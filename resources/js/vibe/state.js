import persist from '@alpinejs/persist';
import { VibeStorage } from './core';

const VIBE_PREFIX = window.VIBE_PREFIX || 'vibe';
const dispatchVibe = (event, detail) => window.dispatchEvent(new CustomEvent(event, { detail }));
const closeAllOverlay = (event) => window.dispatchEvent(new CustomEvent(event, { detail: '*' }));

const withAlpineStore = (name, method, ...args) => {
    const store = window.Alpine?.store?.(name);
    return store ? { handled: true, value: store[method](...args) } : { handled: false };
};

window.VibeModal = {
    getStorageKey() {
        return `${window.VIBE_PREFIX || 'vibe'}-modals`;
    },

    getStored(id) {
        return VibeStorage.findItem(this.getStorageKey(), id);
    },

    isOpen(id) {
        const res = withAlpineStore('vibeModals', 'isOpen', id);
        return res.handled ? res.value : Boolean(this.getStored(id)?.open);
    },

    isDismissed(id) {
        const res = withAlpineStore('vibeModals', 'isDismissed', id);
        return res.handled ? res.value : Boolean(this.getStored(id)?.dismissed);
    },

    setOpen(id, isOpen) {
        if (withAlpineStore('vibeModals', 'setOpen', id, isOpen).handled) return;
        const now = new Date().toISOString();
        VibeStorage.upsertItem(this.getStorageKey(), id, (current) => ({
            ...current,
            id,
            open: Boolean(isOpen),
            status: isOpen ? 'open' : (current.dismissed ? 'dismissed' : 'closed'),
            updatedAt: now,
        }));
    },

    dismiss(id) {
        if (withAlpineStore('vibeModals', 'dismiss', id).handled) return;
        const now = new Date().toISOString();
        VibeStorage.upsertItem(this.getStorageKey(), id, (current) => ({
            ...current,
            id,
            status: 'dismissed',
            open: false,
            dismissed: true,
            dismissedAt: now,
            updatedAt: now,
        }));
    },

    reset(id) {
        if (withAlpineStore('vibeModals', 'reset', id).handled) return;
        VibeStorage.removeItem(this.getStorageKey(), id);
    },
};

window.VibeTabs = {
    getStorageKey() {
        return `${window.VIBE_PREFIX || 'vibe'}-tabs`;
    },

    getStored(id) {
        return VibeStorage.findItem(this.getStorageKey(), id);
    },

    getActive(id, fallback = null) {
        const res = withAlpineStore('vibeTabs', 'getActive', id);
        if (res.handled) return res.value || fallback;
        return this.getStored(id)?.active || fallback;
    },

    setActive(id, active) {
        if (withAlpineStore('vibeTabs', 'setActive', id, active).handled) return;
        VibeStorage.upsertItem(this.getStorageKey(), id, () => ({
            id,
            active,
            updatedAt: new Date().toISOString(),
        }));
    },

    reset(id) {
        if (withAlpineStore('vibeTabs', 'reset', id).handled) return;
        VibeStorage.removeItem(this.getStorageKey(), id);
    },
};

window.VibeTodo = {
    getStorageKey() {
        return `${window.VIBE_PREFIX || 'vibe'}-todo`;
    },

    getAll() {
        const store = window.Alpine?.store?.('vibeTodos');
        if (store) {
            store.clean();
            return store.items;
        }
        return VibeStorage.readArray(this.getStorageKey());
    },

    get(id) {
        const res = withAlpineStore('vibeTodos', 'get', id);
        if (res.handled) return res.value;
        const entry = VibeStorage.pruneExpired(this.getAll(), 'expiredAt').find((i) => i.id === id);
        return entry ? entry.data : null;
    },

    save(id, data, expireHours = 24 * 30) {
        if (withAlpineStore('vibeTodos', 'save', id, data, expireHours).handled) return;
        const key = this.getStorageKey();
        const items = VibeStorage.pruneExpired(this.getAll(), 'expiredAt');
        const entry = { id, data, expiredAt: Date.now() + expireHours * 3600 * 1000 };
        const idx = items.findIndex((i) => i.id === id);
        if (idx >= 0) items[idx] = entry;
        else items.push(entry);
        VibeStorage.writeArray(key, items);
    },

    clear(id) {
        if (withAlpineStore('vibeTodos', 'clear', id).handled) return;
        const key = this.getStorageKey();
        VibeStorage.removeItem(key, id);
        if (id) {
            try {
                const prefix = window.VIBE_PREFIX || 'vibe';
                localStorage.removeItem(`${prefix}-todo-${id}`);
                localStorage.removeItem(id);
            } catch {}
        }
    },
};

