<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Back\ProductRepository;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->orderBy('name_' . session('locale'))->get();
        $suppliers = Supplier::orderBy('name_' . session('locale'))->get();

        return view('admin.products.create', compact('categories', 'suppliers'));
    }

    public function show(Product $product)
    {
        $attributes = $this->productRepository->getAllAttributes($product);

        return view('admin.products.show', compact('attributes'));
    }
}
