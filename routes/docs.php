<?php

use Illuminate\Support\Facades\Route;

Route::prefix('docs')->name('docs.')->group(function () {
    Route::view('/', 'docs.index')->name('index');
    Route::view('/instalation', 'docs.instalation.index')->name('instalation.index');
    Route::view('/directories', 'docs.directories.index')->name('directories.index');
    Route::view('/input', 'docs.input.index')->name('input.index');
    Route::view('/select', 'docs.select.index')->name('select.index');
    Route::view('/button', 'docs.button.index')->name('button.index');
    Route::view('/table', 'docs.table.index')->name('table.index');
    Route::view('/datatable', 'docs.datatable.index')->name('datatable.index');
    Route::view('/modal', 'docs.modal.index')->name('modal.index');
    Route::view('/alert', 'docs.alert.index')->name('alert.index');
    Route::view('/toast', 'docs.toast.index')->name('toast.index');
    Route::view('/sheet', 'docs.sheet.index')->name('sheet.index');


});


Route::view('/', 'docs.index');

Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['id', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('locale.switch');

