<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        PermissionRole::truncate();
        // \App\Models\User::factory(10)->create();
        $this->call([
            PermissionSeeder::class,
            PermissionAssignSeeder::class,
        ]);
    }
}
