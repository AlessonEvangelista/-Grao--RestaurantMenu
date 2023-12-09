<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Enjoy the Silence for Categories...';
});

Route::prefix('v1')
    ->namespace('V1')
    ->controller('categoryController')
    ->group(function () {
        Route::resource('', 'CategoryController')->except([
            'create', 'edit',
        ])->parameters([
            '' => 'category',
        ]);
    });
