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
        if ($this->favicon) {
            return asset('storage/' . $this->favicon);
        } else {
            return asset('assets/img/stisla.svg');
        }
    }

    public function image()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        } else {
            return asset('assets/img/stisla.svg');
        }
    }



    public function author_image()
    {
        if ($this->author_image) {
            return asset('storage/' . $this->author_image);
        } else {
            return asset('assets/img/stisla.svg');
        }
    }
    // public function getAuthorImageAttribute($val)
    // {
    //     return asset('storage/') . '/' . $val;
    // }

    public static function getMonth()
    {
        $month = [
            [
                'no' => 1,
                'name' => 'Januari'
            ],
            [
                'no' => 2,
                'name' => 'Februari'
            ],
            [
                'no' => 3,
                'name' => 'Maret'
            ],
            [
                'no' => 4,
                'name' => 'April'
            ],
            [
                'no' => 5,
                'name' => 'Mei'
            ],
            [
                'no' => 6,
                'name' => 'Juni'
            ],
            [
                'no' => 7,
                'name' => 'Juli'
            ],
            [
                'no' => 8,
                'name' => 'Agustus'
            ],
            [
                'no' => 9,
                'name' => 'September'
            ],
            [
                'no' => 10,
                'name' => 'Oktober'
            ],
            [
                'no' => 11,
                'name' => 'November'
            ],
            [
                'no' => 12,
                'name' => 'Desember'
            ]
        ];

        return (object)$month;
    }

    public static function getYears()
    {
        $currentYear = 2023;
        $years = [];

        for ($i = 0; $i < 5; $i++) {
            $years[] = $currentYear + $i;
        }

        return $years;
    }

    public function getAuthorImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
