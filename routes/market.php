<?php

use App\Http\Controllers\Agricultural_productController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MarketPriceReportController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;


Route::get('tip_view', function () {

    $tips = \App\Models\Tips::paginate(9);


    return view('tipview', ['tips' => $tips]);
})->name('tip.view');


Route::middleware(['auth', 'active'])->group(function () {

    // view routes
    Route::get('/view', [ViewController::class, 'index'])->name('view.index');

    // routes only for role_id == 2
    Route::middleware('role:2')->group(function () {

        Route::prefix('market-prices')->group(function () {
            Route::prefix('reports')->group(function () {
                Route::get('/', [MarketPriceReportController::class, 'index'])->name('market-prices.reports.index');
                Route::post('/generate', [MarketPriceReportController::class, 'generate'])->name('market-prices.reports.generate');
            });
        });

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


        //tips route
        Route::get('tip_add', [TipsController::class, 'add'])->name('tips.add');
        Route::get('/tips', [TipsController::class, 'index'])->name('tips.index');
        Route::post('/tips/store', [TipsController::class, 'store'])->name('tips.store');
        Route::get('/tip_show/{tip}', [TipsController::class, 'show'])->name('tips.show');
        Route::put('/tip_update/{tip}', [TipsController::class, 'update'])->name('tips.update');
        Route::delete('/tip_delete/{tip}', [TipsController::class, 'destroy'])->name('tips.destroy');

    });

});
