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
    BlogController,
    OrderController,
    DashboardController
};
use App\Http\Controllers\User\{
    OrderController as UserOrderController,
    ProfileController
};
use App\Http\Controllers\Front\{
    HomeController,
    BlogController as FrontBlogController,
    ProductController as FrontProductController,
    CartController,
    PurchaseController,
    StateCityController
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

//===================Admin route list========================
Route::group(['middleware' => ['auth', 'check_role'], 'prefix' => 'admin' ], function () {
    Route::name('admin.')->group(function () {

        // Dashboard route
        Route::get('dashboard',[DashboardController::class, 'index'])
            ->name('dashboard.index');

        // Category route
        Route::get('categories/list',[CategoryController::class, 'getCategories'])
            ->name('categories.list');
        Route::apiResource('categories', CategoryController::class);

        // Subcategory route
        Route::apiResource('subcategories', SubcategoryController::class);

        // Attribute route
        Route::apiResource('attributes', AttributeController::class);
        
        // Product route
        Route::get('products/list',[ProductController::class, 'getProducts'])
            ->name('products.list');

        Route::resource('products', ProductController::class);

        // Slider route
        Route::apiResource('sliders', SliderController::class);
        
        // Blog route
        Route::resource('blogs', BlogController::class)->except('show');

        // Order route
        Route::resource('orders', OrderController::class)->only(['index','show','update']);

    });
    
});

//===================User route list==============================
Route::group(['middleware' => ['auth'], 'prefix' => 'user' ], function () {
    Route::name('user.')->group(function () {
        // Order route
        Route::get('order',[UserOrderController::class, 'index'])->name('order.index');
        Route::get('order/{id}/details',[UserOrderController::class, 'show'])->name('order.show');
        Route::put('order/{id}/cancel',[UserOrderController::class, 'cancel'])->name('order.cancel');

        // Profile route
        Route::get('profile',[ProfileController::class, 'profile'])->name('profile.index');
        Route::put('profile/update',[ProfileController::class, 'updateProfile'])
            ->name('profile.update');

        Route::get('profile/password',[ProfileController::class, 'password'])->name('password.index');
        Route::put('profile/password',[ProfileController::class, 'changePassword'])
            ->name('password.change');
        
    });
    
});


//==============Register and login/logout route list================
Route::get('register',[RegisterController::class, 'index'])->name('register.index');
Route::post('register',[RegisterController::class, 'store'])->name('register.store');

Route::get('login',[LoginController::class, 'index'])->name('login.index');
Route::post('login',[LoginController::class, 'authenticate'])->name('login.auth');

Route::get('logout',[LoginController::class, 'logout'])->name('logout');



//==================Shop route list=====================
Route::name('front.')->group(function () {
    // Home route
    Route::get('',[HomeController::class, 'index'])->name('home.index');

    // Cart route
    Route::get('cart',[CartController::class, 'index'])->name('cart.index');
    Route::post('cart/{product}',[CartController::class, 'store'])->name('cart.store');
    Route::put('cart/{id}',[CartController::class, 'update'])->name('cart.update');
    Route::delete('cart/{id}',[CartController::class, 'destroy'])->name('cart.destroy');
    
    // Purchase route
    Route::get('state/{id}/cities',[StateCityController::class, 'getCitiesOfState'])
        ->name('state.cities');
    Route::get('purchase',[PurchaseController::class, 'index'])->name('purchase.index')
        ->middleware('auth');
    Route::post('purchase',[PurchaseController::class, 'store'])->name('purchase.store')
        ->middleware('auth');

    // Blog route
    Route::get('blog',[FrontBlogController::class, 'index'])->name('blog.index');
    Route::get('blog/{blog:slug}',[FrontBlogController::class, 'show'])->name('blog.show');

    // Product search route
    Route::get('search',[FrontProductController::class, 'search'])->name('product.search');
    // Review product
    Route::post('p/{product}/review',[FrontProductController::class, 'review'])
        ->name('product.review')->middleware('auth');
    // Product details route
    Route::get('p/{product:slug}',[FrontProductController::class, 'show'])->name('product.show');
    // All product route
    Route::get('products',[FrontProductController::class, 'index'])->name('product.all');
    // Product by category route
    Route::get('{category:slug}',[FrontProductController::class, 'cateProduct'])
        ->name('product.category');
    // Product by subcategory route
    Route::get('{category:slug}/{subcategory:slug}',[FrontProductController::class, 'subProduct'])
        ->name('product.subcategory');
});