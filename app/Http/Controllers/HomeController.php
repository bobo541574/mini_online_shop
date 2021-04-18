<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->whereNull('parent_id')->get();
        $products = Product::with('category', 'subcategory', 'attribute')->paginate(8);

        $latestProducts = Product::with('category', 'subcategory', 'attribute')->orderBy('created_at')->take(3)->get();
        $popularProducts = Product::with('category', 'subcategory', 'attribute')->orderBy('popular', 'desc')->take(3)->get();
        $adminProducts = Product::with('category', 'subcategory', 'attribute')->whereNotNull('admin_choice')->take(3)->get();

        return view('home', compact('categories', 'products', 'latestProducts', 'popularProducts', 'adminProducts'));
    }

    public function subcategoryByProducts(Category $subcategory)
    {
        $categories = Category::with('subcategories')->whereNull('parent_id')->get();
        $products = Product::with('category', 'subcategory', 'attribute')->where('sub_category_id', $subcategory->id)->paginate(8);

        $latestProducts = Product::with('category', 'subcategory', 'attribute')->orderBy('created_at')->take(3)->get();
        $popularProducts = Product::with('category', 'subcategory', 'attribute')->orderBy('popular', 'desc')->take(3)->get();
        $adminProducts = Product::with('category', 'subcategory', 'attribute')->whereNotNull('admin_choice')->take(3)->get();

        return view('home', compact('categories', 'products', 'latestProducts', 'popularProducts', 'adminProducts'));
    }

    public function addToCart(Product $product)
    {
        return redirect()->back()->with('status', "add_to_cart_success");
    }
}
