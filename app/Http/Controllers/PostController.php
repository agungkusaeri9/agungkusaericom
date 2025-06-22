<?php

namespace App\Http\Controllers;

use App\Models\PengaturanSeo;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostComment;
use App\Models\PostTag;
use App\Models\Setting;
use App\Models\Socmed;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\Sitemap\Tags\Tag;

use function PHPSTORM_META\map;

class PostController extends Controller
{
    private $setting;
    public function __construct()
    {
        visitor()->visit();
        $this->setting = Setting::first();
    }
    public function index()
    {
        $q = request('q');
        if ($q) {
            $posts = Post::publish()->with(['category', 'tags'])->where('title', 'LIKE', '%' . $q . '%')->latest()->paginate(8);
        } else {
            $posts = Post::publish()->with(['category', 'tags'])->latest()->paginate(8);
        }
        $post_categories = PostCategory::withCount('posts')->orderBy('name', 'ASC')->get();
        $post_tags = PostTag::orderBy('name', 'ASC')->get();
        $socmeds = Socmed::orderBy('name', 'ASC')->get();
        $seo = PengaturanSeo::where('halaman', 'blog')->first();
        $seoData = new SEOData(
            title: $seo->judul ?? '',
            description: $seo->meta_description ?? '',
            author: $seo->author ?? '',
            image: $seo ? $seo->gambar() : '',
            url: $seo->url ?? '',
            site_name: $seo->site_name ?? '',
            published_time: $seo ? $seo->published_time : null,
            modified_time: $seo ? $seo->modified_time : null,
            robots: $seo ? $seo->robots : ''
        );
        return view('frontend.pages.post.index', [
            'posts' => $posts,
            'post_categories' => $post_categories,
            'socmeds' => $socmeds,
            'post_tags' => $post_tags,
            'SEOData' => $seoData
        ]);
    }

    public function show($slug)
    {
        $post = Post::publish()->with(['tags', 'comments.child'])->withCount('comments')->where('slug', $slug)->firstOrFail();
        $tags = [];
        if ($post->tags) {
            foreach ($post->tags as $tg) {
                array_push($tags, $tg->name);
            }
        }
        $this->setting->site_name;
        $seoData = new SEOData(
            title: $post->title ?? '',
            description: $post->meta_description ?? '',
            author: $this->setting->author ?? '',
            image: $post ? $post->image() : '',
            url: route('posts.show', $post->slug) ?? '',
            site_name: $this->setting->site_name ?? '',
            published_time: $post ? $post->created_at : null,
            modified_time: $post ? $post->updated_at : null,
            robots: 'index, follow'
        );
        $relatedPosts = Post::where('post_category_id', $post->post_category_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();
        $popularTags = PostTag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();
        $latest_post = Post::latest()->limit(6)->get();
        return view('frontend.pages.post.show', [
            'title' => $post->title,
            'post' => $post,
            'setting' => $this->setting,
            'SEOData' => $seoData,
            'latest_posts' => $latest_post,
            'relatedPosts' => $relatedPosts,
            'popularTags' => $popularTags
        ]);
    }

    public function category($slug)
    {
        $category = PostCategory::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->paginate(8);
        $title = 'Kategori Artikel ' . $category->name . ' | ' . $this->setting->site_name;
        $seo = PengaturanSeo::where('halaman', 'blog')->first();
        $seoData = new SEOData(
            title: $title,
            description: $seo->meta_description ?? '',
            author: $seo->author ?? '',
            image: $seo ? $seo->gambar() : '',
            url: $seo->url ?? '',
            site_name: $seo->site_name ?? '',
            published_time: $seo ? $seo->published_time : null,
            modified_time: $seo ? $seo->modified_time : null,
            robots: $seo ? $seo->robots : ''
        );
        return view('frontend.pages.post.index', [
            'title' => $category->name . ' | Category Blog',
            'posts' => $posts,
            'category' => $category,
            'SEOData' => $seoData
        ]);
    }

    public function tag($slug)
    {

        $tag = PostTag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->paginate(8);

        $title = 'Tag Artikel ' . $tag->name . ' | ' . $this->setting->site_name;
        $seo = PengaturanSeo::where('halaman', 'blog')->first();
        $seoData = new SEOData(
            title: $title,
            description: $seo->meta_description ?? '',
            author: $seo->author ?? '',
            image: $seo ? $seo->gambar() : '',
            url: $seo->url ?? '',
            site_name: $seo->site_name ?? '',
            published_time: $seo ? $seo->published_time : null,
            modified_time: $seo ? $seo->modified_time : null,
            robots: $seo ? $seo->robots : ''
        );
        return view('frontend.pages.post.index', [
            'title' => $tag->name . ' | Tag Blog',
            'posts' => $posts,
            'tag' => $tag,
            'SEOData' => $seoData
        ]);
    }

    public function comment()
    {
        request()->validate([
            'post_id' => ['required', 'numeric'],
            'name' => ['required'],
            'email' => ['required'],
            'comment' => ['required', 'max:100']
        ]);


        try {
            // batasi komentar perhari
            $cek = PostComment::where('post_id', request('post_id'))->whereDate('created_at', now());
            if ($cek->count() > 50) {
                return redirect()->back()->with('error', 'Your comment failed to submit due to restrictions.');
            }

            $data = request()->only(['name', 'email', 'comment', 'parent_id']);
            $post = Post::publish()->findOrFail(request('post_id'));
            $save_info = request('save_info');
            if ($save_info) {
                session(['name' => $data['name']]);
                session(['email' => $data['email']]);
            }
            $post->comments()->create($data);
            return redirect()->back()->with('success', 'Your comment has been submitted.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'System Error.');
        }
    }
}
