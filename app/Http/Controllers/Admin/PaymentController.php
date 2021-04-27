<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\PaymentRepository;
use App\Http\Requests\Back\Payment\CreateRequest;

class PaymentController extends Controller
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function index()
    {
        $payments = $this->paymentRepository->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $payment_types = [
            'post_paid',
            'pre_paid'
        ];

        return view('admin.payments.create', compact('payment_types'));
    }

    public function store(CreateRequest $request)
    {
        $this->paymentRepository->store($request);

        return redirect()->route('payments.index')->with('status', 'payment_created');
    }

    public function edit(Payment $payment)
    {
        $payment_types = [
            'post_paid',
            'pre_paid'
        ];

        return view('admin.payments.edit', compact('payment', 'payment_types'));
    }

    public function update(CreateRequest $request, Payment $payment)
    {
        $this->paymentRepository->update($request, $payment);

        return redirect()->route('payments.index')->with('status', 'payment_updated');
    }

    public function destroy(Payment $payment)
    {
        $this->paymentRepository->destroy($payment);

        return redirect()->route('payments.index')->with('status', 'payment_deleted');
    }
}
