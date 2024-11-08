<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogDetailResource;
use App\Http\Resources\BlogResource;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = request('limit') ?? 10;
        $category = request('category');
        try {
            $items = Post::with(['category', 'tags']);
            if ($category) {
                $items->whereHas('category', function ($cat) use ($category) {
                    $cat->where('slug', $category);
                });
            }

            $blogs = $items->paginate($limit);
            // Menyusun pagination data
            $pagination = [
                'current_page' => $blogs->currentPage(),
                'last_page' => $blogs->lastPage(),
                'per_page' => $blogs->perPage(),
                'total' => $blogs->total(),
            ];
            return ResponseFormatter::success(BlogResource::collection($blogs), "Blog Found.", 200, $pagination);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }

    public function show($slug)
    {
        try {
            $project = Post::with(['category', 'tags'])->where('slug', $slug)->first();
            return ResponseFormatter::success(new BlogDetailResource($project), "Project Found.", 200);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }
}
