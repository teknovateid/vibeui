import persist from '@alpinejs/persist'

const VIBE_PREFIX = window.VIBE_PREFIX || 'vibe';

window.VibeModal = {
    getStorageKey() {
        const prefix = window.VIBE_PREFIX || 'vibe';
        return `${prefix}-modals`;
    },

    getStored(id) {
        try {
            const raw = localStorage.getItem(this.getStorageKey());
            if (raw) {
                const data = JSON.parse(raw);
                if (Array.isArray(data)) {
                    return data.find(i => i && i.id === id) || null;
                }
            }
        } catch (e) {}
        return null;
    },

    isOpen(id) {
        if (window.Alpine && window.Alpine.store && window.Alpine.store('vibeModals')) {
            return window.Alpine.store('vibeModals').isOpen(id);
        }
        const item = this.getStored(id);
        return !!(item && item.open);
    },

    isDismissed(id) {
        if (window.Alpine && window.Alpine.store && window.Alpine.store('vibeModals')) {
            return window.Alpine.store('vibeModals').isDismissed(id);
        }
        const item = this.getStored(id);
        return !!(item && item.dismissed);
    },

    setOpen(id, isOpen) {
        if (window.Alpine && window.Alpine.store && window.Alpine.store('vibeModals')) {
            window.Alpine.store('vibeModals').setOpen(id, isOpen);
            return;
        }
        try {
            const key = this.getStorageKey();
            const raw = localStorage.getItem(key);
            let items = [];
            if (raw) {
                const parsed = JSON.parse(raw);
                if (Array.isArray(parsed)) items = parsed;
            }
            const now = new Date().toISOString();
            const index = items.findIndex(i => i && i.id === id);
            const current = index >= 0 ? items[index] : {};
            const entry = {
                ...current,
                id,
                open: !!isOpen,
                status: isOpen ? 'open' : (current.dismissed ? 'dismissed' : 'closed'),
                updatedAt: now
            };
            if (index >= 0) {
                items[index] = entry;
            } else {
                items.push(entry);
            }
            localStorage.setItem(key, JSON.stringify(items));
        } catch (e) {}
    },

    dismiss(id) {
        if (window.Alpine && window.Alpine.store && window.Alpine.store('vibeModals')) {
            window.Alpine.store('vibeModals').dismiss(id);
            return;
        }
        try {
            const key = this.getStorageKey();
            const raw = localStorage.getItem(key);
            let items = [];
            if (raw) {
                const parsed = JSON.parse(raw);
                if (Array.isArray(parsed)) items = parsed;
            }
            const now = new Date().toISOString();
            const index = items.findIndex(i => i && i.id === id);
            const entry = {
                id,
                status: 'dismissed',
                open: false,
                dismissed: true,
                dismissedAt: now,
                updatedAt: now
            };
            if (index >= 0) {
                items[index] = { ...items[index], ...entry };
            } else {
                items.push(entry);
            }
            localStorage.setItem(key, JSON.stringify(items));
        } catch (e) {}
    },

    reset(id) {
        if (window.Alpine && window.Alpine.store && window.Alpine.store('vibeModals')) {
            window.Alpine.store('vibeModals').reset(id);
            return;
        }
        try {
            const key = this.getStorageKey();
            const raw = localStorage.getItem(key);
            if (raw) {
                let items = JSON.parse(raw);
                if (Array.isArray(items)) {
                    items = items.filter(i => i && i.id !== id);
                    localStorage.setItem(key, JSON.stringify(items));
                }
            }
        } catch (e) {}
    }
};

