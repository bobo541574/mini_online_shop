<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\PermissionRepository;
use App\Http\Requests\Back\Permission\CreateRequest;

class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $permissions = $this->permissionRepository->getAll();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        $routes = $this->permissionRepository->getRouteNames();
        // dd($routes);
        return view('admin.permissions.create', compact('routes'));
    }

    public function store(CreateRequest $request)
    {
        $this->permissionRepository->store($request);

        return redirect()->route('permissions.index')->with('status', 'permission_created');
    }

    public function edit(Permission $permission)
    {
        $routes = $this->permissionRepository->getRouteNames();

        return view('admin.permissions.edit', compact('routes', 'permission'));
    }

    public function update(CreateRequest $request, Permission $permission)
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
