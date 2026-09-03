<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/datatable.title')" :description="__('docs/datatable.description')" schema="techarticle" :breadcrumbs="[
        ['name' => __('docs/datatable.common.home'), 'url' => '/'],
        ['name' => __('docs/datatable.common.docs'), 'url' => '/docs'],
        ['name' => __('docs/datatable.title'), 'url' => '/docs/datatable']
    ]" />

    @php
        $c = fn(string $key) => __('docs/datatable.code.' . $key);
    @endphp

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Hero Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground">{{ __('docs/datatable.badge') }}</span>
                    <span class="text-xs text-muted-foreground">{{ __('docs/datatable.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/datatable.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/datatable.description') }}
                </p>

                {{-- Feature Badges --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['Livewire 3', 'Rappasoft Engine', 'Debounced Search', 'Multi-Sort', 'Bulk Actions', 'Column Selector', 'Custom Filters', 'Footer Aggregates', 'Bordered Mode'] as $badge)
                        <span class="px-2.5 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $badge }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Cara Memanggil DataTable --}}
            <section id="cara-memanggil-datatable" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.how_to_call.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.how_to_call.desc') !!}
                    </p>
                </div>

                {{-- 1. Menggunakan Tag Helper <vibe:datatable> --}}
                <div id="memanggil-vibe-tag" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/datatable.how_to_call.vibe_tag.title') }}</h3>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/datatable.how_to_call.vibe_tag.desc') !!}
                    </p>

                    @php
                        $callVibeTagCode = <<<HTML
{{-- {$c('blade_call_1')} --}}
<vibe:datatable :component="\\App\\Livewire\\DemoBasicTable::class" />

{{-- {$c('blade_call_2')} --}}
<vibe:datatable component="demo-basic-table" />
HTML;
                    @endphp
                    <vibe:highlightjs language="blade" title="resources/views/example.blade.php" :lineNumbers="true" :code="$callVibeTagCode" />
                </div>

                {{-- 2. Menggunakan Tag Asli <livewire:...> --}}
                <div id="memanggil-livewire-tag" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/datatable.how_to_call.livewire_tag.title') }}</h3>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/datatable.how_to_call.livewire_tag.desc') !!}
                    </p>

                    @php
                        $callLivewireTagCode = <<<HTML
{{-- {$c('blade_call_3')} --}}
<livewire:demo-basic-table />
HTML;
                    @endphp
                    <vibe:highlightjs language="blade" title="resources/views/example.blade.php" :lineNumbers="true" :code="$callLivewireTagCode" />
                </div>

                {{-- 3. Menggunakan Direktif @livewire --}}
                <div id="memanggil-blade-directive" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/datatable.how_to_call.blade_directive.title') }}</h3>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/datatable.how_to_call.blade_directive.desc') !!}
                    </p>

                    @php
                        $callDirectiveCode = <<<HTML
{{-- {$c('blade_call_4')} --}}
@livewire(\\App\\Livewire\\DemoBasicTable::class)

{{-- Or using alias string --}}
@livewire('demo-basic-table')
HTML;
                    @endphp
                    <vibe:highlightjs language="blade" title="resources/views/example.blade.php" :lineNumbers="true" :code="$callDirectiveCode" />
                </div>

                {{-- 4. Forwarding Parameter --}}
                <div id="memanggil-prop-forwarding" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/datatable.how_to_call.prop_forwarding.title') }}</h3>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/datatable.how_to_call.prop_forwarding.desc') !!}
                    </p>

                    @php
                        $callPropForwardCode = <<<HTML
{{-- {$c('prop_forwarding_1')} --}}
<vibe:datatable
    :component="\\App\\Livewire\\DemoBasicTable::class"
    :user-id="123"
    status="active"
/>

{{-- {$c('prop_forwarding_2')} --}}
<vibe:datatable
    :component="\\App\\Livewire\\DemoBasicTable::class"
    class="p-4 border rounded-2xl bg-card"
