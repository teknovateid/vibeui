<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/image.title')" :description="__('docs/image.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/image.title'), 'url' => '/docs/image']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/image.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/image.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/image.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/image.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">src</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">zoom / preview</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">previewSrc</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">group</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:image.gallery&gt;</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">initials / name</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">fallback</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">class="aspect-*"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">lazy: true</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">priority: false</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">skeleton: true</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">caption / slot</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/image.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/image.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/image.basic_usage.preview_title')">
                    <vibe:preview.code>
<vibe:image
    src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=800&auto=format&fit=crop&q=80"
    alt="{{ __('docs/image.basic_usage.alt_text') }}"
    class="w-full max-w-md aspect-video rounded-xl shadow-xs"
/>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-4 sm:p-6">
                        <vibe:image
                            src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=800&auto=format&fit=crop&q=80"
                            alt="{{ __('docs/image.basic_usage.alt_text') }}"
                            class="w-full max-w-md aspect-video rounded-xl shadow-xs"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Shimmer Skeleton --}}
            <section id="animasi-skeleton" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/image.skeleton.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/image.skeleton.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/image.skeleton.preview_title')">
                    <vibe:preview.code>
{{-- Skeleton aktif secara default (mencegah Cumulative Layout Shift) --}}
<vibe:image
    src="https://images.unsplash.com/photo-1513694203232-719a280e022f?w=800&auto=format&fit=crop&q=80"
    alt="{{ __('docs/image.skeleton.alt_text') }}"
    :skeleton="true"
    class="w-full max-w-md aspect-video rounded-xl"
/>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-4 sm:p-6">
                        <vibe:image
                            src="https://images.unsplash.com/photo-1513694203232-719a280e022f?w=800&auto=format&fit=crop&q=80"
                            alt="{{ __('docs/image.skeleton.alt_text') }}"
                            :skeleton="true"
                            class="w-full max-w-md aspect-video rounded-xl"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. LCP & Priority Preload --}}
            <section id="optimasi-lcp" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/image.priority.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/image.priority.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/image.priority.preview_title')">
                    <vibe:preview.code>
{{-- Hero Banner: priority="true" otomatis menyuntikkan <link rel="preload"> ke <head> --}}
<vibe:image
    src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=1200&auto=format&fit=crop&q=80"
    alt="{{ __('docs/image.priority.alt_text') }}"
    :priority="true"
    caption="{{ __('docs/image.priority.caption') }}"
    class="w-full max-w-2xl aspect-21/9 rounded-xl shadow-xs"
/>
                    </vibe:preview.code>
                    <div class="w-full flex flex-col items-center p-4 sm:p-6">
                        <vibe:image
                            src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=1200&auto=format&fit=crop&q=80"
                            alt="{{ __('docs/image.priority.alt_text') }}"
                            :priority="true"
                            caption="{{ __('docs/image.priority.caption') }}"
                            class="w-full max-w-2xl aspect-21/9 rounded-xl shadow-xs"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Fallback & Broken Image --}}
            <section id="penanganan-fallback" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/image.fallback.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/image.fallback.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/image.fallback.preview_title')">
                    <vibe:preview.code>
{{-- 1. Gambar rusak otomatis menampilkan placeholder SVG bawaan --}}
<vibe:image
    src="https://contoh-domain-tidak-ada.com/gambar-rusak-404.jpg"
    alt="{{ __('docs/image.fallback.broken_alt') }}"
    class="w-full max-w-xs aspect-video rounded-xl"
/>

{{-- 2. Fallback inisial dengan kustomisasi warna via class --}}
<vibe:image
    src="https://contoh-domain-tidak-ada.com/avatar-tidak-ada.jpg"
    initials="JD"
    class="w-full max-w-xs aspect-video rounded-xl bg-blue-100 text-blue-700 dark:bg-blue-950 dark:text-blue-300"
/>

{{-- 3. Ekstraksi inisial otomatis dari nama lengkap (prop name) --}}
<vibe:image
    src="https://contoh-domain-tidak-ada.com/profil-404.jpg"
    name="Alex Rivera"
    class="w-full max-w-xs aspect-video rounded-xl bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300"
