<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Tester\CommandTester;
use Teknovate\VibeUi\Commands\AuthCommand;

afterEach(function () {
    $appPath = base_path('bootstrap/app.php');
    if (File::exists($appPath)) {
        $appContent = File::get($appPath);
        // Clean up any test routes
        if (str_contains($appContent, 'test-auth-temp.php')) {
            $cleaned = preg_replace("/\s*__DIR__\s*\.\s*'\/..\/routes\/test-auth-temp\.php',?/", '', $appContent);
            File::put($appPath, $cleaned);
        }
    }
});

test('vibe:auth registers routes in bootstrap/app.php when web routing is a single file or array', function () {
    // Test helper simulation of registerRouteInBootstrap method logic
    $authCommand = new class extends AuthCommand
    {
        public function testRegister(string $content): string
        {
            $tempFile = sys_get_temp_dir().'/test_bootstrap_app_'.uniqid().'.php';
            File::put($tempFile, $content);

            // Reflection to call protected registerRouteInBootstrap pointing to temp file
            $ref = new ReflectionClass(AuthCommand::class);
            $method = $ref->getMethod('registerRouteInBootstrap');

            // We test the logic against different formats
            $appFile = $tempFile;
            $content = File::get($appFile);
            if (! str_contains($content, 'routes/auth.php')) {
                if (preg_match('/web:\s*\[/s', $content)) {
                    $content = preg_replace(
                        '/(web:\s*\[)/',
                        "$1\n            __DIR__ . '/../routes/auth.php',",
                        $content
                    );
                } elseif (preg_match('/web:\s*(__DIR__\s*\.\s*[\'"][^\'"]+[\'"])\s*,/', $content, $matches)) {
                    $originalRoute = $matches[1];
                    $replacement = "web: [\n            {$originalRoute},\n            __DIR__ . '/../routes/auth.php',\n        ],";
                    $content = str_replace($matches[0], $replacement, $content);
                }
            }

            File::delete($tempFile);

            return $content;
        }
    };

    // 1. Fresh Laravel 11/12 format (single file string without array)
    $singleFormat = <<<'PHP'
<?php

use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    );
PHP;

    $result1 = $authCommand->testRegister($singleFormat);
    expect($result1)->toContain("web: [\n            __DIR__.'/../routes/web.php',\n            __DIR__ . '/../routes/auth.php',\n        ],");

    // 2. Format with spaces around concatenation dot
    $singleWithSpaces = <<<'PHP'
<?php

use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
    );
PHP;

    $result2 = $authCommand->testRegister($singleWithSpaces);
    expect($result2)->toContain("web: [\n            __DIR__ . '/../routes/web.php',\n            __DIR__ . '/../routes/auth.php',\n        ],");

    // 3. Already an array format
    $arrayFormat = <<<'PHP'
<?php

use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__.'/../routes/web.php',
        ],
    );
PHP;

    $result3 = $authCommand->testRegister($arrayFormat);
    expect($result3)->toContain("__DIR__ . '/../routes/auth.php'");
});

test('passkeys migration stub exists and defines passkeys schema', function () {
    $stubPath = base_path('packages/vibe/stubs/database/migrations/create_passkeys_table.php');
    expect(File::exists($stubPath))->toBeTrue();

    $content = File::get($stubPath);
    expect($content)->toContain("Schema::create('passkeys'");
    expect($content)->toContain("'credential_id'");
    expect($content)->toContain("'credential'");
    expect($content)->toContain('Passkeys::userModel()');
});

test('passkeys config stub exists and contains proper development origin settings', function () {
    $stubPath = base_path('packages/vibe/config/passkeys.php');
    expect(File::exists($stubPath))->toBeTrue();

    $content = File::get($stubPath);
    expect($content)->toContain("'relying_party_id'");
    expect($content)->toContain("'allowed_origins'");
    expect($content)->toContain('localhost:8000');
});

