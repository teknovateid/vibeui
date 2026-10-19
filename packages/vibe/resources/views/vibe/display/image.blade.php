@blaze

@props(['src', 'alt' => '', 'group' => 'default', 'caption' => null, 'standalone' => false, 'imgClass' => 'w-full h-full object-cover', 'loading' => 'lazy', 'showCaption' => false, 'id' => null])

@php
    $id = $id ?? uniqid('vibe-img-');
    $effectiveGroup = $standalone ? null : $group ?? 'default';
@endphp

@pushOnce('head', 'vibe-display-image-js')
    @vite(['resources/js/vibe/display-image.js'])
@endPushOnce

@pushOnce('body', 'vibe-display-lightbox')
    <vibe:display.lightbox />
@endPushOnce

<figure id="{{ $id }}" data-vibe-image data-src="{{ $src }}" data-alt="{{ $alt }}" data-caption="{{ $caption }}" data-group="{{ $effectiveGroup }}" @if ($standalone) data-standalone @endif tabindex="0" role="button" aria-label="{{ $alt ?: 'Perbesar gambar' }}" {{ $attributes->twMerge(['class' => 'relative inline-flex flex-col group/vibe-img cursor-pointer select-none rounded-xl overflow-hidden bg-muted/20']) }}>
    {{-- Image Container (Holds Image + Zoom Overlay) --}}
    <div class="relative w-full h-full flex-1 overflow-hidden rounded-[inherit]">
        {{-- Main Image with Native Lazy Loading --}}
        <img src="{{ $src }}" alt="{{ $alt }}" loading="{{ $loading }}" class="{{ $imgClass }} transition-transform duration-300 ease-out group-hover/vibe-img:scale-105" />

        {{-- Subtle Glassmorphism Zoom Indicator Overlay --}}
        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover/vibe-img:opacity-100 transition-opacity duration-200 flex items-center justify-center pointer-events-none rounded-[inherit] z-20">
            <div class="size-10 rounded-full p-1.5 bg-black/40 backdrop-blur-md border border-white/20 text-white flex items-center justify-center shadow-lg transform scale-90 group-hover/vibe-img:scale-100 transition-transform duration-200">
                <svg class="size-full" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <g fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" d="M12 8v4m0 0v4m0-4h4m-4 0H8" />
                        <circle cx="12" cy="12" r="10" />
                    </g>
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
