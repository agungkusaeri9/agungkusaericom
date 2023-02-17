<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DownloadController extends Controller
{
    public function cv()
    {
        try {
            $setting = Setting::first();
            if (!$setting->cv) {
                return redirect()->back()->with('error', 'CV is not available!');
            }
            $mimes = Str::after($setting->cv, '.');
            $filePath = public_path('storage/') . $setting->cv;
            $headers = ['Content-Type:' . $mimes];
            $fileName = 'CV Agung Kusaeri' . '.' . $mimes;
            return response()->download($filePath, $fileName, $headers);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','System Error!');
        }
    }
}
