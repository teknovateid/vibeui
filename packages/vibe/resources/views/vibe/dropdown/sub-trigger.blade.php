@blaze(fold: true)

<vibe:button 
    x-ref="trigger"
    variant="ghost" 
    class="w-full justify-between font-normal px-3 py-1.5 text-sm text-foreground hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground"
    role="menuitem"
    @click.stop.prevent="subOpen = !subOpen"
    {{ $attributes }}
>
    <span class="flex items-center gap-2">{{ $slot }}</span>
    <svg class="w-4 h-4 text-muted-foreground transition-transform duration-200" :class="{ 'rotate-90': subOpen }" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
    </svg>
</vibe:button>
