const VIBE_PREFIX = window.VIBE_PREFIX || 'vibe';
const THEME_KEY = `${VIBE_PREFIX}-theme`;

// Injeksi instan override CSS secepat mungkin saat theme.js dimuat
(function() {
    try {
        const stored = localStorage.getItem(THEME_KEY);
        if (stored) {
            const parsed = JSON.parse(stored);
            if (parsed && parsed.css) {
                const styleId = `${VIBE_PREFIX}-theme-override`;
                let style = document.getElementById(styleId);
                if (!style) {
                    style = document.createElement('style');
                    style.id = styleId;
                    style.setAttribute('data-navigate-once', 'true');
                    document.head.appendChild(style);
                }
                if (style.textContent !== parsed.css) {
                    style.textContent = parsed.css;
                }
            }
        }
    } catch (e) {}
})();

const ThemeManager = {
    animation: 'curtain', // curtain, shutter, diagonal, wipe
    duration: 700, // Durasi animasi transisi dalam milidetik (misal: 650ms agar terlihat mulus dan elegan)

    defaultConfig: {
        mode: 'system',
        sidebar: null,
        form: null,
        badge: null,
        preset: null,
        radius: null,
        fontName: null,
        fontValue: null,
        css: null,
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
                const parsed = JSON.parse(stored);
                delete parsed.animation; // Jangan biarkan cache localStorage lama menimpa konfigurasi animasi kode
                return { ...this.defaultConfig, ...parsed };
            }
        } catch (e) {
            console.warn("VibeTheme: Gagal mem-parsing konfigurasi tema, kembali ke default.", e);
        }
        return { ...this.defaultConfig };
    },

    saveConfig(config) {
        const toSave = { ...config };
        delete toSave.animation;
        localStorage.setItem(THEME_KEY, JSON.stringify(toSave));
        this.applyComponentThemes(config);
        
        window.dispatchEvent(new CustomEvent(`${VIBE_PREFIX}-theme-changed`, { 
            detail: config 
        }));
    },

    setMode(mode, event = null) {
        const config = this.getConfig();
        if (config.mode === mode) return;

        let targetIsDark = false;
        if (mode === 'dark') {
            targetIsDark = true;
        } else if (mode === 'light') {
            targetIsDark = false;
        } else {
            targetIsDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        }

        const currentlyDark = document.documentElement.classList.contains('dark');
        if (targetIsDark === currentlyDark) {
            config.mode = mode;
            this.saveConfig(config);
            return;
        }

        this._switchWithTransition(() => {
            config.mode = mode;
            this.saveConfig(config);
            this.applyTheme(mode);
        }, targetIsDark, event);
    },

    setComponent(component, value) {
        const config = this.getConfig();
        if (config.hasOwnProperty(component)) {
            config[component] = value;
            this.saveConfig(config);
        }
    },

    setCssOverride(css, extraData = {}) {
        const config = this.getConfig();
        config.css = css;
        Object.assign(config, extraData);
        this.saveConfig(config);
    },

    clearCssOverride() {
        const config = this.getConfig();
        delete config.css;
        delete config.preset;
        delete config.customHex;
        delete config.radius;
        delete config.fontName;
        delete config.fontValue;
        delete config.sidebarPreset;
        delete config.customSidebarBg;
        delete config.customSidebarFg;
        delete config.customSidebarBorder;
        delete config.headerPreset;
        delete config.customHeaderBg;
        delete config.customHeaderFg;
        delete config.customHeaderBorder;
        this.saveConfig(config);
    },

    setAnimation(animation) {
        const valid = ['curtain', 'shutter', 'diagonal', 'wipe'];
        if (valid.includes(animation)) {
            this.animation = animation;
        }
    },

    getAnimation() {
        return this.animation || 'shutter';
    },

    toggle(event = null) {
        const isDark = document.documentElement.classList.contains('dark');
        const nextTheme = isDark ? 'light' : 'dark';
        const targetIsDark = nextTheme === 'dark';

        this._switchWithTransition(() => {
            const config = this.getConfig();
            config.mode = nextTheme;
            this.saveConfig(config);
            this.applyTheme(nextTheme);
        }, targetIsDark, event);
    },

    _switchWithTransition(callback, targetIsDarkOrEvent = false, event = null) {
        let targetIsDark = false;
        if (typeof targetIsDarkOrEvent === 'boolean') {
            targetIsDark = targetIsDarkOrEvent;
        } else if (targetIsDarkOrEvent && typeof targetIsDarkOrEvent === 'object') {
            event = targetIsDarkOrEvent;
            targetIsDark = !document.documentElement.classList.contains('dark');
        }

        const isAppearanceTransition = typeof document.startViewTransition === 'function'
            && !window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (!isAppearanceTransition) {
            document.documentElement.classList.add('vibe-theme-switching');
            callback();
            requestAnimationFrame(() => {
                document.documentElement.classList.remove('vibe-theme-switching');
            });
            return;
        }

        const animType = this.getAnimation();

        let clipPathKeyframes = [];
        let duration = typeof this.duration === 'number' ? this.duration : 650;

        if (animType === 'shutter') {
            // Cinema Aperture: terbuka simetris dari tengah ke kiri dan kanan
            clipPathKeyframes = ['inset(0 50% 0 50%)', 'inset(0 0 0 0)'];
        } else if (animType === 'diagonal') {
            // Diagonal Cyber Slash: membelah sudut layar secara miring
            clipPathKeyframes = targetIsDark
                ? ['polygon(0 0, 0 0, 0 0, 0 0)', 'polygon(0 0, 200% 0, 0 200%, 0 0)']
                : ['polygon(100% 0, 100% 0, 100% 0, 100% 0)', 'polygon(100% 0, -100% 0, 100% 200%, 100% 0)'];
        } else if (animType === 'wipe') {
            // Horizontal Curtain: menyapu dari kanan ke kiri
            clipPathKeyframes = ['inset(0 0 0 100%)', 'inset(0 0 0 0)'];
        } else {
            // Default: 'curtain' (Dusk & Dawn Horizon):
            // Mode Gelap: Tirai malam turun dari atas ke bawah
            // Mode Terang: Cahaya fajar naik dari bawah ke atas
            clipPathKeyframes = targetIsDark
                ? ['inset(0 0 100% 0)', 'inset(0 0 0 0)']
                : ['inset(100% 0 0 0)', 'inset(0 0 0 0)'];
        }

        document.documentElement.classList.add('vibe-theme-switching');

        const transition = document.startViewTransition(() => {
            callback();
        });

        transition.ready.then(() => {
            document.documentElement.classList.remove('vibe-theme-switching');

            try {
                document.documentElement.animate(
                    {
                        clipPath: clipPathKeyframes
                    },
                    {
                        duration: duration,
                        easing: 'cubic-bezier(0.25, 1, 0.5, 1)',
                        pseudoElement: '::view-transition-new(root)'
                    }
                );
            } catch (e) {}
        }).catch(() => {
            document.documentElement.classList.remove('vibe-theme-switching');
        });

        if (transition.finished) {
            transition.finished.finally(() => {
                document.documentElement.classList.remove('vibe-theme-switching');
            });
        }
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

        // Terapkan penimpaan variabel CSS tema (seperti --primary, --ring, --radius) jika ada
        const overrideStyleId = `${VIBE_PREFIX}-theme-override`;
        if (config.css) {
            let style = document.getElementById(overrideStyleId);
            if (!style) {
                style = document.createElement('style');
                style.id = overrideStyleId;
                style.setAttribute('data-navigate-once', 'true');
                document.head.appendChild(style);
            }
            if (style.textContent !== config.css) {
                style.textContent = config.css;
            }
        } else {
            const style = document.getElementById(overrideStyleId);
            if (style) {
                style.textContent = '';
            }
        }
    }
};