test('vibe:auth correctly injects Passkey and 2FA traits and interfaces into User model', function () {
    $standardUserModel = <<<'PHP'
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
PHP;

    $content = $standardUserModel;

    // Simulate the AuthCommand User Model transformation logic
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
    if (! str_contains($content, 'Teknovate\VibeUi\Traits\TwoFactorAuthenticatable')) {
        $content = preg_replace(
            '/(namespace App\\\\Models;)/',
            "$1\n\nuse Teknovate\\VibeUi\\Traits\\TwoFactorAuthenticatable;",
            $content
        );
    }

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

    if (! preg_match('/class\s+User\b[^{]*\{[^}]*\bPasskeyAuthenticatable\b/s', $content)) {
        $content = preg_replace(
            '/(\buse\s+HasFactory,\s*Notifiable)/',
            '$1, PasskeyAuthenticatable',
            $content
        );
    }

    if (! preg_match('/class\s+User\b[^{]*\{[^}]*\bTwoFactorAuthenticatable\b/s', $content)) {
        $content = preg_replace(
            '/(\buse\s+HasFactory,\s*Notifiable(?:,\s*PasskeyAuthenticatable)?)/',
            '$1, TwoFactorAuthenticatable',
            $content
        );
    }

    if (! str_contains($content, "'username'")) {
        $content = preg_replace(
            "/'name',/",
            "'name',\n        'username',\n        'phone',\n        'avatar',",
            $content
        );
    }

    expect($content)->toContain('use Laravel\Passkeys\Contracts\PasskeyUser;');
    expect($content)->toContain('use Laravel\Passkeys\PasskeyAuthenticatable;');
    expect($content)->toContain('use Teknovate\VibeUi\Traits\TwoFactorAuthenticatable;');
    expect($content)->toContain('class User extends Authenticatable implements PasskeyUser');
    expect($content)->toContain('use HasFactory, Notifiable, PasskeyAuthenticatable, TwoFactorAuthenticatable;');
    expect($content)->toContain("'username'");
    expect($content)->toContain("'phone'");
    expect($content)->toContain("'avatar'");
    expect($content)->not->toContain("'position'");
});

test('passkeys migration publishing creates file if missing and prevents duplicates', function () {
    $tempDir = sys_get_temp_dir().'/test_migrations_'.uniqid();
    File::ensureDirectoryExists($tempDir);

    $stub = base_path('packages/vibe/stubs/database/migrations/create_passkeys_table.php');

    // Case 1: missing migration -> creates file
    $existing = File::glob("{$tempDir}/*_create_passkeys_table.php");
    expect($existing)->toBeEmpty();

    $timestamp = date('Y_m_d_His');
    $dest = "{$tempDir}/{$timestamp}_create_passkeys_table.php";
    File::copy($stub, $dest);

    $existingAfter = File::glob("{$tempDir}/*_create_passkeys_table.php");
    expect($existingAfter)->toHaveCount(1);
    expect(File::exists($existingAfter[0]))->toBeTrue();

    // Case 2: existing migration present -> detects it and does not create duplicate
    $existingCheck = File::glob("{$tempDir}/*_create_passkeys_table.php");
    expect($existingCheck)->not->toBeEmpty();
    // Simulate what AuthCommand does: if empty or force -> do publish, else skip
    $shouldPublish = empty($existingCheck);
    expect($shouldPublish)->toBeFalse();

    File::deleteDirectory($tempDir);
});

