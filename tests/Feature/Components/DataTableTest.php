<?php

use Illuminate\Support\Facades\Blade;

describe('Vibe DataTable Component & Boot Lifecycle', function () {
    it('renders the datatable wrapper and bordered styles properly', function () {
        $html = Blade::render('<vibe:datatable bordered><div>Table Content</div></vibe:datatable>');

        expect($html)
            ->toContain('Table Content')
            ->toContain('border-collapse')
            ->toContain('[&_th]:border-table-border');
    });

    it('pushes datatable.js via @pushOnce to head without importing it in app.js or theme.js', function () {
        $appJs = file_get_contents(resource_path('js/vibe/app.js'));
        $themeJs = file_get_contents(resource_path('js/vibe/theme.js'));
        $indexBlade = file_get_contents(resource_path('views/vibe/datatable/index.blade.php'));
        $datatableBlade = file_get_contents(resource_path('views/vibe/datatable/datatable.blade.php'));

        expect($appJs)->not->toContain('datatable')
            ->and($themeJs)->not->toContain("from './datatable'")
            ->and($indexBlade)->toContain("@pushOnce('head', 'vibe-datatable-scripts')")
            ->and($indexBlade)->toContain("@vite(['resources/js/vibe/datatable.js'])")
            ->and($datatableBlade)->toContain("@pushOnce('head', 'vibe-datatable-scripts')")
            ->and($datatableBlade)->toContain("@vite(['resources/js/vibe/datatable.js'])");
    });

    it('guards Alpine.initTree with wireRoot.__livewire check and clears _x_marker on subtree reset in datatable.js', function () {
        $datatableJs = file_get_contents(resource_path('js/vibe/datatable.js'));

        expect($datatableJs)
            ->toContain('export function registerLivewireTableComponents')
            ->toContain('export function ensureDatatablesReady')
            ->toContain('export function resetAlpineSubtree')
            ->toContain('delete node._x_marker;')
            ->toContain('delete node._x_dataStack;')
            ->toContain("const wireRoot = el.closest('[wire\\\\:id]');")
            ->toContain('if (!wireRoot.__livewire)')
            ->toContain("document.addEventListener('livewire:initialized'")
            ->toContain("document.addEventListener('livewire:navigated'")
            ->toContain("window.dispatchEvent(new CustomEvent('vibe-datatable-ready'));")
            ->not->toContain('eventTableFingerpint');
    });

    it('does not strip x-cloak from child elements inside datatable views or theme.js', function () {
        $themeJs = file_get_contents(resource_path('js/vibe/theme.js'));
        $indexBlade = file_get_contents(resource_path('views/vibe/datatable/index.blade.php'));
        $datatableBlade = file_get_contents(resource_path('views/vibe/datatable/datatable.blade.php'));

        expect($themeJs)->not->toContain('.vibe-datatable-root [x-cloak]')
            ->and($indexBlade)->not->toContain("querySelectorAll('[x-cloak]')")
            ->and($datatableBlade)->not->toContain("querySelectorAll('[x-cloak]')");
    });

    it('renders the /docs/datatable documentation page and Livewire DemoBasicTable component cleanly', function () {
        $this->withVite();

        $response = $this->get('/docs/datatable');

        $response->assertStatus(200);
        $response->assertSee('datatable.js', false);
        $response->assertSee('window.VibeInitDataTable', false);

        \Livewire\Livewire::test(\App\Livewire\DemoBasicTable::class)
            ->assertStatus(200)
            ->assertSee('vibe-datatable-root', false)
            ->assertSee('laravellivewiretable', false);
    });
});
