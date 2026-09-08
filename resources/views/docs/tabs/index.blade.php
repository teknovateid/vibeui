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
            <vibe:card.header>
                <vibe:card.title>{{ __('docs/tabs.rows.profile_title') }}</vibe:card.title>
                <vibe:card.description>{{ __('docs/tabs.rows.profile_desc') }}</vibe:card.description>
            </vibe:card.header>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="account">
        <vibe:card>
            <vibe:card.header>
                <vibe:card.title>{{ __('docs/tabs.rows.account_title') }}</vibe:card.title>
                <vibe:card.description>{{ __('docs/tabs.rows.account_desc') }}</vibe:card.description>
            </vibe:card.header>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="billing">
        <vibe:card>
            <vibe:card.header>
                <vibe:card.title>{{ __('docs/tabs.rows.billing_title') }}</vibe:card.title>
                <vibe:card.description>{{ __('docs/tabs.rows.billing_desc') }}</vibe:card.description>
            </vibe:card.header>
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
                                    <vibe:card.header>
                                        <vibe:card.title>{{ __('docs/tabs.rows.profile_title') }}</vibe:card.title>
                                        <vibe:card.description>{{ __('docs/tabs.rows.profile_desc') }}</vibe:card.description>
                                    </vibe:card.header>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="account">
                                <vibe:card>
                                    <vibe:card.header>
                                        <vibe:card.title>{{ __('docs/tabs.rows.account_title') }}</vibe:card.title>
                                        <vibe:card.description>{{ __('docs/tabs.rows.account_desc') }}</vibe:card.description>
                                    </vibe:card.header>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="billing">
                                <vibe:card>
                                    <vibe:card.header>
                                        <vibe:card.title>{{ __('docs/tabs.rows.billing_title') }}</vibe:card.title>
                                        <vibe:card.description>{{ __('docs/tabs.rows.billing_desc') }}</vibe:card.description>
                                    </vibe:card.header>
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
            <vibe:card.header>
                <vibe:card.title>{{ __('docs/tabs.cols.general_title') }}</vibe:card.title>
                <vibe:card.description>{{ __('docs/tabs.cols.general_desc') }}</vibe:card.description>
            </vibe:card.header>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="security">
        <vibe:card>
            <vibe:card.header>
                <vibe:card.title>{{ __('docs/tabs.cols.security_title') }}</vibe:card.title>
                <vibe:card.description>{{ __('docs/tabs.cols.security_desc') }}</vibe:card.description>
            </vibe:card.header>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="notifications">
        <vibe:card>
            <vibe:card.header>
                <vibe:card.title>{{ __('docs/tabs.cols.notif_title') }}</vibe:card.title>
                <vibe:card.description>{{ __('docs/tabs.cols.notif_desc') }}</vibe:card.description>
            </vibe:card.header>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="integrations">
        <vibe:card>
            <vibe:card.header>
                <vibe:card.title>{{ __('docs/tabs.cols.integrations_title') }}</vibe:card.title>
                <vibe:card.description>{{ __('docs/tabs.cols.integrations_desc') }}</vibe:card.description>
            </vibe:card.header>
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
                                    <vibe:card.header>
                                        <vibe:card.title>{{ __('docs/tabs.cols.general_title') }}</vibe:card.title>
                                        <vibe:card.description>{{ __('docs/tabs.cols.general_desc') }}</vibe:card.description>
                                    </vibe:card.header>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="security">
                                <vibe:card>
                                    <vibe:card.header>
                                        <vibe:card.title>{{ __('docs/tabs.cols.security_title') }}</vibe:card.title>
                                        <vibe:card.description>{{ __('docs/tabs.cols.security_desc') }}</vibe:card.description>
                                    </vibe:card.header>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="notifications">
                                <vibe:card>
                                    <vibe:card.header>
                                        <vibe:card.title>{{ __('docs/tabs.cols.notif_title') }}</vibe:card.title>
                                        <vibe:card.description>{{ __('docs/tabs.cols.notif_desc') }}</vibe:card.description>
                                    </vibe:card.header>
                                </vibe:card>
                            </vibe:tabs.panel>

                            <vibe:tabs.panel name="integrations">
                                <vibe:card>
                                    <vibe:card.header>
                                        <vibe:card.title>{{ __('docs/tabs.cols.integrations_title') }}</vibe:card.title>
                                        <vibe:card.description>{{ __('docs/tabs.cols.integrations_desc') }}</vibe:card.description>
                                    </vibe:card.header>
                                </vibe:card>
                            </vibe:tabs.panel>
                        </vibe:tabs>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Integrasi Komponen Card (Card Tabs) --}}
            <section id="integrasi-card" class="space-y-10">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/tabs.card.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/tabs.card.desc') !!}
                    </p>
                </div>

                {{-- 3.1 Card dengan Tabs Baris (Layout Rows) --}}
                <div class="space-y-3">
                    <div class="space-y-1">
                        <h3 id="card-layout-rows" class="text-lg font-semibold text-foreground">{{ __('docs/tabs.card.rows_title') }}</h3>
                        <p class="text-sm text-muted-foreground">{!! __('docs/tabs.card.rows_desc') !!}</p>
                    </div>

                    <vibe:preview :title="__('docs/tabs.card.rows_preview_title')">
                        <vibe:preview.code>
<vibe:card class="w-full max-w-2xl mx-auto border border-border shadow-xs">
    <vibe:card.header>
        <div class="flex items-center justify-between">
            <div>
                <vibe:card.title>{{ __('docs/tabs.card.rows_header_title') }}</vibe:card.title>
                <vibe:card.description>{{ __('docs/tabs.card.rows_header_desc') }}</vibe:card.description>
            </div>
            <vibe:badge variant="primary" class="rounded-full">Pro</vibe:badge>
        </div>
    </vibe:card.header>

    <vibe:tabs default="profile" layout="rows" variant="pill">
        <vibe:tabs.list class="mb-4">
            <vibe:tabs.tab name="profile">
                <x-slot:icon>
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg>
                </x-slot:icon>
                {{ __('docs/tabs.card.rows_tab_profile') }}
            </vibe:tabs.tab>
            <vibe:tabs.tab name="password">
                <x-slot:icon>
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </x-slot:icon>
                {{ __('docs/tabs.card.rows_tab_password') }}
            </vibe:tabs.tab>
            <vibe:tabs.tab name="notifications" badge="2" badgeVariant="secondary">
                <x-slot:icon>
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                </x-slot:icon>
                {{ __('docs/tabs.card.rows_tab_notifications') }}
            </vibe:tabs.tab>
        </vibe:tabs.list>

        {{-- Panel 1: Profile --}}
        <vibe:tabs.panel name="profile">
            <vibe:card.content class="p-0 space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <vibe:input :label="__('docs/tabs.card.rows_profile_name')" value="Fahril Rizqy" />
                    <vibe:input :label="__('docs/tabs.card.rows_profile_email')" type="email" value="fahril@teknovate.id" />
                </div>
                <vibe:input :label="__('docs/tabs.card.rows_profile_bio')" value="Lead Frontend Engineer & UI Architect" />
            </vibe:card.content>
            <vibe:card.footer class="px-0 mt-6">
                <vibe:button variant="outline" size="sm">{{ __('docs/tabs.card.rows_cancel_btn') }}</vibe:button>
                <vibe:button size="sm">{{ __('docs/tabs.card.rows_save_btn') }}</vibe:button>
            </vibe:card.footer>
        </vibe:tabs.panel>

        {{-- Panel 2: Password --}}
        <vibe:tabs.panel name="password">
            <vibe:card.content class="p-0 space-y-4">
                <vibe:input :label="__('docs/tabs.card.rows_password_current')" type="password" placeholder="••••••••" />
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <vibe:input :label="__('docs/tabs.card.rows_password_new')" type="password" placeholder="••••••••" />
                    <vibe:input :label="__('docs/tabs.card.rows_password_confirm')" type="password" placeholder="••••••••" />
                </div>
            </vibe:card.content>
            <vibe:card.footer class="px-0 mt-6">
                <vibe:button variant="outline" size="sm">{{ __('docs/tabs.card.rows_cancel_btn') }}</vibe:button>
                <vibe:button size="sm">{{ __('docs/tabs.card.rows_password_btn') }}</vibe:button>
            </vibe:card.footer>
        </vibe:tabs.panel>

        {{-- Panel 3: Notifications --}}
        <vibe:tabs.panel name="notifications">
            <vibe:card.content class="p-0 space-y-4 divide-y divide-border/60">
                <div class="pt-1">
                    <vibe:switch :label="__('docs/tabs.card.rows_notif_email_label')" :description="__('docs/tabs.card.rows_notif_email_desc')" labelPlacement="justify" :checked="true" />
                </div>
                <div class="pt-4">
                    <vibe:switch :label="__('docs/tabs.card.rows_notif_marketing_label')" :description="__('docs/tabs.card.rows_notif_marketing_desc')" labelPlacement="justify" :checked="false" />
                </div>
            </vibe:card.content>
            <vibe:card.footer class="px-0 mt-6">
                <vibe:button size="sm">{{ __('docs/tabs.card.rows_save_btn') }}</vibe:button>
            </vibe:card.footer>
        </vibe:tabs.panel>
    </vibe:tabs>
