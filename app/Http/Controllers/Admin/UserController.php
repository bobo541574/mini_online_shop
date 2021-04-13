<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAll();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $this->userRepository->store($request);

        return redirect()->route('users.index')->with('status', 'user_created');
    }

    public function edit(User $user)
    {
        $roles = Role::get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->userRepository->update($request, $user);

        return redirect()->route('users.index')->with('status', 'user_updated');
    }

    public function destroy(User $user)
    {
        $this->userRepository->destroy($user);

        return redirect()->route('users.index')->with('status', 'user_deleted');
    }
}
