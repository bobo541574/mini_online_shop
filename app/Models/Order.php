<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_attribute_id',
        'user_id',
        'contact_id',
        'order_code',
        'slug',
        'quantity',
        'delivery_cost',
        'promotion',
        'sale_price',
        'status',
        'arrived',
    ];

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
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

    public function getTotalCostAttribute()
    {
        return $this->numberTranslate(($this->sale_price * $this->quantity) + $this->delivery_cost) . ' ' . trans('kyat', [], session('locale'));
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
