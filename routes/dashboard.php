<?php

use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group(function () {
    Route::livewire('/', 'dashboard.index')->name('index');

    Route::prefix('product')->name('product.')->group(function () {
        Route::livewire('/', 'dashboard.product.index')->name('index');
    });


    Route::prefix('user')->name('user.')->group(function () {
        Route::livewire('/', 'dashboard.user.index')->name('index');
    });

});
