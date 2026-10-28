<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/todo.title')" :description="__('docs/todo.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/todo.title'), 'url' => '/docs/todo']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/todo.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/todo.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/todo.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/todo.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">mode="livewire / api / form / local"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">layout="board / list"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:checkbox="false / true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:lock="false / true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:editable="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:quick-add="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:searchable="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:max="5" (WIP)</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:collapsible="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">drag-handle="hover / visible / hidden"</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:todo.group&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:todo.item&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:todo.title&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:todo.description&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:todo.subtask&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:todo.input&gt;</vibe:badge>
                </div>
            </div>

            {{-- 1. Realtime Livewire 3 Kanban Board --}}
            <section id="livewire-realtime" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/todo.livewire.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/todo.livewire.desc') !!}
                    </p>
                </div>

                <div class="p-3.5 rounded-xl border border-primary/20 bg-primary/5 text-xs text-foreground flex items-center gap-3">
                    <svg class="size-5 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    <span>{!! __('docs/todo.livewire.tip') !!}</span>
                </div>

                @php
                    $snippetLivewire = <<<'BLADE'
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
        wire-reorder="updateTaskOrder"
        wire-toggle="toggleTask"
        wire-delete="deleteTask"
        wire-add="addTask"
    >
        {{-- Column 1: To Do --}}
        <vibe:todo.group name="todo" title="To Do" :count="$todoCount" color="blue">
            @foreach ($tasks->where('group', 'todo') as $task)
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
                    wire:key="todo-item-{{ $task['id'] }}"
                />
            @endforeach
        </vibe:todo.group>

        {{-- Column 2: In Progress --}}
        <vibe:todo.group name="progress" title="In Progress" :count="$progressCount" color="amber">
            @foreach ($tasks->where('group', 'progress') as $task)
                <vibe:todo.item
                    :id="$task['id']"
                    :title="$task['title']"
                    group="progress"
                    wire:key="todo-item-{{ $task['id'] }}"
                />
            @endforeach
        </vibe:todo.group>

        {{-- Column 3: Done --}}
        <vibe:todo.group name="done" title="Done" :count="$doneCount" color="emerald">
            @foreach ($tasks->where('group', 'done') as $task)
                <vibe:todo.item
                    :id="$task['id']"
                    :title="$task['title']"
                    group="done"
                    wire:key="todo-item-{{ $task['id'] }}"
                />
            @endforeach
        </vibe:todo.group>
    </vibe:todo>
</div>
BLADE;
                @endphp

                <vibe:preview :title="__('docs/todo.livewire.preview_title')" :code="$snippetLivewire" :center="false">
                    <livewire:demo-todo />
                </vibe:preview>
            </section>

            {{-- 2. REST API Mode Kanban Board --}}
            <section id="mode-rest-api" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/todo.api.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/todo.api.desc') !!}
                    </p>
                </div>

                @php
                    $snippetApi = <<<'BLADE'
<vibe:todo 
    mode="api"
    layout="board"
    reorder-url="/api/todos/reorder"
    toggle-url="/api/todos/{id}/toggle"
    delete-url="/api/todos/{id}"
>
    <vibe:todo.group name="review" title="Review & Pending" color="purple">
        <vibe:todo.item
            id="task-1"
            group="review"
            title="Konfigurasi API Endpoint & CSRF Token"
            badge="API"
            badge-variant="primary"
        />
    </vibe:todo.group>

    <vibe:todo.group name="deployed" title="Deployed to Production" color="emerald">
        <vibe:todo.item
            id="task-2"
            group="deployed"
            title="Asynchronous Delete Request"
            :completed="true"
        />
    </vibe:todo.group>
</vibe:todo>
BLADE;
                @endphp

                <vibe:preview :title="__('docs/todo.api.preview_title')" :code="$snippetApi" :center="false">
                    <div class="space-y-3 w-full">
                        <vibe:todo 
                            id="demo-api-todo"
                            mode="api"
                            layout="board"
                            reorder-url="/docs/todo-demo/reorder"
                            toggle-url="/docs/todo-demo/{id}/toggle"
                            delete-url="/docs/todo-demo/{id}"
                        >
                            {{-- Column 1: Backlog / Review --}}
                            <vibe:todo.group name="review" title="Review & Pending" count="2" color="purple">
                                <vibe:todo.item
                                    id="api-task-1"
                                    group="review"
                                    title="Konfigurasi API Endpoint & CSRF Token"
                                    description="Secara otomatis menyertakan header X-CSRF-TOKEN Laravel."
                                    :completed="false"
                                    badge="API"
                                    badge-variant="primary"
                                />
                                <vibe:todo.item
                                    id="api-task-2"
                                    group="review"
                                    title="Optimistic Reordering Handling"
                                    description="UI diperbarui seketika, jika API gagal otomatis rollback ke urutan awal."
                                    :completed="false"
                                    badge="Network"
                                    badge-variant="warning"
                                />
                            </vibe:todo.group>

                            {{-- Column 2: Deployed --}}
                            <vibe:todo.group name="deployed" title="Deployed to Production" count="1" color="emerald">
                                <vibe:todo.item
                                    id="api-task-3"
                                    group="deployed"
                                    title="Asynchronous Delete Request"
                                    description="Animasi fade-out lembut saat item dihapus dari server."
                                    :completed="true"
                                    badge="UX"
                                    badge-variant="outline"
                                />
                            </vibe:todo.group>
                        </vibe:todo>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Multi-Column Kanban Board with Navigation Buttons --}}
            <section id="kanban-board" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/todo.kanban.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/todo.kanban.desc') !!}
                    </p>
                </div>

                @php
                    $snippetKanban = <<<'BLADE'
<vibe:todo 
    id="project-kanban" 
    layout="board" 
    mode="local" 
    :persist="true"
    :nav-buttons="true"
>
    <vibe:todo.group name="backlog" title="To Do" color="blue">
        <vibe:todo.item id="t-1" group="backlog" title="Audit Performa Blade Component" />
    </vibe:todo.group>

    <vibe:todo.group name="progress" title="In Progress" color="amber">
        <vibe:todo.item id="t-2" group="progress" title="Desain Tema Dark Mode" />
    </vibe:todo.group>

    <vibe:todo.group name="done" title="Done" color="emerald">
        <vibe:todo.item id="t-3" group="done" title="Implementasi Anti-FOUC" :completed="true" />
    </vibe:todo.group>
