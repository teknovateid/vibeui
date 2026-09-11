<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('modal renders toggle-modal and wildcard close-modal listeners', function () {
    $template = <<<'BLADE'
        <vibe:modal id="test-magic-modal">
            <vibe:modal.content>
                Modal Content
            </vibe:modal.content>
        </vibe:modal>
    BLADE;

    $html = Blade::render($template);

    expect($html)
        ->toContain('modalId: \'test-magic-modal\'')
        ->toContain('@open-modal.window')
        ->toContain('@close-modal.window')
        ->toContain('@toggle-modal.window')
        ->toContain("t === '*' || !t");
});

test('sheet renders wildcard close-sheet listener', function () {
    $template = <<<'BLADE'
        <vibe:sheet id="test-magic-sheet">
            Sheet Content
        </vibe:sheet>
    BLADE;

    $html = Blade::render($template);

    expect($html)
        ->toContain('@open-sheet.window')
        ->toContain('@close-sheet.window')
        ->toContain('@toggle-sheet.window')
        ->toContain("t === '*' || !t");
});

test('dropdown renders id and window listeners for open, close, and toggle', function () {
    $template = <<<'BLADE'
        <vibe:dropdown id="test-magic-dropdown">
            <x-slot:trigger>
                <button>Trigger</button>
            </x-slot:trigger>
            <div>Menu item</div>
        </vibe:dropdown>
    BLADE;

    $html = Blade::render($template);

    expect($html)
        ->toContain('id="test-magic-dropdown"')
        ->toContain('@open-dropdown.window')
        ->toContain('@close-dropdown.window')
        ->toContain('@toggle-dropdown.window')
        ->toContain("t === '*' || !t");
});

test('toast renders close-toast window listener', function () {
    $template = <<<'BLADE'
        <vibe:toast />
    BLADE;

    $html = Blade::render($template);

    expect($html)
        ->toContain('x-on:toast.window')
        ->toContain('x-on:close-toast.window')
        ->toContain("!t || t === '*'");
});

test('alert renders close-alert window listener', function () {
    $template = <<<'BLADE'
        <vibe:alert />
    BLADE;

    $html = Blade::render($template);

    expect($html)
        ->toContain('x-on:alert.window')
        ->toContain('x-on:close-alert.window')
        ->toContain("!t || t === '*'");
});

test('state.js defines $vibe magic manager with singular and plural modules', function () {
    $stateJs = file_get_contents(resource_path('js/vibe/state.js'));

    expect($stateJs)
        ->toContain('window.$vibe = vibeManager;')
        ->toContain("window.Alpine.magic('vibe'")
        ->toContain('modals: {')
        ->toContain('sheets: {')
        ->toContain('dropdowns: {')
        ->toContain('toasts: {')
        ->toContain('alerts: {')
        ->toContain("detail: '*'")
        ->toContain('open-modal')
        ->toContain('close-modal')
        ->toContain('toggle-modal')
        ->toContain('open-sheet')
        ->toContain('close-sheet')
        ->toContain('toggle-sheet')
        ->toContain('open-dropdown')
        ->toContain('close-dropdown')
        ->toContain('toggle-dropdown');
});

test('docs pages for modal, sheet, dropdown, toast, and alert return 200 ok', function () {
    $routes = [
        'docs.modal.index',
        'docs.sheet.index',
        'docs.dropdown.index',
        'docs.toast.index',
        'docs.alert.index',
    ];

    foreach ($routes as $route) {
        $response = $this->get(route($route));
        $response->assertStatus(200);
    }
});

