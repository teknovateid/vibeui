<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/datatable.title')" :description="__('docs/datatable.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/datatable.title'), 'url' => '/docs/datatable']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Hero Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary/10 text-primary border border-primary/20">{{ __('docs/datatable.badge') }}</span>
                    <span class="text-xs text-muted-foreground">{{ __('docs/datatable.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/datatable.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/datatable.description') }}
                </p>

                {{-- Feature Badges --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['vibe:datatable', 'server-side', 'debounced-search', 'per-column-search', 'bulk-actions', 'footer-summary', 'column-filters', 'multi-sort', 'pagination'] as $badge)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $badge }}</span>
                    @endforeach
                </div>
            </div>

            {{-- 1. Installation & Generator --}}
            <section id="instalasi-dan-generator" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.generator.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/datatable.generator.desc') }}
                    </p>
                </div>

                @php
                    $generatorCommand = 'php artisan vibe:table UsersTable --model=User';
                @endphp
                <vibe:highlightjs language="bash" title="Terminal" :code="$generatorCommand" />
            </section>

            {{-- 2. Preview 1: Basic DataTable --}}
            <section id="preview-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.basic_usage.preview_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.basic_usage.desc') !!}
                    </p>
                </div>

                @php
                    $basicComponent = \App\Livewire\DemoBasicTable::class;
                    $basicSnippet = <<<'HTML'
{{-- 1. Menggunakan Tag Helper Vibe UI --}}
<vibe:datatable :component="\App\Livewire\UsersTable::class" />

{{-- 2. Atau menggunakan tag bawaan Livewire --}}
<livewire:users-table />
HTML;
                @endphp
                <vibe:preview :title="__('docs/datatable.basic_usage.preview_title')" :center="false" :code="$basicSnippet">
                    <div class="w-full">
                        <vibe:datatable :component="$basicComponent" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Tag Helper <vibe:datatable> --}}
            <section id="tag-vibe-datatable" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.tag_helper.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.tag_helper.desc') !!}
                    </p>
                </div>

                @php
                    $vibeTagExamples = <<<'HTML'
{{-- 1. Menggunakan FQCN Class --}}
<vibe:datatable :component="\App\Livewire\UsersTable::class" />

{{-- 2. Menggunakan Kebab-case Alias --}}
<vibe:datatable component="users-table" />

{{-- 3. Meneruskan Parameter & Filter ke Komponen Livewire --}}
<vibe:datatable 
    :component="\App\Livewire\UsersTable::class" 
    :role="'admin'" 
    :status="'active'" 
/>

{{-- 4. Sebagai Pembungkus (Wrapper) Kontainer Tabel Kustom --}}
<vibe:datatable class="border-dashed">
    {{-- Konten tabel atau komponen custom Anda --}}
</vibe:datatable>
HTML;
                @endphp
                <vibe:highlightjs language="html" title="Contoh Penggunaan vibe:datatable" :lineNumbers="true" :code="$vibeTagExamples" />
            </section>

            {{-- 4. PHP Component Architecture --}}
            <section id="arsitektur-komponen" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        Contoh struktur kode PHP pada komponen Livewire DataTable yang meng-extend <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">VibeDataTableComponent</code>:
                    </p>
                </div>

                @php
                    $phpComponentCode = <<<'PHP'
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class UsersTable extends VibeDataTableComponent
{
    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'desc');
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
                <vibe:highlightjs language="php" title="app/Livewire/UsersTable.php" :lineNumbers="true" :code="$phpComponentCode" />
            </section>

            {{-- 5. Preview 2: Bulk Actions (Aksi Massal) --}}
            <section id="aksi-massal" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.bulk_actions.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/datatable.bulk_actions.desc') }}
                    </p>
                </div>

                @php
                    $bulkComponent = \App\Livewire\DemoBulkTable::class;
                    $bulkActionCode = <<<'PHP'
public function configure(): void
{
    parent::configure();

    $this->setPrimaryKey('id')
        ->setBulkActions([
            'exportSelected' => 'Ekspor CSV',
            'deleteSelected' => 'Hapus Terpilih',
        ]);
}

// Handler aksi ekspor terpilih
public function exportSelected(): void
{
    $selectedKeys = $this->getSelected(); // Mendapatkan array ID baris terpilih
    // Lakukan proses ekspor...
    $this->clearSelected(); // Bersihkan centang seleksi
}

