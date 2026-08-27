<?php

use Illuminate\Support\Facades\Route;

Route::prefix('[path]')->name('[path].')->group(function () {
    Route::view('/', '[path].index')->name('index');
});
