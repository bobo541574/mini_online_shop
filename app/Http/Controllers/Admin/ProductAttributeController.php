<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductAttributeRepository;
use App\Http\Requests\ProductAttribute\CreateRequest;
use App\Http\Requests\ProductAttribute\UpdateRequest;

class ProductAttributeController extends Controller
{
    protected $productAttributeRepository;

    public function __construct(ProductAttributeRepository $productAttributeRepository)
    {
        $this->productAttributeRepository = $productAttributeRepository;
    }

    public function index()
    {
        $attributes = $this->productAttributeRepository->paginate(10);

        return view('admin.products.attributes.index', compact('attributes'));
    }

    public function create(Product $product)
    {
        $colors = Color::get();
        $sizes = Size::get();

        return view('admin.products.attributes.create', compact('product', 'colors', 'sizes'));
    }

    public function store(CreateRequest $request)
    {
        $this->productAttributeRepository->store($request);

        return redirect()->route('attributes.index')->with('status', 'attribute_created');
    }

    public function edit(ProductAttribute $attribute)
    {
        $colors = Color::get();
        $sizes = Size::get();

        return view('admin.products.attributes.edit', compact('attribute', 'colors', 'sizes'));
    }

    public function update(UpdateRequest $request, ProductAttribute $attribute)
    {
        $this->productAttributeRepository->update($request, $attribute);

        return redirect()->route('attributes.index')->with('status', 'attribute_updated');
    }

    public function show(ProductAttribute $attribute)
    {
        return view('admin.products.attributes.show', compact('attribute'));
    }

    public function destory($slug)
    {
        $this->productAttributeRepository->destory($slug);

        return redirect()->route('attributes.index')->with('status', 'attribute_deleted');
    }

    public function remove(ProductAttribute $attribute)
    {
        $this->productAttributeRepository->remove($attribute);

        return redirect()->route('attributes.index')->with('status', 'attribute_deleted');
    }

    public function trashed()
    {
        $attributes = $this->productAttributeRepository->trashed();

        return view('admin.products.attributes.trashed', compact('attributes'));
    }

    public function restore($slug)
    {
        $this->productAttributeRepository->restore($slug);

        return redirect()->route('attributes.index')->with('status', 'attribute_restored');
    }
}
