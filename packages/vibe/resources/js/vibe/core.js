/**
 * Vibe UI - Shared Core Utilities
 * Consolidates storage, event normalization, clipboard, safe DOM/HTML, audio,
 * dialog fallbacks, scroll utilities, and accessible form error syncing.
 */

const getPrefix = () => (typeof window !== 'undefined' && window.VIBE_PREFIX) || 'vibe';

export function extractEventTarget(detail) {
    if (Array.isArray(detail)) return detail[0];
    if (detail !== null && typeof detail === 'object') return Object.values(detail)[0];
    return detail;
}

export function evalCallback(cb, args = [], paramNames = ['$vibe', 'data', 'response', '$el']) {
    if (!cb) return;
    if (typeof cb === 'function') {
        return cb(...args);
    }
    if (typeof cb === 'string') {
        const trimmed = cb.trim();
        if (!trimmed) return;
        if (args.length === 0 && (trimmed.startsWith('function') || trimmed.includes('=>'))) {
            // eslint-disable-next-line no-new-func
            const fn = new Function('return (' + trimmed + ')')();
            return typeof fn === 'function' ? fn() : fn;
        }
        const names = paramNames.slice(0, args.length);
        // eslint-disable-next-line no-new-func
        return (new Function(...names, trimmed))(...args);
    }
}

export function parseCallbackExpression(fn) {
    if (typeof fn === 'function') return fn;
    if (typeof fn !== 'string') return null;
    const trimmed = fn.trim();
    if (!trimmed) return null;
    if (trimmed.startsWith('function') || trimmed.startsWith('(') || trimmed.includes('=>')) {
        // eslint-disable-next-line no-new-func
        const parsed = new Function('return (' + trimmed + ')')();
        return typeof parsed === 'function' ? parsed : null;
    }
    if (typeof window !== 'undefined' && typeof window[trimmed] === 'function') {
        return window[trimmed];
    }
    return null;
}

export const VibeStorage = {
    getEngine(type = 'local') {
        try {
            return type === 'session' ? window.sessionStorage : window.localStorage;
        } catch {
            return null;
        }
    },

    readArray(key, type = 'local') {
        try {
            const raw = this.getEngine(type)?.getItem(key);
            if (!raw) return [];
            const parsed = JSON.parse(raw);
            return Array.isArray(parsed) ? parsed : [];
        } catch {
            return [];
        }
    },

    writeArray(key, items, type = 'local') {
        try {
            this.getEngine(type)?.setItem(key, JSON.stringify(items));
        } catch {}
    },

    findItem(key, id, type = 'local') {
        return this.readArray(key, type).find((i) => i && i.id === id) || null;
    },

    upsertItem(key, id, buildEntry, type = 'local') {
        const items = this.readArray(key, type);
        const index = items.findIndex((i) => i && i.id === id);
        const current = index >= 0 ? items[index] : {};
        const entry = typeof buildEntry === 'function' ? buildEntry(current) : { ...current, ...buildEntry, id };
        if (index >= 0) {
            items[index] = entry;
        } else {
            items.push(entry);
        }
        this.writeArray(key, items, type);
        return entry;
    },

    removeItem(key, id, type = 'local') {
        if (!id) {
            try {
                this.getEngine(type)?.removeItem(key);
            } catch {}
            return;
        }
        const items = this.readArray(key, type).filter((i) => i && i.id !== id);
        this.writeArray(key, items, type);
    },

    pruneExpired(items, field = 'expired') {
        const now = Date.now();
        return (Array.isArray(items) ? items : []).filter((i) => {
            if (!i) return false;
            const exp = i[field];
            if (!exp) return true;
            const ts = typeof exp === 'number' ? exp : new Date(exp).getTime();
            return ts > now;
        });
    },
};

