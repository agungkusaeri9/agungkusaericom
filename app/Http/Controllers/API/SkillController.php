<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $limit = request('limit') ?? 10;
        try {
            $items = Skill::whereNotNull('id');
            $skill = $items->paginate($limit);
            // Menyusun pagination data
            $pagination = [
                'current_page' => $skill->currentPage(),
                'last_page' => $skill->lastPage(),
                'per_page' => $skill->perPage(),
                'total' => $skill->total(),
            ];
            return ResponseFormatter::success(SkillResource::collection($skill), "Skill Found.", 200, $pagination);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error(null, $th->getMessage());
        }
    }
}
