<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/layouts.title')" :description="__('docs/layouts.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => __('docs/layouts.title'), 'url' => '/docs/layouts']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/layouts.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/layouts.subtitle') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">
                    {{ __('docs/layouts.title') }}
                </h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/layouts.description') }}
                </p>
            </div>

            {{-- Section 1 --}}
            <section id="layout-variants" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/layouts.sections.architecture.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{{ __('docs/layouts.sections.architecture.desc') }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ([
                        'sidebar' => 'sidebar',
                        'sidebar_classic' => 'sidebar-classic',
                        'topbar' => 'topbar',
                    ] as $cardKey => $styleSlug)
                        <vibe:card class="flex flex-col justify-between gap-4 p-5">
                            <div class="space-y-2">
                                <div class="flex items-center justify-between gap-2">
                                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">
                                        {{ __("docs/layouts.sections.architecture.cards.{$cardKey}.tag") }}
                                    </vibe:badge>
                                </div>
                                <h3 class="text-sm font-semibold text-foreground">
                                    {{ __("docs/layouts.sections.architecture.cards.{$cardKey}.title") }}
                                </h3>
                                <p class="text-xs text-muted-foreground leading-relaxed">
                                    {{ __("docs/layouts.sections.architecture.cards.{$cardKey}.desc") }}
                                </p>
                            </div>
                            <div class="pt-2 border-t border-border/60 flex items-center justify-between gap-2">
                                <code class="text-[10px] font-mono text-muted-foreground truncate">layouts/{{ $styleSlug }}.css</code>
                                <vibe:button href="{{ route('docs.layouts.demo', $styleSlug) }}" variant="outline" size="xs">
                                    {{ __('docs/layouts.sections.architecture.preview_demo') }}
                                </vibe:button>
                            </div>
                        </vibe:card>
                    @endforeach
                </div>
            </section>

            {{-- Section 2 --}}
            <section id="props-and-slots" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/layouts.sections.props_slots.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{{ __('docs/layouts.sections.props_slots.desc') }}</p>
                </div>

                <vibe:highlight language="html" title="Custom Props, CSS Vars & Slots" :lineNumbers="true">
&lt;x-docs.layouts.sidebar
    shell="floating"
    navVariant="primary"
    :sidebarSize="280"
    :cssVars="['radius' => '1.25rem', 'gap' => '1rem']"
    :styles="['resources/css/custom/my-panel.css']"
    :scripts="['resources/js/custom/my-panel.js']"
&gt;
    &lt;x-slot:headerCenter&gt;
        &lt;vibe:badge variant="primary" size="sm"&gt;Custom Workspace&lt;/vibe:badge&gt;
    &lt;/x-slot:headerCenter&gt;

    {{ $slot ?? '' }}
&lt;/x-docs.layouts.sidebar&gt;
                </vibe:highlight>
            </section>

            {{-- Section 3 --}}
            <section id="custom-panels" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/layouts.sections.custom_panel.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{{ __('docs/layouts.sections.custom_panel.desc') }}</p>
                </div>

                <vibe:highlight language="bash" title="Artisan Layout Generator CLI">
# Generate panel admin memakai style topbar + file CSS/JS override terisolasi
php artisan vibe:layout admin --style=topbar --with-assets

# Generate panel portal memakai classic sidebar
php artisan vibe:layout portal --style=sidebar-classic
                </vibe:highlight>
            </section>
        </div>

        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>
    </div>
</x-docs.layouts.sidebar>
