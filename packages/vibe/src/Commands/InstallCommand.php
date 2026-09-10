<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vibe:install';

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

        // 5. Inject entry points to vite.config.js
        $this->components->task('Registering Vite entry points', function () {
            $this->registerViteAssets();
        });

        // 6. Inject dependencies to package.json
        $this->components->task('Updating NPM dependencies', function () {
            $packageJsonPath = base_path('package.json');
            if (file_exists($packageJsonPath)) {
                $packageJson = json_decode(file_get_contents($packageJsonPath), true);

                if (! isset($packageJson['dependencies']['@alpinejs/persist'])) {
                    // Ambil versi dari package.json milik Vibe UI secara dinamis
                    $vibePackagePath = __DIR__.'/../../package.json';
                    $alpineVersion = '^3.15.12'; // Fallback

                    if (file_exists($vibePackagePath)) {
                        $vibePackage = json_decode(file_get_contents($vibePackagePath), true);
                        $alpineVersion = $vibePackage['dependencies']['@alpinejs/persist'] ?? $alpineVersion;
                    }

                    $packageJson['dependencies']['@alpinejs/persist'] = $alpineVersion;

                    file_put_contents(
                        $packageJsonPath,
                        json_encode($packageJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                    );
                }
            }
        });

        // 7. Run NPM Install
        $this->components->info('Running npm install...');
        $process = new Process(['npm', 'install'], base_path());
        $process->setTimeout(null);
        $process->run(function ($type, $buffer) {
            $this->output->write($buffer);
        });

        $this->newLine();
        $this->components->info('Vibe UI has been successfully installed!');
        $this->line(' <fg=gray>You can now start using vibe components.</>');
        $this->newLine();
    }

    /**
     * Register Vibe UI on-demand assets in vite.config.js
     */
    protected function registerViteAssets(): void
    {
        $vitePath = null;
        foreach (['vite.config.js', 'vite.config.ts', 'vite.config.mjs'] as $file) {
            if (file_exists(base_path($file))) {
                $vitePath = base_path($file);
                break;
            }
        }

        if (! $vitePath) {
            return;
        }

        $vibeAssets = [
            'resources/css/vibe/highlightjs.css',
            'resources/css/vibe/chart.css',
            'resources/js/vibe/chart.js',
            'resources/js/vibe/date-time.js',
            'resources/js/vibe/form.js',
            'resources/js/vibe/grid.js',
            'resources/js/vibe/highlightjs.js',
            'resources/js/vibe/table.js',
        ];

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
