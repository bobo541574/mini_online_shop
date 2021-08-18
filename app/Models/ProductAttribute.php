<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ProductAttribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->orderBy('created_at');
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function getPhotosAttribute()
    {
        $photos = json_decode($this->photo);

        return $photos;
    }

    public function getImageAttribute()
    {
        return $this->image()->exists() ? image_url($this->image()->first()->name) : $this->getPhotosAttribute()[0];
    }

    public function getSaleAttribute()
    {
        return $this->numberTranslate($this->sale_price) . ' ' . trans('kyat', [], session('locale'));
    }

    public function getDeliveryAttribute()
    {
        $locale = session('locale');

        return ($this->delivery_cost == 0) ? trans('delivery_free', [], $locale) : $this->numberTranslate($this->delivery_cost) . ' ' . trans('kyat', [], $locale);
    }

    protected function numberTranslate($data)
    {
        $array = [];
        $temp = str_split($data, 1);
        foreach ($temp as $value) {
            $array[] = trans($value, [], session('locale'));
        }
        return implode("", $array);
    }
}
