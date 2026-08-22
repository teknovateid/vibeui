@blaze(fold: true)

@props([
    'align' => 'right',
    'width' => '48',
    'contentClasses' => 'p-1 bg-white dark:bg-vibe-950 border border-vibe-200 dark:border-vibe-800',
    'keyboard' => false,
])

@php
    $alignmentClasses = match ($align) {
        'left' => 'origin-top-left left-0',
        'top' => 'origin-top',
        'right', 'default' => 'origin-top-right right-0',
    };

    $widthClasses = match ($width) {
        '48' => 'w-48',
        '64' => 'w-64',
        'min' => 'min-w-min',
        default => $width,
    };
@endphp

<div x-show="open"
    x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="transform opacity-0 scale-95"
    x-transition:enter-end="transform opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="transform opacity-100 scale-100"
    x-transition:leave-end="transform opacity-0 scale-95"
    class="absolute z-50 mt-2 {{ $widthClasses }} rounded-md shadow-lg {{ $alignmentClasses }}"
    style="display: none;"
    @click="close()"
    {{ $attributes }}
>
    <div x-ref="menuContainer" class="rounded-lg shadow-sm {{ $contentClasses }}" role="menu" aria-orientation="vertical" tabindex="-1">
        {{ $slot }}
    </div>
</div>
