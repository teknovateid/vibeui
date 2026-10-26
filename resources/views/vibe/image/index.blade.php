@blaze(fold: true)

@props([
    'src' => null,
    'alt' => '',
    'name' => null,
    'initials' => null,
    'lazy' => true,
    'priority' => false,
    'fallback' => asset('vibe/images/not-found.png'),
    'skeleton' => true,
    'caption' => null,
    'initialsClass' => null,
    'imgClass' => 'w-full h-full object-cover',
    // Zoom / Detail Lightbox feature
    'zoom' => false,
    'preview' => false,
    'previewSrc' => null,
    'group' => null,
    'standalone' => false,
    'zoomIcon' => true,
])

@php
    // Extract initials from name or initials prop (identical to vibe:avatar)
    $initials = ($initials !== null && $initials !== '') ? strtoupper(trim((string) $initials)) : null;
    if ($initials === null && !empty($name)) {
        $words = preg_split('/\s+/', trim((string) $name));
        if (count($words) >= 2) {
            $initials = strtoupper(mb_substr($words[0], 0, 1) . mb_substr(end($words), 0, 1));
        } else {
            $initials = strtoupper(mb_substr((string) $name, 0, 2));
        }
    }

    if (empty($alt) && !empty($name)) {
        $alt = (string) $name;
    }

    // Validate src to prevent broken images from empty paths, /storage root, null strings
    $rawSrc = is_string($src) ? trim($src) : $src;
    $hasSrc = !empty($rawSrc)
        && $rawSrc !== 'null'
        && $rawSrc !== 'undefined'
        && $rawSrc !== '/storage'
        && $rawSrc !== '/storage/'
        && !preg_match('#^https?://[^/]+/storage/?$#i', (string) $rawSrc);

    if ($hasSrc && is_string($rawSrc)) {
        try {
            $storageBaseUrl = rtrim(\Illuminate\Support\Facades\Storage::url(''), '/');
            if (!empty($storageBaseUrl) && rtrim($rawSrc, '/') === $storageBaseUrl) {
                $hasSrc = false;
            }
        } catch (\Throwable $e) {}
    }

    // Zoom / Detail Lightbox handling
    $isZoomable = ($zoom || $preview) && $hasSrc;
    $lightboxSrc = $previewSrc ?: $rawSrc;
    $effectiveGroup = $standalone ? '' : ($group ?? 'default');

    // Normalize and resolve fallback
    $defaultFallbackUrl = asset('vibe/images/not-found.png');

    if (is_string($fallback)) {
        if ($fallback === 'vibe/images/not-found' || str_ends_with($fallback, '/not-found')) {
            $fallback = $defaultFallbackUrl;
        } elseif (!str_starts_with($fallback, 'http://') && !str_starts_with($fallback, 'https://') && !str_starts_with($fallback, '/') && !str_starts_with($fallback, 'data:') && !in_array($fallback, ['placeholder', 'initials', 'false', 'none'], true)) {
            $fallback = asset($fallback);
        }
    }

    $isDefaultFallback = ($fallback === $defaultFallbackUrl);

    // Extract initials from alt if fallback is explicitly set to 'initials' and no initials were supplied
    if ($initials === null && $fallback === 'initials' && !empty($alt)) {
        $words = preg_split('/\s+/', trim((string) $alt));
        if (count($words) >= 2) {
            $initials = strtoupper(mb_substr($words[0], 0, 1) . mb_substr(end($words), 0, 1));
        } else {
            $initials = strtoupper(mb_substr((string) $alt, 0, 2));
        }
    }

    // Determine fallback type: 'none' | 'url' | 'initials' | 'placeholder'
    $fallbackType = 'url';
    $fallbackUrl = $defaultFallbackUrl;

    if ($fallback === false || $fallback === 'false' || $fallback === 'none') {
        $fallbackType = 'none';
    } elseif ($fallback === 'placeholder') {
        $fallbackType = 'placeholder';
    } elseif ($fallback === 'initials') {
        $fallbackType = 'initials';
    } elseif ($initials !== null && $isDefaultFallback) {
        // If initials was provided and fallback is using the default not-found asset, prioritize initials
        $fallbackType = 'initials';
    } elseif (!empty($fallback) && is_string($fallback)) {
        $fallbackType = 'url';
        $fallbackUrl = $fallback;
    } elseif ($initials !== null) {
        $fallbackType = 'initials';
    } else {
        $fallbackType = 'url';
        $fallbackUrl = $defaultFallbackUrl;
    }

    $isLazy = $priority ? false : (bool) $lazy;
    $loadingMode = $isLazy ? 'lazy' : 'eager';
    $fetchPriority = $priority ? 'high' : ($isLazy ? 'low' : 'auto');
    $decoding = 'async';

    // Resolve Aspect Ratio: extract any aspect-* classes from class attribute (supports standard, arbitrary like aspect-[4/3], and responsive variants like sm:aspect-video)
    $origClass = (string) $attributes->get('class', '');
    preg_match_all('/(?<=^|\s)(?:[a-zA-Z0-9\-_:]+:)?aspect-(?:video|square|auto|\[[^\]\s]+\]|[a-zA-Z0-9\-\/]+)(?=\s|$)/', $origClass, $aspectMatches);
    $aspectClasses = !empty($aspectMatches[0]) ? implode(' ', $aspectMatches[0]) : '';

    // Backward compatibility for legacy aspect attribute if passed
    if (empty($aspectClasses) && $attributes->has('aspect')) {
        $legacyAspect = (string) $attributes->get('aspect');
        $aspectClasses = match ($legacyAspect) {
            'square', '1/1', '1:1' => 'aspect-square',
            'video', '16/9', '16:9' => 'aspect-video',
            '4/3', '4:3', '4-3' => 'aspect-[4/3]',
            '3/2', '3:2', '3-2' => 'aspect-[3/2]',
            '21/9', '21:9', '21-9' => 'aspect-[21/9]',
            default => str_starts_with($legacyAspect, 'aspect-') ? $legacyAspect : (str_starts_with($legacyAspect, '[') ? "aspect-{$legacyAspect}" : "aspect-[{$legacyAspect}]"),
        };
    }

    $hasAspect = !empty($aspectClasses);

    // Strip aspect class from figure root if present, so figure doesn't lock aspect ratio including figcaption
    $cleanFigureClass = $origClass;
    if ($hasAspect) {
        $cleanFigureClass = trim(preg_replace('/(?<=^|\s)(?:[a-zA-Z0-9\-_:]+:)?aspect-(?:video|square|auto|\[[^\]\s]+\]|[a-zA-Z0-9\-\/]+)(?=\s|$)/', '', $cleanFigureClass));
        $cleanFigureClass = preg_replace('/\s+/', ' ', $cleanFigureClass);
    }

    $hasCustomHeight = (bool) preg_match('/(?<=^|\s)(?:[a-zA-Z0-9\-_:]+:)?(?:size|h)-\S+/', $origClass);
    $hasBgClass = (bool) preg_match('/(?<=^|\s)(?:[a-zA-Z0-9\-_:]+:)?bg-\S+/', $origClass);
    $hasCaption = !empty($caption) || $slot->isNotEmpty();

    // Base figure classes: default background is applied only when there is no figcaption,
    // so that figures with captions don't have an unwanted background behind the caption text.
    $figureBaseClasses = 'relative inline-flex flex-col group/image rounded-lg';
    if (!$hasCaption) {
        $figureBaseClasses .= ' bg-secondary text-secondary-foreground';
    }

    $zoomAttributes = [];
    if ($isZoomable) {
        $zoomAttributes['data-vibe-image'] = true;
        $zoomAttributes['data-src'] = $lightboxSrc;
        $zoomAttributes['data-alt'] = $alt;
        if (!empty($caption)) {
            $zoomAttributes['data-caption'] = $caption;
        }
        if (!empty($effectiveGroup)) {
            $zoomAttributes['data-group'] = $effectiveGroup;
        }
        if ($standalone) {
            $zoomAttributes['data-standalone'] = true;
        }
        $zoomAttributes['tabindex'] = '0';
        $zoomAttributes['role'] = 'button';
        $zoomAttributes['aria-label'] = $alt ?: __('vibe/image.zoom_image');
        $figureBaseClasses .= ' cursor-zoom-in';
    }

    $figureAttributes = $attributes->except(['class', 'aspect'])->merge($zoomAttributes)->merge(['class' => $cleanFigureClass]);
