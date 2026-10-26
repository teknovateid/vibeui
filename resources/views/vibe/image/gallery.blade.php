@blaze

@props([
    'group' => 'default',
])

@pushOnce('head', 'vibe-image-lightbox-js')
    @vite(['resources/js/vibe/image-lightbox.js'])
@endPushOnce

@pushOnce('body', 'vibe-image-lightbox')
    <vibe:image.lightbox />
@endPushOnce

<div
    {{ $attributes->twMerge(['class' => 'vibe-image-gallery']) }}
    data-vibe-gallery="{{ $group }}"
>
    {{ $slot }}
</div>
