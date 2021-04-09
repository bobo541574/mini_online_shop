<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Category
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category:slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category:slug}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category:slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::put('categories/{category:slug}/to-trash', [CategoryController::class, 'toTrash'])->name('categories.to-trash');
    Route::get('categories/trash-list', [CategoryController::class, 'trashed'])->name('categories.trashed');
    Route::post('categories/{category:slug}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::post('categories/restore', [CategoryController::class, 'restoreAll'])->name('categories.restore-all');
});
