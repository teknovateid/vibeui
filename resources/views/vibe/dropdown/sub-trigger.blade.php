@blaze(fold: true)

<vibe:button 
    x-ref="trigger"
    variant="ghost" 
    class="w-full justify-between font-normal px-3 py-1.5 text-sm text-vibe-700 dark:text-vibe-300 hover:bg-vibe-100 hover:text-vibe-900 dark:hover:bg-vibe-800 dark:hover:text-vibe-100 focus:bg-vibe-100 focus:text-vibe-900 dark:focus:bg-vibe-800 dark:focus:text-vibe-100"
    role="menuitem"
    @click.stop.prevent="subOpen = !subOpen"
    {{ $attributes }}
>
    <span class="flex items-center gap-2">{{ $slot }}</span>
    <svg class="w-4 h-4 text-vibe-400 transition-transform duration-200" :class="{ 'rotate-90': subOpen }" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
    </svg>
</vibe:button>
