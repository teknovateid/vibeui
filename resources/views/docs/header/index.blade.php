<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/header.title')" :description="__('docs/header.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/header.title'), 'url' => '/docs/header']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/header.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/header.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/header.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/header.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">variant: default | sticky</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">size: sm | default | lg</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:header.heading&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:header.subheading&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:header.actions&gt;</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/header.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/header.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/header.basic_usage.preview_title')">
                    <vibe:preview.code>
<vibe:header>
    <div>
        <vibe:header.heading>{{ __('docs/header.basic_usage.heading') }}</vibe:header.heading>
        <vibe:header.subheading>{{ __('docs/header.basic_usage.subheading') }}</vibe:header.subheading>
    </div>
    <vibe:header.actions>
        <vibe:button variant="outline" size="sm">{{ __('docs/header.basic_usage.export_btn') }}</vibe:button>
        <vibe:button variant="primary" size="sm">{{ __('docs/header.basic_usage.create_btn') }}</vibe:button>
    </vibe:header.actions>
</vibe:header>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6 bg-muted/20">
                        <vibe:card class="p-0 overflow-hidden">
                            <vibe:header>
                                <div>
                                    <vibe:header.heading>{{ __('docs/header.basic_usage.heading') }}</vibe:header.heading>
                                    <vibe:header.subheading>{{ __('docs/header.basic_usage.subheading') }}</vibe:header.subheading>
                                </div>
                                <vibe:header.actions>
                                    <vibe:button variant="outline" size="sm">{{ __('docs/header.basic_usage.export_btn') }}</vibe:button>
                                    <vibe:button variant="primary" size="sm">{{ __('docs/header.basic_usage.create_btn') }}</vibe:button>
                                </vibe:header.actions>
                            </vibe:header>
                            <div class="p-6 text-center text-xs text-muted-foreground">
                                Area Konten Halaman
                            </div>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Sizes --}}
            <section id="pilihan-ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/header.sizes.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/header.sizes.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/header.sizes.preview_title')">
                    <vibe:preview.code>
{{-- Ukuran Kecil (sm): py-2.5 px-4 --}}
<vibe:header size="sm">
    <div>
        <vibe:header.heading class="text-base">{{ __('docs/header.sizes.small_title') }}</vibe:header.heading>
        <vibe:header.subheading class="text-xs">{{ __('docs/header.sizes.small_sub') }}</vibe:header.subheading>
    </div>
    <vibe:header.actions>
        <vibe:button variant="outline" size="xs">Aksi</vibe:button>
    </vibe:header.actions>
</vibe:header>

{{-- Ukuran Standar (default): py-4 px-6 --}}
<vibe:header size="default">
    <div>
        <vibe:header.heading>{{ __('docs/header.sizes.default_title') }}</vibe:header.heading>
        <vibe:header.subheading>{{ __('docs/header.sizes.default_sub') }}</vibe:header.subheading>
    </div>
    <vibe:header.actions>
        <vibe:button variant="outline" size="sm">Aksi</vibe:button>
    </vibe:header.actions>
</vibe:header>

{{-- Ukuran Besar (lg): py-6 px-8 --}}
<vibe:header size="lg">
    <div>
        <vibe:header.heading class="text-2xl">{{ __('docs/header.sizes.large_title') }}</vibe:header.heading>
        <vibe:header.subheading class="text-base">{{ __('docs/header.sizes.large_sub') }}</vibe:header.subheading>
    </div>
    <vibe:header.actions>
        <vibe:button variant="primary" size="md">Mulai Sekarang</vibe:button>
    </vibe:header.actions>
