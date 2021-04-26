<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Category;
use App\services\Address;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use App\Http\Resources\Front\ProductResource;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->whereNull('parent_id')->get();

        $latestProducts = Product::with('category', 'subcategory', 'brand', 'attribute')->orderBy('created_at')->take(4)->get();
        $popularProducts = Product::with('category', 'subcategory', 'brand', 'attribute')->orderBy('popular', 'desc')->take(3)->get();
        $adminProducts = Product::with('category', 'subcategory', 'brand', 'attribute')->whereNotNull('admin_choice')->take(3)->get();

        return view('front.home', compact('categories', 'latestProducts', 'popularProducts', 'adminProducts'));
    }

    // public function subcategoryByProducts(Category $subcategory)
    // {
    //     $categories = Category::with('subcategories')->whereNull('parent_id')->get();

    //     $latestProducts = Product::with('category', 'subcategory', 'brand', 'attribute')->orderBy('created_at')->take(3)->get();
    //     $popularProducts = Product::with('category', 'subcategory', 'brand', 'attribute')->orderBy('popular', 'desc')->take(3)->get();
    //     $adminProducts = Product::with('category', 'subcategory', 'brand', 'attribute')->whereNotNull('admin_choice')->take(3)->get();

    //     return view('front.home', compact('categories', 'latestProducts', 'popularProducts', 'adminProducts'));
    // }

    public function productWithAjax()
    {
        $products = Product::with('category', 'subcategory', 'brand', 'attribute')->paginate(12);

        return ProductResource::collection($products);
    }

    public function subcategoryByProducts($id)
    {
        $products = Product::with('category', 'subcategory', 'brand', 'attribute')->where('sub_category_id', $id)->paginate(8);

        return ProductResource::collection($products);
    }

    public function attributesByProduct(Product $product)
    {
        $address = new Address(config('address'));

        $states = $address->stateList();

        $attributes = ProductAttribute::with('product', 'color', 'size')->where('product_id', $product->id)->get();

        return view('front.products.product', compact('attributes', 'states'));
    }

    public function buyNow(Request $request)
    {
        dd($request->all());
    }
}
