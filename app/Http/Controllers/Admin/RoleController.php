<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Role\CreateRequest;
use App\Http\Repositories\Back\RoleRepository;

class RoleController extends Controller
{
    protected $repo;

    public function __construct(RoleRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $roles = $this->repo->getAll();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(CreateRequest $request)
    {
        $this->repo->store($request);

        return redirect()->route('roles.index')->with('status', 'role_created');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(CreateRequest $request, Role $role)
    {
        $this->repo->update($request, $role);

        return redirect()->route('roles.index')->with('status', 'role_updated');
    }

    public function destroy(Role $role)
    {
        $this->repo->destroy($role);

        return redirect()->route('roles.index')->with('status', 'role_deleted');
    }
}
