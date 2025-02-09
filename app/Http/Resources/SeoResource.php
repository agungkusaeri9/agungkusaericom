<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeoResource extends JsonResource
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
            'page' => $this->halaman,
            'title' => $this->judul,
            'meta_keyword' => $this->meta_keyword,
            'meta_description' => $this->meta_description,
            'image' => $this->gambar(),
            'url' => $this->url,
            'site_name' => $this->site_name,
            'published_time' => $this->published_time,
            'modified_time' => $this->modified_time,
            'robots' => $this->robots,
            'author' => $this->author
        ];
    }
}
