<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\SubCategoryRepository;
use App\Http\Requests\Back\SubCategory\CreateRequest;

class SubCategoryController extends Controller
{
    protected $repo;

    public function __construct(SubCategoryRepository $repo)
    {
        $this->repo = $repo;
    }
    public function index()
    {
        $subcategories = $this->repo->getAll();

        return view('admin.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = $this->repo->getAllCategories();

        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(CreateRequest $request)
    {
        $this->repo->store($request);

        return redirect()->route('subcategories.index')->with('status', 'subcategory_created');
    }

    public function edit(Category $subcategory)
    {
        $categories = $this->repo->getAllCategories();

        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(CreateRequest $request, Category $subcategory)
    {
        $this->repo->update($request, $subcategory);

        return redirect()->route('subcategories.index')->with('status', 'subcategory_updated');
    }

    public function destroy($slug)
    {
        $this->repo->destroy($slug);

        return redirect()->route('subcategories.index')->with('status', 'subcategory_deleted');
    }

    public function toTrash(Category $subcategory)
    {
        $this->repo->toTrash($subcategory);

        return redirect()->route('subcategories.index')->with('status', 'subcategory_deleted');
    }

    public function trashed()
    {
        $subcategories = $this->repo->trashed();

        return view('admin.subcategories.trashed', compact('subcategories'));
    }

    public function restore($slug)
    {
        $this->repo->restore($slug);

        return redirect()->route('subcategories.index')->with('status', 'subcategory_restored');
    }

    public function restoreAll()
    {
        //
    }

    public function findBrandsById($subcategoryId)
    {
        return $this->repo->findBrandsById($subcategoryId);
    }
}
