<?php

use Illuminate\Support\Facades\Route;

Route::prefix('docs')->name('docs.')->group(function () {
    Route::livewire('/', 'docs.index')->name('index');
});
