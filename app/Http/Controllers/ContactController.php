<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('frontend.pages.contact',[
            'title' => 'Contact Me | ' . $setting->site_name,
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
    }
}