</vibe:card>
                        </vibe:preview.code>

                        <div class="p-6 w-full flex justify-center">
                            <vibe:card class="w-full max-w-2xl border border-border shadow-xs">
                                <vibe:card.header>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <vibe:card.title>{{ __('docs/tabs.card.rows_header_title') }}</vibe:card.title>
                                            <vibe:card.description>{{ __('docs/tabs.card.rows_header_desc') }}</vibe:card.description>
                                        </div>
                                        <vibe:badge variant="primary" class="rounded-full">Pro</vibe:badge>
                                    </div>
                                </vibe:card.header>

                                <vibe:tabs default="profile" layout="rows" variant="pill">
                                    <vibe:tabs.list class="mb-4">
                                        <vibe:tabs.tab name="profile">
                                            <x-slot:icon>
                                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg>
                                            </x-slot:icon>
                                            {{ __('docs/tabs.card.rows_tab_profile') }}
                                        </vibe:tabs.tab>
                                        <vibe:tabs.tab name="password">
                                            <x-slot:icon>
                                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                            </x-slot:icon>
                                            {{ __('docs/tabs.card.rows_tab_password') }}
                                        </vibe:tabs.tab>
                                        <vibe:tabs.tab name="notifications" badge="2" badgeVariant="secondary">
                                            <x-slot:icon>
                                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                                            </x-slot:icon>
                                            {{ __('docs/tabs.card.rows_tab_notifications') }}
                                        </vibe:tabs.tab>
                                    </vibe:tabs.list>

                                    {{-- Panel 1: Profile --}}
                                    <vibe:tabs.panel name="profile">
                                        <vibe:card.content class="p-0 space-y-4">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <vibe:input :label="__('docs/tabs.card.rows_profile_name')" value="Fahril Rizqy" />
                                                <vibe:input :label="__('docs/tabs.card.rows_profile_email')" type="email" value="fahril@teknovate.id" />
                                            </div>
                                            <vibe:input :label="__('docs/tabs.card.rows_profile_bio')" value="Lead Frontend Engineer & UI Architect" />
                                        </vibe:card.content>
                                        <vibe:card.footer class="px-0 mt-6">
                                            <vibe:button variant="outline" size="sm">{{ __('docs/tabs.card.rows_cancel_btn') }}</vibe:button>
                                            <vibe:button size="sm">{{ __('docs/tabs.card.rows_save_btn') }}</vibe:button>
                                        </vibe:card.footer>
                                    </vibe:tabs.panel>

                                    {{-- Panel 2: Password --}}
                                    <vibe:tabs.panel name="password">
                                        <vibe:card.content class="p-0 space-y-4">
                                            <vibe:input :label="__('docs/tabs.card.rows_password_current')" type="password" placeholder="••••••••" />
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <vibe:input :label="__('docs/tabs.card.rows_password_new')" type="password" placeholder="••••••••" />
                                                <vibe:input :label="__('docs/tabs.card.rows_password_confirm')" type="password" placeholder="••••••••" />
                                            </div>
                                        </vibe:card.content>
                                        <vibe:card.footer class="px-0 mt-6">
                                            <vibe:button variant="outline" size="sm">{{ __('docs/tabs.card.rows_cancel_btn') }}</vibe:button>
                                            <vibe:button size="sm">{{ __('docs/tabs.card.rows_password_btn') }}</vibe:button>
                                        </vibe:card.footer>
                                    </vibe:tabs.panel>

                                    {{-- Panel 3: Notifications --}}
                                    <vibe:tabs.panel name="notifications">
                                        <vibe:card.content class="p-0 space-y-4 divide-y divide-border/60">
                                            <div class="pt-1">
                                                <vibe:switch :label="__('docs/tabs.card.rows_notif_email_label')" :description="__('docs/tabs.card.rows_notif_email_desc')" labelPlacement="justify" :checked="true" />
                                            </div>
                                            <div class="pt-4">
                                                <vibe:switch :label="__('docs/tabs.card.rows_notif_marketing_label')" :description="__('docs/tabs.card.rows_notif_marketing_desc')" labelPlacement="justify" :checked="false" />
                                            </div>
                                        </vibe:card.content>
                                        <vibe:card.footer class="px-0 mt-6">
                                            <vibe:button size="sm">{{ __('docs/tabs.card.rows_save_btn') }}</vibe:button>
                                        </vibe:card.footer>
                                    </vibe:tabs.panel>
                                </vibe:tabs>
                            </vibe:card>
                        </div>
                    </vibe:preview>
                </div>

                {{-- 3.2 Card dengan Tabs Kolom (Layout Cols) --}}
                <div class="space-y-3">
                    <div class="space-y-1">
                        <h3 id="card-layout-cols" class="text-lg font-semibold text-foreground">{{ __('docs/tabs.card.cols_title') }}</h3>
                        <p class="text-sm text-muted-foreground">{!! __('docs/tabs.card.cols_desc') !!}</p>
                    </div>

                    <vibe:preview :title="__('docs/tabs.card.cols_preview_title')">
                        <vibe:preview.code>
