<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;


Route::get('/', function (){
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('products/index', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('products/index/{category}', [ProductController::class, 'showByCategory'])->name('products.showbycategory');


Route::get('test', function(){
    $test = 'hhhh';
    echo phpinfo();
});