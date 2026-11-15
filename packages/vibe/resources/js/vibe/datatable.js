/**
 * Vibe DataTable - Bundled Rappasoft Livewire Tables Alpine Components
 * Self-contained module to guarantee registration on initial load, hard refresh (F5), and SPA navigation (wire:navigate).
 */

export function registerLivewireTableComponents(Alpine = window.Alpine) {
    if (!Alpine || typeof Alpine.data !== 'function') return;
    if (Alpine._vibeLivewireTablesRegistered) return;
    Alpine._vibeLivewireTablesRegistered = true;

    const hasValidWire = (wire) => Boolean(wire && typeof wire.entangle === 'function');

    Alpine.data('laravellivewiretable', (e) => {
        const validWire = hasValidWire(e);

        return {
            __hasLivewireWire: validWire,
            paginationCurrentCount: validWire ? e.entangle('paginationCurrentCount') : 0,
            paginationTotalItemCount: validWire ? e.entangle('paginationTotalItemCount') : 0,
            childRow: -1,
            currentlyReorderingStatus: validWire ? e.entangle('currentlyReorderingStatus') : false,
            selectedItems: validWire ? e.entangle('selected') : [],
            selectAllStatus: validWire ? e.entangle('selectAll') : false,
            filterSlideDownDefaultVisible: validWire ? e.entangle('filterSlideDownDefaultVisible') : false,
            filtersOpen: validWire ? e.entangle('filterSlideDownDefaultVisible').live : false,
            filterPopoverOpen: false,
            tableId: null,
            toggleChildRow(t) {
                this.childRow = t === this.childRow ? -1 : t;
            },
            shouldBeDisplayed: (t) => true,
            showTable(t) {
                const l = t?.detail?.tableFingerprint;
                if (this.$wire?.__instance?.id && l === this.$wire.__instance.id) {
                    this.$root.classList.remove('hidden');
                }
            },
            hideTable(t) {
                const l = t?.detail?.tableFingerprint;
                if (this.$wire?.__instance?.id && l === this.$wire.__instance.id) {
                    this.$root.classList.add('hidden');
                }
            },
            setTableId(t) {
                this.tableId = t;
            },
            clearSelected() {
                this.unsetAllSelected();
                this.selectedItems = [];
            },
            setAllSelected() {
                this.selectAllStatus = true;
            },
            unsetAllSelected() {
                this.selectAllStatus = false;
            },
            toggleSelectAll() {
                if (
                    !this.selectAllStatus &&
                    Array.isArray(this.selectedItems) &&
                    this.paginationTotalItemCount === this.selectedItems.length
                ) {
                    this.setAllSelected();
                    this.selectAllStatus = true;
                }
            },
            getReorderTable() {
                if (!this.tableId) return null;
                const tableEl = document.getElementById(this.tableId);
                return tableEl ? tableEl.getElementsByTagName('tbody')[0] ?? null : null;
            },
            getReorderRows() {
                const tbody = this.getReorderTable();
                return tbody ? tbody.rows ?? [] : [];
            },
            setupEvenOddClasses() {
                const rows = Array.from(this.getReorderRows());
                let evenClass = [];
                let oddClass = [];

                rows.forEach((row, idx) => {
                    if (evenClass.length === 0 && oddClass.length === 0) {
                        if (idx % 2 === 0) {
                            row.classList.forEach((cls) => {
                                if (cls.startsWith('even:')) evenClass.push(cls);
                            });
                        } else {
                            row.classList.forEach((cls) => {
                                if (cls.startsWith('odd:')) oddClass.push(cls);
                            });
                        }
                    } else {
                        return false;
                    }
                });

                const strippedEvenClasses = evenClass.map((s) => s.slice(5));
                const strippedOddClasses = oddClass.map((s) => s.slice(4));

                rows.forEach((row, idx) => {
                    row.classList.remove(...evenClass, ...oddClass, ...strippedEvenClasses, ...strippedOddClasses);
                    if (idx % 2 === 0) {
                        row.classList.add(...strippedOddClasses);
                    } else {
                        row.classList.add(...strippedEvenClasses);
                    }
                });
            },
            sourceID: null,
            targetID: null,
            evenClasses: null,
            oddClasses: null,
            dragStart(t) {
                this.setupEvenOddClasses();
                this.sourceID = t.target.id;
                t.dataTransfer.effectAllowed = 'move';
                t.dataTransfer.setData('text/plain', t.target.id);
                t.target.classList.add('laravel-livewire-tables-reordering-drag');
            },
            dragOverEvent(t) {
                if (typeof t.target.closest !== 'function') return false;
                const n = t.target.closest('tr');
                if (!n) return false;
                Array.from(n.getElementsByTagName('td')).forEach((el) => {
                    el.classList.add('!border-t-2', '!border-t-blue-500');
                });
                this.targetID = n.id;
            },
            dragLeaveEvent(t) {
                if (typeof t.target.closest !== 'function') return false;
                const n = t.target.closest('tr');
                if (!n) return false;
                Array.from(n.getElementsByTagName('td')).forEach((el) => {
                    el.classList.remove('!border-t-2', '!border-t-blue-500');
                });
            },
            dropEvent(t) {
                if (typeof t.target.closest !== 'function') return false;
                const tbody = this.getReorderTable();
                if (!tbody || !this.sourceID) return false;
                const sourceRow = document.getElementById(this.sourceID);
                if (!sourceRow) return false;
                sourceRow.classList.remove('laravel-livewire-tables-reordering-drag');
                const n = t.target.closest('tr');
                if (!n) return false;
                Array.from(n.getElementsByTagName('td')).forEach((el) => {
                    el.classList.remove('!border-t-2', '!border-t-blue-500');
                });
                const i = n.parentNode.rowIndex;
                const r = sourceRow.rowIndex;
                if (i > r) {
                    tbody.insertBefore(sourceRow, n.nextSibling);
                } else {
                    tbody.insertBefore(sourceRow, n);
                }
                this.setupEvenOddClasses();
            },
            updateOrderedItems() {
                if (!validWire) return;
                const rows = Array.from(this.getReorderRows());
                const n = [];
                const i = e.get('reorderDisplayColumn');
                const r = e.get('defaultReorderColumn');
                rows.forEach((row, a) => {
                    const o = a + 1;
                    if (i) {
                        const cell = row.getElementsByClassName('reorder-current-value-' + this.tableId)[0];
                        if (cell) cell.innerHTML = o;
                    }
                    n.push({ value: row.getAttribute('wire:sortable.item'), [r]: o });
                });
                e.reorderItems(n);
            },
            init() {
                this.filtersOpen = this.filterSlideDownDefaultVisible;
            },
        };
    });

    Alpine.data('booleanFilter', (e, t, n) => {
        const validWire = hasValidWire(e);
        return {
            value: validWire ? e.entangle('filterComponents.' + t) : null,
            hasValue: false,
            selectValue: -1,
            toggleStatusWithUpdate() {
                this.toggleStatus();
                this.value = this.selectValue;
            },
            toggleStatus() {
                this.selectValue = Boolean(parseInt(this.selectValue)) !== true ? 1 : 0;
                this.hasValue = true;
            },
            resetValue() {
                this.value = null;
                this.hasValue = false;
            },
            init() {
                if (typeof this.value === 'boolean' || typeof this.value === 'string' || typeof this.value === 'number') {
                    this.selectValue = Boolean(parseInt(this.value)) === true ? 1 : 0;
                    this.hasValue = true;
                }
                this.$watch('value', (i) => {
                    if (i === null) this.hasValue = false;
                });
            },
        };
    });

    Alpine.data('newBooleanFilter', (e, t, n) => ({
        value: hasValidWire(e) ? e.entangle('filterComponents.' + t) : null,
        hasValue: false,
        toggleStatusWithUpdate() {
            this.toggleStatus();
        },
        toggleStatus() {
            this.value = Boolean(parseInt(this.value)) !== true ? 1 : 0;
        },
        resetValue() {
            this.value = null;
        },
    }));

    Alpine.data('booleanFilterLatest', (e, t, n) => {
        const validWire = hasValidWire(e);
        return {
            filterKey: t,
            localValue: validWire ? e.entangle('filterComponents.' + t) : null,
            toggleStatus() {
                this.localValue = Boolean(parseInt(this.localValue)) !== true ? 1 : 0;
            },
            resetValue() {
                this.localValue = null;
            },
            updateWireable() {
                if (validWire) {
                    e.set('filterComponents.' + this.filterKey, this.localValue);
                }
            },
            init() {
                this.$watch('localValue', (i) => i !== null && this.updateWireable());
            },
        };
    });

    Alpine.data('numberRangeFilter', (e, t, n, i) => {
        const validWire = hasValidWire(e);
        return {
            filterValues: validWire ? e.entangle('filterComponents.' + t) : { min: 0, max: 100 },
            currentMin: 0,
            currentMax: 100,
            allowUpdates: false,
            filterMin: 0,
            filterMax: 100,
            minThumb: 0,
            maxThumb: 0,
            updateMin() {
                this.currentMin = Math.min(this.currentMin, this.currentMax - 1);
                this.minThumb = ((this.currentMin - this.filterMin) / (this.filterMax - this.filterMin)) * 100;
            },
            updateMax() {
                this.currentMax = Math.max(this.currentMax, this.currentMin + 1);
                this.maxThumb = 100 - ((this.currentMax - this.filterMin) / (this.filterMax - this.filterMin)) * 100;
            },
            updateWireable() {
                if (this.allowUpdates) {
                    this.allowUpdates = false;
                    this.filterValues = { min: this.currentMin, max: this.currentMax };
                }
            },
            init() {
                this.filterMin = i.minRange;
                this.filterMax = i.maxRange;
                this.currentMin = this.filterValues.min !== void 0 ? this.filterValues.min : this.filterMin;
                this.currentMax = this.filterValues.max !== void 0 ? this.filterValues.max : this.filterMax;
                this.$watch('filterValues', (r) => {
                    this.currentMin = r.min !== void 0 ? r.min : this.filterMin;
                    this.currentMax = r.max !== void 0 ? r.max : this.filterMax;
                    this.updateMin();
                    this.updateMax();
                });
                this.updateMin();
                this.updateMax();
            },
        };
    });

    Alpine.data('flatpickrFilter', (e, t, n, i, r) => {
        const validWire = hasValidWire(e);
        return {
            flatpickrInstance: null,
            shouldUpdate: false,
            filterKey: t,
            filterConfig: n,
            wireValues: validWire ? e.entangle('filterComponents.' + t) : [],
            wireValuesArray: [],
            dateValues: [],
            setupFlatpickr() {
                if (typeof flatpickr !== 'function') return;
                this.flatpickrInstance = flatpickr(this.$refs.rangeInput, {
                    mode: 'range',
                    altFormat: n.ariaDateFormat,
                    altInput: true,
                    allowInvalidPreload: true,
                    dateFormat: n.dateFormat,
                    defaultDate: [this.wireValues.minDate, this.wireValues.maxDate],
                    enableTime: n.enableTime,
                    locale: r,
                    maxDate: n.maxDate,
                    minDate: n.minDate,
                    shorthandCurrentMonth: n.shorthandCurrentMonth,
                    time_24hr: n.time_24hr,
                    weekNumbers: n.weekNumbers,
                    onOpen: () => {
                        this.childElementOpen = true;
                        this.shouldUpdate = true;
                    },
                    onChange: (a, o, s) => {
                        if (a.length > 1) {
                            const d = o.split(s.l10n.rangeSeparator);
                            const c = d[0];
                            const f = d[1];
                            if (this.shouldUpdate) {
                                this.wireValues = { minDate: c, maxDate: f };
                                this.childElementOpen = false;
                            }
                        }
                    },
                });
            },
            init() {
                if (this.wireValues !== void 0) {
                    if (this.wireValues.minDate !== void 0 && this.wireValues.maxDate !== void 0) {
                        this.wireValuesArray = [this.wireValues.minDate, this.wireValues.maxDate];
                    } else {
                        this.wireValues = [];
                    }
                } else {
                    this.wireValuesArray = [];
                }
                this.setupFlatpickr();
                this.$watch('wireValues', (a) => {
                    if (!this.flatpickrInstance) return;
                    if (a.minDate === void 0 && a.maxDate === void 0) {
                        this.flatpickrInstance.clear();
                    } else if (a.minDate !== void 0 && a.maxDate !== void 0) {
                        this.shouldUpdate = false;
                        this.flatpickrInstance.setDate([a.minDate, a.maxDate]);
                    }
                });
            },
        };
    });

    Alpine.data('tableWrapper', (e, t) => ({
        childElementOpen: false,
        filtersOpen: hasValidWire(e) ? e.entangle('filterSlideDownDefaultVisible').live : false,
        filterPopoverOpen: false,
    }));

    Alpine.data('reorderFunction', (e, t, n) => {
        const validWire = hasValidWire(e);
        return {
            tableId: t,
            sourceID: '',
            targetID: '',
            currentlyReorderingStatus: validWire ? e.entangle('currentlyReorderingStatus') : false,
            evenClasses: null,
            oddClasses: null,
            defaultReorderColumn: validWire ? e.entangle('defaultReorderColumn') : null,
            hideReorderColumnUnlessReorderingStatus: validWire ? e.entangle('hideReorderColumnUnlessReorderingStatus') : false,
            reorderDisplayColumn: validWire ? e.entangle('reorderDisplayColumn') : false,
            dragStart(i) {
                this.setupEvenOddClasses();
                this.sourceID = i.target.id;
                i.dataTransfer.effectAllowed = 'move';
                i.dataTransfer.setData('text/plain', i.target.id);
                i.target.classList.add('laravel-livewire-tables-reordering-drag');
            },
            dragOverEvent(i) {
                if (typeof i.target.closest !== 'function') return false;
                const r = i.target.closest('tr');
                if (!r) return false;
                Array.from(r.getElementsByTagName('td')).forEach((el) => {
                    el.classList.add('!border-t-2', '!border-t-blue-500');
                });
                this.targetID = r.id;
            },
            dragLeaveEvent(i) {
                if (typeof i.target.closest !== 'function') return false;
                const r = i.target.closest('tr');
                if (!r) return false;
                Array.from(r.getElementsByTagName('td')).forEach((el) => {
                    el.classList.remove('!border-t-2', '!border-t-blue-500');
                });
            },
            dropEvent(i) {
                if (typeof i.target.closest !== 'function') return false;
                const tbody = this.getReorderTable();
                if (!tbody || !this.sourceID) return false;
                const sourceRow = document.getElementById(this.sourceID);
                if (!sourceRow) return false;
                sourceRow.classList.remove('laravel-livewire-tables-reordering-drag');
                const r = i.target.closest('tr');
                if (!r) return false;
                Array.from(r.getElementsByTagName('td')).forEach((el) => {
                    el.classList.remove('!border-t-2', '!border-t-blue-500');
                });
                const a = r.parentNode.rowIndex;
                const o = sourceRow.rowIndex;
                if (a > o) {
                    tbody.insertBefore(sourceRow, r.nextSibling);
                } else {
                    tbody.insertBefore(sourceRow, r);
                }
                this.setupEvenOddClasses();
            },
            reorderEnabled() {
                this.currentlyReorderingStatus = true;
            },
            cancelReorder() {
                this.currentlyReorderingStatus = false;
                if (validWire) e.resetReorder();
            },
            updateOrderedItems() {
                if (!validWire) return;
                const rows = Array.from(this.getReorderRows());
                const r = [];
                rows.forEach((row, o) => {
                    const s = o + 1;
                    if (this.reorderDisplayColumn) {
                        const cell = row.getElementsByClassName('reorder-current-value-' + this.tableId)[0];
                        if (cell) cell.innerHTML = s;
                    }
                    r.push({ value: row.getAttribute('wire:sortable.item'), [n]: s });
                });
                e.reorderItems(r);
            },
            getReorderTable() {
                if (!this.tableId) return null;
                const tableEl = document.getElementById(this.tableId);
                return tableEl ? tableEl.getElementsByTagName('tbody')[0] ?? null : null;
            },
            getReorderRows() {
                const tbody = this.getReorderTable();
                return tbody ? tbody.rows ?? [] : [];
            },
            setupEvenOddClasses() {
                const rows = Array.from(this.getReorderRows());
                let evenClass = [];
                let oddClass = [];

                rows.forEach((row, idx) => {
                    if (evenClass.length === 0 && oddClass.length === 0) {
                        if (idx % 2 === 0) {
                            row.classList.forEach((cls) => {
                                if (cls.startsWith('even:')) evenClass.push(cls);
                            });
                        } else {
                            row.classList.forEach((cls) => {
                                if (cls.startsWith('odd:')) oddClass.push(cls);
                            });
                        }
                    } else {
                        return false;
                    }
                });

                const strippedEvenClasses = evenClass.map((c) => c.slice(5));
                const strippedOddClasses = oddClass.map((c) => c.slice(4));

                rows.forEach((row, idx) => {
                    row.classList.remove(...evenClass, ...oddClass, ...strippedEvenClasses, ...strippedOddClasses);
                    if (idx % 2 === 0) {
                        row.classList.add(...strippedOddClasses);
                    } else {
                        row.classList.add(...strippedEvenClasses);
                    }
                });
            },
        };
    });

    Alpine.data('filterPillsHandler', (e, t) => ({
        localFilterKey: t,
        resetSpecificFilter(n) {
            if (hasValidWire(e)) {
                e.resetFilter(n);
            }
        },
    }));

    Alpine.data('tablesExternalFilter', (e, t) => ({
        tableComponent: window.Livewire ? window.Livewire.find(e) : null,
        selectedValue: '',
        filterKey: t,
        updateStatus() {
            if (this.tableComponent) {
                this.tableComponent.set('filterComponents.' + this.filterKey, this.selectedValue);
            }
        },
        init() {
            if (this.tableComponent) {
                this.selectedValue = this.tableComponent.get('filterComponents.' + this.filterKey);
                this.$watch('selectedValue', () => {
                    this.updateStatus();
                });
            }
        },
    }));
}