// Handler aksi hapus massal
public function deleteSelected(): void
{
    $selectedKeys = $this->getSelected();
    User::whereIn('id', $selectedKeys)->delete();
    $this->clearSelected();
}
PHP;
                @endphp
                <vibe:preview :title="__('docs/datatable.bulk_actions.preview_title')" :center="false" :code="$bulkActionCode">
                    <div class="w-full">
                        <vibe:datatable :component="$bulkComponent" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Preview 3: Pencarian di Setiap Kolom (Per-Column Search) --}}
            <section id="pencarian-setiap-kolom" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.column_search.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/datatable.column_search.desc') }}
                    </p>
                </div>

                @php
                    $colSearchComponent = \App\Livewire\DemoColumnSearchTable::class;
                    $colSearchCode = <<<'PHP'
public string $searchId = '';
public string $searchName = '';
public string $searchEmail = '';

public function configure(): void
{
    parent::configure();

    $this->setPrimaryKey('id')
        ->setDefaultSort('id', 'asc')
        ->setSecondaryHeaderStatus(true); // Aktifkan header sekunder
}

public function builder(): Builder
{
    return User::query()
        ->when($this->searchId, fn ($q, $val) => $q->whereRaw('CAST(id AS TEXT) LIKE ?', ['%' . trim($val) . '%']))
        ->when($this->searchName, fn ($q, $val) => $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower(trim($val)) . '%']))
        ->when($this->searchEmail, fn ($q, $val) => $q->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower(trim($val)) . '%']));
}

public function columns(): array
{
    return [
        Column::make('ID', 'id')
            ->sortable()
            ->secondaryHeader(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchId" placeholder="ID..." class="w-20" />'))
            ->html(),

        Column::make('Name', 'name')
            ->sortable()
            ->secondaryHeader(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchName" placeholder="Cari nama..." />'))
            ->html(),

        Column::make('Email', 'email')
            ->sortable()
            ->secondaryHeader(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchEmail" placeholder="Cari email..." />'))
            ->html(),

        Column::make('Created At', 'created_at')
            ->sortable()
            ->secondaryHeader(fn () => Blade::render('<span class="text-xs text-muted-foreground">-</span>'))
            ->html(),
    ];
}
PHP;
                @endphp
                <vibe:preview :title="__('docs/datatable.column_search.preview_title')" :center="false" :code="$colSearchCode">
                    <div class="w-full">
                        <vibe:datatable :component="$colSearchComponent" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Preview 4: Filter Popover Kustom --}}
            <section id="filter-popover" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.filters_section.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/datatable.filters_section.desc') }}
                    </p>
                </div>

                @php
                    $filterComponent = \App\Livewire\DemoFilterTable::class;
                    $filterExampleCode = <<<'PHP'
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

public function filters(): array
{
    return [
        // Filter dropdown select
        SelectFilter::make('Domain Email')
            ->options([
                '' => 'Semua Domain',
                'example.com' => '@example.com',
                'test.com' => '@test.com',
            ])
            ->filter(function (Builder $builder, string $value) {
                if (! empty($value)) {
                    $builder->where('email', 'like', '%' . $value);
                }
            }),

        // Filter rentang tanggal
        DateFilter::make('Dibuat Sejak')
            ->filter(function (Builder $builder, string $value) {
                $builder->where('created_at', '>=', $value);
            }),
    ];
}
PHP;
                @endphp
                <vibe:preview :title="__('docs/datatable.filters_section.preview_title')" :center="false" :code="$filterExampleCode">
                    <div class="w-full">
                        <vibe:datatable :component="$filterComponent" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Preview 5: Footer Kolom & Ringkasan (Aggregations) --}}
            <section id="footer-kolom" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.footer_section.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/datatable.footer_section.desc') }}
                    </p>
                </div>

                @php
                    $footerComponent = \App\Livewire\DemoFooterTable::class;
                    $footerExampleCode = <<<'PHP'
public function configure(): void
{
    parent::configure();

    // 1. Aktifkan baris footer tabel
    $this->setFooterStatus(true);
}

