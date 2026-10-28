<?php

use Illuminate\Support\Facades\Blade;

test('vibe:grid supports drag-handle="hover", "visible", and "hidden"', function () {
    // 1. Default (card header grip is hover: mobile flex, desktop hover)
    $htmlDefault = Blade::render(
        '<vibe:grid.card title="Card 1" :reorderable="true" />'
    );
    expect($htmlDefault)
        ->toContain('flex md:hidden md:group-hover/header:flex size-7')
        ->toContain('circle cx="9" cy="6"');

    // 2. Visible mode
    $htmlVisible = Blade::render(
        '<vibe:grid.card title="Card 1" :reorderable="true" drag-handle="visible" />'
    );
    expect($htmlVisible)
        ->toContain('class="flex size-7')
        ->toContain('circle cx="9" cy="6"');

    // 3. Hidden mode
    $htmlHidden = Blade::render(
        '<vibe:grid.card title="Card 1" :reorderable="true" drag-handle="hidden" />'
    );
    expect($htmlHidden)
        ->not->toContain('circle cx="9" cy="6"');

    // 4. Boolean :drag-handle="false"
    $htmlFalse = Blade::render(
        '<vibe:grid.card title="Card 1" :reorderable="true" :drag-handle="false" />'
    );
    expect($htmlFalse)
        ->not->toContain('circle cx="9" cy="6"');
});

test('vibe:grid passes drag-handle to nested cards via @aware', function () {
    $html = Blade::render(
        '<vibe:grid drag-handle="hidden">
            <vibe:grid.card title="Card A" :reorderable="true" />
        </vibe:grid>'
    );

    expect($html)
        ->not->toContain('circle cx="9" cy="6"');

    $htmlVisible = Blade::render(
        '<vibe:grid drag-handle="visible">
            <vibe:grid.card title="Card A" :reorderable="true" />
        </vibe:grid>'
    );

    expect($htmlVisible)
        ->toContain('class="flex size-7')
        ->toContain('circle cx="9" cy="6"');
});

