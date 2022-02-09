<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;


Route::get('/', function (): View {
    return view('welcome');
});

//Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