/>
HTML;
                    @endphp
                    <vibe:highlightjs language="blade" title="resources/views/example.blade.php" :lineNumbers="true" :code="$callPropForwardCode" />
                </div>
            </section>

            {{-- Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.basic_usage.desc') !!}
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="basic-preview" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.preview_component') }}</h4>

                    @php
                        $basicComponent = \App\Livewire\DemoBasicTable::class;
                        $basicBladeCode = <<<HTML
{{-- {$c('blade_call_1')} --}}
<vibe:datatable :component="\\App\\Livewire\\DemoBasicTable::class" />

{{-- {$c('blade_call_3')} --}}
<livewire:demo-basic-table />
HTML;
                    @endphp
                    <vibe:preview :title="__('docs/datatable.basic_usage.preview_title')" :center="false" :code="$basicBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$basicComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="basic-livewire" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.livewire_component') }}</h4>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/datatable.basic_usage.livewire_desc') !!}
                    </p>

                    @php
                        $basicPhpCode = <<<'PHP'
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoBasicTable extends VibeDataTableComponent
{
    public string $tableName = 'basic_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Created At', 'created_at')
                ->sortable(),
        ];
    }
}
PHP;
                    @endphp
                    <vibe:highlightjs language="php" title="app/Livewire/DemoBasicTable.php" :lineNumbers="true" :code="$basicPhpCode" />
                </div>
            </section>

            {{-- Bordered Table --}}
            <section id="bordered-table" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.bordered.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.bordered.desc') !!}
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="bordered-preview" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.preview_component') }}</h4>

                    @php
                        $borderedComponent = \App\Livewire\DemoBorderedTable::class;
                        $borderedBladeCode = <<<HTML
{{-- {$c('bordered_1')} --}}
<vibe:datatable :component="\\App\\Livewire\\DemoBasicTable::class" class="border" />

{{-- {$c('bordered_2')} --}}
<vibe:datatable :component="\\App\\Livewire\\DemoBasicTable::class" bordered />

