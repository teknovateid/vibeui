<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;
use Teknovate\VibeUi\Commands\InstallCommand;

test('vibe:install registers all assets including filepond and dynamic-form into vite.config', function () {
    $tempViteConfig = sys_get_temp_dir().'/vite.config.test.js';

    // Simulate a standard fresh Laravel vite.config.js
    File::put($tempViteConfig, <<<'JS'
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
JS);

    $command = new InstallCommand;
    $command->registerViteAssets($tempViteConfig);

    $content = File::get($tempViteConfig);
    $expectedAssets = $command->getVibeAssets();

    expect($expectedAssets)->not->toBeEmpty();
    expect($expectedAssets)->toContain('resources/js/vibe/passkeys.js');

    foreach ($expectedAssets as $asset) {
        expect($content)->toContain("'{$asset}'");
    }

    File::delete($tempViteConfig);
});

test('vibe:install transfers all dependencies from vibeui package.json to root package.json', function () {
    $tempPackageJson = sys_get_temp_dir().'/package.test.json';

    // Simulate a fresh Laravel package.json without Vibe UI dependencies
    File::put($tempPackageJson, json_encode([
        'private' => true,
        'type' => 'module',
        'scripts' => [
            'dev' => 'vite',
            'build' => 'vite build',
        ],
        'devDependencies' => [
            '@tailwindcss/vite' => '^4.0.0',
            'laravel-vite-plugin' => '^3.1',
            'tailwindcss' => '^4.0.0',
            'vite' => '^8.0.0',
        ],
    ], JSON_PRETTY_PRINT));

    $command = new InstallCommand;
    $vibePackagePath = base_path('packages/vibe/package.json');
    $hasChanges = $command->updateNpmDependencies($tempPackageJson, $vibePackagePath);

    expect($hasChanges)->toBeTrue();

    $result = json_decode(File::get($tempPackageJson), true);
    $vibePackage = json_decode(File::get($vibePackagePath), true);

    expect($result['dependencies'])->toBeArray();

    foreach (array_keys($vibePackage['dependencies'] ?? []) as $depKey) {
        expect($result['dependencies'])->toHaveKey($depKey);
    }

    File::delete($tempPackageJson);
});

test('vibe:install command executes successfully with --skip-npm', function () {
    $this->artisan('vibe:install', ['--skip-npm' => true])
        ->assertSuccessful();
});

test('InstallCommand::getRequiredDependencies dynamically reads from packages/vibe/package.json', function () {
    $dependencies = InstallCommand::getRequiredDependencies();
    $packageJsonPath = base_path('packages/vibe/package.json');
    $vibePackage = json_decode(File::get($packageJsonPath), true);

    expect($dependencies)->toBeArray();
    expect($dependencies)->toBe($vibePackage['dependencies']);
});

test('vibe:install registers locale switch route in routes/web.php', function () {
    $tempWebRoute = sys_get_temp_dir().'/web.test.php';

    File::put($tempWebRoute, <<<'PHP'
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
PHP);

    $command = new InstallCommand;
    $hasInjected = $command->registerLocaleRoute($tempWebRoute);

    expect($hasInjected)->toBeTrue();

    $content = File::get($tempWebRoute);
    expect($content)->toContain("Route::get('/locale/{locale}'");
    expect($content)->toContain("name('locale.switch')");
    expect($content)->toContain("session(['locale' => \$locale]);");

    // Idempotent: running again should not duplicate
    $hasInjectedAgain = $command->registerLocaleRoute($tempWebRoute);
    expect($hasInjectedAgain)->toBeFalse();

    File::delete($tempWebRoute);
});

test('vibe:install creates routes/web.php if it does not exist when registering locale route', function () {
    $tempWebRoute = sys_get_temp_dir().'/web_non_existent.test.php';
    if (File::exists($tempWebRoute)) {
        File::delete($tempWebRoute);
    }

    $command = new InstallCommand;
    $hasInjected = $command->registerLocaleRoute($tempWebRoute);

    expect($hasInjected)->toBeTrue();
    expect(File::exists($tempWebRoute))->toBeTrue();

    $content = File::get($tempWebRoute);
    expect($content)->toContain('use Illuminate\Support\Facades\Route;');
    expect($content)->toContain("Route::get('/locale/{locale}'");
    expect($content)->toContain("name('locale.switch')");

    File::delete($tempWebRoute);
});
