@blaze
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

@pushOnce('body', 'vibe-grid')
    @vite(['resources/js/vibe/grid.js'])
@endPushOnce

<div
    id="{{ $gridId }}"
    data-vibe-grid
    {{ $attributes->twMerge(['class' => "w-full grid grid-cols-{$cols} {$gapClass} relative transition-all duration-150"]) }}
    x-data="typeof window.vibeGrid === 'function' ? window.vibeGrid({
        id: '{{ $gridId }}',
        cols: {{ (int) $cols }},
        persist: {{ $persist ? 'true' : 'false' }},
        resizable: {{ $resizable ? 'true' : 'false' }},
        reorderable: {{ $reorderable ? 'true' : 'false' }},
        storageKey: '{{ $storageKey ?: '' }}'
    }) : {
        id: '{{ $gridId }}',
        cols: {{ (int) $cols }},
        persist: {{ $persist ? 'true' : 'false' }},
        resizable: {{ $resizable ? 'true' : 'false' }},
        reorderable: {{ $reorderable ? 'true' : 'false' }},
        storageKey: '{{ $storageKey ?: '' }}',
        order: [],
        spans: {},
        draggingId: null,
        dragOverId: null,
        resizing: null,
        previewId: null,
        previewCols: null,
        init() {
            var self = this;
            var isBound = false;
            var bindGrid = function() {
                if (isBound) return;
                if (typeof window.vibeGrid === 'function') {
                    isBound = true;
                    clearInterval(timer);
                    Object.assign(self, window.vibeGrid({
                        id: '{{ $gridId }}',
                        cols: {{ (int) $cols }},
                        persist: {{ $persist ? 'true' : 'false' }},
                        resizable: {{ $resizable ? 'true' : 'false' }},
                        reorderable: {{ $reorderable ? 'true' : 'false' }},
                        storageKey: '{{ $storageKey ?: '' }}'
                    }));
                    self.init();
                }
            };

            window.addEventListener('vibe-grid-ready', bindGrid, { once: true });
            var timer = setInterval(function() {
                if (typeof window.vibeGrid === 'function') {
                    bindGrid();
                }
            }, 30);
            setTimeout(function() { clearInterval(timer); }, 3000);
        },
        onDragOver() {},
        onDragLeave() {},
        onDrop() {},
        startDrag() {},
        endDrag() {},
        startResize() {},
        applyLayout() {},
        resetLayout() {}
    }"
>
    {{ $slot }}
</div>
