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
        return $request->all();
    }
}
