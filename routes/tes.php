<?php

use Illuminate\Support\Facades\Route;

Route::prefix('tes')->name('tes.')
    ->group(function () {
        Route::livewire('/', 'tes.index')->name('index');
        Route::livewire('/blank', 'tes.blank')->name('blank');
        
        Route::prefix('resource')->name('resource.')->group(function(){
            Route::livewire('/', 'tes.resource.index')->name('index');
            Route::livewire('/{id}/edit', 'tes.resource.edit')->name('edit');
            Route::livewire('/create', 'tes.resource.create')->name('create');
        });
    
    Route::prefix('tes')->name('tes.')->group(function () {
        Route::livewire('/', 'tes.tes.index')->name('index');
    });

});
