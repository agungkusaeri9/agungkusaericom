<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    public function index()
    {
        return view('admin.pages.payment.index', [
            'title' => 'Metode Pembayaran'
        ]);
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = Payment::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-name='$model->name' data-number='$model->number' data-description='$model->description'  data-link='$model->link'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-name='$model->name'><i class='fas fa fa-trash'></i> Hapus</button>";
                    return $action;
                })
                ->editColumn('image', function ($model) {
                    if ($model->image) {
                        return '<img src="' . $model->image() . '" class="img-fluid" style="max-height:50px">';
                    } else {
                        return 'Tidak Ada';
                    }
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required', Rule::unique('payments')->ignore(request('id'))],
            'image' => ['image', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);

        if (request()->file('image')) {
            if (request('id')) {
                $item = Payment::find(request('id'));
                Storage::disk('public')->delete($item->image);
            }
            $image = request()->file('image')->store('payment', 'public');
        } else {
            if (request('id')) {
                $item = Payment::find(request('id'));
                $image = $item->image;
            } else {
                $image = NULL;
            }
        }

        try {
            Payment::updateOrCreate([
                'id'  => request('id')
            ], [
                'name' => request('name'),
                'image' => $image,
                'number' => request('number'),
                'description' => request('description')
            ]);

            if (request('id')) {
                $message = 'Metode Pembayaran berhasil disimpan.';
            } else {
                $message = 'Metode Pembayaran berhasil ditambahakan.';
            }
            return response()->json(['status' => 'succcess', 'message' => $message]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Ada kesalahan sistem.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item =  Payment::find($id);
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $item->delete();
            return response()->json(['status' => 'succcess', 'message' => 'Metode Pembayaran berhasil dihapus.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Metode Pembayaran gagal dihapus.']);
        }
    }
}
