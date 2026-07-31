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

        $layoutsDir = __DIR__ . '/../../resources/views/components/layouts';
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
        $componentsDir = __DIR__ . '/../../resources/views/components';
        $destComponentsDir = resource_path('views/components');

        if (File::exists($destComponentsDir . '/layouts/app.blade.php')) {
            if ($this->confirm("Global layout components already exist. Overwrite them?", false)) {
                File::copyDirectory($componentsDir, $destComponentsDir);
            }
        } else {
            File::copyDirectory($componentsDir, $destComponentsDir);
        }

        $pages = [
            'index' => 'templates/index.blade.php',
        ];

        foreach ($pages as $component => $templatePath) {
            $this->call('make:livewire', ['name' => "{$path}.{$component}", '--class' => true]);

            $templateFile = __DIR__ . "/../../resources/views/{$templatePath}";
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

            // Inject Title attribute into the generated class
            $classNamePath = collect(explode('.', $component))->map(fn($part) => ucfirst($part))->implode('/');
            $classFile = app_path("Livewire/" . str($path)->studly() . "/{$classNamePath}.php");
            
            if (File::exists($classFile)) {
                $classContent = File::get($classFile);
                if (!str_contains($classContent, 'use Livewire\Attributes\Title;')) {
                    $titleName = str($path)->headline() . ' ' . str(str_replace('.', ' ', $component))->headline();
                    
                    $classContent = str_replace(
                        "use Livewire\Component;\n\nclass",
                        "use Livewire\Component;\nuse Livewire\Attributes\Layout;\nuse Livewire\Attributes\Title;\n\n#[Title('" . $titleName . "')]\n#[Layout('components.layouts.{$chosenLayout}')]\nclass",
                        $classContent
                    );
                    File::put($classFile, $classContent);
                }
            }
        }

        return true;
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