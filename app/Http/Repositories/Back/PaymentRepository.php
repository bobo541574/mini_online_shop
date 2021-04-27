<?php

namespace App\Http\Repositories\Back;

use App\Models\Payment;

class PaymentRepository
{
    public function model()
    {
        return (new Payment());
    }

    public function paginate($data)
    {
        return $this->model()->latest()->paginate(10);
    }

    public function store($request)
    {
        return $this->model()->create([
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'slug' => strtoslug($request->name_en),
            'payment_type' => $request->payment_type,
        ]);
    }

    public function update($request, $payment)
    {
        return $this->model()->update([
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'slug' => strtoslug($request->name_en),
            'payment_type' => $request->payment_type,
        ]);
    }

    public function destroy($payment)
    {
        return $payment->delete();
    }
}
