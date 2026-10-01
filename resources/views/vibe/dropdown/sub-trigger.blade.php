@blaze(fold: true)

<vibe:button 
    x-ref="trigger"
    variant="ghost" 
    class="w-full justify-between font-normal px-3 py-1.5 text-sm text-foreground hover:bg-muted hover:text-foreground focus:bg-muted focus:text-foreground"
    role="menuitem"
    @click.stop.prevent="subOpen = !subOpen"
    {{ $attributes }}
>
    <span class="flex items-center gap-2">{{ $slot }}</span>
    <svg class="w-4 h-4 text-muted-foreground transition-transform duration-200" :class="{ 'rotate-90': subOpen }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 5l7 7-7 7" />
    </svg>
</vibe:button>
