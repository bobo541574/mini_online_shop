<?php

namespace Database\Seeders;

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
        // PermissionRole::truncate();
        User::create([
            'first_name' => "Admin",
            'last_name' => "",
            'user_name' => "admin",
            'email' => "admin@gmail.com",
            'email_verified_at' => now(),
            'phone' => "09999999999",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        User::factory(10)->create();

        $this->call([
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
