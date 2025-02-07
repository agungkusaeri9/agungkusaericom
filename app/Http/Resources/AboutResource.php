<?php

namespace App\Http\Resources;

use App\Models\Skill;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $skills = Skill::all();
        return [
            'site_name' => $this->site_name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'description' => $this->description,
            'author' => [
                'name' => $this->author,
                'image' => $this->image(),
                'role' => $this->author_role
            ],
            'cv' => $this->cv,
            'skills' => SkillResource::collection($skills),
        ];
    }
}
