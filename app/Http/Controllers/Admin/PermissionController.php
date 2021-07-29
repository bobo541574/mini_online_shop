<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\PermissionRepository;
use App\Http\Requests\Back\Permission\CreateRequest;

class PermissionController extends Controller
{
    protected $repo;

    public function __construct(PermissionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $permissions = $this->repo->getAll();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        $routes = $this->repo->getRouteNames();
        // dd($routes);
        return view('admin.permissions.create', compact('routes'));
    }

    public function store(CreateRequest $request)
    {
        $this->repo->store($request);

        return redirect()->route('permissions.index')->with('status', 'permission_created');
    }

    public function edit(Permission $permission)
    {
        $routes = $this->repo->getRouteNames();

        return view('admin.permissions.edit', compact('routes', 'permission'));
    }

    public function update(CreateRequest $request, Permission $permission)
    {
        $this->repo->update($request, $permission);

        return redirect()->route('permissions.index')->with('status', 'permission_updated');
    }

    public function destroy(Permission $permission)
    {
        $this->repo->destroy($permission);

        return redirect()->route('permissions.index')->with('status', 'permission_udeleted');
    }
}
