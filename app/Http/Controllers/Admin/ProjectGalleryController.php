<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectGalleryController extends Controller
{
    public function index($project_id)
    {
        $item = Project::with('galleries')->findOrFail($project_id);
        return view('admin.pages.project.gallery', [
            'title' => 'Galeri Proyek',
            'item' => $item
        ]);
    }

    public function store($project_id)
    {
        request()->validate([
            'image' => ['required','image','max:2048','mimes:png,jpg,jpeg']
        ]);
        try {
            $project = Project::findOrFail($project_id);

            $project->galleries()->create([
                'image' => request()->file('image')->store('project/gallery', 'public')
            ]);
            return redirect()->back()->with('success', 'Gambar Proyek berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Ada kesalahan sistem!');
        }
    }

    public function destroy($id)
    {
        $gallery = ProjectGallery::findOrFail($id);
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();
        return redirect()->back()->with('success', 'Gambar Proyek berhasil dihapus.');
    }
}