/>

{{-- 4. URL gambar cadangan pengganti jika gambar utama galat --}}
<vibe:image
    src="https://contoh-domain-tidak-ada.com/gambar-rusak-404.jpg"
    fallback="https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?w=600&auto=format&fit=crop&q=80"
    alt="{{ __('docs/image.fallback.custom_url_alt') }}"
    class="w-full max-w-xs aspect-video rounded-xl"
/>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-start">
                        <div class="flex flex-col items-center gap-2">
                            <span class="text-xs font-semibold text-muted-foreground text-center">{{ __('docs/image.fallback.broken_label') }}</span>
                            <vibe:image
                                src="https://contoh-domain-tidak-ada.com/gambar-rusak-404.jpg"
                                alt="{{ __('docs/image.fallback.broken_alt') }}"
                                class="w-full aspect-video rounded-xl"
                            />
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <span class="text-xs font-semibold text-muted-foreground text-center">{{ __('docs/image.fallback.initials_label') }}</span>
                            <vibe:image
                                src="https://contoh-domain-tidak-ada.com/avatar-tidak-ada.jpg"
                                initials="JD"
                                class="w-full aspect-video rounded-xl bg-blue-100 text-blue-700 dark:bg-blue-950 dark:text-blue-300"
                            />
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <span class="text-xs font-semibold text-muted-foreground text-center">{{ __('docs/image.fallback.name_label') }}</span>
                            <vibe:image
                                src="https://contoh-domain-tidak-ada.com/profil-404.jpg"
                                name="Alex Rivera"
                                class="w-full aspect-video rounded-xl bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300"
                            />
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <span class="text-xs font-semibold text-muted-foreground text-center">{{ __('docs/image.fallback.fallback_label') }}</span>
                            <vibe:image
                                src="https://contoh-domain-tidak-ada.com/gambar-rusak-404.jpg"
                                fallback="https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?w=600&auto=format&fit=crop&q=80"
                                alt="{{ __('docs/image.fallback.custom_url_alt') }}"
                                class="w-full aspect-video rounded-xl"
                            />
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Detail & Zoom Lightbox --}}
            <section id="modal-zoom-lightbox" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/image.lightbox.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/image.lightbox.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/image.lightbox.preview_title')">
                    <vibe:preview.code>
{{-- 1. Gambar dengan fitur zoom aktif (klik untuk membuka modal detail) --}}
<vibe:image
    src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=800&auto=format&fit=crop&q=80"
    alt="Yosemite Valley Landscape"
    caption="Pemandangan Lembah Yosemite saat matahari terbenam"
    zoom
    class="w-full aspect-video rounded-xl shadow-xs"
/>

{{-- 2. Menggunakan previewSrc untuk resolusi ultra tinggi di dalam modal --}}
<vibe:image
    src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=500&auto=format&fit=crop&q=80"
    previewSrc="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=2000&auto=format&fit=crop&q=80"
    alt="Foggy Forest"
    caption="Hutan Pinus Berkabut (Preview Resolusi Tinggi)"
    zoom
    class="w-full aspect-video rounded-xl shadow-xs"
/>

{{-- 3. Gambar standalone (buka mandiri tanpa navigasi grup) --}}
<vibe:image
    src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=800&auto=format&fit=crop&q=80"
    alt="Microchip Hardware"
    caption="Arsitektur Prosesor Modern"
    zoom
    standalone
    class="w-full aspect-video rounded-xl shadow-xs"
