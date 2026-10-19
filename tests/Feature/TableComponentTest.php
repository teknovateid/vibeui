<?php

use Illuminate\Support\Facades\Blade;

test('vibe:table renders with table token classes', function () {
    $rendered = Blade::render('<vibe:table><tbody><tr><td>Data</td></tr></tbody></vibe:table>');

    expect($rendered)
        ->toContain('border-table-border')
        ->toContain('[&_tbody_tr:hover]:bg-table-row-hover');
});

test('vibe:table.header renders with table-header background and foreground tokens', function () {
    $rendered = Blade::render('<vibe:table.header><vibe:table.column>Name</vibe:table.column></vibe:table.header>');

    expect($rendered)
        ->toContain('bg-table-header')
        ->toContain('text-table-header-foreground')
        ->toContain('border-table-border');
});

test('vibe:table.header sticky mode applies solid bg-table-header without transparent bleed', function () {
    $rendered = Blade::render('<vibe:table.header :sticky="true"><vibe:table.column>Name</vibe:table.column></vibe:table.header>');

    expect($rendered)
        ->toContain('sticky top-0 bg-table-header')
        ->not->toContain('bg-background/95');
});

test('vibe:table.footer renders with table-footer and table-border tokens', function () {
    $rendered = Blade::render('<vibe:table.footer><vibe:table.cell>Total</vibe:table.cell></vibe:table.footer>');

    expect($rendered)
        ->toContain('bg-table-footer')
        ->toContain('border-table-border')
        ->toContain('text-table-header-foreground');
});

test('vibe:table.rows renders with divide-table-border token', function () {
    $rendered = Blade::render('<vibe:table.rows><tr><td>Data</td></tr></vibe:table.rows>');

    expect($rendered)
        ->toContain('divide-table-border')
        ->not->toContain('divide-border/60');
});

test('VibeDataTableComponent sets table appearance tokens by default', function () {
    $component = new class extends \Teknovate\VibeUi\DataTable\VibeDataTableComponent {
        public function columns(): array { return []; }
        public function builder(): \Illuminate\Database\Eloquent\Builder {
            return \App\Models\User::query();
        }
    };

    $component->configure();

    expect($component->getTableWrapperAttributes()['class'])
        ->toContain('border-table-border')
        ->not->toContain('border-border');

    expect($component->getTheadAttributes()['class'])
        ->toContain('border-table-border')
        ->toContain('bg-table-header')
        ->toContain('text-table-header-foreground')
        ->not->toContain('border-border');

    expect($component->getTbodyAttributes()['class'])
        ->toContain('divide-table-border')
        ->not->toContain('divide-border');

    $trAttrs = $component->getTrAttributes(new \App\Models\User(), 0);
    expect($trAttrs['class'])
        ->toContain('hover:bg-table-row-hover')
        ->not->toContain('hover:bg-muted/50');

    $thAttrs = $component->getThAttributes(new \Rappasoft\LaravelLivewireTables\Views\Column('Test'));
    expect($thAttrs['class'])
        ->toContain('text-table-header-foreground');
});

