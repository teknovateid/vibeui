@blaze(fold: true)

@props([
    'href' => null,
    'type' => 'button',
    'destructive' => false,
    'variant' => 'default',
    'disabled' => false,
])

@php
    $isDestructive = $destructive
        || $variant === 'destructive'
        || $variant === 'danger'
        || str_contains($attributes->get('class', ''), 'text-destructive')
        || str_contains($attributes->get('class', ''), 'destructive');

    $itemClasses = $isDestructive
        ? 'w-full justify-start font-normal px-3 py-1.5 text-sm rounded-md transition-colors text-destructive hover:bg-destructive/10 hover:text-destructive focus-visible:bg-destructive/10 focus-visible:text-destructive active:bg-destructive/20'
        : 'w-full justify-start font-normal px-3 py-1.5 text-sm rounded-md transition-colors text-popover-foreground hover:bg-accent hover:text-accent-foreground focus-visible:bg-accent focus-visible:text-accent-foreground';

    $disabledClasses = $disabled ? 'opacity-50 pointer-events-none' : '';
@endphp

<vibe:button
    variant="ghost"
    :href="$href"
    :type="$type"
    :disabled="$disabled"
    role="menuitem"
    tabindex="-1"
    {{ $attributes->twMerge(['class' => $itemClasses . ' ' . $disabledClasses]) }}
>
    {{ $slot }}
</vibe:button>
