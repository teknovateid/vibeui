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

        // 4. Inject to app.js
        $this->components->task('Registering JS assets', function () {
            $jsPath = resource_path('js/app.js');
            if (file_exists($jsPath)) {
                $content = file_get_contents($jsPath);
                if (! str_contains($content, "import './vibe/app'")) {
                    file_put_contents($jsPath, $content."\nimport './vibe/app';\n");
                }
            }
        });

        // 5. Inject to app.css
        $this->components->task('Registering CSS assets', function () {
            $cssPath = resource_path('css/app.css');
            if (file_exists($cssPath)) {
                $content = file_get_contents($cssPath);
                if (! str_contains($content, "@import './vibe/app.css'") && ! str_contains($content, '@import "./vibe/app.css"')) {
                    file_put_contents($cssPath, "@import './vibe/app.css';\n".$content);
                }
            }
        });

        // 6. Inject entry points to vite.config.js
        $this->components->task('Registering Vite entry points', function () {
            $this->registerViteAssets();
        });

        // 7. Inject dependencies to package.json
        $this->components->task('Updating NPM dependencies', function () {
            $this->updateNpmDependencies();
        });

        // 8. Run NPM Install
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
        $viewsDir = __DIR__.'/../../resources/views/vibe';
        if (! is_dir($viewsDir)) {
            $viewsDir = resource_path('views/vibe');
        }

        $assets = [];

        if (is_dir($viewsDir)) {
            $files = File::allFiles($viewsDir);
            foreach ($files as $file) {
                if (str_ends_with($file->getFilename(), '.blade.php')) {
                    $content = $file->getContents();

                    // Matches array syntax: @vite(['...', '...'])
                    if (preg_match_all("/@vite\(\s*\[([^\]]+)\]\s*\)/", $content, $matches)) {
                        foreach ($matches[1] as $group) {
                            if (preg_match_all("/['\"]([^'\"]+)['\"]/", $group, $assetMatches)) {
                                foreach ($assetMatches[1] as $asset) {
                                    $assets[] = trim($asset);
                                }
                            }
                        }
                    }

                    // Matches single string syntax: @vite('...')
                    if (preg_match_all("/@vite\(\s*['\"]([^'\"]+)['\"]\s*\)/", $content, $singleMatches)) {
                        foreach ($singleMatches[1] as $asset) {
                            $assets[] = trim($asset);
                        }
                    }
                }
            }
        }

        $assets = array_values(array_unique(array_filter($assets)));
        sort($assets);

        if (! empty($assets)) {
            return $assets;
        }

        return [
            'resources/css/vibe/chart.css',
            'resources/css/vibe/filepond.css',
            'resources/css/vibe/highlightjs.css',
            'resources/js/vibe/chart.js',
            'resources/js/vibe/date-time.js',
            'resources/js/vibe/dynamic-form.js',
            'resources/js/vibe/filepond.js',
            'resources/js/vibe/form.js',
            'resources/js/vibe/grid.js',
            'resources/js/vibe/highlightjs.js',
            'resources/js/vibe/table.js',
        ];
    }

    /**
     * Register Vibe UI on-demand assets in vite.config.js
     */
    public function registerViteAssets(?string $customVitePath = null): void
    {
        $vitePath = $customVitePath;
        if (! $vitePath) {
            foreach (['vite.config.js', 'vite.config.ts', 'vite.config.mjs'] as $file) {
                if (file_exists(base_path($file))) {
                    $vitePath = base_path($file);
                    break;
                }
            }
        }

        if (! $vitePath || ! file_exists($vitePath)) {
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
}
