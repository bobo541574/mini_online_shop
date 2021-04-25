<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getNameAttribute()
    {
        return $this->{'name_' . session('locale')};
    }

    public function getPaymentTypeAttribute()
    {
        return $this->{'payment_type_' . session('locale')};
    }
}