</vibe:header>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6 bg-muted/20 space-y-6">
                        {{-- Small --}}
                        <vibe:card class="p-0 overflow-hidden">
                            <vibe:header size="sm">
                                <div>
                                    <vibe:header.heading class="text-base">{{ __('docs/header.sizes.small_title') }}</vibe:header.heading>
                                    <vibe:header.subheading class="text-xs">{{ __('docs/header.sizes.small_sub') }}</vibe:header.subheading>
                                </div>
                                <vibe:header.actions>
                                    <vibe:badge variant="outline" size="sm" class="font-mono">size="sm"</vibe:badge>
                                    <vibe:button variant="outline" size="xs">Aksi</vibe:button>
                                </vibe:header.actions>
                            </vibe:header>
                        </vibe:card>

                        {{-- Default --}}
                        <vibe:card class="p-0 overflow-hidden">
                            <vibe:header size="default">
                                <div>
                                    <vibe:header.heading>{{ __('docs/header.sizes.default_title') }}</vibe:header.heading>
                                    <vibe:header.subheading>{{ __('docs/header.sizes.default_sub') }}</vibe:header.subheading>
                                </div>
                                <vibe:header.actions>
                                    <vibe:badge variant="outline" size="sm" class="font-mono">size="default"</vibe:badge>
                                    <vibe:button variant="outline" size="sm">Aksi</vibe:button>
                                </vibe:header.actions>
                            </vibe:header>
                        </vibe:card>

                        {{-- Large --}}
                        <vibe:card class="p-0 overflow-hidden">
                            <vibe:header size="lg">
                                <div>
                                    <vibe:header.heading class="text-2xl">{{ __('docs/header.sizes.large_title') }}</vibe:header.heading>
                                    <vibe:header.subheading class="text-base">{{ __('docs/header.sizes.large_sub') }}</vibe:header.subheading>
                                </div>
                                <vibe:header.actions>
                                    <vibe:badge variant="outline" size="sm" class="font-mono">size="lg"</vibe:badge>
                                    <vibe:button variant="primary" size="md">Mulai Sekarang</vibe:button>
                                </vibe:header.actions>
                            </vibe:header>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Sticky Header --}}
            <section id="header-sticky" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/header.sticky.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/header.sticky.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/header.sticky.preview_title')">
                    <vibe:preview.code>
{{-- 1. Sticky Header standar (otomatis transparan saat di atas, semi-transparan blur saat di-scroll) --}}
<vibe:header variant="sticky">
    <div>
        <vibe:header.heading>{{ __('docs/header.sticky.sticky_heading') }}</vibe:header.heading>
        <vibe:header.subheading>{{ __('docs/header.sticky.sticky_sub') }}</vibe:header.subheading>
    </div>
    <vibe:header.actions>
        <vibe:badge variant="warning" size="sm" class="rounded-full">Pending</vibe:badge>
        <vibe:button variant="primary" size="sm">{{ __('docs/header.sticky.save_btn') }}</vibe:button>
    </vibe:header.actions>
</vibe:header>

{{-- 2. Sticky Header dengan Custom Class saat Scrolled --}}
<vibe:header
    variant="sticky"
    scrolled-class="bg-primary/90 text-primary-foreground backdrop-blur-md shadow-md border-b border-primary/30"
    unscrolled-class="bg-transparent border-b border-transparent"
    threshold="15"
>
    <div>
        <vibe:header.heading class="text-inherit">Custom Scrolled Header</vibe:header.heading>
        <vibe:header.subheading class="text-inherit opacity-80">Aktif dengan styling khusus saat di-scroll</vibe:header.subheading>
    </div>
    <vibe:header.actions>
        <vibe:badge variant="outline" size="sm" class="rounded-full border-current text-inherit">Custom</vibe:badge>
    </vibe:header.actions>
