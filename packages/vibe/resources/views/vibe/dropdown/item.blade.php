@blaze(fold: true)

@props([
    'href' => null,
    'type' => 'button',
    'destructive' => false,
    'variant' => 'default',
])

@php
    $isDestructive = $destructive 
        || $variant === 'destructive' 
        || $variant === 'danger' 
        || str_contains($attributes->get('class', ''), 'text-destructive')
        || str_contains($attributes->get('class', ''), 'destructive');

    $itemClasses = $isDestructive
        ? 'w-full justify-start font-normal px-3 py-1.5 text-sm rounded-md transition-colors text-destructive/75 dark:text-destructive-foreground/75 hover:bg-destructive/10 dark:hover:bg-destructive/30 hover:text-destructive dark:hover:text-destructive-foreground focus-visible:bg-destructive/10 dark:focus-visible:bg-destructive/30 focus-visible:text-destructive dark:focus-visible:text-destructive-foreground active:bg-destructive/20 dark:active:bg-destructive/50'
        : 'w-full justify-start font-normal px-3 py-1.5 text-sm rounded-md transition-colors text-popover-foreground hover:bg-accent hover:text-accent-foreground focus-visible:bg-accent focus-visible:text-accent-foreground';
@endphp

<vibe:button 
    variant="ghost" 
    :href="$href" 
    :type="$type" 
    role="menuitem" 
    tabindex="-1" 
    {{ $attributes->twMerge(['class' => $itemClasses]) }}
>
    {{ $slot }}
</vibe:button>
