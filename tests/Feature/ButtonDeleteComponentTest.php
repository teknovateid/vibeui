<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('button.delete renders with default trash icon and destructive styling', function () {
    $html = Blade::render('<vibe:button.delete />');

    expect($html)
        ->toContain('vibeConfirmDelete')
        ->toContain('<svg')
        ->toContain('text-destructive/80')
        ->toContain('data-confirm-title')
        ->toContain('data-confirm-message')
        ->toContain('data-confirm-text')
        ->toContain('data-cancel-text');
});

test('button.delete supports wire:click action callback', function () {
    $html = Blade::render('<vibe:button.delete wire:click="delete(42)" />');

    expect($html)
        ->toContain('$wire.delete(42)')
        ->not->toMatch('/<button[^>]*\swire:click[\s=>]/');
});

test('button.delete supports url delete submission', function () {
    $html = Blade::render('<vibe:button.delete url="/users/5" />');

    expect($html)
        ->toContain('window.vibeSubmitDelete')
        ->toContain('/users/5')
        ->toContain('data-url="/users/5"');
});

test('button.delete supports custom action expression', function () {
    $html = Blade::render('<vibe:button.delete action="handleDelete()" />');

    expect($html)
        ->toContain('handleDelete()');
});

test('button.delete supports custom title, message, and button texts', function () {
    $html = Blade::render(
        '<vibe:button.delete title="Hapus Akun?" message="Semua data Anda akan hilang selamanya." confirm-text="Hapus Sekarang" cancel-text="Batalkan" />'
    );

    expect($html)
        ->toContain('data-confirm-title="Hapus Akun?"')
        ->toContain('data-confirm-message="Semua data Anda akan hilang selamanya."')
        ->toContain('data-confirm-text="Hapus Sekarang"')
        ->toContain('data-cancel-text="Batalkan"');
});

test('button.delete supports custom slot content and variants', function () {
    $html = Blade::render(
        '<vibe:button.delete variant="outline">Hapus Data Permanen</vibe:button.delete>'
    );

    expect($html)
        ->toContain('Hapus Data Permanen')
        ->toContain('border-destructive/30');
});
