@blaze(fold: true)

@props([
    'orientation' => 'horizontal', // horizontal, vertical
    'attached' => false,
    'variant' => 'default', // default, outline, ghost, transparent, surface, attached
    'size' => null, // xs, sm, md, lg, xl
])

@php
    $baseClasses = 'inline-flex items-center select-none';

    $isAttached = $attached || in_array($variant, ['attached']);

    $layoutClasses = match ($orientation) {
        'vertical' => $isAttached ? 'flex-col -space-y-px' : 'flex-col',
        default => $isAttached ? 'flex-row -space-x-px' : 'flex-row items-center',
    };

    $spacingClasses = $isAttached ? '' : match ($size) {
        'md' => 'p-1 gap-1 rounded-xl',
        'lg' => 'p-1.5 gap-1.5 rounded-xl',
        'xl' => 'p-2 gap-2 rounded-2xl',
        default => 'p-0.5 gap-0.5 rounded-lg',
    };

    $variantClasses = match ($variant) {
        'ghost', 'transparent' => 'bg-transparent border-transparent shadow-none',
        'outline' => 'bg-background border border-input rounded-lg shadow-2xs',
        'surface' => 'bg-card border border-border/80 rounded-lg shadow-2xs',
        'attached', 'plain', 'unstyled' => 'bg-transparent border-transparent shadow-none',
        default => 'bg-muted border border-border rounded-lg shadow-2xs',
    };

    $cornerClasses = '';
    if ($isAttached) {
        $cornerClasses = match ($orientation) {
            'vertical' => '[&>*:not(:first-child):not(:last-child)]:rounded-none! [&>*:first-child:not(:only-child)]:rounded-b-none! [&>*:last-child:not(:only-child)]:rounded-t-none!',
            default => '[&>*:not(:first-child):not(:last-child)]:rounded-none! [&>*:first-child:not(:only-child)]:rounded-r-none! [&>*:last-child:not(:only-child)]:rounded-l-none!',
        };
    }

    $pillClasses = match ($orientation) {
        'vertical' => $isAttached
            ? '[&.rounded-full>*:first-child:not(:only-child)]:rounded-t-full! [&.rounded-full>*:last-child:not(:only-child)]:rounded-b-full! [&.rounded-full>*:not(:first-child):not(:last-child)]:rounded-none!'
            : '[&.rounded-full]:rounded-full [&.rounded-full>*]:rounded-full!',
        default => $isAttached
            ? '[&.rounded-full>*:first-child:not(:only-child)]:rounded-l-full! [&.rounded-full>*:last-child:not(:only-child)]:rounded-r-full! [&.rounded-full>*:not(:first-child):not(:last-child)]:rounded-none!'
            : '[&.rounded-full]:rounded-full [&.rounded-full>*]:rounded-full!',
    };

    $stackClasses = $isAttached ? '[&>*]:relative [&>*:hover]:z-10 [&>*:focus-visible]:z-20 [&>*:active]:z-20 [&>*[aria-current=page]]:z-10 [&>*[data-active=true]]:z-10' : '';

    $compiledClasses = trim("{$baseClasses} {$layoutClasses} {$spacingClasses} {$variantClasses} {$cornerClasses} {$pillClasses} {$stackClasses}");
@endphp

<div role="group" {{ $attributes->twMerge(['class' => $compiledClasses]) }}>{{ $slot }}</div>

