<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class,'project_category_id','id');
    }

    public function tags()
    {
        return $this->belongsToMany(ProjectTag::class,'project_tag','project_id','tag_id');
    }
    public function image()
    {
        return asset('storage/' . $this->image);
    }

    public function galleries()
    {
        return $this->hasMany(ProjectGallery::class);
    }
}
