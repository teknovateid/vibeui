/**
 * Vibe UI - Dynamic Form (Repeater) Component Controller for Alpine.js
 * Supports dynamic row adding, deleting, cloning, reordering, collapsible cards,
 * and automatic Alpine.js reinitialization for nested controls (vibe:date-time, vibe:select, etc.).
 */

export function vibeDynamicForm(config = {}) {
    return {
        id: config.id || 'vibe-df-' + Math.random().toString(36).substring(2, 9),
        name: config.name || 'items',
        min: config.min !== undefined && config.min !== null ? parseInt(config.min, 10) : 1,
        max: config.max !== undefined && config.max !== null ? parseInt(config.max, 10) : null,
        variant: config.variant || 'card',
        allowReorder: config.allowReorder !== undefined ? Boolean(config.allowReorder) : true,
        allowDuplicate: config.allowDuplicate !== undefined ? Boolean(config.allowDuplicate) : true,
        collapsible: config.collapsible !== undefined ? Boolean(config.collapsible) : true,
        confirmDelete: Boolean(config.confirmDelete),
        confirmDeleteMessage: config.confirmDeleteMessage || 'Hapus baris ini?',
        
        // Reactive state
        itemCount: 0,
        counter: 0,
        collapsedState: {},
        draggingEl: null,
        draggingIndex: null,
        dragOverIndex: null,

        get canAdd() {
            return this.max === null || this.itemCount < this.max;
        },

        get canRemove() {
            return this.itemCount > this.min;
        },

        get isEmpty() {
            return this.itemCount === 0;
        },

        init() {
            this.$nextTick(() => {
                const rows = this.getRows();
                this.itemCount = rows.length;
                this.counter = rows.length;

                // Bind initial state
                this.reindex();

                // If default count is specified and current rows < default
                const defaultCount = config.default !== undefined ? parseInt(config.default, 10) : 0;
                if (rows.length === 0 && defaultCount > 0) {
                    for (let i = 0; i < defaultCount; i++) {
                        this.addItem();
                    }
                }

                // Dispatch ready event
                window.dispatchEvent(new CustomEvent('vibe-dynamic-form-ready', {
                    detail: { id: this.id, count: this.itemCount }
                }));
            });
        },

        getRoot() {
            if (this.id) {
                const el = document.getElementById(this.id);
                if (el) return el;
            }
            if (this.$root && this.$root.isConnected) return this.$root;
            if (this.$el && this.$el.isConnected) {
                return this.$el.closest(`[id="${this.id}"]`) || this.$el;
            }
            return null;
        },

        getContainer() {
            const root = this.getRoot();
            if (root) {
                const container = root.querySelector('[data-dynamic-form-container]');
                if (container) return container;
            }
            if (this.$refs && this.$refs.container && this.$refs.container.isConnected) {
                return this.$refs.container;
            }
            return document.querySelector(`[id="${this.id}"] [data-dynamic-form-container]`);
        },

        getTemplate() {
            const root = this.getRoot();
            if (root) {
                const template = root.querySelector('[data-dynamic-form-template]');
                if (template) return template;
            }
            if (this.$refs && this.$refs.template && this.$refs.template.isConnected) {
                return this.$refs.template;
            }
            return document.querySelector(`[id="${this.id}"] [data-dynamic-form-template]`);
        },

        getRows() {
            const container = this.getContainer();
            if (!container) return [];
            return Array.from(container.children).filter(el => el.hasAttribute('data-dynamic-form-item'));
        },

        generateUid() {
            return 'vibe-df-' + Math.random().toString(36).substring(2, 9);
        },

        addItem(values = null) {
            if (!this.canAdd) {
                return;
            }

            const template = this.getTemplate();
            const container = this.getContainer();
            if (!template || !container) {
                console.warn('[Vibe Dynamic Form] Template or container element not found.');
                return;
            }

            const newIndex = this.getRows().length;
            this.counter++;
            const uid = this.generateUid();

            // Read template content (support <template> tag or hidden div)
            let templateHtml = template.tagName.toLowerCase() === 'template' 
                ? template.innerHTML 
                : template.outerHTML;

            // 1. Replace placeholder tokens
            let html = templateHtml
                .replaceAll('__INDEX__', newIndex)
                .replaceAll('__UID__', uid);

            // 2. Generate unique component IDs for nested elements to prevent collisions
            const idMap = {};
            const baseMatches = html.match(/\b(vibe-dt|select|input|textarea)-[a-zA-Z0-9_-]+/g) || [];
            baseMatches.forEach(m => {
                const base = m.replace(/-(trigger|description|error|info)$/, '');
                if (!idMap[base]) {
                    const prefix = base.split('-')[0];
                    idMap[base] = prefix + '-' + Math.random().toString(36).substring(2, 9);
                }
            });
            Object.keys(idMap).forEach(oldBase => {
                html = html.replaceAll(oldBase, idMap[oldBase]);
            });

            // Create new DOM element
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html.trim();
            const newRow = tempDiv.firstElementChild;

            if (!newRow) return;

            // Ensure proper attributes on the row
            newRow.setAttribute('data-dynamic-form-item', '');
            newRow.setAttribute('data-index', newIndex);

            // Auto-namespace any input without bracket name (e.g. name="company" -> name="experiences[0][company]")
            this.autoNamespaceInputs(newRow, newIndex, uid);

            // Append to container
            container.appendChild(newRow);

            // 3. Initialize Alpine on the newly added row
            if (window.Alpine && typeof window.Alpine.initTree === 'function') {
                try {
                    window.Alpine.initTree(newRow);
                } catch (err) {
                    console.error('[Vibe Dynamic Form] Error initializing Alpine tree on new row:', err);
                }
            }

            // 4. Ensure nested components (like vibe:select) have clean initial state
            const componentRoots = newRow.querySelectorAll('[x-data]');
            componentRoots.forEach(root => {
                const alpineData = root._x_dataStack ? root._x_dataStack[0] : (window.Alpine?.$data ? window.Alpine.$data(root) : null);
                if (alpineData && 'hasVisibleOptions' in alpineData) {
                    alpineData.hasVisibleOptions = true;
                }
            });

            // 5. If initial/duplicate values provided, populate inputs AFTER Alpine initialized
            if (values && typeof values === 'object') {
                this.populateRowValues(newRow, values);
            }

            // Update state and reindex
            this.reindex();

            // Smooth scroll into view if added
            if (newRow.scrollIntoView && newIndex > 0) {
                newRow.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }

            // Dispatch event
            const eventDetail = { formId: this.id, row: newRow, index: newIndex };
            this.$dispatch('vibe-dynamic-form:add', eventDetail);
            window.dispatchEvent(new CustomEvent('vibe-dynamic-form-add', { detail: eventDetail }));
        },

        removeItem(target) {
            if (!this.canRemove) {
                return;
            }

            if (this.confirmDelete && !window.confirm(this.confirmDeleteMessage)) {
                return;
            }

            const row = this.resolveRow(target);
            if (!row) return;

            const index = parseInt(row.getAttribute('data-index') || '-1', 10);

            // Animate removal
            const root = this.getRoot();
            row.classList.add('opacity-0', 'scale-95', 'transition-all', 'duration-150');
            setTimeout(() => {
                if (row.parentNode) {
                    row.remove();
                    this.reindex();

                    const eventDetail = { formId: this.id, index };
                    if (root) {
                        root.dispatchEvent(new CustomEvent('vibe-dynamic-form:remove', { bubbles: true, detail: eventDetail }));
                    } else if (typeof this.$dispatch === 'function') {
                        try { this.$dispatch('vibe-dynamic-form:remove', eventDetail); } catch (e) {}
                    }
                    window.dispatchEvent(new CustomEvent('vibe-dynamic-form-remove', { detail: eventDetail }));
                }
            }, 150);
        },

        duplicateItem(target) {
            if (!this.canAdd) return;

            const row = this.resolveRow(target);
            if (!row) return;

            const values = this.extractRowValues(row);
            // Clear ID value on duplicate so database treats it as a new row
            if (values.id !== undefined) {
                values.id = '';
            }

            this.addItem(values);
        },

        moveUp(target) {
            const row = this.resolveRow(target);
            if (!row) return;

            const prevRow = row.previousElementSibling;
            if (prevRow && prevRow.hasAttribute('data-dynamic-form-item')) {
                const container = this.getContainer();
                container.insertBefore(row, prevRow);
                this.reindex();
                this.highlightRow(row);
                this.$dispatch('vibe-dynamic-form:reorder', { formId: this.id });
            }
        },

        moveDown(target) {
            const row = this.resolveRow(target);
            if (!row) return;

            const nextRow = row.nextElementSibling;
            if (nextRow && nextRow.hasAttribute('data-dynamic-form-item')) {
                const container = this.getContainer();
                container.insertBefore(nextRow, row);
                this.reindex();
                this.highlightRow(row);
                this.$dispatch('vibe-dynamic-form:reorder', { formId: this.id });
            }
        },

        // --- Drag & Drop Reordering ---
        startDrag(target, e) {
            if (!this.allowReorder) return;
            const row = this.resolveRow(target);
            if (!row) return;

            const index = parseInt(row.getAttribute('data-index') || '-1', 10);
            if (index === -1) return;

            this.draggingEl = row;
            this.draggingIndex = index;

            if (e.dataTransfer) {
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/plain', String(index));
                e.dataTransfer.setData('application/x-vibe-dynamic-form', this.id);

                if (e.dataTransfer.setDragImage) {
                    const rect = row.getBoundingClientRect();
                    const offsetX = Math.min(rect.width / 2, Math.max(10, (e.clientX || 0) - rect.left));
                    const offsetY = Math.min(rect.height / 2, Math.max(10, (e.clientY || 0) - rect.top));
                    e.dataTransfer.setDragImage(row, offsetX, offsetY);
                }
            }

            // Visual feedback on the dragged row
            setTimeout(() => {
                row.classList.add('opacity-40', 'scale-[0.99]');
            }, 0);
        },

        onDragOver(target, e) {
            if (!this.allowReorder || !this.draggingEl) return;
            const row = this.resolveRow(target);
            if (!row) return;

            const targetIndex = parseInt(row.getAttribute('data-index') || '-1', 10);
            if (targetIndex === -1 || row === this.draggingEl) return;

            e.preventDefault();
            if (e.dataTransfer) {
                e.dataTransfer.dropEffect = 'move';
            }

            this.dragOverIndex = targetIndex;
            row.classList.add('ring-2', 'ring-primary', 'border-primary/60');
        },

        onDragLeave(target, e) {
            const row = this.resolveRow(target);
            if (!row) return;

            if (e.relatedTarget && row.contains(e.relatedTarget)) {
                return;
            }

            row.classList.remove('ring-2', 'ring-primary', 'border-primary/60');
        },

        onDrop(target, e) {
            if (!this.allowReorder) return;
            e.preventDefault();

            if (e.dataTransfer) {
                const sourceForm = e.dataTransfer.getData('application/x-vibe-dynamic-form');
                if (sourceForm && sourceForm !== this.id) {
                    this.endDrag(target, e);
                    return;
                }
            }

            const targetRow = this.resolveRow(target);
            if (!targetRow) {
                this.endDrag(target, e);
                return;
            }

            const rows = this.getRows();
            const sourceRow = this.draggingEl || (this.draggingIndex !== null ? rows[this.draggingIndex] : null);

            if (!sourceRow || sourceRow === targetRow) {
                this.endDrag(target, e);
                return;
            }

            const fromIndex = parseInt(sourceRow.getAttribute('data-index') || '-1', 10);
            const toIndex = parseInt(targetRow.getAttribute('data-index') || '-1', 10);

            if (fromIndex !== -1 && toIndex !== -1 && fromIndex !== toIndex) {
                const container = this.getContainer();

                if (fromIndex < toIndex) {
                    // Dragging DOWNWARDS: insert sourceRow AFTER targetRow
                    container.insertBefore(sourceRow, targetRow.nextSibling);
                } else {
                    // Dragging UPWARDS: insert sourceRow BEFORE targetRow
                    container.insertBefore(sourceRow, targetRow);
                }

                this.reindex();
                this.highlightRow(sourceRow);

                const eventDetail = { formId: this.id, fromIndex, toIndex };
                this.$dispatch('vibe-dynamic-form:reorder', eventDetail);
                window.dispatchEvent(new CustomEvent('vibe-dynamic-form-reorder', { detail: eventDetail }));
            }

            this.endDrag(target, e);
        },

        endDrag(target, e) {
            this.draggingEl = null;
            this.draggingIndex = null;
            this.dragOverIndex = null;

            const rows = this.getRows();
            rows.forEach(r => {
                r.classList.remove('opacity-40', 'scale-[0.99]', 'ring-2', 'ring-primary', 'border-primary/60');
            });
        },

        toggleCollapse(target) {
            const row = this.resolveRow(target);
            if (!row) return;

            const body = row.querySelector('[data-dynamic-form-body]');
            const chevron = row.querySelector('[data-dynamic-form-chevron]');
            if (!body) return;

            const isCollapsed = body.classList.contains('hidden');
            if (isCollapsed) {
                body.classList.remove('hidden');
                if (chevron) chevron.classList.remove('-rotate-90');
            } else {
                body.classList.add('hidden');
                if (chevron) chevron.classList.add('-rotate-90');
            }
        },

        resolveRow(target) {
            if (!target) return null;
            if (target.nodeType && target.hasAttribute('data-dynamic-form-item')) {
                return target;
            }
            if (target.target) {
                target = target.target;
            }
            if (typeof target.closest === 'function') {
                return target.closest('[data-dynamic-form-item]');
            }
            return null;
        },

        highlightRow(row) {
            row.classList.add('ring-2', 'ring-primary/40', 'transition-shadow', 'duration-300');
            setTimeout(() => {
                row.classList.remove('ring-2', 'ring-primary/40');
            }, 600);
        },

        autoNamespaceInputs(row, index, uid) {
            const inputs = row.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                const oldName = input.getAttribute('name');
                if (oldName) {
                    // If already correctly formatted with base name, just replace index
                    if (oldName.startsWith(this.name + '[')) {
                        input.setAttribute('name', oldName.replace(new RegExp(`^${this.name}\\[[^\\]]+\\]`), `${this.name}[${index}]`));
                    } else if (!oldName.includes('[')) {
                        // Flat name: "company" -> "experiences[index][company]"
                        input.setAttribute('name', `${this.name}[${index}][${oldName}]`);
                    }
                }

                // If input has an ID that matches its flat name or isn't unique yet
                const oldId = input.getAttribute('id');
                if (oldId && uid && !oldId.includes('vibe-') && !oldId.includes('-' + uid)) {
                    const newId = `${oldId}-${uid}`;
                    input.setAttribute('id', newId);

                    const label = row.querySelector(`label[for="${oldId}"]`);
                    if (label) label.setAttribute('for', newId);

                    const trigger = row.querySelector(`[id="${oldId}-trigger"]`);
                    if (trigger) trigger.setAttribute('id', `${newId}-trigger`);

                    const triggerLabel = row.querySelector(`label[for="${oldId}-trigger"]`);
                    if (triggerLabel) triggerLabel.setAttribute('for', `${newId}-trigger`);
                }
            });
        },

        extractRowValues(row) {
            const values = {};
            const inputs = row.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                const name = input.getAttribute('name');
                if (!name) return;

                // Extract field key name (e.g. experiences[0][company] -> company)
                const match = name.match(/\[([^\]]+)\]$/);
                const fieldKey = match ? match[1] : name;

                if (input.type === 'checkbox') {
                    values[fieldKey] = input.checked;
                } else if (input.type === 'radio') {
                    if (input.checked) values[fieldKey] = input.value;
                } else {
                    let val = input.value;
                    // Check if parent Alpine component has an active value (e.g. vibe:select or date-time)
                    const alpineRoot = input.closest('[x-data]');
                    const alpineData = alpineRoot ? (alpineRoot._x_dataStack ? alpineRoot._x_dataStack[0] : (window.Alpine?.$data ? window.Alpine.$data(alpineRoot) : null)) : null;
                    if (alpineData) {
                        if (alpineData.value !== undefined && alpineData.value !== null && alpineData.value !== '') {
                            val = alpineData.value;
                        } else if (alpineData.formValue !== undefined && alpineData.formValue !== '') {
                            val = alpineData.formValue;
                        }
                    }
                    values[fieldKey] = val;
                }
            });
            return values;
        },

        populateRowValues(row, values) {
            const inputs = row.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                const name = input.getAttribute('name');
                if (!name) return;

                const match = name.match(/\[([^\]]+)\]$/);
                const fieldKey = match ? match[1] : name;

                if (values[fieldKey] !== undefined) {
                    const val = values[fieldKey];
                    if (input.type === 'checkbox') {
                        input.checked = Boolean(val);
                    } else if (input.type === 'radio') {
                        input.checked = input.value === String(val);
                    } else {
                        input.value = val !== null ? val : '';

                        // Check if this input is managed by an Alpine component (e.g. vibe:select or date-time)
                        const alpineRoot = input.closest('[x-data]');
                        if (alpineRoot) {
                            const alpineData = alpineRoot._x_dataStack ? alpineRoot._x_dataStack[0] : (window.Alpine?.$data ? window.Alpine.$data(alpineRoot) : null);
                            if (alpineData) {
                                if ('value' in alpineData) {
                                    alpineData.value = val;
                                }
                                if ('formValue' in alpineData) {
                                    alpineData.formValue = val;
                                }
                                if ('hasVisibleOptions' in alpineData) {
                                    alpineData.hasVisibleOptions = true;
                                }
                                if (typeof alpineData.updateSelectionFromValue === 'function') {
                                    alpineData.updateSelectionFromValue();
                                }
                            }
                        }

                        // Dispatch input and change event so reactive components notice
                        input.dispatchEvent(new Event('input', { bubbles: true }));
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                }
            });

            // Ensure all select components in row have hasVisibleOptions = true and updated labels
            const selects = row.querySelectorAll('[x-data]');
            selects.forEach(sel => {
                const alpineData = sel._x_dataStack ? sel._x_dataStack[0] : (window.Alpine?.$data ? window.Alpine.$data(sel) : null);
                if (alpineData) {
                    if ('hasVisibleOptions' in alpineData) {
                        alpineData.hasVisibleOptions = true;
                    }
                    if (typeof alpineData.updateSelectionFromValue === 'function') {
                        alpineData.updateSelectionFromValue();
                    }
                }
            });
        },

        reindex() {
            const rows = this.getRows();
            this.itemCount = rows.length;

            rows.forEach((row, i) => {
                row.setAttribute('data-index', i);

                // Update badge (#1, #2, ...)
                const badge = row.querySelector('[data-dynamic-form-badge]');
                if (badge) {
                    badge.textContent = `#${i + 1}`;
                }

                // Update row title fallback if needed
                const titleEl = row.querySelector('[data-dynamic-form-title]');
                if (titleEl && titleEl.dataset.defaultTitle) {
                    titleEl.textContent = titleEl.dataset.defaultTitle.replace(':index', i + 1);
                }

                // Update input names
                this.autoNamespaceInputs(row, i);

                // Update move-up/down button states
                const btnUp = row.querySelector('[data-action-move-up]');
                const btnDown = row.querySelector('[data-action-move-down]');
                if (btnUp) {
                    if (i === 0) {
                        btnUp.setAttribute('disabled', 'disabled');
                        btnUp.classList.add('opacity-40', 'pointer-events-none');
                    } else {
                        btnUp.removeAttribute('disabled');
                        btnUp.classList.remove('opacity-40', 'pointer-events-none');
                    }
                }
                if (btnDown) {
                    if (i === rows.length - 1) {
                        btnDown.setAttribute('disabled', 'disabled');
                        btnDown.classList.add('opacity-40', 'pointer-events-none');
                    } else {
                        btnDown.removeAttribute('disabled');
                        btnDown.classList.remove('opacity-40', 'pointer-events-none');
                    }
                }
            });
        }
    };
}

// Register global window object
if (typeof window !== 'undefined') {
    window.vibeDynamicForm = vibeDynamicForm;
}
