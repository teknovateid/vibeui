/**
 * Vibe UI - Realtime Todo & Drag-and-Drop Component for Alpine.js
 * Supports Tri-Mode Data Sync: Livewire 3 Realtime, REST API (Async), and Form Batch Submit.
 * Anti-FOUC Architecture: Progressively hydratable from Server-Side Rendered Blade HTML.
 */

if (typeof window !== 'undefined' && !window.VibeTodo) {
    window.VibeTodo = {
        getStorageKey() {
            const prefix = window.VIBE_PREFIX || 'vibe';
            return `${prefix}-todo`;
        },
        getAll() {
            try {
                const raw = localStorage.getItem(this.getStorageKey());
                const parsed = raw ? JSON.parse(raw) : [];
                return Array.isArray(parsed) ? parsed : [];
            } catch (e) {
                return [];
            }
        },
        get(id) {
            const items = this.getAll();
            const now = Date.now();
            const entry = items.find(item => item && item.id === id);
            if (entry && (!entry.expiredAt || entry.expiredAt > now)) {
                return entry.data;
            }
            return null;
        },
        save(id, data, expireHours = 24 * 30) {
            try {
                const key = this.getStorageKey();
                let items = this.getAll();
                const now = Date.now();
                items = items.filter(item => item && (!item.expiredAt || item.expiredAt > now));

                const expirationDate = new Date();
                expirationDate.setHours(expirationDate.getHours() + expireHours);

                const newEntry = {
                    id: id,
                    data: data,
                    expiredAt: expirationDate.getTime()
                };

                const existingIndex = items.findIndex(item => item && item.id === id);
                if (existingIndex > -1) {
                    items[existingIndex] = newEntry;
                } else {
                    items.push(newEntry);
                }

                localStorage.setItem(key, JSON.stringify(items));
            } catch (e) {}
        },
        clear(id) {
            try {
                const key = this.getStorageKey();
                let items = this.getAll();
                if (id) {
                    items = items.filter(item => item && item.id !== id);
                    localStorage.setItem(key, JSON.stringify(items));
                    const prefix = window.VIBE_PREFIX || 'vibe';
                    localStorage.removeItem(`${prefix}-todo-${id}`);
                    localStorage.removeItem(id);
                } else {
                    localStorage.removeItem(key);
                }
            } catch (e) {}
        }
    };
}

