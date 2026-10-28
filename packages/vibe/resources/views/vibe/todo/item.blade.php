@blaze(fold: true)

@aware([
    'layout' => 'list',
    'checkbox' => null,
    'checkable' => null,
    'navButtons' => false,
    'dragHandle' => null,
    'dragIndicator' => null,
    'handle' => null,
    'lock' => false,
    'locked' => false,
])

@props([
    'id' => null,
    'title' => '',
    'description' => null,
    'completed' => false,
    'checkbox' => null,
    'checkable' => null,
    'group' => null,
    'order' => null,
    'reorderable' => true,
    'deletable' => true,
    'badge' => null,
    'badgeVariant' => 'default',
    'dueDate' => null,
    'assignee' => null,
    'variant' => 'default', // 'default', 'card', 'flat'
    'navButtons' => null, // null = inherit dari parent @aware, true/false = override per-item
    'dragHandle' => null,
    'dragIndicator' => null,
    'handle' => null,
    'lock' => null,
    'locked' => null,
])

@php
    $itemId = $id ?? 'todo-item-' . Str::random(8);
    $isCompleted = (bool) $completed;

    $isBoard = in_array($layout, ['board', 'kanban'], true) || ! empty($group);
    
    // Default: NO checkbox unless explicitly enabled via :checkbox="true" or :checkable="true"
    $itemCheckbox = $checkbox ?? $checkable;
    $showCheckbox = $itemCheckbox !== null ? (bool) $itemCheckbox : false;

    // nav-buttons: per-item prop overrides parent @aware value
    // Default is false (hidden). Set :nav-buttons="true" on <vibe:todo> or per-item to show.
    // Note: $navButtons from @props is null when not set on item; $navButtons from @aware is false by default.
    $showNavButtons = $navButtons !== null ? (bool) $navButtons : false;

    // lock: per-item prop overrides parent @aware value.
    // Default is false (unlocked). Set lock/locked on <vibe:todo>, <vibe:todo.group>, or <vibe:todo.item> to prevent moving.
    $itemLockProp = $lock ?? $locked;
    $isLocked = $itemLockProp !== null ? (bool) $itemLockProp : false;

    // drag-handle: per-item prop overrides parent @aware value.
    // Default is 'hover' (only on hover on desktop, always visible on mobile). Options: 'visible', 'hover', 'hidden' (or false).
    $itemHandleProp = $dragHandle ?? $dragIndicator ?? $handle ?? $attributes->get('drag-handle') ?? $attributes->get('drag-indicator') ?? $attributes->get('handle');
    if ($itemHandleProp === false || $itemHandleProp === 'false' || $itemHandleProp === 'hidden' || $itemHandleProp === 'none' || $itemHandleProp === 'hide') {
        $dragHandleMode = 'hidden';
    } elseif ($itemHandleProp === true || $itemHandleProp === 'true' || $itemHandleProp === 'visible' || $itemHandleProp === 'show' || $itemHandleProp === 'always' || $itemHandleProp === '') {
        $dragHandleMode = 'visible';
    } else {
        $dragHandleMode = 'hover';
    }

    $cardStyles = match ($variant) {
        'flat' => 'bg-muted/40 border-transparent hover:bg-muted/60',
        'outline' => 'bg-transparent border border-border hover:border-border/80',
        default => 'bg-card border border-border/70 dark:border-border/40 shadow-2xs hover:shadow-xs',
    };
@endphp

