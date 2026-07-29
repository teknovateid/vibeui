<?php

use Illuminate\Support\Facades\Route;

Route::name('landing.')
    ->group(function () {
        Route::livewire('/', 'landing.index')->name('index');
        Route::livewire('/blank', 'landing.blank')->name('blank');
        
        Route::prefix('resource')->name('resource.')->group(function(){
            Route::livewire('/', 'landing.resource.index')->name('index');
            Route::livewire('/{id}/edit', 'landing.resource.edit')->name('edit');
            Route::livewire('/create', 'landing.resource.create')->name('create');
        });
    });