window.VibeTabs = {
    getStorageKey() {
        const prefix = window.VIBE_PREFIX || 'vibe';
        return `${prefix}-tabs`;
    },

    getStored(id) {
        try {
            const raw = localStorage.getItem(this.getStorageKey());
            if (raw) {
                const data = JSON.parse(raw);
                if (Array.isArray(data)) {
                    return data.find(i => i && i.id === id) || null;
                }
            }
        } catch (e) {}
        return null;
    },

    getActive(id, fallback = null) {
        if (window.Alpine && window.Alpine.store && window.Alpine.store('vibeTabs')) {
            return window.Alpine.store('vibeTabs').getActive(id) || fallback;
        }
        const item = this.getStored(id);
        return (item && item.active) ? item.active : fallback;
    },

    setActive(id, active) {
        if (window.Alpine && window.Alpine.store && window.Alpine.store('vibeTabs')) {
            window.Alpine.store('vibeTabs').setActive(id, active);
            return;
        }
        try {
            const key = this.getStorageKey();
            const raw = localStorage.getItem(key);
            let items = [];
            if (raw) {
                const parsed = JSON.parse(raw);
                if (Array.isArray(parsed)) items = parsed;
            }
            const now = new Date().toISOString();
            const index = items.findIndex(i => i && i.id === id);
            const entry = { id, active, updatedAt: now };
            if (index >= 0) {
                items[index] = entry;
            } else {
                items.push(entry);
            }
            localStorage.setItem(key, JSON.stringify(items));
        } catch (e) {}
    },

    reset(id) {
        if (window.Alpine && window.Alpine.store && window.Alpine.store('vibeTabs')) {
            window.Alpine.store('vibeTabs').reset(id);
            return;
        }
        try {
            const key = this.getStorageKey();
            const raw = localStorage.getItem(key);
            if (raw) {
                let items = JSON.parse(raw);
                if (Array.isArray(items)) {
                    items = items.filter(i => i && i.id !== id);
                    localStorage.setItem(key, JSON.stringify(items));
                }
            }
        } catch (e) {}
    }
};

