<?php

namespace App\Http\Repositories\Back;

use App\Models\Product;

class ProductRepository
{
    public function model()
    {
        return (new Product());
    }

    public function paginate($data)
    {
        return $this->model()->with(['category', 'subcategory', 'brand', 'productAttributes'])->orderBy('name_' . session('locale'))->paginate($data);
    }

    public function getAllAttributes($product)
    {
        return $attributes = $product->productAttributes()->with(['color', 'size'])->orderBy('arrived', 'desc')->paginate(10);

        // $product->setRelation('attributes', $product->productAttributes()->paginate(2));
    }
}
