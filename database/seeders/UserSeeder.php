<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::firstWhere('email', 'admin@gmail.com');

        if (!$admin) {
            User::create([
                'first_name' => "Bo",
                'last_name' => "Bo",
                'user_name' => "bobo57",
                'email' => "admin@gmail.com",
                'email_verified_at' => now(),
                'phone' => "09978551328",
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10),
            ])->image()->create([
                'name' => '/img/users/profile.png'
            ]);
        }

        User::factory(10)->create()->each(function ($user) {
            $user->image()->create([
                'name' => '/img/users/profile.png'
            ]);
        });
    }
}
