<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

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

        if (! File::exists(base_path("routes/{$layout}.php"))) {
            $this->components->error("Layout group '{$layout}' does not exist! Please create a layout group first using `php artisan vibe:layout {$layout}`.");

            return;
        }

        $name = str()->slug($this->argument('name'));
        $isResource = $this->option('resource');
        $isBlank = $this->option('blank');

        // Detect layout style from the layout components directory
        $style = 'sidebar'; // Default fallback
        $layoutDir = resource_path("views/components/{$layout}/layouts");
        if (File::isDirectory($layoutDir)) {
            $files = File::files($layoutDir);
            foreach ($files as $file) {
                $filename = basename($file->getFilename(), '.blade.php');
                if ($filename !== 'base') {
                    $style = $filename;
                    break;
                }
            }
        }

        $actions = $isResource ? ['index', 'create', 'edit'] : ['index'];
        $list = [];

        foreach ($actions as $action) {
            if ($isResource) {
                $templateFile = __DIR__."/../../stubs/Templates/crud/resource/{$action}.blade.php";
            } elseif ($isBlank) {
                $templateFile = __DIR__.'/../../stubs/Templates/pages/blank.blade.php';
            } else {
                $templateFile = __DIR__.'/../../stubs/Templates/pages/index.blade.php';
            }

            $destView = resource_path("views/{$layout}/{$name}/{$action}.blade.php");

            if (File::exists($templateFile)) {
                $pageTitle = str($layout)->headline().' - '.str($name)->headline();
                if ($action !== 'index') {
                    $pageTitle .= ' '.ucfirst($action);
                }

                $content = File::get($templateFile);

                if (str_contains($content, '<x-[path].layouts.')) {
                    $wrappedContent = str_replace(
                        ['[path]', '[style]', '[Title]'],
                        [$layout, $style, $pageTitle],
                        $content
                    );
                } else {
                    $content = str_replace('[path]', $layout, $content);
                    $wrappedContent = "<x-{$layout}.layouts.{$style}>\n    <vibe:seo title=\"{$pageTitle}\" />\n".$content."\n</x-{$layout}.layouts.{$style}>\n";
                }

                $dir = dirname($destView);
                if (! File::isDirectory($dir)) {
                    File::makeDirectory($dir, 0755, true);
                }

                File::put($destView, $wrappedContent);
            }

            $list[] = "resources/views/{$layout}/{$name}/{$action}.blade.php";
        }

        // Add to routes
        $routePath = base_path("routes/{$layout}.php");
        if (File::exists($routePath)) {
            $routeContent = File::get($routePath);
            $routePrefix = "\n    Route::prefix('{$name}')->name('{$name}.')->group(function () {\n";
            $routePrefix .= "        Route::view('/', '{$layout}.{$name}.index')->name('index');\n";
            if ($isResource) {
                $routePrefix .= "        Route::view('/create', '{$layout}.{$name}.create')->name('create');\n";
                $routePrefix .= "        Route::view('/{id}/edit', '{$layout}.{$name}.edit')->name('edit');\n";
            }
            $routePrefix .= "    });\n";

            $groupPattern = '/(Route::prefix\([\'"]'.preg_quote($layout, '/').'[\'"].*?group\(function\s*\(\)\s*\{)(.*?)(\n\}\);)/s';
            if (preg_match($groupPattern, $routeContent)) {
                $routeContent = preg_replace_callback($groupPattern, function ($matches) use ($routePrefix) {
                    return $matches[1].$matches[2].$routePrefix.$matches[3];
                }, $routeContent);
            } else {
                $lastGroupClose = strrpos($routeContent, '});');
                if ($lastGroupClose !== false) {
                    $routeContent = substr_replace($routeContent, $routePrefix.'});', $lastGroupClose, 3);
                } else {
                    $routeContent .= $routePrefix;
                }
            }
            File::put($routePath, $routeContent);
            $list[] = "Updated routes/{$layout}.php";
        }

        // Add to menu
        $menuPath = resource_path("views/components/{$layout}/partials/{$style}-menu.blade.php");
        if (File::exists($menuPath)) {
            $menuContent = File::get($menuPath);
            $stubName = $isResource ? 'group.blade.php' : 'item.blade.php';
            $stubPath = __DIR__."/../../stubs/Partials/{$style}/{$stubName}";

            if (File::exists($stubPath) && str_contains($menuContent, '</vibe:nav>')) {
                $stub = File::get($stubPath);

                $routePrefixName = "{$layout}.{$name}";
                $humanTitle = (string) str($name)->headline();

                $stub = str_replace(['[route]', '[Title]'], [$routePrefixName, $humanTitle], $stub);

                // Inject right before </vibe:nav>
                $menuContent = preg_replace('/(<\/vibe:nav>\s*)$/', "\n".$stub."\n$1", $menuContent);
                File::put($menuPath, $menuContent);
                $list[] = "Updated resources/views/components/{$layout}/partials/{$style}-menu.blade.php";
            }
        }

        $this->newLine();
        $this->components->success('Page(s) created successfully.');
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
            $componentsDir = resource_path('views/components');
            $layoutGroups = [];

            if (File::isDirectory($componentsDir)) {
                $directories = File::directories($componentsDir);
                foreach ($directories as $dir) {
                    $dirName = basename($dir);
                    if (File::exists(base_path("routes/{$dirName}.php"))) {
                        $layoutGroups[$dirName] = ucfirst($dirName);
                    }
                }
            }

            if (! empty($layoutGroups)) {
                $layout = select(
                    'Which layout group?',
                    $layoutGroups
                );
            } else {
                $this->components->error('No layout groups found! Please create a layout group first using `php artisan vibe:layout`.');
                exit(1);
            }

            $input->setArgument('layout', $layout);
        }

        if (! $input->getArgument('name')) {
            $name = text('What is the page name?', 'product');
            $input->setArgument('name', $name);
        }

        if (! $input->getOption('resource') && ! $input->getOption('blank')) {
            $baseType = select(
                'Apakah menggunakan template static atau crud?',
                [
                    'static' => 'Template Static (Kosong / Index Biasa)',
                    'crud' => 'Template CRUD (Auto-generate dari Database)',
                ]
            );

            if ($baseType === 'crud') {
                $type = select(
                    'Pilih jenis template CRUD yang ingin digunakan:',
                    [
                        'crud-sheet' => 'CRUD 1 Halaman — Sheet (form di slide-over kanan)',
                        'crud-index' => 'CRUD 1 Halaman — Modal (form di dalam modal)',
                        'crud-resource' => 'CRUD Terpisah — Resource (Index, Create, Edit pages)',
                    ]
                );

                $generateCrud = select('Lanjutkan auto-generate dari Database Schema?', [
                    'yes' => 'Ya, Generate sekarang',
                    'no' => 'Lewati (Hanya buat file kosong)',
                ], default: 'yes');

                if ($generateCrud === 'yes') {
                    $this->call('vibe:crud', [
                        'layout' => $input->getArgument('layout'),
                        'name' => $input->getArgument('name'),
                        '--type' => $type,
                    ]);
                    exit(0);
                } else {
                    if ($type === 'crud-resource') {
                        $input->setOption('resource', true);
                    }
                }
            } else {
                $type = select(
                    'Pilih jenis template Static:',
                    [
                        'index' => 'Index (1 halaman dengan grid / layout standar)',
                        'blank' => 'Blank (1 halaman kosong)',
                        'resource' => 'Resource (Index, Create, Edit kosong)',
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
}