</vibe:todo>
BLADE;
                @endphp

                <vibe:preview :title="__('docs/todo.kanban.preview_title')" :code="$snippetKanban" :center="false">
                    <div class="w-full space-y-3">
                        <div class="flex items-center justify-between pb-1">
                            <span class="text-xs text-muted-foreground flex items-center gap-1.5">
                                <svg class="size-3.5 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 16v-4" />
                                    <path d="M12 8h.01" />
                                </svg>
                                {{ __('docs/todo.kanban.hint') }}
                            </span>
                            <button 
                                type="button" 
                                @click="(window.VibeTodo ? window.VibeTodo.clear('demo-kanban-board') : null); localStorage.removeItem('vibe-todo-demo-kanban-board'); window.location.reload();" 
                                class="text-xs text-muted-foreground hover:text-foreground font-medium underline cursor-pointer"
                                title="{{ __('docs/todo.kanban.reset_btn') }}"
                            >
                                {{ __('docs/todo.kanban.reset_btn') }}
                            </button>
                        </div>

                        {{-- Kanban Board with :nav-buttons="true" explicitly enabled --}}
                        <vibe:todo id="demo-kanban-board" layout="board" mode="local" :persist="true" :nav-buttons="true">
                            {{-- Column 1: Backlog / To Do --}}
                            <vibe:todo.group name="backlog" title="To Do" count="2" color="blue">
                                <vibe:todo.item
                                    id="kb-1"
                                    group="backlog"
                                    title="Audit Performa Blade Component"
                                    badge="Core"
                                    badge-variant="primary"
                                    due-date="Hari Ini"
                                />
                                <vibe:todo.item
                                    id="kb-2"
                                    group="backlog"
                                    title="Optimasi Touch Event untuk Layar Sentuh"
                                    badge="Mobile"
                                    badge-variant="warning"
                                    due-date="Besok"
                                />
                            </vibe:todo.group>

                            {{-- Column 2: In Progress --}}
                            <vibe:todo.group name="progress" title="In Progress" count="2" color="amber">
                                <vibe:todo.item
                                    id="kb-3"
                                    group="progress"
                                    title="Pengujian Integrasi REST API & Mock"
                                    badge="QA"
                                    badge-variant="outline"
                                    due-date="29 Okt"
                                />
                                <vibe:todo.item
                                    id="kb-4"
                                    group="progress"
                                    title="Desain Tema Dark Mode Kontras Tinggi"
                                    badge="UI"
                                    badge-variant="primary"
                                    due-date="30 Okt"
                                />
                            </vibe:todo.group>

                            {{-- Column 3: Completed / Done --}}
                            <vibe:todo.group name="done" title="Done" count="1" color="emerald">
                                <vibe:todo.item
                                    id="kb-5"
                                    group="done"
                                    title="Implementasi Anti-FOUC Blueprint"
                                    :completed="true"
                                    badge="Done"
                                    badge-variant="default"
                                    due-date="Selesai"
                                />
                            </vibe:todo.group>
                        </vibe:todo>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Form Submit Mode (THE ONLY NON-KANBAN DEMO) --}}
            <section id="form-submit" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/todo.form.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/todo.form.desc') !!}
                    </p>
                </div>

                @php
                    $snippetForm = <<<'BLADE'
<form method="POST" action="{{ route('tasks.batch') }}">
    @csrf
    <vibe:todo mode="form" layout="list" name="batch_tasks">
        @foreach ($items as $item)
            <vibe:todo.item 
                :id="$item->id" 
                :title="$item->title" 
                :order="$loop->index" 
            />
        @endforeach
    </vibe:todo>

    <vibe:button type="submit" class="mt-4 rounded-xl">
        Simpan Perubahan
    </vibe:button>
</form>
BLADE;
                @endphp

                <vibe:preview :title="__('docs/todo.form.preview_title')" :code="$snippetForm" :center="false">
                    <form 
                        method="POST" 
                        action="#" 
                        @submit.prevent="alert('{{ __('docs/todo.form.alert_submitted') }}')" 
                        class="space-y-4 w-full"
                    >
                        {{-- Linear vertical list layout --}}
                        <vibe:todo mode="form" layout="list" name="batch_tasks">
                            <vibe:todo.item
                                id="form-task-1"
                                title="Tahap 1: Verifikasi Identitas Pengguna"
                                :order="0"
                                badge="Wajib"
                                badge-variant="destructive"
                            />
                            <vibe:todo.item
                                id="form-task-2"
                                title="Tahap 2: Pengaturan Preferensi Notifikasi"
                                :order="1"
                                badge="Opsional"
                                badge-variant="outline"
                            />
                            <vibe:todo.item
                                id="form-task-3"
                                title="Tahap 3: Konfirmasi & Kirim Formulir"
                                :order="2"
                                badge="Final"
                                badge-variant="primary"
                            />
                        </vibe:todo>

                        <div class="pt-2 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <p class="text-xs text-muted-foreground">
                                {!! __('docs/todo.form.hint') !!}
                            </p>
                            <vibe:button type="submit" size="sm" class="rounded-xl">
                                {{ __('docs/todo.form.submit_btn') }}
                            </vibe:button>
                        </div>
                    </form>
                </vibe:preview>
            </section>

            {{-- 5. Kanban Board with LocalStorage Persistence --}}
            <section id="local-persist" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/todo.persist.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/todo.persist.desc') !!}
                    </p>
                </div>

                @php
                    $snippetPersist = <<<'BLADE'
<vibe:todo 
    id="sprint-board" 
    layout="board" 
    mode="local" 
    :persist="true" 
    storage-key="my-team-sprint-board"
>
    <vibe:todo.group name="sprint_active" title="Sprint Active" color="blue">
        <vibe:todo.item id="p-1" group="sprint_active" title="Penyusunan Roadmap Q4" />
    </vibe:todo.group>

    <vibe:todo.group name="sprint_completed" title="Sprint Completed" color="emerald">
        <vibe:todo.item id="p-2" group="sprint_completed" title="Pembaruan Dokumentasi" :completed="true" />
    </vibe:todo.group>
</vibe:todo>
BLADE;
                @endphp

                <vibe:preview :title="__('docs/todo.persist.preview_title')" :code="$snippetPersist" :center="false">
                    <div class="w-full space-y-3">
                        <div class="flex items-center justify-between pb-1">
                            <span class="text-xs text-muted-foreground flex items-center gap-1.5">
                                <svg class="size-3.5 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                    <polyline points="17 21 17 13 7 13 7 21"/>
                                    <polyline points="7 3 7 8 15 8"/>
                                </svg>
                                {{ __('docs/todo.persist.hint') }}
                            </span>
                            <button 
                                type="button" 
                                @click="(window.VibeTodo ? window.VibeTodo.clear('docs-persist-board') : null); localStorage.removeItem('docs-persist-board'); window.location.reload();" 
                                class="text-xs text-muted-foreground hover:text-foreground font-medium underline cursor-pointer"
                                title="{{ __('docs/todo.persist.reset_btn') }}"
                            >
                                {{ __('docs/todo.persist.reset_btn') }}
                            </button>
                        </div>

                        <vibe:todo id="demo-persist-board" layout="board" mode="local" :persist="true" storage-key="docs-persist-board">
                            <vibe:todo.group name="sprint_active" title="Sprint Active" count="2" color="blue">
                                <vibe:todo.item
                                    id="ps-1"
                                    group="sprint_active"
                                    title="Penyusunan Roadmap Q4"
                                    badge="Planning"
                                    badge-variant="primary"
                                />
                                <vibe:todo.item
                                    id="ps-2"
                                    group="sprint_active"
                                    title="Refactoring CSS Variables Theme"
                                    badge="Core"
                                    badge-variant="warning"
                                />
                            </vibe:todo.group>

                            <vibe:todo.group name="sprint_completed" title="Sprint Completed" count="1" color="emerald">
                                <vibe:todo.item
                                    id="ps-3"
                                    group="sprint_completed"
                                    title="Pembaruan Dokumentasi Multi-bahasa"
                                    :completed="true"
                                    badge="Docs"
                                    badge-variant="outline"
                                />
                            </vibe:todo.group>
                        </vibe:todo>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Column Navigation Buttons Control (nav-buttons) --}}
            <section id="nav-buttons" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/todo.nav_buttons.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/todo.nav_buttons.desc') !!}
                    </p>
                </div>

                @php
                    $snippetNavButtons = <<<'BLADE'
{{-- Mengaktifkan tombol navigasi kolom secara global di seluruh kartu --}}
<vibe:todo layout="board" :nav-buttons="true">
    <vibe:todo.group name="todo" title="To Do">
        <vibe:todo.item id="t-1" title="Tugas dengan Tombol Navigasi" group="todo" />
    </vibe:todo.group>
    <vibe:todo.group name="done" title="Done">
        ...
    </vibe:todo.group>
