<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Enjoy the Silence for People...';
});

Route::prefix('v1')
    ->namespace('V1')
    ->controller('userController')
    ->group(function () {
        Route::resource('', 'UserController')->except([
            'create', 'edit', 'store', 'destroy',
        ])->parameters([
            '' => 'id',
        ]);
    });