// ==========================================
// VIBE UI CONTROLLER MANAGER ($vibe / window.$vibe)
// ==========================================
const makeOverlayController = (noun, extraInstance = {}, extraStatic = {}) =>
    Object.assign(
        (id) => ({
            show() { dispatchVibe(`open-${noun}`, id); },
            open() { dispatchVibe(`open-${noun}`, id); },
            close() { dispatchVibe(`close-${noun}`, id); },
            toggle() { dispatchVibe(`toggle-${noun}`, id); },
            ...Object.fromEntries(Object.entries(extraInstance).map(([k, fn]) => [k, () => fn(id)])),
        }),
        {
            show(id) { dispatchVibe(`open-${noun}`, id); },
            open(id) { dispatchVibe(`open-${noun}`, id); },
            close(id) { dispatchVibe(`close-${noun}`, id); },
            toggle(id) { dispatchVibe(`toggle-${noun}`, id); },
            ...extraStatic,
        }
    );

const vibeManager = {
    // MODAL (open-modal / close-modal / toggle-modal)
    modal: makeOverlayController(
        'modal',
        { isOpen: (id) => (window.VibeModal ? window.VibeModal.isOpen(id) : false) },
        { isOpen: (id) => (window.VibeModal ? window.VibeModal.isOpen(id) : false) }
    ),
    modals: {
        close() { closeAllOverlay('close-modal'); },
    },

    // SHEET (open-sheet / close-sheet / toggle-sheet)
    sheet: makeOverlayController('sheet'),
    sheets: {
        close() { closeAllOverlay('close-sheet'); },
    },

    // DROPDOWN (open-dropdown / close-dropdown / toggle-dropdown)
    dropdown: makeOverlayController('dropdown'),
    dropdowns: {
        close() { closeAllOverlay('close-dropdown'); },
    },

    // TOAST
    toast: Object.assign((payload, type = 'info', opts = {}) => {
        const data = typeof payload === 'string' ? { message: payload, type, ...opts } : { type, ...payload };
        dispatchVibe('toast', data);
        return {
            close() { if (data.id) dispatchVibe('close-toast', data.id); },
        };
    }, {
        success: (msg, title, opts) => vibeManager.toast(msg, 'success', { title, ...opts }),
        error: (msg, title, opts) => vibeManager.toast(msg, 'error', { title, ...opts }),
        warning: (msg, title, opts) => vibeManager.toast(msg, 'warning', { title, ...opts }),
        info: (msg, title, opts) => vibeManager.toast(msg, 'info', { title, ...opts }),
        close: (id) => dispatchVibe('close-toast', id),
    }),
    toasts: {
        close() { closeAllOverlay('close-toast'); },
    },

    // ALERT
    alert: Object.assign((payload, type = 'info', opts = {}) => {
        const data = typeof payload === 'string' ? { message: payload, type, ...opts } : { type, ...payload };
        dispatchVibe('alert', data);
        return {
            close() { if (data.id) dispatchVibe('close-alert', data.id); },
        };
    }, {
        success: (msg, title, opts) => vibeManager.alert({ message: msg, title, type: 'success', ...opts }),
        error: (msg, title, opts) => vibeManager.alert({ message: msg, title, type: 'error', ...opts }),
        warning: (msg, title, opts) => vibeManager.alert({ message: msg, title, type: 'warning', ...opts }),
        info: (msg, title, opts) => vibeManager.alert({ message: msg, title, type: 'info', ...opts }),
        confirm: (opts, onConfirm, title) => {
            if (typeof opts === 'string') {
                return vibeManager.alert({
                    type: 'confirm',
                    title: title || window.VibeCommonI18n?.confirm_title || 'Confirmation',
                    message: opts,
                    confirmButton: {
                        text: window.VibeCommonI18n?.confirm_btn || 'Confirm',
                        action: onConfirm,
                    },
                });
            }
            return vibeManager.alert({ type: 'confirm', ...opts });
        },
        close: (id) => dispatchVibe('close-alert', id),
    }),
    alerts: {
        close() { closeAllOverlay('close-alert'); },
    },

    // CONTEXT MENU
    context: Object.assign((id) => ({
        show(x, y, data = {}) { dispatchVibe('open-context', { menu: id, x, y, data }); },
        open(x, y, data = {}) { dispatchVibe('open-context', { menu: id, x, y, data }); },
        close() { dispatchVibe('close-context', id); },
    }), {
        show(id, x, y, data = {}) { dispatchVibe('open-context', { menu: id, x, y, data }); },
        open(id, x, y, data = {}) { dispatchVibe('open-context', { menu: id, x, y, data }); },
        close(id) { dispatchVibe('close-context', id); },
    }),
    contexts: {
        close() { closeAllOverlay('close-context'); },
    },

    // TODO
    todo: Object.assign((id) => ({
        clear() { window.VibeTodo?.clear(id); },
        get() { return window.VibeTodo ? window.VibeTodo.get(id) : null; },
    }), {
        clear(id) { window.VibeTodo?.clear(id); },
        get(id) { return window.VibeTodo ? window.VibeTodo.get(id) : null; },
    }),

    // CLIPBOARD
    copy: (text, opts = {}) => window.VibeCore?.copy(text, opts),
    clipboard: {
        copy: (text, opts = {}) => window.VibeCore?.copy(text, opts),
        trigger: (button, target = null) => window.VibeClipboard?.copyFromTrigger(button, target),
    },
};

