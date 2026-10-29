@blaze

@aware([
    'layout' => 'list',
    'checkbox' => null,
    'checkable' => null,
    'navButtons' => false,
    'lock' => false,
    'locked' => false,
    'lockable' => false,
    'editable' => false,
    'wireUpdate' => null,
    'updateUrl' => null,
])

@props([
    'id' => null,
    'title' => null,
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
    'variant' => 'default', // 'default', 'card', 'flat', 'outline'
    'navButtons' => null, // null = inherit dari parent @aware
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
    $showNavButtons = $navButtons !== null ? (bool) $navButtons : false;

    // lock: per-item prop overrides parent @aware value.
    $itemLockProp = $attributes->has('lock') 
        ? filter_var($attributes->get('lock'), FILTER_VALIDATE_BOOLEAN) 
        : ($attributes->has('locked') 
            ? filter_var($attributes->get('locked'), FILTER_VALIDATE_BOOLEAN) 
            : (bool) ($lock || $locked));
    $isLocked = $itemLockProp;

    // lockable: per-item prop overrides parent @aware value
    $isLockable = $attributes->has('lockable')
        ? filter_var($attributes->get('lockable'), FILTER_VALIDATE_BOOLEAN)
        : (bool) $lockable;

    // editable: per-item prop overrides parent @aware value
    $isEditable = $attributes->has('editable')
        ? filter_var($attributes->get('editable'), FILTER_VALIDATE_BOOLEAN)
        : (bool) $editable;

    // Detect if custom slots were provided
    $hasLabelsSlot = isset($labels) && ($labels instanceof \Illuminate\Contracts\Support\Htmlable || $labels instanceof \Illuminate\View\ComponentSlot) && !empty((string) $labels);
    $hasContentSlot = isset($content) && ($content instanceof \Illuminate\Contracts\Support\Htmlable || $content instanceof \Illuminate\View\ComponentSlot) && !empty(trim((string) $content));
    $hasActionsSlot = isset($actions) && ($actions instanceof \Illuminate\Contracts\Support\Htmlable || $actions instanceof \Illuminate\View\ComponentSlot) && !empty(trim((string) $actions));

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
    $rawAssignees = $assignees ?? $assignee;
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
        'overdue' => 'text-destructive bg-destructive/10 border-destructive/25 font-semibold',
        'today' => 'text-amber-600 dark:text-amber-400 bg-amber-500/10 border-amber-500/25 font-semibold',
        default => '',
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

    $cursorClass = ($reorderable && ! $isLocked) ? 'cursor-grab active:cursor-grabbing' : '';

    $hasMetaBadges = !empty($badge) || !empty($dueDate) || !empty($resolvedLabels) || !empty($resolvedAssignees) || $hasLabelsSlot;

    $rawSlotString = isset($slot) ? trim((string) $slot) : '';
    $hasRawSlot = !empty($rawSlotString);
    $hasHeaderSubcomponent = str_contains($rawSlotString, 'data-todo-header');
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
    {{ $attributes->twMerge(['class' => "group relative flex flex-col justify-center gap-0 p-3 sm:p-3.5 rounded-xl transition-all duration-150 select-none {$cardStyles} {$cursorClass}"]) }}
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

    {{-- Card Main Body --}}
    <div class="flex @if($showCheckbox) items-start gap-3 @else flex-col @endif w-full min-w-0">
        {{-- Custom Accessible Checkbox --}}
        @if ($showCheckbox)
            <button
                type="button"
                draggable="false"
                role="checkbox"
                aria-checked="{{ $isCompleted ? 'true' : 'false' }}"
                @click.stop="typeof toggle === 'function' ? toggle('{{ $itemId }}') : null"
                class="shrink-0 mt-0.5 flex items-center justify-center size-5 rounded-md border transition-all duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/40 cursor-pointer"
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

        {{-- Card Content Slot & Backward Compatible Content --}}
        <div class="flex-1 min-w-0 space-y-2 w-full">
            {{-- Prop-based Title & Description Layout with Flex Header and Inline Actions --}}
            @if (!empty($title))
                <div class="flex items-start justify-between gap-2 w-full">
                    <div class="flex-1 min-w-0 space-y-1">
                        <vibe:todo.title :editable="$isEditable" :completed="$isCompleted">
                            {{ $title }}
                        </vibe:todo.title>

                        @if (!empty($description))
                            <vibe:todo.description :editable="$isEditable">
                                {{ $description }}
                            </vibe:todo.description>
                        @endif
                    </div>

                    {{-- Actions: Lock indicator/button & Delete Button --}}
                    <div class="flex items-center gap-1 shrink-0 pt-0.5">
                        @if ($isLockable)
                            <button
                                type="button"
                                draggable="false"
                                data-todo-lock-btn
                                aria-pressed="{{ $isLocked ? 'true' : 'false' }}"
                                aria-label="{{ $isLocked ? 'Buka kunci kartu' : 'Kunci kartu' }}"
                                title="{{ $isLocked ? 'Buka kunci kartu' : 'Kunci kartu' }}"
                                @click.stop="typeof toggleLock === 'function' ? toggleLock('{{ $itemId }}') : null"
                                class="p-1 rounded-md transition-all cursor-pointer flex items-center justify-center {{ $isLocked ? 'text-amber-500 dark:text-amber-400' : 'text-muted-foreground opacity-0 group-hover:opacity-100 focus:opacity-100 hover:text-foreground hover:bg-muted' }}"
                            >
                                <svg data-lock-icon-locked class="size-3.5 {{ $isLocked ? '' : 'hidden' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                                <svg data-lock-icon-unlocked class="size-3.5 {{ $isLocked ? 'hidden' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 9.9-1"/>
                                </svg>
                            </button>
                        @elseif ($isLocked)
                            <div data-todo-lock-indicator class="inline-flex items-center text-muted-foreground/60 p-1" aria-label="Terkunci" title="Terkunci (tidak dapat dipindah)">
                                <svg class="size-3.5 select-none pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </div>
                        @endif

                        @if ($deletable)
                            <button
                                type="button"
                                draggable="false"
                                aria-label="Hapus tugas"
                                title="Hapus tugas"
                                @click.stop="typeof remove === 'function' ? remove('{{ $itemId }}') : null"
                                class="opacity-0 group-hover:opacity-100 focus:opacity-100 p-1 rounded-md text-muted-foreground hover:text-destructive hover:bg-destructive/10 transition-opacity cursor-pointer flex items-center justify-center"
                            >
                                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"/>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            @elseif (! $hasHeaderSubcomponent && ($deletable || $isLocked || $isLockable))
                {{-- Fallback Header Actions for slot without <vibe:todo.header> --}}
                <div class="flex items-center justify-end gap-1 w-full pb-0.5">
                    @if ($isLockable)
                        <button
                            type="button"
                            draggable="false"
                            data-todo-lock-btn
                            aria-pressed="{{ $isLocked ? 'true' : 'false' }}"
                            aria-label="{{ $isLocked ? 'Buka kunci kartu' : 'Kunci kartu' }}"
                            title="{{ $isLocked ? 'Buka kunci kartu' : 'Kunci kartu' }}"
                            @click.stop="typeof toggleLock === 'function' ? toggleLock('{{ $itemId }}') : null"
                            class="p-1 rounded-md transition-all cursor-pointer flex items-center justify-center {{ $isLocked ? 'text-amber-500 dark:text-amber-400' : 'text-muted-foreground opacity-0 group-hover:opacity-100 focus:opacity-100 hover:text-foreground hover:bg-muted' }}"
                        >
                            <svg data-lock-icon-locked class="size-3.5 {{ $isLocked ? '' : 'hidden' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <svg data-lock-icon-unlocked class="size-3.5 {{ $isLocked ? 'hidden' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 9.9-1"/>
                            </svg>
                        </button>
                    @elseif ($isLocked)
                        <div data-todo-lock-indicator class="inline-flex items-center text-muted-foreground/60 p-1" aria-label="Terkunci" title="Terkunci (tidak dapat dipindah)">
                            <svg class="size-3.5 select-none pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </div>
                    @endif

                    @if ($deletable)
                            <button
                                type="button"
                                draggable="false"
                                aria-label="Hapus tugas"
                                title="Hapus tugas"
                                @click.stop="typeof remove === 'function' ? remove('{{ $itemId }}') : null"
                                class="opacity-0 group-hover:opacity-100 focus:opacity-100 p-1 rounded-md text-muted-foreground hover:text-destructive hover:bg-destructive/10 transition-opacity cursor-pointer flex items-center justify-center"
                            >
                                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"/>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                </svg>
                            </button>
                        @endif
                    </div>
            @endif

            {{-- Metadata Badges (badge, dueDate, labels, assignees) and Board Column Nav Buttons --}}
            @if ($hasMetaBadges || ($isBoard && $showNavButtons && ! $isLocked))
                <div class="flex items-center justify-between gap-2 text-xs pt-0.5 w-full">
                    <div class="flex items-center gap-1.5 flex-wrap flex-1 min-w-0">
                        @if ($hasLabelsSlot)
                            {{ $labels }}
                        @endif

                        @if (!empty($badge))
                            <vibe:badge :variant="$badgeVariant" size="sm">{{ $badge }}</vibe:badge>
                        @endif

                        @if (!empty($dueDate))
                            <vibe:badge variant="outline" size="sm" class="{{ $dueDateClasses }}" title="{{ $dueDateTooltip }}">
                                <x-slot:icon>
                                    <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </x-slot:icon>
                                {{ $dueDate }}
                            </vibe:badge>
                        @endif

                        @foreach ($resolvedLabels as $lbl)
                            @php
                                $lblText = is_array($lbl) ? ($lbl['text'] ?? $lbl['name'] ?? '') : (string) $lbl;
                                $lblVariant = is_array($lbl) ? ($lbl['variant'] ?? 'outline') : 'outline';
                            @endphp
                            <vibe:badge :variant="$lblVariant" size="sm" class="text-[10px]">{{ $lblText }}</vibe:badge>
                        @endforeach

                        @if (!empty($resolvedAssignees))
                            <vibe:avatar.group size="xs" :limit="3">
                                @foreach ($resolvedAssignees as $asg)
                                    <vibe:avatar size="xs" :name="is_array($asg) ? ($asg['name'] ?? null) : (string) $asg" />
                                @endforeach
                            </vibe:avatar.group>
                        @endif
                    </div>

                    {{-- Board Column Navigation Buttons (< >) in Document Flow --}}
                    @if ($isBoard && $showNavButtons && ! $isLocked)
                        <div 
                            class="flex items-center gap-1 shrink-0 ml-auto"
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
                </div>
            @endif

            {{-- Backward-compatible subtasks array prop if passed --}}
            @if (!empty($resolvedSubtasks))
                <div class="space-y-1 pt-1">
                    @foreach ($resolvedSubtasks as $st)
                        <vibe:todo.subtask :id="$st['id'] ?? null" :completed="$st['completed'] ?? false">
                            {{ $st['title'] ?? '' }}
                        </vibe:todo.subtask>
                    @endforeach
                </div>
            @endif

            {{-- Explicit content slot --}}
            @if ($hasContentSlot)
                <div data-todo-custom-content class="w-full">
                    {{ $content }}
                </div>
            @endif

            {{-- Default slot (when no content slot was passed) --}}
            @if ($hasRawSlot)
                <div data-todo-custom-content class="w-full space-y-2">
                    {{ $slot }}
                </div>
            @endif
        </div>
    </div>

    {{-- Actions Slot --}}
    @if ($hasActionsSlot)
        <div data-todo-actions class="w-full mt-2.5 pt-2 border-t border-border/40 flex items-center justify-end gap-2">
            {{ $actions }}
        </div>
    @endif
</div>
