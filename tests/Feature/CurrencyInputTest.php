<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('renders currency input with default settings', function () {
    $html = Blade::render('<vibe:input.currency name="price" value="150000" />');

    expect($html)
        ->toContain('name="price"')
        ->toContain("thousandSep: '.'")
        ->toContain("decimalSep: ','")
        ->toContain('h-11 sm:h-9 text-base sm:text-sm');
});

test('renders currency input without thousand separator without regex errors', function () {
    $html = Blade::render('<vibe:input.currency name="amount" value="50000" thousand-separator="" />');

    expect($html)
        ->toContain("thousandSep: ''")
        ->toContain('clean.split(this.thousandSep).join')
        ->not->toContain("new RegExp('\\\\'");
});

test('renders currency input with integer mode and empty thousand separator without php warnings', function () {
    $html = Blade::render('<vibe:input.currency name="qty_price" value="25000.00" integer thousand-separator="" />');

    expect($html)
        ->toContain('rawValue: \'25000\'')
        ->toContain("thousandSep: ''");
});
