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
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground">{{ __('docs/table.badge') }}</span>
                    <span class="text-xs text-muted-foreground">{{ __('docs/table.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/table.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/table.description') }}
                </p>

                {{-- Quick props badge strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['default', 'striped', 'bordered', 'flush'] as $v)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $v }}</span>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['dense', 'hoverable', 'sortable', 'selected'] as $f)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $f }}</span>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.basic_usage_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.basic_usage_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Basic Table" :center="false">
                    <vibe:preview.code>
                        @verbatim
                            <vibe:table>
                                <vibe:table.header>
                                    <vibe:table.column>Name</vibe:table.column>
                                    <vibe:table.column>Email</vibe:table.column>
                                    <vibe:table.column>Role</vibe:table.column>
                                    <vibe:table.column align="right">Status</vibe:table.column>
                                </vibe:table.header>

                                <vibe:table.rows>
                                    <vibe:table.row>
                                        <vibe:table.cell variant="strong">Sarah Connor</vibe:table.cell>
                                        <vibe:table.cell variant="muted">sarah@example.com</vibe:table.cell>
                                        <vibe:table.cell>Administrator</vibe:table.cell>
                                        <vibe:table.cell align="right">
                                            <vibe:badge variant="success">Active</vibe:badge>
                                        </vibe:table.cell>
                                    </vibe:table.row>

                                    <vibe:table.row>
                                        <vibe:table.cell variant="strong">John Doe</vibe:table.cell>
                                        <vibe:table.cell variant="muted">john@example.com</vibe:table.cell>
                                        <vibe:table.cell>Editor</vibe:table.cell>
                                        <vibe:table.cell align="right">
                                            <vibe:badge variant="warning">Pending</vibe:badge>
                                        </vibe:table.cell>
                                    </vibe:table.row>

                                    <vibe:table.row>
                                        <vibe:table.cell variant="strong">Alex Rivers</vibe:table.cell>
                                        <vibe:table.cell variant="muted">alex@example.com</vibe:table.cell>
                                        <vibe:table.cell>Member</vibe:table.cell>
                                        <vibe:table.cell align="right">
                                            <vibe:badge variant="default">Offline</vibe:badge>
                                        </vibe:table.cell>
                                    </vibe:table.row>
                                </vibe:table.rows>
                            </vibe:table>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:table>
                            <vibe:table.header>
                                <vibe:table.column>Name</vibe:table.column>
                                <vibe:table.column>Email</vibe:table.column>
                                <vibe:table.column>Role</vibe:table.column>
                                <vibe:table.column align="right">Status</vibe:table.column>
                            </vibe:table.header>

                            <vibe:table.rows>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">Sarah Connor</vibe:table.cell>
                                    <vibe:table.cell variant="muted">sarah@example.com</vibe:table.cell>
                                    <vibe:table.cell>Administrator</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:badge variant="success">Active</vibe:badge>
                                    </vibe:table.cell>
                                </vibe:table.row>

                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">John Doe</vibe:table.cell>
                                    <vibe:table.cell variant="muted">john@example.com</vibe:table.cell>
                                    <vibe:table.cell>Editor</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:badge variant="warning">Pending</vibe:badge>
                                    </vibe:table.cell>
                                </vibe:table.row>

                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">Alex Rivers</vibe:table.cell>
                                    <vibe:table.cell variant="muted">alex@example.com</vibe:table.cell>
                                    <vibe:table.cell>Member</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:badge variant="default">Offline</vibe:badge>
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
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.variants_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.variants_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Table Variants" :center="false">
                    <vibe:preview.code>
                        @verbatim
                            {{-- 1. Striped Table --}}
                            <vibe:table variant="striped">
                                <vibe:table.header>
                                    <vibe:table.column>Product</vibe:table.column>
                                    <vibe:table.column>Category</vibe:table.column>
                                    <vibe:table.column align="right">Price</vibe:table.column>
                                </vibe:table.header>
                                <vibe:table.rows>
                                    <vibe:table.row>
                                        <vibe:table.cell variant="strong">Mechanical Keyboard</vibe:table.cell>
                                        <vibe:table.cell variant="muted">Accessories</vibe:table.cell>
                                        <vibe:table.cell align="right">$129.00</vibe:table.cell>
                                    </vibe:table.row>
                                    ...
                                </vibe:table.rows>
                            </vibe:table>

                            {{-- 2. Bordered Table --}}
                            <vibe:table variant="bordered">
                                ...
                            </vibe:table>

                            {{-- 3. Flush Table --}}
                            <vibe:table variant="flush">
                                ...
                            </vibe:table>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full space-y-6">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-muted-foreground mb-2">Variant: Striped</p>
                            <vibe:table variant="striped">
                                <vibe:table.header>
                                    <vibe:table.column>Product</vibe:table.column>
                                    <vibe:table.column>Category</vibe:table.column>
                                    <vibe:table.column align="right">Price</vibe:table.column>
                                </vibe:table.header>
                                <vibe:table.rows>
                                    <vibe:table.row>
                                        <vibe:table.cell variant="strong">Mechanical Keyboard</vibe:table.cell>
                                        <vibe:table.cell variant="muted">Accessories</vibe:table.cell>
                                        <vibe:table.cell align="right">$129.00</vibe:table.cell>
                                    </vibe:table.row>
                                    <vibe:table.row>
                                        <vibe:table.cell variant="strong">Wireless Mouse</vibe:table.cell>
                                        <vibe:table.cell variant="muted">Accessories</vibe:table.cell>
                                        <vibe:table.cell align="right">$79.00</vibe:table.cell>
                                    </vibe:table.row>
                                    <vibe:table.row>
                                        <vibe:table.cell variant="strong">4K Monitor 27"</vibe:table.cell>
                                        <vibe:table.cell variant="muted">Display</vibe:table.cell>
                                        <vibe:table.cell align="right">$349.00</vibe:table.cell>
                                    </vibe:table.row>
                                </vibe:table.rows>
                            </vibe:table>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-muted-foreground mb-2">Variant: Bordered</p>
                            <vibe:table variant="bordered">
                                <vibe:table.header>
                                    <vibe:table.column>Feature</vibe:table.column>
                                    <vibe:table.column align="center">Starter</vibe:table.column>
                                    <vibe:table.column align="center">Pro</vibe:table.column>
                                </vibe:table.header>
                                <vibe:table.rows>
                                    <vibe:table.row>
                                        <vibe:table.cell>Unlimited Projects</vibe:table.cell>
                                        <vibe:table.cell align="center" variant="muted">5</vibe:table.cell>
                                        <vibe:table.cell align="center" variant="strong">Unlimited</vibe:table.cell>
                                    </vibe:table.row>
                                    <vibe:table.row>
                                        <vibe:table.cell>Custom Domain</vibe:table.cell>
                                        <vibe:table.cell align="center" variant="muted">—</vibe:table.cell>
                                        <vibe:table.cell align="center">
                                            <svg class="size-4 text-emerald-500 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
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
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.dense_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.dense_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Dense Table" :center="false">
                    <vibe:preview.code>
                        @verbatim
                            <vibe:table dense>
                                <vibe:table.header>
                                    <vibe:table.column>Invoice #</vibe:table.column>
                                    <vibe:table.column>Date</vibe:table.column>
                                    <vibe:table.column>Client</vibe:table.column>
                                    <vibe:table.column align="right">Amount</vibe:table.column>
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
                                    <vibe:table.cell colspan="3" variant="strong">Total</vibe:table.cell>
                                    <vibe:table.cell align="right" variant="strong">$4,170.00</vibe:table.cell>
                                </vibe:table.footer>
                            </vibe:table>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:table dense>
                            <vibe:table.header>
                                <vibe:table.column>Invoice #</vibe:table.column>
                                <vibe:table.column>Date</vibe:table.column>
                                <vibe:table.column>Client</vibe:table.column>
                                <vibe:table.column align="right">Amount</vibe:table.column>
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
                                <vibe:table.cell colspan="3" variant="strong">Total</vibe:table.cell>
                                <vibe:table.cell align="right" variant="strong">$4,170.00</vibe:table.cell>
                            </vibe:table.footer>
                        </vibe:table>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Sortable Columns --}}
            <section id="kolom-pengurutan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.sortable_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.sortable_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Sortable Columns" :center="false">
                    <vibe:preview.code>
                        @verbatim
                            <vibe:table>
                                <vibe:table.header>
                                    {{-- Sorted Column (Ascending) --}}
                                    <vibe:table.column sortable :sorted="true" direction="asc">
                                        Name
                                    </vibe:table.column>

                                    {{-- Sortable but not active --}}
                                    <vibe:table.column sortable>
                                        Department
                                    </vibe:table.column>

                                    {{-- Sortable Column --}}
                                    <vibe:table.column sortable align="right">
                                        Performance
                                    </vibe:table.column>
                                </vibe:table.header>

                                <vibe:table.rows>
                                    <vibe:table.row>
                                        <vibe:table.cell variant="strong">Ahmad Fauzi</vibe:table.cell>
                                        <vibe:table.cell variant="muted">Engineering</vibe:table.cell>
                                        <vibe:table.cell align="right">98%</vibe:table.cell>
                                    </vibe:table.row>
                                    ...
                                </vibe:table.rows>
                            </vibe:table>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:table>
                            <vibe:table.header>
                                <vibe:table.column sortable :sorted="true" direction="asc">
                                    Name
                                </vibe:table.column>
                                <vibe:table.column sortable>
                                    Department
                                </vibe:table.column>
                                <vibe:table.column sortable align="right">
                                    Performance
                                </vibe:table.column>
                            </vibe:table.header>

                            <vibe:table.rows>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">Ahmad Fauzi</vibe:table.cell>
                                    <vibe:table.cell variant="muted">Engineering</vibe:table.cell>
                                    <vibe:table.cell align="right">98%</vibe:table.cell>
                                </vibe:table.row>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">Budi Santoso</vibe:table.cell>
                                    <vibe:table.cell variant="muted">Product</vibe:table.cell>
                                    <vibe:table.cell align="right">94%</vibe:table.cell>
                                </vibe:table.row>
                                <vibe:table.row>
                                    <vibe:table.cell variant="strong">Citra Lestari</vibe:table.cell>
                                    <vibe:table.cell variant="muted">Design</vibe:table.cell>
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
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.selection_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.selection_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Row Selection" :center="false">
                    <vibe:preview.code>
                        @verbatim
                            <vibe:table>
                                <vibe:table.header>
                                    <vibe:table.column class="w-10"></vibe:table.column>
                                    <vibe:table.column>User</vibe:table.column>
                                    <vibe:table.column>Plan</vibe:table.column>
                                    <vibe:table.column align="right">Action</vibe:table.column>
                                </vibe:table.header>

                                <vibe:table.rows>
                                    {{-- Selected Row --}}
                                    <vibe:table.row :selected="true">
                                        <vibe:table.cell>
                                            <input type="checkbox" checked class="rounded border-input text-primary focus:ring-primary size-4" />
                                        </vibe:table.cell>
                                        <vibe:table.cell variant="strong">Dani Ramadhan (Selected)</vibe:table.cell>
                                        <vibe:table.cell variant="muted">Enterprise</vibe:table.cell>
                                        <vibe:table.cell align="right">
                                            <vibe:button size="xs" variant="outline">Edit</vibe:button>
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
                                            <vibe:button size="xs" variant="outline">Edit</vibe:button>
                                        </vibe:table.cell>
                                    </vibe:table.row>
                                </vibe:table.rows>
                            </vibe:table>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:table>
                            <vibe:table.header>
                                <vibe:table.column class="w-10"></vibe:table.column>
                                <vibe:table.column>User</vibe:table.column>
                                <vibe:table.column>Plan</vibe:table.column>
                                <vibe:table.column align="right">Action</vibe:table.column>
                            </vibe:table.header>

                            <vibe:table.rows>
                                <vibe:table.row :selected="true">
                                    <vibe:table.cell>
                                        <input type="checkbox" checked class="rounded border-input text-primary focus:ring-primary size-4" />
                                    </vibe:table.cell>
                                    <vibe:table.cell variant="strong">Dani Ramadhan (Selected)</vibe:table.cell>
                                    <vibe:table.cell variant="muted">Enterprise</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:button size="xs" variant="outline">Edit</vibe:button>
                                    </vibe:table.cell>
                                </vibe:table.row>

                                <vibe:table.row>
                                    <vibe:table.cell>
                                        <input type="checkbox" class="rounded border-input text-primary focus:ring-primary size-4" />
                                    </vibe:table.cell>
                                    <vibe:table.cell variant="strong">Eka Wulandari</vibe:table.cell>
                                    <vibe:table.cell variant="muted">Pro</vibe:table.cell>
                                    <vibe:table.cell align="right">
                                        <vibe:button size="xs" variant="outline">Edit</vibe:button>
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
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.empty_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.empty_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Empty State Table" :center="false">
                    <vibe:preview.code>
                        @verbatim
                            <vibe:table>
                                <vibe:table.header>
                                    <vibe:table.column>Name</vibe:table.column>
                                    <vibe:table.column>Category</vibe:table.column>
                                    <vibe:table.column align="right">Stock</vibe:table.column>
                                </vibe:table.header>

                                <vibe:table.rows>
                                    <vibe:table.empty title="No products found" description="Your search criteria did not match any inventory records.">
                                        <vibe:button size="xs" variant="primary">
                                            Clear Filters
                                        </vibe:button>
                                    </vibe:table.empty>
                                </vibe:table.rows>
                            </vibe:table>
                        @endverbatim
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:table>
                            <vibe:table.header>
                                <vibe:table.column>Name</vibe:table.column>
                                <vibe:table.column>Category</vibe:table.column>
                                <vibe:table.column align="right">Stock</vibe:table.column>
                            </vibe:table.header>

                            <vibe:table.rows>
                                <vibe:table.empty title="No products found" description="Your search criteria did not match any inventory records.">
                                    <vibe:button size="xs" variant="primary">
                                        Clear Filters
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
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.subcomponents_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.subcomponents_desc') !!}
                    </p>
                </div>

                <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                    <table class="w-full text-left text-xs">
                        <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                            <tr>
                                <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/table.table_component') }}</th>
                                <th class="px-4 py-3">Tag HTML</th>
                                <th class="px-4 py-3">{{ __('docs/table.table_desc') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border text-muted-foreground">
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:table&gt;</td>
                                <td class="px-4 py-3 font-mono text-muted-foreground whitespace-nowrap">&lt;table&gt; + wrapper div</td>
                                <td class="px-4 py-3 text-muted-foreground">Kontainer tabel utama dengan pembungkus overflow responsif dan bayangan lembut.</td>
                            </tr>
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:table.header&gt;</td>
                                <td class="px-4 py-3 font-mono text-muted-foreground whitespace-nowrap">&lt;thead&gt;</td>
                                <td class="px-4 py-3 text-muted-foreground">Bagian kepala tabel. Mendukung prop <code class="font-mono text-foreground">sticky</code>.</td>
                            </tr>
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:table.column&gt;</td>
                                <td class="px-4 py-3 font-mono text-muted-foreground whitespace-nowrap">&lt;th&gt;</td>
                                <td class="px-4 py-3 text-muted-foreground">Kolom judul tabel. Mendukung perataan teks dan fitur sortir (<code class="font-mono text-foreground">sortable</code>).</td>
                            </tr>
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:table.rows&gt;</td>
                                <td class="px-4 py-3 font-mono text-muted-foreground whitespace-nowrap">&lt;tbody&gt;</td>
                                <td class="px-4 py-3 text-muted-foreground">Badan tabel yang mengelompokkan baris-baris data dengan pemisah horizontal.</td>
                            </tr>
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:table.row&gt;</td>
                                <td class="px-4 py-3 font-mono text-muted-foreground whitespace-nowrap">&lt;tr&gt;</td>
                                <td class="px-4 py-3 text-muted-foreground">Baris tunggal. Mendukung status baris terpilih (<code class="font-mono text-foreground">selected</code>) dan <code class="font-mono text-foreground">clickable</code>.</td>
                            </tr>
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:table.cell&gt;</td>
                                <td class="px-4 py-3 font-mono text-muted-foreground whitespace-nowrap">&lt;td&gt;</td>
                                <td class="px-4 py-3 text-muted-foreground">Sel data tabel dengan kontrol perataan teks (<code class="font-mono text-foreground">align</code>) dan varian teks.</td>
                            </tr>
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:table.footer&gt;</td>
                                <td class="px-4 py-3 font-mono text-muted-foreground whitespace-nowrap">&lt;tfoot&gt;</td>
                                <td class="px-4 py-3 text-muted-foreground">Bagian kaki tabel untuk baris ringkasan, total, atau kontrol paginasi.</td>
                            </tr>
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:table.empty&gt;</td>
                                <td class="px-4 py-3 font-mono text-muted-foreground whitespace-nowrap">&lt;tr&gt; + &lt;td&gt;</td>
                                <td class="px-4 py-3 text-muted-foreground">Tampilan state kosong ketika tidak ada catatan data untuk ditampilkan.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- 8. Props Reference --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/table.props_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/table.props_desc') !!}
                    </p>
                </div>

                {{-- Table props --}}
                <p class="text-sm font-semibold text-foreground pt-1">&lt;vibe:table&gt;</p>
                <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                    <table class="w-full text-left text-xs">
                        <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                            <tr>
                                <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/table.table_prop') }}</th>
                                <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/table.table_type') }}</th>
                                <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/table.table_default') }}</th>
                                <th class="px-4 py-3">{{ __('docs/table.table_desc') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border text-muted-foreground">
                            @php
                                $mainProps = [['variant', "'default'|'striped'|'bordered'|'flush'", "'default'", 'Gaya visual tabel.'], ['dense', 'bool', 'false', 'Mode kompak dengan tinggi baris dan padding lebih ramping.'], ['hoverable', 'bool', 'true', 'Efek sorot (highlight) saat kursor berada di atas baris.'], ['caption', 'string|null', 'null', 'Keterangan teks kecil di bawah tabel.'], ['containerClass', 'string|null', 'null', 'Kelas Tailwind tambahan untuk div wrapper pembungkus luar tabel.']];
                            @endphp
                            @foreach ($mainProps as [$prop, $type, $default, $desc])
                                <tr class="hover:bg-accent/40 transition-colors">
                                    <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</td>
                                    <td class="px-4 py-3 font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</td>
                                    <td class="px-4 py-3 font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</td>
                                    <td class="px-4 py-3 text-muted-foreground">{{ $desc }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Column props --}}
                <p class="text-sm font-semibold text-foreground pt-4">&lt;vibe:table.column&gt;</p>
                <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                    <table class="w-full text-left text-xs">
                        <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                            <tr>
                                <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/table.table_prop') }}</th>
                                <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/table.table_type') }}</th>
                                <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/table.table_default') }}</th>
                                <th class="px-4 py-3">{{ __('docs/table.table_desc') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border text-muted-foreground">
                            @php
                                $colProps = [['align', "'left'|'center'|'right'", "'left'", 'Perataan horizontal isi kolom.'], ['sortable', 'bool', 'false', 'Menandai kolom dapat diurutkan (menampilkan indikator sort).'], ['sorted', 'bool', 'false', 'Status apakah kolom sedang aktif menjadi acuan pengurutan.'], ['direction', "'asc'|'desc'|null", 'null', 'Arah panah pengurutan saat kolom berstatus sorted.']];
                            @endphp
                            @foreach ($colProps as [$prop, $type, $default, $desc])
                                <tr class="hover:bg-accent/40 transition-colors">
                                    <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</td>
                                    <td class="px-4 py-3 font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</td>
                                    <td class="px-4 py-3 font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</td>
                                    <td class="px-4 py-3 text-muted-foreground">{{ $desc }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
