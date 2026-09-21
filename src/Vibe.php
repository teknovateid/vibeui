<?php

namespace Teknovate\VibeUi;

use Teknovate\VibeUi\Models\TwoFactorAuthenticator;

class Vibe
{
    /**
     * The current version of Vibe UI.
     */
    const VERSION = '0.2.7';

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
}