<vibe:card class="w-full max-w-3xl mx-auto p-0 overflow-hidden border border-border shadow-xs">
    <div class="p-6 border-b border-border bg-muted/20">
        <div class="flex items-center justify-between">
            <div>
                <vibe:card.title>{{ __('docs/tabs.card.cols_header_title') }}</vibe:card.title>
                <vibe:card.description class="mt-1">{{ __('docs/tabs.card.cols_header_desc') }}</vibe:card.description>
            </div>
            <vibe:badge variant="outline" class="font-mono text-xs">team_slug</vibe:badge>
        </div>
    </div>

    <vibe:tabs default="general" layout="cols" variant="underline" class="gap-0">
        {{-- Left Sidebar Tabs --}}
        <vibe:tabs.list class="w-full md:w-56 p-4 border-r border-border bg-muted/10 shrink-0 gap-1">
            <vibe:tabs.tab name="general" class="w-full justify-start text-xs font-semibold">
                <x-slot:icon>
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                </x-slot:icon>
                {{ __('docs/tabs.card.cols_tab_general') }}
            </vibe:tabs.tab>

            <vibe:tabs.tab name="members" badge="8" badgeVariant="secondary" class="w-full justify-start text-xs font-semibold">
                <x-slot:icon>
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </x-slot:icon>
                {{ __('docs/tabs.card.cols_tab_members') }}
            </vibe:tabs.tab>

            <vibe:tabs.tab name="billing" class="w-full justify-start text-xs font-semibold">
                <x-slot:icon>
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                </x-slot:icon>
                {{ __('docs/tabs.card.cols_tab_billing') }}
            </vibe:tabs.tab>
        </vibe:tabs.list>

        {{-- Right Content Panels --}}
        <div class="flex-1 min-w-0">
            {{-- General Panel --}}
            <vibe:tabs.panel name="general" class="p-6">
                <vibe:card.content class="p-0 space-y-4">
                    <vibe:input :label="__('docs/tabs.card.cols_general_name')" value="Teknovate Labs" />
                    <vibe:input :label="__('docs/tabs.card.cols_general_slug')" prefix="https://app.teknovate.id/" value="teknovate-labs" />
                    <vibe:input :label="__('docs/tabs.card.cols_general_desc_field')" value="Divisi riset dan pengembangan teknologi antarmuka modern." />
                </vibe:card.content>
                <vibe:card.footer class="p-0 pt-6 mt-6 border-t border-border/60">
                    <vibe:button size="sm">{{ __('docs/tabs.card.cols_save_workspace') }}</vibe:button>
                </vibe:card.footer>
            </vibe:tabs.panel>

            {{-- Members Panel --}}
            <vibe:tabs.panel name="members" class="p-6">
                <vibe:card.content class="p-0 space-y-3">
                    <div class="flex items-center justify-between pb-2 border-b border-border/60">
                        <span class="text-xs font-medium text-muted-foreground">8 Anggota Aktif</span>
                        <vibe:button size="xs" variant="outline">{{ __('docs/tabs.card.cols_invite_btn') }}</vibe:button>
                    </div>
                    <div class="flex items-center justify-between py-2 text-xs">
                        <div class="flex items-center gap-2.5">
                            <vibe:avatar size="sm" initials="FR" />
                            <div>
                                <p class="font-medium text-foreground">Fahril Rizqy</p>
                                <p class="text-muted-foreground text-[11px]">fahril@teknovate.id</p>
                            </div>
                        </div>
                        <vibe:badge size="xs" variant="primary">{{ __('docs/tabs.card.cols_member_1_role') }}</vibe:badge>
                    </div>
                    <div class="flex items-center justify-between py-2 text-xs border-t border-border/40">
                        <div class="flex items-center gap-2.5">
                            <vibe:avatar size="sm" initials="AL" />
                            <div>
                                <p class="font-medium text-foreground">Ahmad Luthfi</p>
                                <p class="text-muted-foreground text-[11px]">luthfi@teknovate.id</p>
                            </div>
                        </div>
                        <vibe:badge size="xs" variant="secondary">{{ __('docs/tabs.card.cols_member_2_role') }}</vibe:badge>
                    </div>
                </vibe:card.content>
            </vibe:tabs.panel>

            {{-- Billing Panel --}}
            <vibe:tabs.panel name="billing" class="p-6">
                <vibe:card.content class="p-0 space-y-4">
                    <div class="rounded-xl border border-primary/20 bg-primary/5 p-4 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-sm text-foreground">{{ __('docs/tabs.card.cols_plan_title') }}</span>
                            <vibe:badge variant="primary" size="xs">Aktif</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">{{ __('docs/tabs.card.cols_plan_desc') }}</p>
                    </div>
                    <div class="space-y-1 text-xs">
                        <div class="flex justify-between text-muted-foreground">
                            <span>Kapasitas Penyimpanan</span>
                            <span class="font-medium text-foreground">18.4 GB / 50 GB</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-muted overflow-hidden">
                            <div class="h-full bg-primary rounded-full" style="width: 36.8%;"></div>
                        </div>
                    </div>
                </vibe:card.content>
                <vibe:card.footer class="p-0 pt-6 mt-6 border-t border-border/60">
                    <vibe:button size="sm" variant="outline">{{ __('docs/tabs.card.cols_upgrade_btn') }}</vibe:button>
                </vibe:card.footer>
            </vibe:tabs.panel>
        </div>
    </vibe:tabs>
</vibe:card>
                        </vibe:preview.code>

                        <div class="p-6 w-full flex justify-center">
                            <vibe:card class="w-full max-w-3xl border border-border shadow-xs p-0 overflow-hidden">
                                <div class="p-6 border-b border-border bg-muted/20">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <vibe:card.title>{{ __('docs/tabs.card.cols_header_title') }}</vibe:card.title>
                                            <vibe:card.description class="mt-1">{{ __('docs/tabs.card.cols_header_desc') }}</vibe:card.description>
                                        </div>
                                        <vibe:badge variant="outline" class="font-mono text-xs">team_slug</vibe:badge>
                                    </div>
                                </div>

                                <vibe:tabs default="general" layout="cols" variant="underline" class="gap-0">
                                    {{-- Left Sidebar Tabs --}}
                                    <vibe:tabs.list class="w-full md:w-56 p-4 border-r border-border bg-muted/10 shrink-0 gap-1">
                                        <vibe:tabs.tab name="general" class="w-full justify-start text-xs font-semibold">
                                            <x-slot:icon>
                                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                                            </x-slot:icon>
                                            {{ __('docs/tabs.card.cols_tab_general') }}
                                        </vibe:tabs.tab>

                                        <vibe:tabs.tab name="members" badge="8" badgeVariant="secondary" class="w-full justify-start text-xs font-semibold">
                                            <x-slot:icon>
                                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                            </x-slot:icon>
                                            {{ __('docs/tabs.card.cols_tab_members') }}
                                        </vibe:tabs.tab>

                                        <vibe:tabs.tab name="billing" class="w-full justify-start text-xs font-semibold">
                                            <x-slot:icon>
                                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                                            </x-slot:icon>
                                            {{ __('docs/tabs.card.cols_tab_billing') }}
                                        </vibe:tabs.tab>
                                    </vibe:tabs.list>

                                    {{-- Right Content Panels --}}
                                    <div class="flex-1 min-w-0">
                                        {{-- General Panel --}}
                                        <vibe:tabs.panel name="general" class="p-6">
                                            <vibe:card.content class="p-0 space-y-4">
                                                <vibe:input :label="__('docs/tabs.card.cols_general_name')" value="Teknovate Labs" />
                                                <vibe:input :label="__('docs/tabs.card.cols_general_slug')" prefix="https://app.teknovate.id/" value="teknovate-labs" />
                                                <vibe:input :label="__('docs/tabs.card.cols_general_desc_field')" value="Divisi riset dan pengembangan teknologi antarmuka modern." />
                                            </vibe:card.content>
                                            <vibe:card.footer class="p-0 pt-6 mt-6 border-t border-border/60">
                                                <vibe:button size="sm">{{ __('docs/tabs.card.cols_save_workspace') }}</vibe:button>
                                            </vibe:card.footer>
                                        </vibe:tabs.panel>

                                        {{-- Members Panel --}}
                                        <vibe:tabs.panel name="members" class="p-6">
                                            <vibe:card.content class="p-0 space-y-3">
                                                <div class="flex items-center justify-between pb-2 border-b border-border/60">
                                                    <span class="text-xs font-medium text-muted-foreground">8 Anggota Aktif</span>
                                                    <vibe:button size="xs" variant="outline">{{ __('docs/tabs.card.cols_invite_btn') }}</vibe:button>
                                                </div>
                                                <div class="flex items-center justify-between py-2 text-xs">
                                                    <div class="flex items-center gap-2.5">
                                                        <vibe:avatar size="sm" initials="FR" />
                                                        <div>
                                                            <p class="font-medium text-foreground">Fahril Rizqy</p>
                                                            <p class="text-muted-foreground text-[11px]">fahril@teknovate.id</p>
                                                        </div>
                                                    </div>
                                                    <vibe:badge size="xs" variant="primary">{{ __('docs/tabs.card.cols_member_1_role') }}</vibe:badge>
                                                </div>
                                                <div class="flex items-center justify-between py-2 text-xs border-t border-border/40">
                                                    <div class="flex items-center gap-2.5">
                                                        <vibe:avatar size="sm" initials="AL" />
                                                        <div>
                                                            <p class="font-medium text-foreground">Ahmad Luthfi</p>
                                                            <p class="text-muted-foreground text-[11px]">luthfi@teknovate.id</p>
                                                        </div>
                                                    </div>
                                                    <vibe:badge size="xs" variant="secondary">{{ __('docs/tabs.card.cols_member_2_role') }}</vibe:badge>
                                                </div>
                                            </vibe:card.content>
                                        </vibe:tabs.panel>

                                        {{-- Billing Panel --}}
                                        <vibe:tabs.panel name="billing" class="p-6">
                                            <vibe:card.content class="p-0 space-y-4">
                                                <div class="rounded-xl border border-primary/20 bg-primary/5 p-4 space-y-2">
                                                    <div class="flex items-center justify-between">
                                                        <span class="font-semibold text-sm text-foreground">{{ __('docs/tabs.card.cols_plan_title') }}</span>
                                                        <vibe:badge variant="primary" size="xs">Aktif</vibe:badge>
                                                    </div>
                                                    <p class="text-xs text-muted-foreground leading-relaxed">{{ __('docs/tabs.card.cols_plan_desc') }}</p>
                                                </div>
                                                <div class="space-y-1 text-xs">
                                                    <div class="flex justify-between text-muted-foreground">
                                                        <span>Kapasitas Penyimpanan</span>
                                                        <span class="font-medium text-foreground">18.4 GB / 50 GB</span>
                                                    </div>
                                                    <div class="w-full h-2 rounded-full bg-muted overflow-hidden">
                                                        <div class="h-full bg-primary rounded-full" style="width: 36.8%;"></div>
                                                    </div>
                                                </div>
                                            </vibe:card.content>
                                            <vibe:card.footer class="p-0 pt-6 mt-6 border-t border-border/60">
                                                <vibe:button size="sm" variant="outline">{{ __('docs/tabs.card.cols_upgrade_btn') }}</vibe:button>
                                            </vibe:card.footer>
                                        </vibe:tabs.panel>
                                    </div>
                                </vibe:tabs>
                            </vibe:card>
                        </div>
                    </vibe:preview>
                </div>
            </section>

            {{-- 4. Varian Gaya Visual --}}
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

            {{-- 5. Tab dengan Ikon SVG & Badge --}}
            <section id="ikon-badge" class="space-y-4">
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

            {{-- 6. Tab Lebar Penuh (Fitted) --}}
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

            {{-- 7. Persistensi LocalStorage --}}
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

            {{-- 8. Integrasi Livewire & URL Sync --}}
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

            {{-- 9. Inspirasi Desain Kustom (Custom Class) --}}
            <section id="desain-kustom" class="space-y-10">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/tabs.custom.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/tabs.custom.desc') !!}
                    </p>
                </div>

                {{-- 8.1 Floating Glassmorphism Pill --}}
                <div class="space-y-3">
                    <div class="space-y-1">
                        <h3 id="floating-glassmorphism" class="text-lg font-semibold text-foreground">{{ __('docs/tabs.custom.floating_title') }}</h3>
                        <p class="text-sm text-muted-foreground">{!! __('docs/tabs.custom.floating_desc') !!}</p>
                    </div>

                    <vibe:preview :title="__('docs/tabs.custom.floating_preview_title')">
                        <vibe:preview.code>
