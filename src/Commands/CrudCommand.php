<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

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
            'crud-index' => 'CRUD 1 Halaman — Modal (form di dalam modal)',
            'crud-sheet' => 'CRUD 1 Halaman — Sheet (form di slide-over kanan)',
            'crud-resource' => 'CRUD Terpisah — Resource (Index, Create, Edit pages)',
        ]);

        $modelName = $this->option('model');
        if (! $modelName) {
            $modelName = text('What is the Eloquent Model name? (e.g. Product, User)', default: Str::studly(Str::singular($name)));
        }

        $modelClass = 'App\\Models\\'.$modelName;
        if (! class_exists($modelClass)) {
            $this->components->error("Model {$modelClass} does not exist. Please create the model and migration first.");

            return;
        }

        $modelInstance = new $modelClass;
        $table = $modelInstance->getTable();

        if (! Schema::hasTable($table)) {
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
                    'checkbox' => 'Checkbox',
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
                    'checkbox' => 'Checkbox',
                ], default: $defaultComp);
            }

            if ($component !== 'skip') {
                if ($component === 'input') {
                    $defaultType = 'text';
                    if (Str::contains($column, 'email')) {
                        $defaultType = 'email';
                    }
                    if (Str::contains($column, 'password')) {
                        $defaultType = 'password';
                    }
                    if (Str::contains($column, 'date')) {
                        $defaultType = 'date';
                    }
                    if (Str::contains($column, ['price', 'amount', 'qty', 'count', 'id'])) {
                        $defaultType = 'number';
                    }

                    $inputType = select("Select input type for '{$column}'", [
                        'text' => 'Text',
                        'number' => 'Number',
                        'email' => 'Email',
                        'password' => 'Password',
                        'date' => 'Date',
                        'color' => 'Color',
                    ], default: $defaultType);

                    $schemaMapping[$column] = ['component' => 'input', 'type' => $inputType];
                } else {
                    $schemaMapping[$column] = ['component' => $component];
                }
            }
        }

        // Detect layout style from the group's Index component
        $style = 'sidebar';
        $indexFile = app_path('Livewire/'.str($layout)->studly().'/Index.php');
        if (File::exists($indexFile)) {
            $indexContent = File::get($indexFile);
            if (preg_match('/#\[Layout\([\'"]components\.(?:[a-zA-Z0-9_-]+\.)?layouts\.([a-zA-Z0-9_-]+)[\'"]\)\]/', $indexContent, $matches)) {
                $style = $matches[1];
            }
        }

        // Scan lists folder
        $listsPath = __DIR__.'/../../stubs/resources/views/livewire/crud/organisms/lists';
        $listOptions = [];
        if (File::exists($listsPath)) {
            $files = File::files($listsPath);
            foreach ($files as $file) {
                if (Str::endsWith($file->getFilename(), '.blade.php')) {
                    $nameWithoutExt = str_replace('.blade.php', '', $file->getFilename());
                    $listOptions[$nameWithoutExt] = Str::headline($nameWithoutExt);
                }
            }
        }

        $listStyle = 'datatable';
        if (count($listOptions) > 0) {
            $listStyle = select('Pilih komponen list yang ingin digunakan (datatable, dll):', $listOptions);
        }

        // Scan forms folder
        $formsPath = __DIR__.'/../../stubs/resources/views/livewire/crud/organisms/forms';
        $formOptions = [];
        if (File::exists($formsPath)) {
            $files = File::files($formsPath);
            foreach ($files as $file) {
                if (Str::endsWith($file->getFilename(), '.blade.php')) {
                    $nameWithoutExt = str_replace('.blade.php', '', $file->getFilename());
                    $formOptions[$nameWithoutExt] = Str::headline($nameWithoutExt);
                }
            }
        }

        $formCreateStyle = 'form';
        $formEditStyle = 'form';
        if (count($formOptions) > 0) {
            $formCreateStyle = select('Pilih komponen form untuk form Create (Tambah Data):', $formOptions);
            $formEditStyle = select('Pilih komponen form untuk form Edit (Ubah Data):', $formOptions);
        }

        // Generate files
        if ($type === 'crud-index') {
            $this->generateCrudIndex($layout, $name, $modelClass, $modelName, $schemaMapping, $style, $listStyle, $formCreateStyle, $formEditStyle);
        } elseif ($type === 'crud-sheet') {
            $this->generateCrudSheet($layout, $name, $modelClass, $modelName, $schemaMapping, $style, $listStyle, $formCreateStyle, $formEditStyle);
        } else {
            $this->generateCrudResource($layout, $name, $modelClass, $modelName, $schemaMapping, $style, $listStyle, $formCreateStyle, $formEditStyle);
        }

        // Add to routes
        $this->updateRoutes($layout, $name, $type);

        // Add to menu
        $this->updateMenu($layout, $name, $style, $type);

        $this->newLine();
        $this->components->success("CRUD {$name} created successfully.");
        $this->newLine();
    }

    protected function generateCrudIndex($layout, $name, $modelClass, $modelName, $schemaMapping, $style, $listStyle = 'datatable', $formCreateStyle = 'form', $formEditStyle = 'form')
    {
        // Build View
        $destView = resource_path("views/livewire/{$layout}/{$name}/index.blade.php");
        $datatableStub = __DIR__.'/../../stubs/resources/views/livewire/crud/organisms/lists/'.$listStyle.'.blade.php';
        $formCreateStub = __DIR__.'/../../stubs/resources/views/livewire/crud/organisms/forms/'.$formCreateStyle.'.blade.php';
        $formEditStub = __DIR__.'/../../stubs/resources/views/livewire/crud/organisms/forms/'.$formEditStyle.'.blade.php';
        $templateStub = __DIR__.'/../../stubs/resources/views/livewire/crud/templates/modal/index.blade.php';

        $viewContent = File::exists($templateStub) ? File::get($templateStub) : "<div>[DataTable]\n    <vibe:modal wire:model=\"isOpen\">[ModalForm]</vibe:modal>\n</div>";
        $datatableContent = File::exists($datatableStub) ? File::get($datatableStub) : '';
        $formCreateContent = File::exists($formCreateStub) ? File::get($formCreateStub) : '';
        $formEditContent = File::exists($formEditStub) ? File::get($formEditStub) : '';

        $title = Str::headline($layout).' '.Str::headline($name);
        $blocks = $this->buildSchemaBlocks($schemaMapping);

        $datatableContent = str_replace(
            ['[Title]', '[CreateAction]', '[TableHeaders]', '[TableData]', '[ListGridData]', '[EditAction]', '[Modals]'],
            [
                $title,
                '<vibe:button variant="primary" wire:click="create">Tambah Data</vibe:button>',
                $blocks['tableHeaders'],
                $blocks['tableData'],
                $blocks['listGridData'],
                '<vibe:button variant="ghost" size="sm" wire:click="edit({{ $item->id }})">Edit</vibe:button>',
                '',
            ],
            $datatableContent
        );

        $formCreateContent = str_replace(
            ['[Title]', '[FormFields]', '[CancelAction]'],
            ['Tambah Data', $blocks['formFields'], '<vibe:button variant="ghost" type="button" wire:click="$set(\'isOpen\', false)">Batal</vibe:button>'],
            $formCreateContent
        );

        $formEditContent = str_replace(
            ['[Title]', '[FormFields]', '[CancelAction]'],
            ['Edit Data', $blocks['formFields'], '<vibe:button variant="ghost" type="button" wire:click="$set(\'isOpen\', false)">Batal</vibe:button>'],
            $formEditContent
        );

        $modalBody = "@if(\$editId)\n        {$formEditContent}\n    @else\n        {$formCreateContent}\n    @endif";
        $viewContent = str_replace(['[DataTable]', '[ModalForm]'], [$datatableContent, $modalBody], $viewContent);

        File::ensureDirectoryExists(dirname($destView));
        File::put($destView, $viewContent);

        // Build Class
        $classNamePath = 'Livewire/'.str($layout)->studly().'/'.str($name)->studly().'/Index.php';
        $classFile = app_path($classNamePath);

        $classStub = __DIR__.'/../../stubs/app/Livewire/Pages/crud/modal/index.stub';
        if (File::exists($classStub)) {
            $classContent = File::get($classStub);

            $namespace = 'App\\Livewire\\'.str($layout)->studly().'\\'.str($name)->studly();

            $classContent = str_replace(
                ['[Namespace]', '[ModelNamespace]', '[Title]', '[Layout]', '[ClassName]', '[Properties]', '[Rules]', '[ResetFields]', '[SetProperties]', '[ModelName]', '[FirstColumn]', '[ViewPath]'],
                [$namespace, $modelClass, $title, "components.{$layout}.layouts.{$style}", 'Index', $blocks['properties'], $blocks['rules'], $blocks['resetFields'], $blocks['setProperties'], $modelName, $blocks['firstColumn'], "livewire.{$layout}.{$name}.index"],
                $classContent
            );

            File::ensureDirectoryExists(dirname($classFile));
            File::put($classFile, $classContent);
        }
    }

    protected function generateCrudSheet($layout, $name, $modelClass, $modelName, $schemaMapping, $style, $listStyle = 'datatable', $formCreateStyle = 'form', $formEditStyle = 'form')
    {
        // Build View
        $destView = resource_path("views/livewire/{$layout}/{$name}/index.blade.php");
        $datatableStub = __DIR__.'/../../stubs/resources/views/livewire/crud/organisms/lists/'.$listStyle.'.blade.php';
        $formCreateStub = __DIR__.'/../../stubs/resources/views/livewire/crud/organisms/forms/'.$formCreateStyle.'.blade.php';
        $formEditStub = __DIR__.'/../../stubs/resources/views/livewire/crud/organisms/forms/'.$formEditStyle.'.blade.php';
        $templateStub = __DIR__.'/../../stubs/resources/views/livewire/crud/templates/sheet/index.blade.php';

        $viewContent = File::exists($templateStub) ? File::get($templateStub) : '<div>[DataTable][SheetCreate][SheetEdit]</div>';
        $datatableContent = File::exists($datatableStub) ? File::get($datatableStub) : '';
        $formCreateContent = File::exists($formCreateStub) ? File::get($formCreateStub) : '';
        $formEditContent = File::exists($formEditStub) ? File::get($formEditStub) : '';

        $title = Str::headline($layout).' '.Str::headline($name);
        $blocks = $this->buildSchemaBlocks($schemaMapping);

        // Build datatable block
        $datatableContent = str_replace(
            ['[Title]', '[CreateAction]', '[TableHeaders]', '[TableData]', '[ListGridData]', '[EditAction]', '[Modals]'],
            [
                $title,
                '<vibe:button variant="primary" wire:click="create">Tambah Data</vibe:button>',
                $blocks['tableHeaders'],
                $blocks['tableData'],
                $blocks['listGridData'],
                '<vibe:button variant="ghost" size="sm" wire:click="edit({{ $item->id }})">Edit</vibe:button>',
                '',
            ],
            $datatableContent
        );

        // Build forms block
        $formCreateContent = str_replace(
            ['[Title]', '[FormId]', '[FormFields]', '[CancelAction]'],
            ['Tambah Data', 'create-form', $blocks['formFields'], '<vibe:button variant="ghost" type="button" @click="close()">Batal</vibe:button>'],
            $formCreateContent
        );

        $formEditContent = str_replace(
            ['[Title]', '[FormId]', '[FormFields]', '[CancelAction]'],
            ['Edit Data', 'edit-form', $blocks['formFields'], '<vibe:button variant="ghost" type="button" @click="close()">Batal</vibe:button>'],
            $formEditContent
        );

        // Inject into template
        $viewContent = str_replace(['[DataTable]', '[SheetCreate]', '[SheetEdit]'], [$datatableContent, $formCreateContent, $formEditContent], $viewContent);

        File::ensureDirectoryExists(dirname($destView));
        File::put($destView, $viewContent);

        // Build Class (reuse modal stub — same logic, only view differs)
        $classNamePath = 'Livewire/'.str($layout)->studly().'/'.str($name)->studly().'/Index.php';
        $classFile = app_path($classNamePath);

        $classStub = __DIR__.'/../../stubs/app/Livewire/Pages/crud/sheet/index.stub';
        if (File::exists($classStub)) {
            $classContent = File::get($classStub);

            $namespace = 'App\\Livewire\\'.str($layout)->studly().'\\'.str($name)->studly();

            $classContent = str_replace(
                ['[Namespace]', '[ModelNamespace]', '[Title]', '[Layout]', '[ClassName]', '[Properties]', '[Rules]', '[ResetFields]', '[SetProperties]', '[ModelName]', '[FirstColumn]', '[ViewPath]'],
                [$namespace, $modelClass, $title, "components.{$layout}.layouts.{$style}", 'Index', $blocks['properties'], $blocks['rules'], $blocks['resetFields'], $blocks['setProperties'], $modelName, $blocks['firstColumn'], "livewire.{$layout}.{$name}.index"],
                $classContent
            );

            File::ensureDirectoryExists(dirname($classFile));
            File::put($classFile, $classContent);
        }
    }

    /**
     * Build shared table, list, form, and class code blocks from schema column mappings.
     *
     * @param  array<string, array<string, mixed>>  $schemaMapping
     * @return array<string, string>
     */
    protected function buildSchemaBlocks(array $schemaMapping): array
    {
        $tableHeaders = '';
        $tableData = '';
        $listGridData = '';
        $formFields = '';
        $properties = '';
        $rules = '';
        $resetFields = '';
        $setProperties = '';
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
            $listGridData .= "<div class=\"flex justify-between items-center py-1 border-b border-border last:border-0\">\n";
            $listGridData .= "    <span class=\"text-sm text-muted-foreground\">{$label}</span>\n";
            $listGridData .= "    <span class=\"text-sm font-medium text-foreground\">{{ \$item->{$col} }}</span>\n";
            $listGridData .= "</div>\n                            ";
            $formFields .= $this->buildFormField($col, $label, $map);

            $properties .= "public \${$col};\n    ";
            $rules .= "'{$col}' => 'required',\n            ";
            $resetFields .= "'{$col}', ";
            $setProperties .= "\$this->{$col} = \$model->{$col};\n        ";
        }

        return [
            'firstColumn' => $firstColumn,
            'tableHeaders' => $tableHeaders,
            'tableData' => $tableData,
            'listGridData' => $listGridData,
            'formFields' => $formFields,
            'properties' => $properties,
            'rules' => $rules,
            'resetFields' => rtrim($resetFields, ', '),
            'setProperties' => $setProperties,
        ];
    }

    protected function generateCrudResource($layout, $name, $modelClass, $modelName, $schemaMapping, $style, $listStyle = 'datatable', $formCreateStyle = 'form', $formEditStyle = 'form')
    {
        $actions = ['index', 'create', 'edit'];
        $firstColumn = 'id';

        // Prepare common strings
        $tableHeaders = '';
        $tableData = '';
        $listGridData = '';
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
            $listGridData .= "<div class=\"flex justify-between items-center py-1 border-b border-border last:border-0\">\n";
            $listGridData .= "    <span class=\"text-sm text-muted-foreground\">{$label}</span>\n";
            $listGridData .= "    <span class=\"text-sm font-medium text-foreground\">{{ \$item->{$col} }}</span>\n";
            $listGridData .= "</div>\n                            ";
            $formFields .= $this->buildFormField($col, $label, $map);

            $properties .= "public \${$col};\n    ";
            $rules .= "'{$col}' => 'required',\n            ";
            $setProperties .= "\$this->{$col} = \$model->{$col};\n        ";
        }

        foreach ($actions as $action) {
            $destView = resource_path("views/livewire/{$layout}/{$name}/{$action}.blade.php");
            File::ensureDirectoryExists(dirname($destView));
            $title = Str::headline($layout).' '.Str::headline($name);
            if ($action !== 'index') {
                $title .= ' '.ucfirst($action);
            }

            // Generate Views
            if ($action === 'index') {
                $stub = __DIR__.'/../../stubs/resources/views/livewire/crud/templates/resource/index.blade.php';
                $content = File::exists($stub) ? File::get($stub) : '';
                $orgStub = __DIR__.'/../../stubs/resources/views/livewire/crud/organisms/lists/'.$listStyle.'.blade.php';
                $orgContent = File::exists($orgStub) ? File::get($orgStub) : '';
                $orgContent = str_replace('[Title]', $title, $orgContent);
                $orgContent = str_replace('[CreateAction]', "<vibe:button variant=\"primary\" href=\"{{ route('{$layout}.{$name}.create') }}\" wire:navigate>Tambah Data</vibe:button>", $orgContent);
                $orgContent = str_replace('[TableHeaders]', $tableHeaders, $orgContent);
                $orgContent = str_replace('[TableData]', $tableData, $orgContent);
                $orgContent = str_replace('[ListGridData]', $listGridData, $orgContent);
                $orgContent = str_replace('[EditAction]', "<vibe:button variant=\"ghost\" size=\"sm\" href=\"{{ route('{$layout}.{$name}.edit', \$item->id) }}\" wire:navigate>Edit</vibe:button>", $orgContent);
                $orgContent = str_replace('[Modals]', '', $orgContent);
                $content = str_replace('[DataTable]', $orgContent, $content);
                File::put($destView, $content);
            } elseif ($action === 'create') {
                $stub = __DIR__.'/../../stubs/resources/views/livewire/crud/templates/resource/create.blade.php';
                $content = File::exists($stub) ? File::get($stub) : '';
                $orgStub = __DIR__.'/../../stubs/resources/views/livewire/crud/organisms/forms/'.$formCreateStyle.'.blade.php';
                $orgContent = File::exists($orgStub) ? File::get($orgStub) : '';
                $orgContent = str_replace('[Title]', $title, $orgContent);
                $orgContent = str_replace('[FormId]', 'create-form', $orgContent);
                $orgContent = str_replace('[FormFields]', $formFields, $orgContent);
                $orgContent = str_replace('[CancelAction]', "<vibe:button variant=\"ghost\" type=\"button\" href=\"{{ route('{$layout}.{$name}.index') }}\" wire:navigate>Batal</vibe:button>", $orgContent);
                $content = str_replace('[FormContent]', $orgContent, $content);
                File::put($destView, $content);
            } elseif ($action === 'edit') {
                $stub = __DIR__.'/../../stubs/resources/views/livewire/crud/templates/resource/edit.blade.php';
                $content = File::exists($stub) ? File::get($stub) : '';
                $orgStub = __DIR__.'/../../stubs/resources/views/livewire/crud/organisms/forms/'.$formEditStyle.'.blade.php';
                $orgContent = File::exists($orgStub) ? File::get($orgStub) : '';
                $orgContent = str_replace('[Title]', $title, $orgContent);
                $orgContent = str_replace('[FormId]', 'edit-form', $orgContent);
                $orgContent = str_replace('[FormFields]', $formFields, $orgContent);
                $orgContent = str_replace('[CancelAction]', "<vibe:button variant=\"ghost\" type=\"button\" href=\"{{ route('{$layout}.{$name}.index') }}\" wire:navigate>Batal</vibe:button>", $orgContent);
                $content = str_replace('[FormContent]', $orgContent, $content);
                File::put($destView, $content);
            }

            // Generate Classes
            $classNamePath = 'Livewire/'.str($layout)->studly().'/'.str($name)->studly().'/'.ucfirst($action).'.php';
            $classFile = app_path($classNamePath);
            $classStub = __DIR__."/../../stubs/app/Livewire/Pages/crud/resource/{$action}.stub";

            if (File::exists($classStub)) {
                $classContent = File::get($classStub);
                $namespace = 'App\\Livewire\\'.str($layout)->studly().'\\'.str($name)->studly();

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

                File::ensureDirectoryExists(dirname($classFile));
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

            if (str_contains($routeContent, '});')) {
                $routeContent = preg_replace('/(}\);\s*)$/', $routePrefix."\n$1", $routeContent);
            } else {
                $routeContent .= $routePrefix;
            }
            File::put($routePath, $routeContent);
        }
    }

    protected function updateMenu($layout, $name, $style, $type)
    {
        $menuPath = resource_path("views/components/{$layout}/partials/{$style}-menu.blade.php");
        if (File::exists($menuPath)) {
            $menuContent = File::get($menuPath);
            $stubName = ($type === 'crud-resource') ? 'group.blade.php' : 'item.blade.php';
            $stubPath = __DIR__."/../../stubs/resources/views/components/partials/{$style}/{$stubName}";

            if (File::exists($stubPath) && str_contains($menuContent, '</vibe:nav>')) {
                $stub = File::get($stubPath);

                $routePrefixName = "{$layout}.{$name}";
                $humanTitle = (string) Str::headline($name);

                $stub = str_replace(['[route]', '[Title]'], [$routePrefixName, $humanTitle], $stub);

                $menuContent = preg_replace('/(<\/vibe:nav>\s*)$/', "\n".$stub."\n$1", $menuContent);
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
            $name = text('What is the CRUD name?', 'product');
            $input->setArgument('name', $name);
        }
    }
}
