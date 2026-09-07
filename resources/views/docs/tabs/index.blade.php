<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/tabs.title')" :description="__('docs/tabs.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/tabs.title'), 'url' => '/docs/tabs']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/tabs.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/tabs.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/tabs.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/tabs.description') }}
                </p>

                {{-- Quick Props & Layouts Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['layout:rows', 'layout:cols'] as $l)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $l }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['pill', 'underline', 'button'] as $v)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $v }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['sm', 'md', 'lg'] as $s)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $s }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">persist</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">fitted</vibe:badge>
                </div>
            </div>

            {{-- 1. Desain 2 Baris (Horizontal Tabs) --}}
            <section id="desain-2-baris" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/tabs.rows.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/tabs.rows.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/tabs.rows.preview_title')">
                    <vibe:preview.code>
<vibe:tabs default="profile" layout="rows" variant="pill">
    <vibe:tabs.list>
        <vibe:tabs.tab name="profile">
            <x-slot:icon>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg>
            </x-slot:icon>
            {{ __('docs/tabs.rows.tab_profile') }}
        </vibe:tabs.tab>

        <vibe:tabs.tab name="account">
            <x-slot:icon>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </x-slot:icon>
            {{ __('docs/tabs.rows.tab_account') }}
        </vibe:tabs.tab>

        <vibe:tabs.tab name="billing">
            <x-slot:icon>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
            </x-slot:icon>
            {{ __('docs/tabs.rows.tab_billing') }}
        </vibe:tabs.tab>
    </vibe:tabs.list>

    <vibe:tabs.panel name="profile">
        <vibe:card>
            <h3 class="font-semibold text-base text-foreground">{{ __('docs/tabs.rows.profile_title') }}</h3>
            <p class="text-sm text-muted-foreground mt-1">{{ __('docs/tabs.rows.profile_desc') }}</p>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="account">
        <vibe:card>
            <h3 class="font-semibold text-base text-foreground">{{ __('docs/tabs.rows.account_title') }}</h3>
            <p class="text-sm text-muted-foreground mt-1">{{ __('docs/tabs.rows.account_desc') }}</p>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="billing">
        <vibe:card>
            <h3 class="font-semibold text-base text-foreground">{{ __('docs/tabs.rows.billing_title') }}</h3>
            <p class="text-sm text-muted-foreground mt-1">{{ __('docs/tabs.rows.billing_desc') }}</p>
        </vibe:card>
    </vibe:tabs.panel>
</vibe:tabs>
                    </vibe:preview.code>

                    <div class="p-6">
                        <vibe:tabs default="profile" layout="rows" variant="pill">
                            <vibe:tabs.list>
                                <vibe:tabs.tab name="profile">
                                    <x-slot:icon>
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg>
                                    </x-slot:icon>
                                    {{ __('docs/tabs.rows.tab_profile') }}
                                </vibe:tabs.tab>

                                <vibe:tabs.tab name="account">
                                    <x-slot:icon>
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    </x-slot:icon>
                                    {{ __('docs/tabs.rows.tab_account') }}
                                </vibe:tabs.tab>

                                <vibe:tabs.tab name="billing">
                                    <x-slot:icon>
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                                    </x-slot:icon>
                                    {{ __('docs/tabs.rows.tab_billing') }}
                                </vibe:tabs.tab>
                            </vibe:tabs.list>

                            <vibe:tabs.panel name="profile">
                                <vibe:card>
                                    <h3 class="font-semibold text-base text-foreground">{{ __('docs/tabs.rows.profile_title') }}</h3>
                                    <p class="text-sm text-muted-foreground mt-1">{{ __('docs/tabs.rows.profile_desc') }}</p>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="account">
                                <vibe:card>
                                    <h3 class="font-semibold text-base text-foreground">{{ __('docs/tabs.rows.account_title') }}</h3>
                                    <p class="text-sm text-muted-foreground mt-1">{{ __('docs/tabs.rows.account_desc') }}</p>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="billing">
                                <vibe:card>
                                    <h3 class="font-semibold text-base text-foreground">{{ __('docs/tabs.rows.billing_title') }}</h3>
                                    <p class="text-sm text-muted-foreground mt-1">{{ __('docs/tabs.rows.billing_desc') }}</p>
                                </vibe:card>
                            </vibe:tabs.panel>
                        </vibe:tabs>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Desain 2 Kolom (Vertical Side-by-Side Tabs) --}}
            <section id="desain-2-kolom" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/tabs.cols.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/tabs.cols.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/tabs.cols.preview_title')">
                    <vibe:preview.code>
