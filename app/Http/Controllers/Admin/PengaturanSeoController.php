<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class PengaturanSeoController extends Controller
{
    public function index()
    {
        return view('admin.pages.pengaturan-seo.index', [
            'title' => 'Pengaturan SEO'
        ]);
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = PengaturanSeo::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-name='$model->name' data-type='$model->type' data-description='$model->description'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-name='$model->name'><i class='fas fa fa-trash'></i> Hapus</button>";
                    return $action;
                })
                ->editColumn('gambar', function ($model) {
                    return '<img src="' . $model->gambar() . '" class="img-fluid" style="max-height:50px">';
                })
                ->addColumn('published', function ($model) {
                    return $model->published_time->translatedFormat('d F Y H:i:s');
                })
                ->addColumn('modified', function ($model) {
                    return $model->modified_time->translatedFormat('d F Y H:i:s');
                })
                ->rawColumns(['action', 'gambar'])
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
            'halaman' => ['required', Rule::unique('pengaturan_seo')->ignore(request('id'))],
            'gambar' => [Rule::when(request('gambar'), ['required']), 'image', 'mimes:jpg,jpeg,png,svg', 'max:2048'],
            'judul' => ['required'],
            'meta_keyword' => ['required'],
            'meta_description' => ['required'],
            'url' => ['required'],
            'site_name' => ['required'],
            'robots' => ['required'],
            'author' => ['required']
        ]);

        if (request()->file('gambar')) {
            if (request('id')) {
                $item = PengaturanSeo::find(request('id'));
                Storage::disk('public')->delete($item->gambar);
            }
            $gambar = request()->file('gambar')->store('pengaturan-seo', 'public');
        } else {
            if (request('id')) {
                $item = PengaturanSeo::find(request('id'));
                $gambar = $item->gambar;
            } else {
                $gambar = NULL;
            }
        }


        try {
            PengaturanSeo::updateOrCreate([
                'id'  => request('id')
            ], [
                'halaman' => request('halaman'),
                'gambar' => $gambar,
                'judul' => request('judul'),
                'meta_keyword' => request('meta_keyword'),
                'meta_description' => request('meta_description'),
                'url' => request('url'),
                'site_name' => request('site_name'),
                'published_time' => request('published_time'),
                'modified_time' => request('modified_time'),
                'robots' => request('robots'),
                'author' => request('author'),
            ]);

            if (request('id')) {
                $message = 'Pengaturan SEO berhasil disimpan.';
            } else {
                $message = 'Pengaturan SEO berhasil ditambahakan.';
            }
            return response()->json(['status' => 'succcess', 'message' => $message]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Ada kesalahan sistem.']);
        }
    }

    public function getByIdJson()
    {
        if (request()->ajax()) {
            $id = request('id');
            $pengaturan = PengaturanSeo::where('id', $id)->first();
            $pengaturan['published'] = $pengaturan->published_time->translatedFormat('Y-m-d H:i:s');
            $pengaturan['modified'] = $pengaturan->modified_time->translatedFormat('Y-m-d H:i:s');
            if ($pengaturan) {
                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => 'Pengaturan berhasil diambil',
                    'data' => $pengaturan
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => 404,
                    'message' => 'Pengaturan tidak ada',
                    'data' => NULL
                ]);
            }
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
            $item =  PengaturanSeo::find($id);
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $item->delete();
            return response()->json(['status' => 'succcess', 'message' => 'Pengaturan SEO berhasil dihapus.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Pengaturan SEO gagal dihapus.']);
        }
    }
}
