<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Front\TransitionRepository;

class TransitionController extends Controller
{
    protected $transitionRepository;

    public function __construct(TransitionRepository $transitionRepository)
    {
        $this->transitionRepository = $transitionRepository;
    }

    public function store(Order $order, Request $request)
    {
        $this->transitionRepository->store($order, $request);

        return redirect()->route('front.orders.finish')->with('success', 'transition_created');
    }

    public function finish()
    {
        return "Successfully Order!";
    }
}
