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
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:nav-buttons="false / true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:reorderable="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:persist="true"</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:todo.group&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:todo.item&gt;</vibe:badge>
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

                <vibe:preview :title="__('docs/todo.livewire.preview_title')" :center="false">
                    <livewire:demo-todo />

                    <x-slot:code>
&lt;div class="space-y-4 w-full"&gt;
    {{-- Quick Add Input --}}
    &lt;vibe:todo.input 
        placeholder="Tulis tugas baru lalu tekan Enter..." 
        button-text="Tambah Tugas" 
    /&gt;

    {{-- Realtime Livewire Kanban Board --}}
    &lt;vibe:todo 
        mode="livewire"
        layout="board"
        wire-reorder="updateTaskOrder"
        wire-toggle="toggleTask"
        wire-delete="deleteTask"
        wire-add="addTask"
    &gt;
        {{-- Column 1: To Do --}}
        &lt;vibe:todo.group name="todo" title="To Do" :count="$todoCount" color="blue"&gt;
            @@foreach ($tasks-&gt;where('group', 'todo') as $task)
                &lt;vibe:todo.item
                    :id="$task['id']"
                    :title="$task['title']"
                    :description="$task['description']"
                    :completed="$task['completed']"
                    :badge="$task['badge']"
                    :badge-variant="$task['badgeVariant']"
                    :due-date="$task['dueDate']"
                    :order="$task['order']"
                    group="todo"
                    wire:key="todo-item-&#123;&#123; $task['id'] &#125;&#125;"
                /&gt;
            @@endforeach
        &lt;/vibe:todo.group&gt;

        {{-- Column 2: In Progress --}}
        &lt;vibe:todo.group name="progress" title="In Progress" :count="$progressCount" color="amber"&gt;
            @@foreach ($tasks-&gt;where('group', 'progress') as $task)
                &lt;vibe:todo.item
                    :id="$task['id']"
                    :title="$task['title']"
                    group="progress"
                    wire:key="todo-item-&#123;&#123; $task['id'] &#125;&#125;"
                /&gt;
            @@endforeach
        &lt;/vibe:todo.group&gt;

        {{-- Column 3: Done --}}
        &lt;vibe:todo.group name="done" title="Done" :count="$doneCount" color="emerald"&gt;
            @@foreach ($tasks-&gt;where('group', 'done') as $task)
                &lt;vibe:todo.item
                    :id="$task['id']"
                    :title="$task['title']"
                    group="done"
                    wire:key="todo-item-&#123;&#123; $task['id'] &#125;&#125;"
                /&gt;
            @@endforeach
        &lt;/vibe:todo.group&gt;
    &lt;/vibe:todo&gt;
&lt;/div&gt;
                    </x-slot:code>
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

                <vibe:preview :title="__('docs/todo.api.preview_title')" :center="false">
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

                    <x-slot:code>
&lt;vibe:todo 
    mode="api"
    layout="board"
    reorder-url="/api/todos/reorder"
    toggle-url="/api/todos/{id}/toggle"
    delete-url="/api/todos/{id}"
&gt;
    &lt;vibe:todo.group name="review" title="Review &amp; Pending" color="purple"&gt;
        &lt;vibe:todo.item
            id="task-1"
            group="review"
            title="Konfigurasi API Endpoint &amp; CSRF Token"
            badge="API"
            badge-variant="primary"
        /&gt;
    &lt;/vibe:todo.group&gt;

    &lt;vibe:todo.group name="deployed" title="Deployed to Production" color="emerald"&gt;
        &lt;vibe:todo.item
            id="task-2"
            group="deployed"
            title="Asynchronous Delete Request"
            :completed="true"
        /&gt;
    &lt;/vibe:todo.group&gt;
&lt;/vibe:todo&gt;
                    </x-slot:code>
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

                <vibe:preview :title="__('docs/todo.kanban.preview_title')" :center="false">
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

                    <x-slot:code>
&lt;vibe:todo 
    id="project-kanban" 
    layout="board" 
    mode="local" 
    :persist="true"
    :nav-buttons="true"
&gt;
    &lt;vibe:todo.group name="backlog" title="To Do" color="blue"&gt;
        &lt;vibe:todo.item id="t-1" group="backlog" title="Audit Performa Blade Component" /&gt;
    &lt;/vibe:todo.group&gt;

    &lt;vibe:todo.group name="progress" title="In Progress" color="amber"&gt;
        &lt;vibe:todo.item id="t-2" group="progress" title="Desain Tema Dark Mode" /&gt;
    &lt;/vibe:todo.group&gt;

    &lt;vibe:todo.group name="done" title="Done" color="emerald"&gt;
        &lt;vibe:todo.item id="t-3" group="done" title="Implementasi Anti-FOUC" :completed="true" /&gt;
    &lt;/vibe:todo.group&gt;
&lt;/vibe:todo&gt;
                    </x-slot:code>
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

                <vibe:preview :title="__('docs/todo.form.preview_title')" :center="false">
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

                    <x-slot:code>
