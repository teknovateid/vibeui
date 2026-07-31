<?php

use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group(function () {
    Route::livewire('/', 'dashboard.index')->name('index');
});
