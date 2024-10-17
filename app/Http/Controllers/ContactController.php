<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use App\Models\PengaturanSeo;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class ContactController extends Controller
{
    public function __construct()
    {
        visitor()->visit();
    }

    public function index()
    {
        $setting = Setting::first();
        $seo = PengaturanSeo::where('halaman', 'contact')->first();
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
        return view('frontend.pages.contact', [
            'setting' => $setting,
            'SEOData' => $seoData
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required', 'max:20'],
            'email' => ['required', 'email', 'max:30'],
            'subject' => ['required', 'max:255'],
            'text' => ['required']
        ]);

        try {
            // batasin perhari maksimal 20 pesan
            $hari_ini = Carbon::now()->translatedFormat('Y-m-d');
            $cekPerhari = Inbox::whereDate('created_at', $hari_ini)->count();
            if ($cekPerhari > 2) {
                return redirect()->back()->with('error', 'Sorry, you cannot provide feedback and suggestions at the moment due to a daily limit. Please visit me another time or you can contact me through WhatsApp or email. Thank you.');
            }

            $data = request()->only(['name', 'email', 'subject', 'text']);
            Inbox::create($data);
            return redirect()->back()->with('success', 'Thank you for your feedback and suggestions.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'System Error.');
        }
    }
}
