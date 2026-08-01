<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Illuminate\Support\Str;

use function Laravel\Prompts\text;
use function Laravel\Prompts\select;

class CrudCommand extends Command implements PromptsForMissingInput
{
    protected $signature = 'vibe:crud
        {layout : The layout panel name}
        {name : The page name}
        {--type= : The CRUD type (crud-index or crud-resource)}
        {--model= : The Eloquent Model class name}';

    protected $description = 'Generate a dynamic CRUD page based on database schema.';

    public function handle(): void
    {
        $layout = str()->slug($this->argument('layout'));
        $name = str()->slug($this->argument('name'));
        $type = $this->option('type') ?: select('What type of CRUD do you want to generate?', [
            'crud-index' => 'CRUD Index (Modal for Create/Edit)',
            'crud-resource' => 'CRUD Resource (Separate pages for Index/Create/Edit)',
        ]);

        $modelName = $this->option('model');
        if (!$modelName) {
            $modelName = text('What is the Eloquent Model name? (e.g. Product, User)', default: Str::studly(Str::singular($name)));
        }

        $modelClass = "App\\Models\\" . $modelName;
        if (!class_exists($modelClass)) {
            $this->components->error("Model {$modelClass} does not exist. Please create the model and migration first.");
            return;
        }

        $modelInstance = new $modelClass;
        $table = $modelInstance->getTable();

        if (!Schema::hasTable($table)) {
            $this->components->error("Table '{$table}' does not exist. Please run migrations first.");
            return;
        }

        // Get columns
        $columns = Schema::getColumnListing($table);
        $schemaMapping = [];

        foreach ($columns as $column) {
            if (in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at', 'email_verified_at', 'remember_token'])) {
                $component = select("Select UI component for column '{$column}'", [
                    'skip' => 'Skip',
                    'input' => 'Input',
                    'textarea' => 'Textarea',
                    'select' => 'Select',
                    'checkbox' => 'Checkbox'
                ], default: 'skip');
            } else {
                $defaultComp = 'input';
                if (Str::contains($column, 'description') || Str::contains($column, 'body')) {
                    $defaultComp = 'textarea';
                } elseif (Str::contains($column, 'is_') || Str::contains($column, 'has_')) {
                    $defaultComp = 'checkbox';
                }

                $component = select("Select UI component for column '{$column}'", [
                    'skip' => 'Skip',
                    'input' => 'Input',
                    'textarea' => 'Textarea',
                    'select' => 'Select',
                    'checkbox' => 'Checkbox'
                ], default: $defaultComp);
            }

            if ($component !== 'skip') {
                if ($component === 'input') {
                    $defaultType = 'text';
                    if (Str::contains($column, 'email')) $defaultType = 'email';
                    if (Str::contains($column, 'password')) $defaultType = 'password';
                    if (Str::contains($column, 'date')) $defaultType = 'date';
                    if (Str::contains($column, ['price', 'amount', 'qty', 'count', 'id'])) $defaultType = 'number';

                    $inputType = select("Select input type for '{$column}'", [
                        'text' => 'Text',
                        'number' => 'Number',
                        'email' => 'Email',
                        'password' => 'Password',
                        'date' => 'Date',
                        'color' => 'Color'
                    ], default: $defaultType);

                    $schemaMapping[$column] = ['component' => 'input', 'type' => $inputType];
                } else {
                    $schemaMapping[$column] = ['component' => $component];
                }
            }
        }

        // Detect layout style from the group's Index component
        $style = 'sidebar';
        $indexFile = app_path("Livewire/" . str($layout)->studly() . "/Index.php");
        if (File::exists($indexFile)) {
            $indexContent = File::get($indexFile);
            if (preg_match('/#\[Layout\([\'"]components\.(?:[a-zA-Z0-9_-]+\.)?layouts\.([a-zA-Z0-9_-]+)[\'"]\)\]/', $indexContent, $matches)) {
                $style = $matches[1];
            }
        }

        // Generate files
        if ($type === 'crud-index') {
            $this->generateCrudIndex($layout, $name, $modelClass, $modelName, $schemaMapping, $style);
        } else {
            $this->generateCrudResource($layout, $name, $modelClass, $modelName, $schemaMapping, $style);
        }

        // Add to routes
        $this->updateRoutes($layout, $name, $type);

        // Add to menu
        $this->updateMenu($layout, $name, $style, $type);

        $this->newLine();
        $this->components->success("CRUD {$name} created successfully.");
        $this->newLine();
    }

