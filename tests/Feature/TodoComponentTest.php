<?php

use App\Livewire\DemoTodo;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;

test('vibe:todo root container renders properly with anti-fouc SSR structure', function () {
    $html = Blade::render(
        '<vibe:todo id="test-todo" mode="livewire">
            <vibe:todo.item id="1" title="Tugas Pertama" :completed="false" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('id="test-todo"')
        ->toContain('data-vibe-todo')
        ->toContain('data-mode="livewire"')
        ->toContain('data-todo-item="1"')
        ->toContain('Tugas Pertama')
        ->toContain('data-completed="false"');
});

test('vibe:todo.item renders title, checkbox, and handles correctly', function () {
    $html = Blade::render(
        '<vibe:todo.item 
            id="item-42" 
            title="Selesaikan Dokumentasi" 
            description="Lengkapi panduan API dan Livewire"
            :completed="true"
            badge="Penting"
            due-date="Hari Ini"
        />'
    );

    expect($html)
        ->toContain('data-todo-item="item-42"')
        ->toContain('data-completed="true"')
        ->toContain('Selesaikan Dokumentasi')
        ->toContain('Lengkapi panduan API dan Livewire')
        ->toContain('line-through')
        ->toContain('Penting')
        ->toContain('Hari Ini')
        ->toContain('draggable="true"');
});

test('vibe:todo.item includes form hidden inputs for batch submit mode', function () {
    $html = Blade::render(
        '<vibe:todo mode="form" name="my_tasks">
            <vibe:todo.item id="task-99" title="Tugas Form" :order="0" :completed="false" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('data-field="id"')
        ->toContain('data-field="order"')
        ->toContain('data-field="completed"')
        ->toContain('value="task-99"');
});

test('vibe:todo configures persistence and expireHours properly in x-data', function () {
    $html = Blade::render(
        '<vibe:todo id="my-board" :persist="true" storage-key="custom-storage-key" :expire-hours="48">
            <vibe:todo.item id="t1" title="Task 1" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('persist: true')
        ->toContain("storageKey: 'custom-storage-key'")
        ->toContain('expireHours: 48');
});

test('vibe:todo.group renders Kanban column structure', function () {
    $html = Blade::render(
        '<vibe:todo layout="board">
            <vibe:todo.group name="in_progress" title="Sedang Dikerjakan" count="3" color="amber">
                <vibe:todo.item id="k1" title="Tugas Kanban" group="in_progress" />
            </vibe:todo.group>
        </vibe:todo>'
    );

    expect($html)
        ->toContain('data-todo-group="in_progress"')
        ->toContain('data-todo-group-items="in_progress"')
        ->toContain('Sedang Dikerjakan')
        ->toContain('3')
        ->toContain('Tugas Kanban');
});

test('vibe:todo.input renders quick add input with enter shortcut key', function () {
    $html = Blade::render(
        '<vibe:todo.input placeholder="Ketik tugas baru..." button-text="Simpan" />'
    );

    expect($html)
        ->toContain('placeholder="Ketik tugas baru..."')
        ->toContain('Simpan')
        ->toContain('x-model="newTitle"')
        ->toContain('@keydown.enter.prevent');
});

test('Livewire DemoTodo component handles reordering, toggling, adding, and deleting tasks', function () {
    $component = Livewire::test(DemoTodo::class);

    // Initial state check
    $component->assertSee('Riset implementasi CSS Container Queries di Vibe UI');

    // Test toggle task
    $component->call('toggleTask', '1');
    $tasks = $component->get('tasks');
    $task1 = collect($tasks)->firstWhere('id', '1');
    expect($task1['completed'])->toBeTrue();

    // Test add task
    $component->call('addTask', 'Tugas Baru dari Livewire Test');
    $component->assertSee('Tugas Baru dari Livewire Test');

    // Test delete task
    $component->call('deleteTask', '1');
    $component->assertDontSee('Riset implementasi CSS Container Queries di Vibe UI');

    // Test reorder task
    $component->call('updateTaskOrder', ['3', '2', '4']);
    $reorderedTasks = $component->get('tasks');
    expect($reorderedTasks[0]['id'])->toBe('3');
});

test('docs todo page renders successfully without errors', function () {
    $response = $this->get(route('docs.todo.index'));
    $response->assertStatus(200);
    $response->assertSee('livewire / api / form / local', false);
    $response->assertSee('dragOverGroup: null', false);
    $response->assertSee('typeof dragOverGroup !== \'undefined\'', false);
});

test('vibe:todo.item hides checkbox when :checkbox="false"', function () {
    $html = Blade::render(
        '<vibe:todo.item id="no-check-1" title="Kartu Tanpa Checkbox" :checkbox="false" />'
    );

    expect($html)
        ->toContain('Kartu Tanpa Checkbox')
        ->not->toContain('data-todo-checkbox-box');
});

test('vibe:todo layout="board" automatically hides checkbox on items by default', function () {
    $html = Blade::render(
        '<vibe:todo layout="board">
            <vibe:todo.item id="kb-card" title="Kartu Kanban" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('Kartu Kanban')
        ->not->toContain('data-todo-checkbox-box');
});

test('vibe:todo container with :checkbox="false" cascades to child items', function () {
    $html = Blade::render(
        '<vibe:todo :checkbox="false">
            <vibe:todo.item id="cascade-1" title="Item 1" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('Item 1')
        ->not->toContain('data-todo-checkbox-box');

    $htmlWithOverride = Blade::render(
        '<vibe:todo :checkbox="false">
            <vibe:todo.item id="cascade-2" title="Item 2" :checkbox="true" />
        </vibe:todo>'
    );

    expect($htmlWithOverride)
        ->toContain('Item 2')
        ->toContain('data-todo-checkbox-box');
});

test('vibe:todo layout="board" hides column navigation buttons by default', function () {
    $html = Blade::render(
        '<vibe:todo layout="board">
            <vibe:todo.group name="todo" title="To Do">
                <vibe:todo.item id="nav-item-1" title="Tugas Navigasi" group="todo" />
            </vibe:todo.group>
        </vibe:todo>'
    );

    expect($html)
        ->toContain('Tugas Navigasi')
        ->not->toContain('canMovePrev(\'nav-item-1\')')
        ->not->toContain('moveToPrevGroup(\'nav-item-1\')');
});

test('vibe:todo renders column navigation buttons when :nav-buttons="true"', function () {
    $html = Blade::render(
        '<vibe:todo layout="board" :nav-buttons="true">
            <vibe:todo.group name="todo" title="To Do">
                <vibe:todo.item id="nav-item-1" title="Tugas Navigasi" group="todo" />
            </vibe:todo.group>
        </vibe:todo>'
    );

    expect($html)
        ->toContain('canMovePrev(\'nav-item-1\')')
        ->toContain('moveToPrevGroup(\'nav-item-1\')')
        ->toContain('canMoveNext(\'nav-item-1\')')
        ->toContain('moveToNextGroup(\'nav-item-1\')')
        ->toContain('Pindahkan ke kolom sebelumnya')
        ->toContain('Pindahkan ke kolom selanjutnya');
});

test('vibe:todo.item :nav-buttons="true" enables buttons individually', function () {
    $html = Blade::render(
        '<vibe:todo layout="board">
            <vibe:todo.group name="todo" title="To Do">
                <vibe:todo.item id="nav-item-1" title="Item 1" group="todo" :nav-buttons="true" />
                <vibe:todo.item id="nav-item-2" title="Item 2" group="todo" />
            </vibe:todo.group>
        </vibe:todo>'
    );

    expect($html)
        ->toContain('canMovePrev(\'nav-item-1\')')
        ->not->toContain('canMovePrev(\'nav-item-2\')');
});

test('vibe:todo.item is directly draggable by default without requiring separate drag handle icon', function () {
    $htmlDefault = Blade::render(
        '<vibe:todo>
            <vibe:todo.item id="default-item-1" title="Item Default" />
        </vibe:todo>'
    );

    expect($htmlDefault)
        ->toContain('data-todo-item="default-item-1"')
        ->toContain('draggable="true"')
        ->toContain('cursor-grab')
        ->not->toContain('aria-label="Drag to reorder"')
        ->toContain('opacity-0 group-hover:opacity-100 focus:opacity-100');
});

test('vibe:todo supports lock option to disable dragging and lock item', function () {
    $htmlLocked = Blade::render(
        '<vibe:todo>
            <vibe:todo.item id="locked-item-1" title="Item Locked" :lock="true" />
        </vibe:todo>'
    );

    expect($htmlLocked)
        ->toContain('data-todo-item="locked-item-1"')
        ->toContain('draggable="false"')
        ->toContain('data-locked="true"')
        ->toContain('title="Terkunci (tidak dapat dipindah)"');
});

test('vibe:todo defaults to having NO checkbox on items in list layout', function () {
    $html = Blade::render(
        '<vibe:todo layout="list">
            <vibe:todo.item id="default-list-item" title="Tugas Default List" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('Tugas Default List')
        ->not->toContain('data-todo-checkbox-box');
});

test('vibe:todo supports explicit checkbox prop on container and item', function () {
    $htmlWithTodoCheckbox = Blade::render(
        '<vibe:todo :checkbox="true">
            <vibe:todo.item id="check-item-1" title="Tugas dengan Checkbox Global" />
        </vibe:todo>'
    );

    expect($htmlWithTodoCheckbox)
        ->toContain('data-todo-checkbox-box');

    $htmlWithItemCheckbox = Blade::render(
        '<vibe:todo>
            <vibe:todo.item id="check-item-2" title="Tugas dengan Checkbox Item" :checkbox="true" />
            <vibe:todo.item id="check-item-3" title="Tugas Tanpa Checkbox" />
        </vibe:todo>'
    );

    expect($htmlWithItemCheckbox)
        ->toContain('data-todo-item="check-item-2"')
        ->toContain('data-todo-checkbox-box');
});

test('vibe:todo supports lock option to prevent items from being moved', function () {
    // 1. Lock on specific item
    $htmlItemLock = Blade::render(
        '<vibe:todo>
            <vibe:todo.item id="free-item" title="Item Bebas" />
            <vibe:todo.item id="locked-item" title="Item Terkunci" lock />
        </vibe:todo>'
    );

    expect($htmlItemLock)
        ->toContain('data-todo-item="free-item"')
        ->toContain('data-todo-item="locked-item"')
        ->toContain('data-locked="true"')
        ->toContain('title="Terkunci (tidak dapat dipindah)"');

    // 2. Lock on container locks all items
    $htmlTodoLock = Blade::render(
        '<vibe:todo :lock="true">
            <vibe:todo.item id="all-locked-1" title="Semua Terkunci 1" />
        </vibe:todo>'
    );

    expect($htmlTodoLock)
        ->toContain('data-locked="true"')
        ->toContain('draggable="false"')
        ->toContain('title="Terkunci (tidak dapat dipindah)"')
        ->not->toContain('aria-label="Drag to reorder"');
});

test('locked items in board mode do not show navigation buttons', function () {
    $html = Blade::render(
        '<vibe:todo layout="board" :nav-buttons="true">
            <vibe:todo.group name="col_a" title="Kolom A">
                <vibe:todo.item id="movable" title="Bisa Pindah" group="col_a" />
                <vibe:todo.item id="immovable" title="Tidak Bisa Pindah" group="col_a" :lock="true" />
            </vibe:todo.group>
            <vibe:todo.group name="col_b" title="Kolom B">
            </vibe:todo.group>
        </vibe:todo>'
    );

    expect($html)
        ->toContain('canMoveNext(\'movable\')')
        ->not->toContain('canMoveNext(\'immovable\')');
});

test('vibe:todo.item supports inline editing when editable=true', function () {
    $html = Blade::render(
        '<vibe:todo>
            <vibe:todo.item id="edit-1" title="Kartu Bisa Diedit" :editable="true" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('x-data="{')
        ->toContain('@dblclick.stop="startEdit()"')
        ->toContain('x-ref="titleInput"')
        ->toContain('saveEdit()')
        ->toContain('cancelEdit()')
        ->toContain('title="Ubah judul"');
});

test('vibe:todo.item supports multi-labels array and custom labels slot', function () {
    // Array labels
    $htmlArray = Blade::render(
        '<vibe:todo>
            <vibe:todo.item id="item-labels" title="Multi Label" :labels="[[\'text\' => \'Bug\', \'variant\' => \'destructive\'], [\'text\' => \'UI\', \'variant\' => \'primary\']]" />
        </vibe:todo>'
    );

    expect($htmlArray)
        ->toContain('Bug')
        ->toContain('UI')
        ->toContain('bg-destructive');

    // Slot labels
    $htmlSlot = Blade::render(
        '<vibe:todo>
            <vibe:todo.item id="item-slot-labels" title="Slot Label">
                <x-slot:labels>
                    <span class="custom-label">Custom Label Tag</span>
                </x-slot:labels>
            </vibe:todo.item>
        </vibe:todo>'
    );

    expect($htmlSlot)
        ->toContain('custom-label')
        ->toContain('Custom Label Tag');
});

test('vibe:todo.item supports smart due date urgency styling', function () {
    $html = Blade::render(
        '<vibe:todo>
            <vibe:todo.item id="overdue-item" title="Tugas Lewat" due-date="2020-01-01" />
            <vibe:todo.item id="upcoming-item" title="Tugas Masa Depan" due-date="2099-12-31" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('title="Terlewat / Overdue"')
        ->toContain('text-destructive bg-destructive/10')
        ->toContain('2020-01-01')
        ->toContain('2099-12-31');
});

test('vibe:todo.item supports assignee avatars and avatar stack', function () {
    $html = Blade::render(
        '<vibe:todo>
            <vibe:todo.item id="assignee-item" title="Punya Assignee" :assignees="[[\'name\' => \'Alex Johnson\'], [\'name\' => \'Maria Garcia\']]" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('vibe-avatar-group')
        ->toContain('data-avatar')
        ->toContain('AJ')
        ->toContain('MG');
});

test('vibe:todo.subtask renders correctly with checkbox and title', function () {
    $html = Blade::render(
        '<vibe:todo.subtask id="sub-1" title="Subtask Test Title" :completed="true" />'
    );

    expect($html)
        ->toContain('data-todo-subtask="sub-1"')
        ->toContain('data-completed="true"')
        ->toContain('Subtask Test Title')
        ->toContain('line-through');
});

test('vibe:todo.subitem renders progress bar and counter with shortcut props or slot', function () {
    $html = Blade::render(
        '<vibe:todo.subitem :total="8" :completed="6" color="indigo" title="Subtasks" />'
    );

    expect($html)
        ->toContain('Subtasks')
        ->toContain('6/8')
        ->toContain('75%')
        ->toContain('bg-indigo-600');
});

test('vibe:todo supports full compound subcomponents (header, content, subitem, footer)', function () {
    $html = Blade::render(
        '<vibe:todo layout="board" :editable="true">
            <vibe:todo.item id="modern-task" :lock="true">
                <vibe:todo.header class="custom-header">
                    <span class="badge">High</span>
                </vibe:todo.header>
                <vibe:todo.content class="custom-content">
                    <vibe:todo.title :editable="true">Design System</vibe:todo.title>
                    <vibe:todo.description>Create UI components</vibe:todo.description>
                </vibe:todo.content>
                <vibe:todo.subitem class="custom-subitem">
                    <div class="custom-progress">75% Progress</div>
                </vibe:todo.subitem>
                <vibe:todo.footer class="custom-footer">
                    <button>Done</button>
                </vibe:todo.footer>
            </vibe:todo.item>
        </vibe:todo>'
    );

    expect($html)
        ->toContain('custom-header')
        ->toContain('title="Terkunci (tidak dapat dipindah)"')
        ->toContain('custom-content')
        ->toContain('data-todo-title')
        ->toContain('Design System')
        ->toContain('data-todo-description')
        ->toContain('Create UI components')
        ->toContain('custom-subitem')
        ->toContain('75% Progress')
        ->toContain('custom-footer')
        ->toContain('Done');
});

test('vibe:todo.item supports subtasks via array prop', function () {
    $html = Blade::render(
        '<vibe:todo>
            <vibe:todo.item id="array-task" title="Array Prop Task" :subtasks="[
                [\'id\' => \'sub-a\', \'title\' => \'Subtask A\', \'completed\' => true],
                [\'id\' => \'sub-b\', \'title\' => \'Subtask B\', \'completed\' => false]
            ]" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('Array Prop Task')
        ->toContain('Subtask A')
        ->toContain('Subtask B')
        ->toContain('data-todo-subtask="sub-a"')
        ->toContain('data-todo-subtask="sub-b"');
});

test('vibe:todo.group supports quick add per column', function () {
    $html = Blade::render(
        '<vibe:todo layout="board">
            <vibe:todo.group name="todo" title="To Do" :quick-add="true" quick-add-text="Buat Tugas Baru">
                <vibe:todo.item id="t-1" title="Tugas 1" />
            </vibe:todo.group>
        </vibe:todo>'
    );

    expect($html)
        ->toContain('Buat Tugas Baru')
        ->toContain('Judul tugas baru...')
        ->toContain('vibe:todo-add');
});

test('vibe:todo.group supports wip limit and warning calculation', function () {
    $html = Blade::render(
        '<vibe:todo layout="board">
            <vibe:todo.group name="progress" title="In Progress" :count="4" :max="3">
                <vibe:todo.item id="t-1" title="Tugas 1" />
            </vibe:todo.group>
        </vibe:todo>'
    );

    expect($html)
        ->toContain('data-wip-max="3"')
        ->toContain('isOverWip()')
        ->toContain('/3');
});

test('vibe:todo.group supports collapsible columns', function () {
    $html = Blade::render(
        '<vibe:todo layout="board">
            <vibe:todo.group name="done" title="Selesai" :collapsible="true" :collapsed="true">
                <vibe:todo.item id="t-1" title="Tugas 1" />
            </vibe:todo.group>
        </vibe:todo>'
    );

    expect($html)
        ->toContain('isCollapsed: true')
        ->toContain('isCollapsible: true')
        ->toContain('Buka kolom Selesai')
        ->toContain('Lipat kolom');
});

test('vibe:todo supports live client-side search bar', function () {
    $html = Blade::render(
        '<vibe:todo :searchable="true" search-placeholder="Filter seluruh tugas...">
            <vibe:todo.item id="t-1" title="Item Pertama" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('data-todo-search-container')
        ->toContain('Filter seluruh tugas...')
        ->toContain('searchQuery')
        ->toContain('filterItems');
});

test('vibe:todo.item can be filled with custom HTML in default slot for developer custom designs', function () {
    $html = Blade::render(
        '<vibe:todo.item id="custom-card-1">
            <div class="p-2 bg-muted rounded-lg">
                Catatan Pesanan: Pedas manis
            </div>
            <div class="text-[11px] text-muted-foreground flex items-center gap-1">
                <span>Lihat Rincian (2 item)</span>
            </div>
            <div class="flex justify-between mt-2 items-center">
                <vibe:badge variant="secondary" size="sm">Meja 4</vibe:badge>
                <vibe:badge size="sm">5m lalu</vibe:badge>
            </div>
        </vibe:todo.item>'
    );

    expect($html)
        ->toContain('data-todo-custom-content')
        ->toContain('Catatan Pesanan: Pedas manis')
        ->toContain('Lihat Rincian (2 item)')
        ->toContain('Meja 4')
        ->toContain('5m lalu');
});

test('vibe:todo.item supports custom content and actions slots simultaneously', function () {
    $html = Blade::render(
        '<vibe:todo.item id="card-with-actions" title="Pesanan #101" badge="Dine-In">
            <x-slot:content>
                <div class="p-2 bg-muted rounded-lg">
                    Catatan Pesanan: Tanpa Es
                </div>
            </x-slot:content>
            <x-slot:actions>
                <vibe:button size="sm" variant="primary" class="w-full">
                    Mulai Masak
                </vibe:button>
            </x-slot:actions>
        </vibe:todo.item>'
    );

    expect($html)
        ->toContain('Pesanan #101')
        ->toContain('Dine-In')
        ->toContain('data-todo-custom-content')
        ->toContain('Catatan Pesanan: Tanpa Es')
        ->toContain('data-todo-actions')
        ->toContain('Mulai Masak');
});

test('vibe:todo supports dedicated title and description subcomponents inside item slot', function () {
    $html = Blade::render(
        '<vibe:todo.item id="item-with-subcomponents" :deletable="false">
            <vibe:todo.title>Antrian #05</vibe:todo.title>
            <vibe:todo.description>Pelanggan: Budi</vibe:todo.description>
            <div class="note-box">Catatan Tambahan</div>
        </vibe:todo.item>'
    );

    expect($html)
        ->toContain('data-todo-title')
        ->toContain('Antrian #05')
        ->toContain('data-todo-description')
        ->toContain('Pelanggan: Budi')
        ->toContain('note-box')
        ->toContain('Catatan Tambahan');
});

test('vibe:todo :editable="true" properly enables inline edit mode on title and description subcomponents', function () {
    $html = Blade::render(
        '<vibe:todo :editable="true">
            <vibe:todo.item id="editable-item">
                <vibe:todo.title>Tugas Dapat Diedit</vibe:todo.title>
                <vibe:todo.description>Deskripsi Dapat Diedit</vibe:todo.description>
            </vibe:todo.item>
        </vibe:todo>'
    );

    expect($html)
        ->toContain('vibe:todo-item-update')
        ->toContain('titleInput')
        ->toContain('descInput')
        ->toContain('Ubah judul')
        ->toContain('Ubah deskripsi')
        ->toContain('startEdit()')
        ->toContain('saveEdit()');
});

test('vibe:todo.item does not render auto delete button when custom header subcomponent is used', function () {
    $html = Blade::render(
        '<vibe:todo>
            <vibe:todo.item id="custom-header-item">
                <vibe:todo.header>
                    <span class="custom-badge">High</span>
                    <button type="button" class="three-dots-menu">...</button>
                </vibe:todo.header>
                <vibe:todo.content>
                    <vibe:todo.title>Judul Kartu</vibe:todo.title>
                </vibe:todo.content>
            </vibe:todo.item>
        </vibe:todo>'
    );

    expect($html)
        ->toContain('data-todo-header')
        ->toContain('three-dots-menu')
        ->not->toContain('aria-label="Hapus tugas"');
});

test('vibe:todo.item supports :lockable="true" to render interactive lock toggle button', function () {
    $html = Blade::render(
        '<vibe:todo>
            <vibe:todo.item id="lockable-item" title="Tugas Interaktif" :lockable="true" />
            <vibe:todo.item id="static-locked-item" title="Tugas Statis" :lock="true" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('data-todo-lock-btn')
        ->toContain('toggleLock(\'lockable-item\')')
        ->toContain('data-lock-icon-locked')
        ->toContain('data-lock-icon-unlocked')
        ->toContain('data-todo-lock-indicator');
});

test('vibe:todo.header supports :lockable="true" to render interactive lock toggle button in header', function () {
    $html = Blade::render(
        '<vibe:todo>
            <vibe:todo.item id="header-lockable-item">
                <vibe:todo.header :lockable="true">
                    <span>Tag</span>
                </vibe:todo.header>
                <vibe:todo.title>Tugas dengan Header Lock</vibe:todo.title>
            </vibe:todo.item>
        </vibe:todo>'
    );

    expect($html)
        ->toContain('data-todo-lock-btn')
        ->toContain('toggleLock($el.closest(\'[data-todo-item]\')');
});

test('vibe:todo with :lockable="true" propagates lockable state to all child items', function () {
    $html = Blade::render(
        '<vibe:todo :lockable="true">
            <vibe:todo.item id="inherited-lockable-item" title="Tugas Warisan" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('data-todo-lock-btn')
        ->toContain('toggleLock(\'inherited-lockable-item\')');
});








