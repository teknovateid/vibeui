<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Teknovate\VibeUi\Commands\InstallCommand;
use Teknovate\VibeUi\Vibe;

afterEach(function () {
    File::deleteDirectory(resource_path('views/tmp-layout-arch'));
    File::deleteDirectory(resource_path('views/components/tmp-layout-arch'));
    File::delete(base_path('routes/tmp-layout-arch.php'));
    File::delete(resource_path('css/vibe/layouts/tmp-layout-arch-topbar.css'));
    File::delete(resource_path('js/vibe/layouts/tmp-layout-arch-topbar.js'));
});

test('Vibe layout helpers sanitize css variables and safely render external or local assets', function () {
    $cssVars = Vibe::cssVarsStyle([
        'radius' => '1.25rem',
        '--vibe-header-height' => '4rem',
        'bad;key' => '1px; background: url(evil)',
        'malicious' => 'javascript:alert(1)',
    ]);

    expect($cssVars)
        ->toContain('--vibe-layout-radius: 1.25rem')
        ->toContain('--vibe-header-height: 4rem')
        ->not->toContain('javascript:')
        ->not->toContain('url(evil)');

    $assetTags = Vibe::renderAssetTags(
        ['/css/custom-layout.css', 'https://example.com/theme.css', 'resources/css/vibe/layouts/nonexistent.css'],
        ['/js/custom-layout.js', 'resources/js/vibe/layouts/nonexistent.js']
    );

    expect($assetTags)
        ->toContain('<link rel="stylesheet" href="/css/custom-layout.css" data-navigate-once="true" />')
        ->toContain('<link rel="stylesheet" href="https://example.com/theme.css" data-navigate-once="true" />')
        ->toContain('<script type="module" src="/js/custom-layout.js" data-navigate-once="true"></script>')
        ->not->toContain('nonexistent');
});

test('sidebar, sidebar-classic, and topbar panel layouts render isolated scopes, custom props, and named slots', function () {
    $modern = Blade::render(<<<'BLADE'
<x-docs.layouts.sidebar
    panel="docs"
    shell="floating"
    :cssVars="['radius' => '1.25rem']"
    :styles="['/css/extra-sidebar.css']"
    :scripts="['/js/extra-sidebar.js']"
>
    <x-slot:headerCenter><span>Center Pill</span></x-slot:headerCenter>
    <div>Modern Workspace</div>
</x-docs.layouts.sidebar>
BLADE);

    expect($modern)
        ->toContain('data-vibe-layout="sidebar"')
        ->toContain('data-vibe-layout-group="panel"')
        ->toContain('data-vibe-panel="docs"')
        ->toContain('data-vibe-shell="floating"')
        ->toContain('--vibe-layout-radius: 1.25rem')
        ->toContain('/css/extra-sidebar.css')
        ->toContain('/js/extra-sidebar.js')
        ->toContain('Center Pill')
        ->toContain('data-vibe-scroll="main"')
        ->toContain('flex h-dvh overflow-hidden relative')
        ->not->toContain('@if=')
        ->not->toContain('@endif');

    $classic = Blade::render('<x-docs.layouts.sidebar-classic><div>Classic Workspace</div></x-docs.layouts.sidebar-classic>');
    expect($classic)
        ->toContain('data-vibe-layout="sidebar-classic"')
        ->toContain('data-vibe-shell="flush"')
        ->toContain('data-nav-variant="line"')
        ->toContain('data-nav-density="compact"')
        ->toContain('data-nav-indicator="true"')
        ->toContain('Classic Workspace')
        ->not->toContain('@if=')
        ->not->toContain('@endif');

    $topbar = Blade::render(<<<'BLADE'
<x-docs.layouts.topbar>
    <x-slot:subHeader><div>Breadcrumb Ribbon</div></x-slot:subHeader>
    <div>Horizontal Workspace</div>
    <x-slot:footer><div>Topbar Footer</div></x-slot:footer>
</x-docs.layouts.topbar>
BLADE);

    expect($topbar)
        ->toContain('data-vibe-layout="topbar"')
        ->toContain('data-vibe-shell="horizontal"')
        ->toContain('<nav aria-label="Primary"')
        ->toContain('popovertarget="vibe-topbar-menu"')
        ->toContain('Breadcrumb Ribbon')
        ->toContain('Horizontal Workspace')
        ->toContain('Topbar Footer');
});