/>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6 grid grid-cols-1 sm:grid-cols-3 gap-6 items-start">
                        <div class="flex flex-col items-center gap-2">
                            <span class="text-xs font-semibold text-muted-foreground text-center">{{ __('docs/image.lightbox.single_label') }}</span>
                            <vibe:image
                                src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=800&auto=format&fit=crop&q=80"
                                alt="Yosemite Valley Landscape"
                                caption="Pemandangan Lembah Yosemite saat matahari terbenam"
                                zoom
                                class="w-full aspect-video rounded-xl shadow-xs"
                            />
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <span class="text-xs font-semibold text-muted-foreground text-center">{{ __('docs/image.lightbox.hd_label') }}</span>
                            <vibe:image
                                src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=500&auto=format&fit=crop&q=80"
                                previewSrc="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=2000&auto=format&fit=crop&q=80"
                                alt="Foggy Forest"
                                caption="Hutan Pinus Berkabut (Preview Resolusi Tinggi)"
                                zoom
                                class="w-full aspect-video rounded-xl shadow-xs"
                            />
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <span class="text-xs font-semibold text-muted-foreground text-center">{{ __('docs/image.lightbox.standalone_label') }}</span>
                            <vibe:image
                                src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=800&auto=format&fit=crop&q=80"
                                alt="Microchip Hardware"
                                caption="Arsitektur Prosesor Modern"
                                zoom
                                standalone
                                class="w-full aspect-video rounded-xl shadow-xs"
                            />
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Image Gallery & Groups --}}
            <section id="galeri-gambar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/image.gallery.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/image.gallery.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/image.gallery.preview_title')">
                    <vibe:preview.code>
{{-- Membungkus gambar dalam kontainer <vibe:image.gallery> --}}
<vibe:image.gallery group="room-tour" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <vibe:image
        src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600&auto=format&fit=crop&q=80"
        alt="{{ __('docs/image.gallery.room_1') }}"
        caption="{{ __('docs/image.gallery.room_1') }}"
        zoom
        class="w-full aspect-4/3 rounded-xl shadow-xs"
    />

    <vibe:image
        src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=600&auto=format&fit=crop&q=80"
        alt="{{ __('docs/image.gallery.room_2') }}"
        caption="{{ __('docs/image.gallery.room_2') }}"
        zoom
        class="w-full aspect-4/3 rounded-xl shadow-xs"
    />

    <vibe:image
        src="https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=600&auto=format&fit=crop&q=80"
        alt="{{ __('docs/image.gallery.room_3') }}"
        caption="{{ __('docs/image.gallery.room_3') }}"
        zoom
        class="w-full aspect-4/3 rounded-xl shadow-xs"
    />

    <vibe:image
        src="https://images.unsplash.com/photo-1513694203232-719a280e022f?w=600&auto=format&fit=crop&q=80"
        alt="{{ __('docs/image.gallery.room_4') }}"
        caption="{{ __('docs/image.gallery.room_4') }}"
        zoom
        class="w-full aspect-4/3 rounded-xl shadow-xs"
    />
