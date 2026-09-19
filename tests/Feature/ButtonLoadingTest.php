<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('button renders with static loading when loading is true', function () {
    $html = Blade::render('<vibe:button :loading="true">Save</vibe:button>');

    expect($html)
        ->toContain('data-loading="true"')
        ->toContain('aria-busy="true"')
        ->toContain('animate-spin')
        ->toContain('Save')
        ->toMatch('/<button[^>]*\sdisabled[\s=>]/');
});

test('button renders normal state when loading is false', function () {
    $html = Blade::render('<vibe:button>Save</vibe:button>');

    expect($html)
        ->toContain('data-loading="false"')
        ->toContain('animate-spin')
        ->toContain('group-data-[loading=true]/vbtn:inline-flex')
        ->toContain('Save')
        ->not->toContain('aria-busy="true"')
        ->not->toMatch('/<button[^>]*\sdisabled[\s=>]/');
});

test('button auto-wires livewire loading directives when wire:click and loading are present', function () {
    $html = Blade::render('<vibe:button wire:click="saveRecord" loading>Simpan</vibe:button>');

    expect($html)
        ->toContain('wire:loading.attr="disabled"')
        ->toContain('wire:target="saveRecord"')
        ->toContain('wire:loading.inline-flex')
        ->toContain('Simpan');
});

test('button supports custom loading text with livewire target', function () {
    $html = Blade::render('<vibe:button type="submit" loading="Menyimpan..." wire:target="updatePassword">Perbarui Kata Sandi</vibe:button>');

    expect($html)
        ->toContain('wire:loading.attr="disabled"')
        ->toContain('wire:target="updatePassword"')
        ->toContain('wire:loading.remove')
        ->toContain('wire:loading.inline-flex')
        ->toContain('Menyimpan...')
        ->toContain('Perbarui Kata Sandi');
});

test('button supports alpine.js loading bindings', function () {
    $html = Blade::render('<vibe:button ::loading="isSubmitting">Kirim</vibe:button>');

    expect($html)
        ->toContain(':data-loading="Boolean(isSubmitting) ? \'true\' : \'false\'"')
        ->toContain(':disabled="Boolean(isSubmitting)"')
        ->toContain(':aria-busy="Boolean(isSubmitting)"')
        ->toContain('Kirim')
        ->not->toContain('::loading');
});

test('button supports x-loading directive as alpine binding without extra js', function () {
    $html = Blade::render('<vibe:button x-loading="isSubmitting">Kirim</vibe:button>');

    expect($html)
        ->toContain(':data-loading="Boolean(isSubmitting) ? \'true\' : \'false\'"')
        ->toContain(':disabled="Boolean(isSubmitting)"')
        ->toContain(':aria-busy="Boolean(isSubmitting)"')
        ->toContain('Kirim')
        ->not->toContain('x-loading');
});

test('button as link (href) supports loading state', function () {
    $html = Blade::render('<vibe:button href="/home" :loading="true">Beranda</vibe:button>');

    expect($html)
        ->toContain('<a')
        ->toContain('data-loading="true"')
        ->toContain('aria-disabled="true"')
        ->toContain('animate-spin')
        ->toContain('Beranda');
});

