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
use Illuminate\Support\Facades\Route;
use Teknovate\VibeUi\Vibe;

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


    // Two-Factor Authentication Endpoints
    Route::prefix('two-factor')->name('two-factor.')->group(function () {
        Route::get('/status', function () {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $manager = Vibe::twoFactor();

            $totpAuth = $user?->getTwoFactorAuthenticator('totp');
            $emailAuth = $user?->getTwoFactorAuthenticator('email');
            $anyRecovery = $user?->twoFactorAuthenticators()->whereNotNull('recovery_codes')->first();

            return response()->json([
                'enabled' => $user?->hasTwoFactorEnabled() ?? false,
                'methods' => [
                    'totp' => [
                        'enabled' => $totpAuth?->isConfirmed() ?? false,
                        'is_default' => (bool) ($totpAuth?->is_default ?? false),
                        'confirmed_at' => $totpAuth?->confirmed_at?->toIso8601String(),
                    ],
                    'email' => [
                        'enabled' => $emailAuth?->isConfirmed() ?? false,
                        'is_default' => (bool) ($emailAuth?->is_default ?? false),
                        'confirmed_at' => $emailAuth?->confirmed_at?->toIso8601String(),
                        'email' => $user?->email ? $manager->maskEmail($user->email) : null,
                    ],
                    'whatsapp' => [
                        'enabled' => false,
                        'phone' => $user?->phone ? $manager->maskPhone($user->phone) : null,
                    ],
                ],
                'has_recovery_codes' => ! empty($anyRecovery?->recovery_codes),
                'recovery_codes_count' => count($anyRecovery?->recovery_codes ?? []),
            ]);
        })->name('status');

        Route::post('/setup', function (Request $request) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $manager = Vibe::twoFactor();
            $method = $request->input('method', 'totp');

            if ($method === 'email') {
                if (empty($user->email)) {
                    return response()->json(['message' => 'Alamat email akun tidak ditemukan.'], 422);
                }

                // Throttle pengiriman email: maks 3 kali per menit per user
                $throttleKey = 'two-factor-setup-email:' . $user->getAuthIdentifier();
                $rateLimiter = app(\Illuminate\Cache\RateLimiter::class);

                if ($rateLimiter->tooManyAttempts($throttleKey, 3)) {
                    $seconds = $rateLimiter->availableIn($throttleKey);
                    return response()->json([
                        'method' => 'email',
                        'email' => $manager->maskEmail($user->email),
                        'message' => 'Email sudah dikirim. Tunggu ' . $seconds . ' detik sebelum meminta ulang.',
                        'cooldown_seconds' => $seconds,
                        'throttled' => true,
                    ], 429);
                }

                $rateLimiter->hit($throttleKey, 60);

                $otp = $manager->createOtpForUser($user, 'email', 10);
                $manager->sendEmailOtp($user, $otp, 10);

                return response()->json([
                    'method' => 'email',
                    'email' => $manager->maskEmail($user->email),
                    'message' => 'Kode verifikasi 6-digit telah dikirimkan ke email Anda.',
                    'cooldown_seconds' => 60,
                ]);
            }

            // Default: TOTP
            $authenticator = $user->twoFactorAuthenticators()->firstOrNew(['method' => 'totp']);

            if (! $authenticator->isConfirmed() || empty($authenticator->secret)) {
                $authenticator->secret = $manager->generateSecretKey();
                if (! $user->twoFactorAuthenticators()->where('is_default', true)->exists()) {
                    $authenticator->is_default = true;
                }
                $authenticator->save();
            }

            $appName = config('app.name', 'Vibe UI');
            // Sanitasi secret ke Base32 murni agar QR dan secret yang ditampilkan konsisten
            $cleanSecret = $manager->sanitizeSecret($authenticator->secret);
            $qrUrl = $manager->qrCodeUrl($appName, $user->email ?? $user->username, $authenticator->secret);

            return response()->json([
                'method' => 'totp',
                'secret' => $cleanSecret,
                'qr_code_url' => $qrUrl,
                'confirmed' => $authenticator->isConfirmed(),
            ]);
        })->name('setup');

        Route::post('/confirm', function (Request $request) {
            $request->validate([
                'code' => ['required', 'string', 'min:6'],
                'method' => ['nullable', 'string'],
            ]);

            /** @var \App\Models\User $user */
            $user = Auth::user();
            $manager = Vibe::twoFactor();
            $method = $request->input('method', 'totp');

            if ($method === 'email') {
                $valid = $manager->verifyOtpForUser($user, 'email', $request->code);

                if (! $valid) {
                    return response()->json(['message' => 'Kode verifikasi email 6-digit tidak valid atau sudah kedaluwarsa.'], 422);
                }

                $authenticator = $user->twoFactorAuthenticators()->firstOrNew(['method' => 'email']);
                $recoveryCodes = $user->twoFactorAuthenticators()->whereNotNull('recovery_codes')->value('recovery_codes')
                    ?: $user->generateTwoFactorRecoveryCodes();

                $authenticator->recovery_codes = $recoveryCodes;
                if (! $user->twoFactorAuthenticators()->where('is_default', true)->exists()) {
                    $authenticator->is_default = true;
                }
                $authenticator->markAsConfirmed();
                $authenticator->touchUsage();

                return response()->json([
                    'status' => 'success',
                    'method' => 'email',
                    'message' => '2FA via Email berhasil diaktifkan!',
                    'recovery_codes' => $recoveryCodes,
                ]);
            }

            // Default: TOTP
            $authenticator = $user->twoFactorAuthenticators()->where('method', 'totp')->first();

            if (! $authenticator || ! $authenticator->secret) {
                return response()->json(['message' => 'Silakan mulai setup 2FA terlebih dahulu.'], 400);
            }

            $valid = $manager->verifyOtp($authenticator->secret, $request->code);

            if (! $valid) {
                return response()->json(['message' => 'Kode autentikasi 6-digit tidak valid.'], 422);
            }

            $recoveryCodes = $user->twoFactorAuthenticators()->whereNotNull('recovery_codes')->value('recovery_codes')
                ?: $user->generateTwoFactorRecoveryCodes();

            $authenticator->recovery_codes = $recoveryCodes;
            if (! $user->twoFactorAuthenticators()->where('is_default', true)->exists()) {
                $authenticator->is_default = true;
            }
            $authenticator->markAsConfirmed();
            $authenticator->touchUsage();

            return response()->json([
                'status' => 'success',
                'method' => 'totp',
                'message' => 'Autentikasi Dua Faktor (TOTP) berhasil diaktifkan!',
                'recovery_codes' => $recoveryCodes,
            ]);
        })->name('confirm');

        Route::post('/send-otp', function (Request $request) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $manager = Vibe::twoFactor();
            $method = $request->input('method', 'email');

            if ($method === 'email') {
                if (empty($user->email)) {
                    return response()->json(['message' => 'Alamat email tidak tersedia.'], 422);
                }

                // Throttle kirim ulang: maks 3 kali per menit per user (shared dengan setup)
                $throttleKey = 'two-factor-setup-email:' . $user->getAuthIdentifier();
                $rateLimiter = app(\Illuminate\Cache\RateLimiter::class);

                if ($rateLimiter->tooManyAttempts($throttleKey, 3)) {
                    $seconds = $rateLimiter->availableIn($throttleKey);
                    return response()->json([
                        'message' => 'Terlalu sering. Tunggu ' . $seconds . ' detik sebelum meminta ulang.',
                        'cooldown_seconds' => $seconds,
                    ], 429);
                }

                $rateLimiter->hit($throttleKey, 60);

                $otp = $manager->createOtpForUser($user, 'email', 10);
                $manager->sendEmailOtp($user, $otp, 10);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Kode 6-digit baru telah dikirimkan ke email Anda.',
                    'cooldown_seconds' => 60,
                ]);
            }

            return response()->json(['message' => 'Metode belum didukung untuk pengiriman OTP.'], 422);
        })->name('send-otp');

        Route::post('/recovery-codes', function () {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $authenticator = $user->twoFactorAuthenticators()->whereNotNull('confirmed_at')->first();

            if (! $authenticator) {
                return response()->json(['message' => '2FA belum aktif pada akun ini.'], 400);
            }

            $recoveryCodes = $user->generateTwoFactorRecoveryCodes();
            $authenticator->recovery_codes = $recoveryCodes;
            $authenticator->save();

            return response()->json([
                'status' => 'success',
                'recovery_codes' => $recoveryCodes,
            ]);
        })->name('recovery-codes');

        Route::get('/recovery-codes', function () {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $authenticator = $user->twoFactorAuthenticators()->whereNotNull('recovery_codes')->first();

            if (! $authenticator) {
                return response()->json(['message' => '2FA belum aktif pada akun ini.'], 400);
            }

            return response()->json([
                'recovery_codes' => $authenticator->recovery_codes ?? [],
            ]);
        })->name('recovery-codes.get');

        Route::delete('/disable', function (Request $request) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $method = $request->input('method');

            if ($method && in_array($method, ['totp', 'email', 'whatsapp', 'sms'])) {
                $user->twoFactorAuthenticators()->where('method', $method)->delete();
                $message = 'Metode 2FA (' . strtoupper($method) . ') telah dinonaktifkan.';
            } else {
                $user->twoFactorAuthenticators()->delete();
                $message = 'Seluruh Autentikasi Dua Faktor telah dinonaktifkan.';
            }

            return response()->json([
                'status' => 'success',
                'message' => $message,
            ]);
        })->name('disable');
    });

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
