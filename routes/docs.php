<?php

use Illuminate\Support\Facades\Route;

Route::prefix('docs')->name('docs.')->group(function () {

    Route::prefix('instalation')->name('instalation.')->group(function () {
        Route::view('/', 'docs.instalation.index')->name('index');
    });

});
