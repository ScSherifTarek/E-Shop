<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterationController;

Route::post('/register', [RegisterationController::class, 'store']);

Route::middleware('auth.basic.once')
    ->group(function() {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

