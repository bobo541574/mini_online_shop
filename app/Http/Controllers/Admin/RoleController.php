<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleRequest;
use App\Http\Repositories\RoleRepository;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $roles = $this->roleRepository->getAll();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(RoleRequest $request)
    {
        $this->roleRepository->store($request);

        return redirect()->route('roles.index')->with('status', 'role_created');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $this->roleRepository->update($request, $role);

        return redirect()->route('roles.index')->with('status', 'role_updated');
    }

    public function destroy(Role $role)
    {
        $this->roleRepository->destroy($role);

        return redirect()->route('roles.index')->with('status', 'role_deleted');
    }
}
