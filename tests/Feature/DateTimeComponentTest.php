<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('renders date-time component with default props', function () {
    $html = Blade::render('<vibe:date-time name="birth_date" />');

    expect($html)
        ->toContain('data-vibe-date-time')
        ->toContain('name="birth_date"')
        ->toContain('x-ref="hiddenInput"')
        ->toContain('window.vibeDateTime');
});

test('renders date-time component with wire:model.live', function () {
    $html = Blade::render('<vibe:date-time wire:model.live="dateRange" mode="range" :presets="true" :clearable="true" />');

    expect($html)
        ->toContain("\$wire.entangle('dateRange').live")
        ->toContain('name="dateRange"')
        ->toContain('x-ref="hiddenInput"')
        ->toContain('wireModelName&quot;:&quot;dateRange&quot;')
        ->toContain('isWireLive&quot;:true')
        ->toContain('@click="apply()"');
});

test('renders date-time component with standard wire:model deferred', function () {
    $html = Blade::render('<vibe:date-time wire:model="filterDate" mode="single" />');

    expect($html)
        ->toContain("\$wire.entangle('filterDate')")
        ->not->toContain("\$wire.entangle('filterDate').live")
        ->toContain('name="filterDate"')
        ->toContain('wireModelName&quot;:&quot;filterDate&quot;')
        ->toContain('isWireLive&quot;:false');
});

test('renders date-time with explicit value prop', function () {
    $html = Blade::render('<vibe:date-time name="event_date" value="2026-11-14" />');

    expect($html)
        ->toContain('&quot;value&quot;:&quot;2026-11-14&quot;')
        ->not->toContain('$wire.entangle');
});
