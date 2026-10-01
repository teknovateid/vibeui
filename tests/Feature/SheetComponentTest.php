<?php

use Illuminate\Support\Facades\Blade;

test('sheet renders default and card variant with card colors', function ($variant) {
    $html = Blade::render(
        '<vibe:sheet id="test-sheet" variant="' . $variant . '">Content</vibe:sheet>'
    );

    expect($html)
        ->toContain('bg-card')
        ->toContain('text-card-foreground')
        ->toContain('border-border');
})->with(['default', 'card']);

test('sheet renders sidebar variant with sidebar colors', function () {
    $html = Blade::render(
        '<vibe:sheet id="test-sidebar-sheet" variant="sidebar">Content</vibe:sheet>'
    );

    expect($html)
        ->toContain('bg-sidebar')
        ->toContain('text-sidebar-foreground')
        ->toContain('border-sidebar-border')
        ->toContain('data-variant="sidebar"');
});

test('sheet renders muted variant with respective colors', function () {
    $mutedHtml = Blade::render(
        '<vibe:sheet id="test-muted-sheet" variant="muted">Content</vibe:sheet>'
    );
    expect($mutedHtml)
        ->toContain('bg-muted')
        ->toContain('text-muted-foreground');
});

test('sheet header and footer support variant sidebar styling', function () {
    $html = Blade::render(
        <<<'BLADE'
        <vibe:sheet id="test-sub-sheet" variant="sidebar">
            <vibe:sheet.header>Header</vibe:sheet.header>
            <vibe:sheet.content>Content</vibe:sheet.content>
            <vibe:sheet.footer>Footer</vibe:sheet.footer>
        </vibe:sheet>
        BLADE
    );

    expect($html)
        ->toContain('group-data-[variant=sidebar]/sheet:border-sidebar-border');
});

test('sheet with position right uses right: 0 in inner styling', function () {
    $html = Blade::render(
        '<vibe:sheet id="test-right-sheet" position="right" layout="fixed" default-size="400">Content</vibe:sheet>'
    );

    expect($html)
        ->toContain('top: 0; right: 0; bottom: 0; width: 400px')
        ->toContain('top: 0; right: 0; bottom: 0; width: ${size}px');
});

test('sheet defaults to fixed full height drawer with backdrop and collapsed state', function () {
    $html = Blade::render(
        '<vibe:sheet id="demo-sheet-basic" position="right" behavior="collapsible" :defaultSize="320">Content</vibe:sheet>'
    );

    expect($html)
        ->toContain('fixed right-0 top-0 bottom-0 h-dvh shadow-2xl')
        ->toContain('data-layout="fixed"')
        ->toContain('data-state="collapsed"')
        ->toContain('data-dismissible="true"')
        ->toContain('x-teleport="body"')
        ->toContain('backdrop-blur-xs');
});

test('sheet supports size presets', function () {
    $htmlSm = Blade::render(
        '<vibe:sheet id="test-sm" size="sm">Content</vibe:sheet>'
    );
    expect($htmlSm)->toContain('width: 300px');

    $htmlMd = Blade::render(
        '<vibe:sheet id="test-md" size="md">Content</vibe:sheet>'
    );
    expect($htmlMd)->toContain('width: 380px');

    $htmlLg = Blade::render(
        '<vibe:sheet id="test-lg" size="lg">Content</vibe:sheet>'
    );
    expect($htmlLg)->toContain('width: 500px');
});

test('sheet with layout relative defaults to expanded state without backdrop', function () {
    $html = Blade::render(
        '<vibe:sheet id="test-relative-sheet" layout="relative">Content</vibe:sheet>'
    );

    expect($html)
        ->toContain('data-layout="relative"')
        ->toContain('data-state="expanded"')
        ->toContain('data-dismissible="false"')
        ->not->toContain('x-teleport="body"');
});

test('sheet applies responsive mobile width constraint on sidebar variant and supports mobileSize prop', function () {
    $htmlSidebar = Blade::render(
        '<vibe:sheet id="test-mobile-sheet" variant="sidebar" position="left" layout="relative">Content</vibe:sheet>'
    );

    expect($htmlSidebar)
        ->toContain('max-w-[calc(100vw-3rem)]')
        ->toContain('md:max-w-full')
        ->toContain("mobileSize: '280'");

    $htmlCustom = Blade::render(
        '<vibe:sheet id="test-custom-mobile" position="left" layout="relative" mobileSize="260">Content</vibe:sheet>'
    );

    expect($htmlCustom)
        ->toContain("mobileSize: '260'");
});

test('sheet supports mobileSize full and w-full class on mobile with max-w on larger screens', function () {
    $htmlFull = Blade::render(
        '<vibe:sheet id="test-full-sheet" position="right" layout="absolute" mobileSize="full" class="w-full sm:max-w-md">Content</vibe:sheet>'
    );

    expect($htmlFull)
        ->toContain("mobileSize: 'full'")
        ->toContain('w-full')
        ->toContain('sm:max-w-md')
        ->not->toContain('max-w-[calc(100vw-3rem)]');
});

test('sheet with dismissibleButton false does not render outer floating close button', function () {
    $htmlWithoutBtn = Blade::render(
        '<vibe:sheet id="test-no-dismiss-btn" layout="absolute" :dismissibleButton="false"><vibe:sheet.header>Header</vibe:sheet.header></vibe:sheet>'
    );

    expect($htmlWithoutBtn)
        ->not->toContain('absolute top-3 right-3 z-30');
});

