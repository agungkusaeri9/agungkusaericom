<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.pages.project.index', [
            'title' => 'Proyek'
        ]);
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = Project::with('category')->latest();
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $urlDetail = route('admin.projects.show', $model->id);
                    $urlGalleries = route('admin.projects.galleries.index', $model->id);
                    $urlEdit = route('admin.projects.edit', $model->id);
                    $action = "<a href='$urlGalleries' class='btn btn-sm btn-success mx-1'><i class='fas fa fa-image'></i> Galeri</a>
                    <a href='$urlDetail' class='btn btn-sm btn-warning mx-1'><i class='fas fa fa-eye'></i> Detail</a><a href='$urlEdit' class='btn btn-sm btn-info mx-1'><i class='fas fa fa-edit'></i> Edit</a><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-name='$model->name'><i class='fas fa fa-trash'></i> Hapus</button>";
                    return $action;
                })
                ->addColumn('category', function ($model) {
                    return $model->category->name;
                })
                ->editColumn('is_publish', function ($model) {
                    if ($model->is_publish == true) {
                        return '<span class="badge badge-success">Ya</span>';
                    } else {
                        return '<span class="badge badge-danger ">Tidak</span>';
                    }
                })
                ->editColumn('is_portfolio', function ($model) {
                    if ($model->is_portfolio == true) {
                        return '<span class="badge badge-success">Ya</span>';
                    } else {
                        return '<span class="badge badge-danger ">Tidak</span>';
                    }
                })
                ->editColumn('status', function ($model) {
                    if ($model->status === 'ON PROGRESS') {
                        return '<span class="badge badge-warning">ON PROGRESS</span>';
                    } else if ($model->status === 'SUCCESS') {
                        return '<span class="badge badge-success">SUCCESS</span>';
                    } else if ($model->status === 'PENDING') {
                        return '<span class="badge badge-warning">PENDING</span>';
                    } else {
                        return '<span class="badge badge-danger">FAILED</span>';
                    }
                })
                ->editColumn('image', function ($model) {
                    return '<img src="' . $model->image() . '" class="img-fluid" style="max-height:80px;max-width:60px;">';
                })
                ->addColumn('created', function ($model) {
                    return $model->created_at->translatedFormat('d-m-Y H:i:s');
                })
                ->rawColumns(['action', 'is_publish', 'status', 'image', 'is_portfolio'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('admin.pages.project.create', [
            'title' => 'Tambah Proyek',
            'categories' => ProjectCategory::orderBy('name', 'ASC')->get(),
            'tags' => ProjectTag::orderBy('name', 'ASC')->get()
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required', 'max:255'],
            'project_category_id' => ['required'],
            'description' => ['required'],
            'status' => ['required'],
            'is_publish' => ['required', 'in:0,1'],
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048']
        ]);

        try {
            $data = request()->except('project_tag_id');
            $request_project_tags = request('project_tag_id');
            $project_tags = [];
            if (count($request_project_tags) > 0) {
                foreach ($request_project_tags as $key => $value) {
                    if (is_numeric($value)) {
                        $project_tags[]  = intval($value);
                    } else {
                        $newTag = ProjectTag::create(['name' => $value, 'slug' => Str::slug($value)]);
                        $project_tags[] = $newTag->id;
                    }
                }
            }
            $data['slug'] = Str::slug(request('name'));
            if (request()->file('image')) {
                $data['image'] = request()->file('image')->store('project', 'public');
            }
            $project = Project::create($data);
            $project->tags()->attach($project_tags);
            return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil ditambahkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.projects.index')->with('error', 'Ada kesalahan sistem!');
        }
    }

    public function show($id)
    {
        $item = Project::with(['category', 'tags'])->findOrFail($id);
        return view('admin.pages.project.show', [
            'title' => 'Detail Proyek',
            'item' => $item
        ]);
    }


    public function edit($id)
    {
        $item = Project::findOrFail($id);
        $item_tags = [];
        foreach ($item->tags as $itag) {
            array_push($item_tags, $itag->id);
        }
        $project_tags = ProjectTag::orderBy('name')->get();
        return view('admin.pages.project.edit', [
            'title' => 'Edit Proyek',
            'categories' => ProjectCategory::orderBy('name', 'ASC')->get(),
            'tags' => ProjectTag::orderBy('name', 'ASC')->get(),
            'item' => $item,
            'project_tags' => $project_tags,
            'item_tags' => $item_tags
        ]);
    }


    public function update($id)
    {
        request()->validate([
            'name' => ['required', 'max:255'],
            'project_category_id' => ['required'],
            'description' => ['required'],
            'status' => ['required'],
            'is_publish' => ['required', 'in:0,1'],
            'image' => ['image', 'mimes:jpg,png,jpeg', 'max:2048']
        ]);

        try {
            $request_project_tags = request('project_tag_id');
            $project_tags = [];
            if (count($request_project_tags) > 0) {
                foreach ($request_project_tags as $key => $value) {
                    if (is_numeric($value)) {
                        $project_tags[]  = intval($value);
                    } else {
                        $newTag = ProjectTag::create(['name' => $value, 'slug' => Str::slug($value)]);
                        $project_tags[] = $newTag->id;
                    }
                }
            }

            $item = Project::with('tags')->findOrFail($id);
            $data = request()->except('project_tag_id');
            $data['slug'] = Str::slug(request('name'));
            if (request()->file('image')) {
                $data['image'] = request()->file('image')->store('project', 'public');
            } else {
                $data['image'] = $item->image;
            }
            $item->update($data);
            $item->tags()->sync($project_tags);
            return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil disimpan');
            return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.projects.index')->with('error', 'Ada kesalahan sistem!');
        }
    }



    public function destroy($id)
    {
        try {
            $item = Project::find($id)->delete();
            Storage::disk('public')->delete($item);
            return response()->json(['status' => 'succcess', 'message' => 'Kategori Proyek berhasil dihapus.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Ada kesalahan sistem.']);
        }
    }
}
