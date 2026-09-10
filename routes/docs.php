<?php

use App\Http\Controllers\DashboardPageController;
use App\Http\Controllers\FilepondController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::prefix('docs')->name('docs.')->group(function () {
    Route::view('/', 'docs.index')->name('index');
    Route::view('/instalation', 'docs.instalation.index')->name('instalation.index');
    Route::view('/design-system', 'docs.design-system.index')->name('design-system.index');
    Route::view('/directories', 'docs.directories.index')->name('directories.index');
   
    Route::prefix('form')->name('form.')->group(function () {
        Route::get('/', [FormController::class, 'index'])->name('index');
        Route::post('/', [FormController::class, 'store'])->name('store');
    });

    Route::view('/input', 'docs.input.index')->name('input.index');
    Route::view('/textarea', 'docs.textarea.index')->name('textarea.index');
    Route::view('/select', 'docs.select.index')->name('select.index');
    Route::view('/checkbox', 'docs.checkbox.index')->name('checkbox.index');
    Route::view('/radio', 'docs.radio.index')->name('radio.index');
    Route::view('/switch', 'docs.switch.index')->name('switch.index');
    Route::view('/range', 'docs.range.index')->name('range.index');
    Route::view('/date-time', 'docs.date-time.index')->name('date-time.index');
    Route::view('/dynamic-form', 'docs.dynamic-form.index')->name('dynamic-form.index');

    Route::prefix('filepond')->name('filepond.')->group(function () {
        Route::get('/', [FilepondController::class, 'index'])->name('index');
        Route::post('/store', [FilepondController::class, 'requestTest'])->name('store');
        Route::post('/request-test', [FilepondController::class, 'requestTest'])->name('request_test');
        Route::post('/presigned', [FilepondController::class, 'presigned'])->name('presigned');
        Route::put('/local-upload/{key}', [FilepondController::class, 'localUpload'])->name('local_upload');
    });
    
    Route::view('/button', 'docs.button.index')->name('button.index');
    Route::view('/dropdown', 'docs.dropdown.index')->name('dropdown.index');
    Route::view('/badge', 'docs.badge.index')->name('badge.index');
    Route::view('/avatar', 'docs.avatar.index')->name('avatar.index');
    Route::view('/image', 'docs.image.index')->name('image.index');
    Route::view('/card', 'docs.card.index')->name('card.index');
    Route::view('/grid-list', 'docs.grid-list.index')->name('grid-list.index');
    Route::view('/header', 'docs.header.index')->name('header.index');
    Route::view('/nav', 'docs.nav.index')->name('nav.index');
    Route::view('/breadcrumb', 'docs.breadcrumb.index')->name('breadcrumb.index');
    Route::view('/table', 'docs.table.index')->name('table.index');
    Route::view('/grid', 'docs.grid.index')->name('grid.index');
    Route::view('/datatable', 'docs.datatable.index')->name('datatable.index');
    Route::view('/modal', 'docs.modal.index')->name('modal.index');
    Route::view('/alert', 'docs.alert.index')->name('alert.index');
    Route::view('/toast', 'docs.toast.index')->name('toast.index');
    Route::view('/sheet', 'docs.sheet.index')->name('sheet.index');
    Route::view('/tabs', 'docs.tabs.index')->name('tabs.index');
    Route::view('/highlightjs', 'docs.highlightjs.index')->name('highlightjs.index');
    
    Route::get('/chart', function () {
        $monthlyMetrics = \App\Models\SalesMetric::where('category', 'Semua Kategori')->orderBy('id')->get();
        $categoryMetrics = \App\Models\SalesMetric::where('month', 'Total')->orderByDesc('revenue')->get();

        return view('docs.chart.index', compact('monthlyMetrics', 'categoryMetrics'));
    })->name('chart.index');

    Route::get('/dashboard/{view}',[DashboardPageController::class,'show'])->name('dashboard.show');
    Route::view('/settings', 'docs.settings.index')->name('settings.index');
    Route::get('/search/query', [\App\Http\Controllers\SearchController::class, 'search'])->name('search.query');

});



Route::view('/', 'docs.index');

Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['id', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('locale.switch');
