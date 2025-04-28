<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Agricultural_productController;
use App\Http\Controllers\ViewController;

Route::middleware(['auth', 'active'])->group(function () {

    // view routes
    Route::get('/view', [ViewController::class, 'index'])->name('view.index');

    // routes only for role_id == 2
    Route::middleware('role:2')->group(function () {

        // Category routes
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category_update/{category}', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/category_add', [CategoryController::class, 'add'])->name('category.add');
        Route::post('/category_store', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/category_edit/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category_destroy/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

        // User routes
        Route::get('/users_index', [UserController::class, 'index'])->name('user.index');
        Route::delete('/user_destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::patch('/users/{user}/update-status', [UserController::class, 'updateStatus'])->name('users.update-status');
        Route::patch('/users/{user}/update-role', [UserController::class, 'updateRole'])->name('users.update-role');

        // Product routes
        Route::get('/products', [Agricultural_productController::class, 'index'])->name('agricultural_product.index');
        Route::get('/product_add', [Agricultural_productController::class, 'add'])->name('product.add');
        Route::get('/product_edit/{agricultural_product}', [Agricultural_productController::class, 'show'])->name('agricultural_product.show');
        Route::patch('/product/{agricultural_product}/edit', [Agricultural_productController::class, 'update'])->name('product.update');
        Route::post('/product_store', [Agricultural_productController::class, 'store'])->name('product.store');
        Route::delete('/product/{agricultural_product}/destroy', [Agricultural_productController::class, 'destroy'])->name('product.destroy');
    });

});
