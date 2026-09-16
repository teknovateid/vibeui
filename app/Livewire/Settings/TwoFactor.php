<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Teknovate\VibeUi\Vibe;

class TwoFactor extends Component
{
    /**
     * Apakah 2FA TOTP aktif untuk user.
     */
    public bool $totpEnabled = false;

    /**
     * Apakah 2FA Email aktif untuk user.
     */
    public bool $emailEnabled = false;

    /**
     * Apakah salah satu metode 2FA (TOTP atau Email) sedang aktif.
     */
    public bool $enabled = false;

    /**
     * Email terdaftar user yang disamarkan (masked).
     */
    public string $userEmail = '';

    /**
     * Status login user (true jika guest).
     */
    public bool $isGuest = false;

    /**
     * Langkah setup saat ini (0: input OTP / scan QR, 1: tampilkan recovery codes).
     */
    public int $step = 0;

    /**
     * Metode 2FA yang sedang disetup atau dipilih ('totp' atau 'email').
     */
    public string $selectedMethod = 'totp';

    /**
     * Base32 secret key untuk TOTP.
     */
    public string $secretKey = '';

    /**
     * URL otpauth:// untuk QR code TOTP.
     */
    public string $qrCodeUrl = '';

    /**
     * Kode OTP 6 digit yang diinput oleh user.
     */
    public string $code = '';

    /**
     * Pesan feedback verifikasi / kesalahan.
     */
    public ?string $feedback = null;

    /**
     * Tipe alert feedback ('info', 'error', 'success').
     */
    public string $feedbackType = 'info';

    /**
     * Daftar kode pemulihan cadangan (recovery codes).
     */
    public array $recoveryCodes = [];

    /**
     * Sisa detik cooldown untuk kirim ulang kode OTP email.
     */
    public int $cooldown = 0;

    /**
     * Apakah kode OTP email sudah terkirim pada sesi modal saat ini.
     */
    public bool $emailOtpSent = false;

    /**
     * Apakah secret key berhasil disalin ke clipboard.
     */
    public bool $copiedSecret = false;

    /**
     * Lifecycle mount hook.
     */
    public function mount(): void
    {
        $this->refreshStatus();
    }

    /**
     * Refresh status 2FA dari user aktif.
     */
    public function refreshStatus(): void
    {
        /** @var User|null $user */
        $user = Auth::user();
        $this->isGuest = ! Auth::check();

        if ($user) {
            $this->totpEnabled = $user->hasTwoFactorEnabled('totp');
            $this->emailEnabled = $user->hasTwoFactorEnabled('email');
            $this->enabled = $this->totpEnabled || $this->emailEnabled;
            $this->userEmail = $user->email ? Vibe::twoFactor()->maskEmail($user->email) : '';

            // Cek apakah ada cooldown setup email yang masih aktif
            $cooldownKey = '2fa_cooldown_setup_email_' . $user->getAuthIdentifier();
            if (Cache::has($cooldownKey)) {
                $remaining = (int) Cache::get($cooldownKey) - time();
                if ($remaining > 0) {
                    $this->cooldown = $remaining;
                    $this->emailOtpSent = true;
                } else {
                    Cache::forget($cooldownKey);
                    $this->cooldown = 0;
                    $this->emailOtpSent = false;
                }
            }
        } else {
            $this->totpEnabled = false;
            $this->emailEnabled = false;
            $this->enabled = false;
            $this->userEmail = '';
            $this->cooldown = 0;
            $this->emailOtpSent = false;
        }
    }

    /**
     * Accessor untuk mengecek apakah salah satu metode 2FA sedang aktif.
     */
    public function enabled(): bool
    {
        return $this->totpEnabled || $this->emailEnabled;
    }

    public function getEnabledProperty(): bool
    {
        return $this->totpEnabled || $this->emailEnabled;
    }

