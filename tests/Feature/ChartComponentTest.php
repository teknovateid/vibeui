<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('renders chart component with canvas and skeleton', function () {
    $html = Blade::render('<vibe:chart id="test-chart" :height="250" />');

    expect($html)
        ->toContain('id="test-chart"')
        ->toContain('data-vibe-chart')
        ->toContain('vibe-chart-skeleton')
        ->toContain('x-ref="canvas"')
        ->toContain('<canvas')
        ->toContain('min-height: 250px; height: 250px;')
        ->toEndWith("</div>\n");
});

test('renders chart component with sparkline configuration', function () {
    $html = Blade::render('<vibe:chart :sparkline="true" :height="50" />');

    expect($html)
        ->toContain('min-height: 50px; height: 50px;')
        ->toContain('&quot;legend&quot;:{&quot;display&quot;:false}')
        ->toContain('x-ref="canvas"');
});

test('renders chart component with zoom enabled', function () {
    $html = Blade::render('<vibe:chart :zoom="true" />');

    expect($html)
        ->toContain('&quot;zoom&quot;:{&quot;wheel&quot;:{&quot;enabled&quot;:true}')
        ->toContain('x-ref="canvas"');
});
