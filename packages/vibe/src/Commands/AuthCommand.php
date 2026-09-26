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
        {--migrate : Run database migrations after scaffolding}
        {--force : Overwrite existing files}';

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

        $force = (bool) $this->option('force');

        // 1. Publish Auth Layouts
        $this->components->task('Publishing Auth Layouts', function () use ($force) {
            $destDir = resource_path('views/auth/layouts');
            File::ensureDirectoryExists($destDir);

            $layoutsDir = __DIR__.'/../../stubs/Auth/layouts';
            if (File::isDirectory($layoutsDir)) {
                foreach (File::files($layoutsDir) as $file) {
                    $dest = "{$destDir}/{$file->getFilename()}";
                    if ($force || ! File::exists($dest)) {
                        File::copy($file->getPathname(), $dest);
                    }
                }
            }
        });

        // 2. Publish Livewire Concern Trait
        $this->components->task('Publishing AuthenticatesUsers Concern', function () use ($force) {
            $destDir = app_path('Livewire/Auth/Concerns');
            File::ensureDirectoryExists($destDir);

            $concernsDir = __DIR__.'/../../stubs/Auth/Concerns';
            if (File::isDirectory($concernsDir)) {
                foreach (File::files($concernsDir) as $file) {
                    $dest = "{$destDir}/{$file->getFilename()}";
                    if ($force || ! File::exists($dest)) {
                        File::copy($file->getPathname(), $dest);
                    }
                }
            }
        });

        // 3. Publish Livewire Components (Auth & Settings)
        $this->components->task('Publishing Livewire Auth & Settings Components', function () use ($force) {
            $authLivewireDir = __DIR__.'/../../stubs/Auth/Livewire';
            if (File::isDirectory($authLivewireDir)) {
                $destAuth = app_path('Livewire/Auth');
                File::ensureDirectoryExists($destAuth);
                foreach (File::files($authLivewireDir) as $file) {
                    $dest = "{$destAuth}/{$file->getFilename()}";
                    if ($force || ! File::exists($dest)) {
                        File::copy($file->getPathname(), $dest);
                    }
                }
            }

            $settingsLivewireDir = __DIR__.'/../../stubs/Auth/Livewire/Settings';
            if (File::isDirectory($settingsLivewireDir)) {
                $destSettings = app_path('Livewire/Settings');
                File::ensureDirectoryExists($destSettings);
                foreach (File::files($settingsLivewireDir) as $file) {
                    $dest = "{$destSettings}/{$file->getFilename()}";
                    if ($force || ! File::exists($dest)) {
                        File::copy($file->getPathname(), $dest);
                    }
                }
            }
        });

        // 4. Publish Auth & Settings Views
        $this->components->task('Publishing Auth & Settings Views', function () use ($force) {
            $authViewsDir = __DIR__.'/../../stubs/Auth/views';
            if (File::isDirectory($authViewsDir)) {
                $destAuthViews = resource_path('views/auth');
                File::ensureDirectoryExists($destAuthViews);
                foreach (File::files($authViewsDir) as $file) {
                    $dest = "{$destAuthViews}/{$file->getFilename()}";
                    if ($force || ! File::exists($dest)) {
                        File::copy($file->getPathname(), $dest);
                    }
                }
            }

            $settingsViewsDir = __DIR__.'/../../stubs/Auth/views/settings';
            if (File::isDirectory($settingsViewsDir)) {
                $destSettingsViews = resource_path('views/livewire/settings');
                File::ensureDirectoryExists($destSettingsViews);
                foreach (File::files($settingsViewsDir) as $file) {
                    $dest = "{$destSettingsViews}/{$file->getFilename()}";
                    if ($force || ! File::exists($dest)) {
                        File::copy($file->getPathname(), $dest);
                    }
                }
            }
        });

        // 5. Publish Routes
        $this->components->task('Registering Auth Routes', function () use ($force) {
            $src = base_path('routes/auth.php');
            if (! File::exists($src)) {
                $src = __DIR__.'/../../stubs/Auth/routes/auth.php';
            }
            $dest = base_path('routes/auth.php');

            if ($force || ! File::exists($dest)) {
                File::copy($src, $dest);
            }

            // Register in bootstrap/app.php
            $this->registerRouteInBootstrap();
        });

        // 6. Publish Auth Language Files
        $this->components->task('Publishing Auth Language Files', function () use ($force) {
            foreach (['id', 'en'] as $locale) {
                $dest = lang_path("{$locale}/auth.php");
                $src = __DIR__."/../../lang/{$locale}/auth.php";
                if (File::exists($src)) {
                    File::ensureDirectoryExists(dirname($dest));
                    if ($force || ! File::exists($dest)) {
                        File::copy($src, $dest);
                    }
                }

                $srcDir = __DIR__."/../../lang/{$locale}/auth";
                $destDir = lang_path("{$locale}/auth");
                if (File::isDirectory($srcDir)) {
                    File::ensureDirectoryExists($destDir);
                    if ($force) {
                        File::copyDirectory($srcDir, $destDir);
                    } else {
                        foreach (File::allFiles($srcDir) as $file) {
                            $target = $destDir.'/'.$file->getRelativePathname();
                            if (! File::exists($target)) {
                                File::ensureDirectoryExists(dirname($target));
                                File::copy($file->getPathname(), $target);
                            }
                        }
                    }
                }
            }
        });

        // 7. Update Configuration
        $this->components->task('Updating config/vibe.php settings', function () use ($loginBy, $layout, $enablePasskeys) {
            $configFile = config_path('vibe.php');
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

                    $envFile = base_path('.env');
                    if (File::exists($envFile)) {
                        $envContent = File::get($envFile);
                        $passkeyValue = $enablePasskeys ? 'true' : 'false';
                        if (str_contains($envContent, 'PASSKEYS_ENABLED=')) {
                            $envContent = preg_replace('/PASSKEYS_ENABLED=[^\r\n]*/', "PASSKEYS_ENABLED={$passkeyValue}", $envContent);
                        } else {
                            $envContent .= "\nPASSKEYS_ENABLED={$passkeyValue}\n";
                        }
                        File::put($envFile, $envContent);
                    }
                }
            }
        });

        if ($enablePasskeys) {
            // 8. Publish Passkeys Configuration
            $this->components->task('Publishing Passkeys Configuration', function () use ($force) {
                $dest = config_path('passkeys.php');
                if ($force || ! File::exists($dest)) {
                    $src = __DIR__.'/../../stubs/Auth/config/passkeys.php';
                    if (! File::exists($src)) {
                        $src = base_path('vendor/laravel/passkeys/config/passkeys.php');
                    }

                    if (File::exists($src)) {
                        File::ensureDirectoryExists(dirname($dest));
                        File::copy($src, $dest);
                    } else {
                        $this->callSilent('vendor:publish', ['--tag' => 'passkeys-config', '--force' => true]);
                    }
                }
            });

            // 9. Ensure Vite Assets & NPM Dependencies for Passkeys
            $this->components->task('Ensuring Vite assets and Passkeys dependencies', function () {
                // Ensure passkeys.js is published if missing
                $passkeysDest = resource_path('js/vibe/passkeys.js');
                if (! File::exists($passkeysDest)) {
                    $src = __DIR__.'/../../resources/js/vibe/passkeys.js';
                    if (File::exists($src)) {
                        File::ensureDirectoryExists(dirname($passkeysDest));
                        File::copy($src, $passkeysDest);
                    } else {
                        $this->callSilent('vendor:publish', ['--tag' => 'vibe-assets', '--force' => true]);
                    }
                }

                $installCmd = new InstallCommand;
                $installCmd->registerViteAssets();
                $installCmd->updateNpmDependencies();
            });
        }

        // 10. Publish & Rewrite User and 2FA Migration
        $this->components->task('Publishing and Rewriting User & 2FA Migrations', function () {
            $src = __DIR__.'/../../stubs/Auth/migrations/0001_01_01_000000_create_users_table.php';

            $existing = File::glob(database_path('migrations/*_create_users_table.php'));
            $dest = ! empty($existing)
                ? $existing[0]
                : database_path('migrations/0001_01_01_000000_create_users_table.php');

            File::ensureDirectoryExists(dirname($dest));
            File::copy($src, $dest);
        });

        if ($enablePasskeys) {
            // 11. Publish Passkeys Migration
            $this->components->task('Publishing Passkeys Migration', function () use ($force) {
                $existing = File::glob(database_path('migrations/*_create_passkeys_table.php'));

                if (empty($existing) || $force) {
                    $timestamp = date('Y_m_d_His');
                    $dest = ! empty($existing)
                        ? $existing[0]
                        : database_path("migrations/{$timestamp}_create_passkeys_table.php");

                    $src = __DIR__.'/../../stubs/Auth/migrations/create_passkeys_table.php';
                    if (! File::exists($src)) {
                        $src = base_path('vendor/laravel/passkeys/database/migrations/2024_01_01_000000_create_passkeys_table.php');
                    }

                    if (File::exists($src)) {
                        File::ensureDirectoryExists(dirname($dest));
                        File::copy($src, $dest);
                    } else {
                        $this->callSilent('vendor:publish', ['--tag' => 'passkeys-migrations', '--force' => true]);
                    }
                }
            });
        }

        // 12. Ensure User Model has Passkey & TwoFactorAuthenticatable traits and required fillables
        $this->components->task('Updating User Model Traits & Fillables', function () use ($enablePasskeys) {
            $userModel = app_path('Models/User.php');
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

                // Ensure username and phone in fillable if not present
                if (! str_contains($content, "'username'")) {
                    $content = preg_replace(
                        "/'name',/",
                        "'name',\n        'username',\n        'phone',\n        'position',",
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

    protected function registerRouteInBootstrap(): void
    {
        $appFile = base_path('bootstrap/app.php');
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
