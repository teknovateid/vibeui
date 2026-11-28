<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('modal uses native top-layer dialog with closedby and removes body scroll lock', function () {
    $dismissible = Blade::render('<vibe:modal id="m1">Hello</vibe:modal>');
    $locked = Blade::render('<vibe:modal id="m2" :dismissible="false">Locked</vibe:modal>');

    expect($dismissible)
        ->toContain('<dialog id="m1" closedby="any" data-vibe-dialog')
        ->toContain('@cancel.prevent=')
        ->not->toContain('role="dialog"')
        ->not->toContain("document.body.classList.add('overflow-hidden')")
        ->not->toContain('@keydown.escape.window');

    expect($locked)->toContain('<dialog id="m2" closedby="none"');
});

test('form confirm password modal and image lightbox use native dialog element', function () {
    $formHtml = Blade::render('<vibe:form action="/save" :confirm-password="true">Body</vibe:form>');
    $lightboxHtml = Blade::render('<vibe:image.lightbox />');

    expect($formHtml)
        ->toContain('<dialog x-ref="confirmPasswordDialog"')
        ->toContain('closedby="any"')
        ->not->toContain('role="dialog"');

    expect($lightboxHtml)
        ->toContain('<dialog')
        ->toContain('closedby="any"')
        ->not->toContain('role="dialog"');
});

test('vibeStyles emits color-scheme meta tag and syncs it', function () {
    $headHtml = Blade::render('@vibeStyles');

    expect($headHtml)
        ->toContain('<meta name="color-scheme" content="light dark">')
        ->toContain('meta[name="color-scheme"]');
});

test('switch renders native html switch attribute alongside accessibility metadata', function () {
    $html = Blade::render('<vibe:switch name="alerts" label="Alerts" description="Enable notices" error="Required" />');

    expect($html)
        ->toContain('<input')
        ->toContain('type="checkbox"')
        ->toContain('switch')
        ->toContain('role="switch"')
        ->toContain('aria-invalid="true"')
        ->toContain('aria-describedby="')
        ->toContain('role="alert"');
});

test('toast renders manual popover top-layer container and polite live regions', function () {
    $html = Blade::render('<vibe:toast />');

    expect($html)
        ->toContain('popover="manual"')
        ->toContain('role="region"')
        ->toContain('role="status"')
        ->toContain('aria-live="polite"')
        ->toContain('@focusin="onFocusIn()"')
        ->toContain('@focusout="onFocusOut($event)"');
});

test('alert renders alertdialog semantics and escape dismissal handler', function () {
    $html = Blade::render('<vibe:alert />');

    expect($html)
        ->toContain('role="alertdialog"')
        ->toContain('aria-modal="true"')
        ->toContain(':aria-labelledby=')
        ->toContain(':aria-describedby=')
        ->toContain('@keydown.escape.window=');
});

test('table renders keyboard-accessible scroll region and sortable buttons without tabindex minus one', function () {
    $html = Blade::render('<vibe:table caption="Users"><vibe:table.header><vibe:table.column :sortable="true" :sorted="true" direction="asc">Name</vibe:table.column><vibe:table.column :sortable="true">Email</vibe:table.column></vibe:table.header><tbody><tr><td>Alice</td><td>a@example.com</td></tr></tbody></vibe:table>');

    expect($html)
        ->toContain('role="region"')
        ->toContain('tabindex="0"')
        ->toContain('aria-label="Users"')
        ->toContain('data-vibe-table-status')
        ->toContain('aria-sort="ascending"')
        ->not->toContain('aria-sort="none"')
        ->not->toContain('tabindex="-1"')
        ->not->toContain('pointer-events-none');
});

test('input components expose accessible error linking and remove password toggle negative tabindex', function () {
    $inputHtml = Blade::render('<vibe:input name="secret" type="password" viewable label="Secret" description="Min 8 chars" error="Too short" />');
    $textareaHtml = Blade::render('<vibe:textarea name="bio" label="Bio" :auto-resize="true" error="Required" />');

    expect($inputHtml)
        ->toContain('data-error="secret-error"')
        ->toContain('aria-invalid="true"')
        ->toContain('aria-describedby="secret-error"')
        ->toContain('id="secret-error"')
        ->not->toContain('tabindex="-1"');

    expect($textareaHtml)
        ->toContain('field-sizing: content;')
        ->toContain('aria-invalid="true"')
        ->toContain('data-error="bio-error"');
});

test('dropdown exposes aria-haspopup, expanded state, and unique ids across instances', function () {
    $html = Blade::render('<vibe:dropdown keyboard><x-slot:trigger><button type="button">Menu</button></x-slot:trigger><vibe:dropdown.content><vibe:dropdown.item>One</vibe:dropdown.item></vibe:dropdown.content></vibe:dropdown><vibe:dropdown><x-slot:trigger><button type="button">Two</button></x-slot:trigger><vibe:dropdown.content /></vibe:dropdown>');

    preg_match_all('/id="(dropdown-[^"]+)"/', $html, $matches);
    expect(count($matches[1] ?? []))->toBe(2);
    expect($matches[1][0])->not->toBe($matches[1][1]);

    expect($html)
        ->toContain('aria-haspopup="menu"')
        ->toContain(':aria-expanded=')
        ->toContain('@keydown.home.window=');
});

test('vibe component command excludes internal partials directory while partials still render', function () {
    $this->artisan('vibe:component', ['name' => 'partials'])
        ->expectsOutputToContain("Component 'partials' not found.")
        ->assertSuccessful();

    expect(Blade::render('<vibe:partials.field-label for="email" label="Email" :required="true" />'))
        ->toContain('for="email"')
        ->toContain('*');

    expect(file_get_contents(base_path('packages/vibe/src/Commands/CleanCommand.php')))
        ->toContain("'partials'");
});
