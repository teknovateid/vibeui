<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;

Route::prefix('[path]')->name('[path].')->group(function () {

    // --------------------------------------------------------------------------
    // 1. Route View (Blade View Murni — 100% SPA via wire:navigate)
    // --------------------------------------------------------------------------
    Route::view('/', '[path].index')->name('index');

    // --------------------------------------------------------------------------
    // 2. Pengaturan Akun & Tampilan (Settings)
    // --------------------------------------------------------------------------
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', function () {
            return \Illuminate\Support\Facades\Auth::check()
                ? redirect('/[path]/settings/account')
                : redirect('/[path]/settings/appearance');
        })->name('index');
        Route::view('/appearance', '[path].settings.appearance')->name('appearance');
        Route::view('/notifications', '[path].settings.notifications')->name('notifications');

        Route::middleware(['auth', 'verified'])->group(function () {
            Route::view('/account', '[path].settings.account')->name('account');
            Route::view('/security', '[path].settings.security')
                ->middleware('confirm')
                ->name('security');
            Route::view('/login-history', '[path].settings.login-history')
                ->middleware('idle:300')
                ->name('login-history');
        });
    });

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
