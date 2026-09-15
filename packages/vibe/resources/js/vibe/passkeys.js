import { Passkeys, UserCancelledError, InvalidDomainError } from '@laravel/passkeys';

window.Passkeys = Passkeys;
window.VibePasskeys = Passkeys;

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
            return {
                success: false,
                isIpAddress: true,
                localhostUrl: `http://localhost${port}${window.location.pathname}${window.location.search}`,
                message: `WebAuthn (Passkey) mewajibkan nama domain. Saat masih dalam tahap pengembangan (development), silakan gunakan localhost alih-alih alamat IP 127.0.0.1 (misal: http://localhost${port}${window.location.pathname}).`
            };
        }

        try {
            const response = await Passkeys.verify(options);
            return { success: true, response };
        } catch (error) {
            console.warn('Passkey verify error:', error);

            if (error instanceof InvalidDomainError || error?.name === 'InvalidDomainError') {
                const port = typeof window !== 'undefined' && window.location.port ? `:${window.location.port}` : '';
                return { 
                    success: false, 
                    message: `Domain tidak valid untuk Passkey. Pada masa development, silakan gunakan http://localhost${port}` 
                };
            }

            if (error instanceof UserCancelledError || error?.name === 'NotAllowedError' || error?.name === 'UserCancelledError') {
                return { 
                    success: false, 
                    cancelled: true, 
                    message: 'Belum ada Passkey yang terdaftar di perangkat ini untuk aplikasi ini, atau dialog autentikasi dibatalkan. Silakan masuk dengan kata sandi terlebih dahulu, lalu daftarkan Passkey perangkat Anda.' 
                };
            }

            return { success: false, message: error?.message || 'Gagal memverifikasi passkey.' };
        }
    },

    async register(name = 'Perangkat Saya') {
        if (typeof window !== 'undefined' && (window.location.hostname === '127.0.0.1' || window.location.hostname === '::1')) {
            const port = window.location.port ? `:${window.location.port}` : '';
            return {
                success: false,
                isIpAddress: true,
                localhostUrl: `http://localhost${port}${window.location.pathname}${window.location.search}`,
                message: `WebAuthn (Passkey) mewajibkan nama domain. Saat masih dalam tahap pengembangan (development), silakan gunakan localhost alih-alih alamat IP 127.0.0.1 (misal: http://localhost${port}${window.location.pathname}).`
            };
        }

        try {
            const response = await Passkeys.register({ name });
            return { success: true, response };
        } catch (error) {
            console.warn('Passkey register error:', error);

            if (error instanceof InvalidDomainError || error?.name === 'InvalidDomainError') {
                const port = typeof window !== 'undefined' && window.location.port ? `:${window.location.port}` : '';
                return { 
                    success: false, 
                    message: `Domain tidak valid untuk Passkey. Silakan gunakan http://localhost${port}` 
                };
            }

            if (error instanceof UserCancelledError || error?.name === 'NotAllowedError' || error?.name === 'UserCancelledError') {
                return { success: false, cancelled: true, message: 'Pendaftaran passkey dibatalkan oleh pengguna.' };
            }

            return { success: false, message: error?.message || 'Gagal mendaftarkan passkey.' };
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
            await wire.handlePasskeyError(e.message || 'Terjadi kesalahan saat memverifikasi passkey.', false, null);
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
            throw new Error('Modul Passkey belum dimuat.');
        }

        const res = await Passkeys.verify({
            routes: {
                options: '/passkeys/confirm/options',
                submit: '/passkeys/confirm',
            },
        });

        window.location.href = redirectUrl || '/';
    } catch (e) {
        console.warn('Passkey confirm error:', e);
        if (btn) {
            btn.removeAttribute('disabled');
            if (textSpan) textSpan.style.display = 'inline-flex';
            if (loadingSpan) loadingSpan.style.display = 'none';
        }
        if (window.vibeToast) {
            window.vibeToast(e.message || 'Gagal mengkonfirmasi dengan passkey.', { type: 'error' });
        } else {
            alert(e.message || 'Gagal mengkonfirmasi dengan passkey.');
        }
    }
};

let isAutofillActive = false;

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
        VibePasskeyService.isAutofillSupported?.().then(supported => {
            if (supported) {
                VibePasskeyService.client?.autofill?.().then(res => {
                    if (res) window.location.href = redirectUrl;
                }).catch((err) => {
                    console.debug('Passkey autofill idle or ignored:', err);
                }).finally(() => {
                    isAutofillActive = false;
                });
            } else {
                isAutofillActive = false;
            }
        }).catch(() => {
            isAutofillActive = false;
        });
    }
}

if (typeof window !== 'undefined') {
    window.addEventListener('DOMContentLoaded', () => {
        setTimeout(initPasskeyAutofill, 200);
    }, { once: true });

    document.addEventListener('livewire:navigated', () => {
        isAutofillActive = false;
        setTimeout(initPasskeyAutofill, 200);
    });
}