export function isTableElementInitialized(el) {
    if (!el || !Array.isArray(el._x_dataStack) || el._x_dataStack.length === 0) {
        return false;
    }

    return el._x_dataStack.some(
        (scope) => scope && typeof scope.setTableId === 'function' && scope.__hasLivewireWire !== false
    );
}

export function resetAlpineSubtree(el) {
    if (!el) return;

    if (window.Alpine && typeof window.Alpine.destroyTree === 'function') {
        try {
            window.Alpine.destroyTree(el);
        } catch (_) {
            // Ignore cleanup errors on partially initialized subtrees
        }
    }

    const clearNode = (node) => {
        if (!node) return;
        delete node._x_marker;
        delete node._x_dataStack;
    };

    clearNode(el);
    if (typeof el.querySelectorAll === 'function') {
        el.querySelectorAll('*').forEach(clearNode);
    }
}

export function ensureDatatablesReady(root = document) {
    registerLivewireTableComponents(window.Alpine);

    if (!window.Alpine || typeof window.Alpine.initTree !== 'function') {
        return;
    }

    const scopeRoot = root && typeof root.querySelectorAll === 'function' ? root : document;
    const selector = '[x-data*="laravellivewiretable"]';
    const tables = [];

    if (scopeRoot instanceof Element && scopeRoot.matches(selector)) {
        tables.push(scopeRoot);
    }
    scopeRoot.querySelectorAll(selector).forEach((el) => tables.push(el));

    if (tables.length === 0) {
        return;
    }

    const livewireBootFinished = Boolean(window.Livewire?.initialRenderIsFinished);

    tables.forEach((el) => {
        const wireRoot = el.closest('[wire\\:id]');

        // Never call Alpine.initTree(el) before Livewire has mounted its enclosing [wire:id] component.
        // Initializing the inner table before wireRoot.__livewire exists causes "$wire is not defined"
        // and stamps _x_marker on the subtree, blocking Livewire's own initialization.
        if (!wireRoot) {
            return;
        }

        if (!wireRoot.__livewire) {
            if (livewireBootFinished) {
                try {
                    window.Alpine.initTree(wireRoot);
                } catch (_) {
                    // Wait for Livewire to mount wireRoot
                }
            }

            if (!wireRoot.__livewire) {
                return;
            }
        }

        if (!isTableElementInitialized(el)) {
            resetAlpineSubtree(el);
            try {
                window.Alpine.initTree(el);
            } catch (err) {
                console.warn('[Vibe UI DataTable] Re-init warning:', err);
            }
        }

        if (isTableElementInitialized(el)) {
            if (el.hasAttribute('x-cloak')) {
                el.removeAttribute('x-cloak');
            }
            const wrapperRoot = el.closest('.vibe-datatable-root');
            if (wrapperRoot && wrapperRoot.hasAttribute('x-cloak')) {
                wrapperRoot.removeAttribute('x-cloak');
            }
        }
    });
}

