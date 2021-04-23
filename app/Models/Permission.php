<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en', 'name_mm', 'slug', 'type'
    ];

    public function getNameAttribute()
    {
        return $this->{'name_' . session('locale')};
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