<vibe:tabs default="overview" layout="rows" variant="pill" class="flex flex-col items-center">
    {{-- Floating glassmorphic pill bar --}}
    <vibe:tabs.list class="rounded-full p-2 bg-background/80 backdrop-blur-xl border border-border/80 shadow-lg shadow-black/5 dark:shadow-black/25 inline-flex items-center gap-2">
        <vibe:tabs.tab name="overview" class="rounded-full h-10 px-6 text-sm font-semibold">
            {{ __('docs/tabs.custom.floating_tab_overview') }}
        </vibe:tabs.tab>
        <vibe:tabs.tab name="analytics" class="rounded-full h-10 px-6 text-sm font-semibold">
            {{ __('docs/tabs.custom.floating_tab_analytics') }}
        </vibe:tabs.tab>
        <vibe:tabs.tab name="reports" class="rounded-full h-10 px-6 text-sm font-semibold">
            {{ __('docs/tabs.custom.floating_tab_reports') }}
        </vibe:tabs.tab>
    </vibe:tabs.list>

    {{-- Content Panels --}}
    <vibe:tabs.panel name="overview" class="w-full max-w-xl mt-6">
        <vibe:card class="rounded-2xl border border-border/70 shadow-sm p-6 space-y-4">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-muted-foreground">Status Ringkasan</span>
                <vibe:badge variant="primary" class="rounded-full text-[10px]">+24.8% YoY</vibe:badge>
            </div>
            <h4 class="font-bold text-lg text-foreground">{{ __('docs/tabs.custom.floating_overview_title') }}</h4>
            <p class="text-sm text-muted-foreground leading-relaxed">{{ __('docs/tabs.custom.floating_overview_desc') }}</p>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="analytics" class="w-full max-w-xl mt-6">
        <vibe:card class="rounded-2xl border border-border/70 shadow-sm p-6 space-y-4">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-muted-foreground">Aktif Sekarang</span>
                <span class="flex items-center gap-1.5 text-xs text-emerald-500 font-medium">
                    <span class="size-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Live
                </span>
            </div>
            <h4 class="font-bold text-lg text-foreground">{{ __('docs/tabs.custom.floating_analytics_title') }}</h4>
            <p class="text-sm text-muted-foreground leading-relaxed">{{ __('docs/tabs.custom.floating_analytics_desc') }}</p>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="reports" class="w-full max-w-xl mt-6">
        <vibe:card class="rounded-2xl border border-border/70 shadow-sm p-6 space-y-4">
            <h4 class="font-bold text-lg text-foreground">{{ __('docs/tabs.custom.floating_reports_title') }}</h4>
            <p class="text-sm text-muted-foreground leading-relaxed">{{ __('docs/tabs.custom.floating_reports_desc') }}</p>
            <div class="pt-2 flex items-center gap-2">
                <vibe:button size="sm" variant="outline" class="rounded-full text-xs">Unduh PDF</vibe:button>
                <vibe:button size="sm" variant="secondary" class="rounded-full text-xs">Ekspor CSV</vibe:button>
            </div>
        </vibe:card>
    </vibe:tabs.panel>
</vibe:tabs>
                        </vibe:preview.code>

                        <div class="p-6 md:p-8 w-full flex justify-center bg-linear-to-b from-muted/30 via-background to-muted/20 rounded-b-2xl">
                            <vibe:tabs default="overview" layout="rows" variant="pill" class="w-full flex flex-col items-center">
                                {{-- Floating glassmorphic pill bar --}}
                                <vibe:tabs.list class="rounded-full p-2 bg-background/80 backdrop-blur-xl border border-border/80 shadow-lg shadow-black/5 dark:shadow-black/25 inline-flex items-center gap-2">
                                    <vibe:tabs.tab name="overview" class="rounded-full h-10 px-6 text-sm font-semibold">
                                        {{ __('docs/tabs.custom.floating_tab_overview') }}
                                    </vibe:tabs.tab>
                                    <vibe:tabs.tab name="analytics" class="rounded-full h-10 px-6 text-sm font-semibold">
                                        {{ __('docs/tabs.custom.floating_tab_analytics') }}
                                    </vibe:tabs.tab>
                                    <vibe:tabs.tab name="reports" class="rounded-full h-10 px-6 text-sm font-semibold">
                                        {{ __('docs/tabs.custom.floating_tab_reports') }}
                                    </vibe:tabs.tab>
                                </vibe:tabs.list>

                                {{-- Content Panels --}}
                                <vibe:tabs.panel name="overview" class="w-full max-w-xl mt-6">
                                    <vibe:card class="rounded-2xl border border-border/70 shadow-sm p-6 space-y-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-medium text-muted-foreground">Status Ringkasan</span>
                                            <vibe:badge variant="primary" class="rounded-full text-[10px]">+24.8% YoY</vibe:badge>
                                        </div>
                                        <h4 class="font-bold text-lg text-foreground">{{ __('docs/tabs.custom.floating_overview_title') }}</h4>
                                        <p class="text-sm text-muted-foreground leading-relaxed">{{ __('docs/tabs.custom.floating_overview_desc') }}</p>
                                    </vibe:card>
                                </vibe:tabs.panel>

                                <vibe:tabs.panel name="analytics" class="w-full max-w-xl mt-6">
                                    <vibe:card class="rounded-2xl border border-border/70 shadow-sm p-6 space-y-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-medium text-muted-foreground">Aktif Sekarang</span>
                                            <span class="flex items-center gap-1.5 text-xs text-emerald-500 font-medium">
                                                <span class="size-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                                Live
                                            </span>
                                        </div>
                                        <h4 class="font-bold text-lg text-foreground">{{ __('docs/tabs.custom.floating_analytics_title') }}</h4>
                                        <p class="text-sm text-muted-foreground leading-relaxed">{{ __('docs/tabs.custom.floating_analytics_desc') }}</p>
                                    </vibe:card>
                                </vibe:tabs.panel>

                                <vibe:tabs.panel name="reports" class="w-full max-w-xl mt-6">
                                    <vibe:card class="rounded-2xl border border-border/70 shadow-sm p-6 space-y-4">
                                        <h4 class="font-bold text-lg text-foreground">{{ __('docs/tabs.custom.floating_reports_title') }}</h4>
                                        <p class="text-sm text-muted-foreground leading-relaxed">{{ __('docs/tabs.custom.floating_reports_desc') }}</p>
                                        <div class="pt-2 flex items-center gap-2">
                                            <vibe:button size="sm" variant="outline" class="rounded-full text-xs">Unduh PDF</vibe:button>
                                            <vibe:button size="sm" variant="secondary" class="rounded-full text-xs">Ekspor CSV</vibe:button>
                                        </div>
                                    </vibe:card>
                                </vibe:tabs.panel>
                            </vibe:tabs>
                        </div>
                    </vibe:preview>
                </div>

                {{-- 8.2 Card Header Segmented Navigation --}}
                <div class="space-y-3">
                    <div class="space-y-1">
                        <h3 id="card-header-segmented" class="text-lg font-semibold text-foreground">{{ __('docs/tabs.custom.card_header_title') }}</h3>
                        <p class="text-sm text-muted-foreground">{!! __('docs/tabs.custom.card_header_desc') !!}</p>
                    </div>

                    <vibe:preview :title="__('docs/tabs.custom.card_header_preview_title')">
                        <vibe:preview.code>
