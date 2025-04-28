<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('category', [\App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
