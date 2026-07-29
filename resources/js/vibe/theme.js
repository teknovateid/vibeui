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
        const isDark = document.documentElement.classList.contains('dark');
        this.setMode(isDark ? 'light' : 'dark');
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