test('auth layouts support isolated data attributes, custom styling props, and named slots', function () {
    $cardHtml = view('auth.layouts.card', [
        'title' => 'Sign In',
        'surface' => 'glass',
        'backdropPattern' => 'grid',
        'maxWidth' => '30rem',
        'styles' => ['/css/auth-extra.css'],
        'slot' => 'Card Body',
    ])->render();

    expect($cardHtml)
        ->toContain('data-vibe-layout="auth-card"')
        ->toContain('data-vibe-layout-group="auth"')
        ->toContain('data-surface="glass"')
        ->toContain('data-backdrop-pattern="grid"')
        ->toContain('--vibe-auth-max-width: 30rem')
        ->toContain('/css/auth-extra.css');

    $simpleHtml = view('auth.layouts.simple', [
        'title' => 'Register',
        'slot' => 'Simple Body',
    ])->render();

    expect($simpleHtml)
        ->toContain('data-vibe-layout="auth-simple"')
        ->toContain('Simple Body');

    $splitHtml = view('auth.layouts.split', [
        'title' => 'Welcome',
        'mediaPosition' => 'right',
        'slot' => 'Split Body',
    ])->render();

    expect($splitHtml)
        ->toContain('data-vibe-layout="auth-split"')
        ->toContain('data-media-position="right"')
        ->toContain('data-vibe-split-showcase');
});

test('InstallCommand auto-discovers per-layout CSS/JS assets and @vibeStyles supports generic scroll attributes', function () {
    $assets = (new InstallCommand)->getVibeAssets();

    expect($assets)
        ->toContain('resources/css/vibe/layouts/sidebar.css')
        ->toContain('resources/css/vibe/layouts/sidebar-classic.css')
        ->toContain('resources/css/vibe/layouts/topbar.css')
        ->toContain('resources/css/vibe/layouts/auth-card.css')
        ->toContain('resources/css/vibe/layouts/auth-simple.css')
        ->toContain('resources/css/vibe/layouts/auth-split.css')
        ->toContain('resources/js/vibe/layouts/sidebar.js')
        ->toContain('resources/js/vibe/layouts/sidebar-classic.js')
        ->toContain('resources/js/vibe/layouts/topbar.js')
        ->toContain('resources/js/vibe/layouts/auth-card.js')
        ->toContain('resources/js/vibe/layouts/auth-simple.js')
        ->toContain('resources/js/vibe/layouts/auth-split.js')
        ->not->toContain('resources/js/vibe/layouts/core.js');

    $vibeStyles = Blade::render('@vibeStyles');
    expect($vibeStyles)
        ->toContain('[data-vibe-scroll="main"]')
        ->toContain('[data-vibe-scroll="sidebar"]');
});

