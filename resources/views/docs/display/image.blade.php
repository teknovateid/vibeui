<x-docs.layouts.sidebar>
    <vibe:seo 
        :title="__('docs/display/image.seo_title')" 
        :description="__('docs/display/image.seo_description')" 
        schema="techarticle" 
        :breadcrumbs="[
            ['name' => __('docs/display/image.breadcrumbs.home'), 'url' => '/'],
            ['name' => __('docs/display/image.breadcrumbs.docs'), 'url' => '/docs'],
            ['name' => __('docs/display/image.breadcrumbs.display'), 'url' => route('docs.display.image')],
            ['name' => __('docs/display/image.breadcrumbs.image'), 'url' => route('docs.display.image')]
        ]" 
    />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">{{ __('docs/display/image.badge_component') }}</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">{{ __('docs/display/image.badge_tag') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/display/image.header_features') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/display/image.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {!! __('docs/display/image.description') !!}
                </p>
            </div>

            {{-- 1. Grouped Gallery Preview --}}
            <section id="galeri-grup" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/display/image.grouped.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/display/image.grouped.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/display/image.grouped.preview_title')">
                    <vibe:preview.code>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <\vibe:display.image 
        src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1200&auto=format&fit=crop&q=80" 
        alt="{{ __('docs/display/image.grouped.yosemite.alt') }}" 
        caption="{{ __('docs/display/image.grouped.yosemite.caption') }}"
        group="nature"
        class="w-full aspect-[4/3] rounded-2xl shadow-sm"
    />

    <\vibe:display.image 
        src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1200&auto=format&fit=crop&q=80" 
        alt="{{ __('docs/display/image.grouped.meadow.alt') }}" 
        caption="{{ __('docs/display/image.grouped.meadow.caption') }}"
        group="nature"
        class="w-full aspect-[4/3] rounded-2xl shadow-sm"
    />

    <\vibe:display.image 
        src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=1200&auto=format&fit=crop&q=80" 
        alt="{{ __('docs/display/image.grouped.lake.alt') }}" 
        caption="{{ __('docs/display/image.grouped.lake.caption') }}"
        group="nature"
        class="w-full aspect-[4/3] rounded-2xl shadow-sm"
    />
</div>
                    </vibe:preview.code>

                    <div class="w-full p-4 sm:p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <vibe:display.image 
                                src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1200&auto=format&fit=crop&q=80" 
                                alt="{{ __('docs/display/image.grouped.yosemite.alt') }}" 
                                caption="{{ __('docs/display/image.grouped.yosemite.caption') }}"
                                group="nature"
                                class="w-full aspect-[4/3] rounded-2xl shadow-sm"
                            />

                            <vibe:display.image 
                                src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1200&auto=format&fit=crop&q=80" 
                                alt="{{ __('docs/display/image.grouped.meadow.alt') }}" 
                                caption="{{ __('docs/display/image.grouped.meadow.caption') }}"
                                group="nature"
                                class="w-full aspect-[4/3] rounded-2xl shadow-sm"
                            />

                            <vibe:display.image 
                                src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=1200&auto=format&fit=crop&q=80" 
                                alt="{{ __('docs/display/image.grouped.lake.alt') }}" 
                                caption="{{ __('docs/display/image.grouped.lake.caption') }}"
                                group="nature"
                                class="w-full aspect-[4/3] rounded-2xl shadow-sm"
                            />
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Standalone Image Preview --}}
            <section id="gambar-tunggal" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/display/image.standalone.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/display/image.standalone.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/display/image.standalone.preview_title')">
                    <vibe:preview.code>
<\vibe:display.image 
    src="https://images.unsplash.com/photo-1519681393784-d120267933ba?w=1200&auto=format&fit=crop&q=80" 
    alt="{{ __('docs/display/image.standalone.alt') }}" 
    caption="{{ __('docs/display/image.standalone.caption') }}"
    standalone
    class="w-full max-w-xl aspect-video rounded-2xl shadow-md mx-auto"
/>
                    </vibe:preview.code>

                    <div class="w-full flex justify-center p-4 sm:p-6">
                        <vibe:display.image 
                            src="https://images.unsplash.com/photo-1519681393784-d120267933ba?w=1200&auto=format&fit=crop&q=80" 
                            alt="{{ __('docs/display/image.standalone.alt') }}" 
                            caption="{{ __('docs/display/image.standalone.caption') }}"
                            standalone
                            class="w-full max-w-xl aspect-video rounded-2xl shadow-md mx-auto"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Customization Size & Aspect Ratio via Class --}}
            <section id="kustomisasi-class" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/display/image.sizing.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/display/image.sizing.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/display/image.sizing.preview_title')">
                    <vibe:preview.code>
