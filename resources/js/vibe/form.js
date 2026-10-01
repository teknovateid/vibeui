export function vibeForm(config = {}) {
    let formId = null;
    let expireHours = 24;
    let storageType = 'session';
    let isAjax = true;
    let saveToStorage = false;
    let statusMode = false;   // false | true | 'toast' | 'alert'
    let delay = null;         // ms
    let redirectTo = null;    // URL string or null
    let onSuccess = null;     // JS expression string or null
    let onError = null;       // JS expression string or null
    let confirmPassword = true;
    let confirmPasswordUrl = '/confirm-password';
    let i18n = {};
    let _self = null;         // Captured Alpine proxy (set in init) — ensures correct $el even when submit() is called from alert callbacks

    if (typeof config === 'string') {
        formId = config;
        expireHours = arguments[1] || 24;
        storageType = arguments[2] || 'session';
        isAjax = arguments[3] !== undefined ? Boolean(arguments[3]) : true;
        saveToStorage = true;
    } else if (typeof config === 'object' && config !== null) {
        formId = config.id || null;
        expireHours = config.expireHours || 24;
        storageType = config.storageType || 'session';
        isAjax = config.ajax !== undefined ? Boolean(config.ajax) : true;
        saveToStorage = Boolean(config.saveToStorage);
        statusMode = config.status !== undefined ? config.status : false;
        delay = config.delay !== undefined ? config.delay : null;
        redirectTo = config.redirectTo || null;
        onSuccess = config.onSuccess || null;
        onError = config.onError || null;
        confirmPassword = config.confirmPassword !== undefined ? Boolean(config.confirmPassword) : true;
        confirmPasswordUrl = config.confirmPasswordUrl || '/confirm-password';
        i18n = config.i18n || {};
    }

    // ==========================================
    // HELPER: Dispatch notification (toast or alert)
    // ==========================================
    function notify(type, title, message) {
        if (!statusMode) return;

        if (statusMode === 'alert') {
            // Use vibe:alert pop-up
            window.dispatchEvent(new CustomEvent('alert', {
                detail: { type, title: title || (type === 'error' ? 'Terjadi Kesalahan' : 'Pemberitahuan'), message }
            }));
        } else {
            // Default: Toast notification
            if (window.$vibe && window.$vibe.toast) {
                if (typeof window.$vibe.toast[type] === 'function') {
                    if (title && title !== message) {
                        window.$vibe.toast[type](message, title);
                    } else {
                        window.$vibe.toast[type](message);
                    }
                } else {
                    const opts = (title && title !== message) ? { title } : {};
                    window.$vibe.toast(message, type, opts);
                }
            } else {
                const detail = { type, message };
                if (title && title !== message) detail.title = title;
                window.dispatchEvent(new CustomEvent('toast', { detail }));
            }
        }
    }

    // ==========================================
    // HELPER: Parse HTTP error response into title + message (O(1) Dictionary Lookup)
    // ==========================================
    function parseErrorMessage(status, data) {
        const httpMap = i18n.http_errors || {};

        // 422 - Laravel Validation Error
        if (status === 422) {
            let message = '';
            if (data && data.message) {
                message = data.message;
            } else if (data && data.errors && typeof data.errors === 'object') {
                const errorLines = [];
                Object.values(data.errors).forEach(fieldErrors => {
                    if (Array.isArray(fieldErrors)) {
                        fieldErrors.forEach(e => errorLines.push(e));
                    } else if (typeof fieldErrors === 'string') {
                        errorLines.push(fieldErrors);
                    }
                });
                if (errorLines.length > 0) {
                    const first = errorLines[0];
                    const remaining = errorLines.length - 1;
                    const suffix = httpMap.and_more_errors || '(:count more errors)';
                    message = remaining > 0 ? `${first} ${suffix.replace(':count', remaining)}` : first;
                }
            }
            return {
                title: null,
                message: message || (httpMap['422'] && httpMap['422'].message) || 'Validation Failed'
            };
        }

        // Direct O(1) hash map lookup
        const entry = httpMap[status];
        if (entry) {
            return {
                title: entry.title,
                message: (data && data.message) || entry.message
            };
        }

        // Generic HTTP status
        if (status) {
            const generic = httpMap.generic || { title: 'Error :status', message: 'Request failed (:status)' };
            return {
                title: generic.title.replace(':status', status),
                message: (data && data.message) || generic.message.replace(':status', status)
            };
        }

        // Network error fallback
        return httpMap.network || { title: 'Network Error', message: 'Unable to connect to the server.' };
    }

    // ==========================================
    // HELPER: Execute onSuccess / onError callback string
    // ==========================================
    function executeCallback(code, data, response) {
        if (!code) return;
        try {
            if (typeof code === 'function') {
                code(data, response);
                return;
            }
            if (typeof code === 'string') {
                // Make $vibe available in scope
                const $vibe = window.$vibe;
                // eslint-disable-next-line no-new-func
                (new Function('$vibe', 'data', 'response', code))($vibe, data, response);
            }
        } catch (e) {
            console.error('[vibeForm] onSuccess/onError callback error:', e);
        }
    }

    return {
        id: formId,
        loading: false,
        submitted: false,
        error: null,
        response: null,
        storageKey: (window.VIBE_PREFIX || 'vibe') + '-form',

        getStorageEngine() {
            return storageType === 'session' ? window.sessionStorage : window.localStorage;
        },

        init() {
            // Capture Alpine proxy in closure so submit() always has the right $el,
            // regardless of how/where it's called (e.g., from an alert confirm callback).
            _self = this;

            if (saveToStorage && formId) {
                this.restoreFromStorage();

                // Re-restore data when a sheet or modal opens,
                // to override Livewire's $this->reset() if the form is inside them.
                // BUG-FIX: Store handlers as named references so they can be properly
                // removed on destroy — prevents memory leak on SPA/Livewire navigation.
                this._sheetHandler = () => setTimeout(() => this.restoreFromStorage(), 100);
                this._modalHandler = () => setTimeout(() => this.restoreFromStorage(), 100);
                window.addEventListener('open-sheet', this._sheetHandler);
                window.addEventListener('open-modal', this._modalHandler);

                if (typeof this.$cleanup === 'function') {
                    this.$cleanup(() => {
                        window.removeEventListener('open-sheet', this._sheetHandler);
                        window.removeEventListener('open-modal', this._modalHandler);
                    });
                }
            }
        },

        showConfirmPasswordModal: false,
        confirmPasswordInput: '',
        confirmPasswordLoading: false,
        confirmPasswordError: null,
        showConfirmPasswordText: false,

        closeConfirmPasswordModal() {
            this.showConfirmPasswordModal = false;
            this.confirmPasswordInput = '';
            this.confirmPasswordError = null;
            this.loading = false;
        },

        async submitConfirmPassword() {
            if (!this.confirmPasswordInput) return;
            this.confirmPasswordLoading = true;
            this.confirmPasswordError = null;

            try {
                const form = (_self && _self.$el) ? _self.$el : this.$el;
                let csrfToken = null;
                const csrfInput = form ? form.querySelector('input[name="_token"]') : null;
                if (csrfInput && csrfInput.value) {
                    csrfToken = csrfInput.value;
                }
                if (!csrfToken) {
                    const metaCsrf = document.querySelector('meta[name="csrf-token"]');
                    if (metaCsrf) csrfToken = metaCsrf.getAttribute('content');
                }

                const res = await fetch(confirmPasswordUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || '',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ password: this.confirmPasswordInput })
                });

                if (res.ok || res.status === 204) {
                    this.showConfirmPasswordModal = false;
                    this.confirmPasswordInput = '';
                    this.confirmPasswordError = null;

                    // Automatically replay the form submission!
                    setTimeout(() => {
                        this.submit();
                    }, 100);
                } else {
                    const data = await res.json().catch(() => ({}));
                    this.confirmPasswordError = (data && data.errors && data.errors.password && data.errors.password[0])
                        || (data && data.message)
                        || (i18n.password_incorrect || 'Kata sandi salah.');
                }
            } catch (err) {
                this.confirmPasswordError = i18n.network_error || 'Gagal memverifikasi kata sandi.';
            } finally {
                this.confirmPasswordLoading = false;
            }
        },

        // ==========================================
        // PUBLIC: submit() — call as `submit()` (no `this`) from Alpine @click expressions
        // e.g. @click="$vibe.alert.confirm('Yakin?', () => submit())"
        // Uses _self (closure-captured proxy) to guarantee correct $el context.
        // ==========================================
        submit() {
            const ctx = _self || this;
            return ctx.handleSubmit(null);
        },

        handleKeydownEnter(event) {
            const target = event.target;
            if (!target || event.defaultPrevented) return;

            // Do not submit if inside textarea or contenteditable element (Enter should make a newline)
            if (target.tagName === 'TEXTAREA' || target.isContentEditable) {
                return;
            }

            // Do not submit if focused on a button or link (normal activation)
            if (['BUTTON', 'A'].includes(target.tagName)) {
                return;
            }

            // Only trigger for input fields or select
            if (target.tagName === 'INPUT' || target.tagName === 'SELECT') {
                event.preventDefault();

                const form = (_self && _self.$el) ? _self.$el : this.$el;
                if (!form) return;

                // If form has an explicit submit button, click it to trigger native button clicks and validation
                const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
                if (submitBtn) {
                    submitBtn.click();
                    return;
                }

                // If no explicit submit button exists, validate form constraint validation first
                if (typeof form.reportValidity === 'function' && !form.reportValidity()) {
                    return;
                }

                this.submit();
            }
        },

        async handleSubmit(event) {
            // Use _self.$el (closure-captured proxy) as primary source.
            // Falls back to this.$el if called normally via @submit.
            const form = (_self && _self.$el) ? _self.$el : this.$el;
            const formData = new FormData(form);
            const submitDetail = { form, id: formId, formData, event };

            // Trigger submit events
            window.dispatchEvent(new CustomEvent('vibe-form-submit', { detail: submitDetail }));
            form.dispatchEvent(new CustomEvent('vibe-submit', { detail: submitDetail }));

            if (!isAjax) {
                if (saveToStorage) {
                    this.clearStorage();
                }
                if (!event) {
                    form.submit();
                }
                return; // Let standard browser submit proceed
            }

            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            if (this.loading) {
                return;
            }

            const action = form.getAttribute('action') || window.location.href;
            const method = (form.getAttribute('method') || 'POST').toUpperCase();

            // Extract CSRF token from input or meta tag
            let csrfToken = null;
            const csrfInput = form.querySelector('input[name="_token"]');
            if (csrfInput && csrfInput.value) {
                csrfToken = csrfInput.value;
            }
            if (!csrfToken) {
                const metaCsrf = document.querySelector('meta[name="csrf-token"]');
                if (metaCsrf) {
                    csrfToken = metaCsrf.getAttribute('content');
                }
            }

            // Ensure CSRF token is restored in input and formData
            if (csrfToken) {
                if (csrfInput && !csrfInput.value) {
                    csrfInput.value = csrfToken;
                }
                if (!formData.get('_token')) {
                    formData.set('_token', csrfToken);
                }
            }

            // Extract HTTP method override (supports @method('PUT'|'PATCH'|'DELETE') or form method attribute)
            const methodInput = form.querySelector('input[name="_method"]');
            let spoofedMethod = (methodInput && methodInput.value ? methodInput.value : formData.get('_method') || '').toUpperCase();
            if (['PUT', 'PATCH', 'DELETE'].includes(method) && !spoofedMethod) {
                spoofedMethod = method;
            }

            this.loading = true;
            this.error = null;

            try {
                const headers = {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                };
                if (csrfToken) {
                    headers['X-CSRF-TOKEN'] = csrfToken;
                }
                if (spoofedMethod) {
                    formData.set('_method', spoofedMethod);
                    headers['X-HTTP-Method-Override'] = spoofedMethod;
                }

                let fetchOptions = {
                    method: method === 'GET' ? 'GET' : 'POST',
                    headers: headers,
                };

                let targetUrl = action;
                if (method === 'GET') {
                    const paramsStr = new URLSearchParams(formData).toString();
                    targetUrl = action + (action.includes('?') ? '&' : '?') + paramsStr;
                } else {
                    fetchOptions.body = formData;
                }

                const res = await fetch(targetUrl, fetchOptions);
                const contentType = res.headers.get('content-type') || '';
                let data = null;

                if (contentType.includes('application/json')) {
                    data = await res.json();
                } else {
                    const text = await res.text();
                    try {
                        data = JSON.parse(text);
                    } catch (e) {
                        data = { text: text };
                    }
                }

                if (!res.ok) {
                    throw { response: res, data };
                }

                this.loading = false;
                this.submitted = true;
                this.response = data;

                if (saveToStorage) {
                    this.clearStorage();
                }

                // Dispatch success events with payload
                const successDetail = { form, id: formId, data, response: res };
                window.dispatchEvent(new CustomEvent('vibe-form-success', { detail: successDetail }));
                window.dispatchEvent(new CustomEvent('vibe-form-submitted', { detail: successDetail }));
                form.dispatchEvent(new CustomEvent('vibe-success', { detail: successDetail }));

                // ------ POST-SUBMIT ACTIONS (onSuccess, redirectTo, delay) ------
                // NOTE: status only shows ERROR notifications. Success toast/close/redirect
                // is handled via onSuccess callback by the developer.
                const hasAction = onSuccess || redirectTo || (data && (data.redirect || data.redirect_to));
                const effectiveDelay = delay !== null ? parseInt(delay) : 0;

                if (hasAction || onSuccess) {
                    const doActions = () => {
                        // Execute onSuccess callback
                        if (onSuccess) {
                            executeCallback(onSuccess, data, res);
                        }

                        // Redirect: prop > server json
                        const finalRedirect = redirectTo || (data && (data.redirect || data.redirect_to)) || null;
                        if (finalRedirect) {
                            // Use Livewire.navigate if available for SPA-style nav
                            if (window.Livewire && typeof window.Livewire.navigate === 'function') {
                                window.Livewire.navigate(finalRedirect);
                            } else {
                                window.location.href = finalRedirect;
                            }
                        }
                    };

                    if (effectiveDelay > 0) {
                        setTimeout(doActions, effectiveDelay);
                    } else {
                        doActions();
                    }
                }

            } catch (err) {
                console.error('vibeForm: error caught!', err);
                this.loading = false;
                this.error = err.data || err;

                const httpStatus = err.response ? err.response.status : null;

                // Auto intercept HTTP 423 (Password confirmation required)
                if (httpStatus === 423 && confirmPassword && isAjax) {
                    this.confirmPasswordInput = '';
                    this.confirmPasswordError = null;
                    this.showConfirmPasswordModal = true;
                    setTimeout(() => {
                        const input = this.$refs && this.$refs.confirmPasswordInputRef;
                        if (input) input.focus();
                    }, 100);
                    return;
                }

                const errorDetail = { form, id: formId, error: this.error, response: err.response };
                window.dispatchEvent(new CustomEvent('vibe-form-error', { detail: errorDetail }));
                form.dispatchEvent(new CustomEvent('vibe-error', { detail: errorDetail }));

                // ------ ERROR NOTIFICATION ------
                if (statusMode) {
                    const { title, message } = parseErrorMessage(httpStatus, err.data);
                    notify('error', title, message);
                }

                // Execute onError callback
                if (onError) {
                    executeCallback(onError, err.data, err.response);
                }
            }
        },

        getStorageData() {
            try {
                return JSON.parse(this.getStorageEngine().getItem(this.storageKey)) || [];
            } catch (e) {
                return [];
            }
        },

        setStorageData(data) {
            this.getStorageEngine().setItem(this.storageKey, JSON.stringify(data));
        },

        saveToStorage(formEl) {
            const formData = new FormData(formEl);
            const dataObj = {};

            for (let [key, value] of formData.entries()) {
                if (value instanceof File || key.startsWith('_') || key === 'components') continue;
                dataObj[key] = value;
            }

            if (Object.keys(dataObj).length === 0) return;

            let storageArray = this.getStorageData();
            const existingIndex = storageArray.findIndex(item => item.id === formId);

            const expirationDate = new Date();
            expirationDate.setHours(expirationDate.getHours() + expireHours);

            const newItem = {
                id: formId,
                data: dataObj,
                expiredAt: expirationDate.getTime()
            };

            if (existingIndex > -1) {
                storageArray[existingIndex] = newItem;
            } else {
                storageArray.push(newItem);
            }

            this.setStorageData(storageArray);
        },

        restoreFromStorage() {
            let storageArray = this.getStorageData();
            const now = new Date().getTime();

            let cleanedArray = storageArray.filter(item => item.expiredAt && item.expiredAt > now);
            if (cleanedArray.length !== storageArray.length) {
                this.setStorageData(cleanedArray);
                storageArray = cleanedArray;
            }

            const myData = storageArray.find(item => item.id === formId);

            if (myData && myData.data) {
                setTimeout(() => {
                    Object.entries(myData.data).forEach(([key, value]) => {
                        const input = this.$el.querySelector(`[name="${key}"]`);
                        if (input && input.value !== value) {
                            input.value = value;
                            input.dispatchEvent(new Event('input', { bubbles: true }));
                        }
                    });
                }, 50);
            }
        },

        clearStorage() {
            let storageArray = this.getStorageData();
            storageArray = storageArray.filter(item => item.id !== formId);
            this.setStorageData(storageArray);
        }
    };
}

// Auto-register in Alpine when available
function registerVibeForm() {
    if (typeof window !== 'undefined' && window.Alpine && typeof window.Alpine.data === 'function') {
        window.Alpine.data('vibeForm', vibeForm);
    }
}

if (typeof window !== 'undefined') {
    window.vibeForm = vibeForm;
    registerVibeForm();
    document.addEventListener('alpine:init', registerVibeForm);
    document.addEventListener('livewire:init', registerVibeForm);
    window.dispatchEvent(new CustomEvent('vibe-form-ready'));
}
