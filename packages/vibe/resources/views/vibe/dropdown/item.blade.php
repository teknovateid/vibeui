@blaze(fold: true)

@props([
    'href' => null,
    'type' => 'button',
])

<vibe:button 
    variant="ghost" 
    :href="$href" 
    :type="$type" 
    role="menuitem" 
    tabindex="-1" 
    {{ $attributes->twMerge(['class' => 'w-full justify-start font-normal px-3 py-1.5 text-sm text-popover-foreground hover:bg-accent hover:text-accent-foreground focus-visible:bg-accent focus-visible:text-accent-foreground rounded-md transition-colors']) }}
>
    {{ $slot }}
</vibe:button>
