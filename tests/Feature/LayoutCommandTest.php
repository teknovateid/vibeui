<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;

afterEach(function () {
    // Ensure no unexpected test files linger
    if (File::exists(base_path('routes/.php'))) {
        File::delete(base_path('routes/.php'));
    }
    if (File::exists(resource_path('views/index.blade.php'))) {
        File::delete(resource_path('views/index.blade.php'));
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
