<?php

namespace Teknovate\VibeUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Laravel\Prompts\suggest;
use function Laravel\Prompts\text;

class TableMakeCommand extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vibe:table
        {name : The name of the datatable class (e.g. UsersTable)}
        {--model= : The Eloquent model associated with the table}
        {--force : Overwrite existing file if it exists}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Vibe UI Livewire DataTable component';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = trim($this->argument('name'));
        $name = str_replace(['/', '\\'], '/', $name);

        $className = str(basename($name))->studly()->toString();
        $subNamespace = dirname($name) !== '.' ? collect(explode('/', dirname($name)))->map(fn ($s) => str($s)->studly()->toString())->join('\\') : '';

        $fullNamespace = 'App\\Livewire' . ($subNamespace ? '\\' . $subNamespace : '');
        $destinationDir = app_path('Livewire' . ($subNamespace ? '/' . str_replace('\\', '/', $subNamespace) : ''));
        $destinationFile = $destinationDir . '/' . $className . '.php';

        if (File::exists($destinationFile) && ! $this->option('force')) {
            $this->components->error("Datatable class [{$destinationFile}] already exists. Use --force to overwrite.");
            return self::FAILURE;
        }

        if (! File::isDirectory($destinationDir)) {
            File::makeDirectory($destinationDir, 0755, true);
        }

        $model = $this->option('model');
        $model = $model ? trim($model) : null;
        $modelClass = $model ? class_basename($model) : null;
        $modelNamespace = $model ? (str_contains($model, '\\') ? $model : "App\\Models\\{$model}") : null;

        $stub = $this->generateStub($fullNamespace, $className, $modelClass, $modelNamespace);

        File::put($destinationFile, $stub);

        $this->components->success("Vibe DataTable [{$className}] created successfully.");
        $this->components->bulletList([
            "File: {$destinationFile}",
            "Class: {$fullNamespace}\\{$className}",
            "Usage: <livewire:" . str($className)->kebab() . " />",
        ]);

        return self::SUCCESS;
    }

    protected function generateStub(string $namespace, string $className, ?string $modelClass, ?string $modelNamespace): string
    {
        $useModel = $modelNamespace ? "use {$modelNamespace};\n" : '';
        $builderReturn = $modelClass
            ? "return {$modelClass}::query();"
            : "// return \\App\\Models\\YourModel::query();\n        throw new \\Exception('Please return an Eloquent query builder in ' . __METHOD__);";

        $actionColumnComment = <<<PHP
            // Action column with transparent Vibe Button Group & icon buttons:
            // Column::make('Actions')
            //     ->label(fn (\$row) => Blade::render('
            //         <vibe:button.group variant="ghost">
            //             <vibe:button size="icon-xs" variant="ghost" class="text-muted-foreground hover:text-foreground" title="Edit">
            //                 <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
            //             </vibe:button>
            //             <vibe:button.delete size="icon-xs" variant="ghost" wire:click="delete({{ \$row->id }})" />
            //         </vibe:button.group>
            //     ', ['row' => \$row]))
            //     ->html(),
PHP;

        $columnsContent = ($modelClass === 'User')
            ? <<<PHP
            Column::make('ID', 'id')
                ->sortable(),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Created At', 'created_at')
                ->sortable(),

{$actionColumnComment}
PHP
            : <<<PHP
            Column::make('ID', 'id')
                ->sortable(),

            // Column::make('Name', 'name')
            //     ->sortable()
            //     ->searchable(),

{$actionColumnComment}
PHP;

        $deleteLogic = $modelClass
            ? "{$modelClass}::destroy(\$id);"
            : "// Model::destroy(\$id);";

        $bulkDeleteLogic = $modelClass
            ? "{$modelClass}::whereIn('id', \$this->getSelected())->delete();\n        \$this->clearSelected();"
            : "// Model::whereIn('id', \$this->getSelected())->delete();\n        \$this->clearSelected();";

        $stubPath = __DIR__ . '/../../stubs/Datatable/Table.stub';
        if (! File::exists($stubPath)) {
            $stubPath = __DIR__ . '/../../stubs/Datatable/datatable.stub';
        }
        $stub = File::exists($stubPath) ? File::get($stubPath) : '';

        return str_replace(
            ['[Namespace]', '[ModelImport]', '[ClassName]', '[BuilderQuery]', '[Columns]', '[DeleteLogic]', '[BulkDeleteLogic]'],
            [$namespace, $useModel, $className, $builderReturn, $columnsContent, $deleteLogic, $bulkDeleteLogic],
            $stub
        );
    }

    protected function promptForMissingArguments(InputInterface $input, OutputInterface $output): void
    {
        if (! $input->getArgument('name')) {
            $name = text(
                label: 'What is the name of your DataTable component?',
                placeholder: 'e.g. UsersTable',
                required: true,
            );
            $input->setArgument('name', $name);
        }

        if ($input->getOption('model') === null) {
            $models = $this->getAvailableModels();
            $tableName = class_basename($input->getArgument('name'));
            $baseName = preg_replace('/Table$/i', '', $tableName);
            $suggested = str($baseName)->singular()->studly()->toString();

            $model = suggest(
                label: 'What is the associated Eloquent model? (optional, press Enter to skip)',
                options: $models,
                placeholder: in_array($suggested, $models) ? "e.g. {$suggested} (or leave empty)" : 'e.g. User (or leave empty)',
            );

            $input->setOption('model', $model ?: null);
        }
    }

    protected function getAvailableModels(): array
    {
        $models = [];
        $modelsPath = app_path('Models');

        if (File::isDirectory($modelsPath)) {
            foreach (File::allFiles($modelsPath) as $file) {
                $relativePath = $file->getRelativePathname();
                $class = str_replace(['/', '.php'], ['\\', ''], $relativePath);
                $models[] = $class;
            }
        }

        if (empty($models)) {
            $models[] = 'User';
        }

        return array_values(array_unique($models));
    }
}
