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

// Register and login route
Route::get('register',[RegisterController::class, 'index'])->name('register.index');
Route::post('register',[RegisterController::class, 'store'])->name('register.store');
Route::get('login',[LoginController::class, 'index'])->name('login.index');
Route::post('login',[LoginController::class, 'authenticate'])->name('login.auth');
Route::get('logout',[LoginController::class, 'logout'])->name('logout');

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

    Route::apiResource('subcategories', SubcategoryController::class);

    Route::apiResource('attributes', AttributeController::class);

    Route::resource('products', ProductController::class);
    });
    
    
    
});