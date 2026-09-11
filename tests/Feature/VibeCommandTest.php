<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;
use Teknovate\VibeUi\Commands\InstallCommand;
use Teknovate\VibeUi\Commands\VibeCommand;

test('InstallCommand::isInstalled returns true in current fully-configured environment', function () {
    expect(InstallCommand::isInstalled())->toBeTrue();
});

test('InstallCommand::isInstalled returns false when config is missing', function () {
    $configPath = config_path('vibe.php');
    $backupPath = config_path('vibe.php.backup_test');

    if (file_exists($configPath)) {
        File::move($configPath, $backupPath);
    }

    try {
        expect(InstallCommand::isInstalled())->toBeFalse();
    } finally {
        if (file_exists($backupPath)) {
            File::move($backupPath, $configPath);
        }
    }
});

test('InstallCommand::isInstalled returns false when css assets directory is missing', function () {
    $cssDir = resource_path('css/vibe');
    $backupDir = resource_path('css/vibe_backup_test');

    if (is_dir($cssDir)) {
        File::moveDirectory($cssDir, $backupDir);
    }

    try {
        expect(InstallCommand::isInstalled())->toBeFalse();
    } finally {
        if (is_dir($backupDir)) {
            File::moveDirectory($backupDir, $cssDir);
        }
    }
});

test('VibeCommand::getAvailableActions omits install option when already installed', function () {
    $command = new VibeCommand;
    $actions = $command->getAvailableActions();

    expect($actions)->not->toHaveKey('install');
    expect($actions)->toHaveKey('component');
    expect($actions)->toHaveKey('table');
    expect($actions)->toHaveKey('page');
    expect($actions)->toHaveKey('layout');
    expect($actions)->toHaveKey('clean');
    expect($actions)->toHaveKey('exit');
});

test('VibeCommand::getAvailableActions includes sync and release when packages directory exists', function () {
    expect(is_dir(base_path('packages')))->toBeTrue();

    $command = new VibeCommand;
    $actions = $command->getAvailableActions();

    expect($actions)->toHaveKey('sync');
    expect($actions)->toHaveKey('release');
});

test('VibeCommand::getAvailableActions omits sync and release when packages directory is missing', function () {
    $command = new class extends VibeCommand
    {
        public function hasPackagesDirectory(): bool
        {
            return false;
        }
    };

    $actions = $command->getAvailableActions();

    expect($actions)->not->toHaveKey('sync');
    expect($actions)->not->toHaveKey('release');
});

test('vibe:install command remains directly executable via CLI', function () {
    $this->artisan('vibe:install', ['--skip-npm' => true])
        ->assertSuccessful();
});
