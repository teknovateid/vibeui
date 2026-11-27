<?php

namespace Teknovate\VibeUi;

use Teknovate\VibeUi\Models\TwoFactorAuthenticator;

class Vibe
{
    /**
     * The current version of Vibe UI.
     */
    const VERSION = '0.12.1';

    /**
     * The custom model class for Two Factor Authenticator.
     */
    protected static ?string $twoFactorModel = null;

    /**
     * The custom notification class for Two Factor Code.
     */
    protected static ?string $twoFactorNotification = null;

    /**
     * Get the current Vibe UI version.
     */
    public static function version(): string
    {
        return self::VERSION;
    }

    /**
     * Set the custom model class name to use for Two Factor Authenticator.
     */
    public static function useTwoFactorModel(string $model): void
    {
        static::$twoFactorModel = $model;
    }

    /**
     * Get the Two Factor Authenticator model class name.
     */
    public static function twoFactorModel(): string
    {
        return static::$twoFactorModel
            ?? config('vibe.models.two_factor', TwoFactorAuthenticator::class);
    }

    /**
     * Set the custom notification class name to use for 2FA verification code.
     */
    public static function useTwoFactorNotification(string $notification): void
    {
        static::$twoFactorNotification = $notification;
    }

    /**
     * Get the Two Factor Code notification class name.
     */
    public static function twoFactorNotification(): string
    {
        return static::$twoFactorNotification
            ?? config('vibe.notifications.two_factor_code', \Teknovate\VibeUi\Notifications\TwoFactorCodeNotification::class);
    }

    /**
     * Get the TwoFactorManager service instance.
     */
    public static function twoFactor(): \Teknovate\VibeUi\Services\TwoFactorManager
    {
        return app(\Teknovate\VibeUi\Services\TwoFactorManager::class);
    }

    /**
     * Get the QrLoginManager instance (supports swapping or extending drivers).
     */
    public static function qrLogin(): \Teknovate\VibeUi\Services\QrLogin\QrLoginManager
    {
        return app(\Teknovate\VibeUi\Services\QrLogin\QrLoginManager::class);
    }

    /**
     * Parse and interpolate dynamic variables in editor HTML template.
     * Replaces both <span class="vibe-editor-variable" data-variable="..."> badges and raw {{ model.column }} tokens.
     *
     * @param  string  $content  HTML content containing variables
     * @param  array  $data  Data array or Eloquent models (e.g. ['user' => $user, 'order' => $order])
     * @param  bool  $escape  Whether to escape variable replacement values against XSS (default: true)
     * @param  bool  $stripMissing  Whether to strip unparsed variable badges/tokens from output (default: false)
     * @return string Parsed clean HTML ready for email, PDF, or display
     */
    public static function parseTemplate(string $content, array $data = [], bool $escape = true, bool $stripMissing = false): string
    {
        if (empty($content)) {
            return '';
        }

        // 1. Replace <span class="vibe-editor-variable"... data-variable="key">...</span>
        $content = preg_replace_callback(
            '/<span[^>]*class="[^"]*vibe-editor-variable[^"]*"[^>]*data-variable="([^"]+)"[^>]*>.*?<\/span>/is',
            function ($matches) use ($data, $escape, $stripMissing) {
                $key = trim($matches[1]);
                $val = array_key_exists($key, $data) ? $data[$key] : data_get($data, $key);

                if ($val !== null) {
                    return $escape ? htmlspecialchars((string) $val, ENT_QUOTES, 'UTF-8') : (string) $val;
                }

                return $stripMissing ? '' : $matches[0];
            },
            $content
        );

        // 2. Replace raw {{ variable.key }} tokens
        $content = preg_replace_callback(
            '/\{\{\s*([a-zA-Z0-9_\-\.]+)\s*\}\}/',
            function ($matches) use ($data, $escape, $stripMissing) {
                $key = trim($matches[1]);
                $val = array_key_exists($key, $data) ? $data[$key] : data_get($data, $key);

                if ($val !== null) {
                    return $escape ? htmlspecialchars((string) $val, ENT_QUOTES, 'UTF-8') : (string) $val;
                }

                return $stripMissing ? '' : $matches[0];
            },
            $content
        );

        return $content;
    }
}
