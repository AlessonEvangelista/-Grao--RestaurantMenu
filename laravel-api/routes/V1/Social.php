<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Enjoy the Silence for Socials...';
});

Route::prefix('v1')
    ->namespace('V1')
    ->controller('socialController')
    ->group(function () {
        Route::resource('', 'SocialController')->except([
            'create', 'edit',
        ])->parameters([
            '' => 'social',
        ]);
    });
