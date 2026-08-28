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
    {{ $attributes->twMerge(['class' => 'w-full justify-start font-normal px-3 py-1.5 text-sm text-vibe-700 dark:text-vibe-300 select:bg-vibe-100 select:text-vibe-900 dark:select:bg-vibe-800 dark:select:text-vibe-100']) }}
>
    {{ $slot }}
</vibe:button>
