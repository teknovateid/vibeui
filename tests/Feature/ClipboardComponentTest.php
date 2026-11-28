<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('vibe:clipboard button renders accessible invoker command markup with external live region', function () {
    $html = Blade::render('<vibe:clipboard value="vibe_secret_123" aria-label="Copy secret token" />');

    expect($html)
        ->toContain('type="button"')
        ->toContain('command="--copy"')
        ->toContain('data-vibe-clipboard-trigger')
        ->toContain('data-clipboard-value="vibe_secret_123"')
        ->toContain('aria-label="Copy secret token"')
        ->toContain('size-9')
        ->toContain('role="status"')
        ->toContain('aria-live="polite"')
        ->not->toMatch('/\sdisabled(?:\s|=|>)/');

    $buttonClosePos = strpos($html, '</button>');
    $statusPos = strpos($html, 'data-vibe-clipboard-status');
    expect($buttonClosePos)->not->toBeFalse()
        ->and($statusPos)->not->toBeFalse()
        ->and($statusPos)->toBeGreaterThan($buttonClosePos);
});

test('vibe:clipboard supports visible labels, custom feedback strings, target commandfor, and sr-only bubble=false', function () {
    $labeled = Blade::render('<vibe:clipboard value="https://vibeui.id" variant="primary" copy-label="Salin Link" copied-label="Tersalin!" failed-label="Gagal!" toast />');
    expect($labeled)
        ->toContain('h-9 px-3.5 text-sm')
        ->toContain('Salin Link')
        ->toContain('Tersalin!')
        ->toContain('data-copied-text="Tersalin!"')
        ->toContain('data-failed-text="Gagal!"')
        ->toContain('data-copy-toast="true"');

    $targeted = Blade::render('<vibe:clipboard target="api-snippet" :bubble="false" />');
    expect($targeted)
        ->toContain('command="--copy"')
        ->toContain('commandfor="api-snippet"')
        ->toContain('sr-only');
});

test('vibe:clipboard follows proportional xs to xl sizing in both button and box modes', function () {
    $scale = [
        'xs' => ['btn' => 'size-7', 'h' => 'h-7', 'text' => 'text-xs', 'radius' => 'rounded-md'],
        'sm' => ['btn' => 'size-8', 'h' => 'h-8', 'text' => 'text-xs', 'radius' => 'rounded-md'],
        'md' => ['btn' => 'size-9', 'h' => 'h-9', 'text' => 'text-sm', 'radius' => 'rounded-lg'],
        'lg' => ['btn' => 'size-10', 'h' => 'h-10', 'text' => 'text-sm', 'radius' => 'rounded-lg'],
        'xl' => ['btn' => 'size-11', 'h' => 'h-11', 'text' => 'text-base', 'radius' => 'rounded-xl'],
    ];

    foreach ($scale as $size => $tokens) {
        $btnHtml = Blade::render('<vibe:clipboard size="' . $size . '" value="abc" />');
        $fieldHtml = Blade::render('<vibe:clipboard variant="field" size="' . $size . '" value="abc" />');
        $codeHtml = Blade::render('<vibe:clipboard variant="code" size="' . $size . '" prefix="$" value="php artisan vibe" />');

        expect($btnHtml)->toContain($tokens['btn'])->toContain($tokens['radius']);
        expect($fieldHtml)->toContain($tokens['h'])->toContain($tokens['text'])->toContain($tokens['radius']);
        expect($codeHtml)->toContain($tokens['h'])->toContain($tokens['radius'])->toContain('>$</span>');
    }
});

test('vibe:clipboard field masked mode keeps plain copy value and renders accessible reveal toggle', function () {
    $html = Blade::render('<vibe:clipboard id="api-key-box" variant="field" label="API Key" description="Keep secret" value="sk_live_999" masked />');

    expect($html)
        ->toContain('for="api-key-box-source"')
        ->toContain('id="api-key-box-source"')
        ->toContain('type="password"')
        ->toContain(':type="revealed ? \'text\' : \'password\'"')
        ->toContain(':aria-pressed="revealed"')
        ->toContain('commandfor="api-key-box-source"')
        ->toContain('data-clipboard-value="sk_live_999"')
        ->toContain('Keep secret');
});

test('vibe clipboard JS engine, CSS rules, and $vibe helper are wired correctly', function () {
    $coreJs = file_get_contents(resource_path('js/vibe/core.js'));
    $stateJs = file_get_contents(resource_path('js/vibe/state.js'));
    $vibeCss = file_get_contents(resource_path('css/vibe/vibe.css'));

    expect($coreJs)
        ->toContain('window.VibeClipboard = VibeClipboard')
        ->toContain('initClipboardCommands()')
        ->toContain("document.addEventListener('command'")
        ->toContain("'CommandEvent' in window")
        ->toContain('navigator.clipboard.writeText')
        ->toContain('legacyCopyText');

    expect($stateJs)
        ->toContain('copy: (text, opts = {}) => window.VibeCore?.copy(text, opts)')
        ->toContain('clipboard:');

    expect($vibeCss)
        ->toContain('[data-vibe-clipboard-trigger][data-copied]')
        ->toContain('.vibe-clipboard-tip')
        ->toContain('.vibe-copyable')
        ->toContain('prefers-reduced-motion: reduce');
});

test('docs clipboard page renders successfully in English and Indonesian locales', function () {
    $this->get('/docs/clipboard')
        ->assertStatus(200)
        ->assertSee('vibe:clipboard', false)
        ->assertSee('data-vibe-clipboard-trigger', false)
        ->assertSee('window.VibeClipboard.copy', false);

    $this->withSession(['locale' => 'en'])
        ->get('/docs/clipboard')
        ->assertStatus(200)
        ->assertSee('Copying from Target Elements', false);
});
