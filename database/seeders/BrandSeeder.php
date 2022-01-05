<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::factory(20)->create()->each(function ($brand) {
            $brand->image()->create([
                'name' => '/img/brands/brand.png'
            ]);
        });
    }
}
