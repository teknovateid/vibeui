<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('renders alert component with default animation false', function () {
    $html = Blade::render('<vibe:alert />');

    expect($html)
        ->toContain('id="vibe-alert-container"')
        ->toContain('globalAnimation: false')
        ->toContain('getAnimationClass(alert)')
        ->toContain('shakeAlert(alert)');
});

test('renders alert component with custom animation', function () {
    $html = Blade::render('<vibe:alert animation="shake" />');

    expect($html)
        ->toContain("globalAnimation: 'shake'");
});


test('alert docs page returns successful response and contains animation section', function () {
    $response = $this->get('/docs/alert');
    $response->assertStatus(200);

    $content = $response->getContent();
    expect($content)
        ->toContain('animasi-alert')
        ->toContain('animation: \'shake\'')
        ->toContain('animation: \'pop\'')
        ->toContain('animation: \'pulse\'')
        ->toContain('animation: \'wobble\'');
});
