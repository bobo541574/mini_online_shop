<?php

namespace App\Models;

use App\services\Address;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'home_street',
        'township',
        'city',
        'state'
    ];

    public function contactable()
    {
        return $this->morphTo();
    }

    public function getAddressAttribute()
    {
        if (session('locale') == "mm") {
            return $this->home_street . '၊ ' . (new Address(config('address')))->findAddress($this);
        } elseif (session('locale') == "en") {
            return $this->home_street . ', ' . (new Address(config('address')))->findAddress($this);
        }
    }
}
