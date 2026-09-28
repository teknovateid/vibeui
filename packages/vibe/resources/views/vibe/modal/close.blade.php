@blaze(fold: true)

<vibe:button
    type="button"
    variant="ghost"
    size="icon-sm"
    aria-label="{{ __('vibe/modal.close') }}"
    @click="close()"
    {{ $attributes->twMerge(['class' => 'text-muted-foreground hover:text-foreground cursor-pointer rounded-lg']) }}
>
    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M19 5L5 19M19 19L5 5" />
    </svg>
</vibe:button>
