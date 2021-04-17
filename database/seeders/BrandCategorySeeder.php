<?php

namespace Database\Seeders;

use App\Models\BrandCategory;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BrandCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BrandCategory::factory(20)->create();
    }
}
