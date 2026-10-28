@blaze(fold: true)
 
@aware([
    'layout' => 'board',
    'navButtons' => false,
    'dragHandle' => null,
    'dragIndicator' => null,
    'handle' => null,
    'lock' => false,
    'locked' => false,
    'editable' => false,
    'quickAdd' => false,
    'wireUpdate' => null,
    'updateUrl' => null,
])

@props([
    'name' => 'default',
    'title' => null,
    'count' => null,
    'color' => 'default',
    'emptyText' => 'Tarik tugas ke sini',
    'lock' => null,
    'locked' => null,
    'quickAdd' => null,
    'quickAddText' => 'Tambah Tugas',
    'max' => null,
    'wipLimit' => null,
    'wip' => null,
    'collapsible' => false,
    'collapsed' => false,
])

@php
    $accentColor = match ($color) {
        'amber', 'warning' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-500/20',
        'blue', 'primary' => 'bg-primary/10 text-primary border-primary/20',
        'emerald', 'success' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/20',
        'purple' => 'bg-purple-500/10 text-purple-600 dark:text-purple-400 border-purple-500/20',
        default => 'bg-muted text-muted-foreground border-border',
    };

    $resolvedMax = $max !== null ? (int) $max : ($wipLimit !== null ? (int) $wipLimit : ($wip !== null ? (int) $wip : null));
    $showQuickAdd = $quickAdd !== null ? (bool) $quickAdd : false;
    $isCollapsible = filter_var($collapsible, FILTER_VALIDATE_BOOLEAN);
    $isCollapsed = filter_var($collapsed, FILTER_VALIDATE_BOOLEAN);
@endphp

<div
    data-todo-group="{{ $name }}"
    @if ($lock || $locked) data-locked="true" @endif
    @if ($resolvedMax !== null) data-wip-max="{{ $resolvedMax }}" @endif
    @dragover.prevent.stop="typeof onDragOverGroup === 'function' ? onDragOverGroup('{{ $name }}', $event) : null"
    @dragleave="typeof onDragLeaveGroup === 'function' ? onDragLeaveGroup('{{ $name }}', $event) : null"
    @drop.prevent.stop="typeof onDropGroup === 'function' ? onDropGroup('{{ $name }}', $event) : null"
    x-data="{
        isCollapsed: {{ $isCollapsed ? 'true' : 'false' }},
        isCollapsible: {{ $isCollapsible ? 'true' : 'false' }},
        addingTask: false,
        newTaskTitle: '',
        wipMax: {{ $resolvedMax !== null ? $resolvedMax : 'null' }},
        getLiveCount() {
            return typeof getGroupCount === 'function' ? getGroupCount('{{ $name }}') : {{ (int) ($count ?? 0) }};
        },
        isOverWip() {
            if (this.wipMax === null) return false;
            return this.getLiveCount() > this.wipMax;
        }
    }"
    {{ $attributes->twMerge(['class' => 'flex flex-col flex-1 rounded-2xl bg-muted/30 dark:bg-muted/10 border border-border/60 transition-all duration-200']) }}
    :class="{
        'ring-2 ring-primary/50 bg-primary/5 border-primary/40': (typeof dragOverGroup !== 'undefined' && dragOverGroup === '{{ $name }}'),
        'border-destructive/60 bg-destructive/5': isOverWip(),
        'min-w-14 max-w-14 p-2': isCollapsed,
        'min-w-[280px] max-w-full p-3 sm:p-4': !isCollapsed
    }"
