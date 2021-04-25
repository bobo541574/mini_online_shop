<?php

namespace App\Http\Repositories\Front;

use App\Models\Transition;

class TransitionRepository
{
    public function model()
    {
        return (new Transition());
    }

    public function store($order, $request)
    {
        return $this->model()->create([
            'order_id' => $order->id,
            'payment_id' => $request->payment,
            'name' => $request->name,
            'phone' => $request->phone,
            'code' => $request->code ?? null,
            'name' => $request->name ?? null,
        ]);
    }
}