</vibe:image.gallery>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <vibe:image.gallery group="room-tour" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <vibe:image
                                src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600&auto=format&fit=crop&q=80"
                                alt="{{ __('docs/image.gallery.room_1') }}"
                                caption="{{ __('docs/image.gallery.room_1') }}"
                                zoom
                                class="w-full aspect-4/3 rounded-xl shadow-xs"
                            />

                            <vibe:image
                                src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=600&auto=format&fit=crop&q=80"
                                alt="{{ __('docs/image.gallery.room_2') }}"
                                caption="{{ __('docs/image.gallery.room_2') }}"
                                zoom
                                class="w-full aspect-4/3 rounded-xl shadow-xs"
                            />

                            <vibe:image
                                src="https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=600&auto=format&fit=crop&q=80"
                                alt="{{ __('docs/image.gallery.room_3') }}"
                                caption="{{ __('docs/image.gallery.room_3') }}"
                                zoom
                                class="w-full aspect-4/3 rounded-xl shadow-xs"
                            />

                            <vibe:image
                                src="https://images.unsplash.com/photo-1513694203232-719a280e022f?w=600&auto=format&fit=crop&q=80"
                                alt="{{ __('docs/image.gallery.room_4') }}"
                                caption="{{ __('docs/image.gallery.room_4') }}"
                                zoom
                                class="w-full aspect-4/3 rounded-xl shadow-xs"
                            />
                        </vibe:image.gallery>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Aspect Ratios --}}
            <section id="rasio-aspek" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/image.aspect_ratios.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/image.aspect_ratios.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/image.aspect_ratios.preview_title')">
                    <vibe:preview.code>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-start">
    {{-- 16:9 Landscape (class="aspect-video") --}}
    <vibe:image
        src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=600&auto=format&fit=crop&q=80"
        alt="Landscape 16:9"
        caption="{{ __('docs/image.aspect_ratios.ratio_16_9') }}"
        class="w-full aspect-video rounded-xl shadow-xs"
    />

    {{-- 1:1 Square (class="aspect-square") --}}
    <vibe:image
        src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=600&auto=format&fit=crop&q=80"
        alt="Square 1:1"
        caption="{{ __('docs/image.aspect_ratios.ratio_1_1') }}"
        class="w-full aspect-square rounded-xl shadow-xs"
    />

    {{-- 4:3 Klasik (class="aspect-4/3") --}}
    <vibe:image
        src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=600&auto=format&fit=crop&q=80"
        alt="Standard 4:3"
        caption="{{ __('docs/image.aspect_ratios.ratio_4_3') }}"
        class="w-full aspect-4/3 rounded-xl shadow-xs"
    />

    {{-- 21:9 Ultrawide (class="aspect-21/9") --}}
    <vibe:image
        src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=600&auto=format&fit=crop&q=80"
        alt="Ultrawide 21:9"
        caption="{{ __('docs/image.aspect_ratios.ratio_21_9') }}"
        class="w-full aspect-21/9 rounded-xl shadow-xs"
    />
</div>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-start">
                            <div>
                                <vibe:image
                                    src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=600&auto=format&fit=crop&q=80"
                                    alt="Landscape 16:9"
                                    caption="{{ __('docs/image.aspect_ratios.ratio_16_9') }}"
                                    class="w-full aspect-video rounded-xl shadow-xs"
                                />
                            </div>

                            <div>
                                <vibe:image
                                    src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=600&auto=format&fit=crop&q=80"
                                    alt="Square 1:1"
                                    caption="{{ __('docs/image.aspect_ratios.ratio_1_1') }}"
                                    class="w-full aspect-square rounded-xl shadow-xs"
                                />
                            </div>

                            <div>
                                <vibe:image
                                    src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=600&auto=format&fit=crop&q=80"
                                    alt="Standard 4:3"
                                    caption="{{ __('docs/image.aspect_ratios.ratio_4_3') }}"
                                    class="w-full aspect-4/3 rounded-xl shadow-xs"
                                />
                            </div>

                            <div>
                                <vibe:image
                                    src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=600&auto=format&fit=crop&q=80"
                                    alt="Ultrawide 21:9"
                                    caption="{{ __('docs/image.aspect_ratios.ratio_21_9') }}"
                                    class="w-full aspect-21/9 rounded-xl shadow-xs"
                                />
                            </div>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Captions & Figcaption --}}
            <section id="keterangan-gambar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/image.caption.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/image.caption.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/image.caption.preview_title')">
                    <vibe:preview.code>
{{-- 1. Menggunakan prop caption="..." teks ringkas --}}
<vibe:image
    src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop&q=80"
    alt="Team Collaboration"
    caption="{{ __('docs/image.caption.caption_text') }}"
    class="w-full max-w-lg aspect-video rounded-xl shadow-xs"
/>

{{-- 2. Menggunakan slot kustom untuk konten HTML bebas --}}
<vibe:image
    src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop&q=80"
    alt="Team Collaboration"
    class="w-full max-w-lg aspect-video rounded-xl shadow-xs"
>
    <div class="flex items-center justify-between text-xs px-1">
        <span class="font-semibold text-foreground">{{ __('docs/image.caption.slot_title') }}</span>
        <div class="flex items-center gap-2">
            <vibe:badge variant="outline" size="sm">{{ __('docs/image.caption.slot_tag') }}</vibe:badge>
            <a href="#" class="text-primary hover:underline">{!! __('docs/image.caption.slot_link') !!}</a>
        </div>
    </div>
