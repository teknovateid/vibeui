<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;

afterEach(function () {
    // Ensure no unexpected test files linger
    if (File::exists(base_path('routes/.php'))) {
        File::delete(base_path('routes/.php'));
    }
    if (File::exists(base_path('routes/admin-test.php'))) {
        File::delete(base_path('routes/admin-test.php'));
    }
    if (File::exists(resource_path('views/index.blade.php'))) {
        File::delete(resource_path('views/index.blade.php'));
    }
    File::deleteDirectory(resource_path('views/admin-test'));
    File::deleteDirectory(resource_path('views/components/admin-test'));

    $appPath = base_path('bootstrap/app.php');
    if (File::exists($appPath)) {
        $appContent = File::get($appPath);
        if (str_contains($appContent, 'admin-test.php')) {
            $cleaned = preg_replace("/\s*__DIR__\s*\.\s*'\/..\/routes\/admin-test\.php',?/", '', $appContent);
            File::put($appPath, $cleaned);
        }
    }
});

test('vibe:layout requires layout path and fails when empty or whitespace string provided', function () {
    $this->artisan('vibe:layout', ['path' => '', '--no-interaction' => true])
        ->expectsOutputToContain('The layout path is required and cannot be empty.')
        ->assertSuccessful();

    $this->artisan('vibe:layout', ['path' => '   ', '--no-interaction' => true])
        ->expectsOutputToContain('The layout path is required and cannot be empty.')
        ->assertSuccessful();

    expect(File::exists(base_path('routes/.php')))->toBeFalse();
});

test('vibe:layout rejects reserved layout names like components and vibe', function () {
    $this->artisan('vibe:layout', ['path' => 'components'])
        ->expectsOutputToContain("The layout path 'components' is reserved. Please choose another name.")
        ->assertSuccessful();

    $this->artisan('vibe:layout', ['path' => 'vibe'])
        ->expectsOutputToContain("The layout path 'vibe' is reserved. Please choose another name.")
        ->assertSuccessful();
});

test('vibe:layout generates settings pages including appearance', function () {
    // Clean before in case
    File::deleteDirectory(resource_path('views/admin-test'));
    File::deleteDirectory(resource_path('views/components/admin-test'));
    File::delete(base_path('routes/admin-test.php'));

    $this->artisan('vibe:layout', ['path' => 'admin-test'])
        ->expectsQuestion('Which layout style do you want to use?', 'sidebar')
        ->expectsConfirmation("Create a new route file for 'admin-test'? (routes/admin-test.php)", 'yes')
        ->assertSuccessful();

    expect(File::exists(resource_path('views/admin-test/settings/appearance.blade.php')))->toBeTrue();
    expect(File::exists(resource_path('views/admin-test/settings/account.blade.php')))->toBeTrue();
    expect(File::exists(resource_path('views/admin-test/settings/security.blade.php')))->toBeTrue();
    expect(File::exists(resource_path('views/admin-test/settings/login-history.blade.php')))->toBeTrue();
    expect(File::exists(resource_path('views/admin-test/settings/notifications.blade.php')))->toBeTrue();
    expect(File::exists(resource_path('views/admin-test/settings/tabs.blade.php')))->toBeTrue();

    // Verify content contains converted path
    $appearanceContent = File::get(resource_path('views/admin-test/settings/appearance.blade.php'));
    expect($appearanceContent)->toContain('<x-admin-test.layouts.sidebar>');
    expect($appearanceContent)->toContain("route('admin-test.settings.account')");
    expect($appearanceContent)->toContain("route('admin-test.settings.appearance')");
    // Verify menu contains both index and settings items
    $menuContent = File::get(resource_path('views/components/admin-test/partials/sidebar-menu.blade.php'));
    expect($menuContent)->toContain("route('admin-test.index')");
    expect($menuContent)->toContain("Admin Test");
    expect($menuContent)->toContain("route('admin-test.settings.index')");
    expect($menuContent)->toContain("vibe/settings.breadcrumb.settings");

    // Clean up
    File::deleteDirectory(resource_path('views/admin-test'));
    File::deleteDirectory(resource_path('views/components/admin-test'));
    File::delete(base_path('routes/admin-test.php'));
});

