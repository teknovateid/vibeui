<?php

namespace App\Livewire\Auth;

use App\Livewire\Auth\Concerns\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Teknovate\VibeUi\Vibe;

class TwoFactorChallenge extends Component
{
    use AuthenticatesUsers;

    /**
     * Kode token OTP numerik (untuk TOTP, Email, SMS, WhatsApp).
     */
    public string $code = '';

    /**
     * Kode pemulihan darurat.
     */
    public string $recovery_code = '';

    /**
     * Metode 2FA yang sedang aktif dipilih.
     * Pilihan: 'totp', 'email', 'whatsapp', 'sms', 'recovery'
     */
    public string $selectedMethod = 'totp';

    /**
     * Daftar metode 2FA yang dapat dipilih untuk user ini.
     */
    public array $availableMethods = [];

    /**
     * Tampilkan dropdown/modal pemilih metode.
     */
    public bool $showingMethodSelector = false;

    /**
     * Apakah kode OTP sudah dikirimkan (untuk Email / WA / SMS).
     */
    public bool $codeSent = false;

    /**
     * Pesan konfirmasi pengiriman kode.
     */
    public ?string $sentMessage = null;

    /**
     * Sisa detik cooldown untuk kirim ulang kode.
     */
    public int $resendCooldown = 0;

    /**
     * Mount lifecycle hook.
     */
    public function mount(): mixed
    {
        if (! session()->has('auth.2fa.user_id')) {
            return redirect()->route('login');
        }

        $user = $this->getUser();
        if (! $user) {
            session()->forget(['auth.2fa.user_id', 'auth.2fa.remember']);

            return redirect()->route('login');
        }

        $this->initializeMethods($user);

        return null;
    }

    /**
     * Inisialisasi daftar metode 2FA yang tersedia untuk user.
     */
    protected function initializeMethods($user): void
    {
        $twoFactor = Vibe::twoFactor();
        $methods = [];

        // 1. TOTP (Aplikasi Autentikator)
        if ($user->hasTwoFactorEnabled('totp')) {
            $methods['totp'] = [
                'name' => 'Aplikasi Autentikator',
                'description' => 'Google Authenticator, Authy, atau 1Password',
                'badge' => 'TOTP',
                'icon' => 'device-mobile',
            ];
        }

        // 2. Email OTP (jika diaktifkan di database)
        if ($user->hasTwoFactorEnabled('email') && ! empty($user->email)) {
            $methods['email'] = [
                'name' => 'Kode Verifikasi Email',
                'description' => 'Kirim kode 6-digit ke ' . $twoFactor->maskEmail($user->email),
                'badge' => 'Email',
                'icon' => 'mail',
            ];
        }

        // 3. WhatsApp OTP (jika diaktifkan di database)
        if ($user->hasTwoFactorEnabled('whatsapp') && ! empty($user->phone)) {
            $methods['whatsapp'] = [
                'name' => 'WhatsApp OTP',
                'description' => 'Kirim kode ke WhatsApp ' . $twoFactor->maskPhone($user->phone),
                'badge' => 'WhatsApp',
                'icon' => 'chat',
            ];
        }

        // 4. SMS OTP (jika diaktifkan di database)
        if ($user->hasTwoFactorEnabled('sms') && ! empty($user->phone)) {
            $methods['sms'] = [
                'name' => 'SMS OTP',
                'description' => 'Kirim kode via SMS ke ' . $twoFactor->maskPhone($user->phone),
                'badge' => 'SMS',
                'icon' => 'phone',
            ];
        }

        // 5. Kode Pemulihan (jika ada authenticator dengan recovery codes di database)
        $hasRecovery = $user->twoFactorAuthenticators()->whereNotNull('recovery_codes')->exists();
        if ($hasRecovery) {
            $methods['recovery'] = [
                'name' => 'Kode Pemulihan Cadangan',
                'description' => 'Gunakan 1 dari 8 kode cadangan darurat',
                'badge' => 'Cadangan',
                'icon' => 'key',
            ];
        }

        $this->availableMethods = $methods;

        // Pilih default method: totp jika ada, atau default authenticator, atau email
        $defaultAuth = $user->defaultTwoFactorAuthenticator();
        if ($defaultAuth && isset($methods[$defaultAuth->method])) {
            $this->selectedMethod = $defaultAuth->method;
        } elseif (isset($methods['totp'])) {
            $this->selectedMethod = 'totp';
        } elseif (isset($methods['email'])) {
            $this->selectedMethod = 'email';
            $this->sendOtp();
        } else {
            $this->selectedMethod = array_key_first($methods) ?? 'totp';
        }
    }

