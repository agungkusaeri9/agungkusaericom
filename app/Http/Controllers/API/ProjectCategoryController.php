<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectCategoryResource;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    public function index()
    {
        $limit = request('limit');
        try {
            if ($limit) {
                $items = ProjectCategory::limit($limit)->orderBy('name', 'ASC')->get();
            } else {
                $items = ProjectCategory::orderBy('name', 'ASC')->get();
            }
            return ResponseFormatter::success(ProjectCategoryResource::collection($items), "Projects Categories Found.", 200);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }
}
