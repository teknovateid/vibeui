<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

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

        $force = (bool) $this->option('force');

        // 1. Publish Auth Layouts (card, simple, split)
        $this->components->task('Publishing Auth Layouts', function () use ($force) {
            $layouts = ['card.blade.php', 'simple.blade.php', 'split.blade.php'];
            $destDir = resource_path('views/auth/layouts');
            File::ensureDirectoryExists($destDir);

            foreach ($layouts as $layout) {
                $src = resource_path("views/auth/layouts/{$layout}");
                if (! File::exists($src)) {
                    $src = __DIR__."/../../stubs/Auth/layouts/{$layout}";
                }
                $dest = "{$destDir}/{$layout}";

                if ($force || ! File::exists($dest)) {
                    File::copy($src, $dest);
                }
            }
        });

        // 2. Publish Livewire Concern Trait
        $this->components->task('Publishing AuthenticatesUsers Concern', function () use ($force) {
            $src = app_path('Livewire/Auth/Concerns/AuthenticatesUsers.php');
            if (! File::exists($src)) {
                $src = __DIR__.'/../../stubs/Auth/Concerns/AuthenticatesUsers.php';
            }
            $dest = app_path('Livewire/Auth/Concerns/AuthenticatesUsers.php');

            File::ensureDirectoryExists(dirname($dest));
            if ($force || ! File::exists($dest)) {
                File::copy($src, $dest);
            }
        });

        // 3. Publish Livewire Components
        $this->components->task('Publishing Livewire Auth Components', function () use ($force) {
            $components = [
                'Login.php',
                'Register.php',
                'ForgotPassword.php',
                'ResetPassword.php',
                'VerifyEmail.php',
                'ConfirmPassword.php',
                'TwoFactorChallenge.php',
            ];

            File::ensureDirectoryExists(app_path('Livewire/Auth'));

            foreach ($components as $component) {
                $src = app_path("Livewire/Auth/{$component}");
                if (! File::exists($src)) {
                    $src = __DIR__."/../../stubs/Auth/Livewire/{$component}";
                }
                $dest = app_path("Livewire/Auth/{$component}");

                if ($force || ! File::exists($dest)) {
                    File::copy($src, $dest);
                }
            }
            File::ensureDirectoryExists(app_path('Livewire/Settings'));
            $srcTwoFactor = app_path('Livewire/Settings/TwoFactor.php');
            if (! File::exists($srcTwoFactor)) {
                $srcTwoFactor = __DIR__.'/../../stubs/Auth/Livewire/Settings/TwoFactor.php';
            }
            $destTwoFactor = app_path('Livewire/Settings/TwoFactor.php');
            if ($force || ! File::exists($destTwoFactor)) {
                File::copy($srcTwoFactor, $destTwoFactor);
            }
        });

        // 4. Publish Auth Views
        $this->components->task('Publishing Auth Views', function () use ($force) {
            $views = [
                'login.blade.php',
                'register.blade.php',
                'forgot-password.blade.php',
                'reset-password.blade.php',
                'verify-email.blade.php',
                'confirm-password.blade.php',
                'two-factor-challenge.blade.php',
            ];

            $destDir = resource_path('views/auth');
            File::ensureDirectoryExists($destDir);

            foreach ($views as $view) {
                $src = resource_path("views/auth/{$view}");
                if (! File::exists($src)) {
                    $src = __DIR__."/../../stubs/Auth/views/{$view}";
                }
                $dest = "{$destDir}/{$view}";

                if ($force || ! File::exists($dest)) {
                    File::copy($src, $dest);
                }
            }

            File::ensureDirectoryExists(resource_path('views/livewire/settings'));
            $srcTfView = resource_path('views/livewire/settings/two-factor.blade.php');
            if (! File::exists($srcTfView)) {
                $srcTfView = __DIR__.'/../../stubs/Auth/views/settings/two-factor.blade.php';
            }
            $destTfView = resource_path('views/livewire/settings/two-factor.blade.php');
            if ($force || ! File::exists($destTfView)) {
                File::copy($srcTfView, $destTfView);
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
            $appFile = base_path('bootstrap/app.php');
            if (File::exists($appFile)) {
                $content = File::get($appFile);
                if (! str_contains($content, 'routes/auth.php')) {
                    $updated = preg_replace(
                        '/web:\s*\[([^\]]*)\]/s',
                        "web: [$1    __DIR__ . '/../routes/auth.php',\n        ]",
                        $content
                    );
                    if ($updated && $updated !== $content) {
                        File::put($appFile, $updated);
                    }
                }
            }
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
        $this->components->task('Updating config/vibe.php settings', function () use ($loginBy, $layout) {
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
                    File::put($configFile, $content);
                }
            }
        });

        // 7. Ensure Vite Assets & NPM Dependencies for Passkeys
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

        // 8. Publish & Rewrite User and 2FA Migration
        $this->components->task('Publishing and Rewriting User & 2FA Migrations', function () {
            $src = __DIR__.'/../../stubs/Auth/migrations/0001_01_01_000000_create_users_table.php';

            $existing = File::glob(database_path('migrations/*_create_users_table.php'));
            $dest = ! empty($existing)
                ? $existing[0]
                : database_path('migrations/0001_01_01_000000_create_users_table.php');

            File::ensureDirectoryExists(dirname($dest));
            File::copy($src, $dest);
        });

        // 9. Ensure User Model has TwoFactorAuthenticatable and required fillables
        $this->components->task('Updating User Model Traits & Fillables', function () {
            $userModel = app_path('Models/User.php');
            if (File::exists($userModel)) {
                $content = File::get($userModel);

                // Add trait import if not present
                if (! str_contains($content, 'Teknovate\VibeUi\Traits\TwoFactorAuthenticatable')) {
                    $content = preg_replace(
                        '/(namespace App\\\\Models;\s+)/',
                        "$1\nuse Teknovate\\VibeUi\\Traits\\TwoFactorAuthenticatable;\n",
                        $content
                    );
                }

                // Add trait to class if not present
                if (! str_contains($content, 'TwoFactorAuthenticatable;')) {
                    $content = preg_replace(
                        '/(use HasFactory,\s*Notifiable(?:,\s*PasskeyAuthenticatable)?)/',
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

        $this->newLine();
        $this->components->info('Authentication system scaffolded successfully!');
        $this->line(" <fg=gray>Default Layout: <fg=white>{$layout}</> | Credential Mode: <fg=white>{$loginBy}</></>");
        $this->line(' <fg=gray>You can now test the routes at: <fg=cyan>/login</>, <fg=cyan>/register</>, and <fg=cyan>/forgot-password</></>');
        $this->newLine();
    }
}
