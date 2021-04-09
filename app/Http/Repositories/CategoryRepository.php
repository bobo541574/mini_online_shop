<?php

namespace App\Http\Repositories;

use App\Models\Category;

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
            'slug' => strtoslug($request->name_en),
            'description_en' => $request->description_en,
            'description_mm' => $request->description_mm,
        ]);
    }

    public function update($request, $category)
    {
        return $category->update([
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'slug' => strtoslug($request->name_en),
            'active' => $request->status,
            'description_en' => $request->description_en,
            'description_mm' => $request->description_mm,
        ]);
    }

    public function destroy($slug)
    {
        $category = $this->model()->onlyTrashed()->where('slug', $slug)->first();

        return $category->forceDelete();
    }

    public function toTrash($category)
    {
        $category->active = 0;
        $category->save();

        return $category->delete();
    }

    public function trashed()
    {
        return $this->model()->onlyTrashed()->whereNull('parent_id')->get();
    }

    public function restore($slug)
    {
        $category = $this->model()->onlyTrashed()->where('slug', $slug)->first();
        $category->active = 1;
        $category->save();

        return $category->restore();
    }
}