<div class="flex flex-wrap items-center gap-6 justify-center">
    {{-- Square --}}
    <\vibe:display.image 
        src="https://images.unsplash.com/photo-1534447677768-be436bb09401?w=800&auto=format&fit=crop&q=80" 
        alt="{{ __('docs/display/image.sizing.square.alt') }}" 
        caption="{{ __('docs/display/image.sizing.square.caption') }}"
        group="shape-variations"
        class="w-36 aspect-square rounded-2xl shadow-sm"
    />

    {{-- Portrait (3:4) --}}
    <\vibe:display.image 
        src="https://images.unsplash.com/photo-1518791841217-8f162f1e1131?w=800&auto=format&fit=crop&q=80" 
        alt="{{ __('docs/display/image.sizing.portrait.alt') }}" 
        caption="{{ __('docs/display/image.sizing.portrait.caption') }}"
        group="shape-variations"
        class="w-36 aspect-[3/4] rounded-2xl shadow-sm"
    />

    {{-- Circle (Avatar Lightbox) --}}
    <\vibe:display.image 
        src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=800&auto=format&fit=crop&q=80" 
        alt="{{ __('docs/display/image.sizing.avatar.alt') }}" 
        caption="{{ __('docs/display/image.sizing.avatar.caption') }}"
        standalone
        class="size-28 rounded-full shadow-sm"
    />
</div>
                    </vibe:preview.code>

                    <div class="w-full flex flex-wrap items-center gap-6 justify-center p-6">
                        <vibe:display.image 
                            src="https://images.unsplash.com/photo-1534447677768-be436bb09401?w=800&auto=format&fit=crop&q=80" 
                            alt="{{ __('docs/display/image.sizing.square.alt') }}" 
                            caption="{{ __('docs/display/image.sizing.square.caption') }}"
                            group="shape-variations"
                            class="w-36 aspect-square rounded-2xl shadow-sm"
                        />

                        <vibe:display.image 
                            src="https://images.unsplash.com/photo-1518791841217-8f162f1e1131?w=800&auto=format&fit=crop&q=80" 
                            alt="{{ __('docs/display/image.sizing.portrait.alt') }}" 
                            caption="{{ __('docs/display/image.sizing.portrait.caption') }}"
                            group="shape-variations"
                            class="w-36 aspect-[3/4] rounded-2xl shadow-sm"
                        />

                        <vibe:display.image 
                            src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=800&auto=format&fit=crop&q=80" 
                            alt="{{ __('docs/display/image.sizing.avatar.alt') }}" 
                            caption="{{ __('docs/display/image.sizing.avatar.caption') }}"
                            standalone
                            class="size-28 rounded-full shadow-sm"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Automatic Gallery Container (vibe:display.image-gallery) --}}
            <section id="kontainer-galeri" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/display/image.container.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/display/image.container.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/display/image.container.preview_title')">
                    <vibe:preview.code>
<\vibe:display.image-gallery group="room-interior" class="grid grid-cols-2 gap-4 max-w-xl mx-auto">
    <img 
        src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&auto=format&fit=crop&q=80" 
        alt="{{ __('docs/display/image.container.bedroom.alt') }}" 
        class="w-full aspect-video rounded-xl object-cover shadow-xs"
    />
    <img 
        src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&auto=format&fit=crop&q=80" 
        alt="{{ __('docs/display/image.container.bathroom.alt') }}" 
        class="w-full aspect-video rounded-xl object-cover shadow-xs"
    />
