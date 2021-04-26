<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Repositories\Back\CategoryRepository;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {
        $categories = $this->categoryRepository->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->store($request);

        return redirect()->route('categories.index')->with('status', 'category_created');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryRepository->update($request, $category);

        return redirect()->route('categories.index')->with('status', 'category_updated');
    }

    public function destroy($slug)
    {
        $this->categoryRepository->destroy($slug);

        return redirect()->route('categories.index')->with('status', 'category_deleted');
    }

    public function toTrash(Category $category)
    {
        $this->categoryRepository->toTrash($category);

        return redirect()->route('categories.index')->with('status', 'category_deleted');
    }

    public function trashed()
    {
        $categories = $this->categoryRepository->trashed();

        return view('admin.categories.trashed', compact('categories'));
    }

    public function restore($slug)
    {
        $this->categoryRepository->restore($slug);

        return redirect()->route('categories.index')->with('status', 'category_restored');
    }

    public function restoreAll()
    {
        //
    }

    public function findSubcategoriesById($parentId)
    {
        return $this->categoryRepository->findSubcategoriesById($parentId);
    }
}
