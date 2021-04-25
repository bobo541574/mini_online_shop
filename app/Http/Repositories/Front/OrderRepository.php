<?php

namespace App\Http\Repositories\Front;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Mockery\Expectation;

class OrderRepository
{
    public function model()
    {
        return (new Order());
    }

    public function getAllOrders()
    {
        return $this->model()->with('attribute', 'attribute.color', 'attribute.size')->get();

        // return  $orders->groupBy(function ($item) {
        //     return $item->payment_id != null;
        // });
        // return $this->model()->whereHas('payment', function (Builder $query) {
        //     $query->groupBy('payment_type_ne')->get();
        // });
    }

    public function store($attribute, $request)
    {
        DB::beginTransaction();

        try {

            $attribute->carts()->where('user_id', auth()->user()->id)->delete();

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

    public function update($order, $request)
    {
        return $order->update([
            'contact_id' => $request->address,
        ]);
    }

    public function toTrash($order)
    {
        return $order->delete();
    }

    public function destroy($slug)
    {
        $order = $this->model()->onlyTrashed()->where('slug', $slug)->first();

        return $order->forceDelete();
    }
}
