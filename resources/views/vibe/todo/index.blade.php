@blaze

@props([
    'id' => null,
    'mode' => 'local', // 'livewire', 'api', 'form', 'local'
    'name' => 'todos', // for form mode: name="todos[i][id]"
    'reorderable' => true,
    'persist' => false,
    'storageKey' => null,
    'endpoint' => null,
    'reorderUrl' => null,
    'toggleUrl' => null,
    'deleteUrl' => null,
    'addUrl' => null,
    'updateUrl' => null,
    'wireReorder' => null,
    'wireToggle' => null,
    'wireDelete' => null,
    'wireAdd' => null,
    'wireUpdate' => null,
    'layout' => 'list', // 'list' | 'board'
    'gap' => '3',
    'checkbox' => null,
    'checkable' => null,
    'navButtons' => false, // show/hide ← → column navigation buttons on items (default hidden)
    'dragHandle' => null, // 'visible', 'hover', 'hidden'
    'dragIndicator' => null,
    'handle' => null,
    'expireHours' => 24 * 30,
    'lock' => false,
    'locked' => false,
    'editable' => false,
    'quickAdd' => false,
    'searchable' => false,
    'searchPlaceholder' => null,
    'keyboardNavigation' => true,
])

@php
    $todoId = $id ?? 'vibe-todo-' . Str::random(8);

    $gapClass = match ($gap) {
        '1', 'gap-1' => 'gap-1',
        '2', 'gap-2' => 'gap-2',
        '4', 'gap-4' => 'gap-4',
        '6', 'gap-6' => 'gap-6',
        default => 'gap-3',
    };

    $layoutClass = match ($layout) {
        'board', 'kanban' => 'flex flex-col md:flex-row items-stretch overflow-x-auto pb-2 gap-4 w-full h-full min-h-0',
        default => "flex flex-col w-full {$gapClass}",
    };
@endphp

@pushOnce('head', 'vibe-todo-scripts')
    @vite('resources/js/vibe/todo.js')

    <script>
        (function () {
            'use strict';

            function resolveViteTodoUrl() {
                var links = document.querySelectorAll('link[rel="modulepreload"]');
                for (var i = 0; i < links.length; i++) {
                    if (links[i].href && links[i].href.indexOf('todo') !== -1) {
                        return links[i].href;
                    }
                }
                var scripts = document.querySelectorAll('script[type="module"]');
                for (var j = 0; j < scripts.length; j++) {
                    if (scripts[j].src && scripts[j].src.indexOf('todo') !== -1) {
                        return scripts[j].src;
                    }
                }
                return null;
            }

            var todoModulePromise = null;

            function loadTodoModule() {
                if (todoModulePromise) return todoModulePromise;
                var url = resolveViteTodoUrl();
                if (!url) {
                    todoModulePromise = Promise.reject(new Error('[Vibe Todo] Could not resolve todo.js URL'));
                } else {
                    todoModulePromise = import(url).then(function (mod) {
                        var todoFn = (mod && mod.vibeTodo) ? mod.vibeTodo : (mod && mod.default ? mod.default : window.vibeTodo);
                        if (todoFn && typeof window !== 'undefined') {
                            window.vibeTodo = todoFn;
                            if (window.Alpine && typeof window.Alpine.data === 'function') {
                                window.Alpine.data('vibeTodo', todoFn);
                            }
                            window.dispatchEvent(new CustomEvent('vibe-todo-ready'));
                        }
                        return mod;
                    });
                }
                return todoModulePromise;
            }

            function reinitTodoElements() {
                if (!window.Alpine) return;
                var roots = document.querySelectorAll('[data-vibe-todo]');
                roots.forEach(function (el) {
                    var stack = el._x_dataStack;
                    var data = stack && stack[0];
                    var isProperlyInit = data && typeof data.discoverItemsFromDom === 'function';

                    if (!isProperlyInit) {
                        try {
                            if (typeof window.Alpine.destroyTree === 'function') {
                                window.Alpine.destroyTree(el);
                            } else {
                                ['_x_dataStack', '_x_effects', '_x_cleanups', '_x_attributeCleanups',
                                 '_x_bindings', '_x_runEffects', '_x_ignore', '_x_refs'
                                ].forEach(function (k) { try { delete el[k]; } catch(e){} });
                            }
                            if (typeof window.Alpine.initTree === 'function') {
                                window.Alpine.initTree(el);
                            }
                        } catch (e) {
                            console.warn('[Vibe Todo] Re-init error:', e);
                        }
                    }
                    if (el.hasAttribute('x-cloak')) el.removeAttribute('x-cloak');
                });
            }

            document.addEventListener('alpine:init', function () {
                loadTodoModule()
                    .then(function () {
                        setTimeout(reinitTodoElements, 0);
                    })
                    .catch(function (e) {
                        console.warn('[Vibe Todo] Module load error during alpine:init:', e);
                    });
            });

            document.addEventListener('livewire:init', function () {
                loadTodoModule()
                    .then(function () {
                        setTimeout(reinitTodoElements, 0);
                    })
                    .catch(function () {});
            });

            document.addEventListener('livewire:navigated', function () {
                loadTodoModule()
                    .then(function () {
                        [50, 150, 300].forEach(function (d) {
                            setTimeout(reinitTodoElements, d);
                        });
                    })
                    .catch(function () {});
            });

            var observer = new MutationObserver(function (mutations) {
                var hasNewTodo = false;
                for (var i = 0; i < mutations.length; i++) {
                    var added = mutations[i].addedNodes;
                    for (var j = 0; j < added.length; j++) {
                        var node = added[j];
                        if (node.nodeType === 1) {
                            if (
                                (node.hasAttribute && node.hasAttribute('data-vibe-todo')) ||
                                (node.querySelector && node.querySelector('[data-vibe-todo]'))
                            ) {
                                hasNewTodo = true;
                                break;
                            }
                        }
                    }
                    if (hasNewTodo) break;
                }

                if (hasNewTodo) {
                    loadTodoModule()
                        .then(function () {
                            setTimeout(reinitTodoElements, 50);
                        })
                        .catch(function () {});
                }
            });

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function () {
                    observer.observe(document.body, { childList: true, subtree: true });
                    loadTodoModule().then(function () {
                        setTimeout(reinitTodoElements, 0);
                    });
                });
            } else {
                observer.observe(document.body, { childList: true, subtree: true });
                loadTodoModule().then(function () {
                    setTimeout(reinitTodoElements, 0);
                });
            }
        })();
    </script>