<div
    id="todo-item-{{ $itemId }}"
    data-todo-item="{{ $itemId }}"
    data-id="{{ $itemId }}"
    data-completed="{{ $isCompleted ? 'true' : 'false' }}"
    data-order="{{ $order ?? '' }}"
    data-group="{{ $group ?? '' }}"
    data-locked="{{ $isLocked ? 'true' : 'false' }}"
    draggable="{{ ($reorderable && ! $isLocked) ? 'true' : 'false' }}"
    @if ($reorderable && ! $isLocked)
        @dragstart="typeof onDragStart === 'function' ? onDragStart('{{ $itemId }}', $event.currentTarget.closest('[data-todo-group]')?.dataset?.todoGroup || $event.currentTarget.dataset.group, $event) : null"
        @dragover.prevent.stop="typeof onDragOver === 'function' ? onDragOver('{{ $itemId }}', $event.currentTarget.closest('[data-todo-group]')?.dataset?.todoGroup || $event.currentTarget.dataset.group, $event) : null"
        @dragleave="typeof onDragLeave === 'function' ? onDragLeave('{{ $itemId }}', $event) : null"
        @drop.prevent.stop="typeof onDrop === 'function' ? onDrop('{{ $itemId }}', $event.currentTarget.closest('[data-todo-group]')?.dataset?.todoGroup || $event.currentTarget.dataset.group, $event) : null"
        @dragend="typeof onDragEnd === 'function' ? onDragEnd() : null"
    @endif
    {{ $attributes->twMerge(['class' => "group relative flex items-center justify-between gap-3 p-3 sm:p-3.5 rounded-xl transition-all duration-150 select-none {$cardStyles}"]) }}
    :class="{
        'opacity-40 scale-[0.99] ring-2 ring-primary/40': (typeof draggingId !== 'undefined' && draggingId === '{{ $itemId }}'),
        'border-t-2 border-t-primary': (typeof dragOverId !== 'undefined' && dragOverId === '{{ $itemId }}' && typeof dragOverPosition !== 'undefined' && dragOverPosition === 'before'),
        'border-b-2 border-b-primary': (typeof dragOverId !== 'undefined' && dragOverId === '{{ $itemId }}' && typeof dragOverPosition !== 'undefined' && dragOverPosition === 'after')
    }"