</vibe:image>
                    </vibe:preview.code>
                    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-8 p-4 sm:p-6 items-start">
                        <div class="w-full flex justify-center">
                            <vibe:image
                                src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop&q=80"
                                alt="Team Collaboration"
                                caption="{{ __('docs/image.caption.caption_text') }}"
                                class="w-full aspect-video rounded-xl shadow-xs"
                            />
                        </div>

                        <div class="w-full flex justify-center">
                            <vibe:image
                                src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop&q=80"
                                alt="Team Collaboration"
                                class="w-full aspect-video rounded-xl shadow-xs"
                            >
                                <div class="flex items-center justify-between text-xs px-1">
                                    <span class="font-semibold text-foreground">{{ __('docs/image.caption.slot_title') }}</span>
                                    <div class="flex items-center gap-2">
                                        <vibe:badge variant="outline" size="sm">{{ __('docs/image.caption.slot_tag') }}</vibe:badge>
                                        <a href="#" class="text-primary hover:underline">{!! __('docs/image.caption.slot_link') !!}</a>
                                    </div>
                                </div>
                            </vibe:image>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 9. Image Styling & Object Fit --}}
            <section id="kustomisasi-gaya" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/image.styling.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/image.styling.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/image.styling.preview_title')">
                    <vibe:preview.code>
{{-- 1. Hover Zoom Effect --}}
<vibe:image
    src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80"
    alt="Circuit Board"
    class="w-full aspect-video rounded-xl overflow-hidden shadow-xs cursor-pointer"
    imgClass="transition-transform duration-500 group-hover/image:scale-105"
/>

{{-- 2. Grayscale Filter with Color on Hover --}}
<vibe:image
    src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80"
    alt="Circuit Board"
    class="w-full aspect-video rounded-xl overflow-hidden shadow-xs cursor-pointer"
    imgClass="grayscale group-hover/image:grayscale-0 transition-all duration-500"
/>

{{-- 3. Object Contain with Background --}}
<vibe:image
    src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=600&auto=format&fit=crop&q=80"
    alt="Abstract Object"
    class="w-full aspect-video rounded-xl bg-muted/60 p-2 shadow-xs"
    imgClass="object-contain"
