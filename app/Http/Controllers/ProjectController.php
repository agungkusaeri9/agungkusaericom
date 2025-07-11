<?php

namespace App\Http\Controllers;

use App\Models\PengaturanSeo;
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
use RalphJSmit\Laravel\SEO\Support\SEOData;

class ProjectController extends Controller
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
            $projects = Project::publish()->with(['category', 'tags'])->where('name', 'LIKE', '%' . $q . '%')->latest()->paginate(8);
        } else {

            $projects = Project::publish()->with(['category', 'tags'])->latest()->paginate(9);
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

        return view('frontend.pages.project.index', [
            'title' => 'Projects | ' . $this->setting->site_name,
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
        $project = Project::with(['tags', 'galleries'])->publish()->where('slug', $slug)->firstOrFail();

        $tags = [];
        if ($project->tags) {
            foreach ($project->tags as $tg) {
                array_push($tags, $tg->name);
            }
        }
        $this->setting->site_name;
        $seoData = new SEOData(
            title: $project->name ?? '',
            description: $project->meta_description ?? '',
            author: $this->setting->author ?? '',
            image: $project ? $project->image() : '',
            url: route('projects.show', $project->slug) ?? '',
            site_name: $this->setting->site_name ?? '',
            published_time: $project ? $project->created_at : null,
            modified_time: $project ? $project->updated_at : null,
            robots: 'index, follow'
        );
        $project_terkait = Project::whereNot('id', $project->id)->latest()->limit(3)->get();
        return view('frontend.pages.project.show', [
            'project' => $project,
            'setting' => $this->setting,
            'SEOData' => $seoData,
            'project_terkait' => $project_terkait
        ]);
    }

    public function category($slug)
    {
        $category = ProjectCategory::where('slug', $slug)->firstOrFail();
        $projects = $category->projects()->publish()->paginate(8);

        $seo = PengaturanSeo::where('halaman', 'project')->first();
        $seoData = new SEOData(
            title: "Category : " . $category->name ?? '',
            description: $seo->meta_description ?? '',
            author: $seo->author ?? '',
            image: $seo ? $seo->gambar() : '',
            url: $seo->url ?? '',
            site_name: $seo->site_name ?? '',
            published_time: $seo ? $seo->published_time : null,
            modified_time: $seo ? $seo->modified_time : null,
            robots: $seo ? $seo->robots : ''
        );

        return view('frontend.pages.project.index', [
            'projects' => $projects,
            'category' => $category,
            'setting' => $this->setting,
            'SEOData' => $seoData
        ]);
    }

    public function tag($slug)
    {
        $tag = ProjectTag::where('slug', $slug)->firstOrFail();
        $projects = $tag->projects()->publish()->paginate(8);
        $seo = PengaturanSeo::where('halaman', 'project')->first();
        $seoData = new SEOData(
            title: "Tag : " . $tag->name ?? '',
            description: $seo->meta_description ?? '',
            author: $seo->author ?? '',
            image: $seo ? $seo->gambar() : '',
            url: $seo->url ?? '',
            site_name: $seo->site_name ?? '',
            published_time: $seo ? $seo->published_time : null,
            modified_time: $seo ? $seo->modified_time : null,
            robots: $seo ? $seo->robots : ''
        );
        return view('frontend.pages.project.index', [
            'projects' => $projects,
            'tag' => $tag,
            'setting' => $this->setting,
            'SEOData' => $seoData
        ]);
    }
}
