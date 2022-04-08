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

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index'); 

Route::get('products/index', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('products/index/{category}', [ProductController::class, 'showByCategory'])->name('products.showbycategory');
Route::get('/top', [ProductController::class, 'top'])->name('top');

//Route::resource('cart', ShoppingCartController::class)->only('index', 'store')->names('cart');
Route::get('cart', [ShoppingCartController::class, 'index'])->name('cart.index');
Route::post('cart', [ShoppingCartController::class, 'store'])->name('cart.store');
Route::get('cart/checkout', [ShoppingCartController::class, 'checkout'])->name('cart.checkout');
Route::patch('cart/update/{product}', [ShoppingCartController::class, 'update'])->name('cart.update');

Route::delete('cart/clear', [ShoppingCartController::class, 'clear'])->name('cart.clear');
Route::delete('cart/{cart}', [ShoppingCartController::class, 'remove'])->name('cart.remove');

Route::get('/pay/{order}', [PaymentController::class, 'pay'])->name('pay');
Route::get('pay/consult/{order}', [PaymentController::class, 'consult'])->name('consult');
Route::get('pay/retray/{order}', [PaymentController::class, 'retray'])->name('retray');
Route::get('pay/cancel/{order}', [PaymentController::class, 'cancel'])->name('cancel');

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

//Route::resource('/orders', OrderController::class)->names('orders')->except('destroy');



