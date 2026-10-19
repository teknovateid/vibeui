<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('renders number input without prefix by default', function () {
    $html = Blade::render('<vibe:input.number name="stock" value="150000" />');

    expect($html)
        ->toContain('name="stock"')
        ->toContain("thousandSep: '.'")
        ->toContain("decimalSep: ','")
        ->toContain("isRaw: true")
        ->not->toContain('>Rp<');
});

test('supports raw=true by default and keep-format/raw=false for formatted posting', function () {
    // Default raw mode
    $rawHtml = Blade::render('<vibe:input.number name="count" />');
    expect($rawHtml)->toContain("isRaw: true");

    // keep-format attribute
    $formattedHtml = Blade::render('<vibe:input.number name="count" keep-format />');
    expect($formattedHtml)->toContain("isRaw: false");

    // :raw="false" prop
    $rawFalseHtml = Blade::render('<vibe:input.number name="count" :raw="false" />');
    expect($rawFalseHtml)->toContain("isRaw: false");
});

test('supports suffix like kg, pcs, and percent', function () {
    $html = Blade::render('<vibe:input.number name="weight" suffix="kg" precision="2" />');

    expect($html)
        ->toContain('kg')
        ->toContain('precision: 2')
        ->toContain('inputmode="decimal"');
});

test('supports optional stepper buttons', function () {
    $withoutStepper = Blade::render('<vibe:input.number name="items" />');
    expect($withoutStepper)->not->toContain('aria-label="Increase value"');

    $withStepper = Blade::render('<vibe:input.number name="items" stepper min="1" max="100" step="5" />');
    expect($withStepper)
        ->toContain('aria-label="Increase value"')
        ->toContain('aria-label="Decrease value"')
        ->toContain('step: 5')
        ->toContain('min: 1')
        ->toContain('max: 100');
});

test('cleans initial formatted value with separators in integer mode', function () {
    $html = Blade::render('<vibe:input.number name="pop" value="1.500.000" integer />');

    expect($html)
        ->toContain("rawValue: '1500000'")
        ->toContain("thousandSep: '.'");
});

test('docs.input.number route loads with standard right-side TOC aside and controller test form', function () {
    $response = $this->get(route('docs.input.number'));

    $response->assertOk();
    $response->assertSee('md:order-2 md:col-span-3', false);
    $response->assertSee('selector="#docs-content"', false);
    $response->assertSee(route('docs.form.store'), false);
    $response->assertSee('form-test-submission-modal', false);
});
