<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/table.title')" :description="__('docs/table.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/table.title'), 'url' => '/docs/table']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Hero Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/table.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/table.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/table.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/table.description') }}
                </p>

                {{-- Quick props badge strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['default', 'striped', 'bordered', 'flush'] as $v)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $v }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['dense', 'hoverable', 'sortable', 'selected'] as $f)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $f }}</vibe:badge>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/table.basic_usage.preview_title')" :center="false">
                    <vibe:preview.code>
                        <vibe:table>
                            <vibe:table.header>
                                <vibe:table.column>{{ __('docs/table.columns.name') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.columns.email') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.columns.role') }}</vibe:table.column>
                                <vibe:table.column align="right">{{ __('docs/table.columns.status') }}</vibe:table.column>
                            </vibe:table.header>

                            <vibe:table.rows>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">Sarah Connor</vibe:table.cell>
                                    <vibe:table.cell variant="muted">sarah@example.com</vibe:table.cell>
                                    <vibe:table.cell>{{ __('docs/table.sample_data.roles.admin') }}</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:badge variant="success">{{ __('docs/table.sample_data.statuses.active') }}</vibe:badge>
                                    </vibe:table.cell>
                                </vibe:table.row>

                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">John Doe</vibe:table.cell>
                                    <vibe:table.cell variant="muted">john@example.com</vibe:table.cell>
                                    <vibe:table.cell>{{ __('docs/table.sample_data.roles.editor') }}</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:badge variant="warning">{{ __('docs/table.sample_data.statuses.pending') }}</vibe:badge>
                                    </vibe:table.cell>
                                </vibe:table.row>

                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">Alex Rivers</vibe:table.cell>
                                    <vibe:table.cell variant="muted">alex@example.com</vibe:table.cell>
                                    <vibe:table.cell>{{ __('docs/table.sample_data.roles.member') }}</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:badge variant="default">{{ __('docs/table.sample_data.statuses.offline') }}</vibe:badge>
                                    </vibe:table.cell>
                                </vibe:table.row>
                            </vibe:table.rows>
                        </vibe:table>
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:table>
                            <vibe:table.header>
                                <vibe:table.column>{{ __('docs/table.columns.name') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.columns.email') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.columns.role') }}</vibe:table.column>
                                <vibe:table.column align="right">{{ __('docs/table.columns.status') }}</vibe:table.column>
                            </vibe:table.header>

                            <vibe:table.rows>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">Sarah Connor</vibe:table.cell>
                                    <vibe:table.cell variant="muted">sarah@example.com</vibe:table.cell>
                                    <vibe:table.cell>{{ __('docs/table.sample_data.roles.admin') }}</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:badge variant="success">{{ __('docs/table.sample_data.statuses.active') }}</vibe:badge>
                                    </vibe:table.cell>
                                </vibe:table.row>

                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">John Doe</vibe:table.cell>
                                    <vibe:table.cell variant="muted">john@example.com</vibe:table.cell>
                                    <vibe:table.cell>{{ __('docs/table.sample_data.roles.editor') }}</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:badge variant="warning">{{ __('docs/table.sample_data.statuses.pending') }}</vibe:badge>
                                    </vibe:table.cell>
                                </vibe:table.row>

                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">Alex Rivers</vibe:table.cell>
                                    <vibe:table.cell variant="muted">alex@example.com</vibe:table.cell>
                                    <vibe:table.cell>{{ __('docs/table.sample_data.roles.member') }}</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:badge variant="default">{{ __('docs/table.sample_data.statuses.offline') }}</vibe:badge>
                                    </vibe:table.cell>
                                </vibe:table.row>
                            </vibe:table.rows>
                        </vibe:table>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Variants --}}
            <section id="varian-tampilan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.variants.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.variants.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/table.variants.preview_title')" :center="false">
                    <vibe:preview.code>
                        {{-- 1. Striped Table --}}
                        <vibe:table variant="striped">
                            <vibe:table.header>
                                <vibe:table.column>{{ __('docs/table.variants.product') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.variants.category') }}</vibe:table.column>
                                <vibe:table.column align="right">{{ __('docs/table.variants.price') }}</vibe:table.column>
                            </vibe:table.header>
                            <vibe:table.rows>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">{{ __('docs/table.variants.keyboard') }}</vibe:table.cell>
                                    <vibe:table.cell variant="muted">{{ __('docs/table.variants.cat_accessories') }}</vibe:table.cell>
                                    <vibe:table.cell align="right">$129.00</vibe:table.cell>
                                </vibe:table.row>
                                ...
                            </vibe:table.rows>
                        </vibe:table>

                        {{-- 2. Bordered Table --}}
                        <vibe:table variant="bordered">
                            <vibe:table.header>
                                <vibe:table.column>{{ __('docs/table.variants.feature') }}</vibe:table.column>
                                <vibe:table.column align="center">{{ __('docs/table.variants.starter') }}</vibe:table.column>
                                <vibe:table.column align="center">{{ __('docs/table.variants.pro') }}</vibe:table.column>
                            </vibe:table.header>
                            ...
                        </vibe:table>

                        {{-- 3. Flush Table --}}
                        <vibe:table variant="flush">
                            ...
                        </vibe:table>
                    </vibe:preview.code>
                    <div class="w-full space-y-6">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-muted-foreground mb-2">{{ __('docs/table.variants.items.striped') }}</p>
                            <vibe:table variant="striped">
                                <vibe:table.header>
                                    <vibe:table.column>{{ __('docs/table.variants.product') }}</vibe:table.column>
                                    <vibe:table.column>{{ __('docs/table.variants.category') }}</vibe:table.column>
                                    <vibe:table.column align="right">{{ __('docs/table.variants.price') }}</vibe:table.column>
                                </vibe:table.header>
                                <vibe:table.rows>
                                    <vibe:table.row>
                                        <vibe:table.cell variant="strong">{{ __('docs/table.variants.keyboard') }}</vibe:table.cell>
                                        <vibe:table.cell variant="muted">{{ __('docs/table.variants.cat_accessories') }}</vibe:table.cell>
                                        <vibe:table.cell align="right">$129.00</vibe:table.cell>
                                    </vibe:table.row>
                                    <vibe:table.row>
                                        <vibe:table.cell variant="strong">{{ __('docs/table.variants.mouse') }}</vibe:table.cell>
                                        <vibe:table.cell variant="muted">{{ __('docs/table.variants.cat_accessories') }}</vibe:table.cell>
                                        <vibe:table.cell align="right">$79.00</vibe:table.cell>
                                    </vibe:table.row>
                                    <vibe:table.row>
                                        <vibe:table.cell variant="strong">{{ __('docs/table.variants.monitor') }}</vibe:table.cell>
                                        <vibe:table.cell variant="muted">{{ __('docs/table.variants.cat_display') }}</vibe:table.cell>
                                        <vibe:table.cell align="right">$349.00</vibe:table.cell>
                                    </vibe:table.row>
                                </vibe:table.rows>
                            </vibe:table>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-muted-foreground mb-2">{{ __('docs/table.variants.items.bordered') }}</p>
                            <vibe:table variant="bordered">
                                <vibe:table.header>
                                    <vibe:table.column>{{ __('docs/table.variants.feature') }}</vibe:table.column>
                                    <vibe:table.column align="center">{{ __('docs/table.variants.starter') }}</vibe:table.column>
                                    <vibe:table.column align="center">{{ __('docs/table.variants.pro') }}</vibe:table.column>
                                </vibe:table.header>
                                <vibe:table.rows>
                                    <vibe:table.row>
                                        <vibe:table.cell>{{ __('docs/table.variants.unlimited_projects') }}</vibe:table.cell>
                                        <vibe:table.cell align="center" variant="muted">5</vibe:table.cell>
                                        <vibe:table.cell align="center" variant="strong">{{ __('docs/table.variants.unlimited') }}</vibe:table.cell>
                                    </vibe:table.row>
                                    <vibe:table.row>
                                        <vibe:table.cell>{{ __('docs/table.variants.custom_domain') }}</vibe:table.cell>
                                        <vibe:table.cell align="center" variant="muted">—</vibe:table.cell>
                                        <vibe:table.cell align="center">
                                            <svg class="size-4 text-success mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                        </vibe:table.cell>
                                    </vibe:table.row>
                                </vibe:table.rows>
                            </vibe:table>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Dense Mode --}}
            <section id="tabel-kompak" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.dense.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.dense.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/table.dense.preview_title')" :center="false">
                    <vibe:preview.code>
                        <vibe:table dense>
                            <vibe:table.header>
                                <vibe:table.column>{{ __('docs/table.dense.invoice') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.dense.date') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.dense.client') }}</vibe:table.column>
                                <vibe:table.column align="right">{{ __('docs/table.dense.amount') }}</vibe:table.column>
                            </vibe:table.header>
                            <vibe:table.rows>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">INV-2026-001</vibe:table.cell>
                                    <vibe:table.cell variant="muted">01 Sep 2026</vibe:table.cell>
                                    <vibe:table.cell>Acme Corp</vibe:table.cell>
                                    <vibe:table.cell align="right" variant="strong">$1,250.00</vibe:table.cell>
                                </vibe:table.row>
                                ...
                            </vibe:table.rows>
                            <vibe:table.footer>
                                <vibe:table.cell colspan="3" variant="strong">{{ __('docs/table.dense.total') }}</vibe:table.cell>
                                <vibe:table.cell align="right" variant="strong">$4,170.00</vibe:table.cell>
                            </vibe:table.footer>
                        </vibe:table>
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:table dense>
                            <vibe:table.header>
                                <vibe:table.column>{{ __('docs/table.dense.invoice') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.dense.date') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.dense.client') }}</vibe:table.column>
                                <vibe:table.column align="right">{{ __('docs/table.dense.amount') }}</vibe:table.column>
                            </vibe:table.header>
                            <vibe:table.rows>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">INV-2026-001</vibe:table.cell>
                                    <vibe:table.cell variant="muted">01 Sep 2026</vibe:table.cell>
                                    <vibe:table.cell>Acme Corp</vibe:table.cell>
                                    <vibe:table.cell align="right" variant="strong">$1,250.00</vibe:table.cell>
                                </vibe:table.row>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">INV-2026-002</vibe:table.cell>
                                    <vibe:table.cell variant="muted">02 Sep 2026</vibe:table.cell>
                                    <vibe:table.cell>Starlight Labs</vibe:table.cell>
                                    <vibe:table.cell align="right" variant="strong">$820.00</vibe:table.cell>
                                </vibe:table.row>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">INV-2026-003</vibe:table.cell>
                                    <vibe:table.cell variant="muted">03 Sep 2026</vibe:table.cell>
                                    <vibe:table.cell>Nexus Studio</vibe:table.cell>
                                    <vibe:table.cell align="right" variant="strong">$2,100.00</vibe:table.cell>
                                </vibe:table.row>
                            </vibe:table.rows>
                            <vibe:table.footer>
                                <vibe:table.cell colspan="3" variant="strong">{{ __('docs/table.dense.total') }}</vibe:table.cell>
                                <vibe:table.cell align="right" variant="strong">$4,170.00</vibe:table.cell>
                            </vibe:table.footer>
                        </vibe:table>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Sortable Columns --}}
            <section id="kolom-pengurutan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.sortable.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.sortable.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/table.sortable.preview_title')" :center="false">
                    <vibe:preview.code>
                        <vibe:table>
                            <vibe:table.header>
                                {{-- Sorted Column (Ascending) --}}
                                <vibe:table.column sortable :sorted="true" direction="asc">
                                    {{ __('docs/table.columns.name') }}
                                </vibe:table.column>

                                {{-- Sortable but not active --}}
                                <vibe:table.column sortable>
                                    {{ __('docs/table.sortable.department') }}
                                </vibe:table.column>

                                {{-- Sortable Column --}}
                                <vibe:table.column sortable align="right">
                                    {{ __('docs/table.sortable.performance') }}
                                </vibe:table.column>
                            </vibe:table.header>

                            <vibe:table.rows>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">Ahmad Fauzi</vibe:table.cell>
                                    <vibe:table.cell variant="muted">{{ __('docs/table.sortable.dept_engineering') }}</vibe:table.cell>
                                    <vibe:table.cell align="right">98%</vibe:table.cell>
                                </vibe:table.row>
                                ...
                            </vibe:table.rows>
                        </vibe:table>
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:table>
                            <vibe:table.header>
                                <vibe:table.column sortable :sorted="true" direction="asc">
                                    {{ __('docs/table.columns.name') }}
                                </vibe:table.column>
                                <vibe:table.column sortable>
                                    {{ __('docs/table.sortable.department') }}
                                </vibe:table.column>
                                <vibe:table.column sortable align="right">
                                    {{ __('docs/table.sortable.performance') }}
                                </vibe:table.column>
                            </vibe:table.header>

                            <vibe:table.rows>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">Ahmad Fauzi</vibe:table.cell>
                                    <vibe:table.cell variant="muted">{{ __('docs/table.sortable.dept_engineering') }}</vibe:table.cell>
                                    <vibe:table.cell align="right">98%</vibe:table.cell>
                                </vibe:table.row>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">Budi Santoso</vibe:table.cell>
                                    <vibe:table.cell variant="muted">{{ __('docs/table.sortable.dept_product') }}</vibe:table.cell>
                                    <vibe:table.cell align="right">94%</vibe:table.cell>
                                </vibe:table.row>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">Citra Lestari</vibe:table.cell>
                                    <vibe:table.cell variant="muted">{{ __('docs/table.sortable.dept_design') }}</vibe:table.cell>
                                    <vibe:table.cell align="right">89%</vibe:table.cell>
                                </vibe:table.row>
                            </vibe:table.rows>
                        </vibe:table>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Selection & Actions --}}
            <section id="baris-terpilih" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.selection.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.selection.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/table.selection.preview_title')" :center="false">
                    <vibe:preview.code>
                        <vibe:table>
                            <vibe:table.header>
                                <vibe:table.column class="w-10"></vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.selection.user') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.selection.plan') }}</vibe:table.column>
                                <vibe:table.column align="right">{{ __('docs/table.selection.action') }}</vibe:table.column>
                            </vibe:table.header>

                            <vibe:table.rows>
                                {{-- Selected Row --}}
                                <vibe:table.row :selected="true">
                                    <vibe:table.cell>
                                        <input type="checkbox" checked class="rounded border-input text-primary focus:ring-primary size-4" />
                                    </vibe:table.cell>
                                    <vibe:table.cell variant="strong">Dani Ramadhan {{ __('docs/table.selection.selected_badge') }}</vibe:table.cell>
                                    <vibe:table.cell variant="muted">Enterprise</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:button size="xs" variant="outline">{{ __('docs/table.selection.edit') }}</vibe:button>
                                    </vibe:table.cell>
                                </vibe:table.row>

                                {{-- Normal Row --}}
                                <vibe:table.row>
                                    <vibe:table.cell>
                                        <input type="checkbox" class="rounded border-input text-primary focus:ring-primary size-4" />
                                    </vibe:table.cell>
                                    <vibe:table.cell variant="strong">Eka Wulandari</vibe:table.cell>
                                    <vibe:table.cell variant="muted">Pro</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:button size="xs" variant="outline">{{ __('docs/table.selection.edit') }}</vibe:button>
                                    </vibe:table.cell>
                                </vibe:table.row>
                            </vibe:table.rows>
                        </vibe:table>
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:table>
                            <vibe:table.header>
                                <vibe:table.column class="w-10"></vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.selection.user') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.selection.plan') }}</vibe:table.column>
                                <vibe:table.column align="right">{{ __('docs/table.selection.action') }}</vibe:table.column>
                            </vibe:table.header>

                            <vibe:table.rows>
                                <vibe:table.row :selected="true">
                                    <vibe:table.cell>
                                        <input type="checkbox" checked class="rounded border-input text-primary focus:ring-primary size-4" />
                                    </vibe:table.cell>
                                    <vibe:table.cell variant="strong">Dani Ramadhan {{ __('docs/table.selection.selected_badge') }}</vibe:table.cell>
                                    <vibe:table.cell variant="muted">Enterprise</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:button size="xs" variant="outline">{{ __('docs/table.selection.edit') }}</vibe:button>
                                    </vibe:table.cell>
                                </vibe:table.row>

                                <vibe:table.row>
                                    <vibe:table.cell>
                                        <input type="checkbox" class="rounded border-input text-primary focus:ring-primary size-4" />
                                    </vibe:table.cell>
                                    <vibe:table.cell variant="strong">Eka Wulandari</vibe:table.cell>
                                    <vibe:table.cell variant="muted">Pro</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:button size="xs" variant="outline">{{ __('docs/table.selection.edit') }}</vibe:button>
                                    </vibe:table.cell>
                                </vibe:table.row>
                            </vibe:table.rows>
                        </vibe:table>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Empty State --}}
            <section id="tampilan-kosong" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.empty_state.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.empty_state.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/table.empty_state.preview_title')" :center="false">
                    <vibe:preview.code>
                        <vibe:table>
                            <vibe:table.header>
                                <vibe:table.column>{{ __('docs/table.columns.name') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.variants.category') }}</vibe:table.column>
                                <vibe:table.column align="right">{{ __('docs/table.empty_state.stock') }}</vibe:table.column>
                            </vibe:table.header>

                            <vibe:table.rows>
                                <vibe:table.empty :title="__('docs/table.empty_state.empty_title')" :description="__('docs/table.empty_state.empty_desc')">
                                    <vibe:button size="xs" variant="primary">
                                        {{ __('docs/table.empty_state.clear_filters') }}
                                    </vibe:button>
                                </vibe:table.empty>
                            </vibe:table.rows>
                        </vibe:table>
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:table>
                            <vibe:table.header>
                                <vibe:table.column>{{ __('docs/table.columns.name') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/table.variants.category') }}</vibe:table.column>
                                <vibe:table.column align="right">{{ __('docs/table.empty_state.stock') }}</vibe:table.column>
                            </vibe:table.header>

                            <vibe:table.rows>
                                <vibe:table.empty :title="__('docs/table.empty_state.empty_title')" :description="__('docs/table.empty_state.empty_desc')">
                                    <vibe:button size="xs" variant="primary">
                                        {{ __('docs/table.empty_state.clear_filters') }}
                                    </vibe:button>
                                </vibe:table.empty>
                            </vibe:table.rows>
                        </vibe:table>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Subcomponents Reference --}}
            <section id="subkomponen-table" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.subcomponents.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.subcomponents.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/table.subcomponents.columns.component') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/table.subcomponents.columns.tag') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/table.subcomponents.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $subcomponents = [
                                ['<vibe:table>', '<table> + wrapper div', 'table'],
                                ['<vibe:table.header>', '<thead>', 'header'],
                                ['<vibe:table.column>', '<th>', 'column'],
                                ['<vibe:table.rows>', '<tbody>', 'rows'],
                                ['<vibe:table.row>', '<tr>', 'row'],
                                ['<vibe:table.cell>', '<td>', 'cell'],
                                ['<vibe:table.footer>', '<tfoot>', 'footer'],
                                ['<vibe:table.empty>', '<tr> + <td>', 'empty'],
                            ];
                        @endphp
                        @foreach ($subcomponents as [$comp, $tag, $key])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $comp }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $tag }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! __('docs/table.subcomponents.items.' . $key) !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>
            </section>

            {{-- 8. Props Reference --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.props.desc') !!}
                    </p>
                </div>

                {{-- Table props --}}
                <p class="text-sm font-semibold text-foreground pt-1">&lt;vibe:table&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/table.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/table.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/table.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/table.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $mainProps = [
                                ['variant', "'default'|'striped'|'bordered'|'flush'", "'default'", 'variant'],
                                ['dense', 'bool', 'false', 'dense'],
                                ['hoverable', 'bool', 'true', 'hoverable'],
                                ['caption', 'string|null', 'null', 'caption'],
                                ['containerClass', 'string|null', 'null', 'containerClass'],
                            ];
                        @endphp
                        @foreach ($mainProps as [$prop, $type, $default, $key])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/table.props.table.' . $key) }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Column props --}}
                <p class="text-sm font-semibold text-foreground pt-4">&lt;vibe:table.column&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/table.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/table.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/table.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/table.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $colProps = [
                                ['align', "'left'|'center'|'right'", "'left'", 'align'],
                                ['sortable', 'bool', 'false', 'sortable'],
                                ['sorted', 'bool', 'false', 'sorted'],
                                ['direction', "'asc'|'desc'|null", 'null', 'direction'],
                            ];
                        @endphp
                        @foreach ($colProps as [$prop, $type, $default, $key])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/table.props.column.' . $key) }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Row props --}}
                <p class="text-sm font-semibold text-foreground pt-4">&lt;vibe:table.row&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/table.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/table.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/table.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/table.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $rowProps = [
                                ['selected', 'bool', 'false', 'selected'],
                                ['clickable', 'bool', 'false', 'clickable'],
                            ];
                        @endphp
                        @foreach ($rowProps as [$prop, $type, $default, $key])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/table.props.row.' . $key) }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Cell props --}}
                <p class="text-sm font-semibold text-foreground pt-4">&lt;vibe:table.cell&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/table.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/table.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/table.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/table.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $cellProps = [
                                ['align', "'left'|'center'|'right'", "'left'", 'align'],
                                ['variant', "'default'|'strong'|'muted'", "'default'", 'variant'],
                                ['colspan', 'int|string|null', 'null', 'colspan'],
                            ];
                        @endphp
                        @foreach ($cellProps as [$prop, $type, $default, $key])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/table.props.cell.' . $key) }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
