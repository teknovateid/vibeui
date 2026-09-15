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
                'errors' => ['password' => [__('auth.password')]],
            ], 422);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        if ($request->expectsJson()) {
            return response()->noContent();
        }

        return redirect()->intended('/');
    })->name('password.confirm.post');


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
