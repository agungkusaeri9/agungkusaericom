<?php

namespace App\Http\Controllers;

use App\Models\PengaturanSeo;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectTag;
use App\Models\Setting;
use App\Models\Socmed;
use Artesaos\SEOTools\Contracts\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd as FacadesJsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\JsonLd;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PortofolioController extends Controller
{
    private $setting;
    public function __construct()
    {
        $this->setting = Setting::first();
        visitor()->visit();
    }

    public function index()
    {
        $q = request('q');
        if ($q) {
            $projects = Project::where('is_portfolio', 1)->with(['category', 'tags'])->where('name', 'LIKE', '%' . $q . '%')->latest()->paginate(8);
        } else {

            $projects = Project::where('is_portfolio', 1)->with(['category', 'tags'])->latest()->paginate(8);
        }
        $project_categories = ProjectCategory::withCount('projects')->orderBy('name', 'ASC')->get();
        $project_tags = ProjectTag::orderBy('name', 'ASC')->get();
        $socmeds = Socmed::orderBy('name', 'ASC')->get();
        $seo = PengaturanSeo::where('halaman', 'project')->first();
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
        return view('frontend.pages.portofolio.index', [
            'title' => 'Portofolio | ' . $this->setting->site_name,
            'projects' => $projects,
            'project_categories' => $project_categories,
            'setting' => $this->setting,
            'socmeds' => $socmeds,
            'project_tags' => $project_tags,
            'SEOData' => $seoData
        ]);
    }

    public function show($slug)
    {
        $project = Project::where('is_portfolio', 1)->with(['tags', 'galleries'])->publish()->where('slug', $slug)->firstOrFail();

        $tags = [];
        if ($project->tags) {
            foreach ($project->tags as $tg) {
                array_push($tags, $tg->name);
            }
        }
        $seoData = new SEOData(
            title: $project->name ?? '',
            description: $project->meta_description ?? '',
            author: $this->setting->author ?? '',
            image: $project ? $project->gambar() : '',
            url: route('projects.show', $project->slug) ?? '',
            site_name: $this->setting->site_name ?? '',
            published_time: $project ? $project->created_at : null,
            modified_time: $project ? $project->updated_at : null,
            robots: 'index, follow'
        );

        return view('frontend.pages.portofolio.show', [
            'project' => $project,
            'setting' => $this->setting
        ]);
    }

    public function category($slug)
    {
        $category = ProjectCategory::where('slug', $slug)->firstOrFail();
        $projects = $category->projects()->where('is_portfolio', 1)->paginate(8);

        $setting = Setting::first();
        $title = 'Kategori Project ' . $category->name . ' | ' . $this->setting->site_name;
        $meta_description = 'Kategori Project ' . $category->name . ' - Jelajahi portofolio pribadi saya, yang mencakup karya-karya terbaik dibidang pengembangan web. Dari konsep hingga implementasi, temukan keterampilan dan bakat saya dalam setiap karya yang saya hasilkan.';
        // seo meta
        SEOMeta::setTitle($title)
            ->setDescription($meta_description)
            ->setCanonical(route('projects.category', $category->slug))
            ->addMeta('author', $setting->author)
            ->setKeywords($setting->meta_keyword)
            ->addMeta('robots', 'noindex, nofollow')
            ->addMeta('googlebot', 'noindex');


        return view('frontend.pages.portofolio.index', [
            'title' => $category->name . ' | Category Project',
            'projects' => $projects,
            'category' => $category,
            'setting' => $this->setting
        ]);
    }

    public function tag($slug)
    {
        $tag = ProjectTag::where('slug', $slug)->firstOrFail();
        $projects = $tag->projects()->where('is_portfolio', 1)->paginate(8);

        $setting = Setting::first();
        $title = 'Tag Project ' . $tag->name . ' | ' . $this->setting->site_name;
        $meta_description = 'Tag Project ' . $tag->name . ' - Jelajahi portofolio pribadi saya, yang mencakup karya-karya terbaik dibidang pengembangan web. Dari konsep hingga implementasi, temukan keterampilan dan bakat saya';
        // seo meta
        SEOMeta::setTitle($title)
            ->setDescription($meta_description)
            ->setCanonical(route('projects.category', $tag->slug))
            ->addMeta('author', $setting->author)
            ->setKeywords($setting->meta_keyword)
            ->addMeta('robots', 'noindex, nofollow')
            ->addMeta('googlebot', 'noindex');


        return view('frontend.pages.portofolio.index', [
            'title' => $tag->name . ' | Tag Project',
            'projects' => $projects,
            'tag' => $tag,
            'setting' => $this->setting
        ]);
    }
}
