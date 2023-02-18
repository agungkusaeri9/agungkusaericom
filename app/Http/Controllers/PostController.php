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
        $q = request('q');
        if($q)
        {
            $posts = Post::with(['category','tags'])->where('title','LIKE', '%'. $q . '%')->latest()->paginate(8);
        }else{
            $posts = Post::with(['category','tags'])->latest()->paginate(8);
        }


        $post_categories = PostCategory::withCount('posts')->orderBy('name','ASC')->get();
        $post_tags = PostTag::orderBy('name','ASC')->get();
        $socmeds = Socmed::orderBy('name','ASC')->get();
        return view('frontend.pages.post.index',[
            'title' => 'Blog | ' . $this->setting->site_name,
            'posts' => $posts,
            'post_categories' => $post_categories,
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

    public function category($slug)
    {
        $category = PostCategory::where('slug',$slug)->firstOrFail();
        $posts = $category->posts()->paginate(8);

        return view('frontend.pages.post.index',[
            'title' => $category->name . ' | Category Blog',
            'posts' => $posts,
            'category' => $category
        ]);
    }

    public function tag($slug)
    {
        $tag = PostTag::where('slug',$slug)->firstOrFail();
        $posts = $tag->posts()->paginate(8);
        return view('frontend.pages.post.index',[
            'title' => $tag->name . ' | Tag Blog',
            'posts' => $posts,
            'tag' => $tag
        ]);
    }
}
