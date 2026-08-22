<?php

use Illuminate\Support\Facades\Route;

Route::prefix('tes')->name('tes.')->group(function () {
    Route::livewire('/', 'tes.index')->name('index');
});
