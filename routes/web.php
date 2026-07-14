<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChangePasswordController;
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
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('forgotpassword', [AuthController::class, 'forgotPassword'])->name('forgotpass');
    Route::post('forgotpassword', [AuthController::class, 'postForgotPassword'])->name('forgotpass.post');

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('change-password', [ChangePasswordController::class, 'show'])->name('change-password');
        Route::post('change-password', [ChangePasswordController::class, 'update'])->name('change-password.post');

        Route::middleware('roles:1')->group(function () {
            Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
            Route::patch('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
            Route::delete('categories/{id}/forceDelete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
            Route::resource('categories', CategoryController::class);
            Route::resource('brands', BrandController::class);
            Route::resource('products', ProductController::class)->except(['index']);
        });

        Route::middleware('roles:1,2')->group(function () {
            Route::get('products', [ProductController::class, 'index'])->name('products.index');
        });
    });
});


