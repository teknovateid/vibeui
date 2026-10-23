@blaze(fold: true)

@props([
    'variant' => 'primary',
    'size' => 'md',
    'icon' => true,
    'hideOnLast' => false,
])

@php
    $btnAttrs = [];
    if ($hideOnLast) {
        $btnAttrs['x-show'] = '!isLast()';
    }
@endphp

<vibe:button
    :variant="$variant"
    :size="$size"
    @click="next()"
    {{ $attributes->merge($btnAttrs)->twMerge([
        'class' => 'inline-flex items-center gap-1.5'
    ]) }}
>
    <span>{{ $slot->isNotEmpty() ? $slot : __('vibe/stepper.next') }}</span>
    @if ($icon)
        <svg class="size-4 shrink-0 -mr-0.5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6"/>
        </svg>
    @endif
</vibe:button>
