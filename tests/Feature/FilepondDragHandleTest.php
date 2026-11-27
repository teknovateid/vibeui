<?php

use Illuminate\Support\Facades\Blade;

test('vibe:filepond supports drag-handle configuration', function () {
    // 1. Default (hover mode: hover on desktop, visible on mobile)
    $htmlDefault = Blade::render(
        '<vibe:filepond name="avatar" :reorder="true" />'
    );
    expect($htmlDefault)
        ->toContain('data-drag-handle="hover"')
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

test('vibe:filepond renders deterministic id, wire:key, and server error sync attributes across renders', function () {
    $renderOne = Blade::render('<vibe:filepond name="draft_media_tmp" />');
    $renderTwo = Blade::render('<vibe:filepond name="draft_media_tmp" />');

    expect($renderOne)
        ->toBe($renderTwo)
        ->toContain('id="filepond-draft_media_tmp-container"')
        ->toContain('wire:key="filepond-draft_media_tmp-container"')
        ->toContain('wire:key="filepond-draft_media_tmp-pond-ignore"')
        ->toContain('data-has-error="0"');

    $withError = Blade::render(
        '<vibe:filepond id="custom-pond" name="draft_media_tmp" error="media gagal diunggah." />'
    );

    expect($withError)
        ->toContain('id="custom-pond-container"')
        ->toContain('wire:key="custom-pond-container"')
        ->toContain('data-has-error="1"')
        ->toContain('data-error-message="media gagal diunggah."');
});