export function playAudioFeedback(sound) {
    if (!sound) return;
    if (typeof sound === 'string' && sound.length > 5) {
        try {
            const p = new Audio(sound).play();
            if (p !== undefined) p.catch((e) => console.warn('Audio play failed:', e));
        } catch (e) {
            console.warn('Audio play failed:', e);
        }
        return;
    }

    try {
        if (!window.vibeAudioContext || window.vibeAudioContext.state === 'closed') {
            const AudioCtx = window.AudioContext || window.webkitAudioContext;
            if (AudioCtx) window.vibeAudioContext = new AudioCtx();
        }
        const ctx = window.vibeAudioContext;
        if (!ctx) return;
        if (ctx.state === 'suspended') ctx.resume().catch(() => {});

        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        osc.connect(gain);
        gain.connect(ctx.destination);

        const now = ctx.currentTime;
        osc.type = 'sine';
        osc.frequency.setValueAtTime(800, now);
        osc.frequency.exponentialRampToValueAtTime(300, now + 0.12);

        gain.gain.setValueAtTime(0.3, now);
        gain.gain.exponentialRampToValueAtTime(0.001, now + 0.12);

        osc.start(now);
        osc.stop(now + 0.12);
    } catch (e) {
        console.warn('Web Audio API error:', e);
    }
}

export function decodeHtml(str) {
    if (!str || typeof str !== 'string' || !str.includes('&')) return str || '';
    const doc = new DOMParser().parseFromString(str, 'text/html');
    return doc.documentElement.textContent || '';
}

const SAFE_HTML_TAGS = new Set([
    'a', 'abbr', 'b', 'blockquote', 'br', 'code', 'dd', 'del', 'div', 'dl', 'dt',
    'em', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'hr', 'i', 'img', 'ins', 'kbd',
    'li', 'mark', 'ol', 'p', 'pre', 'q', 's', 'small', 'span', 'strong', 'sub',
    'sup', 'table', 'tbody', 'td', 'tfoot', 'th', 'thead', 'tr', 'u', 'ul',
    'svg', 'path', 'circle', 'rect', 'line', 'polyline', 'polygon', 'g',
]);

const SAFE_HTML_ATTRS = new Set([
    'class', 'id', 'title', 'alt', 'href', 'src', 'target', 'rel', 'width', 'height',
    'viewbox', 'fill', 'stroke', 'stroke-width', 'stroke-linecap', 'stroke-linejoin',
    'd', 'cx', 'cy', 'r', 'x', 'y', 'rx', 'ry', 'x1', 'y1', 'x2', 'y2', 'points',
    'xmlns', 'aria-hidden', 'aria-label', 'role',
]);

export function sanitizeHtmlFragment(html) {
    const doc = new DOMParser().parseFromString(String(html ?? ''), 'text/html');
    const frag = document.createDocumentFragment();

    const walk = (srcParent, destParent) => {
        for (const node of Array.from(srcParent.childNodes)) {
            if (node.nodeType === Node.TEXT_NODE) {
                destParent.appendChild(document.createTextNode(node.textContent || ''));
                continue;
            }
            if (node.nodeType !== Node.ELEMENT_NODE) continue;

            const tag = node.tagName.toLowerCase();
            if (!SAFE_HTML_TAGS.has(tag)) {
                // Keep plain text children for non-executable wrapper tags, drop script/style/iframe completely
                if (!['script', 'style', 'iframe', 'object', 'embed', 'template'].includes(tag)) {
                    walk(node, destParent);
                }
                continue;
            }

            const clean = tag === 'svg' || destParent.namespaceURI === 'http://www.w3.org/2000/svg'
                ? document.createElementNS('http://www.w3.org/2000/svg', tag)
                : document.createElement(tag);

            for (const attr of Array.from(node.attributes)) {
                const name = attr.name.toLowerCase();
                if (name.startsWith('on') || !SAFE_HTML_ATTRS.has(name)) continue;
                const val = attr.value.trim();
                if ((name === 'href' || name === 'src') && /^\s*(javascript|vbscript|data:(?!image\/(png|jpeg|jpg|webp|gif|avif);))/i.test(val)) {
                    continue;
                }
                clean.setAttribute(attr.name, attr.value);
            }
            walk(node, clean);
            destParent.appendChild(clean);
        }
    };

    walk(doc.body, frag);
    return frag;
}

export function setSafeHtml(el, html) {
    if (!el) return;
    const content = html !== null && html !== undefined ? String(html) : '';
    if (!content) {
        el.replaceChildren();
        return;
    }
    if ('setHTML' in Element.prototype) {
        el.setHTML(content);
        return;
    }
    el.replaceChildren(sanitizeHtmlFragment(content));
}

