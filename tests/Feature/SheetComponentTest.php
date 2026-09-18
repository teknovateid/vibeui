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

test('sheet renders muted and accent variants with respective colors', function () {
    $mutedHtml = Blade::render(
        '<vibe:sheet id="test-muted-sheet" variant="muted">Content</vibe:sheet>'
    );
    expect($mutedHtml)
        ->toContain('bg-muted')
        ->toContain('text-muted-foreground');

    $accentHtml = Blade::render(
        '<vibe:sheet id="test-accent-sheet" variant="accent">Content</vibe:sheet>'
    );
    expect($accentHtml)
        ->toContain('bg-accent')
        ->toContain('text-accent-foreground');
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
