<?php

namespace App\Http\Repositories;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CategoryRepository
{
    public function model()
    {
        return (new Category());
    }

    public function getAllCategories()
    {
        return $this->model()->whereNull('parent_id')->orderBy('name_' . session('locale'))->get();
    }

    public function store($request)
    {
        return $this->model()->create([
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'slug' => Str::slug($request->name_en . '_' . str_replace(':', '-', str_replace(' ', '_', Carbon::now()))),
            'description_en' => $request->description_en,
            'description_mm' => $request->description_mm,
        ]);
    }

    public function update($request, $category)
    {
        return $category->update([
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'slug' => Str::slug($request->name_en . '_' . str_replace(':', '-', str_replace(' ', '_', Carbon::now()))),
            'active' => $request->status,
            'description_en' => $request->description_en,
            'description_mm' => $request->description_mm,
        ]);
    }

    public function destroy($category)
    {
        $category->active = 0;
        $category->save();

        return $category->delete();
    }

    public function trashed()
    {
        return $this->model()->onlyTrashed()->whereNull('parent_id')->get();
    }
}