@endphp

@if ($priority && $hasSrc)
    @push('head')
        <link rel="preload" as="image" href="{{ $rawSrc }}">
    @endpush
@endif

@if ($isZoomable)
    @pushOnce('head', 'vibe-image-lightbox-js')
        @vite(['resources/js/vibe/image-lightbox.js'])
    @endPushOnce
    @pushOnce('body', 'vibe-image-lightbox')
        <vibe:image.lightbox />
    @endPushOnce
@endif

<figure {{ $figureAttributes->twMerge(['class' => $figureBaseClasses]) }} x-data="{
    loaded: false,
    error: {{ $hasSrc ? 'false' : 'true' }},
    init() {
        if (this.$refs.img) {
            if (this.$refs.img.complete) {
                if (this.$refs.img.naturalWidth > 0) {
                    this.loaded = true;
                } else {
                    this.error = true;
                }
            }
        }
    }
}">
    {{-- Image Container (Holds Skeleton + Image + Fallback) --}}
    <div class="@container relative w-full {{ $hasAspect ? $aspectClasses : 'flex-1 min-h-0' }} overflow-hidden rounded-[inherit]{{ ($hasCaption && $fallbackType === 'initials' && !$hasBgClass) ? ' bg-secondary text-secondary-foreground' : '' }}">
        {{-- Shimmer Skeleton Loading State (Prevents CLS) --}}
        @if ($skeleton && $hasSrc)
            <div data-image-skeleton x-show="!loaded && !error" class="absolute inset-0 bg-muted animate-pulse rounded-[inherit] z-10 pointer-events-none"></div>
        @endif

        {{-- Subtle Glassmorphism Zoom Indicator Overlay --}}
        @if ($isZoomable && $zoomIcon)
            <div class="absolute inset-0 bg-black/25 opacity-0 group-hover/image:opacity-100 transition-opacity duration-200 flex items-center justify-center pointer-events-none rounded-[inherit] z-20" x-show="!error">
                <div class="size-10 rounded-full p-2 bg-black/40 backdrop-blur-md border border-white/20 text-white flex items-center justify-center shadow-lg transform scale-90 group-hover/image:scale-100 transition-transform duration-200">
                    <svg class="size-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" x2="16.65" y1="21" y2="16.65"/>
                        <line x1="11" x2="11" y1="8" y2="14"/>
                        <line x1="8" x2="14" y1="11" y2="11"/>
                    </svg>
                </div>
            </div>
        @endif

        {{-- Fallback Handling --}}
        @if ($fallbackType === 'url')
            <img
                data-image-fallback
                x-show="error"
                src="{{ $fallbackUrl }}"
                alt="{{ $alt }}"
                @if ($hasSrc) style="display: none;" @endif
                onerror="this.style.display='none';const ph=this.parentElement.querySelector('[data-image-placeholder]');if(ph)ph.style.display='flex';"
                class="{{ $hasAspect ? 'absolute inset-0 ' : '' }}{{ $imgClass }} transition-opacity duration-300"
            />
            {{-- Safety net placeholder if fallback image itself fails to load --}}
            <div
                data-image-placeholder
                style="display: none;"
                class="{{ $hasAspect ? 'absolute inset-0' : ($hasCustomHeight ? 'w-full h-full' : 'w-full h-full min-h-25') }} flex flex-col items-center justify-center p-4 bg-muted/50 border border-dashed border-border text-muted-foreground rounded-[inherit] transition-opacity duration-300"
            >
                <svg class="size-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="8.5" cy="8.5" r="1.5" />
                    <path d="M2.5 12c0-4.714 0-7.071 1.464-8.536C5.43 2 7.786 2 12.5 2c4.714 0 7.071 0 8.536 1.464C22.5 4.93 22.5 7.286 22.5 12c0 4.714 0 7.071-1.464 8.536C19.57 22 17.214 22 12.5 22c-4.714 0-7.071 0-8.536-1.464C2.5 19.07 2.5 16.714 2.5 12Z" />
                    <path d="m2.5 16.5 5.5-5.5a2 2 0 0 1 2.8 0l7.2 7.2" />
                    <path d="m15.5 15.5 1.8-1.8a2 2 0 0 1 2.8 0l2.4 2.3" />
                </svg>
                <span class="text-xs mt-1 font-medium text-center line-clamp-1 max-w-full px-1">{{ $alt ?: __('vibe/image.failed_to_load') }}</span>
            </div>
        @elseif ($fallbackType === 'initials')
            <div
                data-image-fallback
                x-show="error"
                @if ($hasSrc) style="display: none;" @endif
                class="{{ $hasAspect ? 'absolute inset-0' : ($hasCustomHeight ? 'w-full h-full' : 'w-full h-full min-h-25') }} flex items-center justify-center select-none rounded-[inherit] transition-opacity duration-300"
            >
                <span class="{{ $initialsClass ?: 'text-base @xs:text-lg @sm:text-xl @md:text-2xl @lg:text-3xl font-bold uppercase tracking-wider select-none leading-none' }}">
                    {{ $initials }}
                </span>
            </div>
        @elseif ($fallbackType === 'placeholder')
            <div
                data-image-fallback
                x-show="error"
                @if ($hasSrc) style="display: none;" @endif
                class="{{ $hasAspect ? 'absolute inset-0' : ($hasCustomHeight ? 'w-full h-full' : 'w-full h-full min-h-25') }} flex flex-col items-center justify-center p-4 bg-muted/50 border border-dashed border-border text-muted-foreground rounded-[inherit] transition-opacity duration-300"
            >
                <svg class="size-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="8.5" cy="8.5" r="1.5" />
                    <path d="M2.5 12c0-4.714 0-7.071 1.464-8.536C5.43 2 7.786 2 12.5 2c4.714 0 7.071 0 8.536 1.464C22.5 4.93 22.5 7.286 22.5 12c0 4.714 0 7.071-1.464 8.536C19.57 22 17.214 22 12.5 22c-4.714 0-7.071 0-8.536-1.464C2.5 19.07 2.5 16.714 2.5 12Z" />
                    <path d="m2.5 16.5 5.5-5.5a2 2 0 0 1 2.8 0l7.2 7.2" />
                    <path d="m15.5 15.5 1.8-1.8a2 2 0 0 1 2.8 0l2.4 2.3" />
                </svg>
                <span class="text-xs mt-1 font-medium text-center line-clamp-1 max-w-full px-1">{{ $alt ?: __('vibe/image.failed_to_load') }}</span>
            </div>
        @endif

        {{-- Main Optimized Image --}}
        @if ($hasSrc)
            <img
                x-ref="img"
                x-show="!error"
                src="{{ $rawSrc }}"
                alt="{{ $alt }}"
                loading="{{ $loadingMode }}"
                decoding="{{ $decoding }}"
                fetchpriority="{{ $fetchPriority }}"
                x-on:load="loaded = true"
                x-on:error="error = true"
                onload="const sk=this.parentElement.querySelector('[data-image-skeleton]');if(sk)sk.style.display='none';"
                onerror="this.style.display='none';const fb=this.parentElement.querySelector('[data-image-fallback]');if(fb)fb.style.display='';"
                :class="loaded ? 'opacity-100' : 'opacity-0'"
                class="{{ $hasAspect ? 'absolute inset-0 ' : '' }}{{ $imgClass }} transition-opacity duration-300"
            />
        @endif
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
