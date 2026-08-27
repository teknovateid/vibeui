<?php

use Illuminate\Support\Facades\Route;

Route::prefix('docs')->name('docs.')->group(function () {

    Route::view('/', 'docs.index')->name('index');
    
    Route::prefix('instalation')->name('instalation.')->group(function () {
        Route::view('/', 'docs.instalation.index')->name('index');
        Route::view('/create', 'docs.instalation.create')->name('create');
        Route::view('/{id}/edit', 'docs.instalation.edit')->name('edit');
    });


    Route::prefix('blank')->name('blank.')->group(function () {
        Route::view('/', 'docs.blank.index')->name('index');
    });

});
