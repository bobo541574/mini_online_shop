<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_attribute_id',
        'user_id',
        'slug',
        'quantity',
    ];

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }

    public function getQtyAttribute()
    {
        return $this->numberTranslate($this->quantity);
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