/>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6 grid grid-cols-1 sm:grid-cols-3 gap-6 items-start">
                        <div class="flex flex-col items-center gap-2">
                            <vibe:image
                                src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80"
                                alt="Circuit Board"
                                class="w-full aspect-video rounded-xl overflow-hidden shadow-xs cursor-pointer"
                                imgClass="transition-transform duration-500 group-hover/image:scale-105"
                            />
                            <span class="text-xs font-medium text-muted-foreground text-center">{{ __('docs/image.styling.zoom_label') }}</span>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <vibe:image
                                src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&auto=format&fit=crop&q=80"
                                alt="Circuit Board"
                                class="w-full aspect-video rounded-xl overflow-hidden shadow-xs cursor-pointer"
                                imgClass="grayscale group-hover/image:grayscale-0 transition-all duration-500"
                            />
                            <span class="text-xs font-medium text-muted-foreground text-center">{{ __('docs/image.styling.filter_label') }}</span>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <vibe:image
                                src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=600&auto=format&fit=crop&q=80"
                                alt="Abstract Object"
                                class="w-full aspect-video rounded-xl bg-muted/60 p-2 shadow-xs"
                                imgClass="object-contain"
                            />
                            <span class="text-xs font-medium text-muted-foreground text-center">{{ __('docs/image.styling.contain_label') }}</span>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 10. Real-world Compositions --}}
            <section id="komposisi-nyata" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/image.compositions.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/image.compositions.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/image.compositions.preview_title')">
                    <vibe:preview.code>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
    {{-- Komposisi 1: Kartu Artikel / Blog Card --}}
    <vibe:card class="p-0 overflow-hidden group/card hover:border-primary/40 transition-all">
        <vibe:image
            src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800&auto=format&fit=crop&q=80"
            alt="Workspace"
            class="w-full aspect-video rounded-t-xl rounded-b-none"
            imgClass="transition-transform duration-500 group-hover/card:scale-105"
        />
        <div class="p-5 space-y-3">
            <div class="flex items-center justify-between text-xs text-muted-foreground">
                <vibe:badge variant="primary" size="sm">{{ __('docs/image.compositions.blog_card_category') }}</vibe:badge>
                <span>{{ __('docs/image.compositions.blog_card_date') }}</span>
            </div>
            <h3 class="text-base font-bold text-foreground group-hover/card:text-primary transition-colors">
                {{ __('docs/image.compositions.blog_card_title') }}
            </h3>
            <p class="text-xs text-muted-foreground line-clamp-2">
                {{ __('docs/image.compositions.blog_card_desc') }}
            </p>
            <div class="pt-2">
                <vibe:button size="sm" variant="outline" class="w-full">
                    {{ __('docs/image.compositions.blog_card_btn') }}
                </vibe:button>
            </div>
        </div>
    </vibe:card>

    {{-- Komposisi 2: Kartu Profil dengan Fallback Inisial Bulat --}}
    <vibe:card class="p-6 flex flex-col items-center text-center space-y-4">
        <vibe:image
            initials="JM"
            class="size-24 rounded-full bg-primary/10 text-primary border-4 border-background shadow-md"
        />
        <div class="space-y-1">
            <h4 class="text-base font-bold text-foreground">{{ __('docs/image.compositions.profile_card_name') }}</h4>
            <p class="text-xs text-muted-foreground">{{ __('docs/image.compositions.profile_card_role') }}</p>
        </div>
        <div class="flex items-center gap-2 w-full pt-1">
            <vibe:button size="sm" variant="primary" class="w-full">
                {{ __('docs/image.compositions.profile_card_btn') }}
            </vibe:button>
        </div>
    </vibe:card>
