<?php

namespace App\Http\Resources;

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
        return [
            'site_name' => $this->site_name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'description' => $this->description,
            'author' => $this->author,
            'author_image' => $this->author_image,
            'author_role' => $this->author_role,
            'author_description' => $this->author_description,
            'cv' => $this->cv
        ];
    }
}
