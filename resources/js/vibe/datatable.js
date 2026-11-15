/**
 * Vibe DataTable - Bundled Rappasoft Livewire Tables v3 Alpine Components
 * Self-contained module loaded via @pushOnce('head', 'vibe-datatable-scripts').
 */

export function registerLivewireTableComponents(Alpine = window.Alpine, force = false) {
    if (!Alpine || typeof Alpine.data !== 'function') return;
    if (Alpine._vibeLivewireTablesRegistered && !force) return;
    Alpine._vibeLivewireTablesRegistered = true;

    const hasValidWire = (wire) => Boolean(wire && typeof wire.entangle === 'function');

    Alpine.data('laravellivewiretable', (i) => {
        const validWire = hasValidWire(i);

        return {
            __hasLivewireWire: validWire,
            tableId: '',
            showBulkActionsAlpine: false,
            primaryKeyName: '',
            shouldBeDisplayed: validWire ? i.entangle('shouldBeDisplayed') : true,
            tableName: validWire ? i.entangle('tableName') : '',
            dataTableFingerprint: validWire ? i.entangle('dataTableFingerprint') : '',
            listeners: [],
            childElementOpen: false,
            filtersOpen: validWire ? i.entangle('filterSlideDownDefaultVisible') : false,
            filterSlideDownDefaultVisible: validWire ? i.entangle('filterSlideDownDefaultVisible') : false,
            filterPopoverOpen: false,
            paginationCurrentCount: validWire ? i.entangle('paginationCurrentCount') : 0,
            paginationTotalItemCount: validWire ? i.entangle('paginationTotalItemCount') : 0,
            paginationCurrentItems: validWire ? i.entangle('paginationCurrentItems') : [],
            selectedItems: validWire ? i.entangle('selected') : [],
            selectAllStatus: validWire ? i.entangle('selectAll') : false,
            delaySelectAll: validWire ? i.entangle('delaySelectAll') : false,
            hideBulkActionsWhenEmpty: validWire ? i.entangle('hideBulkActionsWhenEmpty') : true,
            dragging: false,
            reorderEnabled: false,
            sourceID: '',
            targetID: '',
            evenRowClasses: '',
            oddRowClasses: '',
            currentlyHighlightedElement: '',
            evenRowClassArray: {},
            oddRowClassArray: {},
            evenNotInOdd: {},
            oddNotInEven: {},
            orderedRows: [],
            defaultReorderColumn: validWire ? i.entangle('defaultReorderColumn') : '',
            reorderStatus: validWire ? i.entangle('reorderStatus') : false,
            currentlyReorderingStatus: validWire ? i.entangle('currentlyReorderingStatus') : false,
            hideReorderColumnUnlessReorderingStatus: validWire ? i.entangle('hideReorderColumnUnlessReorderingStatus') : false,
            reorderDisplayColumn: validWire ? i.entangle('reorderDisplayColumn') : false,
            externalFilterPillsVals: validWire ? i.entangle('externalFilterPillsValues') : [],
            internalFilterPillsVals: validWire ? i.entangle('internalFilterPillsVals') : [],
            showFilterPillLabel: [],
            filterPillsSeparator: ', ',
            showFilterPillsSection: true,
            childRow: -1,
            toggleChildRow(e) {
                this.childRow = e === this.childRow ? -1 : e;
            },
            removeHTMLTags(e) {
                return (new DOMParser().parseFromString(e, 'text/html').body.innerText || '').trim();
            },
            resetSpecificFilter(e) {
                if (this.externalFilterPillsVals) {
                    this.externalFilterPillsVals[e] = [];
                }
                if (validWire) {
                    i.call('resetFilter', e);
                }
            },
            resetAllFilters() {
                this.externalFilterPillsVals = [];
                if (validWire) {
                    i.call('setFilterDefaults');
                }
            },
            setInternalFilterPillVal(e, t) {
                if (typeof t !== 'undefined' && this.internalFilterPillsVals) {
                    this.internalFilterPillsVals[e] = t;
                }
            },
            syncExternalFilterPillsValues(e, t) {
                if (this.externalFilterPillsVals) {
                    this.externalFilterPillsVals[e] = t;
                }
                this.showFilterPillLabel[e] = this.getFilterPillsLength(e);
            },
            getFilterPillsLength(e) {
                const target = this.externalFilterPillsVals ? this.externalFilterPillsVals[e] : null;
                return target ? Object.keys(target).length ?? 0 : 0;
            },
            showFilterPillsValue(e, t) {
                if (!this.externalFilterPillsVals) return;
                this.externalFilterPillsVals[e] = typeof t !== 'undefined' ? t : null;
            },
            setFilterPillsLength(e) {
                return typeof e !== 'undefined' && e !== null ? Object.keys(e).length ?? 0 : 0;
            },
            showFilterPillsLabel(e) {
                return this.getFilterPillsLength(e) > 0;
            },
            getFilterPillImplodedValues(e, t) {
                const l = this.externalFilterPillsVals ? this.externalFilterPillsVals[e] : undefined;
                return typeof l !== 'undefined' && Array.isArray(l) ? l.join(t) : '';
            },
            showFilterPillsSeparator(e, t) {
                return t + 1 < this.getFilterPillsLength(e);
            },
            getReorderTable() {
                if (!validWire || !i.$el) {
                    if (!this.tableId) return null;
                    return document.getElementById(this.tableId);
                }
                return Array.from(i.$el.querySelectorAll('table')).find(
                    (e) =>
                        e.id === this.tableId &&
                        e.closest('[wire\\:id]') === i.$el &&
                        e.parentElement.closest('table')?.closest('[wire\\:id]') !== i.$el
                );
            },
            getReorderRows() {
                const e = this.getReorderTable();
                if (!e) return [];
                return Array.from(e.tBodies).flatMap((t) =>
                    Array.from(t.children).filter(
                        (l) => l.tagName === 'TR' && l.hasAttribute('rowpk') && (!validWire || !i.$el || l.closest('[wire\\:id]') === i.$el)
                    )
                );
            },
            dragStart(e) {
                this.sourceID = '';
                const t = e.target.closest('tr');
                if (this.getReorderRows().includes(t)) {
                    this.$nextTick(() => {
                        this.setupEvenOddClasses();
                    });
                    this.sourceID = t.id;
                    e.dataTransfer.effectAllowed = 'move';
                    e.dataTransfer.setData('text/plain', t.id);
                    if (validWire && i.$el) {
                        e.dataTransfer.setData(
                            'application/x-livewire-tables',
                            JSON.stringify([i.$el.getAttribute('wire:id'), this.tableId])
                        );
                    }
                    t.classList.add('laravel-livewire-tables-dragging');
                }
            },
            dragOverEvent(e) {
                if (typeof this.currentlyHighlightedElement === 'object' && this.currentlyHighlightedElement) {
                    this.currentlyHighlightedElement.classList.remove(
                        'laravel-livewire-tables-highlight-bottom',
                        'laravel-livewire-tables-highlight-top'
                    );
                }
                const t = e.target.closest('tr');
                const l = this.getReorderRows();
                if (!l.some((s) => s.id === this.sourceID) || !l.includes(t)) return;
                this.currentlyHighlightedElement = t;
                if (e.offsetY < t.getBoundingClientRect().height / 2) {
                    t.classList.add('laravel-livewire-tables-highlight-top');
                    t.classList.remove('laravel-livewire-tables-highlight-bottom');
                } else {
                    t.classList.remove('laravel-livewire-tables-highlight-top');
                    t.classList.add('laravel-livewire-tables-highlight-bottom');
                }
            },
            dragLeaveEvent(e) {
                const t = e.target.closest('tr');
                if (this.getReorderRows().includes(t)) {
                    t.classList.remove('laravel-livewire-tables-highlight-bottom', 'laravel-livewire-tables-highlight-top');
                }
            },
            dropEvent(e) {
                if (typeof this.currentlyHighlightedElement === 'object' && this.currentlyHighlightedElement) {
                    this.currentlyHighlightedElement.classList.remove(
                        'laravel-livewire-tables-highlight-bottom',
                        'laravel-livewire-tables-highlight-top'
                    );
                }
                const t = this.getReorderRows();
                const l = e.target.closest('tr');
                const s = t.find((r) => r.id === this.sourceID);
                this.sourceID = '';
                if (
                    !s ||
                    !t.includes(l) ||
                    (validWire &&
                        i.$el &&
                        e.dataTransfer.getData('application/x-livewire-tables') !==
                            JSON.stringify([i.$el.getAttribute('wire:id'), this.tableId]))
                ) {
                    return;
                }
                s.classList.remove('laravel-livewire-tables-dragging');
                if (s === l) return;
                if (e.offsetY > l.getBoundingClientRect().height / 2) {
                    l.parentNode.insertBefore(s, l.nextSibling);
                } else {
                    l.parentNode.insertBefore(s, l);
                }
                let a = 'even';
                for (const r of this.getReorderRows()) {
                    if (!r.classList.contains('hidden') && !r.classList.contains('md:hidden')) {
                        if (a === 'even') {
                            r.classList.remove(...(Array.isArray(this.oddNotInEven) ? this.oddNotInEven : []));
                            r.classList.add(...(Array.isArray(this.evenNotInOdd) ? this.evenNotInOdd : []));
                            a = 'odd';
                        } else {
                            r.classList.remove(...(Array.isArray(this.evenNotInOdd) ? this.evenNotInOdd : []));
                            r.classList.add(...(Array.isArray(this.oddNotInEven) ? this.oddNotInEven : []));
                            a = 'even';
                        }
                    }
                }
            },
            reorderToggle() {
                if (!validWire) return;
                if (this.currentlyReorderingStatus) {
                    i.disableReordering();
                } else {
                    if (this.hideReorderColumnUnlessReorderingStatus) {
                        this.reorderDisplayColumn = true;
                    }
                    this.setupEvenOddClasses();
                    i.enableReordering();
                }
                this.$nextTick(() => {
                    this.setupEvenOddClasses();
                });
            },
            cancelReorder() {
                if (this.hideReorderColumnUnlessReorderingStatus) {
                    this.reorderDisplayColumn = false;
                }
                if (validWire) {
                    i.disableReordering();
                }
            },
            updateOrderedItems() {
                if (!validWire || !this.getReorderTable()) return;
                const e = this.getReorderRows().map((t, l) => ({
                    [this.primaryKeyName]: t.getAttribute('rowpk'),
                    [this.defaultReorderColumn]: l + 1,
                }));
                i.storeReorder(e);
            },
            setupEvenOddClasses() {
                if (
                    this.evenNotInOdd.length === void 0 ||
                    this.evenNotInOdd.length === 0 ||
                    this.oddNotInEven.length === void 0 ||
                    this.oddNotInEven.length === 0
                ) {
                    const e = this.getReorderRows();
                    if (e[0] !== void 0 && e[1] !== void 0) {
                        const t = Array.from(e[0].classList);
                        const l = Array.from(e[1].classList);
                        this.evenNotInOdd = t.filter((s) => !l.includes(s));
                        this.oddNotInEven = l.filter((s) => !t.includes(s));
                    }
                }
            },
            toggleSelectAll() {
                if (!this.showBulkActionsAlpine) return;
                const selectedLen = Array.isArray(this.selectedItems) ? this.selectedItems.length : 0;
                if (this.paginationTotalItemCount === selectedLen) {
                    this.clearSelected();
                    this.selectAllStatus = false;
                } else if (this.delaySelectAll) {
                    this.setAllItemsSelected();
                } else {
                    this.setAllSelected();
                }
            },
            setAllItemsSelected() {
                if (this.showBulkActionsAlpine) {
                    this.selectAllStatus = true;
                    this.selectAllOnPage();
                }
            },
            setAllSelected() {
                if (!this.showBulkActionsAlpine) return;
                if (this.delaySelectAll) {
                    this.selectAllStatus = true;
                    this.selectAllOnPage();
                } else if (validWire) {
                    i.setAllSelected();
                }
            },
            unsetAllSelected() {
                this.selectAllStatus = false;
            },
            clearSelected() {
                if (this.showBulkActionsAlpine) {
                    this.selectAllStatus = false;
                    if (validWire) {
                        i.clearSelected();
                    } else {
                        this.selectedItems = [];
                    }
                } else {
                    this.selectAllStatus = false;
                    this.selectedItems = [];
                }
            },
            selectAllOnPage() {
                if (!this.showBulkActionsAlpine) return;
                const e = Array.isArray(this.selectedItems) ? [...this.selectedItems] : [];
                const items = this.paginationCurrentItems && typeof this.paginationCurrentItems.values === 'function'
                    ? this.paginationCurrentItems.values()
                    : [];
                for (const l of items) {
                    e.push(l.toString());
                }
                this.selectedItems = [...new Set(e)];
            },
            setTableId(e) {
                this.tableId = e;
            },
            setAlpineBulkActions(e) {
                this.showBulkActionsAlpine = Boolean(e && e !== '0' && e !== 'false');
            },
            setPrimaryKeyName(e) {
                this.primaryKeyName = e;
            },
            showTable(e) {
                const t = e?.detail?.tableName ?? '';
                const l = e?.detail?.tableFingerpint ?? e?.detail?.tableFingerprint ?? '';
                if ((t !== '' && t === this.tableName) || (l !== '' && l === this.dataTableFingerprint)) {
                    this.shouldBeDisplayed = true;
                }
            },
            hideTable(e) {
                const t = e?.detail?.tableName ?? '';
                const l = e?.detail?.tableFingerpint ?? e?.detail?.tableFingerprint ?? '';
                if ((t !== '' && t === this.tableName) || (l !== '' && l === this.dataTableFingerprint)) {
                    this.shouldBeDisplayed = false;
                }
            },
            destroy() {
                if (Array.isArray(this.listeners)) {
                    this.listeners.forEach((e) => {
                        if (typeof e === 'function') e();
                    });
                }
            },
        };
    });

    Alpine.data('booleanFilter', (i, e, t, l) => {
        const validWire = hasValidWire(i);
        return {
            localListeners: [],
            switchOn: false,
            value: validWire ? i.entangle('filterComponents.' + e).live : null,
            init() {
                this.switchOn = false;
                if (typeof this.value !== 'undefined') {
                    this.switchOn = Boolean(Number(this.value));
                }
                if (window.Livewire && typeof window.Livewire.on === 'function') {
                    this.localListeners.push(
                        window.Livewire.on('filter-was-set', (s) => {
                            if (s.tableName == this.tableName && s.filterKey == e) {
                                this.switchOn = s.value ?? l;
                            }
                        })
                    );
                }
            },
            destroy() {
                this.localListeners.forEach((s) => {
                    if (typeof s === 'function') s();
                });
            },
        };
    });

    Alpine.data('newBooleanFilter', (i, e, t) => ({
        booleanFilterKey: i,
        switchOn: false,
        value: false,
        toggleStatus() {
            const s = !Boolean(Number(this.$wire?.get('filterComponents.' + this.booleanFilterKey) ?? this.value));
            this.switchOn = this.value = s;
            return Number(s);
        },
        toggleStatusWithUpdate() {
            const l = this.toggleStatus();
            this.$wire?.set('filterComponents.' + this.booleanFilterKey, l);
        },
        toggleStatusWithReset() {
            this.toggleStatus();
            this.$wire?.call('resetFilter', this.booleanFilterKey);
        },
        setSwitchOn(l) {
            const s = Number(l ?? 0);
            this.switchOn = Boolean(s);
        },
        init() {
            this.$nextTick(() => {
                this.value = this.$wire?.get('filterComponents.' + this.booleanFilterKey) ?? t;
                this.setSwitchOn(this.value ?? 0);
            });
            if (window.Livewire && typeof window.Livewire.on === 'function' && Array.isArray(this.listeners)) {
                this.listeners.push(
                    window.Livewire.on('filter-was-set', (l) => {
                        if (l.tableName == this.tableName && l.filterKey == this.booleanFilterKey) {
                            this.switchOn = l.value ?? t;
                        }
                    })
                );
            }
        },
    }));

    Alpine.data('booleanFilterLatest', (i) => ({
        booleanFilterKey: i?.filterKey,
        booleanFilterDefaultValue: i?.defaultValue,
        switchOn: false,
        value: false,
        toggleStatus() {
            const t = !Boolean(Number(this.$wire?.get('filterComponents.' + this.booleanFilterKey) ?? this.value));
            this.switchOn = this.value = t;
            return Number(t);
        },
        toggleStatusWithUpdate() {
            const e = this.toggleStatus();
            this.$wire?.set('filterComponents.' + this.booleanFilterKey, e);
        },
        toggleStatusWithReset() {
            this.toggleStatus();
            this.$wire?.call('resetFilter', this.booleanFilterKey);
        },
        setSwitchOn(e) {
            const t = Number(e ?? 0);
            this.switchOn = Boolean(t);
        },
        init() {
            this.$nextTick(() => {
                this.value = this.$wire?.get('filterComponents.' + this.booleanFilterKey) ?? this.booleanFilterDefaultValue;
                this.setSwitchOn(this.value ?? 0);
            });
            if (window.Livewire && typeof window.Livewire.on === 'function' && Array.isArray(this.listeners)) {
                this.listeners.push(
                    window.Livewire.on('filter-was-set', (e) => {
                        if (e.tableName == this.tableName && e.filterKey == this.booleanFilterKey) {
                            this.switchOn = e.value ?? this.booleanFilterDefaultValue;
                        }
                    })
                );
            }
        },
    }));

    Alpine.data('numberRangeFilter', (i, e, t, l, s) => {
        const validWire = hasValidWire(i);
        return {
            allFilters: validWire ? i.entangle('filterComponents', false) : {},
            originalMin: 0,
            originalMax: 100,
            filterMin: 0,
            filterMax: 100,
            currentMin: 0,
            currentMax: 100,
            hasUpdate: false,
            wireValues: validWire ? i.entangle('filterComponents.' + e, false) : {},
            defaultMin: l?.minRange ?? 0,
            defaultMax: l?.maxRange ?? 100,
            restrictUpdates: false,
            initialiseStyles() {
                const a = document.getElementById(t);
                if (!a) return;
                a.style.setProperty('--value-a', this.wireValues?.min ?? this.filterMin);
                a.style.setProperty('--text-value-a', JSON.stringify(this.wireValues?.min ?? this.filterMin));
                a.style.setProperty('--value-b', this.wireValues?.max ?? this.filterMax);
                a.style.setProperty('--text-value-b', JSON.stringify(this.wireValues?.max ?? this.filterMax));
            },
            updateStyles(a, r) {
                const o = document.getElementById(t);
                if (!o) return;
                o.style.setProperty('--value-a', a);
                o.style.setProperty('--text-value-a', JSON.stringify(a));
                o.style.setProperty('--value-b', r);
                o.style.setProperty('--text-value-b', JSON.stringify(r));
            },
            setupWire() {
                if (this.wireValues !== void 0) {
                    this.filterMin = this.originalMin = this.wireValues.min !== void 0 ? this.wireValues.min : this.defaultMin;
                    this.filterMax = this.originalMax = this.wireValues.max !== void 0 ? this.wireValues.max : this.defaultMax;
                } else {
                    this.filterMin = this.originalMin = this.defaultMin;
                    this.filterMax = this.originalMax = this.defaultMax;
                }
                this.updateStyles(this.filterMin, this.filterMax);
            },
            allowUpdates() {
                this.updateWire();
            },
            updateWire() {
                const a = parseInt(this.filterMin);
                const r = parseInt(this.filterMax);
                if (a !== this.originalMin || r !== this.originalMax) {
                    if (r < a) {
                        this.filterMin = r;
                        this.filterMax = a;
                    }
                    this.hasUpdate = true;
                    this.originalMin = a;
                    this.originalMax = r;
                }
                this.updateStyles(this.filterMin, this.filterMax);
            },
            updateWireable() {
                if (this.hasUpdate) {
                    this.hasUpdate = false;
                    this.wireValues = { min: this.filterMin, max: this.filterMax };
                    if (validWire) {
                        i.set('filterComponents.' + e, this.wireValues);
                    }
                }
            },
            init() {
                this.initialiseStyles();
                this.setupWire();
                this.$watch('allFilters', () => this.setupWire());
            },
        };
    });

    Alpine.data('flatpickrFilter', (i, e, t, l, s) => {
        const validWire = hasValidWire(i);
        return {
            wireValues: validWire ? i.entangle('filterComponents.' + e) : {},
            flatpickrInstance:
                typeof flatpickr === 'function'
                    ? flatpickr(l, {
                          mode: 'range',
                          altFormat: t?.altFormat ?? 'F j, Y',
                          altInput: t?.altInput ?? false,
                          allowInput: t?.allowInput ?? false,
                          allowInvalidPreload: t?.allowInvalidPreload ?? true,
                          ariaDateFormat: t?.ariaDateFormat ?? 'F j, Y',
                          clickOpens: true,
                          dateFormat: t?.dateFormat ?? 'Y-m-d',
                          defaultDate: t?.defaultDate ?? null,
                          defaultHour: t?.defaultHour ?? 12,
                          defaultMinute: t?.defaultMinute ?? 0,
                          enableTime: t?.enableTime ?? false,
                          enableSeconds: t?.enableSeconds ?? false,
                          hourIncrement: t?.hourIncrement ?? 1,
                          locale: t?.locale ?? 'en',
                          minDate: t?.earliestDate ?? null,
                          maxDate: t?.latestDate ?? null,
                          minuteIncrement: t?.minuteIncrement ?? 5,
                          shorthandCurrentMonth: t?.shorthandCurrentMonth ?? false,
                          time_24hr: t?.time_24hr ?? false,
                          weekNumbers: t?.weekNumbers ?? false,
                          onOpen: function () {
                              window.childElementOpen = true;
                          },
                          onChange: function (a, r) {
                              if (a.length > 1) {
                                  const n = r.split(' ');
                                  window.childElementOpen = false;
                                  window.filterPopoverOpen = false;
                                  const h = { minDate: n[0], maxDate: typeof n[2] === 'undefined' ? n[0] : n[2] };
                                  if (validWire) {
                                      i.set('filterComponents.' + e, h);
                                  }
                              }
                          },
                      })
                    : null,
            changedValue(a) {
                if (a.length < 5 && this.flatpickrInstance) {
                    this.flatpickrInstance.setDate([]);
                    if (validWire) {
                        i.set('filterComponents.' + e, {});
                    }
                }
            },
            setupWire() {
                if (!this.flatpickrInstance) return;
                if (this.wireValues !== void 0 && this.wireValues.minDate !== void 0 && this.wireValues.maxDate !== void 0) {
                    this.flatpickrInstance.setDate([this.wireValues.minDate, this.wireValues.maxDate]);
                } else {
                    this.flatpickrInstance.setDate([]);
                }
            },
            init() {
                this.setupWire();
                this.$watch('wireValues', () => this.setupWire());
            },
        };
    });

    Alpine.data('tableWrapper', (i, e) => {
        const validWire = hasValidWire(i);
        return {
            shouldBeDisplayed: validWire ? i.entangle('shouldBeDisplayed') : true,
            listeners: [],
            childElementOpen: false,
            filtersOpen: validWire ? i.entangle('filterSlideDownDefaultVisible') : false,
            filterPopoverOpen: false,
            paginationCurrentCount: validWire ? i.entangle('paginationCurrentCount') : 0,
            paginationTotalItemCount: validWire ? i.entangle('paginationTotalItemCount') : 0,
            paginationCurrentItems: validWire ? i.entangle('paginationCurrentItems') : [],
            selectedItems: validWire ? i.entangle('selected') : [],
            selectAllStatus: validWire ? i.entangle('selectAll') : false,
            delaySelectAll: validWire ? i.entangle('delaySelectAll') : false,
            hideBulkActionsWhenEmpty: validWire ? i.entangle('hideBulkActionsWhenEmpty') : true,
            toggleSelectAll() {
                if (!e) return;
                const selectedLen = Array.isArray(this.selectedItems) ? this.selectedItems.length : 0;
                if (this.paginationTotalItemCount === selectedLen) {
                    this.clearSelected();
                    this.selectAllStatus = false;
                } else if (this.delaySelectAll) {
                    this.setAllItemsSelected();
                } else {
                    this.setAllSelected();
                }
            },
            setAllItemsSelected() {
                if (e) {
                    this.selectAllStatus = true;
                    this.selectAllOnPage();
                }
            },
            setAllSelected() {
                if (!e) return;
                if (this.delaySelectAll) {
                    this.selectAllStatus = true;
                    this.selectAllOnPage();
                } else if (validWire) {
                    i.setAllSelected();
                }
            },
            clearSelected() {
                if (e) {
                    this.selectAllStatus = false;
                    if (validWire) {
                        i.clearSelected();
                    }
                }
            },
            selectAllOnPage() {
                if (!e) return;
                const t = Array.isArray(this.selectedItems) ? [...this.selectedItems] : [];
                const l = this.paginationCurrentItems && typeof this.paginationCurrentItems.values === 'function'
                    ? this.paginationCurrentItems.values()
                    : [];
                for (const s of l) {
                    t.push(s.toString());
                }
                this.selectedItems = [...new Set(t)];
            },
            destroy() {
                this.listeners.forEach((t) => {
                    if (typeof t === 'function') t();
                });
            },
        };
    });

    Alpine.data('reorderFunction', (i, e, t) => {
        const validWire = hasValidWire(i);
        return {
            dragging: false,
            reorderEnabled: false,
            sourceID: '',
            targetID: '',
            evenRowClasses: '',
            oddRowClasses: '',
            currentlyHighlightedElement: '',
            evenRowClassArray: {},
            oddRowClassArray: {},
            evenNotInOdd: {},
            oddNotInEven: {},
            orderedRows: [],
            defaultReorderColumn: validWire ? i.get('defaultReorderColumn') : '',
            reorderStatus: validWire ? i.get('reorderStatus') : false,
            currentlyReorderingStatus: validWire ? i.entangle('currentlyReorderingStatus') : false,
            hideReorderColumnUnlessReorderingStatus: validWire ? i.entangle('hideReorderColumnUnlessReorderingStatus') : false,
            reorderDisplayColumn: validWire ? i.entangle('reorderDisplayColumn') : false,
            getReorderTable() {
                if (!validWire || !i.$el) return document.getElementById(e);
                return Array.from(i.$el.querySelectorAll('table')).find(
                    (l) =>
                        l.id === e &&
                        l.closest('[wire\\:id]') === i.$el &&
                        l.parentElement.closest('table')?.closest('[wire\\:id]') !== i.$el
                );
            },
            getReorderRows() {
                const l = this.getReorderTable();
                if (!l) return [];
                return Array.from(l.tBodies).flatMap((s) =>
                    Array.from(s.children).filter(
                        (a) => a.tagName === 'TR' && a.hasAttribute('rowpk') && (!validWire || !i.$el || a.closest('[wire\\:id]') === i.$el)
                    )
                );
            },
            dragStart(l) {
                this.sourceID = '';
                const s = l.target.closest('tr');
                if (this.getReorderRows().includes(s)) {
                    this.$nextTick(() => {
                        this.setupEvenOddClasses();
                    });
                    this.sourceID = s.id;
                    l.dataTransfer.effectAllowed = 'move';
                    l.dataTransfer.setData('text/plain', s.id);
                    if (validWire && i.$el) {
                        l.dataTransfer.setData('application/x-livewire-tables', JSON.stringify([i.$el.getAttribute('wire:id'), e]));
                    }
                    s.classList.add('laravel-livewire-tables-dragging');
                }
            },
            dragOverEvent(l) {
                if (typeof this.currentlyHighlightedElement === 'object' && this.currentlyHighlightedElement) {
                    this.currentlyHighlightedElement.classList.remove(
                        'laravel-livewire-tables-highlight-bottom',
                        'laravel-livewire-tables-highlight-top'
                    );
                }
                const s = l.target.closest('tr');
                const a = this.getReorderRows();
                if (!a.some((r) => r.id === this.sourceID) || !a.includes(s)) return;
                this.currentlyHighlightedElement = s;
                if (l.offsetY < s.getBoundingClientRect().height / 2) {
                    s.classList.add('laravel-livewire-tables-highlight-top');
                    s.classList.remove('laravel-livewire-tables-highlight-bottom');
                } else {
                    s.classList.remove('laravel-livewire-tables-highlight-top');
                    s.classList.add('laravel-livewire-tables-highlight-bottom');
                }
            },
            dragLeaveEvent(l) {
                const s = l.target.closest('tr');
                if (this.getReorderRows().includes(s)) {
                    s.classList.remove('laravel-livewire-tables-highlight-bottom', 'laravel-livewire-tables-highlight-top');
                }
            },
            dropEvent(l) {
                if (typeof this.currentlyHighlightedElement === 'object' && this.currentlyHighlightedElement) {
                    this.currentlyHighlightedElement.classList.remove(
                        'laravel-livewire-tables-highlight-bottom',
                        'laravel-livewire-tables-highlight-top'
                    );
                }
                const s = this.getReorderRows();
                const a = l.target.closest('tr');
                const r = s.find((n) => n.id === this.sourceID);
                this.sourceID = '';
                if (
                    !r ||
                    !s.includes(a) ||
                    (validWire &&
                        i.$el &&
                        l.dataTransfer.getData('application/x-livewire-tables') !== JSON.stringify([i.$el.getAttribute('wire:id'), e]))
                ) {
                    return;
                }
                r.classList.remove('laravel-livewire-tables-dragging');
                if (r === a) return;
                if (l.offsetY > a.getBoundingClientRect().height / 2) {
                    a.parentNode.insertBefore(r, a.nextSibling);
                } else {
                    a.parentNode.insertBefore(r, a);
                }
                let o = 'even';
                for (const n of this.getReorderRows()) {
                    if (!n.classList.contains('hidden') && !n.classList.contains('md:hidden')) {
                        if (o === 'even') {
                            n.classList.remove(...(Array.isArray(this.oddNotInEven) ? this.oddNotInEven : []));
                            n.classList.add(...(Array.isArray(this.evenNotInOdd) ? this.evenNotInOdd : []));
                            o = 'odd';
                        } else {
                            n.classList.remove(...(Array.isArray(this.evenNotInOdd) ? this.evenNotInOdd : []));
                            n.classList.add(...(Array.isArray(this.oddNotInEven) ? this.oddNotInEven : []));
                            o = 'even';
                        }
                    }
                }
            },
            reorderToggle() {
                if (!validWire) return;
                this.$nextTick(() => {
                    this.setupEvenOddClasses();
                });
                if (this.currentlyReorderingStatus) {
                    i.disableReordering();
                } else {
                    this.setupEvenOddClasses();
                    if (this.hideReorderColumnUnlessReorderingStatus) {
                        this.reorderDisplayColumn = true;
                    }
                    i.enableReordering();
                }
            },
            cancelReorder() {
                if (this.hideReorderColumnUnlessReorderingStatus) {
                    this.reorderDisplayColumn = false;
                }
                if (validWire) {
                    i.disableReordering();
                }
            },
            updateOrderedItems() {
                if (!validWire || !this.getReorderTable()) return;
                const l = this.getReorderRows().map((s, a) => ({
                    [t]: s.getAttribute('rowpk'),
                    [this.defaultReorderColumn]: a + 1,
                }));
                i.storeReorder(l);
            },
            setupEvenOddClasses() {
                if (
                    this.evenNotInOdd.length === void 0 ||
                    this.evenNotInOdd.length === 0 ||
                    this.oddNotInEven.length === void 0 ||
                    this.oddNotInEven.length === 0
                ) {
                    const l = this.getReorderRows();
                    if (l[0] !== void 0 && l[1] !== void 0) {
                        const s = Array.from(l[0].classList);
                        const a = Array.from(l[1].classList);
                        this.evenNotInOdd = s.filter((r) => !a.includes(r));
                        this.oddNotInEven = a.filter((r) => !s.includes(r));
                    }
                }
            },
            init() {},
        };
    });

    Alpine.data('filterPillsHandler', (i) => ({
        localData: i || {},
        localFilterKey: '',
        localFilterTitle: '',
        isExternalFilter: false,
        shouldRenderAsHTML: false,
        shouldWatchPillValues: false,
        pillsSeparator: ',',
        pillValues: null,
        pillHasValues: false,
        displayString: '',
        generateLocalFilterPillImplodedValues(e) {
            if (typeof e !== 'undefined') {
                const t = '---tablepillsseparator---';
                const l = new RegExp(t, 'g');
                let s = Array.isArray(e) ? e.join(t) : e;
                if (!this.shouldRenderAsHTML) {
                    s = this.removeHTMLTags(s);
                }
                return s !== null && typeof s === 'string' ? s.replace(l, this.pillsSeparator) : '';
            }
            return '';
        },
        clearExternalFilterPill() {
            if (this.isExternalFilter) {
                this.externalFilterPillsVals[this.localFilterKey] = [];
                this.displayString = this.generateLocalFilterPillImplodedValues(this.externalFilterPillsVals[this.localFilterKey]);
                this.updatePillHasValues();
                this.resetSpecificFilter(this.localFilterKey);
            }
        },
        trigger: {
            '@filterpillupdate.window'(e) {
                this.watchForUpdateEvent(e);
            },
        },
        checkEventIsValid(e, t) {
            return this.tableName === e && this.localFilterKey === t;
        },
        watchForUpdateEvent(e) {
            if (this.checkEventIsValid(e.detail?.tableName ?? '', e.detail?.filterKey ?? '')) {
                let t = e.detail?.pillItem ?? '';
                if (!this.shouldRenderAsHTML) {
                    t = this.removeHTMLTags(t);
                }
                if (t !== '') {
                    if (this.isExternalFilter) {
                        const l = this.externalFilterPillsVals[this.localFilterKey] || [];
                        l.push(t);
                        this.updatePillValues(l);
                    } else {
                        this.updatePillValues(t);
                    }
                }
            }
        },
        updatePillValues(e) {
            this.pillValues = e;
            this.displayString = this.generateLocalFilterPillImplodedValues(e);
            this.updatePillHasValues();
            return this.displayString;
        },
        updatePillHasValues() {
            this.pillHasValues = this.displayString.length > 0;
        },
        init() {
            this.localFilterKey = this.localData.filterKey ?? 'unknown';
            this.localFilterTitle = this.localData.filterPillTitle ?? 'Unknown';
            this.pillsSeparator = this.localData.separator ?? ',';
            this.shouldWatchPillValues = Boolean(this.localData.watchForEvents ?? 0);
            this.isExternalFilter = Boolean(this.localData.isAnExternalLivewireFilter ?? 0);
            this.shouldRenderAsHTML = Boolean(this.localData.renderPillsAsHtml ?? 0);
            this.pillValues = this.localData.pillValues ?? null;
            this.$nextTick(() => {
                if (this.isExternalFilter) {
                    this.updatePillValues(this.externalFilterPillsVals?.[this.localFilterKey]);
                } else {
                    this.updatePillValues(this.pillValues);
                }
            });
            if (this.isExternalFilter && this.shouldWatchPillValues) {
                this.$watch('externalFilterPillsVals.' + this.localFilterKey, (e) => {
                    this.updatePillValues(e);
                });
            }
        },
    }));

    Alpine.data('tablesExternalFilter', (i, e) => {
        const validWire = hasValidWire(i);
        return {
            externalFilterKey: e,
            pillValues: [],
            optionsAvailable: validWire ? i.entangle('optionsAvailable') : {},
            optionsSelected: validWire ? i.entangle('optionsSelected').live : [],
            selectedItems: validWire ? i.entangle('selectedItems') : [],
            sendValueToPill(t) {
                const l = this.removeHTMLTags(t);
                this.$dispatch('filterpillupdate', {
                    tableName: this.tableName,
                    filterKey: this.externalFilterKey,
                    pillItem: l,
                });
            },
            overridePill(t) {
                const l = this.removeHTMLTags(t);
                this.$dispatch('filterpillupdate', {
                    tableName: this.tableName,
                    filterKey: this.externalFilterKey,
                    pillItem: l,
                });
            },
            syncItems(t) {
                this.pillValues = [];
                if (Array.isArray(t)) {
                    t.forEach((l) => {
                        this.pillValues.push(this.optionsAvailable?.[l]);
                    });
                }
                if (this.pillValues.length > 0) {
                    this.pillValues.sort();
                    this.syncExternalFilterPillsValues(this.externalFilterKey, this.pillValues);
                }
                this.optionsSelected = this.selectedItems;
                if (validWire) {
                    i.set('value', this.selectedItems);
                }
            },
            init() {
                this.selectedItems = this.optionsSelected;
                this.syncItems(this.selectedItems);
                this.$watch('selectedItems', (t) => this.syncItems(t));
            },
        };
    });
}

export function isTableElementInitialized(el) {
    if (!el || !Array.isArray(el._x_dataStack) || el._x_dataStack.length === 0) {
        return false;
    }

    return el._x_dataStack.some(
        (scope) =>
            scope &&
            typeof scope.setTableId === 'function' &&
            typeof scope.setAlpineBulkActions === 'function' &&
            typeof scope.setPrimaryKeyName === 'function' &&
            scope.__hasLivewireWire !== false
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
    registerLivewireTableComponents(window.Alpine, true);
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
