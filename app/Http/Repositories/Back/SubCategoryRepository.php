<?php

namespace App\Http\Repositories\Back;

use App\Models\Category;

class SubCategoryRepository
{
    public function model()
    {
        return (new Category());
    }

    public function getAll()
    {
        return $this->model()->whereNotNull('parent_id')->orderBy('name_' . session('locale'))->paginate(10);
    }

    public function getAllCategories()
    {
        return $this->model()->whereNull('parent_id')->orderBy('name_' . session('locale'))->get();
    }

    public function store($request)
    {
        return $this->model()->create([
            'parent_id' => $request->parent_id,
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'slug' => strtoslug($request->name_en),
            'description_en' => $request->description_en,
            'description_mm' => $request->description_mm,
        ]);
    }

    public function update($request, $subcategory)
    {
        return $subcategory->update([
            'parent_id' => $request->parent_id,
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
        $subcategory = $this->model()->onlyTrashed()->where('slug', $slug)->first();

        return $subcategory->forceDelete();
    }

    public function toTrash($subcategory)
    {
        $subcategory->active = 0;
        $subcategory->save();

        return $subcategory->delete();
    }

    public function trashed()
    {
        return $this->model()->onlyTrashed()->whereNotNull('parent_id')->get();
    }

    public function restore($slug)
    {
        $subcategory = $this->model()->onlyTrashed()->where('slug', $slug)->first();
        $subcategory->active = 1;
        $subcategory->save();

        return $subcategory->restore();
    }

    public function findBrandsById($subcategoryId)
    {
        return $this->model()->find($subcategoryId)->brands;
    }
}