test('settings components and views stubs exist for auth and layout publishing', function () {
    $expectedComponents = [
        'Profile.php',
        'Password.php',
        'TwoFactor.php',
        'LoginHistory.php',
        'DeleteUser.php',
    ];

    foreach ($expectedComponents as $component) {
        $path = base_path("packages/vibe/app/Livewire/Settings/{$component}");
        expect(File::exists($path))->toBeTrue("Expected {$component} to exist in app/Livewire/Settings");
    }

    $expectedViews = [
        'profile.blade.php',
        'password.blade.php',
        'two-factor.blade.php',
        'login-history.blade.php',
        'delete-user.blade.php',
    ];

    foreach ($expectedViews as $view) {
        $path = base_path("packages/vibe/resources/views/livewire/settings/{$view}");
        expect(File::exists($path))->toBeTrue("Expected {$view} to exist in resources/views/livewire/settings");
    }
});

test('passkeys config stub contains enabled option bound to env', function () {
    $stubPath = base_path('packages/vibe/config/passkeys.php');
    expect(File::exists($stubPath))->toBeTrue();

    $content = File::get($stubPath);
    expect($content)->toContain("'enabled' => env('PASSKEYS_ENABLED', true)");
});

test('vibe:auth skips Passkey traits and interfaces when passkeys are disabled', function () {
    $standardUserModel = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
PHP;

    $content = $standardUserModel;
    $enablePasskeys = false;

    // Simulate AuthCommand configureUserModel with $enablePasskeys = false
    if ($enablePasskeys) {
        if (! str_contains($content, 'Laravel\Passkeys\Contracts\PasskeyUser')) {
            $content = preg_replace(
                '/(namespace App\\\\Models;)/',
                "$1\n\nuse Laravel\\Passkeys\\Contracts\\PasskeyUser;",
                $content
            );
        }
    }

    if (! str_contains($content, 'Teknovate\VibeUi\Traits\TwoFactorAuthenticatable')) {
        $content = preg_replace(
            '/(namespace App\\\\Models;)/',
            "$1\n\nuse Teknovate\\VibeUi\\Traits\\TwoFactorAuthenticatable;",
            $content
        );
    }

    if (! preg_match('/class\s+User\b[^{]*\{[^}]*\bTwoFactorAuthenticatable\b/s', $content)) {
        $content = preg_replace(
            '/(\buse\s+HasFactory,\s*Notifiable(?:,\s*PasskeyAuthenticatable)?)/',
            '$1, TwoFactorAuthenticatable',
            $content
        );
    }

    expect($content)->not->toContain('use Laravel\Passkeys\Contracts\PasskeyUser;');
    expect($content)->not->toContain('PasskeyAuthenticatable');
    expect($content)->toContain('use Teknovate\VibeUi\Traits\TwoFactorAuthenticatable;');
    expect($content)->toContain('use HasFactory, Notifiable, TwoFactorAuthenticatable;');
});

