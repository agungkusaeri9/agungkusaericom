<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        try {
            $project = Setting::first();
            return ResponseFormatter::success(new AboutResource($project), message: "About Found.");
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }
}
