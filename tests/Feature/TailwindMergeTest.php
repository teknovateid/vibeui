<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;
use Illuminate\View\ComponentAttributeBag;

test('twMerge helper merges conflicting tailwind classes', function () {
    expect(twMerge('px-2 py-1 bg-red-500', 'px-4 bg-blue-500'))
        ->toBe('py-1 px-4 bg-blue-500');
});

test('ComponentAttributeBag twMerge macro merges classes correctly', function () {
    $bag = new ComponentAttributeBag(['class' => 'rounded-full bg-blue-600']);
    $merged = $bag->twMerge(['class' => 'px-4 bg-red-500 rounded-md']);

    expect($merged->get('class'))
        ->toBe('px-4 rounded-full bg-blue-600');
});

test('Blade renders vibe components with merged classes', function () {
    $html = Blade::render('<vibe:button class="rounded-full bg-blue-600">Test</vibe:button>');

    expect($html)
        ->toContain('rounded-full')
        ->toContain('bg-blue-600');
});
