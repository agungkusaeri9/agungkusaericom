<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectTag;
use App\Models\Setting;
use App\Models\Socmed;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
            $projects = Project::publish()->with(['category','tags'])->where('name','LIKE','%' . $q . '%')->latest()->paginate(8);
        }else{

            $projects = Project::publish()->with(['category','tags'])->latest()->paginate(8);
        }
        $project_categories = ProjectCategory::withCount('projects')->orderBy('name','ASC')->get();
        $project_tags = ProjectTag::orderBy('name','ASC')->get();
        $socmeds = Socmed::orderBy('name','ASC')->get();


        $setting = Setting::first();
        $title = 'Kumpulan Portofolio Terbaik Saya | ' . $this->setting->site_name;
        $meta_description = $setting->site_name . ' - Jelajahi portofolio pribadi saya, yang mencakup karya-karya terbaik dibidang pengembangan web. Dari konsep hingga implementasi, temukan keterampilan dan bakat saya dalam setiap karya yang saya hasilkan.';
        // seo meta
        SEOMeta::setTitle($title)
            ->setDescription($meta_description)
            ->setCanonical(route('projects.index'))
            ->addMeta('author', $setting->author)
            ->setKeywords($setting->meta_keyword)
            ->addMeta('robots','index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1');

        // seo og
        OpenGraph::setTitle($title)
            ->setDescription($meta_description)
            ->setUrl(route('projects.index'))
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
            ->setUrl(route('projects.index'))
            ->setSite($setting->site_name)
            ->addValue('card', 'summary_large_image');

        // seo jsonld
        JsonLd::setType('website')
            ->setTitle($title)
            ->setImage($setting->image())
            ->setDescription($meta_description)
            ->setUrl(route('projects.index'))
            ->setSite($setting->site_name);

        return view('frontend.pages.project.index',[
            'title' => 'Projects | ' . $this->setting->site_name,
            'projects' => $projects,
            'project_categories' => $project_categories,
            'setting' => $this->setting,
            'socmeds' => $socmeds,
            'project_tags' => $project_tags
        ]);
    }

    public function show($slug)
    {
        $project = Project::with(['tags','galleries'])->publish()->where('slug', $slug)->firstOrFail();

        $tags = [];
        if ($project->tags) {
            foreach ($project->tags as $tg) {
                array_push($tags, $tg->name);
            }
        }

        $setting = Setting::first();
        $this->setting->site_name;
        // seo meta
        SEOMeta::setTitle($project->name)
            ->setDescription($project->meta_description)
            ->setCanonical(route('projects.show', $project->slug))
            ->addMeta('author', $setting->author)
            ->setKeywords($project->meta_keyword)
            ->addMeta('robots','index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1');

        // seo og
        OpenGraph::setTitle($project->name)
            ->setDescription($project->meta_description)
            ->setUrl(route('projects.show', $project->slug))
            ->setSiteName($setting->site_name)
            ->addImage($project->image())
            ->addProperty('image:type', 'image/jpeg/png')
            ->addProperty('image:width', 400)
            ->addProperty('image:height', 300)
            ->addProperty('locale', 'id_ID')
            ->addProperty('type', 'article')
            ->setArticle([
                'published_time' => $project->created_at,
                'modified_time' => $project->updated_at,
                'author' => $setting->author,
                'section' => $project->category->name,
                'tag' => $tags
            ]);

        // seo twitter
        TwitterCard::setType('article')
            ->setImage($project->image())
            ->setTitle($project->name)
            ->setDescription($project->meta_description)
            ->setUrl(route('projects.show', $project->slug))
            ->setSite($setting->site_name)
            ->addValue('card', 'summary_large_image');

        // seo jsonld
        JsonLd::setType('article')
            ->setTitle($project->name)
            ->setImage($project->image())
            ->setDescription($project->meta_description)
            ->setUrl(route('projects.show', $project->slug))
            ->setSite($setting->site_name);

        return view('frontend.pages.project.show',[
            'project' => $project,
            'setting' => $this->setting
        ]);
    }

    public function category($slug)
    {
        $category = ProjectCategory::where('slug',$slug)->firstOrFail();
        $projects = $category->projects()->publish()->paginate(8);


        $setting = Setting::first();
        $title = 'Kategori Project ' . $category->name . ' | ' . $this->setting->site_name;
        $meta_description = 'Kategori Project ' . $category->name . ' - Jelajahi portofolio pribadi saya, yang mencakup karya-karya terbaik dibidang pengembangan web. Dari konsep hingga implementasi, temukan keterampilan dan bakat saya dalam setiap karya yang saya hasilkan.';
        // seo meta
        SEOMeta::setTitle($title)
            ->setDescription($meta_description)
            ->setCanonical(route('projects.category',$category->slug))
            ->addMeta('author', $setting->author)
            ->setKeywords($setting->meta_keyword)
            ->addMeta('robots','index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1');

        // seo og
        OpenGraph::setTitle($title)
            ->setDescription($meta_description)
            ->setUrl(route('projects.category',$category->slug))
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
            ->setUrl(route('projects.category',$category->slug))
            ->setSite($setting->site_name)
            ->addValue('card', 'summary_large_image');

        // seo jsonld
        JsonLd::setType('website')
            ->setTitle($title)
            ->setImage($setting->image())
            ->setDescription($meta_description)
            ->setUrl(route('projects.category',$category->slug))
            ->setSite($setting->site_name);

        return view('frontend.pages.project.index',[
            'title' => $category->name . ' | Category Project',
            'projects' => $projects,
            'category' => $category,
            'setting' => $this->setting
        ]);
    }

    public function tag($slug)
    {
        $tag = ProjectTag::where('slug',$slug)->firstOrFail();
        $projects = $tag->projects()->publish()->paginate(8);

        $setting = Setting::first();
        $title = 'Tag Project ' . $tag->name . ' | ' . $this->setting->site_name;
        $meta_description = 'Tag Project ' . $tag->name . ' - Jelajahi portofolio pribadi saya, yang mencakup karya-karya terbaik dibidang pengembangan web. Dari konsep hingga implementasi, temukan keterampilan dan bakat saya';
        // seo meta
        SEOMeta::setTitle($title)
            ->setDescription($meta_description)
            ->setCanonical(route('projects.category',$tag->slug))
            ->addMeta('author', $setting->author)
            ->setKeywords($setting->meta_keyword)
            ->addMeta('robots','index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1');

        // seo og
        OpenGraph::setTitle($title)
            ->setDescription($meta_description)
            ->setUrl(route('projects.category',$tag->slug))
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
            ->setUrl(route('projects.category',$tag->slug))
            ->setSite($setting->site_name)
            ->addValue('card', 'summary_large_image');

        // seo jsonld
        JsonLd::setType('website')
            ->setTitle($title)
            ->setImage($setting->image())
            ->setDescription($meta_description)
            ->setUrl(route('projects.category',$tag->slug))
            ->setSite($setting->site_name);

        return view('frontend.pages.project.index',[
            'title' => $tag->name . ' | Tag Project',
            'projects' => $projects,
            'tag' => $tag,
            'setting' => $this->setting
        ]);
    }
}
