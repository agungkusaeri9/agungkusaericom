<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use App\Models\Setting;
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
        $service_name = str_replace('-', ' ' , $name);
        if(!$name)
        {
            return redirect()->back();
        }

        $service = ServiceType::where('name',$service_name)->first();
        if(!$service)
        {
            return redirect()->back();
        }

        if($service->name === 'Jasa Pembuatan Web')
        {
            return view('frontend.pages.service.jasa-pembuatan-web',[
                'title' => 'Jasa Pembuatan Web | ' . $this->setting->site_name,
                'setting' => $this->setting
            ]);
        }
    }
}
