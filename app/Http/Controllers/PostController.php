<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\Setting;
use App\Models\Socmed;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class PostController extends Controller
{
    private $setting;
    public function __construct()
    {
        $this->setting = Setting::first();
    }
    public function index()
    {
        $posts = Post::with(['category','tags'])->latest()->paginate(12);
        $post_categories = PostCategory::withCount('posts')->orderBy('name','ASC')->get();
        $post_tags = PostTag::orderBy('name','ASC')->get();
        $socmeds = Socmed::orderBy('name','ASC')->get();
        return view('frontend.pages.post.index',[
            'title' => 'Blog',
            'posts' => $posts,
            'post_categories' => $post_categories,
            'setting' => $this->setting,
            'socmeds' => $socmeds,
            'post_tags' => $post_tags
        ]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.post.show',[
            'title' => $post->title,
            'post' => $post,
            'setting' => $this->setting
        ]);
    }
}
