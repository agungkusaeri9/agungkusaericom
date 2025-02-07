<?php

namespace App\Http\Resources;

use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $author = Setting::first();
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'meta_description' => $this->meta_description,
            'short_description' => $this->short_description,
            'meta_keyword' => $this->meta_keyword,
            'category' => new ProjectCategoryResource($this->category),
            'description' => $this->description,
            'link' => $this->link,
            'image' => $this->image(),
            'galleries' => GalleryResource::collection($this->galleries),
            'tags' => TagResource::collection($this->tags),
            'author' => [
                'name' => $author->author,
                'image' => $author->image(),
                'role' => $author->author_role
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at

        ];
    }
}