</vibe:todo>

{{-- Atau aktifkan secara granular hanya pada item tertentu --}}
<vibe:todo layout="board">
    <vibe:todo.group name="todo" title="To Do">
        <vibe:todo.item id="t-2" title="Tugas Khusus" group="todo" :nav-buttons="true" />
    </vibe:todo.group>
</vibe:todo>
BLADE;
                @endphp

                <vibe:preview :title="__('docs/todo.nav_buttons.preview_title')" :code="$snippetNavButtons" :center="false">
                    <div class="w-full space-y-4">
                        <div class="grid grid-cols-1 gap-4">
                            <div class="space-y-2">
                                <div class="flex items-center gap-2">
                                    <vibe:badge variant="primary" size="sm" class="font-mono text-[11px]">:nav-buttons="true"</vibe:badge>
                                    <span class="text-xs text-muted-foreground">{{ __('docs/todo.nav_buttons.enabled_hint') }}</span>
                                </div>
                                <vibe:todo id="demo-nav-enabled" layout="board" mode="local" :nav-buttons="true">
                                    <vibe:todo.group name="step_a" title="Tahap A" count="1" color="blue">
                                        <vibe:todo.item
                                            id="nav-demo-1"
                                            group="step_a"
                                            title="Tugas dengan Tombol Navigasi"
                                            description="Perhatikan tombol panah (→) di sebelah kanan."
                                            badge="Enabled"
                                            badge-variant="primary"
                                        />
                                    </vibe:todo.group>

                                    <vibe:todo.group name="step_b" title="Tahap B" count="0" color="amber">
                                    </vibe:todo.group>
                                </vibe:todo>
                            </div>

                            <div class="space-y-2 pt-2 border-t border-border/50">
                                <div class="flex items-center gap-2">
                                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:nav-buttons="false" (default)</vibe:badge>
                                    <span class="text-xs text-muted-foreground">{{ __('docs/todo.nav_buttons.disabled_hint') }}</span>
                                </div>
                                <vibe:todo id="demo-nav-disabled" layout="board" mode="local" :nav-buttons="false">
                                    <vibe:todo.group name="step_c" title="Tahap C" count="1" color="purple">
                                        <vibe:todo.item
                                            id="nav-demo-2"
                                            group="step_c"
                                            title="Tugas Standar (Hanya Drag-and-Drop)"
                                            description="Tombol navigasi panah tersembunyi secara default."
                                            badge="Default"
                                            badge-variant="outline"
                                        />
                                    </vibe:todo.group>

                                    <vibe:todo.group name="step_d" title="Tahap D" count="0" color="emerald">
                                    </vibe:todo.group>
                                </vibe:todo>
                            </div>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. 3x2 Drag Indicator Options (drag-handle) --}}
            <section id="drag-handle" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/todo.drag_handle.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/todo.drag_handle.desc') !!}
                    </p>
                </div>

                <div class="p-3.5 rounded-xl border border-primary/20 bg-primary/5 text-xs text-foreground flex items-center gap-3">
                    <svg class="size-5 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect width="14" height="20" x="5" y="2" rx="2" ry="2"/>
                        <path d="M12 18h.01"/>
                    </svg>
                    <span>{!! __('docs/todo.drag_handle.mobile_hint') !!}</span>
                </div>

                @php
                    $snippetDragHandle = <<<'BLADE'
{{-- 1. Setelan Global di Container Todo --}}
<vibe:todo drag-handle="hover">
    <vibe:todo.item id="t-1" title="Semua kartu otomatis mengikuti mode hover" />
</vibe:todo>

{{-- 2. Sembunyikan Titik Drag Sepenuhnya --}}
<vibe:todo drag-handle="hidden">
    <vibe:todo.item id="t-2" title="Tampilan kartu bersih tanpa ikon 3x2" />
</vibe:todo>

{{-- 3. Granular Override per Item Kartu --}}
<vibe:todo drag-handle="visible">
    <vibe:todo.item id="t-3" title="Kartu A: visible" />
    <vibe:todo.item id="t-4" title="Kartu B: on hover" drag-handle="hover" />
    <vibe:todo.item id="t-5" title="Kartu C: tersembunyi" drag-handle="hidden" />
</vibe:todo>

{{-- 4. Opsi Lock Agar Kartu Tidak Bisa Dipindah --}}
<vibe:todo>
    <vibe:todo.item id="t-6" title="Kartu Terkunci (Pinned)" :lock="true" />
