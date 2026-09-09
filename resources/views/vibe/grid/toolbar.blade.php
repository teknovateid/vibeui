@blaze(fold: true)

@props([
    'title' => null,
    'description' => null,
    'showReset' => true,
])

<div
    data-grid-toolbar
    style="order: 0;"
    {{ $attributes->twMerge(['class' => 'col-span-full w-full flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-2 border-b border-border/50']) }}
>
    @if ($title || $description)
        <div class="space-y-0.5 min-w-0">
            @if ($title)
                <h3 class="text-base sm:text-lg font-semibold text-foreground tracking-tight">{{ $title }}</h3>
            @endif
            @if ($description)
                <p class="text-xs sm:text-sm text-muted-foreground">{{ $description }}</p>
            @endif
        </div>
    @endif

    <div class="flex items-center gap-2 shrink-0 sm:ml-auto">
        {{ $slot }}

        @if ($showReset)
            <vibe:button
                type="button"
                variant="outline"
                size="sm"
                @click="($el.closest('[data-vibe-grid]')._x_dataStack ? $el.closest('[data-vibe-grid]')._x_dataStack[0] : this).resetLayout()"
                class="gap-1.5 text-xs text-muted-foreground hover:text-foreground cursor-pointer"
            >
                <svg class="size-3.5 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                    <path d="M3 3v5h5"/>
                </svg>
                <span>{{ __('vibe/grid.reset_layout') }}</span>
            </vibe:button>
        @endif
    </div>
</div>
