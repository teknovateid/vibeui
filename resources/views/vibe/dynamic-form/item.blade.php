@blaze

@props([
    'index' => 0,
    'title' => null,
    'variant' => 'card', // card, bordered, table, ghost
    'allowReorder' => true,
    'allowDuplicate' => true,
    'collapsible' => true,
    'collapsed' => false,
])

@php
    $isIndexNumeric = is_numeric($index);
    $displayIndex = $isIndexNumeric ? $index + 1 : 1;
    $defaultTitle = __('vibe/dynamic-form.item_prefix');
    $displayTitle = $title ?? str_replace(':index', $displayIndex, $defaultTitle);

    $cardClasses = match ($variant) {
        'bordered' => 'w-full rounded-xl border border-border bg-background p-4 relative transition-all duration-150 focus-within:z-30',
        'table' => 'w-full rounded-lg border border-border/70 bg-card p-3 relative transition-all duration-150 focus-within:z-30',
        'ghost' => 'w-full border-b border-border/60 pb-4 pt-2 relative transition-all duration-150 focus-within:z-30',
        default => 'w-full rounded-xl border border-border bg-card text-card-foreground shadow-2xs relative transition-all duration-150 focus-within:z-30',
    };
@endphp

<div data-dynamic-form-item data-index="{{ $index }}" @if ($allowReorder) @dragover="onDragOver($el, $event)"
        @dragleave="onDragLeave($el, $event)"
        @drop="onDrop($el, $event)"
        @dragend="endDrag($el, $event)" @endif {{ $attributes->twMerge(['class' => $cardClasses]) }}>
    @if ($variant === 'card')
        {{-- Card Header Bar --}}
        <div class="flex items-center justify-between px-4 py-2.5 bg-muted/40 border-b border-border/60 rounded-t-xl select-none group">
            {{-- Left: Drag Handle, Badge & Title --}}
            <div class="flex items-center gap-2 min-w-0">
                @if ($allowReorder)
                    {{-- Drag Handle --}}
                    <div data-action-drag-handle draggable="true" @dragstart="startDrag($el, $event)" @dragend="endDrag($el, $event)" title="Tarik untuk mengubah urutan baris" class="cursor-grab hidden group-hover:flex duration-400 transition-all active:cursor-grabbing text-muted-foreground/60 hover:text-foreground hover:bg-muted p-1 -ml-1 rounded items-center justify-center shrink-0 select-none">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="5" r="1" />
                            <circle cx="9" cy="12" r="1" />
                            <circle cx="9" cy="19" r="1" />
                            <circle cx="15" cy="5" r="1" />
                            <circle cx="15" cy="12" r="1" />
                            <circle cx="15" cy="19" r="1" />
                        </svg>
                    </div>
                @endif

                <span data-dynamic-form-badge class="inline-flex items-center justify-center text-[11px] font-bold font-mono px-2 py-0.5 rounded-md bg-primary/10 text-primary shrink-0">
                    #{{ $displayIndex }}
                </span>

                <span data-dynamic-form-title data-default-title="{{ $defaultTitle }}" class="text-xs font-semibold text-foreground truncate">
                    {{ $displayTitle }}
                </span>
            </div>

            {{-- Right: Actions Toolbar --}}
            <div class="flex items-center gap-1 shrink-0">
                @if ($allowReorder)
                    {{-- Move Up --}}
                    <button type="button" data-action-move-up @click="moveUp($el)" title="{{ __('vibe/dynamic-form.move_up') }}" class="p-1 rounded-md text-muted-foreground hover:text-foreground hover:bg-muted transition-colors cursor-pointer">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6" />
                        </svg>
                    </button>

                    {{-- Move Down --}}
                    <button type="button" data-action-move-down @click="moveDown($el)" title="{{ __('vibe/dynamic-form.move_down') }}" class="p-1 rounded-md text-muted-foreground hover:text-foreground hover:bg-muted transition-colors cursor-pointer">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>

                    <span class="w-px h-3.5 bg-border mx-0.5"></span>
                @endif

                @if ($allowDuplicate)
                    {{-- Duplicate --}}
                    <button type="button" data-action-duplicate @click="duplicateItem($el)" title="{{ __('vibe/dynamic-form.duplicate_row') }}" class="p-1 rounded-md text-muted-foreground hover:text-foreground hover:bg-muted transition-colors cursor-pointer">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="14" height="14" x="8" y="8" rx="2" ry="2" />
                            <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                        </svg>
                    </button>
                @endif

                @if ($collapsible)
                    {{-- Collapse Toggle --}}
                    <button type="button" data-action-collapse @click="toggleCollapse($el)" title="{{ __('vibe/dynamic-form.collapse') }}" class="p-1 rounded-md text-muted-foreground hover:text-foreground hover:bg-muted transition-colors cursor-pointer">
                        <svg data-dynamic-form-chevron class="size-3.5 transition-transform duration-200 {{ $collapsed ? '-rotate-90' : '' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                @endif

                {{-- Delete / Remove --}}
                <button type="button" data-action-delete @click="removeItem($el)" x-bind:disabled="!canRemove" x-bind:class="{ 'opacity-40 pointer-events-none': !canRemove }" title="{{ __('vibe/dynamic-form.delete_row') }}" class="p-1 rounded-md text-destructive/80 hover:text-destructive hover:bg-destructive/10 transition-colors cursor-pointer ml-0.5">
                    <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 6h18" />
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                        <path d="M8 6V4c0-1 1-2 1-2h6c1 0 1 1 1 2v2" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Card Body --}}
        <div data-dynamic-form-body class="p-4 rounded-b-xl {{ $collapsed ? 'hidden' : '' }}">
            {{ $slot }}
        </div>
    @elseif ($variant === 'table')
        {{-- Table Variant: Inline row layout with Drag Handle --}}
        <div class="flex flex-col md:flex-row items-start md:items-center gap-2.5">
            @if ($allowReorder)
                <div data-action-drag-handle draggable="true" @dragstart="startDrag($el, $event)" @dragend="endDrag($el, $event)" title="Tarik untuk mengubah urutan baris" class="cursor-grab active:cursor-grabbing text-muted-foreground/60 hover:text-foreground hover:bg-muted p-1 rounded transition-colors hidden md:flex items-center justify-center shrink-0 select-none">
                    <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="5" r="1" />
                        <circle cx="9" cy="12" r="1" />
                        <circle cx="9" cy="19" r="1" />
                        <circle cx="15" cy="5" r="1" />
                        <circle cx="15" cy="12" r="1" />
                        <circle cx="15" cy="19" r="1" />
                    </svg>
                </div>
            @endif

            <span data-dynamic-form-badge class="inline-flex items-center justify-center text-xs font-mono font-bold px-2 py-1 rounded bg-muted text-muted-foreground shrink-0">
                #{{ $displayIndex }}
            </span>

            <div data-dynamic-form-body class="flex-1 w-full min-w-0">
                {{ $slot }}
            </div>

            <div class="flex items-center gap-1 shrink-0 self-end md:self-center">
                @if ($allowReorder)
                    <button type="button" data-action-move-up @click="moveUp($el)" class="p-1.5 rounded text-muted-foreground hover:bg-muted" title="{{ __('vibe/dynamic-form.move_up') }}">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m18 15-6-6-6 6" />
                        </svg>
                    </button>
                    <button type="button" data-action-move-down @click="moveDown($el)" class="p-1.5 rounded text-muted-foreground hover:bg-muted" title="{{ __('vibe/dynamic-form.move_down') }}">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                @endif
                @if ($allowDuplicate)
                    <button type="button" data-action-duplicate @click="duplicateItem($el)" class="p-1.5 rounded text-muted-foreground hover:bg-muted" title="{{ __('vibe/dynamic-form.duplicate_row') }}">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect width="14" height="14" x="8" y="8" rx="2" ry="2" />
                            <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                        </svg>
                    </button>
                @endif
                <button type="button" data-action-delete @click="removeItem($el)" x-bind:disabled="!canRemove" x-bind:class="{ 'opacity-40 pointer-events-none': !canRemove }" class="p-1.5 rounded text-destructive/80 hover:bg-destructive/10 cursor-pointer" title="{{ __('vibe/dynamic-form.delete_row') }}">
                    <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 6h18" />
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                        <path d="M8 6V4c0-1 1-2 1-2h6c1 0 1 1 1 2v2" />
                    </svg>
                </button>
            </div>
        </div>
    @else
        {{-- Bordered / Ghost Variant with Drag Handle --}}
        <div class="flex items-center justify-between pb-2 mb-3 border-b border-border/50">
            <div class="flex items-center gap-2">
                @if ($allowReorder)
                    <div data-action-drag-handle draggable="true" @dragstart="startDrag($el, $event)" @dragend="endDrag($el, $event)" title="Tarik untuk mengubah urutan baris" class="cursor-grab active:cursor-grabbing text-muted-foreground/60 hover:text-foreground hover:bg-muted p-0.5 rounded transition-colors flex items-center justify-center shrink-0 select-none">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="5" r="1" />
                            <circle cx="9" cy="12" r="1" />
                            <circle cx="9" cy="19" r="1" />
                            <circle cx="15" cy="5" r="1" />
                            <circle cx="15" cy="12" r="1" />
                            <circle cx="15" cy="19" r="1" />
                        </svg>
                    </div>
                @endif
                <span data-dynamic-form-badge class="text-xs font-semibold font-mono text-primary">#{{ $displayIndex }}</span>
            </div>

            <div class="flex items-center gap-1">
                @if ($allowReorder)
                    <button type="button" data-action-move-up @click="moveUp($el)" class="p-1 rounded text-muted-foreground hover:bg-muted" title="{{ __('vibe/dynamic-form.move_up') }}">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m18 15-6-6-6 6" />
                        </svg>
                    </button>
                    <button type="button" data-action-move-down @click="moveDown($el)" class="p-1 rounded text-muted-foreground hover:bg-muted" title="{{ __('vibe/dynamic-form.move_down') }}">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                @endif
                @if ($allowDuplicate)
                    <button type="button" data-action-duplicate @click="duplicateItem($el)" class="p-1 rounded text-muted-foreground hover:bg-muted" title="{{ __('vibe/dynamic-form.duplicate_row') }}">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect width="14" height="14" x="8" y="8" rx="2" ry="2" />
                            <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                        </svg>
                    </button>
                @endif
                <button type="button" data-action-delete @click="removeItem($el)" x-bind:disabled="!canRemove" x-bind:class="{ 'opacity-40 pointer-events-none': !canRemove }" class="p-1 rounded text-destructive/80 hover:bg-destructive/10 cursor-pointer" title="{{ __('vibe/dynamic-form.delete_row') }}">
                    <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 6h18" />
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                        <path d="M8 6V4c0-1 1-2 1-2h6c1 0 1 1 1 2v2" />
                    </svg>
                </button>
            </div>
        </div>
        <div data-dynamic-form-body>
            {{ $slot }}
        </div>
    @endif
</div>
