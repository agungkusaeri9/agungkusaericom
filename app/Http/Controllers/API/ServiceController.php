<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {

        try {
            $services = ServiceType::all();
            return ResponseFormatter::success(ServiceResource::collection($services), "Services Found.");
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }
}
