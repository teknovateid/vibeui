<?php

use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::livewire('/', 'dashboard.index')->name('index');
        Route::livewire('/blank', 'dashboard.blank')->name('blank');
        
        Route::prefix('resource')->name('resource.')->group(function(){
            Route::livewire('/', 'dashboard.resource.index')->name('index');
            Route::livewire('/{id}/edit', 'dashboard.resource.edit')->name('edit');
            Route::livewire('/create', 'dashboard.resource.create')->name('create');
        });
    
    Route::prefix('product')->name('product.')->group(function () {
        Route::livewire('/', 'dashboard.product.index')->name('index');
        Route::livewire('/create', 'dashboard.product.create')->name('create');
        Route::livewire('/{id}/edit', 'dashboard.product.edit')->name('edit');
    });

});
