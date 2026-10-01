<?php

use Illuminate\Support\Facades\Blade;

test('vibe:button.edit renders default button with pencil icon and click.stop isolation', function () {
    $rendered = Blade::render('<vibe:button.edit />');

    expect($rendered)->toContain('x-on:click.stop');
    expect($rendered)->toContain('<svg');
    expect($rendered)->toContain('d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"');
});

test('vibe:button.edit in href mode renders as link with click.stop isolation for datatable safety', function () {
    $rendered = Blade::render('<vibe:button.edit href="/users/42/edit">Edit User</vibe:button.edit>');

    expect($rendered)->toContain('href="/users/42/edit"');
    expect($rendered)->toContain('x-on:click.stop');
    expect($rendered)->toContain('Edit User');
});

test('vibe:button.edit in target mode with url and action renders data attributes without forcing PUT', function () {
    $rendered = Blade::render(
        '<vibe:button.edit target="edit-user-sheet" url="/api/users/42" action="/users/42" onSuccess="console.log(data)" />'
    );

    expect($rendered)->toContain('data-target="edit-user-sheet"');
    expect($rendered)->toContain('data-url="/api/users/42"');
    expect($rendered)->toContain('data-action="/users/42"');
    expect($rendered)->toContain('data-on-success="console.log(data)"');
    expect($rendered)->toContain('window.vibeTriggerEdit($el)');
    expect($rendered)->toContain('x-on:click.stop');
    // Must NOT force @method('PUT')
    expect($rendered)->not->toContain('_method="PUT"');
});

test('vibe:button.edit in instant data mode renders row data json attribute', function () {
    $user = ['id' => 99, 'name' => 'John Doe', 'email' => 'john@example.com'];
    $rendered = Blade::render(
        '<vibe:button.edit target="edit-modal" :data="$user" />',
        ['user' => $user]
    );

    expect($rendered)->toContain('data-target="edit-modal"');
    expect($rendered)->toContain(':data-row-data=');
    expect($rendered)->toContain('window.vibeTriggerEdit($el)');
    expect($rendered)->toContain('x-on:click.stop');
});

test('vibe:button.edit supports wire:click combined with target', function () {
    $rendered = Blade::render(
        '<vibe:button.edit wire:click="edit(12)" target="user-sheet" />'
    );

    expect($rendered)->toContain('$wire.edit(12);');
    expect($rendered)->not->toContain('$wire.edit(12)();');
    expect($rendered)->toContain('window.vibeTriggerEdit($el)');
    expect($rendered)->toContain('x-on:click.stop');
});

test('vibe:button.edit with wire:click method alone does not append duplicate parentheses', function () {
    $renderedWithParam = Blade::render('<vibe:button.edit wire:click="edit(1)" />');
    expect($renderedWithParam)->toContain('$wire.edit(1);');
    expect($renderedWithParam)->not->toContain('$wire.edit(1)();');

    $renderedNoParam = Blade::render('<vibe:button.edit wire:click="edit" />');
    expect($renderedNoParam)->toContain('$wire.edit();');
    expect($renderedNoParam)->not->toContain('$wire.edit()();');

    $renderedInterpolated = Blade::render('<vibe:button.edit wire:click="edit({{ $id }})" />', ['id' => 99]);
    expect($renderedInterpolated)->toContain('$wire.edit(99);');
    expect($renderedInterpolated)->not->toContain('$wire.edit(99)();');
});

test('vibe:button.edit supports custom slot content and variant styling', function () {
    $rendered = Blade::render(
        '<vibe:button.edit variant="outline" size="sm"><span>Custom Edit</span></vibe:button.edit>'
    );

    expect($rendered)->toContain('Custom Edit');
    expect($rendered)->toContain('border');
});
