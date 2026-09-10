export function vibeForm(config = {}) {
    let formId = null;
    let expireHours = 24;
    let storageType = 'session';
    let isAjax = true;
    let saveToStorage = false;

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

        async handleSubmit(event) {
            if (!isAjax) {
                if (saveToStorage) {
                    this.clearStorage();
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

            const form = this.$el;
            const action = form.getAttribute('action') || window.location.href;
            const method = (form.getAttribute('method') || 'POST').toUpperCase();
            const formData = new FormData(form);

            // Extract CSRF token
            let csrfToken = null;
            const csrfInput = form.querySelector('input[name="_token"]');
            if (csrfInput) {
                csrfToken = csrfInput.value;
            } else {
                const metaCsrf = document.querySelector('meta[name="csrf-token"]');
                if (metaCsrf) {
                    csrfToken = metaCsrf.getAttribute('content');
                }
            }

            this.loading = true;
            this.error = null;

            // Trigger submit events
            const submitDetail = { form, id: formId, formData };
            window.dispatchEvent(new CustomEvent('vibe-form-submit', { detail: submitDetail }));
            form.dispatchEvent(new CustomEvent('vibe-submit', { detail: submitDetail }));

            try {
                const headers = {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                };
                if (csrfToken) {
                    headers['X-CSRF-TOKEN'] = csrfToken;
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

            } catch (err) {
                console.error('vibeForm: error caught!', err);
                this.loading = false;
                this.error = err.data || err;

                const errorDetail = { form, id: formId, error: this.error, response: err.response };
                window.dispatchEvent(new CustomEvent('vibe-form-error', { detail: errorDetail }));
                form.dispatchEvent(new CustomEvent('vibe-error', { detail: errorDetail }));
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
