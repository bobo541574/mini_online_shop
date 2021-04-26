<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Assign\CategoryAssignRequest;
use App\Http\Repositories\Back\CategoryAssignRepository;

class CategoryAssignController extends Controller
{
    protected $categoryAssignRepository;

    public function __construct(CategoryAssignRepository $categoryAssignRepository)
    {
        $this->categoryAssignRepository = $categoryAssignRepository;
    }

    public function index()
    {
        $brands = $this->categoryAssignRepository->paginate(10);

        return view('admin.brands.categories.index', compact('brands'));
    }

    public function create()
    {
        $brands = $this->categoryAssignRepository->getAllBrands();
        $categories = $this->categoryAssignRepository->getAllCategories();

        return view('admin.brands.categories.create', compact('categories', 'brands'));
    }

    public function store(CategoryAssignRequest $request)
    {
        $this->brandRepository->store($request);

        return redirect()->route('assigns.categories-index')->with('status', 'brand_categories_created');
    }

    public function edit(Brand $brand)
    {
        $categories = $this->categoryAssignRepository->getAllCategories();

        return view('admin.brands.categories.edit', compact('categories', 'brand'));
    }

    public function update(CategoryAssignRequest $request, Brand $brand)
    {
        $this->categoryAssignRepository->update($request, $brand);

        return redirect()->route('assigns.categories-index')->with('status', 'brand_categories_updated');
    }

    public function destroy(Brand $brand)
    {
        $this->categoryAssignRepository->destroy($brand);

        return redirect()->route('assigns.categories-index')->with('status', 'brand_categories_deleted');
    }
}
