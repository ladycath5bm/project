<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class)->names('api.products');

Route::post('register', [AuthController::class, 'register'])->name('api.users.register');
Route::post('login', [AuthController::class, 'login'])->name('api.users.login');
Route::middleware('auth:sanctum')
    ->post('logout', [AuthController::class, 'logout'])
    ->name('api.users.logout');
