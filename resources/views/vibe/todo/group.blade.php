@blaze(fold: true)
 
@aware([
    'layout' => 'board',
    'navButtons' => false,
])

@props([
    'name' => 'default',
    'title' => null,
    'count' => null,
    'color' => 'default',
    'emptyText' => 'Tarik tugas ke sini',
])

@php
    $accentColor = match ($color) {
        'amber', 'warning' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-500/20',
        'blue', 'primary' => 'bg-primary/10 text-primary border-primary/20',
        'emerald', 'success' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/20',
        'purple' => 'bg-purple-500/10 text-purple-600 dark:text-purple-400 border-purple-500/20',
        default => 'bg-muted text-muted-foreground border-border',
    };
@endphp

<div
    data-todo-group="{{ $name }}"
    @dragover.prevent.stop="typeof onDragOverGroup === 'function' ? onDragOverGroup('{{ $name }}', $event) : null"
    @dragleave="typeof onDragLeaveGroup === 'function' ? onDragLeaveGroup('{{ $name }}', $event) : null"
    @drop.prevent.stop="typeof onDropGroup === 'function' ? onDropGroup('{{ $name }}', $event) : null"
    {{ $attributes->twMerge(['class' => 'flex flex-col flex-1 min-w-[280px] max-w-full rounded-2xl bg-muted/30 dark:bg-muted/10 border border-border/60 p-3 sm:p-4 transition-all duration-150']) }}
    :class="{ 'ring-2 ring-primary/50 bg-primary/5 border-primary/40': (typeof dragOverGroup !== 'undefined' && dragOverGroup === '{{ $name }}') }"
>
    {{-- Group Header --}}
    @if ($title || isset($header))
        <div class="flex items-center justify-between mb-3 px-1">
            <div class="flex items-center gap-2">
                <h3 class="text-sm font-semibold text-foreground tracking-tight">
                    {{ $title }}
                </h3>

                @if ($count !== null)
                    <span 
                        class="text-xs px-2 py-0.5 rounded-full font-medium border transition-all duration-150 {{ $accentColor }}"
                        x-text="typeof getGroupCount === 'function' ? getGroupCount('{{ $name }}') : {{ (int) $count }}"
                    >
                        {{ $count }}
                    </span>
                @endif
            </div>

            @if (isset($header))
                <div>{{ $header }}</div>
            @endif
        </div>
    @endif

    {{-- Items Container --}}
    <div 
        data-todo-group-items="{{ $name }}"
        @dragover.prevent.stop="typeof onDragOverGroup === 'function' ? onDragOverGroup('{{ $name }}', $event) : null"
        @drop.prevent.stop="typeof onDropGroup === 'function' ? onDropGroup('{{ $name }}', $event) : null"
        class="flex flex-col gap-2.5 min-h-35 h-full rounded-xl transition-all p-1"
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
</div>
