<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;

Route::get('/demo', [DemoController::class, 'index']);

Route::get('/demo2', [DemoController::class, 'index2']);

Route::get('/demo3', [DemoController::class, 'index3']);

Route::get('/demo4/{id}', [DemoController::class, 'index4']);

Route::get('/demo5/{id?}', [DemoController::class, 'index5']);

Route::get('/demo6/{parram1}/{parram2}', [DemoController::class, 'index6']);

// Authentication routes
Route::get('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('forgotpassword', [AuthController::class, 'forgotPassword'])->name('forgotpassword');
Route::post('forgotpassword', [AuthController::class, 'postForgotPassword'])->name('postForgotPassword');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');

    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);
});


