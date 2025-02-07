<?php

namespace App\Http\Resources;

use App\Models\Setting;
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
        $author = Setting::first();
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'category' => new BlogCategoryResource($this->category),
            'short_description' => $this->short_description,
            'description' => $this->description,
            'visitor' => $this->visitor,
            'meta_description' => $this->meta_description,
            'image' => $this->image(),
            'tags' => $this->tags,
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