{{-- {$c('bordered_3')} --}}
<vibe:datatable :component="\\App\\Livewire\\DemoBorderedTable::class" />
HTML;
                    @endphp
                    <vibe:preview :title="__('docs/datatable.bordered.preview_title')" :center="false" :code="$borderedBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$borderedComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="bordered-livewire" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.livewire_component') }}</h4>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/datatable.bordered.livewire_desc') !!}
                    </p>

                    @php
                        $borderedPhpCode = <<<PHP
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoBorderedTable extends VibeDataTableComponent
{
    public string \$tableName = 'bordered_table';

    public function configure(): void
    {
        parent::configure();

        \$this->setPrimaryKey('id')
            ->setBorderedEnabled(); // {$c('comment_bordered_enabled')}
    }

    public function builder(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Created At', 'created_at')
                ->sortable(),
        ];
    }
}
PHP;
                    @endphp
                    <vibe:highlightjs language="php" title="app/Livewire/DemoBorderedTable.php" :lineNumbers="true" :code="$borderedPhpCode" />
                </div>
            </section>

            {{-- Kustomisasi Kolom & Tombol Aksi --}}
            <section id="kustomisasi-kolom" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.columns.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.columns.desc') !!}
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="columns-preview" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.preview_component') }}</h4>

                    @php
                        $columnsComponent = \App\Livewire\DemoActionsTable::class;
                        $columnsBladeCode = <<<HTML
{{-- {$c('blade_call_1')} --}}
<vibe:datatable :component="\\App\\Livewire\\DemoActionsTable::class" />
HTML;
                    @endphp
                    <vibe:preview :title="__('docs/datatable.columns.preview_title')" :center="false" :code="$columnsBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$columnsComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="columns-livewire" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.livewire_component') }}</h4>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/datatable.columns.livewire_desc') !!}
                    </p>

                    @php
                        $columnsPhpCode = <<<'PHP'
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoActionsTable extends VibeDataTableComponent
{
    public string $tableName = 'actions_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Status')
                ->label(fn ($row) => $row->id % 2 === 0
                    ? '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 border border-emerald-500/20">Active</span>'
                    : '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground border border-border">Inactive</span>'
                )
                ->html(),

            Column::make('Actions')
                ->label(fn ($row) => Blade::render('
                    <vibe:button.group variant="ghost">
                        <vibe:button size="icon-xs" variant="ghost" class="text-muted-foreground hover:text-foreground" title="Edit" wire:click="edit({{ $row->id }})">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                        </vibe:button>
                        <vibe:button.delete size="icon-xs" variant="ghost" wire:click="delete({{ $row->id }})" />
                    </vibe:button.group>
                ', ['row' => $row]))
                ->html(),
        ];
    }
}
PHP;
                    @endphp
                    <vibe:highlightjs language="php" title="app/Livewire/DemoActionsTable.php" :lineNumbers="true" :code="$columnsPhpCode" />
                </div>
            </section>

            {{-- Aksi Massal (Bulk Actions) --}}
            <section id="aksi-massal" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.bulk_actions.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.bulk_actions.desc') !!}
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="bulk-preview" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.preview_component') }}</h4>

                    @php
                        $bulkComponent = \App\Livewire\DemoBulkTable::class;
                        $bulkBladeCode = <<<HTML
{{-- {$c('blade_call_1')} --}}
<vibe:datatable :component="\\App\\Livewire\\DemoBulkTable::class" />
HTML;
                    @endphp
                    <vibe:preview :title="__('docs/datatable.bulk_actions.preview_title')" :center="false" :code="$bulkBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$bulkComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="bulk-livewire" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.livewire_component') }}</h4>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/datatable.bulk_actions.livewire_desc') !!}
                    </p>

                    @php
                        $bulkPhpCode = <<<PHP
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoBulkTable extends VibeDataTableComponent
{
    public string \$tableName = 'bulk_table';

    public function configure(): void
    {
        parent::configure();

        \$this->setPrimaryKey('id')
            ->setBulkActions([
                'exportSelected' => 'Ekspor Data (CSV)',
                'deleteSelected' => 'Hapus Terpilih',
            ]);
    }

    public function exportSelected(): void
    {
        \$selectedIds = \$this->getSelected();
        // {$c('comment_export_csv')}
        \$this->clearSelected(); // {$c('comment_clear_selected')}
    }

    public function deleteSelected(): void
    {
        \$selectedIds = \$this->getSelected();
        // {$c('comment_delete_selected')}
        \$this->clearSelected();
    }

    public function builder(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->sortable(),
            Column::make('Name', 'name')->sortable()->searchable(),
            Column::make('Email', 'email')->sortable()->searchable(),
            Column::make('Created At', 'created_at')->sortable(),
        ];
    }
}
PHP;
                    @endphp
                    <vibe:highlightjs language="php" title="app/Livewire/DemoBulkTable.php" :lineNumbers="true" :code="$bulkPhpCode" />
                </div>
            </section>

            {{-- Pencarian di Setiap Kolom --}}
            <section id="pencarian-setiap-kolom" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.column_search.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.column_search.desc') !!}
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="column-search-preview" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.preview_component') }}</h4>

                    @php
                        $colSearchComponent = \App\Livewire\DemoColumnSearchTable::class;
                        $colSearchBladeCode = <<<HTML
{{-- {$c('blade_call_1')} --}}
<vibe:datatable :component="\\App\\Livewire\\DemoColumnSearchTable::class" />
HTML;
                    @endphp
                    <vibe:preview :title="__('docs/datatable.column_search.preview_title')" :center="false" :code="$colSearchBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$colSearchComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="column-search-livewire" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.livewire_component') }}</h4>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/datatable.column_search.livewire_desc') !!}
                    </p>

                    @php
                        $colSearchPhpCode = <<<PHP
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoColumnSearchTable extends VibeDataTableComponent
{
    public string \$searchId = '';
    public string \$searchName = '';
    public string \$searchEmail = '';

    public string \$tableName = 'col_search_table';

    public function configure(): void
    {
        parent::configure();

        \$this->setPrimaryKey('id')
            ->setSecondaryHeaderStatus(true); // {$c('comment_secondary_header')}
    }

    public function builder(): Builder
    {
        return User::query()
            ->when(\$this->searchId, fn (Builder \$q, \$val) => \$q->whereRaw('CAST(id AS TEXT) LIKE ?', ['%' . trim(\$val) . '%']))
            ->when(\$this->searchName, fn (Builder \$q, \$val) => \$q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower(trim(\$val)) . '%']))
            ->when(\$this->searchEmail, fn (Builder \$q, \$val) => \$q->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower(trim(\$val)) . '%']));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->secondaryHeader(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchId" placeholder="{$c('placeholder_id')}" class="w-20" />'))
                ->html(),

            Column::make('Name', 'name')
                ->sortable()
                ->secondaryHeader(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchName" placeholder="{$c('placeholder_name')}" />'))
                ->html(),

            Column::make('Email', 'email')
                ->sortable()
                ->secondaryHeader(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchEmail" placeholder="{$c('placeholder_email')}" />'))
                ->html(),

            Column::make('Created At', 'created_at')
                ->sortable()
                ->secondaryHeader(fn () => Blade::render('<span class="text-xs text-muted-foreground">-</span>'))
                ->html(),
        ];
    }
}
PHP;
                    @endphp
                    <vibe:highlightjs language="php" title="app/Livewire/DemoColumnSearchTable.php" :lineNumbers="true" :code="$colSearchPhpCode" />
                </div>
            </section>

            {{-- Pencarian di Setiap Kolom (Footer) --}}
            <section id="pencarian-kolom-footer" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.footer_column_search.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.footer_column_search.desc') !!}
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="footer-search-preview" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.preview_component') }}</h4>

                    @php
                        $footerSearchComponent = \App\Livewire\DemoFooterColumnSearchTable::class;
                        $footerSearchBladeCode = <<<HTML
{{-- {$c('blade_call_1')} --}}
<vibe:datatable :component="\\App\\Livewire\\DemoFooterColumnSearchTable::class" />
HTML;
                    @endphp
                    <vibe:preview :title="__('docs/datatable.footer_column_search.preview_title')" :center="false" :code="$footerSearchBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$footerSearchComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="footer-search-livewire" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.livewire_component') }}</h4>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/datatable.footer_column_search.livewire_desc') !!}
                    </p>

                    @php
                        $footerSearchPhpCode = <<<PHP
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoFooterColumnSearchTable extends VibeDataTableComponent
{
    public string \$searchId = '';
    public string \$searchName = '';
    public string \$searchEmail = '';

    public string \$tableName = 'footer_col_search_table';

    public function configure(): void
    {
        parent::configure();

        \$this->setPrimaryKey('id')
            ->setFooterStatus(true); // {$c('comment_footer_status')}
    }

    public function builder(): Builder
    {
        return User::query()
            ->when(\$this->searchId, fn (Builder \$q, \$val) => \$q->whereRaw('CAST(id AS TEXT) LIKE ?', ['%' . trim(\$val) . '%']))
            ->when(\$this->searchName, fn (Builder \$q, \$val) => \$q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower(trim(\$val)) . '%']))
            ->when(\$this->searchEmail, fn (Builder \$q, \$val) => \$q->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower(trim(\$val)) . '%']));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->footer(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchId" placeholder="{$c('placeholder_id')}" class="w-20" />'))
                ->html(),

            Column::make('Name', 'name')
                ->sortable()
                ->footer(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchName" placeholder="{$c('placeholder_name')}" />'))
                ->html(),

            Column::make('Email', 'email')
                ->sortable()
                ->footer(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchEmail" placeholder="{$c('placeholder_email')}" />'))
                ->html(),

            Column::make('Created At', 'created_at')
                ->sortable()
                ->footer(fn () => Blade::render('<span class="text-xs text-muted-foreground">-</span>'))
                ->html(),
        ];
    }
}
PHP;
                    @endphp
                    <vibe:highlightjs language="php" title="app/Livewire/DemoFooterColumnSearchTable.php" :lineNumbers="true" :code="$footerSearchPhpCode" />
                </div>
            </section>

            {{-- Filter Popover Kustom --}}
            <section id="filter-popover" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.filters.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.filters.desc') !!}
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="filter-preview" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.preview_component') }}</h4>

                    @php
                        $filterComponent = \App\Livewire\DemoFilterTable::class;
                        $filterBladeCode = <<<HTML
{{-- {$c('blade_call_1')} --}}
<vibe:datatable :component="\\App\\Livewire\\DemoFilterTable::class" />
HTML;
                    @endphp
                    <vibe:preview :title="__('docs/datatable.filters.preview_title')" :center="false" :code="$filterBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$filterComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="filter-livewire" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.livewire_component') }}</h4>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/datatable.filters.livewire_desc') !!}
                    </p>

                    @php
                        $filterPhpCode = <<<PHP
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoFilterTable extends VibeDataTableComponent
{
    public string \$tableName = 'filter_table';

    public function configure(): void
    {
        parent::configure();

        \$this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return User::query();
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Domain Email', 'domain_email')
                ->options([
                    '' => '{$c('filter_all_domains')}',
                    'example.com' => '@example.com',
                    'example.org' => '@example.org',
                    'example.net' => '@example.net',
                ])
                ->filter(function (Builder \$builder, string \$value) {
                    if (\$value) {
                        \$builder->where('email', 'like', '%' . \$value);
                    }
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->sortable(),
            Column::make('Name', 'name')->sortable()->searchable(),
            Column::make('Email', 'email')->sortable()->searchable(),
            Column::make('Created At', 'created_at')->sortable(),
        ];
    }
}
PHP;
                    @endphp
                    <vibe:highlightjs language="php" title="app/Livewire/DemoFilterTable.php" :lineNumbers="true" :code="$filterPhpCode" />
                </div>
            </section>

            {{-- Footer Kolom & Kalkulasi Ringkasan --}}
            <section id="footer-kolom" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.footer_calc.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.footer_calc.desc') !!}
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="footer-preview" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.preview_component') }}</h4>

                    @php
                        $footerComponent = \App\Livewire\DemoFooterTable::class;
                        $footerBladeCode = <<<HTML
{{-- {$c('blade_call_1')} --}}
<vibe:datatable :component="\\App\\Livewire\\DemoFooterTable::class" />
HTML;
                    @endphp
                    <vibe:preview :title="__('docs/datatable.footer_calc.preview_title')" :center="false" :code="$footerBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$footerComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="footer-livewire" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.livewire_component') }}</h4>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/datatable.footer_calc.livewire_desc') !!}
                    </p>

                    @php
                        $footerPhpCode = <<<PHP
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoFooterTable extends VibeDataTableComponent
{
    public string \$tableName = 'footer_table';

    public function configure(): void
    {
        parent::configure();

        \$this->setPrimaryKey('id')
            ->setFooterStatus(true); // {$c('comment_footer_status')}
    }

    public function builder(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->footer(fn (\$rows) => 'Total: ' . \$rows->count()),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Created At', 'created_at')
                ->sortable()
                ->footer(fn () => '-'),
        ];
    }
}
PHP;
                    @endphp
                    <vibe:highlightjs language="php" title="app/Livewire/DemoFooterTable.php" :lineNumbers="true" :code="$footerPhpCode" />
                </div>
            </section>

            {{-- Header Sebagai Footer --}}
            <section id="header-sebagai-footer" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.header_as_footer.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.header_as_footer.desc') !!}
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="header-as-footer-preview" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.preview_component') }}</h4>

                    @php
                        $headerFooterComponent = \App\Livewire\DemoHeaderFooterTable::class;
                        $headerFooterBladeCode = <<<HTML
{{-- {$c('blade_call_1')} --}}
<vibe:datatable :component="\\App\\Livewire\\DemoHeaderFooterTable::class" />
HTML;
                    @endphp
                    <vibe:preview :title="__('docs/datatable.header_as_footer.preview_title')" :center="false" :code="$headerFooterBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$headerFooterComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="header-as-footer-livewire" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.livewire_component') }}</h4>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/datatable.header_as_footer.livewire_desc') !!}
                    </p>

                    @php
                        $headerFooterPhpCode = <<<PHP
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoHeaderFooterTable extends VibeDataTableComponent
{
    public string \$tableName = 'header_footer_table';

    public function configure(): void
    {
        parent::configure();

        \$this->setPrimaryKey('id')
            ->setFooterStatus(true)
            ->setUseHeaderAsFooterStatus(true); // {$c('comment_header_as_footer')}
    }

    public function builder(): Builder
    {
        return User::query()->select(['id', 'name', 'email', 'created_at']);
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->footer(fn (\$rows) => 'Total: ' . \$rows->count() . ' User'),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable()
                ->footer(fn () => 'Summary'),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Created At', 'created_at')
                ->sortable(),
        ];
    }
}
PHP;
                    @endphp
                    <vibe:highlightjs language="php" title="app/Livewire/DemoHeaderFooterTable.php" :lineNumbers="true" :code="$headerFooterPhpCode" />
                </div>
            </section>

            {{-- Performa Dataset Besar --}}
            <section id="performa-dataset-besar" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.performance.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.performance.desc') !!}
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="performance-preview" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.preview_component') }}</h4>

                    @php
                        $perfComponent = \App\Livewire\DemoPerformanceTable::class;
                        $perfBladeCode = <<<HTML
{{-- {$c('blade_call_1')} --}}
<vibe:datatable :component="\\App\\Livewire\\DemoPerformanceTable::class" />
HTML;
                    @endphp
                    <vibe:preview :title="__('docs/datatable.performance.preview_title')" :center="false" :code="$perfBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$perfComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="performance-livewire" class="space-y-3">
                    <h4 class="text-base font-semibold text-foreground">{{ __('docs/datatable.common.livewire_component') }}</h4>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/datatable.performance.livewire_desc') !!}
                    </p>

                    @php
                        $perfPhpCode = <<<PHP
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoPerformanceTable extends VibeDataTableComponent
{
    public string \$tableName = 'perf_table';

    public function configure(): void
    {
        parent::configure();

        \$this->setPrimaryKey('id')
            ->setDefaultSort('id', 'asc')
            ->setPerPageAccepted([25, 50, 100, 250]) // {$c('comment_large_dataset')}
            ->setDefaultPerPage(50)
            ->setSearchDebounce(300)
            ->setFooterStatus(true);
    }

    public function builder(): Builder
    {
        return User::query()->select(['id', 'name', 'email', 'created_at']);
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->footer(fn (\$rows) => 'Halaman: ' . \$rows->count()),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable()
                ->footer(fn () => 'Total: ' . number_format(User::count()) . ' Data'),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Created At', 'created_at')
                ->sortable()
                ->format(fn (\$val) => \$val ? \$val->format('d M Y H:i') : '-'),
        ];
    }
}
PHP;
                    @endphp
                    <vibe:highlightjs language="php" title="app/Livewire/DemoPerformanceTable.php" :lineNumbers="true" :code="$perfPhpCode" />
                </div>
            </section>

            {{-- Referensi Lengkap API & Konfigurasi --}}
            <section id="referensi-api" class="space-y-8">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.api_reference.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/datatable.api_reference.desc') }}
                    </p>
                </div>

                {{-- Metode configure() --}}
                <div id="metode-configure" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/datatable.api_reference.configure_table.title') }}</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/datatable.api_reference.configure_table.method_col') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/datatable.api_reference.configure_table.desc_col') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">parent::configure()</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.configure_table.methods.parent_configure') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setPrimaryKey('id')</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.configure_table.methods.set_primary_key') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setBorderedEnabled()</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.configure_table.methods.set_bordered_enabled') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setDefaultSort('col', 'desc')</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.configure_table.methods.set_default_sort') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setBulkActions([...])</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.configure_table.methods.set_bulk_actions') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setSecondaryHeaderStatus(true)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.configure_table.methods.set_secondary_header_status') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setFooterStatus(true)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.configure_table.methods.set_footer_status') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setUseHeaderAsFooterStatus(true)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.configure_table.methods.set_use_header_as_footer_status') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setSearchDebounce(350)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.configure_table.methods.set_search_debounce') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setPerPageAccepted([10, 25, 50, 100])</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.configure_table.methods.set_per_page_accepted') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setColumnSelectStatus(true)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.configure_table.methods.set_column_select_status') }}</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- Properti Tag <vibe:datatable> --}}
                <div id="properti-tag" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/datatable.api_reference.props_table.title') }}</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/datatable.api_reference.props_table.prop_col') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/datatable.api_reference.props_table.type_col') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/datatable.api_reference.props_table.default_col') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/datatable.api_reference.props_table.desc_col') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">:component</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string|null</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">null</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.props_table.props.component') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">bordered</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">false</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.props_table.props.bordered') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$attributes</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">ComponentAttributeBag</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">[]</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.props_table.props.attributes') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$slot</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">HtmlString|null</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">null</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.api_reference.props_table.props.slot') }}</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
