<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getNameAttribute()
    {
        return $this->{'name_' . session('locale')};
    }

    public function attribute():HasOne
    {
        return $this->hasOne(ProductAttribute::class);
    }

    public function productAttributes():HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory():BelongsTo
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }

    public function brand():BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function scopeFilter($query, array $filter)
    {
        return $query->where('name_' . session('locale'), 'like', "%" . ($filter['product'] ?? false) . "%")
            ->whereHas('category', function ($query) use ($filter) {
                return $query->where('name_' . session('locale'), 'like', "%" . ($filter['category'] ?? false) . "%");
            })
            ->whereHas('subcategory', function ($query) use ($filter) {
                return $query->where('name_' . session('locale'), 'like', "%" . ($filter['subcategory'] ?? false) . "%");
            })
            ->whereHas('brand', function ($query) use ($filter) {
                return $query->where('name_' . session('locale'), 'like', "%" . ($filter['brand'] ?? false) . "%");
            });
    }
}
