@blaze

@props([
    'src',
    'alt' => '',
    'group' => 'default',
    'caption' => null,
    'standalone' => false,
    'imgClass' => 'w-full h-full object-cover',
    'loading' => 'lazy',
    'showCaption' => false,
    'id' => null,
])

@php
    $id = $id ?? uniqid('vibe-img-');
    $effectiveGroup = $standalone ? null : ($group ?? 'default');
@endphp

@pushOnce('head', 'vibe-display-image-js')
    @vite(['resources/js/vibe/display-image.js'])
@endPushOnce

@pushOnce('body', 'vibe-display-lightbox')
    <vibe:display.lightbox />
@endPushOnce

<figure
    id="{{ $id }}"
    {{ $attributes->twMerge(['class' => 'relative inline-flex flex-col group/vibe-img cursor-pointer select-none rounded-xl overflow-hidden bg-muted/20']) }}
    x-data="{
        loaded: false,
        error: false,
        id: '{{ $id }}',
        src: @js($src),
        alt: @js($alt),
        caption: @js($caption),
        group: @js($effectiveGroup),
        standalone: {{ $standalone ? 'true' : 'false' }},
        getStore() {
            return (window.Alpine && window.Alpine.store) ? window.Alpine.store('vibeImageLightbox') : window.VibeImageLightbox;
        },
        init() {
            if (this.$refs.img && this.$refs.img.complete && this.$refs.img.naturalWidth > 0) {
                this.loaded = true;
            }
            const reg = () => {
                const store = this.getStore();
                if (store && !this.standalone) {
                    store.register(this.group, {
                        id: this.id,
                        src: this.src,
                        alt: this.alt,
                        caption: this.caption
                    });
                }
            };
            reg();
            window.addEventListener('alpine:init', reg, { once: true });
            document.addEventListener('livewire:navigated', reg);
        },
        openLightbox() {
            const store = this.getStore();
            if (store) {
                store.open(this.group, this.src, {
                    alt: this.alt,
                    caption: this.caption,
                    standalone: this.standalone
                });
            }
        }
    }"
    @click="openLightbox()"
    tabindex="0"
    role="button"
    :aria-label="alt || 'Perbesar gambar'"
    @keydown.enter.prevent="openLightbox()"
    @keydown.space.prevent="openLightbox()"
>
    {{-- Image Container (Holds Skeleton + Image + Zoom Overlay) --}}
    <div class="relative w-full h-full flex-1 overflow-hidden rounded-[inherit]">
        {{-- Skeleton Loading Placeholder (CLS prevention) --}}
        <div x-show="!loaded && !error" class="absolute inset-0 bg-muted animate-pulse pointer-events-none z-10 rounded-[inherit]"></div>

        {{-- Fallback Error State --}}
        <div x-show="error" class="absolute inset-0 flex flex-col items-center justify-center p-3 bg-muted/50 border border-dashed border-border text-muted-foreground rounded-[inherit] z-10">
            <svg class="size-6 opacity-60" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="8.5" cy="8.5" r="1.5" />
                <path d="M2.5 12c0-4.714 0-7.071 1.464-8.536C5.43 2 7.786 2 12.5 2c4.714 0 7.071 0 8.536 1.464C22.5 4.93 22.5 7.286 22.5 12c0 4.714 0 7.071-1.464 8.536C19.57 22 17.214 22 12.5 22c-4.714 0-7.071 0-8.536-1.464C2.5 19.07 2.5 16.714 2.5 12Z" />
                <path d="m2.5 16.5 5.5-5.5a2 2 0 0 1 2.8 0l7.2 7.2" />
                <path d="m15.5 15.5 1.8-1.8a2 2 0 0 1 2.8 0l2.4 2.3" />
            </svg>
            <span class="text-[11px] mt-1 font-medium text-center truncate max-w-full px-2">{{ $alt ?: __('vibe/image.failed_to_load') }}</span>
        </div>

        {{-- Main Image --}}
        <img
            x-ref="img"
            x-show="!error"
            src="{{ $src }}"
            alt="{{ $alt }}"
            loading="{{ $loading }}"
            x-on:load="loaded = true"
            x-on:error="error = true"
            :class="loaded ? 'opacity-100' : 'opacity-0'"
            class="{{ $imgClass }} transition-transform duration-300 ease-out group-hover/vibe-img:scale-105"
        />

        {{-- Subtle Glassmorphism Zoom Indicator Overlay --}}
        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover/vibe-img:opacity-100 transition-opacity duration-200 flex items-center justify-center pointer-events-none rounded-[inherit] z-20">
            <div class="size-10 rounded-full bg-black/40 backdrop-blur-md border border-white/20 text-white flex items-center justify-center shadow-lg transform scale-90 group-hover/vibe-img:scale-100 transition-transform duration-200">
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" x2="16.65" y1="21" x2="16.65" />
                    <line x1="11" x2="11" y1="8" y2="14" />
                    <line x1="8" x2="14" y1="11" y2="11" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Optional Thumbnail Caption --}}
    @if ($showCaption && ($caption || $slot->isNotEmpty()))
        <figcaption class="shrink-0 text-xs text-muted-foreground mt-2 text-center w-full px-1">
            {{ $caption ?? $slot }}
        </figcaption>
    @endif
</figure>
