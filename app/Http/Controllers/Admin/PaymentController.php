<?php

namespace App\Http\Controllers\Admin;

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
        return $request->all();
    }
}
