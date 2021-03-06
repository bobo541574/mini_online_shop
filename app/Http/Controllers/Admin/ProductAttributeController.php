<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\ProductAttribute\CreateRequest;
use App\Http\Requests\Back\ProductAttribute\UpdateRequest;
use App\Http\Repositories\Back\ProductAttributeRepository;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    protected $repo;

    public function __construct(ProductAttributeRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $attributes = $this->repo->paginate(10);

        return view('admin.products.attributes.index', compact('attributes'));
    }

    public function attributesByProduct($slug)
    {
        $attributes = $this->repo->attributesByProduct($slug, 10);

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
        $this->repo->store($request);

        return redirect()->route('attributes.product', Product::find($request->product_id)->slug)->with('status', 'attribute_created');
    }

    public function edit(ProductAttribute $attribute)
    {
        $colors = Color::get();
        $sizes = Size::get();

        return view('admin.products.attributes.edit', compact('attribute', 'colors', 'sizes'));
    }

    public function update(UpdateRequest $request, ProductAttribute $attribute)
    {
        $this->repo->update($request, $attribute);

        return redirect()->route('attributes.product', Product::find($request->product_id)->slug)->with('status', 'attribute_updated');
    }

    public function show(ProductAttribute $attribute)
    {
        return view('admin.products.attributes.show', compact('attribute'));
    }

    public function destory($slug)
    {
        $product = $this->repo->destory($slug);

        return redirect()->route('attributes.product', Product::find($product->id)->slug)->with('status', 'attribute_deleted');
    }

    public function remove(ProductAttribute $attribute)
    {
        $this->repo->remove($attribute);

        return redirect()->route('attributes.product', Product::find($attribute->product->id)->slug)->with('status', 'attribute_deleted');
    }

    public function trashed()
    {
        $attributes = $this->repo->trashed();

        return view('admin.products.attributes.trashed', compact('attributes'));
    }

    public function restore($slug)
    {
        $product = $this->repo->restore($slug);

        return redirect()->route('attributes.product', Product::find($product->id)->slug)->with('status', 'attribute_restored');
    }

    public function uploadPhoto(Request $request)
    {
        return $this->repo->uploadPhoto($request);
    }

    public function removePhoto(Request $request)
    {
        return $this->repo->removePhoto($request);
    }

    public function showPhoto(ProductAttribute $attribute)
    {
        return $this->repo->showPhoto($attribute);
    }
}
