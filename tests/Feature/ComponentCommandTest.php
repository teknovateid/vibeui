<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;

test('vibe:component rejects non-existent component name', function () {
    $this->artisan('vibe:component', ['name' => 'non-existent-xyz'])
        ->expectsOutputToContain("Component 'non-existent-xyz' not found.")
        ->assertSuccessful();
});

test('vibe:component publishes blade views along with js and css assets', function () {
    $this->artisan('vibe:component', ['name' => 'chart', '--silent' => true])
        ->assertSuccessful();

    expect(File::isDirectory(resource_path('views/vibe/chart')))->toBeTrue();
    expect(File::isFile(resource_path('js/vibe/chart.js')))->toBeTrue();
    expect(File::isFile(resource_path('css/vibe/chart.css')))->toBeTrue();
});

test('vibe:component publishes js asset for components that have js without css', function () {
    $this->artisan('vibe:component', ['name' => 'dynamic-form', '--silent' => true])
        ->assertSuccessful();

    expect(File::isDirectory(resource_path('views/vibe/dynamic-form')))->toBeTrue();
    expect(File::isFile(resource_path('js/vibe/dynamic-form.js')))->toBeTrue();
});

test('vibe:component displays published assets in output when not silent', function () {
    $this->artisan('vibe:component', ['name' => 'chart'])
        ->expectsOutputToContain("Component 'chart' published.")
        ->expectsOutputToContain('resources/js/vibe/chart.js')
        ->assertSuccessful();
});
