<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;

Route::get('/', function () {
    return view('welcome');
});

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
            Route::patch('categories/restore-all', [CategoryController::class, 'restoreAll'])->name('categories.restoreAll');
            Route::delete('categories/{id}/forceDelete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
            Route::delete('categories/force-delete-all', [CategoryController::class, 'forceDeleteAll'])->name('categories.forceDeleteAll');
            Route::resource('categories', CategoryController::class);

            Route::get('brands/trash', [BrandController::class, 'trash'])->name('brands.trash');
            Route::patch('brands/{id}/restore', [BrandController::class, 'restore'])->name('brands.restore');
            Route::patch('brands/restore-all', [BrandController::class, 'restoreAll'])->name('brands.restoreAll');
            Route::delete('brands/{id}/forceDelete', [BrandController::class, 'forceDelete'])->name('brands.forceDelete');
            Route::delete('brands/force-delete-all', [BrandController::class, 'forceDeleteAll'])->name('brands.forceDeleteAll');
            Route::resource('brands', BrandController::class);

            Route::get('products/trash', [ProductController::class, 'trash'])->name('products.trash');
            Route::patch('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
            Route::patch('products/restore-all', [ProductController::class, 'restoreAll'])->name('products.restoreAll');
            Route::delete('products/{id}/forceDelete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
            Route::delete('products/force-delete-all', [ProductController::class, 'forceDeleteAll'])->name('products.forceDeleteAll');
            Route::resource('products', ProductController::class)->except(['index']);
        });

        Route::middleware('roles:1,2')->group(function () {
            Route::get('products', [ProductController::class, 'index'])->name('products.index');
        });
    });
});