window.$vibe = vibeManager;

const registerAlpineVibe = () => {
    if (window.Alpine && typeof window.Alpine.magic === 'function') {
        window.Alpine.magic('vibe', () => vibeManager);
    }
};

registerAlpineVibe();

const createExpiringStore = (storageSuffix, defaultExpireHours, extraMethods = {}) => ({
    items: window.Alpine.$persist([]).as(`${VIBE_PREFIX}-${storageSuffix}`),

    save(id, data, expireHours = defaultExpireHours) {
        const expired = new Date(Date.now() + expireHours * 3600 * 1000).toISOString();
        const entry = { id, data, expired };
        const index = this.items.findIndex((item) => item && item.id === id);
        if (index >= 0) this.items[index] = entry;
        else this.items.push(entry);
        this.clean();
    },

    get(id) {
        this.clean();
        const item = this.items.find((entry) => entry && entry.id === id);
        return item ? item.data : null;
    },

    clean() {
        this.items = VibeStorage.pruneExpired(this.items, 'expired');
    },

    ...extraMethods,
});

document.addEventListener('alpine:init', () => {
    registerAlpineVibe();
    try {
        window.Alpine.plugin(persist);
    } catch {
        // Ignore if already registered (e.g., Livewire 3)
    }

    window.Alpine.store('vibeForms', createExpiringStore('form', 24, {
        clear(id) {
            this.items = this.items.filter((f) => f && f.id !== id);
        },
    }));

    window.Alpine.store('vibeTables', createExpiringStore('tables', 24 * 30));

    window.Alpine.store('vibeGrids', createExpiringStore('grids', 24 * 90, {
        remove(id) {
            this.items = this.items.filter((g) => g && g.id !== id);
        },
    }));

    // ==========================================
    // STORE: vibeTodos (Todo & Kanban persistence)
    // ==========================================
    window.Alpine.store('vibeTodos', {
        items: window.Alpine.$persist([]).as(`${VIBE_PREFIX}-todo`),

        save(id, data, expireHours = 24 * 30) {
            const index = this.items.findIndex((t) => t && t.id === id);
            const entry = { id, data, expiredAt: Date.now() + expireHours * 3600 * 1000 };
            if (index >= 0) this.items[index] = entry;
            else this.items.push(entry);
            this.clean();
        },

        get(id) {
            this.clean();
            const item = this.items.find((t) => t && t.id === id);
            return item ? item.data : null;
        },

        clear(id) {
            this.items = id ? this.items.filter((t) => t && t.id !== id) : [];
        },

        clean() {
            this.items = VibeStorage.pruneExpired(this.items, 'expiredAt');
        },
    });

    // ==========================================
    // STORE: vibeModals (Modal Persistence & Dismissals)
    // ==========================================
    window.Alpine.store('vibeModals', {
        items: window.Alpine.$persist([]).as(`${VIBE_PREFIX}-modals`),

        get(id) {
            return this.items.find(item => item && item.id === id) || null;
        },

        isOpen(id) {
            const item = this.get(id);
            return !!(item && item.open);
        },

        isDismissed(id) {
            const item = this.get(id);
            return !!(item && item.dismissed);
        },

        setOpen(id, isOpen) {
            const now = new Date().toISOString();
            let index = this.items.findIndex(item => item && item.id === id);
            const current = index >= 0 ? this.items[index] : {};
            const entry = {
                ...current,
                id,
                open: !!isOpen,
                status: isOpen ? 'open' : (current.dismissed ? 'dismissed' : 'closed'),
                updatedAt: now
            };
            if (index >= 0) {
                this.items[index] = entry;
            } else {
                this.items.push(entry);
            }
        },

        dismiss(id) {
            const now = new Date().toISOString();
            let index = this.items.findIndex(item => item && item.id === id);
            const entry = {
                id,
                status: 'dismissed',
                open: false,
                dismissed: true,
                dismissedAt: now,
                updatedAt: now
            };
            if (index >= 0) {
                this.items[index] = { ...this.items[index], ...entry };
            } else {
                this.items.push(entry);
            }
        },

        save(id, data = {}) {
            const now = new Date().toISOString();
            let index = this.items.findIndex(item => item && item.id === id);
            let entry = { id, ...data, updatedAt: now };
            if (index >= 0) {
                this.items[index] = { ...this.items[index], ...entry };
            } else {
                this.items.push(entry);
            }
        },

        reset(id) {
            this.items = this.items.filter(item => item && item.id !== id);
        },

        clear() {
            this.items = [];
        },

        getAll() {
            return this.items;
        }
    });

    // ==========================================
    // STORE: vibeTabs (Tab Navigation Persistence)
    // ==========================================
    window.Alpine.store('vibeTabs', {
        items: window.Alpine.$persist([]).as(`${VIBE_PREFIX}-tabs`),

        get(id) {
            return this.items.find(item => item && item.id === id) || null;
        },

        getActive(id) {
            const item = this.get(id);
            return item ? item.active : null;
        },

        setActive(id, active) {
            const now = new Date().toISOString();
            let index = this.items.findIndex(item => item && item.id === id);
            const entry = { id, active, updatedAt: now };
            if (index >= 0) {
                this.items[index] = entry;
            } else {
                this.items.push(entry);
            }
        },

        reset(id) {
            this.items = this.items.filter(item => item && item.id !== id);
        },

        clear() {
            this.items = [];
        },

        getAll() {
            return this.items;
        }
    });

    // ==========================================
    // STORE: vibeHistory (Page Access History)
    // ==========================================
    window.Alpine.store('vibeHistory', {
        items: window.Alpine.$persist([]).as(`${VIBE_PREFIX}-page-history`),

        getConfig() {
            return window.VIBE_HISTORY_CONFIG || {};
        },

        isEnabled() {
            return this.getConfig().enabled !== false;
        },

        getMethod() {
            return this.getConfig().method || 'update_timestamp';
        },

        getDisplayLimit() {
            return this.getConfig().display_limit ?? 10;
        },

        isIgnored(url) {
            const ignorePaths = this.getConfig().ignore_paths || ['/login', '/logout', '/register', '/password/*'];
            return ignorePaths.some(pattern => {
                if (pattern.endsWith('/*')) {
                    const base = pattern.slice(0, -2);
                    return url === base || url.startsWith(base + '/');
                }
                return url === pattern || url.startsWith(pattern + '?') || url.startsWith(pattern + '/');
            });
        },

        // METODE 1: Data Baru (Menambahkan halaman baru ke riwayat)
        addNew(title, url, icon = null) {
            this.items.unshift({
                title: title || document.title || url,
                url: url,
                icon: icon,
                visitedAt: new Date().toISOString()
            });
        },

        // METODE 2: Merubah Timestamp (Halaman sudah ada di riwayat)
        updateTimestamp(index, newTitle = null) {
            let item = this.items[index];
            if (!item) return;

            item.visitedAt = new Date().toISOString();
            if (newTitle) item.title = newTitle;

            if (this.getMethod() === 'keep_position') {
                // Pertahankan posisi awal dalam array
                this.items[index] = item;
            } else {
                // Default 'update_timestamp': Pindahkan ke urutan teratas (index 0)
                this.items.splice(index, 1);
                this.items.unshift(item);
            }
        },

        // Dispatcher / Tracking Handler
        track(title = null, url = null, icon = null) {
            if (!this.isEnabled()) return;

            const targetUrl = url || (window.location.pathname + window.location.search);
            if (!targetUrl || this.isIgnored(targetUrl)) return;

            const pageTitle = title || document.title || targetUrl;
            const method = this.getMethod();

            if (method === 'record_all') {
                // Selalu panggil Metode 1 (Data Baru)
                this.addNew(pageTitle, targetUrl, icon);
                return;
            }

            const existingIndex = this.items.findIndex(item => item.url === targetUrl);

            if (existingIndex >= 0) {
                // Panggil METODE 2: Merubah Timestamp
                this.updateTimestamp(existingIndex, pageTitle);
            } else {
                // Panggil METODE 1: Data Baru
                this.addNew(pageTitle, targetUrl, icon);
            }
        },

        // Mengambil riwayat dengan batasan limit untuk UI (default: display_limit dari config)
        getRecent(limit = null) {
            const count = limit !== null ? limit : this.getDisplayLimit();
            return count > 0 ? this.items.slice(0, count) : this.items;
        },

        // Mengambil seluruh data riwayat tanpa batasan
        getAll() {
            return this.items;
        },

        // Menghapus halaman tertentu dari riwayat
        remove(url) {
            this.items = this.items.filter(item => item.url !== url);
        },

        // Menghapus seluruh riwayat
        clear() {
            this.items = [];
        }
    });
});

