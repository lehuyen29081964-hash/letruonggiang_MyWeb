<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;

Route::get('/demo', [DemoController::class, 'index']);

Route::get('/demo2', [DemoController::class, 'index2']);

Route::get('/demo3', [DemoController::class, 'index3']);

Route::get('/demo4/{id}', [DemoController::class, 'index4']);

Route::get('/demo5/{id?}', [DemoController::class, 'index5']);

Route::get('/demo6/{parram1}/{parram2}', [DemoController::class, 'index6']);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('home');

    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);
});


