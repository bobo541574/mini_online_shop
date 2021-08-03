<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryAssignController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PermissionAssignController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\TransitionController;
use App\Http\Controllers\Front\UserController as FrontUserController;
use App\Http\Controllers\LocalizationController;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/db-seed', function () {
    return Artisan::call('db:seed --force');
});

Route::get('/clear', function () {
    return Artisan::call('optimize:clear--force');
});

Route::get('/products/image', function () {
    $attributes = ProductAttribute::get();
    foreach ($attributes as $attribute) {
        $attribute->photo = json_encode(["/img/products/product - 1.svg", "/img/products/product - 2.svg", "/img/products/product - 3.svg"]);
        $attribute->save();
    }
});

Route::get('/locale-switch/{locale}', LocalizationController::class)->name('locale.switch');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Front Section
Route::get('/', [HomeController::class, 'index'])->name('front.home');
Route::get('/products', [HomeController::class, 'productWithAjax'])->name('front.products.ajax');
Route::get('/category/{subcategory:id}/products', [HomeController::class, 'subcategoryByProducts'])->name('front.subcategories.ajax');
Route::get('/product/{product:slug}/attributes', [HomeController::class, 'attributesByProduct'])->name('front.product.attributes');
Route::group(['middleware' => 'auth'], function () {
    // Order
    Route::get('orders', [OrderController::class, 'index'])->name('front.orders.index');
    Route::post('orders', [OrderController::class, 'store'])->name('front.orders.store');
    Route::get('orders/{order:slug}/show', [OrderController::class, 'show'])->name('front.orders.show');
    Route::post('orders/{order:slug}/to-trash', [OrderController::class, 'toTrash'])->name('front.orders.to-trash');
    Route::put('orders/{order:slug}', [OrderController::class, 'update'])->name('front.orders.update');
    Route::delete('orders/{order:slug}', [OrderController::class, 'destroy'])->name('front.orders.destroy');
    Route::get('orders/finish', [OrderController::class, 'finish'])->name('front.orders.finish');

    // Cart
    Route::get('carts', [CartController::class, 'index'])->name('front.carts.index');
    Route::post('carts', [CartController::class, 'store'])->name('front.carts.store');
    Route::get('carts/{cart:slug}', [CartController::class, 'show'])->name('front.carts.show');
    Route::delete('carts/{cart:slug}', [CartController::class, 'destroy'])->name('front.carts.destroy');

    // Transition
    Route::post('transitions/{order:slug}', [TransitionController::class, 'store'])->name('front.transitions.store');

    // Contact
    Route::get('/state/{state?}/cities', [ContactController::class, 'getCititesBystate'])->name('front.state.cities');
    Route::get('/city/{state?}/townships', [ContactController::class, 'getTownshipsBycity'])->name('front.city.townships');

    // Contact For User
    Route::post('/users/contact', [FrontUserController::class, 'contact'])->name('front.users.store-contact');
});

Route::post('/product/add-to-cart', [HomeController::class, 'addToCart'])->name('front.attribute.add-to-cart');

