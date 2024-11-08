<?php

namespace App\Http\Resources;

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
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'meta_description' => $this->meta_description,
            'category_name' => $this->category->name,
            'category_slug' => $this->category->slug,
            'description' => $this->description,
            'link' => $this->link,
            'image' => $this->image,
            'galleries' => $this->galleries,
            'tags' => $this->tags,
            'created' => $this->created_at
        ];
    }
}
