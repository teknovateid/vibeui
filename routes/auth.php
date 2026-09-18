<?php

use App\Livewire\Auth\Concerns\AuthenticatesUsers;
use App\Livewire\Auth\ConfirmPassword;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\TwoFactorChallenge;
use App\Livewire\Auth\VerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
    Route::get('/two-factor-challenge', TwoFactorChallenge::class)->name('two-factor.challenge');
});

Route::middleware('auth')->group(function () {
    Route::get('/verify-email', VerifyEmail::class)->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->intended(AuthenticatesUsers::redirectUrl() . '?verified=1');
    })->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    $sanitizeIntendedUrl = function (?string $url, string $fallback): string {
        if (! $url || ! is_string($url)) {
            return $fallback;
        }

        $url = trim($url);

        // Jika nama route internal yang valid
        if (\Illuminate\Support\Facades\Route::has($url)) {
            return route($url);
        }

        // Path relatif aman (diawali / dan bukan //)
        if (str_starts_with($url, '/') && ! str_starts_with($url, '//')) {
            return $url;
        }

        // Host eksternal harus cocok dengan host aplikasi internal
        $appHost = parse_url(config('app.url'), PHP_URL_HOST);
        $requestHost = request()->getHost();
        $targetHost = parse_url($url, PHP_URL_HOST);

        if ($targetHost && in_array($targetHost, array_filter([$appHost, $requestHost, 'localhost', '127.0.0.1']), true)) {
            return $url;
        }

        return $fallback;
    };

    Route::get('/confirm-password', ConfirmPassword::class)->name('password.confirm');

    Route::post('/confirm-password', function (Request $request) use ($sanitizeIntendedUrl) {
        $request->validate(['password' => ['required', 'string']]);

        $user = Auth::user();

        if (! $user || ! Hash::check($request->password, $user->getAuthPassword())) {
            return response()->json([
                'errors' => ['password' => [__('auth/errors.password')]],
            ], 422);
        }

        $request->session()->put('auth.password_confirmed_at', time());
        $request->session()->put('auth.one_time_confirmed', true);

        $rawTarget = $request->session()->pull('auth.target_route') ?: $request->session()->get('url.intended');
        $target = $rawTarget ? $sanitizeIntendedUrl($rawTarget, '/') : null;

        if ($target) {
            $request->session()->put('auth.confirmed_route', $target);
            $request->session()->put('auth.is_single_page_confirm', true);
            $request->session()->put('url.intended', $target);
        }

        if ($request->expectsJson()) {
            return response()->noContent();
        }

        return redirect()->intended('/');
    })->middleware('throttle:10,1')->name('password.confirm.post');

    Route::match(['get', 'post'], '/confirm-password/lock', function (Request $request) use ($sanitizeIntendedUrl) {
        // Tolak jika dipanggil dari tag media/script (anti CSRF micro-DoS)
        $fetchDest = $request->header('Sec-Fetch-Dest');
        if ($fetchDest && in_array($fetchDest, ['image', 'script', 'style', 'video', 'audio', 'track'], true)) {
            abort(403);
        }

        $request->session()->forget('auth.password_confirmed_at');
        $request->session()->forget('auth.confirmed_route');
        $request->session()->forget('auth.is_single_page_confirm');

        $fallback = Route::has('docs.settings.security')
            ? route('docs.settings.security')
            : (Route::has('settings.security') ? route('settings.security') : url('/'));

        $safeTarget = $sanitizeIntendedUrl($request->header('referer'), $fallback);

        return redirect()->to($safeTarget);
    })->name('password.lock');

    Route::get('/confirm-password/idle-lock', function (Request $request) use ($sanitizeIntendedUrl) {
        // Tolak jika dipanggil dari tag media/script (anti CSRF micro-DoS)
        $fetchDest = $request->header('Sec-Fetch-Dest');
        if ($fetchDest && in_array($fetchDest, ['image', 'script', 'style', 'video', 'audio', 'track'], true)) {
            abort(403);
        }

        $request->session()->put('auth.session_locked', true);
        $request->session()->forget('auth.password_confirmed_at');
        $request->session()->forget('auth.confirmed_route');
        $request->session()->put('auth.last_activity_time', time());

        $fallback = Route::has('docs.settings.login-history')
            ? route('docs.settings.login-history')
            : (Route::has('settings.login-history') ? route('settings.login-history') : url('/'));
        $intended = $request->query('intended') ?: $request->header('referer') ?: $fallback;
        $safeIntended = $sanitizeIntendedUrl($intended, $fallback);
        $request->session()->put('url.intended', $safeIntended);

        $confirmUrl = Route::has('password.confirm') ? route('password.confirm') : '/confirm-password';

        return redirect($confirmUrl)->with('status', 'idle_timeout');
    })->name('password.idle-lock');

    Route::match(['get', 'post'], '/keep-alive', function (Request $request) {
        if ($request->session()->get('auth.session_locked')) {
            return response()->json(['status' => 'locked'], 423);
        }
        $request->session()->put('auth.last_activity_time', time());
        return response()->json(['status' => 'ok']);
    })->middleware('throttle:60,1')->name('auth.keep-alive');

    Route::post('/logout', function (Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    })->name('logout');
});

