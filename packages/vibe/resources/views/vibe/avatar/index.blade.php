@blaze(fold: true)

@props([
    'src'       => null,
    'alt'       => '',
    'initials'  => null,
    'size'      => 'md',
    'shape'     => 'circle',
    'indicator' => null,
    'color'     => null, {{-- e.g. 'blue', 'green', 'red', 'purple', 'yellow', 'pink' --}}
])

@php
    $sizeClasses = match ($size) {
        'xs'    => 'w-6 h-6 text-xs',
        'sm'    => 'w-8 h-8 text-sm',
        'md'    => 'w-10 h-10 text-base',
        'lg'    => 'w-12 h-12 text-lg',
        'xl'    => 'w-14 h-14 text-xl',
        '2xl'   => 'w-16 h-16 text-2xl',
        default => 'w-10 h-10 text-base',
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

    $baseClasses = "relative inline-flex items-center justify-center font-medium overflow-hidden shrink-0 {$sizeClasses} {$shapeClasses} {$colorClasses}";

    // Indicator badge styles
    if ($indicator) {
        $indicatorSizeClasses = match ($size) {
            'xs'    => 'w-1.5 h-1.5',
            'sm'    => 'w-2 h-2',
            'lg'    => 'w-3 h-3',
            'xl'    => 'w-3.5 h-3.5',
            '2xl'   => 'w-4 h-4',
            default => 'w-2.5 h-2.5',
        };

        $indicatorPositionClasses = match ($shape) {
            'square', 'rounded' => '-top-1 -right-1',
            default             => 'bottom-0 right-0',
        };

        $indicatorColorClasses = match ($indicator) {
            'online'  => 'bg-emerald-500',
            'offline' => 'bg-muted-foreground',
            'busy'    => 'bg-destructive',
            'away'    => 'bg-amber-500',
            default   => 'bg-muted-foreground',
        };

        $indicatorClasses = "absolute block rounded-full ring-2 ring-background {$indicatorSizeClasses} {$indicatorPositionClasses} {$indicatorColorClasses}";
    }
@endphp

<div data-avatar {{ $attributes->twMerge(['class' => $baseClasses]) }}>
    @if ($src)
        <img src="{{ $src }}" alt="{{ $alt }}" class="w-full h-full object-cover" />
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

    @if ($indicator)
        <span class="{{ $indicatorClasses }}"></span>
    @endif
</div>
