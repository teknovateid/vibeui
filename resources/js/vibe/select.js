import { decodeHtml as coreDecodeHtml } from './core';

/**
 * Vibe UI - Select & Remote Select Components
 * Externalized Alpine.js state machines for <vibe:select> and <vibe:select.remote>.
 */

const sharedSelectMethods = {
    getBadgeClasses(index) {
        if (this.badgeVariant === 'cycle') {
            const cycle = [
                'bg-info/15 text-info border-info/30 hover:bg-info/20',
                'bg-primary/15 text-primary border-primary/30 hover:bg-primary/20',
                'bg-success/15 text-success border-success/30 hover:bg-success/20',
                'bg-warning/15 text-warning border-warning/30 hover:bg-warning/20',
                'bg-purple-500/15 text-purple-600 dark:text-purple-400 border-purple-500/30 hover:bg-purple-500/20',
                'bg-pink-500/15 text-pink-600 dark:text-pink-400 border-pink-500/30 hover:bg-pink-500/20',
                'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border-emerald-500/30 hover:bg-emerald-500/20',
                'bg-cyan-500/15 text-cyan-600 dark:text-cyan-400 border-cyan-500/30 hover:bg-cyan-500/20',
            ];
            return cycle[index % cycle.length];
        }
        if (this.badgeVariant === 'primary') {
            return 'bg-primary text-primary-foreground border-transparent shadow-2xs';
        }
        if (this.badgeVariant === 'outline') {
            return 'bg-transparent text-foreground border-border hover:bg-muted';
        }
        return 'bg-muted/80 text-foreground border-border/70 hover:bg-muted';
    },

    decodeHtml(str) {
        return coreDecodeHtml(str);
    },

    canSelectMore() {
        if (!this.multiple) return true;
        if (this.max === null) return true;
        return Array.isArray(this.value) && this.value.length < this.max;
    },

    canDeselect() {
        if (!this.multiple) return true;
        if (this.min === null) return true;
        return Array.isArray(this.value) && this.value.length > this.min;
    },

    isOptionDisabled(val, isDisabled) {
        if (isDisabled) return true;
        if (this.multiple && this.max !== null && !this.isSelected(val) && !this.canSelectMore()) {
            return true;
        }
        return false;
    },

    restoreFromFormStorage() {
        const isEmptyValue = this.value === '' || this.value === null || this.value === undefined || (Array.isArray(this.value) && this.value.length === 0);
        if (!isEmptyValue) return false;

        const form = this.$el ? this.$el.closest('form') : null;
        if (!form || !form._x_dataStack || !form._x_dataStack[0]?.getStorageData) {
            return false;
        }

        const formAlpine = form._x_dataStack[0];
        if (!formAlpine.saveToStorage || !form.id) return false;

        const storageArray = formAlpine.getStorageData();
        const myData = Array.isArray(storageArray) ? storageArray.find(item => item.id === form.id) : null;
        if (!myData || !myData.data) return false;

        const rawKey = this.name;
        const storedVal = myData.data[rawKey] !== undefined ? myData.data[rawKey] : myData.data[`${rawKey}[]`];
        if (storedVal !== undefined && storedVal !== null && storedVal !== '') {
            this.value = storedVal;
            return true;
        }

        return false;
    },

    calculatePlacement() {
        if (this.placement === 'top') {
            this.openUp = true;
            return;
        }
        if (this.placement === 'bottom') {
            this.openUp = false;
            return;
        }
        const trigger = this.$refs.triggerBtn || this.$el;
        const rect = trigger.getBoundingClientRect();
        const spaceBelow = window.innerHeight - rect.bottom;
        const spaceAbove = rect.top;
        const popoverHeight = 250;

        this.openUp = spaceBelow < popoverHeight && spaceAbove > spaceBelow;
    },

    getVisibleItems() {
        return Array.from(this.$refs.optionsContainer ? this.$refs.optionsContainer.querySelectorAll("[role='option']:not([disabled]):not(.cursor-not-allowed)") : [])
            .filter(el => el.offsetWidth > 0 || el.offsetHeight > 0);
    },

    focusNext(e) {
        if (!this.open) return;
        e?.preventDefault();
        const items = this.getVisibleItems();
        if (!items.length) return;
        const currentIndex = items.indexOf(document.activeElement);
        const nextIndex = Math.min(currentIndex + 1, items.length - 1);
        if (items[nextIndex]) {
            items[nextIndex].focus();
            items[nextIndex].scrollIntoView({ block: 'nearest' });
        }
    },

    focusPrevious(e) {
        if (!this.open) return;
        e?.preventDefault();
        const items = this.getVisibleItems();
        if (!items.length) return;
        let currentIndex = items.indexOf(document.activeElement);
        if (currentIndex <= 0) {
            if (this.$refs.searchInput) {
                this.$refs.searchInput.focus();
                return;
            }
            currentIndex = items.length;
        }
        const nextIndex = Math.max(currentIndex - 1, 0);
        if (items[nextIndex]) {
            items[nextIndex].focus();
            items[nextIndex].scrollIntoView({ block: 'nearest' });
        }
    }
};

