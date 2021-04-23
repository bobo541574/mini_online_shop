<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\PermissionAssignRepository;

class PermissionAssignController extends Controller
{
    protected $permissionAssignRepository;

    public function __construct(PermissionAssignRepository $permissionAssignRepository)
    {
        $this->permissionAssignRepository = $permissionAssignRepository;
    }

    public function index()
    {
        $assigns = $this->permissionAssignRepository->getAll();

        return view('admin.permissions.assigns.index', compact('assigns'));
    }

    public function create()
    {
        $permissions = $this->permissionAssignRepository->getAllPermissions();
        $roles = $this->permissionAssignRepository->getAllRoles();

        return view('admin.permissions.assigns.create', compact('permissions', 'roles'));
    }

    public function store(Request $request)
    {
        $this->permissionAssignRepository->store($request);

        return redirect()->route('assigns.permissions-index')->with('status', 'assign_created');
    }

    public function edit(Role $role)
    {
        $permissions = $this->permissionAssignRepository->getAllPermissions();
        $roles = $this->permissionAssignRepository->getAllRoles();

        return view('admin.permissions.assigns.edit', compact('permissions', 'roles', 'role'));
    }

    public function update(Request $request, Role $role)
    {
        $this->permissionAssignRepository->update($request, $role);

        return redirect()->route('assigns.permissions-index')->with('status', 'assign_created');
    }
}
