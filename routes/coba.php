<?php

use Illuminate\Support\Facades\Route;

Route::prefix('coba')->name('coba.')->group(function () {
    Route::livewire('/', 'coba.index')->name('index');

    Route::prefix('user')->name('user.')->group(function () {
        Route::livewire('/', 'coba.user.index')->name('index');
    });


    Route::prefix('user')->name('user.')->group(function () {
        Route::livewire('/', 'coba.user.index')->name('index');
    });

});
