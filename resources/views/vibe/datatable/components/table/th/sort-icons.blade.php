@aware(['isTailwind', 'isBootstrap'])
@props(['direction' => 'none', 'customIconAttributes' => []])

<span class="relative inline-flex items-center ml-1 text-muted-foreground group-hover:text-foreground transition-colors">
    @switch($direction)
        @case('asc')
            <svg class="w-3.5 h-3.5 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 15l-7-6-7 6"/>
            </svg>
            @break
        @case('desc')
            <svg class="w-3.5 h-3.5 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 9l-7 6-7-6"/>
            </svg>
            @break
        @default
            <svg class="w-3.5 h-3.5 opacity-40 group-hover:opacity-100 transition-opacity" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 9.5l-4-4-4 4M8 14.5l4 4 4-4"/>
            </svg>
    @endswitch
</span>
