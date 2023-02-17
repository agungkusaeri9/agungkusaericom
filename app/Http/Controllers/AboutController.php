<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Skill;
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
        return view('frontend.pages.about',[
            'title' => 'About Me - ' . $setting->site_name,
            'setting' => $setting,
            'skills' => Skill::orderBy('name','ASC')->get()
        ]);
    }
}