</vibe:todo>
BLADE;
                @endphp

                <vibe:preview :title="__('docs/todo.drag_handle.preview_title')" :code="$snippetDragHandle" :center="false">
                    <div class="w-full space-y-6">
                        {{-- 1. On Hover (Default) --}}
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <vibe:badge variant="warning" size="sm" class="font-mono text-[11px]">{{ __('docs/todo.drag_handle.hover_badge') }}</vibe:badge>
                                <span class="text-xs text-muted-foreground">{{ __('docs/todo.drag_handle.hover_desc') }}</span>
                            </div>
                            <vibe:todo id="demo-drag-hover" layout="list" mode="local" drag-handle="hover">
                                <vibe:todo.item
                                    id="dh-2"
                                    title="Arahkan Kursor ke Sini untuk Melihat Titik Drag (On Hover)"
                                    description="Ikon titik 3x2 otomatis muncul saat kartu disorot oleh kursor mouse."
                                    badge="Hover"
                                    badge-variant="warning"
                                />
                            </vibe:todo>
                        </div>

                        {{-- 2. Visible --}}
                        <div class="space-y-2 pt-2 border-t border-border/50">
                            <div class="flex items-center gap-2">
                                <vibe:badge variant="primary" size="sm" class="font-mono text-[11px]">{{ __('docs/todo.drag_handle.visible_badge') }}</vibe:badge>
                                <span class="text-xs text-muted-foreground">{{ __('docs/todo.drag_handle.visible_desc') }}</span>
                            </div>
                            <vibe:todo id="demo-drag-visible" layout="list" mode="local" drag-handle="visible">
                                <vibe:todo.item
                                    id="dh-1"
                                    title="Titik Drag Selalu Tampil (Visible)"
                                    description="Pengguna dapat langsung melihat ikon titik 3x2 dan menggesernya."
                                    badge="Visible"
                                    badge-variant="primary"
                                />
                            </vibe:todo>
                        </div>

                        {{-- 3. Hidden / False --}}
                        <div class="space-y-2 pt-2 border-t border-border/50">
                            <div class="flex items-center gap-2">
                                <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ __('docs/todo.drag_handle.hidden_badge') }}</vibe:badge>
                                <span class="text-xs text-muted-foreground">{{ __('docs/todo.drag_handle.hidden_desc') }}</span>
                            </div>
                            <vibe:todo id="demo-drag-hidden" layout="list" mode="local" drag-handle="hidden">
                                <vibe:todo.item
                                    id="dh-3"
                                    title="Indikator Titik 3x2 Disembunyikan (Clean Minimalist)"
                                    description="Di mobile, kartu ini tetap dapat dipindahkan menggunakan sentuh-tahan (long press)."
                                    badge="Hidden"
                                    badge-variant="outline"
                                />
                            </vibe:todo>
                        </div>

                        {{-- 4. Locked (:lock="true") --}}
                        <div class="space-y-2 pt-2 border-t border-border/50">
                            <div class="flex items-center gap-2">
                                <vibe:badge variant="destructive" size="sm" class="font-mono text-[11px]">{{ __('docs/todo.drag_handle.locked_badge') }}</vibe:badge>
                                <span class="text-xs text-muted-foreground">{{ __('docs/todo.drag_handle.locked_desc') }}</span>
                            </div>
                            <vibe:todo id="demo-drag-locked" layout="list" mode="local">
                                <vibe:todo.item
                                    id="dh-4"
                                    title="Kartu Terkunci (Pinned / Immovable)"
                                    description="Menampilkan ikon gembok, draggable dinonaktifkan, dan tidak dapat digeser atau dipindah."
                                    badge="Locked"
                                    badge-variant="destructive"
                                    :lock="true"
                                />
                            </vibe:todo>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Complete Backend Integration Guide --}}
            <section id="backend-guide" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/todo.backend.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/todo.backend.desc') !!}
                    </p>
                </div>

                @php
                    $livewireCode = <<<'PHP'
