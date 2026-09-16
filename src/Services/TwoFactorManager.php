<?php

namespace Teknovate\VibeUi\Services;

use Illuminate\Support\Str;

class TwoFactorManager
{
    /**
     * Karakter standar Base32 (RFC 4648).
     */
    protected const BASE32_ALPHABET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

    /**
     * Generate kunci rahasia Base32 acak (kompatibel Google Authenticator & Authy).
     */
    public function generateSecretKey(int $length = 16): string
    {
        $alphabet = self::BASE32_ALPHABET;
        $secret = '';
        $maxIndex = strlen($alphabet) - 1;

        for ($i = 0; $i < $length; $i++) {
            $secret .= $alphabet[random_int(0, $maxIndex)];
        }

        return $secret;
    }

    /**
     * Generate URI skema otpauth:// untuk QR Code.
     */
    public function qrCodeUrl(string $issuer, string $accountName, string $secret): string
    {
        return sprintf(
            'otpauth://totp/%s:%s?secret=%s&issuer=%s&algorithm=SHA1&digits=6&period=30',
            rawurlencode($issuer),
            rawurlencode($accountName),
            rawurlencode($secret),
            rawurlencode($issuer)
        );
    }

    /**
     * Hitung kode TOTP 6-digit saat ini berdasarkan secret dan timestamp (RFC 6238).
     */
    public function calculateOtp(string $secret, ?int $timestamp = null, int $digits = 6, int $period = 30): string
    {
        $timestamp = $timestamp ?? time();
        $timeCounter = (int) floor($timestamp / $period);

        $binarySecret = $this->base32Decode($secret);

        // Ubah time counter ke 8-byte big-endian binary (64-bit integer)
        $binaryTime = pack('N*', 0) . pack('N*', $timeCounter);

        // Hitung HMAC-SHA1
        $hash = hash_hmac('sha1', $binaryTime, $binarySecret, true);

        // Dynamic Truncation sesuai RFC 4226
        $offset = ord(substr($hash, -1)) & 0x0F;
        $truncatedHash = (
            ((ord($hash[$offset]) & 0x7F) << 24) |
            ((ord($hash[$offset + 1]) & 0xFF) << 16) |
            ((ord($hash[$offset + 2]) & 0xFF) << 8) |
            (ord($hash[$offset + 3]) & 0xFF)
        );

        $otp = $truncatedHash % (10 ** $digits);

        return str_pad((string) $otp, $digits, '0', STR_PAD_LEFT);
    }

