<?php

namespace Database\Seeders;

use App\Models\ProductAttribute;
use Illuminate\Database\Seeder;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = ["/img/products/product - 1.svg", "/img/products/product - 2.svg", "/img/products/product - 3.svg"];

        ProductAttribute::factory(600)->create()->each(function ($attribute) use ($images) {
            foreach ($images as $image) {
                $attribute->images()->create([
                    'name' => $image
                ]);
            }
        });
    }
}
