<?php

use Illuminate\Support\Facades\Blade;

test('vibe:filepond supports drag-handle configuration', function () {
    // 1. Default (visible)
    $htmlDefault = Blade::render(
        '<vibe:filepond name="avatar" :reorder="true" />'
    );
    expect($htmlDefault)
        ->toContain('data-drag-handle="visible"')
        ->toContain('dragHandle');

    // 2. Hover mode
    $htmlHover = Blade::render(
        '<vibe:filepond name="avatar" :reorder="true" drag-handle="hover" />'
    );
    expect($htmlHover)
        ->toContain('data-drag-handle="hover"')
        ->toContain('hover');

    // 3. Hidden mode
    $htmlHidden = Blade::render(
        '<vibe:filepond name="avatar" :reorder="true" drag-handle="hidden" />'
    );
    expect($htmlHidden)
        ->toContain('data-drag-handle="hidden"')
        ->toContain('hidden');

    // 4. Boolean :drag-handle="false"
    $htmlFalse = Blade::render(
        '<vibe:filepond name="avatar" :reorder="true" :drag-handle="false" />'
    );
    expect($htmlFalse)
        ->toContain('data-drag-handle="hidden"')
        ->toContain('hidden');
});
