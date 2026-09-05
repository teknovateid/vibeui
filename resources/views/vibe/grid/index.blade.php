@blaze(fold: true)

@props([
    'id' => null,
    'cols' => 12,
    'gap' => '4',
    'persist' => true,
    'resizable' => true,
    'reorderable' => true,
    'storageKey' => null,
])

@php
    $gridId = $id ?? 'vibe-grid-' . Str::random(8);

    $gapClass = match ($gap) {
        '2', 'gap-2' => 'gap-2',
        '3', 'gap-3' => 'gap-3',
        '6', 'gap-6' => 'gap-6',
        '8', 'gap-8' => 'gap-8',
        default => 'gap-4',
    };
@endphp

<div
    id="{{ $gridId }}"
    data-vibe-grid
    {{ $attributes->twMerge(['class' => "w-full grid grid-cols-{$cols} {$gapClass} relative transition-all duration-150"]) }}
    x-data="vibeGrid({
        id: '{{ $gridId }}',
        cols: {{ (int) $cols }},
        persist: {{ $persist ? 'true' : 'false' }},
        resizable: {{ $resizable ? 'true' : 'false' }},
        reorderable: {{ $reorderable ? 'true' : 'false' }},
        storageKey: '{{ $storageKey ?: '' }}'
    })"
>
    {{ $slot }}
</div>
