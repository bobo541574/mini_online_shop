<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\CategoryRepository;
use App\Http\Requests\Back\Category\CreateRequest;

class CategoryController extends Controller
{
    protected $repo;

    public function __construct(CategoryRepository $repo)
    {
        $this->repo = $repo;
    }
    public function index()
    {
        $categories = $this->repo->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CreateRequest $request)
    {
        $this->repo->store($request);

        return redirect()->route('categories.index')->with('status', 'category_created');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CreateRequest $request, Category $category)
    {
        $this->repo->update($request, $category);

        return redirect()->route('categories.index')->with('status', 'category_updated');
    }

    public function destroy($slug)
    {
        $this->repo->destroy($slug);

        return redirect()->route('categories.index')->with('status', 'category_deleted');
    }

    public function toTrash(Category $category)
    {
        $this->repo->toTrash($category);

        return redirect()->route('categories.index')->with('status', 'category_deleted');
    }

    public function trashed()
    {
        $categories = $this->repo->trashed();

        return view('admin.categories.trashed', compact('categories'));
    }

    public function restore($slug)
    {
        $this->repo->restore($slug);

        return redirect()->route('categories.index')->with('status', 'category_restored');
    }

    public function restoreAll()
    {
        //
    }

    public function findSubcategoriesById($parentId)
    {
        return $this->repo->findSubcategoriesById($parentId);
    }
}
