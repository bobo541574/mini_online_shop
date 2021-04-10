<?php

namespace App\Http\Repositories;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

class PermissionRepository
{
    public function model()
    {
        return (new Permission());
    }

    public function getRouteNames()
    {
        $permissions = [];

        $routes = Route::getRoutes(); //get and returns all returns route collection

        foreach ($routes as $route) {
            if ($this->arrayFilter($route->getName())) {
                continue;
            }
            $permissions[] = strtoslug($route->getName(), false);
        }

        return $permissions;
    }

    public function arrayFilter($data)
    {
        $removeList = ["", "debugbar", "ignition"];
        foreach ($removeList as $list) {
            if ($list != "") {
                if (strpos($data, $list) !== false) {
                    return true;
                }
            } elseif ($data == "") {
                return true;
            }
        }

        return false;
    }

    public function store($request)
    {
        $type = explode('-', $request->slug);

        return $this->model()->create([
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'slug' => strtoslug([$request->slug], false),
            'type' => Str::of(strtolower($type[0]))->singular(),
        ]);
    }

    public function update($request, $permission)
    {
        $type = explode('-', $request->slug);

        return $permission->update([
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'slug' => strtoslug([$request->slug], false),
            'type' => Str::of(strtolower($type[0]))->singular(),
        ]);
    }

    public function destroy($permission)
    {
        return $permission->delete();
    }
}
