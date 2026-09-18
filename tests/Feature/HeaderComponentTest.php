<?php

use Illuminate\Support\Facades\Blade;

test('header renders variant header with header color variables', function () {
    $html = Blade::render(
        '<vibe:header id="test-header" variant="header">Header Content</vibe:header>'
    );

    expect($html)
        ->toContain('bg-header')
        ->toContain('text-header-foreground')
        ->toContain('border-header-border')
        ->toContain('data-variant="header"');
});

test('header renders default and card variant with card colors', function ($variant) {
    $html = Blade::render(
        '<vibe:header variant="' . $variant . '">Header Content</vibe:header>'
    );

    expect($html)
        ->toContain('bg-card')
        ->toContain('text-card-foreground')
        ->toContain('border-border');
})->with(['default', 'card']);

test('header renders muted and accent variants with respective colors', function () {
    $mutedHtml = Blade::render(
        '<vibe:header variant="muted">Header Content</vibe:header>'
    );
    expect($mutedHtml)
        ->toContain('bg-muted')
        ->toContain('text-muted-foreground');

    $accentHtml = Blade::render(
        '<vibe:header variant="accent">Header Content</vibe:header>'
    );
    expect($accentHtml)
        ->toContain('bg-accent')
        ->toContain('text-accent-foreground');
});

test('header supports sticky variant and sticky prop with header colors', function () {
    $stickyVariantHtml = Blade::render(
        '<vibe:header variant="sticky">Header Content</vibe:header>'
    );
    expect($stickyVariantHtml)
        ->toContain('sticky top-0 z-50')
        ->toContain('data-sticky="true"')
        ->toContain('data-[scrolled=true]:bg-header/80');

    $stickyHeaderHtml = Blade::render(
        '<vibe:header variant="header" :sticky="true">Header Content</vibe:header>'
    );
    expect($stickyHeaderHtml)
        ->toContain('sticky top-0 z-50')
        ->toContain('data-sticky="true"')
        ->toContain('data-variant="header"')
        ->toContain('data-[scrolled=true]:bg-header/80')
        ->toContain('data-[scrolled=true]:border-header-border/80');
});

test('header heading and subheading harmonize with variant header', function () {
    $html = Blade::render(
        <<<'BLADE'
        <vibe:header variant="header">
            <vibe:header.heading>Judul Header</vibe:header.heading>
            <vibe:header.subheading>Subjudul Header</vibe:header.subheading>
        </vibe:header>
        BLADE
    );

    expect($html)
        ->toContain('text-inherit')
        ->toContain('group-data-[variant=header]/header:text-header-foreground')
        ->toContain('group-data-[variant=header]/header:text-header-foreground/70');
});
