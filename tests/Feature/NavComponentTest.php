<?php

use Illuminate\Support\Facades\Blade;

test('nav renders with variant, density, and indicator data attributes', function () {
    $html = Blade::render(
        '<vibe:nav id="test-nav" variant="primary" density="compact" indicator>Nav Content</vibe:nav>'
    );

    expect($html)
        ->toContain('id="test-nav"')
        ->toContain('data-nav-variant="primary"')
        ->toContain('data-nav-density="compact"')
        ->toContain('data-nav-indicator="true"');
});

test('nav item renders with default active tokens and icon currentColor', function () {
    $html = Blade::render(
        <<<'BLADE'
        <vibe:nav.item href="/dashboard" active>
            <x-slot:icon>
                <svg><path d="M0 0h24v24H0z"/></svg>
            </x-slot:icon>
            Dashboard
        </vibe:nav.item>
        BLADE
    );

    expect($html)
        ->toContain('nav-item-active')
        ->toContain('bg-[var(--nav-active-bg)]')
        ->toContain('text-[var(--nav-active-fg)]')
        ->toContain('text-current');
});

test('nav item renders primary and subtle variants when active', function () {
    $primaryHtml = Blade::render(
        '<vibe:nav.item href="/dashboard" variant="primary" active>Dashboard</vibe:nav.item>'
    );
    expect($primaryHtml)
        ->toContain('bg-primary')
        ->toContain('text-primary-foreground')
        ->toContain('data-variant="primary"');

    $subtleHtml = Blade::render(
        '<vibe:nav.item href="/dashboard" variant="subtle" active>Dashboard</vibe:nav.item>'
    );
    expect($subtleHtml)
        ->toContain('bg-muted')
        ->toContain('text-foreground')
        ->toContain('data-variant="subtle"');
});

test('nav item renders line variant with indicator pseudo element', function () {
    $html = Blade::render(
        '<vibe:nav.item href="/dashboard" variant="line" active>Dashboard</vibe:nav.item>'
    );

    expect($html)
        ->toContain('bg-transparent')
        ->toContain('before:bg-[var(--nav-indicator)]')
        ->toContain('data-indicator="true"');
});

test('nav item supports density options', function () {
    $compactHtml = Blade::render(
        '<vibe:nav.item href="/dashboard" density="compact">Dashboard</vibe:nav.item>'
    );
    expect($compactHtml)
        ->toContain('min-h-8')
        ->toContain('data-density="compact"');

    $relaxedHtml = Blade::render(
        '<vibe:nav.item href="/dashboard" density="relaxed">Dashboard</vibe:nav.item>'
    );
    expect($relaxedHtml)
        ->toContain('min-h-10')
        ->toContain('data-density="relaxed"');
});

test('nav group supports variant and density props', function () {
    $html = Blade::render(
        <<<'BLADE'
        <vibe:nav.group title="Settings" variant="primary" density="compact" active>
            <vibe:nav.item href="/settings/general">General</vibe:nav.item>
        </vibe:nav.group>
        BLADE
    );

    expect($html)
        ->toContain('data-variant="primary"')
        ->toContain('data-density="compact"')
        ->toContain('bg-primary')
        ->toContain('text-primary-foreground');
});