// Admin Section
Route::group(['prefix' => 'admin', 'middleware' => 'backend'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Product Ajax Request
    Route::get('products/{parentId}/subcategories', [CategoryController::class, 'findSubcategoriesById'])->name('products.subcategories');
    Route::get('subcategory/{subcategoryId}/brands', [SubCategoryController::class, 'findBrandsById'])->name('products.brands');

    Route::group(['middleware' => 'permissions'], function () {
        // User
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user:user_name}/show', [UserController::class, 'show'])->name('users.show');
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

        // Role Assign Permission
        Route::get('roles/permissions', [PermissionAssignController::class, 'index'])->name('assigns.permissions-index');
        Route::get('roles/permissions/create', [PermissionAssignController::class, 'create'])->name('assigns.permissions-create');
        Route::post('roles/permissions', [PermissionAssignController::class, 'store'])->name('assigns.permissions-store');
        Route::get('roles/{role:slug}/permissions/edit', [PermissionAssignController::class, 'edit'])->name('assigns.permissions-edit');
        Route::put('roles/{role:slug}/permissions', [PermissionAssignController::class, 'update'])->name('assigns.permissions-update');

        // Category
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('', [CategoryController::class, 'store'])->name('store');
            Route::get('/{category:slug}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/{category:slug}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{category:slug}', [CategoryController::class, 'destroy'])->name('destroy');
            Route::put('/{category:slug}/to-trash', [CategoryController::class, 'toTrash'])->name('to-trash');
            Route::get('/trash-list', [CategoryController::class, 'trashed'])->name('trashed');
            Route::post('/{category:slug}/restore', [CategoryController::class, 'restore'])->name('restore');
            Route::post('/restore', [CategoryController::class, 'restoreAll'])->name('restore-all');
        });

        // Subcategory
        Route::prefix('subcategories')->name('subcategories.')->group(function () {
            Route::get('/', [SubCategoryController::class, 'index'])->name('index');
            Route::get('/create', [SubCategoryController::class, 'create'])->name('create');
            Route::post('', [SubCategoryController::class, 'store'])->name('store');
            Route::get('/{subcategory:slug}/edit', [SubCategoryController::class, 'edit'])->name('edit');
            Route::put('/{subcategory:slug}', [SubCategoryController::class, 'update'])->name('update');
            Route::delete('/{subcategory:slug}', [SubCategoryController::class, 'destroy'])->name('destroy');
            Route::put('/{subcategory:slug}/to-trash', [SubCategoryController::class, 'toTrash'])->name('to-trash');
            Route::get('/trash-list', [SubCategoryController::class, 'trashed'])->name('trashed');
            Route::post('/{subcategory:slug}/restore', [SubCategoryController::class, 'restore'])->name('restore');
            Route::post('/restore', [SubCategoryController::class, 'restoreAll'])->name('restore-all');
        });

        // Brand
        Route::prefix('brands')->name('brands.')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('index');
            Route::get('/create', [BrandController::class, 'create'])->name('create');
            Route::post('', [BrandController::class, 'store'])->name('store');
            Route::get('/{brand:slug}/edit', [BrandController::class, 'edit'])->name('edit');
            Route::put('/{brand:slug}', [BrandController::class, 'update'])->name('update');
            Route::delete('/{brand:slug}', [BrandController::class, 'destroy'])->name('destroy');
            Route::put('/{brand:slug}/to-trash', [BrandController::class, 'toTrash'])->name('to-trash');
            Route::get('/trash-list', [BrandController::class, 'trashed'])->name('trashed');
            Route::post('/{brand:slug}/restore', [BrandController::class, 'restore'])->name('restore');
            Route::post('/restore', [BrandController::class, 'restoreAll'])->name('restore-all');
        });


        // Brand Assign Category
        Route::get('brands/categories', [CategoryAssignController::class, 'index'])->name('assigns.categories-index');
        Route::get('brands/categories/create', [CategoryAssignController::class, 'create'])->name('assigns.categories-create');
        Route::post('brands/categories', [CategoryAssignController::class, 'store'])->name('assigns.categories-store');
        Route::get('brands/{brand:slug}/categories/edit', [CategoryAssignController::class, 'edit'])->name('assigns.categories-edit');
        Route::put('brands/{brand:slug}/categories', [CategoryAssignController::class, 'update'])->name('assigns.categories-update');
        Route::delete('brands/{brand:slug}/categories', [CategoryAssignController::class, 'destroy'])->name('assigns.categories-destroy');

        // Color
        Route::get('colors', [ColorController::class, 'index'])->name('colors.index');
        Route::get('colors/create', [ColorController::class, 'create'])->name('colors.create');
        Route::post('colors', [ColorController::class, 'store'])->name('colors.store');
        Route::get('colors/{color:slug}/edit', [ColorController::class, 'edit'])->name('colors.edit');
        Route::put('colors/{color:slug}', [ColorController::class, 'update'])->name('colors.update');
        Route::delete('colors/{color:slug}', [ColorController::class, 'destroy'])->name('colors.destroy');

        // Size
        Route::get('sizes', [SizeController::class, 'index'])->name('sizes.index');
        Route::get('sizes/create', [SizeController::class, 'create'])->name('sizes.create');
        Route::post('sizes', [SizeController::class, 'store'])->name('sizes.store');
        Route::get('sizes/{size:slug}/edit', [SizeController::class, 'edit'])->name('sizes.edit');
        Route::put('sizes/{size:slug}', [SizeController::class, 'update'])->name('sizes.update');
        Route::delete('sizes/{size:slug}', [SizeController::class, 'destroy'])->name('sizes.destroy');

        // Payment
        Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create');
        Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::get('payments/{payment:slug}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
        Route::put('payments/{payment:slug}', [PaymentController::class, 'update'])->name('payments.update');
        Route::delete('payments/{payment:slug}', [PaymentController::class, 'destroy'])->name('payments.destroy');

        // Product
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('', [ProductController::class, 'store'])->name('store');
            Route::get('/{product:slug}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{product:slug}', [ProductController::class, 'update'])->name('update');
            Route::get('/{product:slug}/show', [ProductController::class, 'show'])->name('show');
            Route::delete('/{product:slug}', [ProductController::class, 'destroy'])->name('destroy');
            Route::put('/{product:slug}/to-trash', [ProductController::class, 'toTrash'])->name('to-trash');
            Route::get('/trash-list', [ProductController::class, 'trashed'])->name('trashed');
            Route::post('/{product:slug}/restore', [ProductController::class, 'restore'])->name('restore');
            Route::post('/restore', [ProductController::class, 'restoreAll'])->name('restore-all');
        });


        // Product Attribute
        Route::prefix('attributes')->name('attributes.')->group(function () {
            Route::get('/', [ProductAttributeController::class, 'index'])->name('index');
            Route::get('/{slug}', [ProductAttributeController::class, 'attributesByProduct'])->name('product');
            Route::get('/{product:slug}/create', [ProductAttributeController::class, 'create'])->name('create');
            Route::post('', [ProductAttributeController::class, 'store'])->name('store');
            Route::get('/{attribute:slug}/edit', [ProductAttributeController::class, 'edit'])->name('edit');
            Route::put('/{attribute:slug}', [ProductAttributeController::class, 'update'])->name('update');
            Route::get('/{attribute:slug}/show', [ProductAttributeController::class, 'show'])->name('show');
            Route::delete('/{attribute:slug}', [ProductAttributeController::class, 'destroy'])->name('destroy');
            Route::put('/{attribute:slug}/remove', [ProductAttributeController::class, 'remove'])->name('remove');
            Route::get('/trash-list', [ProductAttributeController::class, 'trashed'])->name('trashed');
            Route::post('/{attribute:slug}/restore', [ProductAttributeController::class, 'restore'])->name('restore');
            Route::get('/upload-photos', [ProductAttributeController::class, 'uploadPhoto'])->name('upload-photos');
        });
    });
});
