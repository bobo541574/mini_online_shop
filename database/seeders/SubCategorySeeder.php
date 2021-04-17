<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
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
        $parent_id = Category::whereNull('parent_id')->pluck('id')->toArray();

        for ($i = 1; $i < 15; $i++) {
            $category = new Category();
            $category->parent_id = rand($parent_id[0], $parent_id[5]);
            $category->name_en = "Test Sub Category - " . (trans($i, [], 'en'));
            $category->name_mm = "အစမ်း ကုန်ပစ္စည်း အမျိုးအစားခွဲ - " . (trans($i, [], 'mm'));
            $category->slug = Str::slug("Test Sub Category - " . (trans($this->index, [], 'en')) . "-" . now());
            $category->description_en = "Test Sub Category - " . (trans($i, [], 'en'));
            $category->description_mm = "အစမ်း ကုန်ပစ္စည်း အမျိုးအစားခွဲ - " . (trans($i, [], 'mm'));
            $category->save();
        }
    }
}
