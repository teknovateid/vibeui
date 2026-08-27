<?php

use Illuminate\Support\Facades\Route;

Route::prefix('docs')->name('docs.')->group(function () {

    Route::livewire('/', 'docs.index')->name('index');
    
    Route::prefix('instalation')->name('instalation.')->group(function () {
        Route::livewire('/', 'docs.instalation.index')->name('index');
        Route::livewire('/create', 'docs.instalation.create')->name('create');
        Route::livewire('/{id}/edit', 'docs.instalation.edit')->name('edit');
    });


    Route::prefix('blank')->name('blank.')->group(function () {
        Route::livewire('/', 'docs.blank.index')->name('index');
    });

});
