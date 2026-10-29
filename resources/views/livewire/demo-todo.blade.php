<div class="space-y-4 w-full">
    {{-- Quick Add Input --}}
    <vibe:todo.input 
        placeholder="Tulis tugas baru lalu tekan Enter..." 
        button-text="Tambah Tugas" 
    />

    {{-- Realtime Livewire Kanban Board --}}
    <vibe:todo 
        mode="livewire"
        layout="board"
        :editable="true"
        wire-reorder="updateTaskOrder"
        wire-toggle="toggleTask"
        wire-delete="deleteTask"
        wire-add="addTask"
        wire-update="updateTask"
    >
        <vibe:todo.group name="todo" title="To Do" :count="collect($tasks)->where('group', 'todo')->count()" color="blue">
            @foreach (collect($tasks)->where('group', 'todo')->sortBy('order') as $task)
                <vibe:todo.item
                    :id="$task['id']"
                    :title="$task['title']"
                    :description="$task['description']"
                    :completed="$task['completed']"
                    :badge="$task['badge']"
                    :badge-variant="$task['badgeVariant']"
                    :due-date="$task['dueDate']"
                    :order="$task['order']"
                    group="todo"
                    wire:key="livewire-todo-{{ $task['id'] }}"
                />
            @endforeach
        </vibe:todo.group>

        <vibe:todo.group name="progress" title="In Progress" :count="collect($tasks)->where('group', 'progress')->count()" color="amber">
            @foreach (collect($tasks)->where('group', 'progress')->sortBy('order') as $task)
                <vibe:todo.item
                    :id="$task['id']"
                    :title="$task['title']"
                    :description="$task['description']"
                    :completed="$task['completed']"
                    :badge="$task['badge']"
                    :badge-variant="$task['badgeVariant']"
                    :due-date="$task['dueDate']"
                    :order="$task['order']"
                    group="progress"
                    wire:key="livewire-todo-{{ $task['id'] }}"
                />
            @endforeach
        </vibe:todo.group>

        <vibe:todo.group name="done" title="Done" :count="collect($tasks)->where('group', 'done')->count()" color="emerald">
            @foreach (collect($tasks)->where('group', 'done')->sortBy('order') as $task)
                <vibe:todo.item
                    :id="$task['id']"
                    :title="$task['title']"
                    :description="$task['description']"
                    :completed="$task['completed']"
                    :badge="$task['badge']"
                    :badge-variant="$task['badgeVariant']"
                    :due-date="$task['dueDate']"
                    :order="$task['order']"
                    group="done"
                    wire:key="livewire-todo-{{ $task['id'] }}"
                />
            @endforeach
        </vibe:todo.group>
    </vibe:todo>
</div>
