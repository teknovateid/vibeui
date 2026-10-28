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

test('vibe:todo supports drag-handle="hover" mode', function () {
    $html = Blade::render(
        '<vibe:todo drag-handle="hover">
            <vibe:todo.item id="hover-item-1" title="Item Hover" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('data-todo-item="hover-item-1"')
        ->toContain('opacity-0 group-hover:opacity-100')
        ->toContain('aria-label="Drag to reorder"');
});

test('vibe:todo supports drag-handle="hidden" and :drag-handle="false" mode', function () {
    $htmlHidden = Blade::render(
        '<vibe:todo drag-handle="hidden">
            <vibe:todo.item id="hidden-item-1" title="Item Hidden" />
        </vibe:todo>'
    );

    expect($htmlHidden)
        ->toContain('data-todo-item="hidden-item-1"')
        ->not->toContain('aria-label="Drag to reorder"');

    $htmlFalse = Blade::render(
        '<vibe:todo :drag-handle="false">
            <vibe:todo.item id="hidden-item-2" title="Item False" />
        </vibe:todo>'
    );

    expect($htmlFalse)
        ->toContain('data-todo-item="hidden-item-2"')
        ->not->toContain('aria-label="Drag to reorder"');
});

test('vibe:todo.item can override drag-handle per item', function () {
    $html = Blade::render(
        '<vibe:todo drag-handle="hidden">
            <vibe:todo.item id="item-override-1" title="Item 1" drag-handle="visible" />
            <vibe:todo.item id="item-override-2" title="Item 2" />
        </vibe:todo>'
    );

    expect($html)
        ->toContain('data-todo-item="item-override-1"')
        ->toContain('aria-label="Drag to reorder"');
});

