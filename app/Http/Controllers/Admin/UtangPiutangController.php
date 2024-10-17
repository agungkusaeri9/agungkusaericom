<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UtangPiutang;
use App\View\Components\Admin\Datatable;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UtangPiutangController extends Controller
{
    public function index()
    {
        return view('admin.pages.utang-piutang.index', [
            'title' => 'Utang Piutang'
        ]);
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {
            $data = UtangPiutang::orderBy('tanggal_jatuh_tempo', 'DESC');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-name='$model->name' data-type='$model->type' data-description='$model->description'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-name='$model->name'><i class='fas fa fa-trash'></i> Hapus</button>";
                    return $action;
                })
                ->editColumn('jumlah', function ($model) {
                    return formatRupiah($model->jumlah);
                })
                ->editColumn('status', function ($model) {
                    if ($model->status == 1) {
                        return '<span class="badge badge-success">Lunas</span>';
                    } else {
                        return '<span class="badge badge-danger">Belum Lunas</span>';
                    }
                })
                ->editColumn('tanggal_jatuh_tempo', function ($model) {
                    return formatTanggal($model->tanggal_jatuh_tempo, 'd/m/Y');
                })
                ->editColumn('tanggal', function ($model) {
                    return formatTanggal($model->tanggal, 'd/m/Y');
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status')) {
                        if ($request->get('status') === 'lunas')
                            $instance->where('status', 1);
                        else
                            $instance->where('status', 0);
                    }
                    if ($request->get('jenis')) {
                        $instance->where('jenis', $request->get('jenis'));
                    }
                })
                ->rawColumns(['action', 'status'])
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
            'jumlah' => ['required', 'numeric'],
            'jenis' => ['required'],
            'tanggal' => ['required', 'date'],
            'tanggal_jatuh_tempo' => ['required', 'date'],
            'status' => ['required']
        ]);

        try {
            UtangPiutang::updateOrCreate([
                'id'  => request('id')
            ], [
                'tanggal' => request('tanggal'),
                'jumlah' => request('jumlah'),
                'jenis' => request('jenis'),
                'keterangan' => request('keterangan'),
                'kepada' => request('kepada'),
                'tanggal_jatuh_tempo' => request('tanggal_jatuh_tempo'),
                'status' => request('status'),
            ]);

            if (request('id')) {
                $message = 'Utang Piutang berhasil disimpan.';
            } else {
                $message = 'Utang Piutang berhasil ditambahakan.';
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
            $item =  UtangPiutang::find($id);
            $item->delete();
            return response()->json(['status' => 'succcess', 'message' => 'Utang Piutang berhasil dihapus.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Utang Piutang gagal dihapus.']);
        }
    }

    public function getById()
    {
        if (request()->ajax()) {
            $id = request('id');
            $utangPiutang = UtangPiutang::find($id);
            if ($utangPiutang) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'data' => $utangPiutang
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Data tidak ditemukan',
                    'data' => NULL
                ]);
            }
        }
    }
}
