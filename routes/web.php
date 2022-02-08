<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;


Route::get('/', function (): View {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function (): View {
    return view('dashboard');
})->name('dashboard');

Route::get('products/index', [ProductController::class, 'index'])->name('products.index');