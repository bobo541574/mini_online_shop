<?php

namespace App\Http\Repositories\Back;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function model()
    {
        return (new User());
    }

    public function getAll()
    {
        return $this->model()->with('role')->orderBy('first_name')->paginate(10);
    }

    public function store($request)
    {
        return $this->model()->create([
            'role_id' => $request->role_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
    }

    public function update($request, $user)
    {
        return $user->update([
            'role_id' => $request->role_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
    }

    public function destroy($user)
    {
        return $user->delete();
    }
}