// Expose global helpers for VibeServiceProvider and Blade hooks
window.VibeRegisterDataTableComponents = registerLivewireTableComponents;
window.VibeInitDataTable = ensureDatatablesReady;

if (window.Alpine) {
    registerLivewireTableComponents(window.Alpine);
}

const scheduleEnsureDatatables = (root = document) => {
    ensureDatatablesReady(root);
    if (typeof requestAnimationFrame === 'function') {
        requestAnimationFrame(() => ensureDatatablesReady(root));
    }
    setTimeout(() => ensureDatatablesReady(root), 60);
};

const bindLivewireHooks = () => {
    if (!window.Livewire || typeof window.Livewire.hook !== 'function') return;
    if (window.__vibeDatatableLivewireHookRegistered) return;
    window.__vibeDatatableLivewireHookRegistered = true;

    window.Livewire.hook('morph.updated', ({ el }) => {
        queueMicrotask(() => ensureDatatablesReady(el || document));
    });

    window.Livewire.hook('morphed', ({ el }) => {
        queueMicrotask(() => ensureDatatablesReady(el || document));
    });
};

// Register Alpine component definitions BEFORE Livewire/Alpine walks the DOM tree
document.addEventListener('alpine:init', () => {
    registerLivewireTableComponents(window.Alpine);
});

document.addEventListener('livewire:init', () => {
    registerLivewireTableComponents(window.Alpine);
    bindLivewireHooks();
});

// Run tree verification ONLY AFTER Livewire/Alpine initial boot or SPA navigation finishes
document.addEventListener('livewire:initialized', () => {
    bindLivewireHooks();
    scheduleEnsureDatatables(document);
});

document.addEventListener('alpine:initialized', () => {
    scheduleEnsureDatatables(document);
});

document.addEventListener('livewire:navigated', () => {
    bindLivewireHooks();
    scheduleEnsureDatatables(document);
});

// If this module was loaded on-demand (e.g. via @pushOnce('head') during wire:navigate) after Livewire booted
if (window.Livewire?.initialRenderIsFinished) {
    bindLivewireHooks();
    scheduleEnsureDatatables(document);
}

window.dispatchEvent(new CustomEvent('vibe-datatable-ready'));