<vibe:tabs default="general" layout="cols" variant="underline">
    <vibe:tabs.list class="w-full md:w-64">
        <vibe:tabs.tab name="general">
            <x-slot:icon>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
            </x-slot:icon>
            {{ __('docs/tabs.cols.tab_general') }}
        </vibe:tabs.tab>

        <vibe:tabs.tab name="security">
            <x-slot:icon>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </x-slot:icon>
            {{ __('docs/tabs.cols.tab_security') }}
        </vibe:tabs.tab>

        <vibe:tabs.tab name="notifications" badge="3">
            <x-slot:icon>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
            </x-slot:icon>
            {{ __('docs/tabs.cols.tab_notifications') }}
        </vibe:tabs.tab>

        <vibe:tabs.tab name="integrations">
            <x-slot:icon>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>
            </x-slot:icon>
            {{ __('docs/tabs.cols.tab_integrations') }}
        </vibe:tabs.tab>
    </vibe:tabs.list>

    <vibe:tabs.panel name="general">
        <vibe:card>
            <h3 class="font-semibold text-base text-foreground">{{ __('docs/tabs.cols.general_title') }}</h3>
            <p class="text-sm text-muted-foreground mt-1">{{ __('docs/tabs.cols.general_desc') }}</p>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="security">
        <vibe:card>
            <h3 class="font-semibold text-base text-foreground">{{ __('docs/tabs.cols.security_title') }}</h3>
            <p class="text-sm text-muted-foreground mt-1">{{ __('docs/tabs.cols.security_desc') }}</p>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="notifications">
        <vibe:card>
            <h3 class="font-semibold text-base text-foreground">{{ __('docs/tabs.cols.notif_title') }}</h3>
            <p class="text-sm text-muted-foreground mt-1">{{ __('docs/tabs.cols.notif_desc') }}</p>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="integrations">
        <vibe:card>
            <h3 class="font-semibold text-base text-foreground">{{ __('docs/tabs.cols.integrations_title') }}</h3>
            <p class="text-sm text-muted-foreground mt-1">{{ __('docs/tabs.cols.integrations_desc') }}</p>
        </vibe:card>
    </vibe:tabs.panel>
