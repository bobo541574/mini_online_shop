<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        $permission = new Permission();

        $lists = config('permissions');

        foreach ($lists as $key => $list) {
            foreach ($list as $p) {
                $permission->create([
                    'name_en' => $p['name_en'],
                    'name_mm' => $p['name_mm'],
                    'slug' => $p['slug'],
                    'type' => $key,
                ]);
            }
        }
    }
}
