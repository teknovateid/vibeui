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

test('currency input normalizes programmatic and vibe:show decimal strings without stripping decimal point as thousand separator', function () {
    $html = Blade::render('<vibe:input.currency name="min_spent" />');

    expect($html)
        ->toContain('bindHiddenInput()')
        ->toContain('normalizeRaw(e.target.value)')
        ->toContain('normalizeRaw(val)')
        ->toContain('if (hidden.value !== this.rawValue)')
        ->toContain('/^-?(?:\d+(?:\.\d+)?|\.\d+)$/');

    $xModelHtml = Blade::render('<vibe:input.currency x-model="row.price" />');

    expect($xModelHtml)
        ->toContain('this.normalizeRaw(initialVal)')
        ->toContain('this.normalizeRaw(newVal)');
});

test('docs input currency page renders updated vibe:show compatibility section', function () {
    $response = $this->get('/docs/input/currency');

    $response->assertStatus(200)
        ->assertSee('vibe:form')
        ->assertSee('vibe:show')
        ->assertSee('currency-show-demo', false)
        ->assertSee('300000.00', false);
});

test('docs button show-demo returns decimal min_spent string and docs show includes currency input', function () {
    $this->get('/docs/button/show-demo')
        ->assertStatus(200)
        ->assertJsonPath('min_spent', '300000.00');

    $this->get('/docs/show')
        ->assertStatus(200)
        ->assertSee('name="min_spent"', false);
});
