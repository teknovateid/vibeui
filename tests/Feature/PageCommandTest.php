<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;

afterEach(function () {
    File::delete(base_path('routes/tmp-page-panel.php'));
    File::deleteDirectory(resource_path('views/tmp-page-panel'));
    File::deleteDirectory(resource_path('views/components/tmp-page-panel'));

    $appPath = base_path('bootstrap/app.php');
    if (File::exists($appPath)) {
        $appContent = File::get($appPath);
        if (str_contains($appContent, 'tmp-page-panel.php')) {
            $cleaned = preg_replace("/\s*__DIR__\s*\.\s*'\/\.\.\/routes\/tmp-page-panel\.php',?/", '', $appContent);
            File::put($appPath, $cleaned);
        }
    }
});

test('vibe:page rejects missing layout groups', function () {
    $this->artisan('vibe:page', [
        'layout' => 'missing-layout-xyz',
        'name' => 'reports',
    ])
        ->expectsOutputToContain("Layout group 'missing-layout-xyz' does not exist!")
        ->assertSuccessful();
});

test('vibe:page generates index, blank, and resource views and registers routes and menu items', function () {
    $this->artisan('vibe:layout', ['path' => 'tmp-page-panel'])
        ->expectsQuestion('Which layout style do you want to use?', 'sidebar')
        ->expectsConfirmation("Create a new route file for 'tmp-page-panel'? (routes/tmp-page-panel.php)", 'yes')
        ->assertSuccessful();

    // 1. Default index page
    $this->artisan('vibe:page', [
        'layout' => 'tmp-page-panel',
        'name' => 'reports',
    ])
        ->expectsOutputToContain('Page(s) created successfully.')
        ->assertSuccessful();

    expect(File::exists(resource_path('views/tmp-page-panel/reports/index.blade.php')))->toBeTrue();
    expect(File::get(resource_path('views/tmp-page-panel/reports/index.blade.php')))
        ->toContain('<x-tmp-page-panel.layouts.sidebar>');

    // 2. Blank page
    $this->artisan('vibe:page', [
        'layout' => 'tmp-page-panel',
        'name' => 'blank-demo',
        '--blank' => true,
    ])
        ->assertSuccessful();

    expect(File::exists(resource_path('views/tmp-page-panel/blank-demo/index.blade.php')))->toBeTrue();

    // 3. Resource pages (index, create, edit)
    $this->artisan('vibe:page', [
        'layout' => 'tmp-page-panel',
        'name' => 'articles',
        '--resource' => true,
    ])
        ->assertSuccessful();

    expect(File::exists(resource_path('views/tmp-page-panel/articles/index.blade.php')))->toBeTrue();
    expect(File::exists(resource_path('views/tmp-page-panel/articles/create.blade.php')))->toBeTrue();
    expect(File::exists(resource_path('views/tmp-page-panel/articles/edit.blade.php')))->toBeTrue();

    $routes = File::get(base_path('routes/tmp-page-panel.php'));
    expect($routes)
        ->toContain("Route::prefix('reports')->name('reports.')")
        ->toContain("Route::prefix('articles')->name('articles.')")
        ->toContain("Route::view('/create', 'tmp-page-panel.articles.create')->name('create')")
        ->toContain("Route::view('/{id}/edit', 'tmp-page-panel.articles.edit')->name('edit')");

    $menu = File::get(resource_path('views/components/tmp-page-panel/partials/sidebar-menu.blade.php'));
    expect($menu)
        ->toContain("route('tmp-page-panel.reports.index')")
        ->toContain("route('tmp-page-panel.articles.index')")
        ->toContain("route('tmp-page-panel.articles.create')");
});
