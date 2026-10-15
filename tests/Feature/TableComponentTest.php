<?php

use Illuminate\Support\Facades\Blade;

test('vibe:table renders with table token classes', function () {
    $rendered = Blade::render('<vibe:table><tbody><tr><td>Data</td></tr></tbody></vibe:table>');

    expect($rendered)
        ->toContain('border-table-border')
        ->toContain('[&_tbody_tr:hover]:bg-table-row-hover');
});

test('vibe:table.header renders with table-header background and foreground tokens', function () {
    $rendered = Blade::render('<vibe:table.header><vibe:table.column>Name</vibe:table.column></vibe:table.header>');

    expect($rendered)
        ->toContain('bg-table-header')
        ->toContain('text-table-header-foreground')
        ->toContain('border-table-border');
});

test('vibe:table.header sticky mode applies solid bg-table-header without transparent bleed', function () {
    $rendered = Blade::render('<vibe:table.header :sticky="true"><vibe:table.column>Name</vibe:table.column></vibe:table.header>');

    expect($rendered)
        ->toContain('sticky top-0 bg-table-header')
        ->not->toContain('bg-background/95');
});

test('vibe:table.footer renders with table-footer and table-border tokens', function () {
    $rendered = Blade::render('<vibe:table.footer><vibe:table.cell>Total</vibe:table.cell></vibe:table.footer>');

    expect($rendered)
        ->toContain('bg-table-footer')
        ->toContain('border-table-border')
        ->toContain('text-table-header-foreground');
});
