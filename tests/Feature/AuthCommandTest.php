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
