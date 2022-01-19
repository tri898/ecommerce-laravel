<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{
    RegisterController,
    LoginController
};
use App\Http\Controllers\Admin\{
    CategoryController,
    SubcategoryController,
    AttributeController,
    ProductController,
    SliderController,
    BlogController
};
use App\Http\Controllers\Front\{
    HomeController,
    BlogController as FrontBlogController,
    ProductController as FrontProductController
};


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

// Register and login/logout route
Route::get('register',[RegisterController::class, 'index'])->name('register.index');
Route::post('register',[RegisterController::class, 'store'])->name('register.store');
Route::get('login',[LoginController::class, 'index'])->name('login.index');
Route::post('login',[LoginController::class, 'authenticate'])->name('login.auth');
Route::get('logout',[LoginController::class, 'logout'])->name('logout');

// Public route
Route::name('front.')->group(function () {
    Route::get('',[HomeController::class, 'index'])->name('home.index');
    // Blog route
    Route::get('/blog',[FrontBlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{blog:slug}',[FrontBlogController::class, 'show'])->name('blog.show');
    // Product route
    Route::get('/p/{product:slug}',[FrontProductController::class, 'show'])->name('product.show');

});



// Admin route list
Route::group(['middleware' => ['auth', 'check_role'], 'prefix' => 'admin' ], function () {
    Route::name('admin.')->group(function () {
        // Dashboard route
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard.index');
        // Category route
        Route::get('categories/list',[CategoryController::class, 'getCategories'])->name('categories.list');
        Route::apiResource('categories', CategoryController::class);
        // Subcategory route
        Route::apiResource('subcategories', SubcategoryController::class);
        // Attribute route
        Route::apiResource('attributes', AttributeController::class);
        // Product route
        Route::get('products/list',[ProductController::class, 'getProducts'])->name('products.list');
        Route::resource('products', ProductController::class);
        // Slider route
        Route::apiResource('sliders', SliderController::class);
        // Blog route
        Route::resource('blogs', BlogController::class)->except('show');

    });
    
});