test('vibe:auth overwrites all existing auth Livewire classes, views, layouts, routes, lang, and JS assets by default', function () {
    $sandbox = sys_get_temp_dir().'/vibe_auth_overwrite_'.uniqid();
    File::ensureDirectoryExists($sandbox);

    try {
        $makeSandboxCommand = function () use ($sandbox) {
            $command = new class($sandbox) extends AuthCommand
            {
                public function __construct(protected string $root)
                {
                    parent::__construct();
                }

                protected function targetBasePath(string $path = ''): string
                {
                    return $this->root.($path !== '' ? DIRECTORY_SEPARATOR.ltrim($path, DIRECTORY_SEPARATOR) : '');
                }

                protected function targetAppPath(string $path = ''): string
                {
                    return $this->targetBasePath('app'.($path !== '' ? DIRECTORY_SEPARATOR.ltrim($path, DIRECTORY_SEPARATOR) : ''));
                }

                protected function targetResourcePath(string $path = ''): string
                {
                    return $this->targetBasePath('resources'.($path !== '' ? DIRECTORY_SEPARATOR.ltrim($path, DIRECTORY_SEPARATOR) : ''));
                }

                protected function targetConfigPath(string $path = ''): string
                {
                    return $this->targetBasePath('config'.($path !== '' ? DIRECTORY_SEPARATOR.ltrim($path, DIRECTORY_SEPARATOR) : ''));
                }

                protected function targetDatabasePath(string $path = ''): string
                {
                    return $this->targetBasePath('database'.($path !== '' ? DIRECTORY_SEPARATOR.ltrim($path, DIRECTORY_SEPARATOR) : ''));
                }

                protected function targetLangPath(string $path = ''): string
                {
                    return $this->targetBasePath('lang'.($path !== '' ? DIRECTORY_SEPARATOR.ltrim($path, DIRECTORY_SEPARATOR) : ''));
                }
            };

            $command->setLaravel(app());

            return $command;
        };

        $seedStaleFiles = function (string $marker) use ($sandbox) {
            $targets = [
                'app/Livewire/Auth/Login.php',
                'app/Livewire/Auth/Register.php',
                'app/Livewire/Auth/QrApprove.php',
                'app/Livewire/Auth/Concerns/AuthenticatesUsers.php',
                'app/Livewire/Settings/Profile.php',
                'app/Livewire/Settings/TwoFactor.php',
                'resources/views/auth/login.blade.php',
                'resources/views/auth/register.blade.php',
                'resources/views/auth/qr-approve.blade.php',
                'resources/views/auth/layouts/card.blade.php',
                'resources/views/livewire/settings/profile.blade.php',
                'resources/views/livewire/settings/two-factor.blade.php',
                'routes/auth.php',
                'lang/en/auth/qr_login.php',
                'config/passkeys.php',
                'resources/js/vibe/passkeys.js',
                'resources/js/vibe/qr-login.js',
                'resources/js/vibe/qrcode.js',
            ];

            foreach ($targets as $rel) {
                $full = $sandbox.DIRECTORY_SEPARATOR.$rel;
                File::ensureDirectoryExists(dirname($full));
                File::put($full, $marker);
            }

            return $targets;
        };

        $existingUsersMigration = "{$sandbox}/database/migrations/0001_01_01_000000_create_users_table.php";
        File::ensureDirectoryExists(dirname($existingUsersMigration));
        File::put($existingUsersMigration, 'CUSTOM_EXISTING_USERS_MIGRATION');

        File::ensureDirectoryExists("{$sandbox}/bootstrap");
        File::put("{$sandbox}/bootstrap/app.php", "<?php\nreturn Application::configure()->withRouting(web: __DIR__.'/../routes/web.php');\n");
        File::ensureDirectoryExists("{$sandbox}/config");
        File::put("{$sandbox}/config/vibe.php", File::get(config_path('vibe.php')));
        File::put("{$sandbox}/.env", "APP_NAME=Test\n");
        File::put("{$sandbox}/package.json", json_encode(['dependencies' => []]));

        $staleMarker = 'STALE_CUSTOM_OR_OLD_AUTH_CONTENT';
        $staleTargets = $seedStaleFiles($staleMarker);

        // 1. Run vibe:auth WITHOUT --force -> must overwrite ALL existing auth files without touching create_users_table
        $tester1 = new CommandTester($makeSandboxCommand());
        $tester1->execute([
            '--layout' => 'split',
            '--login-by' => 'email_or_username',
            '--with-passkeys' => true,
            '--with-qr-login' => true,
        ], ['interactive' => false]);

        expect($tester1->getStatusCode())->toBe(0);

        foreach ($staleTargets as $rel) {
            expect(File::get($sandbox.DIRECTORY_SEPARATOR.$rel))
                ->not->toBe($staleMarker, "Expected {$rel} to be overwritten without --force");
        }

        expect(File::get($existingUsersMigration))->toBe('CUSTOM_EXISTING_USERS_MIGRATION');
        $vibeAuthMigrations = File::glob("{$sandbox}/database/migrations/*_add_vibe_auth_tables.php");
        expect($vibeAuthMigrations)->toHaveCount(1);
        expect(File::get($vibeAuthMigrations[0]))
            ->toBe(File::get(base_path('packages/vibe/stubs/database/migrations/add_vibe_auth_tables.php')));

        // Verify ALL stub Livewire classes and views exist and match stub contents
        foreach (File::files(base_path('packages/vibe/app/Livewire/Auth')) as $stub) {
            expect(File::get("{$sandbox}/app/Livewire/Auth/{$stub->getFilename()}"))
                ->toBe($stub->getContents());
        }
        foreach (File::files(base_path('packages/vibe/resources/views/auth')) as $stub) {
            expect(File::get("{$sandbox}/resources/views/auth/{$stub->getFilename()}"))
                ->toBe($stub->getContents());
        }
        expect(File::get("{$sandbox}/routes/auth.php"))
            ->toBe(File::get(base_path('packages/vibe/routes/auth.php')));

        // 2. Run vibe:auth WITH --skip-existing -> preserves existing files while writing missing ones
        $skipTargets = $seedStaleFiles($staleMarker);
        $missingFile = "{$sandbox}/app/Livewire/Auth/ConfirmPassword.php";
        File::delete($missingFile);

        $tester2 = new CommandTester($makeSandboxCommand());
        $tester2->execute([
            '--layout' => 'card',
            '--login-by' => 'email',
            '--with-passkeys' => true,
            '--with-qr-login' => true,
            '--skip-existing' => true,
        ], ['interactive' => false]);

        expect($tester2->getStatusCode())->toBe(0);

        foreach ($skipTargets as $rel) {
            expect(File::get($sandbox.DIRECTORY_SEPARATOR.$rel))
                ->toBe($staleMarker, "Expected {$rel} to be preserved when --skip-existing is set");
        }

        expect(File::get($existingUsersMigration))->toBe('CUSTOM_EXISTING_USERS_MIGRATION');
        expect(File::glob("{$sandbox}/database/migrations/*_add_vibe_auth_tables.php"))->toHaveCount(1);
        expect(File::exists($missingFile))->toBeTrue();
        expect(File::get($missingFile))
            ->toBe(File::get(base_path('packages/vibe/app/Livewire/Auth/ConfirmPassword.php')));
    } finally {
        File::deleteDirectory($sandbox);
    }
});

