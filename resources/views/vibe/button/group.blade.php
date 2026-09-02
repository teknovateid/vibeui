@blaze(fold: true)

@props([
    'orientation' => 'horizontal', // horizontal, vertical
    'attached' => true,
    'variant' => 'default',        // default, outline, ghost, transparent
])

@php
    $isVertical = $orientation === 'vertical';

    if ($attached) {
        $layoutClasses = $isVertical
            ? 'inline-flex flex-col -space-y-px [&>*:not(:first-child):not(:last-child)]:rounded-none! [&>*:first-child:not(:only-child)]:rounded-b-none! [&>*:last-child:not(:only-child)]:rounded-t-none!'
            : 'inline-flex flex-row -space-x-px [&>*:not(:first-child):not(:last-child)]:rounded-none! [&>*:first-child:not(:only-child)]:rounded-r-none! [&>*:last-child:not(:only-child)]:rounded-l-none!';

        // Support rounded-full on group level (Rule 4: use rounded-full utility class)
        $pillClasses = $isVertical
            ? '[&.rounded-full>*:first-child:not(:only-child)]:rounded-t-full! [&.rounded-full>*:last-child:not(:only-child)]:rounded-b-full! [&.rounded-full>*:not(:first-child):not(:last-child)]:rounded-none!'
            : '[&.rounded-full>*:first-child:not(:only-child)]:rounded-l-full! [&.rounded-full>*:last-child:not(:only-child)]:rounded-r-full! [&.rounded-full>*:not(:first-child):not(:last-child)]:rounded-none!';

        $stackClasses = '[&>*]:relative [&>*:hover]:z-10 [&>*:focus-visible]:z-20 [&>*:active]:z-20 [&>*[aria-current=page]]:z-10 [&>*[data-active=true]]:z-10';
        $compiledClasses = "{$layoutClasses} {$pillClasses} {$stackClasses}";
    } else {
        $compiledClasses = $isVertical ? 'inline-flex flex-col gap-1' : 'inline-flex flex-row items-center gap-1';
    }

    if ($variant === 'ghost' || $variant === 'transparent') {
        $compiledClasses .= ' bg-transparent [&>*]:bg-transparent [&>*]:border-transparent [&>*]:shadow-none';
    }
@endphp

<div role="group" {{ $attributes->twMerge(['class' => $compiledClasses]) }}>{{ $slot }}</div>
