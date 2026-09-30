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

test('alert component button click handlers use clean method calls without inline try statement', function () {
    $html = Blade::render('<vibe:alert />');

    expect($html)
        ->toContain('@click="handleClose(alert)"')
        ->toContain('@click="handleConfirm(alert)"')
        ->not->toContain('@click="try');
});

test('renders alert component with backdrop and blur support for all alert types', function () {
    $html = Blade::render('<vibe:alert :blur="true" />');

    expect($html)
        ->toContain('globalBlur: true')
        ->toContain('hasBackdrop()')
        ->toContain('x-show="hasBackdrop()"')
        ->toContain('getBackdropBlurClass()');

    $htmlString = Blade::render('<vibe:alert blur="lg" />');
    expect($htmlString)
        ->toContain("globalBlur: 'lg'");
});



