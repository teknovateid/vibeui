<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

afterEach(function () {
    File::delete(base_path('routes/tmp-crud-panel.php'));
    File::deleteDirectory(resource_path('views/tmp-crud-panel'));
    File::deleteDirectory(resource_path('views/components/tmp-crud-panel'));
    File::deleteDirectory(resource_path('views/livewire/tmp-crud-panel'));
    File::deleteDirectory(app_path('Livewire/TmpCrudPanel'));

    $appPath = base_path('bootstrap/app.php');
    if (File::exists($appPath)) {
        $appContent = File::get($appPath);
        if (str_contains($appContent, 'tmp-crud-panel.php')) {
            $cleaned = preg_replace("/\s*__DIR__\s*\.\s*'\/\.\.\/routes\/tmp-crud-panel\.php',?/", '', $appContent);
            File::put($appPath, $cleaned);
        }
    }
});

test('vibe:crud fails gracefully when target model does not exist', function () {
    $this->artisan('vibe:crud', [
        'layout' => 'tmp-crud-panel',
        'name' => 'items',
        '--type' => 'crud-index',
        '--model' => 'NonExistentModelXyz',
    ])
        ->expectsOutputToContain('Model App\Models\NonExistentModelXyz does not exist.')
        ->assertSuccessful();
});

test('vibe:crud generates modal, sheet, and resource classes and views from stub files', function () {
    $this->artisan('vibe:layout', ['path' => 'tmp-crud-panel'])
        ->expectsQuestion('Which layout style do you want to use?', 'sidebar')
        ->expectsConfirmation("Create a new route file for 'tmp-crud-panel'? (routes/tmp-crud-panel.php)", 'yes')
        ->assertSuccessful();

    $columns = Schema::getColumnListing((new User)->getTable());

    $runCrudWithType = function (string $name, string $type) use ($columns) {
        $command = $this->artisan('vibe:crud', [
            'layout' => 'tmp-crud-panel',
            'name' => $name,
            '--type' => $type,
            '--model' => 'User',
        ]);

        foreach ($columns as $column) {
            if ($column === 'name') {
                $command->expectsQuestion("Select UI component for column '{$column}'", 'input')
                    ->expectsQuestion("Select input type for '{$column}'", 'text');
            } else {
                $command->expectsQuestion("Select UI component for column '{$column}'", 'skip');
            }
        }

        $command
            ->expectsQuestion('Pilih komponen list yang ingin digunakan (datatable, dll):', 'datatable')
            ->expectsQuestion('Pilih komponen form untuk form Create (Tambah Data):', 'form')
            ->expectsQuestion('Pilih komponen form untuk form Edit (Ubah Data):', 'form')
            ->expectsOutputToContain("CRUD {$name} created successfully.")
            ->assertSuccessful();
    };

    // 1. Modal CRUD (crud-index)
    $runCrudWithType('modal-users', 'crud-index');
    $modalClass = app_path('Livewire/TmpCrudPanel/'.Str::studly('modal-users').'/Index.php');
    $modalView = resource_path('views/livewire/tmp-crud-panel/modal-users/index.blade.php');
    expect(File::exists($modalClass))->toBeTrue();
    expect(File::exists($modalView))->toBeTrue();
    expect(File::get($modalClass))
        ->toContain('namespace App\Livewire\TmpCrudPanel\\'.Str::studly('modal-users').';')
        ->toContain("#[Layout('components.tmp-crud-panel.layouts.sidebar')]")
        ->toContain('public $name;');
    expect(File::get($modalView))
        ->toContain('<vibe:modal wire:model="isOpen">')
        ->not->toContain('[DataTable]')
        ->not->toContain('[ModalForm]');

    // 2. Sheet CRUD (crud-sheet)
    $runCrudWithType('sheet-users', 'crud-sheet');
    $sheetClass = app_path('Livewire/TmpCrudPanel/'.Str::studly('sheet-users').'/Index.php');
    $sheetView = resource_path('views/livewire/tmp-crud-panel/sheet-users/index.blade.php');
    expect(File::exists($sheetClass))->toBeTrue();
    expect(File::exists($sheetView))->toBeTrue();
    expect(File::get($sheetClass))
        ->toContain('namespace App\Livewire\TmpCrudPanel\\'.Str::studly('sheet-users').';')
        ->toContain('public $editId = null;');
    expect(File::get($sheetView))->toContain('<vibe:sheet');

    // 3. Resource CRUD (crud-resource)
    $runCrudWithType('res-users', 'crud-resource');
    $studlyRes = Str::studly('res-users');
    expect(File::exists(app_path("Livewire/TmpCrudPanel/{$studlyRes}/Index.php")))->toBeTrue();
    expect(File::exists(app_path("Livewire/TmpCrudPanel/{$studlyRes}/Create.php")))->toBeTrue();
    expect(File::exists(app_path("Livewire/TmpCrudPanel/{$studlyRes}/Edit.php")))->toBeTrue();
    expect(File::exists(resource_path('views/livewire/tmp-crud-panel/res-users/index.blade.php')))->toBeTrue();
    expect(File::exists(resource_path('views/livewire/tmp-crud-panel/res-users/create.blade.php')))->toBeTrue();
    expect(File::exists(resource_path('views/livewire/tmp-crud-panel/res-users/edit.blade.php')))->toBeTrue();

    $routes = File::get(base_path('routes/tmp-crud-panel.php'));
    expect($routes)
        ->toContain("Route::livewire('/', 'tmp-crud-panel.modal-users.index')->name('index')")
        ->toContain("Route::livewire('/', 'tmp-crud-panel.sheet-users.index')->name('index')")
        ->toContain("Route::livewire('/create', 'tmp-crud-panel.res-users.create')->name('create')")
        ->toContain("Route::livewire('/{id}/edit', 'tmp-crud-panel.res-users.edit')->name('edit')");

    $menu = File::get(resource_path('views/components/tmp-crud-panel/partials/sidebar-menu.blade.php'));
    expect($menu)
        ->toContain("route('tmp-crud-panel.modal-users.index')")
        ->toContain("route('tmp-crud-panel.sheet-users.index')")
        ->toContain("route('tmp-crud-panel.res-users.index')");
});
