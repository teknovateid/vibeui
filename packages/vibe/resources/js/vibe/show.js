/**
 * Vibe UI - Data Show & Binding Engine (VibeShow)
 *
 * Supports:
 * - <vibe:button.show> trigger fetching data via AJAX
 * - <vibe:show key="..."> and [vibe-show="..."] single data binding
 * - <vibe:show.each key="..."> and [vibe-show-each="..."] array looping (table rows, cards)
 * - Automatic binding with all Vibe UI components:
 *   - <vibe:input>, <vibe:textarea>
 *   - <vibe:select> (single & multiple)
 *   - <vibe:checkbox>, <vibe:radio>, <vibe:switch>
 *   - <vibe:range>, <vibe:date-time>
 *   - <vibe:avatar>, <vibe:badge>
 * - Native form controls matching via [name] attribute fallback
 */

(function () {
    /**
     * Safely resolve nested object path with dot & bracket notation.
     * e.g. 'user.profile.name', 'products[0].title', '.'
     */
    function get(obj, path, defaultValue = '') {
        if (obj === null || obj === undefined) return defaultValue;
        if (!path || path === '.') return obj;

        // Normalize bracket access: items[0].name -> items.0.name
        const normalized = String(path).replace(/\[(\w+)\]/g, '.$1').replace(/^\./, '');
        const keys = normalized.split('.');

        let current = obj;
        for (const key of keys) {
            if (current === null || current === undefined || typeof current !== 'object') {
                return defaultValue;
            }
            current = current[key];
        }

        return current !== undefined && current !== null ? current : defaultValue;
    }

    /**
     * Set value on a DOM element or Vibe UI component.
     */
    function setElementValue(el, val) {
        if (!el) return;

        // 1. Explicit attribute binding: vibe-show-attr="src|href|title|..."
        if (el.hasAttribute('vibe-show-attr')) {
            const attr = el.getAttribute('vibe-show-attr');
            if (val !== null && val !== undefined) {
                el.setAttribute(attr, String(val));
            } else {
                el.removeAttribute(attr);
            }
            el.dispatchEvent(new CustomEvent('vibe:show:updated', { detail: { value: val }, bubbles: true }));
            return;
        }

        // 2. HTML injection: vibe-show-html
        if (el.hasAttribute('vibe-show-html')) {
            el.innerHTML = val !== null && val !== undefined ? String(val) : '';
            el.dispatchEvent(new CustomEvent('vibe:show:updated', { detail: { value: val }, bubbles: true }));
            return;
        }

        const tag = el.tagName ? el.tagName.toLowerCase() : '';

        // 3. Native & Vibe Input elements
        if (tag === 'input') {
            const type = (el.type || 'text').toLowerCase();

            if (type === 'checkbox') {
                if (Array.isArray(val)) {
                    el.checked = val.map(String).includes(String(el.value));
                } else {
                    el.checked = Boolean(val) && val !== '0' && val !== 0 && val !== false;
                }
                el.dispatchEvent(new Event('change', { bubbles: true }));
                el.dispatchEvent(new Event('input', { bubbles: true }));
            } else if (type === 'radio') {
                el.checked = String(el.value) === String(val);
                el.dispatchEvent(new Event('change', { bubbles: true }));
                el.dispatchEvent(new Event('input', { bubbles: true }));
            } else if (type === 'range') {
                el.value = val !== null && val !== undefined ? val : '';
                el.dispatchEvent(new Event('input', { bubbles: true }));
                el.dispatchEvent(new Event('change', { bubbles: true }));
                // Trigger range component updateProgress if inside vibe:range
                const alpineData = el._x_dataStack?.[0] || el.closest('[x-data]')?._x_dataStack?.[0];
                if (alpineData && typeof alpineData.updateProgress === 'function') {
                    alpineData.updateProgress(el);
                }
            } else {
                el.value = val !== null && val !== undefined ? val : '';
                el.dispatchEvent(new Event('input', { bubbles: true }));
                el.dispatchEvent(new Event('change', { bubbles: true }));
            }

            el.dispatchEvent(new CustomEvent('vibe:show:updated', { detail: { value: val }, bubbles: true }));
            return;
        }

        // 4. Textarea (supports vibe:textarea auto-resize and counter)
        if (tag === 'textarea') {
            el.value = val !== null && val !== undefined ? String(val) : '';
            el.dispatchEvent(new Event('input', { bubbles: true }));
            el.dispatchEvent(new Event('change', { bubbles: true }));
            el.dispatchEvent(new CustomEvent('vibe:show:updated', { detail: { value: val }, bubbles: true }));
            return;
        }

        // 5. Native Select
        if (tag === 'select') {
            if (el.multiple && Array.isArray(val)) {
                const strVals = val.map(String);
                Array.from(el.options).forEach(opt => {
                    opt.selected = strVals.includes(String(opt.value));
                });
            } else {
                el.value = val !== null && val !== undefined ? String(val) : '';
            }
            el.dispatchEvent(new Event('change', { bubbles: true }));
            el.dispatchEvent(new Event('input', { bubbles: true }));
            el.dispatchEvent(new CustomEvent('vibe:show:updated', { detail: { value: val }, bubbles: true }));
            return;
        }

        // 6. Custom Vibe Select (<vibe:select>)
        // Can be trigger or wrapper with Alpine store/instance
        const alpineComponent = el._x_dataStack?.[0] || el.closest('[x-data]')?._x_dataStack?.[0];
        if (alpineComponent && 'selectedLabel' in alpineComponent && 'updateSelectionFromValue' in alpineComponent) {
            alpineComponent.value = val;
            if (typeof alpineComponent.updateSelectionFromValue === 'function') {
                alpineComponent.updateSelectionFromValue();
            }
            const hiddenInput = el.closest('[x-data]')?.querySelector('[x-ref="hiddenInput"]');
            if (hiddenInput) {
                hiddenInput.value = Array.isArray(val) ? JSON.stringify(val) : (val ?? '');
                hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
                hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
            }
            el.dispatchEvent(new CustomEvent('vibe:show:updated', { detail: { value: val }, bubbles: true }));
            return;
        }

        // 7. Avatar (<vibe:avatar> or element with [data-avatar])
        const avatarContainer = el.hasAttribute('data-avatar') ? el : el.closest('[data-avatar]');
        if (avatarContainer) {
            const str = String(val ?? '').trim();
            const isUrl = str.startsWith('http://') || str.startsWith('https://') || str.startsWith('/') || str.startsWith('data:image');
            const innerWrap = avatarContainer.querySelector('div') || avatarContainer;

            if (isUrl) {
                let img = avatarContainer.querySelector('img');
                if (img) {
                    img.src = str;
                } else {
                    innerWrap.innerHTML = `<img src="${str}" class="w-full h-full object-cover" alt="" />`;
                }
            } else if (str) {
                let span = avatarContainer.querySelector('span');
                if (span) {
                    span.textContent = str;
                } else {
                    innerWrap.innerHTML = `<span class="font-semibold leading-none select-none">${str}</span>`;
                }
            }
            el.dispatchEvent(new CustomEvent('vibe:show:updated', { detail: { value: val }, bubbles: true }));
            return;
        }

        // 8. Image element (<img>)
        if (tag === 'img') {
            el.src = val !== null && val !== undefined ? String(val) : '';
            el.dispatchEvent(new CustomEvent('vibe:show:updated', { detail: { value: val }, bubbles: true }));
            return;
        }

        // 9. Anchor element (<a>)
        if (tag === 'a') {
            if (el.getAttribute('vibe-show-as') === 'href') {
                el.href = val !== null && val !== undefined ? String(val) : '#';
            } else {
                el.textContent = val !== null && val !== undefined ? String(val) : '';
            }
            el.dispatchEvent(new CustomEvent('vibe:show:updated', { detail: { value: val }, bubbles: true }));
            return;
        }

        // 10. Default / Text elements (span, div, p, td, badge, etc.)
        el.textContent = val !== null && val !== undefined ? String(val) : '';
        el.dispatchEvent(new CustomEvent('vibe:show:updated', { detail: { value: val }, bubbles: true }));
    }

    /**
     * Populate array/list container with looped rows cloned from <template>.
     * e.g. <tbody vibe-show-each="products"><template><tr>...</tr></template></tbody>
     */
    function populateEach(container, items) {
        if (!container) return;
        const template = container.querySelector('template');
        if (!template) return;

        const emptyEl = container.querySelector('[data-vibe-empty]') || container.querySelector('.vibe-show-empty');

        // Remove previously rendered rows/cards
        const oldRendered = container.querySelectorAll('[data-vibe-rendered="true"]');
        oldRendered.forEach(el => el.remove());

        const isArray = Array.isArray(items);
        const hasItems = isArray && items.length > 0;

        if (!hasItems) {
            if (emptyEl) {
                emptyEl.classList.remove('hidden');
                emptyEl.style.display = '';
            }
            return;
        }

        if (emptyEl) {
            emptyEl.classList.add('hidden');
            emptyEl.style.display = 'none';
        }

        const fragment = document.createDocumentFragment();

        items.forEach((item, index) => {
            const clone = template.content.cloneNode(true);

            // Populate all [vibe-show] elements inside the cloned item (descendants & direct children)
            const showElements = Array.from(clone.querySelectorAll('[vibe-show]'));
            Array.from(clone.children).forEach(child => {
                if (child.hasAttribute('vibe-show') && !showElements.includes(child)) {
                    showElements.unshift(child);
                }
            });
            showElements.forEach(el => {
                const key = el.getAttribute('vibe-show');
                let val;
                if (key === '$iteration') {
                    val = index + 1;
                } else if (key === '$index') {
                    val = index;
                } else if (key === '.') {
                    val = item;
                } else {
                    val = get(item, key, '');
                }
                setElementValue(el, val);
            });

            // Form controls inside repeated item (match by [name] attribute)
            if (typeof item === 'object' && item !== null) {
                const formElements = Array.from(clone.querySelectorAll('input[name], textarea[name], select[name]'));
                formElements.forEach(el => {
                    if (el.hasAttribute('vibe-show')) return;
                    const rawName = el.getAttribute('name') || '';
                    const cleanName = rawName.replace(/\[\w*\]/g, '').trim();
                    if (cleanName in item) {
                        setElementValue(el, item[cleanName]);
                    }
                });
            }

            // Nested each loops inside this item if any
            const nestedEach = Array.from(clone.querySelectorAll('[vibe-show-each]'));
            nestedEach.forEach(childContainer => {
                const childKey = childContainer.getAttribute('vibe-show-each');
                const childItems = get(item, childKey, []);
                populateEach(childContainer, childItems);
            });

            // Mark top-level elements of clone for future removal on re-population
            Array.from(clone.children).forEach(child => {
                child.setAttribute('data-vibe-rendered', 'true');
            });

            fragment.appendChild(clone);
        });

        if (emptyEl) {
            container.insertBefore(fragment, emptyEl);
        } else {
            container.appendChild(fragment);
        }
    }

    /**
     * Populate target element with data.
     */
    function populate(data, rootEl) {
        if (!rootEl) return;

        if (typeof rootEl === 'string') {
            const sel = rootEl.startsWith('#') || rootEl.startsWith('.') || rootEl.includes(' ')
                ? rootEl
                : '#' + rootEl;
            rootEl = document.querySelector(sel) || document.getElementById(rootEl);
        }

        if (!rootEl) return;

        // 1. Process Array Looping [vibe-show-each]
        const eachContainers = Array.from(rootEl.querySelectorAll('[vibe-show-each]'));
        if (rootEl.hasAttribute('vibe-show-each')) {
            eachContainers.unshift(rootEl);
        }
        eachContainers.forEach(container => {
            // Skip if inside a template (nested loop will be handled when parent template is cloned)
            if (container.closest('template')) return;
            const key = container.getAttribute('vibe-show-each');
            const items = get(data, key, []);
            populateEach(container, items);
        });

        // 2. Process Single Data Elements [vibe-show]
        const showElements = Array.from(rootEl.querySelectorAll('[vibe-show]'));
        if (rootEl.hasAttribute('vibe-show')) {
            showElements.unshift(rootEl);
        }
        showElements.forEach(el => {
            // Skip elements inside <template>
            if (el.closest('template')) return;
            // Skip elements that are inside an each-container or rendered by populateEach
            if (el.hasAttribute('data-vibe-rendered') || el.closest('[data-vibe-rendered="true"]')) return;
            const eachParent = el.closest('[vibe-show-each]');
            if (eachParent && eachParent !== el) return;

            const key = el.getAttribute('vibe-show');
            const val = get(data, key, '');
            setElementValue(el, val);
        });

        // 3. Auto form-matching for Vibe form elements with [name] attribute (fallback when no vibe-show)
        const formControls = Array.from(rootEl.querySelectorAll('input[name], textarea[name], select[name]'));
        formControls.forEach(el => {
            if (el.closest('template')) return;
            if (el.hasAttribute('data-vibe-rendered') || el.closest('[data-vibe-rendered="true"]')) return;
            const eachParent = el.closest('[vibe-show-each]');
            if (eachParent && eachParent !== el) return;
            if (el.hasAttribute('vibe-show')) return;

            const rawName = el.getAttribute('name') || '';
            // Convert bracket name notation: user[profile][phone] -> user.profile.phone
            const keyPath = rawName.replace(/\[(\w+)\]/g, '.$1').replace(/\[\]/g, '').replace(/^\./, '');
            if (!keyPath) return;

            const val = get(data, keyPath, undefined);
            if (val !== undefined) {
                setElementValue(el, val);
            }
        });

        // 4. Dispatch custom event vibe:show:success
        rootEl.dispatchEvent(new CustomEvent('vibe:show:success', {
            detail: { data },
            bubbles: true
        }));
    }

    /**
     * AJAX Fetch and Populate handler for <vibe:button.show>.
     */
    async function fetchAndShow(triggerEl, options = {}) {
        let url = options.url;
        let target = options.target;
        let method = options.method || 'GET';

        if (triggerEl instanceof Element) {
            url = url || triggerEl.getAttribute('data-url') || triggerEl.getAttribute('href');
            target = target || triggerEl.getAttribute('data-target');
            method = method || triggerEl.getAttribute('data-method') || 'GET';
        }

        if (!url) {
            console.error('[VibeShow] Missing URL in fetchAndShow');
            return;
        }

        if (!target) {
            console.error('[VibeShow] Missing target in fetchAndShow');
            return;
        }

        let targetEl = null;
        if (typeof target === 'string') {
            const sel = target.startsWith('#') || target.startsWith('.') || target.includes(' ')
                ? target
                : '#' + target;
            targetEl = document.querySelector(sel) || document.getElementById(target);
        } else if (target instanceof Element) {
            targetEl = target;
        }

        if (!targetEl) {
            console.warn('[VibeShow] Target element not found:', target);
        }

        // Set Loading state on trigger button
        if (triggerEl instanceof Element) {
            triggerEl.disabled = true;
            triggerEl.setAttribute('data-loading', 'true');
            triggerEl.classList.add('is-loading');
        }

        try {
            const response = await fetch(url, {
                method,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    ...(options.headers || {})
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error ${response.status}: ${response.statusText}`);
            }

            const json = await response.json();

            // Unwrap Laravel resource wrapper { data: { ... } } if present
            let payload = json;
            if (json && typeof json === 'object' && 'data' in json && typeof json.data === 'object' && json.data !== null && Object.keys(json).length <= 2) {
                payload = json.data;
            }

            if (targetEl) {
                populate(payload, targetEl);
            }

            // Auto-open Modal or Sheet if target matches or is container ID
            const targetId = typeof target === 'string' ? target.replace(/^#/, '') : (targetEl ? targetEl.id : null);
            if (targetId) {
                window.dispatchEvent(new CustomEvent('open-modal', { detail: targetId }));
                window.dispatchEvent(new CustomEvent('open-sheet', { detail: targetId }));
            }

            if (typeof options.onSuccess === 'function') {
                options.onSuccess(payload, targetEl);
            }

            return payload;
        } catch (err) {
            console.error('[VibeShow] Fetch error:', err);
            const errMsg = err.message || 'Failed to fetch data';
            if (window.$vibe && window.$vibe.toast) {
                window.$vibe.toast.error(errMsg);
            }
            if (typeof options.onError === 'function') {
                options.onError(err);
            }
            throw err;
        } finally {
            if (triggerEl instanceof Element) {
                triggerEl.disabled = false;
                triggerEl.removeAttribute('data-loading');
                triggerEl.classList.remove('is-loading');
            }
        }
    }

    const VibeShow = {
        get,
        setElementValue,
        populateEach,
        populate,
        fetchAndShow
    };

    window.VibeShow = VibeShow;
    window.vibeShow = VibeShow;
    window.vibeFetchAndShow = function (el, url, target, opts = {}) {
        return fetchAndShow(el, { url, target, ...opts });
    };

    if (window.$vibe) {
        window.$vibe.show = (url, target, opts = {}) => {
            return fetchAndShow(null, { url, target, ...opts });
        };
    } else {
        window.addEventListener('DOMContentLoaded', () => {
            if (window.$vibe) {
                window.$vibe.show = (url, target, opts = {}) => {
                    return fetchAndShow(null, { url, target, ...opts });
                };
            }
        }, { once: true });
    }
})();
