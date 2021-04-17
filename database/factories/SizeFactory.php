<?php

namespace Database\Factories;

use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

class SizeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Size::class;
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
            'name_en' => "Test Size - " . (trans($this->index, [], 'en')),
            'name_mm' => "အစမ်း အရွယ်အစား - " . (trans($this->index, [], 'mm')),
            'slug' => strtoslug("Test Siz - " . (trans($this->index, [], 'en'))),
        ];
    }
}
