@blaze(fold: true)

@props([
    'id' => null,
    'title' => '',
    'completed' => false,
    'disabled' => false,
])

@php
    $subtaskId = $id ?? uniqid('subtask-');
    $isCompleted = filter_var($completed, FILTER_VALIDATE_BOOLEAN);
@endphp

<div
    data-todo-subtask="{{ $subtaskId }}"
    data-subtask-id="{{ $subtaskId }}"
    data-completed="{{ $isCompleted ? 'true' : 'false' }}"
    x-data="{
        subtaskId: '{{ $subtaskId }}',
        completed: {{ $isCompleted ? 'true' : 'false' }},
        toggle() {
            if ({{ $disabled ? 'true' : 'false' }}) return;
            this.completed = !this.completed;
            this.$el.dataset.completed = this.completed ? 'true' : 'false';
            this.$dispatch('vibe:todo-subtask-toggle', {
                subtaskId: this.subtaskId,
                completed: this.completed
            });
        }
    }"
    :data-completed="completed ? 'true' : 'false'"
    @click.stop="toggle()"
    class="group/subtask flex items-center gap-2 py-1 px-1.5 rounded-lg hover:bg-muted/40 transition-colors cursor-pointer select-none text-xs"
>
    {{-- Checkbox button --}}
    <button
        type="button"
        @click.stop="toggle()"
        :class="completed ? 'bg-primary border-primary text-primary-foreground' : 'border-border bg-background hover:border-primary/60'"
        class="size-3.5 rounded border flex items-center justify-center transition-all shrink-0 cursor-pointer focus:outline-none"
        aria-label="Toggle subtask"
    >
        <svg x-show="completed" class="size-2.5 stroke-current stroke-[3]" viewBox="0 0 24 24" fill="none">
            <polyline points="20 6 9 17 4 12" />
        </svg>
    </button>

    {{-- Title / Content --}}
    <span
        :class="completed ? 'line-through text-muted-foreground/60' : 'text-foreground/90'"
        class="truncate transition-all duration-150 flex-1"
    >
        {{ $title ?: $slot }}
    </span>
</div>
