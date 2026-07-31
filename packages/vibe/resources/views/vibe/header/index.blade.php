@blaze(fold: true)

@props([
    'variant' => 'default',
    'size' => 'default',
])

@php
    $baseClasses = 'flex items-center justify-between shrink-0 bg-white dark:bg-vibe-900 border-b border-gray-200 dark:border-vibe-800';

    $variantClasses = match ($variant) {
        'sticky' => 'sticky top-0 z-50',
        default => '',
    };

    $sizeClasses = match ($size) {
        'sm' => 'py-2 px-4',
        'default' => 'py-4 px-6',
        'lg' => 'py-6 px-8',
        default => 'py-4 px-6',
    };

    $compiledClasses = "{$baseClasses} {$sizeClasses} {$variantClasses}";
@endphp

<header {{ $attributes->twMerge(['class' => $compiledClasses]) }}>
    {{ $slot }}
</header>