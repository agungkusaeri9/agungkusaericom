<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ToolsController extends Controller
{
    public function index()
    {
        return view('admin.pages.tool.index', [
            'title' => 'Skill'
        ]);
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = Tool::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-name='$model->name' ><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-name='$model->name'><i class='fas fa fa-trash'></i> Hapus</button>";
                    return $action;
                })
                ->editColumn('image', function ($model) {
                    return '<img src="' . $model->image() . '" class="img-fluid" style="max-height:50px">';
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
            'name' => ['required', Rule::unique('tools')->ignore(request('id'))],
            'image' => [Rule::when(!request('id'), 'required'), 'image', 'mimes:jpg,jpeg,png,svg', 'max:2048'],
        ]);

        if (request()->file('image')) {
            if (request('id')) {
                $item = Tool::find(request('id'));
                Storage::disk('public')->delete($item->image);
            }
            $image = request()->file('image')->store('tool', 'public');
        } else {
            if (request('id')) {
                $item = Tool::find(request('id'));
                $image = $item->image;
            } else {
                $image = NULL;
            }
        }


        try {
            Tool::updateOrCreate([
                'id'  => request('id')
            ], [
                'name' => request('name'),
                'image' => $image,
            ]);

            if (request('id')) {
                $message = 'Tool berhasil disimpan.';
            } else {
                $message = 'Tool berhasil ditambahakan.';
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
            $item =  Tool::find($id);
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $item->delete();
            return response()->json(['status' => 'succcess', 'message' => 'Tool berhasil dihapus.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Tool gagal dihapus.']);
        }
    }
}
