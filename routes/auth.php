<?php

use App\Livewire\Auth\Concerns\AuthenticatesUsers;
use App\Livewire\Auth\ConfirmPassword;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\VerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Route::get('/verify-email', VerifyEmail::class)->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->intended(AuthenticatesUsers::redirectUrl() . '?verified=1');
    })->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    Route::get('/confirm-password', ConfirmPassword::class)->name('password.confirm');

    Route::post('/confirm-password', function (Request $request) {
        $request->validate(['password' => ['required', 'string']]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()?->email,
            'password' => $request->password,
        ])) {
            return response()->json([
                'errors' => ['password' => [__('auth/errors.password')]],
            ], 422);
        }

        $request->session()->put('auth.password_confirmed_at', time());
        $request->session()->put('auth.one_time_confirmed', true);

        $target = $request->session()->pull('auth.target_route') ?: $request->session()->get('url.intended');
        if ($target) {
            $request->session()->put('auth.confirmed_route', $target);
            $request->session()->put('auth.is_single_page_confirm', true);
        }

        if ($request->expectsJson()) {
            return response()->noContent();
        }

        return redirect()->intended('/');
    })->name('password.confirm.post');

    Route::match(['get', 'post'], '/confirm-password/lock', function (Request $request) {
        $request->session()->forget('auth.password_confirmed_at');
        $request->session()->forget('auth.confirmed_route');
        $request->session()->forget('auth.is_single_page_confirm');

        return redirect()->to($request->header('referer') ?: route('docs.settings.security'));
    })->name('password.lock');

    Route::get('/confirm-password/idle-lock', function (Request $request) {
        $request->session()->put('auth.session_locked', true);
        $request->session()->forget('auth.password_confirmed_at');
        $request->session()->forget('auth.confirmed_route');
        $request->session()->put('auth.last_activity_time', time());

        $intended = $request->query('intended') ?: $request->header('referer') ?: route('docs.settings.login-history');
        $request->session()->put('url.intended', $intended);

        $confirmUrl = Route::has('password.confirm') ? route('password.confirm') : '/confirm-password';

        return redirect($confirmUrl)->with('status', 'idle_timeout');
    })->name('password.idle-lock');

    Route::match(['get', 'post'], '/keep-alive', function (Request $request) {
        if ($request->session()->get('auth.session_locked')) {
            return response()->json(['status' => 'locked'], 423);
        }
        $request->session()->put('auth.last_activity_time', time());
        return response()->json(['status' => 'ok']);
    })->name('auth.keep-alive');


    Route::post('/logout', function (Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    })->name('logout');
});

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
