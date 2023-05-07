<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $dates = ['paid_time'];

    public function status()
    {
        if($this->status == 1)
        {
            return '<span class="badge badge-success">Paid</span>';
        }else
        {
            return '<span class="badge badge-danger">Unpaid</span>';
        }
    }

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