export function isSafeUrl(url, allowDataImage = false, allowBlob = false) {
    if (!url || typeof url !== 'string') return false;
    const trimmed = url.trim();
    if (trimmed.startsWith('/') && !trimmed.startsWith('//')) return true;
    if (allowDataImage && /^data:image\/(png|jpeg|jpg|webp|gif|avif);/i.test(trimmed)) return true;
    try {
        const parsed = new URL(trimmed, window.location.origin);
        return parsed.protocol === 'http:' || parsed.protocol === 'https:' || (allowBlob && parsed.protocol === 'blob:');
    } catch {
        return false;
    }
}

export function getScrollContainer(el) {
    const docsScroll = document.getElementById('docs-main-scroll');
    if (docsScroll && (!el || docsScroll.contains(el))) return docsScroll;
    let parent = el ? el.parentElement : null;
    while (parent && parent !== document.body && parent !== document.documentElement) {
        const style = window.getComputedStyle(parent);
        if (style.overflowY === 'auto' || style.overflowY === 'scroll') return parent;
        parent = parent.parentElement;
    }
    return window;
}

export function getStickyHeaderOffset(scrollContainer, defaultOffset = 40) {
    const stickyHeader = (scrollContainer && scrollContainer !== window)
        ? scrollContainer.querySelector('header.sticky, header[data-variant="sticky"], .has-sticky-header > header')
        : document.querySelector('header.sticky, header[data-variant="sticky"]');
    return stickyHeader ? ((stickyHeader.offsetHeight || 56) + 24) : defaultOffset;
}

const copyTimers = new WeakMap();
let lastClipboardAnnouncement = '';

function legacyCopyText(text) {
    const previousFocus = document.activeElement;
    const field = Object.assign(document.createElement('textarea'), { value: text });
    field.setAttribute('readonly', '');
    field.style.cssText = 'position:fixed;inset-block-start:0;opacity:0';
    document.body.append(field);
    field.select();
    try {
        return document.execCommand('copy');
    } finally {
        field.remove();
        previousFocus?.focus?.({ preventScroll: true });
    }
}

function resolveCopyPayload(button, target = null) {
    const inlineValue = button?.dataset?.clipboardValue ?? button?.getAttribute?.('value');
    if (inlineValue !== undefined && inlineValue !== null && inlineValue !== '') {
        return String(inlineValue);
    }

    if (target) {
        if (target.matches?.('input, textarea, select')) {
            return String(target.value ?? '');
        }
        if (target.dataset?.clipboardValue !== undefined && target.dataset.clipboardValue !== '') {
            return String(target.dataset.clipboardValue);
        }
        return String(target.innerText ?? target.textContent ?? '').trim();
    }

    return '';
}

export async function copyToClipboard(text, options = {}) {
    const {
        button = null,
        statusEl = null,
        copiedText = 'Copied',
        failedText = 'Copy failed',
        duration = 2000,
        toast = false,
        toastSuccess = null,
        toastError = null,
    } = options;

    const value = String(text ?? '');
    if (!value) return false;

    let ok = false;
    try {
        if (navigator.clipboard && window.isSecureContext) {
            await navigator.clipboard.writeText(value);
            ok = true;
        } else {
            ok = legacyCopyText(value);
        }
    } catch {
        try {
            ok = legacyCopyText(value);
        } catch {
            ok = false;
        }
    }

    if (button) {
        clearTimeout(copyTimers.get(button));
        button.removeAttribute('data-copied');
        button.removeAttribute('data-failed');
        void button.offsetWidth;
        button.setAttribute(ok ? 'data-copied' : 'data-failed', '');
    }

    if (statusEl) {
        let message = ok ? copiedText : failedText;
        if (message === lastClipboardAnnouncement) {
            message += '\u00A0';
        }
        lastClipboardAnnouncement = message;
        statusEl.textContent = '';
        requestAnimationFrame(() => {
            statusEl.textContent = message;
        });
    }

    if (toast && typeof window !== 'undefined' && window.$vibe?.toast) {
        if (ok && typeof window.$vibe.toast.success === 'function') {
            window.$vibe.toast.success(toastSuccess || copiedText);
        } else if (!ok && typeof window.$vibe.toast.error === 'function') {
            window.$vibe.toast.error(toastError || failedText);
        }
    }

    if (button) {
        button.dispatchEvent(new CustomEvent(ok ? 'vibe:clipboard-copied' : 'vibe:clipboard-failed', {
            bubbles: true,
            detail: { value, ok },
        }));
    }

    if (button || statusEl) {
        const keyTarget = button || statusEl;
        clearTimeout(copyTimers.get(keyTarget));
        copyTimers.set(keyTarget, setTimeout(() => {
            button?.removeAttribute('data-copied');
            button?.removeAttribute('data-failed');
            if (statusEl) statusEl.textContent = '';
        }, duration));
    }

    return ok;
}

