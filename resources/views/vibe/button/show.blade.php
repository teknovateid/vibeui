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
        'x-on:click.stop' => "vibeFetchAndShow(\$el, '{$url}', '{$target}', { method: '{$method}' })",
    ]);
@endphp

@pushOnce('body')
    @vite('resources/js/vibe/show.js')
@endPushOnce

<vibe:button :variant="$variant" :size="$size" :attributes="$mergedAttributes">
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @else
        <svg class="{{ $isIcon ? 'size-3.5' : 'size-4 mr-1.5' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
            <circle cx="12" cy="12" r="3" />
        </svg>
    @endif
</vibe:button>
