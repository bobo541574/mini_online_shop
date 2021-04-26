<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\SubCategoryRepository;
use App\Http\Requests\SubCategory\SubCategoryRequest;

class SubCategoryController extends Controller
{
    protected $subCategoryRepository;

    public function __construct(SubCategoryRepository $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }
    public function index()
    {
        $subcategories = $this->subCategoryRepository->getAll();

        return view('admin.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = $this->subCategoryRepository->getAllCategories();

        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(SubCategoryRequest $request)
    {
        $this->subCategoryRepository->store($request);

        return redirect()->route('subcategories.index')->with('status', 'subcategory_created');
    }

    public function edit(Category $subcategory)
    {
        $categories = $this->subCategoryRepository->getAllCategories();

        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(SubCategoryRequest $request, Category $subcategory)
    {
        $this->subCategoryRepository->update($request, $subcategory);

        return redirect()->route('subcategories.index')->with('status', 'subcategory_updated');
    }

    public function destroy($slug)
    {
        $this->subCategoryRepository->destroy($slug);

        return redirect()->route('subcategories.index')->with('status', 'subcategory_deleted');
    }

    public function toTrash(Category $subcategory)
    {
        $this->subCategoryRepository->toTrash($subcategory);

        return redirect()->route('subcategories.index')->with('status', 'subcategory_deleted');
    }

    public function trashed()
    {
        $subcategories = $this->subCategoryRepository->trashed();

        return view('admin.subcategories.trashed', compact('subcategories'));
    }

    public function restore($slug)
    {
        $this->subCategoryRepository->restore($slug);

        return redirect()->route('subcategories.index')->with('status', 'subcategory_restored');
    }

    public function restoreAll()
    {
        //
    }

    public function findBrandsById($subcategoryId)
    {
        return $this->subCategoryRepository->findBrandsById($subcategoryId);
    }
}
