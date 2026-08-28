@props(['src', 'alt' => '', 'lazy' => true, 'priority' => false, 'fallback' => null, 'skeleton' => true, 'caption' => null, 'imgClass' => 'w-full h-full object-cover'])

@php
    $isLazy = $priority ? false : (bool) $lazy;
    $loadingMode = $isLazy ? 'lazy' : 'eager';
    $fetchPriority = $priority ? 'high' : ($isLazy ? 'low' : 'auto');
    $decoding = 'async';
@endphp

@if ($priority)
{{-- @dd($priority) --}}
    @push('head')
        <link rel="preload" as="image" href="{{ $src }}">
    @endpush
@endif

<figure {{ $attributes->twMerge(['class' => 'relative inline-flex flex-col group/image rounded-lg']) }} x-data="{
    loaded: false,
    error: false,
    init() {
        if (this.$refs.img && this.$refs.img.complete && this.$refs.img.naturalWidth > 0) {
            this.loaded = true;
        }
    }
}">
    {{-- Image Container (Holds Skeleton + Image + Fallback) --}}
    <div class="relative w-full flex-1 min-h-0 overflow-hidden rounded-[inherit]">
        {{-- Shimmer Skeleton Loading State (Prevents CLS) --}}
        @if ($skeleton)
            <div x-show="!loaded && !error" class="absolute inset-0 bg-vibe-200 dark:bg-vibe-800 animate-pulse rounded-[inherit] z-10 pointer-events-none"></div>
        @endif

        {{-- Fallback on 404 / Broken Image --}}
        @if ($fallback)
            <img x-show="error" src="{{ $fallback }}" alt="{{ $alt }}" class="{{ $imgClass }} transition-opacity duration-300" />
        @else
            <div x-show="error" class="w-full h-full min-h-25 flex flex-col items-center justify-center p-4 bg-vibe-100 dark:bg-vibe-900 border border-dashed border-vibe-300 dark:border-vibe-700 text-vibe-400 dark:text-vibe-500 rounded-[inherit]">
                <svg class="size-7 stroke-[1.5]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <span class="text-xs mt-1 font-medium text-center">{{ $alt ?: 'Failed to load image' }}</span>
            </div>
        @endif

        {{-- Main Optimized Image --}}
        <img x-ref="img" x-show="!error" src="{{ $src }}" alt="{{ $alt }}" loading="{{ $loadingMode }}" decoding="{{ $decoding }}" fetchpriority="{{ $fetchPriority }}" x-on:load="loaded = true" x-on:error="error = true" :class="loaded ? 'opacity-100' : 'opacity-0'" class="{{ $imgClass }} transition-opacity duration-300" />
    </div>

    {{-- Figcaption Support --}}
    @if ($caption || $slot->isNotEmpty())
        <figcaption class="shrink-0 text-xs text-vibe-600 dark:text-vibe-400 mt-2 text-center w-full px-1">
            {{ $caption ?? $slot }}
        </figcaption>
    @endif
</figure>
