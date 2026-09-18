<?php

namespace App\Livewire\Auth\Concerns;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait AuthenticatesUsers
{
    /**
     * Get the active login credential fields.
     * e.g. ['email'], ['email', 'username'], ['email', 'phone'], ['email', 'username', 'phone']
     *
     * @return array<string>
     */
    public function loginBy(): array
    {
        $config = config('vibe.auth.login_by', ['email']);

        if (is_string($config)) {
            $config = match ($config) {
                'email' => ['email'],
                'username' => ['username'],
                'phone' => ['phone'],
                'email_or_username' => ['email', 'username'],
                'any' => ['email', 'username', 'phone'],
                default => array_map('trim', explode(',', $config)),
            };
        }

        $fields = array_values(array_filter((array) $config));

        return !empty($fields) ? $fields : ['email'];
    }

    /**
     * Check if email is the only allowed credential.
     */
    public function isOnlyEmail(): bool
    {
        return $this->loginBy() === ['email'];
    }

    /**
     * Get the display label for the login field.
     */
    public function getLoginLabel(): string
    {
        $fields = $this->loginBy();

        if (count($fields) === 1) {
            return match ($fields[0]) {
                'username' => __('auth/fields.username'),
                'phone' => __('auth/fields.phone'),
                default => __('auth/fields.email'),
            };
        }

        $hasEmail = in_array('email', $fields, true);
        $hasUsername = in_array('username', $fields, true);
        $hasPhone = in_array('phone', $fields, true);

        if ($hasEmail && $hasUsername && $hasPhone) {
            return __('auth/fields.all_credentials');
        }

        if ($hasEmail && $hasUsername) {
            return __('auth/fields.email_or_username');
        }

        if ($hasEmail && $hasPhone) {
            return __('auth/fields.email_or_phone');
        }

        if ($hasUsername && $hasPhone) {
            return __('auth/fields.username_or_phone');
        }

        return __('auth/fields.credentials');
    }

    /**
     * Get the placeholder for the login field.
     */
    public function getLoginPlaceholder(): string
    {
        $fields = $this->loginBy();

        if (count($fields) === 1) {
            return match ($fields[0]) {
                'username' => __('auth/fields.username_placeholder'),
                'phone' => __('auth/fields.phone_placeholder'),
                default => __('auth/fields.email_placeholder'),
            };
        }

        $hasEmail = in_array('email', $fields, true);
        $hasUsername = in_array('username', $fields, true);
        $hasPhone = in_array('phone', $fields, true);

        if ($hasEmail && $hasUsername && $hasPhone) {
            return __('auth/fields.email_placeholder').', '.__('auth/fields.username_placeholder').', '.__('auth/fields.phone_placeholder');
        }

        if ($hasEmail && $hasUsername) {
            return __('auth/fields.email_placeholder').' / '.__('auth/fields.username_placeholder');
        }

        if ($hasEmail && $hasPhone) {
            return __('auth/fields.email_placeholder').' / '.__('auth/fields.phone_placeholder');
        }

        if ($hasUsername && $hasPhone) {
            return __('auth/fields.username_placeholder').' / '.__('auth/fields.phone_placeholder');
        }

        return __('auth/fields.credentials_placeholder');
    }

    /**
     * Automatically determine the database column for the provided login input.
     */
    public function findLoginField(string $input): string
    {
        $fields = $this->loginBy();

        if (count($fields) === 1) {
            return $fields[0];
        }

        // Auto-detect email if email is in allowed fields
        if (in_array('email', $fields, true) && filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }

        // Auto-detect phone if phone is in allowed fields
        if (in_array('phone', $fields, true)) {
            $digits = preg_replace('/[^0-9]/', '', $input);
            if (strlen($digits) >= 8 && preg_match('/^[0-9\+\-\s\(\)]+$/', $input)) {
                return 'phone';
            }
        }

        // Fallback to username if allowed
        if (in_array('username', $fields, true)) {
            return 'username';
        }

        return $fields[0] ?? 'email';
    }

    /**
     * Resolve the credentials array for Auth::attempt.
     */
    public function resolveCredentials(string $login, string $password): array
    {
        $field = $this->findLoginField(trim($login));

        return [
            $field => trim($login),
            'password' => $password,
        ];
    }

    /**
     * Generate the throttle key for rate limiting.
     */
    public function throttleKey(string $login): string
    {
        return Str::transliterate(Str::lower(trim($login)).'|'.request()->ip());
    }

    /**
     * Get the redirect URL after successful authentication.
     * Supports both route names (e.g. 'docs.index') and URL paths (e.g. '/docs').
     */
    public function redirectAfterLoginUrl(): string
    {
        return static::redirectUrl();
    }

    /**
     * Resolve the target redirect URL from configuration.
     */
    public static function redirectUrl(): string
    {
        $target = config('vibe.auth.redirect_after_login', '/docs');

        if (is_string($target) && Route::has($target)) {
            return route($target);
        }

        return url($target ?: '/');
    }

    /**
     * Resolve the auth layout view name.
     * e.g. 'auth.layouts.card', 'auth.layouts.simple', 'auth.layouts.split'
     */
    public function resolveAuthLayout(): string
    {
        $layout = request()->query('layout', config('vibe.auth.default_layout', 'card'));

        if (! in_array($layout, ['card', 'simple', 'split'])) {
            $layout = 'card';
        }

        return "auth.layouts.{$layout}";
    }

    /**
     * Regenerasi session otentikasi: membersihkan session temporary (2FA),
     * meregenerasi session ID (anti session fixation), dan mencatat waktu aktivitas.
     */
    public function regenerateAuthSession(): void
    {
        session()->forget(['auth.2fa.user_id', 'auth.2fa.remember']);
        session()->regenerate();
        session()->put('auth.last_activity_time', time());
    }

    /**
     * Invalidate sesi pengguna saat logout dan meregenerasi token CSRF.
     */
    public function invalidateAuthSession(): void
    {
        session()->invalidate();
        session()->regenerateToken();
    }

    /**
     * Siapkan session untuk proses challenge Two-Factor Authentication.
     */
    public function initTwoFactorSession(mixed $userId, bool $remember = false): void
    {
        session()->regenerate();
        session()->put('auth.2fa.user_id', $userId);
        session()->put('auth.2fa.remember', $remember);
    }

    /**
     * Regenerasi session ID saat ini.
     */
    public function regenerateSession(): void
    {
        session()->regenerate();
    }
}
