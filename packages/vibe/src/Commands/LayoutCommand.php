<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Laravel\Prompts\text;
use function Laravel\Prompts\select;

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
        $path = str()->slug($this->argument('path'));

        $layoutsDir = __DIR__ . '/../../stubs/Layouts/layouts';
        $layoutFiles = glob($layoutsDir . '/*.blade.php');
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
            $layoutOptions
        );

        $layout = $this->generateLayouts($path, $chosenLayout);
        $route = $this->generateRoute($path);
        $livewire = $this->configureLivewire($path);

        $this->newLine();
        $list = [];
        if ($layout) {
            $this->components->success("Layout created");
            $list[] = "resources/views/{$path}";
        } else {
            $this->components->info("Layout skipped.");
        }

        if ($route) {
            $this->components->success("Route file created and linked in bootstrap/app.php");
            $list[] = "routes/{$path}.php";
        } else {
            $this->components->info("Route skipped.");
        }
        
        if ($livewire) {
            $this->components->success("Livewire config updated");
            $list[] = "config/livewire.php";
        }

        if(count($list) > 0) {
            $this->components->bulletList($list);
        }
        $this->newLine();
    }

    protected function generateLayouts(string $path, string $chosenLayout): bool
    {
        $componentsDir = __DIR__ . '/../../stubs/Layouts';
        $destComponentsDir = resource_path("views/components/{$path}");

        if (File::exists($destComponentsDir)) {
            if ($this->confirm("Layout components for {$path} already exist. Overwrite them?", false)) {
                File::copyDirectory($componentsDir, $destComponentsDir);
                $this->updateComponentReferences($destComponentsDir, $path);
            }
        } else {
            File::copyDirectory($componentsDir, $destComponentsDir);
            $this->updateComponentReferences($destComponentsDir, $path);
        }

        $pages = [
            'index' => 'pages/index.blade.php',
        ];

        foreach ($pages as $component => $templatePath) {
            $this->call('make:livewire', ['name' => "{$path}.{$component}", '--class' => true]);

            $templateFile = __DIR__ . "/../../stubs/Templates/{$templatePath}";
            $destView = resource_path("views/livewire/{$path}/" . str_replace('.', '/', $component) . ".blade.php");

            if (File::exists($templateFile)) {
                $content = str_replace('[path]', $path, File::get($templateFile));
                
                // Ensure directory exists
                $dir = dirname($destView);
                if (!File::isDirectory($dir)) {
                    File::makeDirectory($dir, 0755, true);
                }
                
                File::put($destView, $content);
            }

            // Inject Title attribute using custom stub
            $classNamePath = collect(explode('.', $component))->map(fn($part) => ucfirst($part))->implode('/');
            $classFile = app_path("Livewire/" . str($path)->studly() . "/{$classNamePath}.php");
            
            $stubPath = __DIR__ . '/../../stubs/Pages/page.php';
            if (File::exists($classFile) && File::exists($stubPath)) {
                $titleName = str($path)->headline() . ' ' . str(str_replace('.', ' ', $component))->headline();
                
                $className = collect(explode('.', $component))->map(fn($part) => ucfirst($part))->last();
                $namespacePath = collect(explode('.', $component))->slice(0, -1)->map(fn($part) => ucfirst($part))->implode('\\');
                
                $namespace = "App\\Livewire\\" . str($path)->studly();
                if ($namespacePath) {
                    $namespace .= "\\" . $namespacePath;
                }
                
                $viewPath = "livewire.{$path}." . str_replace('.', '.', $component);
                
                $classContent = File::get($stubPath);
                $classContent = str_replace(
                    ['[Namespace]', '[Title]', '[Layout]', '[ClassName]', '[ViewPath]'],
                    [$namespace, $titleName, "components.{$path}.layouts.{$chosenLayout}", $className, $viewPath],
                    $classContent
                );
                
                File::put($classFile, $classContent);
            }
            
            // Add to menu
            $menuPath = resource_path("views/components/{$path}/partials/menu.blade.php");
            $stubPath = __DIR__ . "/../../stubs/Partials/{$chosenLayout}/item.blade.php";
            
            if (File::exists($menuPath) && File::exists($stubPath)) {
                $menuContent = File::get($menuPath);
                
                if (str_contains($menuContent, '</vibe:nav>')) {
                    $stub = File::get($stubPath);
                    $humanTitle = (string) str($path)->headline();
                    
                    // The layout's index route is just {$path}.index
                    // The active check should exactly match {$path}.index so it doesn't stay active on all child pages
                    $stub = str_replace(
                        ["route('[route].index')", "request()->routeIs('[route].*')", '[Title]'], 
                        ["route('{$path}.index')", "request()->routeIs('{$path}.index')", $humanTitle], 
                        $stub
                    );
                    
                    $menuContent = str_replace('</vibe:nav>', $stub . "\n</vibe:nav>", $menuContent);
                    File::put($menuPath, $menuContent);
                }
            }
        }

        return true;
    }

    protected function updateComponentReferences(string $dir, string $path): void
    {
        $files = File::allFiles($dir);
        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $content = File::get($file->getPathname());
                
                // Replace opening and closing tags
                $content = preg_replace('/<x-layouts\./', '<x-' . $path . '.layouts.', $content);
                $content = preg_replace('/<\/x-layouts\./', '</x-' . $path . '.layouts.', $content);
                
                $content = preg_replace('/<x-partials\./', '<x-' . $path . '.partials.', $content);
                $content = preg_replace('/<\/x-partials\./', '</x-' . $path . '.partials.', $content);
                
                File::put($file->getPathname(), $content);
            }
        }
    }

    protected function generateRoute(string $path): bool
    {
        if (! $this->confirm("Create a new route file for '{$path}'? (routes/{$path}.php)", false)) {
            return false;
        }

        $routePath = base_path("routes/{$path}.php");
        $stubRouteContent = str_replace('[path]', $path, File::get(__DIR__ . '/../../routes/routes.php'));

        if (File::exists($routePath)) {
            if (! $this->confirm("The route file '{$routePath}' already exists. Overwrite?", false)) {
                return false;
            }
        }

        File::put($routePath, $stubRouteContent);

        $appPath = base_path('bootstrap/app.php');
        $appContent = File::get($appPath);
        
        $searchSingle = "web: __DIR__.'/../routes/web.php',";
        $replaceSingle = "web: [\n            __DIR__.'/../routes/web.php',\n            __DIR__.'/../routes/{$path}.php',\n        ],";
        
        if (!str_contains($appContent, "routes/{$path}.php")) {
            if (str_contains($appContent, $searchSingle)) {
                $appContent = str_replace($searchSingle, $replaceSingle, $appContent);
                File::put($appPath, $appContent);
            } else {
                $searchArray = "web: [\n            __DIR__.'/../routes/web.php',";
                $replaceArray = "web: [\n            __DIR__.'/../routes/web.php',\n            __DIR__.'/../routes/{$path}.php',";
                if (str_contains($appContent, "web: [")) {
                     $appContent = preg_replace('/(web:\s*\[)/', "$1\n            __DIR__.'/../routes/{$path}.php',", $appContent);
                     File::put($appPath, $appContent);
                }
            }
        }

        return true;
    }

    protected function configureLivewire(string $path): bool
    {
        $configPath = base_path('config/livewire.php');
        
        if (!File::exists($configPath)) {
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

        if (! $input->getArgument('path')) {
            $path = text('What is the name of the layout path you want to generate?', 'admin');
            $input->setArgument('path', $path);
        }
    }
}