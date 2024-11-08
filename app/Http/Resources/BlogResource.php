<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'category_name' => $this->category->name,
            'category_slug' => $this->category->slug,
            'visitor' => $this->visitor,
            'meta_description' => $this->meta_description,
            'image' => $this->image,
            'author' => $this->user->name,
            'tags' => $this->tags
        ];
    }
}
