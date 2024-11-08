<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function image()
    {
        return asset('storage/' . $this->image);
    }
    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
