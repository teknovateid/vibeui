import Chart from 'chart.js/auto';
import zoomPlugin from 'chartjs-plugin-zoom';
import '../../css/vibe/chart.css';

Chart.register(zoomPlugin);

// =========================================================================
// Defensive Lifecycle Patches for Chart.js in SPA / wire:navigate environments
// (Prevents "Cannot read properties of null (reading 'save')" when
// charts are unmounted, detached, or destroyed during page transitions)
// =========================================================================
const origDraw = Chart.prototype.draw;
Chart.prototype.draw = function() {
    if (!this.ctx || !this.canvas || !this.options || (typeof document !== 'undefined' && !document.body.contains(this.canvas))) {
        return;
    }
    try {
        return origDraw.apply(this, arguments);
    } catch (err) {
        if (err instanceof TypeError) {
            return;
        }
        throw err;
    }
};

const origRender = Chart.prototype.render;
Chart.prototype.render = function() {
    if (!this.ctx || !this.canvas || !this.options || (typeof document !== 'undefined' && !document.body.contains(this.canvas))) {
        return;
    }
    try {
        return origRender.apply(this, arguments);
    } catch (err) {
        if (err instanceof TypeError) {
            return;
        }
        throw err;
    }
};

const origUpdate = Chart.prototype.update;
Chart.prototype.update = function(mode) {
    if (!this.ctx || !this.canvas || (typeof document !== 'undefined' && !document.body.contains(this.canvas))) {
        return;
    }
    try {
        return origUpdate.apply(this, arguments);
    } catch (err) {
        if (err instanceof TypeError) {
            return;
        }
        throw err;
    }
};

const origClear = Chart.prototype.clear;
Chart.prototype.clear = function() {
    if (!this.ctx || !this.canvas || (typeof document !== 'undefined' && !document.body.contains(this.canvas))) {
        return this;
    }
    try {
        return origClear.apply(this, arguments);
    } catch (err) {
        if (err instanceof TypeError) {
            return this;
        }
        throw err;
    }
};

const origResize = Chart.prototype.resize;
Chart.prototype.resize = function(width, height) {
    if (!this.ctx || !this.canvas || !this.options || (typeof document !== 'undefined' && !document.body.contains(this.canvas))) {
        return;
    }
    try {
        return origResize.apply(this, arguments);
    } catch (err) {
        if (err instanceof TypeError) {
            return;
        }
        throw err;
    }
};

const origDestroy = Chart.prototype.destroy;
Chart.prototype.destroy = function() {
    if (!this.canvas && !this.ctx) {
        return;
    }
    try {
        return origDestroy.apply(this, arguments);
    } catch (err) {
        this.canvas = null;
        this.ctx = null;
        return;
    }
};

const origEventHandler = Chart.prototype._eventHandler;
Chart.prototype._eventHandler = function(e, replay) {
    if (!this.canvas || !this.ctx || !this.options || !Array.isArray(this.options.events)) {
        return this;
    }
    if (typeof document !== 'undefined' && !document.body.contains(this.canvas)) {
        return this;
    }
    try {
        return origEventHandler.apply(this, arguments);
    } catch (err) {
        return this;
    }
};

try {
    const categoryScale = Chart.registry.getScale('category');
    if (categoryScale) {
        const BaseScale = Object.getPrototypeOf(categoryScale.prototype);
        if (BaseScale) {
            const origDrawLabels = BaseScale.drawLabels;
            BaseScale.drawLabels = function(chartArea) {
                if (!this.ctx || (this.chart && (!this.chart.ctx || !this.chart.options || (this.chart.canvas && typeof document !== 'undefined' && !document.body.contains(this.chart.canvas))))) {
                    return;
                }
                try {
                    return origDrawLabels.apply(this, arguments);
                } catch (err) {
                    if (err instanceof TypeError) {
                        return;
                    }
                    throw err;
                }
            };

            const origScaleDraw = BaseScale.draw;
            BaseScale.draw = function(chartArea) {
                if (!this.ctx || (this.chart && (!this.chart.ctx || !this.chart.options || (this.chart.canvas && typeof document !== 'undefined' && !document.body.contains(this.chart.canvas))))) {
                    return;
                }
                try {
                    return origScaleDraw.apply(this, arguments);
                } catch (err) {
                    if (err instanceof TypeError) {
                        return;
                    }
                    throw err;
                }
            };
        }
    }
} catch (e) {
    // Non-critical
}

