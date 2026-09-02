<?php

use Illuminate\Support\Facades\Route;

Route::prefix('docs')->name('docs.')->group(function () {
    Route::view('/', 'docs.index')->name('index');
    Route::view('/instalation', 'docs.instalation.index')->name('instalation.index');
    Route::view('/directories', 'docs.directories.index')->name('directories.index');
    Route::view('/input', 'docs.input.index')->name('input.index');
    Route::view('/button', 'docs.button.index')->name('button.index');
    Route::view('/table', 'docs.table.index')->name('table.index');
    Route::view('/datatable', 'docs.datatable.index')->name('datatable.index');

    Route::prefix('alert')->name('alert.')->group(function () {
        Route::view('/', 'docs.alert.index')->name('index');
    });


    Route::prefix('toast')->name('toast.')->group(function () {
        Route::view('/', 'docs.toast.index')->name('index');
    });

});

Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['id', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('locale.switch');

