<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LocalizationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.layouts.app');
})->name('index');

Route::get('/products', function () {
    return view('admin.products.index');
})->name('products');

Route::get('/address', [HomeController::class, 'index'])->name('address');

Route::get('/locale-switch/{locale}', LocalizationController::class)->name('locale.switch');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Admin Section
Route::get('admin/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('admin/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('admin/categories/{category:slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('admin/categories/{category:slug}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('admin/categories/{category:slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('admin/categories/trash-list', [CategoryController::class, 'trashed'])->name('categories.trashed');
Route::post('admin/categories/{category:slug}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
Route::post('admin/categories/restore', [CategoryController::class, 'restoreAll'])->name('categories.restore-all');
