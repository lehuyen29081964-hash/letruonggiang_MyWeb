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

use App\Http\Middleware\Authenticate as AuthMiddleware;

Route::prefix('admin')->name('admin.')->middleware(AuthMiddleware::class)->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');

    // Change password
    Route::get('/change-password', [App\Http\Controllers\ChangePasswordController::class, 'show'])->name('change-password');
    Route::post('/change-password', [App\Http\Controllers\ChangePasswordController::class, 'update'])->name('change-password.post');

    // Admin-only resources (role = 1)
    Route::middleware(App\Http\Middleware\RoleMiddleware::class . ':1')->group(function () {
        Route::get('/categories/trash', [App\Http\Controllers\Admin\CategoryController::class, 'trash'])->name('categories.trash');
        Route::patch('/categories/{id}/restore', [App\Http\Controllers\Admin\CategoryController::class, 'restore'])->name('categories.restore');
        Route::delete('/categories/{id}/forceDelete', [App\Http\Controllers\Admin\CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('products', ProductController::class);
    });
});


