<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vibe:install
        {--skip-npm : Skip running npm install}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install and configure Vibe UI in your Laravel application';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->components->info('Installing Vibe UI...');

        // 1. Publish Config
        $this->components->task('Publishing configuration', function () {
            $this->callSilent('vendor:publish', ['--tag' => 'vibe-config', '--force' => true]);
        });

        // 2. Publish Assets
        $this->components->task('Publishing CSS & JS assets', function () {
            $this->callSilent('vendor:publish', ['--tag' => 'vibe-assets', '--force' => true]);
        });

        // 3. Publish Localization
        $this->components->task('Publishing localization files', function () {
            $this->callSilent('vendor:publish', ['--tag' => 'vibe-lang', '--force' => true]);
        });

        // 4. Publish AI Agent Skill (.agents/skills/vibeui)
        $this->components->task('Publishing AI agent skill', function () {
            $this->publishSkills();
        });

        // 5. Inject to app.js
        $this->components->task('Registering JS assets', function () {
            $jsPath = resource_path('js/app.js');
            if (file_exists($jsPath)) {
                $content = file_get_contents($jsPath);
                if (! str_contains($content, "import './vibe/app'")) {
                    file_put_contents($jsPath, $content."\nimport './vibe/app';\n");
                }
            }
        });

        // 6. Inject to app.css
        $this->components->task('Registering CSS assets', function () {
            $cssPath = resource_path('css/app.css');
            if (file_exists($cssPath)) {
                $content = file_get_contents($cssPath);
                if (! str_contains($content, "@import './vibe/app.css'") && ! str_contains($content, '@import "./vibe/app.css"')) {
                    file_put_contents($cssPath, "@import './vibe/app.css';\n".$content);
                }
            }
        });

        // 7. Inject entry points & fonts to vite.config.js
        $this->components->task('Registering Vite entry points', function () {
            $this->registerViteAssets();
            $this->registerViteFonts();
        });

        // 8. Inject dependencies to package.json
        $this->components->task('Updating NPM dependencies', function () {
            $this->updateNpmDependencies();
        });

        // 9. Register locale switch route in routes/web.php
        $this->components->task('Registering locale switch route', function () {
            $this->registerLocaleRoute();
        });

        // 10. Run NPM Install
        if (! $this->option('skip-npm')) {
            $this->components->info('Running npm install...');
            $process = new Process(['npm', 'install'], base_path());
            $process->setTimeout(null);
            $process->run(function ($type, $buffer) {
                $this->output->write($buffer);
            });
        }

        $this->newLine();
        $this->components->info('Vibe UI has been successfully installed!');
        $this->line(' <fg=gray>You can now start using vibe components.</>');
        $this->newLine();
    }

    /**
     * Publish the bundled Vibe UI AI agent skill into .agents/skills/vibeui.
     */
    public function publishSkills(?string $targetDir = null, ?string $sourceDir = null): bool
    {
        $isDefaultTarget = $targetDir === null;
        $sourceDir = $sourceDir ?: __DIR__.'/../../resources/skills/vibeui';
        $targetDir = $targetDir ?: base_path('.agents/skills/vibeui');

        if (! File::isDirectory($sourceDir)) {
            return false;
        }

        // In the Vibe UI monorepo, .agents/skills/vibeui is the source of truth synced into packages/vibe.
        if ($isDefaultTarget && File::isDirectory($targetDir) && File::isDirectory(base_path('packages/vibe/src'))) {
            return true;
        }

        $resolvedSource = realpath($sourceDir);
        $resolvedTarget = realpath($targetDir);

        if ($resolvedSource !== false && $resolvedTarget !== false && $resolvedSource === $resolvedTarget) {
            return true;
        }

        File::ensureDirectoryExists(dirname($targetDir));

        if (File::isDirectory($targetDir)) {
            File::deleteDirectory($targetDir);
        }

        return File::copyDirectory($sourceDir, $targetDir);
    }

    /**
     * Determine if Vibe UI is fully installed and configured in the application.
     * Checks:
     * 1. Config: config/vibe.php exists.
     * 2. Assets: resources/css/vibe and resources/js/vibe exist.
     * 3. JS registration: resources/js/app.js contains import './vibe/app'.
     * 4. CSS registration: resources/css/app.css contains @import './vibe/app.css'.
     * 5. Vite config: vite.config.* registers vibe entry points.
     * 6. Package dependencies: package.json has vibe dependencies.
     */
    public static function isInstalled(): bool
    {
        // 1. Config published
        if (! file_exists(config_path('vibe.php'))) {
            return false;
        }

        // 2. Core assets published
        if (! is_dir(resource_path('css/vibe')) || ! is_dir(resource_path('js/vibe'))) {
            return false;
        }

        // 3. app.js injected
        $jsPath = resource_path('js/app.js');
        if (file_exists($jsPath)) {
            $jsContent = file_get_contents($jsPath);
            if (! str_contains($jsContent, "import './vibe/app'") && ! str_contains($jsContent, 'import "./vibe/app"')) {
                return false;
            }
        } else {
            return false;
        }

        // 4. app.css injected
        $cssPath = resource_path('css/app.css');
        if (file_exists($cssPath)) {
            $cssContent = file_get_contents($cssPath);
            if (! str_contains($cssContent, "@import './vibe/app.css'") && ! str_contains($cssContent, '@import "./vibe/app.css"')) {
                return false;
            }
        } else {
            return false;
        }

        // 5. vite.config.js entry points injected
        $vitePath = null;
        foreach (['vite.config.js', 'vite.config.ts', 'vite.config.mjs'] as $file) {
            if (file_exists(base_path($file))) {
                $vitePath = base_path($file);
                break;
            }
        }
        if ($vitePath) {
            $viteContent = file_get_contents($vitePath);
            if (! str_contains($viteContent, 'resources/css/vibe/') && ! str_contains($viteContent, 'resources/js/vibe/')) {
                return false;
            }
        } else {
            return false;
        }

        // 6. package.json dependencies updated
        $packageJsonPath = base_path('package.json');
        if (file_exists($packageJsonPath)) {
            $packageJson = json_decode(file_get_contents($packageJsonPath), true) ?: [];
            $dependencies = $packageJson['dependencies'] ?? [];
            $required = array_keys(static::getRequiredDependencies());
            foreach ($required as $dep) {
                if (! isset($dependencies[$dep])) {
                    return false;
                }
            }
        } else {
            return false;
        }

        return true;
    }

    /**
     * Get required dependencies from Vibe UI package.json.
     *
     * @return array<string, string>
     */
    public static function getRequiredDependencies(?string $vibePackagePath = null): array
    {
        $vibePackagePath = $vibePackagePath ?: __DIR__.'/../../package.json';

        if (file_exists($vibePackagePath)) {
            $vibePackage = json_decode(file_get_contents($vibePackagePath), true) ?: [];

            return $vibePackage['dependencies'] ?? [];
        }

        return [];
    }

    /**
     * Update consumer package.json with dependencies from Vibe UI package.json
     */
    public function updateNpmDependencies(?string $packageJsonPath = null, ?string $vibePackagePath = null): bool
    {
        $packageJsonPath = $packageJsonPath ?: base_path('package.json');
        if (! file_exists($packageJsonPath)) {
            return false;
        }

        $packageJson = json_decode(file_get_contents($packageJsonPath), true) ?: [];
        $vibeDependencies = static::getRequiredDependencies($vibePackagePath);

        if (! isset($packageJson['dependencies'])) {
            $packageJson['dependencies'] = [];
        }

        $hasChanges = false;
        foreach ($vibeDependencies as $name => $version) {
            if (! isset($packageJson['dependencies'][$name])) {
                $packageJson['dependencies'][$name] = $version;
                $hasChanges = true;
            }
        }

        if ($hasChanges) {
            file_put_contents(
                $packageJsonPath,
                json_encode($packageJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            );
        }

        return $hasChanges;
    }

    /**
     * Get list of Vibe UI on-demand assets dynamically scanned from component views,
     * with fallback to known assets.
     *
     * @return array<string>
     */
    public function getVibeAssets(): array
    {
        $viewsDirs = array_filter([
            __DIR__.'/../../resources/views/vibe',
            resource_path('views/vibe'),
            __DIR__.'/../../stubs/Auth/layouts',
            resource_path('views/auth/layouts'),
        ], 'is_dir');

        $assets = [];

        foreach ($viewsDirs as $viewsDir) {
            $files = File::allFiles($viewsDir);
            foreach ($files as $file) {
                if (str_ends_with($file->getFilename(), '.blade.php')) {
                    $content = $file->getContents();

                    // Matches array syntax: @vite(['...', '...'])
                    if (preg_match_all("/@vite\(\s*\[([^\]]+)\]\s*\)/", $content, $matches)) {
                        foreach ($matches[1] as $group) {
                            if (preg_match_all("/['\"]([^'\"]+)['\"]/", $group, $assetMatches)) {
                                foreach ($assetMatches[1] as $asset) {
                                    $asset = trim($asset);
                                    if (str_starts_with($asset, 'resources/css/vibe/') || str_starts_with($asset, 'resources/js/vibe/')) {
                                        $assets[] = $asset;
                                    }
                                }
                            }
                        }
                    }

                    // Matches single string syntax: @vite('...')
                    if (preg_match_all("/@vite\(\s*['\"]([^'\"]+)['\"]\s*\)/", $content, $singleMatches)) {
                        foreach ($singleMatches[1] as $asset) {
                            $asset = trim($asset);
                            if (str_starts_with($asset, 'resources/css/vibe/') || str_starts_with($asset, 'resources/js/vibe/')) {
                                $assets[] = $asset;
                            }
                        }
                    }
                }
            }
        }

        // Always guarantee passkeys.js and qr-login.js are included if the files exist
        if (File::exists(__DIR__.'/../../resources/js/vibe/passkeys.js') || File::exists(resource_path('js/vibe/passkeys.js'))) {
            $assets[] = 'resources/js/vibe/passkeys.js';
        }
        if (File::exists(__DIR__.'/../../resources/js/vibe/qr-login.js') || File::exists(resource_path('js/vibe/qr-login.js'))) {
            $assets[] = 'resources/js/vibe/qr-login.js';
        }

        $assets = array_values(array_unique(array_filter($assets)));
        sort($assets);

        if (! empty($assets)) {
            return $assets;
        }

        return [
            'resources/css/vibe/chart.css',
            'resources/css/vibe/editor.css',
            'resources/css/vibe/filepond.css',
            'resources/css/vibe/highlightjs.css',
            'resources/js/vibe/chart.js',
            'resources/js/vibe/date-time.js',
            'resources/js/vibe/dynamic-form.js',
            'resources/js/vibe/editor.js',
            'resources/js/vibe/filepond.js',
            'resources/js/vibe/form.js',
            'resources/js/vibe/grid.js',
            'resources/js/vibe/highlightjs.js',
            'resources/js/vibe/idle.js',
            'resources/js/vibe/passkeys.js',
            'resources/js/vibe/qr-login.js',
            'resources/js/vibe/qrcode.js',
            'resources/js/vibe/select.js',
            'resources/js/vibe/sheet.js',
            'resources/js/vibe/table.js',
            'resources/js/vibe/datatable.js',
            'resources/js/vibe/show.js',
        ];
    }

    /**
     * Resolve target vite.config.* file path.
     */
    protected function resolveViteConfigPath(?string $customVitePath = null): ?string
    {
        if ($customVitePath) {
            return file_exists($customVitePath) ? $customVitePath : null;
        }

        foreach (['vite.config.js', 'vite.config.ts', 'vite.config.mjs'] as $file) {
            if (file_exists(base_path($file))) {
                return base_path($file);
            }
        }

        return null;
    }

    /**
     * Register Vibe UI on-demand assets in vite.config.js
     */
    public function registerViteAssets(?string $customVitePath = null): void
    {
        $vitePath = $this->resolveViteConfigPath($customVitePath);

        if (! $vitePath) {
            return;
        }

        $vibeAssets = $this->getVibeAssets();

        $content = file_get_contents($vitePath);
        $assetsToInject = [];

        foreach ($vibeAssets as $asset) {
            if (! str_contains($content, "'{$asset}'") && ! str_contains($content, "\"{$asset}\"")) {
                $assetsToInject[] = $asset;
            }
        }

        if (empty($assetsToInject)) {
            return;
        }

        if (preg_match('/input\s*:\s*\[([^\]]*)\]/s', $content, $matches)) {
            $existing = rtrim($matches[1]);
            if (! empty($existing) && ! str_ends_with($existing, ',')) {
                $existing .= ',';
            }

            // Detect base indentation from existing entries
            $indent = '                ';
            if (preg_match('/\n(\s+)[\'"][^\'"]+[\'"]/', $matches[1], $indentMatch)) {
                $indent = $indentMatch[1];
            }

            $injectedLines = implode("\n", array_map(fn ($asset) => "{$indent}'{$asset}',", $assetsToInject));
            $closingIndent = "\n            ";
            if (preg_match('/(\n\s*)$/', $matches[1], $closingMatch)) {
                $closingIndent = $closingMatch[1];
            }

            $replacement = 'input: ['.$existing."\n".$injectedLines.$closingIndent.']';
            $content = str_replace($matches[0], $replacement, $content);
            file_put_contents($vitePath, $content);
        }
    }

    /**
     * Get the Bunny font families used by Vibe UI appearance presets.
     *
     * @return array<string>
     */
    public function getVibeFonts(): array
    {
        return ['Figtree', 'Inter', 'Plus Jakarta Sans', 'Outfit'];
    }

    /**
     * Determine whether the target app supports laravel-vite-plugin/fonts.
     */
    protected function supportsViteFonts(string $viteContent, ?string $customPackageJsonPath = null): bool
    {
        if (str_contains($viteContent, 'laravel-vite-plugin/fonts') || preg_match('/\bfonts\s*:\s*\[/', $viteContent)) {
            return true;
        }

        $packageJsonPath = $customPackageJsonPath ?: base_path('package.json');
        if (file_exists($packageJsonPath)) {
            $pkg = json_decode(file_get_contents($packageJsonPath), true) ?: [];
            $constraint = $pkg['devDependencies']['laravel-vite-plugin']
                ?? $pkg['dependencies']['laravel-vite-plugin']
                ?? null;

            if (is_string($constraint) && preg_match('/(?:^|[~^>=<\s|])([3-9]|\d{2,})\./', $constraint)) {
                return true;
            }
        }

        return $customPackageJsonPath === null
            && is_dir(base_path('node_modules/laravel-vite-plugin/dist/fonts'));
    }

    /**
     * Find the matching closing delimiter index, respecting JS string literals.
     */
    protected function findMatchingDelimiter(string $content, int $openPos, string $openChar, string $closeChar): ?int
    {
        $len = strlen($content);
        $depth = 0;
        $quote = null;

        for ($i = $openPos; $i < $len; $i++) {
            $ch = $content[$i];

            if ($quote !== null) {
                if ($ch === '\\') {
                    $i++;

                    continue;
                }
                if ($ch === $quote) {
                    $quote = null;
                }

                continue;
            }

            if ($ch === "'" || $ch === '"' || $ch === '`') {
                $quote = $ch;

                continue;
            }

            if ($ch === $openChar) {
                $depth++;
            } elseif ($ch === $closeChar) {
                $depth--;
                if ($depth === 0) {
                    return $i;
                }
            }
        }

        return null;
    }

    /**
     * Build a formatted bunny() font entry for vite.config.js.
     */
    protected function buildBunnyFontEntry(string $family, string $indent = '                '): string
    {
        return "{$indent}bunny('{$family}', {\n"
            ."{$indent}    weights: [400, 500, 600, 700],\n"
            ."{$indent}    display: 'swap',\n"
            ."{$indent}    preload: false,\n"
            ."{$indent}}),";
    }

    /**
     * Register Vibe UI Bunny fonts inside vite.config.js when supported.
     */
    public function registerViteFonts(?string $customVitePath = null, ?string $customPackageJsonPath = null): bool
    {
        $vitePath = $this->resolveViteConfigPath($customVitePath);
        if (! $vitePath) {
            return false;
        }

        $content = file_get_contents($vitePath);
        if (! $this->supportsViteFonts($content, $customPackageJsonPath)) {
            return false;
        }

        $missingFonts = array_values(array_filter(
            $this->getVibeFonts(),
            fn (string $family) => ! preg_match('/\b(?:bunny|google|fontsource|local)\s*\(\s*[\'"]'.preg_quote($family, '/').'[\'"]/i', $content)
        ));

        if (empty($missingFonts)) {
            return false;
        }

        $updated = $content;

        // Ensure bunny import from laravel-vite-plugin/fonts exists
        if (preg_match('/import\s*\{([^}]+)\}\s*from\s*[\'"]laravel-vite-plugin\/fonts[\'"]\s*;?/', $updated, $importMatch, PREG_OFFSET_CAPTURE)) {
            if (! preg_match('/\bbunny\b/', $importMatch[1][0])) {
                $newImports = trim($importMatch[1][0]) !== ''
                    ? 'bunny, '.trim($importMatch[1][0])
                    : 'bunny';
                $updated = substr_replace(
                    $updated,
                    "import { {$newImports} } from 'laravel-vite-plugin/fonts';",
                    $importMatch[0][1],
                    strlen($importMatch[0][0])
                );
            }
        } elseif (preg_match('/import\s+laravel\s+from\s+[\'"]laravel-vite-plugin[\'"]\s*;?/', $updated, $laravelImport, PREG_OFFSET_CAPTURE)) {
            $insertPos = $laravelImport[0][1] + strlen($laravelImport[0][0]);
            $updated = substr_replace(
                $updated,
                "\nimport { bunny } from 'laravel-vite-plugin/fonts';",
                $insertPos,
                0
            );
        }

        // Locate laravel({ ... }) block
        if (! preg_match('/\blaravel\s*\(\s*\{/', $updated, $laravelCall, PREG_OFFSET_CAPTURE)) {
            return false;
        }

        $laravelOpenBrace = strpos($updated, '{', $laravelCall[0][1]);
        $laravelCloseBrace = $laravelOpenBrace !== false
            ? $this->findMatchingDelimiter($updated, $laravelOpenBrace, '{', '}')
            : null;

        if ($laravelCloseBrace === null) {
            return false;
        }

        $laravelInner = substr($updated, $laravelOpenBrace, $laravelCloseBrace - $laravelOpenBrace + 1);

        if (preg_match('/\bfonts\s*:\s*\[/', $laravelInner, $fontsProp, PREG_OFFSET_CAPTURE)) {
            $fontsOpenBracket = strpos($updated, '[', $laravelOpenBrace + $fontsProp[0][1]);
            $fontsCloseBracket = $fontsOpenBracket !== false
                ? $this->findMatchingDelimiter($updated, $fontsOpenBracket, '[', ']')
                : null;

            if ($fontsCloseBracket === null) {
                return false;
            }

            $existingInner = substr($updated, $fontsOpenBracket + 1, $fontsCloseBracket - $fontsOpenBracket - 1);
            $indent = '                ';
            if (preg_match('/\n([ \t]+)(?:bunny|google|fontsource|local)\s*\(/', $existingInner, $indentMatch)) {
                $indent = $indentMatch[1];
            }

            $closingIndent = "\n            ";
            if (preg_match('/(\n[ \t]*)$/', $existingInner, $closingMatch)) {
                $closingIndent = $closingMatch[1];
            }

            $trimmedInner = rtrim($existingInner);
            if ($trimmedInner !== '' && ! str_ends_with($trimmedInner, ',')) {
                $trimmedInner .= ',';
            }

            $entries = implode("\n", array_map(fn (string $f) => $this->buildBunnyFontEntry($f, $indent), $missingFonts));
            $newFontsInner = ($trimmedInner !== '' ? $trimmedInner."\n" : "\n").$entries.$closingIndent;

            $updated = substr_replace(
                $updated,
                $newFontsInner,
                $fontsOpenBracket + 1,
                $fontsCloseBracket - $fontsOpenBracket - 1
            );
        } else {
            $propIndent = '            ';
            if (preg_match('/\n([ \t]+)(?:input|refresh|ssr|detectTls)\s*:/', $laravelInner, $propIndentMatch)) {
                $propIndent = $propIndentMatch[1];
            }
            $entryIndent = $propIndent.'    ';

            $existingLaravelInner = substr($updated, $laravelOpenBrace + 1, $laravelCloseBrace - $laravelOpenBrace - 1);
            $closingIndent = "\n        ";
            if (preg_match('/(\n[ \t]*)$/', $existingLaravelInner, $closingMatch)) {
                $closingIndent = $closingMatch[1];
            }

            $trimmedLaravelInner = rtrim($existingLaravelInner);
            if ($trimmedLaravelInner !== '' && ! str_ends_with($trimmedLaravelInner, ',')) {
                $trimmedLaravelInner .= ',';
            }

            $entries = implode("\n", array_map(fn (string $f) => $this->buildBunnyFontEntry($f, $entryIndent), $missingFonts));
            $fontsBlock = "{$propIndent}fonts: [\n{$entries}\n{$propIndent}],";
            $newLaravelInner = ($trimmedLaravelInner !== '' ? $trimmedLaravelInner."\n" : "\n").$fontsBlock.$closingIndent;

            $updated = substr_replace(
                $updated,
                $newLaravelInner,
                $laravelOpenBrace + 1,
                $laravelCloseBrace - $laravelOpenBrace - 1
            );
        }

        if ($updated !== $content) {
            file_put_contents($vitePath, $updated);

            return true;
        }

        return false;
    }

    /**
     * Register the locale switch route in routes/web.php
     */
    public function registerLocaleRoute(?string $webRoutePath = null): bool
    {
        $webRoutePath = $webRoutePath ?: base_path('routes/web.php');

        if (! File::exists($webRoutePath)) {
            File::ensureDirectoryExists(dirname($webRoutePath));
            File::put($webRoutePath, "<?php\n\nuse Illuminate\Support\Facades\Route;\n");
        }

        $content = File::get($webRoutePath);

        if (str_contains($content, 'locale.switch') || str_contains($content, '/locale/{locale}')) {
            return false;
        }

        if (! str_contains($content, 'Illuminate\Support\Facades\Route')) {
            if (str_contains($content, '<?php')) {
                $content = preg_replace('/<\?php\s*/', "<?php\n\nuse Illuminate\Support\Facades\Route;\n\n", $content, 1);
            }
        }

        $routeCode = <<<'PHP'
Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['id', 'en'])) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('locale.switch');
PHP;

        $trimmed = rtrim($content);
        File::put($webRoutePath, $trimmed."\n\n".$routeCode."\n");

        return true;
    }
}
