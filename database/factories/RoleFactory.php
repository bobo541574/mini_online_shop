<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

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
            'name_en' => "User Role - " . ($en),
            'name_mm' => "အသုံးပြုသူ၏ အဆင့် - " . ($mm),
            'slug' => strtoslug("User Role - " . ($en) . "-" . now()),
        ];
    }
}
