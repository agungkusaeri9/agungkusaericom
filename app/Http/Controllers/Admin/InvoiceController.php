<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('admin.pages.invoice.index', [
            'title' => 'Data Invoice'
        ]);
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {
            $data = Invoice::latest();
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $print = route('admin.invoices.export-pdf', $model->code);
                    $edit = route('admin.invoices.edit', $model->id);
                    $show = route('admin.invoices.show', $model->id);
                    $action = "<a href='$print' target='_blank' class='btn btn-sm btn-secondary mx-1' ><i class='fas fa fa-print'></i> Print</a>
                    <a href='$show' class='btn btn-sm btn-warning mx-1' ><i class='fas fa fa-eye'></i> Detail</a><a href='$edit' class='btn btn-sm btn-info btnEdit mx-1' ><i class='fas fa fa-edit'></i> Edit</a><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-code='$model->code' ><i class='fas fa fa-trash'></i> Hapus</button>";
                    return $action;
                })
                ->editColumn('created_at', function ($model) {
                    return $model->created_at->translatedFormat('H:i:s d-m-Y');
                })
                ->editColumn('paid_time', function ($model) {
                    $md =  $model->paid_time ? $model->paid_time->translatedFormat('H:i:s d-m-Y') : '-';
                    return $md;
                })
                ->editColumn('sub_total', function ($model) {
                    return 'Rp ' . number_format($model->sub_total, 0, ',', '.');
                })
                ->editColumn('discount', function ($model) {
                    return 'Rp ' . number_format($model->discount, 0, ',', '.');
                })
                ->editColumn('total', function ($model) {
                    return 'Rp ' . number_format($model->total, 0, ',', '.');
                })
                ->editColumn('status', function ($model) {
                    return $model->status();
                })
                ->filter(function ($instance) use ($request) {

                    if ($request->get('status')) {
                        if ($request->get('status') === 'paid')
                            $instance->where('status', 1);
                        else
                            $instance->where('status', 0);
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('admin.pages.invoice.create', [
            'title' => 'Buat Invoice',
            'payments' => Payment::get()
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required'],
            'phone_number' => ['required'],
            'status' => ['numeric', 'in:0,1'],
            'item_price' => ['array']
        ]);

        // hitung sub total dulu (cek input valid)
        $sub_total = 0;
        foreach (request('item_price') as $key => $item_price) {
            $item_qty = request('item_qty')[$key] ?? 0;
            $sub_total += ($item_price * $item_qty);
        }

        $data = request()->only(['name', 'phone_number', 'address', 'discount', 'status', 'payment_id']);
        $data['sub_total'] = $sub_total;
        $data['total'] = $data['sub_total'] - ($data['discount'] ?? 0);

        $maxAttempts = 5;
        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            DB::beginTransaction();
            try {
                // generate kode INV-YYYYMM-0001 based on last invoice in same period
                $period = Carbon::now()->format('Ym'); // YYYYMM, pakai Carbon::now('Asia/Jakarta') kalo mau WIB
                $prefix = "INV-{$period}-";

                $last = Invoice::where('code', 'like', $prefix . '%')
                    ->orderBy('code', 'desc')
                    ->lockForUpdate() // attempt to lock matching rows (may help)
                    ->first();

                if ($last) {
                    $nomor_kode = (int) substr($last->code, -4);
                    $next = $nomor_kode + 1;
                } else {
                    $next = 1;
                }

                $seq = str_pad($next, 4, '0', STR_PAD_LEFT); // 0001
                $kode_baru = $prefix . $seq;

                $data['code'] = $kode_baru;

                // create invoice
                $invoice = Invoice::create($data);

                // insert detail invoice
                foreach (request('item_price') as $key => $item_price) {
                    $item_qty = request('item_qty')[$key] ?? 0;
                    $item_description = request('item_description')[$key] ?? '';
                    $total = $item_price * $item_qty;

                    $invoice->details()->create([
                        'description' => $item_description,
                        'price' => $item_price,
                        'qty' => $item_qty,
                        'total' => $total
                    ]);
                }

                DB::commit();
                return redirect()->route('admin.invoices.index')->with('success', 'Invoice berhasil dibuat. (No: ' . $kode_baru . ')');
            } catch (QueryException $qe) {
                DB::rollBack();
                // duplicate key error (MySQL SQLSTATE 23000), coba lagi
                // pastikan invoice.code memiliki UNIQUE constraint supaya ini nendang
                $isDuplicate = strpos($qe->getMessage(), '1062') !== false || $qe->getCode() === '23000';
                if ($isDuplicate && $attempt < $maxAttempts) {
                    // small backoff to reduce collision chance
                    usleep(100000 * $attempt); // 0.1s, 0.2s, ...
                    continue;
                }
                // kalau bukan duplicate atau udah nyoba berkali-kali, rollback & exit
                return redirect()->route('admin.invoices.index')->with('error', 'Ada kesalahan sistem (DB).');
            } catch (\Throwable $th) {
                dd($th->getMessage());
                DB::rollBack();
                return redirect()->route('admin.invoices.index')->with('error', 'Ada kesalahan sistem.');
            }
        }

        // kalau loop habis tanpa sukses
        return redirect()->route('admin.invoices.index')->with('error', 'Gagal membuat invoice setelah beberapa percobaan. Silakan coba lagi.');
    }


    public function show($id)
    {
        $item = Invoice::with(['details', 'payment'])->findOrFail($id);
        return view('admin.pages.invoice.show', [
            'title' => 'Detail Invoice',
            'item' => $item,
            'setting' => Setting::first()
        ]);
    }

    public function edit($id)
    {
        $item = Invoice::with('details')->findOrFail($id);
        return view('admin.pages.invoice.edit', [
            'title' => 'Edit Invoice',
            'item' => $item,
            'payments' => Payment::get()
        ]);
    }

    public function update($id)
    {
        request()->validate([
            'name' => ['required'],
            'phone_number' => ['required'],
            'status' => ['numeric', 'in:0,1'],
            'item_price' => ['array']
        ]);


        DB::beginTransaction();
        try {
            $item = Invoice::findOrFail($id);
            $data = request()->only(['name', 'phone_number', 'address', 'discount', 'status', 'payment_id', 'paid_time', 'created_at']);

            // hitung sub total
            $sub_total = 0;
            foreach (request('item_price') as $key => $item_price) {
                $item_qty = request('item_qty')[$key];
                $sub_total = $sub_total + ($item_price * $item_qty);
            }
            $data['sub_total'] = $sub_total;
            $data['total'] = $data['sub_total'] - $data['discount'];
            $item->update($data);


            // delete detail
            InvoiceDetail::where('invoice_id', $item->id)->delete();

            // insert detail invoice
            foreach (request('item_price') as $key => $item_price) {
                $item_qty = request('item_qty')[$key];
                $item_description = request('item_description')[$key];
                $total = $item_price * $item_qty;

                $item->details()->create([
                    'description' => $item_description,
                    'price' => $item_price,
                    'qty' => $item_qty,
                    'total' => $total
                ]);
            }

            DB::commit();

            return redirect()->route('admin.invoices.index')->with('success', 'Invoice berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return redirect()->route('admin.invoices.index')->with('error', 'Ada kesalahan sistem.');
        }
    }

    public function destroy($id)
    {
        try {
            $item =  Invoice::find($id);
            $item->delete();
            return response()->json(['status' => 'succcess', 'message' => 'Invoice berhasil dihapus.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Invoice gagal dihapus.']);
        }
    }

    public function exportPdf($code)
    {
        $item = Invoice::where('code', $code)->firstorFail();
        // $pdf = Pdf::loadView('admin.pages.invoice.export-pdf',[
        //     'item' => $item,
        //     'setting' => Setting::first()
        // ]);
        // return $pdf->stream();
        return view('admin.pages.invoice.export-pdf', [
            'item' => $item,
            'title' => 'Invoice #' . $item->code,
            'setting' => Setting::first()
        ]);
    }
}
