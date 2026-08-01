<?php

use Illuminate\Support\Facades\Route;

Route::prefix('hehe')->name('hehe.')->group(function () {
    Route::livewire('/', 'hehe.index')->name('index');

    Route::prefix('user')->name('user.')->group(function () {
        Route::livewire('/', 'hehe.user.index')->name('index');
    });

});
