@blaze(fold: true)

<vibe:button
    type="button"
    variant="ghost"
    size="sm"
    aria-label="{{ __('vibe/sheet.close') }}"
    @click="close()"
    {{ $attributes->twMerge(['class' => 'p-1.5 rounded-lg text-muted-foreground hover:text-foreground cursor-pointer']) }}
>
    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M19 5L5 19M19 19L5 5" />
    </svg>
</vibe:button>
