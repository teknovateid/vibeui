@blaze

@props([
    'group' => 'default',
])

@pushOnce('head', 'vibe-display-image-js')
    @vite(['resources/js/vibe/display-image.js'])
@endPushOnce

@pushOnce('body', 'vibe-display-lightbox')
    <vibe:display.lightbox />
@endPushOnce

<div
    {{ $attributes->twMerge(['class' => 'vibe-image-gallery']) }}
    data-vibe-gallery="{{ $group }}"
>
    {{ $slot }}
</div>