@endPushOnce

<div
    id="{{ $todoId }}"
    data-vibe-todo
    data-mode="{{ $mode }}"
    @if ($lock || $locked) data-locked="true" @endif
    {{ $attributes->twMerge(['class' => "relative w-full {$layoutClass} transition-colors select-none"]) }}
    x-data="typeof window.vibeTodo === 'function' ? window.vibeTodo({
        id: @js($todoId),
        mode: @js($mode),
        name: @js($name),
        reorderable: @js((bool) $reorderable),
        locked: @js((bool) ($lock || $locked)),
        persist: @js((bool) $persist),
        storageKey: @js($storageKey ?: ''),
        expireHours: @js($expireHours),
        endpoint: @js($endpoint ?: ''),
        reorderUrl: @js($reorderUrl ?: ''),
        toggleUrl: @js($toggleUrl ?: ''),
        deleteUrl: @js($deleteUrl ?: ''),
        addUrl: @js($addUrl ?: ''),
        updateUrl: @js($updateUrl ?: ''),
        wireReorder: @js($wireReorder ?: ''),
        wireToggle: @js($wireToggle ?: ''),
        wireDelete: @js($wireDelete ?: ''),
        wireAdd: @js($wireAdd ?: ''),
        wireUpdate: @js($wireUpdate ?: ''),
        editable: @js((bool) $editable),
        searchable: @js((bool) $searchable),
        keyboardNavigation: @js((bool) $keyboardNavigation),
    }) : {
        id: @js($todoId),
        mode: @js($mode),
        items: [],
        searchQuery: '',
        filterItems() {},
        isDragging: false,
        wasDragging: false,
        draggingId: null,
        draggingGroup: null,
        dragOverId: null,
        dragOverPosition: null,
        dragOverGroup: null,
        newTitle: '',
        init() {
            var self = this;
            var isBound = false;
            var bindTodo = function() {
                if (isBound) return;
                if (typeof window.vibeTodo === 'function') {
                    isBound = true;
                    clearInterval(timer);
                    if (window.Alpine && typeof window.Alpine.initTree === 'function' && self.$el) {
                        var el = self.$el;
                        if (typeof window.Alpine.destroyTree === 'function') {
                            try { window.Alpine.destroyTree(el); } catch (e) {}
                        }
                        delete el._x_dataStack;
                        window.Alpine.initTree(el);
                    }
                }
            };

            window.addEventListener('vibe-todo-ready', bindTodo, { once: true });
            var timer = setInterval(function() {
                if (typeof window.vibeTodo === 'function') {
                    bindTodo();
                }
            }, 25);
            setTimeout(function() { clearInterval(timer); }, 3000);
        },
        onDragStart() {},
        onDragOver() {},
        onDragLeave() {},
        onDrop() {},
        onDragEnd() {},
        onDragOverGroup() {},
        onDragLeaveGroup() {},
        onDropGroup() {},
        getGroupCount() { return 0; },
        getGroups() { return []; },
        canMovePrev() { return false; },
        canMoveNext() { return false; },
        moveToNextGroup() {},
        moveToPrevGroup() {},
        toggle() {},
        remove() {},
        updateItem() {},
        add() {},
        clearStorage() {},
        resetStorage() {}
    }"
    @vibe:todo-add="typeof add === 'function' ? add($event.detail.title, $event.detail.group) : null"
    :class="{ 'vibe-todo-dragging': isDragging }"
>
    @if ($searchable)
        <div class="relative w-full mb-3" data-todo-search-container>
            <div class="relative flex items-center">
                <svg class="size-4 absolute left-3.5 text-muted-foreground/70 pointer-events-none select-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input
                    type="text"
                    x-model="searchQuery"
                    @input="typeof filterItems === 'function' ? filterItems(searchQuery) : null"
                    placeholder="{{ $searchPlaceholder ?? 'Cari tugas...' }}"
                    class="w-full pl-10 pr-9 py-2 text-xs rounded-xl border border-input bg-background/80 text-foreground focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary transition-all placeholder:text-muted-foreground/60 shadow-2xs"
                />
                <button
                    type="button"
                    x-show="searchQuery"
                    @click="searchQuery = ''; if (typeof filterItems === 'function') filterItems('');"
                    class="absolute right-2.5 p-1 rounded-md text-muted-foreground hover:text-foreground cursor-pointer text-xs"
                >
                    ✕
                </button>
            </div>
        </div>
    @endif

    {{ $slot }}
</div>
