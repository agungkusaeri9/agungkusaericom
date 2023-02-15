<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class SkillController extends Controller
{
    public function index()
    {
        return view('admin.pages.skill.index', [
            'title' => 'Skill'
        ]);
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = Skill::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-name='$model->name' data-type='$model->type' data-description='$model->description'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-name='$model->name'><i class='fas fa fa-trash'></i> Hapus</button>";
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
            'name' => ['required', Rule::unique('skills')->ignore(request('id'))],
            'image' => ['required','image', 'mimes:jpg,jpeg,png,svg', 'max:2048'],
            'type' => ['required'],
            'description' => ['required']
        ]);

        if (request()->file('image')) {
            if (request('id')) {
                $item = Skill::find(request('id'));
                Storage::disk('public')->delete($item->image);
            }
            $image = request()->file('image')->store('skill', 'public');
        } else {
            if (request('id')) {
                $item = Skill::find(request('id'));
                $image = $item->image;
            } else {
                $image = NULL;
            }
        }


        try {
            Skill::updateOrCreate([
                'id'  => request('id')
            ], [
                'name' => request('name'),
                'image' => $image,
                'type' => request('type'),
                'description' => request('description')
            ]);

            if (request('id')) {
                $message = 'Skill berhasil disimpan.';
            } else {
                $message = 'Skill berhasil ditambahakan.';
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
        $item =  Skill::find($id);
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        return response()->json(['status' => 'succcess', 'message' => 'Skill berhasil dihapus.']);
       } catch (\Throwable $th) {
        return response()->json(['status' => 'error', 'message' => 'Skill gagal dihapus.']);
       }
    }
}
