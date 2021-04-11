<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Repositories\PermissionRepository;
use App\Http\Requests\Permission\PermissionRequest;

class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $permissions = Permission::with('roles')->paginate(10);

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        $routes = $this->permissionRepository->getRouteNames();
        // dd($routes);
        return view('admin.permissions.create', compact('routes'));
    }

    public function store(PermissionRequest $request)
    {
        $this->permissionRepository->store($request);

        return redirect()->route('permissions.index')->with('status', 'permission_created');
    }

    public function edit(Permission $permission)
    {
        $routes = $this->permissionRepository->getRouteNames();

        return view('admin.permissions.edit', compact('routes', 'permission'));
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $this->permissionRepository->update($request, $permission);

        return redirect()->route('permissions.index')->with('status', 'permission_updated');
    }

    public function destroy(Permission $permission)
    {
        $this->permissionRepository->destroy($permission);

        return redirect()->route('permissions.index')->with('status', 'permission_udeleted');
    }
}
