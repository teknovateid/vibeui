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
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">src (required)</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">alt</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">aspect: video | square | 4/3</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">lazy: true</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">priority: false</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">skeleton: true (anti-CLS)</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">fallback</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">caption</vibe:badge>
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
{{-- Skeleton aktif secara default (mencegah layout shift) --}}
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
{{-- 1. Gambar rusak tanpa fallback: Menampilkan placeholder galat yang rapi --}}
<vibe:image
    src="https://contoh-domain-tidak-ada.com/gambar-rusak-404.jpg"
    alt="{{ __('docs/image.fallback.broken_alt') }}"
    class="w-full max-w-xs aspect-video rounded-xl"
/>

{{-- 2. Gambar rusak dengan fallback URL gambar pengganti --}}
<vibe:image
    src="https://contoh-domain-tidak-ada.com/gambar-rusak-404.jpg"
    fallback="https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?w=600&auto=format&fit=crop&q=80"
    alt="Fallback Image"
    class="w-full max-w-xs aspect-video rounded-xl"
/>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6 flex flex-col sm:flex-row items-center justify-center gap-6">
                        <div class="flex flex-col items-center gap-2">
                            <span class="text-xs font-semibold text-muted-foreground">{{ __('docs/image.fallback.broken_label') }}</span>
                            <vibe:image
                                src="https://contoh-domain-tidak-ada.com/gambar-rusak-404.jpg"
                                alt="{{ __('docs/image.fallback.broken_alt') }}"
                                class="w-72 aspect-video rounded-xl"
                            />
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <span class="text-xs font-semibold text-muted-foreground">{{ __('docs/image.fallback.fallback_label') }}</span>
                            <vibe:image
                                src="https://contoh-domain-tidak-ada.com/gambar-rusak-404.jpg"
                                fallback="https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?w=600&auto=format&fit=crop&q=80"
                                alt="Fallback Image"
                                class="w-72 aspect-video rounded-xl"
                            />
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Captions --}}
            <section id="keterangan-gambar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/image.caption.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/image.caption.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/image.caption.preview_title')">
                    <vibe:preview.code>
{{-- Menggunakan prop caption="..." --}}
<vibe:image
    src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop&q=80"
    alt="Team Collaboration"
    caption="{{ __('docs/image.caption.caption_text') }}"
    aspect="video"
    class="w-full max-w-lg rounded-xl shadow-xs"
/>

{{-- Atau menggunakan slot kustom untuk konten HTML bebas di figcaption --}}
<vibe:image
    src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop&q=80"
    alt="Team Collaboration"
    aspect="video"
    class="w-full max-w-lg rounded-xl shadow-xs"
>
    <div class="flex items-center justify-center gap-2 text-xs">
        <span class="font-semibold text-foreground">Dokumentasi Tim</span>
        <span>&bull;</span>
        <a href="#" class="text-primary hover:underline">Unduh Resolusi Penuh &rarr;</a>
    </div>
</vibe:image>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-4 sm:p-6">
                        <vibe:image
                            src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop&q=80"
                            alt="Team Collaboration"
                            caption="{{ __('docs/image.caption.caption_text') }}"
                            aspect="video"
                            class="w-full max-w-lg rounded-xl shadow-xs"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Aspect Ratios --}}
            <section id="rasio-aspek" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/image.aspect_ratios.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/image.aspect_ratios.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/image.aspect_ratios.preview_title')">
                    <vibe:preview.code>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 items-start">
    {{-- 16:9 Landscape (aspect="video") --}}
    <div>
        <vibe:image
            src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=600&auto=format&fit=crop&q=80"
            alt="Landscape 16:9"
            aspect="video"
            caption="{{ __('docs/image.aspect_ratios.ratio_16_9') }}"
            class="w-full rounded-xl"
        />
    </div>

    {{-- 1:1 Square (aspect="square") --}}
    <div>
        <vibe:image
            src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=600&auto=format&fit=crop&q=80"
            alt="Square 1:1"
            aspect="square"
            caption="{{ __('docs/image.aspect_ratios.ratio_1_1') }}"
            class="w-full rounded-xl"
        />
    </div>

    {{-- 4:3 Standard (aspect="4/3") --}}
    <div>
        <vibe:image
            src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=600&auto=format&fit=crop&q=80"
            alt="Standard 4:3"
            aspect="4/3"
            caption="{{ __('docs/image.aspect_ratios.ratio_4_3') }}"
            class="w-full rounded-xl"
        />
    </div>
</div>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 items-start">
                            <div>
                                <vibe:image
                                    src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=600&auto=format&fit=crop&q=80"
                                    alt="Landscape 16:9"
                                    aspect="video"
                                    caption="{{ __('docs/image.aspect_ratios.ratio_16_9') }}"
                                    class="w-full rounded-xl"
                                />
                            </div>

                            <div>
                                <vibe:image
                                    src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=600&auto=format&fit=crop&q=80"
                                    alt="Square 1:1"
                                    aspect="square"
                                    caption="{{ __('docs/image.aspect_ratios.ratio_1_1') }}"
                                    class="w-full rounded-xl"
                                />
                            </div>

                            <div>
                                <vibe:image
                                    src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=600&auto=format&fit=crop&q=80"
                                    alt="Standard 4:3"
                                    aspect="4/3"
                                    caption="{{ __('docs/image.aspect_ratios.ratio_4_3') }}"
                                    class="w-full rounded-xl"
                                />
                            </div>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Props Reference --}}
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
                                ['src', 'string', '— (Wajib)', 'URL sumber file gambar yang ingin ditampilkan.'],
                                ['alt', 'string', "''", 'Teks alternatif gambar untuk aksesibilitas pembaca layar dan fallback SEO.'],
                                ['aspect', 'string|null', 'null', 'Rasio aspek gambar: `"square"` (1:1), `"video"` (16:9), `"4/3"`, `"3/2"`, `"21/9"`, atau nilai kustom lainnya. Bisa juga ditentukan via utility class seperti `class="aspect-square"`.'],
                                ['lazy', 'bool', 'true', 'Mengaktifkan pemuatan tunda native browser (`loading="lazy"` dan `fetchpriority="low"`).'],
                                ['priority', 'bool', 'false', 'Jika `true`, menonaktifkan lazy loading, menyetel `fetchpriority="high"`, dan menginjeksi tag `<link rel="preload">` ke `<head>`.'],
                                ['fallback', 'string|null', 'null', 'URL gambar cadangan jika gambar utama gagal dimuat (404 atau koneksi terputus).'],
                                ['skeleton', 'bool', 'true', 'Menampilkan animasi placeholder shimmer pulse saat gambar sedang diunduh untuk mencegah pergeseran layout (CLS).'],
                                ['caption', 'string|null', 'null', 'Teks keterangan gambar yang dirender di dalam tag semantik `<figcaption>`.'],
                                ['imgClass', 'string', "'w-full h-full object-cover'", 'Kelas Tailwind khusus yang diterapkan langsung pada elemen `<img>` internal.'],
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
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