test('vibe:layout supports --style=topbar --with-assets and vibe:page appends items to topbar menu', function () {
    $this->artisan('vibe:layout', [
        'path' => 'tmp-layout-arch',
        '--style' => 'topbar',
        '--with-assets' => true,
        '--no-route' => true,
        '--skip-vite' => true,
    ])->assertSuccessful();

    $layoutPath = resource_path('views/components/tmp-layout-arch/layouts/topbar.blade.php');
    $menuPath = resource_path('views/components/tmp-layout-arch/partials/topbar-menu.blade.php');
    $cssPath = resource_path('css/vibe/layouts/tmp-layout-arch-topbar.css');
    $jsPath = resource_path('js/vibe/layouts/tmp-layout-arch-topbar.js');

    expect(File::exists($layoutPath))->toBeTrue();
    expect(File::exists($menuPath))->toBeTrue();
    expect(File::exists(resource_path('views/components/tmp-layout-arch/partials/optional/search-modal.blade.php')))->toBeTrue();
    expect(File::exists($cssPath))->toBeTrue();
    expect(File::exists($jsPath))->toBeTrue();

    expect(File::get($layoutPath))
        ->toContain("'panel' => 'tmp-layout-arch'")
        ->toContain('resources/css/vibe/layouts/tmp-layout-arch-topbar.css')
        ->toContain('resources/js/vibe/layouts/tmp-layout-arch-topbar.js');

    expect(File::get($cssPath))
        ->toContain("@import './topbar.css';")
        ->toContain('[data-vibe-layout="topbar"][data-vibe-panel="tmp-layout-arch"]');

    // Create stub route so vibe:page detects the panel group
    File::put(base_path('routes/tmp-layout-arch.php'), "<?php\n// test\n");

    $this->artisan('vibe:page', [
        'layout' => 'tmp-layout-arch',
        'name' => 'reports',
        '--blank' => true,
    ])->assertSuccessful();

    expect(File::get($menuPath))->toContain('Reports');
});

test('docs layouts showcase and live demo routes render cleanly in both id and en locales', function () {
    foreach (['id', 'en'] as $locale) {
        $this->withSession(['locale' => $locale])
            ->get('/docs/layouts')
            ->assertStatus(200)
            ->assertSee('sidebar')
            ->assertSee('sidebar-classic')
            ->assertSee('topbar');

        foreach (['sidebar', 'sidebar-classic', 'topbar'] as $style) {
            $this->withSession(['locale' => $locale])
                ->get("/docs/layouts/demo/{$style}")
                ->assertStatus(200)
                ->assertSee("data-vibe-layout=\"{$style}\"", false);
        }
    }
});

test('sidebar and sidebar-classic keep rightmost viewport scroller and aligned headers', function () {
    $sidebarHtml = Blade::render('<x-docs.layouts.sidebar><p>Content</p></x-docs.layouts.sidebar>');

    expect($sidebarHtml)
        ->toContain('data-vibe-sidebar-header')
        ->toContain('data-vibe-sheet-header')
        ->toContain('data-vibe-panel-sheet')
        ->toContain('data-vibe-layout-header')
        ->toContain('data-vibe-scroll="main"')
        ->toContain('data-vibe-main-shell');

    // In sidebar layout, fixed-height rounded data-vibe-main-shell wraps data-vibe-scroll="main" so all 4 corners stay rounded while scrolling
    $shellPos = strpos($sidebarHtml, '<div data-vibe-main-shell');
    $scrollPos = strpos($sidebarHtml, 'id="docs-main-scroll" data-vibe-scroll="main"');
    expect($shellPos)->not->toBeFalse()
        ->and($scrollPos)->not->toBeFalse()
        ->and($shellPos)->toBeLessThan($scrollPos);

    $sidebarCss = File::get(resource_path('css/vibe/layouts/sidebar.css'));
    expect($sidebarCss)
        ->toContain('[data-vibe-sidebar-header]')
        ->toContain('[data-vibe-sheet-header]')
        ->toContain('[data-vibe-panel-sheet]')
        ->toContain('[data-vibe-layout-header]')
        ->toContain('block-size: var(--vibe-header-height)')
        ->toContain('padding-inline-end: var(--vibe-layout-gap);')
        ->toContain('background-color: var(--header) !important;')
        ->not->toContain('scrollbar-gutter: stable');

    $classicHtml = Blade::render('<x-docs.layouts.sidebar-classic><p>Content</p></x-docs.layouts.sidebar-classic>');
    expect($classicHtml)
        ->toContain('data-vibe-sidebar-header')
        ->toContain('data-vibe-layout-header');

    $classicCss = File::get(resource_path('css/vibe/layouts/sidebar-classic.css'));
    expect($classicCss)
        ->toContain('[data-vibe-sidebar-header]')
        ->toContain('[data-vibe-layout-header]')
        ->toContain('block-size: var(--vibe-header-height)');
});
