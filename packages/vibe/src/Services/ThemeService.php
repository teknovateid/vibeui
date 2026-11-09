<?php

namespace Teknovate\VibeUi\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Teknovate\VibeUi\Models\ThemeSetting;

class ThemeService
{
    /**
     * Get the configured ThemeSetting model class.
     */
    protected function getModelClass(): string
    {
        return Config::get('vibe.models.theme_setting', ThemeSetting::class);
    }

    /**
     * Get the cache key for global theme settings.
     */
    public function getCacheKey(): string
    {
        return Config::get('vibe.theme.cache_key', 'vibe:theme:global');
    }

    /**
     * Get the global theme configuration from cache (or database).
     */
    public function getGlobalTheme(): array
    {
        return Cache::rememberForever($this->getCacheKey(), function () {
            try {
                $modelClass = $this->getModelClass();
                $setting = $modelClass::where('key', 'global')->first();

                if (! $setting) {
                    return [
                        'tokens' => null,
                        'css' => null,
                        'is_locked' => false,
                        'updated_by' => null,
                        'updated_at' => null,
                    ];
                }

                return [
                    'tokens' => $setting->tokens,
                    'css' => $setting->css,
                    'is_locked' => (bool) $setting->is_locked,
                    'updated_by' => $setting->updated_by,
                    'updated_at' => $setting->updated_at?->toIso8601String(),
                ];
            } catch (\Throwable $e) {
                return [
                    'tokens' => null,
                    'css' => null,
                    'is_locked' => false,
                    'updated_by' => null,
                    'updated_at' => null,
                ];
            }
        });
    }

    /**
     * Save global theme configuration to database and update cache.
     */
    public function saveGlobalTheme(array $tokens, ?string $css = null, bool $isLocked = false, ?string $updatedBy = null): array
    {
        $modelClass = $this->getModelClass();
        $setting = $modelClass::updateOrCreate(
            ['key' => 'global'],
            [
                'tokens' => $tokens,
                'css' => $css,
                'is_locked' => $isLocked,
                'updated_by' => $updatedBy,
            ]
        );

        $this->clearCache();

        return $this->getGlobalTheme();
    }

    /**
     * Reset global theme configuration and flush cache.
     */
    public function resetGlobalTheme(): void
    {
        $modelClass = $this->getModelClass();
        $modelClass::where('key', 'global')->delete();
        $this->clearCache();
    }

    /**
     * Clear the global theme cache.
     */
    public function clearCache(): void
    {
        Cache::forget($this->getCacheKey());
    }

    /**
     * Check if global theme is enforced / locked.
     */
    public function isLocked(): bool
    {
        $theme = $this->getGlobalTheme();

        return ! empty($theme['is_locked']);
    }

    /**
     * Check if current user / guest can manage global theme.
     * If developer defines a Gate, it evaluates the Gate. Otherwise, defaults to unrestricted.
     */
    public function canManage($user = null): bool
    {
        $gateName = Config::get('vibe.theme.gate');

        if ($gateName && Gate::has($gateName)) {
            return $user ? Gate::forUser($user)->allows($gateName) : Gate::allows($gateName);
        }

        return true;
    }
}
