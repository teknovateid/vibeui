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

