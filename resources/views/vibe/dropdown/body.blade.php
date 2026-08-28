@blaze(fold: true)

@props([
    'align' => 'right',
    'width' => '48',
])

@php
    $alignmentClasses = match ($align) {
        'top', 'top-left' => 'bottom-full mb-2 left-0 origin-bottom-left',
        'top-right' => 'bottom-full mb-2 right-0 origin-bottom-right',
        'top-center' => 'bottom-full mb-2 left-1/2 -translate-x-1/2 origin-bottom',
        'left', 'bottom-left' => 'top-full mt-2 left-0 origin-top-left',
        'bottom-center' => 'top-full mt-2 left-1/2 -translate-x-1/2 origin-top',
        'bottom', 'bottom-right', 'right', 'default' => 'top-full mt-2 right-0 origin-top-right',
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
    class="absolute z-50 {{ $widthClasses }} {{ $alignmentClasses }}"
    style="display: none;"
    @click="close()">
    <div x-ref="menuContainer" {{ $attributes->twMerge(['class' => 'rounded-xl shadow-xl p-1.5 bg-vibe-50 dark:bg-vibe-900 border border-vibe-200 dark:border-vibe-800 text-vibe-900 dark:text-vibe-100 flex flex-col gap-0.5']) }} role="menu" aria-orientation="vertical" tabindex="-1">
        {{ $slot }}
    </div>
</div>
