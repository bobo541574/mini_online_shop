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
        if ($role->count() < 1) {
            $role->create([
                'name_en' => "Super Admin",
                'name_mm' => "စူပါအက်မင်",
                'slug' => strtoslug('Super Admin'),
            ]);
        }

        $role->find(1)->permissions()->sync(Permission::get());
    }
}
