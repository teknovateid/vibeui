<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('renders basic tabs with list, tab buttons, and panels', function () {
    $template = <<<'BLADE'
        <vibe:tabs selected="livewire" default="livewire" layout="rows" variant="pill">
            <vibe:tabs.list>
                <vibe:tabs.tab name="livewire">Livewire</vibe:tabs.tab>
                <vibe:tabs.tab name="api">API</vibe:tabs.tab>
                <vibe:tabs.tab name="form">Form</vibe:tabs.tab>
            </vibe:tabs.list>
            <vibe:tabs.panel name="livewire">Panel Livewire</vibe:tabs.panel>
            <vibe:tabs.panel name="api">Panel API</vibe:tabs.panel>
            <vibe:tabs.panel name="form">Panel Form</vibe:tabs.panel>
        </vibe:tabs>
    BLADE;

    $html = Blade::render($template);

    expect($html)
        ->toContain('vibe-tabs-root')
        ->toContain('getRootEl()')
        ->toContain("activeTab: 'livewire'")
        ->toContain('data-tab-name="livewire"')
        ->toContain('data-tab-name="api"')
        ->toContain('data-tab-name="form"')
        ->toContain("@click=\"activeTab = 'livewire'; selectTab('livewire'")
        ->toContain("@click=\"activeTab = 'api'; selectTab('api'")
        ->toContain("@click=\"activeTab = 'form'; selectTab('form'")
        ->toContain("x-show=\"activeTab === 'livewire'\"")
        ->toContain("x-show=\"activeTab === 'api'\"")
        ->toContain("x-show=\"activeTab === 'form'\"")
        ->toContain('Panel Livewire')
        ->toContain('Panel API')
        ->toContain('Panel Form');
});

test('docs todo page renders backend integration tabs section properly', function () {
    $response = $this->get('/docs/todo');

    $response->assertStatus(200);
    $response->assertSee('vibe-tabs-root', false);
    $response->assertSee('data-tab-name="livewire"', false);
    $response->assertSee('data-tab-name="api"', false);
    $response->assertSee('data-tab-name="form"', false);
    $response->assertSee('selectTab(\'livewire\'', false);
    $response->assertSee('selectTab(\'api\'', false);
    $response->assertSee('selectTab(\'form\'', false);
});
