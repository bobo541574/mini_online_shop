<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_en', 'name_mm', 'slug', 'active', 'description_en', 'description_mm'
    ];

    public function getNameAttribute()
    {
        return $this->{'name_' . session('locale')};
    }

    public function getDescriptionAttribute()
    {
        return $this->{'description_' . session('locale')};
    }
}