    protected function generateCrudIndex($layout, $name, $modelClass, $modelName, $schemaMapping, $style)
    {
        $componentName = "{$layout}.{$name}.index";
        $this->call('make:livewire', ['name' => $componentName, '--class' => true]);

        // Build View
        $destView = resource_path("views/livewire/{$layout}/{$name}/index.blade.php");
        $datatableStub = __DIR__ . '/../../stubs/Organisms/crud/datatable.blade.php';
        $formStub = __DIR__ . '/../../stubs/Organisms/crud/form-create.blade.php';

        $viewContent = File::exists($datatableStub) ? File::get($datatableStub) : '';
        $formContent = File::exists($formStub) ? File::get($formStub) : '';

        $title = Str::headline($layout) . ' ' . Str::headline($name);
        
        $tableHeaders = '';
        $tableData = '';
        $formFields = '';
        $firstColumn = 'id';
        $isFirst = true;

        foreach ($schemaMapping as $col => $map) {
            if ($isFirst) {
                $firstColumn = $col;
                $isFirst = false;
            }
            $label = Str::headline($col);
            $tableHeaders .= "<th class=\"px-6 py-3\">{$label}</th>\n                    ";
            $tableData .= "<td class=\"px-6 py-4\">{{ \$item->{$col} }}</td>\n                    ";
            
            $formFields .= $this->buildFormField($col, $label, $map);
        }

        $viewContent = str_replace('[Title]', $title, $viewContent);
        $viewContent = str_replace('[CreateAction]', '<vibe:button variant="primary" wire:click="create">Tambah Data</vibe:button>', $viewContent);
        $viewContent = str_replace('[TableHeaders]', $tableHeaders, $viewContent);
        $viewContent = str_replace('[TableData]', $tableData, $viewContent);
        $viewContent = str_replace('[EditAction]', '<vibe:button variant="ghost" size="sm" wire:click="edit({{ $item->id }})">Edit</vibe:button>', $viewContent);

        $formContent = str_replace('[Title]', '{{ $editId ? \'Edit Data\' : \'Tambah Data\' }}', $formContent);
        $formContent = str_replace('[FormFields]', $formFields, $formContent);
        $formContent = str_replace('[CancelAction]', '<vibe:button variant="ghost" type="button" wire:click="$set(\'isOpen\', false)">Batal</vibe:button>', $formContent);

        $modalContent = "<vibe:modal wire:model=\"isOpen\">\n    {$formContent}\n</vibe:modal>";
        $viewContent = str_replace('[Modals]', $modalContent, $viewContent);

        File::put($destView, $viewContent);

        // Build Class
        $classNamePath = "Livewire/" . str($layout)->studly() . "/" . str($name)->studly() . "/Index.php";
        $classFile = app_path($classNamePath);
        
        $classStub = __DIR__ . '/../../stubs/Pages/crud/modal/index.php';
        if (File::exists($classStub)) {
            $classContent = File::get($classStub);
            
            $namespace = "App\\Livewire\\" . str($layout)->studly() . "\\" . str($name)->studly();
            $properties = '';
            $rules = '';
            $resetFields = '';
            $setProperties = '';

            foreach ($schemaMapping as $col => $map) {
                $properties .= "public \${$col};\n    ";
                $rules .= "'{$col}' => 'required',\n            ";
                $resetFields .= "'{$col}', ";
                $setProperties .= "\$this->{$col} = \$model->{$col};\n        ";
            }
            $resetFields = rtrim($resetFields, ', ');

            $classContent = str_replace('[Namespace]', $namespace, $classContent);
            $classContent = str_replace('[ModelNamespace]', $modelClass, $classContent);
            $classContent = str_replace('[Title]', $title, $classContent);
            $classContent = str_replace('[Layout]', "components.{$layout}.layouts.{$style}", $classContent);
            $classContent = str_replace('[ClassName]', 'Index', $classContent);
            $classContent = str_replace('[Properties]', $properties, $classContent);
            $classContent = str_replace('[Rules]', $rules, $classContent);
            $classContent = str_replace('[ResetFields]', $resetFields, $classContent);
            $classContent = str_replace('[SetProperties]', $setProperties, $classContent);
            $classContent = str_replace('[ModelName]', $modelName, $classContent);
            $classContent = str_replace('[FirstColumn]', $firstColumn, $classContent);
            $classContent = str_replace('[ViewPath]', "livewire.{$layout}.{$name}.index", $classContent);

            File::put($classFile, $classContent);
        }
    }