</vibe:header>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6 bg-muted/20 space-y-6">
                        {{-- Scrollable demo container 1: Default Sticky Blur --}}
                        <div class="space-y-2">
                            <span class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">1. Default Scrolled Blur:</span>
                            <vibe:card class="relative h-64 overflow-y-auto p-0">
                                <vibe:header variant="sticky">
                                    <div>
                                        <vibe:header.heading class="text-sm font-bold">{{ __('docs/header.sticky.sticky_heading') }}</vibe:header.heading>
                                        <vibe:header.subheading class="text-[11px]">{{ __('docs/header.sticky.sticky_sub') }}</vibe:header.subheading>
                                    </div>
                                    <vibe:header.actions>
                                        <vibe:badge variant="warning" size="sm" class="rounded-full">Pending</vibe:badge>
                                        <vibe:button variant="primary" size="xs">{{ __('docs/header.sticky.save_btn') }}</vibe:button>
                                    </vibe:header.actions>
                                </vibe:header>

                                <div class="p-6 space-y-4 text-xs text-muted-foreground">
                                    <p class="p-3 rounded-lg bg-muted font-mono text-[11px] text-foreground">
                                        💡 {!! __('docs/header.sticky.hint') !!}
                                    </p>
                                    @for ($j = 1; $j <= 8; $j++)
                                        <div class="p-3 rounded-lg border border-border/40 flex items-center justify-between">
                                            <span>Rincian Item Pembayaran #{{ $j }}</span>
                                            <span class="font-mono font-semibold text-foreground">Rp {{ number_format($j * 150000, 0, ',', '.') }}</span>
                                        </div>
                                    @endfor
                                </div>
                            </vibe:card>
                        </div>

                        {{-- Scrollable demo container 2: Custom Scrolled Class --}}
                        <div class="space-y-2">
                            <span class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">2. Custom Scrolled Class (Primary Tint):</span>
                            <vibe:card class="relative h-60 overflow-y-auto p-0">
                                <vibe:header variant="sticky" scrolled-class="bg-primary/90 text-primary-foreground backdrop-blur-md shadow-md border-b border-primary/30">
                                    <div>
                                        <vibe:header.heading class="text-sm font-bold text-inherit">Kustomisasi Scrolled Class</vibe:header.heading>
                                        <vibe:header.subheading class="text-[11px] text-inherit opacity-80">scrolled-class="bg-primary/90 text-primary-foreground..."</vibe:header.subheading>
                                    </div>
                                    <vibe:header.actions>
                                        <vibe:badge variant="outline" size="sm" class="rounded-full border-current text-inherit">Custom</vibe:badge>
                                    </vibe:header.actions>
                                </vibe:header>

                                <div class="p-6 space-y-4 text-xs text-muted-foreground">
                                    <p class="p-3 rounded-lg bg-muted font-mono text-[11px] text-foreground">
                                        🎨 Gulir kotak ini untuk melihat custom class <code class="font-bold">bg-primary/90</code> aktif saat di-scroll!
                                    </p>
                                    @for ($k = 1; $k <= 8; $k++)
                                        <div class="p-3 rounded-lg border border-border/40 flex items-center justify-between">
                                            <span>Aktivitas Log #{{ $k }}</span>
                                            <span class="font-mono font-semibold text-foreground">Status OK</span>
                                        </div>
                                    @endfor
                                </div>
                            </vibe:card>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Rich Composition --}}
            <section id="komposisi-lengkap" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/header.rich_composition.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/header.rich_composition.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/header.rich_composition.preview_title')">
                    <vibe:preview.code>
<vibe:card class="overflow-hidden p-0">
    {{-- Breadcrumb navigasi di atas header --}}
    <div class="px-6 pt-4">
        <vibe:breadcrumb :title="false">
            <vibe:breadcrumb.item href="#">Dashboard</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="#">Tim & Karyawan</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>Sarah Jenkins</vibe:breadcrumb.item>
        </vibe:breadcrumb>
    </div>

    {{-- Komponen Header Utama --}}
    <vibe:header class="border-none">
        <div class="flex items-center gap-4">
            <vibe:avatar
                name="Sarah Jenkins"
                size="lg"
                status="online"
                alt="Sarah Jenkins"
            />
            <div>
                <div class="flex items-center gap-2">
                    <vibe:header.heading class="text-xl font-bold">{{ __('docs/header.rich_composition.user_name') }}</vibe:header.heading>
                    <vibe:badge variant="success" size="sm" class="rounded-full" dot dotPulse>
                        {{ __('docs/header.rich_composition.status') }}
                    </vibe:badge>
                </div>
                <vibe:header.subheading>{!! __('docs/header.rich_composition.user_role') !!}</vibe:header.subheading>
            </div>
        </div>

        <vibe:header.actions>
            <vibe:button variant="outline" size="sm">
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                {{ __('docs/header.rich_composition.edit_profile') }}
            </vibe:button>
            <vibe:button variant="primary" size="sm">
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                {{ __('docs/header.rich_composition.settings') }}
            </vibe:button>
        </vibe:header.actions>
    </vibe:header>
