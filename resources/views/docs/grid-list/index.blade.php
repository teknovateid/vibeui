<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/grid-list.title')" :description="__('docs/grid-list.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/grid-list.title'), 'url' => '/docs/grid-list']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/grid-list.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/grid-list.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/grid-list.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/grid-list.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">id</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">default-layout: list | grid</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">header-slot</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">localStorage</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">anti-flicker (zero-FOUC)</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/grid-list.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/grid-list.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/grid-list.basic_usage.preview_title')">
                    <vibe:preview.code>
                        <vibe:grid-list id="basic_catalog_demo" default-layout="grid">
                            <x-slot:header>
                                <h3 class="text-base font-semibold text-foreground">Daftar Modul Aplikasi</h3>
                            </x-slot:header>

                            @for ($i = 1; $i <= 6; $i++)
                                <vibe:grid-list.card>
                                    <div class="flex items-center justify-between">
                                        <h4 class="font-semibold text-sm text-foreground">Modul Keamanan #{{ $i }}</h4>
                                        <vibe:badge variant="outline" size="sm">v1.{{ $i }}</vibe:badge>
                                    </div>
                                    <p class="text-xs text-muted-foreground leading-relaxed mt-1">
                                        Komponen modul microservice untuk otentikasi dan kontrol otorisasi pengguna.
                                    </p>
                                </vibe:grid-list.card>
                            @endfor
                        </vibe:grid-list>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <vibe:grid-list id="docs_preview_basic" default-layout="grid">
                            <x-slot:header>
                                <h3 class="text-base font-semibold text-foreground">Daftar Modul Aplikasi</h3>
                            </x-slot:header>

                            @for ($i = 1; $i <= 6; $i++)
                                <vibe:grid-list.card>
                                    <div class="flex items-center justify-between">
                                        <h4 class="font-semibold text-sm text-foreground">Modul Keamanan #{{ $i }}</h4>
                                        <vibe:badge variant="outline" size="sm">v1.{{ $i }}</vibe:badge>
                                    </div>
                                    <p class="text-xs text-muted-foreground leading-relaxed mt-1">
                                        Komponen modul microservice untuk otentikasi dan kontrol otorisasi pengguna.
                                    </p>
                                </vibe:grid-list.card>
                            @endfor
                        </vibe:grid-list>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Default Layout --}}
            <section id="layout-default" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/grid-list.default_layout.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/grid-list.default_layout.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/grid-list.default_layout.preview_title')">
                    <vibe:preview.code>
                        {{-- Memulai tampilan awal dalam mode List --}}
                        <vibe:grid-list id="list_view_demo" default-layout="list">
                            <x-slot:header>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-base font-semibold text-foreground">Antrean Pesanan Masuk</h3>
                                    <vibe:badge variant="secondary" size="sm">3 Baru</vibe:badge>
                                </div>
                            </x-slot:header>

                            @foreach (['INV-2026-001' => 'PT Surya Digital Nusantara', 'INV-2026-002' => 'CV Tekno Pratama', 'INV-2026-003' => 'PT Maju Bersama Tech'] as $code => $client)
                                <vibe:grid-list.card>
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <span class="font-mono text-xs font-semibold text-primary">{{ $code }}</span>
                                                <vibe:badge variant="success" size="sm" class="rounded-full">Diproses</vibe:badge>
                                            </div>
                                            <p class="text-sm font-medium text-foreground">{{ $client }}</p>
                                        </div>
                                        <div class="flex items-center gap-2 shrink-0">
                                            <vibe:button variant="outline" size="sm">Detail</vibe:button>
                                            <vibe:button variant="primary" size="sm">Proses</vibe:button>
                                        </div>
                                    </div>
                                </vibe:grid-list.card>
                            @endforeach
                        </vibe:grid-list>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <vibe:grid-list id="docs_preview_list" default-layout="list">
                            <x-slot:header>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-base font-semibold text-foreground">Antrean Pesanan Masuk</h3>
                                    <vibe:badge variant="secondary" size="sm">3 Baru</vibe:badge>
                                </div>
                            </x-slot:header>

                            @foreach (['INV-2026-001' => 'PT Surya Digital Nusantara', 'INV-2026-002' => 'CV Tekno Pratama', 'INV-2026-003' => 'PT Maju Bersama Tech'] as $code => $client)
                                <vibe:grid-list.card>
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <span class="font-mono text-xs font-semibold text-primary">{{ $code }}</span>
                                                <vibe:badge variant="success" size="sm" class="rounded-full">Diproses</vibe:badge>
                                            </div>
                                            <p class="text-sm font-medium text-foreground">{{ $client }}</p>
                                        </div>
                                        <div class="flex items-center gap-2 shrink-0">
                                            <vibe:button variant="outline" size="sm">Detail</vibe:button>
                                            <vibe:button variant="primary" size="sm">Proses</vibe:button>
                                        </div>
                                    </div>
                                </vibe:grid-list.card>
                            @endforeach
                        </vibe:grid-list>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Header Slot --}}
            <section id="slot-header" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/grid-list.header_slot.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/grid-list.header_slot.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/grid-list.header_slot.preview_title')">
                    <vibe:preview.code>
                        <vibe:grid-list id="team_repos_demo" default-layout="grid">
                            <x-slot:header>
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 w-full pr-2">
                                    <div class="flex items-center gap-2.5">
                                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/grid-list.header_slot.header_title') }}</h3>
                                        <vibe:badge variant="outline" size="sm" class="rounded-full font-mono">
                                            {{ __('docs/grid-list.header_slot.count_badge') }}
                                        </vibe:badge>
                                    </div>
                                    <div class="w-full sm:w-64">
                                        <vibe:input name="repo_search" placeholder="{{ __('docs/grid-list.header_slot.search_placeholder') }}">
                                            <x-slot:leading>
                                                <svg class="size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <circle cx="11" cy="11" r="8" />
                                                    <path d="m21 21-4.3-4.3" />
                                                </svg>
                                            </x-slot:leading>
                                        </vibe:input>
                                    </div>
                                </div>
                            </x-slot:header>

                            @foreach ([['name' => 'vibe-ui/core', 'desc' => 'Core Blade and Tailwind components library for modern web apps.', 'stars' => '1.2k', 'lang' => 'PHP'], ['name' => 'vibe-ui/icons', 'desc' => 'High performance Lucide SVG icon set with direct Blade integration.', 'stars' => '840', 'lang' => 'Blade'], ['name' => 'vibe-ui/docs', 'desc' => 'Official documentation portal built with interactive live previews.', 'stars' => '520', 'lang' => 'Laravel']] as $repo)
                                <vibe:grid-list.card class="flex flex-col justify-between gap-3">
                                    <div class="space-y-1.5">
                                        <div class="flex items-center justify-between">
                                            <span class="font-mono text-sm font-semibold text-primary">{{ $repo['name'] }}</span>
                                            <span class="flex items-center gap-1 text-xs text-muted-foreground">
                                                <svg class="size-3.5 text-warning fill-warning" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                                </svg>
                                                {{ $repo['stars'] }}
                                            </span>
                                        </div>
                                        <p class="text-xs text-muted-foreground leading-relaxed">{{ $repo['desc'] }}</p>
                                    </div>
                                    <div class="flex items-center justify-between pt-1 border-t border-border/40 text-xs">
                                        <span class="text-muted-foreground flex items-center gap-1.5">
                                            <span class="size-2 rounded-full bg-primary"></span>
                                            {{ $repo['lang'] }}
                                        </span>
                                        <vibe:button variant="ghost" size="xs">Akses Repositori &rarr;</vibe:button>
                                    </div>
                                </vibe:grid-list.card>
                            @endforeach
                        </vibe:grid-list>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <vibe:grid-list id="docs_preview_header" default-layout="grid">
                            <x-slot:header>
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 w-full pr-2">
                                    <div class="flex items-center gap-2.5">
                                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/grid-list.header_slot.header_title') }}</h3>
                                        <vibe:badge variant="outline" size="sm" class="rounded-full font-mono">
                                            {{ __('docs/grid-list.header_slot.count_badge') }}
                                        </vibe:badge>
                                    </div>
                                    <div class="w-full sm:w-64">
                                        <vibe:input name="demo_repo_search" placeholder="{{ __('docs/grid-list.header_slot.search_placeholder') }}">
                                            <x-slot:leading>
                                                <svg class="size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <circle cx="11" cy="11" r="8" />
                                                    <path d="m21 21-4.3-4.3" />
                                                </svg>
                                            </x-slot:leading>
                                        </vibe:input>
                                    </div>
                                </div>
                            </x-slot:header>

                            @foreach ([['name' => 'vibe-ui/core', 'desc' => 'Core Blade and Tailwind components library for modern web apps.', 'stars' => '1.2k', 'lang' => 'PHP'], ['name' => 'vibe-ui/icons', 'desc' => 'High performance Lucide SVG icon set with direct Blade integration.', 'stars' => '840', 'lang' => 'Blade'], ['name' => 'vibe-ui/docs', 'desc' => 'Official documentation portal built with interactive live previews.', 'stars' => '520', 'lang' => 'Laravel']] as $repo)
                                <vibe:grid-list.card class="flex flex-col justify-between gap-3">
                                    <div class="space-y-1.5">
                                        <div class="flex items-center justify-between">
                                            <span class="font-mono text-sm font-semibold text-primary">{{ $repo['name'] }}</span>
                                            <span class="flex items-center gap-1 text-xs text-muted-foreground">
                                                <svg class="size-3.5 text-warning fill-warning" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                                </svg>
                                                {{ $repo['stars'] }}
                                            </span>
                                        </div>
                                        <p class="text-xs text-muted-foreground leading-relaxed">{{ $repo['desc'] }}</p>
                                    </div>
                                    <div class="flex items-center justify-between pt-1 border-t border-border/40 text-xs">
                                        <span class="text-muted-foreground flex items-center gap-1.5">
                                            <span class="size-2 rounded-full bg-primary"></span>
                                            {{ $repo['lang'] }}
                                        </span>
                                        <vibe:button variant="ghost" size="xs">Akses Repositori &rarr;</vibe:button>
                                    </div>
                                </vibe:grid-list.card>
                            @endforeach
                        </vibe:grid-list>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Rich Adaptive Cards --}}
            <section id="kartu-katalog-responsif" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/grid-list.rich_cards.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/grid-list.rich_cards.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/grid-list.rich_cards.preview_title')">
                    <vibe:preview.code>
                        <vibe:grid-list id="cloud_nodes_demo" default-layout="grid">
                            <x-slot:header>
                                <h3 class="text-base font-semibold text-foreground">Cluster Node Produksi</h3>
                            </x-slot:header>

                            @foreach ([['name' => 'sg-node-01', 'region' => 'Singapore (ap-southeast-1)', 'cpu' => '8 vCPU', 'ram' => '32 GB', 'ssd' => '500 GB', 'status' => 'active'], ['name' => 'us-node-02', 'region' => 'N. Virginia (us-east-1)', 'cpu' => '16 vCPU', 'ram' => '64 GB', 'ssd' => '1 TB', 'status' => 'active'], ['name' => 'eu-node-03', 'region' => 'Frankfurt (eu-central-1)', 'cpu' => '4 vCPU', 'ram' => '16 GB', 'ssd' => '250 GB', 'status' => 'maintenance']] as $node)
                                <vibe:grid-list.card class="flex flex-col justify-between gap-4">
                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-2">
                                                <span class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-mono text-xs font-bold">
                                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <rect width="20" height="8" x="2" y="2" rx="2" ry="2" />
                                                        <rect width="20" height="8" x="2" y="14" rx="2" ry="2" />
                                                        <line x1="6" x2="6.01" y1="6" y2="6" />
                                                        <line x1="6" x2="6.01" y1="18" y2="18" />
                                                    </svg>
                                                </span>
                                                <div>
                                                    <h4 class="font-mono text-sm font-bold text-foreground">{{ $node['name'] }}</h4>
                                                    <p class="text-[11px] text-muted-foreground">{{ $node['region'] }}</p>
                                                </div>
                                            </div>
                                            @if ($node['status'] === 'active')
                                                <vibe:badge variant="success" size="sm" class="rounded-full" dot dotPulse>
                                                    {{ __('docs/grid-list.rich_cards.status_active') }}
                                                </vibe:badge>
                                            @else
                                                <vibe:badge variant="warning" size="sm" class="rounded-full" dot>
                                                    {{ __('docs/grid-list.rich_cards.status_maintenance') }}
                                                </vibe:badge>
                                            @endif
                                        </div>

                                        {{-- Specs Grid --}}
                                        <div class="grid grid-cols-3 gap-2 pt-2 border-t border-border/40 text-center">
                                            <div class="p-1.5 rounded-lg bg-muted/40">
                                                <span class="block text-[10px] text-muted-foreground uppercase tracking-wider font-semibold">{{ __('docs/grid-list.rich_cards.cpu') }}</span>
                                                <span class="font-mono text-xs font-bold text-foreground">{{ $node['cpu'] }}</span>
                                            </div>
                                            <div class="p-1.5 rounded-lg bg-muted/40">
                                                <span class="block text-[10px] text-muted-foreground uppercase tracking-wider font-semibold">{{ __('docs/grid-list.rich_cards.ram') }}</span>
                                                <span class="font-mono text-xs font-bold text-foreground">{{ $node['ram'] }}</span>
                                            </div>
                                            <div class="p-1.5 rounded-lg bg-muted/40">
                                                <span class="block text-[10px] text-muted-foreground uppercase tracking-wider font-semibold">{{ __('docs/grid-list.rich_cards.storage') }}</span>
                                                <span class="font-mono text-xs font-bold text-foreground">{{ $node['ssd'] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-1 flex items-center justify-end gap-2">
                                        <vibe:button variant="outline" size="sm" class="w-full sm:w-auto">
                                            {{ __('docs/grid-list.rich_cards.view_details') }}
                                        </vibe:button>
                                    </div>
                                </vibe:grid-list.card>
                            @endforeach
                        </vibe:grid-list>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <vibe:grid-list id="docs_preview_rich" default-layout="grid">
                            <x-slot:header>
                                <h3 class="text-base font-semibold text-foreground">Cluster Node Produksi</h3>
                            </x-slot:header>

                            @foreach ([['name' => 'sg-node-01', 'region' => 'Singapore (ap-southeast-1)', 'cpu' => '8 vCPU', 'ram' => '32 GB', 'ssd' => '500 GB', 'status' => 'active'], ['name' => 'us-node-02', 'region' => 'N. Virginia (us-east-1)', 'cpu' => '16 vCPU', 'ram' => '64 GB', 'ssd' => '1 TB', 'status' => 'active'], ['name' => 'eu-node-03', 'region' => 'Frankfurt (eu-central-1)', 'cpu' => '4 vCPU', 'ram' => '16 GB', 'ssd' => '250 GB', 'status' => 'maintenance']] as $node)
                                <vibe:grid-list.card class="flex flex-col justify-between gap-4">
                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-2">
                                                <span class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-mono text-xs font-bold">
                                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <rect width="20" height="8" x="2" y="2" rx="2" ry="2" />
                                                        <rect width="20" height="8" x="2" y="14" rx="2" ry="2" />
                                                        <line x1="6" x2="6.01" y1="6" y2="6" />
                                                        <line x1="6" x2="6.01" y1="18" y2="18" />
                                                    </svg>
                                                </span>
                                                <div>
                                                    <h4 class="font-mono text-sm font-bold text-foreground">{{ $node['name'] }}</h4>
                                                    <p class="text-[11px] text-muted-foreground">{{ $node['region'] }}</p>
                                                </div>
                                            </div>
                                            @if ($node['status'] === 'active')
                                                <vibe:badge variant="success" size="sm" class="rounded-full" dot dotPulse>
                                                    {{ __('docs/grid-list.rich_cards.status_active') }}
                                                </vibe:badge>
                                            @else
                                                <vibe:badge variant="warning" size="sm" class="rounded-full" dot>
                                                    {{ __('docs/grid-list.rich_cards.status_maintenance') }}
                                                </vibe:badge>
                                            @endif
                                        </div>

                                        {{-- Specs Grid --}}
                                        <div class="grid grid-cols-3 gap-2 pt-2 border-t border-border/40 text-center">
                                            <div class="p-1.5 rounded-lg bg-muted/40">
                                                <span class="block text-[10px] text-muted-foreground uppercase tracking-wider font-semibold">{{ __('docs/grid-list.rich_cards.cpu') }}</span>
                                                <span class="font-mono text-xs font-bold text-foreground">{{ $node['cpu'] }}</span>
                                            </div>
                                            <div class="p-1.5 rounded-lg bg-muted/40">
                                                <span class="block text-[10px] text-muted-foreground uppercase tracking-wider font-semibold">{{ __('docs/grid-list.rich_cards.ram') }}</span>
                                                <span class="font-mono text-xs font-bold text-foreground">{{ $node['ram'] }}</span>
                                            </div>
                                            <div class="p-1.5 rounded-lg bg-muted/40">
                                                <span class="block text-[10px] text-muted-foreground uppercase tracking-wider font-semibold">{{ __('docs/grid-list.rich_cards.storage') }}</span>
                                                <span class="font-mono text-xs font-bold text-foreground">{{ $node['ssd'] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-1 flex items-center justify-end gap-2">
                                        <vibe:button variant="outline" size="sm" class="w-full sm:w-auto">
                                            {{ __('docs/grid-list.rich_cards.view_details') }}
                                        </vibe:button>
                                    </div>
                                </vibe:grid-list.card>
                            @endforeach
                        </vibe:grid-list>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Persistence & Anti-Flicker --}}
            <section id="persistensi-anti-flicker" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/grid-list.persistence.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/grid-list.persistence.desc') !!}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <vibe:card class="space-y-2.5">
                        <div class="flex items-center gap-2.5 text-foreground font-semibold text-sm">
                            <span class="flex size-7 items-center justify-center rounded-lg bg-primary/10 text-primary shrink-0">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="7 10 12 15 17 10" />
                                    <line x1="12" x2="12" y1="15" y2="3" />
                                </svg>
                            </span>
                            <span>Kunci Penyimpanan (localStorage)</span>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Preferensi layout disimpan dalam struktur JSON array di bawah kunci <code class="font-mono text-xs text-foreground">(VIBE_PREFIX || 'vibe') + '-grid-list'</code>, dipetakan secara terpisah sesuai dengan atribut <code class="font-mono text-xs text-foreground">id</code> masing-masing halaman.
                        </p>
                    </vibe:card>

                    <vibe:card class="space-y-2.5">
                        <div class="flex items-center gap-2.5 text-foreground font-semibold text-sm">
                            <span class="flex size-7 items-center justify-center rounded-lg bg-success/10 text-success shrink-0">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z" />
                                </svg>
                            </span>
                            <span>Injeksi Skrip Anti-Kedip (Zero-FOUC)</span>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Potongan skrip IIFE (*Immediately Invoked Function Expression*) dieksekusi secara sinkron sebelum render penuh diselesaikan, sehingga kelas kontainer langsung disesuaikan tanpa pergeseran tata letak (*layout jump*).
                        </p>
                    </vibe:card>
                </div>
            </section>

            {{-- 6. Props Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/grid-list.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/grid-list.props.desc') !!}
                    </p>
                </div>

                {{-- vibe:grid-list Props --}}
                <p class="text-sm font-semibold text-foreground">&lt;vibe:grid-list&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid-list.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid-list.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid-list.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/grid-list.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $gridListProps = [
                            ['id', 'string', "'default_page'", __('docs/grid-list.props_items.grid_list.id')],
                            ['defaultLayout', 'string', "'list'", __('docs/grid-list.props_items.grid_list.defaultLayout')],
                            ['title', 'string|null', 'null', __('docs/grid-list.props_items.grid_list.title')],
                            ['description', 'string|null', 'null', __('docs/grid-list.props_items.grid_list.description')],
                            ['badge', 'string|null', 'null', __('docs/grid-list.props_items.grid_list.badge')],
                            ['badgeVariant', 'string', "'secondary'", __('docs/grid-list.props_items.grid_list.badgeVariant')],
                            ['header', 'slot|null', 'null', __('docs/grid-list.props_items.grid_list.header')],
                            ['actions', 'slot|null', 'null', __('docs/grid-list.props_items.grid_list.actions')],
                            ['showSwitcher', 'bool', 'true', __('docs/grid-list.props_items.grid_list.showSwitcher')],
                        ];
                        @endphp
                        @foreach ($gridListProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- vibe:grid-list.card Props --}}
                <p class="text-sm font-semibold text-foreground pt-4">&lt;vibe:grid-list.card&gt; / &lt;vibe:grid-list.item&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid-list.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid-list.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid-list.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/grid-list.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $cardProps = [
                            ['variant', 'string', "'default'", __('docs/grid-list.props_items.card.variant')],
                            ['padding', 'string', "'sm'", __('docs/grid-list.props_items.card.padding')],
                            ['hover', 'bool', 'true', __('docs/grid-list.props_items.card.hover')],
                            ['title', 'string|null', 'null', __('docs/grid-list.props_items.card.title')],
                            ['description', 'string|null', 'null', __('docs/grid-list.props_items.card.description')],
                            ['header', 'slot|null', 'null', __('docs/grid-list.props_items.card.header')],
                            ['actions', 'slot|null', 'null', __('docs/grid-list.props_items.card.actions')],
                            ['footer', 'slot|null', 'null', __('docs/grid-list.props_items.card.footer')],
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

                {{-- Built-in Layout Classes Table --}}
                <p class="text-sm font-semibold text-foreground pt-4">{{ __('docs/grid-list.classes.title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid-list.classes.columns.mode') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/grid-list.classes.columns.classes') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/grid-list.classes.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">Grid</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-primary whitespace-nowrap">grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Menata item ke dalam sistem grid responsif 1 kolom (mobile), 2 kolom (tablet), dan 3 kolom (desktop).</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">List</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-primary whitespace-nowrap">flex flex-col gap-4</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Menata item secara vertikal memanjang ke bawah dengan lebar penuh (*full-width*).</vibe:table.cell>
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