<vibe:card class="p-0 overflow-hidden border border-border/80 shadow-xs">
    <vibe:tabs default="general" layout="rows" variant="underline">
        {{-- Integrated Card Header Bar with Border-b --}}
        <div class="border-b border-border bg-muted/40 px-5 pt-3.5 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-2.5">
                <span class="font-semibold text-sm text-foreground">Project Settings</span>
                <vibe:badge variant="outline" size="xs" class="text-[10px] font-mono">v2.4.0</vibe:badge>
            </div>

            {{-- Tabs list without duplicate border-b --}}
            <vibe:tabs.list class="border-b-0 gap-6">
                <vibe:tabs.tab name="general" class="h-10 px-4 pb-3 pt-2 text-sm font-semibold">
                    {{ __('docs/tabs.custom.card_header_tab_general') }}
                </vibe:tabs.tab>
                <vibe:tabs.tab name="collaborators" badge="4" badgeVariant="secondary" class="h-10 px-4 pb-3 pt-2 text-sm font-semibold">
                    {{ __('docs/tabs.custom.card_header_tab_collaborators') }}
                </vibe:tabs.tab>
                <vibe:tabs.tab name="webhooks" badge="2" badgeVariant="outline" class="h-10 px-4 pb-3 pt-2 text-sm font-semibold">
                    {{ __('docs/tabs.custom.card_header_tab_webhooks') }}
                </vibe:tabs.tab>
            </vibe:tabs.list>
        </div>

        {{-- Panels in Card Body --}}
        <vibe:tabs.panel name="general" class="p-6 space-y-4">
            <div>
                <h4 class="font-semibold text-sm text-foreground">{{ __('docs/tabs.custom.card_header_general_title') }}</h4>
                <p class="text-xs text-muted-foreground mt-0.5">{{ __('docs/tabs.custom.card_header_general_desc') }}</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div class="space-y-1.5">
                    <label class="text-xs font-medium text-foreground">Nama Proyek</label>
                    <vibe:input value="vibe-ui-design-system" />
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-medium text-foreground">Branch Utama</label>
                    <vibe:input value="main" />
                </div>
            </div>
        </vibe:tabs.panel>

        <vibe:tabs.panel name="collaborators" class="p-6 space-y-4">
            <div>
                <h4 class="font-semibold text-sm text-foreground">{{ __('docs/tabs.custom.card_header_collab_title') }}</h4>
                <p class="text-xs text-muted-foreground mt-0.5">{{ __('docs/tabs.custom.card_header_collab_desc') }}</p>
            </div>
            <div class="divide-y divide-border/60 text-xs">
                <div class="py-2.5 flex items-center justify-between">
                    <div>
                        <span class="font-semibold text-foreground">Fahril Rizqy</span>
                        <span class="text-muted-foreground ml-2">fahril@teknovate.id</span>
                    </div>
                    <vibe:badge size="xs" variant="primary">Owner</vibe:badge>
                </div>
                <div class="py-2.5 flex items-center justify-between">
                    <div>
                        <span class="font-semibold text-foreground">Alex Developer</span>
                        <span class="text-muted-foreground ml-2">alex@example.com</span>
                    </div>
                    <vibe:badge size="xs" variant="secondary">Maintainer</vibe:badge>
                </div>
            </div>
        </vibe:tabs.panel>

        <vibe:tabs.panel name="webhooks" class="p-6 space-y-4">
            <div>
                <h4 class="font-semibold text-sm text-foreground">{{ __('docs/tabs.custom.card_header_webhooks_title') }}</h4>
                <p class="text-xs text-muted-foreground mt-0.5">{{ __('docs/tabs.custom.card_header_webhooks_desc') }}</p>
            </div>
            <div class="rounded-lg border border-border/80 p-3 bg-muted/20 flex items-center justify-between text-xs font-mono">
                <span class="text-foreground truncate">https://api.github.com/webhook/ci-pipeline</span>
                <vibe:badge size="xs" variant="outline" class="text-emerald-600 dark:text-emerald-400">Active</vibe:badge>
            </div>
        </vibe:tabs.panel>
    </vibe:tabs>
</vibe:card>
                        </vibe:preview.code>

                        <div class="p-6 w-full">
                            <vibe:card class="p-0 overflow-hidden border border-border/80 shadow-xs">
                                <vibe:tabs default="general" layout="rows" variant="underline">
                                    {{-- Integrated Card Header Bar with Border-b --}}
                                    <div class="border-b border-border bg-muted/40 px-5 pt-3.5 flex flex-wrap items-center justify-between gap-4">
                                        <div class="flex items-center gap-2.5">
                                            <span class="font-semibold text-sm text-foreground">Project Settings</span>
                                            <vibe:badge variant="outline" size="xs" class="text-[10px] font-mono">v2.4.0</vibe:badge>
                                        </div>

                                        {{-- Tabs list without duplicate border-b --}}
                                        <vibe:tabs.list class="border-b-0 gap-6">
                                            <vibe:tabs.tab name="general" class="h-10 px-4 pb-3 pt-2 text-sm font-semibold">
                                                {{ __('docs/tabs.custom.card_header_tab_general') }}
                                            </vibe:tabs.tab>
                                            <vibe:tabs.tab name="collaborators" badge="4" badgeVariant="secondary" class="h-10 px-4 pb-3 pt-2 text-sm font-semibold">
                                                {{ __('docs/tabs.custom.card_header_tab_collaborators') }}
                                            </vibe:tabs.tab>
                                            <vibe:tabs.tab name="webhooks" badge="2" badgeVariant="outline" class="h-10 px-4 pb-3 pt-2 text-sm font-semibold">
                                                {{ __('docs/tabs.custom.card_header_tab_webhooks') }}
                                            </vibe:tabs.tab>
                                        </vibe:tabs.list>
                                    </div>

                                    {{-- Panels in Card Body --}}
                                    <vibe:tabs.panel name="general" class="p-6 space-y-4">
                                        <div>
                                            <h4 class="font-semibold text-sm text-foreground">{{ __('docs/tabs.custom.card_header_general_title') }}</h4>
                                            <p class="text-xs text-muted-foreground mt-0.5">{{ __('docs/tabs.custom.card_header_general_desc') }}</p>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                                            <div class="space-y-1.5">
                                                <label class="text-xs font-medium text-foreground">Nama Proyek</label>
                                                <vibe:input value="vibe-ui-design-system" />
                                            </div>
                                            <div class="space-y-1.5">
                                                <label class="text-xs font-medium text-foreground">Branch Utama</label>
                                                <vibe:input value="main" />
                                            </div>
                                        </div>
                                    </vibe:tabs.panel>

                                    <vibe:tabs.panel name="collaborators" class="p-6 space-y-4">
                                        <div>
                                            <h4 class="font-semibold text-sm text-foreground">{{ __('docs/tabs.custom.card_header_collab_title') }}</h4>
                                            <p class="text-xs text-muted-foreground mt-0.5">{{ __('docs/tabs.custom.card_header_collab_desc') }}</p>
                                        </div>
                                        <div class="divide-y divide-border/60 text-xs">
                                            <div class="py-2.5 flex items-center justify-between">
                                                <div>
                                                    <span class="font-semibold text-foreground">Fahril Rizqy</span>
                                                    <span class="text-muted-foreground ml-2">fahril@teknovate.id</span>
                                                </div>
                                                <vibe:badge size="xs" variant="primary">Owner</vibe:badge>
                                            </div>
                                            <div class="py-2.5 flex items-center justify-between">
                                                <div>
                                                    <span class="font-semibold text-foreground">Alex Developer</span>
                                                    <span class="text-muted-foreground ml-2">alex@example.com</span>
                                                </div>
                                                <vibe:badge size="xs" variant="secondary">Maintainer</vibe:badge>
                                            </div>
                                        </div>
                                    </vibe:tabs.panel>

                                    <vibe:tabs.panel name="webhooks" class="p-6 space-y-4">
                                        <div>
                                            <h4 class="font-semibold text-sm text-foreground">{{ __('docs/tabs.custom.card_header_webhooks_title') }}</h4>
                                            <p class="text-xs text-muted-foreground mt-0.5">{{ __('docs/tabs.custom.card_header_webhooks_desc') }}</p>
                                        </div>
                                        <div class="rounded-lg border border-border/80 p-3 bg-muted/20 flex items-center justify-between text-xs font-mono">
                                            <span class="text-foreground truncate">https://api.github.com/webhook/ci-pipeline</span>
                                            <vibe:badge size="xs" variant="outline" class="text-emerald-600 dark:text-emerald-400">Active</vibe:badge>
                                        </div>
                                    </vibe:tabs.panel>
                                </vibe:tabs>
                            </vibe:card>
                        </div>
                    </vibe:preview>
                </div>

                {{-- 8.3 Sidebar Settings Navigation (2 Kolom) --}}
                <div class="space-y-3">
                    <div class="space-y-1">
                        <h3 id="sidebar-settings-nav" class="text-lg font-semibold text-foreground">{{ __('docs/tabs.custom.sidebar_title') }}</h3>
                        <p class="text-sm text-muted-foreground">{!! __('docs/tabs.custom.sidebar_desc') !!}</p>
                    </div>

                    <vibe:preview :title="__('docs/tabs.custom.sidebar_preview_title')">
                        <vibe:preview.code>
