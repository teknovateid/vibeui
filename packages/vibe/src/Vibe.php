<?php

namespace Teknovate\VibeUi;

use Illuminate\Foundation\Vite;
use Teknovate\VibeUi\Models\TwoFactorAuthenticator;

class Vibe
{
    /**
     * The current version of Vibe UI.
     */
    const VERSION = '0.13.1';

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

    /**
     * Render layout or view-level style/script tags from Vite paths or public/external URLs.
     *
     * @param  array<int, string>|string  $styles
     * @param  array<int, string>|string  $scripts
     */
    public static function renderAssetTags(array|string $styles = [], array|string $scripts = []): string
    {
        $normalizeList = static function (array|string $items): array {
            $list = is_string($items) ? [$items] : $items;
            $cleaned = [];
            foreach ($list as $item) {
                if (! is_string($item)) {
                    continue;
                }
                $trimmed = trim($item);
                if ($trimmed !== '') {
                    $cleaned[] = $trimmed;
                }
            }

            return array_values(array_unique($cleaned));
        };

        $styleList = $normalizeList($styles);
        $scriptList = $normalizeList($scripts);

        if ($styleList === [] && $scriptList === []) {
            return '';
        }

        $viteEntries = [];
        $externalTags = [];

        $isExternalOrPublic = static fn (string $path): bool => (bool) preg_match('/^(?:https?:)?\/\/|^\//i', $path);

        foreach ($styleList as $style) {
            if ($isExternalOrPublic($style)) {
                $externalTags[] = '<link rel="stylesheet" href="'.e($style).'" data-navigate-once="true" />';
            } else {
                $viteEntries[] = ltrim($style, './');
            }
        }

        foreach ($scriptList as $script) {
            if ($isExternalOrPublic($script)) {
                $externalTags[] = '<script type="module" src="'.e($script).'" data-navigate-once="true"></script>';
            } else {
                $viteEntries[] = ltrim($script, './');
            }
        }

        $viteOutput = '';
        $viteEntries = array_values(array_unique(array_filter(
            $viteEntries,
            static fn (string $entry): bool => file_exists(base_path($entry))
        )));

        if ($viteEntries !== [] && class_exists(Vite::class) && app()->bound(Vite::class)) {
            $vite = app(Vite::class);
            $manifestPath = public_path('build/manifest.json');
            if (! $vite->isRunningHot() && file_exists($manifestPath)) {
                $manifest = json_decode((string) file_get_contents($manifestPath), true);
                if (is_array($manifest)) {
                    $viteEntries = array_values(array_filter(
                        $viteEntries,
                        static fn (string $entry): bool => isset($manifest[$entry])
                    ));
                }
            }

            if ($viteEntries !== []) {
                try {
                    $viteOutput = (string) $vite($viteEntries);
                } catch (\Throwable $e) {
                    $viteOutput = '';
                }
            }
        }

        return trim($viteOutput."\n".implode("\n", $externalTags));
    }

    /**
     * Build a safe inline CSS custom property declaration string (prefixed with --vibe-layout- unless prefixed with --).
     *
     * @param  array<string, scalar|null>  $vars
     */
    public static function cssVarsStyle(array $vars = []): string
    {
        if ($vars === []) {
            return '';
        }

        $declarations = [];

        foreach ($vars as $name => $value) {
            if (! is_string($name) || $value === null || is_array($value) || is_object($value)) {
                continue;
            }

            $rawKey = trim($name);
            if ($rawKey === '') {
                continue;
            }

            $sanitizedKey = preg_replace('/[^a-zA-Z0-9_-]/', '', ltrim($rawKey, '-')) ?? '';
            if ($sanitizedKey === '') {
                continue;
            }

            $propName = str_starts_with($rawKey, '--')
                ? '--'.$sanitizedKey
                : (str_starts_with($sanitizedKey, 'vibe-layout-') ? '--'.$sanitizedKey : '--vibe-layout-'.$sanitizedKey);

            $rawValue = trim((string) $value);
            if ($rawValue === '') {
                continue;
            }

            if (preg_match('/[;{}<>]|(?:expression\s*\(|javascript\s*:|vbscript\s*:|url\s*\()/i', $rawValue)) {
                continue;
            }

            $declarations[] = "{$propName}: {$rawValue}";
        }

        return implode('; ', $declarations);
    }
}
