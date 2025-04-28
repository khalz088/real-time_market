<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


//category routes
Route::get('/category', [\App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
Route::get('/category_update/{category}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');
Route::get('/category_add', [\App\Http\Controllers\CategoryController::class, 'add'])->name("category.add");
Route::post('/category_store', [\App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
Route::put('/category_edit/{category}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
Route::delete('/category_destroy/{category}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.destroy');


// user routes

Route::get('/users_index', [\App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::delete('/user_destroy/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
Route::patch('/users/{user}/update-status', [\App\Http\Controllers\UserController::class, 'updateStatus'])->name('users.update-status');
Route::patch('/users/{user}/update-role', [\App\Http\Controllers\UserController::class, 'updateRole'])->name('users.update-role');


