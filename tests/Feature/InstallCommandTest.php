<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Teknovate\VibeUi\Commands\InstallCommand;
use Teknovate\VibeUi\VibeServiceProvider;

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

test('vibe:install injects bunny fonts into vite.config when laravel-vite-plugin v3+ is used', function () {
    $tempViteConfig = sys_get_temp_dir().'/vite.fonts.fresh.test.js';
    $tempPackageJson = sys_get_temp_dir().'/package.fonts.v3.test.json';

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

    File::put($tempPackageJson, json_encode([
        'devDependencies' => [
            'laravel-vite-plugin' => '^3.1',
        ],
    ]));

    $command = new InstallCommand;
    $changed = $command->registerViteFonts($tempViteConfig, $tempPackageJson);

    expect($changed)->toBeTrue();

    $content = File::get($tempViteConfig);
    expect($content)
        ->toContain("import { bunny } from 'laravel-vite-plugin/fonts';")
        ->toContain("fonts: [")
        ->toContain("bunny('Figtree'")
        ->toContain("bunny('Inter'")
        ->toContain("bunny('Plus Jakarta Sans'")
        ->toContain("bunny('Outfit'");

    // Idempotent second run
    expect($command->registerViteFonts($tempViteConfig, $tempPackageJson))->toBeFalse();

    File::delete([$tempViteConfig, $tempPackageJson]);
});

test('vibe:install preserves existing fonts array entries including nested weights brackets', function () {
    $tempViteConfig = sys_get_temp_dir().'/vite.fonts.existing.test.js';
    $tempPackageJson = sys_get_temp_dir().'/package.fonts.existing.test.json';

    File::put($tempViteConfig, <<<'JS'
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                    preload: false,
                }),
            ],
        }),
    ],
});
JS);

    File::put($tempPackageJson, json_encode([
        'devDependencies' => [
            'laravel-vite-plugin' => '^3.1',
        ],
    ]));

    $command = new InstallCommand;
    $changed = $command->registerViteFonts($tempViteConfig, $tempPackageJson);

    expect($changed)->toBeTrue();

    $content = File::get($tempViteConfig);
    expect($content)
        ->toContain("bunny('Instrument Sans'")
        ->toContain("bunny('Figtree'")
        ->toContain("bunny('Inter'")
        ->toContain("bunny('Plus Jakarta Sans'")
        ->toContain("bunny('Outfit'");
    expect(substr_count($content, 'fonts: ['))->toBe(1);

    File::delete([$tempViteConfig, $tempPackageJson]);
});

test('vibe:install skips vite font injection cleanly when laravel-vite-plugin is below v3', function () {
    $tempViteConfig = sys_get_temp_dir().'/vite.fonts.v2.test.js';
    $tempPackageJson = sys_get_temp_dir().'/package.fonts.v2.test.json';

    $original = <<<'JS'
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
JS;
    File::put($tempViteConfig, $original);
    File::put($tempPackageJson, json_encode([
        'devDependencies' => [
            'laravel-vite-plugin' => '^2.0',
        ],
    ]));

    $command = new InstallCommand;
    expect($command->registerViteFonts($tempViteConfig, $tempPackageJson))->toBeFalse();
    expect(File::get($tempViteConfig))->toBe($original);

    File::delete([$tempViteConfig, $tempPackageJson]);
});

test('vibe:install publishes the vibeui skill into .agents/skills without disturbing sibling skills', function () {
    $tempBase = sys_get_temp_dir().'/vibe-skill-install-'.uniqid();
    $skillsRoot = $tempBase.'/.agents/skills';
    $siblingSkillDir = $skillsRoot.'/modern-web-guidance';
    $targetSkillDir = $skillsRoot.'/vibeui';
    $sourceSkillDir = base_path('packages/vibe/resources/skills/vibeui');

    File::ensureDirectoryExists($siblingSkillDir);
    File::put($siblingSkillDir.'/SKILL.md', "---\nname: modern-web-guidance\n---\n");

    File::ensureDirectoryExists($targetSkillDir);
    File::put($targetSkillDir.'/stale-file.md', 'old content');

    $command = new InstallCommand;
    $published = $command->publishSkills($targetSkillDir, $sourceSkillDir);

    expect($published)->toBeTrue();
    expect(File::exists($targetSkillDir.'/SKILL.md'))->toBeTrue();
    expect(File::exists($targetSkillDir.'/references/components.md'))->toBeTrue();
    expect(File::exists($targetSkillDir.'/references/cli-and-theming.md'))->toBeTrue();
    expect(File::exists($targetSkillDir.'/stale-file.md'))->toBeFalse();
    expect(File::exists($siblingSkillDir.'/SKILL.md'))->toBeTrue();

    File::deleteDirectory($tempBase);
});

test('VibeServiceProvider registers vibe-skills publish tag targeting .agents/skills/vibeui', function () {
    $paths = ServiceProvider::pathsToPublish(
        VibeServiceProvider::class,
        'vibe-skills'
    );

    expect($paths)->not->toBeEmpty();
    expect(array_values($paths))->toContain(base_path('.agents/skills/vibeui'));
});

test('vibe:install --skip-npm keeps vibeui skill available in project .agents/skills/vibeui', function () {
    $this->artisan('vibe:install', ['--skip-npm' => true])
        ->assertSuccessful();

    expect(File::exists(base_path('.agents/skills/vibeui/SKILL.md')))->toBeTrue();
    expect(File::exists(base_path('.agents/skills/vibeui/references/components.md')))->toBeTrue();
    expect(File::exists(base_path('.agents/skills/vibeui/references/cli-and-theming.md')))->toBeTrue();
});
