<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
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
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            // PermissionSeeder::class,
            // PermissionAssignSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            BrandSeeder::class,
            BrandCategorySeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            ProductSeeder::class,
            ProductAttributeSeeder::class,
        ]);
    }
}
