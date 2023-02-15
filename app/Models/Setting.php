<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $guarded = ['id'];

    public function favicon()
    {
        if($this->favicon)
        {
            return asset('storage/' . $this->favicon);
        }else{
            return asset('assets/img/stisla.svg');
        }
    }

    public function image()
    {
        if($this->image)
        {
            return asset('storage/' . $this->image);
        }else{
            return asset('assets/img/stisla.svg');
        }
    }

    public function author_image()
    {
        if($this->author_image)
        {
            return asset('storage/' . $this->author_image);
        }else{
            return asset('assets/img/stisla.svg');
        }
    }
    public function getAuthorImageAttribute($val)
    {
        return asset('storage/') . '/' . $val;
    }
}
