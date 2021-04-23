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
        'parent_id', 'name_en', 'name_mm', 'slug', 'active', 'description_en', 'description_mm'
    ];

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function attributes()
    {
        return $this->hasManyThrough(ProductAttribute::class, Product::class);
    }

    public function getNameAttribute()
    {
        return $this->{'name_' . session('locale')};
    }

    public function getCategoryNameAttribute()
    {
        $category = $this->find($this->parent_id);

        return $category->{'name_' . session('locale')};
    }

    public function getDescriptionAttribute()
    {
        return $this->{'description_' . session('locale')};
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brand_categories');
    }
}
