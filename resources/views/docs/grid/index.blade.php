<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/grid.title')" :description="__('docs/grid.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/grid.title'), 'url' => '/docs/grid']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/grid.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/grid.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/grid.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/grid.description') }}
                </p>

                {{-- Quick Subcomponents Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:grid&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:grid.toolbar&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:grid.card&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:grid.item&gt;</vibe:badge>
                </div>
            </div>

            {{-- 1. Full Interactive Showcase --}}
            <section id="demo-interaktif" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/grid.showcase.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/grid.showcase.desc') !!}
                    </p>
                </div>

                <div class="p-3.5 rounded-xl border border-primary/20 bg-primary/5 text-xs text-foreground flex items-center gap-3">
                    <svg class="size-5 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    <span>{{ __('docs/grid.showcase.hint') }}</span>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/grid.showcase.preview_title')">
                    <vibe:preview.code>
                        <vibe:grid id="dashboard-showcase" :persist="true" :resizable="true" :reorderable="true">
                            <vibe:grid.toolbar title="{{ __('docs/grid.showcase.toolbar_title') }}" description="{{ __('docs/grid.showcase.toolbar_desc') }}" />

                            {{-- Kartu Metrik 1 (col-span-4) --}}
                            <vibe:grid.card id="metric-revenue" title="Total Pendapatan" description="Bulan berjalan" :colSpan="4">
                                <div class="space-y-2">
                                    <div class="flex items-baseline justify-between">
                                        <span class="text-2xl sm:text-3xl font-bold text-foreground">Rp 128.450.000</span>
                                        <vibe:badge variant="success" size="sm" class="font-medium">
                                            +14.2%
                                        </vibe:badge>
                                    </div>
                                    <p class="text-xs text-muted-foreground">Meningkat Rp 16.200.000 dibanding bulan lalu</p>
                                </div>
                            </vibe:grid.card>

                            {{-- Kartu Metrik 2 (col-span-4) --}}
                            <vibe:grid.card id="metric-users" title="Pengguna Aktif" description="Sesi 24 jam terakhir" :colSpan="4">
                                <div class="space-y-2">
                                    <div class="flex items-baseline justify-between">
                                        <span class="text-2xl sm:text-3xl font-bold text-foreground">8.942</span>
                                        <vibe:badge variant="outline" size="sm" class="bg-sky-500/10 text-sky-600 border-sky-500/20 font-medium">
                                            +8.5%
                                        </vibe:badge>
                                    </div>
                                    <p class="text-xs text-muted-foreground">1.240 pengguna baru mendaftar pekan ini</p>
                                </div>
                            </vibe:grid.card>

                            {{-- Kartu Metrik 3 (col-span-4) --}}
                            <vibe:grid.card id="metric-conversion" title="Konversi Penjualan" description="Tingkat checkout" :colSpan="4">
                                <div class="space-y-2">
                                    <div class="flex items-baseline justify-between">
                                        <span class="text-2xl sm:text-3xl font-bold text-foreground">4.82%</span>
                                        <vibe:badge variant="outline" size="sm" class="bg-indigo-500/10 text-indigo-600 border-indigo-500/20 font-medium">
                                            Stabil
                                        </vibe:badge>
                                    </div>
                                    <p class="text-xs text-muted-foreground">Target triwulan 5.0% tercapai 96.4%</p>
                                </div>
                            </vibe:grid.card>

                            {{-- Kartu Grafik Analytics (col-span-8) --}}
                            <vibe:grid.card id="widget-analytics" title="Tren Penjualan & Performa" description="Grafik volume transaksi per bulan" :colSpan="8">
                                <div class="h-44 w-full flex items-end gap-3 pt-4 px-2 pb-2">
                                    @php
                                        $bars = [['bln' => 'Jan', 'val' => 45], ['bln' => 'Feb', 'val' => 60], ['bln' => 'Mar', 'val' => 75], ['bln' => 'Apr', 'val' => 50], ['bln' => 'Mei', 'val' => 90], ['bln' => 'Jun', 'val' => 65], ['bln' => 'Jul', 'val' => 85], ['bln' => 'Agu', 'val' => 100]];
                                    @endphp
                                    @foreach ($bars as $bar)
                                        <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end group/bar">
                                            <div class="w-full max-w-9 bg-primary/20 group-hover/bar:bg-primary transition-all rounded-t-md relative" style="height: {{ $bar['val'] }}%">
                                                <div class="opacity-0 group-hover/bar:opacity-100 absolute -top-7 left-1/2 -translate-x-1/2 px-1.5 py-0.5 rounded bg-foreground text-background text-[10px] font-mono whitespace-nowrap transition-opacity pointer-events-none">
                                                    {{ $bar['val'] }}%
                                                </div>
                                            </div>
                                            <span class="text-[11px] text-muted-foreground font-mono">{{ $bar['bln'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </vibe:grid.card>

                            {{-- Kartu Aktivitas Tim (col-span-4) --}}
                            <vibe:grid.card id="widget-activity" title="Aktivitas Terkini" description="Pembaruan sistem & log tim" :colSpan="4">
                                <div class="space-y-3">
                                    <div class="flex items-start gap-2.5 text-xs">
                                        <div class="size-2 rounded-full bg-success mt-1.5 shrink-0"></div>
                                        <div class="min-w-0 flex-1">
                                            <p class="font-medium text-foreground truncate">Deploy Vibe UI v2.4 Sukses</p>
                                            <p class="text-[11px] text-muted-foreground">12 menit lalu oleh Fahril</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-2.5 text-xs">
                                        <div class="size-2 rounded-full bg-info mt-1.5 shrink-0"></div>
                                        <div class="min-w-0 flex-1">
                                            <p class="font-medium text-foreground truncate">Pesanan Baru #8912 diverifikasi</p>
                                            <p class="text-[11px] text-muted-foreground">34 menit lalu • Sistem</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-2.5 text-xs">
                                        <div class="size-2 rounded-full bg-warning mt-1.5 shrink-0"></div>
                                        <div class="min-w-0 flex-1">
                                            <p class="font-medium text-foreground truncate">Backup database harian</p>
                                            <p class="text-[11px] text-muted-foreground">2 jam lalu • Otomatis</p>
                                        </div>
                                    </div>
                                </div>
                            </vibe:grid.card>
                        </vibe:grid>
                    </vibe:preview.code>

                    <div class="w-full p-2 sm:p-4 bg-muted/20">
                        <vibe:grid id="dashboard-showcase-demo" :persist="true" :resizable="true" :reorderable="true">
                            <vibe:grid.toolbar title="{{ __('docs/grid.showcase.toolbar_title') }}" description="{{ __('docs/grid.showcase.toolbar_desc') }}" />

                            {{-- Kartu Metrik 1 (col-span-4) --}}
                            <vibe:grid.card id="demo-revenue" title="Total Pendapatan" description="Bulan berjalan" :colSpan="4">
                                <div class="space-y-2">
                                    <div class="flex items-baseline justify-between">
                                        <span class="text-2xl sm:text-3xl font-bold text-foreground">Rp 128.450.000</span>
                                        <vibe:badge variant="success" size="sm" class="font-medium">
                                            +14.2%
                                        </vibe:badge>
                                    </div>
                                    <p class="text-xs text-muted-foreground">Meningkat Rp 16.200.000 dibanding bulan lalu</p>
                                </div>
                            </vibe:grid.card>

                            {{-- Kartu Metrik 2 (col-span-4) --}}
                            <vibe:grid.card id="demo-users" title="Pengguna Aktif" description="Sesi 24 jam terakhir" :colSpan="4">
                                <div class="space-y-2">
                                    <div class="flex items-baseline justify-between">
                                        <span class="text-2xl sm:text-3xl font-bold text-foreground">8.942</span>
                                        <vibe:badge variant="outline" size="sm" class="bg-sky-500/10 text-sky-600 dark:text-sky-400 border-sky-500/20 font-medium">
                                            +8.5%
                                        </vibe:badge>
                                    </div>
                                    <p class="text-xs text-muted-foreground">1.240 pengguna baru mendaftar pekan ini</p>
                                </div>
                            </vibe:grid.card>

                            {{-- Kartu Metrik 3 (col-span-4) --}}
                            <vibe:grid.card id="demo-conversion" title="Konversi Penjualan" description="Tingkat checkout" :colSpan="4">
                                <div class="space-y-2">
                                    <div class="flex items-baseline justify-between">
                                        <span class="text-2xl sm:text-3xl font-bold text-foreground">4.82%</span>
                                        <vibe:badge variant="outline" size="sm" class="bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border-indigo-500/20 font-medium">
                                            Stabil
                                        </vibe:badge>
                                    </div>
                                    <p class="text-xs text-muted-foreground">Target triwulan 5.0% tercapai 96.4%</p>
                                </div>
                            </vibe:grid.card>

                            {{-- Kartu Grafik Analytics (col-span-8) --}}
                            <vibe:grid.card id="demo-analytics" title="Tren Penjualan & Performa" description="Grafik volume transaksi per bulan" :colSpan="8">
                                <div class="h-44 w-full flex items-end gap-3 pt-4 px-2 pb-2">
                                    @php
                                        $demoBars = [['bln' => 'Jan', 'val' => 45], ['bln' => 'Feb', 'val' => 60], ['bln' => 'Mar', 'val' => 75], ['bln' => 'Apr', 'val' => 50], ['bln' => 'Mei', 'val' => 90], ['bln' => 'Jun', 'val' => 65], ['bln' => 'Jul', 'val' => 85], ['bln' => 'Agu', 'val' => 100]];
                                    @endphp
                                    @foreach ($demoBars as $bar)
                                        <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end group/bar">
                                            <div class="w-full max-w-9 bg-primary/20 group-hover/bar:bg-primary transition-all rounded-t-md relative" style="height: {{ $bar['val'] }}%">
                                                <div class="opacity-0 group-hover/bar:opacity-100 absolute -top-7 left-1/2 -translate-x-1/2 px-1.5 py-0.5 rounded bg-foreground text-background text-[10px] font-mono whitespace-nowrap transition-opacity pointer-events-none">
                                                    {{ $bar['val'] }}%
                                                </div>
                                            </div>
                                            <span class="text-[11px] text-muted-foreground font-mono">{{ $bar['bln'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </vibe:grid.card>

                            {{-- Kartu Aktivitas Tim (col-span-4) --}}
                            <vibe:grid.card id="demo-activity" title="Aktivitas Terkini" description="Pembaruan sistem & log tim" :colSpan="4">
                                 <div class="space-y-3">
                                     <div class="flex items-start gap-2.5 text-xs">
                                         <div class="size-2 rounded-full bg-success mt-1.5 shrink-0"></div>
                                         <div class="min-w-0 flex-1">
                                             <p class="font-medium text-foreground truncate">Deploy Vibe UI v2.4 Sukses</p>
                                             <p class="text-[11px] text-muted-foreground">12 menit lalu oleh Fahril</p>
                                         </div>
                                     </div>
                                     <div class="flex items-start gap-2.5 text-xs">
                                         <div class="size-2 rounded-full bg-info mt-1.5 shrink-0"></div>
                                         <div class="min-w-0 flex-1">
                                             <p class="font-medium text-foreground truncate">Pesanan Baru #8912 diverifikasi</p>
                                             <p class="text-[11px] text-muted-foreground">34 menit lalu • Sistem</p>
                                         </div>
                                     </div>
                                     <div class="flex items-start gap-2.5 text-xs">
                                         <div class="size-2 rounded-full bg-warning mt-1.5 shrink-0"></div>
                                         <div class="min-w-0 flex-1">
                                             <p class="font-medium text-foreground truncate">Backup database harian</p>
                                             <p class="text-[11px] text-muted-foreground">2 jam lalu • Otomatis</p>
                                         </div>
                                     </div>
                                 </div>
                            </vibe:grid.card>
                        </vibe:grid>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Card Resize --}}
            <section id="ubah-ukuran-kartu" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/grid.resize.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/grid.resize.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/grid.resize.preview_title')">
                    <vibe:preview.code>
                        <vibe:grid id="grid-resize-demo" :resizable="true" :persist="false">
                            {{-- Kartu dengan lebar awal 6 kolom (50%), minimal 3, maksimal 12 --}}
                            <vibe:grid.card id="card-stats" title="Statistik Penjualan" :colSpan="6" :minColSpan="3" :maxColSpan="12">
                                <p class="text-sm text-muted-foreground">Tarik handel di sudut kanan bawah kartu ini untuk mengubah lebarnya.</p>
                            </vibe:grid.card>

                            {{-- Kartu kedua dengan lebar awal 6 kolom --}}
                            <vibe:grid.card id="card-traffic" title="Sumber Trafik" :colSpan="6">
                                <p class="text-sm text-muted-foreground">Setiap kartu dapat diperlebar atau diperkecil dengan menyeret handel garis di sudut kanan bawah.</p>
                            </vibe:grid.card>
                        </vibe:grid>
                    </vibe:preview.code>

                    <div class="w-full p-2 sm:p-4 bg-muted/20">
                        <vibe:grid id="grid-resize-preview" :resizable="true" :persist="false">
                            <vibe:grid.card id="resize-preview-1" title="Statistik Penjualan" :colSpan="6" :minColSpan="3" :maxColSpan="12">
                                <p class="text-sm text-muted-foreground">Tarik handel di sudut kanan bawah kartu ini untuk mengubah lebarnya.</p>
                            </vibe:grid.card>
                            <vibe:grid.card id="resize-preview-2" title="Sumber Trafik" :colSpan="6">
                                <p class="text-sm text-muted-foreground">Setiap kartu dapat diperlebar atau diperkecil dengan menyeret handel garis di sudut kanan bawah.</p>
                            </vibe:grid.card>
                        </vibe:grid>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Card Reorder --}}
            <section id="pindah-urutan-kartu" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/grid.reorder.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/grid.reorder.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/grid.reorder.preview_title')">
                    <vibe:preview.code>
                        <vibe:grid id="grid-reorder-demo" :reorderable="true" :persist="false">
                            <vibe:grid.card id="item-a" title="Kartu A (Bisa Digeser)" :colSpan="4">
                                <p class="text-sm text-muted-foreground">Gunakan tombol pegangan di kiri header untuk menyeret kartu ini.</p>
                            </vibe:grid.card>

                            <vibe:grid.card id="item-b" title="Kartu B (Bisa Digeser)" :colSpan="4">
                                <p class="text-sm text-muted-foreground">Tukar posisi kartu ini dengan Kartu A. Kartu C di sebelahnya terkunci dan posisinya tidak dapat ditukar.</p>
                            </vibe:grid.card>

                            {{-- Kartu C dikunci agar tidak dapat dipindah posisinya --}}
                            <vibe:grid.card id="item-c" title="Kartu C (Terkunci)" :colSpan="4" :reorderable="false">
                                <p class="text-sm text-muted-foreground">Kartu ini memiliki :reorderable="false" sehingga posisinya terkunci dan tidak dapat ditukar oleh kartu lain.</p>
                            </vibe:grid.card>
                        </vibe:grid>
                    </vibe:preview.code>

                    <div class="w-full p-2 sm:p-4 bg-muted/20">
                        <vibe:grid id="grid-reorder-preview" :reorderable="true" :persist="false">
                            <vibe:grid.card id="reorder-preview-a" title="Kartu A (Bisa Digeser)" :colSpan="4">
                                <p class="text-sm text-muted-foreground">Gunakan tombol pegangan di kiri header untuk menyeret kartu ini.</p>
                            </vibe:grid.card>
                            <vibe:grid.card id="reorder-preview-b" title="Kartu B (Bisa Digeser)" :colSpan="4">
                                <p class="text-sm text-muted-foreground">Tukar posisi kartu ini dengan Kartu A. Kartu C di sebelahnya terkunci dan posisinya tidak dapat ditukar.</p>
                            </vibe:grid.card>
                            <vibe:grid.card id="reorder-preview-c" title="Kartu C (Terkunci)" :colSpan="4" :reorderable="false">
                                <p class="text-sm text-muted-foreground">Kartu ini memiliki :reorderable="false" sehingga posisinya terkunci dan tidak dapat ditukar oleh kartu lain.</p>
                            </vibe:grid.card>
                        </vibe:grid>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Lock Modes --}}
            <section id="mode-penguncian" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/grid.lock.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/grid.lock.desc') !!}
                    </p>
                </div>

                {{-- Lock modes table --}}
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">Mode Kunci</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">Prop yang Diset</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">Bisa Resize?</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">Bisa Dipindah?</vibe:table.column>
                        <vibe:table.column>Ikon Hover</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-medium text-foreground text-xs">Kunci Posisi</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-primary whitespace-nowrap">:reorderable="false"</vibe:table.cell>
                            <vibe:table.cell class="text-xs font-semibold text-success">✓ Ya</vibe:table.cell>
                            <vibe:table.cell class="text-xs font-semibold text-destructive">✗ Tidak</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Gembok + titik tengah</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-medium text-foreground text-xs">Kunci Ukuran</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-primary whitespace-nowrap">:resizable="false"</vibe:table.cell>
                            <vibe:table.cell class="text-xs font-semibold text-destructive">✗ Tidak</vibe:table.cell>
                            <vibe:table.cell class="text-xs font-semibold text-success">✓ Ya</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Gembok + garis horizontal</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-medium text-foreground text-xs">Kunci Penuh</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-primary whitespace-nowrap">:reorderable="false" :resizable="false"</vibe:table.cell>
                            <vibe:table.cell class="text-xs font-semibold text-destructive">✗ Tidak</vibe:table.cell>
                            <vibe:table.cell class="text-xs font-semibold text-destructive">✗ Tidak</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Gembok solid</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>

                <div class="p-3.5 rounded-xl border border-warning/20 bg-warning/10 text-xs text-foreground flex items-center gap-3">
                    <svg class="size-5 text-warning shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" /><line x1="12" y1="16" x2="12" y2="12" /><line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    <span>{{ __('docs/grid.lock.hint') }}</span>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/grid.lock.preview_title')">
                    <vibe:preview.code>
                        <vibe:grid id="grid-lock-demo" :persist="false">
                            {{-- Kunci Posisi: bisa resize, tidak bisa dipindah --}}
                            <vibe:grid.card id="lock-pos" title="Kunci Posisi" description="reorderable=false" :colSpan="4" :reorderable="false">
                                <div class="space-y-2">
                                    <p class="text-sm text-muted-foreground">Posisi kartu ini dikunci. Tidak bisa dipindahkan ke posisi lain, namun masih bisa di-resize.</p>
                                    <code class="block text-xs font-mono bg-muted px-2 py-1 rounded text-foreground">:reorderable="false"</code>
                                </div>
                            </vibe:grid.card>

                            {{-- Kunci Ukuran: bisa dipindah, tidak bisa resize --}}
                            <vibe:grid.card id="lock-size" title="Kunci Ukuran" description="resizable=false" :colSpan="4" :resizable="false">
                                <div class="space-y-2">
                                    <p class="text-sm text-muted-foreground">Ukuran kartu ini dikunci. Tidak bisa di-resize, namun masih bisa dipindahkan ke posisi lain.</p>
                                    <code class="block text-xs font-mono bg-muted px-2 py-1 rounded text-foreground">:resizable="false"</code>
                                </div>
                            </vibe:grid.card>

                            {{-- Kunci Penuh: tidak bisa dipindah dan tidak bisa resize --}}
                            <vibe:grid.card id="lock-both" title="Kunci Penuh" description="reorderable=false, resizable=false" :colSpan="4" :reorderable="false" :resizable="false">
                                <div class="space-y-2">
                                    <p class="text-sm text-muted-foreground">Kartu ini terkunci sepenuhnya. Tidak bisa dipindahkan maupun di-resize.</p>
                                    <code class="block text-xs font-mono bg-muted px-2 py-1 rounded text-foreground">:reorderable="false" :resizable="false"</code>
                                </div>
                            </vibe:grid.card>
                        </vibe:grid>
                    </vibe:preview.code>

                    <div class="w-full p-2 sm:p-4 bg-muted/20">
                        <vibe:grid id="grid-lock-preview" :persist="false">
                            <vibe:grid.card id="lock-preview-pos" title="Kunci Posisi" description="reorderable=false" :colSpan="4" :reorderable="false">
                                <div class="space-y-2">
                                    <p class="text-sm text-muted-foreground">Posisi kartu ini dikunci. Tidak bisa dipindahkan ke posisi lain, namun masih bisa di-resize.</p>
                                    <code class="block text-xs font-mono bg-muted px-2 py-1 rounded text-foreground">:reorderable="false"</code>
                                </div>
                            </vibe:grid.card>
                            <vibe:grid.card id="lock-preview-size" title="Kunci Ukuran" description="resizable=false" :colSpan="4" :resizable="false">
                                <div class="space-y-2">
                                    <p class="text-sm text-muted-foreground">Ukuran kartu ini dikunci. Tidak bisa di-resize, namun masih bisa dipindahkan ke posisi lain.</p>
                                    <code class="block text-xs font-mono bg-muted px-2 py-1 rounded text-foreground">:resizable="false"</code>
                                </div>
                            </vibe:grid.card>
                            <vibe:grid.card id="lock-preview-both" title="Kunci Penuh" description="reorderable=false, resizable=false" :colSpan="4" :reorderable="false" :resizable="false">
                                <div class="space-y-2">
                                    <p class="text-sm text-muted-foreground">Kartu ini terkunci sepenuhnya. Tidak bisa dipindahkan maupun di-resize.</p>
                                    <code class="block text-xs font-mono bg-muted px-2 py-1 rounded text-foreground">:reorderable="false" :resizable="false"</code>
                                </div>
                            </vibe:grid.card>
                        </vibe:grid>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Persistence --}}
            <section id="persistensi-layout" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/grid.persistence.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/grid.persistence.desc') !!}
                    </p>
                </div>

                {{-- Storage info --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <vibe:card class="space-y-1.5">
                        <p class="text-xs font-semibold text-foreground">Alpine Store Key</p>
                        <code class="text-xs font-mono text-primary">vibeGrids</code>
                        <p class="text-[11px] text-muted-foreground">Semua grid tersimpan dalam satu store bersama.</p>
                    </vibe:card>
                    <vibe:card class="space-y-1.5">
                        <p class="text-xs font-semibold text-foreground">localStorage Key</p>
                        <code class="text-xs font-mono text-primary">vibe-grids</code>
                        <p class="text-[11px] text-muted-foreground">Key aktual yang tersimpan di browser.</p>
                    </vibe:card>
                    <vibe:card class="space-y-1.5">
                        <p class="text-xs font-semibold text-foreground">Expiry</p>
                        <code class="text-xs font-mono text-primary">90 hari</code>
                        <p class="text-[11px] text-muted-foreground">Data otomatis dihapus setelah 90 hari.</p>
                    </vibe:card>
                </div>
            </section>

            {{-- 5. Props Reference --}}
            <section id="referensi-props" class="space-y-8">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/grid.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/grid.props.desc') !!}
                    </p>
                </div>

                {{-- Subcomponents Catalog Table --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground">{{ __('docs/grid.subcomponents.title') }}</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid.subcomponents.columns.component') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/grid.subcomponents.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:grid&gt;</vibe:table.cell>
                                <vibe:table.cell class="text-xs text-muted-foreground">Kontainer utama dashboard grid yang mengelola state Alpine.js (lebar kolom, drag & drop reorder, dan persistensi localStorage).</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:grid.toolbar&gt;</vibe:table.cell>
                                <vibe:table.cell class="text-xs text-muted-foreground">Toolbar pembungkus judul dashboard, deskripsi, dan tombol aksi "Reset Layout".</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:grid.card&gt;</vibe:table.cell>
                                <vibe:table.cell class="text-xs text-muted-foreground">Komponen widget kartu individual yang dilengkapi drag handle, handel sudut resize, dan menu ukuran cepat.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:grid.item&gt;</vibe:table.cell>
                                <vibe:table.cell class="text-xs text-muted-foreground">Alias kompatibilitas penuh yang meneruskan seluruh props dan slot langsung ke &lt;vibe:grid.card&gt;.</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- vibe:grid Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground">&lt;vibe:grid&gt;</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/grid.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $gridRootProps = [['id', 'string|null', 'null', 'Identifier unik untuk menyimpan konfigurasi susunan kartu ke `localStorage`.'], ['cols', 'int|string', '12', 'Jumlah total kolom dalam sistem CSS grid (standar 12 kolom dashboard).'], ['gap', 'string', "'4'", 'Jarak antar kartu (misal `"2"`, `"4"`, `"6"`).'], ['persist', 'bool', 'true', 'Mengaktifkan penyimpanan otomatis urutan dan ukuran kartu ke browser `localStorage`.'], ['resizable', 'bool', 'true', 'Mengaktifkan kemampuan drag-to-resize pada sudut kartu di dalam grid.'], ['reorderable', 'bool', 'true', 'Mengaktifkan kemampuan drag-and-drop untuk memindahkan posisi urutan kartu.'], ['storageKey', 'string|null', 'null', 'Kunci khusus untuk override penamaan key di `localStorage`.']];
                            @endphp
                            @foreach ($gridRootProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- vibe:grid.card Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground">&lt;vibe:grid.card&gt; / &lt;vibe:grid.item&gt;</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/grid.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $gridCardProps = [['id / key', 'string', '— (Wajib)', 'Kunci identifikasi unik kartu yang digunakan untuk persistensi dan target drop.'], ['title', 'string|null', 'null', 'Judul teks pada header kartu widget.'], ['titleTag', 'string', "'h3'", 'Tag heading HTML untuk judul kartu (misal: "h2", "h3", "h4", "div").'], ['description', 'string|null', 'null', 'Deskripsi atau teks keterangan kecil di bawah judul kartu.'], ['colSpan', 'int|string', '4', 'Lebar awal kartu dalam kelipatan kolom grid (1 sampai 12).'], ['rowSpan', 'int|string', '1', 'Tinggi kartu dalam kelipatan baris grid.'], ['minColSpan', 'int|string', '2', 'Batas minimal lebar kolom saat kartu di-resize.'], ['maxColSpan', 'int|string', '12', 'Batas maksimal lebar kolom saat kartu di-resize.'], ['resizable', 'bool', 'true', 'Mengizinkan atau menonaktifkan handel resize pada kartu ini.'], ['reorderable', 'bool', 'true', 'Mengizinkan atau menonaktifkan tombol drag pemindahan kartu ini.'], ['variant', 'string', "'default'", 'Tampilan visual kartu: `"default"`, `"outline"`, `"flat"`, atau `"elevated"`.'], ['padding', 'string', "'default'", 'Ukuran ruang padding dalam kartu: `"none"`, `"sm"`, `"default"`, `"lg"`.']];
                            @endphp
                            @foreach ($gridCardProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- vibe:grid.toolbar Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground">&lt;vibe:grid.toolbar&gt;</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/grid.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $toolbarProps = [['title', 'string|null', 'null', 'Judul dashboard atau nama bagian grid.'], ['description', 'string|null', 'null', 'Keterangan atau panduan singkat penggunaan widget grid.'], ['showReset', 'bool', 'true', 'Menampilkan tombol bawaan "Reset Layout" untuk mengembalikan tata letak semula.']];
                            @endphp
                            @foreach ($toolbarProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
