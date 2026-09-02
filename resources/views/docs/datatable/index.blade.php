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
                    @foreach (['vibe:datatable', 'vibe:button.delete', 'server-side', 'debounced-search', 'per-column-search', 'bulk-actions', 'footer-summary', 'column-filters', 'multi-sort', 'pagination'] as $badge)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $badge }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Artisan Generator --}}
            <section id="generator-artisan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Artisan Generator</h2>
                    <p class="text-sm text-muted-foreground">
                        Buat komponen DataTable siap pakai dalam hitungan detik menggunakan perintah artisan generator bawaan Vibe UI. Generator otomatis menghasilkan class berstandar PSR-4 (StudlyCase) lengkap dengan query Eloquent, kolom, dan tombol aksi:
                    </p>
                </div>

                @php
                    $generatorCommand = <<<'BASH'
# 1. Membuat DataTable dengan model Eloquent terkait
php artisan vibe:table UsersTable --model=User

# 2. Atau menggunakan format kebab/path bersarang
php artisan vibe:table Admin/UserTable --model=User
BASH;
                @endphp
                <vibe:highlightjs language="bash" title="Terminal" :code="$generatorCommand" />
            </section>

            {{-- Cara Memanggil DataTable --}}
            <section id="cara-memanggil-datatable" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Cara Memanggil DataTable</h2>
                    <p class="text-sm text-muted-foreground">
                        Vibe UI menyediakan tag helper <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:datatable&gt;</code> yang deklaratif dan terintegrasi penuh. Anda juga tetap dapat menggunakan tag atau direktif bawaan Livewire.
                    </p>
                </div>

                @php
                    $callSnippets = <<<'HTML'
{{-- OPSI 1: Menggunakan Tag Helper Vibe UI dengan FQCN (Sangat Disarankan) --}}
<vibe:datatable :component="\App\Livewire\DemoBasicTable::class" />

{{-- OPSI 2: Menggunakan Kebab-Case Alias --}}
<vibe:datatable component="demo-basic-table" />

{{-- OPSI 3: Meneruskan Parameter & Props Tambahan ke Komponen Livewire --}}
<vibe:datatable 
    :component="\App\Livewire\DemoBasicTable::class" 
    :role="'admin'" 
    :status="'active'" 
    class="rounded-xl shadow-xs"
/>

{{-- OPSI 4: Sintaks Tag Bawaan Livewire --}}
<livewire:demo-basic-table />

{{-- OPSI 5: Blade Directive @livewire --}}
@livewire(\App\Livewire\DemoBasicTable::class, ['role' => 'admin'])
HTML;
                @endphp
                <vibe:highlightjs language="html" title="resources/views/your-page.blade.php" :lineNumbers="true" :code="$callSnippets" />
            </section>

            {{-- Basic Usage --}}
            <section id="basic-usage" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Basic Usage</h2>
                    <p class="text-sm text-muted-foreground">
                        Implementasi tabel data paling mendasar yang menampilkan pencarian real-time, sorting interaktif per kolom, dan paginasi otomatis.
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="basic-usage-preview" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Preview</h3>

                    @php
                        $basicComponent = \App\Livewire\DemoBasicTable::class;
                        $basicBladeCode = <<<'HTML'
{{-- Cara Pemanggilan di Blade --}}
<vibe:datatable :component="\App\Livewire\DemoBasicTable::class" />

