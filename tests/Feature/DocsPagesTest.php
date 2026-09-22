<?php

declare(strict_types=1);

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
