/**
 * VibeUI Keyboard Shortcut Engine & Registry
 *
 * Single source of truth for application keyboard shortcuts across Layouts,
 * DataTables, Forms, Modals, and Sheets.
 * Exposes `window.VibeShortcut` for shortcut registration & the F1 help modal.
 */

(function () {
    'use strict';

    const SHIFTED_SYMBOLS = new Set(['?', '+', '{', '}', '|', ':', '"', '<', '>', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '~', '_']);
    const DEFAULT_CATEGORIES = ['global', 'crud'];

    function isMacPlatform() {
        const platform = (navigator.userAgentData && navigator.userAgentData.platform) || navigator.platform || '';
        return /mac|iphone|ipad|ipod/i.test(platform);
    }

    function getI18n() {
        return (typeof window !== 'undefined' && window.VibeShortcutI18n) ? window.VibeShortcutI18n : {};
    }

    function t(path, fallback = '') {
        const parts = path.split('.');
        let cur = getI18n();
        for (const p of parts) {
            if (cur && typeof cur === 'object' && p in cur) {
                cur = cur[p];
            } else {
                return fallback;
            }
        }
        return (typeof cur === 'string' && cur.length > 0) ? cur : fallback;
    }

    function isVisibleElement(el) {
        if (!el || typeof el.getBoundingClientRect !== 'function') return false;
        const style = window.getComputedStyle(el);
        if (style.display === 'none' || style.visibility === 'hidden') return false;
        return el.offsetWidth > 0 || el.offsetHeight > 0 || el.getClientRects().length > 0;
    }

    function isInputElement(el) {
        if (!el) return false;
        if (el.isContentEditable) return true;
        const tag = el.tagName;
        return tag === 'INPUT' || tag === 'TEXTAREA' || tag === 'SELECT';
    }

    function findVisibleElement(selector, root = document) {
        if (!root) return null;
        const list = root.querySelectorAll(selector);
        for (const el of list) {
            if (isVisibleElement(el)) return el;
        }
        return null;
    }

    function getVisibleAlerts() {
        const container = document.getElementById('vibe-alert-container');
        if (!container) return [];
        return Array.from(container.querySelectorAll('.pointer-events-auto')).filter(isVisibleElement);
    }

    function getOpenModals(excludeShortcutModal = false) {
        return Array.from(document.querySelectorAll('.vibe-modal-container'))
            .filter((el) => {
                if (excludeShortcutModal && el.id === 'shortcut-list-modal') {
                    return false;
                }
                return isVisibleElement(el);
            });
    }

    function isShortcutModalOpen() {
        const el = document.getElementById('shortcut-list-modal');
        if (el && isVisibleElement(el)) return true;
        return !!(window.VibeModal && typeof window.VibeModal.isOpen === 'function' && window.VibeModal.isOpen('shortcut-list-modal'));
    }

    function getExpandedOverlaySheets() {
        return Array.from(
            document.querySelectorAll('[data-state="expanded"][data-layout="fixed"], [data-state="expanded"][data-layout="absolute"]')
        ).filter(isVisibleElement);
    }

    function hasOpenDropdownOrPopover() {
        if (findVisibleElement('[role="menu"], [role="listbox"], .flatpickr-calendar.open')) {
            return true;
        }
        return !!document.querySelector('[role="combobox"][aria-expanded="true"]');
    }

    function isBlockingOverlayOpen() {
        return (
            getVisibleAlerts().length > 0 ||
            getOpenModals(true).length > 0 ||
            getExpandedOverlaySheets().length > 0 ||
            hasOpenDropdownOrPopover()
        );
    }

    function isPrintableForm(form) {
        if (!form || form.hasAttribute('data-shortcut-ignore')) return false;
        if (form.getAttribute('role') === 'search') return false;
        if (!isVisibleElement(form)) return false;
        if (form.closest('#global-search-modal, #shortcut-list-modal')) return false;
        return !!findVisibleElement('button[type="submit"]:not([disabled]), input[type="submit"]:not([disabled])', form);
    }

    function findActiveForm() {
        const openModals = getOpenModals();
        for (let i = openModals.length - 1; i >= 0; i--) {
            if (openModals[i].id === 'shortcut-list-modal' || openModals[i].id === 'global-search-modal') continue;
            const form = findVisibleElement('form', openModals[i]);
            if (isPrintableForm(form)) return form;
        }

        const openSheets = getExpandedOverlaySheets();
        for (let i = openSheets.length - 1; i >= 0; i--) {
            const form = findVisibleElement('form', openSheets[i]);
            if (isPrintableForm(form)) return form;
        }

        const activeForm = document.activeElement?.closest?.('form');
        if (isPrintableForm(activeForm)) return activeForm;

        const pageForms = Array.from(document.querySelectorAll('main form, form')).filter(isPrintableForm);
        return pageForms[0] || null;
    }

    function getActiveSearchTarget() {
        const selector = 'input[data-shortcut-search]:not([disabled]), input.search-data:not([disabled]), .vibe-datatable-root input[wire\\:model*="search"]:not([disabled])';
        const activeModal = getOpenModals(true).slice(-1)[0];
        if (activeModal) {
            return findVisibleElement(selector, activeModal);
        }
        return findVisibleElement(selector);
    }

    const PREV_PAGE_SELECTOR = '[data-shortcut-prev-page]:not([disabled]), .vibe-datatable-root button[wire\\:click*="previousPage"]:not([disabled]), .vibe-datatable-root button[wire\\:click*="previousCursor"]:not([disabled]), .vibe-datatable-root [rel="prev"]:not([disabled])';
    const NEXT_PAGE_SELECTOR = '[data-shortcut-next-page]:not([disabled]), .vibe-datatable-root button[wire\\:click*="nextPage"]:not([disabled]), .vibe-datatable-root button[wire\\:click*="nextCursor"]:not([disabled]), .vibe-datatable-root [rel="next"]:not([disabled])';

    function findActivePrintButton() {
        const openModals = getOpenModals(true);
        for (let i = openModals.length - 1; i >= 0; i--) {
            const modalPrint = findVisibleElement('[data-shortcut-print]:not([disabled]), #print-button:not([disabled])', openModals[i]);
            if (modalPrint) return modalPrint;
        }
        return findVisibleElement('[data-shortcut-print]:not([disabled]), #print-button:not([disabled])');
    }

    function navigateBackWithTarget(el) {
        if (!el) return;
        const tag = el.tagName;
        if (tag === 'A' && el.href) {
            if (isVisibleElement(el)) {
                el.click();
                return;
            }
            if (window.Livewire && typeof window.Livewire.navigate === 'function' && el.hasAttribute('wire:navigate')) {
                window.Livewire.navigate(el.href);
            } else {
                window.location.href = el.href;
            }
            return;
        }
        el.click();
    }

    function findBackTarget() {
        const visibleBtn = findVisibleElement('[data-shortcut-back]:not([disabled])');
        if (visibleBtn) return visibleBtn;
        return document.querySelector('[data-shortcut-back][href]');
    }

    function canGoHistoryBack() {
        if (window.history.length <= 1) return false;
        if (!document.referrer) return true;
        try {
            return new URL(document.referrer).origin === window.location.origin;
        } catch (e) {
            return false;
        }
    }

    function showToast(message, type = 'info', title = null) {
        if (!message) return;
        if (window.$vibe && window.$vibe.toast && typeof window.$vibe.toast[type] === 'function') {
            window.$vibe.toast[type](message, title);
            return;
        }
        window.dispatchEvent(new CustomEvent('toast', {
            detail: { type, title, message },
        }));
    }

    function normalizeEventKey(event) {
        const key = event.key || '';
        if (key === ' ') return 'space';
        if (key.length === 1) return key.toLowerCase();
        return key.toLowerCase();
    }

    function normalizeToken(token) {
        const lower = String(token).toLowerCase();
        if (lower === 'mod') return isMacPlatform() ? 'meta' : 'control';
        if (lower === 'ctrl') return 'control';
        if (lower === 'cmd' || lower === 'command') return 'meta';
        if (lower === 'esc') return 'escape';
        if (lower === 'del') return 'delete';
        return lower;
    }

    function matchesCombo(event, combo) {
        if (!Array.isArray(combo) || combo.length === 0) return false;

        let reqCtrl = false;
        let reqMeta = false;
        let reqAlt = false;
        let reqShift = false;
        let targetKey = null;

        for (const raw of combo) {
            const norm = normalizeToken(raw);
            if (norm === 'control') reqCtrl = true;
            else if (norm === 'meta') reqMeta = true;
            else if (norm === 'alt') reqAlt = true;
            else if (norm === 'shift') reqShift = true;
            else targetKey = norm;
        }

        if (!targetKey) return false;

        if (event.ctrlKey !== reqCtrl) return false;
        if (event.metaKey !== reqMeta) return false;
        if (event.altKey !== reqAlt) return false;

        if (reqShift) {
            if (!event.shiftKey) return false;
        } else if (event.shiftKey && !SHIFTED_SYMBOLS.has(targetKey)) {
            return false;
        }

        const pressedKey = normalizeEventKey(event);
        return pressedKey === targetKey;
    }

    function formatKeyToken(token) {
        const mac = isMacPlatform();
        const lower = String(token).toLowerCase();
        switch (lower) {
            case 'mod':
                return mac ? '⌘' : 'Ctrl';
            case 'control':
            case 'ctrl':
                return 'Ctrl';
            case 'meta':
            case 'cmd':
                return '⌘';
            case 'alt':
                return mac ? '⌥' : 'Alt';
            case 'shift':
                return 'Shift';
            case 'arrowleft':
                return '←';
            case 'arrowright':
                return '→';
            case 'arrowup':
                return '↑';
            case 'arrowdown':
                return '↓';
            case 'escape':
                return 'Esc';
            case 'delete':
                return 'Delete';
            case 'backspace':
                return 'Backspace';
            case 'enter':
                return 'Enter';
            default:
                return String(token).toUpperCase();
        }
    }

    function formatComboDisplay(combo) {
        if (!Array.isArray(combo)) return [];
        return combo.map(formatKeyToken);
    }

    function toggleFullscreenMode() {
        if (!document.fullscreenElement) {
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen().catch(() => {});
            }
        } else if (document.exitFullscreen) {
            document.exitFullscreen().catch(() => {});
        }
    }

    const CUSTOM_CATEGORIES = new Map();

    const SHORTCUT_DEFINITIONS = [
        // ─── Global & Navigation ─────────────────────────────────────────────
        {
            id: 'help',
            category: 'global',
            keys: ['F1'],
            triggerInInputs: true,
            allowWhenShortcutModalOpen: true,
            allowRepeat: false,
            preventDefault: true,
            canQuickRun: false,
            fallbackTitle: 'Keyboard Shortcuts',
            fallbackDescription: 'Open or close the keyboard shortcuts list modal.',
            available: () => !!document.getElementById('shortcut-list-modal'),
            action: () => {
                window.dispatchEvent(new CustomEvent('toggle-modal', { detail: 'shortcut-list-modal' }));
            },
        },
        {
            id: 'search',
            category: 'global',
            keys: ['Mod', 'k'],
            altKeys: [['Mod', '/']],
            triggerInInputs: true,
            allowWhenShortcutModalOpen: false,
            allowRepeat: false,
            preventDefault: true,
            canQuickRun: true,
            fallbackTitle: 'Quick Search (Command Palette)',
            fallbackDescription: 'Open or toggle the global search modal.',
            available: () => !!document.getElementById('global-search-modal'),
            action: () => {
                if (isShortcutModalOpen()) {
                    window.dispatchEvent(new CustomEvent('close-modal', { detail: 'shortcut-list-modal' }));
                }
                const searchModalEl = document.getElementById('global-search-modal');
                if (searchModalEl && isVisibleElement(searchModalEl)) {
                    window.dispatchEvent(new CustomEvent('close-modal', { detail: 'global-search-modal' }));
                    return;
                }
                window.dispatchEvent(new CustomEvent('open-search-modal'));
            },
        },
        {
            id: 'sidebar',
            category: 'global',
            keys: ['Mod', 'b'],
            triggerInInputs: false,
            allowRepeat: false,
            preventDefault: true,
            canQuickRun: true,
            fallbackTitle: 'Toggle Navigation Sidebar',
            fallbackDescription: 'Show or collapse the main navigation sidebar.',
            available: () => !!document.getElementById('sidebar-menu'),
            action: () => {
                window.dispatchEvent(new CustomEvent('toggle-sheet', { detail: 'sidebar-menu' }));
            },
        },
        {
            id: 'theme',
            category: 'global',
            keys: ['Mod', 'd'],
            triggerInInputs: false,
            allowRepeat: false,
            preventDefault: true,
            canQuickRun: true,
            fallbackTitle: 'Toggle Light / Dark Theme',
            fallbackDescription: 'Switch between light and dark appearance mode.',
            available: () => true,
            action: (event) => {
                if (window.VibeTheme && typeof window.VibeTheme.toggle === 'function') {
                    window.VibeTheme.toggle(event);
                } else {
                    document.documentElement.classList.toggle('dark');
                }
            },
        },
        {
            id: 'fullscreen',
            category: 'global',
            keys: ['F11'],
            triggerInInputs: true,
            allowRepeat: false,
            preventDefault: true,
            canQuickRun: true,
            fallbackTitle: 'Toggle Fullscreen Mode',
            fallbackDescription: 'Enter or exit browser fullscreen mode.',
            available: () => !!(document.documentElement.requestFullscreen || document.exitFullscreen),
            action: () => {
                toggleFullscreenMode();
            },
        },
        {
            id: 'back',
            category: 'global',
            keys: ['Backspace'],
            altKeys: [['Alt', 'ArrowLeft']],
            triggerInInputs: false,
            allowRepeat: false,
            preventDefault: true,
            canQuickRun: false,
            fallbackTitle: 'Previous Page (Back)',
            fallbackDescription: 'Return to the previous page outside text inputs.',
            available: () => !isBlockingOverlayOpen() && (!!findBackTarget() || canGoHistoryBack()),
            action: () => {
                const target = findBackTarget();
                if (target) {
                    navigateBackWithTarget(target);
                    return;
                }
                if (canGoHistoryBack()) {
                    window.history.back();
                }
            },
        },
        {
            id: 'forward',
            category: 'global',
            keys: ['Shift', 'Backspace'],
            altKeys: [['Alt', 'ArrowRight']],
            triggerInInputs: false,
            allowRepeat: false,
            preventDefault: true,
            canQuickRun: false,
            fallbackTitle: 'Next Page (Forward)',
            fallbackDescription: 'Step forward in browser page history.',
            available: () => !isBlockingOverlayOpen() && window.history.length > 1,
            action: () => {
                window.history.forward();
            },
        },
        {
            id: 'close_overlay',
            category: 'global',
            keys: ['Escape'],
            triggerInInputs: true,
            allowWhenShortcutModalOpen: true,
            allowRepeat: false,
            preventDefault: false,
            canQuickRun: false,
            fallbackTitle: 'Close Dialog / Modal / Sheet',
            fallbackDescription: 'Close the active alert, modal, overlay sheet, or blur focused input.',
            available: () => true,
            action: (event) => {
                const alerts = getVisibleAlerts();
                if (alerts.length > 0) {
                    const topAlert = alerts[alerts.length - 1];
                    const cancelBtn = topAlert.querySelector('[data-vibe-alert-cancel]');
                    if (cancelBtn && isVisibleElement(cancelBtn)) {
                        event.preventDefault();
                        event.stopPropagation();
                        cancelBtn.click();
                        return;
                    }
                }

                if (getOpenModals(false).length > 0 || getExpandedOverlaySheets().length > 0 || hasOpenDropdownOrPopover()) {
                    return;
                }

                const active = document.activeElement;
                if (active && isInputElement(active) && typeof active.blur === 'function') {
                    event.preventDefault();
                    active.blur();
                }
            },
        },
        {
            id: 'confirm_alert',
            category: 'global',
            keys: ['Enter'],
            triggerInInputs: true,
            allowRepeat: false,
            preventDefault: false,
            canQuickRun: false,
            fallbackTitle: 'Confirm Active Alert',
            fallbackDescription: 'Trigger the primary confirm button on the active alert dialog.',
            available: () => getVisibleAlerts().length > 0,
            action: (event) => {
                const alerts = getVisibleAlerts();
                if (alerts.length === 0) return;

                if (event.target && event.target.closest && event.target.closest('button, a')) {
                    return;
                }

                const topAlert = alerts[alerts.length - 1];
                const confirmBtn = topAlert.querySelector('[data-vibe-alert-confirm]');
                if (confirmBtn && isVisibleElement(confirmBtn)) {
                    event.preventDefault();
                    event.stopPropagation();
                    confirmBtn.click();
                }
            },
        },

        // ─── Tables, Data & Forms ──────────────────────────────────────────
        {
            id: 'search_data',
            category: 'crud',
            keys: ['Mod', 'f'],
            altKeys: [['/']],
            triggerInInputs: (event, comboIndex) => comboIndex === 0,
            allowRepeat: false,
            preventDefault: true,
            canQuickRun: true,
            fallbackTitle: 'Focus Data Table Search',
            fallbackDescription: 'Move cursor focus to the active search box.',
            available: () => !!getActiveSearchTarget(),
            action: () => {
                const input = getActiveSearchTarget();
                if (input) {
                    requestAnimationFrame(() => {
                        input.focus();
                        if (typeof input.select === 'function') {
                            input.select();
                        }
                    });
                }
            },
        },
        {
            id: 'prev_page',
            category: 'crud',
            keys: ['ArrowLeft'],
            altKeys: [['[']],
            triggerInInputs: false,
            allowRepeat: false,
            preventDefault: true,
            canQuickRun: false,
            fallbackTitle: 'Previous Table Page',
            fallbackDescription: 'Go to the previous page on data table pagination.',
            available: () => !isBlockingOverlayOpen() && !!findVisibleElement(PREV_PAGE_SELECTOR),
            action: () => {
                const btn = findVisibleElement(PREV_PAGE_SELECTOR);
                if (btn) btn.click();
            },
        },
        {
            id: 'next_page',
            category: 'crud',
            keys: ['ArrowRight'],
            altKeys: [[']']],
            triggerInInputs: false,
            allowRepeat: false,
            preventDefault: true,
            canQuickRun: false,
            fallbackTitle: 'Next Table Page',
            fallbackDescription: 'Go to the next page on data table pagination.',
            available: () => !isBlockingOverlayOpen() && !!findVisibleElement(NEXT_PAGE_SELECTOR),
            action: () => {
                const btn = findVisibleElement(NEXT_PAGE_SELECTOR);
                if (btn) btn.click();
            },
        },
        {
            id: 'add_data',
            category: 'crud',
            keys: ['Alt', 'n'],
            triggerInInputs: false,
            allowRepeat: false,
            preventDefault: true,
            canQuickRun: true,
            fallbackTitle: 'Add New Record',
            fallbackDescription: 'Open the create modal, sheet, or page.',
            available: () => !isBlockingOverlayOpen() && !!findVisibleElement('[data-shortcut-add]:not([disabled]), .btn-add:not([disabled])'),
            action: () => {
                const btn = findVisibleElement('[data-shortcut-add]:not([disabled]), .btn-add:not([disabled])');
                if (btn) btn.click();
            },
        },
        {
            id: 'save_form',
            category: 'crud',
            keys: ['Mod', 's'],
            triggerInInputs: true,
            allowRepeat: false,
            preventDefault: true,
            canQuickRun: false,
            fallbackTitle: 'Save Active Form',
            fallbackDescription: 'Submit the currently active form on the page, modal, or sheet.',
            available: () => !!findActiveForm(),
            action: () => {
                const form = findActiveForm();
                if (!form) return;
                const submitBtn = findVisibleElement('button[type="submit"]:not([disabled]), input[type="submit"]:not([disabled])', form);
                if (submitBtn) {
                    submitBtn.click();
                } else if (typeof form.requestSubmit === 'function') {
                    form.requestSubmit();
                }
            },
        },
        {
            id: 'print',
            category: 'crud',
            keys: ['Mod', 'p'],
            triggerInInputs: false,
            allowRepeat: false,
            preventDefault: true,
            canQuickRun: false,
            fallbackTitle: 'Print Active View',
            fallbackDescription: 'Trigger the active print button on the current page or modal.',
            available: () => !!findActivePrintButton(),
            action: () => {
                const button = findActivePrintButton();
                if (!button) {
                    showToast(
                        t('alerts.no_printable_message', 'No printable action is available on this view.'),
                        'warning',
                        t('alerts.no_printable_title', 'No Printable Target')
                    );
                    return;
                }
                button.click();
            },
        },
    ];

    function findMatchingShortcut(event) {
        const isInputFocused = isInputElement(document.activeElement);
        const shortcutDialogOpen = isShortcutModalOpen();

        for (const s of SHORTCUT_DEFINITIONS) {
            if (shortcutDialogOpen && !s.allowWhenShortcutModalOpen) {
                continue;
            }

            const combos = [s.keys, ...(Array.isArray(s.altKeys) ? s.altKeys : [])];
            let matchedIdx = -1;
            for (let i = 0; i < combos.length; i++) {
                if (matchesCombo(event, combos[i])) {
                    matchedIdx = i;
                    break;
                }
            }

            if (matchedIdx === -1) continue;

            const allowInInputs = typeof s.triggerInInputs === 'function'
                ? s.triggerInInputs(event, matchedIdx)
                : Boolean(s.triggerInInputs);

            if (isInputFocused && !allowInInputs) {
                continue;
            }

            if (event.repeat && !s.allowRepeat) {
                continue;
            }

            if (typeof s.available === 'function' && !s.available(event)) {
                continue;
            }

            return s;
        }

        return null;
    }

    function handleKeydown(event) {
        if (event.isComposing || event.keyCode === 229) return;
        const matched = findMatchingShortcut(event);
        if (!matched) return;

        if (matched.preventDefault) {
            event.preventDefault();
        }
        matched.action(event);
    }

    function handleNavigated() {
        window.dispatchEvent(new CustomEvent('vibe-shortcuts-refresh'));
    }

    if (typeof window !== 'undefined') {
        if (window.__vibeShortcutKeydownHandler) {
            document.removeEventListener('keydown', window.__vibeShortcutKeydownHandler, false);
        }
        if (window.__vibeShortcutNavHandler) {
            document.removeEventListener('livewire:navigated', window.__vibeShortcutNavHandler, false);
        }

        window.__vibeShortcutKeydownHandler = handleKeydown;
        window.__vibeShortcutNavHandler = handleNavigated;

        document.addEventListener('keydown', handleKeydown, false);
        document.addEventListener('livewire:navigated', handleNavigated, false);

        window.VibeShortcut = {
            isMac: isMacPlatform,

            registerCategory(id, fallbackLabel) {
                if (id) CUSTOM_CATEGORIES.set(id, fallbackLabel || id);
            },

            register(definitionOrList) {
                const items = Array.isArray(definitionOrList) ? definitionOrList : [definitionOrList];
                for (const def of items) {
                    if (!def || !def.id || !Array.isArray(def.keys)) continue;
                    const idx = SHORTCUT_DEFINITIONS.findIndex((item) => item.id === def.id);
                    if (idx >= 0) {
                        SHORTCUT_DEFINITIONS[idx] = def;
                    } else {
                        SHORTCUT_DEFINITIONS.push(def);
                    }
                }
                window.dispatchEvent(new CustomEvent('vibe-shortcuts-refresh'));
            },

            getCategories() {
                const ids = [...DEFAULT_CATEGORIES, ...CUSTOM_CATEGORIES.keys()];
                for (const def of SHORTCUT_DEFINITIONS) {
                    if (def.category && !ids.includes(def.category)) {
                        ids.push(def.category);
                    }
                }
                return ids.map((id) => ({
                    id,
                    label: t(`categories.${id}`, CUSTOM_CATEGORIES.get(id) || id),
                }));
            },

            getShortcuts() {
                return SHORTCUT_DEFINITIONS.map((s) => {
                    const isAvailable = typeof s.available === 'function' ? Boolean(s.available()) : true;
                    return {
                        id: s.id,
                        category: s.category,
                        categoryLabel: t(`categories.${s.category}`, CUSTOM_CATEGORIES.get(s.category) || s.category),
                        keys: formatComboDisplay(s.keys),
                        altKeys: Array.isArray(s.altKeys) ? s.altKeys.map(formatComboDisplay) : [],
                        title: t(`items.${s.id}.title`, s.fallbackTitle || s.id),
                        description: t(`items.${s.id}.description`, s.fallbackDescription || ''),
                        available: isAvailable,
                        canRun: Boolean(s.canQuickRun && isAvailable && s.id !== 'help'),
                    };
                });
            },

            run(id) {
                const def = SHORTCUT_DEFINITIONS.find((s) => s.id === id);
                if (!def) return false;
                if (typeof def.available === 'function' && !def.available()) return false;
                if (isShortcutModalOpen()) {
                    window.dispatchEvent(new CustomEvent('close-modal', { detail: 'shortcut-list-modal' }));
                }
                def.action(new KeyboardEvent('keydown'));
                return true;
            },

            openModal() {
                window.dispatchEvent(new CustomEvent('open-modal', { detail: 'shortcut-list-modal' }));
            },

            closeModal() {
                window.dispatchEvent(new CustomEvent('close-modal', { detail: 'shortcut-list-modal' }));
            },

            toggleModal() {
                window.dispatchEvent(new CustomEvent('toggle-modal', { detail: 'shortcut-list-modal' }));
            },

            formatKeys: formatComboDisplay,
        };

        window.dispatchEvent(new CustomEvent('vibe-shortcuts-refresh'));
    }
})();
