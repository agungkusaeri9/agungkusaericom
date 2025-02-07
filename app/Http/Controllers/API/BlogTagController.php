<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogTagResource;
use App\Models\PostTag;
use Illuminate\Http\Request;

class BlogTagController extends Controller
{
    public function index()
    {
        $limit = request('limit');
        try {
            if ($limit) {
                $items = PostTag::limit($limit)->orderBy('name', 'ASC')->get();
            } else {
                $items = PostTag::orderBy('name', 'ASC')->get();
            }
            return ResponseFormatter::success(BlogTagResource::collection($items), "Blog Tag Found.", 200);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }
}
