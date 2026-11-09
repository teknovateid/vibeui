<?php

use Illuminate\Support\Facades\Route;
use Teknovate\VibeUi\Http\Controllers\ThemeSettingController;

Route::middleware(['web'])->prefix('vibe-api/theme')->name('vibe.theme.')->group(function () {
    Route::get('/global', [ThemeSettingController::class, 'show'])->name('global.show');
    Route::post('/global', [ThemeSettingController::class, 'save'])->name('global.save');
    Route::post('/global/reset', [ThemeSettingController::class, 'reset'])->name('global.reset');
});
