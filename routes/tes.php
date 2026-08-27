<?php

use Illuminate\Support\Facades\Route;

Route::prefix('tes')->name('tes.')->group(function () {
    Route::view('/', 'tes.index')->name('index');
});
