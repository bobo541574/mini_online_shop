<?php

namespace App\Http\Repositories\Back;

use App\Models\Role;

class RoleRepository
{
    public function model()
    {
        return (new Role());
    }

    public function getAll()
    {
        return $this->model()->orderBy('name_' . session('locale'))->paginate(5);
    }

    public function store($request)
    {
        return $this->model()->create([
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'slug' => strtoslug($request->name_en, false),
        ]);
    }

    public function update($request, $role)
    {
        return $role->update([
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'slug' => strtoslug($request->name_en, false),
        ]);
    }

    public function destroy($role)
    {
        return $role->delete();
    }
}
