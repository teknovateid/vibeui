<?php

use Illuminate\Support\Facades\Route;

Route::prefix('tes')->name('tes.')->group(function () {
    Route::livewire('/', 'tes.index')->name('index');

    Route::prefix('useers')->name('useers.')->group(function () {
        Route::livewire('/', 'tes.useers.index')->name('index');
    });


    Route::prefix('user')->name('user.')->group(function () {
        Route::livewire('/', 'tes.user.index')->name('index');
    });


    Route::prefix('user')->name('user.')->group(function () {
        Route::livewire('/', 'tes.user.index')->name('index');
    });


    Route::prefix('user')->name('user.')->group(function () {
        Route::livewire('/', 'tes.user.index')->name('index');
    });

});
