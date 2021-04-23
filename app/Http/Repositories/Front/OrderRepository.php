<?php

namespace App\Http\Repositories\Front;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Mockery\Expectation;

class OrderRepository
{
    public function model()
    {
        return (new Order());
    }

    public function store($attribute, $request)
    {
        DB::beginTransaction();

        try {

            $order = $this->model()->create([
                'product_attribute_id' => $request->attribute_id,
                'user_id' => $request->user()->id,
                'contact_id' => $request->contact_id,
                'order_code' => strtoupper(strtoslug(['OD' . $request->user()->id . $request->contact_id, $attribute->product->id . $attribute->color->id . $attribute->size->id, rand(100, 999)], false)),
                'slug' => strtoupper(strtoslug(['OD' . $request->user()->id . $request->contact_id, $attribute->product->id . $attribute->color->id . $attribute->size->id])),
                'quantity' => $request->sku,
                'delivery_cost' => $attribute->delivery_cost,
                'promotion' => $attribute->promotion,
                'sale_price' => $attribute->sale_price,
            ]);

            $attribute->sku = $attribute->sku - $request->sku;
            $attribute->save();

            DB::commit();

            return $order;
        } catch (Expectation $e) {
            DB::rollBack();

            return $order;
        }
    }
}
