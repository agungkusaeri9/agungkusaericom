<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeoResource;
use App\Models\PengaturanSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SeoController extends Controller
{
    public function get()
    {
        $validator = Validator::make(request()->all(), [
            'page' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseFormatter::validationError($validator->errors());
        }
        try {
            $page = request('page');
            $item = PengaturanSeo::where('halaman', $page)->first();
            if ($page) {
                $seo  = new SeoResource($item);
                return ResponseFormatter::success($seo, "Page Found", 200);
            } else {
                return ResponseFormatter::error(null, 'Page not found', 404);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error($th->getMessage());
        }
    }
}
