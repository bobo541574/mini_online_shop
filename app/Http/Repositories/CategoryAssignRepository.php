<?php

namespace App\Http\Repositories;

use App\Models\Brand;
use App\Models\Category;

class CategoryAssignRepository
{
    public function category()
    {
        return (new Category());
    }

    public function brand()
    {
        return (new Brand());
    }

    public function paginate($data)
    {
        return $this->brand()->with('categories')->orderBy('name_' . session('locale'))->paginate($data);
    }

    public function getAllBrands()
    {
        return $this->brand()->with('categories')->orderBy('name_' . session('locale'))->get();
    }

    public function getAllCategories()
    {
        return $this->category()->whereNotNull('parent_id')->orderBy('name_' . session('locale'))->get();
    }

    public function store($request)
    {
        $this->brand()->find($request->brand)->categories()->sync($request->categories);
    }

    public function update($request, $brand)
    {
        return $brand->categories()->sync($request->categories);
    }

    public function destroy($brand)
    {
        return $brand->delete();
    }
}