<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskBoard extends Component
{
    /**
     * Dipanggil otomatis oleh prop: wire-reorder="updateTaskOrder"
     * 
     * @param array $orderedIds Array ID tugas terurut: ['3', '1', '4', '2']
     * @param string|null $changedItemId ID tugas spesifik yang baru saja dipindahkan
     * @param string|null $fromGroup Nama kolom asal (misal: 'todo')
     * @param string|null $toGroup Nama kolom tujuan (misal: 'progress')
     */
    public function updateTaskOrder(array $orderedIds, ?string $changedItemId = null, ?string $fromGroup = null, ?string $toGroup = null): void
    {
        // 1. Perbarui nilai kolom 'order' secara massal di database
        foreach ($orderedIds as $index => $id) {
            Task::where('id', $id)->update(['order' => $index]);
        }

        // 2. Jika tugas berpindah antar kolom status / Kanban group
        if ($changedItemId && $toGroup && $fromGroup !== $toGroup) {
            Task::where('id', $changedItemId)->update([
                'status' => $toGroup,
                'completed' => ($toGroup === 'done'),
            ]);
        }
    }

    /**
     * Dipanggil otomatis oleh prop: wire-toggle="toggleTask"
     */
    public function toggleTask(string $id): void
    {
        $task = Task::findOrFail($id);
        $task->update([
            'completed' => ! $task->completed,
            'status' => ! $task->completed ? 'done' : 'todo',
        ]);
    }

    /**
     * Dipanggil otomatis oleh prop: wire-delete="deleteTask"
     */
    public function deleteTask(string $id): void
    {
        Task::where('id', $id)->delete();
    }

    /**
     * Dipanggil otomatis oleh prop: wire-add="addTask"
     */
    public function addTask(string $title, ?string $group = 'todo'): void
    {
        $clean = trim($title);
        if (empty($clean)) return;

        $targetGroup = $group ?: 'todo';
        $maxOrder = Task::where('status', $targetGroup)->max('order') ?? 0;

        Task::create([
            'title' => $clean,
            'status' => $targetGroup,
            'order' => $maxOrder + 1,
            'completed' => false,
        ]);
    }

    public function render()
    {
        return view('livewire.task-board', [
            'tasks' => Task::orderBy('order')->get(),
        ]);
    }
}
PHP;

                    $apiControllerCode = <<<'PHP'
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskApiController extends Controller
{
    /**
     * Endpoint: POST /api/tasks/reorder (sesuai prop: reorder-url)
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'orderIds' => 'required|array',
            'orderIds.*' => 'required',
            'changedItemId' => 'nullable',
            'fromGroup' => 'nullable|string',
            'toGroup' => 'nullable|string',
        ]);

        // Simpan urutan baru
        foreach ($validated['orderIds'] as $index => $id) {
            Task::where('id', $id)->update(['order' => $index]);
        }

        // Simpan perpindahan kolom status
        if (!empty($validated['changedItemId']) && !empty($validated['toGroup'])) {
            Task::where('id', $validated['changedItemId'])->update([
                'status' => $validated['toGroup'],
                'completed' => ($validated['toGroup'] === 'done'),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Urutan tugas berhasil diperbarui!',
        ]);
    }

    /**
     * Endpoint: POST /api/tasks/{id}/toggle (sesuai prop: toggle-url)
     */
    public function toggle(string $id, Request $request)
    {
        $task = Task::findOrFail($id);
        $task->update([
            'completed' => (bool) $request->input('completed', !$task->completed),
        ]);

        return response()->json(['success' => true, 'task' => $task]);
    }

    /**
     * Endpoint: DELETE /api/tasks/{id} (sesuai prop: delete-url)
     */
    public function destroy(string $id)
    {
        Task::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Endpoint: POST /api/tasks (sesuai prop: add-url)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'group' => 'nullable|string',
        ]);

        $task = Task::create([
            'title' => $validated['title'],
            'status' => $validated['group'] ?? 'todo',
            'order' => (Task::where('status', $validated['group'] ?? 'todo')->max('order') ?? 0) + 1,
            'completed' => false,
        ]);

        return response()->json(['success' => true, 'task' => $task], 201);
    }
}
PHP;

                    $formControllerCode = <<<'PHP'
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskBatchController extends Controller
{
    /**
     * Menangani formulir batch submit dari: <vibe:todo mode="form" name="batch_tasks">
     */
    public function updateBatch(Request $request)
    {
        $validated = $request->validate([
            'batch_tasks' => 'required|array',
            'batch_tasks.*.id' => 'required',
            'batch_tasks.*.order' => 'required|integer',
            'batch_tasks.*.completed' => 'required|boolean',
            'batch_tasks.*.group' => 'nullable|string',
        ]);

        // Simpan seluruh perubahan urutan dan status sekaligus dalam 1 transaksi
        \DB::transaction(function () use ($validated) {
            foreach ($validated['batch_tasks'] as $item) {
                Task::where('id', $item['id'])->update([
                    'order' => (int) $item['order'],
                    'completed' => (bool) $item['completed'],
                    'status' => $item['group'] ?? 'default',
                ]);
            }
        });

        return redirect()->back()->with('success', 'Semua perubahan tugas berhasil disimpan!');
    }
}
PHP;
                @endphp

                <vibe:tabs selected="livewire" default="livewire" layout="rows" variant="pill" class="space-y-4">
                    <vibe:tabs.list class="flex-wrap">
                        <vibe:tabs.tab name="livewire">
                            <x-slot:icon>
                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                            </x-slot:icon>
                            {{ __('docs/todo.backend.tab_livewire') }}
                        </vibe:tabs.tab>
                        <vibe:tabs.tab name="api">
                            <x-slot:icon>
                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            </x-slot:icon>
                            {{ __('docs/todo.backend.tab_api') }}
                        </vibe:tabs.tab>
                        <vibe:tabs.tab name="form">
                            <x-slot:icon>
                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                            </x-slot:icon>
                            {{ __('docs/todo.backend.tab_form') }}
                        </vibe:tabs.tab>
                    </vibe:tabs.list>

                    {{-- Tab 1: Livewire 3 --}}
                    <vibe:tabs.panel name="livewire">
                        <vibe:card class="p-5 space-y-3">
                            <div class="space-y-1">
                                <h3 class="text-sm font-semibold text-foreground">{{ __('docs/todo.backend.livewire_card_title') }}</h3>
                                <p class="text-xs text-muted-foreground leading-relaxed">{!! __('docs/todo.backend.livewire_card_desc') !!}</p>
                            </div>
                            <vibe:highlightjs language="php" title="app/Livewire/TaskBoard.php" :code="$livewireCode" :line-numbers="true" />
                        </vibe:card>
                    </vibe:tabs.panel>

                    {{-- Tab 2: REST API Controller --}}
                    <vibe:tabs.panel name="api">
                        <vibe:card class="p-5 space-y-3">
                            <div class="space-y-1">
                                <h3 class="text-sm font-semibold text-foreground">{{ __('docs/todo.backend.api_card_title') }}</h3>
                                <p class="text-xs text-muted-foreground leading-relaxed">{!! __('docs/todo.backend.api_card_desc') !!}</p>
                            </div>
                            <vibe:highlightjs language="php" title="app/Http/Controllers/Api/TaskApiController.php" :code="$apiControllerCode" :line-numbers="true" />
                        </vibe:card>
                    </vibe:tabs.panel>

                    {{-- Tab 3: Form Batch Controller --}}
                    <vibe:tabs.panel name="form">
                        <vibe:card class="p-5 space-y-3">
                            <div class="space-y-1">
                                <h3 class="text-sm font-semibold text-foreground">{{ __('docs/todo.backend.form_card_title') }}</h3>
                                <p class="text-xs text-muted-foreground leading-relaxed">{!! __('docs/todo.backend.form_card_desc') !!}</p>
                            </div>
                            <vibe:highlightjs language="php" title="app/Http/Controllers/TaskBatchController.php" :code="$formControllerCode" :line-numbers="true" />
                        </vibe:card>
                    </vibe:tabs.panel>
                </vibe:tabs>
            </section>

            {{-- 9. Anti-FOUC Architecture Detail --}}
            <section id="anti-fouc" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/todo.anti_fouc.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/todo.anti_fouc.desc') !!}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <vibe:card class="p-4 space-y-2 border border-border/80">
                        <div class="size-8 rounded-lg bg-emerald-500/10 text-emerald-600 flex items-center justify-center font-bold text-sm">
                            1
                        </div>
                        <h4 class="font-semibold text-sm text-foreground">{{ __('docs/todo.anti_fouc.card1_title') }}</h4>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            {{ __('docs/todo.anti_fouc.card1_desc') }}
                        </p>
                    </vibe:card>

                    <vibe:card class="p-4 space-y-2 border border-border/80">
                        <div class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                            2
                        </div>
                        <h4 class="font-semibold text-sm text-foreground">{{ __('docs/todo.anti_fouc.card2_title') }}</h4>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            {{ __('docs/todo.anti_fouc.card2_desc') }}
                        </p>
                    </vibe:card>

                    <vibe:card class="p-4 space-y-2 border border-border/80">
                        <div class="size-8 rounded-lg bg-amber-500/10 text-amber-600 flex items-center justify-center font-bold text-sm">
                            3
                        </div>
                        <h4 class="font-semibold text-sm text-foreground">{{ __('docs/todo.anti_fouc.card3_title') }}</h4>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            {{ __('docs/todo.anti_fouc.card3_desc') }}
                        </p>
                    </vibe:card>
                </div>
            </section>

            {{-- 10. Fitur Kartu Lanjutan (Inline Edit, Subtasks, Multi-Labels & Assignees) --}}
            <section id="fitur-kartu" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">10. Fitur Kartu Lanjutan (Inline Edit, Subtasks, Multi-Labels &amp; Assignees)</h2>
                    <p class="text-sm text-muted-foreground">
                        Tingkatkan produktivitas dengan inline quick editing tanpa modal popup, checklist subtugas (&lt;vibe:todo.subtask&gt;) dengan visual progress bar otomatis, multi-labels warna-warni, kalkulasi urgensi jatuh tempo otomatis (overdue, today, upcoming), dan kolaborator avatar stack.
                    </p>
                </div>

                @php
                    $snippetCardFeatures = <<<'BLADE'
<vibe:todo layout="list" :editable="true">
    {{-- 1. Kartu dengan Subtasks Checklist & Progress Bar --}}
    <vibe:todo.item 
        id="card-feat-1" 
        title="Redesain Halaman Dashboard Analitik" 
        description="Klik dua kali atau klik ikon pensil untuk mengedit teks secara inline."
        :labels="[['text' => 'Frontend', 'variant' => 'primary'], ['text' => 'High', 'variant' => 'destructive']]"
        due-date="Hari Ini"
        :assignees="[['name' => 'Sarah Connor'], ['name' => 'John Doe']]"
    >
        <vibe:todo.subtask id="sub-1" title="Buat wireframe figma resolusi tinggi" :completed="true" />
        <vibe:todo.subtask id="sub-2" title="Slicing komponen grafik chart.js" :completed="true" />
        <vibe:todo.subtask id="sub-3" title="Integrasi endpoint REST API realtime" :completed="false" />
    </vibe:todo.item>

    {{-- 2. Kartu Overdue Terlewat dengan Multi-Labels --}}
    <vibe:todo.item 
        id="card-feat-2" 
        title="Migrasi Database Skema v2" 
        description="Indikator tanggal otomatis bernuansa merah saat melewati batas waktu (overdue)."
        :completed="false"
        :labels="[['text' => 'Backend', 'variant' => 'warning'], ['text' => 'Critical', 'variant' => 'destructive']]"
        due-date="2020-01-01"
        :assignees="[['name' => 'Alex Miller']]"
    />