<vibe:tabs default="profile" layout="cols" variant="pill" class="gap-6 items-start">
    {{-- Custom Sidebar Container --}}
    <vibe:tabs.list class="w-full md:w-64 p-3 bg-muted/40 rounded-2xl border border-border/70 flex flex-col gap-2 shrink-0">
        <div class="px-3 py-2 text-[11px] font-bold uppercase tracking-wider text-muted-foreground">
            Akun & Akses
        </div>

        <vibe:tabs.tab name="profile" class="w-full justify-start rounded-xl h-11 px-4 text-sm font-medium">
            <x-slot:icon>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg>
            </x-slot:icon>
            {{ __('docs/tabs.custom.sidebar_tab_profile') }}
        </vibe:tabs.tab>

        <vibe:tabs.tab name="billing" badge="Pro" badgeVariant="primary" class="w-full justify-start rounded-xl h-11 px-4 text-sm font-medium">
            <x-slot:icon>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
            </x-slot:icon>
            {{ __('docs/tabs.custom.sidebar_tab_billing') }}
        </vibe:tabs.tab>

        <vibe:tabs.tab name="api" class="w-full justify-start rounded-xl h-11 px-4 text-sm font-medium">
            <x-slot:icon>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>
            </x-slot:icon>
            {{ __('docs/tabs.custom.sidebar_tab_api') }}
        </vibe:tabs.tab>

        <vibe:tabs.tab name="security" class="w-full justify-start rounded-xl h-11 px-4 text-sm font-medium">
            <x-slot:icon>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </x-slot:icon>
            {{ __('docs/tabs.custom.sidebar_tab_security') }}
        </vibe:tabs.tab>
    </vibe:tabs.list>

    {{-- Content Panels with Card Frame --}}
    <vibe:tabs.panel name="profile" class="flex-1 min-w-0">
        <vibe:card class="rounded-2xl p-6 border border-border/70 shadow-2xs space-y-4">
            <h4 class="font-bold text-base text-foreground">{{ __('docs/tabs.custom.sidebar_profile_title') }}</h4>
            <p class="text-xs text-muted-foreground">{{ __('docs/tabs.custom.sidebar_profile_desc') }}</p>
            <div class="space-y-3 pt-2">
                <vibe:input label="Nama Lengkap" value="Fahril Rizqy" />
                <vibe:input label="Email" value="fahril@teknovate.id" />
            </div>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="billing" class="flex-1 min-w-0">
        <vibe:card class="rounded-2xl p-6 border border-border/70 shadow-2xs space-y-4">
            <div class="flex items-center justify-between">
                <h4 class="font-bold text-base text-foreground">{{ __('docs/tabs.custom.sidebar_billing_title') }}</h4>
                <vibe:badge variant="primary">Aktif</vibe:badge>
            </div>
            <p class="text-xs text-muted-foreground">{{ __('docs/tabs.custom.sidebar_billing_desc') }}</p>
            <div class="pt-2">
                <vibe:button size="sm">Perbarui Metode Pembayaran</vibe:button>
            </div>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="api" class="flex-1 min-w-0">
        <vibe:card class="rounded-2xl p-6 border border-border/70 shadow-2xs space-y-4">
            <h4 class="font-bold text-base text-foreground">{{ __('docs/tabs.custom.sidebar_api_title') }}</h4>
            <p class="text-xs text-muted-foreground">{{ __('docs/tabs.custom.sidebar_api_desc') }}</p>
            <div class="p-3 bg-muted/40 rounded-xl border border-border font-mono text-xs flex items-center justify-between">
                <span>vb_live_9a87f2e1c4b0...</span>
                <vibe:button size="sm" variant="outline">Salin</vibe:button>
            </div>
        </vibe:card>
    </vibe:tabs.panel>

    <vibe:tabs.panel name="security" class="flex-1 min-w-0">
        <vibe:card class="rounded-2xl p-6 border border-border/70 shadow-2xs space-y-4">
            <h4 class="font-bold text-base text-foreground">{{ __('docs/tabs.custom.sidebar_security_title') }}</h4>
            <p class="text-xs text-muted-foreground">{{ __('docs/tabs.custom.sidebar_security_desc') }}</p>
            <div class="pt-2 flex items-center justify-between p-3 rounded-xl border border-border/60 bg-muted/30">
                <div class="text-xs">
                    <span class="font-semibold block text-foreground">Autentikasi Dua Langkah (2FA)</span>
                    <span class="text-muted-foreground">Status saat ini: Aktif melalui Google Authenticator</span>
                </div>
                <vibe:badge variant="outline" size="xs" class="text-emerald-500">Enabled</vibe:badge>
            </div>
        </vibe:card>
    </vibe:tabs.panel>