export function vibeSelect(config = {}) {
    return {
        open: false,
        search: '',
        value: '',
        name: null,
        separator: null,
        badgeVariant: 'secondary',
        colorCycle: ['info', 'primary', 'success', 'warning', 'secondary', 'purple'],
        selectedLabel: '',
        selectedAvatar: '',
        selectedIcon: '',
        selectedDescription: '',
        selectedItems: [],
        hasVisibleOptions: true,
        disabled: false,
        keyboard: false,
        multiple: false,
        min: null,
        max: null,
        placement: 'auto',
        openUp: false,
        ...config,
        ...sharedSelectMethods,

        isOptionVisible(el) {
            if (!this.search) return true;
            const q = this.search.toLowerCase().trim();
            if (!q) return true;
            return (el.innerText || '').toLowerCase().includes(q) || (el.dataset.value || '').toLowerCase().includes(q);
        },

        getOptionClasses(el, isDisabled = false) {
            const val = el?.dataset?.value;
            const sel = this.isSelected(val);
            const dis = this.isOptionDisabled(val, isDisabled);
            return {
                'bg-muted text-foreground font-medium': !this.multiple && sel,
                'font-medium text-foreground': this.multiple && sel,
                'text-popover-foreground hover:bg-muted/60': !sel && !dis,
                'hover:bg-muted/60': this.multiple && sel && !dis,
                'opacity-40 cursor-not-allowed pointer-events-none': dis,
            };
        },

        getOptionLabel(el) {
            if (!el) return '';
            const lbl = el.getAttribute('data-label') || el.innerText.trim();
            return this.decodeHtml(lbl);
        },

        findOptionByValue(val) {
            if (!this.$refs.optionsContainer) return null;
            const target = String(val);
            const options = this.$refs.optionsContainer.querySelectorAll('[data-value]');
            for (let i = 0; i < options.length; i++) {
                if (options[i].getAttribute('data-value') === target) {
                    return options[i];
                }
            }
            return null;
        },

        init() {
            this.$nextTick(() => {
                let isEmptyValue = this.value === '' || this.value === null || this.value === undefined || (Array.isArray(this.value) && this.value.length === 0);
                if (isEmptyValue && this.restoreFromFormStorage()) {
                    isEmptyValue = false;
                }
                if (isEmptyValue && this.$refs.hiddenInput && this.$refs.hiddenInput.value) {
                    if (this.multiple) {
                        if (this.separator && typeof this.$refs.hiddenInput.value === 'string') {
                            const parsed = this.$refs.hiddenInput.value.split(this.separator).map(s => s.trim()).filter(Boolean);
                            if (parsed.length > 0) {
                                this.value = parsed;
                                isEmptyValue = false;
                            }
                        } else {
                            try {
                                const parsed = JSON.parse(this.$refs.hiddenInput.value);
                                if (Array.isArray(parsed) && parsed.length > 0) {
                                    this.value = parsed;
                                    isEmptyValue = false;
                                }
                            } catch (e) {}
                        }
                    } else {
                        this.value = this.$refs.hiddenInput.value;
                        isEmptyValue = false;
                    }
                }
                if (isEmptyValue && this.$refs.optionsContainer) {
                    const preselected = Array.from(this.$refs.optionsContainer.querySelectorAll("[data-selected='true']"));
                    if (preselected.length > 0) {
                        if (this.multiple) {
                            this.value = preselected.map(el => el.getAttribute('data-value'));
                        } else {
                            this.value = preselected[0].getAttribute('data-value');
                        }
                    }
                }
                this.updateSelectionFromValue();
            });
            this.$watch('value', () => {
                this.updateSelectionFromValue();
            });
            this.$watch('search', () => {
                this.$nextTick(() => this.checkVisibility());
            });
            this.$el.addEventListener('vibe-select-restore', (e) => {
                if (e.detail && e.detail.value !== undefined) {
                    this.value = e.detail.value;
                    this.updateSelectionFromValue();
                    if (this.$refs.hiddenInput) {
                        if (this.multiple) {
                            this.$refs.hiddenInput.value = this.separator ? (Array.isArray(this.value) ? this.value.join(this.separator) : this.value) : JSON.stringify(this.value);
                        } else {
                            this.$refs.hiddenInput.value = this.value;
                        }
                    }
                }
            });
        },

        selectOption(el) {
            if (!el) return;
            const val = el.getAttribute('data-value');
            const lbl = this.getOptionLabel(el);
            const av = el.getAttribute('data-avatar') || '';
            const ic = el.getAttribute('data-icon') || '';
            const desc = el.getAttribute('data-description') || '';
            this.select(val, lbl, av, ic, desc);
        },

        isSelected(val) {
            if (this.multiple) {
                return Array.isArray(this.value) && this.value.some(v => String(v) === String(val));
            }
            return String(this.value) === String(val);
        },

        removeTag(val) {
            if (this.disabled) return;
            if (this.min !== null && Array.isArray(this.value) && this.value.length <= this.min) {
                return;
            }
            const strVal = String(val);
            this.value = this.value.filter(v => String(v) !== strVal);
            this.updateSelectionFromValue();
            this.$nextTick(() => {
                this.dispatchChangeEvent();
            });
        },

        clearAll() {
            if (this.disabled) return;
            if (this.multiple) {
                if (this.min !== null && this.min > 0) {
                    if (Array.isArray(this.value) && this.value.length > this.min) {
                        this.value = this.value.slice(0, this.min);
                        this.updateSelectionFromValue();
                        this.$nextTick(() => {
                            this.dispatchChangeEvent();
                        });
                    }
                    return;
                }
                this.value = [];
                this.updateSelectionFromValue();
                this.$nextTick(() => {
                    this.dispatchChangeEvent();
                });
                return;
            }
            this.value = '';
            this.selectedLabel = '';
            this.selectedAvatar = '';
            this.selectedIcon = '';
            this.selectedDescription = '';
            this.updateSelectionFromValue();
            this.$nextTick(() => {
                this.dispatchChangeEvent();
            });
        },

        dispatchChangeEvent() {
            if (this.$refs.hiddenInput) {
                this.$refs.hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
                this.$refs.hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
            }
            this.$el.dispatchEvent(new CustomEvent('vibe-select-change', {
                bubbles: true,
                detail: { name: this.name, value: this.value }
            }));
            this.$el.dispatchEvent(new Event('input', { bubbles: true }));
            this.$el.dispatchEvent(new Event('change', { bubbles: true }));
        },

        handleHiddenInput(el) {
            if (!el) return;
            if (this.multiple) {
                if (this.separator && typeof el.value === 'string') {
                    const p = el.value ? el.value.split(this.separator).map(s => s.trim()).filter(Boolean) : [];
                    if (JSON.stringify(p) !== JSON.stringify(this.value)) {
                        this.value = p;
                        this.updateSelectionFromValue();
                    }
                } else {
                    try {
                        const p = JSON.parse(el.value);
                        if (Array.isArray(p) && JSON.stringify(p) !== JSON.stringify(this.value)) {
                            this.value = p;
                            this.updateSelectionFromValue();
                        }
                    } catch (e) {}
                }
            } else if (this.value !== el.value) {
                this.value = el.value;
                this.updateSelectionFromValue();
            }
        },

        updateSelectionFromValue() {
            if (this.multiple) {
                if (!Array.isArray(this.value)) {
                    if (this.separator && typeof this.value === 'string') {
                        this.value = this.value ? this.value.split(this.separator).map(s => s.trim()).filter(Boolean) : [];
                    } else {
                        this.value = this.value !== null && this.value !== undefined && this.value !== '' ? [this.value] : [];
                    }
                }
                const items = [];
                this.value.forEach(val => {
                    const el = this.findOptionByValue(val);
                    if (el) {
                        items.push({
                            value: val,
                            label: this.getOptionLabel(el),
                            avatar: el.getAttribute('data-avatar') || '',
                            icon: el.getAttribute('data-icon') || '',
                            description: el.getAttribute('data-description') || ''
                        });
                    } else {
                        items.push({
                            value: val,
                            label: this.decodeHtml(String(val)),
                            avatar: '',
                            icon: '',
                            description: ''
                        });
                    }
                });
                this.selectedItems = items;
                return;
            }

            if (this.value === '' || this.value === null || this.value === undefined) {
                this.selectedLabel = '';
                this.selectedAvatar = '';
                this.selectedIcon = '';
                this.selectedDescription = '';
                return;
            }
            const el = this.findOptionByValue(this.value);
            if (el) {
                this.selectedLabel = this.getOptionLabel(el);
                this.selectedAvatar = el.getAttribute('data-avatar') || '';
                this.selectedIcon = el.getAttribute('data-icon') || '';
                this.selectedDescription = el.getAttribute('data-description') || '';
            }
        },

        select(val, lbl, av, ic, desc) {
            if (this.disabled) return;
            if (this.isOptionDisabled(val, false)) return;

            if (this.multiple) {
                if (!Array.isArray(this.value)) {
                    this.value = [];
                }
                const strVal = String(val);
                const exists = this.value.some(v => String(v) === strVal);

                if (exists) {
                    if (this.min !== null && this.value.length <= this.min) {
                        return;
                    }
                    this.value = this.value.filter(v => String(v) !== strVal);
                } else {
                    if (this.max !== null && this.value.length >= this.max) {
                        return;
                    }
                    this.value = [...this.value, val];
                }
                this.updateSelectionFromValue();
                this.$nextTick(() => {
                    this.dispatchChangeEvent();
                });
                return;
            }

            this.value = val;
            this.selectedLabel = this.decodeHtml(lbl);
            this.selectedAvatar = av || '';
            this.selectedIcon = ic || '';
            this.selectedDescription = desc || '';
            this.open = false;
            this.search = '';

            this.$nextTick(() => {
                this.dispatchChangeEvent();
            });
        },

        checkVisibility() {
            if (!this.$refs.optionsContainer) return;
            const options = Array.from(this.$refs.optionsContainer.querySelectorAll('[data-select-option]'));
            if (options.length === 0) {
                this.hasVisibleOptions = false;
                return;
            }
            const q = (this.search || '').toLowerCase().trim();
            if (!q) {
                this.hasVisibleOptions = true;
                return;
            }
            const anyVisible = options.some(el => {
                if (el.style.display === 'none') return false;
                const val = (el.getAttribute('data-value') || '').toLowerCase();
                const lbl = (this.getOptionLabel(el) || '').toLowerCase();
                return val.includes(q) || lbl.includes(q);
            });
            this.hasVisibleOptions = anyVisible;
        },

        toggle() {
            if (this.disabled) return;
            this.open = !this.open;
            if (this.open) {
                this.search = '';
                this.hasVisibleOptions = true;
                this.calculatePlacement();
                this.$nextTick(() => {
                    this.calculatePlacement();
                    if (this.$refs.searchInput) {
                        this.$refs.searchInput.focus();
                    } else if (this.keyboard) {
                        this.focusNext();
                    }
                    this.checkVisibility();
                });
            }
        },

        close() {
            this.open = false;
            this.search = '';
        }
    };
}

