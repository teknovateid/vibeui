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
    {{ $attributes->twMerge(['class' => 'w-full justify-start font-normal px-3 py-1.5 text-sm text-vibe-700 dark:text-vibe-300 hover:bg-vibe-100 hover:text-vibe-900 dark:hover:bg-vibe-800 dark:hover:text-vibe-100 focus:bg-vibe-100 focus:text-vibe-900 dark:focus:bg-vibe-800 dark:focus:text-vibe-100']) }}
>
    {{ $slot }}
</vibe:button>