</vibe:tabs>
                    </vibe:preview.code>

                    <div class="p-6">
                        <vibe:tabs default="general" layout="cols" variant="underline">
                            <vibe:tabs.list class="w-full md:w-64">
                                <vibe:tabs.tab name="general">
                                    <x-slot:icon>
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                                    </x-slot:icon>
                                    {{ __('docs/tabs.cols.tab_general') }}
                                </vibe:tabs.tab>

                                <vibe:tabs.tab name="security">
                                    <x-slot:icon>
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    </x-slot:icon>
                                    {{ __('docs/tabs.cols.tab_security') }}
                                </vibe:tabs.tab>

                                <vibe:tabs.tab name="notifications" badge="3">
                                    <x-slot:icon>
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                                    </x-slot:icon>
                                    {{ __('docs/tabs.cols.tab_notifications') }}
                                </vibe:tabs.tab>

                                <vibe:tabs.tab name="integrations">
                                    <x-slot:icon>
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>
                                    </x-slot:icon>
                                    {{ __('docs/tabs.cols.tab_integrations') }}
                                </vibe:tabs.tab>
                            </vibe:tabs.list>

                            <vibe:tabs.panel name="general">
                                <vibe:card>
                                    <h3 class="font-semibold text-base text-foreground">{{ __('docs/tabs.cols.general_title') }}</h3>
                                    <p class="text-sm text-muted-foreground mt-1">{{ __('docs/tabs.cols.general_desc') }}</p>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="security">
                                <vibe:card>
                                    <h3 class="font-semibold text-base text-foreground">{{ __('docs/tabs.cols.security_title') }}</h3>
                                    <p class="text-sm text-muted-foreground mt-1">{{ __('docs/tabs.cols.security_desc') }}</p>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="notifications">
                                <vibe:card>
                                    <h3 class="font-semibold text-base text-foreground">{{ __('docs/tabs.cols.notif_title') }}</h3>
                                    <p class="text-sm text-muted-foreground mt-1">{{ __('docs/tabs.cols.notif_desc') }}</p>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="integrations">
                                <vibe:card>
                                    <h3 class="font-semibold text-base text-foreground">{{ __('docs/tabs.cols.integrations_title') }}</h3>
                                    <p class="text-sm text-muted-foreground mt-1">{{ __('docs/tabs.cols.integrations_desc') }}</p>
                                </vibe:card>
                            </vibe:tabs.panel>
                        </vibe:tabs>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Varian Gaya Visual --}}
            <section id="varian-gaya" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/tabs.variants.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/tabs.variants.desc') !!}
                    </p>
                </div>

                {{-- Pill Variant --}}
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/tabs.variants.pill_label') }}</h3>
                    <vibe:preview>
                        <vibe:preview.code>
<vibe:tabs default="tab1" variant="pill">
    <vibe:tabs.list>
        <vibe:tabs.tab name="tab1">Overview</vibe:tabs.tab>
        <vibe:tabs.tab name="tab2">Analytics</vibe:tabs.tab>
        <vibe:tabs.tab name="tab3">Reports</vibe:tabs.tab>
    </vibe:tabs.list>
</vibe:tabs>
                        </vibe:preview.code>
                        <div class="p-6">
                            <vibe:tabs default="tab1" variant="pill">
                                <vibe:tabs.list>
                                    <vibe:tabs.tab name="tab1">Overview</vibe:tabs.tab>
                                    <vibe:tabs.tab name="tab2">Analytics</vibe:tabs.tab>
                                    <vibe:tabs.tab name="tab3">Reports</vibe:tabs.tab>
                                </vibe:tabs.list>
                            </vibe:tabs>
                        </div>
                    </vibe:preview>
                </div>

                {{-- Underline Variant --}}
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/tabs.variants.underline_label') }}</h3>
                    <vibe:preview>
                        <vibe:preview.code>
<vibe:tabs default="tab1" variant="underline">
    <vibe:tabs.list>
        <vibe:tabs.tab name="tab1">Overview</vibe:tabs.tab>
        <vibe:tabs.tab name="tab2">Analytics</vibe:tabs.tab>
        <vibe:tabs.tab name="tab3">Reports</vibe:tabs.tab>
    </vibe:tabs.list>
</vibe:tabs>
                        </vibe:preview.code>
                        <div class="p-6">
                            <vibe:tabs default="tab1" variant="underline">
                                <vibe:tabs.list>
                                    <vibe:tabs.tab name="tab1">Overview</vibe:tabs.tab>
                                    <vibe:tabs.tab name="tab2">Analytics</vibe:tabs.tab>
                                    <vibe:tabs.tab name="tab3">Reports</vibe:tabs.tab>
                                </vibe:tabs.list>
                            </vibe:tabs>
                        </div>
                    </vibe:preview>
                </div>

                {{-- Button / Outline Variant --}}
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/tabs.variants.button_label') }}</h3>
                    <vibe:preview>
                        <vibe:preview.code>
