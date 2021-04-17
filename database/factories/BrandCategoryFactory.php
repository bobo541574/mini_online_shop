<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\BrandCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BrandCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brand_id' => $this->faker->randomElement(Brand::pluck('id')->toArray()),
            'category_id' => $this->faker->randomElement(Category::whereNotNull('parent_id')->pluck('id')->toArray()),
        ];
    }
}
