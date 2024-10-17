<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanSeo extends Model
{
    use HasFactory;
    protected $table = 'pengaturan_seo';
    protected $guarded = ['id'];

    public $casts = [
        'published_time' => 'datetime',
        'modified_time' => 'datetime',
    ];

    public function gambar()
    {
        return asset('storage/' . $this->gambar);
    }

    public function published()
    {
        if ($this->published_time) {
            return $this->published_time->translatedFormat('d F Y');
        } else {
            return '';
        }
    }
    public function modified()
    {
        if ($this->modified_time) {
            return $this->modified_time->translatedFormat('d F Y');
        } else {
            return '';
        }
    }
}