    /**
     * Beralih ke metode 2FA tertentu.
     */
    public function selectMethod(string $method): void
    {
        if (! isset($this->availableMethods[$method])) {
            return;
        }

        $this->selectedMethod = $method;
        $this->code = '';
        $this->recovery_code = '';
        $this->showingMethodSelector = false;
        $this->resetErrorBag();

        // Di unit test, jalankan sendOtp langsung agar assertions tetap synchronous.
        // Di browser, sendOtp dipicu otomatis secara asynchronous via x-init di view
        // agar perpindahan layar ke form OTP terjadi secara 100% INSTAN.
        if (app()->runningUnitTests()) {
            if (in_array($method, ['email', 'whatsapp', 'sms']) && ! $this->codeSent) {
                $this->sendOtp();
            }
        }
    }

    /**
     * Toggle modal/dropdown pemilih metode.
     */
    public function toggleMethodSelector(): void
    {
        $this->showingMethodSelector = ! $this->showingMethodSelector;
    }

    /**
     * Kirim kode OTP via Email, WhatsApp, atau SMS.
     */
    public function sendOtp(): void
    {
        $user = $this->getUser();
        if (! $user) {
            return;
        }

        $method = $this->selectedMethod;
        if (! in_array($method, ['email', 'whatsapp', 'sms'])) {
            return;
        }

        // Cek cooldown 60 detik
        $cooldownKey = "2fa_cooldown_{$method}_{$user->id}";
        if (Cache::has($cooldownKey)) {
            $remaining = Cache::get($cooldownKey) - time();
            if ($remaining > 0) {
                $this->resendCooldown = $remaining;

                return;
            }
        }

        $twoFactor = Vibe::twoFactor();
        $otp = $twoFactor->createOtpForUser($user, $method, 10);

        if ($method === 'email') {
            $twoFactor->sendEmailOtp($user, $otp, 10);
            $this->sentMessage = 'Kode 6-digit telah dikirim ke ' . $twoFactor->maskEmail($user->email);
        } elseif ($method === 'whatsapp') {
            $twoFactor->sendWhatsAppOtp($user, $otp, $user->phone);
            $this->sentMessage = 'Kode 6-digit telah disiapkan untuk WhatsApp ke ' . $twoFactor->maskPhone($user->phone);
        } elseif ($method === 'sms') {
            $twoFactor->sendSmsOtp($user, $otp, $user->phone);
            $this->sentMessage = 'Kode 6-digit telah disiapkan untuk SMS ke ' . $twoFactor->maskPhone($user->phone);
        }

        // Simpan cooldown 60 detik
        Cache::put($cooldownKey, time() + 60, now()->addSeconds(60));
        $this->resendCooldown = 60;
        $this->codeSent = true;
        $this->code = '';
        $this->resetErrorBag();
    }

    /**
     * Batalkan tantangan 2FA dan kembali ke halaman login.
     */
    public function cancel()
    {
        session()->forget(['auth.2fa.user_id', 'auth.2fa.remember']);

        return redirect()->route('login');
    }