    protected function generateCrudResource($layout, $name, $modelClass, $modelName, $schemaMapping, $style)
    {
        $actions = ['index', 'create', 'edit'];
        $firstColumn = 'id';
        
        // Prepare common strings
        $tableHeaders = '';
        $tableData = '';
        $formFields = '';
        $properties = '';
        $rules = '';
        $setProperties = '';
        
        $isFirst = true;
        foreach ($schemaMapping as $col => $map) {
            if ($isFirst) {
                $firstColumn = $col;
                $isFirst = false;
            }
            $label = Str::headline($col);
            $tableHeaders .= "<th class=\"px-6 py-3\">{$label}</th>\n                    ";
            $tableData .= "<td class=\"px-6 py-4\">{{ \$item->{$col} }}</td>\n                    ";
            $formFields .= $this->buildFormField($col, $label, $map);
            
            $properties .= "public \${$col};\n    ";
            $rules .= "'{$col}' => 'required',\n            ";
            $setProperties .= "\$this->{$col} = \$model->{$col};\n        ";
        }

        foreach ($actions as $action) {
            $componentName = "{$layout}.{$name}.{$action}";
            $this->call('make:livewire', ['name' => $componentName, '--class' => true]);

            $destView = resource_path("views/livewire/{$layout}/{$name}/{$action}.blade.php");
            $title = Str::headline($layout) . ' ' . Str::headline($name);
            if ($action !== 'index') $title .= ' ' . ucfirst($action);

            // Generate Views
            if ($action === 'index') {
                $stub = __DIR__ . '/../../stubs/Templates/crud/resource/index.blade.php';
                $content = File::exists($stub) ? File::get($stub) : '';
                $orgStub = __DIR__ . '/../../stubs/Organisms/crud/datatable.blade.php';
                $orgContent = File::exists($orgStub) ? File::get($orgStub) : '';
                $orgContent = str_replace('[Title]', $title, $orgContent);
                $orgContent = str_replace('[CreateAction]', "<vibe:button variant=\"primary\" href=\"{{ route('{$layout}.{$name}.create') }}\" wire:navigate>Tambah Data</vibe:button>", $orgContent);
                $orgContent = str_replace('[TableHeaders]', $tableHeaders, $orgContent);
                $orgContent = str_replace('[TableData]', $tableData, $orgContent);
                $orgContent = str_replace('[EditAction]', "<vibe:button variant=\"ghost\" size=\"sm\" href=\"{{ route('{$layout}.{$name}.edit', \$item->id) }}\" wire:navigate>Edit</vibe:button>", $orgContent);
                $orgContent = str_replace('[Modals]', '', $orgContent);
                $content = str_replace('[DataTable]', $orgContent, $content);
                File::put($destView, $content);
            } elseif ($action === 'create') {
                $stub = __DIR__ . '/../../stubs/Templates/crud/resource/create.blade.php';
                $content = File::exists($stub) ? File::get($stub) : '';
                $orgStub = __DIR__ . '/../../stubs/Organisms/crud/form-create.blade.php';
                $orgContent = File::exists($orgStub) ? File::get($orgStub) : '';
                $orgContent = str_replace('[Title]', $title, $orgContent);
                $orgContent = str_replace('[FormFields]', $formFields, $orgContent);
                $orgContent = str_replace('[CancelAction]', "<vibe:button variant=\"ghost\" type=\"button\" href=\"{{ route('{$layout}.{$name}.index') }}\" wire:navigate>Batal</vibe:button>", $orgContent);
                $content = str_replace('[FormContent]', $orgContent, $content);
                File::put($destView, $content);
            } elseif ($action === 'edit') {
                $stub = __DIR__ . '/../../stubs/Templates/crud/resource/edit.blade.php';
                $content = File::exists($stub) ? File::get($stub) : '';
                $orgStub = __DIR__ . '/../../stubs/Organisms/crud/form-edit.blade.php';
                $orgContent = File::exists($orgStub) ? File::get($orgStub) : '';
                $orgContent = str_replace('[Title]', $title, $orgContent);
                $orgContent = str_replace('[FormFields]', $formFields, $orgContent);
                $orgContent = str_replace('[CancelAction]', "<vibe:button variant=\"ghost\" type=\"button\" href=\"{{ route('{$layout}.{$name}.index') }}\" wire:navigate>Batal</vibe:button>", $orgContent);
                $content = str_replace('[FormContent]', $orgContent, $content);
                File::put($destView, $content);
            }

            // Generate Classes
            $classNamePath = "Livewire/" . str($layout)->studly() . "/" . str($name)->studly() . "/" . ucfirst($action) . ".php";
            $classFile = app_path($classNamePath);
            $classStub = __DIR__ . "/../../stubs/Pages/crud/resource/{$action}.php";
            
            if (File::exists($classStub) && File::exists($classFile)) {
                $classContent = File::get($classStub);
                $namespace = "App\\Livewire\\" . str($layout)->studly() . "\\" . str($name)->studly();
                
                $classContent = str_replace('[Namespace]', $namespace, $classContent);
                $classContent = str_replace('[ModelNamespace]', $modelClass, $classContent);
                $classContent = str_replace('[Title]', $title, $classContent);
                $classContent = str_replace('[Layout]', "components.{$layout}.layouts.{$style}", $classContent);
                $classContent = str_replace('[Properties]', $properties, $classContent);
                $classContent = str_replace('[Rules]', $rules, $classContent);
                $classContent = str_replace('[SetProperties]', $setProperties, $classContent);
                $classContent = str_replace('[ModelName]', $modelName, $classContent);
                $classContent = str_replace('[FirstColumn]', $firstColumn, $classContent);
                $classContent = str_replace('[ViewPath]', "livewire.{$layout}.{$name}.{$action}", $classContent);
                $classContent = str_replace('[RoutePrefix]', "{$layout}.{$name}", $classContent);
                
                File::put($classFile, $classContent);
            }
        }
    }

