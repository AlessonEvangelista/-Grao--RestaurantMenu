<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Enjoy the Silence for Restaurant...';
});

Route::prefix('v1')
    ->namespace('V1')
    ->controller('restaurantController')
    ->group(function () {
        Route::resource('', 'RestaurantController')->except([
            'create', 'edit',
        ])->parameters([
            '' => 'restaurant',
        ]);
    });
