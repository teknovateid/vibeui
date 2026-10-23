@blaze(fold: true)

@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'icon' => true,
])

@php
    $btnAttrs = [];
    if ($type === 'button') {
        $btnAttrs['@click'] = "\$dispatch('vibe-stepper:finish', { current: currentStep, total: totalSteps })";
    }
@endphp

<vibe:button
    :variant="$variant"
    :size="$size"
    :type="$type"
    x-show="isLast()"
    x-cloak
    {{ $attributes->merge($btnAttrs)->twMerge([
        'class' => 'inline-flex items-center gap-1.5'
    ]) }}
>
    @if ($icon)
        <svg class="size-4 shrink-0 -ml-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"/>
        </svg>
    @endif
    <span>{{ $slot->isNotEmpty() ? $slot : __('vibe/stepper.finish') }}</span>
</vibe:button>
