<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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
                        if($request->get('status') === 'paid')
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

        DB::beginTransaction();
        try {
            $data = request()->only(['name', 'phone_number', 'address', 'discount', 'status', 'payment_id']);
            $kode_lama = Invoice::latest();
            if ($kode_lama->count() > 0) {
                $nomor_kode = \Str::substr($kode_lama->first()->code, 3);
                $kode_baru = 'INV' . str_pad($nomor_kode + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $kode_baru = 'INV001';
            }
            // hitung sub total dan total
            $sub_total = 0;
            foreach (request('item_price') as $key => $item_price) {
                $item_qty = request('item_qty')[$key];
                $sub_total = $sub_total + ($item_price * $item_qty);
            }
            $data['sub_total'] = $sub_total;
            $data['code'] = $kode_baru;
            $data['total'] = $data['sub_total'] - $data['discount'];
            $invoice = Invoice::create($data);

            // insert detail invoice
            foreach (request('item_price') as $key => $item_price) {
                $item_qty = request('item_qty')[$key];
                $item_description = request('item_description')[$key];
                $total = $item_price * $item_qty;

                $invoice->details()->create([
                    'description' => $item_description,
                    'price' => $item_price,
                    'qty' => $item_qty,
                    'total' => $total
                ]);
            }

            DB::commit();

            return redirect()->route('admin.invoices.index')->with('success', 'Invoice berhasil dibuat.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('admin.invoices.index')->with('error', 'Ada kesalahan sistem.');
        }
    }


    public function show($id)
    {
        $item = Invoice::with(['details','payment'])->findOrFail($id);
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
            $data = request()->only(['name', 'phone_number', 'address', 'discount', 'status', 'payment_id','paid_time','created_at']);

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
            InvoiceDetail::where('invoice_id',$item->id)->delete();

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

    public function exportPdf($code){
        $item = Invoice::where('code',$code)->firstorFail();
        // $pdf = Pdf::loadView('admin.pages.invoice.export-pdf',[
        //     'item' => $item,
        //     'setting' => Setting::first()
        // ]);
        // return $pdf->stream();
        return view('admin.pages.invoice.export-pdf',[
            'item' => $item,
            'title' => 'Invoice #' . $item->code,
            'setting' => Setting::first()
        ]);
    }
}
