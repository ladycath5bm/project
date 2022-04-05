<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::all();
    return view('welcome', compact('categories'));
})->name('welcome');

Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('products/index', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('products/index/{category}', [ProductController::class, 'showByCategory'])->name('products.showbycategory');
Route::get('products/top', [ProductController::class, 'top'])->name('products.top');


Route::resource('cart', ShoppingCartController::class)->only('index', 'store')->names('cart');

Route::post('cart', [ShoppingCartController::class, 'store'])->name('cart.store');

Route::delete('cart/clear', [ShoppingCartController::class, 'clear'])->name('cart.clear');

Route::delete('cart/{cart}', [ShoppingCartController::class, 'remove'])->name('cart.remove');

Route::post('cart/checkout', [ShoppingCartController::class, 'checkout'])->name('cart.checkout');

Route::post('/pay', [PaymentController::class, 'pay'])->name('pay');

Route::get('/consult/{order}', [PaymentController::class, 'consult'])->name('consult');

Route::get('/retray/{order}', [PaymentController::class, 'retray'])->name('retray');

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});


Route::resource('/orders', OrderController::class)->names('orders')->except('destroy');

Route::get('orders/cancel/{order}', [OrderController::class, 'cancel'])->name('orders.cancel');

