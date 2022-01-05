<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        $this->redirectSolver();

        return view('auth.login');
    }

    protected function redirectSolver()
    {
        // session မှ မ save ချင်တဲ့ route တွေကို အောက်က list မှထည့်မယ်။
        $except = [
            'register',
            'login',
        ];

        $status = collect($except)->contains(function ($value, $key) {
            return route($value) == url()->previous();
        });

        if (!$status) {

            if (session('redirectUrl') == null)
                session()->put('redirectUrl', url('/'));
            else
                session()->put('redirectUrl', url()->previous());
        }

        return;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }

        return redirect(session('redirectUrl'));
    }
}