// ==========================================
// VIBE UI CONTROLLER MANAGER ($vibe / window.$vibe)
// ==========================================
const vibeManager = {
    // MODAL
    modal: Object.assign((id) => ({
        show() { window.dispatchEvent(new CustomEvent('open-modal', { detail: id })); },
        open() { window.dispatchEvent(new CustomEvent('open-modal', { detail: id })); },
        close() { window.dispatchEvent(new CustomEvent('close-modal', { detail: id })); },
        toggle() { window.dispatchEvent(new CustomEvent('toggle-modal', { detail: id })); },
        isOpen() { return window.VibeModal ? window.VibeModal.isOpen(id) : false; }
    }), {
        show(id) { window.dispatchEvent(new CustomEvent('open-modal', { detail: id })); },
        open(id) { window.dispatchEvent(new CustomEvent('open-modal', { detail: id })); },
        close(id) { window.dispatchEvent(new CustomEvent('close-modal', { detail: id })); },
        toggle(id) { window.dispatchEvent(new CustomEvent('toggle-modal', { detail: id })); },
        isOpen(id) { return window.VibeModal ? window.VibeModal.isOpen(id) : false; }
    }),
    modals: {
        close() { window.dispatchEvent(new CustomEvent('close-modal', { detail: '*' })); }
    },

    // SHEET
    sheet: Object.assign((id) => ({
        show() { window.dispatchEvent(new CustomEvent('open-sheet', { detail: id })); },
        open() { window.dispatchEvent(new CustomEvent('open-sheet', { detail: id })); },
        close() { window.dispatchEvent(new CustomEvent('close-sheet', { detail: id })); },
        toggle() { window.dispatchEvent(new CustomEvent('toggle-sheet', { detail: id })); }
    }), {
        show(id) { window.dispatchEvent(new CustomEvent('open-sheet', { detail: id })); },
        open(id) { window.dispatchEvent(new CustomEvent('open-sheet', { detail: id })); },
        close(id) { window.dispatchEvent(new CustomEvent('close-sheet', { detail: id })); },
        toggle(id) { window.dispatchEvent(new CustomEvent('toggle-sheet', { detail: id })); }
    }),
    sheets: {
        close() { window.dispatchEvent(new CustomEvent('close-sheet', { detail: '*' })); }
    },

    // DROPDOWN
    dropdown: Object.assign((id) => ({
        show() { window.dispatchEvent(new CustomEvent('open-dropdown', { detail: id })); },
        open() { window.dispatchEvent(new CustomEvent('open-dropdown', { detail: id })); },
        close() { window.dispatchEvent(new CustomEvent('close-dropdown', { detail: id })); },
        toggle() { window.dispatchEvent(new CustomEvent('toggle-dropdown', { detail: id })); }
    }), {
        show(id) { window.dispatchEvent(new CustomEvent('open-dropdown', { detail: id })); },
        open(id) { window.dispatchEvent(new CustomEvent('open-dropdown', { detail: id })); },
        close(id) { window.dispatchEvent(new CustomEvent('close-dropdown', { detail: id })); },
        toggle(id) { window.dispatchEvent(new CustomEvent('toggle-dropdown', { detail: id })); }
    }),
    dropdowns: {
        close() { window.dispatchEvent(new CustomEvent('close-dropdown', { detail: '*' })); }
    },

    // TOAST
    toast: Object.assign((payload, type = 'info', opts = {}) => {
        let data = typeof payload === 'string' ? { message: payload, type, ...opts } : { type, ...payload };
        window.dispatchEvent(new CustomEvent('toast', { detail: data }));
        return {
            close() { if (data.id) window.dispatchEvent(new CustomEvent('close-toast', { detail: data.id })); }
        };
    }, {
        success: (msg, title, opts) => vibeManager.toast(msg, 'success', { title, ...opts }),
        error: (msg, title, opts) => vibeManager.toast(msg, 'error', { title, ...opts }),
        warning: (msg, title, opts) => vibeManager.toast(msg, 'warning', { title, ...opts }),
        info: (msg, title, opts) => vibeManager.toast(msg, 'info', { title, ...opts }),
        close: (id) => window.dispatchEvent(new CustomEvent('close-toast', { detail: id }))
    }),
    toasts: {
        close() { window.dispatchEvent(new CustomEvent('close-toast', { detail: '*' })); }
    },

    // ALERT
    alert: Object.assign((payload, type = 'info', opts = {}) => {
        let data = typeof payload === 'string' ? { message: payload, type, ...opts } : { type, ...payload };
        window.dispatchEvent(new CustomEvent('alert', { detail: data }));
        return {
            close() { if (data.id) window.dispatchEvent(new CustomEvent('close-alert', { detail: data.id })); }
        };
    }, {
        success: (msg, title, opts) => vibeManager.alert({ message: msg, title, type: 'success', ...opts }),
        error: (msg, title, opts) => vibeManager.alert({ message: msg, title, type: 'error', ...opts }),
        warning: (msg, title, opts) => vibeManager.alert({ message: msg, title, type: 'warning', ...opts }),
        info: (msg, title, opts) => vibeManager.alert({ message: msg, title, type: 'info', ...opts }),
        confirm: (opts) => vibeManager.alert(typeof opts === 'string' ? { message: opts, type: 'confirm' } : { type: 'confirm', ...opts }),
        close: (id) => window.dispatchEvent(new CustomEvent('close-alert', { detail: id }))
    }),
    alerts: {
        close() { window.dispatchEvent(new CustomEvent('close-alert', { detail: '*' })); }
    },

    // CONTEXT MENU
    context: Object.assign((id) => ({
        show(x, y, data = {}) {
            window.dispatchEvent(new CustomEvent('open-context', { detail: { menu: id, x, y, data } }));
        },
        open(x, y, data = {}) {
            window.dispatchEvent(new CustomEvent('open-context', { detail: { menu: id, x, y, data } }));
        },
        close() {
            window.dispatchEvent(new CustomEvent('close-context', { detail: id }));
        },
    }), {
        show(id, x, y, data = {}) {
            window.dispatchEvent(new CustomEvent('open-context', { detail: { menu: id, x, y, data } }));
        },
        open(id, x, y, data = {}) {
            window.dispatchEvent(new CustomEvent('open-context', { detail: { menu: id, x, y, data } }));
        },
        close(id) {
            window.dispatchEvent(new CustomEvent('close-context', { detail: id }));
        },
    }),
    contexts: {
        close() { window.dispatchEvent(new CustomEvent('close-context', { detail: '*' })); }
    }
};

