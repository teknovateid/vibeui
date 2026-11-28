<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\select;

class AuthCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vibe:auth
        {--layout= : The auth layout variant (card, simple, split)}
        {--login-by= : Login identifier mode (email, username, phone, email_or_username, any)}
        {--without-passkeys : Scaffold authentication without Passkeys (WebAuthn)}
        {--with-passkeys : Force enable Passkeys without prompting}
        {--without-qr-login : Scaffold authentication without QR Code login}
        {--with-qr-login : Force enable QR Code login without prompting}
        {--migrate : Run database migrations after scaffolding}
        {--force : Overwrite existing files (default behavior)}
        {--skip-existing : Skip overwriting files that already exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold Flux UI-inspired authentication components and views';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->newLine();
        $this->components->info('Scaffolding Vibe UI Authentication System...');

        $layout = $this->option('layout');
        if (! $layout || ! in_array($layout, ['card', 'simple', 'split'])) {
            $layout = select(
                label: 'Choose your default Auth Layout variant:',
                options: [
                    'card' => 'Card (Centered elevated container — Recommended)',
                    'simple' => 'Simple (Centered clean minimalist flow)',
                    'split' => 'Split (2-Column split screen with branding sidebar)',
                ],
                default: 'card'
            );
        }

        $loginBy = $this->option('login-by');
        if (! $loginBy || ! in_array($loginBy, ['email', 'username', 'phone', 'email_or_username', 'any'])) {
            $loginBy = select(
                label: 'Choose your default login credential mode:',
                options: [
                    'email' => 'Email only (Standard Laravel default)',
                    'email_or_username' => 'Email or Username (Auto-detects format)',
                    'any' => 'Any (Auto-detects Email, Username, or Phone)',
                    'username' => 'Username only',
                    'phone' => 'Phone only',
                ],
                default: 'email'
            );
        }

        $withoutPasskeys = (bool) $this->option('without-passkeys');
        $withPasskeys = (bool) $this->option('with-passkeys');

        if ($withoutPasskeys) {
            $enablePasskeys = false;
        } elseif ($withPasskeys) {
            $enablePasskeys = true;
        } elseif ($this->input->isInteractive()) {
            $enablePasskeys = confirm(
                label: 'Do you want to enable Passkey (WebAuthn / Biometric) authentication?',
                default: true
            );
        } else {
            $enablePasskeys = true;
        }

        $withoutQrLogin = (bool) $this->option('without-qr-login');
        $withQrLogin = (bool) $this->option('with-qr-login');

        if ($withoutQrLogin) {
            $enableQrLogin = false;
        } elseif ($withQrLogin) {
            $enableQrLogin = true;
        } elseif ($this->input->isInteractive()) {
            $enableQrLogin = confirm(
                label: 'Do you want to enable QR Code cross-device login (Pusher default, swappable broadcast driver)?',
                default: true
            );
        } else {
            $enableQrLogin = true;
        }

        $force = (bool) $this->option('force') || ! (bool) $this->option('skip-existing');
        $packageRoot = __DIR__.'/../..';

        // 1. Publish Auth Layouts
        $this->components->task('Publishing Auth Layouts', function () use ($force, $packageRoot) {
            $this->publishDirectoryFiles(
                "{$packageRoot}/resources/views/auth/layouts",
                $this->targetResourcePath('views/auth/layouts'),
                $force,
                recursive: true
            );
        });

        // 2. Publish Livewire Concern Trait
        $this->components->task('Publishing AuthenticatesUsers Concern', function () use ($force, $packageRoot) {
            $this->publishDirectoryFiles(
                "{$packageRoot}/app/Livewire/Auth/Concerns",
                $this->targetAppPath('Livewire/Auth/Concerns'),
                $force,
                recursive: true
            );
        });

        // 3. Publish Livewire Components (Auth & Settings)
        $this->components->task('Publishing Livewire Auth & Settings Components', function () use ($force, $packageRoot) {
            $this->publishDirectoryFiles(
                "{$packageRoot}/app/Livewire/Auth",
                $this->targetAppPath('Livewire/Auth'),
                $force,
                recursive: false
            );

            $this->publishDirectoryFiles(
                "{$packageRoot}/app/Livewire/Settings",
                $this->targetAppPath('Livewire/Settings'),
                $force,
                recursive: true
            );
        });

        // 4. Publish Auth & Settings Views
        $this->components->task('Publishing Auth & Settings Views', function () use ($force, $packageRoot) {
            $this->publishDirectoryFiles(
                "{$packageRoot}/resources/views/auth",
                $this->targetResourcePath('views/auth'),
                $force,
                recursive: false
            );

            $this->publishDirectoryFiles(
                "{$packageRoot}/resources/views/livewire/settings",
                $this->targetResourcePath('views/livewire/settings'),
                $force,
                recursive: true
            );
        });

        // 5. Publish Routes
        $this->components->task('Registering Auth Routes', function () use ($force, $packageRoot) {
            $this->publishSingleFile(
                "{$packageRoot}/routes/auth.php",
                $this->targetBasePath('routes/auth.php'),
                $force
            );

            // Register in bootstrap/app.php
            $this->registerRouteInBootstrap();
        });

        // 6. Publish Auth Language Files
        $this->components->task('Publishing Auth Language Files', function () use ($force) {
            foreach (['id', 'en'] as $locale) {
                $this->publishSingleFile(
                    __DIR__."/../../lang/{$locale}/auth.php",
                    $this->targetLangPath("{$locale}/auth.php"),
                    $force
                );

                $this->publishDirectoryFiles(
                    __DIR__."/../../lang/{$locale}/auth",
                    $this->targetLangPath("{$locale}/auth"),
                    $force,
                    recursive: true
                );
            }
        });

        // 7. Update Configuration
        $this->components->task('Updating config/vibe.php settings', function () use ($loginBy, $layout, $enablePasskeys, $enableQrLogin) {
            $configFile = $this->targetConfigPath('vibe.php');
            if (File::exists($configFile)) {
                $content = File::get($configFile);
                if (str_contains($content, "'auth' => [")) {
                    $loginByFormatted = match ($loginBy) {
                        'email' => "['email']",
                        'username' => "['username']",
                        'phone' => "['phone']",
                        'email_or_username' => "['email', 'username']",
                        'any' => "['email', 'username', 'phone']",
                        default => "['email']",
                    };
                    $content = preg_replace(
                        "/'login_by'\s*=>\s*(\[[^\]]*\]|[^,\n]+)/",
                        "'login_by' => {$loginByFormatted}",
                        $content
                    );
                    $content = preg_replace(
                        "/'default_layout'\s*=>\s*[^,\n]+/",
                        "'default_layout' => '{$layout}'",
                        $content
                    );
                    if (str_contains($content, "'passkeys_enabled'")) {
                        $passkeyBool = $enablePasskeys ? 'true' : 'false';
                        $content = preg_replace(
                            "/'passkeys_enabled'\s*=>\s*[^,\n]+/",
                            "'passkeys_enabled' => {$passkeyBool}",
                            $content
                        );
                    }
                    File::put($configFile, $content);

                    $envFile = $this->targetBasePath('.env');
                    if (File::exists($envFile)) {
                        $envContent = File::get($envFile);
                        $passkeyValue = $enablePasskeys ? 'true' : 'false';
                        if (str_contains($envContent, 'PASSKEYS_ENABLED=')) {
                            $envContent = preg_replace('/PASSKEYS_ENABLED=[^\r\n]*/', "PASSKEYS_ENABLED={$passkeyValue}", $envContent);
                        } else {
                            $envContent .= "\nPASSKEYS_ENABLED={$passkeyValue}\n";
                        }

                        $qrLoginValue = $enableQrLogin ? 'true' : 'false';
                        if (str_contains($envContent, 'VIBE_QR_LOGIN_ENABLED=')) {
                            $envContent = preg_replace('/VIBE_QR_LOGIN_ENABLED=[^\r\n]*/', "VIBE_QR_LOGIN_ENABLED={$qrLoginValue}", $envContent);
                        } else {
                            $envContent .= "VIBE_QR_LOGIN_ENABLED={$qrLoginValue}\n";
                        }
                        if (! str_contains($envContent, 'VIBE_QR_LOGIN_DRIVER=')) {
                            $envContent .= "VIBE_QR_LOGIN_DRIVER=pusher\n";
                        }
                        if (! str_contains($envContent, 'VIBE_QR_LOGIN_TTL=')) {
                            $envContent .= "VIBE_QR_LOGIN_TTL=120\n";
                        }
                        if (! str_contains($envContent, 'VIBE_QR_LOGIN_AUTO_REFRESH=')) {
                            $envContent .= "VIBE_QR_LOGIN_AUTO_REFRESH=true\n";
                        }
                        if (! str_contains($envContent, 'VIBE_QR_LOGIN_MAX_AUTO_REFRESH=')) {
                            $envContent .= "VIBE_QR_LOGIN_MAX_AUTO_REFRESH=0\n";
                        }

                        File::put($envFile, $envContent);
                    }
                }
            }
        });

        if ($enablePasskeys) {
            // 8. Publish Passkeys Configuration
            $this->components->task('Publishing Passkeys Configuration', function () use ($force, $packageRoot) {
                $dest = $this->targetConfigPath('passkeys.php');
                if ($force || ! File::exists($dest)) {
                    $src = "{$packageRoot}/config/passkeys.php";
                    if (! File::exists($src)) {
                        $src = base_path('vendor/laravel/passkeys/config/passkeys.php');
                    }

                    if (File::exists($src)) {
                        $this->publishSingleFile($src, $dest, $force);
                    } else {
                        $this->callSilent('vendor:publish', ['--tag' => 'passkeys-config', '--force' => true]);
                    }
                }
            });
        }

        if ($enablePasskeys || $enableQrLogin) {
            // 9. Ensure Vite Assets & NPM Dependencies for Passkeys & QR Login
            $this->components->task('Ensuring Vite assets and Auth JS dependencies', function () use ($force, $enablePasskeys, $enableQrLogin) {
                $assetsToSync = [];
                if ($enablePasskeys) {
                    $assetsToSync[] = 'passkeys.js';
                }
                if ($enableQrLogin) {
                    $assetsToSync[] = 'qr-login.js';
                    $assetsToSync[] = 'qrcode.js';
                }

                $needsVendorPublishFallback = false;
                foreach ($assetsToSync as $assetFile) {
                    $src = __DIR__."/../../resources/js/vibe/{$assetFile}";
                    $dest = $this->targetResourcePath("js/vibe/{$assetFile}");

                    if (File::exists($src)) {
                        $this->publishSingleFile($src, $dest, $force);
                    } elseif ($force || ! File::exists($dest)) {
                        $needsVendorPublishFallback = true;
                    }
                }

                if ($needsVendorPublishFallback) {
                    $this->callSilent('vendor:publish', ['--tag' => 'vibe-assets', '--force' => true]);
                }

                $installCmd = new InstallCommand;
                $installCmd->registerViteAssets($this->resolveViteConfigTargetPath());
                $installCmd->updateNpmDependencies($this->targetBasePath('package.json'));
            });
        }

        // 10. Publish Vibe Auth & 2FA Migration
        $this->components->task('Publishing Vibe Auth & 2FA Migration', function () use ($force, $packageRoot) {
            $existing = File::glob($this->targetDatabasePath('migrations/*_add_vibe_auth_tables.php'));

            if (empty($existing) || $force) {
                $timestamp = date('Y_m_d_His');
                $dest = ! empty($existing)
                    ? $existing[0]
                    : $this->targetDatabasePath("migrations/{$timestamp}_add_vibe_auth_tables.php");

                $src = "{$packageRoot}/stubs/database/migrations/add_vibe_auth_tables.php";

                $this->publishSingleFile($src, $dest, $force);
            }
        });

        if ($enablePasskeys) {
            // 11. Publish Passkeys Migration
            $this->components->task('Publishing Passkeys Migration', function () use ($force, $packageRoot) {
                $existing = File::glob($this->targetDatabasePath('migrations/*_create_passkeys_table.php'));

                if (empty($existing) || $force) {
                    $timestamp = date('Y_m_d_His');
                    $dest = ! empty($existing)
                        ? $existing[0]
                        : $this->targetDatabasePath("migrations/{$timestamp}_create_passkeys_table.php");

                    $src = "{$packageRoot}/stubs/database/migrations/create_passkeys_table.php";
                    if (! File::exists($src)) {
                        $src = base_path('vendor/laravel/passkeys/database/migrations/2024_01_01_000000_create_passkeys_table.php');
                    }

                    if (File::exists($src)) {
                        $this->publishSingleFile($src, $dest, $force);
                    } else {
                        $this->callSilent('vendor:publish', ['--tag' => 'passkeys-migrations', '--force' => true]);
                    }
                }
            });
        }

        // 12. Ensure User Model has Passkey & TwoFactorAuthenticatable traits and required fillables
        $this->components->task('Updating User Model Traits & Fillables', function () use ($enablePasskeys) {
            $userModel = $this->targetAppPath('Models/User.php');
            if (File::exists($userModel)) {
                $content = File::get($userModel);

                if ($enablePasskeys) {
                    // Add Passkey imports if not present
                    if (! str_contains($content, 'Laravel\Passkeys\Contracts\PasskeyUser')) {
                        $content = preg_replace(
                            '/(namespace App\\\\Models;)/',
                            "$1\n\nuse Laravel\\Passkeys\\Contracts\\PasskeyUser;",
                            $content
                        );
                    }
                    if (! str_contains($content, 'Laravel\Passkeys\PasskeyAuthenticatable')) {
                        $content = preg_replace(
                            '/(namespace App\\\\Models;)/',
                            "$1\n\nuse Laravel\\Passkeys\\PasskeyAuthenticatable;",
                            $content
                        );
                    }
                }

                // Add trait import if not present
                if (! str_contains($content, 'Teknovate\VibeUi\Traits\TwoFactorAuthenticatable')) {
                    $content = preg_replace(
                        '/(namespace App\\\\Models;)/',
                        "$1\n\nuse Teknovate\\VibeUi\\Traits\\TwoFactorAuthenticatable;",
                        $content
                    );
                }

                if ($enablePasskeys) {
                    // Add PasskeyUser interface to class declaration if not present
                    if (! preg_match('/class\s+User\b[^{]*\bPasskeyUser\b/s', $content)) {
                        if (preg_match('/(class\s+User\s+extends\s+Authenticatable\s+implements\s+)([^\{\n]+)/', $content)) {
                            $content = preg_replace(
                                '/(class\s+User\s+extends\s+Authenticatable\s+implements\s+)([^\{\n]+)/',
                                '$1$2, PasskeyUser',
                                $content
                            );
                        } elseif (preg_match('/(class\s+User\s+extends\s+Authenticatable)/', $content)) {
                            $content = preg_replace(
                                '/(class\s+User\s+extends\s+Authenticatable)/',
                                '$1 implements PasskeyUser',
                                $content
                            );
                        }
                    }

                    // Add PasskeyAuthenticatable trait to class if not present
                    if (! preg_match('/class\s+User\b[^{]*\{[^}]*\bPasskeyAuthenticatable\b/s', $content)) {
                        $content = preg_replace(
                            '/(\buse\s+HasFactory,\s*Notifiable)/',
                            '$1, PasskeyAuthenticatable',
                            $content
                        );
                    }
                }

                // Add TwoFactorAuthenticatable trait to class if not present
                if (! preg_match('/class\s+User\b[^{]*\{[^}]*\bTwoFactorAuthenticatable\b/s', $content)) {
                    $content = preg_replace(
                        '/(\buse\s+HasFactory,\s*Notifiable(?:,\s*PasskeyAuthenticatable)?)/',
                        '$1, TwoFactorAuthenticatable',
                        $content
                    );
                }

                // Ensure username, phone, and avatar in fillable if not present
                if (! str_contains($content, "'username'")) {
                    $content = preg_replace(
                        "/'name',/",
                        "'name',\n        'username',\n        'phone',\n        'avatar',",
                        $content
                    );
                } elseif (! str_contains($content, "'avatar'")) {
                    $content = preg_replace(
                        "/'name',/",
                        "'name',\n        'avatar',",
                        $content
                    );
                }

                File::put($userModel, $content);
            }
        });

        // 13. Optional Migrations Run
        if ($this->option('migrate')) {
            $this->components->task('Running Database Migrations', function () {
                $this->call('migrate', ['--force' => true]);
            });
        }

        $this->newLine();
        $this->components->info('Authentication system scaffolded successfully!');
        $this->line(" <fg=gray>Default Layout: <fg=white>{$layout}</> | Credential Mode: <fg=white>{$loginBy}</></>");
        $this->line(' <fg=gray>You can now test the routes at: <fg=cyan>/login</>, <fg=cyan>/register</>, and <fg=cyan>/forgot-password</></>');
        if (! $this->option('migrate')) {
            $this->newLine();
            if ($enablePasskeys) {
                $this->line(' <fg=yellow>Reminder:</> Run <fg=white;options=bold>php artisan migrate</> to create the user, 2FA, and passkeys database tables.');
            } else {
                $this->line(' <fg=yellow>Reminder:</> Run <fg=white;options=bold>php artisan migrate</> to create the user and 2FA database tables.');
            }
        }
        $this->newLine();
    }

    protected function publishDirectoryFiles(string $srcDir, string $destDir, bool $overwrite, bool $recursive = false): void
    {
        if (! File::isDirectory($srcDir)) {
            return;
        }

        File::ensureDirectoryExists($destDir);
        $files = $recursive ? File::allFiles($srcDir) : File::files($srcDir);

        foreach ($files as $file) {
            $relative = $recursive ? $file->getRelativePathname() : $file->getFilename();
            $dest = $destDir.DIRECTORY_SEPARATOR.$relative;

            $this->publishSingleFile($file->getPathname(), $dest, $overwrite);
        }
    }

    protected function publishSingleFile(string $src, string $dest, bool $overwrite): void
    {
        if (! File::exists($src)) {
            return;
        }

        if ($overwrite || ! File::exists($dest)) {
            File::ensureDirectoryExists(dirname($dest));
            File::copy($src, $dest);
        }
    }

    protected function resolveViteConfigTargetPath(): ?string
    {
        foreach (['vite.config.js', 'vite.config.ts', 'vite.config.mjs'] as $file) {
            $candidate = $this->targetBasePath($file);
            if (File::exists($candidate)) {
                return $candidate;
            }
        }

        return null;
    }

    protected function targetBasePath(string $path = ''): string
    {
        return base_path($path);
    }

    protected function targetAppPath(string $path = ''): string
    {
        return app_path($path);
    }

    protected function targetResourcePath(string $path = ''): string
    {
        return resource_path($path);
    }

    protected function targetConfigPath(string $path = ''): string
    {
        return config_path($path);
    }

    protected function targetDatabasePath(string $path = ''): string
    {
        return database_path($path);
    }

    protected function targetLangPath(string $path = ''): string
    {
        return lang_path($path);
    }

    protected function registerRouteInBootstrap(): void
    {
        $appFile = $this->targetBasePath('bootstrap/app.php');
        if (! File::exists($appFile)) {
            return;
        }

        $content = File::get($appFile);
        if (str_contains($content, 'routes/auth.php')) {
            return;
        }

        // Case 1: web: is already an array (e.g. web: [ ... ])
        if (preg_match('/web:\s*\[/s', $content)) {
            $updated = preg_replace(
                '/(web:\s*\[)/',
                "$1\n            __DIR__ . '/../routes/auth.php',",
                $content
            );
            if ($updated && $updated !== $content) {
                File::put($appFile, $updated);

                return;
            }
        }

        // Case 2: web: is a single route file string (e.g. web: __DIR__.'/../routes/web.php', or web: __DIR__ . '/../routes/web.php',)
        if (preg_match('/web:\s*(__DIR__\s*\.\s*[\'"][^\'"]+[\'"])\s*,/', $content, $matches)) {
            $originalRoute = $matches[1];
            $replacement = "web: [\n            {$originalRoute},\n            __DIR__ . '/../routes/auth.php',\n        ],";
            $updated = str_replace($matches[0], $replacement, $content);
            if ($updated && $updated !== $content) {
                File::put($appFile, $updated);

                return;
            }
        }

        // Case 3: Generic fallback for web: <expression>,
        if (preg_match('/web:\s*([^,\n]+),/', $content, $matches)) {
            $expr = trim($matches[1]);
            $replacement = "web: [\n            {$expr},\n            __DIR__ . '/../routes/auth.php',\n        ],";
            $updated = str_replace($matches[0], $replacement, $content);
            if ($updated && $updated !== $content) {
                File::put($appFile, $updated);
            }
        }
    }
}
