<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostComment;
use App\Models\PostTag;
use App\Models\Setting;
use App\Models\Socmed;
use Carbon\Carbon;
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
            $posts = Post::publish()->with(['category','tags'])->where('title','LIKE', '%'. $q . '%')->latest()->paginate(8);
        }else{
            $posts = Post::publish()->with(['category','tags'])->latest()->paginate(8);
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
        $post = Post::publish()->with(['comments.child'])->withCount('comments')->where('slug', $slug)->firstOrFail();
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

    public function comment()
    {
        request()->validate([
            'post_id' => ['required','numeric'],
            'name' => ['required'],
            'email' => ['required'],
            'comment' => ['required','max:100']
        ]);

        try {
            // batasi komentar perhari
        $cek = PostComment::where('post_id',request('post_id'))->whereDate('created_at',now());
        if($cek->count() > 50)
        {
            return redirect()->back()->with('error','Your comment failed to submit due to restrictions.');
        }

        $data = request()->only(['name','email','comment','parent_id']);
        $post = Post::publish()->findOrFail(request('post_id'));
        $save_info = request('save_info');
        if($save_info)
        {
            session(['name' => $data['name']]);
            session(['email' => $data['email']]);
        }
       $post->comments()->create($data);
       return redirect()->back()->with('success','Your comment has been submitted.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','System Error.');
        }
    }
}
