<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/card.title')" :description="__('docs/card.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/card.title'), 'url' => '/docs/card']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/card.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/card.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/card.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/card.description') }}
                </p>

                {{-- Quick Variants Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['default', 'outline', 'flat', 'elevated', 'ghost'] as $v)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $v }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['none', 'sm', 'default', 'lg', 'xl'] as $p)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">p:{{ $p }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:card.header&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:card.footer&gt;</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/card.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/card.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/card.basic_usage.preview_title')">
                    <vibe:preview.code>
<vibe:card class="max-w-md">
    <h3 class="font-semibold text-lg text-foreground mb-1">
        {{ __('docs/card.basic_usage.sample_title') }}
    </h3>
    <p class="text-sm text-muted-foreground mb-4">
        {{ __('docs/card.basic_usage.sample_desc') }}
    </p>
    <div class="text-sm text-card-foreground">
        {{ __('docs/card.basic_usage.sample_body') }}
    </div>
</vibe:card>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-4">
                        <vibe:card class="max-w-md w-full">
                            <h3 class="font-semibold text-lg text-foreground mb-1">
                                {{ __('docs/card.basic_usage.sample_title') }}
                            </h3>
                            <p class="text-sm text-muted-foreground mb-4">
                                {{ __('docs/card.basic_usage.sample_desc') }}
                            </p>
                            <div class="text-sm text-card-foreground leading-relaxed">
                                {{ __('docs/card.basic_usage.sample_body') }}
                            </div>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Structured Card (Header, Content, Footer) --}}
            <section id="struktur-modular" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/card.structured.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/card.structured.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/card.structured.preview_title')">
                    <vibe:preview.code>
<vibe:card class="max-w-lg">
    <vibe:card.header>
        <div class="flex items-center justify-between">
            <vibe:card.title>{{ __('docs/card.structured.title_text') }}</vibe:card.title>
            <vibe:badge variant="success" dot dotPulse class="rounded-full">Aktif</vibe:badge>
        </div>
        <vibe:card.description>{{ __('docs/card.structured.desc_text') }}</vibe:card.description>
    </vibe:card.header>

    <vibe:card.content>
        <p class="leading-relaxed">{{ __('docs/card.structured.content_text') }}</p>
    </vibe:card.content>

    <vibe:card.footer>
        <vibe:button variant="ghost" size="sm">
            {{ __('docs/card.structured.footer_cancel') }}
        </vibe:button>
        <vibe:button variant="primary" size="sm">
            {{ __('docs/card.structured.footer_action') }}
        </vibe:button>
    </vibe:card.footer>
</vibe:card>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-4">
                        <vibe:card class="max-w-lg w-full">
                            <vibe:card.header>
                                <div class="flex items-center justify-between">
                                    <vibe:card.title>{{ __('docs/card.structured.title_text') }}</vibe:card.title>
                                    <vibe:badge variant="success" dot dotPulse class="rounded-full">Aktif</vibe:badge>
                                </div>
                                <vibe:card.description>{{ __('docs/card.structured.desc_text') }}</vibe:card.description>
                            </vibe:card.header>

                            <vibe:card.content>
                                <p class="leading-relaxed">{{ __('docs/card.structured.content_text') }}</p>
                            </vibe:card.content>

                            <vibe:card.footer>
                                <vibe:button variant="ghost" size="sm">
                                    {{ __('docs/card.structured.footer_cancel') }}
                                </vibe:button>
                                <vibe:button variant="primary" size="sm">
                                    {{ __('docs/card.structured.footer_action') }}
                                </vibe:button>
                            </vibe:card.footer>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Visual Variants --}}
            <section id="varian-visual" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/card.variants.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/card.variants.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/card.variants.preview_title')">
                    <vibe:preview.code>
{{-- 1. Default Card --}}
<vibe:card variant="default">
    <h4 class="font-semibold text-sm">{{ __('docs/card.variants.default') }}</h4>
</vibe:card>

{{-- 2. Outline Card --}}
<vibe:card variant="outline">
    <h4 class="font-semibold text-sm">{{ __('docs/card.variants.outline') }}</h4>
</vibe:card>

{{-- 3. Flat / Muted Card --}}
<vibe:card variant="flat">
    <h4 class="font-semibold text-sm">{{ __('docs/card.variants.flat') }}</h4>
</vibe:card>

{{-- 4. Elevated Card --}}
<vibe:card variant="elevated">
    <h4 class="font-semibold text-sm">{{ __('docs/card.variants.elevated') }}</h4>
</vibe:card>

{{-- 5. Ghost Card --}}
<vibe:card variant="ghost">
    <h4 class="font-semibold text-sm">{{ __('docs/card.variants.ghost') }}</h4>