<vibe:tabs default="tab1" variant="button">
    <vibe:tabs.list>
        <vibe:tabs.tab name="tab1">Overview</vibe:tabs.tab>
        <vibe:tabs.tab name="tab2">Analytics</vibe:tabs.tab>
        <vibe:tabs.tab name="tab3">Reports</vibe:tabs.tab>
    </vibe:tabs.list>
</vibe:tabs>
                        </vibe:preview.code>
                        <div class="p-6">
                            <vibe:tabs default="tab1" variant="button">
                                <vibe:tabs.list>
                                    <vibe:tabs.tab name="tab1">Overview</vibe:tabs.tab>
                                    <vibe:tabs.tab name="tab2">Analytics</vibe:tabs.tab>
                                    <vibe:tabs.tab name="tab3">Reports</vibe:tabs.tab>
                                </vibe:tabs.list>
                            </vibe:tabs>
                        </div>
                    </vibe:preview>
                </div>
            </section>

            {{-- 4. Tab dengan Ikon SVG & Badge --}}
            <section id="ikon-dan-badge" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/tabs.icons.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/tabs.icons.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/tabs.icons.preview_title')">
                    <vibe:preview.code>
<vibe:tabs default="inbox" variant="pill">
    <vibe:tabs.list>
        <vibe:tabs.tab name="inbox" badge="12" badgeVariant="primary">
            <x-slot:icon>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            </x-slot:icon>
            {{ __('docs/tabs.icons.tab_inbox') }}
        </vibe:tabs.tab>

        <vibe:tabs.tab name="sent">
            <x-slot:icon>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" x2="11" y1="2" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            </x-slot:icon>
            {{ __('docs/tabs.icons.tab_sent') }}
        </vibe:tabs.tab>

        <vibe:tabs.tab name="archive">
            <x-slot:icon>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="5" x="2" y="3" rx="1"/><path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"/><path d="M10 12h4"/></svg>
            </x-slot:icon>
            {{ __('docs/tabs.icons.tab_archive') }}
        </vibe:tabs.tab>
    </vibe:tabs.list>

    <vibe:tabs.panel name="inbox">
        <vibe:card class="mt-4">
            <p class="text-sm text-foreground">{{ __('docs/tabs.icons.inbox_content') }}</p>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="sent">
        <vibe:card class="mt-4">
            <p class="text-sm text-foreground">{{ __('docs/tabs.icons.sent_content') }}</p>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="archive">
        <vibe:card class="mt-4">
            <p class="text-sm text-foreground">{{ __('docs/tabs.icons.archive_content') }}</p>
        </vibe:card>
    </vibe:tabs.panel>
</vibe:tabs>
                    </vibe:preview.code>

                    <div class="p-6">
                        <vibe:tabs default="inbox" variant="pill">
                            <vibe:tabs.list>
                                <vibe:tabs.tab name="inbox" badge="12" badgeVariant="primary">
                                    <x-slot:icon>
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                    </x-slot:icon>
                                    {{ __('docs/tabs.icons.tab_inbox') }}
                                </vibe:tabs.tab>

                                <vibe:tabs.tab name="sent">
                                    <x-slot:icon>
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" x2="11" y1="2" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                                    </x-slot:icon>
                                    {{ __('docs/tabs.icons.tab_sent') }}
                                </vibe:tabs.tab>

                                <vibe:tabs.tab name="archive">
                                    <x-slot:icon>
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="5" x="2" y="3" rx="1"/><path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"/><path d="M10 12h4"/></svg>
                                    </x-slot:icon>
                                    {{ __('docs/tabs.icons.tab_archive') }}
                                </vibe:tabs.tab>
                            </vibe:tabs.list>

                            <vibe:tabs.panel name="inbox">
                                <vibe:card class="mt-4">
                                    <p class="text-sm text-foreground">{{ __('docs/tabs.icons.inbox_content') }}</p>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="sent">
                                <vibe:card class="mt-4">
                                    <p class="text-sm text-foreground">{{ __('docs/tabs.icons.sent_content') }}</p>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="archive">
                                <vibe:card class="mt-4">
                                    <p class="text-sm text-foreground">{{ __('docs/tabs.icons.archive_content') }}</p>
                                </vibe:card>
                            </vibe:tabs.panel>
                        </vibe:tabs>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Tab Lebar Penuh (Fitted) --}}
            <section id="tab-lebar-penuh" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/tabs.fitted.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/tabs.fitted.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/tabs.fitted.preview_title')">
                    <vibe:preview.code>