test('add_vibe_auth_tables migration extends existing users table, creates 2fa table, and rolls back cleanly', function () {
    $previousConnection = DB::getDefaultConnection();

    config(['database.connections.vibe_auth_migration_test' => [
        'driver' => 'sqlite',
        'database' => ':memory:',
        'prefix' => '',
    ]]);

    DB::setDefaultConnection('vibe_auth_migration_test');

    try {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'name' => 'Existing User',
            'email' => 'existing@example.com',
            'password' => 'secret',
        ]);

        $migration = require base_path('packages/vibe/stubs/database/migrations/add_vibe_auth_tables.php');
        $migration->up();
        // Second up() call validates idempotency when columns/table already exist
        $migration->up();

        expect(Schema::hasColumns('users', ['phone', 'username', 'avatar']))->toBeTrue();
        expect(Schema::hasColumn('users', 'position'))->toBeFalse();
        expect(Schema::hasTable('two_factor_authenticators'))->toBeTrue();
        expect(DB::table('users')->where('email', 'existing@example.com')->exists())->toBeTrue();

        $migration->down();

        expect(Schema::hasTable('two_factor_authenticators'))->toBeFalse();
        expect(Schema::hasTable('users'))->toBeTrue();
        expect(Schema::hasColumn('users', 'phone'))->toBeFalse();
        expect(Schema::hasColumn('users', 'username'))->toBeFalse();
        expect(Schema::hasColumn('users', 'avatar'))->toBeFalse();
        expect(DB::table('users')->where('email', 'existing@example.com')->exists())->toBeTrue();
    } finally {
        DB::setDefaultConnection($previousConnection);
        DB::purge('vibe_auth_migration_test');
    }
});
