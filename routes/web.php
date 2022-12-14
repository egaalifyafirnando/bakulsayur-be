<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

/**
 * route for admin
 */

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function () {

        // ROUTE DASHBOARD
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        // ROUTE CATEGORY
        Route::resource('/category', CategoryController::class, ['as' => 'admin']);

        // ROUTE PRODUCT
        Route::resource('/product', ProductController::class, ['as' => 'admin']);

        // ROUTE ORDER
        Route::resource('/order', OrderController::class, ['except' => ['create', 'store', 'edit', 'destroy'], 'as' => 'admin']);

        // ROUTE CUSTOMER
        Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer.index');

        // ROUTE SLIDER
        Route::resource('/slider', SliderController::class, ['except' => ['create', 'edit', 'update', 'show'], 'as' => 'admin']);

        // ROUTE PROFILE
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');

        // ROUTE USER
        Route::resource('/user', UserController::class, ['except' => ['show'], 'as' => 'admin']);
    });
});
