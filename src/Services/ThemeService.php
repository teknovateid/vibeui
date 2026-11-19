<?php

namespace Teknovate\VibeUi\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Teknovate\VibeUi\Models\ThemeSetting;

class ThemeService
{
    public const VALID_STORAGE_MODES = ['hybrid', 'local_only', 'global_only'];

    /**
     * Normalize a storage mode string against allowed options.
     */
    public function normalizeStorageMode(?string $mode): ?string
    {
        if (! is_string($mode) || $mode === '') {
            return null;
        }

        return in_array($mode, self::VALID_STORAGE_MODES, true) ? $mode : null;
    }

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
     * Check whether the backing table has the dedicated storage_mode column.
     */
    protected function hasStorageModeColumn(string $modelClass): bool
    {
        try {
            return Schema::hasColumn((new $modelClass)->getTable(), 'storage_mode');
        } catch (\Throwable) {
            return false;
        }
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
                        'storage_mode' => null,
                        'tokens' => null,
                        'css' => null,
                        'is_locked' => false,
                        'updated_by' => null,
                        'updated_at' => null,
                    ];
                }

                $tokens = is_array($setting->tokens) ? $setting->tokens : null;
                $fallbackMode = is_array($tokens) ? ($tokens['_storage_mode'] ?? null) : null;
                if (is_array($tokens) && array_key_exists('_storage_mode', $tokens)) {
                    unset($tokens['_storage_mode']);
                    if ($tokens === []) {
                        $tokens = null;
                    }
                }

                return [
                    'storage_mode' => $this->normalizeStorageMode($setting->storage_mode ?? $fallbackMode),
                    'tokens' => $tokens,
                    'css' => $setting->css,
                    'is_locked' => (bool) $setting->is_locked,
                    'updated_by' => $setting->updated_by,
                    'updated_at' => $setting->updated_at?->toIso8601String(),
                ];
            } catch (\Throwable $e) {
                return [
                    'storage_mode' => null,
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
     * Get the effective theme storage mode (database override or config default).
     */
    public function getStorageMode(): string
    {
        $theme = $this->getGlobalTheme();
        $dbMode = $this->normalizeStorageMode($theme['storage_mode'] ?? null);

        if ($dbMode !== null) {
            return $dbMode;
        }

        $configMode = (string) Config::get('vibe.theme.storage_mode', 'hybrid');

        return $this->normalizeStorageMode($configMode) ?? 'hybrid';
    }

    /**
     * Save global theme configuration to database and update cache.
     */
    public function saveGlobalTheme(
        array $tokens,
        ?string $css = null,
        bool $isLocked = false,
        ?string $updatedBy = null,
        ?string $storageMode = null
    ): array {
        $modelClass = $this->getModelClass();
        $existing = $modelClass::where('key', 'global')->first();
        $hasColumn = $this->hasStorageModeColumn($modelClass);

        unset($tokens['_storage_mode']);

        $resolvedMode = $this->normalizeStorageMode($storageMode)
            ?? $this->normalizeStorageMode($existing?->storage_mode ?? ($existing?->tokens['_storage_mode'] ?? null));

        $attributes = [
            'tokens' => $tokens,
            'css' => $css,
            'is_locked' => $isLocked,
            'updated_by' => $updatedBy,
        ];

        if ($hasColumn) {
            $attributes['storage_mode'] = $resolvedMode;
        } elseif ($resolvedMode !== null) {
            $attributes['tokens']['_storage_mode'] = $resolvedMode;
        }

        $modelClass::updateOrCreate(
            ['key' => 'global'],
            $attributes
        );

        $this->clearCache();

        return $this->getGlobalTheme();
    }

    /**
     * Persist the active theme storage method ('hybrid', 'local_only', 'global_only') in database & cache.
     */
    public function saveStorageMode(string $storageMode, ?string $updatedBy = null): array
    {
        $normalizedMode = $this->normalizeStorageMode($storageMode);
        if ($normalizedMode === null) {
            throw new \InvalidArgumentException("Invalid theme storage mode [{$storageMode}].");
        }

        $modelClass = $this->getModelClass();
        $existing = $modelClass::where('key', 'global')->first();
        $hasColumn = $this->hasStorageModeColumn($modelClass);

        $tokens = is_array($existing?->tokens) ? $existing->tokens : null;

        $attributes = [
            'tokens' => $tokens,
            'css' => $existing?->css,
            'is_locked' => (bool) ($existing?->is_locked ?? false),
            'updated_by' => $updatedBy ?? $existing?->updated_by,
        ];

        if ($hasColumn) {
            $attributes['storage_mode'] = $normalizedMode;
        } else {
            $attributes['tokens'] = array_merge($tokens ?? [], ['_storage_mode' => $normalizedMode]);
        }

        $modelClass::updateOrCreate(
            ['key' => 'global'],
            $attributes
        );

        $this->clearCache();

        return $this->getGlobalTheme();
    }

    /**
     * Reset global theme visual tokens and flush cache while preserving configured storage mode.
     */
    public function resetGlobalTheme(): void
    {
        $modelClass = $this->getModelClass();
        $existing = $modelClass::where('key', 'global')->first();

        $persistedMode = $this->normalizeStorageMode(
            $existing?->storage_mode ?? (is_array($existing?->tokens) ? ($existing->tokens['_storage_mode'] ?? null) : null)
        );

        if ($existing && $persistedMode !== null) {
            $hasColumn = $this->hasStorageModeColumn($modelClass);
            $existing->update([
                'tokens' => $hasColumn ? null : ['_storage_mode' => $persistedMode],
                'css' => null,
                'is_locked' => false,
                'updated_by' => null,
            ]);
        } else {
            $modelClass::where('key', 'global')->delete();
        }

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
