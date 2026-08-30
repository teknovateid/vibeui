@blaze(fold: true)

@props([
    'contentClasses' => 'p-1 bg-popover text-popover-foreground border border-border',
    'align' => 'right',
    'width' => '48',
    'position' => 'absolute',
])

@php
    if ($position === 'absolute') {
        $positionClasses = match ($align) {
            'left' => 'absolute top-0 right-full mr-1 z-50',
            'right', 'default' => 'absolute top-0 left-full ml-1 z-50',
        };
        $widthClasses = match ($width) {
            '48' => 'w-48',
            '64' => 'w-64',
            'min' => 'min-w-min',
            default => $width,
        };
        $wrapperClasses = "$positionClasses $widthClasses rounded-md shadow-lg";
        $innerClasses = "rounded-md shadow-sm $contentClasses";
    } else {
        $wrapperClasses = "relative w-full mt-1";
        $treeStyles = 
            "[&>*]:relative " .
            "[&>*:before]:content-[''] [&>*:before]:absolute [&>*:before]:top-0 [&>*:before]:-left-3 [&>*:before]:w-3 [&>*:before]:h-1/2 [&>*:before]:border-l [&>*:before]:border-b [&>*:before]:border-border [&>*:before]:rounded-bl-md " .
            "[&>*:first-child:before]:-top-1 [&>*:first-child:before]:h-[calc(50%+0.25rem)] " .
            "[&>*:not(:last-child):after]:content-[''] [&>*:not(:last-child):after]:absolute [&>*:not(:last-child):after]:top-0 [&>*:not(:last-child):after]:-left-3 [&>*:not(:last-child):after]:w-px [&>*:not(:last-child):after]:h-[calc(100%+0.25rem)] [&>*:not(:last-child):after]:bg-border";
        $innerClasses = "pl-3 ml-3 flex flex-col gap-1 $treeStyles";
    }
@endphp

<div x-show="subOpen"
    x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="transform opacity-0 scale-95"
    x-transition:enter-end="transform opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="transform opacity-100 scale-100"
    x-transition:leave-end="transform opacity-0 scale-95"
    class="{{ $wrapperClasses }}"
    style="display: none;"
    {{ $attributes }}
>
    <div class="{{ $innerClasses }}" role="menu" aria-orientation="vertical">
        {{ $slot }}
    </div>
</div>
