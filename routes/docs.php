<?php

use Illuminate\Support\Facades\Route;

Route::prefix('docs')->name('docs.')->group(function () {
    Route::view('/', 'docs.index')->name('index');
    Route::view('/instalation', 'docs.instalation.index')->name('instalation.index');
    Route::view('/directories', 'docs.directories.index')->name('directories.index');
    Route::view('/input', 'docs.input.index')->name('input.index');
    Route::view('/button', 'docs.button.index')->name('button.index');
});
