<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectTag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ProjectTagController extends Controller
{
    public function index()
    {
        return view('admin.pages.project-tag.index',[
            'title' => 'Tag Proyek'
        ]);
    }

    public function data()
    {
        if(request()->ajax())
        {
            $data = ProjectTag::query();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($model){
                        $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-name='$model->name'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-name='$model->name'><i class='fas fa fa-trash'></i> Hapus</button>";
                        return $action;
                    })
                    ->rawColumns(['action'])
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
            'name' => ['required',Rule::unique('project_tags')->ignore(request('id'))]
        ]);

       try {
        ProjectTag::updateOrCreate([
            'id'  => request('id')
        ],[
            'name' => request('name'),
            'slug' => Str::slug(request('name'))
        ]);

        if(request('id'))
        {
            $message = 'Tag Proyek berhasil disimpan.';
        }else{
            $message = 'Tag Proyek berhasil ditambahakan.';
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
        ProjectTag::find($id)->delete();
        return response()->json(['status'=>'succcess','message' => 'Tag Proyek berhasil dihapus.']);
       } catch (\Throwable $th) {
        return response()->json(['status'=>'error','message' => 'Ada kesalahan sistem.']);
       }
    }
}