    /**
     * Verifikasi kode token 6 digit dengan window toleransi drift waktu (±30 detik).
     */
    public function verifyOtp(string $secret, string $otp, int $window = 1, ?int $timestamp = null, int $digits = 6, int $period = 30): bool
    {
        $cleanOtp = trim(str_replace(' ', '', $otp));

        if (strlen($cleanOtp) !== $digits || ! ctype_digit($cleanOtp)) {
            return false;
        }

        $timestamp = $timestamp ?? time();

        // Cek window toleransi waktu: -window ... +window
        for ($i = -$window; $i <= $window; $i++) {
            $checkTime = $timestamp + ($i * $period);
            $expectedOtp = $this->calculateOtp($secret, $checkTime, $digits, $period);

            if (hash_equals($expectedOtp, $cleanOtp)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Hasilkan array kode pemulihan acak.
     *
     * @return list<string>
     */
    public function generateRecoveryCodes(int $count = 8): array
    {
        $codes = [];

        for ($i = 0; $i < $count; $i++) {
            $codes[] = sprintf(
                '%s-%s-%s',
                Str::lower(Str::random(4)),
                Str::lower(Str::random(4)),
                Str::lower(Str::random(4))
            );
        }

        return $codes;
    }

    /**
     * Decode string Base32 menjadi biner.
     */
    protected function base32Decode(string $b32): string
    {
        $b32 = strtoupper(trim(str_replace('=', '', $b32)));
        $alphabet = self::BASE32_ALPHABET;
        $buffer = 0;
        $bitsLeft = 0;
        $binary = '';

        for ($i = 0, $len = strlen($b32); $i < $len; $i++) {
            $char = $b32[$i];
            $val = strpos($alphabet, $char);

            if ($val === false) {
                continue;
            }

            $buffer = ($buffer << 5) | $val;
            $bitsLeft += 5;

            if ($bitsLeft >= 8) {
                $bitsLeft -= 8;
                $binary .= chr(($buffer >> $bitsLeft) & 0xFF);
            }
        }

        return $binary;
    }

    /**
     * Hasilkan kode numerik acak (default 6-digit).
     */
    public function generateNumericOtp(int $length = 6): string
    {
        $min = 10 ** ($length - 1);
        $max = (10 ** $length) - 1;

        return (string) random_int($min, $max);
    }

    /**
     * Buat kode OTP baru untuk user berdasarkan metode dan simpan di cache terenkripsi.
     */
    public function createOtpForUser($user, string $method = 'email', int $ttlMinutes = 10): string
    {
        $otp = $this->generateNumericOtp(6);
        $userId = is_object($user) ? $user->getAuthIdentifier() : $user;
        $cacheKey = "vibe_2fa_otp_{$method}_{$userId}";

        \Illuminate\Support\Facades\Cache::put($cacheKey, [
            'hash' => \Illuminate\Support\Facades\Hash::make($otp),
            'expires_at' => now()->addMinutes($ttlMinutes)->timestamp,
        ], now()->addMinutes($ttlMinutes));

        return $otp;
    }

    /**
     * Verifikasi kode OTP yang dimasukkan user untuk metode tertentu.
     */
    public function verifyOtpForUser($user, string $method, string $code): bool
    {
        $cleanCode = trim(str_replace(' ', '', $code));
        if (strlen($cleanCode) < 6) {
            return false;
        }

        $userId = is_object($user) ? $user->getAuthIdentifier() : $user;
        $cacheKey = "vibe_2fa_otp_{$method}_{$userId}";
        $stored = \Illuminate\Support\Facades\Cache::get($cacheKey);

        if (! $stored || ! isset($stored['hash'])) {
            return false;
        }

        if (($stored['expires_at'] ?? 0) < time()) {
            \Illuminate\Support\Facades\Cache::forget($cacheKey);

            return false;
        }

        if (\Illuminate\Support\Facades\Hash::check($cleanCode, $stored['hash'])) {
            \Illuminate\Support\Facades\Cache::forget($cacheKey);

            return true;
        }

        return false;
    }

    /**
     * Kirim kode OTP aktif via Email.
     */
    public function sendEmailOtp($user, string $otp, int $ttlMinutes = 10): void
    {
        if (method_exists($user, 'notify')) {
            $notificationClass = \Teknovate\VibeUi\Vibe::twoFactorNotification();
            $user->notify(new $notificationClass($otp, $ttlMinutes));
        }
    }

    /**
     * Kirim kode OTP via WhatsApp.
     *
     * Data ($user, $otp, $phone, $message) sudah siap dan dipersiapkan secara penuh.
     * Integrasikan gateway penyedia (Fonnte, Wablas, Twilio WA, dll) di dalam fungsi ini saat siap diaktifkan.
     */
    public function sendWhatsAppOtp($user, string $otp, ?string $phone = null): bool
    {
        $targetPhone = $phone ?: ($user->phone ?? null);
        $appName = config('app.name', 'Vibe UI');
        $message = "*Kode Verifikasi 2FA {$appName}*\n\nKode verifikasi Anda adalah: *{$otp}*\n\nBerlaku selama 10 menit. Jangan bagikan kode ini kepada siapa pun.";

        // CATATAN: Fungsi pengiriman fisik belum diaktifkan sesuai permintaan.
        // Data pengiriman telah siap dan dicatat ke log sistem:
        \Illuminate\Support\Facades\Log::info("[2FA WhatsApp OTP STUB] Siap dikirim ke: {$targetPhone} | OTP: {$otp} | Pesan: {$message}");

        return true;
    }

    /**
     * Kirim kode OTP via SMS.
     *
     * Data ($user, $otp, $phone, $message) sudah siap dan dipersiapkan secara penuh.
     * Integrasikan gateway penyedia (Twilio SMS, RajaSMS, Zenziva, dll) di dalam fungsi ini saat siap diaktifkan.
     */
    public function sendSmsOtp($user, string $otp, ?string $phone = null): bool
    {
        $targetPhone = $phone ?: ($user->phone ?? null);
        $appName = config('app.name', 'Vibe UI');
        $message = "Kode verifikasi 2FA {$appName} Anda adalah: {$otp}. Berlaku selama 10 menit.";

        // CATATAN: Fungsi pengiriman fisik belum diaktifkan sesuai permintaan.
        // Data pengiriman telah siap dan dicatat ke log sistem:
        \Illuminate\Support\Facades\Log::info("[2FA SMS OTP STUB] Siap dikirim ke: {$targetPhone} | OTP: {$otp} | Pesan: {$message}");

        return true;
    }

    /**
     * Samarkan alamat email untuk tampilan UI yang aman (cth: fa***@gmail.com).
     */
    public function maskEmail(?string $email): string
    {
        if (! $email || ! str_contains($email, '@')) {
            return '';
        }

        [$name, $domain] = explode('@', $email, 2);
        $maskedName = strlen($name) <= 2
            ? substr($name, 0, 1) . '***'
            : substr($name, 0, 2) . '***' . substr($name, -1);

        return $maskedName . '@' . $domain;
    }

    /**
     * Samarkan nomor handphone untuk tampilan UI yang aman (cth: 0812****789).
     */
    public function maskPhone(?string $phone): string
    {
        if (! $phone) {
            return '';
        }

        $clean = preg_replace('/[^\d+]/', '', $phone);
        $len = strlen($clean);
        if ($len <= 5) {
            return $clean;
        }

        return substr($clean, 0, 4) . '****' . substr($clean, -3);
    }
}
