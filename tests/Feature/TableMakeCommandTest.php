<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;

afterEach(function () {
    File::delete(app_path('Livewire/TmpUsersDataTableTest.php'));
    File::deleteDirectory(app_path('Livewire/TmpTableNs'));
});

test('vibe:table generates a datatable component from Table.stub and respects --force', function () {
    $target = app_path('Livewire/TmpUsersDataTableTest.php');
    File::delete($target);

    $this->artisan('vibe:table', [
        'name' => 'TmpUsersDataTableTest',
        '--model' => 'User',
    ])
        ->expectsOutputToContain('Vibe DataTable [TmpUsersDataTableTest] created successfully.')
        ->assertSuccessful();

    expect(File::exists($target))->toBeTrue();
    $content = File::get($target);
    expect($content)
        ->toContain('namespace App\Livewire;')
        ->toContain('use App\Models\User;')
        ->toContain('class TmpUsersDataTableTest extends VibeDataTableComponent')
        ->toContain('return User::query();')
        ->toContain("Column::make('Email', 'email')");

    $this->artisan('vibe:table', [
        'name' => 'TmpUsersDataTableTest',
        '--model' => 'User',
    ])
        ->expectsOutputToContain('already exists. Use --force to overwrite.')
        ->assertFailed();

    $this->artisan('vibe:table', [
        'name' => 'TmpUsersDataTableTest',
        '--model' => 'User',
        '--force' => true,
    ])
        ->assertSuccessful();
});

test('vibe:table supports nested namespace paths without a model', function () {
    $target = app_path('Livewire/TmpTableNs/OrdersTable.php');
    File::deleteDirectory(app_path('Livewire/TmpTableNs'));

    $this->artisan('vibe:table', [
        'name' => 'TmpTableNs/OrdersTable',
        '--model' => '',
    ])
        ->assertSuccessful();

    expect(File::exists($target))->toBeTrue();
    expect(File::get($target))
        ->toContain('namespace App\Livewire\TmpTableNs;')
        ->toContain('class OrdersTable extends VibeDataTableComponent');
});