<vibe:tabs default="daily" variant="pill">
    <vibe:tabs.list fitted="true">
        <vibe:tabs.tab name="daily">{{ __('docs/tabs.fitted.tab_daily') }}</vibe:tabs.tab>
        <vibe:tabs.tab name="weekly">{{ __('docs/tabs.fitted.tab_weekly') }}</vibe:tabs.tab>
        <vibe:tabs.tab name="monthly">{{ __('docs/tabs.fitted.tab_monthly') }}</vibe:tabs.tab>
        <vibe:tabs.tab name="yearly">{{ __('docs/tabs.fitted.tab_yearly') }}</vibe:tabs.tab>
    </vibe:tabs.list>
</vibe:tabs>
                    </vibe:preview.code>

                    <div class="p-6">
                        <vibe:tabs default="daily" variant="pill">
                            <vibe:tabs.list fitted="true">
                                <vibe:tabs.tab name="daily">{{ __('docs/tabs.fitted.tab_daily') }}</vibe:tabs.tab>
                                <vibe:tabs.tab name="weekly">{{ __('docs/tabs.fitted.tab_weekly') }}</vibe:tabs.tab>
                                <vibe:tabs.tab name="monthly">{{ __('docs/tabs.fitted.tab_monthly') }}</vibe:tabs.tab>
                                <vibe:tabs.tab name="yearly">{{ __('docs/tabs.fitted.tab_yearly') }}</vibe:tabs.tab>
                            </vibe:tabs.list>
                        </vibe:tabs>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Persistensi LocalStorage --}}
            <section id="persistensi-tabs" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/tabs.persist.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/tabs.persist.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/tabs.persist.preview_title')">
                    <vibe:preview.code>
<vibe:tabs id="demo-persist-tabs" default="step1" :persist="true" variant="pill">
    <vibe:tabs.list>
        <vibe:tabs.tab name="step1">{{ __('docs/tabs.persist.tab_step1') }}</vibe:tabs.tab>
        <vibe:tabs.tab name="step2">{{ __('docs/tabs.persist.tab_step2') }}</vibe:tabs.tab>
        <vibe:tabs.tab name="step3">{{ __('docs/tabs.persist.tab_step3') }}</vibe:tabs.tab>
    </vibe:tabs.list>

    <vibe:tabs.panel name="step1">
        <vibe:card class="mt-4">
            <h4 class="font-semibold">{{ __('docs/tabs.persist.tab_step1') }}</h4>
            <p class="text-sm text-muted-foreground mt-1">{!! __('docs/tabs.persist.reload_tip') !!}</p>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="step2">
        <vibe:card class="mt-4">
            <h4 class="font-semibold">{{ __('docs/tabs.persist.tab_step2') }}</h4>
            <p class="text-sm text-muted-foreground mt-1">{!! __('docs/tabs.persist.reload_tip') !!}</p>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="step3">
        <vibe:card class="mt-4">
            <h4 class="font-semibold">{{ __('docs/tabs.persist.tab_step3') }}</h4>
            <p class="text-sm text-muted-foreground mt-1">{!! __('docs/tabs.persist.reload_tip') !!}</p>
        </vibe:card>
    </vibe:tabs.panel>
