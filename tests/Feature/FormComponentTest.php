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
        ->toContain('h-9 px-3.5 text-sm gap-2 rounded-lg');
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

test('vibe:select multiple uses min-h-9 matching vibe:input height', function () {
    $html = Blade::render(
        '<vibe:select name="categories" multiple><vibe:select.option value="1">Opt 1</vibe:select.option></vibe:select>'
    );

    expect($html)
        ->toContain('min-h-9 py-1')
        ->not->toContain('min-h-11')
        ->not->toContain('sm:min-h-10');
});

test('vibe:select single uses h-9 matching vibe:input height', function () {
    $html = Blade::render(
        '<vibe:select name="category"><vibe:select.option value="1">Opt 1</vibe:select.option></vibe:select>'
    );

    expect($html)
        ->toContain('h-9 text-sm rounded-lg')
        ->not->toContain('h-11 sm:h-9');
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

test('vibe:select decodes html entities in options and delegates logic to vibeSelect module', function () {
    $html = Blade::render(
        '<vibe:select name="category" :options="$options" multiple />',
        ['options' => ['cemilan' => 'Cemilan & Finger Food', 'manual' => 'Manual Brew']]
    );

    expect($html)
        ->toContain('window.vibeSelect(')
        ->not->toContain('decodeHtml(str)')
        ->toContain('data-label="Cemilan &amp; Finger Food"')
        ->not->toContain('&amp;amp;');

    $selectJs = file_get_contents(resource_path('js/vibe/select.js'));
    expect($selectJs)
        ->toContain('decodeHtml(str)')
        ->toContain('getOptionLabel(el)')
        ->toContain('window.vibeSelect')
        ->toContain('window.vibeRemoteSelect');
});

test('vibe:select.remote delegates logic to vibeRemoteSelect module', function () {
    $html = Blade::render(
        '<vibe:select.remote name="product" api="/api/products" placeholder="Pick one" />'
    );

    expect($html)
        ->toContain('window.vibeRemoteSelect(')
        ->toContain('\u0022api\u0022:')
        ->toContain('products')
        ->toContain('vibe-select-ready');
});

test('all core form, button, toggle, and tab components share a monotonic proportional size scale', function () {
    $expected = [
        'xs' => ['h' => 'h-7', 'minH' => 'min-h-7', 'text' => 'text-xs', 'radius' => 'rounded-md', 'box' => 'size-3', 'switchTrack' => 'h-3.5 w-6'],
        'sm' => ['h' => 'h-8', 'minH' => 'min-h-8', 'text' => 'text-xs', 'radius' => 'rounded-md', 'box' => 'size-3.5', 'switchTrack' => 'h-4 w-7'],
        'md' => ['h' => 'h-9', 'minH' => 'min-h-9', 'text' => 'text-sm', 'radius' => 'rounded-lg', 'box' => 'size-4', 'switchTrack' => 'h-5 w-9'],
        'lg' => ['h' => 'h-10', 'minH' => 'min-h-10', 'text' => 'text-sm', 'radius' => 'rounded-lg', 'box' => 'size-4.5', 'switchTrack' => 'h-6 w-11'],
        'xl' => ['h' => 'h-11', 'minH' => 'min-h-11', 'text' => 'text-base', 'radius' => 'rounded-xl', 'box' => 'size-5', 'switchTrack' => 'h-7 w-13'],
    ];

    foreach ($expected as $size => $tokens) {
        $inputHtml = Blade::render('<vibe:input name="f" size="' . $size . '" />');
        $btnHtml = Blade::render('<vibe:button size="' . $size . '">Action</vibe:button>');
        $iconBtnHtml = Blade::render('<vibe:button size="icon-' . $size . '"><svg /></vibe:button>');
        $selectHtml = Blade::render('<vibe:select name="s" size="' . $size . '"><vibe:select.option value="1">One</vibe:select.option></vibe:select>');
        $remoteHtml = Blade::render('<vibe:select.remote name="r" api="/api/items" size="' . $size . '" />');
        $dateHtml = Blade::render('<vibe:date-time name="d" size="' . $size . '" />');
        $currencyHtml = Blade::render('<vibe:input.currency name="c" size="' . $size . '" />');
        $numberHtml = Blade::render('<vibe:input.number name="n" size="' . $size . '" />');
        $phoneHtml = Blade::render('<vibe:input.phone name="p" size="' . $size . '" />');
        $qtyHtml = Blade::render('<vibe:input.quantity name="q" size="' . $size . '" />');
        $genHtml = Blade::render('<vibe:input.generate name="g" size="' . $size . '" />');
        $fileHtml = Blade::render('<vibe:input.file name="fl" size="' . $size . '" />');
        $multiHtml = Blade::render('<vibe:input.multiple name="m" size="' . $size . '" />');
        $textareaHtml = Blade::render('<vibe:textarea name="t" size="' . $size . '" />');
        $checkHtml = Blade::render('<vibe:checkbox name="cb" label="Agree" size="' . $size . '" />');
        $radioHtml = Blade::render('<vibe:radio name="rb" label="Choice" value="1" size="' . $size . '" />');
        $switchHtml = Blade::render('<vibe:switch name="sw" label="Toggle" size="' . $size . '" />');
        $tabHtml = Blade::render('<vibe:tabs variant="button" size="' . $size . '"><vibe:tabs.list><vibe:tabs.tab name="a">Tab A</vibe:tabs.tab></vibe:tabs.list><vibe:tabs.panel name="a">Body</vibe:tabs.panel></vibe:tabs>');

        foreach ([$inputHtml, $btnHtml, $selectHtml, $remoteHtml, $dateHtml, $currencyHtml, $numberHtml, $phoneHtml, $genHtml, $fileHtml, $tabHtml] as $controlHtml) {
            expect($controlHtml)
                ->toContain($tokens['h'])
                ->toContain($tokens['text'])
                ->toContain($tokens['radius'])
                ->not->toContain('h-11 sm:h-9');
        }

        expect($qtyHtml)->toContain($tokens['h'])->toContain($tokens['text'])->toContain($tokens['radius']);
        expect($iconBtnHtml)->toContain(str_replace('h-', 'size-', $tokens['h']))->toContain($tokens['radius']);
        expect($multiHtml)->toContain($tokens['minH'])->toContain($tokens['text'])->toContain($tokens['radius']);
        expect($textareaHtml)->toContain($tokens['text'])->toContain($tokens['radius']);
        expect($checkHtml)->toContain($tokens['box'])->toContain($tokens['text']);
        expect($radioHtml)->toContain($tokens['box'])->toContain($tokens['text'])->toContain('<label for=');
        expect($switchHtml)->toContain($tokens['switchTrack'])->toContain($tokens['text']);
    }

    $vibeCss = file_get_contents(resource_path('css/vibe/vibe.css'));
    expect($vibeCss)
        ->toContain('@media (pointer: coarse)')
        ->toContain('min-block-size: 44px;')
        ->toContain('font-size: max(1rem, 1em);');
});

