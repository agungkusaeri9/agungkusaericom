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
        $search = request('search') ?? "";
        $category = request('category');
        $tag = request('tag');
        $page = request('page');
        try {
            $items = Post::with(['category', 'tags']);
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

            $blogs = $items->paginate($limit);
            // Menyusun pagination data
            $pagination = [
                'current_page' => $blogs->currentPage(),
                'last_page' => $blogs->lastPage(),
                'per_page' => $blogs->perPage(),
                'total' => $blogs->total(),
            ];
            return ResponseFormatter::success(BlogResource::collection($blogs), "Blogs Found.", 200, $pagination);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }

    public function show($slug)
    {
        try {
            $project = Post::with(['category', 'tags'])->where('slug', $slug)->first();
            return ResponseFormatter::success(new BlogResource($project), "Blog Found.", 200);
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
            $blog = Post::with(['category', 'tags'])->where('slug', $slug)->first();
            if (!$blog) {
                return ResponseFormatter::error(null, "Blogs Not Found.", 404);
            }
            $blogs = Post::with(['category', 'tags'])->where('post_category_id', $blog->post_category_id)->latest()->limit($limit)->get();

            return ResponseFormatter::success(BlogResource::collection($blogs), "Blog Found.", 200);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }
}
