<?php

use Illuminate\Support\Facades\Route;

Route::prefix('[path]')->name('[path].')->group(function () {
    Route::livewire('/', '[path].index')->name('index');
});