>
    {{-- Collapsed Ribbon View --}}
    <div x-show="isCollapsed" class="flex flex-col items-center justify-between h-full min-h-60 py-2 cursor-pointer select-none" @click="isCollapsed = false">
        <button
            type="button"
            @click.stop="isCollapsed = false"
            class="p-1 rounded-md text-muted-foreground hover:text-foreground hover:bg-muted/60 transition-colors"
            title="Buka kolom {{ $title }}"
        >
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </button>

        <span class="text-xs font-semibold text-foreground tracking-wider uppercase [writing-mode:vertical-rl] rotate-180 my-4">
            {{ $title }}
        </span>

        <span 
            class="text-[11px] px-1.5 py-0.5 rounded-full font-medium border"
            :class="isOverWip() ? 'text-destructive bg-destructive/10 border-destructive/30' : '{{ $accentColor }}'"
            x-text="getLiveCount()"
        >
            {{ $count ?? 0 }}
        </span>
    </div>

    {{-- Expanded Normal View --}}
    <div x-show="!isCollapsed" class="flex flex-col flex-1 h-full min-w-0">
        {{-- Group Header --}}
        @if ($title || isset($header) || $isCollapsible)
            <div class="flex items-center justify-between mb-3 px-1">
                <div class="flex items-center gap-2 min-w-0">
                    <h3 class="text-sm font-semibold text-foreground tracking-tight truncate">
                        {{ $title }}
                    </h3>

                    @if ($count !== null || $resolvedMax !== null)
                        <span 
                            class="text-xs px-2 py-0.5 rounded-full font-medium border transition-all duration-150"
                            :class="isOverWip() ? 'text-destructive bg-destructive/10 border-destructive/30 font-semibold ring-1 ring-destructive/40' : '{{ $accentColor }}'"
                            :title="wipMax !== null ? ('Batas WIP: ' + wipMax) : ''"
                            x-text="getLiveCount() + (wipMax !== null ? ('/' + wipMax) : '')"
                        >
                            {{ $count ?? 0 }}{{ $resolvedMax !== null ? '/' . $resolvedMax : '' }}
                        </span>
                    @endif
                </div>

                <div class="flex items-center gap-1">
                    @if (isset($header))
                        <div>{{ $header }}</div>
                    @endif

                    @if ($isCollapsible)
                        <button
                            type="button"
                            @click.stop="isCollapsed = true"
                            class="p-1 rounded-md text-muted-foreground/60 hover:text-foreground hover:bg-muted/50 transition-colors cursor-pointer"
                            title="Lipat kolom"
                        >
                            <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="15 18 9 12 15 6"/>
                            </svg>
                        </button>
                    @endif
                </div>
            </div>
        @endif

        {{-- Items Container --}}
        <div 
            data-todo-group-items="{{ $name }}"
            @dragover.prevent.stop="typeof onDragOverGroup === 'function' ? onDragOverGroup('{{ $name }}', $event) : null"
            @drop.prevent.stop="typeof onDropGroup === 'function' ? onDropGroup('{{ $name }}', $event) : null"
            class="flex flex-col gap-2.5 min-h-35 flex-1 rounded-xl transition-all p-1"
            :class="{ 'bg-primary/5 border-2 border-dashed border-primary/40': (typeof dragOverGroup !== 'undefined' && dragOverGroup === '{{ $name }}') }"
        >
            {{ $slot }}

            {{-- Empty Zone Placeholder --}}
            <div 
                data-todo-empty-placeholder
                x-show="typeof getGroupCount === 'function' && getGroupCount('{{ $name }}') === 0"
                class="flex flex-1 items-center justify-center p-6 rounded-xl border border-dashed border-border/70 text-xs text-muted-foreground/60 select-none pointer-events-none text-center min-h-25"
                x-cloak
            >
                {{ $emptyText }}
            </div>
        </div>

        {{-- Quick Add per Column --}}
        @if ($showQuickAdd)
            <div class="mt-2 pt-1 border-t border-border/40">
                <button
                    x-show="!addingTask"
                    type="button"
                    @click.stop="addingTask = true; $nextTick(() => { const el = $refs.quickAddInput; if (el) el.focus(); })"
                    class="w-full flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-xl border border-dashed border-border/80 text-xs font-medium text-muted-foreground hover:text-foreground hover:bg-muted/50 hover:border-border transition-all cursor-pointer"
                >
                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    <span>{{ $quickAddText }}</span>
                </button>

                {{-- Quick Add Input Inline Form --}}
                <div 
                    x-show="addingTask" 
                    @click.stop 
                    class="p-2.5 rounded-xl border border-border bg-card shadow-xs space-y-2"
                >
                    <input
                        x-ref="quickAddInput"
                        x-model="newTaskTitle"
                        type="text"
                        placeholder="Judul tugas baru..."
                        @keydown.enter.prevent="if (newTaskTitle.trim()) { if (typeof add === 'function') { add(newTaskTitle.trim(), '{{ $name }}'); } else { $dispatch('vibe:todo-add', { title: newTaskTitle.trim(), group: '{{ $name }}' }); } newTaskTitle = ''; addingTask = false; }"
                        @keydown.escape.prevent="addingTask = false; newTaskTitle = '';"
                        class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-input bg-background text-foreground focus:outline-none focus:ring-1 focus:ring-primary"
                    />
                    <div class="flex items-center gap-1.5">
                        <button
                            type="button"
                            @click.stop="if (newTaskTitle.trim()) { if (typeof add === 'function') { add(newTaskTitle.trim(), '{{ $name }}'); } else { $dispatch('vibe:todo-add', { title: newTaskTitle.trim(), group: '{{ $name }}' }); } newTaskTitle = ''; addingTask = false; }"
                            class="px-2.5 py-1 text-xs font-medium rounded-md bg-primary text-primary-foreground hover:bg-primary/90 transition-all cursor-pointer"
                        >
                            Tambah
                        </button>
                        <button
                            type="button"
                            @click.stop="addingTask = false; newTaskTitle = '';"
                            class="px-2.5 py-1 text-xs font-medium rounded-md hover:bg-muted text-muted-foreground hover:text-foreground transition-all cursor-pointer"
                        >
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
