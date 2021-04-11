<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\State;
use App\Models\Contact;
use App\services\Address;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $routes = new RouteCollection();
        dd($routes);

        $user = new User();
        $user->giveAllPermissionsTo('create-category');
        dd(Auth::hasRole());
    }
}