</div>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start max-w-3xl mx-auto">
                            {{-- Blog Article Card --}}
                            <vibe:card class="p-0 overflow-hidden group/card hover:border-primary/40 transition-all">
                                <vibe:image
                                    src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800&auto=format&fit=crop&q=80"
                                    alt="Workspace"
                                    class="w-full aspect-video rounded-t-xl rounded-b-none"
                                    imgClass="transition-transform duration-500 group-hover/card:scale-105"
                                />
                                <div class="p-5 space-y-3">
                                    <div class="flex items-center justify-between text-xs text-muted-foreground">
                                        <vibe:badge variant="primary" size="sm">{{ __('docs/image.compositions.blog_card_category') }}</vibe:badge>
                                        <span>{{ __('docs/image.compositions.blog_card_date') }}</span>
                                    </div>
                                    <h3 class="text-base font-bold text-foreground group-hover/card:text-primary transition-colors">
                                        {{ __('docs/image.compositions.blog_card_title') }}
                                    </h3>
                                    <p class="text-xs text-muted-foreground line-clamp-2">
                                        {{ __('docs/image.compositions.blog_card_desc') }}
                                    </p>
                                    <div class="pt-2">
                                        <vibe:button size="sm" variant="outline" class="w-full">
                                            {{ __('docs/image.compositions.blog_card_btn') }}
                                        </vibe:button>
                                    </div>
                                </div>
                            </vibe:card>

                            {{-- User Profile Card --}}
                            <vibe:card class="p-6 flex flex-col items-center text-center space-y-4">
                                <vibe:image
                                    initials="JM"
                                    class="size-24 rounded-full bg-primary/10 text-primary border-4 border-background shadow-md"
                                />
                                <div class="space-y-1">
                                    <h4 class="text-base font-bold text-foreground">{{ __('docs/image.compositions.profile_card_name') }}</h4>
                                    <p class="text-xs text-muted-foreground">{{ __('docs/image.compositions.profile_card_role') }}</p>
                                </div>
                                <div class="flex items-center gap-2 w-full pt-1">
                                    <vibe:button size="sm" variant="primary" class="w-full">
                                        {{ __('docs/image.compositions.profile_card_btn') }}
                                    </vibe:button>
                                </div>
                            </vibe:card>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 11. Best Practices --}}
            <section id="praktik-terbaik" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/image.best_practices.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/image.best_practices.desc') !!}
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="rounded-xl border border-border bg-card p-4 space-y-2">
                        <div class="flex items-center gap-2 text-primary font-semibold text-sm">
                            <span class="size-2 rounded-full bg-primary"></span>
                            <h4>{{ __('docs/image.best_practices.lcp_title') }}</h4>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            {!! __('docs/image.best_practices.lcp_desc') !!}
                        </p>
                    </div>

                    <div class="rounded-xl border border-border bg-card p-4 space-y-2">
                        <div class="flex items-center gap-2 text-success font-semibold text-sm">
                            <span class="size-2 rounded-full bg-success"></span>
                            <h4>{{ __('docs/image.best_practices.cls_title') }}</h4>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            {!! __('docs/image.best_practices.cls_desc') !!}
                        </p>
                    </div>

                    <div class="rounded-xl border border-border bg-card p-4 space-y-2">
                        <div class="flex items-center gap-2 text-warning font-semibold text-sm">
                            <span class="size-2 rounded-full bg-warning"></span>
                            <h4>{{ __('docs/image.best_practices.a11y_title') }}</h4>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            {!! __('docs/image.best_practices.a11y_desc') !!}
                        </p>
                    </div>
                </div>
            </section>

            {{-- 12. Props & Slots Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/image.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/image.props.desc') !!}
                    </p>
                </div>

                {{-- vibe:image Props --}}
                <p class="text-sm font-semibold text-foreground">&lt;vibe:image&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/image.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/image.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/image.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/image.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $imageProps = [
                                ['src', 'string|null', 'null', __('docs/image.props_items.src')],
                                ['alt', 'string', "''", __('docs/image.props_items.alt')],
                                ['zoom', 'bool', 'false', __('docs/image.props_items.zoom')],
                                ['preview', 'bool', 'false', __('docs/image.props_items.preview')],
                                ['previewSrc', 'string|null', 'null', __('docs/image.props_items.previewSrc')],
                                ['group', 'string|null', 'null', __('docs/image.props_items.group')],
                                ['standalone', 'bool', 'false', __('docs/image.props_items.standalone')],
                                ['zoomIcon', 'bool', 'true', __('docs/image.props_items.zoomIcon')],
                                ['initials', 'string|null', 'null', __('docs/image.props_items.initials')],
                                ['name', 'string|null', 'null', __('docs/image.props_items.name')],
                                ['fallback', 'string|bool', "asset('vibe/images/not-found.png')", __('docs/image.props_items.fallback')],
                                ['lazy', 'bool', 'true', __('docs/image.props_items.lazy')],
                                ['priority', 'bool', 'false', __('docs/image.props_items.priority')],
                                ['skeleton', 'bool', 'true', __('docs/image.props_items.skeleton')],
                                ['caption', 'string|null', 'null', __('docs/image.props_items.caption')],
                                ['initialsClass', 'string|null', 'null', __('docs/image.props_items.initialsClass')],
                                ['imgClass', 'string', "'w-full h-full object-cover'", __('docs/image.props_items.imgClass')],
                                ['class', 'string|null', 'null', __('docs/image.props_items.class')],
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

                {{-- vibe:image.gallery Props --}}
                <p class="text-sm font-semibold text-foreground pt-4">&lt;vibe:image.gallery&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/image.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/image.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/image.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/image.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">group</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">string</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">'default'</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">{{ __('docs/image.props_items.gallery_group') }}</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>

                {{-- Slots Reference --}}
                <p class="text-sm font-semibold text-foreground pt-4">{{ __('docs/image.slots.title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/image.slots.columns.slot') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/image.slots.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">default ($slot)</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">{!! __('docs/image.slots.default_desc') !!}</vibe:table.cell>
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
