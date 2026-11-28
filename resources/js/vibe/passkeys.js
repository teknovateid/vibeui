import { Passkeys, UserCancelledError, InvalidDomainError } from '@laravel/passkeys';

window.Passkeys = Passkeys;
window.VibePasskeys = Passkeys;

const pk = () => window.VibeCommonI18n?.passkey || {};

export const VibePasskeyService = {
    client: Passkeys,

    isSupported() {
        return typeof window !== 'undefined' && Passkeys.isSupported();
    },

    async isAutofillSupported() {
        return typeof window !== 'undefined' && await Passkeys.isAutofillSupported();
    },

    async authenticate(options = {}) {
        if (typeof window !== 'undefined' && (window.location.hostname === '127.0.0.1' || window.location.hostname === '::1')) {
            const port = window.location.port ? `:${window.location.port}` : '';
            const localhostUrl = `http://localhost${port}${window.location.pathname}${window.location.search}`;
            const tpl = pk().ip_address_notice || 'WebAuthn (Passkey) requires a valid domain name. During local development, please use localhost instead of IP address 127.0.0.1 (e.g. :url).';
            return {
                success: false,
                isIpAddress: true,
                localhostUrl,
                message: tpl.replace(':url', `http://localhost${port}${window.location.pathname}`)
            };
        }

        try {
            const response = await Passkeys.verify(options);
            return { success: true, response };
        } catch (error) {
            console.warn('Passkey verify error:', error);

            if (error instanceof InvalidDomainError || error?.name === 'InvalidDomainError') {
                const port = typeof window !== 'undefined' && window.location.port ? `:${window.location.port}` : '';
                const tpl = pk().invalid_domain || 'Invalid domain for Passkey. Please use :url';
                return { 
                    success: false, 
                    message: tpl.replace(':url', `http://localhost${port}`) 
                };
            }

            if (error instanceof UserCancelledError || error?.name === 'NotAllowedError' || error?.name === 'UserCancelledError') {
                return { 
                    success: false, 
                    cancelled: true, 
                    message: pk().auth_cancelled || 'No Passkey is registered on this device for this application yet, or the authentication prompt was cancelled. Please sign in with your password first and register a Passkey.' 
                };
            }

            return { success: false, message: error?.message || pk().verify_failed || 'Failed to verify passkey.' };
        }
    },

    async register(name) {
        const deviceName = name || pk().default_device || 'My Device';
        if (typeof window !== 'undefined' && (window.location.hostname === '127.0.0.1' || window.location.hostname === '::1')) {
            const port = window.location.port ? `:${window.location.port}` : '';
            const localhostUrl = `http://localhost${port}${window.location.pathname}${window.location.search}`;
            const tpl = pk().ip_address_notice || 'WebAuthn (Passkey) requires a valid domain name. During local development, please use localhost instead of IP address 127.0.0.1 (e.g. :url).';
            return {
                success: false,
                isIpAddress: true,
                localhostUrl,
                message: tpl.replace(':url', `http://localhost${port}${window.location.pathname}`)
            };
        }

        try {
            const response = await Passkeys.register({ name: deviceName });
            return { success: true, response };
        } catch (error) {
            console.warn('Passkey register error:', error);

            if (error instanceof InvalidDomainError || error?.name === 'InvalidDomainError') {
                const port = typeof window !== 'undefined' && window.location.port ? `:${window.location.port}` : '';
                const tpl = pk().invalid_domain || 'Invalid domain for Passkey. Please use :url';
                return { 
                    success: false, 
                    message: tpl.replace(':url', `http://localhost${port}`) 
                };
            }

            if (error instanceof UserCancelledError || error?.name === 'NotAllowedError' || error?.name === 'UserCancelledError') {
                return { success: false, cancelled: true, message: pk().register_cancelled || 'Passkey registration was cancelled by user.' };
            }

            if (error?.status === 423 || error?.response?.status === 423 || error?.message?.includes('423') || error?.message?.toLowerCase().includes('password confirmation')) {
                return { 
                    success: false, 
                    confirmationRequired: true, 
                    message: pk().sudo_required || 'Password confirmation (sudo mode) is required before registering a new Passkey.' 
                };
            }

            return { success: false, message: error?.message || pk().register_failed || 'Failed to register passkey.', error };
        }
    },
};

window.VibePasskeyService = VibePasskeyService;

