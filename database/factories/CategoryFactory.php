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

    protected $mm = [];

    protected $en = [];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->index =  $this->index + 1;

        $temp = str_split($this->index, 1);
        foreach ($temp as $value) {
            $this->mm[] = (trans($value, [], 'mm'));
            $this->en[] = trans($value, [], 'en');
        }
        $mm = implode("", $this->mm);
        $en = implode("", $this->en);
        $this->mm = [];
        $this->en = [];

        return [
            'name_en' => "Test Category - " . ($en),
            'name_mm' => "အမျိုးအစား - " . ($mm),
            'slug' => strtoslug("Test Category - " . ($en) . "-" . now()),
            'description_en' => "Test Category - " . ($en),
            'description_mm' => "အမျိုးအစား - " . ($mm),
        ];
    }
}
