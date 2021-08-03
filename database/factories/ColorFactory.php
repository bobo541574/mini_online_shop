<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Color::class;

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
            'name_en' => "Test Color - " . ($en),
            'name_mm' => "ကာလာ - " . ($mm),
            'slug' => strtoslug("Test Color - " . ($en) . "-" . now()),
            'color_code' => "#" . rand(000000, 999999),
        ];
    }
}
