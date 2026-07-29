import persist from '@alpinejs/persist'

const VIBE_PREFIX = window.VIBE_PREFIX || 'vibe';

document.addEventListener('alpine:init', () => {
    window.Alpine.plugin(persist)

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
});
