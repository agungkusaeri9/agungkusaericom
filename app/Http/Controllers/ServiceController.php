<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

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

        if ($service->name === 'Jasa Pembuatan Web') {
            $title = 'Jasa Pembuatan Web | ' . $this->setting->site_name;
            $meta_description = $this->setting->site_name . ' - Bisnis online Anda membutuhkan website yang efektif? Percayakan pembuatan website Anda kepada saya dan nikmati hasil yang memuaskan. Hubungi saya untuk mendapatkan penawaran terbaik.';

            // seo meta
            SEOMeta::setTitle($title)
                ->setDescription($meta_description)
                ->setCanonical(route('services.index',$service_name))
                ->addMeta('author', $this->setting->author)
                ->setKeywords($this->setting->meta_keyword);

            // seo og
            OpenGraph::setTitle($title)
                ->setDescription($meta_description)
                ->setUrl(route('services.index',$service_name))
                ->setSiteName($this->setting->site_name)
                ->addImage($this->setting->image())
                ->addProperty('image:type', 'image/jpeg/png')
                ->addProperty('image:width', 400)
                ->addProperty('image:height', 300)
                ->addProperty('locale', 'id_ID')
                ->addProperty('type', 'website');

            // seo twitter
            TwitterCard::setType('website')
                ->setImage($this->setting->image())
                ->setTitle($title)
                ->setDescription($meta_description)
                ->setUrl(route('services.index',$service_name))
                ->setSite($this->setting->site_name)
                ->addValue('card', 'summary_large_image');

            // seo jsonld
            JsonLd::setType('website')
                ->setTitle($title)
                ->setImage($this->setting->image())
                ->setDescription($meta_description)
                ->setUrl(route('services.index',$service_name))
                ->setSite($this->setting->site_name);


            return view('frontend.pages.service.jasa-pembuatan-web', [
                'title' => 'Jasa Pembuatan Web | ' . $this->setting->site_name,
                'setting' => $this->setting
            ]);
        }
    }
}