ThemeManager.init();
window.VibeTheme = ThemeManager;

// Safely track registered Alpine.data components and prevent single-argument calls from wiping data callbacks
const registeredAlpineData = new Set();

function patchAlpineData(alpine = window.Alpine) {
    if (!alpine || alpine._vibePatched) return;
    alpine._vibePatched = true;

    const originalData = alpine.data;
    alpine.data = function (name, callback) {
        if (arguments.length < 2 || typeof callback !== 'function') {
            return registeredAlpineData.has(name);
        }
        registeredAlpineData.add(name);
        return originalData.call(alpine, name, callback);
    };
}

if (window.Alpine) {
    patchAlpineData(window.Alpine);
}
document.addEventListener('alpine:init', () => {
    if (window.Alpine) patchAlpineData(window.Alpine);
}, { capture: true });
document.addEventListener('livewire:init', () => {
    if (window.Alpine) patchAlpineData(window.Alpine);
});

function isTableDataRegistered() {
    if (registeredAlpineData.has('laravellivewiretable')) return true;
    if (window.Alpine && typeof window.Alpine.evaluate === 'function') {
        try {
            const testEl = document.createElement('div');
            const result = window.Alpine.evaluate(testEl, 'typeof laravellivewiretable');
            if (result === 'function') {
                registeredAlpineData.add('laravellivewiretable');
                return true;
            }
        } catch (e) {}
    }
    return false;
}

