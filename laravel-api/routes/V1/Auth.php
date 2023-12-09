<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Authenticating...';
});

Route::prefix('v1')
    ->namespace('V1')
    ->controller('AuthController')
    ->group(function () {
        Route::post('login', 'login');
    });

Route::middleware('auth:sanctum')
    ->prefix('v1')
    ->namespace('V1')
    ->controller('AuthController')
    ->group(function () {
        Route::post('logout', 'logout');
    });
