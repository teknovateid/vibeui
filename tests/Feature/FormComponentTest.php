<?php

use Illuminate\Support\Facades\Blade;

test('vibe:form renders with auto confirm password modal by default', function () {
    $html = Blade::render(
        '<vibe:form id="test-form" action="/test">Fields</vibe:form>'
    );

    expect($html)
        ->toContain('confirmPassword: true')
        ->toContain('showConfirmPasswordModal')
        ->toContain('x-teleport="body"')
        ->toContain('submitConfirmPassword()')
        ->toContain('closeConfirmPasswordModal()')
        ->toContain('confirmPasswordInput');
});

test('vibe:form disables confirm password modal when confirmPassword is false', function () {
    $html = Blade::render(
        '<vibe:form id="test-form" action="/test" :confirm-password="false">Fields</vibe:form>'
    );

    expect($html)
        ->toContain('confirmPassword: false')
        ->not->toContain('x-teleport="body"')
        ->not->toContain('Konfirmasi Kata Sandi');
});

test('vibe:form disables confirm password modal when ajax is false', function () {
    $html = Blade::render(
        '<vibe:form id="test-form" action="/test" :ajax="false">Fields</vibe:form>'
    );

    expect($html)
        ->toContain('ajax: false')
        ->not->toContain('x-teleport="body"')
        ->not->toContain('Konfirmasi Kata Sandi');
});

test('vibe:form accepts custom confirm password url', function () {
    $html = Blade::render(
        '<vibe:form id="test-form" action="/test" confirm-password-url="/custom-confirm">Fields</vibe:form>'
    );

    expect($html)
        ->toContain("confirmPasswordUrl: '/custom-confirm'");
});

test('vibe:form confirm password modal renders passkey button and medium buttons', function () {
    $html = Blade::render(
        '<vibe:form id="test-form" action="/test">Fields</vibe:form>'
    );

    expect($html)
        ->toContain('confirmWithPasskey()')
        ->toContain('h-11 sm:h-9 px-4 sm:px-3.5 text-base sm:text-sm gap-2 rounded-lg');
});

test('vibe:input.multiple safely handles double quotes in placeholder without attribute corruption', function () {
    $html = Blade::render(
        '<vibe:input.multiple name="tags" :placeholder="$ph" />',
        ['ph' => 'Tambah "tags" disini']
    );

    expect($html)
        ->toContain(':placeholder="items.length === 0 ? \'Tambah \u0022tags\u0022 disini\' : \'\'"')
        ->not->toContain('Tambah \"tags\"');
});

test('vibe:select safely handles double quotes in placeholder without attribute corruption', function () {
    $html = Blade::render(
        '<vibe:select name="category" :placeholder="$ph"><vibe:select.option value="1">Opt</vibe:select.option></vibe:select>',
        ['ph' => 'Pilih "Kategori"']
    );

    expect($html)
        ->toContain('x-text="selectedLabel || \'Pilih \u0022Kategori\u0022\'"')
        ->not->toContain('Pilih \"Kategori\"');
});

test('vibe:select multiple uses min-h-11 sm:min-h-9 matching vibe:input height', function () {
    $html = Blade::render(
        '<vibe:select name="categories" multiple><vibe:select.option value="1">Opt 1</vibe:select.option></vibe:select>'
    );

    expect($html)
        ->toContain('min-h-11 sm:min-h-9 py-1.5 sm:py-1')
        ->not->toContain('sm:min-h-10');
});

test('vibe:select single uses h-11 sm:h-9 matching vibe:input height', function () {
    $html = Blade::render(
        '<vibe:select name="category"><vibe:select.option value="1">Opt 1</vibe:select.option></vibe:select>'
    );

    expect($html)
        ->toContain('h-11 sm:h-9');
});
test('vibe:date-time safely falls back to default placeholders when translations/placeholders are missing', function () {
    $html = Blade::render(
        '<vibe:date-time name="published_at" locale="xx-custom" />'
    );

    expect($html)
        ->toContain('placeholder="Select date"');
});

test('vibe:form supports onSuccess and onError props', function () {
    $html = Blade::render(
        '<vibe:form id="test-form" action="/test" onSuccess="$el.reset()" onError="console.error($el)">Fields</vibe:form>'
    );

    expect($html)
        ->toContain('$el.reset()')
        ->toContain('console.error($el)');
});

test('docs form page renders successfully without errors', function () {
    $response = $this->get('/docs/form');
    $response->assertStatus(200);
});

test('vibe:select.option safely handles double quotes in value without attribute corruption', function () {
    $html = Blade::render(
        '<vibe:select.option :value="$val">Monitor</vibe:select.option>',
        ['val' => '27" 4K Monitor']
    );

    expect($html)
        ->toContain(':aria-selected="isSelected($el.dataset.value)"')
        ->toContain('data-value="27&quot; 4K Monitor"')
        ->toContain("isSelected('27\u0022 4K Monitor')")
        ->not->toContain("isSelected('27\\\"")
        ->not->toContain("isSelected('27\\&quot;");
});

test('vibe:select.option safely handles single quotes in value', function () {
    $html = Blade::render(
        '<vibe:select.option :value="$val">Shoes</vibe:select.option>',
        ['val' => "Men's Shoes"]
    );

    expect($html)
        ->toContain(':aria-selected="isSelected($el.dataset.value)"')
        ->toContain("isSelected('Men\u0027s Shoes')")
        ->not->toContain("isSelected('Men\\'");
});

test('vibe:select.option decodes html entities in label without double-encoding in data-label', function () {
    $htmlFromSlot = Blade::render(
        '<vibe:select.option value="cemilan">Cemilan &amp; Finger Food</vibe:select.option>'
    );

    expect($htmlFromSlot)
        ->toContain('data-label="Cemilan &amp; Finger Food"')
        ->not->toContain('&amp;amp;');

    $htmlFromLabel = Blade::render(
        '<vibe:select.option value="cemilan" label="Cemilan &amp; Finger Food" />'
    );

    expect($htmlFromLabel)
        ->toContain('data-label="Cemilan &amp; Finger Food"')
        ->not->toContain('&amp;amp;');
});

test('vibe:select decodes html entities in options and includes decodeHtml in alpine data', function () {
    $html = Blade::render(
        '<vibe:select name="category" :options="$options" multiple />',
        ['options' => ['cemilan' => 'Cemilan & Finger Food', 'manual' => 'Manual Brew']]
    );

    expect($html)
        ->toContain('decodeHtml(str)')
        ->toContain('getOptionLabel(el)')
        ->toContain('data-label="Cemilan &amp; Finger Food"')
        ->not->toContain('&amp;amp;');
});