function ensureDataTableScripts() {
    if (isTableDataRegistered()) return;

    if (!document.querySelector('script[src*="laravel-livewire-tables/core.min.js"]')) {
        const script = document.createElement('script');
        script.src = '/rappasoft/laravel-livewire-tables/core.min.js';
        script.setAttribute('data-navigate-once', 'true');
        script.onload = () => {
            window.VibeInitDataTable();
        };
        document.head.appendChild(script);
    }
    if (!document.querySelector('link[href*="laravel-livewire-tables/core.min.css"]')) {
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = '/rappasoft/laravel-livewire-tables/core.min.css';
        document.head.appendChild(link);
    }
}

// Function to initialize Rappasoft Datatables when loaded on-demand via @pushOnce / wire:navigate
window.VibeInitDataTable = function () {
    if (!window.Alpine) return;
    patchAlpineData(window.Alpine);

    ensureDataTableScripts();

    // 1. If laravellivewiretable Alpine component is not registered, dispatch alpine:init
    if (!isTableDataRegistered()) {
        try {
            document.dispatchEvent(new CustomEvent('alpine:init'));
        } catch (e) {}
    }

    // 2. If laravellivewiretable is registered, safely initialize any table roots stuck with x-cloak
    if (isTableDataRegistered()) {
        const cloakedTables = document.querySelectorAll('.vibe-datatable-root [x-cloak], [x-data*="laravellivewiretable"][x-cloak]');
        cloakedTables.forEach((el) => {
            try {
                if (typeof window.Alpine.initTree === 'function') {
                    if (el._x_dataStack && !el._x_dataStack[0]) {
                        delete el._x_dataStack;
                    }
                    if (!el._x_dataStack) {
                        window.Alpine.initTree(el);
                    }
                }
            } catch (e) {}
            if (el.hasAttribute('x-cloak')) {
                el.removeAttribute('x-cloak');
            }
        });
    }
};

// Detect when core.min.js is injected into DOM by Livewire SPA navigation
function setupDataTableScriptObserver() {
    const attachLoadHandler = (script) => {
        if (script.tagName === 'SCRIPT' && script.src && script.src.includes('laravel-livewire-tables')) {
            script.addEventListener('load', () => {
                window.VibeInitDataTable();
            }, { capture: true });
        }
    };

    document.querySelectorAll('script[src*="laravel-livewire-tables"]').forEach(attachLoadHandler);

    const observer = new MutationObserver((mutations) => {
        for (const mutation of mutations) {
            for (const node of mutation.addedNodes) {
                if (node.nodeType === 1) {
                    attachLoadHandler(node);
                    if (node.querySelectorAll) {
                        node.querySelectorAll('script[src*="laravel-livewire-tables"]').forEach(attachLoadHandler);
                    }
                }
            }
        }
    });

    if (document.head) observer.observe(document.head, { childList: true, subtree: true });
    if (document.body) observer.observe(document.body, { childList: true, subtree: true });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupDataTableScriptObserver);
} else {
    setupDataTableScriptObserver();
}

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
        mainEl.addEventListener('animationend', () => {
            mainEl.classList.remove('vibe-page-enter');
        }, { once: true });
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

