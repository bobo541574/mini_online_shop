<?php

namespace App\Http\Repositories\Front;

use App\Models\Cart;

class CartRepository
{
    public function model()
    {
        return (new Cart());
    }

    public function getAllCarts()
    {
        return $this->model()->with('attribute', 'attribute.color', 'attribute.size', 'attribute.product')->latest()->get();
    }

    public function store($request)
    {
        $cart = $this->model()->where(['product_attribute_id' => $request->attribute_id, 'user_id' => $request->user()->id]);

        if ($cart->exists()) {
            return $cart->first();
        } else {
            return $this->model()->updateOrCreate([
                'product_attribute_id' => $request->attribute_id,
                'user_id' => $request->user()->id,
                'slug' => strtoupper(strtoslug(['CT' . $request->user()->id . rand(11, 99), $request->attribute_id . rand(11, 99)])),
                'quantity' => $request->sku ?? 1,
            ]);
        }
    }

    public function destroy($cart)
    {
        return $cart->delete();
    }
}
