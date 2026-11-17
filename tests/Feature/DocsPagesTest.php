<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('docs show page renders successfully', function () {
    $response = $this->get('/docs/show');

    $response->assertStatus(200);
    $response->assertSee('vibe:button.show', false);
    $response->assertSee('vibe:show.each', false);
    $response->assertSee('vibe-show-attr', false);
    $response->assertSee('VibeShow.populate', false);
});

test('docs button page renders successfully with show and delete sections', function () {
    $response = $this->get('/docs/button');

    $response->assertStatus(200);
    $response->assertSee('vibe:button.show', false);
    $response->assertSee('vibe:button.delete', false);
    $response->assertSee('vibeConfirmDelete', false);
});

test('docs sidebar and classic sidebar layouts use dvh shell and overscroll containment', function () {
    $response = $this->get('/docs/show');
    $response->assertStatus(200)
        ->assertSee('flex h-dvh overflow-hidden relative', false)
        ->assertSee('min-h-0 overflow-y-auto overscroll-y-contain', false)
        ->assertDontSee('flex h-screen overflow-hidden relative', false);

    $classicHtml = Blade::render('<x-docs.layouts.sidebar-classic>Content</x-docs.layouts.sidebar-classic>');
    expect($classicHtml)
        ->toContain('flex h-dvh overflow-hidden relative')
        ->toContain('h-full min-h-0 overflow-y-auto overscroll-y-contain')
        ->not->toContain('flex h-screen');
});