</\vibe:display.image-gallery>
                    </vibe:preview.code>

                    <div class="w-full p-4 sm:p-6">
                        <vibe:display.image-gallery group="room-interior" class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-xl mx-auto">
                            <img 
                                src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&auto=format&fit=crop&q=80" 
                                alt="{{ __('docs/display/image.container.bedroom.alt') }}" 
                                class="w-full aspect-video rounded-xl object-cover shadow-xs"
                            />
                            <img 
                                src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&auto=format&fit=crop&q=80" 
                                alt="{{ __('docs/display/image.container.bathroom.alt') }}" 
                                class="w-full aspect-video rounded-xl object-cover shadow-xs"
                            />
                        </vibe:display.image-gallery>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Keyboard Shortcuts & Touch Gestures --}}
            <section id="pintasan-keyboard" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/display/image.shortcuts.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/display/image.shortcuts.desc') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl border border-border bg-card space-y-3">
                        <h3 class="text-sm font-semibold text-foreground flex items-center gap-2">
                            <svg class="size-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="14" x="2" y="4" rx="2"/>
                                <path d="M6 8h.01M10 8h.01M14 8h.01M18 8h.01M8 12h8M6 12h.01M18 12h.01"/>
                            </svg>
                            {{ __('docs/display/image.shortcuts.desktop_title') }}
                        </h3>
                        <ul class="text-xs space-y-2 text-muted-foreground">
                            <li class="flex items-center justify-between">
                                <span>{{ __('docs/display/image.shortcuts.desktop_prev') }}</span>
                                <kbd class="px-2 py-0.5 rounded bg-muted border border-border font-mono text-foreground font-semibold">ArrowLeft (←)</kbd>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>{{ __('docs/display/image.shortcuts.desktop_next') }}</span>
                                <kbd class="px-2 py-0.5 rounded bg-muted border border-border font-mono text-foreground font-semibold">ArrowRight (→)</kbd>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>{{ __('docs/display/image.shortcuts.desktop_close') }}</span>
                                <kbd class="px-2 py-0.5 rounded bg-muted border border-border font-mono text-foreground font-semibold">Escape (Esc)</kbd>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>{{ __('docs/display/image.shortcuts.desktop_zoom') }}</span>
                                <kbd class="px-2 py-0.5 rounded bg-muted border border-border font-mono text-foreground font-semibold">+ / -</kbd>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>{{ __('docs/display/image.shortcuts.desktop_double_click') }}</span>
                                <span class="font-mono text-foreground font-semibold">{{ __('docs/display/image.shortcuts.desktop_double_click_key') }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card space-y-3">
                        <h3 class="text-sm font-semibold text-foreground flex items-center gap-2">
                            <svg class="size-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="14" height="20" x="5" y="2" rx="2"/>
                                <path d="M12 18h.01"/>
                            </svg>
                            {{ __('docs/display/image.shortcuts.mobile_title') }}
                        </h3>
                        <ul class="text-xs space-y-2 text-muted-foreground">
                            <li class="flex items-center justify-between">
                                <span>{{ __('docs/display/image.shortcuts.mobile_swipe_left_label') }}</span>
                                <span class="font-medium text-foreground">{{ __('docs/display/image.shortcuts.mobile_swipe_left_val') }}</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>{{ __('docs/display/image.shortcuts.mobile_swipe_right_label') }}</span>
                                <span class="font-medium text-foreground">{{ __('docs/display/image.shortcuts.mobile_swipe_right_val') }}</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>{{ __('docs/display/image.shortcuts.mobile_swipe_down_label') }}</span>
                                <span class="font-medium text-foreground">{{ __('docs/display/image.shortcuts.mobile_swipe_down_val') }}</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>{{ __('docs/display/image.shortcuts.mobile_drag_label') }}</span>
                                <span class="font-medium text-foreground">{{ __('docs/display/image.shortcuts.mobile_drag_val') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            {{-- 6. Props & Attributes Reference Table --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/display/image.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/display/image.props.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/display/image.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/display/image.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/display/image.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/display/image.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $imageProps = [
                                ['src', 'string', '—', __('docs/display/image.props.items.src')],
                                ['alt', 'string', "''", __('docs/display/image.props.items.alt')],
                                ['group', 'string', "'default'", __('docs/display/image.props.items.group')],
                                ['caption', 'string|null', 'null', __('docs/display/image.props.items.caption')],
                                ['standalone', 'bool', 'false', __('docs/display/image.props.items.standalone')],
                                ['class', 'string', "''", __('docs/display/image.props.items.class')],
                                ['imgClass', 'string', "'w-full h-full object-cover'", __('docs/display/image.props.items.imgClass')],
                                ['loading', 'string', "'lazy'", __('docs/display/image.props.items.loading')],
                                ['showCaption', 'bool', 'false', __('docs/display/image.props.items.showCaption')],
                            ];
                        @endphp
                        @foreach ($imageProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- vibe:display.image-gallery Props --}}
                <p class="text-sm font-semibold text-foreground pt-4">{!! __('docs/display/image.props.gallery_title') !!}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/display/image.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/display/image.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/display/image.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/display/image.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $galleryProps = [
                                ['group', 'string', "'default'", __('docs/display/image.props.items.gallery_group')],
                            ];
                        @endphp
                        @foreach ($galleryProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
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
