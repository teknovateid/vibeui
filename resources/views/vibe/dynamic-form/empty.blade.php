@blaze

@props([
    'title' => null,
    'description' => null,
    'addText' => null,
])

@php
    $title = $title ?? __('vibe/dynamic-form.empty_title');
    $description = $description ?? __('vibe/dynamic-form.empty_description');
    $addText = $addText ?? __('vibe/dynamic-form.add_first_row');
@endphp

<div 
    x-show="isEmpty" 
    x-cloak
    class="w-full flex flex-col items-center justify-center p-8 text-center rounded-xl border border-dashed border-border/80 bg-muted/20"
>
    <div class="size-12 rounded-full bg-muted flex items-center justify-center text-muted-foreground mb-3 shadow-2xs">
        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <rect width="18" height="18" x="3" y="3" rx="2" />
            <path d="M7 8h10" />
            <path d="M7 12h10" />
            <path d="M7 16h6" />
        </svg>
    </div>

    <h4 class="text-sm font-semibold text-foreground mb-1">{{ $title }}</h4>
    <p class="text-xs text-muted-foreground max-w-sm mb-4">{{ $description }}</p>

    <vibe:button type="button" size="sm" variant="outline" @click="addItem()">
        <svg class="size-3.5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14" />
            <path d="M12 5v14" />
        </svg>
        <span>{{ $addText }}</span>
    </vibe:button>
</div>