    /**
     * Memulai proses setup 2FA TOTP (Authenticator App).
     */
    public function setupTotp(): void
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            $this->dispatch('vibe-toast', message: 'Silakan login terlebih dahulu untuk mengaktifkan 2FA.', type: 'warning');
            return;
        }

        $manager = Vibe::twoFactor();
        $authenticator = $user->twoFactorAuthenticators()->firstOrNew(['method' => 'totp']);

        if (! $authenticator->isConfirmed() || empty($authenticator->secret)) {
            $authenticator->secret = $manager->generateSecretKey();
            if (! $user->twoFactorAuthenticators()->where('is_default', true)->exists()) {
                $authenticator->is_default = true;
            }
            $authenticator->save();
        }

        $appName = config('app.name', 'Vibe UI');
        $this->secretKey = $manager->sanitizeSecret($authenticator->secret);
        $this->qrCodeUrl = $manager->qrCodeUrl($appName, $user->email ?? $user->username, $authenticator->secret);
        $this->selectedMethod = 'totp';
        $this->step = 0;
        $this->code = '';
        $this->feedback = null;
        $this->resetErrorBag();

        $this->dispatch('open-modal', 'modal-2fa-totp');
    }

    /**
     * Memulai proses setup 2FA Email.
     */
    public function setupEmail(): void
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            $this->dispatch('vibe-toast', message: 'Silakan login terlebih dahulu untuk mengaktifkan 2FA.', type: 'warning');
            return;
        }

        if (empty($user->email)) {
            $this->feedbackType = 'error';
            $this->feedback = 'Alamat email akun tidak ditemukan.';
            $this->dispatch('vibe-toast', message: 'Alamat email akun tidak ditemukan.', type: 'error');
            return;
        }

        $this->selectedMethod = 'email';
        $this->step = 0;
        $this->code = '';
        $this->resetErrorBag();

        // 1. Cek cooldown 60 detik di Cache: jika masih aktif, jangan buat OTP atau kirim email lagi
        $cooldownKey = '2fa_cooldown_setup_email_' . $user->getAuthIdentifier();
        if (Cache::has($cooldownKey)) {
            $remaining = (int) Cache::get($cooldownKey) - time();
            if ($remaining > 0) {
                $this->cooldown = $remaining;
                $this->emailOtpSent = true;
                $this->feedbackType = 'info';
                $this->feedback = 'Kode verifikasi sudah dikirim ke email Anda. Tunggu ' . $remaining . ' detik untuk meminta kode baru.';
                $this->dispatch('start-cooldown', seconds: $remaining);
                $this->dispatch('open-modal', 'modal-2fa-email');
                return;
            }
        }

        // 2. Cek rate limiter: batasi maksimal 5 permintaan per 15 menit
        $throttleKey = 'two-factor-setup-email-rate:' . $user->getAuthIdentifier();
        $rateLimiter = app(\Illuminate\Cache\RateLimiter::class);

        if ($rateLimiter->tooManyAttempts($throttleKey, 5)) {
            $seconds = $rateLimiter->availableIn($throttleKey);
            $this->cooldown = $seconds;
            $this->feedbackType = 'error';
            $this->feedback = 'Terlalu banyak permintaan kode verifikasi. Tunggu ' . ceil($seconds / 60) . ' menit sebelum mencoba lagi.';
            $this->dispatch('start-cooldown', seconds: $seconds);
            $this->dispatch('open-modal', 'modal-2fa-email');
            return;
        }

        $rateLimiter->hit($throttleKey, 900);
        Cache::put($cooldownKey, time() + 60, now()->addSeconds(60));

        $manager = Vibe::twoFactor();
        $otp = $manager->createOtpForUser($user, 'email', 10);
        $manager->sendEmailOtp($user, $otp, 10);

        $this->cooldown = 60;
        $this->emailOtpSent = true;
        $this->feedbackType = 'info';
        $this->feedback = 'Kode verifikasi 6-digit telah dikirimkan ke email Anda.';
        $this->dispatch('start-cooldown', seconds: 60);
        $this->dispatch('open-modal', 'modal-2fa-email');
    }

    /**
     * Kirim ulang kode OTP Email dengan rate limit throttling.
     */
    public function resendEmailOtp(): void
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user || empty($user->email)) {
            return;
        }

        // 1. Cek cooldown 60 detik di Cache
        $cooldownKey = '2fa_cooldown_setup_email_' . $user->getAuthIdentifier();
        if (Cache::has($cooldownKey)) {
            $remaining = (int) Cache::get($cooldownKey) - time();
            if ($remaining > 0) {
                $this->cooldown = $remaining;
                $this->feedbackType = 'info';
                $this->feedback = 'Tunggu ' . $remaining . ' detik sebelum meminta kode baru.';
                $this->dispatch('start-cooldown', seconds: $remaining);
                return;
            }
        }

        // 2. Cek rate limiter: batasi maksimal 5 permintaan per 15 menit
        $throttleKey = 'two-factor-setup-email-rate:' . $user->getAuthIdentifier();
        $rateLimiter = app(\Illuminate\Cache\RateLimiter::class);

        if ($rateLimiter->tooManyAttempts($throttleKey, 5)) {
            $seconds = $rateLimiter->availableIn($throttleKey);
            $this->cooldown = $seconds;
            $this->feedbackType = 'error';
            $this->feedback = 'Terlalu sering. Tunggu ' . ceil($seconds / 60) . ' menit sebelum meminta ulang.';
            $this->dispatch('start-cooldown', seconds: $seconds);
            return;
        }

        $rateLimiter->hit($throttleKey, 900);
        Cache::put($cooldownKey, time() + 60, now()->addSeconds(60));

        $manager = Vibe::twoFactor();
        $otp = $manager->createOtpForUser($user, 'email', 10);
        $manager->sendEmailOtp($user, $otp, 10);

        $this->cooldown = 60;
        $this->emailOtpSent = true;
        $this->feedbackType = 'info';
        $this->feedback = 'Kode 6-digit baru telah dikirimkan ke email Anda.';
        $this->dispatch('start-cooldown', seconds: 60);
        $this->dispatch('vibe-toast', message: 'Kode baru berhasil dikirim ke email!', type: 'success');
    }

    /**
     * Konfirmasi kode verifikasi OTP (TOTP atau Email) dan aktifkan 2FA.
     */
    public function confirmTwoFactor(?string $method = null, ?string $code = null): void
    {
        if ($method) {
            $this->selectedMethod = $method;
        }
        if ($code) {
            $this->code = $code;
        }

        $this->validate([
            'code' => ['required', 'string', 'min:6'],
        ], [], [
            'code' => 'Kode Verifikasi',
        ]);

        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            return;
        }

        $manager = Vibe::twoFactor();

        if ($this->selectedMethod === 'email') {
            $valid = $manager->verifyOtpForUser($user, 'email', $this->code);
            if (! $valid) {
                $this->feedbackType = 'error';
                $this->feedback = 'Kode verifikasi email 6-digit tidak valid atau sudah kedaluwarsa.';
                $this->addError('code', $this->feedback);
                return;
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

            Cache::forget('2fa_cooldown_setup_email_' . $user->getAuthIdentifier());

            $this->emailEnabled = true;
            $this->enabled = true;
            $this->emailOtpSent = false;
            $this->cooldown = 0;
            $this->recoveryCodes = $recoveryCodes;
            $this->step = 1;
            $this->feedback = null;
            $this->code = '';
            $this->dispatch('vibe-toast', message: '2FA via Email berhasil diaktifkan!', type: 'success');
            return;
        }

        // Default: TOTP
        $authenticator = $user->twoFactorAuthenticators()->where('method', 'totp')->first();
        if (! $authenticator || ! $authenticator->secret) {
            $this->feedbackType = 'error';
            $this->feedback = 'Silakan mulai setup 2FA terlebih dahulu.';
            $this->addError('code', $this->feedback);
            return;
        }

        $valid = $manager->verifyOtp($authenticator->secret, $this->code);
        if (! $valid) {
            $this->feedbackType = 'error';
            $this->feedback = 'Kode autentikasi 6-digit tidak valid.';
            $this->addError('code', $this->feedback);
            return;
        }

        $recoveryCodes = $user->twoFactorAuthenticators()->whereNotNull('recovery_codes')->value('recovery_codes')
            ?: $user->generateTwoFactorRecoveryCodes();

        $authenticator->recovery_codes = $recoveryCodes;
        if (! $user->twoFactorAuthenticators()->where('is_default', true)->exists()) {
            $authenticator->is_default = true;
        }
        $authenticator->markAsConfirmed();
        $authenticator->touchUsage();

        $this->totpEnabled = true;
        $this->enabled = true;
        $this->recoveryCodes = $recoveryCodes;
        $this->step = 1;
        $this->feedback = null;
        $this->code = '';
        $this->dispatch('vibe-toast', message: 'Autentikasi Dua Faktor (TOTP) berhasil diaktifkan!', type: 'success');
    }

    /**
     * Nonaktifkan metode 2FA tertentu atau seluruh 2FA.
     */
    public function disable(?string $method = null): void
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            return;
        }

        if ($method && in_array($method, ['totp', 'email', 'whatsapp', 'sms'])) {
            $user->twoFactorAuthenticators()->where('method', $method)->delete();
            $message = 'Metode 2FA (' . strtoupper($method) . ') telah dinonaktifkan.';
            if ($method === 'totp') $this->totpEnabled = false;
            if ($method === 'email') {
                $this->emailEnabled = false;
                Cache::forget('2fa_cooldown_setup_email_' . $user->getAuthIdentifier());
                $this->emailOtpSent = false;
                $this->cooldown = 0;
            }
            $this->enabled = $this->totpEnabled || $this->emailEnabled;
        } else {
            $user->twoFactorAuthenticators()->delete();
            $message = 'Seluruh Autentikasi Dua Faktor telah dinonaktifkan.';
            $this->totpEnabled = false;
            $this->emailEnabled = false;
            $this->enabled = false;
            Cache::forget('2fa_cooldown_setup_email_' . $user->getAuthIdentifier());
            $this->emailOtpSent = false;
            $this->cooldown = 0;
        }

        $this->dispatch('vibe-toast', message: $message, type: 'info');
    }

    /**
     * Ambil daftar kode pemulihan cadangan yang aktif.
     */
    public function getRecoveryCodes(): void
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            return;
        }

        $authenticator = $user->twoFactorAuthenticators()->whereNotNull('recovery_codes')->first();
        if (! $authenticator) {
            $this->dispatch('vibe-toast', message: '2FA belum aktif pada akun ini.', type: 'error');
            return;
        }

        $this->recoveryCodes = $authenticator->recovery_codes ?? [];
        $this->dispatch('open-modal', 'modal-2fa-recovery');
    }

    /**
     * Buat ulang (regenerasi) kode pemulihan baru.
     */
    public function regenerateRecoveryCodes(): void
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            return;
        }

        $authenticator = $user->twoFactorAuthenticators()->whereNotNull('confirmed_at')->first();
        if (! $authenticator) {
            $this->dispatch('vibe-toast', message: '2FA belum aktif pada akun ini.', type: 'error');
            return;
        }

        $recoveryCodes = $user->generateTwoFactorRecoveryCodes();
        $authenticator->recovery_codes = $recoveryCodes;
        $authenticator->save();

        $this->recoveryCodes = $recoveryCodes;
        $this->dispatch('vibe-toast', message: 'Kode pemulihan baru berhasil dibuat.', type: 'success');
    }

    public function render()
    {
        return view('livewire.settings.two-factor');
    }
}
