<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogCategoryResource;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $limit = request('limit');
        try {
            if ($limit) {
                $items = PostCategory::limit($limit)->orderBy('name', 'ASC')->get();
            } else {
                $items = PostCategory::orderBy('name', 'ASC')->get();
            }
            return ResponseFormatter::success(BlogCategoryResource::collection($items), "Blog Categories Found.", 200);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }
}
