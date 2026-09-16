<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('modal renders with animation support and backdrop shake', function () {
    $html = Blade::render('<vibe:modal id="test-modal">Modal Content</vibe:modal>');

    expect($html)
        ->toContain('isShaking: false')
        ->toContain('triggerShake()')
        ->toContain('onBackdropClick')
        ->toContain('animate-vibe-shake');
});

test('toast renders with animation support and default false', function () {
    $html = Blade::render('<vibe:toast />');

    expect($html)
        ->toContain('globalAnimation: false')
        ->toContain('getAnimationClass(toast)');
});

test('card alert renders with animation classes when specified', function () {
    $default = Blade::render('<vibe:card.alert title="Info" />');
    expect($default)->not->toContain('animate-vibe-');

    $shake = Blade::render('<vibe:card.alert title="Error" animation="shake" />');
    expect($shake)->toContain('animate-vibe-shake');

    $pop = Blade::render('<vibe:card.alert title="Success" animation="pop" />');
    expect($pop)->toContain('animate-vibe-pop');

    $autoDestructive = Blade::render('<vibe:card.alert variant="destructive" animation="auto" />');
    expect($autoDestructive)->toContain('animate-vibe-shake');
});

test('badge renders with animation and pulse when specified', function () {
    $default = Blade::render('<vibe:badge>Normal</vibe:badge>');
    expect($default)->not->toContain('animate-vibe-pulse');

    $pulse = Blade::render('<vibe:badge pulse>Live</vibe:badge>');
    expect($pulse)->toContain('animate-vibe-pulse');

    $animated = Blade::render('<vibe:badge animation="pop">New</vibe:badge>');
    expect($animated)->toContain('animate-vibe-pop');
});

test('input renders with shake animation when requested or on error', function () {
    $default = Blade::render('<vibe:input name="username" />');
    expect($default)->not->toContain('animate-vibe-shake');

    $shake = Blade::render('<vibe:input name="password" animation="shake" />');
    expect($shake)->toContain('animate-vibe-shake');

    $autoWithError = Blade::render('<vibe:input name="email" error="Format salah" :animation="true" />');
    expect($autoWithError)->toContain('animate-vibe-shake');
});

test('button renders with pulse and animation when specified', function () {
    $default = Blade::render('<vibe:button>Click me</vibe:button>');
    expect($default)->not->toContain('animate-vibe-pulse');

    $pulse = Blade::render('<vibe:button pulse>Hot Deal</vibe:button>');
    expect($pulse)->toContain('animate-vibe-pulse');

    $shake = Blade::render('<vibe:button animation="shake">Failed</vibe:button>');
    expect($shake)->toContain('animate-vibe-shake');
});
