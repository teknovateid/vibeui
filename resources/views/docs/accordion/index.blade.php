<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/accordion.title')" :description="__('docs/accordion.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/accordion.title'), 'url' => '/docs/accordion']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/accordion.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/accordion.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/accordion.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/accordion.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">type="single"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">type="multiple"</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">default</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">separated / card</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">flush</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">filled / muted</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">sm / md / lg</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:collapsible="false"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">chevronPosition="left"</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/accordion.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/accordion.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/accordion.basic_usage.preview_title')">
                    <vibe:preview.code>
                        <vibe:accordion selected="faq-1">
                            {{-- Shorthand syntax with title prop --}}
                            <vibe:accordion.item value="faq-1" title="{{ __('docs/accordion.basic_usage.q1_title') }}">
                                {{ __('docs/accordion.basic_usage.q1_desc') }}
                            </vibe:accordion.item>

                            {{-- Granular syntax with heading & content --}}
                            <vibe:accordion.item value="faq-2">
                                <vibe:accordion.heading>
                                    {{ __('docs/accordion.basic_usage.q2_title') }}
                                </vibe:accordion.heading>
                                <vibe:accordion.content>
                                    {{ __('docs/accordion.basic_usage.q2_desc') }}
                                </vibe:accordion.content>
                            </vibe:accordion.item>

                            <vibe:accordion.item value="faq-3" title="{{ __('docs/accordion.basic_usage.q3_title') }}">
                                {{ __('docs/accordion.basic_usage.q3_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </vibe:preview.code>

                    <div class="w-full max-w-2xl mx-auto p-4">
                        <vibe:accordion selected="faq-1">
                            <vibe:accordion.item value="faq-1" title="{{ __('docs/accordion.basic_usage.q1_title') }}">
                                {{ __('docs/accordion.basic_usage.q1_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="faq-2">
                                <vibe:accordion.heading>
                                    {{ __('docs/accordion.basic_usage.q2_title') }}
                                </vibe:accordion.heading>
                                <vibe:accordion.content>
                                    {{ __('docs/accordion.basic_usage.q2_desc') }}
                                </vibe:accordion.content>
                            </vibe:accordion.item>

                            <vibe:accordion.item value="faq-3" title="{{ __('docs/accordion.basic_usage.q3_title') }}">
                                {{ __('docs/accordion.basic_usage.q3_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Expansion Mode: Single vs Multiple --}}
            <section id="mode-ekspansi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/accordion.types.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/accordion.types.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/accordion.types.preview_title')">
                    <vibe:preview.code>
                        {{-- Mode multiple: beberapa panel dapat terbuka bersamaan --}}
                        <vibe:accordion type="multiple" :selected="['sec-1', 'sec-2']">
                            <vibe:accordion.item value="sec-1" title="{{ __('docs/accordion.types.multi_q1') }}">
                                {{ __('docs/accordion.types.multi_q1_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="sec-2" title="{{ __('docs/accordion.types.multi_q2') }}">
                                {{ __('docs/accordion.types.multi_q2_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="sec-3" title="{{ __('docs/accordion.types.multi_q3') }}">
                                {{ __('docs/accordion.types.multi_q3_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </vibe:preview.code>

                    <div class="w-full max-w-2xl mx-auto p-4">
                        <vibe:accordion type="multiple" :selected="['sec-1', 'sec-2']">
                            <vibe:accordion.item value="sec-1" title="{{ __('docs/accordion.types.multi_q1') }}">
                                {{ __('docs/accordion.types.multi_q1_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="sec-2" title="{{ __('docs/accordion.types.multi_q2') }}">
                                {{ __('docs/accordion.types.multi_q2_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="sec-3" title="{{ __('docs/accordion.types.multi_q3') }}">
                                {{ __('docs/accordion.types.multi_q3_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Visual Variants: Separated / Card --}}
            <section id="varian-tampilan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/accordion.variants.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/accordion.variants.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/accordion.variants.preview_title')">
                    <vibe:preview.code>
                        {{-- Varian separated / card: Tiap item berupa kartu mandiri --}}
                        <vibe:accordion variant="separated" selected="card-1">
                            <vibe:accordion.item value="card-1" title="{{ __('docs/accordion.variants.card_q1') }}">
                                {{ __('docs/accordion.variants.card_q1_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="card-2" title="{{ __('docs/accordion.variants.card_q2') }}">
                                {{ __('docs/accordion.variants.card_q2_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="card-3" title="{{ __('docs/accordion.variants.card_q3') }}">
                                {{ __('docs/accordion.variants.card_q3_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </vibe:preview.code>

                    <div class="w-full max-w-2xl mx-auto p-4">
                        <vibe:accordion variant="separated" selected="card-1">
                            <vibe:accordion.item value="card-1" title="{{ __('docs/accordion.variants.card_q1') }}">
                                {{ __('docs/accordion.variants.card_q1_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="card-2" title="{{ __('docs/accordion.variants.card_q2') }}">
                                {{ __('docs/accordion.variants.card_q2_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="card-3" title="{{ __('docs/accordion.variants.card_q3') }}">
                                {{ __('docs/accordion.variants.card_q3_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Flush Variant --}}
            <section id="varian-flush" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/accordion.flush.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/accordion.flush.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/accordion.flush.preview_title')">
                    <vibe:preview.code>
                        <vibe:accordion variant="flush" selected="flush-1">
                            <vibe:accordion.item value="flush-1" title="{{ __('docs/accordion.basic_usage.q1_title') }}">
                                {{ __('docs/accordion.basic_usage.q1_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="flush-2" title="{{ __('docs/accordion.basic_usage.q2_title') }}">
                                {{ __('docs/accordion.basic_usage.q2_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </vibe:preview.code>

                    <div class="w-full max-w-2xl mx-auto p-4">
                        <vibe:accordion variant="flush" selected="flush-1">
                            <vibe:accordion.item value="flush-1" title="{{ __('docs/accordion.basic_usage.q1_title') }}">
                                {{ __('docs/accordion.basic_usage.q1_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="flush-2" title="{{ __('docs/accordion.basic_usage.q2_title') }}">
                                {{ __('docs/accordion.basic_usage.q2_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Sizes --}}
            <section id="pilihan-ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/accordion.sizes.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/accordion.sizes.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/accordion.sizes.preview_title')">
                    <vibe:preview.code>
                        {{-- Small (sm) --}}
                        <vibe:accordion size="sm">
                            <vibe:accordion.item value="s-1" title="{{ __('docs/accordion.sizes.size_sm') }}">
                                {{ __('docs/accordion.sizes.sample_content') }}
                            </vibe:accordion.item>
                        </vibe:accordion>

                        {{-- Medium (md - default) --}}
                        <vibe:accordion size="md" selected="m-1">
                            <vibe:accordion.item value="m-1" title="{{ __('docs/accordion.sizes.size_md') }}">
                                {{ __('docs/accordion.sizes.sample_content') }}
                            </vibe:accordion.item>
                        </vibe:accordion>

                        {{-- Large (lg) --}}
                        <vibe:accordion size="lg">
                            <vibe:accordion.item value="l-1" title="{{ __('docs/accordion.sizes.size_lg') }}">
                                {{ __('docs/accordion.sizes.sample_content') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </vibe:preview.code>

                    <div class="w-full max-w-2xl mx-auto p-4 space-y-6">
                        <div>
                            <span class="text-xs font-semibold text-muted-foreground uppercase tracking-wider block mb-2">Size: Small (sm)</span>
                            <vibe:accordion size="sm">
                                <vibe:accordion.item value="s-1" title="{{ __('docs/accordion.sizes.size_sm') }}">
                                    {{ __('docs/accordion.sizes.sample_content') }}
                                </vibe:accordion.item>
                            </vibe:accordion>
                        </div>

                        <div>
                            <span class="text-xs font-semibold text-muted-foreground uppercase tracking-wider block mb-2">Size: Medium (md - default)</span>
                            <vibe:accordion size="md" selected="m-1">
                                <vibe:accordion.item value="m-1" title="{{ __('docs/accordion.sizes.size_md') }}">
                                    {{ __('docs/accordion.sizes.sample_content') }}
                                </vibe:accordion.item>
                            </vibe:accordion>
                        </div>

                        <div>
                            <span class="text-xs font-semibold text-muted-foreground uppercase tracking-wider block mb-2">Size: Large (lg)</span>
                            <vibe:accordion size="lg">
                                <vibe:accordion.item value="l-1" title="{{ __('docs/accordion.sizes.size_lg') }}">
                                    {{ __('docs/accordion.sizes.sample_content') }}
                                </vibe:accordion.item>
                            </vibe:accordion>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Icons, Badges & Subtitles --}}
            <section id="icon-badge" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/accordion.icons_badges.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/accordion.icons_badges.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/accordion.icons_badges.preview_title')">
                    <vibe:preview.code>
                        <vibe:accordion selected="feat-1" variant="separated">
                            {{-- Item dengan Icon, Subtitle, dan Badge --}}
                            <vibe:accordion.item
                                value="feat-1"
                                title="{{ __('docs/accordion.icons_badges.billing_title') }}"
                                subtitle="{{ __('docs/accordion.icons_badges.billing_sub') }}"
                                badge="Active"
                                badgeVariant="primary"
                            >
                                <x-slot:iconSlot>
                                    <svg class="size-5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/>
                                    </svg>
                                </x-slot:iconSlot>
                                {{ __('docs/accordion.icons_badges.billing_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item
                                value="feat-2"
                                title="{{ __('docs/accordion.icons_badges.team_title') }}"
                                subtitle="{{ __('docs/accordion.icons_badges.team_sub') }}"
                                badge="5 Members"
                                badgeVariant="outline"
                            >
                                <x-slot:iconSlot>
                                    <svg class="size-5 text-indigo-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                </x-slot:iconSlot>
                                {{ __('docs/accordion.icons_badges.team_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item
                                value="feat-3"
                                title="{{ __('docs/accordion.icons_badges.api_title') }}"
                                subtitle="{{ __('docs/accordion.icons_badges.api_sub') }}"
                                badge="Secret"
                                badgeVariant="destructive"
                            >
                                <x-slot:iconSlot>
                                    <svg class="size-5 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m21 2-2 2m-1.5 1.5L10 13m4-4 2 2m-2-2-4 4-2-2m-4 4-2 2m1.5-1.5L2 21m4-4-2-2"/>
                                    </svg>
                                </x-slot:iconSlot>
                                {{ __('docs/accordion.icons_badges.api_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </vibe:preview.code>

                    <div class="w-full max-w-2xl mx-auto p-4">
                        <vibe:accordion selected="feat-1" variant="separated">
                            <vibe:accordion.item
                                value="feat-1"
                                title="{{ __('docs/accordion.icons_badges.billing_title') }}"
                                subtitle="{{ __('docs/accordion.icons_badges.billing_sub') }}"
                                badge="Active"
                                badgeVariant="primary"
                            >
                                <x-slot:iconSlot>
                                    <svg class="size-5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/>
                                    </svg>
                                </x-slot:iconSlot>
                                {{ __('docs/accordion.icons_badges.billing_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item
                                value="feat-2"
                                title="{{ __('docs/accordion.icons_badges.team_title') }}"
                                subtitle="{{ __('docs/accordion.icons_badges.team_sub') }}"
                                badge="5 Members"
                                badgeVariant="outline"
                            >
                                <x-slot:iconSlot>
                                    <svg class="size-5 text-indigo-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                </x-slot:iconSlot>
                                {{ __('docs/accordion.icons_badges.team_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item
                                value="feat-3"
                                title="{{ __('docs/accordion.icons_badges.api_title') }}"
                                subtitle="{{ __('docs/accordion.icons_badges.api_sub') }}"
                                badge="Secret"
                                badgeVariant="destructive"
                            >
                                <x-slot:iconSlot>
                                    <svg class="size-5 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m21 2-2 2m-1.5 1.5L10 13m4-4 2 2m-2-2-4 4-2-2m-4 4-2 2m1.5-1.5L2 21m4-4-2-2"/>
                                    </svg>
                                </x-slot:iconSlot>
                                {{ __('docs/accordion.icons_badges.api_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Chevron Customization --}}
            <section id="posisi-chevron" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/accordion.chevron.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/accordion.chevron.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/accordion.chevron.preview_title')">
                    <vibe:preview.code>
                        {{-- Chevron di sisi kiri (chevronPosition="left") --}}
                        <vibe:accordion chevronPosition="left" selected="chev-1">
                            <vibe:accordion.item value="chev-1" title="{{ __('docs/accordion.chevron.q1') }}">
                                {{ __('docs/accordion.chevron.q1_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="chev-2" title="{{ __('docs/accordion.basic_usage.q2_title') }}">
                                {{ __('docs/accordion.basic_usage.q2_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </vibe:preview.code>

                    <div class="w-full max-w-2xl mx-auto p-4">
                        <vibe:accordion chevronPosition="left" selected="chev-1">
                            <vibe:accordion.item value="chev-1" title="{{ __('docs/accordion.chevron.q1') }}">
                                {{ __('docs/accordion.chevron.q1_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="chev-2" title="{{ __('docs/accordion.basic_usage.q2_title') }}">
                                {{ __('docs/accordion.basic_usage.q2_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Collapsible = False (Always Open) --}}
            <section id="selalu-terbuka" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/accordion.collapsible.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/accordion.collapsible.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/accordion.collapsible.preview_title')">
                    <vibe:preview.code>
                        {{-- collapsible="false": Item aktif tidak dapat ditutup, selalu minimal 1 terbuka --}}
                        <vibe:accordion :collapsible="false" selected="c-1">
                            <vibe:accordion.item value="c-1" title="{{ __('docs/accordion.basic_usage.q1_title') }}">
                                {{ __('docs/accordion.basic_usage.q1_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="c-2" title="{{ __('docs/accordion.basic_usage.q2_title') }}">
                                {{ __('docs/accordion.basic_usage.q2_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </vibe:preview.code>

                    <div class="w-full max-w-2xl mx-auto p-4">
                        <vibe:accordion :collapsible="false" selected="c-1">
                            <vibe:accordion.item value="c-1" title="{{ __('docs/accordion.basic_usage.q1_title') }}">
                                {{ __('docs/accordion.basic_usage.q1_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="c-2" title="{{ __('docs/accordion.basic_usage.q2_title') }}">
                                {{ __('docs/accordion.basic_usage.q2_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </div>
                </vibe:preview>
            </section>

            {{-- 9. Disabled State --}}
            <section id="status-disabled" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/accordion.disabled.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/accordion.disabled.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/accordion.disabled.preview_title')">
                    <vibe:preview.code>
                        <vibe:accordion selected="dis-1">
                            <vibe:accordion.item value="dis-1" title="{{ __('docs/accordion.disabled.active_item') }}">
                                {{ __('docs/accordion.disabled.active_desc') }}
                            </vibe:accordion.item>

                            {{-- Item dinonaktifkan / terkunci --}}
                            <vibe:accordion.item value="dis-2" :disabled="true" title="{{ __('docs/accordion.disabled.disabled_item') }}">
                                {{ __('docs/accordion.disabled.disabled_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </vibe:preview.code>

                    <div class="w-full max-w-2xl mx-auto p-4">
                        <vibe:accordion selected="dis-1">
                            <vibe:accordion.item value="dis-1" title="{{ __('docs/accordion.disabled.active_item') }}">
                                {{ __('docs/accordion.disabled.active_desc') }}
                            </vibe:accordion.item>

                            <vibe:accordion.item value="dis-2" :disabled="true" title="{{ __('docs/accordion.disabled.disabled_item') }}">
                                {{ __('docs/accordion.disabled.disabled_desc') }}
                            </vibe:accordion.item>
                        </vibe:accordion>
                    </div>
                </vibe:preview>
            </section>

            {{-- 10. Complete Props Reference --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/accordion.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/accordion.props.desc') !!}
                    </p>
                </div>

                <div class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">&lt;vibe:accordion&gt;</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/accordion.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/accordion.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/accordion.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/accordion.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">type</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">'single' | 'multiple'</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">'single'</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.type') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">collapsible</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">true</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.collapsible') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">selected / value / default</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string | array</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">null</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.selected') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">variant</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">'default'</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.variant') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">size</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">'sm' | 'md' | 'lg'</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">'md'</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.size') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">chevron</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">true</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.chevron') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">chevronPosition</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">'right' | 'left'</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">'right'</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.chevronPosition') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">disabled</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">false</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.disabled') }}</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                <div class="space-y-3 pt-4">
                    <h3 class="text-base font-semibold text-foreground">&lt;vibe:accordion.item&gt;</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/accordion.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/accordion.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/accordion.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/accordion.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">value</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">uniqid()</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.item_value') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">title</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">null</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.item_title') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">subtitle</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">null</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.item_subtitle') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">icon</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">null</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.item_icon') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">badge</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">null</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.item_badge') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">open</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">false</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.item_open') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">disabled</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">bool</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary whitespace-nowrap">false</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/accordion.props.items.disabled') }}</vibe:table.cell>
                            </vibe:table.row>
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
