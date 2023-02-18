<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InboxController extends Controller
{
    public function index()
    {
        return view('admin.pages.inbox.index',[
            'title' => 'Pesan Masuk'
        ]);
    }

    public function data()
    {
        if(request()->ajax())
        {
            $data = Inbox::latest();
            return DataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($model){
                        $action = "<button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-name='$model->name'><i class='fas fa fa-trash'></i> Hapus</button>";
                        return $action;
                    })
                    ->addColumn('tanggal', function($model){
                        return $model->created_at->translatedFormat('d-m-Y H:i:s');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function destroy($id)
    {
       try {
        Inbox::find($id)->delete();
        return response()->json(['status'=>'succcess','message' => 'Pesan Masuk berhasil dihapus.']);
       } catch (\Throwable $th) {
        return response()->json(['status'=>'error','message' => 'Ada kesalahan sistem.']);
       }
    }
}
