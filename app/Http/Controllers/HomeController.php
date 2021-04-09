<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Contact;
use App\services\Address;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $address = new Address(config('address'));

        $contacts = new Contact();

        return $address->findAddress($contacts->find(1));

        $states = State::all();

        foreach ($states as $state) {
            echo $state->name;
        }
    }
}