</vibe:card>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6 bg-muted/20">
                        <vibe:card class="overflow-hidden p-0">
                            <div class="px-6 pt-4">
                                <vibe:breadcrumb :title="false">
                                    <vibe:breadcrumb.item href="#">Dashboard</vibe:breadcrumb.item>
                                    <vibe:breadcrumb.item href="#">Tim & Karyawan</vibe:breadcrumb.item>
                                    <vibe:breadcrumb.item active>Sarah Jenkins</vibe:breadcrumb.item>
                                </vibe:breadcrumb>
                            </div>

                            <vibe:header class="border-none">
                                <div class="flex items-center gap-4">
                                    <vibe:avatar
                                        name="Sarah Jenkins"
                                        size="lg"
                                        status="online"
                                        alt="Sarah Jenkins"
                                    />
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <vibe:header.heading class="text-xl font-bold">{{ __('docs/header.rich_composition.user_name') }}</vibe:header.heading>
                                            <vibe:badge variant="success" size="sm" class="rounded-full" dot dotPulse>
                                                {{ __('docs/header.rich_composition.status') }}
                                            </vibe:badge>
                                        </div>
                                        <vibe:header.subheading>{!! __('docs/header.rich_composition.user_role') !!}</vibe:header.subheading>
                                    </div>
                                </div>

                                <vibe:header.actions>
                                    <vibe:button variant="outline" size="sm">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                        {{ __('docs/header.rich_composition.edit_profile') }}
                                    </vibe:button>
                                    <vibe:button variant="primary" size="sm">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                                        {{ __('docs/header.rich_composition.settings') }}
                                    </vibe:button>
                                </vibe:header.actions>
                            </vibe:header>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Props Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/header.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/header.props.desc') !!}
                    </p>
                </div>

                {{-- vibe:header Props --}}
                <p class="text-sm font-semibold text-foreground">&lt;vibe:header&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/header.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/header.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/header.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/header.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $headerProps = [
                                ['variant', 'string', "'default'", "Variasi posisi header: `'default'` (statis normal) atau `'sticky'` (menempel di bagian atas layar dengan `sticky top-0 z-50`)."],
                                ['size', 'string', "'default'", "Ukuran padding header: `'sm'` (`py-2.5 px-4`), `'default'` (`py-4 px-6`), atau `'lg'` (`py-6 px-8`)."],
                                ['scrolledClass', 'string', "'bg-background/80 backdrop-blur-md border-b border-border/80 shadow-2xs'", "Class utility yang ditambahkan saat header `variant=\"sticky\"` di-scroll melebihi threshold."],
                                ['unscrolledClass', 'string', "'bg-transparent border-b border-transparent'", "Class utility saat header `variant=\"sticky\"` di posisi paling atas (belum di-scroll)."],
                                ['threshold', 'int', "10", "Jarak scroll (dalam pixel) sebelum status scrolled aktif."],
                            ];
                        @endphp
                        @foreach ($headerProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Subcomponents Table --}}
                <p class="text-sm font-semibold text-foreground pt-4">{{ __('docs/header.subcomponents.title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/header.subcomponents.columns.component') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/header.subcomponents.columns.tag') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/header.subcomponents.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:header.heading&gt;</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-primary whitespace-nowrap">&lt;h2&gt;</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Merender judul halaman utama dengan tipografi tegas (<code class="font-mono text-foreground">text-lg font-semibold tracking-tight text-foreground</code>).</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:header.subheading&gt;</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-primary whitespace-nowrap">&lt;p&gt;</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Merender deskripsi sekunder atau metadata ringkas (<code class="font-mono text-foreground">text-sm text-muted-foreground mt-1</code>).</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:header.actions&gt;</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-primary whitespace-nowrap">&lt;div&gt;</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Wadah kelompok tombol aksi, dropdown menu, filter, atau input pencarian (<code class="font-mono text-foreground">flex items-center gap-3 shrink-0</code>).</vibe:table.cell>
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
