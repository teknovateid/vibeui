@blaze(fold: true)

@props([
    'href' => '#',
    'type' => 'button',
])

@php
    $baseClasses = 'block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 transition-colors duration-150';
@endphp

@if ($attributes->has('href') || $href !== '#')
    <a href="{{ $href }}" {{ $attributes->twMerge(['class' => $baseClasses]) }} role="menuitem" tabindex="-1">
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->twMerge(['class' => $baseClasses]) }} role="menuitem" tabindex="-1">
        {{ $slot }}
    </button>
@endif