export function vibeRemoteSelect(config = {}) {
    return {
        open: false,
        search: '',
        value: '',
        name: null,
        selectedLabel: '',
        selectedAvatar: '',
        selectedIcon: '',
        selectedItems: [],
        items: [],
        loading: false,
        hasLoadedOnce: false,
        hasNetworkError: false,
        disabled: false,
        keyboard: false,
        multiple: false,
        badgeVariant: 'secondary',
        colorCycle: ['info', 'primary', 'success', 'warning', 'secondary', 'purple'],
        min: null,
        max: null,
        api: '',
        searchParam: 'q',
        minChars: 0,
        debounce: 300,
        placement: 'auto',
        openUp: false,
        headers: {},
        abortController: null,
        ...config,
        ...sharedSelectMethods,

        init() {
            if (this.multiple) {
                const initialVals = Array.isArray(this.value) ? this.value : (this.value ? [this.value] : []);
                this.value = initialVals.map(String);

                if (this.selectedItems.length === 0 && this.value.length > 0) {
                    const labels = Array.isArray(this.selectedLabel) ? this.selectedLabel : (this.selectedLabel ? [this.selectedLabel] : []);
                    const avatars = Array.isArray(this.selectedAvatar) ? this.selectedAvatar : (this.selectedAvatar ? [this.selectedAvatar] : []);
                    const icons = Array.isArray(this.selectedIcon) ? this.selectedIcon : (this.selectedIcon ? [this.selectedIcon] : []);
                    this.selectedItems = this.value.map((v, i) => ({
                        value: v,
                        label: this.decodeHtml(labels[i] || v),
                        avatar: avatars[i] || '',
                        icon: icons[i] || '',
                        description: ''
                    }));
                }
            } else {
                this.value = this.value !== null && this.value !== undefined ? String(this.value) : '';
                if (this.selectedItems.length > 0) {
                    if (!this.selectedLabel && this.selectedItems[0].label) {
                        this.selectedLabel = this.decodeHtml(this.selectedItems[0].label);
                    }
                    if (!this.selectedAvatar && this.selectedItems[0].avatar) {
                        this.selectedAvatar = this.selectedItems[0].avatar;
                    }
                    if (!this.selectedIcon && this.selectedItems[0].icon) {
                        this.selectedIcon = this.selectedItems[0].icon;
                    }
                }
            }

            this.restoreFromFormStorage();

            this.$watch('value', (val) => {
                if (!this.multiple) {
                    if (!val || val === '') {
                        this.selectedLabel = '';
                        this.selectedAvatar = '';
                        this.selectedIcon = '';
                    } else if (this.items && this.items.length > 0) {
                        const found = this.items.find(i => String(i.value) === String(val));
                        if (found) {
                            this.selectedLabel = found.label;
                            this.selectedAvatar = found.avatar || '';
                            this.selectedIcon = !found.avatar && found.icon ? found.icon : '';
                        }
                    }
                }
                this.$nextTick(() => this.dispatchChangeEvent());
            });

            this.$el.addEventListener('vibe-select-restore', (e) => {
                if (e.detail && e.detail.value !== undefined) {
                    this.value = e.detail.value;
                    if (this.$refs.hiddenInput) {
                        if (this.multiple) {
                            this.$refs.hiddenInput.value = JSON.stringify(this.value);
                        } else {
                            this.$refs.hiddenInput.value = this.value;
                        }
                    }
                    this.dispatchChangeEvent();
                }
            });
        },

        toggle() {
            if (this.disabled) return;
            this.open = !this.open;
            if (this.open) {
                this.calculatePlacement();
                this.$nextTick(() => {
                    this.calculatePlacement();
                    if (this.$refs.searchInput) {
                        this.$refs.searchInput.focus();
                    } else if (this.keyboard) {
                        this.focusNext();
                    }
                    if (!this.hasLoadedOnce || (this.items.length === 0 && this.minChars === 0)) {
                        this.fetchData('');
                    }
                });
            } else {
                this.search = '';
            }
        },

        close() {
            this.open = false;
            this.search = '';
        },

        async fetchData(q = null) {
            const query = q !== null ? q : this.search;
            if (query.length < this.minChars) {
                this.items = [];
                this.loading = false;
                return;
            }

            if (this.abortController) {
                this.abortController.abort();
            }
            this.abortController = new AbortController();

            this.loading = true;
            this.hasNetworkError = false;

            try {
                const url = new URL(this.api, window.location.origin);
                url.searchParams.set(this.searchParam, query);

                const res = await fetch(url.toString(), {
                    signal: this.abortController.signal,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        ...(this.headers || {})
                    }
                });

                if (!res.ok) throw new Error('Network error');
                const json = await res.json();
                const rawItems = Array.isArray(json) ? json : (Array.isArray(json.data) ? json.data : []);

                this.items = rawItems.map(item => ({
                    value: String(item.value ?? item.id ?? ''),
                    label: this.decodeHtml(String(item.label ?? item.name ?? item.title ?? item.value ?? '')),
                    description: item.description ?? item.desc ?? null,
                    avatar: item.avatar ?? (item.icon && (String(item.icon).startsWith('http') || String(item.icon).startsWith('/') || String(item.icon).startsWith('data:')) ? item.icon : null),
                    icon: item.icon ?? item.avatar ?? null,
                    disabled: Boolean(item.disabled)
                }));

                this.hasLoadedOnce = true;

                if (this.multiple) {
                    if (Array.isArray(this.selectedItems) && this.selectedItems.length > 0) {
                        this.selectedItems.forEach(sel => {
                            const found = this.items.find(i => String(i.value) === String(sel.value));
                            if (found) {
                                if (!sel.label || sel.label === sel.value) sel.label = found.label;
                                if (!sel.avatar && found.avatar) sel.avatar = found.avatar;
                                if (!sel.icon && found.icon) sel.icon = found.icon;
                                if (!sel.description && found.description) sel.description = found.description;
                            }
                        });
                    }
                } else if (this.value && (!this.selectedLabel || !this.selectedAvatar)) {
                    const found = this.items.find(i => String(i.value) === String(this.value));
                    if (found) {
                        this.selectedLabel = found.label;
                        this.selectedAvatar = found.avatar || '';
                        this.selectedIcon = !found.avatar && found.icon ? found.icon : '';
                    }
                }
            } catch (e) {
                if (e.name !== 'AbortError') {
                    this.hasNetworkError = true;
                    this.items = [];
                }
            } finally {
                this.loading = false;
            }
        },

        isSelected(val) {
            const strVal = String(val);
            if (this.multiple) {
                return Array.isArray(this.value) && this.value.includes(strVal);
            }
            return String(this.value) === strVal;
        },

        selectItem(item) {
            if (!item || item.disabled) return;
            if (this.isOptionDisabled(item.value, false)) return;

            if (this.multiple) {
                const strVal = String(item.value);
                if (this.isSelected(strVal)) {
                    if (this.min !== null && this.value.length <= this.min) return;
                    this.value = this.value.filter(v => v !== strVal);
                    this.selectedItems = this.selectedItems.filter(i => String(i.value) !== strVal);
                } else {
                    if (this.max !== null && this.value.length >= this.max) return;
                    this.value.push(strVal);
                    this.selectedItems.push({
                        value: strVal,
                        label: this.decodeHtml(item.label),
                        avatar: item.avatar || '',
                        icon: item.icon || '',
                        description: item.description || ''
                    });
                }
                this.dispatchChangeEvent();
                return;
            }

            this.value = String(item.value);
            this.selectedLabel = this.decodeHtml(item.label);
            this.selectedAvatar = item.avatar || '';
            this.selectedIcon = !item.avatar && item.icon ? item.icon : '';
            this.close();
            this.dispatchChangeEvent();
        },

        removeTag(val) {
            if (this.disabled) return;
            const strVal = String(val);
            if (this.min !== null && this.value.length <= this.min) return;
            this.value = this.value.filter(v => v !== strVal);
            this.selectedItems = this.selectedItems.filter(i => String(i.value) !== strVal);
            this.dispatchChangeEvent();
        },

        clearAll() {
            if (this.disabled) return;
            if (this.multiple) {
                if (this.min !== null && this.min > 0) {
                    if (Array.isArray(this.value) && this.value.length > this.min) {
                        this.value = this.value.slice(0, this.min);
                        this.selectedItems = this.selectedItems.slice(0, this.min);
                        this.dispatchChangeEvent();
                    }
                    return;
                }
                this.value = [];
                this.selectedItems = [];
                this.dispatchChangeEvent();
                return;
            }
            this.value = '';
            this.selectedLabel = '';
            this.selectedAvatar = '';
            this.selectedIcon = '';
            this.dispatchChangeEvent();
        },

        dispatchChangeEvent() {
            this.$nextTick(() => {
                if (this.$refs.hiddenInput) {
                    this.$refs.hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
                    this.$refs.hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
                }
                this.$el.dispatchEvent(new CustomEvent('vibe-select-change', {
                    bubbles: true,
                    detail: { name: this.name, value: this.value }
                }));
                this.$el.dispatchEvent(new Event('input', { bubbles: true }));
                this.$el.dispatchEvent(new Event('change', { bubbles: true }));
            });
        }
    };
}

if (typeof window !== 'undefined') {
    window.vibeSelect = vibeSelect;
    window.vibeRemoteSelect = vibeRemoteSelect;

    document.addEventListener('alpine:init', () => {
        if (window.Alpine && typeof window.Alpine.data === 'function') {
            window.Alpine.data('vibeSelect', vibeSelect);
            window.Alpine.data('vibeRemoteSelect', vibeRemoteSelect);
        }
    });

    if (window.Alpine && typeof window.Alpine.data === 'function') {
        window.Alpine.data('vibeSelect', vibeSelect);
        window.Alpine.data('vibeRemoteSelect', vibeRemoteSelect);
    }

    window.dispatchEvent(new CustomEvent('vibe-select-ready'));
}
