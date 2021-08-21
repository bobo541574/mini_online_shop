<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Back\Product\CreateRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\ProductRepository;

class ProductController extends Controller
{
    protected $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $products = $this->repo->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->orderBy('name_' . session('locale'))->get();
        $suppliers = Supplier::orderBy('name_' . session('locale'))->get();

        return view('admin.products.create', compact('categories', 'suppliers'));
    }

    public function store(CreateRequest $request)
    {
        $data = $this->repo->store($request);

        return redirect()->route('products.index')->with('status', 'product_created');
    }

    public function show(Product $product)
    {
        $attributes = $this->repo->getAllAttributes($product);

        return view('admin.products.show', compact('attributes'));
    }
}
