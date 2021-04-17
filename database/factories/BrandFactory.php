<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;
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
            'name_en' => "Test Brand - " . (trans($this->index, [], 'en')),
            'name_mm' => "အစမ်း ကုန်ပစ္စည်း အမှတ်တံဆိပ် - " . (trans($this->index, [], 'mm')),
            'photo' => json_encode("/img/brands/brand.png"),
            'slug' => Str::slug("Test Brand - " . (trans($this->index, [], 'en')) . "-" . now()),
            'description_en' => "Test Brand - " . (trans($this->index, [], 'en')),
            'description_mm' => "အစမ်း ကုန်ပစ္စည်း အမှတ်တံဆိပ် - " . (trans($this->index, [], 'mm')),
        ];
    }
}