window.$vibe = vibeManager;

const registerAlpineVibe = () => {
    if (window.Alpine && typeof window.Alpine.magic === 'function') {
        window.Alpine.magic('vibe', () => vibeManager);
    }
};

registerAlpineVibe();

document.addEventListener('alpine:init', () => {
    registerAlpineVibe();
    try {
        window.Alpine.plugin(persist);
    } catch (e) {
        // Abaikan jika plugin sudah diregister (misalnya oleh Livewire 3)
    }

    // ==========================================
    // STORE: vibeForms (Auto-save form drafts)
    // ==========================================
    window.Alpine.store('vibeForms', {
        items: window.Alpine.$persist([]).as(`${VIBE_PREFIX}-form`),
        
        save(id, data, expireHours = 24) {
            let index = this.items.findIndex(f => f.id === id);
            let expired = new Date(Date.now() + expireHours * 60 * 60 * 1000).toISOString();
            let entry = { id, data, expired };
            
            if (index >= 0) {
                this.items[index] = entry;
            } else {
                this.items.push(entry);
            }
            this.clean();
        },
        
        get(id) {
            this.clean();
            let item = this.items.find(f => f.id === id);
            return item ? item.data : null;
        },

        clean() {
            const now = new Date();
            this.items = this.items.filter(f => new Date(f.expired) > now);
        },

        clear(id) {
            this.items = this.items.filter(f => f.id !== id);
        }
    });

    // ==========================================
    // STORE: vibeTables (Table preferences)
    // ==========================================
    window.Alpine.store('vibeTables', {
        items: window.Alpine.$persist([]).as(`${VIBE_PREFIX}-tables`),
        
        save(id, data, expireHours = 24 * 30) { // Default 30 days for tables
            let index = this.items.findIndex(f => f.id === id);
            let expired = new Date(Date.now() + expireHours * 60 * 60 * 1000).toISOString();
            let entry = { id, data, expired };
            
            if (index >= 0) {
                this.items[index] = entry;
            } else {
                this.items.push(entry);
            }
            this.clean();
        },
        
        get(id) {
            this.clean();
            let item = this.items.find(f => f.id === id);
            return item ? item.data : null;
        },

        clean() {
            const now = new Date();
            this.items = this.items.filter(f => new Date(f.expired) > now);
        }
    });

    // ==========================================
    // STORE: vibeGrids (Grid layout persistence)
    // ==========================================
    window.Alpine.store('vibeGrids', {
        items: window.Alpine.$persist([]).as(`${VIBE_PREFIX}-grids`),

        save(id, data, expireHours = 24 * 90) { // Default 90 days for grid layouts
            let index = this.items.findIndex(g => g.id === id);
            let expired = new Date(Date.now() + expireHours * 60 * 60 * 1000).toISOString();
            let entry = { id, data, expired };

            if (index >= 0) {
                this.items[index] = entry;
            } else {
                this.items.push(entry);
            }
            this.clean();
        },

        get(id) {
            this.clean();
            let item = this.items.find(g => g.id === id);
            return item ? item.data : null;
        },

        remove(id) {
            this.items = this.items.filter(g => g.id !== id);
        },

        clean() {
            const now = new Date();
            this.items = this.items.filter(g => new Date(g.expired) > now);
        }
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



