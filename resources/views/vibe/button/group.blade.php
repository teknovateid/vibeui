@blaze(fold: true)

@props([
    'orientation' => 'horizontal', // horizontal, vertical
    'attached' => true,
    'variant' => 'default', // default, outline, ghost, transparent, surface
    'size' => null, // xs, sm, md, lg, xl
])

@php
    $baseClasses = 'inline-flex';

    $layoutClasses = match ($orientation) {
        'vertical' => $attached ? 'flex-col -space-y-px [&>*:not(:first-child):not(:last-child)]:rounded-none! [&>*:first-child:not(:only-child)]:rounded-b-none! [&>*:last-child:not(:only-child)]:rounded-t-none!' : 'flex-col gap-1',
        default => $attached ? 'flex-row -space-x-px [&>*:not(:first-child):not(:last-child)]:rounded-none! [&>*:first-child:not(:only-child)]:rounded-r-none! [&>*:last-child:not(:only-child)]:rounded-l-none!' : 'flex-row items-center gap-1',
    };

    $pillClasses = match ($orientation) {
        'vertical' => '[&.rounded-full>*:first-child:not(:only-child)]:rounded-t-full! [&.rounded-full>*:last-child:not(:only-child)]:rounded-b-full! [&.rounded-full>*:not(:first-child):not(:last-child)]:rounded-none!',
        default => '[&.rounded-full>*:first-child:not(:only-child)]:rounded-l-full! [&.rounded-full>*:last-child:not(:only-child)]:rounded-r-full! [&.rounded-full>*:not(:first-child):not(:last-child)]:rounded-none!',
    };

    $variantClasses = match ($variant) {
        'ghost', 'transparent' => 'bg-transparent [&>*]:bg-transparent [&>*]:border-transparent [&>*]:shadow-none',
        'outline' => '[&>*]:border-input [&>*]:bg-background',
        'surface' => '[&>*]:border-border/80 [&>*]:bg-card',
        default => '',
    };

    $stackClasses = $attached ? '[&>*]:relative [&>*:hover]:z-10 [&>*:focus-visible]:z-20 [&>*:active]:z-20 [&>*[aria-current=page]]:z-10 [&>*[data-active=true]]:z-10' : '';

    $compiledClasses = trim("{$baseClasses} {$layoutClasses} " . ($attached ? "{$pillClasses} {$stackClasses} " : '') . "{$variantClasses}");
@endphp

<div role="group" {{ $attributes->twMerge(['class' => $compiledClasses]) }}>{{ $slot }}</div>
