<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;

Route::prefix('[path]')->name('[path].')->group(function () {

    // --------------------------------------------------------------------------
    // 1. Route View (Blade View Murni — 100% SPA via wire:navigate)
    // --------------------------------------------------------------------------
    Route::view('/', '[path].index')->name('index');

    // Contoh sub-halaman menggunakan Route::view:
    // Route::prefix('blank')->name('blank.')->group(function () {
    //     Route::view('/', '[path].blank.index')->name('index');
    // });

    // --------------------------------------------------------------------------
    // 2. Route Controller (Mengambil data via Controller — tetap 100% SPA via wire:navigate)
    // --------------------------------------------------------------------------
    // Route::prefix('user')->name('user.')->group(function () {
    //     Route::get('/', [UserController::class, 'index'])->name('index');
    //     Route::get('/create', [UserController::class, 'create'])->name('create');
    //     Route::post('/', [UserController::class, 'store'])->name('store');
    //     Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
    //     Route::put('/{id}', [UserController::class, 'update'])->name('update');
    //     Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    // });

});
