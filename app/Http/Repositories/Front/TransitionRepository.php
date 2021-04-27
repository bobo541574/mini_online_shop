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
        $photo = $this->photoUpload($request->file('photo'));

        return $this->model()->create([
            'order_id' => $order->id,
            'payment_id' => $request->payment,
            'name' => $request->name,
            'phone' => $request->phone,
            'code' => $request->code ?? null,
            'photo' => $photo ?? null,
        ]);
    }

    protected function photoUpload($photo)
    {
        $path = public_path() . '/img/transitions/';
        $photo->move($path, $photo->getClientOriginalName());
        return json_encode('/img/transitions/' . $photo->getClientOriginalName());
    }
}
