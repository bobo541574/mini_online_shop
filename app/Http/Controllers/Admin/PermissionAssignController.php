<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\PermissionAssignRepository;

class PermissionAssignController extends Controller
{
    protected $repo;

    public function __construct(PermissionAssignRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $assigns = $this->repo->getAll();

        return view('admin.permissions.assigns.index', compact('assigns'));
    }

    public function create()
    {
        $permissions = $this->repo->getAllPermissions();
        $roles = $this->repo->getAllRoles();

        return view('admin.permissions.assigns.create', compact('permissions', 'roles'));
    }

    public function store(Request $request)
    {
        $this->repo->store($request);

        return redirect()->route('assigns.permissions-index')->with('status', 'assign_created');
    }

    public function edit(Role $role)
    {
        $permissions = $this->repo->getAllPermissions();
        $roles = $this->repo->getAllRoles();

        return view('admin.permissions.assigns.edit', compact('permissions', 'roles', 'role'));
    }

    public function update(Request $request, Role $role)
    {
        $this->repo->update($request, $role);

        return redirect()->route('assigns.permissions-index')->with('status', 'assign_created');
    }
}
