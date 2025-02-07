<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectTagResource;
use App\Models\ProjectTag;
use Illuminate\Http\Request;

class ProjectTagController extends Controller
{
    public function index()
    {
        $limit = request('limit');
        try {
            if ($limit) {
                $items = ProjectTag::limit($limit)->orderBy('name', 'ASC')->get();
            } else {
                $items = ProjectTag::orderBy('name', 'ASC')->get();
            }
            return ResponseFormatter::success(ProjectTagResource::collection($items), "Projects Tag Found.", 200);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }
}
