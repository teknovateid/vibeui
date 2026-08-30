<?php

use Illuminate\Support\Facades\Route;

Route::prefix('docs')->name('docs.')->group(function () {

    Route::view('/', 'docs.index')->name('index');

    Route::prefix('instalation')->name('instalation.')->group(function () {
        Route::view('/', 'docs.instalation.index')->name('index');
    });


    Route::prefix('input')->name('input.')->group(function () {
        Route::view('/', 'docs.input.index')->name('index');
    });


    Route::prefix('input')->name('input.')->group(function () {
        Route::view('/', 'docs.input.index')->name('index');
        Route::view('/create', 'docs.input.create')->name('create');
        Route::view('/{id}/edit', 'docs.input.edit')->name('edit');
    });

});
