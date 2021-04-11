<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionAssignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        if ($role->count() < 0) {
            $role->create([
                'name_en' => "Admin",
                'name_mm' => "အက်မင်",
                'slug' => "admin",
            ]);
        }

        $role->where('slug', 'admin')->first()->permissions()->sync(Permission::get());
    }
}