export function vibeTodo(config = {}) {
    return {
        id: config.id || 'vibe-todo',
        mode: config.mode || 'local', // 'livewire', 'api', 'form', 'local'
        name: config.name || 'todos',
        reorderable: config.reorderable ?? true,
        persist: config.persist ?? false,
        storageKey: config.storageKey || '',
        expireHours: typeof config.expireHours === 'number' ? config.expireHours : (24 * 30),
        endpoint: config.endpoint || '',
        reorderUrl: config.reorderUrl || '',
        toggleUrl: config.toggleUrl || '',
        deleteUrl: config.deleteUrl || '',
        addUrl: config.addUrl || '',
        wireReorder: config.wireReorder || '',
        wireToggle: config.wireToggle || '',
        wireDelete: config.wireDelete || '',
        wireAdd: config.wireAdd || '',

        // Drag & Drop State
        draggingId: null,
        draggingGroup: null,
        dragOverId: null,
        dragOverPosition: null, // 'before' | 'after'
        dragOverGroup: null,
        isDragging: false,
        wasDragging: false,

        // Managed Items
        items: [],
        newTitle: '',
        rootEl: null,

        getRootEl() {
            if (this.rootEl && this.rootEl.isConnected) {
                return this.rootEl;
            }
            if (this.$el) {
                const closestRoot = typeof this.$el.closest === 'function' 
                    ? (this.$el.closest('[data-vibe-todo]') || this.$el.closest(`[id="${this.id}"]`)) 
                    : null;
                if (closestRoot) {
                    this.rootEl = closestRoot;
                    return closestRoot;
                }
            }
            if (this.id) {
                const elById = document.getElementById(this.id) || document.querySelector(`[data-vibe-todo][id="${this.id}"]`);
                if (elById) {
                    this.rootEl = elById;
                    return elById;
                }
            }
            return this.$el;
        },

        init() {
            this.rootEl = this.getRootEl();

            const prefix = window.VIBE_PREFIX || 'vibe';
            this.rootStorageKey = `${prefix}-todo`;
            this.entryId = this.storageKey || this.id || 'default';
            this.storageKey = this.entryId;
            this.expireHours = typeof config.expireHours === 'number' ? config.expireHours : (24 * 30);

            // Progressive Hydration: discover items from server-rendered Blade DOM (0ms FOUC)
            this.discoverItemsFromDom();

            // Load stored order if local persistence is active
            if (this.persist && this.mode === 'local') {
                this.loadStoredState();
            }

            // If form mode, sync hidden input index numbers
            if (this.mode === 'form') {
                this.syncFormInputs();
            }

            // Setup mobile & touch drag-and-drop support
            this.setupTouchDrag();

            // Notify ready state
            const root = this.getRootEl();
            if (root && root.classList) {
                root.classList.add('vibe-todo-ready');
            }
        },

        discoverItemsFromDom() {
            const root = this.getRootEl();
            if (!root) return;
            const itemEls = root.querySelectorAll('[data-todo-item]');
            const discovered = [];

            itemEls.forEach((el, index) => {
                const id = el.dataset.id || el.getAttribute('data-todo-item');
                const completed = el.dataset.completed === 'true' || el.getAttribute('data-completed') === 'true';
                
                // Inherit group from closest group wrapper if not set directly on element
                let group = el.dataset.group || null;
                if (!group) {
                    const parentGroup = el.closest('[data-todo-group]');
                    if (parentGroup) {
                        group = parentGroup.dataset.todoGroup || parentGroup.getAttribute('data-todo-group') || null;
                        if (group) {
                            el.dataset.group = group;
                        }
                    }
                }

                const order = el.dataset.order !== undefined && el.dataset.order !== '' 
                    ? parseInt(el.dataset.order, 10) 
                    : index;

                discovered.push({
                    id: String(id),
                    completed: Boolean(completed),
                    group: group ? String(group) : null,
                    order: order,
                    el: el
                });
            });

            this.items = discovered;
        },

        getGroupCount(groupName) {
            if (!groupName) return 0;
            return this.items.filter(i => i.group === String(groupName)).length;
        },

        loadStoredState() {
            try {
                let parsed = null;
                // 1. Try from window.VibeTodo or localStorage root key 'vibe-todo'
                if (typeof window.VibeTodo !== 'undefined' && typeof window.VibeTodo.get === 'function') {
                    parsed = window.VibeTodo.get(this.entryId);
                } else {
                    const raw = localStorage.getItem(this.rootStorageKey);
                    if (raw) {
                        const all = JSON.parse(raw);
                        if (Array.isArray(all)) {
                            const now = Date.now();
                            const entry = all.find(item => item && item.id === this.entryId);
                            if (entry && (!entry.expiredAt || entry.expiredAt > now)) {
                                parsed = entry.data;
                            }
                        }
                    }
                }

                // 2. Migration fallback: check legacy localStorage key if not found in root key
                if (!parsed) {
                    const prefix = window.VIBE_PREFIX || 'vibe';
                    const legacyKey = `${prefix}-todo-${this.id}`;
                    const customLegacyKey = this.storageKey && this.storageKey !== this.id ? this.storageKey : null;
                    const legacyRaw = localStorage.getItem(legacyKey) || (customLegacyKey ? localStorage.getItem(customLegacyKey) : null);
                    if (legacyRaw) {
                        try {
                            const legacyData = JSON.parse(legacyRaw);
                            if (Array.isArray(legacyData) && legacyData.length > 0) {
                                parsed = legacyData;
                                // Automatically migrate to new structure!
                                this.saveStoredData(legacyData);
                                localStorage.removeItem(legacyKey);
                                if (customLegacyKey) localStorage.removeItem(customLegacyKey);
                            }
                        } catch (e) {}
                    }
                }

                if (Array.isArray(parsed) && parsed.length > 0) {
                    const orderMap = new Map();
                    parsed.forEach((stored, idx) => {
                        if (stored && stored.id !== undefined) {
                            orderMap.set(String(stored.id), {
                                order: typeof stored.order === 'number' ? stored.order : idx,
                                completed: !!stored.completed,
                                group: stored.group || null
                            });
                        }
                    });

                    // Reorder items according to stored state
                    this.items.forEach(item => {
                        if (orderMap.has(item.id)) {
                            const stored = orderMap.get(item.id);
                            item.order = stored.order;
                            item.completed = stored.completed;
                            if (stored.group !== undefined && stored.group !== null) {
                                item.group = String(stored.group);
                            }
                            this.updateItemVisuals(item.id, item.completed);
                        }
                    });

                    this.applyOrderToDom();
                    this.items = [...this.items].sort((a, b) => a.order - b.order);
                }
            } catch (e) {
                console.warn('[Vibe Todo] Gagal memuat stored layout:', e);
            }
        },

        saveStoredState() {
            if (!this.persist) return;
            try {
                const serializable = this.items.map(item => ({
                    id: item.id,
                    completed: item.completed,
                    group: item.group,
                    order: item.order
                }));
                this.saveStoredData(serializable);
            } catch (e) {}
        },

        saveStoredData(data) {
            const expireHours = typeof this.expireHours === 'number' ? this.expireHours : (24 * 30);
            if (typeof window.VibeTodo !== 'undefined' && typeof window.VibeTodo.save === 'function') {
                window.VibeTodo.save(this.entryId, data, expireHours);
            } else {
                const key = this.rootStorageKey;
                let items = [];
                try {
                    const raw = localStorage.getItem(key);
                    const parsed = raw ? JSON.parse(raw) : [];
                    if (Array.isArray(parsed)) items = parsed;
                } catch (e) {}

                const now = Date.now();
                items = items.filter(item => item && (!item.expiredAt || item.expiredAt > now));

                const expirationDate = new Date();
                expirationDate.setHours(expirationDate.getHours() + expireHours);

                const newEntry = {
                    id: this.entryId,
                    data: data,
                    expiredAt: expirationDate.getTime()
                };

                const existingIndex = items.findIndex(item => item && item.id === this.entryId);
                if (existingIndex > -1) {
                    items[existingIndex] = newEntry;
                } else {
                    items.push(newEntry);
                }

                localStorage.setItem(key, JSON.stringify(items));
            }
        },

        clearStorage() {
            if (typeof window.VibeTodo !== 'undefined' && typeof window.VibeTodo.clear === 'function') {
                window.VibeTodo.clear(this.entryId);
            } else {
                try {
                    const key = this.rootStorageKey;
                    const raw = localStorage.getItem(key);
                    if (raw) {
                        let items = JSON.parse(raw);
                        if (Array.isArray(items)) {
                            items = items.filter(item => item && item.id !== this.entryId);
                            localStorage.setItem(key, JSON.stringify(items));
                        }
                    }
                } catch (e) {}
            }
            const prefix = window.VIBE_PREFIX || 'vibe';
            localStorage.removeItem(`${prefix}-todo-${this.id}`);
            if (this.storageKey) localStorage.removeItem(this.storageKey);
        },

        resetStorage() {
            this.clearStorage();
        },

        // --- Drag & Drop Operations ---
        onDragStart(id, group, e) {
            if (!this.reorderable) return;
            if (this.items.length === 0) {
                this.discoverItemsFromDom();
            }
            const sId = String(id);
            this.draggingId = sId;

            const el = this.getItemEl(sId);
            const resolvedGroup = group || (el ? el.dataset.group : null) || this.items.find(i => i.id === sId)?.group || null;
            this.draggingGroup = resolvedGroup ? String(resolvedGroup) : null;
            this.isDragging = true;
            this.wasDragging = true;

            if (e && e.dataTransfer) {
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/plain', sId);
                e.dataTransfer.setData('application/x-vibe-todo', JSON.stringify({
                    todoId: this.id,
                    itemId: sId,
                    group: this.draggingGroup
                }));
            }

            if (el) {
                setTimeout(() => {
                    el.classList.add('opacity-40', 'scale-[0.99]', 'ring-2', 'ring-primary/40');
                }, 0);
            }
        },

        onDragOver(targetId, targetGroup, e) {
            if (!this.reorderable || !this.draggingId) return;
            const sTargetId = String(targetId);
            if (this.draggingId === sTargetId) return;

            e.preventDefault();
            if (e.dataTransfer) {
                e.dataTransfer.dropEffect = 'move';
            }

            const targetEl = this.getItemEl(sTargetId);
            if (!targetEl) return;

            const rect = targetEl.getBoundingClientRect();
            const relY = e.clientY - rect.top;
            const position = relY < rect.height / 2 ? 'before' : 'after';

            let resolvedGroup = targetGroup || null;
            if (!resolvedGroup && targetEl) {
                const parentGroup = targetEl.closest('[data-todo-group]');
                resolvedGroup = (parentGroup ? (parentGroup.dataset.todoGroup || parentGroup.getAttribute('data-todo-group')) : null)
                    || targetEl.dataset.group
                    || targetEl.getAttribute('data-group')
                    || null;
            }

            this.dragOverId = sTargetId;
            this.dragOverPosition = position;
            this.dragOverGroup = resolvedGroup ? String(resolvedGroup) : null;
        },

        onDragLeave(targetId, e) {
            const sTargetId = String(targetId);
            const targetEl = this.getItemEl(sTargetId);
            if (targetEl && e && e.relatedTarget && !targetEl.contains(e.relatedTarget)) {
                if (this.dragOverId === sTargetId) {
                    this.dragOverId = null;
                    this.dragOverPosition = null;
                }
            }
        },

        onDragOverGroup(groupName, e) {
            if (!this.reorderable || !this.draggingId) return;
            e.preventDefault();
            if (e.dataTransfer) {
                e.dataTransfer.dropEffect = 'move';
            }
            this.dragOverGroup = String(groupName);
        },

        onDragLeaveGroup(groupName, e) {
            const groupEl = this.getGroupEl(groupName);
            if (groupEl && e && e.relatedTarget && !groupEl.contains(e.relatedTarget)) {
                if (this.dragOverGroup === String(groupName)) {
                    this.dragOverGroup = null;
                }
            }
        },

        onDrop(targetId, targetGroup, e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }
            const fromId = this.draggingId || (e && e.dataTransfer && e.dataTransfer.getData('text/plain'));
            const toId = String(targetId);

            if (!fromId) {
                this.onDragEnd();
                return;
            }

            const targetPosition = this.dragOverPosition || 'before';
            const targetEl = this.getItemEl(toId);
            
            // Resolve target group accurately from DOM hierarchy
            let resolvedGroup = targetGroup || null;
            if (!resolvedGroup && targetEl) {
                const parentGroup = targetEl.closest('[data-todo-group]');
                resolvedGroup = (parentGroup ? (parentGroup.dataset.todoGroup || parentGroup.getAttribute('data-todo-group')) : null) 
                    || targetEl.dataset.group 
                    || targetEl.getAttribute('data-group')
                    || this.dragOverGroup 
                    || null;
            } else if (!resolvedGroup) {
                resolvedGroup = this.dragOverGroup || null;
            }

            this.reorderItem(fromId, toId, targetPosition, resolvedGroup);
            this.onDragEnd();
        },

        onDropGroup(groupName, e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }
            const fromId = this.draggingId || (e && e.dataTransfer && e.dataTransfer.getData('text/plain'));
            if (!fromId) {
                this.onDragEnd();
                return;
            }

            const newGroup = String(groupName);
            this.moveItemToGroup(fromId, newGroup);
            this.onDragEnd();
        },

        onDragEnd() {
            if (this.draggingId) {
                const el = this.getItemEl(this.draggingId);
                if (el) {
                    el.classList.remove('opacity-40', 'scale-[0.99]', 'ring-2', 'ring-primary/40');
                }
            }

            this.draggingId = null;
            this.draggingGroup = null;
            this.dragOverId = null;
            this.dragOverPosition = null;
            this.dragOverGroup = null;
            this.isDragging = false;
            setTimeout(() => {
                this.wasDragging = false;
            }, 100);
        },

        // --- Mobile & Touch Drag-and-Drop Support ---
        setupTouchDrag() {
            const root = this.getRootEl();
            if (!root || root._vibeTodoTouchBound) return;
            root._vibeTodoTouchBound = true;

            let activeItem = null;
            let activeItemId = null;
            let isTouchDragging = false;
            let startX = 0;
            let startY = 0;
            let offsetX = 0;
            let offsetY = 0;
            let holdTimer = null;
            let ghostEl = null;

            const cleanupTouchDrag = () => {
                if (holdTimer) {
                    clearTimeout(holdTimer);
                    holdTimer = null;
                }
                if (ghostEl && ghostEl.parentNode) {
                    ghostEl.parentNode.removeChild(ghostEl);
                    ghostEl = null;
                }
                if (isTouchDragging) {
                    this.onDragEnd();
                    isTouchDragging = false;
                }
                activeItem = null;
                activeItemId = null;
                document.removeEventListener('touchmove', onTouchMove, { capture: true });
                document.removeEventListener('touchend', onTouchEnd, { capture: true });
                document.removeEventListener('touchcancel', onTouchCancel, { capture: true });
            };

            const startDragAction = (clientX, clientY) => {
                if (!activeItem || isTouchDragging) return;
                isTouchDragging = true;

                const rect = activeItem.getBoundingClientRect();
                offsetX = clientX - rect.left;
                offsetY = clientY - rect.top;

                // Visual drag ghost
                ghostEl = activeItem.cloneNode(true);
                ghostEl.removeAttribute('id');
                Array.from(ghostEl.querySelectorAll('[id]')).forEach(el => el.removeAttribute('id'));

                ghostEl.style.width = `${Math.round(rect.width)}px`;
                ghostEl.style.height = `${Math.round(rect.height)}px`;
                ghostEl.style.position = 'fixed';
                ghostEl.style.left = '0px';
                ghostEl.style.top = '0px';
                ghostEl.style.transform = `translate3d(${clientX - offsetX}px, ${clientY - offsetY}px, 0) scale(1.02)`;
                ghostEl.style.zIndex = '99999';
                ghostEl.style.pointerEvents = 'none';
                ghostEl.style.opacity = '0.92';
                ghostEl.style.boxShadow = '0 20px 25px -5px rgba(0, 0, 0, 0.25), 0 8px 10px -6px rgba(0, 0, 0, 0.25)';
                ghostEl.style.borderRadius = window.getComputedStyle(activeItem).borderRadius || '12px';
                ghostEl.style.boxSizing = 'border-box';
                ghostEl.style.transition = 'none';

                document.body.appendChild(ghostEl);

                const group = activeItem.dataset.group || (activeItem.closest('[data-todo-group]')?.dataset?.todoGroup) || null;
                this.onDragStart(activeItemId, group, null);

                if (typeof navigator !== 'undefined' && typeof navigator.vibrate === 'function') {
                    try { navigator.vibrate(30); } catch (_) {}
                }
            };

            const onTouchStart = (e) => {
                if (!this.reorderable || e.touches.length !== 1) return;

                const touch = e.touches[0];
                const target = e.target;

                // Skip interactive controls unless touching a designated drag handle
                const interactive = target.closest('button, a, input, textarea, select, [role="checkbox"], [data-action]');
                const handle = target.closest('[data-todo-handle], [aria-label="Drag to reorder"], [data-action-drag-handle]');

                if (interactive && !handle) return;

                const itemEl = target.closest('[data-todo-item]');
                if (!itemEl || !root.contains(itemEl)) return;

                activeItem = itemEl;
                activeItemId = itemEl.dataset.todoItem || itemEl.dataset.id;
                startX = touch.clientX;
                startY = touch.clientY;

                document.addEventListener('touchmove', onTouchMove, { capture: true, passive: false });
                document.addEventListener('touchend', onTouchEnd, { capture: true });
                document.addEventListener('touchcancel', onTouchCancel, { capture: true });

                if (handle) {
                    // Direct handle touch initiates drag on first slight movement (> 3px)
                } else {
                    // Body touch requires 250ms hold to distinguish from scrolling
                    holdTimer = setTimeout(() => {
                        startDragAction(startX, startY);
                    }, 250);
                }
            };

            const onTouchMove = (e) => {
                if (!activeItem || e.touches.length !== 1) return;
                const touch = e.touches[0];
                const dist = Math.hypot(touch.clientX - startX, touch.clientY - startY);

                if (!isTouchDragging) {
                    const handle = e.target.closest('[data-todo-handle], [aria-label="Drag to reorder"], [data-action-drag-handle]');
                    if (handle && dist >= 3) {
                        if (holdTimer) clearTimeout(holdTimer);
                        startDragAction(touch.clientX, touch.clientY);
                    } else if (dist >= 8) {
                        if (holdTimer) {
                            clearTimeout(holdTimer);
                            holdTimer = null;
                        }
                        return;
                    } else {
                        return;
                    }
                }

                if (e.cancelable) {
                    e.preventDefault();
                }

                if (ghostEl) {
                    ghostEl.style.transform = `translate3d(${touch.clientX - offsetX}px, ${touch.clientY - offsetY}px, 0) scale(1.02)`;
                }

                // Screen vertical auto-scroll
                const margin = 50;
                const speed = 10;
                if (touch.clientY < margin) {
                    window.scrollBy(0, -speed);
                } else if (touch.clientY > window.innerHeight - margin) {
                    window.scrollBy(0, speed);
                }

                // Kanban board horizontal auto-scroll
                const hScrollContainer = root.closest('.overflow-x-auto') || (root.scrollWidth > root.clientWidth ? root : null);
                if (hScrollContainer) {
                    const hRect = hScrollContainer.getBoundingClientRect();
                    if (touch.clientX < hRect.left + margin) {
                        hScrollContainer.scrollLeft -= speed;
                    } else if (touch.clientX > hRect.right - margin) {
                        hScrollContainer.scrollLeft += speed;
                    }
                }

                // Detect element under finger
                const elements = document.elementsFromPoint(touch.clientX, touch.clientY);
                let targetItem = null;
                let targetGroupEl = null;

                for (const el of elements) {
                    if (ghostEl && ghostEl.contains(el)) continue;
                    if (!targetItem) {
                        const item = el.closest('[data-todo-item]');
                        if (item && root.contains(item) && item !== activeItem) {
                            targetItem = item;
                        }
                    }
                    if (!targetGroupEl) {
                        const grp = el.closest('[data-todo-group]');
                        if (grp && root.contains(grp)) {
                            targetGroupEl = grp;
                        }
                    }
                }

                if (targetItem) {
                    const rect = targetItem.getBoundingClientRect();
                    const relY = touch.clientY - rect.top;
                    const position = relY < rect.height / 2 ? 'before' : 'after';
                    const targetId = targetItem.dataset.todoItem || targetItem.dataset.id;
                    const parentGrp = targetItem.closest('[data-todo-group]');
                    const resolvedGroup = (parentGrp ? parentGrp.dataset.todoGroup : null) || targetItem.dataset.group || null;

                    this.dragOverId = String(targetId);
                    this.dragOverPosition = position;
                    this.dragOverGroup = resolvedGroup ? String(resolvedGroup) : null;
                } else if (targetGroupEl) {
                    this.dragOverId = null;
                    this.dragOverPosition = null;
                    this.dragOverGroup = targetGroupEl.dataset.todoGroup ? String(targetGroupEl.dataset.todoGroup) : null;
                } else {
                    this.dragOverId = null;
                    this.dragOverPosition = null;
                    this.dragOverGroup = null;
                }
            };

            const onTouchEnd = () => {
                if (isTouchDragging) {
                    if (this.dragOverId) {
                        this.reorderItem(this.draggingId, this.dragOverId, this.dragOverPosition, this.dragOverGroup);
                    } else if (this.dragOverGroup) {
                        this.moveItemToGroup(this.draggingId, this.dragOverGroup);
                    }
                }
                cleanupTouchDrag();
            };

            const onTouchCancel = () => {
                cleanupTouchDrag();
            };

            root.addEventListener('touchstart', onTouchStart, { passive: true });
        },

        getItemEl(id) {
            if (!id && id !== 0) return null;
            const sId = String(id);
            const root = this.getRootEl();
            if (!root) return null;
            try {
                return root.querySelector(`[data-todo-item="${CSS.escape(sId)}"]`)
                    || root.querySelector(`[data-id="${CSS.escape(sId)}"]`);
            } catch (e) {
                return root.querySelector(`[data-todo-item="${sId}"]`)
                    || root.querySelector(`[data-id="${sId}"]`);
            }
        },

        getGroupEl(groupName) {
            const root = this.getRootEl();
            return root ? root.querySelector(`[data-todo-group="${groupName}"]`) : null;
        },

        getGroupContainerEl(groupName) {
            const root = this.getRootEl();
            if (!groupName) return root;
            if (!root) return null;
            return root.querySelector(`[data-todo-group-items="${groupName}"]`)
                || root.querySelector(`[data-todo-group="${groupName}"]`)
                || root;
        },

        // --- Reordering Logic & DOM Relocation ---
        reorderItem(fromId, toId, position = 'before', newGroup = null) {
            const sFromId = String(fromId);
            const sToId = String(toId);

            if (sFromId === sToId) return;

            const fromIndex = this.items.findIndex(i => i.id === sFromId);
            if (fromIndex === -1) return;

            const fromItem = this.items[fromIndex];
            const oldGroup = fromItem.group;

            // Remove from current position in array
            this.items.splice(fromIndex, 1);

            if (newGroup !== null && newGroup !== undefined) {
                fromItem.group = String(newGroup);
            }

            const toIndex = this.items.findIndex(i => i.id === sToId);
            const insertIndex = toIndex === -1 
                ? this.items.length 
                : (position === 'after' ? toIndex + 1 : toIndex);

            this.items.splice(insertIndex, 0, fromItem);

            // Reassign numeric orders
            this.items.forEach((item, idx) => {
                item.order = idx;
                const el = this.getItemEl(item.id);
                if (el) el.dataset.order = String(idx);
            });

            // Perform DOM node move
            const fromEl = this.getItemEl(sFromId);
            const toEl = this.getItemEl(sToId);

            if (fromEl && toEl) {
                if (position === 'before') {
                    toEl.parentNode.insertBefore(fromEl, toEl);
                } else {
                    toEl.parentNode.insertBefore(fromEl, toEl.nextSibling);
                }

                if (newGroup !== null && newGroup !== undefined) {
                    fromEl.dataset.group = String(newGroup);
                }
            }

            this.items = [...this.items];
            this.dispatchAndSyncReorder(sFromId, oldGroup, fromItem.group);
        },

        moveItemToGroup(itemId, newGroup) {
            const sId = String(itemId);
            const item = this.items.find(i => i.id === sId);
            if (!item) return;

            const oldGroup = item.group;
            item.group = String(newGroup);

            const fromEl = this.getItemEl(sId);
            const groupContainer = this.getGroupContainerEl(newGroup);

            if (fromEl && groupContainer) {
                fromEl.dataset.group = String(newGroup);
                const emptyPlaceholder = groupContainer.querySelector('[data-todo-empty-placeholder]');
                if (emptyPlaceholder) {
                    groupContainer.insertBefore(fromEl, emptyPlaceholder);
                } else {
                    groupContainer.appendChild(fromEl);
                }
            }

            // Move item to the end of the items array
            const idx = this.items.indexOf(item);
            if (idx > -1) {
                this.items.splice(idx, 1);
                this.items.push(item);
            }

            this.items.forEach((it, i) => {
                it.order = i;
                const el = this.getItemEl(it.id);
                if (el) el.dataset.order = String(i);
            });

            this.items = [...this.items];
            this.dispatchAndSyncReorder(sId, oldGroup, newGroup);
        },

        // --- Multi-Column Board Navigation Actions ---
        getGroups() {
            const root = this.getRootEl();
            if (!root) return [];
            const groupEls = root.querySelectorAll('[data-todo-group]');
            const groups = [];
            groupEls.forEach(el => {
                const name = el.dataset.todoGroup || el.getAttribute('data-todo-group');
                if (name && !groups.includes(String(name))) {
                    groups.push(String(name));
                }
            });
            return groups;
        },

        canMovePrev(itemId) {
            const sId = String(itemId);
            const item = this.items.find(i => i.id === sId);
            let currentGroup = item?.group;
            if (!currentGroup) {
                const el = this.getItemEl(sId);
                currentGroup = el ? (el.closest('[data-todo-group]')?.dataset?.todoGroup || el.dataset.group) : null;
            }
            if (!currentGroup) return false;
            const groups = this.getGroups();
            const idx = groups.indexOf(String(currentGroup));
            return idx > 0;
        },

        canMoveNext(itemId) {
            const sId = String(itemId);
            const item = this.items.find(i => i.id === sId);
            let currentGroup = item?.group;
            if (!currentGroup) {
                const el = this.getItemEl(sId);
                currentGroup = el ? (el.closest('[data-todo-group]')?.dataset?.todoGroup || el.dataset.group) : null;
            }
            if (!currentGroup) return false;
            const groups = this.getGroups();
            const idx = groups.indexOf(String(currentGroup));
            return idx !== -1 && idx < groups.length - 1;
        },

        moveToNextGroup(itemId) {
            const sId = String(itemId);
            const item = this.items.find(i => i.id === sId);
            let currentGroup = item?.group;
            if (!currentGroup) {
                const el = this.getItemEl(sId);
                currentGroup = el ? (el.closest('[data-todo-group]')?.dataset?.todoGroup || el.dataset.group) : null;
            }
            if (!currentGroup) return;

            const groups = this.getGroups();
            const currentIdx = groups.indexOf(String(currentGroup));
            if (currentIdx !== -1 && currentIdx < groups.length - 1) {
                const nextGroup = groups[currentIdx + 1];
                this.moveItemToGroup(sId, nextGroup);
            }
        },

        moveToPrevGroup(itemId) {
            const sId = String(itemId);
            const item = this.items.find(i => i.id === sId);
            let currentGroup = item?.group;
            if (!currentGroup) {
                const el = this.getItemEl(sId);
                currentGroup = el ? (el.closest('[data-todo-group]')?.dataset?.todoGroup || el.dataset.group) : null;
            }
            if (!currentGroup) return;

            const groups = this.getGroups();
            const currentIdx = groups.indexOf(String(currentGroup));
            if (currentIdx > 0) {
                const prevGroup = groups[currentIdx - 1];
                this.moveItemToGroup(sId, prevGroup);
            }
        },

        applyOrderToDom() {
            const root = this.getRootEl();
            if (!root) return;
            // Sort items by item.order
            const sorted = [...this.items].sort((a, b) => a.order - b.order);
            sorted.forEach(item => {
                const el = this.getItemEl(item.id);
                if (!el) return;

                const parent = item.group ? this.getGroupContainerEl(item.group) : root;
                if (parent) {
                    if (item.group) {
                        el.dataset.group = String(item.group);
                    }
                    const emptyPlaceholder = parent.querySelector('[data-todo-empty-placeholder]');
                    if (emptyPlaceholder) {
                        parent.insertBefore(el, emptyPlaceholder);
                    } else {
                        parent.appendChild(el);
                    }
                }
            });
        },

        dispatchAndSyncReorder(changedItemId, fromGroup, toGroup) {
            const orderList = this.items.map(i => ({
                id: i.id,
                order: i.order,
                group: i.group
            }));
            const orderIds = this.items.map(i => i.id);

            // Dispatch custom window & component event
            const root = this.getRootEl();
            if (root && root.dispatchEvent) {
                root.dispatchEvent(new CustomEvent('vibe:todo-reordered', {
                    bubbles: true,
                    detail: {
                        id: this.id,
                        changedItemId,
                        fromGroup,
                        toGroup,
                        order: orderList,
                        orderIds
                    }
                }));
            }

            // Sync with Persistence
            this.saveStoredState();

            // Sync according to Mode
            if (this.mode === 'livewire') {
                this.syncLivewireReorder(orderIds, changedItemId, fromGroup, toGroup);
            } else if (this.mode === 'api') {
                this.syncApiReorder(orderList);
            } else if (this.mode === 'form') {
                this.syncFormInputs();
            }
        },

        // --- Tri-Mode Synchronizers ---
        syncLivewireReorder(orderIds, changedItemId, fromGroup, toGroup) {
            if (window.Livewire) {
                if (this.wireReorder && this.$wire) {
                    try {
                        this.$wire.call(this.wireReorder, orderIds, changedItemId, fromGroup, toGroup);
                    } catch (e) {
                        console.error('[Vibe Todo] Gagal memanggil aksi Livewire:', e);
                    }
                } else if (this.$wire) {
                    this.$wire.dispatch('todo-reordered', {
                        id: this.id,
                        orderIds,
                        changedItemId,
                        fromGroup,
                        toGroup
                    });
                }
            }
        },

        async syncApiReorder(orderList) {
            const url = this.reorderUrl || (this.endpoint ? `${this.endpoint.replace(/\/$/, '')}/reorder` : null);
            if (!url) return;

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        todos: orderList
                    })
                });

                if (!response.ok) {
                    throw new Error(`Server returned status ${response.status}`);
                }
            } catch (err) {
                console.error('[Vibe Todo API] Gagal sinkronisasi urutan:', err);
                if (window.VibeToast && typeof window.VibeToast.show === 'function') {
                    window.VibeToast.show({
                        variant: 'destructive',
                        title: 'Gagal Menyimpan',
                        message: 'Urutan tugas tidak dapat disimpan ke server.'
                    });
                }
            }
        },

        syncFormInputs() {
            const root = this.getRootEl();
            const formContainer = root ? (root.querySelector('[data-todo-form-inputs]') || root) : null;
            if (!formContainer) return;
            const prefix = this.name || 'todos';

            this.items.forEach((item, index) => {
                const el = this.getItemEl(item.id);
                if (!el) return;

                let idInput = el.querySelector(`input[data-field="id"]`);
                if (idInput) {
                    idInput.name = `${prefix}[${index}][id]`;
                    idInput.value = item.id;
                }

                let orderInput = el.querySelector(`input[data-field="order"]`);
                if (orderInput) {
                    orderInput.name = `${prefix}[${index}][order]`;
                    orderInput.value = index;
                }

                let completedInput = el.querySelector(`input[data-field="completed"]`);
                if (completedInput) {
                    completedInput.name = `${prefix}[${index}][completed]`;
                    completedInput.value = item.completed ? '1' : '0';
                }

                let groupInput = el.querySelector(`input[data-field="group"]`);
                if (groupInput) {
                    groupInput.name = `${prefix}[${index}][group]`;
                    groupInput.value = item.group || '';
                }
            });
        },

        // --- Task Item Actions: Toggle, Delete, Add ---
        toggle(id) {
            if (this.wasDragging) return;
            const sId = String(id);
            const item = this.items.find(i => i.id === sId);
            if (!item) return;

            item.completed = !item.completed;
            this.updateItemVisuals(sId, item.completed);
            this.saveStoredState();

            const root = this.getRootEl();
            if (root && root.dispatchEvent) {
                root.dispatchEvent(new CustomEvent('vibe:todo-toggled', {
                    bubbles: true,
                    detail: { id: this.id, itemId: sId, completed: item.completed }
                }));
            }

            if (this.mode === 'livewire') {
                if (this.wireToggle && this.$wire) {
                    this.$wire.call(this.wireToggle, sId, item.completed);
                } else if (this.$wire) {
                    this.$wire.dispatch('todo-toggled', { itemId: sId, completed: item.completed });
                }
            } else if (this.mode === 'api') {
                this.syncApiToggle(sId, item.completed);
            } else if (this.mode === 'form') {
                this.syncFormInputs();
            }
        },

        updateItemVisuals(id, completed) {
            const el = this.getItemEl(id);
            if (!el) return;

            el.dataset.completed = completed ? 'true' : 'false';

            const titleEl = el.querySelector('[data-todo-title]');
            if (titleEl) {
                if (completed) {
                    titleEl.classList.add('line-through', 'text-muted-foreground/80');
                    titleEl.classList.remove('text-foreground');
                } else {
                    titleEl.classList.remove('line-through', 'text-muted-foreground/80');
                    titleEl.classList.add('text-foreground');
                }
            }

            const checkIcon = el.querySelector('[data-todo-check-icon]');
            if (checkIcon) {
                if (completed) {
                    checkIcon.classList.remove('opacity-0', 'scale-50');
                    checkIcon.classList.add('opacity-100', 'scale-100');
                } else {
                    checkIcon.classList.add('opacity-0', 'scale-50');
                    checkIcon.classList.remove('opacity-100', 'scale-100');
                }
            }

            const checkboxBox = el.querySelector('[data-todo-checkbox-box]');
            if (checkboxBox) {
                if (completed) {
                    checkboxBox.classList.add('bg-primary', 'border-primary', 'text-primary-foreground');
                    checkboxBox.classList.remove('bg-background', 'border-input');
                } else {
                    checkboxBox.classList.remove('bg-primary', 'border-primary', 'text-primary-foreground');
                    checkboxBox.classList.add('bg-background', 'border-input');
                }
            }
        },

        async syncApiToggle(id, completed) {
            let url = this.toggleUrl 
                ? this.toggleUrl.replace('{id}', id) 
                : (this.endpoint ? `${this.endpoint.replace(/\/$/, '')}/${id}/toggle` : null);

            if (!url) return;

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            try {
                const response = await fetch(url, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ completed })
                });

                if (!response.ok) {
                    throw new Error(`Toggle failed with ${response.status}`);
                }
            } catch (err) {
                console.error('[Vibe Todo API] Gagal toggle item:', err);
                const item = this.items.find(i => i.id === id);
                if (item) {
                    item.completed = !completed;
                    this.updateItemVisuals(id, item.completed);
                }
            }
        },

        remove(id) {
            const sId = String(id);
            const index = this.items.findIndex(i => i.id === sId);
            if (index === -1) return;

            const el = this.getItemEl(sId);
            if (el) {
                el.style.transition = 'all 200ms ease';
                el.style.opacity = '0';
                el.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    if (el.parentNode) el.parentNode.removeChild(el);
                    this.items.splice(index, 1);
                    this.saveStoredState();
                    if (this.mode === 'form') this.syncFormInputs();
                }, 200);
            } else {
                this.items.splice(index, 1);
                this.saveStoredState();
                if (this.mode === 'form') this.syncFormInputs();
            }

            const root = this.getRootEl();
            if (root && root.dispatchEvent) {
                root.dispatchEvent(new CustomEvent('vibe:todo-deleted', {
                    bubbles: true,
                    detail: { id: this.id, itemId: sId }
                }));
            }

            if (this.mode === 'livewire') {
                if (this.wireDelete && this.$wire) {
                    this.$wire.call(this.wireDelete, sId);
                } else if (this.$wire) {
                    this.$wire.dispatch('todo-deleted', { itemId: sId });
                }
            } else if (this.mode === 'api') {
                this.syncApiDelete(sId);
            }
        },

        async syncApiDelete(id) {
            let url = this.deleteUrl 
                ? this.deleteUrl.replace('{id}', id) 
                : (this.endpoint ? `${this.endpoint.replace(/\/$/, '')}/${id}` : null);

            if (!url) return;

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            try {
                await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
            } catch (err) {
                console.error('[Vibe Todo API] Gagal hapus item:', err);
            }
        },

        add(title, group = null) {
            const cleanTitle = (title || this.newTitle || '').trim();
            if (!cleanTitle) return;

            const newId = 'temp-' + Date.now();
            const groupVal = group ? String(group) : (this.dragOverGroup || null);

            const root = this.getRootEl();
            if (root && root.dispatchEvent) {
                root.dispatchEvent(new CustomEvent('vibe:todo-added', {
                    bubbles: true,
                    detail: { id: this.id, title: cleanTitle, group: groupVal }
                }));
            }

            if (this.mode === 'livewire') {
                if (this.wireAdd && this.$wire) {
                    this.$wire.call(this.wireAdd, cleanTitle, groupVal);
                } else if (this.$wire) {
                    this.$wire.dispatch('todo-added', { title: cleanTitle, group: groupVal });
                }
            } else if (this.mode === 'api') {
                this.syncApiAdd(cleanTitle, groupVal);
            } else if (this.mode === 'form') {
                this.items.push({
                    id: newId,
                    completed: false,
                    group: groupVal,
                    order: this.items.length
                });
                this.syncFormInputs();
            }

            this.newTitle = '';
        },

        async syncApiAdd(title, group) {
            const url = this.addUrl || this.endpoint;
            if (!url) return;

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ title, group })
                });

                if (response.ok) {
                    const data = await response.json();
                    if (data && data.item) {
                        this.items.push({
                            id: String(data.item.id),
                            completed: !!data.item.completed,
                            group: data.item.group || null,
                            order: this.items.length
                        });
                    }
                }
            } catch (err) {
                console.error('[Vibe Todo API] Gagal tambah item:', err);
            }
        }
    };
}

// Auto-register in Alpine when available
function registerVibeTodo() {
    if (typeof window !== 'undefined' && window.Alpine && typeof window.Alpine.data === 'function') {
        window.Alpine.data('vibeTodo', vibeTodo);
    }
}

if (typeof window !== 'undefined') {
    window.vibeTodo = vibeTodo;
    registerVibeTodo();
    document.addEventListener('alpine:init', registerVibeTodo);
    document.addEventListener('livewire:init', registerVibeTodo);
    window.dispatchEvent(new CustomEvent('vibe-todo-ready'));
}
