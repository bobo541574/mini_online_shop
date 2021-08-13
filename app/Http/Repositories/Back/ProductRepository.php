<?php

namespace App\Http\Repositories\Back;

use App\Http\Requests\Back\Product\CreateRequest;
use App\Models\Product;
use Illuminate\Pagination\Paginator;

class ProductRepository
{
    public function model(): Product
    {
        return (new Product());
    }

    public function paginate($data):Paginator
    {
        $products = $this->model()->with(['category', 'subcategory', 'brand', 'productAttributes'])->orderBy('created_at', 'DESC');

        if (request()->query) {
            $products->filter(request()->all());
        }
        return $products->paginate($data)->appends(request()->all());
    }

    public function getAllAttributes($product)
    {
        return $product->productAttributes()->with(['color', 'size'])->orderBy('arrived', 'desc')->paginate(10);

        // $product->setRelation('attributes', $product->productAttributes()->paginate(2));
    }

    public function store(CreateRequest $request)
    {
        return $this->model()->get();
    }
}