// Automatically clean up all chart instances when Livewire starts navigating away
if (typeof document !== 'undefined') {
    document.addEventListener('livewire:navigating', () => {
        if (window.Chart && window.Chart.instances) {
            Object.values(window.Chart.instances).forEach(chart => {
                try {
                    chart.destroy();
                } catch (e) {
                    // Ignore transient destruction error
                }
            });
        }
    });
}

window.Chart = Chart;

/**
 * Get computed style CSS variable value.
 */
function getCssVariable(name, fallback = '') {
    if (typeof window === 'undefined') return fallback;
    const style = window.getComputedStyle(document.documentElement);
    let val = style.getPropertyValue(name).trim();
    if (!val && name.startsWith('--color-')) {
        val = style.getPropertyValue(name.replace('--color-', '--')).trim();
    }
    return val || fallback;
}

/**
 * Check if the document is currently in dark mode.
 */
function isDarkMode() {
    if (typeof document === 'undefined') return false;
    return document.documentElement.classList.contains('dark') ||
           document.documentElement.getAttribute('data-canvas-theme') === 'dark';
}

/**
 * Convert hex color to rgba.
 */
function hexToRgba(hex, alpha = 1) {
    if (!hex || typeof hex !== 'string') return hex;
    hex = hex.replace('#', '');
    if (hex.length === 3) {
        hex = hex.split('').map(c => c + c).join('');
    }
    if (hex.length === 6) {
        const r = parseInt(hex.substring(0, 2), 16);
        const g = parseInt(hex.substring(2, 4), 16);
        const b = parseInt(hex.substring(4, 6), 16);
        return `rgba(${r}, ${g}, ${b}, ${alpha})`;
    }
    return hex;
}

/**
 * Resolves color tokens (e.g. 'primary', 'chart-1', 'info', 'primary/20')
 * from app.css CSS variables into browser-compatible color values.
 */
export function resolveColor(token, isDark = isDarkMode(), targetAlpha = null) {
    if (!token) return null;
    if (typeof token !== 'string') return token;

    token = token.trim();

    // Check for Tailwind-style slash opacity: e.g. 'chart-1/20' or '#38bdf8/50'
    if (token.includes('/') && !token.startsWith('rgba') && !token.startsWith('hsla')) {
        const [colorPart, alphaPart] = token.split('/');
        const parsedAlpha = parseFloat(alphaPart) / (parseFloat(alphaPart) > 1 ? 100 : 1);
        return resolveColor(colorPart, isDark, parsedAlpha);
    }

    let resolved = token;

    // Direct CSS variable syntax: var(--...)
    if (token.startsWith('var(')) {
        const varName = token.replace(/^var\(\s*/, '').replace(/\s*\)$/, '');
        resolved = getCssVariable(varName);
    } else {
        const tokenMap = {
            'primary': isDark ? getCssVariable('--primary', '#f9fafa') : getCssVariable('--primary', '#0a0b0a'),
            'primary-foreground': isDark ? '#0a0b0a' : '#f9fafa',
            'secondary': getCssVariable('--secondary', isDark ? '#262726' : '#f4f5f5'),
            'accent': getCssVariable('--accent', isDark ? '#262726' : '#e5e6e5'),
            'info': isDark ? '#38bdf8' : getCssVariable('--info', '#0ea5e9'),
            'success': isDark ? '#34d399' : getCssVariable('--success', '#10b981'),
            'warning': isDark ? '#fbbf24' : getCssVariable('--warning', '#f59e0b'),
            'destructive': isDark ? '#f87171' : getCssVariable('--destructive', '#ef4444'),
            'danger': isDark ? '#f87171' : getCssVariable('--destructive', '#ef4444'),
            'muted': getCssVariable('--muted-foreground', isDark ? '#b3b7b5' : '#717372'),
            'muted-foreground': getCssVariable('--muted-foreground', isDark ? '#b3b7b5' : '#717372'),
            'border': getCssVariable('--border', isDark ? '#262726' : '#e5e6e5'),
            'card': getCssVariable('--card', isDark ? '#191a19' : '#ffffff'),
            'card-foreground': isDark ? '#f9fafa' : '#0a0b0a',
            'foreground': isDark ? '#f9fafa' : '#0a0b0a',
            'background': isDark ? '#0a0b0a' : '#ffffff',
            'chart-1': getCssVariable('--chart-1', isDark ? '#38bdf8' : '#0ea5e9'),
            'chart-2': getCssVariable('--chart-2', isDark ? '#34d399' : '#10b981'),
            'chart-3': getCssVariable('--chart-3', isDark ? '#fbbf24' : '#f59e0b'),
            'chart-4': getCssVariable('--chart-4', isDark ? '#a78bfa' : '#8b5cf6'),
            'chart-5': getCssVariable('--chart-5', isDark ? '#f87171' : '#ef4444'),
        };

        const lower = token.toLowerCase();
        if (tokenMap[lower]) {
            resolved = tokenMap[lower];
        } else {
            // Try CSS variable from name
            const fromVar = getCssVariable(`--color-${token}`) || getCssVariable(`--${token}`);
            if (fromVar) resolved = fromVar;
        }
    }

    if (targetAlpha !== null && targetAlpha !== undefined) {
        if (resolved.startsWith('#')) {
            return hexToRgba(resolved, targetAlpha);
        }
        if (resolved.startsWith('rgb(')) {
            return resolved.replace('rgb(', 'rgba(').replace(')', `, ${targetAlpha})`);
        }
    }

    return resolved;
}