// Listener Global (Mendukung Direct Load & Livewire SPA wire:navigate)
const recordPageHistory = () => {
    if (window.Alpine && window.Alpine.store('vibeHistory')) {
        const historyStore = window.Alpine.store('vibeHistory');
        if (historyStore.getConfig().auto_track !== false) {
            historyStore.track(document.title, window.location.pathname + window.location.search);
        }
    }
};

document.addEventListener('DOMContentLoaded', recordPageHistory);
document.addEventListener('livewire:navigated', recordPageHistory);

// ==========================================
// SCROLL RESTORATION & PERSISTENCE
// ==========================================
const initScrollRestoration = () => {
    const getPrefix = () => window.VIBE_PREFIX || 'vibe';

    if (typeof history !== 'undefined' && 'scrollRestoration' in history) {
        try {
            history.scrollRestoration = 'manual';
        } catch (e) {}
    }

    // Auto-clean any zero or invalid legacy scroll keys from sessionStorage
    try {
        const prefix = getPrefix();
        Object.keys(sessionStorage).forEach(key => {
            if (key.startsWith(`${prefix}-scroll-`)) {
                const val = parseFloat(sessionStorage.getItem(key));
                if (isNaN(val) || val <= 0) {
                    sessionStorage.removeItem(key);
                }
            }
        });
    } catch (e) {}

    // Check if the current page load is a browser refresh / reload (F5, Ctrl+R, reload button)
    const isPageReload = () => {
        try {
            const navEntries = performance.getEntriesByType('navigation');
            if (navEntries && navEntries.length > 0) {
                return navEntries[0].type === 'reload';
            }
            if (window.performance && window.performance.navigation) {
                return window.performance.navigation.type === 1; // TYPE_RELOAD
            }
        } catch (e) {}
        return false;
    };

    const getStorageKey = (target) => {
        const prefix = getPrefix();
        if (target === document || target === window) {
            return `${prefix}-scroll-window-${window.location.pathname}`;
        }
        if (target && target.nodeType === 1) {
            const id = target.id;
            const vibeScroll = target.dataset ? target.dataset.vibeScroll : target.getAttribute('data-vibe-scroll');

            // Explicit main scroll container (page specific)
            if (id === 'docs-main-scroll' || id === 'main-scroll') {
                return `${prefix}-scroll-${id}-${window.location.pathname}`;
            }
            // Global containers like sidebar menu
            if (id === 'sidebar-menu-body' || vibeScroll) {
                return `${prefix}-scroll-${vibeScroll || id}`;
            }
        }
        return null;
    };

    const getSavedVal = (key, fallbackKey) => {
        try {
            let val = sessionStorage.getItem(key);
            if ((val === null || isNaN(parseFloat(val))) && fallbackKey) {
                val = sessionStorage.getItem(fallbackKey);
            }
            if (val !== null && !isNaN(parseFloat(val)) && parseFloat(val) > 0) {
                return parseFloat(val);
            }
        } catch (e) {}
        return null;
    };

    let isRestoring = false;
    let isInitialBoot = true;
    const isReload = isPageReload();

    // Scroll targets
    const getMainScrollContainer = () => {
        return document.getElementById('docs-main-scroll') || document.getElementById('main-scroll');
    };

    const resetPageScrollToTop = () => {
        const main = getMainScrollContainer();
        if (main) {
            main.scrollTop = 0;
        }
        window.scrollTo(0, 0);
    };

    const restoreSidebarScroll = () => {
        const prefix = getPrefix();
        const side = document.getElementById('sidebar-menu-body');
        if (side) {
            const sideKey = `${prefix}-scroll-sidebar-menu-body`;
            const saved = getSavedVal(sideKey);
            if (saved !== null && saved > 0) {
                side.scrollTop = Math.round(saved);
            }
        }
    };

    const restoreReloadScroll = () => {
        const prefix = getPrefix();
        isRestoring = true;

        // 1. Restore window scroll
        const windowKey = `${prefix}-scroll-window-${window.location.pathname}`;
        const legacyWindowKey = `${prefix}-scroll-${window.location.pathname}`;
        const savedWin = getSavedVal(windowKey, legacyWindowKey);
        if (savedWin !== null && savedWin > 0) {
            window.scrollTo(0, Math.round(savedWin));
        }

        // 2. Restore dedicated containers
        const containers = document.querySelectorAll('#docs-main-scroll, #main-scroll, #sidebar-menu-body, [data-vibe-scroll]');
        containers.forEach(el => {
            const key = getStorageKey(el);
            if (!key) return;
            const fallbackKey = (el.id === 'docs-main-scroll' || el.id === 'main-scroll')
                ? `${prefix}-scroll-${window.location.pathname}`
                : null;
            const saved = getSavedVal(key, fallbackKey);
            if (saved !== null && saved > 0) {
                el.scrollTop = Math.round(saved);
            }
        });
    };

    const scheduleReloadRestoration = () => {
        if (!isReload) return;
        isRestoring = true;

        const run = () => restoreReloadScroll();

        run();
        requestAnimationFrame(run);

        const delays = [30, 80, 150, 300, 500];
        delays.forEach(ms => setTimeout(run, ms));

        setTimeout(() => {
            isRestoring = false;
        }, 650);
    };

    const handleHashOrTopScroll = () => {
        const hash = window.location.hash;
        if (hash) {
            try {
                const target = document.querySelector(hash) || document.getElementById(hash.slice(1));
                if (target) {
                    const scrollContainer = getMainScrollContainer() || window;
                    if (scrollContainer === window) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    } else {
                        const cRect = scrollContainer.getBoundingClientRect();
                        const tRect = target.getBoundingClientRect();
                        scrollContainer.scrollTo({
                            top: scrollContainer.scrollTop + (tRect.top - cRect.top) - 80,
                            behavior: 'smooth'
                        });
                    }
                    return;
                }
            } catch (e) {}
        }
        resetPageScrollToTop();
    };

    // Auto-save scroll position using capture phase
    let scrollDebounce;
    window.addEventListener('scroll', (e) => {
        if (isRestoring) return; // Prevent overwriting stored scroll during restore
        clearTimeout(scrollDebounce);
        scrollDebounce = setTimeout(() => {
            if (isRestoring) return;
            const target = e.target;
            const key = getStorageKey(target);
            if (!key) return;

            const scrollVal = (target === document || target === window)
                ? (window.scrollY || window.pageYOffset || 0)
                : (target.scrollTop || 0);

            if (scrollVal > 0) {
                sessionStorage.setItem(key, Math.round(scrollVal));
            } else {
                sessionStorage.removeItem(key);
            }
        }, 50);
    }, { capture: true, passive: true });

    // Sync save on beforeunload / pagehide (ensures latest scroll position is saved on refresh)
    const saveAllScrollsNow = () => {
        if (isRestoring) return;
        const prefix = getPrefix();
        const windowKey = `${prefix}-scroll-window-${window.location.pathname}`;
        const winScroll = window.scrollY || window.pageYOffset || 0;
        if (winScroll > 0) {
            sessionStorage.setItem(windowKey, Math.round(winScroll));
        } else {
            sessionStorage.removeItem(windowKey);
        }

        const containers = document.querySelectorAll('#docs-main-scroll, #main-scroll, #sidebar-menu-body, [data-vibe-scroll]');
        containers.forEach(el => {
            const key = getStorageKey(el);
            if (key) {
                if (el.scrollTop > 0) {
                    sessionStorage.setItem(key, Math.round(el.scrollTop));
                } else {
                    sessionStorage.removeItem(key);
                }
            }
        });
    };

    window.addEventListener('beforeunload', saveAllScrollsNow);
    window.addEventListener('pagehide', saveAllScrollsNow);

    // Track SPA navigation
    document.addEventListener('livewire:navigating', () => {
        saveAllScrollsNow();
        isRestoring = true;

        // Reset page scroll to top immediately before morphing
        resetPageScrollToTop();
    });

    // When navigating to a new page or initial load finishes
    document.addEventListener('livewire:navigated', () => {
        if (isInitialBoot) {
            if (isReload) {
                scheduleReloadRestoration();
            } else {
                resetPageScrollToTop();
                restoreSidebarScroll();
                if (window.location.hash) {
                    handleHashOrTopScroll();
                }
            }
            setTimeout(() => {
                isInitialBoot = false;
            }, 250);
            return;
        }

        // Subsequent livewire:navigated -> this is definitely "berpindah halaman"!
        isRestoring = true;

        // 1. Clear saved page scroll for the newly visited page so it always starts at top
        const prefix = getPrefix();
        const path = window.location.pathname;
        sessionStorage.removeItem(`${prefix}-scroll-docs-main-scroll-${path}`);
        sessionStorage.removeItem(`${prefix}-scroll-main-scroll-${path}`);
        sessionStorage.removeItem(`${prefix}-scroll-window-${path}`);
        sessionStorage.removeItem(`${prefix}-scroll-${path}`);

        // 2. Keep sidebar menu scroll position intact
        restoreSidebarScroll();

        // 3. Reset page scroll position to the very top or scroll to hash
        if (window.location.hash) {
            handleHashOrTopScroll();
        } else {
            resetPageScrollToTop();
            requestAnimationFrame(resetPageScrollToTop);
            setTimeout(resetPageScrollToTop, 30);
            setTimeout(resetPageScrollToTop, 80);
        }

        setTimeout(() => {
            isRestoring = false;
        }, 180);
    });

    // Lock and preserve scroll position across Livewire component updates (pagination, sorting, filters)
    let lockedMainScroll = null;
    let lockedWindowScroll = null;

    const setupLivewireScrollLock = () => {
        if (!window.Livewire || window.Livewire.__scrollLockInitialized) return;
        window.Livewire.__scrollLockInitialized = true;

        window.Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
            const main = getMainScrollContainer();
            lockedMainScroll = main ? main.scrollTop : null;
            lockedWindowScroll = window.scrollY || window.pageYOffset || 0;
            isRestoring = true;

            succeed(() => {
                const restoreNow = () => {
                    if (main && lockedMainScroll !== null) {
                        main.scrollTop = lockedMainScroll;
                    }
                    if (lockedWindowScroll > 0) {
                        window.scrollTo(0, lockedWindowScroll);
                    }
                };

                restoreNow();
                queueMicrotask(restoreNow);
                requestAnimationFrame(() => {
                    restoreNow();
                    setTimeout(() => {
                        restoreNow();
                        isRestoring = false;

                        // Persist stable scroll
                        if (main && lockedMainScroll !== null && lockedMainScroll > 0) {
                            const key = getStorageKey(main);
                            if (key) sessionStorage.setItem(key, Math.round(lockedMainScroll));
                        }
                    }, 40);
                });
            });

            fail(() => {
                isRestoring = false;
            });
        });
    };

    if (window.Livewire) {
        setupLivewireScrollLock();
    } else {
        document.addEventListener('livewire:init', setupLivewireScrollLock);
    }

    // Initial load handling
    if (isReload) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', scheduleReloadRestoration);
        } else {
            scheduleReloadRestoration();
        }
        document.addEventListener('alpine:initialized', () => {
            setTimeout(scheduleReloadRestoration, 10);
        });
        window.addEventListener('load', () => {
            setTimeout(restoreReloadScroll, 10);
        });
    } else {
        // Fresh initial visit: ensure top position
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                resetPageScrollToTop();
                restoreSidebarScroll();
            });
        } else {
            resetPageScrollToTop();
            restoreSidebarScroll();
        }
    }
};

initScrollRestoration();



