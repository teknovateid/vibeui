<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('breadcrumb renders correctly with title and items', function () {
    $html = Blade::render(
        <<<'BLADE'
        <vibe:breadcrumb title="Documentation">
            <vibe:breadcrumb.item href="/docs">Docs</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>Components</vibe:breadcrumb.item>
        </vibe:breadcrumb>
        BLADE
    );

    expect($html)
        ->toContain('Documentation')
        ->toContain('href="/docs"')
        ->toContain('Docs')
        ->toContain('Components')
        ->toContain('aria-current="page"');
});

test('breadcrumb.item applies custom class to link element with twMerge', function () {
    $html = Blade::render(
        '<vibe:breadcrumb.item class="text-2xl font-bold text-red-500" href="/docs">Large Link</vibe:breadcrumb.item>'
    );

    expect($html)
        ->toContain('href="/docs"')
        ->toContain('text-2xl')
        ->toContain('font-bold')
        ->toContain('text-red-500');
});

test('breadcrumb.item applies custom class to active/span element with twMerge', function () {
    $html = Blade::render(
        '<vibe:breadcrumb.item class="text-2xl uppercase" active>Current Page</vibe:breadcrumb.item>'
    );

    expect($html)
        ->toContain('<span')
        ->toContain('text-2xl')
        ->toContain('uppercase')
        ->toContain('Current Page')
        ->toContain('aria-current="page"');
});

test('breadcrumb.item forwards additional HTML attributes to link', function () {
    $html = Blade::render(
        '<vibe:breadcrumb.item href="/docs" target="_blank" rel="noopener" id="docs-item" data-test="breadcrumb-link">External</vibe:breadcrumb.item>'
    );

    expect($html)
        ->toContain('target="_blank"')
        ->toContain('rel="noopener"')
        ->toContain('id="docs-item"')
        ->toContain('data-test="breadcrumb-link"');
});

test('breadcrumb.item supports wrapperClass on the li container', function () {
    $html = Blade::render(
        '<vibe:breadcrumb.item href="/docs" wrapper-class="opacity-75 cursor-pointer" class="text-2xl">Item</vibe:breadcrumb.item>'
    );

    expect($html)
        ->toContain('<li class="inline-flex items-center gap-2 sm:gap-2.5 group shrink-0 whitespace-nowrap opacity-75 cursor-pointer"')
        ->toContain('text-2xl');
});

test('breadcrumb index supports custom classes merged with twMerge', function () {
    $html = Blade::render(
        '<vibe:breadcrumb class="gap-8 justify-center my-4" :title="false">
            <vibe:breadcrumb.item href="/">Home</vibe:breadcrumb.item>
        </vibe:breadcrumb>'
    );

    expect($html)
        ->toContain('gap-8')
        ->toContain('justify-center')
        ->toContain('my-4')
        ->not->toContain('gap-4');
});

test('breadcrumb supports slash separator preset on parent and item', function () {
    // Via parent separator="/"
    $htmlParentSlash = Blade::render(
        <<<'BLADE'
        <vibe:breadcrumb separator="/">
            <vibe:breadcrumb.item href="/">Home</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="/orders">Orders</vibe:breadcrumb.item>
        </vibe:breadcrumb>
        BLADE
    );

    expect($htmlParentSlash)
        ->toContain('m16 4-8 16');

    // Via item separator="slash"
    $htmlItemSlash = Blade::render(
        <<<'BLADE'
        <vibe:breadcrumb>
            <vibe:breadcrumb.item href="/">Home</vibe:breadcrumb.item>
            <vibe:breadcrumb.item separator="slash" href="/orders">Orders</vibe:breadcrumb.item>
        </vibe:breadcrumb>
        BLADE
    );

    expect($htmlItemSlash)
        ->toContain('m16 4-8 16');
});

test('breadcrumb supports arrow and dot separator presets', function () {
    $htmlArrow = Blade::render(
        <<<'BLADE'
        <vibe:breadcrumb separator="arrow">
            <vibe:breadcrumb.item href="/">Home</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="/orders">Orders</vibe:breadcrumb.item>
        </vibe:breadcrumb>
        BLADE
    );

    expect($htmlArrow)
        ->toContain('M5 12h14');

    $htmlDot = Blade::render(
        <<<'BLADE'
        <vibe:breadcrumb separator="dot">
            <vibe:breadcrumb.item href="/">Home</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="/orders">Orders</vibe:breadcrumb.item>
        </vibe:breadcrumb>
        BLADE
    );

    expect($htmlDot)
        ->toContain('circle cx="12" cy="12" r="4"');
});

test('breadcrumb supports custom character separator', function () {
    $html = Blade::render(
        <<<'BLADE'
        <vibe:breadcrumb separator="|">
            <vibe:breadcrumb.item href="/">Home</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="/orders">Orders</vibe:breadcrumb.item>
        </vibe:breadcrumb>
        BLADE
    );

    expect($html)
        ->toContain('|');
});

test('breadcrumb.item supports custom separator slot', function () {
    $html = Blade::render(
        <<<'BLADE'
        <vibe:breadcrumb>
            <vibe:breadcrumb.item href="/">Home</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="/orders">
                <x-slot:separator>
                    <span data-test="custom-slot-sep">==></span>
                </x-slot:separator>
                Orders
            </vibe:breadcrumb.item>
        </vibe:breadcrumb>
        BLADE
    );

    expect($html)
        ->toContain('data-test="custom-slot-sep"')
        ->toContain('==>');
});

test('first breadcrumb item hides separator with group-first:hidden', function () {
    $html = Blade::render(
        <<<'BLADE'
        <vibe:breadcrumb separator="/">
            <vibe:breadcrumb.item href="/">Home</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="/orders">Orders</vibe:breadcrumb.item>
        </vibe:breadcrumb>
        BLADE
    );

    expect($html)->toContain('breadcrumb-separator text-muted-foreground/60 shrink-0 group-first:hidden');
});

test('breadcrumb renders clean inline title when no items are present', function () {
    $html = Blade::render(
        '<vibe:breadcrumb title="Documentation"/>'
    );

    expect($html)
        ->toContain('Documentation')
        ->toContain('text-xl')
        ->toContain('md:text-2xl')
        ->toContain('font-bold')
        ->toContain('leading-none')
        ->not->toContain('vibe-breadcrumb');
});

test('breadcrumb standalone title respects custom font size classes', function () {
    $html = Blade::render(
        '<vibe:breadcrumb title="Documentation" class="text-sm font-normal text-muted-foreground"/>'
    );

    expect($html)
        ->toContain('Documentation')
        ->toContain('text-sm')
        ->toContain('font-normal')
        ->toContain('text-muted-foreground')
        ->not->toContain('text-xl')
        ->not->toContain('md:text-2xl')
        ->not->toContain('font-bold');
});

test('breadcrumb standalone title respects titleClass prop', function () {
    $html = Blade::render(
        '<vibe:breadcrumb title="Documentation" title-class="text-xs text-primary"/>'
    );

    expect($html)
        ->toContain('Documentation')
        ->toContain('text-xs')
        ->toContain('text-primary')
        ->not->toContain('text-xl')
        ->not->toContain('md:text-2xl');
});

