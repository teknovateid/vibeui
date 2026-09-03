<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/nav.title')" :description="__('docs/nav.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/nav.title'), 'url' => '/docs/nav']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/nav.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/nav.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/nav.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/nav.description') }}
                </p>

                {{-- Quick Subcomponents Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:nav&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:nav.item&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:nav.group&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:nav.label&gt;</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:nav.pinned&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:nav.history&gt;</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/nav.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/nav.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/nav.basic_usage.preview_title')">
                    <vibe:preview.code>
                        <vibe:nav id="nav-basic-demo" class="w-full max-w-xs p-2 rounded-xl border border-border bg-card shadow-2xs">
                            <vibe:nav.item href="#" :active="true">
                                <x-slot:icon>
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect width="7" height="9" x="3" y="3" rx="1" />
                                        <rect width="7" height="5" x="14" y="3" rx="1" />
                                        <rect width="7" height="9" x="14" y="12" rx="1" />
                                        <rect width="7" height="5" x="3" y="16" rx="1" />
                                    </svg>
                                </x-slot:icon>
                                {{ __('docs/nav.basic_usage.dashboard') }}
                            </vibe:nav.item>

                            <vibe:nav.item href="#">
                                <x-slot:icon>
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M3 3v18h18" />
                                        <path d="m19 9-5 5-4-4-3 3" />
                                    </svg>
                                </x-slot:icon>
                                {{ __('docs/nav.basic_usage.analytics') }}
                                <x-slot:badge>Pro</x-slot:badge>
                            </vibe:nav.item>

                            <vibe:nav.item href="#" badge="8" badgeColor="info">
                                <x-slot:icon>
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect width="20" height="16" x="2" y="4" rx="2" />
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                    </svg>
                                </x-slot:icon>
                                {{ __('docs/nav.basic_usage.messages') }}
                            </vibe:nav.item>

                            <vibe:nav.item href="#" badge="Baru" badgeColor="success">
                                <x-slot:icon>
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                                        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                                    </svg>
                                </x-slot:icon>
                                {{ __('docs/nav.basic_usage.notifications') }}
                            </vibe:nav.item>
                        </vibe:nav>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-4 sm:p-6 bg-muted/20">
                        <vibe:nav id="nav-basic-demo" class="w-full max-w-xs p-2 rounded-xl border border-border bg-card shadow-2xs space-y-1">
                            <vibe:nav.item href="#" :active="true">
                                <x-slot:icon>
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect width="7" height="9" x="3" y="3" rx="1" />
                                        <rect width="7" height="5" x="14" y="3" rx="1" />
                                        <rect width="7" height="9" x="14" y="12" rx="1" />
                                        <rect width="7" height="5" x="3" y="16" rx="1" />
                                    </svg>
                                </x-slot:icon>
                                {{ __('docs/nav.basic_usage.dashboard') }}
                            </vibe:nav.item>

                            <vibe:nav.item href="#">
                                <x-slot:icon>
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M3 3v18h18" />
                                        <path d="m19 9-5 5-4-4-3 3" />
                                    </svg>
                                </x-slot:icon>
                                {{ __('docs/nav.basic_usage.analytics') }}
                                <x-slot:badge>Pro</x-slot:badge>
                            </vibe:nav.item>

                            <vibe:nav.item href="#" badge="8" badgeColor="info">
                                <x-slot:icon>
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect width="20" height="16" x="2" y="4" rx="2" />
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                    </svg>
                                </x-slot:icon>
                                {{ __('docs/nav.basic_usage.messages') }}
                            </vibe:nav.item>

                            <vibe:nav.item href="#" badge="Baru" badgeColor="success">
                                <x-slot:icon>
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                                        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                                    </svg>
                                </x-slot:icon>
                                {{ __('docs/nav.basic_usage.notifications') }}
                            </vibe:nav.item>
                        </vibe:nav>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Collapsible Groups --}}
            <section id="kelompok-bertingkat" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/nav.groups.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/nav.groups.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/nav.groups.preview_title')">
                    <vibe:preview.code>
                        <vibe:nav id="nav-group-demo" class="w-full max-w-xs p-2 rounded-xl border border-border bg-card shadow-2xs">
                            {{-- Kelompok Menu yang Terbuka Awal (:open="true") --}}
                            <vibe:nav.group :title="__('docs/nav.groups.ecommerce')" :open="true">
                                <x-slot:icon>
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                                        <path d="M3 6h18" />
                                        <path d="M16 10a4 4 0 0 1-8 0" />
                                    </svg>
                                </x-slot:icon>
                                <vibe:nav.item href="#" :active="true">{{ __('docs/nav.groups.products') }}</vibe:nav.item>
                                <vibe:nav.item href="#" badge="14" badgeColor="warning">{{ __('docs/nav.groups.orders') }}</vibe:nav.item>
                                <vibe:nav.item href="#">{{ __('docs/nav.groups.customers') }}</vibe:nav.item>
                            </vibe:nav.group>

                            {{-- Kelompok Menu Tertutup (:open="false") --}}
                            <vibe:nav.group :title="__('docs/nav.groups.content')" :open="false">
                                <x-slot:icon>
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z" />
                                        <path d="M6 6h10" />
                                        <path d="M6 10h10" />
                                    </svg>
                                </x-slot:icon>
                                <vibe:nav.item href="#">{{ __('docs/nav.groups.articles') }}</vibe:nav.item>
                                <vibe:nav.item href="#">{{ __('docs/nav.groups.categories') }}</vibe:nav.item>
                            </vibe:nav.group>
                        </vibe:nav>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-4 sm:p-6 bg-muted/20">
                        <vibe:nav id="nav-group-demo" class="w-full max-w-xs p-2 rounded-xl border border-border bg-card shadow-2xs space-y-1">
                            <vibe:nav.group :title="__('docs/nav.groups.ecommerce')" :open="true">
                                <x-slot:icon>
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                                        <path d="M3 6h18" />
                                        <path d="M16 10a4 4 0 0 1-8 0" />
                                    </svg>
                                </x-slot:icon>
                                <vibe:nav.item href="#" :active="true">{{ __('docs/nav.groups.products') }}</vibe:nav.item>
                                <vibe:nav.item href="#" badge="14" badgeColor="warning">{{ __('docs/nav.groups.orders') }}</vibe:nav.item>
                                <vibe:nav.item href="#">{{ __('docs/nav.groups.customers') }}</vibe:nav.item>
                            </vibe:nav.group>

                            <vibe:nav.group :title="__('docs/nav.groups.content')" :open="false">
                                <x-slot:icon>
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z" />
                                        <path d="M6 6h10" />
                                        <path d="M6 10h10" />
                                    </svg>
                                </x-slot:icon>
                                <vibe:nav.item href="#">{{ __('docs/nav.groups.articles') }}</vibe:nav.item>
                                <vibe:nav.item href="#">{{ __('docs/nav.groups.categories') }}</vibe:nav.item>
                            </vibe:nav.group>
                        </vibe:nav>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Section Labels --}}
            <section id="label-bagian" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/nav.labels.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/nav.labels.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/nav.labels.preview_title')">
                    <vibe:preview.code>
                        <vibe:nav id="nav-label-demo" class="w-full max-w-xs p-2 rounded-xl border border-border bg-card shadow-2xs space-y-4">
                            {{-- Label Kategori 1 --}}
                            <vibe:nav.label :title="__('docs/nav.labels.main_section')">
                                <vibe:nav.item href="#" :active="true">
                                    <x-slot:icon>
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                                            <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                        </svg>
                                    </x-slot:icon>
                                    {{ __('docs/nav.basic_usage.dashboard') }}
                                </vibe:nav.item>
                                <vibe:nav.item href="#">
                                    <x-slot:icon>
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                            <circle cx="9" cy="7" r="4" />
                                        </svg>
                                    </x-slot:icon>
                                    {{ __('docs/nav.labels.users') }}
                                </vibe:nav.item>
                            </vibe:nav.label>

                            {{-- Label Kategori 2 --}}
                            <vibe:nav.label :title="__('docs/nav.labels.system_section')">
                                <vibe:nav.item href="#">
                                    <x-slot:icon>
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                        </svg>
                                    </x-slot:icon>
                                    {{ __('docs/nav.labels.security') }}
                                </vibe:nav.item>
                                <vibe:nav.item href="#">
                                    <x-slot:icon>
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                            <polyline points="14 2 14 8 20 8" />
                                            <line x1="16" y1="13" x2="8" y2="13" />
                                            <line x1="16" y1="17" x2="8" y2="17" />
                                        </svg>
                                    </x-slot:icon>
                                    {{ __('docs/nav.labels.audit') }}
                                </vibe:nav.item>
                            </vibe:nav.label>
                        </vibe:nav>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-4 sm:p-6 bg-muted/20">
                        <vibe:nav id="nav-label-demo" class="w-full max-w-xs p-2 rounded-xl border border-border bg-card shadow-2xs space-y-4">
                            <vibe:nav.label :title="__('docs/nav.labels.main_section')">
                                <vibe:nav.item href="#" :active="true">
                                    <x-slot:icon>
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                                            <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                        </svg>
                                    </x-slot:icon>
                                    {{ __('docs/nav.basic_usage.dashboard') }}
                                </vibe:nav.item>
                                <vibe:nav.item href="#">
                                    <x-slot:icon>
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                            <circle cx="9" cy="7" r="4" />
                                        </svg>
                                    </x-slot:icon>
                                    {{ __('docs/nav.labels.users') }}
                                </vibe:nav.item>
                            </vibe:nav.label>

                            <vibe:nav.label :title="__('docs/nav.labels.system_section')">
                                <vibe:nav.item href="#">
                                    <x-slot:icon>
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                        </svg>
                                    </x-slot:icon>
                                    {{ __('docs/nav.labels.security') }}
                                </vibe:nav.item>
                                <vibe:nav.item href="#">
                                    <x-slot:icon>
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                            <polyline points="14 2 14 8 20 8" />
                                            <line x1="16" y1="13" x2="8" y2="13" />
                                            <line x1="16" y1="17" x2="8" y2="17" />
                                        </svg>
                                    </x-slot:icon>
                                    {{ __('docs/nav.labels.audit') }}
                                </vibe:nav.item>
                            </vibe:nav.label>
                        </vibe:nav>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Pinning System --}}
            <section id="sistem-pin" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/nav.pinning.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/nav.pinning.desc') !!}
                    </p>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/nav.pinning.pinned_desc') !!}
                    </p>
                </div>

                <div class="p-3 rounded-lg border border-primary/20 bg-primary/5 text-xs text-foreground flex items-center gap-2.5">
                    <svg class="size-4 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    <span>{{ __('docs/nav.pinning.hint') }}</span>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/nav.pinning.preview_title')">
                    <vibe:preview.code>
                        {{-- Nav dengan dukungan Pinning diaktifkan (pinnable) dan batas maksimal maxpin="3" --}}
                        <vibe:nav id="nav-pinned-showcase" pinnable :maxpin="3" class="w-full max-w-xs p-2 rounded-xl border border-border bg-card shadow-2xs space-y-3">
                            {{-- Komponen Kontainer Penerima Pintasan Tersemat (vibe:nav.pinned) --}}
                            <vibe:nav.pinned :title="__('docs/nav.pinning.pinned_title')" :open="true" :persist="true" />

                            {{-- Daftar Item Navigasi yang dapat disematkan --}}
                            <vibe:nav.label title="FITUR TERSEDIA">
                                <vibe:nav.item href="#" id="pin-item-dash">
                                    <x-slot:icon>
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect width="7" height="9" x="3" y="3" rx="1" />
                                            <rect width="7" height="5" x="14" y="3" rx="1" />
                                            <rect width="7" height="9" x="14" y="12" rx="1" />
                                            <rect width="7" height="5" x="3" y="16" rx="1" />
                                        </svg>
                                    </x-slot:icon>
                                    Dashboard
                                </vibe:nav.item>

                                <vibe:nav.item href="#" id="pin-item-analytics">
                                    <x-slot:icon>
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M3 3v18h18" />
                                            <path d="m19 9-5 5-4-4-3 3" />
                                        </svg>
                                    </x-slot:icon>
                                    Analitik Performa
                                </vibe:nav.item>

                                <vibe:nav.item href="#" id="pin-item-orders">
                                    <x-slot:icon>
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                                            <path d="M3 6h18" />
                                            <path d="M16 10a4 4 0 0 1-8 0" />
                                        </svg>
                                    </x-slot:icon>
                                    Pesanan Masuk
                                </vibe:nav.item>
                            </vibe:nav.label>
                        </vibe:nav>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-4 sm:p-6 bg-muted/20">
                        <vibe:nav id="nav-pinned-showcase" pinnable :maxpin="3" class="w-full max-w-xs p-2 rounded-xl border border-border bg-card shadow-2xs space-y-3">
                            <vibe:nav.pinned :title="__('docs/nav.pinning.pinned_title')" :open="true" :persist="true" />

                            <vibe:nav.label title="FITUR TERSEDIA">
                                <vibe:nav.item href="#" id="pin-item-dash">
                                    <x-slot:icon>
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect width="7" height="9" x="3" y="3" rx="1" />
                                            <rect width="7" height="5" x="14" y="3" rx="1" />
                                            <rect width="7" height="9" x="14" y="12" rx="1" />
                                            <rect width="7" height="5" x="3" y="16" rx="1" />
                                        </svg>
                                    </x-slot:icon>
                                    Dashboard
                                </vibe:nav.item>

                                <vibe:nav.item href="#" id="pin-item-analytics">
                                    <x-slot:icon>
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M3 3v18h18" />
                                            <path d="m19 9-5 5-4-4-3 3" />
                                        </svg>
                                    </x-slot:icon>
                                    Analitik Performa
                                </vibe:nav.item>

                                <vibe:nav.item href="#" id="pin-item-orders">
                                    <x-slot:icon>
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                                            <path d="M3 6h18" />
                                            <path d="M16 10a4 4 0 0 1-8 0" />
                                        </svg>
                                    </x-slot:icon>
                                    Pesanan Masuk
                                </vibe:nav.item>
                            </vibe:nav.label>
                        </vibe:nav>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. History --}}
            <section id="riwayat-rute" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/nav.history.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/nav.history.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/nav.history.preview_title')">
                    <vibe:preview.code>
                        <vibe:nav id="nav-history-demo" class="w-full max-w-xs p-2 rounded-xl border border-border bg-card shadow-2xs">
                            {{-- Kontainer Riwayat Halaman Terkini --}}
                            <vibe:nav.history :title="__('docs/nav.history.history_title')" :open="true" :persist="true" />
                        </vibe:nav>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-4 sm:p-6 bg-muted/20">
                        <vibe:nav id="nav-history-demo" class="w-full max-w-xs p-2 rounded-xl border border-border bg-card shadow-2xs">
                            <vibe:nav.history :title="__('docs/nav.history.history_title')" :open="true" :persist="true" />
                        </vibe:nav>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Props & Subcomponents Reference --}}
            <section id="referensi-props" class="space-y-8">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/nav.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/nav.props.desc') !!}
                    </p>
                </div>

                {{-- Subcomponents Catalog Table --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground">{{ __('docs/nav.subcomponents.title') }}</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.subcomponents.columns.component') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/nav.subcomponents.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:nav&gt;</vibe:table.cell>
                                <vibe:table.cell class="text-xs text-muted-foreground">Kontainer induk navigasi yang mengelola state pinning, floating popover, dan integrasi sheet minified.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:nav.item&gt;</vibe:table.cell>
                                <vibe:table.cell class="text-xs text-muted-foreground">Link tautan menu dengan dukungan slot ikon, badge counter/status, pin toggle, dan highlight rute aktif.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:nav.group&gt;</vibe:table.cell>
                                <vibe:table.cell class="text-xs text-muted-foreground">Kelompok menu bertingkat (accordion collapsible) yang menampung daftar sub-item navigasi.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:nav.label&gt;</vibe:table.cell>
                                <vibe:table.cell class="text-xs text-muted-foreground">Header pemisah kategori bagian dengan kemampuan ciut/buka (*collapse/expand*) mandiri.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:nav.pinned&gt;</vibe:table.cell>
                                <vibe:table.cell class="text-xs text-muted-foreground">Wadah dinamis yang menampilkan klon pintasan menu yang telah di-pin oleh pengguna.</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:nav.history&gt;</vibe:table.cell>
                                <vibe:table.cell class="text-xs text-muted-foreground">Wadah dinamis yang mencatat riwayat rute halaman terakhir yang diakses pengguna.</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- vibe:nav Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground">&lt;vibe:nav&gt;</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/nav.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $navRootProps = [['id', 'string', "'sidebar-menu'", 'ID unik elemen nav untuk menyimpan preferensi di localStorage.'], ['pinnable', 'bool', 'false', 'Mengaktifkan tombol sematkan (pin) pada seluruh item navigasi di dalamnya.'], ['maxpin', 'int|null', 'null', 'Batas maksimal jumlah menu yang dapat disematkan bersamaan.'], ['collapsed', 'bool', 'false', 'Menyetel navigasi ke mode ringkas (icon-only).']];
                            @endphp
                            @foreach ($navRootProps as [$prop, $type, $default, $desc])
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

                {{-- vibe:nav.item Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground">&lt;vibe:nav.item&gt;</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/nav.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $navItemProps = [['href', 'string', "'#'", 'Target URL tujuan link tautan.'], ['active', 'bool', 'false', 'Menandai status menu saat ini aktif dengan styling latar highlight tegas.'], ['badge', 'string|null', 'null', 'Teks label badge indikator di sebelah kanan (misal counter angka atau status).'], ['badgeColor', 'string', "'vibe'", 'Warna badge: `"success"`, `"info"`, `"destructive"`, `"warning"`, `"accent"`, atau default.'], ['pinnable', 'bool', 'false', 'Menampilkan tombol pin secara spesifik pada item ini.'], ['id', 'string|null', 'slug(label)', 'ID unik item untuk keperluan persistensi pintasan pin.']];
                            @endphp
                            @foreach ($navItemProps as [$prop, $type, $default, $desc])
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

                {{-- vibe:nav.pinned Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground">&lt;vibe:nav.pinned&gt;</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/nav.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $navPinnedProps = [['title', 'string', "__('vibe/nav.pinned')", 'Teks judul header accordion wadah pintasan tersemat (default: "Pinned" atau terjemahan).'], ['open', 'bool', 'true', 'Status awal apakah wadah daftar pin terbuka atau terlipat.'], ['persist', 'bool', 'true', 'Menyimpan status buka/tutup accordion wadah pin ke `localStorage`.'], ['id', 'string|null', "'_pinned'", 'Identifier unik untuk pemetaan persistensi state accordion ke browser.']];
                            @endphp
                            @foreach ($navPinnedProps as [$prop, $type, $default, $desc])
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

                {{-- vibe:nav.group Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground">&lt;vibe:nav.group&gt;</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/nav.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $navGroupProps = [['title', 'string', '— (Wajib)', 'Judul kelompok menu accordion.'], ['open', 'bool', 'false', 'Status awal apakah kelompok menu dalam posisi terbuka.'], ['active', 'bool', 'false', 'Menandai kelompok aktif dan otomatis membukanya saat halaman dimuat.'], ['persist', 'bool', 'false', 'Menyimpan preferensi status buka/tutup kelompok ke `localStorage`.'], ['pinnable', 'bool', 'false', 'Mengizinkan seluruh kelompok menu disematkan sebagai pin shortcut.'], ['id', 'string|null', 'slug(title)', 'ID unik kelompok untuk pemetaan persistensi status buka/tutup.']];
                            @endphp
                            @foreach ($navGroupProps as [$prop, $type, $default, $desc])
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

                {{-- vibe:nav.label Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground">&lt;vibe:nav.label&gt;</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/nav.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $navLabelProps = [['title', 'string', '— (Wajib)', 'Teks judul header pemisah kategori bagian.'], ['open', 'bool', 'true', 'Status awal apakah daftar item di bawah label ditampilkan.'], ['persist', 'bool', 'false', 'Menyimpan preferensi status buka/tutup bagian ke `localStorage`.'], ['id', 'string|null', 'slug(title)', 'ID unik label untuk pemetaan persistensi state.']];
                            @endphp
                            @foreach ($navLabelProps as [$prop, $type, $default, $desc])
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

                {{-- vibe:nav.history Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground">&lt;vibe:nav.history&gt;</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/nav.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/nav.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $navHistoryProps = [['title', 'string', "__('vibe/nav.history')", 'Teks judul header wadah riwayat navigasi (default: "History").'], ['open', 'bool', 'true', 'Status awal apakah accordion riwayat terbuka atau terlipat.'], ['persist', 'bool', 'true', 'Menyimpan preferensi status buka/tutup riwayat ke `localStorage`.']];
                            @endphp
                            @foreach ($navHistoryProps as [$prop, $type, $default, $desc])
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
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
