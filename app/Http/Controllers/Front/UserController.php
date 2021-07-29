<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Front\UserRepository;

class UserController extends Controller
{
    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function contact(Request $request)
    {
        $this->repo->contact($request);

        return redirect()->back()->with('success', 'contact_created');
    }
}