</vibe:tabs>
                        </vibe:preview.code>

                        <div class="p-6 w-full">
                            <vibe:tabs default="profile" layout="cols" variant="pill" class="gap-6 items-start">
                                {{-- Custom Sidebar Container --}}
                                <vibe:tabs.list class="w-full md:w-64 p-3 bg-muted/40 rounded-2xl border border-border/70 flex flex-col gap-2 shrink-0">
                                    <div class="px-3 py-2 text-[11px] font-bold uppercase tracking-wider text-muted-foreground">
                                        Akun & Akses
                                    </div>

                                    <vibe:tabs.tab name="profile" class="w-full justify-start rounded-xl h-11 px-4 text-sm font-medium">
                                        <x-slot:icon>
                                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg>
                                        </x-slot:icon>
                                        {{ __('docs/tabs.custom.sidebar_tab_profile') }}
                                    </vibe:tabs.tab>

                                    <vibe:tabs.tab name="billing" badge="Pro" badgeVariant="primary" class="w-full justify-start rounded-xl h-11 px-4 text-sm font-medium">
                                        <x-slot:icon>
                                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                                        </x-slot:icon>
                                        {{ __('docs/tabs.custom.sidebar_tab_billing') }}
                                    </vibe:tabs.tab>

                                    <vibe:tabs.tab name="api" class="w-full justify-start rounded-xl h-11 px-4 text-sm font-medium">
                                        <x-slot:icon>
                                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>
                                        </x-slot:icon>
                                        {{ __('docs/tabs.custom.sidebar_tab_api') }}
                                    </vibe:tabs.tab>

                                    <vibe:tabs.tab name="security" class="w-full justify-start rounded-xl h-11 px-4 text-sm font-medium">
                                        <x-slot:icon>
                                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                        </x-slot:icon>
                                        {{ __('docs/tabs.custom.sidebar_tab_security') }}
                                    </vibe:tabs.tab>
                                </vibe:tabs.list>

                                {{-- Content Panels with Card Frame --}}
                                <vibe:tabs.panel name="profile" class="flex-1 min-w-0">
                                    <vibe:card class="rounded-2xl p-6 border border-border/70 shadow-2xs space-y-4">
                                        <h4 class="font-bold text-base text-foreground">{{ __('docs/tabs.custom.sidebar_profile_title') }}</h4>
                                        <p class="text-xs text-muted-foreground">{{ __('docs/tabs.custom.sidebar_profile_desc') }}</p>
                                        <div class="space-y-3 pt-2">
                                            <vibe:input label="Nama Lengkap" value="Fahril Rizqy" />
                                            <vibe:input label="Email" value="fahril@teknovate.id" />
                                        </div>
                                    </vibe:card>
                                </vibe:tabs.panel>

                                <vibe:tabs.panel name="billing" class="flex-1 min-w-0">
                                    <vibe:card class="rounded-2xl p-6 border border-border/70 shadow-2xs space-y-4">
                                        <div class="flex items-center justify-between">
                                            <h4 class="font-bold text-base text-foreground">{{ __('docs/tabs.custom.sidebar_billing_title') }}</h4>
                                            <vibe:badge variant="primary">Aktif</vibe:badge>
                                        </div>
                                        <p class="text-xs text-muted-foreground">{{ __('docs/tabs.custom.sidebar_billing_desc') }}</p>
                                        <div class="pt-2">
                                            <vibe:button size="sm">Perbarui Metode Pembayaran</vibe:button>
                                        </div>
                                    </vibe:card>
                                </vibe:tabs.panel>

                                <vibe:tabs.panel name="api" class="flex-1 min-w-0">
                                    <vibe:card class="rounded-2xl p-6 border border-border/70 shadow-2xs space-y-4">
                                        <h4 class="font-bold text-base text-foreground">{{ __('docs/tabs.custom.sidebar_api_title') }}</h4>
                                        <p class="text-xs text-muted-foreground">{{ __('docs/tabs.custom.sidebar_api_desc') }}</p>
                                        <div class="p-3 bg-muted/40 rounded-xl border border-border font-mono text-xs flex items-center justify-between">
                                            <span>vb_live_9a87f2e1c4b0...</span>
                                            <vibe:button size="sm" variant="outline">Salin</vibe:button>
                                        </div>
                                    </vibe:card>
                                </vibe:tabs.panel>

                                <vibe:tabs.panel name="security" class="flex-1 min-w-0">
                                    <vibe:card class="rounded-2xl p-6 border border-border/70 shadow-2xs space-y-4">
                                        <h4 class="font-bold text-base text-foreground">{{ __('docs/tabs.custom.sidebar_security_title') }}</h4>
                                        <p class="text-xs text-muted-foreground">{{ __('docs/tabs.custom.sidebar_security_desc') }}</p>
                                        <div class="pt-2 flex items-center justify-between p-3 rounded-xl border border-border/60 bg-muted/30">
                                            <div class="text-xs">
                                                <span class="font-semibold block text-foreground">Autentikasi Dua Langkah (2FA)</span>
                                                <span class="text-muted-foreground">Status saat ini: Aktif melalui Google Authenticator</span>
                                            </div>
                                            <vibe:badge variant="outline" size="xs" class="text-emerald-500">Enabled</vibe:badge>
                                        </div>
                                    </vibe:card>
                                </vibe:tabs.panel>
                            </vibe:tabs>
                        </div>
                    </vibe:preview>
                </div>

                {{-- 8.4 Developer Terminal Console Code Tabs --}}
                <div class="space-y-3">
                    <div class="space-y-1">
                        <h3 id="terminal-code-tabs" class="text-lg font-semibold text-foreground">{{ __('docs/tabs.custom.terminal_title') }}</h3>
                        <p class="text-sm text-muted-foreground">{!! __('docs/tabs.custom.terminal_desc') !!}</p>
                    </div>

                    <vibe:preview :title="__('docs/tabs.custom.terminal_preview_title')">
                        <vibe:preview.code>
<div class="w-full rounded-2xl border border-zinc-800 bg-zinc-950 p-5 shadow-2xl text-zinc-100">
    <vibe:tabs default="curl" layout="rows" variant="pill">
        {{-- Terminal Window Header with Dots and Monospace Tabs --}}
        <div class="flex flex-wrap items-center justify-between gap-3 pb-3 border-b border-zinc-800/80">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-1.5">
                    <span class="size-3 rounded-full bg-red-500/80 inline-block"></span>
                    <span class="size-3 rounded-full bg-amber-500/80 inline-block"></span>
                    <span class="size-3 rounded-full bg-emerald-500/80 inline-block"></span>
                </div>
                <span class="text-xs font-mono text-zinc-400 pl-2">POST /v1/chat/completions</span>
            </div>

            <vibe:tabs.list class="bg-zinc-900/90 border border-zinc-800 p-1.5 rounded-xl gap-2 shadow-inner">
                <vibe:tabs.tab name="curl" class="h-9 px-4.5 text-xs sm:text-sm font-mono font-medium rounded-lg text-zinc-300 hover:text-white">cURL</vibe:tabs.tab>
                <vibe:tabs.tab name="php" class="h-9 px-4.5 text-xs sm:text-sm font-mono font-medium rounded-lg text-zinc-300 hover:text-white">PHP</vibe:tabs.tab>
                <vibe:tabs.tab name="node" class="h-9 px-4.5 text-xs sm:text-sm font-mono font-medium rounded-lg text-zinc-300 hover:text-white">Node.js</vibe:tabs.tab>
                <vibe:tabs.tab name="python" class="h-9 px-4.5 text-xs sm:text-sm font-mono font-medium rounded-lg text-zinc-300 hover:text-white">Python</vibe:tabs.tab>
            </vibe:tabs.list>
        </div>

        {{-- Monospace Terminal Code Panels --}}
        <vibe:tabs.panel name="curl" class="pt-4 font-mono text-xs text-emerald-400 overflow-x-auto leading-relaxed">
            <pre><code>curl https://api.vibeui.com/v1/chat/completions \
  -H "Authorization: Bearer $VIBE_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{ "model": "vibe-flash-2.0", "messages": [{"role": "user", "content": "Halo Vibe!"}] }'</code></pre>
        </vibe:tabs.panel>

        <vibe:tabs.panel name="php" class="pt-4 font-mono text-xs text-sky-400 overflow-x-auto leading-relaxed">
            <pre><code>$client = new \VibeUI\Client(getenv('VIBE_API_KEY'));
$response = $client->chat()->create([
    'model' => 'vibe-flash-2.0',
    'messages' => [['role' => 'user', 'content' => 'Halo Vibe!']],
]);
echo $response->choices[0]->message->content;</code></pre>
        </vibe:tabs.panel>

        <vibe:tabs.panel name="node" class="pt-4 font-mono text-xs text-amber-300 overflow-x-auto leading-relaxed">
            <pre><code>import { VibeClient } from '@vibe-ui/sdk';
const client = new VibeClient({ apiKey: process.env.VIBE_API_KEY });
const chat = await client.chat.create({
  model: 'vibe-flash-2.0',
  messages: [{ role: 'user', content: 'Halo Vibe!' }]
});
console.log(chat.choices[0].message.content);</code></pre>
        </vibe:tabs.panel>

        <vibe:tabs.panel name="python" class="pt-4 font-mono text-xs text-violet-400 overflow-x-auto leading-relaxed">
            <pre><code>import vibe_ui
client = vibe_ui.Client()
completion = client.chat.completions.create(
    model="vibe-flash-2.0",
    messages=[{"role": "user", "content": "Halo Vibe!"}]
)
print(completion.choices[0].message.content)</code></pre>
        </vibe:tabs.panel>
    </vibe:tabs>
