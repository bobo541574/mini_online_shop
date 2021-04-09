<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\Category\CategoryRequest;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {
        $categories = $this->categoryRepository->getAllCategories();

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

    public function destroy(Category $category)
    {
        $this->categoryRepository->destroy($category);

        return redirect()->route('categories.index')->with('status', 'category_deleted');
    }

    public function trashed()
    {
        return $this->categoryRepository->trashed();
    }
}
