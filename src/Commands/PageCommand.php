<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Laravel\Prompts\text;
use function Laravel\Prompts\select;

class PageCommand extends Command implements PromptsForMissingInput
{
    protected $signature = 'vibe:page
        {layout : The layout panel name}
        {name : The page name}
        {--r|resource : Generate resource pages (index, create, edit)}
        {--b|blank : Generate a blank page}';

    protected $description = 'Generate a new page inside a layout.';

    public function handle(): void
    {
        $layout = str()->slug($this->argument('layout'));

        if (!File::exists(base_path("routes/{$layout}.php"))) {
            $this->components->error("Layout group '{$layout}' does not exist! Please create a layout group first using `php artisan vibe:layout {$layout}`.");
            return;
        }

        $name = str()->slug($this->argument('name'));
        $isResource = $this->option('resource');
        $isBlank = $this->option('blank');

        // Detect layout style from the group's Index component
        $style = 'sidebar'; // Default fallback
        $indexFile = app_path("Livewire/" . str($layout)->studly() . "/Index.php");
        if (File::exists($indexFile)) {
            $indexContent = File::get($indexFile);
            if (preg_match('/#\[Layout\([\'"]components\.layouts\.([a-zA-Z0-9_-]+)[\'"]\)\]/', $indexContent, $matches)) {
                $style = $matches[1];
            }
        }

        $actions = $isResource ? ['index', 'create', 'edit'] : ['index'];
        $list = [];

        foreach ($actions as $action) {
            $componentName = "{$layout}.{$name}.{$action}";
            $this->call('make:livewire', ['name' => $componentName, '--class' => true]);

            if ($isResource) {
                $templateFile = __DIR__ . "/../../resources/views/templates/resource/{$action}.blade.php";
            } elseif ($isBlank) {
                $templateFile = __DIR__ . "/../../resources/views/templates/blank.blade.php";
            } else {
                $templateFile = __DIR__ . "/../../resources/views/templates/index.blade.php";
            }

            $destView = resource_path("views/livewire/{$layout}/{$name}/{$action}.blade.php");

            if (File::exists($templateFile)) {
                $content = str_replace('[path]', $layout, File::get($templateFile));
                File::put($destView, $content);
            }

            // Inject Title and Layout attribute into the generated class
            $className = ucfirst($action);
            $classFile = app_path("Livewire/" . str($layout)->studly() . "/" . str($name)->studly() . "/{$className}.php");
            
            if (File::exists($classFile)) {
                $classContent = File::get($classFile);
                if (!str_contains($classContent, 'use Livewire\Attributes\Title;')) {
                    $pageTitle = str($layout)->headline() . ' ' . str($name)->headline();
                    if ($action !== 'index') {
                        $pageTitle .= ' ' . ucfirst($action);
                    }
                    
                    $classContent = str_replace(
                        "use Livewire\Component;\n\nclass",
                        "use Livewire\Component;\nuse Livewire\Attributes\Layout;\nuse Livewire\Attributes\Title;\n\n#[Title('{$pageTitle}')]\n#[Layout('components.layouts.{$style}')]\nclass",
                        $classContent
                    );
                    File::put($classFile, $classContent);
                }
            }
            
            $list[] = "app/Livewire/" . str($layout)->studly() . "/" . str($name)->studly() . "/{$className}.php";
        }

        // Add to routes
        $routePath = base_path("routes/{$layout}.php");
        if (File::exists($routePath)) {
            $routeContent = File::get($routePath);
            $routePrefix = "\n    Route::prefix('{$name}')->name('{$name}.')->group(function () {\n";
            $routePrefix .= "        Route::livewire('/', '{$layout}.{$name}.index')->name('index');\n";
            if ($isResource) {
                $routePrefix .= "        Route::livewire('/create', '{$layout}.{$name}.create')->name('create');\n";
                $routePrefix .= "        Route::livewire('/{id}/edit', '{$layout}.{$name}.edit')->name('edit');\n";
            }
            $routePrefix .= "    });\n";
            
            if (str_contains($routeContent, "});")) {
                $routeContent = preg_replace('/(}\);\s*)$/', $routePrefix . "\n$1", $routeContent);
            } else {
                $routeContent .= $routePrefix;
            }
            File::put($routePath, $routeContent);
            $list[] = "Updated routes/{$layout}.php";
        }

        // Add to menu
        $menuPath = resource_path('views/components/partials/menu.blade.php');
        if (File::exists($menuPath)) {
            $menuContent = File::get($menuPath);
            $stubName = $isResource ? 'menu-group.stub' : 'menu-item.stub';
            $stubPath = __DIR__ . "/../../stubs/partials/{$style}/{$stubName}";
            
            if (File::exists($stubPath) && str_contains($menuContent, '</vibe:nav>')) {
                $stub = File::get($stubPath);
                
                $routePrefixName = "{$layout}.{$name}";
                $humanTitle = (string) str($name)->headline();
                
                $stub = str_replace(['[route]', '[Title]'], [$routePrefixName, $humanTitle], $stub);
                
                // Inject right before </vibe:nav>
                $menuContent = preg_replace('/(<\/vibe:nav>\s*)$/', "\n" . $stub . "\n$1", $menuContent);
                File::put($menuPath, $menuContent);
                $list[] = "Updated resources/views/components/partials/menu.blade.php";
            }
        }

        $this->newLine();
        $this->components->success("Page(s) created successfully.");
        if (count($list) > 0) {
            $this->components->bulletList($list);
        }
        $this->newLine();
    }

    protected function promptForMissingArguments(InputInterface $input, OutputInterface $output): void
    {
        if ($this->didReceiveOptions($input)) {
            return;
        }

        if (! $input->getArgument('layout')) {
            $livewireDir = resource_path('views/livewire');
            $layoutGroups = [];
            
            if (File::isDirectory($livewireDir)) {
                $directories = File::directories($livewireDir);
                foreach ($directories as $dir) {
                    $dirName = basename($dir);
                    if (File::exists(base_path("routes/{$dirName}.php"))) {
                        $layoutGroups[$dirName] = ucfirst($dirName);
                    }
                }
            }

            if (!empty($layoutGroups)) {
                $layout = select(
                    'Which layout group?',
                    $layoutGroups
                );
            } else {
                $this->components->error("No layout groups found! Please create a layout group first using `php artisan vibe:layout`.");
                exit(1);
            }
            
            $input->setArgument('layout', $layout);
        }

        if (! $input->getArgument('name')) {
            $name = text('What is the page name?', 'product');
            $input->setArgument('name', $name);
        }

        if (! $input->getOption('resource') && ! $input->getOption('blank')) {
            $type = select(
                'What type of page do you want to generate?',
                [
                    'index' => 'Index (1 page with grid)',
                    'blank' => 'Blank (1 empty page)',
                    'resource' => 'Resource (Index, Create, Edit)'
                ]
            );

            if ($type === 'resource') {
                $input->setOption('resource', true);
            } elseif ($type === 'blank') {
                $input->setOption('blank', true);
            }
        }
    }
}