</vibe:todo>
BLADE;
                @endphp

                <vibe:preview title="Fitur Kartu Lanjutan Interaktif" :code="$snippetCardFeatures" :center="false">
                    <div class="w-full space-y-3">
                        <vibe:todo id="demo-card-features" layout="list" :editable="true" mode="local">
                            <vibe:todo.item 
                                id="demo-cf-1" 
                                title="Redesain Halaman Dashboard Analitik" 
                                description="Klik dua kali atau klik ikon pensil untuk mengedit teks ini langsung di tempat."
                                :labels="[['text' => 'Frontend', 'variant' => 'primary'], ['text' => 'High', 'variant' => 'destructive']]"
                                due-date="Hari Ini"
                                :assignees="[['name' => 'Sarah Connor'], ['name' => 'John Doe']]"
                            >
                                <vibe:todo.subtask id="cf-sub-1" title="Buat wireframe figma resolusi tinggi" :completed="true" />
                                <vibe:todo.subtask id="cf-sub-2" title="Slicing komponen grafik chart.js" :completed="true" />
                                <vibe:todo.subtask id="cf-sub-3" title="Integrasi endpoint REST API realtime" :completed="false" />
                            </vibe:todo.item>

                            <vibe:todo.item 
                                id="demo-cf-2" 
                                title="Migrasi Skema Database Transaksi" 
                                description="Indikator tanggal otomatis berwarna merah ketika waktu telah terlewat (overdue)."
                                :completed="false"
                                :labels="[['text' => 'Backend', 'variant' => 'warning'], ['text' => 'Critical', 'variant' => 'destructive']]"
                                due-date="2020-01-01"
                                :assignees="[['name' => 'Alex Miller']]"
                            />
                        </vibe:todo>
                    </div>
                </vibe:preview>

                {{-- Custom Card Content & Action Buttons --}}
                <div class="space-y-2 pt-4 border-t border-border/40">
                    <h3 class="text-base font-semibold text-foreground">Desain Bebas Kustom HTML &amp; Slot Aksi Developer</h3>
                    <p class="text-xs text-muted-foreground">
                        Komponen &lt;vibe:todo.item&gt; dapat langsung diisi dengan markup HTML bebas di dalam tag (seperti kotak catatan pesanan, informasi item, baris badge, atau tombol aksi kustom melalui &lt;x-slot:actions&gt;) agar desain kartu dapat disesuaikan 100% dengan kebutuhan proyek.
                    </p>
                </div>

                @php
                    $snippetCustomHtml = <<<'BLADE'
<vibe:todo layout="board">
    <vibe:todo.group name="kitchen" title="Dapur Masak" color="amber">
        <vibe:todo.item 
            id="order-101" 
            badge="Meja 4" 
            due-date="5m lalu" 
            :deletable="false"
        >
            {{-- Title & Deskripsi diletakkan di dalam komponen --}}
            <vibe:todo.title>Antrian #05</vibe:todo.title>
            <vibe:todo.description>Pelanggan: Budi • ORD-8891</vibe:todo.description>

            {{-- Konten Kustom Tambahan --}}
            <div class="p-2 bg-muted rounded-lg text-xs mt-2">
                Catatan Pesanan: Sedikit gula, es dipisah
            </div>

            <div class="text-[11px] text-muted-foreground flex items-center gap-1 mt-1">
                <span>Rincian Menu: 2x Kopi Susu Aren, 1x Roti Bakar</span>
            </div>

            <div class="flex justify-between mt-2 items-center">
                <vibe:badge variant="secondary" size="sm">Dine-In</vibe:badge>
                <vibe:badge size="sm" variant="outline">Prioritas Normal</vibe:badge>
            </div>

            {{-- Slot Tombol Aksi --}}
            <x-slot:actions>
                <vibe:button size="sm" variant="primary" class="w-full">
                    Selesai Masak
                </vibe:button>
            </x-slot:actions>
        </vibe:todo.item>
    </vibe:todo.group>
</vibe:todo>
BLADE;
                @endphp

                <vibe:preview title="Desain Kustom HTML & Slot Aksi Bebas" :code="$snippetCustomHtml" :center="false">
                    <div class="w-full max-w-sm mx-auto">
                        <vibe:todo layout="board" mode="local">
                            <vibe:todo.group name="kitchen" title="Dapur Masak" color="amber" :count="1">
                                <vibe:todo.item 
                                    id="demo-order-101" 
                                    badge="Meja 4" 
                                    due-date="5m lalu" 
                                    :deletable="false"
                                >
                                    {{-- Title & Deskripsi diletakkan di dalam komponen --}}
                                    <vibe:todo.title>Antrian #05</vibe:todo.title>
                                    <vibe:todo.description>Pelanggan: Budi • ORD-8891</vibe:todo.description>

                                    {{-- Konten Kustom Tambahan --}}
                                    <div class="p-2 bg-muted rounded-lg text-xs mt-2">
                                        Catatan Pesanan: Sedikit gula, es dipisah
                                    </div>

                                    <div class="text-[11px] text-muted-foreground flex items-center gap-1 mt-1">
                                        <span>Rincian Menu: 2x Kopi Susu Aren, 1x Roti Bakar</span>
                                    </div>

                                    <div class="flex justify-between mt-2 items-center">
                                        <vibe:badge variant="secondary" size="sm">Dine-In</vibe:badge>
                                        <vibe:badge size="sm" variant="outline">Prioritas Normal</vibe:badge>
                                    </div>

                                    {{-- Slot Tombol Aksi --}}
                                    <x-slot:actions>
                                        <vibe:button size="sm" variant="primary" class="w-full">
                                            Selesai Masak
                                        </vibe:button>
                                    </x-slot:actions>
                                </vibe:todo.item>
                            </vibe:todo.group>
                        </vibe:todo>
                    </div>
                </vibe:preview>
            </section>

            {{-- 11. Superpower Kolom Kanban & Live Search --}}
            <section id="kolom-superpower" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">11. Superpower Kolom Kanban &amp; Live Search</h2>
                    <p class="text-sm text-muted-foreground">
                        Optimalkan alur kerja tim dengan pembatasan jumlah tugas maksimal per kolom (WIP Limit), tombol tambah cepat inline di bawah kolom, kolom collapsible yang dapat dilipat menjadi pita vertikal, serta bilah pencarian instan sisi klien.
                    </p>
                </div>

                @php
                    $snippetKanbanSuperpower = <<<'BLADE'
