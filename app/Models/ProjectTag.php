<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTag extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function projects()
    {
        return $this->belongsToMany(Project::class,'project_tag','tag_id');
    }
}
