<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = request('limit') ?? 10;
        $search = request('search') ?? "";
        $category = request('category');
        $tag = request('tag');
        $page = request('page');
        try {
            $items = Project::with(['category', 'tags']);
            if ($category) {
                $items->whereHas('category', function ($cat) use ($category) {
                    $cat->where('slug', $category);
                });
            }
            if ($tag) {
                $items->whereHas('tags', function ($cat) use ($tag) {
                    $cat->where('slug', $tag);
                });
            }

            if ($search) {
                $items->where('name', 'like', '%' . $search . '%');
            }

            $projects = $items->paginate($limit);
            // Menyusun pagination data
            $pagination = [
                'current_page' => $projects->currentPage(),
                'last_page' => $projects->lastPage(),
                'per_page' => $projects->perPage(),
                'total' => $projects->total(),
            ];
            return ResponseFormatter::success(ProjectResource::collection($projects), "Projects Found.", 200, $pagination);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }

    public function show($slug)
    {
        try {
            $project = Project::with(['category', 'tags'])->where('slug', $slug)->first();
            return ResponseFormatter::success(new ProjectResource($project), "Project Found.", 200);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }

    public function related()
    {
        try {
            $limit = request('limit');
            $slug = request('slug');
            $project = Project::with(['category', 'tags'])->where('slug', $slug)->first();
            if (!$project) {
                return ResponseFormatter::error(null, "Projects Not Found.", 404);
            }
            $projects = Project::with(['category', 'tags'])->where('project_category_id', $project->project_category_id)->latest()->limit($limit)->get();

            return ResponseFormatter::success(ProjectResource::collection($projects), "Projects Found.", 200);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }
}
