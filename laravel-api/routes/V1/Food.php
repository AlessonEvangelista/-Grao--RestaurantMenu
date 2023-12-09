<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Enjoy the Silence for Foods...';
});

Route::prefix('v1')
    ->namespace('V1')
    ->controller('foodController')
    ->group(function () {
        Route::resource('', 'FoodController')->except([
            'create', 'edit',
        ])->parameters([
            '' => 'foods',
        ]);
    });