    protected function buildFormField($col, $label, $map)
    {
        if ($map['component'] === 'input') {
            return "<vibe:input wire:model=\"{$col}\" label=\"{$label}\" type=\"{$map['type']}\" placeholder=\"Masukkan {$label}\" />\n                ";
        } elseif ($map['component'] === 'textarea') {
            return "<vibe:textarea wire:model=\"{$col}\" label=\"{$label}\" placeholder=\"Masukkan {$label}\" />\n                ";
        } elseif ($map['component'] === 'select') {
            return "<vibe:select wire:model=\"{$col}\" label=\"{$label}\">\n                        <option value=\"\">Pilih {$label}</option>\n                    </vibe:select>\n                ";
        } elseif ($map['component'] === 'checkbox') {
            return "<vibe:checkbox wire:model=\"{$col}\" label=\"{$label}\" />\n                ";
        }
        
        return '';
    }

    protected function updateRoutes($layout, $name, $type)
    {
        $routePath = base_path("routes/{$layout}.php");
        if (File::exists($routePath)) {
            $routeContent = File::get($routePath);
            $routePrefix = "\n    Route::prefix('{$name}')->name('{$name}.')->group(function () {\n";
            $routePrefix .= "        Route::livewire('/', '{$layout}.{$name}.index')->name('index');\n";
            if ($type === 'crud-resource') {
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
        }
    }

    protected function updateMenu($layout, $name, $style, $type)
    {
        $menuPath = resource_path("views/components/{$layout}/partials/menu.blade.php");
        if (File::exists($menuPath)) {
            $menuContent = File::get($menuPath);
            $stubName = ($type === 'crud-resource') ? 'group.blade.php' : 'item.blade.php';
            $stubPath = __DIR__ . "/../../stubs/Partials/{$style}/{$stubName}";
            
            if (File::exists($stubPath) && str_contains($menuContent, '</vibe:nav>')) {
                $stub = File::get($stubPath);
                
                $routePrefixName = "{$layout}.{$name}";
                $humanTitle = (string) Str::headline($name);
                
                $stub = str_replace(['[route]', '[Title]'], [$routePrefixName, $humanTitle], $stub);
                
                $menuContent = preg_replace('/(<\/vibe:nav>\s*)$/', "\n" . $stub . "\n$1", $menuContent);
                File::put($menuPath, $menuContent);
            }
        }
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
            $name = text('What is the CRUD name?', 'product');
            $input->setArgument('name', $name);
        }
    }
}
