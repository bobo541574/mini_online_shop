<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Front\CartRepository;
use App\Http\Requests\Front\Cart\CreateRequest;
use App\services\Address;

class CartController extends Controller
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function index()
    {
        $carts = $this->cartRepository->getAllCarts();

        return view('front.carts.index', compact('carts'));
    }

    public function store(CreateRequest $request)
    {
        $cart = $this->cartRepository->store($request);

        return redirect()->route('front.carts.show', $cart)->with("success", "cart_created");
    }

    public function show(Cart $cart)
    {
        $address = new Address(config('address'));
        $states = $address->stateList();

        return view('front.carts.show', compact('cart', 'states'));
    }

    public function destroy(Cart $cart)
    {
        $this->cartRepository->destroy($cart);

        return redirect()->back()->with("success", "cart_deleted");
    }
}