export async function triggerClipboardCopy(button, target = null) {
    if (!button || button.disabled) return false;

    const resolvedTarget = target || (button.hasAttribute('commandfor')
        ? document.getElementById(button.getAttribute('commandfor'))
        : null);
    const text = resolveCopyPayload(button, resolvedTarget);
    if (!text) return false;

    const host = button.closest('[data-vibe-clipboard]') || button.parentElement;
    const statusEl = host?.querySelector('[data-vibe-clipboard-status]')
        || (button.nextElementSibling?.getAttribute('role') === 'status' ? button.nextElementSibling : null);

    const rawDuration = Number(button.dataset.copyDuration);
    const toastAttr = button.dataset.copyToast;
    const hasToast = Boolean(toastAttr && toastAttr !== 'false' && toastAttr !== '0');

    return copyToClipboard(text, {
        button,
        statusEl,
        copiedText: button.dataset.copiedText || 'Copied!',
        failedText: button.dataset.failedText || 'Copy failed',
        duration: Number.isFinite(rawDuration) && rawDuration > 0 ? rawDuration : 2000,
        toast: hasToast,
        toastSuccess: (hasToast && toastAttr !== 'true' && toastAttr !== '1') ? toastAttr : (button.dataset.copiedToast || null),
        toastError: button.dataset.failedToast || null,
    });
}

export function initClipboardCommands() {
    if (typeof document === 'undefined' || document._vibeClipboardBound) return;
    document._vibeClipboardBound = true;

    // Use native Invoker Commands when targeting an element, plus click fallback for older engines or inline values
    document.addEventListener('command', (event) => {
        if (typeof event.command === 'string' && event.command.startsWith('--copy')) {
            triggerClipboardCopy(event.source, event.target);
        }
    }, true);

    document.addEventListener('click', (event) => {
        if (event.defaultPrevented) return;
        const button = event.target?.closest?.('button[command^="--copy"]');
        if (!button) return;
        if ('CommandEvent' in window && button.hasAttribute('commandfor')) return;
        triggerClipboardCopy(button);
    });
}

export const VibeClipboard = {
    copy: copyToClipboard,
    copyFromTrigger: triggerClipboardCopy,
    resolveTargetValue: resolveCopyPayload,
    init: initClipboardCommands,
};

export function bindDialogLightDismissFallback(dialogEl, onDismiss) {
    if (!dialogEl || ('closedBy' in HTMLDialogElement.prototype)) return;
    if (dialogEl._vibeLightDismissBound) return;
    dialogEl._vibeLightDismissBound = true;

    const isOutside = (e) => {
        const r = dialogEl.getBoundingClientRect();
        return e.clientX < r.left || e.clientX > r.right || e.clientY < r.top || e.clientY > r.bottom;
    };

    let pressedOutside = false;
    dialogEl.addEventListener('pointerdown', (e) => {
        pressedOutside = isOutside(e);
    });
    dialogEl.addEventListener('pointerup', (e) => {
        if (pressedOutside && isOutside(e)) {
            onDismiss?.();
        }
        pressedOutside = false;
    });
}

/**
 * Accessible form error synchronization matching :user-invalid with aria-invalid,
 * dynamic aria-describedby linking, and one polite page-level live region.
 */
