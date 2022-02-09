<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::resource('products', ProductController::class)->names('products');

//Route::get('products/create', [ProductController::class, 'create'])->name('products.create');

Route::resource('categories', CategoryController::class)->names('categories');