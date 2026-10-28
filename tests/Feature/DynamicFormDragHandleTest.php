<?php

use Illuminate\Support\Facades\Blade;

test('vibe:dynamic-form supports drag-handle="hover", "visible", and "hidden"', function () {
    // 1. Default (card variant is hover: mobile flex, desktop hover)
    $htmlDefault = Blade::render(
        '<vibe:dynamic-form.item :allow-reorder="true" index="0" variant="card" />'
    );
    expect($htmlDefault)
        ->toContain('data-action-drag-handle')
        ->toContain('flex md:hidden md:group-hover/header:flex');

    // 2. Visible mode
    $htmlVisible = Blade::render(
        '<vibe:dynamic-form.item :allow-reorder="true" index="0" variant="card" drag-handle="visible" />'
    );
    expect($htmlVisible)
        ->toContain('data-action-drag-handle')
        ->toContain('cursor-grab flex duration-400');

    // 3. Hidden mode via prop
    $htmlHidden = Blade::render(
        '<vibe:dynamic-form.item :allow-reorder="true" index="0" variant="card" drag-handle="hidden" />'
    );
    expect($htmlHidden)
        ->not->toContain('data-action-drag-handle');

    // 4. Hidden mode via boolean :drag-handle="false"
    $htmlFalse = Blade::render(
        '<vibe:dynamic-form.item :allow-reorder="true" index="0" variant="card" :drag-handle="false" />'
    );
    expect($htmlFalse)
        ->not->toContain('data-action-drag-handle');

    // 5. Table variant with hover (and default)
    $htmlTableHover = Blade::render(
        '<vibe:dynamic-form.item :allow-reorder="true" index="0" variant="table" drag-handle="hover" />'
    );
    expect($htmlTableHover)
        ->toContain('data-action-drag-handle')
        ->toContain('flex md:hidden md:group-hover/item:flex md:group-hover:flex');

    // 6. Table variant with visible
    $htmlTableVisible = Blade::render(
        '<vibe:dynamic-form.item :allow-reorder="true" index="0" variant="table" drag-handle="visible" />'
    );
    expect($htmlTableVisible)
        ->toContain('data-action-drag-handle')
        ->toContain('cursor-grab active:cursor-grabbing text-muted-foreground/60 hover:text-foreground hover:bg-muted p-1 rounded transition-colors flex items-center');
});

test('vibe:dynamic-form container passes drag-handle to children and templates', function () {
    $html = Blade::render(
        '<vibe:dynamic-form name="test_items" :allow-reorder="true" drag-handle="hidden">
            <div>Sample Item</div>
        </vibe:dynamic-form>'
    );

    expect($html)
        ->not->toContain('data-action-drag-handle');
});

