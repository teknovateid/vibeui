@blaze(fold: true)

@props([
    'src',
    'alt' => '',
    'aspect' => null,
    'lazy' => true,
    'priority' => false,
    'fallback' => null,
    'skeleton' => true,
    'caption' => null,
    'imgClass' => 'w-full h-full object-cover',
])

@php
    $isLazy = $priority ? false : (bool) $lazy;
    $loadingMode = $isLazy ? 'lazy' : 'eager';
    $fetchPriority = $priority ? 'high' : ($isLazy ? 'low' : 'auto');
    $decoding = 'async';

    // Resolve Aspect Ratio: from prop or extracted from class
    $rawAspect = $aspect;
    $origClass = (string) $attributes->get('class', '');

    if (!$rawAspect && preg_match('/\baspect-(video|square|[a-zA-Z0-9\-\/\[\]]+)\b/', $origClass, $m)) {
        $rawAspect = $m[1];
    }

    $aspectClass = '';
    if ($rawAspect) {
        $aspectClass = match ($rawAspect) {
            'square', '1/1', '1:1' => 'aspect-square',
            'video', '16/9', '16:9' => 'aspect-video',
            '4/3', '4:3', '4-3' => 'aspect-[4/3]',
            '3/2', '3:2', '3-2' => 'aspect-[3/2]',
            '21/9', '21:9', '21-9' => 'aspect-[21/9]',
            default => str_starts_with($rawAspect, 'aspect-') ? $rawAspect : (str_starts_with($rawAspect, '[') ? "aspect-{$rawAspect}" : "aspect-[{$rawAspect}]"),
        };
    }

    $hasAspect = !empty($aspectClass);

    // Strip aspect class from figure root if present, so figure doesn't lock aspect ratio including figcaption
    $cleanFigureClass = $origClass;
    if ($hasAspect) {
        $cleanFigureClass = trim(preg_replace('/\baspect-(?:video|square|[a-zA-Z0-9\-\/\[\]]+)\b/', '', $cleanFigureClass));
        $cleanFigureClass = preg_replace('/\s+/', ' ', $cleanFigureClass);
    }

    $figureAttributes = $attributes->except('class')->merge(['class' => $cleanFigureClass]);
@endphp

@if ($priority)
    @push('head')
        <link rel="preload" as="image" href="{{ $src }}">
    @endpush
@endif

<figure {{ $figureAttributes->twMerge(['class' => 'relative inline-flex flex-col group/image rounded-lg']) }} x-data="{
    loaded: false,
    error: false,
    init() {
        if (this.$refs.img && this.$refs.img.complete && this.$refs.img.naturalWidth > 0) {
            this.loaded = true;
        }
    }
}">
    {{-- Image Container (Holds Skeleton + Image + Fallback) --}}
    <div class="relative w-full {{ $hasAspect ? $aspectClass : 'flex-1 min-h-0' }} overflow-hidden rounded-[inherit]">
        {{-- Shimmer Skeleton Loading State (Prevents CLS) --}}
        @if ($skeleton)
            <div x-show="!loaded && !error" class="absolute inset-0 bg-muted animate-pulse rounded-[inherit] z-10 pointer-events-none"></div>
        @endif

        {{-- Fallback on 404 / Broken Image --}}
        @if ($fallback)
            <img x-show="error" src="{{ $fallback }}" alt="{{ $alt }}" class="{{ $hasAspect ? 'absolute inset-0 ' : '' }}{{ $imgClass }} transition-opacity duration-300" />
        @else
            <div x-show="error" class="{{ $hasAspect ? 'absolute inset-0' : 'w-full h-full min-h-25' }} flex flex-col items-center justify-center p-4 bg-muted/50 border border-dashed border-border text-muted-foreground rounded-[inherit]">
                <svg class="size-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="8.5" cy="8.5" r="1.5" />
                    <path d="M2.5 12c0-4.714 0-7.071 1.464-8.536C5.43 2 7.786 2 12.5 2c4.714 0 7.071 0 8.536 1.464C22.5 4.93 22.5 7.286 22.5 12c0 4.714 0 7.071-1.464 8.536C19.57 22 17.214 22 12.5 22c-4.714 0-7.071 0-8.536-1.464C2.5 19.07 2.5 16.714 2.5 12Z" />
                    <path d="m2.5 16.5 5.5-5.5a2 2 0 0 1 2.8 0l7.2 7.2" />
                    <path d="m15.5 15.5 1.8-1.8a2 2 0 0 1 2.8 0l2.4 2.3" />
                </svg>
                <span class="text-xs mt-1 font-medium text-center">{{ $alt ?: __('vibe/image.failed_to_load') }}</span>
            </div>
        @endif

        {{-- Main Optimized Image --}}
        <img
            x-ref="img"
            x-show="!error"
            src="{{ $src }}"
            alt="{{ $alt }}"
            loading="{{ $loadingMode }}"
            decoding="{{ $decoding }}"
            fetchpriority="{{ $fetchPriority }}"
            x-on:load="loaded = true"
            x-on:error="error = true"
            :class="loaded ? 'opacity-100' : 'opacity-0'"
            class="{{ $hasAspect ? 'absolute inset-0 ' : '' }}{{ $imgClass }} transition-opacity duration-300"
        />
    </div>

    {{-- Figcaption Support --}}
    @if ($caption)
        <figcaption class="shrink-0 text-xs text-muted-foreground mt-2 text-center w-full px-1">
            {{ $caption }}
        </figcaption>
    @elseif ($slot->isNotEmpty())
        <figcaption class="shrink-0 text-xs text-muted-foreground mt-2 text-center w-full px-1">
            {{ $slot }}
        </figcaption>
    @endif
</figure>
