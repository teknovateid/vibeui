@blaze(fold: true)

@props([
    'id' => null,
    'key' => null,
    'title' => null,
    'titleTag' => 'h3',
    'description' => null,
    'colSpan' => 4,
    'rowSpan' => 1,
    'minColSpan' => 2,
    'maxColSpan' => 12,
    'resizable' => true,
    'reorderable' => true,
    'variant' => 'default', // default, outline, flat, elevated
    'padding' => 'default', // none, sm, default, lg
])

@php
    $cardId = $id ?? $key ?? 'card-' . Str::random(6);
    $validTitleTags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'p', 'span'];
    $tag = in_array($titleTag, $validTitleTags, true) ? $titleTag : 'h3';

    // Lock type: none | reorder | resize | both
    $lockType = 'none';
    if (!$reorderable && !$resizable) $lockType = 'both';
    elseif (!$reorderable) $lockType = 'reorder';
    elseif (!$resizable) $lockType = 'resize';

    $lockTooltip = match ($lockType) {
        'reorder' => 'Posisi dikunci — tidak dapat dipindahkan',
        'resize'  => 'Ukuran dikunci — tidak dapat di-resize',
        'both'    => 'Dikunci sepenuhnya — tidak dapat dipindahkan atau di-resize',
        default   => '',
    };

    $variantClasses = match ($variant) {
        'outline' => 'bg-transparent border border-border shadow-none',
        'flat', 'muted' => 'bg-muted/50 border-transparent shadow-none',
        'elevated' => 'bg-card border border-border/80 shadow-md',
        default => 'bg-card border border-border shadow-2xs',
    };

    $bodyPadding = match ($padding) {
        'none', '0' => 'p-0',
        'sm' => 'p-3 sm:p-4',
        'lg' => 'p-6 sm:p-8',
        default => 'p-4 sm:p-5',
    };

    $headerPadding = match ($padding) {
        'none', '0' => 'px-0 pt-0 pb-2',
        'sm' => 'px-3 sm:px-4 pt-3 sm:pt-4 pb-2',
        'lg' => 'px-6 sm:px-8 pt-6 sm:pt-8 pb-3',
        default => 'px-4 sm:px-5 pt-4 sm:pt-5 pb-2.5',
    };

    $footerPadding = match ($padding) {
        'none', '0' => 'px-0 pb-0 pt-2',
        'sm' => 'px-3 sm:px-4 pb-3 sm:pb-4 pt-2',
        'lg' => 'px-6 sm:px-8 pb-6 sm:pb-8 pt-3',
        default => 'px-4 sm:px-5 pb-4 sm:pb-5 pt-2.5',
    };
@endphp

<div
    data-grid-item="{{ $cardId }}"
    data-col-span="{{ $colSpan }}"
    data-row-span="{{ $rowSpan }}"
    data-min-col-span="{{ $minColSpan }}"
    data-max-col-span="{{ $maxColSpan }}"
    data-reorderable="{{ $reorderable ? 'true' : 'false' }}"
    data-resizable="{{ $resizable ? 'true' : 'false' }}"
    :class="{
        'opacity-25 scale-[0.97] saturate-0': draggingId === '{{ $cardId }}',
        'opacity-55 scale-[0.99]': draggingId && draggingId !== '{{ $cardId }}' && dragOverId !== '{{ $cardId }}',
        'scale-[1.015] shadow-lg ring-1 ring-primary/50 border-primary/30': dragOverId === '{{ $cardId }}' && draggingId !== '{{ $cardId }}',
        'ring-2 ring-primary shadow-lg': resizing && resizing.id === '{{ $cardId }}',
        'transition-all duration-200 ease-out': !resizing
    }"
    :style="{ order: order.indexOf('{{ $cardId }}') !== -1 ? order.indexOf('{{ $cardId }}') + 1 : 1 }"
    @if ($reorderable)
        @dragover.prevent="onDragOver('{{ $cardId }}', $event)"
        @dragenter.prevent="onDragOver('{{ $cardId }}', $event)"
        @dragleave="onDragLeave('{{ $cardId }}', $event)"
        @drop.prevent="onDrop('{{ $cardId }}', $event)"
    @endif
    {{ $attributes->twMerge(['class' => "group relative flex flex-col rounded-xl text-card-foreground {$variantClasses} overflow-hidden min-h-[120px] select-text"]) }}
    style="--vibe-col-span: {{ $colSpan }}; --vibe-row-span: {{ $rowSpan }}; grid-column: span var(--vibe-col-span, {{ $colSpan }}); grid-row: span var(--vibe-row-span, {{ $rowSpan }});"
