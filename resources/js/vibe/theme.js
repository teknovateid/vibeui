const VIBE_PREFIX = window.VIBE_PREFIX || 'vibe';
const THEME_KEY = `${VIBE_PREFIX}-theme`;

const ThemeManager = {
    defaultConfig: {
        mode: 'system',
        sidebar: null,
        form: null,
        badge: null,
    },

    init() {
        const config = this.getConfig();
        this.applyTheme(config.mode);
        this.applyComponentThemes(config);
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if (this.getConfig().mode === 'system') {
                this.applyTheme('system');
            }
        });
    },

    getConfig() {
        try {
            const stored = localStorage.getItem(THEME_KEY);
            if (stored) {
                if (stored === 'dark' || stored === 'light' || stored === 'system') {
                    const migratedConfig = { ...this.defaultConfig, mode: stored };
                    localStorage.setItem(THEME_KEY, JSON.stringify(migratedConfig));
                    return migratedConfig;
                }
                return { ...this.defaultConfig, ...JSON.parse(stored) };
            }
        } catch (e) {
            console.warn("VibeTheme: Gagal mem-parsing konfigurasi tema, kembali ke default.", e);
        }
        return { ...this.defaultConfig };
    },

    saveConfig(config) {
        localStorage.setItem(THEME_KEY, JSON.stringify(config));
        this.applyComponentThemes(config);
        
        window.dispatchEvent(new CustomEvent(`${VIBE_PREFIX}-theme-changed`, { 
            detail: config 
        }));
    },

    setMode(mode) {
        const config = this.getConfig();
        config.mode = mode;
        this.saveConfig(config);
        this.applyTheme(mode);
    },

    setComponent(component, value) {
        const config = this.getConfig();
        if (config.hasOwnProperty(component)) {
            config[component] = value;
            this.saveConfig(config);
        }
    },

    toggle() {
        document.documentElement.classList.add('vibe-theme-transition');
        const isDark = document.documentElement.classList.contains('dark');
        this.setMode(isDark ? 'light' : 'dark');
        setTimeout(() => {
            document.documentElement.classList.remove('vibe-theme-transition');
        }, 350);
    },

    applyTheme(mode) {
        let isDark = false;
        if (mode === 'dark') {
            isDark = true;
        } else if (mode === 'light') {
            isDark = false;
        } else {
            isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        }

        if (isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        try {
            document.cookie = `${VIBE_PREFIX}_theme=${isDark ? 'dark' : 'light'}; path=/; max-age=31536000; SameSite=Lax`;
        } catch (e) {}
    },

    applyComponentThemes(config) {
        const root = document.documentElement;
        
        // Menyuntikkan attribute data-* ke tag <html> agar CSS bisa mendeteksi tema per-komponen
        // Contoh CSS: html[data-sidebar="blue"] .vibe-sidebar { @apply bg-blue-500; }
        ['sidebar', 'form', 'badge'].forEach(component => {
            if (config[component]) {
                root.setAttribute(`data-${component}`, config[component]);
            } else {
                root.removeAttribute(`data-${component}`);
            }
        });
    }
};

ThemeManager.init();
window.VibeTheme = ThemeManager;

// Safely track registered Alpine.data components and prevent single-argument calls from wiping data callbacks
const registeredAlpineData = new Set();

function patchAlpineData() {
    if (!window.Alpine || window.Alpine._vibePatched) return;
    window.Alpine._vibePatched = true;

    const originalData = window.Alpine.data;
    window.Alpine.data = function (name, callback) {
        if (arguments.length < 2 || typeof callback !== 'function') {
            return registeredAlpineData.has(name);
        }
        registeredAlpineData.add(name);
        return originalData.call(window.Alpine, name, callback);
    };
}

if (window.Alpine) {
    patchAlpineData();
}
document.addEventListener('alpine:init', patchAlpineData, { capture: true });
document.addEventListener('livewire:init', patchAlpineData);

// Function to initialize Rappasoft Datatables when loaded on-demand via @pushOnce / wire:navigate
window.VibeInitDataTable = function () {
    patchAlpineData();

    if (!window.Alpine) return;

    // 1. If laravellivewiretable Alpine component is not registered, dispatch alpine:init
    if (!registeredAlpineData.has('laravellivewiretable')) {
        try {
            document.dispatchEvent(new CustomEvent('alpine:init'));
        } catch (e) {}
    }

    // 2. If laravellivewiretable is registered, initialize any table roots that are stuck on x-cloak
    if (registeredAlpineData.has('laravellivewiretable') && typeof window.Alpine.initTree === 'function') {
        const cloakedTables = document.querySelectorAll('[x-data*="laravellivewiretable"][x-cloak]');
        cloakedTables.forEach((el) => {
            try {
                if (typeof window.Alpine.destroyTree === 'function') {
                    window.Alpine.destroyTree(el);
                }
                window.Alpine.initTree(el);
            } catch (e) {}
        });
    }
};

// Re-apply theme before and after Livewire SPA navigation
document.addEventListener('livewire:navigating', () => {
    ThemeManager.init();
});

document.addEventListener('livewire:navigated', () => {
    ThemeManager.init();

    const mainEl = document.querySelector('main');
    if (mainEl) {
        mainEl.classList.remove('vibe-page-enter');
        void mainEl.offsetWidth;
        mainEl.classList.add('vibe-page-enter');
    }

    // Initialize datatables if present on the navigated page
    if (document.querySelector('.vibe-datatable-root, [x-data*="laravellivewiretable"]')) {
        window.VibeInitDataTable();
        [50, 150, 300, 600].forEach((delay) => {
            setTimeout(() => {
                window.VibeInitDataTable();
            }, delay);
        });
    }
});

