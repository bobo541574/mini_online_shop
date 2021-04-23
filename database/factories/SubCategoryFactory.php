<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;
    protected $index = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $this->index =  $this->index + 1;
        // return [
        //     'parent_id' => $this->faker->randomElement(Category::whereNull('parent_id')->pluck('id')->toArray()),
        //     'name_en' => "Test Sub Category - " . $this->index,
        //     'name_mm' => "အစမ်း ကုန်ပစ္စည်း အမျိုးအစားခွဲ - " . $this->index,
        //     'slug' => strtoslug("Test Sub Category - " . $this->index),
        //     'description_en' => "Test Sub Category - " . $this->index,
        //     'description_mm' => "အစမ်း ကုန်ပစ္စည်း အမျိုးအစားခွဲ - " . $this->index,
        // ];
    }
}
