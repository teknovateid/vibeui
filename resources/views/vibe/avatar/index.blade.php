@blaze(fold: true)

@props([
    'src'       => null,
    'alt'       => '',
    'name'      => null,
    'initials'  => null,
    'size'      => 'md',
    'shape'     => 'circle',
    'indicator' => null,
    'color'     => null, {{-- e.g. 'blue', 'green', 'red', 'purple', 'yellow', 'pink', 'orange', 'auto' --}}
])

@php
    // Extract initials from name if not explicitly set
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

    $sizeClasses = match ($size) {
        'xs'    => 'size-6 text-xs',
        'sm'    => 'size-8 text-sm',
        'md'    => 'size-10 text-base',
        'lg'    => 'size-12 text-lg',
        'xl'    => 'size-14 text-xl',
        '2xl'   => 'size-16 text-2xl',
        default => 'size-10 text-base',
    };

    $shapeClasses = match ($shape) {
        'square'  => 'rounded-lg',
        'rounded' => 'rounded-md',
        'circle'  => 'rounded-full',
        default   => 'rounded-full',
    };

    // Color palette for initials-based avatars
    $colorClasses = match ($color) {
        'blue'   => 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300',
        'green'  => 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
        'red'    => 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
        'purple' => 'bg-purple-100 text-purple-700 dark:bg-purple-900 dark:text-purple-300',
        'yellow' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300',
        'pink'   => 'bg-pink-100 text-pink-700 dark:bg-pink-900 dark:text-pink-300',
        'orange' => 'bg-orange-100 text-orange-700 dark:bg-orange-900 dark:text-orange-300',
        'auto'   => (function () use ($initials, $alt) {
            $palette = [
                'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300',
                'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
                'bg-purple-100 text-purple-700 dark:bg-purple-900 dark:text-purple-300',
                'bg-orange-100 text-orange-700 dark:bg-orange-900 dark:text-orange-300',
                'bg-pink-100 text-pink-700 dark:bg-pink-900 dark:text-pink-300',
                'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300',
                'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
            ];
            $hash = abs(crc32($initials ?: $alt ?: 'avatar'));
            return $palette[$hash % count($palette)];
        })(),
        default  => 'bg-secondary text-secondary-foreground',
    };

    $baseClasses = "relative inline-flex items-center justify-center font-medium shrink-0 {$sizeClasses} {$shapeClasses}";

    // Indicator badge styles
    if ($indicator) {
        $indicatorSizeClasses = match ($size) {
            'xs'    => 'size-1.5',
            'sm'    => 'size-2',
            'lg'    => 'size-3',
            'xl'    => 'size-3.5',
            '2xl'   => 'size-4',
            default => 'size-2.5',
        };

        $indicatorPositionClasses = match ($shape) {
            'square', 'rounded' => '-top-0.5 -right-0.5',
            default             => 'bottom-0 right-0',
        };

        $indicatorColorClasses = match ($indicator) {
            'online'  => 'bg-success',
            'offline' => 'bg-muted-foreground',
            'busy'    => 'bg-destructive',
            'away'    => 'bg-warning',
            default   => 'bg-muted-foreground',
        };

        $indicatorClasses = "absolute block rounded-full ring-2 ring-background z-10 {$indicatorSizeClasses} {$indicatorPositionClasses} {$indicatorColorClasses}";
    }

    $pixelDim = match ($size) {
        'xs' => 24,
        'sm' => 32,
        'md' => 40,
        'lg' => 48,
        'xl' => 56,
        '2xl' => 64,
        default => 40,
    };
@endphp

<div data-avatar {{ $attributes->twMerge(['class' => $baseClasses]) }}>
    <div class="w-full h-full flex items-center justify-center overflow-hidden {{ $shapeClasses }} {{ $colorClasses }} relative">
        @if ($hasSrc)
            @if ($initials)
                <span data-avatar-fallback class="font-semibold leading-none select-none">{{ $initials }}</span>
            @elseif ($slot->isNotEmpty())
                <div data-avatar-fallback class="w-full h-full flex items-center justify-center">{{ $slot }}</div>
            @else
                <svg data-avatar-fallback class="w-[60%] h-[60%] opacity-60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="6" r="4" />
                    <path d="M20 18c0-2.761-3.582-5-8-5s-8 2.239-8 5" />
                </svg>
            @endif

            <img
                src="{{ $rawSrc }}"
                alt="{{ $alt }}"
                width="{{ $pixelDim }}"
                height="{{ $pixelDim }}"
                loading="lazy"
                decoding="async"
                class="absolute inset-0 w-full h-full object-cover"
                onload="const fb=this.parentElement.querySelector('[data-avatar-fallback]');if(fb)fb.style.display='none';"
                onerror="this.style.display='none';const fb=this.parentElement.querySelector('[data-avatar-fallback]');if(fb)fb.style.display='';"
            />
        @elseif ($initials)
            <span class="font-semibold leading-none select-none">{{ $initials }}</span>
        @elseif ($slot->isNotEmpty())
            {{ $slot }}
        @else
            {{-- Default user silhouette --}}
            <svg class="w-[60%] h-[60%] opacity-60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="6" r="4" />
                <path d="M20 18c0-2.761-3.582-5-8-5s-8 2.239-8 5" />
            </svg>
        @endif
    </div>

    @if ($indicator)
        <span class="{{ $indicatorClasses }}"></span>
    @endif
</div>
