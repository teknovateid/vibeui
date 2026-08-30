import persist from '@alpinejs/persist'

const VIBE_PREFIX = window.VIBE_PREFIX || 'vibe';

document.addEventListener('alpine:init', () => {
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
    // STORE: vibeModals (Dismissed Modals/Announcements)
    // ==========================================
    window.Alpine.store('vibeModals', {
        dismissed: window.Alpine.$persist([]).as(`${VIBE_PREFIX}-modals`),
        
        dismiss(id) {
            if (!this.dismissed.includes(id)) {
                this.dismissed.push(id);
            }
        },
        
        isDismissed(id) {
            return this.dismissed.includes(id);
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

    const getStorageKey = (target) => {
        const prefix = getPrefix();
        if (target === document || target === window) {
            return `${prefix}-scroll-${window.location.pathname}`;
        }
        if (target && target.nodeType === 1) {
            const id = target.id;
            const vibeScroll = target.dataset ? target.dataset.vibeScroll : target.getAttribute('data-vibe-scroll');
            
            // Only track explicit scrollable containers
            if (id === 'docs-main-scroll' || id === 'main-scroll') {
                return `${prefix}-scroll-${window.location.pathname}`;
            }
            if (id === 'sidebar-menu-body' || vibeScroll) {
                return `${prefix}-scroll-${vibeScroll || id}`;
            }
        }
        return null;
    };

    let isRestoring = false;

    const restoreAllScrolls = () => {
        const prefix = getPrefix();
        isRestoring = true;

        // 1. Restore window scroll
        const windowKey = `${prefix}-scroll-${window.location.pathname}`;
        const savedWindowScroll = sessionStorage.getItem(windowKey);
        if (savedWindowScroll !== null && parseFloat(savedWindowScroll) > 0) {
            window.scrollTo(0, Math.round(parseFloat(savedWindowScroll)));
        } else {
            window.scrollTo(0, 0);
        }

        // 2. Restore dedicated scroll containers
        const containers = document.querySelectorAll('#docs-main-scroll, #sidebar-menu-body, [data-vibe-scroll]');
        containers.forEach(el => {
            const key = getStorageKey(el);
            if (!key) return;
            const saved = sessionStorage.getItem(key);
            if (saved !== null && parseFloat(saved) > 0) {
                el.scrollTop = Math.round(parseFloat(saved));
            } else {
                const isPageSpecific = el.id === 'docs-main-scroll' || el.id === 'main-scroll';
                if (isPageSpecific) {
                    el.scrollTop = 0;
                }
            }
        });

        // Ensure temporary minHeight is cleared
        const main = document.getElementById('docs-main-scroll');
        if (main) {
            const m = main.querySelector('main');
            if (m) m.style.minHeight = '';
        }
        const side = document.getElementById('sidebar-menu-body');
        if (side && side.firstElementChild) {
            side.firstElementChild.style.minHeight = '';
        }

        // 3. Mark done restoring after layout settles
        setTimeout(() => {
            isRestoring = false;
        }, 20);
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
        const windowKey = `${prefix}-scroll-${window.location.pathname}`;
        const winScroll = window.scrollY || window.pageYOffset || 0;
        if (winScroll > 0) {
            sessionStorage.setItem(windowKey, Math.round(winScroll));
        } else {
            sessionStorage.removeItem(windowKey);
        }

        const containers = document.querySelectorAll('#docs-main-scroll, #sidebar-menu-body, [data-vibe-scroll]');
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

        // Reset page-specific scroll to top (0) before morphing
        const main = document.getElementById('docs-main-scroll');
        if (main) {
            main.scrollTop = 0;
        }
    });

    // Restore on load & Livewire SPA navigation & Alpine init
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', restoreAllScrolls);
    } else {
        restoreAllScrolls();
    }
    document.addEventListener('livewire:navigated', restoreAllScrolls);
    document.addEventListener('alpine:initialized', () => {
        setTimeout(restoreAllScrolls, 10);
    });
};

initScrollRestoration();



