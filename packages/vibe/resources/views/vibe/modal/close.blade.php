@blaze(fold: true)

<vibe:button
    type="button"
    variant="ghost"
    size="icon-sm"
    aria-label="{{ __('vibe/modal.close') }}"
    @click="close()"
    {{ $attributes->twMerge(['class' => 'text-muted-foreground hover:text-foreground cursor-pointer rounded-lg']) }}
>
    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
</vibe:button>
