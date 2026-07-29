<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')
    ->group(function () {
        Route::livewire('/', 'admin.index')->name('index');
        Route::livewire('/blank', 'admin.blank')->name('blank');
        
        Route::prefix('resource')->name('resource.')->group(function(){
            Route::livewire('/', 'admin.resource.index')->name('index');
            Route::livewire('/{id}/edit', 'admin.resource.edit')->name('edit');
            Route::livewire('/create', 'admin.resource.create')->name('create');
        });
    });
