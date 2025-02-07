<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SocialMediaResource;
use App\Models\Socmed;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index()
    {
        $limit = request('limit') ?? 10;
        try {
            $items = Socmed::whereNotNull('id');
            $socmeds = $items->paginate($limit);
            // Menyusun pagination data
            $pagination = [
                'current_page' => $socmeds->currentPage(),
                'last_page' => $socmeds->lastPage(),
                'per_page' => $socmeds->perPage(),
                'total' => $socmeds->total(),
            ];
            return ResponseFormatter::success(SocialMediaResource::collection($socmeds), "Social Medias Found.", 200, $pagination);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }
}