<vibe:todo 
    layout="board" 
    :searchable="true" 
    search-placeholder="Ketik untuk memfilter tugas secara instan..."
    :quick-add="true"
>
    {{-- Kolom dengan Quick Add & WIP Limit 2 Tugas --}}
    <vibe:todo.group name="sp_progress" title="In Progress" color="amber" :count="2" :max="2">
        <vibe:todo.item id="kb-wip-1" title="Optimasi Query SQL N+1" />
        <vibe:todo.item id="kb-wip-2" title="Implementasi Caching Redis" />
    </vibe:todo.group>

    {{-- Kolom Collapsible yang Dapat Dilipat --}}
    <vibe:todo.group name="sp_done" title="Completed" color="emerald" :count="1" :collapsible="true">
        <vibe:todo.item id="kb-col-1" title="Setup Pipeline CI/CD GitHub Actions" :completed="true" />
    </vibe:todo.group>
</vibe:todo>
BLADE;
                @endphp

                <vibe:preview title="Superpower Kolom Kanban & Live Search Interaktif" :code="$snippetKanbanSuperpower" :center="false">
                    <div class="w-full space-y-3">
                        <vibe:todo 
                            id="demo-kanban-superpowers"
                            layout="board" 
                            :searchable="true" 
                            search-placeholder="Ketik untuk memfilter tugas secara instan..."
                            :quick-add="true"
                            mode="local"
                        >
                            {{-- Kolom 1: In Progress with WIP Limit 2 --}}
                            <vibe:todo.group name="sp_progress" title="In Progress" color="amber" :count="2" :max="2">
                                <vibe:todo.item id="sp-task-1" group="sp_progress" title="Optimasi Query SQL N+1" badge="Core" badge-variant="warning" />
                                <vibe:todo.item id="sp-task-2" group="sp_progress" title="Implementasi Caching Redis" badge="Backend" badge-variant="primary" />
                            </vibe:todo.group>

                            {{-- Kolom 2: Review --}}
                            <vibe:todo.group name="sp_review" title="Code Review" color="blue" :count="1" :max="3">
                                <vibe:todo.item id="sp-task-3" group="sp_review" title="Audit Keamanan Token JWT" badge="Security" badge-variant="destructive" />
                            </vibe:todo.group>

                            {{-- Kolom 3: Done with Collapsible --}}
                            <vibe:todo.group name="sp_done" title="Completed" color="emerald" :count="1" :collapsible="true">
                                <vibe:todo.item id="sp-task-4" group="sp_done" title="Setup Pipeline CI/CD GitHub Actions" :completed="true" />
                            </vibe:todo.group>
                        </vibe:todo>
                    </div>
                </vibe:preview>
            </section>

            {{-- 12. JavaScript Events API --}}
            <section id="events" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">12. {{ __('docs/todo.events.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/todo.events.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.events.table_event') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.events.table_detail') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/todo.events.table_desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-primary whitespace-nowrap">vibe:todo-reordered</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground whitespace-nowrap">{ id, changedItemId, fromGroup, toGroup, orderIds, order }</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">{{ __('docs/todo.events.reordered_desc') }}</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-primary whitespace-nowrap">vibe:todo-toggled</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground whitespace-nowrap">{ id, itemId, completed }</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">{{ __('docs/todo.events.toggled_desc') }}</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-primary whitespace-nowrap">vibe:todo-deleted</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground whitespace-nowrap">{ id, itemId }</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">{{ __('docs/todo.events.deleted_desc') }}</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-primary whitespace-nowrap">vibe:todo-added</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground whitespace-nowrap">{ title, group }</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">{{ __('docs/todo.events.added_desc') }}</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-primary whitespace-nowrap">vibe:todo-updated</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground whitespace-nowrap">{ id, itemId, title, description, group }</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">{{ __('docs/todo.events.updated_desc') }}</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-primary whitespace-nowrap">vibe:todo-subtask-updated</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground whitespace-nowrap">{ todoId, itemId, subtaskId, completed }</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">{{ __('docs/todo.events.subtask_updated_desc') }}</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>

                <div class="rounded-xl border border-border bg-card p-4 space-y-2">
                    <p class="text-xs font-semibold text-foreground">Contoh JavaScript Event Listener:</p>
                    <pre class="text-xs font-mono p-3 bg-muted/50 rounded-lg overflow-x-auto text-foreground"><code>document.addEventListener('vibe:todo-reordered', (e) => {
    console.log('Item dipindahkan:', e.detail.changedItemId);
    console.log('Dari kolom:', e.detail.fromGroup, 'ke kolom:', e.detail.toGroup);
    console.log('Urutan ID terbaru:', e.detail.orderIds);
});</code></pre>
                </div>
            </section>

            {{-- 13. Complete Props Reference --}}
            <section id="referensi-props" class="space-y-8">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">13. {{ __('docs/todo.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/todo.props.desc') !!}
                    </p>
                </div>

                {{-- vibe:todo Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground flex items-center gap-2">
                        <span class="font-mono text-primary">&lt;vibe:todo&gt;</span>
                        <span class="text-xs text-muted-foreground font-normal">(Container Utama)</span>
                    </p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/todo.props.table_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $rootProps = [
                                    ['mode', 'string', "'local'", __('docs/todo.props.todo_mode')],
                                    ['layout', 'string', "'list'", __('docs/todo.props.todo_layout')],
                                    ['checkbox', 'bool', 'false', __('docs/todo.props.todo_checkbox')],
                                    ['lock', 'bool', 'false', __('docs/todo.props.todo_lock')],
                                    ['editable', 'bool', 'false', __('docs/todo.props.todo_editable')],
                                    ['quick-add', 'bool', 'false', __('docs/todo.props.todo_quick_add')],
                                    ['searchable', 'bool', 'false', __('docs/todo.props.todo_searchable')],
                                    ['keyboard-navigation', 'bool', 'true', __('docs/todo.props.todo_keyboard')],
                                    ['nav-buttons', 'bool', 'false', __('docs/todo.props.todo_nav_buttons')],
                                    ['reorderable', 'bool', 'true', __('docs/todo.props.todo_reorderable')],
                                    ['drag-handle', 'string|bool', "'hover'", __('docs/todo.props.todo_drag_handle')],
                                    ['persist', 'bool', 'false', __('docs/todo.props.todo_persist')],
                                    ['storage-key', 'string|null', 'null', __('docs/todo.props.todo_storage_key')],
                                    ['expire-hours', 'int', '720', __('docs/todo.props.todo_expire_hours')],
                                    ['gap', 'string', "'3'", __('docs/todo.props.todo_gap')],
                                    ['wire-reorder', 'string|null', 'null', __('docs/todo.props.todo_wire_reorder')],
                                    ['wire-toggle', 'string|null', 'null', __('docs/todo.props.todo_wire_toggle')],
                                    ['wire-delete', 'string|null', 'null', __('docs/todo.props.todo_wire_delete')],
                                    ['wire-add', 'string|null', 'null', __('docs/todo.props.todo_wire_add')],
                                    ['wire-update', 'string|null', 'null', __('docs/todo.props.todo_wire_update')],
                                    ['endpoint', 'string|null', 'null', __('docs/todo.props.todo_endpoint')],
                                    ['name', 'string', "'todos'", __('docs/todo.props.todo_name')],
                                ];
                            @endphp
                            @foreach ($rootProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{!! $desc !!}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- vibe:todo.group Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground flex items-center gap-2">
                        <span class="font-mono text-primary">&lt;vibe:todo.group&gt;</span>
                        <span class="text-xs text-muted-foreground font-normal">(Kolom Status Kanban)</span>
                    </p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/todo.props.table_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $groupProps = [
                                    ['name', 'string', "'default'", __('docs/todo.props.group_name')],
                                    ['title', 'string|null', 'null', __('docs/todo.props.group_title')],
                                    ['count', 'int|string|null', 'null', __('docs/todo.props.group_count')],
                                    ['color', 'string', "'default'", __('docs/todo.props.group_color')],
                                    ['max / wip-limit', 'int|null', 'null', __('docs/todo.props.group_max')],
                                    ['collapsible', 'bool', 'false', __('docs/todo.props.group_collapsible')],
                                    ['collapsed', 'bool', 'false', __('docs/todo.props.group_collapsed')],
                                    ['quick-add', 'bool|null', 'null', __('docs/todo.props.group_quick_add')],
                                    ['empty-text', 'string', "'Tarik tugas ke sini'", __('docs/todo.props.group_empty_text')],
                                ];
                            @endphp
                            @foreach ($groupProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{!! $desc !!}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- vibe:todo.item Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground flex items-center gap-2">
                        <span class="font-mono text-primary">&lt;vibe:todo.item&gt;</span>
                        <span class="text-xs text-muted-foreground font-normal">(Kartu Tugas)</span>
                    </p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/todo.props.table_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $itemProps = [
                                    ['id', 'string|int', 'required', __('docs/todo.props.item_id')],
                                    ['title', 'string', "''", __('docs/todo.props.item_title')],
                                    ['description', 'string|null', 'null', __('docs/todo.props.item_description')],
                                    ['group', 'string|null', 'null', __('docs/todo.props.item_group')],
                                    ['checkbox', 'bool|null', 'null', __('docs/todo.props.item_checkbox')],
                                    ['lock', 'bool|null', 'null', __('docs/todo.props.item_lock')],
                                    ['editable', 'bool|null', 'null', __('docs/todo.props.item_editable')],
                                    ['labels / tags', 'array|null', 'null', __('docs/todo.props.item_labels')],
                                    ['assignees', 'array|null', 'null', __('docs/todo.props.item_assignees')],
                                    ['subtasks', 'array|null', 'null', __('docs/todo.props.item_subtasks')],
                                    ['nav-buttons', 'bool|null', 'null', __('docs/todo.props.item_nav_buttons')],
                                    ['completed', 'bool', 'false', __('docs/todo.props.item_completed')],
                                    ['badge', 'string|null', 'null', __('docs/todo.props.item_badge')],
                                    ['badge-variant', 'string', "'default'", __('docs/todo.props.item_badge_variant')],
                                    ['due-date', 'string|null', 'null', __('docs/todo.props.item_due_date')],
                                    ['variant', 'string', "'default'", __('docs/todo.props.item_variant')],
                                    ['reorderable', 'bool', 'true', __('docs/todo.props.item_reorderable')],
                                    ['drag-handle', 'string|bool', "'hover'", __('docs/todo.props.item_drag_handle')],
                                    ['deletable', 'bool', 'true', __('docs/todo.props.item_deletable')],
                                    ['update-url', 'string|null', 'null', __('docs/todo.props.todo_endpoint')],
                                    ['wire-update', 'string|null', 'null', __('docs/todo.props.todo_wire_update')],
                                    ['slot (default)', 'html|string', 'null', __('docs/todo.props.item_slot')],
                                    ['x-slot:content', 'html', 'null', __('docs/todo.props.item_slot_content')],
                                    ['x-slot:actions', 'html', 'null', __('docs/todo.props.item_slot_actions')],
                                    ['x-slot:header-actions', 'html', 'null', __('docs/todo.props.item_slot_header_actions')],
                                ];
                            @endphp
                            @foreach ($itemProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{!! $desc !!}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- vibe:todo.title Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground flex items-center gap-2">
                        <span class="font-mono text-primary">&lt;vibe:todo.title&gt;</span>
                        <span class="text-xs text-muted-foreground font-normal">(Subkomponen Judul Kartu)</span>
                    </p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/todo.props.table_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $titleProps = [
                                    ['class', 'string|null', 'null', __('docs/todo.props.title_prop_class')],
                                    ['slot (default)', 'html|string', 'required', __('docs/todo.props.title_slot')],
                                ];
                            @endphp
                            @foreach ($titleProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{!! $desc !!}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- vibe:todo.description Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground flex items-center gap-2">
                        <span class="font-mono text-primary">&lt;vibe:todo.description&gt;</span>
                        <span class="text-xs text-muted-foreground font-normal">(Subkomponen Deskripsi Kartu)</span>
                    </p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/todo.props.table_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $descProps = [
                                    ['class', 'string|null', 'null', __('docs/todo.props.description_prop_class')],
                                    ['slot (default)', 'html|string', 'required', __('docs/todo.props.description_slot')],
                                ];
                            @endphp
                            @foreach ($descProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{!! $desc !!}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- vibe:todo.subtask Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground flex items-center gap-2">
                        <span class="font-mono text-primary">&lt;vibe:todo.subtask&gt;</span>
                        <span class="text-xs text-muted-foreground font-normal">(Subtugas Checklist)</span>
                    </p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/todo.props.table_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $subtaskProps = [
                                    ['id', 'string|int', 'required', __('docs/todo.props.subtask_id')],
                                    ['title', 'string', "''", __('docs/todo.props.subtask_title')],
                                    ['completed', 'bool', 'false', __('docs/todo.props.subtask_completed')],
                                    ['disabled', 'bool', 'false', __('docs/todo.props.subtask_disabled')],
                                ];
                            @endphp
                            @foreach ($subtaskProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{!! $desc !!}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- vibe:todo.input Props --}}
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-foreground flex items-center gap-2">
                        <span class="font-mono text-primary">&lt;vibe:todo.input&gt;</span>
                        <span class="text-xs text-muted-foreground font-normal">(Input Cepat Tambah Tugas)</span>
                    </p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/todo.props.table_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/todo.props.table_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $inputProps = [
                                    ['placeholder', 'string', "'Tulis tugas baru lalu tekan Enter...'", __('docs/todo.props.input_placeholder')],
                                    ['button-text', 'string', "'Tambah Tugas'", __('docs/todo.props.input_button_text')],
                                    ['group', 'string|null', 'null', __('docs/todo.props.input_group')],
                                ];
                            @endphp
                            @foreach ($inputProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{!! $desc !!}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