/**
 * Returns default Vibe UI chart palette.
 */
export function getDefaultPalette(isDark = isDarkMode()) {
    return [
        resolveColor('chart-1', isDark),
        resolveColor('chart-2', isDark),
        resolveColor('chart-3', isDark),
        resolveColor('chart-4', isDark),
        resolveColor('chart-5', isDark),
    ].filter(Boolean);
}

/**
 * Applies Vibe UI theme defaults, colors, and typography to a Chart.js config object.
 */
export function applyVibeTheme(userConfig, isDark = isDarkMode(), ctx = null) {
    const config = JSON.parse(JSON.stringify(userConfig));
    const palette = getDefaultPalette(isDark);

    const fontFamily = getCssVariable('--font-sans', "'Figtree', ui-sans-serif, system-ui, sans-serif");
    const borderColor = resolveColor('border', isDark);
    const textColor = resolveColor('muted-foreground', isDark);
    const cardBg = resolveColor('card', isDark);
    const cardFg = resolveColor('foreground', isDark);

    // 1. Ensure options and plugins structure
    config.options = config.options || {};
    config.options.responsive = config.options.responsive !== false;
    config.options.maintainAspectRatio = config.options.maintainAspectRatio || false;

    // 2. Plugins defaults (Legend, Tooltip, Title)
    config.options.plugins = config.options.plugins || {};

    // Tooltip Vibe UI styling & customization
    const userTooltip = config.options.plugins.tooltip || {};
    const tooltipBg = userTooltip.backgroundColor ? resolveColor(userTooltip.backgroundColor, isDark) : cardBg;
    const tooltipBorder = userTooltip.borderColor ? resolveColor(userTooltip.borderColor, isDark) : borderColor;
    const tooltipTitle = userTooltip.titleColor ? resolveColor(userTooltip.titleColor, isDark) : cardFg;
    const tooltipBody = userTooltip.bodyColor ? resolveColor(userTooltip.bodyColor, isDark) : textColor;

    config.options.plugins.tooltip = {
        enabled: true,
        backgroundColor: tooltipBg,
        titleColor: tooltipTitle,
        bodyColor: tooltipBody,
        borderColor: tooltipBorder,
        borderWidth: 1,
        padding: {
            top: 8,
            bottom: 8,
            left: 12,
            right: 12
        },
        cornerRadius: 8,
        displayColors: true,
        boxWidth: 8,
        boxHeight: 8,
        usePointStyle: true,
        titleFont: {
            family: fontFamily,
            size: 12,
            weight: '600'
        },
        bodyFont: {
            family: fontFamily,
            size: 12,
            weight: '400'
        },
        ...userTooltip
    };

    // Parse callback functions if serialized as string in config.options.plugins.tooltip.callbacks
    if (config.options.plugins.tooltip.callbacks) {
        const cbs = config.options.plugins.tooltip.callbacks;
        for (const [key, fn] of Object.entries(cbs)) {
            if (typeof fn === 'string') {
                const trimmed = fn.trim();
                if (trimmed.startsWith('function') || trimmed.startsWith('(') || trimmed.includes('=>')) {
                    try {
                        cbs[key] = new Function('return (' + trimmed + ')')();
                    } catch (e) {
                        console.warn('[VibeChart] Failed to parse tooltip callback string:', key, e);
                    }
                }
            }
        }
    }

    // Shorthand prefix & suffix formatter helper for tooltip
    if ((userTooltip.prefix || userTooltip.suffix || userTooltip.valuePrefix || userTooltip.valueSuffix) && !config.options.plugins.tooltip.callbacks?.label) {
        const prefix = userTooltip.prefix || userTooltip.valuePrefix || '';
        const suffix = userTooltip.suffix || userTooltip.valueSuffix || '';
        config.options.plugins.tooltip.callbacks = config.options.plugins.tooltip.callbacks || {};
        config.options.plugins.tooltip.callbacks.label = function(context) {
            let label = context.dataset.label || '';
            if (label) label += ': ';
            let val = context.parsed.y !== undefined ? context.parsed.y : context.parsed;
            if (typeof val === 'number') {
                val = val.toLocaleString('id-ID');
            }
            return `${label}${prefix}${val}${suffix}`;
        };
    }

    // Parse external tooltip function if passed as string or window function name
    if (typeof config.options.plugins.tooltip.external === 'string') {
        const extStr = config.options.plugins.tooltip.external.trim();
        if (extStr.startsWith('function') || extStr.startsWith('(') || extStr.includes('=>')) {
            try {
                config.options.plugins.tooltip.external = new Function('return (' + extStr + ')')();
            } catch (e) {
                console.warn('[VibeChart] Failed to parse tooltip external handler:', e);
            }
        } else if (typeof window[extStr] === 'function') {
            config.options.plugins.tooltip.external = window[extStr];
        }
    }

    // Zoom & Pan Vibe UI styling & color resolution
    if (config.options.plugins.zoom) {
        const z = config.options.plugins.zoom;
        if (z.zoom?.drag) {
            const isDragObj = typeof z.zoom.drag === 'object';
            const dragBorder = isDragObj && z.zoom.drag.borderColor ? resolveColor(z.zoom.drag.borderColor, isDark) : resolveColor('primary', isDark);
            const dragBg = isDragObj && z.zoom.drag.backgroundColor ? resolveColor(z.zoom.drag.backgroundColor, isDark) : resolveColor('primary/20', isDark);
            z.zoom.drag = {
                enabled: true,
                borderColor: dragBorder,
                backgroundColor: dragBg,
                borderWidth: 1,
                ...(isDragObj ? z.zoom.drag : {})
            };
        }
    }

    // Legend Vibe UI styling
    config.options.plugins.legend = {
        display: config.options.plugins.legend?.display !== false,
        position: config.options.plugins.legend?.position || 'top',
        align: config.options.plugins.legend?.align || 'end',
        labels: {
            color: textColor,
            font: {
                family: fontFamily,
                size: 11,
                weight: '500'
            },
            boxWidth: 10,
            boxHeight: 10,
            usePointStyle: true,
            pointStyle: 'circle',
            padding: 16,
            ...config.options.plugins.legend?.labels
        },
        ...config.options.plugins.legend
    };

    // 3. Scales defaults for Cartesian charts (line, bar, scatter)
    const isCartesian = !['pie', 'doughnut', 'polarArea', 'radar'].includes(config.type);
    if (isCartesian) {
        config.options.scales = config.options.scales || {};

        config.options.scales.x = {
            grid: {
                color: borderColor,
                tickColor: 'transparent',
                drawBorder: false,
                lineWidth: 1,
                ...config.options.scales.x?.grid
            },
            ticks: {
                color: textColor,
                font: {
                    family: fontFamily,
                    size: 11
                },
                padding: 6,
                ...config.options.scales.x?.ticks
            },
            border: {
                display: false,
                ...config.options.scales.x?.border
            },
            ...config.options.scales.x
        };

        config.options.scales.y = {
            grid: {
                color: borderColor,
                tickColor: 'transparent',
                drawBorder: false,
                lineWidth: 1,
                ...config.options.scales.y?.grid
            },
            ticks: {
                color: textColor,
                font: {
                    family: fontFamily,
                    size: 11
                },
                padding: 8,
                ...config.options.scales.y?.ticks
            },
            border: {
                display: false,
                ...config.options.scales.y?.border
            },
            ...config.options.scales.y
        };
    }

    // 4. Resolve Colors in Datasets
    if (config.data && Array.isArray(config.data.datasets)) {
        config.data.datasets = config.data.datasets.map((dataset, idx) => {
            const ds = { ...dataset };
            const defaultColor = palette[idx % palette.length];

            // Resolve Border Color
            if (ds.borderColor) {
                if (Array.isArray(ds.borderColor)) {
                    ds.borderColor = ds.borderColor.map(c => resolveColor(c, isDark));
                } else {
                    ds.borderColor = resolveColor(ds.borderColor, isDark);
                }
            } else if (config.type === 'line' || config.type === 'bar') {
                ds.borderColor = defaultColor;
            }

            // Resolve Background Color
            if (ds.backgroundColor) {
                if (Array.isArray(ds.backgroundColor)) {
                    ds.backgroundColor = ds.backgroundColor.map(c => resolveColor(c, isDark));
                } else {
                    ds.backgroundColor = resolveColor(ds.backgroundColor, isDark);
                }
            } else if (config.type === 'bar') {
                ds.backgroundColor = resolveColor(ds.borderColor || defaultColor, isDark, 0.85);
            } else if (config.type === 'line' && ds.fill) {
                // Subtle area background for line chart if fill=true
                ds.backgroundColor = resolveColor(ds.borderColor || defaultColor, isDark, 0.15);
            } else if (['pie', 'doughnut'].includes(config.type)) {
                ds.backgroundColor = palette;
                ds.borderColor = cardBg;
                ds.borderWidth = 2;
            }

            // Polish default line styles
            if (config.type === 'line') {
                ds.tension = ds.tension !== undefined ? ds.tension : 0.35;
                ds.borderWidth = ds.borderWidth !== undefined ? ds.borderWidth : 2.5;
                ds.pointRadius = ds.pointRadius !== undefined ? ds.pointRadius : 3;
                ds.pointHoverRadius = ds.pointHoverRadius !== undefined ? ds.pointHoverRadius : 5;
                ds.pointBackgroundColor = ds.pointBackgroundColor || ds.borderColor;
            }

            // Polish default bar styles
            if (config.type === 'bar') {
                ds.borderRadius = ds.borderRadius !== undefined ? ds.borderRadius : 6;
            }

            return ds;
        });
    }

    return config;
}

