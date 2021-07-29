<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\UserRepository;
use App\Http\Requests\Back\User\CreateRequest;
use App\Http\Requests\Back\User\UpdateRequest;

class UserController extends Controller
{
    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $users = $this->repo->getAll();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(CreateRequest $request)
    {
        $this->repo->store($request);

        return redirect()->route('users.index')->with('status', 'user_created');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $this->repo->update($request, $user);

        return redirect()->route('users.index')->with('status', 'user_updated');
    }

    public function destroy(User $user)
    {
        $this->repo->destroy($user);

        return redirect()->route('users.index')->with('status', 'user_deleted');
    }
}
