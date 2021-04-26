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
        // User::create([
        //     'role_id' => 1,
        //     'first_name' => "Super",
        //     'last_name' => "Admin",
        //     'user_name' => "super admin",
        //     'email' => "superadmin@gmail.com",
        //     'email_verified_at' => now(),
        //     'phone' => "09999999999",
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);

        // PermissionRole::truncate();

        $this->call([
            // RoleSeeder::class,
            // UserSeeder::class,
            PermissionSeeder::class,
            PermissionAssignSeeder::class,
            // CategorySeeder::class,
            // SubCategorySeeder::class,
            // BrandSeeder::class,
            // BrandCategorySeeder::class,
            // ColorSeeder::class,
            // SizeSeeder::class,
            // ProductSeeder::class,
            // ProductAttributeSeeder::class,
        ]);
    }
}
