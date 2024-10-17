<?php

namespace App\Http\Controllers;

use App\Models\PengaturanSeo;
use App\Models\Setting;
use App\Models\Skill;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

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
        $seo = PengaturanSeo::where('halaman', 'about')->first();
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
        return view('frontend.pages.about', [
            'setting' => $setting,
            'skills' => Skill::orderBy('name', 'ASC')->get(),
            'SEOData' => $seoData
        ]);
    }
}
