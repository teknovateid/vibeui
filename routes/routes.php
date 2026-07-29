<?php

use Illuminate\Support\Facades\Route;

Route::prefix('[path]')->name('[path].')
    ->group(function () {
        Route::livewire('/', '[path].index')->name('index');
        Route::livewire('/blank', '[path].blank')->name('blank');
        
        Route::prefix('resource')->name('resource.')->group(function(){
            Route::livewire('/', '[path].resource.index')->name('index');
            Route::livewire('/{id}/edit', '[path].resource.edit')->name('edit');
            Route::livewire('/create', '[path].resource.create')->name('create');
        });
    });
