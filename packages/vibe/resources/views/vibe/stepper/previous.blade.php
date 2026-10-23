@blaze(fold: true)

@props([
    'variant' => 'outline',
    'size' => 'md',
    'icon' => true,
])

<vibe:button
    :variant="$variant"
    :size="$size"
    @click="prev()"
    x-bind:disabled="isFirst()"
    {{ $attributes->twMerge([
        'class' => 'inline-flex items-center gap-1.5'
    ]) }}
>
    @if ($icon)
        <svg class="size-4 shrink-0 -ml-0.5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m15 18-6-6 6-6"/>
        </svg>
    @endif
    <span>{{ $slot->isNotEmpty() ? $slot : __('vibe/stepper.previous') }}</span>
</vibe:button>
