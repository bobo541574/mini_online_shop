<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'payment_id',
        'name',
        'phone',
        'code',
        'photo',
    ];

    public function getImageAttribute()
    {
        return json_decode($this->photo);
    }
}