/**
 * Alpine.js component for vibeChart
 */
export function vibeChart(initialConfig = {}) {
    return {
        chart: null,
        loading: true,
        themeObserver: null,
        rawConfig: initialConfig,

        init() {
            this.$nextTick(() => {
                this.renderChart();
                this.setupThemeListener();
            });

            if (typeof this.$cleanup === 'function') {
                this.$cleanup(() => {
                    this.destroy();
                });
            }
        },

        renderChart() {
            const canvas = this.$refs.canvas;
            if (!canvas || !document.body.contains(canvas)) return;

            // Merge rawConfig or check if user provided x-chart attribute
            let config = this.rawConfig;
            if (!config || Object.keys(config).length === 0) {
                try {
                    const attr = this.$el.getAttribute('x-chart') || this.$el.getAttribute('data-chart');
                    if (attr) {
                        config = JSON.parse(attr);
                        this.rawConfig = config;
                    }
                } catch (e) {
                    console.warn('[VibeChart] Failed to parse chart attribute:', e);
                }
            }

            const isDark = isDarkMode();
            this._lastDark = isDark;
            const finalConfig = applyVibeTheme(config, isDark, canvas);

            if (this.chart) {
                try {
                    this.chart.destroy();
                } catch (e) {}
                this.chart = null;
            }

            if (window.Chart) {
                const existing = window.Chart.getChart(canvas);
                if (existing) {
                    try {
                        existing.destroy();
                    } catch (e) {}
                }
            }

            try {
                this.chart = new Chart(canvas, finalConfig);
            } catch (err) {
                console.error('[VibeChart] Error creating chart instance:', err);
            } finally {
                this.loading = false;
            }
        },

        updateTheme() {
            if (!this.chart || !this.rawConfig) return;
            const canvas = this.$refs.canvas;
            if (!canvas || !document.body.contains(canvas)) {
                this.destroy();
                return;
            }

            const isDark = isDarkMode();
            if (this._lastDark === isDark) return;
            this._lastDark = isDark;

            const updated = applyVibeTheme(this.rawConfig, isDark, canvas);

            // Safely apply new dataset colors without overwriting options resolver
            if (updated.data?.datasets && this.chart.data?.datasets) {
                this.chart.data.datasets.forEach((ds, i) => {
                    const src = updated.data.datasets[i];
                    if (src) {
                        if (src.borderColor !== undefined) ds.borderColor = src.borderColor;
                        if (src.backgroundColor !== undefined) ds.backgroundColor = src.backgroundColor;
                        if (src.pointBackgroundColor !== undefined) {
                            ds.pointBackgroundColor = src.pointBackgroundColor;
                        }
                    }
                });
            }

            if (this.chart.options?.plugins && updated.options?.plugins) {
                if (updated.options.plugins.tooltip && this.chart.options.plugins.tooltip) {
                    Object.assign(this.chart.options.plugins.tooltip, updated.options.plugins.tooltip);
                }
                if (updated.options.plugins.legend?.labels && this.chart.options.plugins.legend?.labels) {
                    this.chart.options.plugins.legend.labels.color = updated.options.plugins.legend.labels.color;
                }
            }

            if (this.chart.options?.scales && updated.options?.scales) {
                if (updated.options.scales.x?.grid && this.chart.options.scales.x?.grid) {
                    this.chart.options.scales.x.grid.color = updated.options.scales.x.grid.color;
                }
                if (updated.options.scales.x?.ticks && this.chart.options.scales.x?.ticks) {
                    this.chart.options.scales.x.ticks.color = updated.options.scales.x.ticks.color;
                }
                if (updated.options.scales.y?.grid && this.chart.options.scales.y?.grid) {
                    this.chart.options.scales.y.grid.color = updated.options.scales.y.grid.color;
                }
                if (updated.options.scales.y?.ticks && this.chart.options.scales.y?.ticks) {
                    this.chart.options.scales.y.ticks.color = updated.options.scales.y.ticks.color;
                }
            }

            this.chart.config.options = updated.options;

            try {
                this.chart.update('none'); // Update without full disruptive animation
            } catch (e) {
                // Ignore update errors if chart or canvas is in transient state
            }
        },

        setupThemeListener() {
            this.themeObserver = new MutationObserver((mutations) => {
                for (const mutation of mutations) {
                    if (mutation.type === 'attributes' && (mutation.attributeName === 'class' || mutation.attributeName === 'data-canvas-theme')) {
                        this.updateTheme();
                    }
                }
            });

            this.themeObserver.observe(document.documentElement, {
                attributes: true,
                attributeFilter: ['class', 'data-canvas-theme']
            });

            this._themeHandler = () => this.updateTheme();
            window.addEventListener('vibe:theme-change', this._themeHandler);
            window.addEventListener('theme-changed', this._themeHandler);
        },

        zoomIn(factor = 1.2) {
            this.chart?.zoom?.(factor);
        },

        zoomOut(factor = 0.8) {
            this.chart?.zoom?.(factor);
        },

        resetZoom() {
            this.chart?.resetZoom?.();
        },

        pan(amount = { x: 50 }) {
            this.chart?.pan?.(amount, undefined, 'default');
        },

        destroy() {
            if (this.themeObserver) {
                this.themeObserver.disconnect();
                this.themeObserver = null;
            }
            if (this._themeHandler) {
                window.removeEventListener('vibe:theme-change', this._themeHandler);
                window.removeEventListener('theme-changed', this._themeHandler);
                this._themeHandler = null;
            }
            if (this.chart) {
                try {
                    this.chart.destroy();
                } catch (e) {}
                this.chart = null;
            }
        }
    };
}

