<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getNameAttribute()
    {
        return $this->{'name_' . session('locale')};
    }

    public function attribute()
    {
        return $this->hasOne(ProductAttribute::class);
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function scopeFilter($query, array $filter)
    {
        return $query->where('name_' . session('locale'), 'like', "%" . $filter['product'] . "%")
            ->whereHas('category', function ($query) use ($filter) {
                return $query->where('name_' . session('locale'), 'like', "%" . $filter['category'] . "%");
            })
            ->whereHas('subcategory', function ($query) use ($filter) {
                return $query->where('name_' . session('locale'), 'like', "%" . $filter['subcategory'] . "%");
            })
            ->whereHas('brand', function ($query) use ($filter) {
                return $query->where('name_' . session('locale'), 'like', "%" . $filter['brand'] . "%");
            });
    }
}
