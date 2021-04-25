<?php

namespace App\Http\Repositories\Front;

use App\Models\User;

class UserRepository
{
    public function model()
    {
        return (new User());
    }

    public function contact($request)
    {
        return $request->user()->contacts()->create([
            'phone' => $request->phone,
            'home_street' => $request->home_street,
            'township' => $request->township,
            'city' => $request->city,
            'state' => $request->state
        ]);
    }
}
