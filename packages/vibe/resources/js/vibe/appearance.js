/**
 * Vibe UI - Appearance & Theme Controller
 * Modular Single Source of Truth for Appearance Settings & Theme Customization.
 */

export function appearanceController() {
                const prefix = window.VIBE_PREFIX || 'vibe';
                const themeKey = prefix + '-theme-tokens';
                const styleId = prefix + '-theme-override';

                return {
                    // Compatibility with index.blade.php
                    selectedPreset: 'zinc',
                    selectedSidebarPreset: 'default',
                    selectedHeaderPreset: 'default',
                    showCssDrawer: false,


                    presets: {
                        zinc: {
                            name: 'Zinc',
                            color: '#0a0b0a',
                            light: '#0a0b0a',
                            lightFg: '#f9fafa',
                            dark: '#f9fafa',
                            darkFg: '#0a0b0a'
                        },
                        indigo: {
                            name: 'Indigo',
                            color: '#6366f1',
                            light: '#4f46e5',
                            lightFg: '#ffffff',
                            dark: '#818cf8',
                            darkFg: '#0a0b0a'
                        },
                        violet: {
                            name: 'Violet',
                            color: '#8b5cf6',
                            light: '#7c3aed',
                            lightFg: '#ffffff',
                            dark: '#a78bfa',
                            darkFg: '#0a0b0a'
                        },
                        blue: {
                            name: 'Blue',
                            color: '#2563eb',
                            light: '#2563eb',
                            lightFg: '#ffffff',
                            dark: '#38bdf8',
                            darkFg: '#0a0b0a'
                        },
                        emerald: {
                            name: 'Emerald',
                            color: '#10b981',
                            light: '#059669',
                            lightFg: '#ffffff',
                            dark: '#34d399',
                            darkFg: '#0a0b0a'
                        },
                        rose: {
                            name: 'Rose',
                            color: '#f43f5e',
                            light: '#e11d48',
                            lightFg: '#ffffff',
                            dark: '#fb7185',
                            darkFg: '#0a0b0a'
                        },
                        amber: {
                            name: 'Amber',
                            color: '#f59e0b',
                            light: '#d97706',
                            lightFg: '#ffffff',
                            dark: '#fbbf24',
                            darkFg: '#0a0b0a'
                        },
                        cyan: {
                            name: 'Cyan',
                            color: '#06b6d4',
                            light: '#0891b2',
                            lightFg: '#ffffff',
                            dark: '#22d3ee',
                            darkFg: '#0a0b0a'
                        }
                    },


                    sidebarPresets: {
                        default: {
                            name: 'Default',
                            light: {
                                bg: '#ffffff',
                                fg: '#09090b',
                                border: '#e4e4e7',
                                accent: '#f4f4f5',
                                accentFg: '#09090b'
                            },
                            dark: {
                                bg: '#0f0f12',
                                fg: '#fafafa',
                                border: '#27272a',
                                accent: '#18181b',
                                accentFg: '#fafafa'
                            }
                        },
                        dark: {
                            name: 'Dark Contrast',
                            light: {
                                bg: '#121312',
                                fg: '#f9fafa',
                                border: '#262726',
                                accent: '#1e1f1e',
                                accentFg: '#f9fafa'
                            },
                            dark: {
                                bg: '#0d0e0d',
                                fg: '#f9fafa',
                                border: '#222322',
                                accent: '#191a19',
                                accentFg: '#f9fafa'
                            }
                        },
                        zinc: {
                            name: 'Zinc Slate',
                            light: {
                                bg: '#18181b',
                                fg: '#f4f4f5',
                                border: '#27272a',
                                accent: '#27272a',
                                accentFg: '#f4f4f5'
                            },
                            dark: {
                                bg: '#09090b',
                                fg: '#f4f4f5',
                                border: '#27272a',
                                accent: '#18181b',
                                accentFg: '#f4f4f5'
                            }
                        },
                        subtle: {
                            name: 'Subtle Muted',
                            light: {
                                bg: '#f4f5f5',
                                fg: '#0a0b0a',
                                border: '#e5e6e5',
                                accent: '#e5e6e5',
                                accentFg: '#0a0b0a'
                            },
                            dark: {
                                bg: '#1a1b1a',
                                fg: '#f9fafa',
                                border: '#2b2c2b',
                                accent: '#262726',
                                accentFg: '#f9fafa'
                            }
                        },
                        navy: {
                            name: 'Deep Navy',
                            light: {
                                bg: '#0a0f24',
                                fg: '#f1f5f9',
                                border: '#1e293b',
                                accent: '#1e293b',
                                accentFg: '#f1f5f9'
                            },
                            dark: {
                                bg: '#060919',
                                fg: '#f1f5f9',
                                border: '#172033',
                                accent: '#111827',
                                accentFg: '#f1f5f9'
                            }
                        }
                    },


                    headerPresets: {
                        default: {
                            name: 'Default',
                            light: {
                                bg: '#ffffff',
                                fg: '#0a0b0a',
                                border: '#e5e6e5',
                                accent: '#f4f5f5',
                                accentFg: '#0a0b0a'
                            },
                            dark: {
                                bg: '#121312',
                                fg: '#f9fafa',
                                border: '#262726',
                                accent: '#1e1f1e',
                                accentFg: '#f9fafa'
                            }
                        },
                        glass: {
                            name: 'Translucent Glass',
                            light: {
                                bg: 'rgba(255, 255, 255, 0.85)',
                                fg: '#0a0b0a',
                                border: 'rgba(229, 230, 229, 0.8)',
                                accent: '#f4f5f5',
                                accentFg: '#0a0b0a'
                            },
                            dark: {
                                bg: 'rgba(18, 19, 18, 0.85)',
                                fg: '#f9fafa',
                                border: 'rgba(38, 39, 38, 0.8)',
                                accent: '#1e1f1e',
                                accentFg: '#f9fafa'
                            }
                        },
                        subtle: {
                            name: 'Subtle Muted',
                            light: {
                                bg: '#f4f5f5',
                                fg: '#0a0b0a',
                                border: '#e5e6e5',
                                accent: '#e5e6e5',
                                accentFg: '#0a0b0a'
                            },
                            dark: {
                                bg: '#1a1b1a',
                                fg: '#f9fafa',
                                border: '#2b2c2b',
                                accent: '#262726',
                                accentFg: '#f9fafa'
                            }
                        },
                        dark: {
                            name: 'Dark Contrast',
                            light: {
                                bg: '#121312',
                                fg: '#f9fafa',
                                border: '#262726',
                                accent: '#1e1f1e',
                                accentFg: '#f9fafa'
                            },
                            dark: {
                                bg: '#0d0e0d',
                                fg: '#f9fafa',
                                border: '#222322',
                                accent: '#191a19',
                                accentFg: '#f9fafa'
                            }
                        },
                        navy: {
                            name: 'Deep Navy',
                            light: {
                                bg: '#0a0f24',
                                fg: '#f1f5f9',
                                border: '#1e293b',
                                accent: '#1e293b',
                                accentFg: '#f1f5f9'
                            },
                            dark: {
                                bg: '#060919',
                                fg: '#f1f5f9',
                                border: '#172033',
                                accent: '#111827',
                                accentFg: '#f1f5f9'
                            }
                        }
                    },

                    isDarkNow: false,

                    mode: window.VibeTheme?.getConfig()?.mode || (document.documentElement.classList.contains('dark') ? 'dark' : 'light'),
                    customHex: '#18181b',
                    customHexInput: '18181B',
                    highContrast: false,
                    motionActive: true,

                    // Surface
                    selectedSurface: 'zinc',
                    selectedSurfaceLight: 'zinc',
                    selectedSurfaceDark: 'zinc',
                    
                    // Sidebar States
                    sidebarStyle: 'default',
                    sidebarStyleLight: 'default',
                    sidebarStyleDark: 'default',
                    sidebarCustomBg: '#ffffff',
                    sidebarCustomBgLight: '#ffffff',
                    sidebarCustomBgDark: '#0f0f12',
                    sidebarCustomBgInput: 'FFFFFF',
                    sidebarCustomBorder: '#e4e4e7',
                    sidebarCustomBorderLight: '#e4e4e7',
                    sidebarCustomBorderDark: '#27272a',
                    sidebarCustomBorderInput: 'E4E4E7',
                    sidebarBorderMode: 'default',
                    sidebarBorderModeLight: 'default',
                    sidebarBorderModeDark: 'default',
                    transparentSidebar: false,
                    transparentSidebarLight: false,
                    transparentSidebarDark: false,
                    sidebarFeature: 'Recent changes',

                    // Nav States
                    navStyle: 'harmony',
                    navStyleLight: 'harmony',
                    navStyleDark: 'harmony',
                    navDensity: 'default',
                    navDensityLight: 'default',
                    navDensityDark: 'default',
                    navIndicator: false,
                    navIndicatorLight: false,
                    navIndicatorDark: false,
                    navCustomActiveBg: '#e4e4e7',
                    navCustomActiveBgLight: '#e4e4e7',
                    navCustomActiveBgDark: '#27272a',
                    navCustomActiveBgInput: 'E4E4E7',
                    navCustomActiveFg: '#09090b',
                    navCustomActiveFgLight: '#09090b',
                    navCustomActiveFgDark: '#fafafa',
                    navCustomActiveFgInput: '09090B',
                    navCustomIndicator: '#18181b',
                    navCustomIndicatorLight: '#18181b',
                    navCustomIndicatorDark: '#fafafa',
                    navCustomIndicatorInput: '18181B',

                    // Header States
                    headerStyle: 'default',
                    headerStyleLight: 'default',
                    headerStyleDark: 'default',
                    headerCustomBg: '#ffffff',
                    headerCustomBgLight: '#ffffff',
                    headerCustomBgDark: '#0f0f12',
                    headerCustomBgInput: 'FFFFFF',
                    headerCustomBorder: '#e4e4e7',
                    headerCustomBorderLight: '#e4e4e7',
                    headerCustomBorderDark: '#27272a',
                    headerCustomBorderInput: 'E4E4E7',
                    headerBorderMode: 'default',
                    headerBorderModeLight: 'default',
                    headerBorderModeDark: 'default',
                    headerGlassEffect: true,
                    headerGlassEffectLight: true,
                    headerGlassEffectDark: true,

                    selectedSemantic: 'vibrant',
                    selectedChartPreset: 'rainbow',
                    selectedRadius: '0.5rem',
                    selectedFontName: 'Figtree',
                    selectedFontValue: "'Figtree', ui-sans-serif, system-ui, sans-serif",
                    tablesView: 'default',

                    // Table States
                    tableStyle: 'default',
                    tableStyleLight: 'default',
                    tableStyleDark: 'default',
                    tableCustomHeaderBg: '#f4f4f5',
                    tableCustomHeaderBgLight: '#f4f4f5',
                    tableCustomHeaderBgDark: '#18181b',
                    tableCustomHeaderBgInput: 'F4F4F5',
                    tableCustomBorder: '#e4e4e7',
                    tableCustomBorderLight: '#e4e4e7',
                    tableCustomBorderDark: '#27272a',
                    tableCustomBorderInput: 'E4E4E7',
                    tableCustomRowHover: '#f9f9fa',
                    tableCustomRowHoverLight: '#f9f9fa',
                    tableCustomRowHoverDark: '#1c1c20',
                    tableCustomRowHoverInput: 'F9F9FA',

                    tableStyles: [
                        { id: 'default', name: 'Standar' },
                        { id: 'card', name: 'Kartu' },
                        { id: 'contrast', name: 'Kontras' },
                        { id: 'muted', name: 'Lembut' },
                        { id: 'dark', name: 'Gelap' },
                        { id: 'custom', name: 'Kustom' },
                    ],
                    reduceMotion: false,
                    glassEffect: true,
                    copied: false,

                    primaryColors: [
                        { name: 'Dark Slate', hex: '#18181b' },
                        { name: 'Violet', hex: '#8b5cf6' },
                        { name: 'Indigo', hex: '#6366f1' },
                        { name: 'Blue', hex: '#2563eb' },
                        { name: 'Sky', hex: '#0ea5e9' },
                        { name: 'Teal', hex: '#0d9488' },
                        { name: 'Emerald', hex: '#16a34a' },
                        { name: 'Rose', hex: '#e11d48' },
                        { name: 'Amber', hex: '#d97706' },
                    ],

                    get brandColors() {
                        return this.primaryColors;
                    },

                    surfacePresets: [
                        {
                            id: 'zinc',
                            name: 'Vibe Zinc (Bawaan)',
                            desc: 'Karakter netral kontemporer standar Vibe UI.',
                            light: { bg: '#fafafa', card: '#ffffff', border: '#e4e4e7', sidebar: '#ffffff', header: '#ffffff' },
                            dark: { bg: '#09090b', card: '#121215', border: '#27272a', sidebar: '#0f0f12', header: '#0f0f12' }
                        },
                        {
                            id: 'stone',
                            name: 'Warm Stone',
                            desc: 'Nuansa hangat lembut dan bersahabat ala Linear.',
                            light: { bg: '#fafaf9', card: '#ffffff', border: '#e7e5e4', sidebar: '#fafaf9', header: '#ffffff' },
                            dark: { bg: '#0c0a09', card: '#1c1917', border: '#292524', sidebar: '#141210', header: '#141210' }
                        },
                        {
                            id: 'slate',
                            name: 'Cool Slate',
                            desc: 'Sentuhan kebiruan dingin ala GitHub & Tailwind.',
                            light: { bg: '#f8fafc', card: '#ffffff', border: '#e2e8f0', sidebar: '#f8fafc', header: '#ffffff' },
                            dark: { bg: '#020617', card: '#0f172a', border: '#1e293b', sidebar: '#0b1120', header: '#0b1120' }
                        },
                        {
                            id: 'oled',
                            name: 'OLED Pure Black',
                            desc: 'Hitam pekat 100% pada dark mode untuk efisiensi daya.',
                            light: { bg: '#ffffff', card: '#f4f5f5', border: '#e5e6e5', sidebar: '#ffffff', header: '#ffffff' },
                            dark: { bg: '#000000', card: '#0a0a0a', border: '#27272a', sidebar: '#000000', header: '#000000' }
                        }
                    ],

                    sidebarStyles: [
                        { id: 'default', name: 'Standar' },
                        { id: 'card', name: 'Kartu' },
                        { id: 'contrast', name: 'Kontras' },
                        { id: 'muted', name: 'Lembut' },
                        { id: 'dark', name: 'Gelap' },
                        { id: 'custom', name: 'Kustom' },
                    ],

                    headerStyles: [
                        { id: 'default', name: 'Standar' },
                        { id: 'card', name: 'Kartu' },
                        { id: 'glass', name: 'Glass Blur' },
                        { id: 'contrast', name: 'Kontras' },
                        { id: 'muted', name: 'Lembut' },
                        { id: 'dark', name: 'Gelap' },
                        { id: 'custom', name: 'Kustom' },
                    ],

                    navStyles: [
                        { id: 'harmony', name: 'Sidebar Harmony' },
                        { id: 'primary', name: 'Primary Filled' },
                        { id: 'subtle', name: 'Subtle Neutral' },
                        { id: 'line', name: 'Indicator Line' },
                        { id: 'custom', name: 'Kustom' },
                    ],

                    sidebarFeatures: [
                        { name: 'Recent changes', color: 'bg-emerald-500' },
                        { name: 'Quick shortcuts', color: 'bg-blue-500' },
                        { name: 'Activity feed', color: 'bg-amber-500' },
                        { name: 'None', color: 'bg-zinc-400' },
                    ],

                    semanticPresets: [
                        {
                            id: 'vibrant',
                            name: 'Vibrant Modern',
                            colors: { success: '#10b981', warning: '#f59e0b', destructive: '#ef4444', info: '#0ea5e9' }
                        },
                        {
                            id: 'pastel',
                            name: 'Pastel Soft',
                            colors: { success: '#34d399', warning: '#fbbf24', destructive: '#f87171', info: '#38bdf8' }
                        },
                        {
                            id: 'high',
                            name: 'High Lumens',
                            colors: { success: '#059669', warning: '#d97706', destructive: '#dc2626', info: '#0284c7' }
                        }
                    ],

                    chartPresets: [
                        {
                            id: 'rainbow',
                            name: 'Modern Rainbow',
                            colors: ['#0ea5e9', '#10b981', '#f59e0b', '#8b5cf6', '#ef4444']
                        },
                        {
                            id: 'ocean',
                            name: 'Cool Oceanic',
                            colors: ['#06b6d4', '#0ea5e9', '#0d9488', '#6366f1', '#8b5cf6']
                        },
                        {
                            id: 'sunset',
                            name: 'Warm Sunset',
                            colors: ['#f97316', '#f59e0b', '#f43f5e', '#ec4899', '#a855f7']
                        },
                        {
                            id: 'mono',
                            name: 'Monochromatic',
                            colors: ['#2563eb', '#3b82f6', '#60a5fa', '#93c5fd', '#bfdbfe']
                        }
                    ],

                    radii: [
                        { label: 'Tajam', value: '0rem' },
                        { label: 'Kecil', value: '0.25rem' },
                        { label: 'Standar', value: '0.5rem' },
                        { label: 'Membulat', value: '0.75rem' },
                        { label: 'Penuh', value: '1rem' },
                    ],

                    fonts: [
                        { name: 'Figtree', desc: 'Font bawaan Vibe UI yang ramah dan seimbang', value: "'Figtree', ui-sans-serif, system-ui, sans-serif" },
                        { name: 'Inter', desc: 'Tipografi presisi tinggi standar industri modern', value: "'Inter', ui-sans-serif, system-ui, sans-serif" },
                        { name: 'Plus Jakarta', desc: 'Karakter geometris kontemporer yang elegan', value: "'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif" },
                        { name: 'Outfit', desc: 'Gaya headline display dinamis dan ekspresif', value: "'Outfit', ui-sans-serif, system-ui, sans-serif" }
                    ],

                    get currentSemanticColors() {
                        const p = this.semanticPresets.find(s => s.id === this.selectedSemantic);
                        return p ? p.colors : this.semanticPresets[0].colors;
                    },

                    updateIsDarkNow() {
                        if (this.mode === 'dark') {
                            this.isDarkNow = true;
                        } else if (this.mode === 'light') {
                            this.isDarkNow = false;
                        } else {
                            this.isDarkNow = window.matchMedia('(prefers-color-scheme: dark)').matches;
                        }
                    },

                    syncActiveModeValues() {
                        if (this.isDarkNow) {
                            this.selectedSurface = this.selectedSurfaceDark;

                            this.sidebarStyle = this.sidebarStyleDark;
                            this.sidebarCustomBg = this.sidebarCustomBgDark;
                            this.sidebarCustomBgInput = (this.sidebarCustomBgDark || '').replace('#', '').toUpperCase();
                            this.sidebarCustomBorder = this.sidebarCustomBorderDark;
                            this.sidebarCustomBorderInput = (this.sidebarCustomBorderDark || '').replace('#', '').toUpperCase();
                            this.sidebarBorderMode = this.sidebarBorderModeDark;
                            this.transparentSidebar = this.transparentSidebarDark;

                            this.headerStyle = this.headerStyleDark;
                            this.headerCustomBg = this.headerCustomBgDark;
                            this.headerCustomBgInput = (this.headerCustomBgDark || '').replace('#', '').toUpperCase();
                            this.headerCustomBorder = this.headerCustomBorderDark;
                            this.headerCustomBorderInput = (this.headerCustomBorderDark || '').replace('#', '').toUpperCase();
                            this.headerBorderMode = this.headerBorderModeDark;
                            this.headerGlassEffect = this.headerGlassEffectDark;

                            this.navStyle = this.navStyleDark;
                            this.navDensity = this.navDensityDark;
                            this.navIndicator = this.navIndicatorDark;
                            this.navCustomActiveBg = this.navCustomActiveBgDark;
                            this.navCustomActiveBgInput = (this.navCustomActiveBgDark || '').replace('#', '').toUpperCase();
                            this.navCustomActiveFg = this.navCustomActiveFgDark;
                            this.navCustomActiveFgInput = (this.navCustomActiveFgDark || '').replace('#', '').toUpperCase();
                            this.navCustomIndicator = this.navCustomIndicatorDark;
                            this.navCustomIndicatorInput = (this.navCustomIndicatorDark || '').replace('#', '').toUpperCase();

                            this.tableStyle = this.tableStyleDark;
                            this.tableCustomHeaderBg = this.tableCustomHeaderBgDark;
                            this.tableCustomHeaderBgInput = (this.tableCustomHeaderBgDark || '').replace('#', '').toUpperCase();
                            this.tableCustomBorder = this.tableCustomBorderDark;
                            this.tableCustomBorderInput = (this.tableCustomBorderDark || '').replace('#', '').toUpperCase();
                            this.tableCustomRowHover = this.tableCustomRowHoverDark;
                            this.tableCustomRowHoverInput = (this.tableCustomRowHoverDark || '').replace('#', '').toUpperCase();
                        } else {
                            this.selectedSurface = this.selectedSurfaceLight;

                            this.sidebarStyle = this.sidebarStyleLight;
                            this.sidebarCustomBg = this.sidebarCustomBgLight;
                            this.sidebarCustomBgInput = (this.sidebarCustomBgLight || '').replace('#', '').toUpperCase();
                            this.sidebarCustomBorder = this.sidebarCustomBorderLight;
                            this.sidebarCustomBorderInput = (this.sidebarCustomBorderLight || '').replace('#', '').toUpperCase();
                            this.sidebarBorderMode = this.sidebarBorderModeLight;
                            this.transparentSidebar = this.transparentSidebarLight;

                            this.headerStyle = this.headerStyleLight;
                            this.headerCustomBg = this.headerCustomBgLight;
                            this.headerCustomBgInput = (this.headerCustomBgLight || '').replace('#', '').toUpperCase();
                            this.headerCustomBorder = this.headerCustomBorderLight;
                            this.headerCustomBorderInput = (this.headerCustomBorderLight || '').replace('#', '').toUpperCase();
                            this.headerBorderMode = this.headerBorderModeLight;
                            this.headerGlassEffect = this.headerGlassEffectLight;

                            this.navStyle = this.navStyleLight;
                            this.navDensity = this.navDensityLight;
                            this.navIndicator = this.navIndicatorLight;
                            this.navCustomActiveBg = this.navCustomActiveBgLight;
                            this.navCustomActiveBgInput = (this.navCustomActiveBgLight || '').replace('#', '').toUpperCase();
                            this.navCustomActiveFg = this.navCustomActiveFgLight;
                            this.navCustomActiveFgInput = (this.navCustomActiveFgLight || '').replace('#', '').toUpperCase();
                            this.navCustomIndicator = this.navCustomIndicatorLight;
                            this.navCustomIndicatorInput = (this.navCustomIndicatorLight || '').replace('#', '').toUpperCase();

                            this.tableStyle = this.tableStyleLight;
                            this.tableCustomHeaderBg = this.tableCustomHeaderBgLight;
                            this.tableCustomHeaderBgInput = (this.tableCustomHeaderBgLight || '').replace('#', '').toUpperCase();
                            this.tableCustomBorder = this.tableCustomBorderLight;
                            this.tableCustomBorderInput = (this.tableCustomBorderLight || '').replace('#', '').toUpperCase();
                            this.tableCustomRowHover = this.tableCustomRowHoverLight;
                            this.tableCustomRowHoverInput = (this.tableCustomRowHoverLight || '').replace('#', '').toUpperCase();
                        }
                    },

                    init() {
                        this.updateIsDarkNow();
                        try {
                            if (window.VibeTheme) {
                                const cfg = window.VibeTheme.getConfig();
                                if (cfg && cfg.customHex) {
                                    this.customHex = cfg.customHex;
                                    this.customHexInput = cfg.customHex.replace('#', '').toUpperCase();
                                }
                            }

                            const stored = localStorage.getItem(themeKey);
                            if (stored) {
                                const parsed = JSON.parse(stored);
                                if (parsed.mode) this.mode = parsed.mode;
                                this.updateIsDarkNow();

                                if (parsed.customHex) {
                                    this.customHex = parsed.customHex;
                                    this.customHexInput = parsed.customHex.replace('#', '').toUpperCase();
                                }
                                if (typeof parsed.highContrast !== 'undefined') this.highContrast = !!parsed.highContrast;

                                // Surface
                                if (parsed.selectedSurfaceLight) this.selectedSurfaceLight = parsed.selectedSurfaceLight;
                                if (parsed.selectedSurfaceDark) this.selectedSurfaceDark = parsed.selectedSurfaceDark;
                                if (parsed.selectedSurface && !parsed.selectedSurfaceLight && !parsed.selectedSurfaceDark) {
                                    this.selectedSurfaceLight = parsed.selectedSurface;
                                    this.selectedSurfaceDark = parsed.selectedSurface;
                                }

                                // Sidebar
                                if (parsed.sidebarStyleLight) this.sidebarStyleLight = parsed.sidebarStyleLight;
                                if (parsed.sidebarStyleDark) this.sidebarStyleDark = parsed.sidebarStyleDark;
                                if (parsed.sidebarStyle && !parsed.sidebarStyleLight) {
                                    this.sidebarStyleLight = parsed.sidebarStyle;
                                    this.sidebarStyleDark = parsed.sidebarStyle;
                                }

                                if (parsed.sidebarCustomBgLight) this.sidebarCustomBgLight = parsed.sidebarCustomBgLight;
                                if (parsed.sidebarCustomBgDark) this.sidebarCustomBgDark = parsed.sidebarCustomBgDark;
                                if (parsed.sidebarCustomBg && !parsed.sidebarCustomBgLight) {
                                    this.sidebarCustomBgLight = parsed.sidebarCustomBg;
                                    this.sidebarCustomBgDark = parsed.sidebarCustomBg;
                                }

                                if (parsed.sidebarCustomBorderLight) this.sidebarCustomBorderLight = parsed.sidebarCustomBorderLight;
                                if (parsed.sidebarCustomBorderDark) this.sidebarCustomBorderDark = parsed.sidebarCustomBorderDark;
                                if (parsed.sidebarCustomBorder && !parsed.sidebarCustomBorderLight) {
                                    this.sidebarCustomBorderLight = parsed.sidebarCustomBorder;
                                    this.sidebarCustomBorderDark = parsed.sidebarCustomBorder;
                                }

                                if (parsed.sidebarBorderModeLight) this.sidebarBorderModeLight = parsed.sidebarBorderModeLight;
                                if (parsed.sidebarBorderModeDark) this.sidebarBorderModeDark = parsed.sidebarBorderModeDark;
                                if (parsed.sidebarBorderMode && !parsed.sidebarBorderModeLight) {
                                    this.sidebarBorderModeLight = parsed.sidebarBorderMode;
                                    this.sidebarBorderModeDark = parsed.sidebarBorderMode;
                                }

                                if (typeof parsed.transparentSidebarLight !== 'undefined') this.transparentSidebarLight = !!parsed.transparentSidebarLight;
                                if (typeof parsed.transparentSidebarDark !== 'undefined') this.transparentSidebarDark = !!parsed.transparentSidebarDark;
                                if (typeof parsed.transparentSidebar !== 'undefined' && typeof parsed.transparentSidebarLight === 'undefined') {
                                    this.transparentSidebarLight = !!parsed.transparentSidebar;
                                    this.transparentSidebarDark = !!parsed.transparentSidebar;
                                }
                                if (parsed.sidebarFeature) this.sidebarFeature = parsed.sidebarFeature;

                                // Header
                                if (parsed.headerStyleLight) this.headerStyleLight = parsed.headerStyleLight;
                                if (parsed.headerStyleDark) this.headerStyleDark = parsed.headerStyleDark;
                                if (parsed.headerStyle && !parsed.headerStyleLight) {
                                    this.headerStyleLight = parsed.headerStyle;
                                    this.headerStyleDark = parsed.headerStyle;
                                }

                                if (parsed.headerCustomBgLight) this.headerCustomBgLight = parsed.headerCustomBgLight;
                                if (parsed.headerCustomBgDark) this.headerCustomBgDark = parsed.headerCustomBgDark;
                                if (parsed.headerCustomBg && !parsed.headerCustomBgLight) {
                                    this.headerCustomBgLight = parsed.headerCustomBg;
                                    this.headerCustomBgDark = parsed.headerCustomBg;
                                }

                                if (parsed.headerCustomBorderLight) this.headerCustomBorderLight = parsed.headerCustomBorderLight;
                                if (parsed.headerCustomBorderDark) this.headerCustomBorderDark = parsed.headerCustomBorderDark;
                                if (parsed.headerCustomBorder && !parsed.headerCustomBorderLight) {
                                    this.headerCustomBorderLight = parsed.headerCustomBorder;
                                    this.headerCustomBorderDark = parsed.headerCustomBorder;
                                }

                                if (parsed.headerBorderModeLight) this.headerBorderModeLight = parsed.headerBorderModeLight;
                                if (parsed.headerBorderModeDark) this.headerBorderModeDark = parsed.headerBorderModeDark;
                                if (parsed.headerBorderMode && !parsed.headerBorderModeLight) {
                                    this.headerBorderModeLight = parsed.headerBorderMode;
                                    this.headerBorderModeDark = parsed.headerBorderMode;
                                }

                                if (typeof parsed.headerGlassEffectLight !== 'undefined') this.headerGlassEffectLight = !!parsed.headerGlassEffectLight;
                                if (typeof parsed.headerGlassEffectDark !== 'undefined') this.headerGlassEffectDark = !!parsed.headerGlassEffectDark;
                                if (typeof parsed.headerGlassEffect !== 'undefined' && typeof parsed.headerGlassEffectLight === 'undefined') {
                                    this.headerGlassEffectLight = !!parsed.headerGlassEffect;
                                    this.headerGlassEffectDark = !!parsed.headerGlassEffect;
                                }

                                // Nav
                                if (parsed.navStyleLight) this.navStyleLight = parsed.navStyleLight;
                                if (parsed.navStyleDark) this.navStyleDark = parsed.navStyleDark;
                                if (parsed.navStyle && !parsed.navStyleLight) {
                                    this.navStyleLight = parsed.navStyle;
                                    this.navStyleDark = parsed.navStyle;
                                }

                                if (parsed.navDensityLight) this.navDensityLight = parsed.navDensityLight;
                                if (parsed.navDensityDark) this.navDensityDark = parsed.navDensityDark;
                                if (parsed.navDensity && !parsed.navDensityLight) {
                                    this.navDensityLight = parsed.navDensity;
                                    this.navDensityDark = parsed.navDensity;
                                }

                                if (typeof parsed.navIndicatorLight !== 'undefined') this.navIndicatorLight = !!parsed.navIndicatorLight;
                                if (typeof parsed.navIndicatorDark !== 'undefined') this.navIndicatorDark = !!parsed.navIndicatorDark;
                                if (typeof parsed.navIndicator !== 'undefined' && typeof parsed.navIndicatorLight === 'undefined') {
                                    this.navIndicatorLight = !!parsed.navIndicator;
                                    this.navIndicatorDark = !!parsed.navIndicator;
                                }

                                if (parsed.navCustomActiveBgLight) this.navCustomActiveBgLight = parsed.navCustomActiveBgLight;
                                if (parsed.navCustomActiveBgDark) this.navCustomActiveBgDark = parsed.navCustomActiveBgDark;
                                if (parsed.navCustomActiveBg && !parsed.navCustomActiveBgLight) {
                                    this.navCustomActiveBgLight = parsed.navCustomActiveBg;
                                    this.navCustomActiveBgDark = parsed.navCustomActiveBg;
                                }

                                if (parsed.navCustomActiveFgLight) this.navCustomActiveFgLight = parsed.navCustomActiveFgLight;
                                if (parsed.navCustomActiveFgDark) this.navCustomActiveFgDark = parsed.navCustomActiveFgDark;
                                if (parsed.navCustomActiveFg && !parsed.navCustomActiveFgLight) {
                                    this.navCustomActiveFgLight = parsed.navCustomActiveFg;
                                    this.navCustomActiveFgDark = parsed.navCustomActiveFg;
                                }

                                if (parsed.navCustomIndicatorLight) this.navCustomIndicatorLight = parsed.navCustomIndicatorLight;
                                if (parsed.navCustomIndicatorDark) this.navCustomIndicatorDark = parsed.navCustomIndicatorDark;
                                if (parsed.navCustomIndicator && !parsed.navCustomIndicatorLight) {
                                    this.navCustomIndicatorLight = parsed.navCustomIndicator;
                                    this.navCustomIndicatorDark = parsed.navCustomIndicator;
                                }

                                // Global
                                if (parsed.selectedSemantic) this.selectedSemantic = parsed.selectedSemantic;
                                if (parsed.selectedChartPreset) this.selectedChartPreset = parsed.selectedChartPreset;
                                if (parsed.selectedRadius) this.selectedRadius = parsed.selectedRadius;
                                if (parsed.selectedFontName) this.selectedFontName = parsed.selectedFontName;
                                if (parsed.selectedFontValue) this.selectedFontValue = parsed.selectedFontValue;
                                if (parsed.tablesView) this.tablesView = parsed.tablesView;

                                // Table
                                if (parsed.tableStyleLight) this.tableStyleLight = parsed.tableStyleLight;
                                if (parsed.tableStyleDark) this.tableStyleDark = parsed.tableStyleDark;
                                if (parsed.tableStyle && !parsed.tableStyleLight) {
                                    this.tableStyleLight = parsed.tableStyle;
                                    this.tableStyleDark = parsed.tableStyle;
                                }
                                if (parsed.tableCustomHeaderBgLight) this.tableCustomHeaderBgLight = parsed.tableCustomHeaderBgLight;
                                if (parsed.tableCustomHeaderBgDark) this.tableCustomHeaderBgDark = parsed.tableCustomHeaderBgDark;
                                if (parsed.tableCustomBorderLight) this.tableCustomBorderLight = parsed.tableCustomBorderLight;
                                if (parsed.tableCustomBorderDark) this.tableCustomBorderDark = parsed.tableCustomBorderDark;
                                if (parsed.tableCustomRowHoverLight) this.tableCustomRowHoverLight = parsed.tableCustomRowHoverLight;
                                if (parsed.tableCustomRowHoverDark) this.tableCustomRowHoverDark = parsed.tableCustomRowHoverDark;
                                if (typeof parsed.reduceMotion !== 'undefined') {
                                    this.reduceMotion = !!parsed.reduceMotion;
                                    this.motionActive = !this.reduceMotion;
                                }
                                if (typeof parsed.glassEffect !== 'undefined') this.glassEffect = !!parsed.glassEffect;
                            }
                        } catch (e) {}

                        this.syncActiveModeValues();

                        const shouldBeDark = this.mode === 'dark' || (this.mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
                        if (document.documentElement.classList.contains('dark') !== shouldBeDark) {
                            if (window.VibeTheme?.applyTheme) {
                                window.VibeTheme.applyTheme(this.mode);
                            } else {
                                document.documentElement.classList.toggle('dark', shouldBeDark);
                            }
                        }

                        // Listen for system theme changes
                        const mediaDark = window.matchMedia('(prefers-color-scheme: dark)');
                        if (mediaDark.addEventListener) {
                            mediaDark.addEventListener('change', () => {
                                if (this.mode === 'system') {
                                    this.updateIsDarkNow();
                                    this.syncActiveModeValues();
                                    this.applyTheme();
                                }
                            });
                        }

                        window.addEventListener('vibe-theme-changed', (e) => {
                            if (e.detail && e.detail.mode && e.detail.mode !== this.mode) {
                                this.mode = e.detail.mode;
                                this.updateIsDarkNow();
                                this.syncActiveModeValues();
                                this.applyTheme();
                            }
                        });

                        this.applyTheme();
                    },

                    selectPrimaryColor(hex) {
                        this.customHex = hex;
                        this.customHexInput = hex.replace('#', '').toUpperCase();
                        this.updateMonoChart(hex);
                        this.applyTheme();
                        this.notify('color_changed', 'Custom primary color diubah ke ' + hex, { hex });
                    },

                    selectBrandColor(hex) {
                        this.selectPrimaryColor(hex);
                    },

                    onHexInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.customHexInput = clean.toUpperCase();
                        if (clean.length === 6) {
                            this.customHex = '#' + clean.toLowerCase();
                            this.updateMonoChart(this.customHex);
                            this.applyTheme();
                        } else if (clean.length === 3) {
                            const expanded = clean[0] + clean[0] + clean[1] + clean[1] + clean[2] + clean[2];
                            this.customHex = '#' + expanded.toLowerCase();
                            this.updateMonoChart(this.customHex);
                            this.applyTheme();
                        }
                    },

                    onColorPickerChange(val) {
                        this.customHex = val.toLowerCase();
                        this.customHexInput = val.replace('#', '').toUpperCase();
                        this.updateMonoChart(val);
                        this.applyTheme();
                    },

                    // Surface Selection
                    selectSurfacePreset(id) {
                        if (this.isDarkNow) {
                            this.selectedSurfaceDark = id;
                        } else {
                            this.selectedSurfaceLight = id;
                        }
                        this.selectedSurface = id;
                        this.applyTheme();
                        const modeText = this.isDarkNow ? this.t('mode_dark', 'Mode Gelap') : this.t('mode_light', 'Mode Terang');
                        this.notify('surface_updated', `Kanvas permukaan (${modeText}) diperbarui.`, { mode: modeText });
                    },

                    // Sidebar Methods
                    selectSidebarStyle(id) {
                        if (this.isDarkNow) {
                            this.sidebarStyleDark = id;
                        } else {
                            this.sidebarStyleLight = id;
                        }
                        this.sidebarStyle = id;
                        this.applyTheme();
                        const modeText = this.isDarkNow ? this.t('mode_dark', 'Mode Gelap') : this.t('mode_light', 'Mode Terang');
                        const styleName = this.styleNames?.[id] || id;
                        this.notify('sidebar_style', `Gaya bilah sisi (${modeText}): ${styleName}`, { mode: modeText, style: styleName });
                    },

                    selectSidebarBorderMode(mode) {
                        if (this.isDarkNow) {
                            this.sidebarBorderModeDark = mode;
                        } else {
                            this.sidebarBorderModeLight = mode;
                        }
                        this.sidebarBorderMode = mode;
                        this.applyTheme();
                        const modeText = this.isDarkNow ? this.t('mode_dark', 'Mode Gelap') : this.t('mode_light', 'Mode Terang');
                        this.notify('sidebar_border', `Batas border sidebar (${modeText}): ${mode}`, { mode: modeText, mode_name: mode });
                    },

                    onSidebarCustomBgChange(val) {
                        if (this.isDarkNow) {
                            this.sidebarCustomBgDark = val;
                        } else {
                            this.sidebarCustomBgLight = val;
                        }
                        this.sidebarCustomBg = val;
                        this.sidebarCustomBgInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onSidebarCustomBgInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.sidebarCustomBgInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.sidebarCustomBgDark = hex;
                            } else {
                                this.sidebarCustomBgLight = hex;
                            }
                            this.sidebarCustomBg = hex;
                            this.applyTheme();
                        }
                    },

                    onSidebarCustomBorderChange(val) {
                        if (this.isDarkNow) {
                            this.sidebarCustomBorderDark = val;
                        } else {
                            this.sidebarCustomBorderLight = val;
                        }
                        this.sidebarCustomBorder = val;
                        this.sidebarCustomBorderInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onSidebarCustomBorderInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.sidebarCustomBorderInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.sidebarCustomBorderDark = hex;
                            } else {
                                this.sidebarCustomBorderLight = hex;
                            }
                            this.sidebarCustomBorder = hex;
                            this.applyTheme();
                        }
                    },

                    toggleTransparentSidebar() {
                        const next = !this.transparentSidebar;
                        if (this.isDarkNow) {
                            this.transparentSidebarDark = next;
                        } else {
                            this.transparentSidebarLight = next;
                        }
                        this.transparentSidebar = next;
                        this.applyTheme();
                        const modeText = this.isDarkNow ? this.t('mode_dark', 'Mode Gelap') : this.t('mode_light', 'Mode Terang');
                        this.notify(this.transparentSidebar ? 'sidebar_transparent_on' : 'sidebar_transparent_off', this.transparentSidebar ? `Sidebar transparan (${modeText}) aktif.` : `Sidebar solid (${modeText}) aktif.`, { mode: modeText });
                    },

                    selectSidebarFeature(name) {
                        this.sidebarFeature = name;
                        this.saveState();
                        this.notify('sidebar_feature', 'Sidebar feature: ' + name, { name });
                    },

                    sidebarFeatureBadgeColor(name) {
                        const item = this.sidebarFeatures.find(f => f.name === name);
                        return item ? item.color : 'bg-emerald-500';
                    },

                    // Header Methods
                    selectHeaderStyle(id) {
                        if (this.isDarkNow) {
                            this.headerStyleDark = id;
                        } else {
                            this.headerStyleLight = id;
                        }
                        this.headerStyle = id;
                        this.applyTheme();
                        const modeText = this.isDarkNow ? this.t('mode_dark', 'Mode Gelap') : this.t('mode_light', 'Mode Terang');
                        const styleName = this.styleNames?.[id] || id;
                        this.notify('header_style', `Gaya bilah atas (${modeText}): ${styleName}`, { mode: modeText, style: styleName });
                    },

                    selectHeaderBorderMode(mode) {
                        if (this.isDarkNow) {
                            this.headerBorderModeDark = mode;
                        } else {
                            this.headerBorderModeLight = mode;
                        }
                        this.headerBorderMode = mode;
                        this.applyTheme();
                        const modeText = this.isDarkNow ? this.t('mode_dark', 'Mode Gelap') : this.t('mode_light', 'Mode Terang');
                        this.notify('header_border', `Batas border header (${modeText}): ${mode}`, { mode: modeText, mode_name: mode });
                    },

                    toggleHeaderGlassEffect(val) {
                        const next = typeof val !== 'undefined' ? !!val : !this.headerGlassEffect;
                        if (this.isDarkNow) {
                            this.headerGlassEffectDark = next;
                        } else {
                            this.headerGlassEffectLight = next;
                        }
                        this.headerGlassEffect = next;
                        this.applyTheme();
                        const modeText = this.isDarkNow ? this.t('mode_dark', 'Mode Gelap') : this.t('mode_light', 'Mode Terang');
                        this.notify(this.headerGlassEffect ? 'header_glass_on' : 'header_glass_off', this.headerGlassEffect ? `Header glassmorphism (${modeText}) aktif.` : `Header glassmorphism (${modeText}) nonaktif.`, { mode: modeText });
                    },

                    onHeaderCustomBgChange(val) {
                        if (this.isDarkNow) {
                            this.headerCustomBgDark = val;
                        } else {
                            this.headerCustomBgLight = val;
                        }
                        this.headerCustomBg = val;
                        this.headerCustomBgInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onHeaderCustomBgInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.headerCustomBgInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.headerCustomBgDark = hex;
                            } else {
                                this.headerCustomBgLight = hex;
                            }
                            this.headerCustomBg = hex;
                            this.applyTheme();
                        }
                    },

                    onHeaderCustomBorderChange(val) {
                        if (this.isDarkNow) {
                            this.headerCustomBorderDark = val;
                        } else {
                            this.headerCustomBorderLight = val;
                        }
                        this.headerCustomBorder = val;
                        this.headerCustomBorderInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onHeaderCustomBorderInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.headerCustomBorderInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.headerCustomBorderDark = hex;
                            } else {
                                this.headerCustomBorderLight = hex;
                            }
                            this.headerCustomBorder = hex;
                            this.applyTheme();
                        }
                    },

                    // Nav Methods
                    selectNavStyle(id) {
                        if (this.isDarkNow) {
                            this.navStyleDark = id;
                        } else {
                            this.navStyleLight = id;
                        }
                        this.navStyle = id;
                        this.applyTheme();
                        const modeText = this.isDarkNow ? this.t('mode_dark', 'Mode Gelap') : this.t('mode_light', 'Mode Terang');
                        const styleName = this.styleNames?.[id] || id;
                        this.notify('nav_style', `Gaya item navigasi (${modeText}): ${styleName}`, { mode: modeText, style: styleName });
                    },

                    selectNavDensity(density) {
                        if (this.isDarkNow) {
                            this.navDensityDark = density;
                        } else {
                            this.navDensityLight = density;
                        }
                        this.navDensity = density;
                        this.applyTheme();
                        const modeText = this.isDarkNow ? this.t('mode_dark', 'Mode Gelap') : this.t('mode_light', 'Mode Terang');
                        this.notify('nav_density', `Kerapatan navigasi (${modeText}): ${density}`, { mode: modeText, density });
                    },

                    toggleNavIndicator(val) {
                        const next = typeof val !== 'undefined' ? !!val : !this.navIndicator;
                        if (this.isDarkNow) {
                            this.navIndicatorDark = next;
                        } else {
                            this.navIndicatorLight = next;
                        }
                        this.navIndicator = next;
                        this.applyTheme();
                        const modeText = this.isDarkNow ? this.t('mode_dark', 'Mode Gelap') : this.t('mode_light', 'Mode Terang');
                        this.notify(this.navIndicator ? 'nav_indicator_on' : 'nav_indicator_off', this.navIndicator ? `Garis indikator (${modeText}) aktif.` : `Garis indikator (${modeText}) nonaktif.`, { mode: modeText });
                    },

                    onNavCustomActiveBgChange(val) {
                        if (this.isDarkNow) {
                            this.navCustomActiveBgDark = val;
                        } else {
                            this.navCustomActiveBgLight = val;
                        }
                        this.navCustomActiveBg = val;
                        this.navCustomActiveBgInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onNavCustomActiveBgInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.navCustomActiveBgInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.navCustomActiveBgDark = hex;
                            } else {
                                this.navCustomActiveBgLight = hex;
                            }
                            this.navCustomActiveBg = hex;
                            this.applyTheme();
                        }
                    },

                    onNavCustomActiveFgChange(val) {
                        if (this.isDarkNow) {
                            this.navCustomActiveFgDark = val;
                        } else {
                            this.navCustomActiveFgLight = val;
                        }
                        this.navCustomActiveFg = val;
                        this.navCustomActiveFgInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onNavCustomActiveFgInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.navCustomActiveFgInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.navCustomActiveFgDark = hex;
                            } else {
                                this.navCustomActiveFgLight = hex;
                            }
                            this.navCustomActiveFg = hex;
                            this.applyTheme();
                        }
                    },

                    onNavCustomIndicatorChange(val) {
                        if (this.isDarkNow) {
                            this.navCustomIndicatorDark = val;
                        } else {
                            this.navCustomIndicatorLight = val;
                        }
                        this.navCustomIndicator = val;
                        this.navCustomIndicatorInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onNavCustomIndicatorInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.navCustomIndicatorInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.navCustomIndicatorDark = hex;
                            } else {
                                this.navCustomIndicatorLight = hex;
                            }
                            this.navCustomIndicator = hex;
                            this.applyTheme();
                        }
                    },

                    getPreviewNavActiveBg() {
                        const surfaceLight = this.surfacePresets.find(s => s.id === this.selectedSurfaceLight) || this.surfacePresets[0];
                        const surfaceDark = this.surfacePresets.find(s => s.id === this.selectedSurfaceDark) || this.surfacePresets[0];
                        const sb = this.getResolvedSidebarColors(surfaceLight, surfaceDark);
                        const nav = this.getResolvedNavColors(surfaceLight, surfaceDark, sb);
                        return this.isDarkNow ? nav.dark.activeBg : nav.light.activeBg;
                    },

                    getPreviewNavActiveFg() {
                        const surfaceLight = this.surfacePresets.find(s => s.id === this.selectedSurfaceLight) || this.surfacePresets[0];
                        const surfaceDark = this.surfacePresets.find(s => s.id === this.selectedSurfaceDark) || this.surfacePresets[0];
                        const sb = this.getResolvedSidebarColors(surfaceLight, surfaceDark);
                        const nav = this.getResolvedNavColors(surfaceLight, surfaceDark, sb);
                        return this.isDarkNow ? nav.dark.activeFg : nav.light.activeFg;
                    },

                    getPreviewNavIndicator() {
                        const surfaceLight = this.surfacePresets.find(s => s.id === this.selectedSurfaceLight) || this.surfacePresets[0];
                        const surfaceDark = this.surfacePresets.find(s => s.id === this.selectedSurfaceDark) || this.surfacePresets[0];
                        const sb = this.getResolvedSidebarColors(surfaceLight, surfaceDark);
                        const nav = this.getResolvedNavColors(surfaceLight, surfaceDark, sb);
                        return this.isDarkNow ? nav.dark.indicator : nav.light.indicator;
                    },

                    updateMonoChart(hex) {
                        const mono = this.chartPresets.find(c => c.id === 'mono');
                        if (mono) {
                            mono.colors = [hex, hex + 'dd', hex + 'aa', hex + '77', hex + '44'];
                        }
                    },

                    setMode(newMode, event = null) {
                        this.mode = newMode;
                        this.updateIsDarkNow();
                        this.syncActiveModeValues();
                        if (window.VibeTheme) {
                            window.VibeTheme.setMode(newMode, event);
                        } else {
                            const isDark = newMode === 'dark' || (newMode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
                            document.documentElement.classList.toggle('dark', isDark);
                        }
                        this.applyTheme();
                        this.notify('theme_mode', 'Mode tema diubah ke ' + newMode, { mode: newMode });
                    },

                    toggleHighContrast(val) {
                        this.highContrast = typeof val !== 'undefined' ? !!val : !this.highContrast;
                        this.applyTheme();
                        this.notify(this.highContrast ? 'high_contrast_on' : 'high_contrast_off', this.highContrast ? 'Kontras tinggi aktif.' : 'Kontras standar.');
                    },

                    selectSemanticPreset(id) {
                        this.selectedSemantic = id;
                        this.applyTheme();
                        this.notify('semantic_updated', 'Palet status diperbarui.');
                    },

                    selectChartPreset(id) {
                        this.selectedChartPreset = id;
                        this.applyTheme();
                        this.notify('chart_updated', 'Palet grafik diperbarui.');
                    },

                    selectRadius(val) {
                        this.selectedRadius = val;
                        this.applyTheme();
                        this.notify('radius_updated', 'Border radius: ' + val, { val });
                    },

                    selectFont(name, val) {
                        this.selectedFontName = name;
                        this.selectedFontValue = val;
                        this.applyTheme();
                        this.notify('font_updated', 'Font: ' + name, { name });
                    },

                    setTablesView(view) {
                        this.tablesView = view;
                        this.applyTheme();
                        this.notify('table_view', 'Tampilan tabel: ' + view, { view });
                    },

                    selectTableStyle(id) {
                        if (this.isDarkNow) {
                            this.tableStyleDark = id;
                        } else {
                            this.tableStyleLight = id;
                        }
                        this.tableStyle = id;
                        this.applyTheme();
                        const modeText = this.isDarkNow ? this.t('mode_dark', 'Mode Gelap') : this.t('mode_light', 'Mode Terang');
                        const styleName = this.styleNames?.[id] || id;
                        this.notify('table_style', `Gaya tabel (${modeText}): ${styleName}`, { mode: modeText, style: styleName });
                    },

                    onTableCustomHeaderBgChange(val) {
                        if (this.isDarkNow) {
                            this.tableCustomHeaderBgDark = val;
                        } else {
                            this.tableCustomHeaderBgLight = val;
                        }
                        this.tableCustomHeaderBg = val;
                        this.tableCustomHeaderBgInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onTableCustomHeaderBgInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.tableCustomHeaderBgInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.tableCustomHeaderBgDark = hex;
                            } else {
                                this.tableCustomHeaderBgLight = hex;
                            }
                            this.tableCustomHeaderBg = hex;
                            this.applyTheme();
                        }
                    },

                    onTableCustomBorderChange(val) {
                        if (this.isDarkNow) {
                            this.tableCustomBorderDark = val;
                        } else {
                            this.tableCustomBorderLight = val;
                        }
                        this.tableCustomBorder = val;
                        this.tableCustomBorderInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onTableCustomBorderInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.tableCustomBorderInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.tableCustomBorderDark = hex;
                            } else {
                                this.tableCustomBorderLight = hex;
                            }
                            this.tableCustomBorder = hex;
                            this.applyTheme();
                        }
                    },

                    onTableCustomRowHoverChange(val) {
                        if (this.isDarkNow) {
                            this.tableCustomRowHoverDark = val;
                        } else {
                            this.tableCustomRowHoverLight = val;
                        }
                        this.tableCustomRowHover = val;
                        this.tableCustomRowHoverInput = val.replace('#', '').toUpperCase();
                        this.applyTheme();
                    },

                    onTableCustomRowHoverInput(val) {
                        let clean = val.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6);
                        this.tableCustomRowHoverInput = clean.toUpperCase();
                        if (clean.length === 6 || clean.length === 3) {
                            const hex = '#' + clean;
                            if (this.isDarkNow) {
                                this.tableCustomRowHoverDark = hex;
                            } else {
                                this.tableCustomRowHoverLight = hex;
                            }
                            this.tableCustomRowHover = hex;
                            this.applyTheme();
                        }
                    },

                    toggleMotion(val) {
                        if (typeof val !== 'undefined') {
                            this.motionActive = !!val;
                        } else {
                            this.motionActive = !this.motionActive;
                        }
                        this.reduceMotion = !this.motionActive;
                        this.applyTheme();
                        this.notify(this.reduceMotion ? 'reduced_motion_on' : 'reduced_motion_off', this.reduceMotion ? 'Reduced motion aktif.' : 'Animasi halus aktif.');
                    },

                    toggleGlassEffect(val) {
                        this.glassEffect = typeof val !== 'undefined' ? !!val : !this.glassEffect;
                        this.applyTheme();
                        this.notify(this.glassEffect ? 'glassmorphism_on' : 'glassmorphism_off', this.glassEffect ? 'Glassmorphism aktif.' : 'Glassmorphism nonaktif.');
                    },

                    resetToDefault() {
                        this.mode = 'system';
                        this.updateIsDarkNow();
                        this.customHex = '#18181b';
                        this.customHexInput = '18181B';
                        this.highContrast = false;
                        this.motionActive = true;

                        // Reset Surface
                        this.selectedSurfaceLight = 'zinc';
                        this.selectedSurfaceDark = 'zinc';

                        // Reset Sidebar
                        this.sidebarStyleLight = 'default';
                        this.sidebarStyleDark = 'default';
                        this.sidebarCustomBgLight = '#ffffff';
                        this.sidebarCustomBgDark = '#121312';
                        this.sidebarCustomBorderLight = '#e5e6e5';
                        this.sidebarCustomBorderDark = '#262726';
                        this.sidebarBorderModeLight = 'default';
                        this.sidebarBorderModeDark = 'default';
                        this.transparentSidebarLight = false;
                        this.transparentSidebarDark = false;
                        this.sidebarFeature = 'Recent changes';

                        // Reset Header
                        this.headerStyleLight = 'default';
                        this.headerStyleDark = 'default';
                        this.headerCustomBgLight = '#ffffff';
                        this.headerCustomBgDark = '#121312';
                        this.headerCustomBorderLight = '#e5e6e5';
                        this.headerCustomBorderDark = '#262726';
                        this.headerBorderModeLight = 'default';
                        this.headerBorderModeDark = 'default';
                        this.headerGlassEffectLight = true;
                        this.headerGlassEffectDark = true;

                        // Reset Table
                        this.tableStyleLight = 'default';
                        this.tableStyleDark = 'default';
                        this.tableCustomHeaderBgLight = '#f4f4f5';
                        this.tableCustomHeaderBgDark = '#18181b';
                        this.tableCustomBorderLight = '#e4e4e7';
                        this.tableCustomBorderDark = '#27272a';
                        this.tableCustomRowHoverLight = '#f9f9fa';
                        this.tableCustomRowHoverDark = '#1c1c20';

                        // Reset Nav
                        this.navStyleLight = 'harmony';
                        this.navStyleDark = 'harmony';
                        this.navDensityLight = 'default';
                        this.navDensityDark = 'default';
                        this.navIndicatorLight = false;
                        this.navIndicatorDark = false;
                        this.navCustomActiveBgLight = '#f4f5f5';
                        this.navCustomActiveBgDark = '#1e1f1e';
                        this.navCustomActiveFgLight = '#0a0b0a';
                        this.navCustomActiveFgDark = '#f9fafa';
                        this.navCustomIndicatorLight = '#18181b';
                        this.navCustomIndicatorDark = '#f9fafa';

                        this.selectedSemantic = 'vibrant';
                        this.selectedChartPreset = 'rainbow';
                        this.selectedRadius = '0.5rem';
                        this.selectedFontName = 'Figtree';
                        this.selectedFontValue = "'Figtree', ui-sans-serif, system-ui, sans-serif";
                        this.tablesView = 'default';
                        this.reduceMotion = false;
                        this.glassEffect = true;

                        this.syncActiveModeValues();

                        const root = document.documentElement;
                        root.style.removeProperty('--primary');
                        root.style.removeProperty('--color-primary');
                        root.style.removeProperty('--ring');
                        root.style.removeProperty('--color-ring');
                        root.style.removeProperty('--primary-foreground');
                        root.style.removeProperty('--color-primary-foreground');
                        root.style.removeProperty('--nav-active-bg');
                        root.style.removeProperty('--nav-active-fg');
                        root.style.removeProperty('--nav-hover-bg');
                        root.style.removeProperty('--nav-hover-fg');
                        root.style.removeProperty('--nav-indicator');
                        root.style.removeProperty('--color-nav-active-bg');
                        root.style.removeProperty('--color-nav-active-fg');
                        root.style.removeProperty('--color-nav-hover-bg');
                        root.style.removeProperty('--color-nav-hover-fg');
                        root.style.removeProperty('--color-nav-indicator');
                        root.style.removeProperty('--background');
                        root.style.removeProperty('--card');
                        root.style.removeProperty('--popover');
                        root.style.removeProperty('--container');
                        root.style.removeProperty('--sidebar');
                        root.style.removeProperty('--header');

                        if (window.VibeTheme?.clearCssOverride) {
                            window.VibeTheme.clearCssOverride();
                        }
                        const overrideEl = document.getElementById(styleId);
                        if (overrideEl) {
                            overrideEl.textContent = '';
                        }
                        try {
                            localStorage.removeItem(themeKey);
                        } catch (e) {}

                        this.setMode('system');
                        this.applyTheme();
                        this.notify('reset_all', 'Semua token tema di-reset ke nilai bawaan.');
                    },

                    isLight(hex) {
                        if (!hex) return true;
                        let c = hex.replace('#', '');
                        if (c.length === 3) c = c[0] + c[0] + c[1] + c[1] + c[2] + c[2];
                        if (c.length < 6) return true;
                        const r = parseInt(c.substring(0, 2), 16) || 0;
                        const g = parseInt(c.substring(2, 4), 16) || 0;
                        const b = parseInt(c.substring(4, 6), 16) || 0;
                        return ((r * 299) + (g * 587) + (b * 114)) / 1000 > 128;
                    },

                    getResolvedSidebarColors(surfaceLight, surfaceDark) {
                        let lightBg = surfaceLight.light.sidebar;
                        let darkBg = surfaceDark.dark.sidebar;
                        let lightBorder = this.highContrast ? '#a1a1aa' : surfaceLight.light.border;
                        let darkBorder = this.highContrast ? '#3f3f46' : surfaceDark.dark.border;

                        if (this.sidebarStyleLight === 'card') {
                            lightBg = surfaceLight.light.card;
                        } else if (this.sidebarStyleLight === 'contrast') {
                            lightBg = '#ffffff';
                        } else if (this.sidebarStyleLight === 'muted') {
                            lightBg = '#f4f5f5';
                        } else if (this.sidebarStyleLight === 'dark') {
                            lightBg = '#121312';
                            lightBorder = '#262726';
                        } else if (this.sidebarStyleLight === 'custom') {
                            lightBg = this.sidebarCustomBgLight;
                            lightBorder = this.sidebarCustomBorderLight;
                        }

                        if (this.sidebarBorderModeLight === 'none') {
                            lightBorder = 'transparent';
                        } else if (this.sidebarBorderModeLight === 'high') {
                            lightBorder = '#a1a1aa';
                        }

                        if (this.sidebarStyleDark === 'card') {
                            darkBg = surfaceDark.dark.card;
                        } else if (this.sidebarStyleDark === 'contrast') {
                            darkBg = '#0a0b0a';
                        } else if (this.sidebarStyleDark === 'muted') {
                            darkBg = '#181918';
                        } else if (this.sidebarStyleDark === 'dark') {
                            darkBg = '#121312';
                            darkBorder = '#262726';
                        } else if (this.sidebarStyleDark === 'custom') {
                            darkBg = this.sidebarCustomBgDark;
                            darkBorder = this.sidebarCustomBorderDark;
                        }

                        if (this.sidebarBorderModeDark === 'none') {
                            darkBorder = 'transparent';
                        } else if (this.sidebarBorderModeDark === 'high') {
                            darkBorder = '#3f3f46';
                        }

                        const lightFg = this.isLight(lightBg) ? '#0a0b0a' : '#f9fafa';
                        const darkFg = this.isLight(darkBg) ? '#0a0b0a' : '#f9fafa';

                        return {
                            light: { bg: lightBg, fg: lightFg, border: lightBorder },
                            dark: { bg: darkBg, fg: darkFg, border: darkBorder }
                        };
                    },

                    getResolvedHeaderColors(surfaceLight, surfaceDark) {
                        let lightBg = surfaceLight.light.header;
                        let darkBg = surfaceDark.dark.header;
                        let lightBorder = this.highContrast ? '#a1a1aa' : surfaceLight.light.border;
                        let darkBorder = this.highContrast ? '#3f3f46' : surfaceDark.dark.border;

                        if (this.headerStyleLight === 'card') {
                            lightBg = surfaceLight.light.card;
                        } else if (this.headerStyleLight === 'glass') {
                            lightBg = 'rgba(255, 255, 255, 0.82)';
                        } else if (this.headerStyleLight === 'contrast') {
                            lightBg = '#ffffff';
                        } else if (this.headerStyleLight === 'muted') {
                            lightBg = '#f4f5f5';
                        } else if (this.headerStyleLight === 'dark') {
                            lightBg = '#121312';
                            lightBorder = '#262726';
                        } else if (this.headerStyleLight === 'custom') {
                            lightBg = this.headerCustomBgLight;
                            lightBorder = this.headerCustomBorderLight;
                        }

                        if (this.headerBorderModeLight === 'none') {
                            lightBorder = 'transparent';
                        } else if (this.headerBorderModeLight === 'high') {
                            lightBorder = '#71717a';
                        }

                        if (this.headerStyleDark === 'card') {
                            darkBg = surfaceDark.dark.card;
                        } else if (this.headerStyleDark === 'glass') {
                            darkBg = 'rgba(18, 19, 18, 0.82)';
                        } else if (this.headerStyleDark === 'contrast') {
                            darkBg = '#0a0b0a';
                        } else if (this.headerStyleDark === 'muted') {
                            darkBg = '#181918';
                        } else if (this.headerStyleDark === 'dark') {
                            darkBg = '#121312';
                            darkBorder = '#262726';
                        } else if (this.headerStyleDark === 'custom') {
                            darkBg = this.headerCustomBgDark;
                            darkBorder = this.headerCustomBorderDark;
                        }

                        if (this.headerBorderModeDark === 'none') {
                            darkBorder = 'transparent';
                        } else if (this.headerBorderModeDark === 'high') {
                            darkBorder = '#a1a1aa';
                        }

                        const lightFg = this.isLight(lightBg) ? '#0a0b0a' : '#f9fafa';
                        const darkFg = this.isLight(darkBg) ? '#0a0b0a' : '#f9fafa';

                        return {
                            light: { bg: lightBg, fg: lightFg, border: lightBorder },
                            dark: { bg: darkBg, fg: darkFg, border: darkBorder }
                        };
                    },

                    getResolvedTableColors(surfaceLight, surfaceDark) {
                        let lightHeaderBg = '#f4f4f5';
                        let darkHeaderBg = '#18181b';
                        let lightBorder = this.highContrast ? '#a1a1aa' : surfaceLight.light.border;
                        let darkBorder = this.highContrast ? '#3f3f46' : surfaceDark.dark.border;
                        let lightHover = '#f9f9fa';
                        let darkHover = '#1c1c20';

                        if (this.tableStyleLight === 'card') {
                            lightHeaderBg = surfaceLight.light.card;
                        } else if (this.tableStyleLight === 'contrast') {
                            lightHeaderBg = '#e4e4e7';
                        } else if (this.tableStyleLight === 'muted') {
                            lightHeaderBg = '#f4f5f5';
                        } else if (this.tableStyleLight === 'dark') {
                            lightHeaderBg = '#121312';
                            lightBorder = '#262726';
                        } else if (this.tableStyleLight === 'custom') {
                            lightHeaderBg = this.tableCustomHeaderBgLight;
                            lightBorder = this.tableCustomBorderLight;
                            lightHover = this.tableCustomRowHoverLight;
                        }

                        if (this.tableStyleDark === 'card') {
                            darkHeaderBg = surfaceDark.dark.card;
                        } else if (this.tableStyleDark === 'contrast') {
                            darkHeaderBg = '#0a0b0a';
                        } else if (this.tableStyleDark === 'muted') {
                            darkHeaderBg = '#181918';
                        } else if (this.tableStyleDark === 'dark') {
                            darkHeaderBg = '#121312';
                            darkBorder = '#262726';
                        } else if (this.tableStyleDark === 'custom') {
                            darkHeaderBg = this.tableCustomHeaderBgDark;
                            darkBorder = this.tableCustomBorderDark;
                            darkHover = this.tableCustomRowHoverDark;
                        }

                        const lightFg = this.isLight(lightHeaderBg) ? '#71717a' : '#d4d4d8';
                        const darkFg = this.isLight(darkHeaderBg) ? '#71717a' : '#a1a1aa';

                        return {
                            light: { headerBg: lightHeaderBg, fg: lightFg, border: lightBorder, hover: lightHover },
                            dark: { headerBg: darkHeaderBg, fg: darkFg, border: darkBorder, hover: darkHover }
                        };
                    },

                    getResolvedNavColors(surfaceLight, surfaceDark, sb) {
                        let lightActiveBg = '#f4f5f5';
                        let darkActiveBg = '#1e1f1e';
                        let lightActiveFg = '#0a0b0a';
                        let darkActiveFg = '#f9fafa';
                        let lightHoverBg = '#f4f5f5';
                        let darkHoverBg = '#1e1f1e';
                        let lightHoverFg = '#0a0b0a';
                        let darkHoverFg = '#f9fafa';
                        let lightIndicator = this.customHex;
                        let darkIndicator = this.customHex;

                        if (this.navStyleLight === 'primary') {
                            lightActiveBg = this.customHex;
                            lightActiveFg = this.isLight(this.customHex) ? '#0a0b0a' : '#ffffff';
                            lightIndicator = this.customHex;
                        } else if (this.navStyleLight === 'line') {
                            lightActiveBg = 'transparent';
                            lightActiveFg = sb.light.fg;
                            lightIndicator = this.customHex;
                        } else if (this.navStyleLight === 'subtle') {
                            lightActiveBg = '#f4f5f5';
                            lightActiveFg = '#0a0b0a';
                            lightIndicator = this.customHex;
                        } else if (this.navStyleLight === 'custom') {
                            lightActiveBg = this.navCustomActiveBgLight;
                            lightActiveFg = this.navCustomActiveFgLight;
                            lightHoverBg = this.navCustomActiveBgLight;
                            lightHoverFg = this.navCustomActiveFgLight;
                            lightIndicator = this.navCustomIndicatorLight;
                        } else {
                            if (this.sidebarStyleLight === 'custom') {
                                const isSidebarLight = this.isLight(this.sidebarCustomBgLight);
                                lightActiveBg = isSidebarLight ? 'rgba(0, 0, 0, 0.06)' : 'rgba(255, 255, 255, 0.12)';
                                lightActiveFg = isSidebarLight ? '#0a0b0a' : '#ffffff';
                                lightHoverBg = isSidebarLight ? 'rgba(0, 0, 0, 0.04)' : 'rgba(255, 255, 255, 0.08)';
                                lightHoverFg = lightActiveFg;
                            } else {
                                lightActiveBg = '#f4f5f5';
                                lightActiveFg = '#0a0b0a';
                                lightHoverBg = '#f4f5f5';
                                lightHoverFg = '#0a0b0a';
                            }
                            lightIndicator = this.customHex;
                        }

                        if (this.navStyleDark === 'primary') {
                            darkActiveBg = this.customHex;
                            darkActiveFg = this.isLight(this.customHex) ? '#0a0b0a' : '#ffffff';
                            darkIndicator = this.customHex;
                        } else if (this.navStyleDark === 'line') {
                            darkActiveBg = 'transparent';
                            darkActiveFg = sb.dark.fg;
                            darkIndicator = this.customHex;
                        } else if (this.navStyleDark === 'subtle') {
                            darkActiveBg = '#181918';
                            darkActiveFg = '#f9fafa';
                            darkIndicator = this.customHex;
                        } else if (this.navStyleDark === 'custom') {
                            darkActiveBg = this.navCustomActiveBgDark;
                            darkActiveFg = this.navCustomActiveFgDark;
                            darkHoverBg = this.navCustomActiveBgDark;
                            darkHoverFg = this.navCustomActiveFgDark;
                            darkIndicator = this.navCustomIndicatorDark;
                        } else {
                            if (this.sidebarStyleDark === 'custom') {
                                const isSidebarLight = this.isLight(this.sidebarCustomBgDark);
                                darkActiveBg = isSidebarLight ? 'rgba(0, 0, 0, 0.06)' : 'rgba(255, 255, 255, 0.12)';
                                darkActiveFg = isSidebarLight ? '#0a0b0a' : '#ffffff';
                                darkHoverBg = isSidebarLight ? 'rgba(0, 0, 0, 0.04)' : 'rgba(255, 255, 255, 0.08)';
                                darkHoverFg = darkActiveFg;
                            } else {
                                darkActiveBg = '#1e1f1e';
                                darkActiveFg = '#f9fafa';
                                darkHoverBg = '#1e1f1e';
                                darkHoverFg = '#f9fafa';
                            }
                            darkIndicator = this.customHex;
                        }

                        return {
                            light: {
                                activeBg: lightActiveBg,
                                activeFg: lightActiveFg,
                                hoverBg: lightHoverBg,
                                hoverFg: lightHoverFg,
                                indicator: lightIndicator
                            },
                            dark: {
                                activeBg: darkActiveBg,
                                activeFg: darkActiveFg,
                                hoverBg: darkHoverBg,
                                hoverFg: darkHoverFg,
                                indicator: darkIndicator
                            }
                        };
                    },

                    applyTheme() {
                        const isDefaultSlate = (this.customHex.toLowerCase() === '#18181b' || this.customHex.toLowerCase() === '#0a0b0a');
                        const lightPrimary = isDefaultSlate ? '#0a0b0a' : this.customHex;
                        const lightFg = this.isLight(lightPrimary) ? '#0a0b0a' : '#ffffff';
                        const darkPrimary = isDefaultSlate ? '#f9fafa' : this.customHex;
                        const darkFg = this.isLight(darkPrimary) ? '#0a0b0a' : '#ffffff';

                        const r = this.selectedRadius;
                        const surfaceLight = this.surfacePresets.find(s => s.id === this.selectedSurfaceLight) || this.surfacePresets[0];
                        const surfaceDark = this.surfacePresets.find(s => s.id === this.selectedSurfaceDark) || this.surfacePresets[0];

                        const semantic = this.semanticPresets.find(s => s.id === this.selectedSemantic) || this.semanticPresets[0];
                        const chart = this.chartPresets.find(c => c.id === this.selectedChartPreset) || this.chartPresets[0];

                        const sb = this.getResolvedSidebarColors(surfaceLight, surfaceDark);
                        const hd = this.getResolvedHeaderColors(surfaceLight, surfaceDark);
                        const nav = this.getResolvedNavColors(surfaceLight, surfaceDark, sb);
                        const tbl = this.getResolvedTableColors(surfaceLight, surfaceDark);

                        // Hapus inline style dari documentElement agar stylesheet berperan sebagai single source of truth
                        const root = document.documentElement;
                        root.style.removeProperty('--primary');
                        root.style.removeProperty('--color-primary');
                        root.style.removeProperty('--ring');
                        root.style.removeProperty('--color-ring');
                        root.style.removeProperty('--primary-foreground');
                        root.style.removeProperty('--color-primary-foreground');
                        root.style.removeProperty('--nav-active-bg');
                        root.style.removeProperty('--nav-active-fg');
                        root.style.removeProperty('--nav-hover-bg');
                        root.style.removeProperty('--nav-hover-fg');
                        root.style.removeProperty('--nav-indicator');
                        root.style.removeProperty('--color-nav-active-bg');
                        root.style.removeProperty('--color-nav-active-fg');
                        root.style.removeProperty('--color-nav-hover-bg');
                        root.style.removeProperty('--color-nav-hover-fg');
                        root.style.removeProperty('--color-nav-indicator');
                        root.style.removeProperty('--background');
                        root.style.removeProperty('--card');
                        root.style.removeProperty('--popover');
                        root.style.removeProperty('--container');
                        root.style.removeProperty('--sidebar');
                        root.style.removeProperty('--header');
                        root.style.removeProperty('--table-header');
                        root.style.removeProperty('--table-header-foreground');
                        root.style.removeProperty('--table-border');
                        root.style.removeProperty('--table-row-hover');
                        root.style.removeProperty('--color-table-header');
                        root.style.removeProperty('--color-table-header-foreground');
                        root.style.removeProperty('--color-table-border');
                        root.style.removeProperty('--color-table-row-hover');

                        let css = `
                            :root, html, body, [data-canvas-theme] {
                                --font-sans: ${this.selectedFontValue} !important;
                                font-family: ${this.selectedFontValue} !important;
                                --radius: ${r} !important;
                                --radius-xs: calc(${r} * 0.3) !important;
                                --radius-sm: calc(${r} * 0.5) !important;
                                --radius-md: calc(${r} * 0.75) !important;
                                --radius-lg: ${r} !important;
                                --radius-xl: calc(${r} * 1.25) !important;
                                --radius-2xl: calc(${r} * 1.5) !important;
                                --radius-3xl: calc(${r} * 2) !important;

                                --success: ${semantic.colors.success} !important;
                                --warning: ${semantic.colors.warning} !important;
                                --destructive: ${semantic.colors.destructive} !important;
                                --info: ${semantic.colors.info} !important;

                                --chart-1: ${chart.colors[0]} !important;
                                --chart-2: ${chart.colors[1]} !important;
                                --chart-3: ${chart.colors[2]} !important;
                                --chart-4: ${chart.colors[3]} !important;
                                --chart-5: ${chart.colors[4]} !important;
                            }

                            :root:root, html:root:root, html:not(.dark), html.light, .light, [data-canvas-theme="light"] {
                                --primary: ${lightPrimary} !important;
                                --primary-foreground: ${lightFg} !important;
                                --ring: ${lightPrimary} !important;
                                --color-primary: ${lightPrimary} !important;
                                --color-primary-foreground: ${lightFg} !important;
                                --color-ring: ${lightPrimary} !important;

                                --background: ${surfaceLight.light.bg} !important;
                                --foreground: #0a0b0a !important;
                                --card: ${surfaceLight.light.card} !important;
                                --card-foreground: #0a0b0a !important;
                                --popover: ${surfaceLight.light.card} !important;
                                --popover-foreground: #0a0b0a !important;
                                --container: ${surfaceLight.light.card} !important;
                                --container-foreground: #0a0b0a !important;
                                --container-border: ${this.highContrast ? '#a1a1aa' : surfaceLight.light.border} !important;
                                --border: ${this.highContrast ? '#a1a1aa' : surfaceLight.light.border} !important;
                                --input: ${this.highContrast ? '#a1a1aa' : surfaceLight.light.border} !important;

                                --sidebar: ${sb.light.bg} !important;
                                --sidebar-foreground: ${sb.light.fg} !important;
                                --sidebar-border: ${sb.light.border} !important;
                                --color-sidebar: ${sb.light.bg} !important;
                                --color-sidebar-foreground: ${sb.light.fg} !important;
                                --color-sidebar-border: ${sb.light.border} !important;

                                --header: ${hd.light.bg} !important;
                                --header-foreground: ${hd.light.fg} !important;
                                --header-border: ${hd.light.border} !important;
                                --color-header: ${hd.light.bg} !important;
                                --color-header-foreground: ${hd.light.fg} !important;
                                --color-header-border: ${hd.light.border} !important;

                                --nav-active-bg: ${nav.light.activeBg} !important;
                                --nav-active-fg: ${nav.light.activeFg} !important;
                                --nav-hover-bg: ${nav.light.hoverBg} !important;
                                --nav-hover-fg: ${nav.light.hoverFg} !important;
                                --nav-indicator: ${nav.light.indicator} !important;
                                --color-nav-active-bg: ${nav.light.activeBg} !important;
                                --color-nav-active-fg: ${nav.light.activeFg} !important;
                                --color-nav-hover-bg: ${nav.light.hoverBg} !important;
                                --color-nav-hover-fg: ${nav.light.hoverFg} !important;
                                --color-nav-indicator: ${nav.light.indicator} !important;

                                --table-header: ${tbl.light.headerBg} !important;
                                --table-header-foreground: ${tbl.light.fg} !important;
                                --table-border: ${tbl.light.border} !important;
                                --table-row-hover: ${tbl.light.hover} !important;
                                --color-table-header: ${tbl.light.headerBg} !important;
                                --color-table-header-foreground: ${tbl.light.fg} !important;
                                --color-table-border: ${tbl.light.border} !important;
                                --color-table-row-hover: ${tbl.light.hover} !important;
                            }

                            html.dark:root:root, html.dark, .dark, [data-canvas-theme="dark"] {
                                --primary: ${darkPrimary} !important;
                                --primary-foreground: ${darkFg} !important;
                                --ring: ${darkPrimary} !important;
                                --color-primary: ${darkPrimary} !important;
                                --color-primary-foreground: ${darkFg} !important;
                                --color-ring: ${darkPrimary} !important;

                                --background: ${surfaceDark.dark.bg} !important;
                                --foreground: #f9fafa !important;
                                --card: ${surfaceDark.dark.card} !important;
                                --card-foreground: #f9fafa !important;
                                --popover: ${surfaceDark.dark.card} !important;
                                --popover-foreground: #f9fafa !important;
                                --container: ${surfaceDark.dark.card} !important;
                                --container-foreground: #f9fafa !important;
                                --container-border: ${this.highContrast ? '#3f3f46' : surfaceDark.dark.border} !important;
                                --border: ${this.highContrast ? '#3f3f46' : surfaceDark.dark.border} !important;
                                --input: ${this.highContrast ? '#3f3f46' : surfaceDark.dark.border} !important;

                                --sidebar: ${sb.dark.bg} !important;
                                --sidebar-foreground: ${sb.dark.fg} !important;
                                --sidebar-border: ${sb.dark.border} !important;
                                --color-sidebar: ${sb.dark.bg} !important;
                                --color-sidebar-foreground: ${sb.dark.fg} !important;
                                --color-sidebar-border: ${sb.dark.border} !important;

                                --header: ${hd.dark.bg} !important;
                                --header-foreground: ${hd.dark.fg} !important;
                                --header-border: ${hd.dark.border} !important;
                                --color-header: ${hd.dark.bg} !important;
                                --color-header-foreground: ${hd.dark.fg} !important;
                                --color-header-border: ${hd.dark.border} !important;

                                --nav-active-bg: ${nav.dark.activeBg} !important;
                                --nav-active-fg: ${nav.dark.activeFg} !important;
                                --nav-hover-bg: ${nav.dark.hoverBg} !important;
                                --nav-hover-fg: ${nav.dark.hoverFg} !important;
                                --nav-indicator: ${nav.dark.indicator} !important;
                                --color-nav-active-bg: ${nav.dark.activeBg} !important;
                                --color-nav-active-fg: ${nav.dark.activeFg} !important;
                                --color-nav-hover-bg: ${nav.dark.hoverBg} !important;
                                --color-nav-hover-fg: ${nav.dark.hoverFg} !important;
                                --color-nav-indicator: ${nav.dark.indicator} !important;

                                --table-header: ${tbl.dark.headerBg} !important;
                                --table-header-foreground: ${tbl.dark.fg} !important;
                                --table-border: ${tbl.dark.border} !important;
                                --table-row-hover: ${tbl.dark.hover} !important;
                                --color-table-header: ${tbl.dark.headerBg} !important;
                                --color-table-header-foreground: ${tbl.dark.fg} !important;
                                --color-table-border: ${tbl.dark.border} !important;
                                --color-table-row-hover: ${tbl.dark.hover} !important;
                            }

                            body {
                                font-family: ${this.selectedFontValue} !important;
                            }
                        `;

                        // Sidebar custom rules
                        if (this.transparentSidebarLight) {
                            css += `
                                html:not(.dark) aside, html:not(.dark) [data-vibe-sidebar], html:not(.dark) .vibe-sidebar, html:not(.dark) .sidebar {
                                    background-color: transparent !important;
                                    backdrop-filter: blur(10px) !important;
                                    -webkit-backdrop-filter: blur(10px) !important;
                                }
                            `;
                        }
                        if (this.transparentSidebarDark) {
                            css += `
                                html.dark aside, html.dark [data-vibe-sidebar], html.dark .vibe-sidebar, html.dark .sidebar {
                                    background-color: transparent !important;
                                    backdrop-filter: blur(10px) !important;
                                    -webkit-backdrop-filter: blur(10px) !important;
                                }
                            `;
                        }

                        // Header glassmorphism rules
                        if (this.headerGlassEffectLight) {
                            css += `
                                html:not(.dark) header, html:not(.dark) [data-vibe-header], html:not(.dark) .vibe-header {
                                    backdrop-filter: blur(12px) !important;
                                    -webkit-backdrop-filter: blur(12px) !important;
                                }
                            `;
                        } else {
                            css += `
                                html:not(.dark) header, html:not(.dark) [data-vibe-header], html:not(.dark) .vibe-header {
                                    backdrop-filter: none !important;
                                    -webkit-backdrop-filter: none !important;
                                }
                            `;
                        }

                        if (this.headerGlassEffectDark) {
                            css += `
                                html.dark header, html.dark [data-vibe-header], html.dark .vibe-header {
                                    backdrop-filter: blur(12px) !important;
                                    -webkit-backdrop-filter: blur(12px) !important;
                                }
                            `;
                        } else {
                            css += `
                                html.dark header, html.dark [data-vibe-header], html.dark .vibe-header {
                                    backdrop-filter: none !important;
                                    -webkit-backdrop-filter: none !important;
                                }
                            `;
                        }

                        // Navigation density rules
                        const activeNavDensity = this.isDarkNow ? this.navDensityDark : this.navDensityLight;
                        if (activeNavDensity === 'compact') {
                            css += `
                                nav [data-pin-type="item"], nav [data-pin-type="group"] [data-nav-group-trigger] {
                                    min-height: 2rem !important;
                                    padding-top: 0.35rem !important;
                                    padding-bottom: 0.35rem !important;
                                    font-size: 0.75rem !important;
                                }
                            `;
                        } else if (activeNavDensity === 'relaxed') {
                            css += `
                                nav [data-pin-type="item"], nav [data-pin-type="group"] [data-nav-group-trigger] {
                                    min-height: 2.5rem !important;
                                    padding-top: 0.6rem !important;
                                    padding-bottom: 0.6rem !important;
                                    font-size: 0.875rem !important;
                                }
                            `;
                        }

                        // Navigation indicator line rule
                        if (this.navIndicatorLight || this.navStyleLight === 'line') {
                            css += `
                                html:not(.dark) nav [data-pin-type="item"].nav-item-active,
                                html:not(.dark) nav [data-pin-type="group"] [data-nav-group-trigger].nav-item-active,
                                html:not(.dark) [data-pin-type="item"].nav-item-active {
                                    position: relative !important;
                                }
                                html:not(.dark) nav [data-pin-type="item"].nav-item-active::before,
                                html:not(.dark) nav [data-pin-type="group"] [data-nav-group-trigger].nav-item-active::before,
                                html:not(.dark) [data-pin-type="item"].nav-item-active::before {
                                    content: "" !important;
                                    position: absolute !important;
                                    left: 0 !important;
                                    top: 0.375rem !important;
                                    bottom: 0.375rem !important;
                                    width: 0.25rem !important;
                                    border-top-right-radius: 0.25rem !important;
                                    border-bottom-right-radius: 0.25rem !important;
                                    background-color: var(--nav-indicator) !important;
                                }
                            `;
                        }

                        if (this.navIndicatorDark || this.navStyleDark === 'line') {
                            css += `
                                html.dark nav [data-pin-type="item"].nav-item-active,
                                html.dark nav [data-pin-type="group"] [data-nav-group-trigger].nav-item-active,
                                html.dark [data-pin-type="item"].nav-item-active {
                                    position: relative !important;
                                }
                                html.dark nav [data-pin-type="item"].nav-item-active::before,
                                html.dark nav [data-pin-type="group"] [data-nav-group-trigger].nav-item-active::before,
                                html.dark [data-pin-type="item"].nav-item-active::before {
                                    content: "" !important;
                                    position: absolute !important;
                                    left: 0 !important;
                                    top: 0.375rem !important;
                                    bottom: 0.375rem !important;
                                    width: 0.25rem !important;
                                    border-top-right-radius: 0.25rem !important;
                                    border-bottom-right-radius: 0.25rem !important;
                                    background-color: var(--nav-indicator) !important;
                                }
                            `;
                        }

                        // Table compact density
                        if (this.tablesView === 'compact') {
                            css += `
                                table td, table th {
                                    padding-top: 0.35rem !important;
                                    padding-bottom: 0.35rem !important;
                                }
                            `;
                        }

                        // Reduced motion
                        if (this.reduceMotion) {
                            css += `
                                *, *::before, *::after {
                                    animation-duration: 0.01ms !important;
                                    animation-iteration-count: 1 !important;
                                    transition-duration: 0.01ms !important;
                                }
                            `;
                        }

                        // Global Glassmorphism toggle
                        if (!this.glassEffect) {
                            css += `
                                [class*="backdrop-blur"] {
                                    backdrop-filter: none !important;
                                    -webkit-backdrop-filter: none !important;
                                }
                            `;
                        }

                        let styleEl = document.getElementById(styleId);
                        if (!styleEl) {
                            styleEl = document.createElement('style');
                            styleEl.id = styleId;
                            styleEl.setAttribute('data-navigate-once', 'true');
                            document.head.appendChild(styleEl);
                        }
                        styleEl.textContent = css;
                        document.head.appendChild(styleEl);

                        // Sinkronkan ke ThemeManager agar persisten lintas navigasi
                        if (window.VibeTheme && typeof window.VibeTheme.setCssOverride === 'function') {
                            window.VibeTheme.setCssOverride(css, {
                                customHex: this.customHex,
                                sidebarStyle: this.sidebarStyle,
                                headerStyle: this.headerStyle,
                                navStyle: this.navStyle,
                                navDensity: this.navDensity,
                                navIndicator: this.navIndicator,
                                navCustomActiveBg: this.navCustomActiveBg,
                                navCustomActiveFg: this.navCustomActiveFg,
                                navCustomIndicator: this.navCustomIndicator,
                            });
                        }

                        this.saveState();
                    },

                    generateCssText() {
                        const isDefaultSlate = (this.customHex.toLowerCase() === '#18181b' || this.customHex.toLowerCase() === '#0a0b0a');
                        const lightPrimary = isDefaultSlate ? '#0a0b0a' : this.customHex;
                        const lightFg = this.isLight(lightPrimary) ? '#0a0b0a' : '#ffffff';
                        const darkPrimary = isDefaultSlate ? '#f9fafa' : this.customHex;
                        const darkFg = this.isLight(darkPrimary) ? '#0a0b0a' : '#ffffff';

                        const r = this.selectedRadius;
                        const surfaceLight = this.surfacePresets.find(s => s.id === this.selectedSurfaceLight) || this.surfacePresets[0];
                        const surfaceDark = this.surfacePresets.find(s => s.id === this.selectedSurfaceDark) || this.surfacePresets[0];
                        const semantic = this.semanticPresets.find(s => s.id === this.selectedSemantic) || this.semanticPresets[0];
                        const chart = this.chartPresets.find(c => c.id === this.selectedChartPreset) || this.chartPresets[0];

                        const sb = this.getResolvedSidebarColors(surfaceLight, surfaceDark);
                        const hd = this.getResolvedHeaderColors(surfaceLight, surfaceDark);
                        const nav = this.getResolvedNavColors(surfaceLight, surfaceDark, sb);
                        const tbl = this.getResolvedTableColors(surfaceLight, surfaceDark);

                        return `:root {
    --primary: ${lightPrimary};
    --primary-foreground: ${lightFg};
    --ring: ${lightPrimary};
    --color-primary: ${lightPrimary};
    --color-primary-foreground: ${lightFg};
    --color-ring: ${lightPrimary};
    --font-sans: ${this.selectedFontValue};
    --radius: ${r};
    --success: ${semantic.colors.success};
    --warning: ${semantic.colors.warning};
    --destructive: ${semantic.colors.destructive};
    --info: ${semantic.colors.info};
    --chart-1: ${chart.colors[0]};
    --chart-2: ${chart.colors[1]};
    --chart-3: ${chart.colors[2]};
    --chart-4: ${chart.colors[3]};
    --chart-5: ${chart.colors[4]};
}

:root, html:not(.dark), .light {
    --background: ${surfaceLight.light.bg};
    --foreground: #0a0b0a;
    --card: ${surfaceLight.light.card};
    --card-foreground: #0a0b0a;
    --popover: ${surfaceLight.light.card};
    --popover-foreground: #0a0b0a;
    --container: ${surfaceLight.light.card};
    --container-foreground: #0a0b0a;
    --border: ${this.highContrast ? '#a1a1aa' : surfaceLight.light.border};
    --input: ${this.highContrast ? '#a1a1aa' : surfaceLight.light.border};
    --primary: ${lightPrimary};
    --primary-foreground: ${lightFg};
    --ring: ${lightPrimary};
    --color-primary: ${lightPrimary};
    --color-primary-foreground: ${lightFg};
    --color-ring: ${lightPrimary};
    --sidebar: ${sb.light.bg};
    --sidebar-foreground: ${sb.light.fg};
    --sidebar-border: ${sb.light.border};
    --header: ${hd.light.bg};
    --header-foreground: ${hd.light.fg};
    --header-border: ${hd.light.border};
    --nav-active-bg: ${nav.light.activeBg};
    --nav-active-fg: ${nav.light.activeFg};
    --nav-hover-bg: ${nav.light.hoverBg};
    --nav-hover-fg: ${nav.light.hoverFg};
    --nav-indicator: ${nav.light.indicator};
    --table-header: ${tbl.light.headerBg};
    --table-header-foreground: ${tbl.light.fg};
    --table-border: ${tbl.light.border};
    --table-row-hover: ${tbl.light.hover};
}

html.dark, .dark {
    --background: ${surfaceDark.dark.bg};
    --foreground: #f9fafa;
    --card: ${surfaceDark.dark.card};
    --card-foreground: #f9fafa;
    --popover: ${surfaceDark.dark.card};
    --popover-foreground: #f9fafa;
    --container: ${surfaceDark.dark.card};
    --container-foreground: #f9fafa;
    --border: ${this.highContrast ? '#3f3f46' : surfaceDark.dark.border};
    --input: ${this.highContrast ? '#3f3f46' : surfaceDark.dark.border};
    --primary: ${darkPrimary};
    --primary-foreground: ${darkFg};
    --ring: ${darkPrimary};
    --color-primary: ${darkPrimary};
    --color-primary-foreground: ${darkFg};
    --color-ring: ${darkPrimary};
    --sidebar: ${sb.dark.bg};
    --sidebar-foreground: ${sb.dark.fg};
    --sidebar-border: ${sb.dark.border};
    --header: ${hd.dark.bg};
    --header-foreground: ${hd.dark.fg};
    --header-border: ${hd.dark.border};
    --nav-active-bg: ${nav.dark.activeBg};
    --nav-active-fg: ${nav.dark.activeFg};
    --nav-hover-bg: ${nav.dark.hoverBg};
    --nav-hover-fg: ${nav.dark.hoverFg};
    --nav-indicator: ${nav.dark.indicator};
    --table-header: ${tbl.dark.headerBg};
    --table-header-foreground: ${tbl.dark.fg};
    --table-border: ${tbl.dark.border};
    --table-row-hover: ${tbl.dark.hover};
}`;
                    },

                    copyCssVariables() {
                        const css = this.generateCssText();
                        navigator.clipboard?.writeText(css).then(() => {
                            this.copied = true;
                            this.notify('css_copied', 'Design tokens CSS berhasil disalin ke clipboard!', {}, 'success', this.t('css_copied_title', 'CSS Disalin'));
                            setTimeout(() => this.copied = false, 2500);
                        }).catch(() => {
                            this.notify('css_copy_failed', 'Gagal menyalin CSS tokens.', {}, 'destructive');
                        });
                    },

                    saveState() {
                        try {
                            localStorage.setItem(themeKey, JSON.stringify({
                                mode: this.mode,
                                customHex: this.customHex,
                                highContrast: this.highContrast,

                                selectedSurface: this.selectedSurface,
                                selectedSurfaceLight: this.selectedSurfaceLight,
                                selectedSurfaceDark: this.selectedSurfaceDark,

                                sidebarStyle: this.sidebarStyle,
                                sidebarStyleLight: this.sidebarStyleLight,
                                sidebarStyleDark: this.sidebarStyleDark,
                                sidebarCustomBg: this.sidebarCustomBg,
                                sidebarCustomBgLight: this.sidebarCustomBgLight,
                                sidebarCustomBgDark: this.sidebarCustomBgDark,
                                sidebarCustomBorder: this.sidebarCustomBorder,
                                sidebarCustomBorderLight: this.sidebarCustomBorderLight,
                                sidebarCustomBorderDark: this.sidebarCustomBorderDark,
                                sidebarBorderMode: this.sidebarBorderMode,
                                sidebarBorderModeLight: this.sidebarBorderModeLight,
                                sidebarBorderModeDark: this.sidebarBorderModeDark,
                                transparentSidebar: this.transparentSidebar,
                                transparentSidebarLight: this.transparentSidebarLight,
                                transparentSidebarDark: this.transparentSidebarDark,
                                sidebarFeature: this.sidebarFeature,

                                headerStyle: this.headerStyle,
                                headerStyleLight: this.headerStyleLight,
                                headerStyleDark: this.headerStyleDark,
                                headerCustomBg: this.headerCustomBg,
                                headerCustomBgLight: this.headerCustomBgLight,
                                headerCustomBgDark: this.headerCustomBgDark,
                                headerCustomBorder: this.headerCustomBorder,
                                headerCustomBorderLight: this.headerCustomBorderLight,
                                headerCustomBorderDark: this.headerCustomBorderDark,
                                headerBorderMode: this.headerBorderMode,
                                headerBorderModeLight: this.headerBorderModeLight,
                                headerBorderModeDark: this.headerBorderModeDark,
                                headerGlassEffect: this.headerGlassEffect,
                                headerGlassEffectLight: this.headerGlassEffectLight,
                                headerGlassEffectDark: this.headerGlassEffectDark,

                                navStyle: this.navStyle,
                                navStyleLight: this.navStyleLight,
                                navStyleDark: this.navStyleDark,
                                navDensity: this.navDensity,
                                navDensityLight: this.navDensityLight,
                                navDensityDark: this.navDensityDark,
                                navIndicator: this.navIndicator,
                                navIndicatorLight: this.navIndicatorLight,
                                navIndicatorDark: this.navIndicatorDark,
                                navCustomActiveBg: this.navCustomActiveBg,
                                navCustomActiveBgLight: this.navCustomActiveBgLight,
                                navCustomActiveBgDark: this.navCustomActiveBgDark,
                                navCustomActiveFg: this.navCustomActiveFg,
                                navCustomActiveFgLight: this.navCustomActiveFgLight,
                                navCustomActiveFgDark: this.navCustomActiveFgDark,
                                navCustomIndicator: this.navCustomIndicator,
                                navCustomIndicatorLight: this.navCustomIndicatorLight,
                                navCustomIndicatorDark: this.navCustomIndicatorDark,

                                selectedSemantic: this.selectedSemantic,
                                selectedChartPreset: this.selectedChartPreset,
                                selectedRadius: this.selectedRadius,
                                selectedFontName: this.selectedFontName,
                                selectedFontValue: this.selectedFontValue,
                                tablesView: this.tablesView,

                                tableStyle: this.tableStyle,
                                tableStyleLight: this.tableStyleLight,
                                tableStyleDark: this.tableStyleDark,
                                tableCustomHeaderBg: this.tableCustomHeaderBg,
                                tableCustomHeaderBgLight: this.tableCustomHeaderBgLight,
                                tableCustomHeaderBgDark: this.tableCustomHeaderBgDark,
                                tableCustomBorder: this.tableCustomBorder,
                                tableCustomBorderLight: this.tableCustomBorderLight,
                                tableCustomBorderDark: this.tableCustomBorderDark,
                                tableCustomRowHover: this.tableCustomRowHover,
                                tableCustomRowHoverLight: this.tableCustomRowHoverLight,
                                tableCustomRowHoverDark: this.tableCustomRowHoverDark,

                                reduceMotion: this.reduceMotion,
                                glassEffect: this.glassEffect,
                            }));
                        } catch (e) {}
                    },

                    t(key, fallback, replacements = {}) {
                        let msg = (this.i18n && this.i18n[key]) ? this.i18n[key] : fallback;
                        for (const [k, v] of Object.entries(replacements)) {
                            msg = msg.replace(`:${k}`, v);
                        }
                        return msg;
                    },

                    notify(keyOrText, fallback = '', replacements = {}, type = 'info', title = null) {
                        if (window.vibeToast) {
                            let text = keyOrText;
                            if (this.i18n && this.i18n[keyOrText]) {
                                text = this.i18n[keyOrText];
                                for (const [k, v] of Object.entries(replacements)) {
                                    text = text.replace(`:${k}`, v);
                                }
                            } else if (fallback) {
                                text = fallback;
                                for (const [k, v] of Object.entries(replacements)) {
                                    text = text.replace(`:${k}`, v);
                                }
                            }
                            const resolvedTitle = title || (this.i18n?.toast_title || 'Appearance & Tokens');
                            window.vibeToast(text, { type: type || 'info', title: resolvedTitle });
                        }
                    },

                    // Compatibility methods for index.blade.php
                    selectPreset(key) {
                        this.selectedPreset = key;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    applyCustomHex(hex) {
                        this.selectedPreset = 'custom';
                        this.customHex = hex;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    selectRadius(value) {
                        this.selectedRadius = value;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    selectFont(value, name) {
                        this.selectedFontValue = value;
                        this.selectedFontName = name;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    isLightColor(hex) {
                        if (!hex) return true;
                        let c = hex.replace('#', '');
                        if (c.length === 3) c = c[0] + c[0] + c[1] + c[1] + c[2] + c[2];
                        if (c.length < 6) return true;
                        const r = parseInt(c.substring(0, 2), 16) || 0;
                        const g = parseInt(c.substring(2, 4), 16) || 0;
                        const b = parseInt(c.substring(4, 6), 16) || 0;
                        return ((r * 299) + (g * 587) + (b * 114)) / 1000 > 128;
                    },

                    getActiveColorName() {
                        if (this.selectedPreset === 'custom') return this.customHex;
                        return this.presets[this.selectedPreset]?.name || 'Zinc';
                    },

                    getActiveColors() {
                        if (this.selectedPreset === 'custom') {
                            return {
                                light: this.customHex,
                                lightFg: '#ffffff',
                                dark: this.customHex,
                                darkFg: '#ffffff'
                            };
                        }
                        return this.presets[this.selectedPreset] || this.presets.zinc;
                    },

                    getActivePrimaryColor() {
                        if (this.selectedPreset === 'custom') return this.customHex;
                        return this.presets[this.selectedPreset]?.color || '#0a0b0a';
                    },

                    getActivePrimaryFg() {
                        if (this.selectedPreset === 'custom') {
                            return this.isLightColor(this.customHex) ? '#0a0b0a' : '#ffffff';
                        }
                        const p = this.presets[this.selectedPreset] || this.presets.zinc;
                        return (this.mode === 'dark') ? p.darkFg : p.lightFg;
                    },

                    getActiveSidebarName() {
                        if (this.selectedSidebarPreset === 'custom') return this.customSidebarBg;
                        return this.sidebarPresets[this.selectedSidebarPreset]?.name || 'Default';
                    },

                    getActiveHeaderName() {
                        if (this.selectedHeaderPreset === 'custom') return this.customHeaderBg;
                        return this.headerPresets[this.selectedHeaderPreset]?.name || 'Default';
                    },

                    getSidebarColors() {
                        if (this.selectedSidebarPreset === 'custom') {
                            const isLight = this.isLightColor(this.customSidebarBg);
                            const autoFg = isLight ? '#0a0b0a' : '#f9fafa';
                            const autoBorder = isLight ? '#e5e6e5' : '#262726';
                            const autoAccent = isLight ? '#f4f5f5' : '#1e1f1e';
                            const fg = this.customSidebarFg || autoFg;
                            const border = this.customSidebarBorder || autoBorder;
                            return {
                                light: {
                                    bg: this.customSidebarBg,
                                    fg: fg,
                                    border: border,
                                    accent: autoAccent,
                                    accentFg: fg
                                },
                                dark: {
                                    bg: this.customSidebarBg,
                                    fg: fg,
                                    border: border,
                                    accent: autoAccent,
                                    accentFg: fg
                                }
                            };
                        }
                        return this.sidebarPresets[this.selectedSidebarPreset] || this.sidebarPresets.default;
                    },

                    getActiveSidebarBg() {
                        const s = this.getSidebarColors();
                        return (this.mode === 'dark') ? s.dark.bg : s.light.bg;
                    },

                    getActiveSidebarFg() {
                        const s = this.getSidebarColors();
                        return (this.mode === 'dark') ? s.dark.fg : s.light.fg;
                    },

                    getActiveSidebarBorder() {
                        const s = this.getSidebarColors();
                        return (this.mode === 'dark') ? s.dark.border : s.light.border;
                    },

                    getHeaderColors() {
                        if (this.selectedHeaderPreset === 'custom') {
                            const isLight = this.isLightColor(this.customHeaderBg);
                            const autoFg = isLight ? '#0a0b0a' : '#f9fafa';
                            const autoBorder = isLight ? '#e5e6e5' : '#262726';
                            const autoAccent = isLight ? '#f4f5f5' : '#1e1f1e';
                            const fg = this.customHeaderFg || autoFg;
                            const border = this.customHeaderBorder || autoBorder;
                            return {
                                light: {
                                    bg: this.customHeaderBg,
                                    fg: fg,
                                    border: border,
                                    accent: autoAccent,
                                    accentFg: fg
                                },
                                dark: {
                                    bg: this.customHeaderBg,
                                    fg: fg,
                                    border: border,
                                    accent: autoAccent,
                                    accentFg: fg
                                }
                            };
                        }
                        return this.headerPresets[this.selectedHeaderPreset] || this.headerPresets.default;
                    },

                    getActiveHeaderBg() {
                        const h = this.getHeaderColors();
                        return (this.mode === 'dark') ? h.dark.bg : h.light.bg;
                    },

                    getActiveHeaderFg() {
                        const h = this.getHeaderColors();
                        return (this.mode === 'dark') ? h.dark.fg : h.light.fg;
                    },

                    getActiveHeaderBorder() {
                        const h = this.getHeaderColors();
                        return (this.mode === 'dark') ? h.dark.border : h.light.border;
                    },

                    selectSidebarPreset(key) {
                        this.selectedSidebarPreset = key;
                        if (key !== 'custom') {
                            const preset = this.sidebarPresets[key];
                            const active = this.mode === 'dark' ? preset.dark : preset.light;
                            this.customSidebarBg = active.bg;
                            this.customSidebarFg = active.fg;
                            this.customSidebarBorder = active.border;
                        }
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    applyCustomSidebarBg(val) {
                        this.selectedSidebarPreset = 'custom';
                        this.customSidebarBg = val;
                        const isLight = this.isLightColor(val);
                        this.customSidebarFg = isLight ? '#0a0b0a' : '#f9fafa';
                        this.customSidebarBorder = isLight ? '#e5e6e5' : '#262726';
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    applyCustomSidebarFg(val) {
                        this.selectedSidebarPreset = 'custom';
                        this.customSidebarFg = val;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    applyCustomSidebarBorder(val) {
                        this.selectedSidebarPreset = 'custom';
                        this.customSidebarBorder = val;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    autoAdjustSidebarColors() {
                        const isLight = this.isLightColor(this.customSidebarBg);
                        this.customSidebarFg = isLight ? '#0a0b0a' : '#f9fafa';
                        this.customSidebarBorder = isLight ? '#e5e6e5' : '#262726';
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                        this.notify('sidebar_contrast', 'Kontras warna sidebar berhasil disesuaikan secara otomatis.', {}, 'info', this.t('auto_contrast_title', 'Auto Kontras'));
                    },

                    selectHeaderPreset(key) {
                        this.selectedHeaderPreset = key;
                        if (key !== 'custom') {
                            const preset = this.headerPresets[key];
                            const active = this.mode === 'dark' ? preset.dark : preset.light;
                            this.customHeaderBg = active.bg;
                            this.customHeaderFg = active.fg;
                            this.customHeaderBorder = active.border;
                        }
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    applyCustomHeaderBg(val) {
                        this.selectedHeaderPreset = 'custom';
                        this.customHeaderBg = val;
                        const isLight = this.isLightColor(val);
                        this.customHeaderFg = isLight ? '#0a0b0a' : '#f9fafa';
                        this.customHeaderBorder = isLight ? '#e5e6e5' : '#262726';
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    applyCustomHeaderFg(val) {
                        this.selectedHeaderPreset = 'custom';
                        this.customHeaderFg = val;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    applyCustomHeaderBorder(val) {
                        this.selectedHeaderPreset = 'custom';
                        this.customHeaderBorder = val;
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                    },

                    autoAdjustHeaderColors() {
                        const isLight = this.isLightColor(this.customHeaderBg);
                        this.customHeaderFg = isLight ? '#0a0b0a' : '#f9fafa';
                        this.customHeaderBorder = isLight ? '#e5e6e5' : '#262726';
                        this.updateGeneratedCss();
                        this.injectOverrideCss();
                        this.notify('header_contrast', 'Kontras warna header berhasil disesuaikan secara otomatis.', {}, 'info', this.t('auto_contrast_title', 'Auto Kontras'));
                    },

                    updateGeneratedCss() {
                        const colors = this.getActiveColors();
                        const radius = this.selectedRadius;
                        const font = this.selectedFontValue;
                        const sidebar = this.getSidebarColors();
                        const header = this.getHeaderColors();

                        const radiusRules = radius === '0rem' ? `
    --radius: 0rem !important;
    --radius-xs: 0rem !important;
    --radius-sm: 0rem !important;
    --radius-md: 0rem !important;
    --radius-lg: 0rem !important;
    --radius-xl: 0rem !important;
    --radius-2xl: 0rem !important;
    --radius-3xl: 0rem !important;
` : `
    --radius: ${radius} !important;
    --radius-xs: calc(${radius} * 0.3) !important;
    --radius-sm: calc(${radius} * 0.5) !important;
    --radius-md: calc(${radius} * 0.75) !important;
    --radius-lg: ${radius} !important;
    --radius-xl: calc(${radius} * 1.25) !important;
    --radius-2xl: calc(${radius} * 1.5) !important;
    --radius-3xl: calc(${radius} * 2) !important;
`;

                        this.generatedCss = `
:root:root,
html:root:root,
html.light:root,
html[data-canvas-theme="light"]:root,
html:not(#__vibe_shield__):root {
    --primary: ${colors.light} !important;
    --primary-foreground: ${colors.lightFg} !important;
    --ring: ${colors.light} !important;
    --font-sans: ${font} !important;
    font-family: ${font} !important;
    --sidebar: ${sidebar.light.bg} !important;
    --sidebar-foreground: ${sidebar.light.fg} !important;
    --sidebar-border: ${sidebar.light.border} !important;
    --sidebar-accent: ${sidebar.light.accent} !important;
    --sidebar-accent-foreground: ${sidebar.light.accentFg} !important;
    --header: ${header.light.bg} !important;
    --header-foreground: ${header.light.fg} !important;
    --header-border: ${header.light.border} !important;
    --header-accent: ${header.light.accent} !important;
    --header-accent-foreground: ${header.light.accentFg} !important;
${radiusRules}
}

html.dark:root:root,
html.dark[data-canvas-theme="dark"]:root,
html.dark:not(#__vibe_shield__):root {
    --primary: ${colors.dark} !important;
    --primary-foreground: ${colors.darkFg} !important;
    --ring: ${colors.dark} !important;
    --font-sans: ${font} !important;
    font-family: ${font} !important;
    --sidebar: ${sidebar.dark.bg} !important;
    --sidebar-foreground: ${sidebar.dark.fg} !important;
    --sidebar-border: ${sidebar.dark.border} !important;
    --sidebar-accent: ${sidebar.dark.accent} !important;
    --sidebar-accent-foreground: ${sidebar.dark.accentFg} !important;
    --header: ${header.dark.bg} !important;
    --header-foreground: ${header.dark.fg} !important;
    --header-border: ${header.dark.border} !important;
    --header-accent: ${header.dark.accent} !important;
    --header-accent-foreground: ${header.dark.accentFg} !important;
${radiusRules}
}

body {
    font-family: ${font} !important;
}`;
                    },

                    injectOverrideCss() {
                        if (window.VibeTheme?.applyComponentThemes) {
                            window.VibeTheme.applyComponentThemes({
                                css: this.generatedCss
                            });
                        } else {
                            let styleEl = document.getElementById(styleId);
                            if (!styleEl) {
                                styleEl = document.createElement('style');
                                styleEl.id = styleId;
                                styleEl.setAttribute('data-navigate-once', 'true');
                                document.head.appendChild(styleEl);
                            }
                            styleEl.textContent = this.generatedCss;
                        }
                    },

                    copyCss() {
                        if (navigator.clipboard && navigator.clipboard.writeText) {
                            navigator.clipboard.writeText(this.generatedCss).then(() => {
                                this.copied = true;
                                this.notify('css_copied', 'CSS Berhasil Disalin', {}, 'success', this.t('css_copied_title', 'CSS Disalin'));
                                setTimeout(() => {
                                    this.copied = false;
                                }, 2500);
                            });
                        }
                    },

                    savePreferences() {
                        const extraData = {
                            mode: this.mode,
                            preset: this.selectedPreset,
                            customHex: this.customHex,
                            radius: this.selectedRadius,
                            fontName: this.selectedFontName,
                            fontValue: this.selectedFontValue,
                            sidebarPreset: this.selectedSidebarPreset,
                            customSidebarBg: this.customSidebarBg,
                            customSidebarFg: this.customSidebarFg,
                            customSidebarBorder: this.customSidebarBorder,
                            headerPreset: this.selectedHeaderPreset,
                            customHeaderBg: this.customHeaderBg,
                            customHeaderFg: this.customHeaderFg,
                            customHeaderBorder: this.customHeaderBorder,
                        };

                        if (window.VibeTheme?.setCssOverride) {
                            window.VibeTheme.setCssOverride(this.generatedCss, extraData);
                        } else {
                            let currentConfig = {};
                            try {
                                const stored = localStorage.getItem(themeKey);
                                if (stored) currentConfig = JSON.parse(stored);
                            } catch (e) {}

                            Object.assign(currentConfig, extraData);
                            currentConfig.css = this.generatedCss;
                            localStorage.setItem(themeKey, JSON.stringify(currentConfig));
                        }

                        try {
                            localStorage.removeItem(prefix + '-app-css-overrides');
                        } catch (e) {}

                        this.notify('theme_saved', 'Preferensi tema berhasil disimpan.', {}, 'success', this.t('theme_saved_title', 'Tema Disimpan'));
                    },
};
            }

if (typeof window !== 'undefined') {
    window.appearanceController = appearanceController;
    if (window.Alpine) {
        window.Alpine.data('appearanceController', appearanceController);
    } else {
        document.addEventListener('alpine:init', () => {
            window.Alpine.data('appearanceController', appearanceController);
        });
    }
}