>
    {{-- Form Submit Hidden Inputs (Re-indexed dynamically by JS in form mode) --}}
    <input type="hidden" data-field="id" value="{{ $itemId }}">
    <input type="hidden" data-field="order" value="{{ $order ?? 0 }}">
    <input type="hidden" data-field="completed" value="{{ $isCompleted ? '1' : '0' }}">
    <input type="hidden" data-field="group" value="{{ $group ?? '' }}">

    {{-- Left: Drag Handle / Lock Indicator, Checkbox, Title/Description --}}
    <div class="flex items-center gap-3 min-w-0 flex-1">
        @if ($isLocked)
            {{-- Lock Indicator --}}
            <div class="shrink-0 text-muted-foreground/50 flex items-center justify-center p-0.5" aria-label="Terkunci" title="Terkunci (tidak dapat dipindah)">
                <svg class="size-4 pointer-events-none select-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </div>
        @elseif ($reorderable && $dragHandleMode !== 'hidden')
            {{-- Drag Handle --}}
            <div class="shrink-0 {{ $dragHandleMode === 'hover' ? 'flex md:hidden md:group-hover:flex' : 'flex' }} text-muted-foreground/40 group-hover:text-muted-foreground transition-colors">
                <vibe:todo.handle mode="visible" />
            </div>
        @endif

        {{-- Custom Accessible Checkbox --}}
        @if ($showCheckbox)
            <button
                type="button"
                draggable="false"
                role="checkbox"
                aria-checked="{{ $isCompleted ? 'true' : 'false' }}"
                @click.stop="typeof toggle === 'function' ? toggle('{{ $itemId }}') : null"
                class="shrink-0 flex items-center justify-center size-5 rounded-md border transition-all duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/40 cursor-pointer"
                data-todo-checkbox-box
                :class="{{ $isCompleted ? 'true' : 'false' }} ? 'bg-primary border-primary text-primary-foreground' : 'bg-background border-input hover:border-primary/60'"
            >
                <svg 
                    data-todo-check-icon
                    class="size-3.5 stroke-[2.5] transition-all duration-150 {{ $isCompleted ? 'opacity-100 scale-100' : 'opacity-0 scale-50' }}" 
                    viewBox="0 0 24 24" 
                    fill="none" 
                    stroke="currentColor" 
                    stroke-linecap="round" 
                    stroke-linejoin="round"
                >
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </button>
        @endif

        {{-- Content / Title & Description --}}
        <div 
            class="flex flex-col min-w-0 flex-1 {{ $showCheckbox ? 'cursor-pointer' : '' }}" 
            @if ($showCheckbox) @click="typeof toggle === 'function' ? toggle('{{ $itemId }}') : null" @endif
        >
            <span 
                data-todo-title
                class="text-sm font-medium transition-all duration-150 truncate {{ $isCompleted ? 'line-through text-muted-foreground/80' : 'text-foreground' }}"
            >
                {{ $title ?: $slot }}
            </span>

            @if ($description)
                <p class="text-xs text-muted-foreground truncate mt-0.5">
                    {{ $description }}
                </p>
            @endif
        </div>
    </div>

    {{-- Right: Metadata (Badges, Due Date) & Action Buttons --}}
    <div class="flex items-center gap-2 shrink-0">
        @if ($badge)
            <vibe:badge size="xs" :variant="$badgeVariant" class="font-medium">
                {{ $badge }}
            </vibe:badge>
        @endif

        @if ($dueDate)
            <span class="inline-flex items-center gap-1 text-[11px] font-medium text-muted-foreground bg-muted/50 px-2 py-0.5 rounded-md">
                <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                    <line x1="16" x2="16" y1="2" y2="6"/>
                    <line x1="8" x2="8" y1="2" y2="6"/>
                    <line x1="3" x2="21" y1="10" y2="10"/>
                </svg>
                {{ $dueDate }}
            </span>
        @endif

        {{-- Board Navigation Buttons (Move to Prev/Next Column) --}}
        @if ($isBoard && $showNavButtons && ! $isLocked)
            <div 
                class="flex items-center gap-1 shrink-0"
                x-show="(typeof canMovePrev === 'function' && canMovePrev('{{ $itemId }}')) || (typeof canMoveNext === 'function' && canMoveNext('{{ $itemId }}'))"
            >
                <button
                    type="button"
                    draggable="false"
                    aria-label="Pindahkan ke kolom sebelumnya"
                    title="Pindahkan ke kolom sebelumnya"
                    x-show="typeof canMovePrev === 'function' && canMovePrev('{{ $itemId }}')"
                    @click.stop="typeof moveToPrevGroup === 'function' ? moveToPrevGroup('{{ $itemId }}') : null"
                    class="p-1 rounded-md text-muted-foreground/70 hover:text-foreground hover:bg-muted active:scale-95 transition-all cursor-pointer"
                >
                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                </button>
                <button
                    type="button"
                    draggable="false"
                    aria-label="Pindahkan ke kolom selanjutnya"
                    title="Pindahkan ke kolom selanjutnya"
                    x-show="typeof canMoveNext === 'function' && canMoveNext('{{ $itemId }}')"
                    @click.stop="typeof moveToNextGroup === 'function' ? moveToNextGroup('{{ $itemId }}') : null"
                    class="p-1 rounded-md text-muted-foreground/70 hover:text-foreground hover:bg-muted active:scale-95 transition-all cursor-pointer"
                >
                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </button>
            </div>
        @endif

        {{-- Delete Button (Visible on Hover / Focus, takes zero space when hidden) --}}
        @if ($deletable)
            <button
                type="button"
                draggable="false"
                aria-label="Hapus tugas"
                title="Hapus tugas"
                @click.stop="typeof remove === 'function' ? remove('{{ $itemId }}') : null"
                class="hidden group-hover:flex focus:flex p-1 rounded-md text-muted-foreground hover:text-destructive hover:bg-destructive/10 transition-all cursor-pointer items-center justify-center"
            >
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18"/>
                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                </svg>
            </button>
        @endif
    </div>
</div>
