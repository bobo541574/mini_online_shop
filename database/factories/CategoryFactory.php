<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
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
        $this->index =  $this->index + 1;
        return [
            'name_en' => "Test Category - " . (trans($this->index, [], 'en')),
            'name_mm' => "အစမ်း ကုန်ပစ္စည်း အမျိုးအစား - " . (trans($this->index, [], 'mm')),
            'slug' => \strtoslug("Test Category - " . (trans($this->index, [], 'en'))),
            'description_en' => "Test Category - " . (trans($this->index, [], 'en')),
            'description_mm' => "အစမ်း ကုန်ပစ္စည်း အမျိုးအစား - " . (trans($this->index, [], 'mm')),
        ];
    }
}
