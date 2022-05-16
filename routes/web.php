<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NofiticationController;
use App\Http\Controllers\ShoppingCartController;

Route::get('/', function () {
    $categories = Category::all();
    return view('welcome', compact('categories'));
})->name('welcome');

Route::middleware(['auth', 'role:custom'])
    ->group(function () {
        Route::get('/orders/report/{order}', [OrderController::class, 'generateReport'])
            ->name('orders.report');
        Route::post('/orders', [OrderController::class, 'store'])
            ->name('orders.store');
        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])
            ->name('orders.show');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])
            ->name('orders.destroy');

        Route::get('products/index', [ProductController::class, 'index'])
            ->name('products.index');
        Route::get('products/{product}', [ProductController::class, 'show'])
            ->name('products.show');
        Route::get('products/index/{category}', [ProductController::class, 'showByCategory'])
            ->name('products.showbycategory');
        Route::get('/top', [ProductController::class, 'top'])
            ->name('top');

        Route::get('cart', [ShoppingCartController::class, 'index'])
            ->name('cart.index');
        Route::post('cart', [ShoppingCartController::class, 'store'])
            ->name('cart.store');
        Route::get('cart/checkout', [ShoppingCartController::class, 'checkout'])
            ->name('cart.checkout');
        Route::post('cart/update/', [ShoppingCartController::class, 'update'])
            ->name('cart.update');

        Route::delete('cart/clear', [ShoppingCartController::class, 'clear'])
            ->name('cart.clear');
        Route::delete('cart/{cart}', [ShoppingCartController::class, 'remove'])
            ->name('cart.remove');

        Route::get('/pay/{order}', [PaymentController::class, 'pay'])
            ->name('payments.pay');
        Route::get('pay/retray/{order}', [PaymentController::class, 'retray'])
            ->name('payments.retray');
        Route::get('pay/cancel/{order}', [PaymentController::class, 'cancel'])
            ->name('payments.cancel');
        Route::get('pay/{reference}/complete', [PaymentController::class, 'complete'])
            ->name('payments.complete');

        Route::get('notifications/read/all', [NofiticationController::class, 'readAll'])
            ->name('notifications.readall');
        Route::get('notifications/', [NofiticationController::class, 'index'])
            ->name('notifications.index');
        Route::get('notifications/{notification}', [NofiticationController::class, 'read'])
            ->name('notifications.read');
});