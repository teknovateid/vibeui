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
    'editable' => false,
    'wireUpdate' => null,
    'updateUrl' => null,
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
    'labels' => null,
    'tags' => null,
    'subtasks' => null,
    'dueDate' => null,
    'assignee' => null,
    'assignees' => null,
    'variant' => 'default', // 'default', 'card', 'flat'
    'navButtons' => null, // null = inherit dari parent @aware, true/false = override per-item
    'dragHandle' => null,
    'dragIndicator' => null,
    'handle' => null,
    'lock' => null,
    'locked' => null,
    'editable' => null,
    'wireUpdate' => null,
    'updateUrl' => null,
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

    // editable: per-item prop overrides parent @aware value
    $isEditable = $editable !== null ? (bool) $editable : false;

    // Detect if custom slots were provided
    $hasLabelsSlot = isset($labels) && ($labels instanceof \Illuminate\Contracts\Support\Htmlable || $labels instanceof \Illuminate\View\ComponentSlot) && !empty((string) $labels);
    $hasAssigneeSlot = isset($assignee) && ($assignee instanceof \Illuminate\Contracts\Support\Htmlable || $assignee instanceof \Illuminate\View\ComponentSlot) && !empty((string) $assignee);

    // Resolve labels / tags
    $rawLabels = $hasLabelsSlot ? null : ($labels ?? $tags);
    if (is_string($rawLabels)) {
        if (str_starts_with(trim($rawLabels), '[') || str_starts_with(trim($rawLabels), '{')) {
            $decoded = json_decode($rawLabels, true);
            $resolvedLabels = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : [$rawLabels];
        } else {
            $resolvedLabels = array_filter(array_map('trim', explode(',', $rawLabels)));
        }
    } elseif (is_array($rawLabels)) {
        $resolvedLabels = $rawLabels;
    } else {
        $resolvedLabels = [];
    }

    // Resolve assignees
    $rawAssignees = $hasAssigneeSlot ? null : ($assignees ?? $assignee);
    if (is_string($rawAssignees)) {
        if (str_starts_with(trim($rawAssignees), '[') || str_starts_with(trim($rawAssignees), '{')) {
            $decoded = json_decode($rawAssignees, true);
            $resolvedAssignees = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : [['name' => $rawAssignees]];
        } else {
            $resolvedAssignees = [['name' => $rawAssignees]];
        }
    } elseif (is_array($rawAssignees)) {
        if (isset($rawAssignees['name']) || isset($rawAssignees['src']) || isset($rawAssignees['avatar'])) {
            $resolvedAssignees = [$rawAssignees];
        } else {
            $resolvedAssignees = $rawAssignees;
        }
    } else {
        $resolvedAssignees = [];
    }

    // Resolve subtasks
    $rawSubtasks = $subtasks;
    if (is_string($rawSubtasks)) {
        if (str_starts_with(trim($rawSubtasks), '[') || str_starts_with(trim($rawSubtasks), '{')) {
            $decoded = json_decode($rawSubtasks, true);
            $resolvedSubtasks = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : [];
        } else {
            $subtaskTitles = array_filter(array_map('trim', explode(',', $rawSubtasks)));
            $resolvedSubtasks = [];
            $subIdx = 1;
            foreach ($subtaskTitles as $st) {
                $resolvedSubtasks[] = ['id' => 'sub-' . $subIdx++, 'title' => $st, 'completed' => false];
            }
        }
    } elseif (is_array($rawSubtasks)) {
        $resolvedSubtasks = $rawSubtasks;
    } else {
        $resolvedSubtasks = [];
    }

    $hasSubtasksInSlot = !empty($title) && isset($slot) && !empty(trim((string) $slot));
    $hasAnySubtasks = !empty($resolvedSubtasks) || $hasSubtasksInSlot;

    // Smart Due Date Urgency calculation
    $dueDateUrgency = 'upcoming';
    if (!empty($dueDate) && is_string($dueDate)) {
        try {
            $parsedDate = \Illuminate\Support\Carbon::parse($dueDate);
            if ($parsedDate->isPast() && !$parsedDate->isToday()) {
                $dueDateUrgency = 'overdue';
            } elseif ($parsedDate->isToday()) {
                $dueDateUrgency = 'today';
            }
        } catch (\Throwable $e) {}
    }

    $dueDateClasses = match ($dueDateUrgency) {
        'overdue' => 'text-destructive bg-destructive/10 border border-destructive/25 font-semibold',
        'today' => 'text-amber-600 dark:text-amber-400 bg-amber-500/10 border border-amber-500/25 font-semibold',
        default => 'text-muted-foreground bg-muted/50 border border-transparent font-medium',
    };

    $dueDateTooltip = match ($dueDateUrgency) {
        'overdue' => 'Terlewat / Overdue',
        'today' => 'Jatuh tempo hari ini',
        default => 'Jatuh tempo: ' . $dueDate,
    };

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
    x-data="{
        subtasksCount: {{ count($resolvedSubtasks) }},
        completedSubtasksCount: {{ count(array_filter($resolvedSubtasks, fn($s) => !empty($s['completed']))) }},
        updateSubtasks() {
            const subEls = this.$el.querySelectorAll('[data-todo-subtask]');
            this.subtasksCount = subEls.length;
            let done = 0;
            subEls.forEach(el => {
                if (el.dataset.completed === 'true' || el.getAttribute('data-completed') === 'true') {
                    done++;
                }
            });
            this.completedSubtasksCount = done;
        },
        init() {
            this.$nextTick(() => this.updateSubtasks());
        }
    }"
    @vibe:todo-subtask-toggle.stop="updateSubtasks(); $dispatch('vibe:todo-subtask-changed', { itemId: '{{ $itemId }}', subtaskId: $event.detail.subtaskId, completed: $event.detail.completed, total: subtasksCount, completedCount: completedSubtasksCount })"
    {{ $attributes->twMerge(['class' => "group relative flex flex-col justify-center gap-0 p-3 sm:p-3.5 rounded-xl transition-all duration-150 select-none {$cardStyles}"]) }}
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

    {{-- Main Card Row --}}
    <div class="flex items-center justify-between gap-3 w-full">
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

        {{-- Content / Title & Description with Inline Editing --}}
        <div 
            x-data="{
                editing: false,
                editTitle: @js($title),
                editDesc: @js($description ?? ''),
                isEditable: @js($isEditable),
                startEdit() {
                    if (!this.isEditable) return;
                    this.editing = true;
                    this.$nextTick(() => {
                        const input = this.$refs.titleInput;
                        if (input) { input.focus(); input.select(); }
                    });
                },
                saveEdit() {
                    if (!this.editing) return;
                    this.editing = false;
                    const cleanTitle = (this.editTitle || '').trim();
                    if (cleanTitle) {
                        if (typeof updateItem === 'function') {
                            updateItem('{{ $itemId }}', { title: cleanTitle, description: this.editDesc });
                        }
                    } else {
                        this.editTitle = @js($title);
                    }
                },
                cancelEdit() {
                    this.editing = false;
                    this.editTitle = @js($title);
                    this.editDesc = @js($description ?? '');
                }
            }"
            class="group/content flex flex-col min-w-0 flex-1 relative {{ $showCheckbox && ! $isEditable ? 'cursor-pointer' : '' }}" 
            @if ($showCheckbox && ! $isEditable) @click="typeof toggle === 'function' ? toggle('{{ $itemId }}') : null" @endif
        >
            {{-- Normal View --}}
            <div 
                x-show="!editing"
                @if ($isEditable) @dblclick="startEdit()" @endif
                class="flex items-center gap-1.5 min-w-0"
            >
                <div class="min-w-0 flex-1">
                    <span 
                        data-todo-title
                        class="text-sm font-medium transition-all duration-150 truncate block {{ $isCompleted ? 'line-through text-muted-foreground/80' : 'text-foreground' }}"
                    >
                        {{ $title ?: $slot }}
                    </span>

                    @if ($description)
                        <p data-todo-description class="text-xs text-muted-foreground truncate mt-0.5">
                            {{ $description }}
                        </p>
                    @endif
                </div>

                @if ($isEditable)
                    <button 
                        type="button" 
                        @click.stop="startEdit()" 
                        title="Ubah judul tugas"
                        aria-label="Ubah judul tugas"
                        class="hidden group-hover/content:inline-flex p-1 rounded-md text-muted-foreground/60 hover:text-foreground hover:bg-muted/80 transition-all shrink-0 cursor-pointer"
                    >
                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 20h9"/>
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                        </svg>
                    </button>
                @endif
            </div>

            {{-- Inline Edit Form --}}
            @if ($isEditable)
                <div 
                    x-show="editing" 
                    x-cloak
                    @click.stop 
                    @mousedown.stop 
                    @dragstart.stop.prevent
                    class="flex flex-col gap-1.5 w-full pt-0.5"
                >
                    <input 
                        x-ref="titleInput"
                        type="text" 
                        x-model="editTitle" 
                        @keydown.enter.prevent="saveEdit()" 
                        @keydown.escape.prevent="cancelEdit()" 
                        class="text-sm font-medium bg-background border border-primary/50 focus:border-primary focus:ring-2 focus:ring-primary/20 rounded-lg px-2.5 py-1 w-full outline-none shadow-xs text-foreground transition-all"
                        placeholder="Judul tugas..."
                    />
                    <div class="flex items-center gap-1.5">
                        <button 
                            type="button" 
                            @click.stop="saveEdit()" 
                            class="px-2.5 py-1 text-xs font-semibold rounded-md bg-primary text-primary-foreground hover:bg-primary/90 transition-all cursor-pointer shadow-xs active:scale-95"
                        >
                            Simpan
                        </button>
                        <button 
                            type="button" 
                            @click.stop="cancelEdit()" 
                            class="px-2.5 py-1 text-xs font-medium rounded-md hover:bg-muted text-muted-foreground hover:text-foreground transition-all cursor-pointer"
                        >
                            Batal (Esc)
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Right: Metadata (Labels, Due Date, Assignees) & Action Buttons --}}
    <div class="flex items-center gap-2 shrink-0">
        {{-- Labels / Tags (Slot, Array, or single Badge fallback) --}}
        @if ($hasLabelsSlot)
            <div class="flex items-center gap-1">
                {{ $labels }}
            </div>
        @elseif (!empty($resolvedLabels))
            <div class="flex items-center gap-1">
                @foreach ($resolvedLabels as $lbl)
                    @php
                        $lblText = is_array($lbl) ? ($lbl['text'] ?? $lbl['label'] ?? '') : (string) $lbl;
                        $lblVariant = is_array($lbl) ? ($lbl['variant'] ?? 'default') : 'default';
                    @endphp
                    @if ($lblText)
                        <vibe:badge size="xs" :variant="$lblVariant" class="font-medium">
                            {{ $lblText }}
                        </vibe:badge>
                    @endif
                @endforeach
            </div>
        @elseif ($badge)
            <vibe:badge size="xs" :variant="$badgeVariant" class="font-medium">
                {{ $badge }}
            </vibe:badge>
        @endif

        {{-- Smart Due Date with Urgency Styling --}}
        @if ($dueDate)
            <span title="{{ $dueDateTooltip }}" class="inline-flex items-center gap-1 text-[11px] px-2 py-0.5 rounded-md transition-colors {{ $dueDateClasses }}">
                <svg class="size-3 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                    <line x1="16" x2="16" y1="2" y2="6"/>
                    <line x1="8" x2="8" y1="2" y2="6"/>
                    <line x1="3" x2="21" y1="10" y2="10"/>
                </svg>
                {{ $dueDate }}
            </span>
        @endif

        {{-- Subtasks Mini Counter Badge --}}
        <span 
            x-show="subtasksCount > 0" 
            title="Subtugas selesai"
            class="inline-flex items-center gap-1 text-[11px] text-muted-foreground bg-muted/60 px-1.5 py-0.5 rounded-md font-mono"
        >
            <svg class="size-3 text-muted-foreground/80 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 11 3 3L22 4"/>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
            </svg>
            <span x-text="completedSubtasksCount + '/' + subtasksCount"></span>
        </span>

        {{-- Assignee Avatar / Avatar Stack --}}
        @if ($hasAssigneeSlot)
            <div class="flex items-center">
                {{ $assignee }}
            </div>
        @elseif (!empty($resolvedAssignees))
            @if (count($resolvedAssignees) > 1)
                <vibe:avatar.group size="xs" :limit="3">
                    @foreach ($resolvedAssignees as $asg)
                        @php
                            $asgName = is_array($asg) ? ($asg['name'] ?? null) : (string) $asg;
                            $asgSrc = is_array($asg) ? ($asg['src'] ?? $asg['avatar'] ?? null) : (filter_var($asg, FILTER_VALIDATE_URL) ? $asg : null);
                        @endphp
                        <vibe:avatar size="xs" :name="$asgName" :src="$asgSrc" />
                    @endforeach
                </vibe:avatar.group>
            @else
                @php
                    $singleAsg = $resolvedAssignees[0];
                    $asgName = is_array($singleAsg) ? ($singleAsg['name'] ?? null) : (string) $singleAsg;
                    $asgSrc = is_array($singleAsg) ? ($singleAsg['src'] ?? $singleAsg['avatar'] ?? null) : (filter_var($singleAsg, FILTER_VALIDATE_URL) ? $singleAsg : null);
                @endphp
                <vibe:avatar size="xs" :name="$asgName" :src="$asgSrc" />
            @endif
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

    {{-- Subtasks / Checklist Mini --}}
    @if ($hasAnySubtasks)
        <div x-show="subtasksCount > 0" class="w-full mt-2.5 pt-2 border-t border-border/40 space-y-1.5">
            {{-- Slim Visual Progress Bar --}}
            <div class="w-full bg-muted/70 rounded-full h-1 overflow-hidden">
                <div 
                    class="bg-primary h-full transition-all duration-300 rounded-full" 
                    :style="'width: ' + (subtasksCount > 0 ? Math.round((completedSubtasksCount / subtasksCount) * 100) : 0) + '%'"
                ></div>
            </div>

            {{-- Subtasks List --}}
            <div class="space-y-0.5">
                @if ($hasSubtasksInSlot)
                    {{ $slot }}
                @endif
                @if (!empty($resolvedSubtasks))
                    @foreach ($resolvedSubtasks as $sub)
                        <vibe:todo.subtask 
                            :id="$sub['id'] ?? null" 
                            :title="$sub['title'] ?? ''" 
                            :completed="$sub['completed'] ?? false" 
                        />
                    @endforeach
                @endif
            </div>
        </div>
    @endif
</div>
