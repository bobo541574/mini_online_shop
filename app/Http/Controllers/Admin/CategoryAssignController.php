<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\CategoryAssignRepository;
use App\Http\Requests\Back\Assign\CategoryAssignRequest;

class CategoryAssignController extends Controller
{
    protected $repo;

    public function __construct(CategoryAssignRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $brands = $this->repo->paginate(10);

        return view('admin.brands.categories.index', compact('brands'));
    }

    public function create()
    {
        $brands = $this->repo->getAllBrands();
        $categories = $this->repo->getAllCategories();

        return view('admin.brands.categories.create', compact('categories', 'brands'));
    }

    public function store(CategoryAssignRequest $request)
    {
        $this->repo->store($request);

        return redirect()->route('assigns.categories-index')->with('status', 'brand_categories_created');
    }

    public function edit(Brand $brand)
    {
        $categories = $this->repo->getAllCategories();

        return view('admin.brands.categories.edit', compact('categories', 'brand'));
    }

    public function update(CategoryAssignRequest $request, Brand $brand)
    {
        $this->repo->update($request, $brand);

        return redirect()->route('assigns.categories-index')->with('status', 'brand_categories_updated');
    }

    public function destroy(Brand $brand)
    {
        $this->repo->destroy($brand);

        return redirect()->route('assigns.categories-index')->with('status', 'brand_categories_deleted');
    }
}
