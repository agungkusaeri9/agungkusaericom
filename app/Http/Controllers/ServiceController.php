<?php

namespace App\Http\Controllers;

use App\Models\PengaturanSeo;
use App\Models\ServiceType;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class ServiceController extends Controller
{
    private $setting;
    public function __construct()
    {
        $this->setting = Setting::first();
    }
    public function index($name)
    {
        $service_name = str_replace('-', ' ', $name);
        if (!$name) {
            return redirect()->back();
        }

        $service = ServiceType::where('name', $service_name)->first();
        if (!$service) {
            return redirect()->back();
        }

        $seo = PengaturanSeo::where('halaman', 'service')->first();
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

        return view('frontend.pages.service.show', [
            'title' => 'Service | ' . $service->name,
            'setting' => $this->setting,
            'item' => $service,
            'SEOData' => $seoData
        ]);
    }
}
