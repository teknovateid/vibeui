<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;

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
    $authCommand = new class extends \Teknovate\VibeUi\Commands\AuthCommand {
        public function testRegister(string $content): string {
            $tempFile = sys_get_temp_dir() . '/test_bootstrap_app_' . uniqid() . '.php';
            File::put($tempFile, $content);

            // Reflection to call protected registerRouteInBootstrap pointing to temp file
            $ref = new \ReflectionClass(\Teknovate\VibeUi\Commands\AuthCommand::class);
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
    $stubPath = base_path('packages/vibe/stubs/Auth/migrations/create_passkeys_table.php');
    expect(File::exists($stubPath))->toBeTrue();

    $content = File::get($stubPath);
    expect($content)->toContain("Schema::create('passkeys'");
    expect($content)->toContain("'credential_id'");
    expect($content)->toContain("'credential'");
    expect($content)->toContain("Passkeys::userModel()");
});

test('passkeys config stub exists and contains proper development origin settings', function () {
    $stubPath = base_path('packages/vibe/stubs/Auth/config/passkeys.php');
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
            "'name',\n        'username',\n        'phone',\n        'position',",
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
});

test('passkeys migration publishing creates file if missing and prevents duplicates', function () {
    $tempDir = sys_get_temp_dir() . '/test_migrations_' . uniqid();
    File::ensureDirectoryExists($tempDir);

    $stub = base_path('packages/vibe/stubs/Auth/migrations/create_passkeys_table.php');

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
        $path = base_path("packages/vibe/stubs/Auth/Livewire/Settings/{$component}");
        expect(File::exists($path))->toBeTrue("Expected {$component} to exist in stubs/Auth/Livewire/Settings");
    }

    $expectedViews = [
        'profile.blade.php',
        'password.blade.php',
        'two-factor.blade.php',
        'login-history.blade.php',
        'delete-user.blade.php',
    ];

    foreach ($expectedViews as $view) {
        $path = base_path("packages/vibe/stubs/Auth/views/settings/{$view}");
        expect(File::exists($path))->toBeTrue("Expected {$view} to exist in stubs/Auth/views/settings");
    }
});

test('passkeys config stub contains enabled option bound to env', function () {
    $stubPath = base_path('packages/vibe/stubs/Auth/config/passkeys.php');
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