&lt;form method="POST" action="&#123;&#123; route('tasks.batch') &#125;&#125;"&gt;
    @@csrf
    &lt;vibe:todo mode="form" layout="list" name="batch_tasks"&gt;
        @@foreach ($items as $item)
            &lt;vibe:todo.item 
                :id="$item-&gt;id" 
                :title="$item-&gt;title" 
                :order="$loop-&gt;index" 
            /&gt;
        @@endforeach
    &lt;/vibe:todo&gt;

    &lt;vibe:button type="submit" class="mt-4 rounded-xl"&gt;
        {{ __('docs/todo.form.submit_btn') }}
    &lt;/vibe:button&gt;
&lt;/form&gt;
                    </x-slot:code>
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

                <vibe:preview :title="__('docs/todo.persist.preview_title')" :center="false">
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

                    <x-slot:code>
&lt;vibe:todo 
    id="sprint-board" 
    layout="board" 
    mode="local" 
    :persist="true" 
    storage-key="my-team-sprint-board"
&gt;
    &lt;vibe:todo.group name="sprint_active" title="Sprint Active" color="blue"&gt;
        &lt;vibe:todo.item id="p-1" group="sprint_active" title="Penyusunan Roadmap Q4" /&gt;
    &lt;/vibe:todo.group&gt;

    &lt;vibe:todo.group name="sprint_completed" title="Sprint Completed" color="emerald"&gt;
        &lt;vibe:todo.item id="p-2" group="sprint_completed" title="Pembaruan Dokumentasi" :completed="true" /&gt;
    &lt;/vibe:todo.group&gt;
&lt;/vibe:todo&gt;
                    </x-slot:code>
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

                <vibe:preview :title="__('docs/todo.nav_buttons.preview_title')" :center="false">
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

                    <x-slot:code>
{{-- Mengaktifkan tombol navigasi kolom secara global di seluruh kartu --}}
&lt;vibe:todo layout="board" :nav-buttons="true"&gt;
    &lt;vibe:todo.group name="todo" title="To Do"&gt;
        &lt;vibe:todo.item id="t-1" title="Tugas dengan Tombol Navigasi" group="todo" /&gt;
    &lt;/vibe:todo.group&gt;
    &lt;vibe:todo.group name="done" title="Done"&gt;
        ...
    &lt;/vibe:todo.group&gt;
&lt;/vibe:todo&gt;

{{-- Atau aktifkan secara granular hanya pada item tertentu --}}
&lt;vibe:todo layout="board"&gt;
    &lt;vibe:todo.group name="todo" title="To Do"&gt;
        &lt;vibe:todo.item id="t-2" title="Tugas Khusus" group="todo" :nav-buttons="true" /&gt;
    &lt;/vibe:todo.group&gt;
&lt;/vibe:todo&gt;
                    </x-slot:code>
                </vibe:preview>
            </section>

            {{-- 7. Anti-FOUC Architecture Detail --}}
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

            {{-- 8. JavaScript Events API --}}
            <section id="events" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/todo.events.title') }}</h2>
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

            {{-- 9. Complete Props Reference --}}
            <section id="referensi-props" class="space-y-8">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/todo.props.title') }}</h2>
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
                                    ['nav-buttons', 'bool', 'false', __('docs/todo.props.todo_nav_buttons')],
                                    ['checkbox', 'bool|null', 'null', __('docs/todo.props.todo_checkbox')],
                                    ['reorderable', 'bool', 'true', __('docs/todo.props.todo_reorderable')],
                                    ['drag-handle', 'string|bool', "'visible'", __('docs/todo.props.todo_drag_handle')],
                                    ['persist', 'bool', 'false', __('docs/todo.props.todo_persist')],
                                    ['storage-key', 'string|null', 'null', __('docs/todo.props.todo_storage_key')],
                                    ['gap', 'string', "'3'", __('docs/todo.props.todo_gap')],
                                    ['wire-reorder', 'string|null', 'null', __('docs/todo.props.todo_wire_reorder')],
                                    ['wire-toggle', 'string|null', 'null', __('docs/todo.props.todo_wire_toggle')],
                                    ['wire-delete', 'string|null', 'null', __('docs/todo.props.todo_wire_delete')],
                                    ['wire-add', 'string|null', 'null', __('docs/todo.props.todo_wire_add')],
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
                                    ['nav-buttons', 'bool|null', 'null', __('docs/todo.props.item_nav_buttons')],
                                    ['checkbox', 'bool|null', 'null', __('docs/todo.props.item_checkbox')],
                                    ['completed', 'bool', 'false', __('docs/todo.props.item_completed')],
                                    ['badge', 'string|null', 'null', __('docs/todo.props.item_badge')],
                                    ['badge-variant', 'string', "'default'", __('docs/todo.props.item_badge_variant')],
                                    ['due-date', 'string|null', 'null', __('docs/todo.props.item_due_date')],
                                    ['variant', 'string', "'default'", __('docs/todo.props.item_variant')],
                                    ['reorderable', 'bool', 'true', __('docs/todo.props.item_reorderable')],
                                    ['drag-handle', 'string|bool', "'visible'", __('docs/todo.props.item_drag_handle')],
                                    ['deletable', 'bool', 'true', __('docs/todo.props.item_deletable')],
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