export function initFormA11y() {
    if (typeof window === 'undefined' || window.__vibeFormA11yInitialized) return;
    window.__vibeFormA11yInitialized = true;

    const supportsUserInvalid = typeof CSS !== 'undefined' && CSS.supports?.('selector(:user-invalid)');
    const flagged = new WeakSet();
    const announced = new WeakSet();
    let announcer = null;
    let announceTimer = null;
    let announcedField = null;

    const getAnnouncer = () => {
        if (announcer && announcer.isConnected) return announcer;
        announcer = document.createElement('div');
        announcer.setAttribute('aria-live', 'polite');
        announcer.className = 'sr-only';
        document.body?.appendChild(announcer);
        return announcer;
    };

    const linkError = (el, shown) => {
        const errorId = el.dataset?.error;
        if (!errorId) return;
        const ids = (el.getAttribute('aria-describedby') || '')
            .split(/\s+/)
            .filter((id) => id && id !== errorId);
        if (shown) ids.push(errorId);
        if (ids.length) el.setAttribute('aria-describedby', ids.join(' '));
        else el.removeAttribute('aria-describedby');
    };

    const announceError = (el) => {
        const errorId = el.dataset?.error;
        if (!errorId) return;
        const errorEl = document.getElementById(errorId);
        if (!errorEl) return;
        const labelEl = el.labels?.[0];
        const prefix = labelEl ? `${labelEl.textContent.replace(/\s+/g, ' ').trim()}: ` : '';
        const text = errorEl.textContent.replace(/\s+/g, ' ').trim();
        if (!text) return;

        const live = getAnnouncer();
        clearTimeout(announceTimer);
        live.textContent = '';
        announcedField = el;
        announceTimer = setTimeout(() => {
            live.textContent = prefix + text;
        }, 500);
    };

    const syncAria = (el, announce = false) => {
        if (!el || !el.matches?.('input:not([type="hidden"]):not([type="range"]), select, textarea')) return;
        if (el.hasAttribute('data-vibe-server-invalid')) return;

        let invalid = false;
        if (supportsUserInvalid) {
            invalid = el.matches(':user-invalid');
        } else if (flagged.has(el) && el.checkValidity) {
            invalid = !el.validity.valid;
        }

        if (invalid) {
            if (announce && !announced.has(el)) {
                announceError(el);
                announced.add(el);
            }
            el.setAttribute('aria-invalid', 'true');
            linkError(el, true);
            flagged.add(el);
        } else if (flagged.has(el) || el.getAttribute('aria-invalid') !== 'true') {
            el.setAttribute('aria-invalid', 'false');
            linkError(el, false);
            flagged.delete(el);
            announced.delete(el);
            if (announcedField === el && announcer) {
                clearTimeout(announceTimer);
                announcer.textContent = '';
            }
        }
    };

    const seedFields = () => {
        document.querySelectorAll('input:not([type="hidden"]):not([type="range"]), select, textarea').forEach((el) => {
            if (el.getAttribute('aria-invalid') === 'true') {
                el.setAttribute('data-vibe-server-invalid', 'true');
            } else if (!el.hasAttribute('aria-invalid')) {
                el.setAttribute('aria-invalid', 'false');
            }
        });
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', seedFields, { once: true });
    } else {
        seedFields();
    }
    document.addEventListener('livewire:navigated', seedFields);

    document.addEventListener('blur', (e) => {
        if (!supportsUserInvalid && e.target?.checkValidity) flagged.add(e.target);
        syncAria(e.target, true);
    }, true);

    document.addEventListener('input', (e) => {
        if (e.target?.hasAttribute?.('data-vibe-server-invalid')) {
            e.target.removeAttribute('data-vibe-server-invalid');
        }
        if (e.target?.hasAttribute?.('aria-invalid')) {
            syncAria(e.target, false);
        }
    });

    document.addEventListener('change', (e) => {
        if (!supportsUserInvalid && e.target?.checkValidity) flagged.add(e.target);
        syncAria(e.target, true);
    }, true);

    document.addEventListener('invalid', (e) => {
        announced.add(e.target);
        flagged.add(e.target);
        syncAria(e.target, false);
    }, true);

    document.addEventListener('reset', (e) => {
        setTimeout(() => {
            if (!e.target?.elements) return;
            Array.from(e.target.elements).forEach((el) => {
                flagged.delete(el);
                announced.delete(el);
                el.removeAttribute?.('data-vibe-server-invalid');
                syncAria(el, false);
            });
        });
    }, true);
}

export const VibeCore = {
    getPrefix,
    extractEventTarget,
    evalCallback,
    parseCallbackExpression,
    storage: VibeStorage,
    playAudio: playAudioFeedback,
    decodeHtml,
    sanitizeHtmlFragment,
    setSafeHtml,
    isSafeUrl,
    getScrollContainer,
    getStickyHeaderOffset,
    copy: copyToClipboard,
    clipboard: VibeClipboard,
    bindDialogLightDismissFallback,
    bindLightDismissFallback: bindDialogLightDismissFallback,
    initFormA11y,
};

if (typeof window !== 'undefined') {
    window.VibeCore = VibeCore;
    window.VibeClipboard = VibeClipboard;
    initClipboardCommands();
    initFormA11y();
}

export default VibeCore;
