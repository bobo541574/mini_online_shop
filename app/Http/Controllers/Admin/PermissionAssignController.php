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
        $assigns = $this->permissionAssignRepository->getAllAssigns();

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

        return redirect()->route('assigns.index')->with('status', 'permission_assigned');
    }

    public function edit(Role $role)
    {
        $permissions = $this->permissionAssignRepository->getAllPermissions();
        $roles = $this->permissionAssignRepository->getAllRoles();

        return view('admin.permissions.assigns.edit', compact('permissions', 'roles', 'role'));
    }
}
