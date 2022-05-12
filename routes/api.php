<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::get('products/{product}', [ProductController::class, 'show'])->name('api.products.show');
Route::get('products', [ProductController::class, 'index'])->name('api.products.index');
Route::post('products', [ProductController::class, 'store'])->name('api.products.store');
Route::patch('products/{product}', [ProductController::class, 'update'])->name('api.products.update');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('api.products.destroy');
