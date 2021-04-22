<?php

namespace App\Http\Repositories;

use App\Models\Contact;
use App\services\Address;

class ContactRepository
{
    public function model()
    {
        return (new Contact());
    }

    public function address()
    {
        return (new Address(config('address')));
    }

    public function getCityListByState($state)
    {
        return $this->address()->cityListByState($state);
    }

    public function getTownshipListByCity($vity)
    {
        return $this->address()->townshipListByCity($vity);
    }

    public function storeForUser($request)
    {
        auth()->user()->contacts()->create([
            'phone' => $request->phone,
            'home_street' => $request->home_street,
            'township' => $request->township,
            'city' => $request->city,
            'state' => $request->state
        ]);
    }
}
