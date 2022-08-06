<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterationController;

Route::post('/register', [RegisterationController::class, 'store']);

Route::middleware(['auth.basic.once', 'locale.set'])
    ->group(function() {
        Route::get('/products', [ProductController::class, 'index']);
        Route::post('/products', [ProductController::class, 'store']);
        Route::patch('/cart', [CartController::class, 'add']);
    });

