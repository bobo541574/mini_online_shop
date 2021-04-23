<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = "";
        $mm = [];
        $en = [];

        $parent_id = Category::whereNull('parent_id')->pluck('id')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            $temp = str_split($i, 1);
            foreach ($temp as $value) {
                $mm[] = (trans($value, [], 'mm'));
                $en[] = trans($value, [], 'en');
            }
            $mm_str = implode("", $mm);
            $en_str = implode("", $en);
            $mm = [];
            $en = [];

            $category = new Category();
            $category->parent_id = rand($parent_id[0], $parent_id[5]);
            $category->name_en = "Test Sub Category - " . ($en_str);
            $category->name_mm = "အမျိုးအစားခွဲ - " . ($mm_str);
            $category->slug = strtoslug("Test Sub Category - " . ($en_str) . "-" . now());
            $category->description_en = "Test Sub Category - " . ($en_str);
            $category->description_mm = "အမျိုးအစားခွဲ - " . ($mm_str);
            $category->save();
        }
    }
}
