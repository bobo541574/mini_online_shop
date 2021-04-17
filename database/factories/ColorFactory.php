<?php

namespace Database\Factories;

use App\Models\Color;
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

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->index = $this->index + 1;
        return [
            'name_en' => "Test Color - " . (trans($this->index, [], 'en')),
            'name_mm' => "အစမ်း ကာလာ - " . (trans($this->index, [], 'mm')),
            'slug' => Str::slug("Test Color - " . (trans($this->index, [], 'en')) . "-" . now()),
        ];
    }
}
