@blaze(fold: true)

@props([
    'step' => null,
    'value' => null,
    'lazy' => false,
])

@php
    $stepVal = (string) ($step ?? $value ?? 1);
@endphp

<div
    role="tabpanel"
    x-bind:id="stepperId + '-panel-' + @js($stepVal)"
    x-bind:aria-labelledby="stepperId + '-step-' + @js($stepVal)"
    x-show="isStepActive(@js($stepVal))"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-y-1.5"
    x-transition:enter-end="opacity-100 translate-y-0"
    tabindex="0"
    {{ $attributes->twMerge([
        'class' => 'vibe-stepper-panel w-full focus:outline-none'
    ]) }}
>
    @if ($lazy)
        <template x-if="isStepActive(@js($stepVal))">
            <div>{{ $slot }}</div>
        </template>
    @else
        {{ $slot }}
    @endif
</div>
