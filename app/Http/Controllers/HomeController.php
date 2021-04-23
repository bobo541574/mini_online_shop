<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->whereNull('parent_id')->get();

        $latestProducts = Product::with('category', 'subcategory', 'brand', 'attribute')->orderBy('created_at')->take(3)->get();
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

        return $products;
    }

    public function subcategoryByProducts($id)
    {
        $products = Product::with('category', 'subcategory', 'brand', 'attribute')->where('sub_category_id', 10)->paginate(12);

        return $products;
    }

    public function addToCart(Product $product)
    {
        return redirect()->back()->with('status', "add_to_cart_success");
    }
}
