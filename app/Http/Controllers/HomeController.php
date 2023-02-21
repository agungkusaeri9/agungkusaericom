<?php

namespace App\Http\Controllers;

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

class HomeController extends Controller
{
    public function __invoke()
    {
        $setting = Setting::first();
        $skills = Skill::orderBy('name', 'ASC')->get();
        $project_categories = ProjectCategory::orderBy('name', 'ASC')->get();
        $projects = Project::with('category')->latest()->limit(6)->get();
        $title = $setting->site_name . ' | ' . $setting->author_role;

        // seo meta
        SEOMeta::setTitle($title)
            ->setDescription($setting->meta_description)
            ->setCanonical(route('home'))
            ->addMeta('author', $setting->author)
            ->setKeywords($setting->meta_keyword);

        // seo og
        OpenGraph::setTitle($title)
            ->setDescription($setting->meta_description)
            ->setUrl(route('home'))
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
            ->setDescription($setting->meta_description)
            ->setUrl(route('home'))
            ->setSite($setting->site_name)
            ->addValue('card', 'summary_large_image');

        // seo jsonld
        JsonLd::setType('website')
            ->setTitle($title)
            ->setImage($setting->image())
            ->setDescription($setting->meta_description)
            ->setUrl(route('home'))
            ->setSite($setting->site_name);


        return view('frontend.pages.home', [
            'setting' => $setting,
            'skills' => $skills,
            'project_categories' => $project_categories,
            'projects' => $projects
        ]);
    }
}
