<?php

namespace App\Http\Controllers;

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
        if ($q) {
            $posts = Post::publish()->with(['category', 'tags'])->where('title', 'LIKE', '%' . $q . '%')->latest()->paginate(8);
        } else {
            $posts = Post::publish()->with(['category', 'tags'])->latest()->paginate(8);
        }


        $post_categories = PostCategory::withCount('posts')->orderBy('name', 'ASC')->get();
        $post_tags = PostTag::orderBy('name', 'ASC')->get();
        $socmeds = Socmed::orderBy('name', 'ASC')->get();


        $setting = Setting::first();
        $title = 'Temukan berbagai artikel menarik disini | ' . $this->setting->site_name;
        $meta_description =  $setting->site_name . ' - Temukan berbagai artikel menarik tentang teknologi yang mencakup perkembangan terbaru dalam AI, Bahasa Pemrogramman, keamanan siber, dan lainnya.';
        // seo meta
        SEOMeta::setTitle($title)
            ->setDescription($meta_description)
            ->setCanonical(route('posts.index'))
            ->addMeta('author', $setting->author)
            ->setKeywords($setting->meta_keyword);

        // seo og
        OpenGraph::setTitle($title)
            ->setDescription($meta_description)
            ->setUrl(route('posts.index'))
            ->setSiteName($setting->site_name)
            ->addImage($setting->image())
            ->addProperty('image:type', 'image/jpeg/png')
            ->addProperty('image:width', 400)
            ->addProperty('image:height', 300)
            ->addProperty('locale', 'id_ID')
            ->addProperty('type', 'website');

        // seo twitter
        TwitterCard::setType('website')
            ->setImage($setting->image())
            ->setTitle($title)
            ->setDescription($meta_description)
            ->setUrl(route('posts.index'))
            ->setSite($setting->site_name)
            ->addValue('card', 'summary_large_image');

        // seo jsonld
        JsonLd::setType('website')
            ->setTitle($title)
            ->setImage($setting->image())
            ->setDescription($meta_description)
            ->setUrl(route('posts.index'))
            ->setSite($setting->site_name);


        return view('frontend.pages.post.index', [
            'posts' => $posts,
            'post_categories' => $post_categories,
            'socmeds' => $socmeds,
            'post_tags' => $post_tags
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

        $setting = Setting::first();
        $this->setting->site_name;
        // seo meta
        SEOMeta::setTitle($post->title)
            ->setDescription($post->meta_description)
            ->setCanonical(route('posts.show', $post->slug))
            ->addMeta('author', $post->user->name)
            ->setKeywords($post->meta_keyword);

        // seo og
        OpenGraph::setTitle($post->title)
            ->setDescription($post->meta_description)
            ->setUrl(route('posts.show', $post->slug))
            ->setSiteName($setting->site_name)
            ->addImage($post->image())
            ->addProperty('image:type', 'image/jpeg/png')
            ->addProperty('image:width', 400)
            ->addProperty('image:height', 300)
            ->addProperty('locale', 'id_ID')
            ->addProperty('type', 'article')
            ->setArticle([
                'published_time' => $post->created_at,
                'modified_time' => $post->updated_at,
                'author' => $post->user->name,
                'section' => $post->category->name,
                'tag' => $tags
            ]);

        // seo twitter
        TwitterCard::setType('article')
            ->setImage($post->image())
            ->setTitle($post->title)
            ->setDescription($post->meta_description)
            ->setUrl(route('posts.show', $post->slug))
            ->setSite($setting->site_name)
            ->addValue('card', 'summary_large_image');

        // seo jsonld
        JsonLd::setType('article')
            ->setTitle($post->title)
            ->setImage($post->image())
            ->setDescription($post->meta_description)
            ->setUrl(route('posts.show', $post->slug))
            ->setSite($setting->site_name);



        return view('frontend.pages.post.show', [
            'title' => $post->title,
            'post' => $post,
            'setting' => $this->setting
        ]);
    }

    public function category($slug)
    {
        $category = PostCategory::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->paginate(8);


        $setting = Setting::first();
        $title = 'Kategori Artikel ' . $category->name . ' | '  . $this->setting->site_name;
        $meta_description =  $setting->site_name . ' - Temukan berbagai artikel menarik tentang teknologi yang mencakup perkembangan terbaru dalam AI, Bahasa Pemrogramman, keamanan siber, dan lainnya.';
        // seo meta
        SEOMeta::setTitle($title)
            ->setDescription($meta_description)
            ->setCanonical(route('posts.category',$category->slug))
            ->addMeta('author', $setting->author)
            ->setKeywords($setting->meta_keyword);

        // seo og
        OpenGraph::setTitle($title)
            ->setDescription($meta_description)
            ->setUrl(route('posts.category',$category->slug))
            ->setSiteName($setting->site_name)
            ->addImage($setting->image())
            ->addProperty('image:type', 'image/jpeg/png')
            ->addProperty('image:width', 400)
            ->addProperty('image:height', 300)
            ->addProperty('locale', 'id_ID')
            ->addProperty('type', 'website');

        // seo twitter
        TwitterCard::setType('website')
            ->setImage($setting->image())
            ->setTitle($title)
            ->setDescription($meta_description)
            ->setUrl(route('posts.category',$category->slug))
            ->setSite($setting->site_name)
            ->addValue('card', 'summary_large_image');

        // seo jsonld
        JsonLd::setType('website')
            ->setTitle($title)
            ->setImage($setting->image())
            ->setDescription($meta_description)
            ->setUrl(route('posts.category',$category->slug))
            ->setSite($setting->site_name);



        return view('frontend.pages.post.index', [
            'title' => $category->name . ' | Category Blog',
            'posts' => $posts,
            'category' => $category
        ]);
    }

    public function tag($slug)
    {

        $tag = PostTag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->paginate(8);

        $setting = Setting::first();
        $title = 'Tag Artikel ' . $tag->name . ' | '  . $this->setting->site_name;
        $meta_description =  $setting->site_name . ' - Temukan berbagai artikel menarik tentang teknologi yang mencakup perkembangan terbaru dalam AI, Bahasa Pemrogramman, keamanan siber, dan lainnya.';
        // seo meta
        SEOMeta::setTitle($title)
            ->setDescription($meta_description)
            ->setCanonical(route('posts.tag',$tag->slug))
            ->addMeta('author', $setting->author)
            ->setKeywords($setting->meta_keyword);

        // seo og
        OpenGraph::setTitle($title)
            ->setDescription($meta_description)
            ->setUrl(route('posts.tag',$tag->slug))
            ->setSiteName($setting->site_name)
            ->addImage($setting->image())
            ->addProperty('image:type', 'image/jpeg/png')
            ->addProperty('image:width', 400)
            ->addProperty('image:height', 300)
            ->addProperty('locale', 'id_ID')
            ->addProperty('type', 'website');

        // seo twitter
        TwitterCard::setType('website')
            ->setImage($setting->image())
            ->setTitle($title)
            ->setDescription($meta_description)
            ->setUrl(route('posts.tag',$tag->slug))
            ->setSite($setting->site_name)
            ->addValue('card', 'summary_large_image');

        // seo jsonld
        JsonLd::setType('website')
            ->setTitle($title)
            ->setImage($setting->image())
            ->setDescription($meta_description)
            ->setUrl(route('posts.tag',$tag->slug))
            ->setSite($setting->site_name);


        return view('frontend.pages.post.index', [
            'title' => $tag->name . ' | Tag Blog',
            'posts' => $posts,
            'tag' => $tag
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
