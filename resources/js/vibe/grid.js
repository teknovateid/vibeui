/**
 * Vibe UI - Interactive Card Grid Component for Alpine.js
 * Supports 1-to-1 card swapping, fluid real-time corner drag-to-resize, and localStorage persistence.
 */

export function vibeGrid(config = {}) {
    return {
        id: config.id || 'vibe-grid',
        cols: parseInt(config.cols || 12, 10),
        persist: config.persist ?? true,
        resizable: config.resizable ?? true,
        reorderable: config.reorderable ?? true,
        storageKey: config.storageKey || '',
        order: [],
        spans: {},
        initialOrder: [],
        initialSpans: {},

        // Drag & Drop State
        draggingId: null,
        dragOverId: null,

        // Resize State
        resizing: null,
        previewId: null,
        previewCols: null,

        init() {
            if (!this.storageKey) {
                this.storageKey = (window.VIBE_PREFIX || 'vibe') + '-grid-' + this.id;
            }

            this.discoverItems();

            if (this.persist) {
                this.loadStoredLayout();
            }

            this.applyLayout();
        },

        getItemEl(id) {
            return this.$el.querySelector(':scope > [data-grid-item="' + id + '"]')
                || this.$el.querySelector('[data-grid-item="' + id + '"]');
        },

        isItemReorderable(id) {
            if (!this.reorderable) return false;
            let item = this.spans[id];
            if (item && item.reorderable === false) return false;
            let el = this.getItemEl(id);
            if (el && el.dataset.reorderable === 'false') return false;
            return true;
        },

        isItemResizable(id) {
            if (!this.resizable) return false;
            let item = this.spans[id];
            if (item && item.resizable === false) return false;
            let el = this.getItemEl(id);
            if (el && el.dataset.resizable === 'false') return false;
            return true;
        },

        discoverItems() {
            let itemEls = Array.from(this.$el.querySelectorAll('[data-grid-item]')).filter(
                (el) => el.closest('[data-vibe-grid]') === this.$el
            );
            let order = [];
            let spans = {};

            itemEls.forEach((el) => {
                let id = el.dataset.gridItem;
                if (!id) return;

                let colSpan = parseInt(el.dataset.colSpan || 4, 10);
                let rowSpan = parseInt(el.dataset.rowSpan || 1, 10);
                let minCol = parseInt(el.dataset.minColSpan || 2, 10);
                let maxCol = parseInt(el.dataset.maxColSpan || this.cols, 10);
                let reorderable = el.dataset.reorderable !== 'false';
                let resizable = el.dataset.resizable !== 'false';

                order.push(id);
                spans[id] = {
                    col: Math.max(minCol, Math.min(maxCol, colSpan)),
                    row: rowSpan,
                    minCol: minCol,
                    maxCol: maxCol,
                    initialCol: colSpan,
                    initialRow: rowSpan,
                    reorderable: reorderable,
                    resizable: resizable
                };
            });

            this.order = order;
            this.spans = spans;
            this.initialOrder = [...order];
            this.initialSpans = JSON.parse(JSON.stringify(spans));
        },

        getStore() {
            try {
                return window.Alpine && window.Alpine.store('vibeGrids') ? window.Alpine.store('vibeGrids') : null;
            } catch (e) {
                return null;
            }
        },

        loadStoredLayout() {
            try {
                let store = this.getStore();
                let data = store ? store.get(this.id) : null;

                // Fallback: migrate dari legacy localStorage key jika store kosong
                if (!data) {
                    let raw = localStorage.getItem(this.storageKey);
                    if (raw) {
                        data = JSON.parse(raw);
                        // Migrate ke store baru lalu hapus legacy key
                        if (store && data) {
                            store.save(this.id, data);
                            localStorage.removeItem(this.storageKey);
                        }
                    }
                }

                if (!data) return;

                // Restore spans
                if (data.spans && typeof data.spans === 'object') {
                    for (let id in data.spans) {
                        if (this.spans[id]) {
                            let saved = data.spans[id];
                            let col = typeof saved === 'number' ? saved : (saved ? saved.col : null);
                            let row = (typeof saved === 'object' && saved && saved.row) ? saved.row : this.spans[id].row;

                            if (typeof col === 'number' && !isNaN(col)) {
                                this.spans[id].col = Math.max(this.spans[id].minCol, Math.min(this.spans[id].maxCol, col));
                            }
                            if (typeof row === 'number' && !isNaN(row)) {
                                this.spans[id].row = row;
                            }
                        }
                    }
                }

                // Restore order
                if (Array.isArray(data.order) && data.order.length > 0) {
                    let validIds = data.order.filter((id) => this.order.includes(id));
                    let missingIds = this.order.filter((id) => !validIds.includes(id));
                    this.order = [...validIds, ...missingIds];
                }
            } catch (e) {}
        },

        saveStoredLayout() {
            if (!this.persist) return;
            try {
                let savedSpans = {};
                for (let id in this.spans) {
                    savedSpans[id] = {
                        col: this.spans[id].col,
                        row: this.spans[id].row
                    };
                }
                let data = {
                    order: this.order,
                    spans: savedSpans
                };

                let store = this.getStore();
                if (store) {
                    store.save(this.id, data);
                } else {
                    // Fallback ke localStorage jika store belum siap
                    localStorage.setItem(this.storageKey, JSON.stringify(data));
                }

                window.dispatchEvent(new CustomEvent('vibe-grid-saved', { detail: { id: this.id, data } }));
            } catch (e) {}
        },

        applyLayout() {
            // Apply CSS order property to direct children without moving DOM nodes
            this.order.forEach((id, index) => {
                let el = this.getItemEl(id);
                if (el) {
                    el.style.order = index + 1;
                }
            });

            // Set gridColumn directly on each item
            for (let id in this.spans) {
                let el = this.getItemEl(id);
                if (el) {
                    el.style.gridColumn = 'span ' + this.spans[id].col;
                    el.style.gridRow = 'span ' + this.spans[id].row;
                }
            }
        },

        // --- Drag & Drop 1-to-1 Card Swap ---
        startDrag(id, e) {
            if (!this.isItemReorderable(id)) return;
            this.draggingId = id;
            if (e.dataTransfer) {
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/plain', id);
                e.dataTransfer.setData('application/x-vibe-grid', this.id);
                let cardEl = this.getItemEl(id);
                if (cardEl && e.dataTransfer.setDragImage) {
                    let rect = cardEl.getBoundingClientRect();
                    let offsetX = Math.min(rect.width / 2, Math.max(10, e.clientX - rect.left));
                    let offsetY = Math.min(rect.height / 2, Math.max(10, e.clientY - rect.top));
                    e.dataTransfer.setDragImage(cardEl, offsetX, offsetY);
                }
            }
        },

        onDragOver(targetId, e) {
            if (!this.draggingId || this.draggingId === targetId) return;
            // Target card MUST be reorderable (not locked) to be a valid swap target!
            if (!this.isItemReorderable(this.draggingId) || !this.isItemReorderable(targetId)) return;
            e.preventDefault();
            if (e.dataTransfer) e.dataTransfer.dropEffect = 'move';
            this.dragOverId = targetId;
        },

        onDragLeave(targetId, e) {
            let targetEl = this.getItemEl(targetId);
            if (targetEl && e.relatedTarget && targetEl.contains(e.relatedTarget)) {
                return;
            }
            if (this.dragOverId === targetId) {
                this.dragOverId = null;
            }
        },

        onDrop(targetId, e) {
            e.preventDefault();
            if (e.dataTransfer) {
                let gridSource = e.dataTransfer.getData('application/x-vibe-grid');
                if (gridSource && gridSource !== this.id) {
                    this.endDrag();
                    return;
                }
            }

            let fromId = this.draggingId || (e.dataTransfer && e.dataTransfer.getData('text/plain'));
            if (!fromId || fromId === targetId) {
                this.endDrag();
                return;
            }

            // Both the source and target cards MUST be reorderable (cannot swap with locked cards)!
            if (!this.isItemReorderable(fromId) || !this.isItemReorderable(targetId)) {
                this.endDrag();
                return;
            }

            let fromIndex = this.order.indexOf(fromId);
            let toIndex = this.order.indexOf(targetId);

            if (fromIndex !== -1 && toIndex !== -1 && fromIndex !== toIndex) {
                // Direct 1-to-1 SWAP: Tukar posisi langsung antar kedua kartu yang tidak terkunci
                let newOrder = [...this.order];
                newOrder[fromIndex] = targetId;
                newOrder[toIndex] = fromId;
                this.order = newOrder;

                this.applyLayout();
                this.saveStoredLayout();

                window.dispatchEvent(new CustomEvent('vibe-grid-swapped', {
                    detail: { id: this.id, fromId, targetId, order: this.order }
                }));
            }

            this.endDrag();
        },

        endDrag() {
            this.draggingId = null;
            this.dragOverId = null;
        },

        // --- Fluid Corner Drag-to-Resize ---
        startResize(id, e, cardEl) {
            if (e.button !== undefined && e.button !== 0) return;
            if (!this.isItemResizable(id)) return;
            let item = this.spans[id];
            if (!item) {
                this.discoverItems();
                item = this.spans[id];
            }
            if (!item) return;

            if (e.cancelable) e.preventDefault();

            // Use the passed element reference, or fall back to querySelector
            let targetEl = cardEl || this.getItemEl(id);
            if (!targetEl) return;

            let gridRect = this.$el.getBoundingClientRect();
            let computedStyle = window.getComputedStyle(this.$el);
            let gapPx = parseFloat(computedStyle.columnGap || computedStyle.gap) || 16;
            let totalCols = this.cols || 12;
            let colWidth = (gridRect.width - (totalCols - 1) * gapPx) / totalCols;

            let startX = (e.clientX !== undefined)
                ? e.clientX
                : (e.touches && e.touches[0] ? e.touches[0].clientX : 0);
            let startY = (e.clientY !== undefined)
                ? e.clientY
                : (e.touches && e.touches[0] ? e.touches[0].clientY : 0);

            this.resizing = {
                id: id,
                el: targetEl,
                startX: startX,
                startY: startY,
                startCols: item.col,
                colWidth: colWidth,
                gapPx: gapPx,
                minCol: item.minCol || 2,
                maxCol: item.maxCol || totalCols
            };

            this.previewId = id;
            this.previewCols = item.col;

            // Global stylesheet locks cursor to se-resize across ALL elements and disables text selection
            let existingStyle = document.getElementById('vibe-grid-resizing-style');
            if (existingStyle) existingStyle.remove();

            let styleEl = document.createElement('style');
            styleEl.id = 'vibe-grid-resizing-style';
            styleEl.textContent = '* { cursor: se-resize !important; user-select: none !important; -webkit-user-select: none !important; }';
            document.head.appendChild(styleEl);

            const onMove = (moveEvt) => {
                if (!this.resizing) return;
                let clientX = (moveEvt.clientX !== undefined)
                    ? moveEvt.clientX
                    : (moveEvt.touches && moveEvt.touches[0] ? moveEvt.touches[0].clientX : null);
                if (clientX === null) return;
                if (moveEvt.cancelable) moveEvt.preventDefault();
                this.updateResizeCalculation(clientX);
            };

            const onEnd = () => {
                window.removeEventListener('mousemove', onMove);
                window.removeEventListener('mouseup', onEnd);
                window.removeEventListener('touchmove', onMove);
                window.removeEventListener('touchend', onEnd);
                window.removeEventListener('touchcancel', onEnd);

                let st = document.getElementById('vibe-grid-resizing-style');
                if (st) st.remove();

                this.finishResize();
            };

            window.addEventListener('mousemove', onMove, { passive: false });
            window.addEventListener('mouseup', onEnd);
            window.addEventListener('touchmove', onMove, { passive: false });
            window.addEventListener('touchend', onEnd);
            window.addEventListener('touchcancel', onEnd);
        },

        updateResizeCalculation(currentX) {
            if (!this.resizing) return;

            let deltaX = currentX - this.resizing.startX;

            // Dead zone: ignore micro-movements under 4px
            if (Math.abs(deltaX) < 4) {
                let el = this.resizing.el || this.getItemEl(this.resizing.id);
                if (el) el.style.gridColumn = 'span ' + this.resizing.startCols;
                if (this.spans[this.resizing.id]) this.spans[this.resizing.id].col = this.resizing.startCols;
                this.previewCols = this.resizing.startCols;
                return;
            }

            // Min 50px per column — responsive but not jumpy
            let stepPx = Math.max(50, this.resizing.colWidth + this.resizing.gapPx);

            // Math.round: change triggers at 50% of step (natural feel)
            let colsDelta = Math.round(deltaX / stepPx);

            let calculatedCols = this.resizing.startCols + colsDelta;
            calculatedCols = Math.max(this.resizing.minCol, Math.min(this.resizing.maxCol, calculatedCols));

            this.previewCols = calculatedCols;

            if (this.spans[this.resizing.id]) {
                this.spans[this.resizing.id].col = calculatedCols;
            }

            // Use the stored element reference for instant DOM update
            let el = this.resizing.el || this.getItemEl(this.resizing.id);
            if (el) {
                el.style.gridColumn = 'span ' + calculatedCols;
            }
        },

        finishResize() {
            let st = document.getElementById('vibe-grid-resizing-style');
            if (st) st.remove();

            if (!this.resizing) return;
            let id = this.resizing.id;

            if (this.previewCols !== null && this.spans[id]) {
                this.spans[id].col = this.previewCols;
                this.saveStoredLayout();

                window.dispatchEvent(new CustomEvent('vibe-grid-resized', {
                    detail: { id: this.id, cardId: id, col: this.previewCols }
                }));
            }

            this.resizing = null;
            this.previewId = null;
            this.previewCols = null;
            this.applyLayout();
        },

        resetLayout() {
            try {
                let store = this.getStore();
                if (store) {
                    store.remove(this.id);
                } else {
                    localStorage.removeItem(this.storageKey);
                }
            } catch (e) {}

            this.order = [...this.initialOrder];
            this.spans = JSON.parse(JSON.stringify(this.initialSpans));
            this.applyLayout();
            window.dispatchEvent(new CustomEvent('vibe-grid-reset', { detail: { id: this.id } }));
        }
    };
}

// Auto-register in Alpine when available
if (typeof window !== 'undefined') {
    window.vibeGrid = vibeGrid;
    if (window.Alpine) {
        window.Alpine.data('vibeGrid', vibeGrid);
    } else {
        document.addEventListener('alpine:init', () => {
            if (window.Alpine) {
                window.Alpine.data('vibeGrid', vibeGrid);
            }
        });
    }
}
