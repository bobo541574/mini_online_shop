<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use App\Models\Payment;
use App\services\Address;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Front\OrderRepository;
use App\Http\Requests\Front\Order\CreateRequest;

class OrderController extends Controller
{
    protected $repo;

    public function __construct(OrderRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $orders = $this->repo->getAllOrders();

        return view('front.orders.index', compact('orders'));
    }

    public function finish()
    {
        return view('front.orders.finish');
    }

    public function store(CreateRequest $request)
    {
        $attribute = ProductAttribute::find($request->attribute_id);

        $order = $this->repo->store($attribute, $request);

        if ($order) {
            return redirect()->route('front.orders.show', $order)->with('success', 'order_created');
        } else {
            return redirect()->back()->with('warning', 'order_fail');
        }
    }

    public function show(Order $order)
    {
        $address = new Address(config('address'));
        $states = $address->stateList();
        $payments = Payment::get();

        return view('front.orders.show', compact('order', 'states', 'payments'));
    }

    public function update(Order $order, Request $request)
    {
        $this->repo->update($order, $request);

        return redirect()->route('front.orders.show', $order);
    }

    public function destroy($slug)
    {
        dd("Destroy");
        $this->repo->destroy($slug);

        return redirect()->back()->with('warning', 'order_remove');
    }

    public function toTrash(Order $order)
    {
        $this->repo->toTrash($order);

        return redirect()->back()->with('warning', 'order_remove');
    }
}