{{-- Atau dengan tag Livewire --}}
<livewire:demo-basic-table />
HTML;
                    @endphp
                    <vibe:preview title="Preview: Basic DataTable" :center="false" :code="$basicBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$basicComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="basic-usage-livewire" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Livewire</h3>
                    <p class="text-xs text-muted-foreground">
                        Kode PHP class lengkap yang meng-extend <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">VibeDataTableComponent</code> dengan 3 pilar utama: <code class="font-mono text-xs">configure()</code>, <code class="font-mono text-xs">builder()</code>, dan <code class="font-mono text-xs">columns()</code>.
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
    public function configure(): void
    {
        parent::configure();

        // Menentukan Primary Key unik model untuk identifikasi baris
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        // Mengembalikan query builder Eloquent untuk sumber data tabel
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
                    <h2 class="text-xl font-bold text-foreground">Bordered Table</h2>
                    <p class="text-sm text-muted-foreground">
                        Menampilkan garis batas pembatas (borders) vertikal dan horizontal pada setiap sel header (<code class="font-mono text-xs">&lt;th&gt;</code>) dan data (<code class="font-mono text-xs">&lt;td&gt;</code>). Dapat diaktifkan secara instan cukup dengan menambahkan <code class="font-mono text-xs">class="border"</code> atau atribut <code class="font-mono text-xs">bordered</code> pada tag Blade, maupun melalui method <code class="font-mono text-xs">$this-&gt;setBorderedEnabled()</code> di PHP class.
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="bordered-preview" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Preview</h3>

                    @php
                        $borderedComponent = \App\Livewire\DemoBorderedTable::class;
                        $borderedBladeCode = <<<'HTML'
{{-- Cara 1: Menggunakan Class Utility (Sangat Praktis & Bersih) --}}
<vibe:datatable :component="\App\Livewire\DemoBasicTable::class" class="border" />

{{-- Cara 2: Menggunakan Atribut Boolean 'bordered' --}}
<vibe:datatable :component="\App\Livewire\DemoBasicTable::class" bordered />

{{-- Cara 3: Menggunakan Komponen dengan Konfigurasi PHP Class --}}
<vibe:datatable :component="\App\Livewire\DemoBorderedTable::class" />
HTML;
                    @endphp
                    <vibe:preview title="Preview: Bordered DataTable" :center="false" :code="$borderedBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$borderedComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="bordered-livewire" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Livewire</h3>
                    <p class="text-xs text-muted-foreground">
                        Kode PHP class lengkap menggunakan method <code class="font-mono text-xs">setBorderedEnabled()</code> atau <code class="font-mono text-xs">setBorderedStatus(true)</code> di dalam <code class="font-mono text-xs">configure()</code>.
                    </p>

                    @php
                        $borderedPhpCode = <<<'PHP'
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoBorderedTable extends VibeDataTableComponent
{
    public string $tableName = 'bordered_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setBorderedEnabled(); // Mengaktifkan border penuh pada setiap baris & kolom
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
                    <h2 class="text-xl font-bold text-foreground">Kustomisasi Kolom & Tombol Aksi</h2>
                    <p class="text-sm text-muted-foreground">
                        Menambahkan format badge status dan tombol aksi ikon menggunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button.group&gt;</code> serta komponen khusus <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button.delete&gt;</code> yang otomatis memicu dialog konfirmasi <code class="font-mono text-xs text-foreground">vibeAlert</code>.
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="kolom-preview" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Preview</h3>

                    @php
                        $actionsComponent = \App\Livewire\DemoActionsTable::class;
                        $actionsBladeCode = <<<'HTML'
{{-- Cara Pemanggilan di Blade --}}
<vibe:datatable :component="\App\Livewire\DemoActionsTable::class" />
HTML;
                    @endphp
                    <vibe:preview title="Preview: Kolom Kustom & Aksi Ikon" :center="false" :code="$actionsBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$actionsComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="kolom-livewire" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Livewire</h3>
                    <p class="text-xs text-muted-foreground">
                        Kode PHP lengkap dengan format badge HTML dan integrasi komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button.delete&gt;</code>.
                    </p>

                    @php
                        $actionsPhpCode = <<<'PHP'
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

        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'asc');
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

            // Kolom Status dengan formatting Badge Vibe UI
            Column::make('Status')
                ->label(fn ($row) => $row->id % 2 === 0
                    ? '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 border border-emerald-500/20">Active</span>'
                    : '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground border border-border">Inactive</span>'
                )
                ->html(),

            // Kolom Actions dengan Vibe Button Group & vibe:button.delete
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

    public function edit($id): void
    {
        $this->dispatch('alert', [
            'type' => 'info',
            'title' => 'Edit User',
            'message' => "Edit data user ID #{$id}.",
        ]);
    }

    public function delete($id): void
    {
        // Method ini otomatis dipanggil HANYA setelah user mengonfirmasi di dialog modal vibeAlert
        $this->dispatch('toast', [
            'type' => 'success',
            'title' => 'Berhasil Dihapus',
            'message' => "Data user ID #{$id} telah berhasil dihapus.",
        ]);
    }
}
PHP;
                    @endphp
                    <vibe:highlightjs language="php" title="app/Livewire/DemoActionsTable.php" :lineNumbers="true" :code="$actionsPhpCode" />
                </div>
            </section>

            {{-- Aksi Massal --}}
            <section id="aksi-massal" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Aksi Massal (Bulk Actions)</h2>
                    <p class="text-sm text-muted-foreground">
                        Mengaktifkan fitur seleksi baris (checkbox baris, pilih halaman ini, dan pilih seluruh data lintas halaman) untuk mengeksekusi operasi secara massal seperti ekspor CSV atau penghapusan data.
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="bulk-preview" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Preview</h3>

                    @php
                        $bulkComponent = \App\Livewire\DemoBulkTable::class;
                        $bulkBladeCode = <<<'HTML'
{{-- Cara Pemanggilan di Blade --}}
<vibe:datatable :component="\App\Livewire\DemoBulkTable::class" />
HTML;
                    @endphp
                    <vibe:preview title="Preview: Aksi Massal (Bulk Actions)" :center="false" :code="$bulkBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$bulkComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="bulk-livewire" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Livewire</h3>
                    <p class="text-xs text-muted-foreground">
                        Kode PHP lengkap dengan konfigurasi <code class="font-mono text-xs">setBulkActions()</code>, pemrosesan array kunci dengan <code class="font-mono text-xs">$this-&gt;getSelected()</code>, dan pembersihan centang via <code class="font-mono text-xs">$this-&gt;clearSelected()</code>.
                    </p>

                    @php
                        $bulkPhpCode = <<<'PHP'
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoBulkTable extends VibeDataTableComponent
{
    public string $tableName = 'bulk_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'asc')
            ->setHideBulkActionsWhenEmptyStatus(false)
            ->setBulkActions([
                'exportSelected' => 'Ekspor CSV',
                'deleteSelected' => 'Hapus Terpilih',
            ]);
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

    public function exportSelected(): void
    {
        $selectedKeys = $this->getSelected(); // Array ID yang dicentang
        $count = count($selectedKeys);

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Ekspor Berhasil',
            'message' => "{$count} data terpilih telah berhasil diekspor.",
        ]);

        $this->clearSelected(); // Menghapus centang seleksi
    }

    public function deleteSelected(): void
    {
        $selectedKeys = $this->getSelected();
        $count = count($selectedKeys);

        // User::whereIn('id', $selectedKeys)->delete();

        $this->dispatch('toast', [
            'type' => 'success',
            'title' => 'Hapus Massal Berhasil',
            'message' => "{$count} data terpilih telah berhasil dihapus.",
        ]);

        $this->clearSelected();
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
                    <h2 class="text-xl font-bold text-foreground">Pencarian di Setiap Kolom</h2>
                    <p class="text-sm text-muted-foreground">
                        Memasang input pencarian langsung di bawah judul masing-masing kolom menggunakan fitur <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">secondaryHeader</code>, memungkinkan pengguna memfilter baris berdasarkan kolom ID, nama, atau email secara independen.
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="column-search-preview" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Preview</h3>

                    @php
                        $colSearchComponent = \App\Livewire\DemoColumnSearchTable::class;
                        $colSearchBladeCode = <<<'HTML'
{{-- Cara Pemanggilan di Blade --}}
<vibe:datatable :component="\App\Livewire\DemoColumnSearchTable::class" />
HTML;
                    @endphp
                    <vibe:preview title="Preview: Pencarian di Setiap Kolom" :center="false" :code="$colSearchBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$colSearchComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="column-search-livewire" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Livewire</h3>
                    <p class="text-xs text-muted-foreground">
                        Kode PHP lengkap dengan public properties terikat, pengaktifan <code class="font-mono text-xs">setSecondaryHeaderStatus(true)</code>, dan query bersyarat <code class="font-mono text-xs">when()</code>.
                    </p>

                    @php
                        $colSearchPhpCode = <<<'PHP'
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoColumnSearchTable extends VibeDataTableComponent
{
    public string $searchId = '';
    public string $searchName = '';
    public string $searchEmail = '';

    public string $tableName = 'col_search_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'asc')
            ->setSecondaryHeaderStatus(true); // Mengaktifkan baris header sekunder
    }

    public function builder(): Builder
    {
        return User::query()
            ->when($this->searchId, fn (Builder $q, $val) => $q->whereRaw('CAST(id AS TEXT) LIKE ?', ['%' . trim($val) . '%']))
            ->when($this->searchName, fn (Builder $q, $val) => $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower(trim($val)) . '%']))
            ->when($this->searchEmail, fn (Builder $q, $val) => $q->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower(trim($val)) . '%']));
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
}
PHP;
                    @endphp
                    <vibe:highlightjs language="php" title="app/Livewire/DemoColumnSearchTable.php" :lineNumbers="true" :code="$colSearchPhpCode" />
                </div>
            </section>

            {{-- Pencarian di Setiap Kolom (Footer) --}}
            <section id="pencarian-kolom-footer" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Pencarian di Setiap Kolom (Footer)</h2>
                    <p class="text-sm text-muted-foreground">
                        Menempatkan input pencarian per kolom di bagian bawah tabel (<code class="font-mono text-xs">&lt;tfoot&gt;</code>) alih-alih di bawah header. Cocok untuk tabel dengan data banyak di mana pengguna ingin menyaring data dari dasar tabel menggunakan fitur <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">-&gt;footer(...)</code> dan <code class="font-mono text-xs">$this-&gt;setFooterStatus(true)</code>.
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="footer-search-preview" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Preview</h3>

                    @php
                        $footerSearchComponent = \App\Livewire\DemoFooterColumnSearchTable::class;
                        $footerSearchBladeCode = <<<'HTML'
{{-- Cara Pemanggilan di Blade --}}
<vibe:datatable :component="\App\Livewire\DemoFooterColumnSearchTable::class" />
HTML;
                    @endphp
                    <vibe:preview title="Preview: Pencarian di Setiap Kolom (Footer)" :center="false" :code="$footerSearchBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$footerSearchComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="footer-search-livewire" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Livewire</h3>
                    <p class="text-xs text-muted-foreground">
                        Kode PHP lengkap dengan pemanggilan <code class="font-mono text-xs">setFooterStatus(true)</code> di dalam <code class="font-mono text-xs">configure()</code> dan closure <code class="font-mono text-xs">-&gt;footer(...)</code> pada definisi setiap kolom.
                    </p>

                    @php
                        $footerSearchPhpCode = <<<'PHP'
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoFooterColumnSearchTable extends VibeDataTableComponent
{
    public string $searchId = '';
    public string $searchName = '';
    public string $searchEmail = '';

    public string $tableName = 'footer_col_search_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setFooterStatus(true); // Mengaktifkan baris footer tabel
    }

    public function builder(): Builder
    {
        return User::query()
            ->when($this->searchId, fn (Builder $q, $val) => $q->whereRaw('CAST(id AS TEXT) LIKE ?', ['%' . trim($val) . '%']))
            ->when($this->searchName, fn (Builder $q, $val) => $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower(trim($val)) . '%']))
            ->when($this->searchEmail, fn (Builder $q, $val) => $q->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower(trim($val)) . '%']));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->footer(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchId" placeholder="ID..." class="w-20" />'))
                ->html(),

            Column::make('Name', 'name')
                ->sortable()
                ->footer(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchName" placeholder="Cari nama..." />'))
                ->html(),

            Column::make('Email', 'email')
                ->sortable()
                ->footer(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchEmail" placeholder="Cari email..." />'))
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
                    <h2 class="text-xl font-bold text-foreground">Filter Popover Kustom</h2>
                    <p class="text-sm text-muted-foreground">
                        Menambahkan tombol popover filter di toolbar atas tabel untuk memfilter data dengan dropdown kriteria tertentu (misalnya domain email atau rentang tanggal).
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="filter-preview" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Preview</h3>

                    @php
                        $filterComponent = \App\Livewire\DemoFilterTable::class;
                        $filterBladeCode = <<<'HTML'
{{-- Cara Pemanggilan di Blade --}}
<vibe:datatable :component="\App\Livewire\DemoFilterTable::class" />
HTML;
                    @endphp
                    <vibe:preview title="Preview: Filter Popover" :center="false" :code="$filterBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$filterComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="filter-livewire" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Livewire</h3>
                    <p class="text-xs text-muted-foreground">
                        Kode PHP lengkap dengan implementasi method <code class="font-mono text-xs">filters()</code> menggunakan <code class="font-mono text-xs">SelectFilter</code> bawaan engine tabel.
                    </p>

                    @php
                        $filterPhpCode = <<<'PHP'
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoFilterTable extends VibeDataTableComponent
{
    public string $tableName = 'filter_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'asc');
    }

    public function builder(): Builder
    {
        return User::query();
    }

    public function filters(): array
    {
        return [
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
        ];
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
                    <vibe:highlightjs language="php" title="app/Livewire/DemoFilterTable.php" :lineNumbers="true" :code="$filterPhpCode" />
                </div>
            </section>

            {{-- Footer Kolom & Ringkasan Agregasi --}}
            <section id="footer-kolom" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Footer Kolom & Ringkasan Agregasi</h2>
                    <p class="text-sm text-muted-foreground">
                        Menampilkan baris ringkasan di bagian bawah tabel untuk menyajikan kalkulasi agregasi (seperti total count, sum), dengan styling visual yang identik dengan header (<code class="font-mono text-xs">bg-muted/40 uppercase tracking-wider</code>), serta opsi menampilkan kembali judul header kolom di bagian bawah via <code class="font-mono text-xs">setUseHeaderAsFooterStatus(true)</code>.
                    </p>
                </div>

                {{-- Komponen Preview --}}
                <div id="footer-preview" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Preview</h3>

                    @php
                        $footerComponent = \App\Livewire\DemoFooterTable::class;
                        $footerBladeCode = <<<'HTML'
{{-- Cara Pemanggilan di Blade --}}
<vibe:datatable :component="\App\Livewire\DemoFooterTable::class" />
HTML;
                    @endphp
                    <vibe:preview title="Preview: Footer Kolom & Ringkasan" :center="false" :code="$footerBladeCode">
                        <div class="w-full">
                            <vibe:datatable :component="$footerComponent" />
                        </div>
                    </vibe:preview>
                </div>

                {{-- Komponen Livewire --}}
                <div id="footer-livewire" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Komponen Livewire</h3>
                    <p class="text-xs text-muted-foreground">
                        Kode PHP lengkap dengan pengaktifan <code class="font-mono text-xs">setFooterStatus(true)</code>, <code class="font-mono text-xs">setUseHeaderAsFooterStatus(true)</code>, dan closure kalkulasi <code class="font-mono text-xs">footer(fn ($rows) =&gt; ...)</code>.
                    </p>

                    @php
                        $footerPhpCode = <<<'PHP'
namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoFooterTable extends VibeDataTableComponent
{
    public string $tableName = 'footer_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'asc')
            ->setFooterStatus(true) // Mengaktifkan baris footer di bagian bawah tabel
            ->setUseHeaderAsFooterStatus(true); // Menampilkan header kolom juga sebagai footer
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
                ->footer(fn ($rows) => 'Total: ' . $rows->count() . ' User'),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable()
                ->footer(fn () => 'Ringkasan Halaman'),

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
                    <vibe:highlightjs language="php" title="app/Livewire/DemoFooterTable.php" :lineNumbers="true" :code="$footerPhpCode" />
                </div>
            </section>

            {{-- Referensi Lengkap API & Konfigurasi --}}
            <section id="referensi-api" class="space-y-8">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Referensi Lengkap API & Konfigurasi</h2>
                    <p class="text-sm text-muted-foreground">
                        Daftar lengkap metode konfigurasi, properti tag helper, dan fungsi kolom yang didukung oleh Vibe UI DataTable.
                    </p>
                </div>

                {{-- Daftar Metode configure() --}}
                <div id="metode-configure" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Daftar Metode configure()</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">Metode</vibe:table.column>
                            <vibe:table.column>Fungsi & Kegunaan</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setPrimaryKey('id')</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Menentukan primary key unik model untuk seleksi baris dan identifikasi data.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setBorderedEnabled()</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Mengaktifkan garis batas pembatas (border) vertikal dan horizontal pada setiap sel tabel.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setDefaultSort('col', 'desc')</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Menetapkan kolom dan arah pengurutan bawaan saat pertama kali dimuat.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setBulkActions([...])</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Mendefinisikan aksi massal checkbox baris (seperti export CSV atau hapus terpilih).</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setSecondaryHeaderStatus(true)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Mengaktifkan baris header sekunder tepat di bawah judul kolom untuk input pencarian per kolom.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setFooterStatus(true)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Mengaktifkan baris footer di bagian bawah tabel untuk agregasi / total baris.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setUseHeaderAsFooterStatus(true)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Menjadikan dan menampilkan baris judul header kolom juga sebagai footer di bagian bawah tabel.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setSearchDebounce(350)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Mengatur jeda waktu (dalam milidetik) penundaan query pencarian live agar hemat server.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setPerPageAccepted([10, 25, 50, 100])</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Daftar opsi jumlah data per halaman yang tersedia pada dropdown paginasi.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$this-&gt;setColumnSelectStatus(true)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Mengaktifkan tombol selector untuk menyembunyikan atau menampilkan kolom secara dinamis.</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- Properti Tag <vibe:datatable> --}}
                <div id="properti-tag" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Properti Tag Helper &lt;vibe:datatable&gt;</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">Properti</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">Tipe</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">Default</vibe:table.column>
                            <vibe:table.column>Deskripsi</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">:component</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string|null</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">null</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Nama class FQCN (misal <code class="font-mono text-xs">App\Livewire\DemoBasicTable::class</code>) atau alias kebab-case Livewire.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">bordered</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">false</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Mengaktifkan garis batas pembatas (border) penuh di sekeliling setiap sel header dan baris data tabel langsung dari Blade.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$attributes</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">ComponentAttributeBag</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">[]</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Semua atribut tambahan akan otomatis diteruskan (forwarded) ke komponen Livewire.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">$slot</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">HtmlString|null</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">null</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Konten slot alternatif jika komponen digunakan sebagai pembungkus layout tabel kustom.</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- Metode Column --}}
                <div id="metode-column" class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">Daftar Metode Kolom (Column)</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">Metode</vibe:table.column>
                            <vibe:table.column>Deskripsi</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">Column::make('Judul', 'field')</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Membuat definisi kolom dengan label judul dan mapping nama atribut/kolom database.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">-&gt;sortable()</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Mengaktifkan tombol panah pengurutan interaktif (ASC/DESC) pada header kolom.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">-&gt;searchable()</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Menyertakan kolom ini ke dalam lingkup pencarian global search bar.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">-&gt;format(fn ($val) =&gt; ...)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Mengubah nilai tampilan kolom, menerima parameter nilai sel asli.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">-&gt;label(fn ($row) =&gt; ...)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Merender konten kustom baris secara utuh dengan akses ke seluruh objek <code class="font-mono text-xs">$row</code>.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">-&gt;html()</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Memberitahu engine bahwa output dari format atau label adalah HTML mentah agar tidak di-escape.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">-&gt;secondaryHeader(fn () =&gt; ...)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Menentukan konten yang dirender di baris header sekunder untuk kolom tersebut.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">-&gt;footer(fn ($rows) =&gt; ...)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">Menentukan kalkulasi atau teks agregasi di bagian baris footer tabel.</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

            {{-- Keunggulan Fitur & Arsitektur Enterprise --}}
            <section id="fitur-unggulan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Keunggulan Fitur & Arsitektur Enterprise</h2>
                    <p class="text-sm text-muted-foreground">
                        Mengapa Vibe UI DataTable menjadi pilihan ideal untuk aplikasi web berskala enterprise:
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
