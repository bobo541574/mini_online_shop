<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    protected $index = 0;

    protected $category = 0;

    protected $sub_category_id = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->index = $this->index + 1;
        $this->sub_category_id = $this->faker->randomElement(Category::whereNotNull('parent_id')->pluck('id')->toArray());
        $this->category = Category::find($this->sub_category_id);

        return [
            'brand_id' => $this->faker->randomElement(Brand::pluck('id')->toArray()),
            'category_id' => $this->category->parent_id,
            'sub_category_id' => $this->sub_category_id,
            'name_en' => "Test Product - " . (trans($this->index, [], 'en')),
            'name_mm' => "အစမ်း ကုန်ပစ္စည်း - " . (trans($this->index, [], 'mm')),
            'slug' => Str::slug("Test Product - " . (trans($this->index, [], 'en')) . "-" . now()),
        ];
    }
}
