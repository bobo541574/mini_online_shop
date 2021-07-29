<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Front\TransitionRepository;

class TransitionController extends Controller
{
    protected $repo;

    public function __construct(TransitionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function store(Order $order, Request $request)
    {
        $this->repo->store($order, $request);

        return redirect()->route('front.orders.finish')->with('success', 'transition_created');
    }

    public function finish()
    {
        return "Successfully Order!";
    }
}
