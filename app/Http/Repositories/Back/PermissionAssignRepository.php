<?php

namespace App\Http\Repositories\Back;

use App\Models\Role;
use App\Models\Permission;

class PermissionAssignRepository
{
    public function permission()
    {
        return (new Permission());
    }

    public function role()
    {
        return (new Role());
    }

    public function getAll()
    {
        return $this->role()->with('permissions')->paginate();
    }

    public function getAllPermissions()
    {
        return $this->permission()->get()->groupBy('type');
    }

    public function getAllRoles()
    {
        return $this->role()->orderBy('name_' . session('locale'))->get();
    }

    public function store($request)
    {
        $role = $this->role()->find($request->role_id);

        return $role->permissions()->sync($request->permission);
    }

    public function update($request, $role)
    {
        return $role->permissions()->sync($request->permission);
    }
}
