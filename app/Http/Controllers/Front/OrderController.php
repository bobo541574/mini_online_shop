<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Front\OrderRepository;
use App\Http\Requests\Front\Order\CreateRequest;
use App\Models\Order;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function show(Order $order)
    {
        return view('front.orders.show', compact('order'));
    }

    public function store(CreateRequest $request)
    {
        $attribute = ProductAttribute::find($request->attribute_id);

        $order = $this->orderRepository->store($attribute, $request);

        if ($order) {
            return redirect()->route('front.orders.show', $order)->with('success', 'order_created');
        } else {
            return redirect()->back()->with('warning', 'order_fail');
        }
    }
}
