<?php

use App\Http\Controllers\DashboardPageController;
use App\Http\Controllers\FilepondController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

if (app()->environment('local', 'testing')) {
    Route::post('/dev-login-demo', function () {
        $user = \App\Models\User::firstOrCreate(
            ['email' => 'demo@vibeui.test'],
            [
                'name' => 'Demo User',
                'username' => 'demouser',
                'phone' => '08123456789',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        \Illuminate\Support\Facades\Auth::login($user);
        return redirect()->back();
    })->name('dev.login.demo');
}

Route::prefix('docs')->name('docs.')->group(function () {
    Route::view('/', 'docs.index')->name('index');
    Route::view('/instalation', 'docs.instalation.index')->name('instalation.index');
    Route::view('/design-system', 'docs.design-system.index')->name('design-system.index');
    Route::view('/directories', 'docs.directories.index')->name('directories.index');

    Route::prefix('auth')->middleware(['auth', 'verified'])->name('auth.')->group(function () {
        Route::redirect('/', '/docs/auth/installation')->name('index');
        Route::view('/installation', 'docs.auth.installation')->name('installation');
        Route::view('/confirm', 'docs.auth.confirm')->name('confirm');
        Route::view('/idle', 'docs.auth.idle')->name('idle');
        Route::view('/two-factor', 'docs.auth.two-factor')->name('two-factor');
        Route::view('/passkey', 'docs.auth.passkey')->name('passkey');
    });

    Route::prefix('form')->name('form.')->group(function () {
        Route::get('/', [FormController::class, 'index'])->name('index');
        Route::post('/', [FormController::class, 'store'])->name('store');
    });

    Route::prefix('input')->name('input.')->group(function () {
        Route::view('/', 'docs.input.index')->name('index');
        Route::view('/otp', 'docs.input.otp')->name('otp');
        Route::view('/currency', 'docs.input.currency')->name('currency');
        Route::view('/phone', 'docs.input.phone')->name('phone');
    });

    Route::view('/textarea', 'docs.textarea.index')->name('textarea.index');
    Route::get('/select', [SelectController::class, 'index'])->name('select.index');
    Route::get('/select/api', [SelectController::class, 'api'])->name('select.api');
    Route::view('/checkbox', 'docs.checkbox.index')->name('checkbox.index');
    Route::view('/radio', 'docs.radio.index')->name('radio.index');
    Route::view('/switch', 'docs.switch.index')->name('switch.index');
    Route::view('/range', 'docs.range.index')->name('range.index');
    Route::view('/date-time', 'docs.date-time.index')->name('date-time.index');
    Route::view('/dynamic-form', 'docs.dynamic-form.index')->name('dynamic-form.index');

    Route::prefix('filepond')->name('filepond.')->group(function () {
        Route::get('/', [FilepondController::class, 'index'])->name('index');
        Route::get('/download', [FilepondController::class, 'download'])->name('download');
        Route::post('/store', [FilepondController::class, 'requestTest'])->name('store');
        Route::post('/request-test', [FilepondController::class, 'requestTest'])->name('request_test');
        Route::post('/presigned', [FilepondController::class, 'presigned'])->name('presigned');
        Route::put('/local-upload/{key}', [FilepondController::class, 'localUpload'])->name('local_upload');
    });

    Route::view('/button', 'docs.button.index')->name('button.index');
    Route::view('/dropdown', 'docs.dropdown.index')->name('dropdown.index');
    Route::view('/context', 'docs.context.index')->name('context.index');
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
    Route::view('/accordion', 'docs.accordion.index')->name('accordion.index');
    Route::view('/highlightjs', 'docs.highlightjs.index')->name('highlightjs.index');

    Route::prefix('display')->name('display.')->group(function () {
        Route::redirect('/', '/docs/display/qrcode')->name('index');
        Route::view('/qrcode', 'docs.display.qrcode')->name('qrcode');
    });

    Route::get('/chart', function () {
        $monthlyMetrics = \App\Models\SalesMetric::where('category', 'Semua Kategori')->orderBy('id')->get();
        $categoryMetrics = \App\Models\SalesMetric::where('month', 'Total')->orderByDesc('revenue')->get();

        return view('docs.chart.index', compact('monthlyMetrics', 'categoryMetrics'));
    })->name('chart.index');

    Route::get('/dashboard/{view}', [DashboardPageController::class, 'show'])->name('dashboard.show');

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', function () {
            return Auth::check() ? redirect('/docs/settings/account') : redirect('/docs/settings/appearance');
        })->name('index');
        Route::view('/appearance', 'docs.settings.appearance')->name('appearance');
        Route::view('/notifications', 'docs.settings.notifications')->name('notifications');

        Route::middleware(['auth', 'verified'])->group(function () {
            Route::view('/account', 'docs.settings.account')->name('account');

            Route::get('/security', [SettingsController::class, 'security'])
                ->middleware('confirm')
                ->name('security');

            Route::view('/passkey', 'docs.settings.security')
                ->middleware('confirm')
                ->name('passkey');

            Route::view('/login-history', 'docs.settings.login-history')
                ->middleware('idle:10')
                ->name('login-history');
        });
    });
    Route::get('/search/query', [\App\Http\Controllers\SearchController::class, 'search'])->name('search.query');
});



Route::view('/', 'docs.index');

Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['id', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('locale.switch');