    /**
     * Eksekusi verifikasi kode tantangan 2FA.
     */
    public function challenge()
    {
        $user = $this->getUser();
        if (! $user) {
            session()->forget(['auth.2fa.user_id', 'auth.2fa.remember']);

            return redirect()->route('login');
        }

        $twoFactor = Vibe::twoFactor();

        // 1. Mode Kode Pemulihan Darurat
        if ($this->selectedMethod === 'recovery') {
            $this->validate([
                'recovery_code' => ['required', 'string'],
            ], [], [
                'recovery_code' => __('auth/two_factor.recovery_code'),
            ]);

            $authenticator = $user->twoFactorAuthenticators()
                ->whereNotNull('recovery_codes')
                ->first();

            if (! $authenticator || ! $authenticator->verifyRecoveryCode($this->recovery_code)) {
                throw ValidationException::withMessages([
                    'recovery_code' => __('auth/two_factor.invalid_recovery_code'),
                ]);
            }

            return $this->finishLogin($user);
        }

        // 2. Mode OTP 6-Digit (TOTP, Email, WhatsApp, SMS)
        $this->validate([
            'code' => ['required', 'string', 'min:6'],
        ], [], [
            'code' => __('auth/two_factor.code'),
        ]);

        if ($this->selectedMethod === 'totp') {
            $authenticator = $user->getTwoFactorAuthenticator('totp');
            if (! $authenticator || ! $authenticator->secret) {
                throw ValidationException::withMessages([
                    'code' => __('auth/two_factor.totp_not_configured'),
                ]);
            }

            $valid = $twoFactor->verifyOtp($authenticator->secret, $this->code);
            if (! $valid) {
                throw ValidationException::withMessages([
                    'code' => __('auth/two_factor.invalid_totp_code'),
                ]);
            }

            $authenticator->touchUsage();

            return $this->finishLogin($user);
        }

        // Email, WhatsApp, atau SMS
        if (in_array($this->selectedMethod, ['email', 'whatsapp', 'sms'])) {
            $valid = $twoFactor->verifyOtpForUser($user, $this->selectedMethod, $this->code);
            if (! $valid) {
                throw ValidationException::withMessages([
                    'code' => __('auth/two_factor.invalid_code'),
                ]);
            }

            $authenticator = $user->getTwoFactorAuthenticator($this->selectedMethod);
            if ($authenticator) {
                $authenticator->touchUsage();
            }

            return $this->finishLogin($user);
        }
    }

    /**
     * Ambil instance user yang sedang dalam sesi challenge 2FA.
     */
    protected function getUser(): ?User
    {
        $userId = session('auth.2fa.user_id');
        if (! $userId) {
            return null;
        }

        $userModel = config('auth.providers.users.model', User::class);

        return $userModel::find($userId);
    }

    /**
     * Selesaikan proses otentikasi user dan redirect.
     */
    protected function finishLogin($user)
    {
        $remember = (bool) session('auth.2fa.remember', false);

        Auth::login($user, $remember);

        session()->forget(['auth.2fa.user_id', 'auth.2fa.remember']);
        session()->regenerate();

        return redirect()->intended($this->redirectAfterLoginUrl());
    }

    /**
     * Hook untuk kompatibilitas backward toggle recovery lama jika dipanggil view.
     */
    public function toggleRecovery(): void
    {
        $this->selectedMethod = ($this->selectedMethod === 'recovery') ? 'totp' : 'recovery';
        $this->code = '';
        $this->recovery_code = '';
        $this->resetErrorBag();
    }

    /**
     * Accessor backward-compatible untuk property $recovery.
     */
    public function getRecoveryProperty(): bool
    {
        return $this->selectedMethod === 'recovery';
    }

    public function render()
    {
        /** @var mixed $view */
        $view = view('auth.two-factor-challenge');

        $title = $this->showingMethodSelector
            ? (__('auth/two_factor.select_title'))
            : (__('auth/two_factor.title'));

        $description = $this->showingMethodSelector
            ? (__('auth/two_factor.select_description'))
            : match ($this->selectedMethod) {
                'recovery' => __('auth/two_factor.recovery_desc'),
                'email' => __('auth/two_factor.email_desc'),
                'whatsapp' => __('auth/two_factor.whatsapp_desc'),
                'sms' => __('auth/two_factor.sms_desc'),
                default => __('auth/two_factor.totp_desc'),
            };

        return $view->layout($this->resolveAuthLayout(), [
            'title' => $title,
            'description' => $description,
            'hideHeader' => true,
        ]);
    }
}
