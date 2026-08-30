@blaze(fold: true)

@props([
    'align' => 'right',
    'width' => '48',
])

@php
    $alignmentClasses = match ($align) {
        'left' => 'origin-top-left left-0',
        'top' => 'origin-top',
        'right', 'default' => 'origin-top-right right-0',
    };

    $widthClasses = match ((string) $width) {
        '48', 'xs' => 'w-48',
        '56' => 'w-56',
        '64', 'sm' => 'w-64',
        '72' => 'w-72',
        '80', 'md' => 'w-80',
        '96', 'lg' => 'w-96',
        'xl' => 'w-[28rem]',
        '2xl' => 'w-[32rem]',
        'min' => 'min-w-min',
        'full' => 'w-full',
        default => str_starts_with((string) $width, 'w-') || str_starts_with((string) $width, 'max-w-') ? (string) $width : "w-{$width}",
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
    @click="close()">
    <div x-ref="menuContainer" {{ $attributes->twMerge(['class' => 'rounded-md shadow-sm p-1 bg-popover text-popover-foreground border border-border']) }} role="menu" aria-orientation="vertical" tabindex="-1">
        {{ $slot }}
    </div>
</div>
