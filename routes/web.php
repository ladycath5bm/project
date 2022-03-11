<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;


Route::get('/', function (){
    $categories = Category::all();
    return view('welcome', compact('categories'));
})->name('welcome');

Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('products/index', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('products/index/{category}', [ProductController::class, 'showByCategory'])->name('products.showbycategory');

Route::resource('cart', ShoppingCartController::class)->except('create', 'show', 'update', 'edit')->names('cart');

Route::post('cart', [ShoppingCartController::class, 'store'])->name('cart.store');

Route::post('cart/clear', [ShoppingCartController::class, 'clear'])->name('cart.clear');

Route::post('/pay', [PaymentController::class, 'pay'])->name('pay');

Route::get('/consult', [PaymentController::class, 'consult'])->name('consult');