window.vibeLoginWithPasskey = async function(btn, redirectUrl) {
    let textSpan = null;
    let loadingSpan = null;

    if (btn) {
        btn.setAttribute('disabled', 'true');
        textSpan = btn.querySelector('.vibe-passkey-text');
        loadingSpan = btn.querySelector('.vibe-passkey-loading');
        if (textSpan) textSpan.style.display = 'none';
        if (loadingSpan) loadingSpan.style.display = 'inline-flex';
    }

    // Auto-resolve Livewire component from element ancestor
    const wireId = btn?.closest('[wire\\:id]')?.getAttribute('wire:id');
    const wire = wireId && window.Livewire ? window.Livewire.find(wireId) : null;

    try {
        const res = await VibePasskeyService.authenticate();
        if (res.success) {
            window.location.href = redirectUrl;
            return;
        }

        if (wire && typeof wire.handlePasskeyError === 'function') {
            await wire.handlePasskeyError(res.message, !!res.isIpAddress, res.localhostUrl || null);
        }
    } catch (e) {
        if (wire && typeof wire.handlePasskeyError === 'function') {
            await wire.handlePasskeyError(e.message || pk().verify_error || 'An error occurred while verifying passkey.', false, null);
        }
    } finally {
        if (btn) {
            btn.removeAttribute('disabled');
            if (textSpan) textSpan.style.display = 'inline-flex';
            if (loadingSpan) loadingSpan.style.display = 'none';
        }
    }
};

window.vibeConfirmWithPasskey = async function(btn, redirectUrl) {
    let textSpan = null;
    let loadingSpan = null;

    if (btn) {
        btn.setAttribute('disabled', 'true');
        textSpan = btn.querySelector('.vibe-passkey-text');
        loadingSpan = btn.querySelector('.vibe-passkey-loading');
        if (textSpan) textSpan.style.display = 'none';
        if (loadingSpan) loadingSpan.style.display = 'inline-flex';
    }

    try {
        if (!Passkeys) {
            throw new Error(pk().not_loaded || 'Passkey module is not loaded yet.');
        }

        const res = await Passkeys.verify({
            routes: {
                options: '/passkeys/confirm/options',
                submit: '/passkeys/confirm',
            },
        });

        var dest = (res && res.redirect) ? res.redirect : (redirectUrl || '/');
        window.location.href = dest;
    } catch (e) {
        console.warn('Passkey confirm error:', e);
        if (btn) {
            btn.removeAttribute('disabled');
            if (textSpan) textSpan.style.display = 'inline-flex';
            if (loadingSpan) loadingSpan.style.display = 'none';
        }
        if (window.vibeToast) {
            window.vibeToast(e.message || pk().confirm_failed || 'Failed to confirm with passkey.', { type: 'error' });
        } else {
            alert(e.message || pk().confirm_failed || 'Failed to confirm with passkey.');
        }
    }
};

let isAutofillActive = false;
let autofillTimer = null;
let autofillAbortController = null;

function cancelPasskeyAutofill() {
    if (autofillTimer) {
        clearTimeout(autofillTimer);
        autofillTimer = null;
    }
    if (autofillAbortController) {
        autofillAbortController.abort();
        autofillAbortController = null;
    }
    try {
        Passkeys.cancel?.();
    } catch {}
    isAutofillActive = false;
}

function initPasskeyAutofill() {
    // Prevent duplicate concurrent autofill triggers
    if (isAutofillActive) return;

    const el = document.querySelector('[data-vibe-passkey]');
    if (!el) return;

    // Do not call autofill on IP addresses (127.0.0.1 or ::1) to avoid wasting rate limits
    if (typeof window !== 'undefined' && (window.location.hostname === '127.0.0.1' || window.location.hostname === '::1')) {
        return;
    }

    const redirectUrl = el.getAttribute('data-vibe-passkey') || '/';

    if (window.PublicKeyCredential && VibePasskeyService.isSupported()) {
        isAutofillActive = true;
        autofillAbortController = typeof AbortController !== 'undefined' ? new AbortController() : null;
        const signal = autofillAbortController?.signal;

        VibePasskeyService.isAutofillSupported?.().then(supported => {
            if (!supported || signal?.aborted) {
                isAutofillActive = false;
                return;
            }
            VibePasskeyService.client?.autofill?.({ signal }).then(res => {
                if (res && !signal?.aborted) window.location.href = redirectUrl;
            }).catch((err) => {
                if (err?.name !== 'AbortError') {
                    console.debug('Passkey autofill idle or ignored:', err);
                }
            }).finally(() => {
                isAutofillActive = false;
            });
        }).catch(() => {
            isAutofillActive = false;
        });
    }
}

if (typeof window !== 'undefined') {
    window.addEventListener('DOMContentLoaded', () => {
        autofillTimer = setTimeout(initPasskeyAutofill, 200);
    }, { once: true });

    document.addEventListener('livewire:navigating', () => {
        cancelPasskeyAutofill();
    });

    document.addEventListener('livewire:navigated', () => {
        cancelPasskeyAutofill();
        autofillTimer = setTimeout(initPasskeyAutofill, 200);
    });
}
