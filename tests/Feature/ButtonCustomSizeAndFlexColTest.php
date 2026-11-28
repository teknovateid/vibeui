<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('button with flex-col automatically applies h-auto and responsive vertical padding', function () {
    $html = Blade::render('
        <vibe:button variant="ghost" size="sm" class="flex flex-col" title="Order">
            <svg class="size-10" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0z" fill="none" />
            </svg>
            <span class="text-[10px] uppercase">Order</span>
        </vibe:button>
    ');

    expect($html)
        ->toContain('flex flex-col')
        ->toContain('h-auto')
        ->toContain('py-1.5')
        ->toContain('px-3')
        ->toContain('[&_svg]:shrink-0')
        ->toContain('[&_svg]:pointer-events-none')
        ->toContain('size-10')
        ->toContain('Order')
        ->not->toMatch('/h-8(?!\d)/'); // Ensure fixed h-8 is not forced
});

test('button with flex-col respects custom explicit height in class', function () {
    $html = Blade::render('
        <vibe:button variant="ghost" size="sm" class="flex flex-col h-20" title="Order">
            <svg class="size-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"></svg>
            <span>Order</span>
        </vibe:button>
    ');

    expect($html)
        ->toContain('flex flex-col')
        ->toContain('h-20')
        ->not->toContain('h-auto');
});

test('button supports size="auto" and size="none"', function () {
    $autoHtml = Blade::render('<vibe:button size="auto">Auto Button</vibe:button>');
    expect($autoHtml)
        ->toContain('h-auto')
        ->toContain('py-2')
        ->toContain('px-3');

    $noneHtml = Blade::render('<vibe:button size="none">Unstyled Size</vibe:button>');
    expect($noneHtml)
        ->not->toMatch('/h-(7|8|9|10|11)/')
        ->toContain('Unstyled Size');
});

test('button supports square icon sizes 10, 12, and icon-2xl', function () {
    $size10 = Blade::render('<vibe:button size="10"><svg class="size-5"></svg></vibe:button>');
    expect($size10)->toContain('size-10');

    $icon10 = Blade::render('<vibe:button size="icon-10"><svg class="size-5"></svg></vibe:button>');
    expect($icon10)->toContain('size-10');

    $icon2xl = Blade::render('<vibe:button size="icon-2xl"><svg class="size-6"></svg></vibe:button>');
    expect($icon2xl)->toContain('size-12 p-0 rounded-xl');
});