</vibe:card>
                    </vibe:preview.code>
                    <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-2">
                        <vibe:card variant="default">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-mono font-medium text-muted-foreground">variant="default"</span>
                                <vibe:badge size="sm" variant="secondary">Default</vibe:badge>
                            </div>
                            <h4 class="font-semibold text-sm text-foreground mb-1">{{ __('docs/card.variants.default') }}</h4>
                            <p class="text-xs text-muted-foreground">Border standar dengan bayangan halus.</p>
                        </vibe:card>

                        <vibe:card variant="outline">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-mono font-medium text-muted-foreground">variant="outline"</span>
                                <vibe:badge size="sm" variant="outline">Outline</vibe:badge>
                            </div>
                            <h4 class="font-semibold text-sm text-foreground mb-1">{{ __('docs/card.variants.outline') }}</h4>
                            <p class="text-xs text-muted-foreground">Border bersih tanpa elevasi bayangan.</p>
                        </vibe:card>

                        <vibe:card variant="flat">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-mono font-medium text-muted-foreground">variant="flat"</span>
                                <vibe:badge size="sm" variant="secondary">Flat</vibe:badge>
                            </div>
                            <h4 class="font-semibold text-sm text-foreground mb-1">{{ __('docs/card.variants.flat') }}</h4>
                            <p class="text-xs text-muted-foreground">Latar belakang lembut tanpa garis tepi.</p>
                        </vibe:card>

                        <vibe:card variant="elevated">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-mono font-medium text-muted-foreground">variant="elevated"</span>
                                <vibe:badge size="sm" variant="primary">Elevated</vibe:badge>
                            </div>
                            <h4 class="font-semibold text-sm text-foreground mb-1">{{ __('docs/card.variants.elevated') }}</h4>
                            <p class="text-xs text-muted-foreground">Bayangan medium untuk kartu fokus.</p>
                        </vibe:card>

                        <vibe:card variant="ghost">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-mono font-medium text-muted-foreground">variant="ghost"</span>
                                <vibe:badge size="sm" variant="ghost">Ghost</vibe:badge>
                            </div>
                            <h4 class="font-semibold text-sm text-foreground mb-1">{{ __('docs/card.variants.ghost') }}</h4>
                            <p class="text-xs text-muted-foreground">Transparan sepenuhnya tanpa garis.</p>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Padding Options --}}
            <section id="pengaturan-padding" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/card.padding.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/card.padding.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/card.padding.preview_title')">
                    <vibe:preview.code>
{{-- Kartu dengan banner gambar (padding="none") --}}
<vibe:card padding="none" class="max-w-md overflow-hidden">
    <div class="h-32 bg-linear-to-r from-primary/80 to-primary flex items-center justify-center text-primary-foreground">
        <svg class="size-10 opacity-80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
        </svg>
    </div>
    <div class="p-6">
        <vibe:card.header class="pb-2">
            <vibe:card.title>{{ __('docs/card.padding.banner_title') }}</vibe:card.title>
            <vibe:card.description>{{ __('docs/card.padding.banner_desc') }}</vibe:card.description>
        </vibe:card.header>
        <vibe:card.footer class="pt-4 mt-2">
            <vibe:badge variant="outline" size="sm">v2.4.0</vibe:badge>
            <vibe:button size="sm" variant="outline">{{ __('docs/card.padding.read_more') }}</vibe:button>
        </vibe:card.footer>
    </div>