</vibe:tabs>
                    </vibe:preview.code>

                    <div class="p-6 space-y-4" x-data="{
                        resetStorage() {
                            if (window.Alpine && Alpine.store('vibeTabs')) {
                                Alpine.store('vibeTabs').reset('demo-persist-tabs');
                            } else if (window.VibeTabs) {
                                window.VibeTabs.reset('demo-persist-tabs');
                            }
                            $dispatch('change-tab', { id: 'demo-persist-tabs', tab: 'step1' });
                            if (typeof vibeToast === 'function') {
                                vibeToast({
                                    type: 'success',
                                    title: '{{ __('docs/tabs.persist.reset_btn') }}',
                                    message: '{{ __('docs/tabs.persist.reset_toast') }}'
                                });
                            }
                        }
                    }">
                        <div class="flex justify-end">
                            <vibe:button @click="resetStorage" variant="ghost" size="sm" class="text-muted-foreground hover:text-foreground">
                                <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                                    <path d="M3 3v5h5"/>
                                </svg>
                                {{ __('docs/tabs.persist.reset_btn') }}
                            </vibe:button>
                        </div>

                        <vibe:tabs id="demo-persist-tabs" default="step1" :persist="true" variant="pill">
                            <vibe:tabs.list>
                                <vibe:tabs.tab name="step1">{{ __('docs/tabs.persist.tab_step1') }}</vibe:tabs.tab>
                                <vibe:tabs.tab name="step2">{{ __('docs/tabs.persist.tab_step2') }}</vibe:tabs.tab>
                                <vibe:tabs.tab name="step3">{{ __('docs/tabs.persist.tab_step3') }}</vibe:tabs.tab>
                            </vibe:tabs.list>

                            <vibe:tabs.panel name="step1">
                                <vibe:card class="mt-4">
                                    <h4 class="font-semibold">{{ __('docs/tabs.persist.tab_step1') }}</h4>
                                    <p class="text-sm text-muted-foreground mt-1">{!! __('docs/tabs.persist.reload_tip') !!}</p>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="step2">
                                <vibe:card class="mt-4">
                                    <h4 class="font-semibold">{{ __('docs/tabs.persist.tab_step2') }}</h4>
                                    <p class="text-sm text-muted-foreground mt-1">{!! __('docs/tabs.persist.reload_tip') !!}</p>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="step3">
                                <vibe:card class="mt-4">
                                    <h4 class="font-semibold">{{ __('docs/tabs.persist.tab_step3') }}</h4>
                                    <p class="text-sm text-muted-foreground mt-1">{!! __('docs/tabs.persist.reload_tip') !!}</p>
                                </vibe:card>
                            </vibe:tabs.panel>
                        </vibe:tabs>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Integrasi Livewire & URL Sync --}}
            <section id="integrasi-livewire" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/tabs.livewire.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/tabs.livewire.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/tabs.livewire.preview_title')">
                    <vibe:preview.code>
{{-- Sinkronisasi tab aktif ke URL browser (?tab=security) --}}
<vibe:tabs id="livewire-tabs-demo" default="profile" syncUrl="tab" variant="pill">
    <vibe:tabs.list>
        <vibe:tabs.tab name="profile">Profile</vibe:tabs.tab>
        <vibe:tabs.tab name="security">Security</vibe:tabs.tab>
        <vibe:tabs.tab name="notifications">Notifications</vibe:tabs.tab>
    </vibe:tabs.list>

    <vibe:tabs.panel name="profile">
        <p>Konten Profil...</p>
    </vibe:tabs.panel>
    <vibe:tabs.panel name="security">
        <p>Konten Keamanan...</p>
    </vibe:tabs.panel>
    <vibe:tabs.panel name="notifications">
        <p>Konten Notifikasi...</p>
    </vibe:tabs.panel>
</vibe:tabs>

