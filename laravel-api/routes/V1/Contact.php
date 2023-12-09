<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Enjoy the Silence for Contacts...';
});

Route::prefix('v1')
    ->namespace('V1')
    ->controller('contactsController')
    ->group(function () {
        Route::resource('', 'ContactsController')->except([
            'create', 'edit',
        ])->parameters([
            '' => 'contacts',
        ]);
    });
