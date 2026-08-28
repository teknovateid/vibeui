@blaze(fold: true)

@props([
    'variant' => 'default',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed';

    $variantClasses = match ($variant) {
        'primary' => 'bg-vibe-900 dark:bg-vibe-100 text-white dark:text-black hover:bg-vibe-700 dark:hover:bg-vibe-300 focus:ring-2 focus:ring-offset-2 focus:ring-vibe-700',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-500',
        'outline' => 'border border-vibe-300 dark:border-vibe-700 text-gray-700 dark:text-gray-300 hover:bg-vibe-200 dark:hover:bg-vibe-800 focus:ring-2 focus:ring-offset-2 focus:ring-vibe-700',
        'ghost' => 'text-vibe-900 dark:text-gray-100 hover:bg-vibe-200 dark:hover:bg-vibe-800 focus:outline-none',
        'accent' => 'bg-accent-100 dark:bg-accent-900 text-accent-500 focus:ring-2 focus:ring-offset-2 focus:ring-accent-500',
        default => 'border border-vibe-300 hover:bg-vibe-200 dark:hover:bg-vibe-800 dark:border-vibe-700 dark:bg-vibe-900 focus:ring-2 focus:ring-offset-2 focus:ring-vibe-700',
    };

    $sizeClasses = match ($size) {
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-base',
        default => 'px-4 py-2 text-sm',
    };

    $compiledClasses = trim("{$baseClasses} {$sizeClasses} {$variantClasses}");
    $hasCustomXData = $attributes->has('x-data');
@endphp

@if($href)
    <a wire:navigate href="{{ $href }}" @if(!$hasCustomXData) x-data @endif {{ $attributes->twMerge(['class' => $compiledClasses]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" @if(!$hasCustomXData) x-data @endif {{ $attributes->twMerge(['class' => $compiledClasses]) }}>{{ $slot }}</button>
@endif
