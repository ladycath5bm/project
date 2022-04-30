<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductModulesController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware('can:admin.home')->name('admin.home');

Route::resource('products', ProductController::class)->names('products');
Route::get('list/', [ProductController::class, 'list'])->name('products.list');

Route::resource('categories', CategoryController::class)->names('categories');

Route::resource('users', UserController::class)->except('show', 'destroy', 'store')->names('users');

Route::get('export/', [ProductModulesController::class, 'export'])->name('products.export');
Route::get('report/', [ProductModulesController::class, 'report'])->name('products.reports');
Route::post('import/', [ProductModulesController::class, 'import'])->name('products.import');
Route::get('module/', [ProductModulesController::class, 'index'])->name('products.module');

Route::get('exports/', [ProductModulesController::class, 'exportFile'])->name('exports.file');
