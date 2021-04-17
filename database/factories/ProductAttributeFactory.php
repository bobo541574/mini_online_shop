<?php

namespace Database\Factories;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductAttribute::class;

    protected $index = 0;

    protected $product_id = 0;

    protected $color_id = 0;

    protected $size_id = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->index = $this->index + 1;
        $this->product_id = $this->faker->randomElement(Product::pluck('id')->toArray());
        $this->color_id = $this->faker->randomElement(Color::pluck('id')->toArray());
        $this->size_id = $this->faker->randomElement(Size::pluck('id')->toArray());

        return [
            'product_id' => $this->product_id,
            'color_id' => $this->color_id,
            'size_id' => $this->size_id,
            'slug' => strtoslug("Test Product - " . ($this->product_id) . "-" . ($this->color_id . $this->size_id)),
            'photo' => json_encode(["/img/products/product - 1.png", "/img/products/product - 2.png", "/img/products/product - 3.png"]),
            'sku' => rand(1, 50),
            'buy_price' => rand(1500, 10000),
            'extra_cost' => rand(100, 300),
            'sale_price' => rand(2500, 13000),
            'arrived' => $this->faker->dateTimeBetween('2021-04-01', '2021-11-30'),
            'description_en' => "Test Product Attribute",
            'description_mm' => "အစမ်း ကုပစ္စည်း ၏ အချက်အလက်",
        ];
    }
}