</vibe:card>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-4">
                        <vibe:card padding="none" class="max-w-md w-full overflow-hidden">
                            <div class="h-28 bg-linear-to-r from-primary/90 to-primary/60 flex items-center justify-center text-primary-foreground">
                                <div class="flex items-center gap-2">
                                    <svg class="size-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                                        <polyline points="3.29 7 12 12 20.71 7" />
                                        <line x1="12" y1="22" x2="12" y2="12" />
                                    </svg>
                                    <span class="font-bold tracking-tight text-lg">Vibe Ecosystem</span>
                                </div>
                            </div>
                            <div class="p-6">
                                <vibe:card.header class="pb-2">
                                    <vibe:card.title>{{ __('docs/card.padding.banner_title') }}</vibe:card.title>
                                    <vibe:card.description>{{ __('docs/card.padding.banner_desc') }}</vibe:card.description>
                                </vibe:card.header>
                                <vibe:card.footer class="pt-4 mt-2">
                                    <vibe:badge variant="outline" size="sm">v2.4.0</vibe:badge>
                                    <vibe:button size="sm" variant="outline">{{ __('docs/card.padding.read_more') }}</vibe:button>
                                </vibe:card.footer>
                            </div>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Stat & Metric Cards --}}
            <section id="kartu-metrik" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/card.metrics.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/card.metrics.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/card.metrics.preview_title')">
                    <vibe:preview.code>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- Card 1: Revenue --}}
    <vibe:card>
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-muted-foreground">{{ __('docs/card.metrics.total_revenue') }}</span>
            <vibe:badge variant="success" size="sm" class="rounded-full">{{ __('docs/card.metrics.growth_revenue') }}</vibe:badge>
        </div>
        <p class="font-bold text-2xl text-foreground">{{ __('docs/card.metrics.revenue_val') }}</p>
    </vibe:card>

    {{-- Card 2: Users --}}
    <vibe:card>
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-muted-foreground">{{ __('docs/card.metrics.active_users') }}</span>
            <vibe:badge variant="info" size="sm" class="rounded-full">{{ __('docs/card.metrics.growth_users') }}</vibe:badge>
        </div>
        <p class="font-bold text-2xl text-foreground">{{ __('docs/card.metrics.users_val') }}</p>
    </vibe:card>

    {{-- Card 3: Conversion --}}
    <vibe:card>
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-muted-foreground">{{ __('docs/card.metrics.conversion_rate') }}</span>
            <vibe:badge variant="secondary" size="sm" class="rounded-full">{{ __('docs/card.metrics.growth_conversion') }}</vibe:badge>
        </div>
        <p class="font-bold text-2xl text-foreground">{{ __('docs/card.metrics.conversion_val') }}</p>
    </vibe:card>
</div>
                    </vibe:preview.code>
                    <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-4 p-2">
                        <vibe:card class="hover:border-primary/40 transition-colors">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-medium text-muted-foreground">{{ __('docs/card.metrics.total_revenue') }}</span>
                                <vibe:badge variant="success" size="sm" class="rounded-full">{{ __('docs/card.metrics.growth_revenue') }}</vibe:badge>
                            </div>
                            <p class="font-bold text-2xl text-foreground">{{ __('docs/card.metrics.revenue_val') }}</p>
                        </vibe:card>

                        <vibe:card class="hover:border-primary/40 transition-colors">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-medium text-muted-foreground">{{ __('docs/card.metrics.active_users') }}</span>
                                <vibe:badge variant="info" size="sm" class="rounded-full">{{ __('docs/card.metrics.growth_users') }}</vibe:badge>
                            </div>
                            <p class="font-bold text-2xl text-foreground">{{ __('docs/card.metrics.users_val') }}</p>
                        </vibe:card>

                        <vibe:card class="hover:border-primary/40 transition-colors">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-medium text-muted-foreground">{{ __('docs/card.metrics.conversion_rate') }}</span>
                                <vibe:badge variant="secondary" size="sm" class="rounded-full">{{ __('docs/card.metrics.growth_conversion') }}</vibe:badge>
                            </div>
                            <p class="font-bold text-2xl text-foreground">{{ __('docs/card.metrics.conversion_val') }}</p>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Props & Slots Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/card.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/card.props.desc') !!}
                    </p>
                </div>

                {{-- vibe:card Props --}}
                <p class="text-sm font-semibold text-foreground">&lt;vibe:card&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/card.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/card.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/card.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/card.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $cardProps = [
                                ['variant', 'string', "'default'", "Gaya visual kartu: `'default'`, `'outline'`, `'flat'`, `'elevated'`, atau `'ghost'`."],
                                ['padding', 'string|null', 'null', "Ukuran padding internal: `'none'` (p-0), `'sm'` (p-4), `'lg'` (p-8), `'xl'` (p-10), atau angka kustom. Default: `p-6`."],
                            ];
                        @endphp
                        @foreach ($cardProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Subkomponen Reference --}}
                <p class="text-sm font-semibold text-foreground pt-4">{{ __('docs/card.slots.title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column>{{ __('docs/card.slots.columns.slot') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/card.slots.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:card.header&gt;</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Kontainer header kartu dengan tata letak flex vertikal dan jarak bottom bawaan.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:card.title&gt;</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Elemen judul semantik kartu (<code class="font-mono text-xs text-foreground">&lt;h3&gt;</code>) dengan typography tebal dan rapat.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:card.description&gt;</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Elemen deskripsi pendukung judul kartu dengan teks muted.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:card.content&gt;</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Kontainer pembungkus isi konten utama kartu.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:card.footer&gt;</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Bagian footer kartu yang dilengkapi garis pemisah atas dan penyusunan tombol aksi.</vibe:table.cell>
                        </vibe:table.row>
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
