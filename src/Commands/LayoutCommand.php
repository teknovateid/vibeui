<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class LayoutCommand extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vibe:layout
        {path : The path of your layout.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate layout panel.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $rawPath = trim((string) $this->argument('path'));
        $path = str()->slug($rawPath);

        if (empty($path)) {
            $this->components->error('The layout path is required and cannot be empty.');

            return;
        }

        if (in_array($path, ['components', 'vibe'])) {
            $this->components->error("The layout path '{$path}' is reserved. Please choose another name.");

            return;
        }

        $layoutsDir = __DIR__.'/../../stubs/Layouts/layouts';
        $layoutFiles = glob($layoutsDir.'/*.blade.php');
        $layoutOptions = [];

        foreach ($layoutFiles as $file) {
            $name = basename($file, '.blade.php');
            if ($name !== 'base') {
                $layoutOptions[$name] = ucfirst($name);
            }
        }

        if (empty($layoutOptions)) {
            $layoutOptions['sidebar'] = 'Sidebar';
        }

        $chosenLayout = select(
            'Which layout style do you want to use?',
            $layoutOptions,
            default: array_key_first($layoutOptions) ?? 'sidebar'
        );

        $layout = $this->generateLayouts($path, $chosenLayout);
        $route = $this->generateRoute($path);

        $this->newLine();
        $list = [];
        if ($layout) {
            $this->components->success('Layout created');
            $list[] = "resources/views/{$path}";
            $list[] = "resources/views/{$path}/settings";
            $list[] = "resources/views/components/{$path}";
        } else {
            $this->components->info('Layout skipped.');
        }

        if ($route) {
            $this->components->success('Route file created and linked in bootstrap/app.php');
            $list[] = "routes/{$path}.php";
        } else {
            $this->components->info('Route skipped.');
        }

        if (count($list) > 0) {
            $this->components->bulletList($list);
        }
        $this->newLine();
    }

    protected function generateLayouts(string $path, string $chosenLayout): bool
    {
        $componentsDir = __DIR__.'/../../stubs/Layouts';
        $destComponentsDir = resource_path("views/components/{$path}");

        if (File::exists($destComponentsDir)) {
            if ($this->confirm("Layout components for {$path} already exist. Overwrite them?", false)) {
                File::copyDirectory($componentsDir, $destComponentsDir);
                $this->cleanupUnusedLayouts($destComponentsDir, $chosenLayout);
                $this->updateComponentReferences($destComponentsDir, $path);
            }
        } else {
            File::copyDirectory($componentsDir, $destComponentsDir);
            $this->cleanupUnusedLayouts($destComponentsDir, $chosenLayout);
            $this->updateComponentReferences($destComponentsDir, $path);
        }

        $pages = [
            'index' => 'pages/index.blade.php',
            'settings.account' => 'settings/account.blade.php',
            'settings.appearance' => 'settings/appearance.blade.php',
            'settings.security' => 'settings/security.blade.php',
            'settings.login-history' => 'settings/login-history.blade.php',
            'settings.notifications' => 'settings/notifications.blade.php',
            'settings.tabs' => 'settings/tabs.blade.php',
        ];

        foreach ($pages as $component => $templatePath) {
            $templateFile = __DIR__."/../../stubs/Templates/{$templatePath}";
            $destView = resource_path("views/{$path}/".str_replace('.', '/', $component).'.blade.php');

            if (File::exists($templateFile)) {
                $titleName = str($path)->headline().' '.str(str_replace('.', ' ', $component))->headline();
                $content = File::get($templateFile);

                if ($component === 'settings.tabs') {
                    $wrappedContent = str_replace('[path]', $path, $content);
                } elseif (str_contains($content, '<x-[path].layouts.')) {
                    $wrappedContent = str_replace(
                        ['[path]', '[style]', '[Title]'],
                        [$path, $chosenLayout, $titleName],
                        $content
                    );
                } else {
                    $content = str_replace('[path]', $path, $content);
                    $wrappedContent = "<x-{$path}.layouts.{$chosenLayout}>\n    <vibe:seo title=\"{$titleName}\" />\n".$content."\n</x-{$path}.layouts.{$chosenLayout}>\n";
                }

                // Ensure directory exists
                $dir = dirname($destView);
                if (! File::isDirectory($dir)) {
                    File::makeDirectory($dir, 0755, true);
                }

                File::put($destView, $wrappedContent);
            }
        }

        // Ensure settings translations are published if not already present
        foreach (['id', 'en'] as $locale) {
            $destLang = lang_path("{$locale}/vibe/settings.php");
            $srcLang = __DIR__."/../../lang/{$locale}/vibe/settings.php";
            if (File::exists($srcLang) && ! File::exists($destLang)) {
                File::ensureDirectoryExists(dirname($destLang));
                File::copy($srcLang, $destLang);
            }
        }

        return true;
    }

    protected function cleanupUnusedLayouts(string $destDir, string $chosenLayout): void
    {
        $layoutsPath = $destDir.'/layouts';
        if (File::isDirectory($layoutsPath)) {
            $files = File::files($layoutsPath);
            foreach ($files as $file) {
                $filename = $file->getFilename();
                // We want to keep base.blade.php and the chosen layout.
                if ($filename !== 'base.blade.php' && $filename !== "{$chosenLayout}.blade.php") {
                    File::delete($file->getPathname());
                }
            }
        }

        $partialsPath = $destDir.'/partials';
        if (File::isDirectory($partialsPath)) {
            $files = File::files($partialsPath);
            foreach ($files as $file) {
                $filename = $file->getFilename();
                // We want to keep the chosen layout's menu
                if ($filename !== "{$chosenLayout}-menu.blade.php") {
                    File::delete($file->getPathname());
                }
            }

            // If layout is topbar, clean up optional directory as topbar does not use optional drawer/modal
            if ($chosenLayout === 'topbar') {
                $optionalPath = $partialsPath.'/optional';
                if (File::isDirectory($optionalPath)) {
                    File::deleteDirectory($optionalPath);
                }
            }
        }
    }

    protected function updateComponentReferences(string $dir, string $path): void
    {
        $files = File::allFiles($dir);
        $humanTitle = (string) str($path)->headline();

        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $content = File::get($file->getPathname());

                // Replace opening and closing tags
                $content = preg_replace('/<x-layouts\./', '<x-'.$path.'.layouts.', $content);
                $content = preg_replace('/<\/x-layouts\./', '</x-'.$path.'.layouts.', $content);

                $content = preg_replace('/<x-partials\./', '<x-'.$path.'.partials.', $content);
                $content = preg_replace('/<\/x-partials\./', '</x-'.$path.'.partials.', $content);

                // Replace [path] and [Title] placeholders in components (like menu files)
                $content = str_replace(
                    ['[path]', '[Title]'],
                    [$path, $humanTitle],
                    $content
                );

                // Site settings dropdown link
                $content = str_replace(
                    '<!-- Site settings -->'."\n".'                        <vibe:dropdown.item href="#" class="gap-3">',
                    '<!-- Site settings -->'."\n".'                        <vibe:dropdown.item href="{{ Route::has(\''.$path.'.settings.index\') ? route(\''.$path.'.settings.index\') : \'#\' }}" class="gap-3">',
                    $content
                );

                File::put($file->getPathname(), $content);
            }
        }
    }

    protected function generateRoute(string $path): bool
    {
        if (! $this->confirm("Create a new route file for '{$path}'? (routes/{$path}.php)", true)) {
            return false;
        }

        $routePath = base_path("routes/{$path}.php");
        $stubRouteContent = str_replace('[path]', $path, File::get(__DIR__.'/../../routes/routes.php'));

        if (File::exists($routePath)) {
            if (! $this->confirm("The route file '{$routePath}' already exists. Overwrite?", false)) {
                return false;
            }
        }

        File::put($routePath, $stubRouteContent);

        $appPath = base_path('bootstrap/app.php');
        if (File::exists($appPath)) {
            $appContent = File::get($appPath);

            if (! str_contains($appContent, "routes/{$path}.php")) {
                // Case 1: web: is already an array
                if (preg_match('/web:\s*\[/s', $appContent)) {
                    $appContent = preg_replace('/(web:\s*\[)/', "$1\n            __DIR__.'/../routes/{$path}.php',", $appContent);
                    File::put($appPath, $appContent);
                }
                // Case 2: web: is a single route file string
                elseif (preg_match('/web:\s*(__DIR__\s*\.\s*[\'"][^\'"]+[\'"])\s*,/', $appContent, $matches)) {
                    $originalRoute = $matches[1];
                    $replacement = "web: [\n            {$originalRoute},\n            __DIR__.'/../routes/{$path}.php',\n        ],";
                    $appContent = str_replace($matches[0], $replacement, $appContent);
                    File::put($appPath, $appContent);
                }
                // Case 3: Generic fallback for web: <expression>,
                elseif (preg_match('/web:\s*([^,\n]+),/', $appContent, $matches)) {
                    $expr = trim($matches[1]);
                    $replacement = "web: [\n            {$expr},\n            __DIR__.'/../routes/{$path}.php',\n        ],";
                    $appContent = str_replace($matches[0], $replacement, $appContent);
                    File::put($appPath, $appContent);
                }
            }
        }

        return true;
    }

    protected function configureLivewire(string $path): bool
    {
        $configPath = base_path('config/livewire.php');

        if (! File::exists($configPath)) {
            $this->call('livewire:publish', ['--config' => true]);
        }

        if (File::exists($configPath)) {
            $content = File::get($configPath);
            $changed = false;

            // Fix component_layout issue (Livewire default might be layouts::app)
            if (str_contains($content, "'component_layout' => 'layouts::app'")) {
                $content = str_replace(
                    "'component_layout' => 'layouts::app'",
                    "'component_layout' => 'components.layouts.app'",
                    $content
                );
                $changed = true;
            }

            if ($changed) {
                File::put($configPath, $content);

                return true;
            }
        }

        return false;
    }

    protected function promptForMissingArguments(InputInterface $input, OutputInterface $output): void
    {
        if ($this->didReceiveOptions($input)) {
            return;
        }

        $rawPath = (string) $input->getArgument('path');

        if (empty(trim($rawPath))) {
            $path = text(
                label: 'What is the name of the layout path you want to generate?',
                placeholder: 'e.g. admin',
                required: 'The layout path is required.',
                validate: fn (string $value) => match (true) {
                    empty(trim($value)) => 'The layout path is required.',
                    empty(str()->slug(trim($value))) => 'The layout path must contain valid alphanumeric characters.',
                    in_array(str()->slug(trim($value)), ['components', 'vibe']) => 'The layout path "'.str()->slug(trim($value)).'" is reserved. Please choose another name.',
                    default => null,
                }
            );

            $input->setArgument('path', $path);
        }
    }
}
