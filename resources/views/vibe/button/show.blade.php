@blaze(fold: true)

@props([
    'variant' => 'ghost',
    'size' => 'md',
    'url' => null,
    'target' => null,
    'method' => 'GET',
    'title' => null,
])

@php
    $title = $title ?? __('vibe/button.show_title');
    $isIcon = str_starts_with($size, 'icon-');
    $buttonAttributes = $attributes->whereDoesntStartWith(['wire:click', 'x-on:click', '@click']);

    $mergedAttributes = $buttonAttributes->merge([
        'title' => $title,
        'data-url' => $url,
        'data-target' => $target,
        'data-method' => $method,
        'x-on:click.stop' => 'vibeFetchAndShow($el)',
    ]);
@endphp

@pushOnce('body', 'vibe-show')
    @vite('resources/js/vibe/show.js')
@endPushOnce

<vibe:button :variant="$variant" :size="$size" :attributes="$mergedAttributes">
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @else
        <svg class="{{ $isIcon ? 'size-3.5' : 'size-4 mr-1.5' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3.275 15.296C2.425 14.192 2 13.639 2 12c0-1.639.425-2.192 1.275-3.296C4.972 6.5 7.818 4 12 4s7.028 2.5 8.725 4.704C21.575 9.808 22 10.36 22 12c0 1.639-.425 2.192-1.275 3.296C19.028 17.5 16.182 20 12 20s-7.028-2.5-8.725-4.704Z" />
            <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
    @endif
</vibe:button>