// Global VibeChart Helper
export const VibeChart = {
    Chart,
    resolveColor,
    getDefaultPalette,
    applyVibeTheme,

    /**
     * Helper to manually instantiate a chart on any canvas element or selector.
     */
    create(target, config) {
        const el = typeof target === 'string' ? document.querySelector(target) : target;
        if (!el) return null;
        const canvas = el.tagName === 'CANVAS' ? el : el.querySelector('canvas');
        if (!canvas) {
            console.error('[VibeChart] Target element does not contain a <canvas>');
            return null;
        }

        // Clean up any existing chart attached to this canvas
        if (window.Chart) {
            const existing = window.Chart.getChart(canvas);
            if (existing) {
                existing.destroy();
            }
        }

        const isDark = isDarkMode();
        const finalConfig = applyVibeTheme(config, isDark, canvas);

        let chartInstance = null;
        try {
            chartInstance = new Chart(canvas, finalConfig);
        } catch (err) {
            console.error('[VibeChart] Error creating chart instance:', err);
            return null;
        }

        // Auto-hook theme changes with cleanup when canvas is detached from DOM
        let lastDark = isDark;
        const observer = new MutationObserver(() => {
            if (!document.body.contains(canvas)) {
                observer.disconnect();
                if (window.Chart && window.Chart.getChart(canvas)) {
                    try {
                        chartInstance.destroy();
                    } catch (e) {}
                }
                return;
            }

            const darkNow = isDarkMode();
            if (darkNow === lastDark) return;
            lastDark = darkNow;

            const updated = applyVibeTheme(config, darkNow, canvas);
            if (updated.data?.datasets && chartInstance.data?.datasets) {
                chartInstance.data.datasets.forEach((ds, i) => {
                    const src = updated.data.datasets[i];
                    if (src) {
                        if (src.borderColor !== undefined) ds.borderColor = src.borderColor;
                        if (src.backgroundColor !== undefined) ds.backgroundColor = src.backgroundColor;
                        if (src.pointBackgroundColor !== undefined) {
                            ds.pointBackgroundColor = src.pointBackgroundColor;
                        }
                    }
                });
            }

            if (chartInstance.options?.plugins && updated.options?.plugins) {
                if (updated.options.plugins.tooltip && chartInstance.options.plugins.tooltip) {
                    Object.assign(chartInstance.options.plugins.tooltip, updated.options.plugins.tooltip);
                }
                if (updated.options.plugins.legend?.labels && chartInstance.options.plugins.legend?.labels) {
                    chartInstance.options.plugins.legend.labels.color = updated.options.plugins.legend.labels.color;
                }
            }

            if (chartInstance.options?.scales && updated.options?.scales) {
                if (updated.options.scales.x?.grid && chartInstance.options.scales.x?.grid) {
                    chartInstance.options.scales.x.grid.color = updated.options.scales.x.grid.color;
                }
                if (updated.options.scales.x?.ticks && chartInstance.options.scales.x?.ticks) {
                    chartInstance.options.scales.x.ticks.color = updated.options.scales.x.ticks.color;
                }
                if (updated.options.scales.y?.grid && chartInstance.options.scales.y?.grid) {
                    chartInstance.options.scales.y.grid.color = updated.options.scales.y.grid.color;
                }
                if (updated.options.scales.y?.ticks && chartInstance.options.scales.y?.ticks) {
                    chartInstance.options.scales.y.ticks.color = updated.options.scales.y.ticks.color;
                }
            }

            chartInstance.config.options = updated.options;

            try {
                chartInstance.update('none');
            } catch (e) {
                // Ignore transient update errors
            }
        });

        observer.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['class', 'data-canvas-theme']
        });

        chartInstance._themeObserver = observer;

        return chartInstance;
    },

    /**
     * Programmatic zoom in / zoom out on a chart canvas or container selector.
     */
    zoom(target, factor = 1.2) {
        const el = typeof target === 'string' ? document.querySelector(target) : target;
        const canvas = el?.tagName === 'CANVAS' ? el : el?.querySelector?.('canvas');
        if (canvas && window.Chart) {
            window.Chart.getChart(canvas)?.zoom?.(factor);
        }
    },

    /**
     * Reset zoom to default scale.
     */
    resetZoom(target) {
        const el = typeof target === 'string' ? document.querySelector(target) : target;
        const canvas = el?.tagName === 'CANVAS' ? el : el?.querySelector?.('canvas');
        if (canvas && window.Chart) {
            window.Chart.getChart(canvas)?.resetZoom?.();
        }
    },

    /**
     * Pan chart horizontally or vertically.
     */
    pan(target, amount, mode = 'x') {
        const el = typeof target === 'string' ? document.querySelector(target) : target;
        const canvas = el?.tagName === 'CANVAS' ? el : el?.querySelector?.('canvas');
        if (canvas && window.Chart) {
            window.Chart.getChart(canvas)?.pan?.(amount, undefined, mode);
        }
    }
};

window.vibeChart = vibeChart;
window.VibeChart = VibeChart;

// Dispatch global ready event
window.dispatchEvent(new CustomEvent('vibe-chart-ready'));