</div>
                        </vibe:preview.code>

                        <div class="p-6 w-full">
                            <div class="w-full rounded-2xl border border-zinc-800 bg-zinc-950 p-5 shadow-2xl text-zinc-100">
                                <vibe:tabs default="curl" layout="rows" variant="pill">
                                    {{-- Terminal Window Header with Dots and Monospace Tabs --}}
                                    <div class="flex flex-wrap items-center justify-between gap-3 pb-3 border-b border-zinc-800/80">
                                        <div class="flex items-center gap-2">
                                            <div class="flex items-center gap-1.5">
                                                <span class="size-3 rounded-full bg-red-500/80 inline-block"></span>
                                                <span class="size-3 rounded-full bg-amber-500/80 inline-block"></span>
                                                <span class="size-3 rounded-full bg-emerald-500/80 inline-block"></span>
                                            </div>
                                            <span class="text-xs font-mono text-zinc-400 pl-2">POST /v1/chat/completions</span>
                                        </div>

                                        <vibe:tabs.list class="bg-zinc-900/90 border border-zinc-800 p-1.5 rounded-xl gap-2 shadow-inner">
                                            <vibe:tabs.tab name="curl" class="h-9 px-4.5 text-xs sm:text-sm font-mono font-medium rounded-lg text-zinc-300 hover:text-white">cURL</vibe:tabs.tab>
                                            <vibe:tabs.tab name="php" class="h-9 px-4.5 text-xs sm:text-sm font-mono font-medium rounded-lg text-zinc-300 hover:text-white">PHP</vibe:tabs.tab>
                                            <vibe:tabs.tab name="node" class="h-9 px-4.5 text-xs sm:text-sm font-mono font-medium rounded-lg text-zinc-300 hover:text-white">Node.js</vibe:tabs.tab>
                                            <vibe:tabs.tab name="python" class="h-9 px-4.5 text-xs sm:text-sm font-mono font-medium rounded-lg text-zinc-300 hover:text-white">Python</vibe:tabs.tab>
                                        </vibe:tabs.list>
                                    </div>

                                    {{-- Monospace Terminal Code Panels --}}
                                    <vibe:tabs.panel name="curl" class="pt-4 font-mono text-xs text-emerald-400 overflow-x-auto leading-relaxed">
                                        <pre><code>curl https://api.vibeui.com/v1/chat/completions \
  -H "Authorization: Bearer $VIBE_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{ "model": "vibe-flash-2.0", "messages": [{"role": "user", "content": "Halo Vibe!"}] }'</code></pre>
                                    </vibe:tabs.panel>

                                    <vibe:tabs.panel name="php" class="pt-4 font-mono text-xs text-sky-400 overflow-x-auto leading-relaxed">
                                        <pre><code>$client = new \VibeUI\Client(getenv('VIBE_API_KEY'));
$response = $client->chat()->create([
    'model' => 'vibe-flash-2.0',
    'messages' => [['role' => 'user', 'content' => 'Halo Vibe!']],
]);
echo $response->choices[0]->message->content;</code></pre>
                                    </vibe:tabs.panel>

                                    <vibe:tabs.panel name="node" class="pt-4 font-mono text-xs text-amber-300 overflow-x-auto leading-relaxed">
                                        <pre><code>import { VibeClient } from '@vibe-ui/sdk';
const client = new VibeClient({ apiKey: process.env.VIBE_API_KEY });
const chat = await client.chat.create({
  model: 'vibe-flash-2.0',
  messages: [{ role: 'user', content: 'Halo Vibe!' }]
});
console.log(chat.choices[0].message.content);</code></pre>
                                    </vibe:tabs.panel>

                                    <vibe:tabs.panel name="python" class="pt-4 font-mono text-xs text-violet-400 overflow-x-auto leading-relaxed">
                                        <pre><code>import vibe_ui
client = vibe_ui.Client()
completion = client.chat.completions.create(
    model="vibe-flash-2.0",
    messages=[{"role": "user", "content": "Halo Vibe!"}]
)
print(completion.choices[0].message.content)</code></pre>
                                    </vibe:tabs.panel>
                                </vibe:tabs>
                            </div>
                        </div>
                    </vibe:preview>
                </div>

                {{-- 8.5 Segmented Filter Bar with Counter Badges --}}
                <div class="space-y-3">
                    <div class="space-y-1">
                        <h3 id="segmented-filter-bar" class="text-lg font-semibold text-foreground">{{ __('docs/tabs.custom.filter_title') }}</h3>
                        <p class="text-sm text-muted-foreground">{!! __('docs/tabs.custom.filter_desc') !!}</p>
                    </div>

                    <vibe:preview :title="__('docs/tabs.custom.filter_preview_title')">
                        <vibe:preview.code>
<div class="w-full space-y-4">
    <vibe:tabs default="all" layout="rows" variant="pill" class="w-full">
        {{-- Filter Bar with fitted width & count badges --}}
        <vibe:tabs.list fitted="true" class="w-full max-w-xl mx-auto bg-muted/60 p-1.5 rounded-full border border-border/70 gap-2">
            <vibe:tabs.tab name="all" badge="38" badgeVariant="secondary" class="rounded-full h-10 px-5 text-sm font-semibold">
                {{ __('docs/tabs.custom.filter_tab_all') }}
            </vibe:tabs.tab>
            <vibe:tabs.tab name="active" badge="14" badgeVariant="primary" class="rounded-full h-10 px-5 text-sm font-semibold">
                {{ __('docs/tabs.custom.filter_tab_active') }}
            </vibe:tabs.tab>
            <vibe:tabs.tab name="completed" badge="24" badgeVariant="outline" class="rounded-full h-10 px-5 text-sm font-semibold">
                {{ __('docs/tabs.custom.filter_tab_completed') }}
            </vibe:tabs.tab>
        </vibe:tabs.list>

        {{-- Filter Panels --}}
        <vibe:tabs.panel name="all" class="mt-4">
            <vibe:card class="rounded-xl p-4 border border-border/70 text-center">
                <p class="text-sm text-muted-foreground">{{ __('docs/tabs.custom.filter_all_content') }}</p>
            </vibe:card>
        </vibe:tabs.panel>

        <vibe:tabs.panel name="active" class="mt-4">
            <vibe:card class="rounded-xl p-4 border border-border/70 text-center">
                <p class="text-sm text-muted-foreground">{{ __('docs/tabs.custom.filter_active_content') }}</p>
            </vibe:card>
        </vibe:tabs.panel>

        <vibe:tabs.panel name="completed" class="mt-4">
            <vibe:card class="rounded-xl p-4 border border-border/70 text-center">
                <p class="text-sm text-muted-foreground">{{ __('docs/tabs.custom.filter_completed_content') }}</p>
            </vibe:card>
        </vibe:tabs.panel>
    </vibe:tabs>
</div>
                        </vibe:preview.code>

                        <div class="p-6 w-full">
                            <div class="w-full space-y-4">
                                <vibe:tabs default="all" layout="rows" variant="pill" class="w-full">
                                    {{-- Filter Bar with fitted width & count badges --}}
                                    <vibe:tabs.list fitted="true" class="w-full max-w-xl mx-auto bg-muted/60 p-1.5 rounded-full border border-border/70 gap-2">
                                        <vibe:tabs.tab name="all" badge="38" badgeVariant="secondary" class="rounded-full h-10 px-5 text-sm font-semibold">
                                            {{ __('docs/tabs.custom.filter_tab_all') }}
                                        </vibe:tabs.tab>
                                        <vibe:tabs.tab name="active" badge="14" badgeVariant="primary" class="rounded-full h-10 px-5 text-sm font-semibold">
                                            {{ __('docs/tabs.custom.filter_tab_active') }}
                                        </vibe:tabs.tab>
                                        <vibe:tabs.tab name="completed" badge="24" badgeVariant="outline" class="rounded-full h-10 px-5 text-sm font-semibold">
                                            {{ __('docs/tabs.custom.filter_tab_completed') }}
                                        </vibe:tabs.tab>
                                    </vibe:tabs.list>

                                    {{-- Filter Panels --}}
                                    <vibe:tabs.panel name="all" class="mt-4">
                                        <vibe:card class="rounded-xl p-4 border border-border/70 text-center">
                                            <p class="text-sm text-muted-foreground">{{ __('docs/tabs.custom.filter_all_content') }}</p>
                                        </vibe:card>
                                    </vibe:tabs.panel>

                                    <vibe:tabs.panel name="active" class="mt-4">
                                        <vibe:card class="rounded-xl p-4 border border-border/70 text-center">
                                            <p class="text-sm text-muted-foreground">{{ __('docs/tabs.custom.filter_active_content') }}</p>
                                        </vibe:card>
                                    </vibe:tabs.panel>

                                    <vibe:tabs.panel name="completed" class="mt-4">
                                        <vibe:card class="rounded-xl p-4 border border-border/70 text-center">
                                            <p class="text-sm text-muted-foreground">{{ __('docs/tabs.custom.filter_completed_content') }}</p>
                                        </vibe:card>
                                    </vibe:tabs.panel>
                                </vibe:tabs>
                            </div>
                        </div>
                    </vibe:preview>
                </div>
            </section>

            {{-- 10. Referensi Properti & API --}}
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
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