>
    {{-- Live Resize Floating Pill Indicator --}}
    <div
        x-show="resizing && resizing.id === '{{ $cardId }}'"
        x-cloak
        class="absolute top-2.5 right-2.5 px-2.5 py-1 rounded-md bg-primary text-primary-foreground text-xs font-mono font-bold shadow-lg pointer-events-none z-30 flex items-center gap-1.5 animate-in fade-in zoom-in-95 duration-100"
    >
        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
        <span x-text="(previewCols || (spans['{{ $cardId }}'] ? spans['{{ $cardId }}'].col : '{{ $colSpan }}')) + ' / ' + cols + ' Kolom'"></span>
    </div>

    {{-- Swap Target Overlay Indicator (hanya untuk kartu yang reorderable) --}}
    @if ($reorderable)
        <div
            x-show="dragOverId === '{{ $cardId }}' && draggingId !== '{{ $cardId }}'"
            x-cloak
            class="absolute inset-0 rounded-xl pointer-events-none z-20 overflow-hidden"
        >
            {{-- Subtle frosted background --}}
            <div class="absolute inset-0 bg-primary/6 backdrop-blur-[2px] rounded-xl"></div>

            {{-- Thin border --}}
            <div class="absolute inset-0 rounded-xl" style="box-shadow: inset 0 0 0 1.5px oklch(var(--color-primary) / 0.4); border-radius: inherit;"></div>

            {{-- Center content --}}
            <div class="absolute inset-0 flex flex-col items-center justify-center gap-2.5">
                {{-- Swap icon — small & soft --}}
                <div class="size-8 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center">
                    <svg class="size-4 text-primary/80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m16 3 4 4-4 4"/><path d="M20 7H4"/>
                        <path d="m8 21-4-4 4-4"/><path d="M4 17h16"/>
                    </svg>
                </div>

                {{-- Label --}}
                <div class="flex flex-col items-center gap-0.5">
                    <span class="text-xs font-semibold text-primary/90 tracking-tight">Tukar Posisi</span>
                    <span class="text-[10px] text-primary/55 font-normal">Lepaskan untuk menukar</span>
                </div>
            </div>
        </div>
    @endif

    {{-- Dragging Source Badge --}}
    @if ($reorderable)
        <div
            x-show="draggingId === '{{ $cardId }}'"
            x-cloak
            class="absolute inset-0 rounded-xl pointer-events-none z-20 flex items-center justify-center"
        >
            <div class="px-2.5 py-1 rounded-full bg-muted/80 text-muted-foreground text-[10px] font-medium flex items-center gap-1.5 backdrop-blur-sm border border-border/50">
                <svg class="size-3 opacity-60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="5 9 2 12 5 15"/><polyline points="19 9 22 12 19 15"/>
                    <line x1="2" y1="12" x2="22" y2="12"/>
                </svg>
                <span>Dipindahkan</span>
            </div>
        </div>
    @endif

    {{-- Card Header --}}
    @if (isset($header))
        <div
            @if ($reorderable)
                draggable="true"
                @dragstart="startDrag('{{ $cardId }}', $event)"
                @dragend="endDrag()"
                title="Tarik header untuk menukar posisi kartu"
            @endif
            class="flex items-center justify-between border-b border-border/60 {{ $headerPadding }} {{ $reorderable ? 'cursor-grab active:cursor-grabbing select-none hover:bg-muted/30 transition-colors' : '' }}"
        >
            {{ $header }}
        </div>
    @elseif ($title || $description || isset($actions) || $reorderable !== null)
        <div
            @if ($reorderable)
                draggable="true"
                @dragstart="startDrag('{{ $cardId }}', $event)"
                @dragend="endDrag()"
                title="Tarik header untuk menukar posisi kartu"
            @endif
            class="flex items-center justify-between gap-2 border-b border-border/50 {{ $headerPadding }} {{ $reorderable ? 'cursor-grab active:cursor-grabbing select-none hover:bg-muted/30 transition-colors' : '' }}"
        >
            {{-- Title & Description (Flush Left) --}}
            <div class="min-w-0 flex-1 pointer-events-none">
                @if ($title)
                    <{{ $tag }} data-toc-ignore class="text-sm font-semibold text-foreground tracking-tight truncate">{{ $title }}</{{ $tag }}>
                @endif
                @if ($description)
                    <p class="text-xs text-muted-foreground truncate">{{ $description }}</p>
                @endif
            </div>

            {{-- Actions & Header Controls (Right side) --}}
            <div class="flex items-center gap-1 shrink-0">
                @if (isset($actions))
                    <div class="flex items-center gap-1 shrink-0 pointer-events-auto" @mousedown.stop @dragstart.stop.prevent>
                        {{ $actions }}
                    </div>
                @endif

                {{-- Lock icon — visible on hover only, icon differs per lock type --}}
                @if ($lockType !== 'none')
                    <div
                        title="{{ $lockTooltip }}"
                        class="size-7 rounded-md text-muted-foreground/0 group-hover:text-muted-foreground/50 hover:text-muted-foreground! flex items-center justify-center shrink-0 transition-all duration-150 pointer-events-none"
                    >
                        @if ($lockType === 'reorder')
                            {{-- Position locked, can still resize: padlock with dot inside --}}
                            <svg class="size-3.5 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                <circle cx="12" cy="16" r="1" fill="currentColor"/>
                            </svg>
                        @elseif ($lockType === 'resize')
                            {{-- Size locked, can still move: lock with horizontal bar --}}
                            <svg class="size-3.5 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                <path d="M10 16h4"/>
                            </svg>
                        @else
                            {{-- Fully locked: solid padlock --}}
                            <svg class="size-3.5 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        @endif
                    </div>
                @endif

                {{-- Drag Handle Grip — visible on hover only --}}
                @if ($reorderable)
                    <div
                        title="Tarik header untuk menukar posisi kartu"
                        class="size-7 rounded-md text-muted-foreground/0 group-hover:text-muted-foreground/60 flex items-center justify-center shrink-0 transition-all duration-150 pointer-events-none"
                    >
                        <svg class="size-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="5" r="1"/><circle cx="9" cy="12" r="1"/><circle cx="9" cy="19" r="1"/>
                            <circle cx="15" cy="5" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="15" cy="19" r="1"/>
                        </svg>
                    </div>
                @endif
            </div>
        </div>
    @endif

    {{-- Card Body --}}
    <div class="flex-1 {{ $bodyPadding }}">
        {{ $slot }}
    </div>

    {{-- Card Footer --}}
    @if (isset($footer))
        <div class="border-t border-border/50 {{ $footerPadding }} bg-muted/20">
            {{ $footer }}
        </div>
    @endif

    {{-- Resize Grabber Handle — icon visible on hover only on desktop --}}
    @if ($resizable)
        <div
            data-resize-handle
            @mousedown.stop.prevent="startResize('{{ $cardId }}', $event, $el.closest('[data-grid-item]'))"
            @touchstart.stop.prevent="startResize('{{ $cardId }}', $event, $el.closest('[data-grid-item]'))"
            title="Tarik sudut untuk mengubah ukuran kartu"
            class="hidden lg:flex absolute bottom-0 right-0 size-10 cursor-se-resize items-end justify-end p-2.5 text-muted-foreground/0 group-hover:text-muted-foreground/35 hover:text-primary! hover:bg-primary/10 rounded-tl-xl transition-all select-none z-20 group/resize touch-none"
        >
            <svg class="size-3.5 pointer-events-none group-hover/resize:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="21" y1="15" x2="15" y2="21" />
                <line x1="21" y1="9" x2="9" y2="21" />
            </svg>
        </div>
    @endif
</div>
