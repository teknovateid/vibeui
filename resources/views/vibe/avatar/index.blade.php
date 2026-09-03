@blaze(fold: true)

@props([
    'src'       => null,
    'alt'       => '',
    'initials'  => null,
    'size'      => 'md',
    'shape'     => 'circle',
    'indicator' => null,
    'color'     => null, {{-- e.g. 'blue', 'green', 'red', 'purple', 'yellow', 'pink', 'orange' --}}
])

@php
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
    <div class="w-full h-full flex items-center justify-center overflow-hidden {{ $shapeClasses }} {{ $colorClasses }}">
        @if ($src)
            <img src="{{ $src }}" alt="{{ $alt }}" width="{{ $pixelDim }}" height="{{ $pixelDim }}" loading="lazy" decoding="async" class="w-full h-full object-cover" />
        @elseif ($initials)
            <span class="font-semibold leading-none select-none">{{ $initials }}</span>
        @elseif ($slot->isNotEmpty())
            {{ $slot }}
        @else
            {{-- Default user silhouette --}}
            <svg class="w-[60%] h-[60%] opacity-60" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        @endif
    </div>

    @if ($indicator)
        <span class="{{ $indicatorClasses }}"></span>
    @endif
</div>
