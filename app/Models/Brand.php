<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_en', 'name_mm', 'photo', 'slug', 'description_en', 'description_mm'
    ];

    public function getNameAttribute()
    {
        return $this->{'name_' . session('locale')};
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'brand_categories')->withTimestamps();
    }

    public function getCategoriesIdAttribute()
    {
        return $this->categories->pluck('id')->toArray();
    }
}
