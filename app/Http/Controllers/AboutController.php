<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Skill;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $setting = Setting::first();
        $title = 'About Me | ' . $setting->site_name . ' | ' . $setting->author_role;


        // seo meta
        SEOMeta::setTitle($title)
            ->setDescription($setting->meta_description)
            ->setCanonical(route('about'))
            ->addMeta('author', $setting->author)
            ->setKeywords($setting->meta_keyword)
            ->addMeta('robots','index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1');

        // seo og
        OpenGraph::setTitle($title)
            ->setDescription($setting->meta_description)
            ->setUrl(route('about'))
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
            ->setUrl(route('about'))
            ->setSite($setting->site_name)
            ->addValue('card', 'summary_large_image');

        // seo jsonld
        JsonLd::setType('website')
            ->setTitle($title)
            ->setImage($setting->image())
            ->setDescription($setting->meta_description)
            ->setUrl(route('about'))
            ->setSite($setting->site_name);

        return view('frontend.pages.about',[
            'setting' => $setting,
            'skills' => Skill::orderBy('name','ASC')->get()
        ]);
    }
}
