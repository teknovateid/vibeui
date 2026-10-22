<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ViewErrorBag;

beforeEach(function () {
    app()->setLocale('id');
});

test('input file renders with default variant and hidden file input', function () {
    $html = Blade::render('<vibe:input.file name="resume" label="Curriculum Vitae" />');

    expect($html)
        ->toContain('Curriculum Vitae')
        ->toContain('name="resume"')
        ->toContain('type="file"')
        ->toContain('class="sr-only"')
        ->toContain('Pilih Berkas');
});

test('input file displays required asterisk when required is true', function () {
    $html = Blade::render('<vibe:input.file name="document" label="Dokumen Wajib" required />');

    expect($html)
        ->toContain('Dokumen Wajib')
        ->toContain('*')
        ->toContain('required');
});

test('input file supports dropzone variant', function () {
    $html = Blade::render('<vibe:input.file name="photos" variant="dropzone" hint="PNG, JPG hingga 5MB" />');

    expect($html)
        ->toContain('border-dashed')
        ->toContain('seret')
        ->toContain('PNG, JPG hingga 5MB');
});

test('input file supports logo variant with checkerboard pattern and aspect ratio', function () {
    $html = Blade::render('<vibe:input.file name="company_logo" variant="logo" aspect-ratio="horizontal" />');

    expect($html)
        ->toContain('Logo Preview')
        ->toContain('rounded-xl')
        ->toContain('Pilih Logo');
});

test('input file supports logo variant with square aspect ratio', function () {
    $html = Blade::render('<vibe:input.file name="favicon" variant="logo" aspect-ratio="square" size="sm" />');

    expect($html)
        ->toContain('size-20')
        ->toContain('Logo Preview');
});

test('input file supports avatar variant', function () {
    $html = Blade::render('<vibe:input.file name="avatar" variant="avatar" size="md" />');

    expect($html)
        ->toContain('rounded-full')
        ->toContain('Ubah')
        ->toContain('Pilih Foto');
});

test('input file displays existingUrl in edit mode', function () {
    $url = 'https://example.com/logo.png';
    $html = Blade::render('<vibe:input.file name="logo" variant="logo" existing-url="' . $url . '" />');

    expect($html)
        ->toContain(':src="existingUrl"')
        ->toContain('existingUrl:')
        ->toContain('Ganti Logo')
        ->toContain('Hapus');
});

test('input file supports multiple files and maxFiles', function () {
    $html = Blade::render('<vibe:input.file name="docs[]" multiple max-files="5" />');

    expect($html)
        ->toContain('multiple')
        ->toContain('maxFilesCount: 5')
        ->toContain('isMultiple: true');
});

test('input file respects accept and maxSize attributes', function () {
    $html = Blade::render('<vibe:input.file name="attachment" accept="image/*,.pdf" max-size="2MB" />');

    expect($html)
        ->toContain('accept="image/*,.pdf"')
        ->toContain('maxSizeBytes: 2097152');
});

test('input file handles disabled state', function () {
    $html = Blade::render('<vibe:input.file name="disabled_file" disabled />');

    expect($html)
        ->toContain('disabled')
        ->toContain('opacity-50');
});

test('input file displays error message when error is present', function () {
    $html = Blade::render('<vibe:input.file name="avatar" error="Berkas avatar tidak valid." />');

    expect($html)
        ->toContain('Berkas avatar tidak valid.')
        ->toContain('text-destructive');
});