public function columns(): array
{
    return [
        // 2. Berikan fungsi kalkulasi footer pada kolom yang diinginkan
        Column::make('ID', 'id')
            ->sortable()
            ->footer(fn ($rows) => 'Total Record: ' . $rows->count()),

        Column::make('Name', 'name')
            ->sortable()
            ->footer(fn () => 'Ringkasan Baris'),

        Column::make('Total Transaksi', 'amount')
            ->footer(fn ($rows) => 'Rp ' . number_format($rows->sum('amount'), 0, ',', '.')),
    ];
}
PHP;
                @endphp
                <vibe:preview :title="__('docs/datatable.footer_section.preview_title')" :center="false" :code="$footerExampleCode">
                    <div class="w-full">
                        <vibe:datatable :component="$footerComponent" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 9. Preview 6: Custom Column Formatting & Actions --}}
            <section id="kustomisasi-kolom" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.columns.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.columns.desc') !!}
                    </p>
                </div>

                @php
                    $actionsComponent = \App\Livewire\DemoActionsTable::class;
                    $columnCustomCode = <<<'PHP'
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Facades\Blade;

public function columns(): array
{
    return [
        Column::make('ID', 'id')
            ->sortable(),

        Column::make('Name', 'name')
            ->sortable()
            ->searchable(),

        // Format kolom dengan Badge status Vibe UI
        Column::make('Status', 'status')
            ->format(fn ($value) => match($value) {
                'active' => '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 border border-emerald-500/20">Active</span>',
                default => '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground border border-border">Inactive</span>',
            })
            ->html(),

        // Kolom Aksi dengan Vibe Button Group Transparan & Ikon Ringkas
        Column::make('Actions')
            ->label(fn ($row) => Blade::render('
                <vibe:button.group variant="ghost">
                    <vibe:button size="icon-xs" variant="ghost" class="text-muted-foreground hover:text-foreground" title="Edit" wire:click="edit({{ $row->id }})">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                    </vibe:button>
                    <vibe:button size="icon-xs" variant="ghost" class="text-destructive/80 hover:text-destructive hover:bg-destructive/10" title="Delete" wire:click="delete({{ $row->id }})">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    </vibe:button>
                </vibe:button.group>
            ', ['row' => $row]))
            ->html(),
    ];
}
PHP;
                @endphp
                <vibe:preview :title="__('docs/datatable.columns.preview_title')" :center="false" :code="$columnCustomCode">
                    <div class="w-full">
                        <vibe:datatable :component="$actionsComponent" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 10. Configuration Methods Reference --}}
            <section id="metode-konfigurasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.configuration.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.configuration.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/datatable.configuration.columns.method') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/datatable.configuration.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setPrimaryKey('id')</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Menentukan primary key unik model untuk seleksi baris dan operasi tabel.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setDefaultSort('col', 'desc')</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Menetapkan kolom dan arah pengurutan bawaan saat pertama kali dimuat.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setBulkActions([...])</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Mendefinisikan aksi massal checkbox baris (seperti export CSV atau hapus massal).</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setSecondaryHeaderStatus(true)</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Mengaktifkan baris header sekunder tepat di bawah label judul kolom untuk input pencarian per kolom.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setFooterStatus(true)</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Mengaktifkan baris footer di bagian bawah tabel untuk total / agregasi.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setSearchDebounce(350)</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Mengatur jeda waktu (dalam milidetik) penundaan query pencarian live.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setPerPageAccepted([10, 25, 50])</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Daftar opsi jumlah data per halaman yang tersedia di dropdown paginasi.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setColumnSelectStatus(true)</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Mengaktifkan tombol selector untuk menyembunyikan/menampilkan kolom secara dinamis.</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>
            </section>

            {{-- 11. <vibe:datatable> Props Reference --}}
            <section id="properti-komponen" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/datatable.props.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/datatable.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/datatable.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/datatable.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/datatable.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">:component</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string|null</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">null</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.props.items.component') }}</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$attributes</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">ComponentAttributeBag</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">[]</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.props.items.attributes') }}</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$slot</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">HtmlString|null</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">null</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">{{ __('docs/datatable.props.items.slot') }}</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>
            </section>

            {{-- 12. Key Features --}}
            <section id="fitur-unggulan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/datatable.features_section.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/datatable.features_section.desc') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach (['server_perf', 'theme_native', 'livewire_reactive', 'column_visibility'] as $key)
                        <div class="p-4 rounded-xl border border-border bg-card space-y-1.5 shadow-2xs">
                            <h3 class="font-semibold text-sm text-foreground flex items-center gap-2">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-primary/10 text-primary text-xs">✓</span>
                                {{ __('docs/datatable.features_section.items.' . $key . '.title') }}
                            </h3>
                            <p class="text-xs text-muted-foreground leading-relaxed">
                                {{ __('docs/datatable.features_section.items.' . $key . '.desc') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
