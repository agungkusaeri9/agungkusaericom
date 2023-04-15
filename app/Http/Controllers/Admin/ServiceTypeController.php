<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ServiceTypeController extends Controller
{
    public function index()
    {
        return view('admin.pages.service-type.index',[
            'title' => 'Jenis Layanan'
        ]);
    }

    public function data()
    {
        if(request()->ajax())
        {
            $data = ServiceType::query();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($model){
                        $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-name='$model->name' ><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-name='$model->name' ><i class='fas fa fa-trash'></i> Hapus</button>";
                        return $action;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function getById()
    {
        $id = request('id');
        $item = ServiceType::find($id);
        return response()->json($item);
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
            'name' => ['required',Rule::unique('project_categories')->ignore(request('id'))]
        ]);

       try {
        ServiceType::updateOrCreate([
            'id'  => request('id')
        ],[
            'name' => request('name'),
            'content' => request('content'),
            'head' => request('head'),
            'script' => request('script'),
            'slug' => Str::slug(request('name'))
        ]);

        if(request('id'))
        {
            $message = 'Jenis Layanan berhasil disimpan.';
        }else{
            $message = 'Jenis Layanan berhasil ditambahakan.';
        }
        return response()->json(['status'=>'success','message' => $message]);
       } catch (\Throwable $th) {
        return response()->json(['status'=>'error','message' => 'Ada kesalahan sistem.']);
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
        ServiceType::find($id)->delete();
        return response()->json(['status'=>'succcess','message' => 'Jenis Layanan berhasil dihapus.']);
       } catch (\Throwable $th) {
        return response()->json(['status'=>'error','message' => 'Ada kesalahan sistem.']);
       }
    }
}
