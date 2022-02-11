<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::resource('/', HomeController::class);

Route::resource('products', ProductController::class)->names('products');

Route::resource('categories', CategoryController::class)->names('categories');