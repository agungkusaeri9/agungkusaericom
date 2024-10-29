<?php

namespace App\Http\Controllers;

use App\Models\PengaturanSeo;
use App\Models\Post;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Setting;
use App\Models\Skill;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class HomeController extends Controller
{
    public function __construct()
    {
        visitor()->visit();
    }

    public function __invoke()
    {
        $setting = Setting::first();
        $skills = Skill::orderBy('name', 'ASC')->get();
        $project_categories = ProjectCategory::orderBy('name', 'ASC')->get();
        $seo = PengaturanSeo::where('halaman', 'home')->first();
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
        $latest_posts = Post::publish()->latest()->limit(4)->get();
        return view('frontend.pages.home', [
            'setting' => $setting,
            'skills' => $skills,
            'project_categories' => $project_categories,
            'SEOData' => $seoData,
            'latest_posts' => $latest_posts
        ]);
    }
}
