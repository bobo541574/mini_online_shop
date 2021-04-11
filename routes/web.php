<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\PermissionAssignController;

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

    // User
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user:user_name}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user:user_name}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user:user_name}', [UserController::class, 'destroy'])->name('users.destroy');

    // Permission
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/{permission:slug}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('permissions/{permission:slug}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('permissions/{permission:slug}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // Role
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/{role:slug}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles/{role:slug}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles/{role:slug}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Permission Assign
    Route::get('assigns', [PermissionAssignController::class, 'index'])->name('assigns.index');
    Route::get('assigns/create', [PermissionAssignController::class, 'create'])->name('assigns.create');
    Route::post('assigns', [PermissionAssignController::class, 'store'])->name('assigns.store');
    Route::get('assigns/{role:slug}/edit', [PermissionAssignController::class, 'edit'])->name('assigns.edit');
    Route::put('assigns/{role:slug}', [PermissionAssignController::class, 'update'])->name('assigns.update');

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

    // Subcategory
    Route::get('subcategories', [SubCategoryController::class, 'index'])->name('subcategories.index');
    Route::get('subcategories/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
    Route::post('subcategories', [SubCategoryController::class, 'store'])->name('subcategories.store');
    Route::get('subcategories/{subcategory:slug}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
    Route::put('subcategories/{subcategory:slug}', [SubCategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('subcategories/{subcategory:slug}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');
    Route::put('subcategories/{subcategory:slug}/to-trash', [SubCategoryController::class, 'toTrash'])->name('subcategories.to-trash');
    Route::get('subcategories/trash-list', [SubCategoryController::class, 'trashed'])->name('subcategories.trashed');
    Route::post('subcategories/{subcategory:slug}/restore', [SubCategoryController::class, 'restore'])->name('subcategories.restore');
    Route::post('subcategories/restore', [SubCategoryController::class, 'restoreAll'])->name('subcategories.restore-all');

    // Brand
    Route::get('brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('brands', [BrandController::class, 'store'])->name('brands.store');
    Route::get('brands/{brand:slug}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('brands/{brand:slug}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('brands/{brand:slug}', [BrandController::class, 'destroy'])->name('brands.destroy');
    Route::put('brands/{brand:slug}/to-trash', [BrandController::class, 'toTrash'])->name('brands.to-trash');
    Route::get('brands/trash-list', [BrandController::class, 'trashed'])->name('brands.trashed');
    Route::post('brands/{brand:slug}/restore', [BrandController::class, 'restore'])->name('brands.restore');
    Route::post('brands/restore', [BrandController::class, 'restoreAll'])->name('brands.restore-all');
});
