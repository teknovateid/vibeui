<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('renders editor component with wrapper, skeleton loader and hidden textarea', function () {
    $html = Blade::render('<vibe:editor name="content" id="test-editor" label="Artikel" :height="400" />');

    expect($html)
        ->toContain('id="test-editor"')
        ->toContain('name="content"')
        ->toContain('data-vibe-editor="content"')
        ->toContain('vibe-editor-skeleton')
        ->toContain('min-height: 400px;')
        ->toContain('vibe-editor-wrapper')
        ->toContain('<textarea')
        ->toContain('Artikel');
});

test('normalizes grouped variables array into flat and grouped config', function () {
    $variables = [
        'user' => [
            'label' => 'Data Pengguna',
            'items' => [
                'name' => 'Nama Lengkap',
                'email' => 'Alamat Email',
            ],
        ],
        'order' => [
            'label' => 'Data Pesanan',
            'items' => [
                'id' => 'Nomor Pesanan',
                'total' => 'Total Pembayaran',
            ],
        ],
    ];

    $html = Blade::render('<vibe:editor name="body" :variables="$vars" />', ['vars' => $variables]);

    expect($html)
        ->toContain('user.name')
        ->toContain('Nama Lengkap')
        ->toContain('Data Pengguna')
        ->toContain('order.total')
        ->toContain('Data Pesanan');
});

test('normalizes flat dot-notation variables array', function () {
    $variables = [
        'customer.name' => 'Nama Pelanggan',
        'customer.email' => 'Email Pelanggan',
        'invoice.number' => 'Nomor Faktur',
    ];

    $html = Blade::render('<vibe:editor name="body" :variables="$vars" />', ['vars' => $variables]);

    expect($html)
        ->toContain('customer.name')
        ->toContain('Nama Pelanggan')
        ->toContain('invoice.number')
        ->toContain('Invoice');
});

test('supports presets minimal, basic, full and standard', function () {
    $minimalHtml = Blade::render('<vibe:editor name="body" preset="minimal" />');
    $fullHtml = Blade::render('<vibe:editor name="body" preset="full" />');

    expect($minimalHtml)->toContain('minimal');
    expect($fullHtml)->toContain('full');
});

test('renders error state and validation message', function () {
    $html = Blade::render('<vibe:editor name="content" error="Konten tidak boleh kosong" />');

    expect($html)
        ->toContain('role="alert"')
        ->toContain('Konten tidak boleh kosong')
        ->toContain('text-destructive');
});

test('renders required indicator and disabled state', function () {
    $html = Blade::render('<vibe:editor name="content" label="Body" :required="true" :disabled="true" />');

    expect($html)
        ->toContain('*</span>')
        ->toContain('disabled')
        ->toContain('is-disabled');
});

test('parses variable badges and raw tokens in template HTML using Vibe::parseTemplate', function () {
    $template = '<p>Halo <span class="vibe-editor-variable mceNonEditable" contenteditable="false" data-variable="user.name">&#123;&#123; user.name &#125;&#125;</span>,</p>'
        . '<p>Pesanan nomor {{ order.number }} senilai Rp {{ order.total }} telah berhasil.</p>'
        . '<p>Toko: {{ company.name }}</p>';

    $data = [
        'user' => (object) ['name' => 'Ahmad Fahril'],
        'order' => [
            'number' => 'ORD-2026-001',
            'total' => '150.000',
        ],
        'company.name' => 'Teknovate Solusindo',
    ];

    $parsed = \Teknovate\VibeUi\Vibe::parseTemplate($template, $data);

    expect($parsed)
        ->toContain('<p>Halo Ahmad Fahril,</p>')
        ->toContain('Pesanan nomor ORD-2026-001 senilai Rp 150.000 telah berhasil.')
        ->toContain('Toko: Teknovate Solusindo')
        ->not->toContain('vibe-editor-variable');

    // Test helper function as well
    $helperParsed = vibe_parse_template($template, $data);
    expect($helperParsed)->toBe($parsed);
});

test('handles XSS escaping and missing variables in parseTemplate', function () {
    $template = '<p>Halo {{ user.name }}, email: {{ user.email }}</p>';
    $data = [
        'user' => [
            'name' => '<script>alert("xss")</script>',
        ],
    ];

    // Escaped by default
    $escaped = \Teknovate\VibeUi\Vibe::parseTemplate($template, $data, escape: true);
    expect($escaped)->toContain('&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;');

    // Strip missing variables
    $stripped = \Teknovate\VibeUi\Vibe::parseTemplate($template, $data, stripMissing: true);
    expect($stripped)->toContain('email: </p>');
});


test('docs editor page renders successfully', function () {
    $response = $this->get('/docs/editor');

    $response->assertStatus(200);
    $response->assertSee('vibe:editor', false);
    $response->assertSee('user.name', false);
});

test('renders wire:ignore on wrapper, root marker, and safe fallback lifecycle attributes', function () {
    $html = Blade::render('<vibe:editor name="content" id="nav-editor" />');

    expect($html)
        ->toContain('data-vibe-editor-root="nav-editor"')
        ->toContain('wire:ignore')
        ->toContain('_isVibeEditorFallback: true')
        ->toContain('rebind()')
        ->toContain('\u0022toolbarSticky\u0022:false')
        ->not->toContain("window.tinymce.remove('#' + this.id)");
});

test('editor script cleans up by editor instance and handles livewire navigation hooks', function () {
    $js = file_get_contents(resource_path('js/vibe/editor.js'));

    expect($js)
        ->toContain("document.addEventListener('livewire:navigating', this._navigatingHandler)")
        ->toContain("document.addEventListener('livewire:navigated'")
        ->toContain("document.addEventListener('livewire:init', registerVibeEditorComponent)")
        ->toContain('tinymce.remove(this.editor)')
        ->toContain('rebindFallbackVibeEditors')
        ->toContain('padding: 1rem 1.25rem;')
        ->toContain('left: 1.25rem !important;')
        ->toContain('top: 1rem !important;')
        ->not->toContain("tinymce.remove('#' + this.id)");
});