{{-- Mengontrol tab dari Livewire Component --}}
{{-- $this->dispatch('change-tab', ['id' => 'livewire-tabs-demo', 'tab' => 'security']) --}}
                    </vibe:preview.code>

                    <div class="p-6 space-y-4" x-data="{
                        currentUrlTab: new URLSearchParams(window.location.search).get('tab') || 'profile',
                        init() {
                            window.addEventListener('tab-changed', e => {
                                if (e.detail?.id === 'livewire-tabs-demo') {
                                    this.currentUrlTab = e.detail.tab;
                                }
                            });
                        }
                    }">
                        {{-- Controls simulating Livewire external event dispatch --}}
                        <div class="flex flex-wrap items-center justify-between gap-3 p-3 bg-muted/60 dark:bg-muted/30 rounded-xl border border-border/60 text-xs">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="font-medium text-foreground">Livewire Simulator:</span>
                                <vibe:button size="xs" variant="outline" @click="$dispatch('change-tab', { id: 'livewire-tabs-demo', tab: 'profile' })">
                                    Profile
                                </vibe:button>
                                <vibe:button size="xs" variant="outline" @click="$dispatch('change-tab', { id: 'livewire-tabs-demo', tab: 'security' })">
                                    Security
                                </vibe:button>
                                <vibe:button size="xs" variant="outline" @click="$dispatch('change-tab', { id: 'livewire-tabs-demo', tab: 'notifications' })">
                                    Notifications
                                </vibe:button>
                            </div>
                            <div class="flex items-center gap-1.5 font-mono text-[11px] text-muted-foreground">
                                <span>URL Query:</span>
                                <span class="px-1.5 py-0.5 rounded bg-background border border-border font-bold text-foreground">?tab=<span x-text="currentUrlTab"></span></span>
                            </div>
                        </div>

                        <vibe:tabs id="livewire-tabs-demo" default="profile" syncUrl="tab" variant="pill">
                            <vibe:tabs.list>
                                <vibe:tabs.tab name="profile">
                                    <x-slot:icon>
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg>
                                    </x-slot:icon>
                                    Profile
                                </vibe:tabs.tab>
                                <vibe:tabs.tab name="security">
                                    <x-slot:icon>
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    </x-slot:icon>
                                    Security
                                </vibe:tabs.tab>
                                <vibe:tabs.tab name="notifications">
                                    <x-slot:icon>
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                                    </x-slot:icon>
                                    Notifications
                                </vibe:tabs.tab>
                            </vibe:tabs.list>

                            <vibe:tabs.panel name="profile">
                                <vibe:card class="mt-4">
                                    <h4 class="font-semibold text-foreground">User Profile Settings</h4>
                                    <p class="text-sm text-muted-foreground mt-1">Perubahan tab akan otomatis disinkronkan ke parameter query URL browser (?tab=profile).</p>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="security">
                                <vibe:card class="mt-4">
                                    <h4 class="font-semibold text-foreground">Security &amp; Two-Factor Authentication</h4>
                                    <p class="text-sm text-muted-foreground mt-1">Status tab ini dapat dikontrol secara remote oleh server Livewire maupun URL browser.</p>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="notifications">
                                <vibe:card class="mt-4">
                                    <h4 class="font-semibold text-foreground">Notification Preferences</h4>
                                    <p class="text-sm text-muted-foreground mt-1">Semua perubahan memicu event Alpine/Livewire `tab-changed`.</p>
                                </vibe:card>
                            </vibe:tabs.panel>
                        </vibe:tabs>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Referensi Properti & API --}}
            <section id="referensi-api" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/tabs.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/tabs.props.desc') !!}
                    </p>
                </div>

                {{-- <vibe:tabs> Table --}}
                <div class="space-y-2">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/tabs.props.tabs_title') }}</h3>
                    <div class="overflow-x-auto rounded-xl border border-border bg-card shadow-2xs">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-muted/50 text-xs font-semibold uppercase tracking-wider text-muted-foreground border-b border-border">
                                <tr>
                                    <th class="px-4 py-3">{{ __('docs/tabs.props.th_prop') }}</th>
                                    <th class="px-4 py-3">{{ __('docs/tabs.props.th_type') }}</th>
                                    <th class="px-4 py-3">{{ __('docs/tabs.props.th_default') }}</th>
                                    <th class="px-4 py-3">{{ __('docs/tabs.props.th_desc') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border font-mono text-xs">
                                @foreach (__('docs/tabs.props.tabs_items') as $item)
                                    <tr class="hover:bg-muted/20 transition-colors">
                                        <td class="px-4 py-3 font-semibold text-primary">{{ $item['name'] }}</td>
                                        <td class="px-4 py-3 text-muted-foreground">{{ $item['type'] }}</td>
                                        <td class="px-4 py-3 text-foreground">{{ $item['default'] }}</td>
                                        <td class="px-4 py-3 font-sans text-xs text-muted-foreground">{{ $item['desc'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- <vibe:tabs.tab> Table --}}
                <div class="space-y-2 pt-2">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/tabs.props.tab_title') }}</h3>
                    <div class="overflow-x-auto rounded-xl border border-border bg-card shadow-2xs">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-muted/50 text-xs font-semibold uppercase tracking-wider text-muted-foreground border-b border-border">
                                <tr>
                                    <th class="px-4 py-3">{{ __('docs/tabs.props.th_prop') }}</th>
                                    <th class="px-4 py-3">{{ __('docs/tabs.props.th_type') }}</th>
                                    <th class="px-4 py-3">{{ __('docs/tabs.props.th_default') }}</th>
                                    <th class="px-4 py-3">{{ __('docs/tabs.props.th_desc') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border font-mono text-xs">
                                @foreach (__('docs/tabs.props.tab_items') as $item)
                                    <tr class="hover:bg-muted/20 transition-colors">
                                        <td class="px-4 py-3 font-semibold text-primary">{{ $item['name'] }}</td>
                                        <td class="px-4 py-3 text-muted-foreground">{{ $item['type'] }}</td>
                                        <td class="px-4 py-3 text-foreground">{{ $item['default'] }}</td>
                                        <td class="px-4 py-3 font-sans text-xs text-muted-foreground">{{ $item['desc'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- <vibe:tabs.list> & <vibe:tabs.panel> Table --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                    <div class="space-y-2">
                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/tabs.props.list_title') }}</h3>
                        <div class="overflow-x-auto rounded-xl border border-border bg-card shadow-2xs">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-muted/50 text-xs font-semibold uppercase tracking-wider text-muted-foreground border-b border-border">
                                    <tr>
                                        <th class="px-4 py-3">{{ __('docs/tabs.props.th_prop') }}</th>
                                        <th class="px-4 py-3">{{ __('docs/tabs.props.th_type') }}</th>
                                        <th class="px-4 py-3">{{ __('docs/tabs.props.th_desc') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border font-mono text-xs">
                                    @foreach (__('docs/tabs.props.list_items') as $item)
                                        <tr class="hover:bg-muted/20 transition-colors">
                                            <td class="px-4 py-3 font-semibold text-primary">{{ $item['name'] }}</td>
                                            <td class="px-4 py-3 text-muted-foreground">{{ $item['type'] }}</td>
                                            <td class="px-4 py-3 font-sans text-xs text-muted-foreground">{{ $item['desc'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/tabs.props.panel_title') }}</h3>
                        <div class="overflow-x-auto rounded-xl border border-border bg-card shadow-2xs">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-muted/50 text-xs font-semibold uppercase tracking-wider text-muted-foreground border-b border-border">
                                    <tr>
                                        <th class="px-4 py-3">{{ __('docs/tabs.props.th_prop') }}</th>
                                        <th class="px-4 py-3">{{ __('docs/tabs.props.th_type') }}</th>
                                        <th class="px-4 py-3">{{ __('docs/tabs.props.th_desc') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border font-mono text-xs">
                                    @foreach (__('docs/tabs.props.panel_items') as $item)
                                        <tr class="hover:bg-muted/20 transition-colors">
                                            <td class="px-4 py-3 font-semibold text-primary">{{ $item['name'] }}</td>
                                            <td class="px-4 py-3 text-muted-foreground">{{ $item['type'] }}</td>
                                            <td class="px-4 py-3 font-sans text-xs text-muted-foreground">{{ $item['desc'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
