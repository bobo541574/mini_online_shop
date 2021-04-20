<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $products = Product::with('category', 'subcategory', 'brand', 'attribute')->where('sub_category_id', $id)->paginate(4);

        return $products;
    }

    public function addToCart(Product $product)
    {
        return redirect()->back()->with('status', "add_to_cart_success");
    }
}
