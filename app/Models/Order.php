<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

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
        'consumer_condition',
        'admin_approvement',
        'arrived',
    ];

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function transition()
    {
        return $this->hasOne(Transition::class);
    }

    public function getQtyAttribute()
    {
        return $this->numberTranslate($this->quantity);
    }

    public function getPaymentStatusAttribute()
    {
        $locale = session('locale');

        if ($this->transition) {
            if ($this->transition->payment_id > 1) {
                echo '
                    <i class="fas fa-circle text-success align-middle text-sm mr-2"></i>
                    <span>' . trans("paid", [], $locale) . '</span>
                ';
            } else {
                echo '
                        <i class="fas fa-circle text-success align-middle text-sm mr-2"></i>
                        <span>' . trans("post_paid", [], $locale) . '</span>
                ';
            }
        } else {
            echo '
                    <i class="fas fa-circle text-success align-middle text-sm mr-2"></i>
                    <span>' . trans("unpaid", [], $locale) . '</span>
                ';
        }
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

    public function scopeUnit($query)
    {
        dd("here");
        return $this->numberTranslate($query->count());
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
