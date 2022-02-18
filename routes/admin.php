<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('', [HomeController::class, 'index'])->middleware('can:admin.home')->name('admin.home');

Route::resource('products', ProductController::class)->names('products');

Route::resource('categories', CategoryController::class)->names('categories');

Route::resource('users', UserController::class)->except('show', 'destroy', 'store')->names('users');