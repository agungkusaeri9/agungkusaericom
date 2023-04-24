<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $title = 'Contact Me | ' . $setting->site_name . ' | ' . $setting->author_role;
        // seo meta
        SEOMeta::setTitle($title)
            ->setDescription($setting->meta_description)
            ->setCanonical(route('contact.index'))
            ->addMeta('author', $setting->author)
            ->setKeywords($setting->meta_keyword)
            ->addMeta('robots','index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1');

        // seo og
        OpenGraph::setTitle($title)
            ->setDescription($setting->meta_description)
            ->setUrl(route('contact.index'))
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
            ->setUrl(route('contact.index'))
            ->setSite($setting->site_name)
            ->addValue('card', 'summary_large_image');

        // seo jsonld
        JsonLd::setType('website')
            ->setTitle($title)
            ->setImage($setting->image())
            ->setDescription($setting->meta_description)
            ->setUrl(route('contact.index'))
            ->setSite($setting->site_name);

        return view('frontend.pages.contact',[
            'setting' => $setting
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required','max:20'],
            'email' => ['required','email','max:30'],
            'subject' => ['required','max:255'],
            'text' => ['required']
        ]);

       try {
         // batasin perhari maksimal 20 pesan
         $hari_ini = Carbon::now()->translatedFormat('Y-m-d');
         $cekPerhari = Inbox::whereDate('created_at',$hari_ini)->count();
         if($cekPerhari > 2)
         {
             return redirect()->back()->with('error','Sorry, you cannot provide feedback and suggestions at the moment due to a daily limit. Please visit me another time or you can contact me through WhatsApp or email. Thank you.');
         }

         $data = request()->only(['name','email','subject','text']);
         Inbox::create($data);
         return redirect()->back()->with('success','Thank you for your feedback and suggestions.');
       } catch (\Throwable $th) {
        return redirect()->back()->with('error','System Error.');
       }
    }
}
