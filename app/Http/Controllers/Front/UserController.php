<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Front\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function contact(Request $request)
    {
        $this->userRepository->contact($request);

        return redirect()->back()->with('success', 'contact_created');
    }
}
