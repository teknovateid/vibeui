import Pusher from 'pusher-js';
import './qrcode';

const customDrivers = {};

export const VibeQrLogin = {
    drivers: customDrivers,

    registerDriver(name, factory) {
        if (typeof name === 'string' && name.trim() !== '' && typeof factory === 'function') {
            customDrivers[name.trim()] = factory;
        }
    },
};

export function vibeQrLogin(options = {}) {
    const labels = options.labels || {};

    return {
        labels,
        token: null,
        expiresAt: null,
        remainingSeconds: 0,
        autoRefresh: true,
        maxAutoRefresh: 0,
        clientConfig: {},
        status: 'idle',
        errorMessage: null,

        _pusher: null,
        _pusherSignature: null,
        _channel: null,
        _pollTimer: null,
        _countdownTimer: null,
        _startedHandler: null,
        _stoppedHandler: null,
        _navigatingHandler: null,
        _visibilityHandler: null,
        _deadlineMs: null,
        _pollingInFlight: false,
        _autoRefreshCount: 0,
        _pendingAutoRefresh: false,
        _refreshing: false,
        _completing: false,
        _isDestroyed: false,

        init() {
            this._isDestroyed = false;

            this._startedHandler = (event) => {
                if (this._isDestroyed) return;
                this.start(event.detail || {});
            };
            this._stoppedHandler = () => {
                if (this._isDestroyed) return;
                this.stop();
            };
            this._navigatingHandler = () => {
                this.destroy();
            };
            this._visibilityHandler = () => {
                if (this._isDestroyed || document.hidden) return;

                if (this._pendingAutoRefresh) {
                    this._pendingAutoRefresh = false;
                    this.attemptAutoRefresh();
                    return;
                }

                if (this._deadlineMs && ['pending', 'scanned'].includes(this.status)) {
                    this.syncCountdownTick();
                }
            };

            window.addEventListener('vibe-qr-login-started', this._startedHandler);
            window.addEventListener('vibe-qr-login-stopped', this._stoppedHandler);
            document.addEventListener('livewire:navigating', this._navigatingHandler);
            document.addEventListener('visibilitychange', this._visibilityHandler);

            this.$nextTick(() => {
                if (!this._isDestroyed && !this.token) {
                    const initial = options.initial && options.initial.token
                        ? options.initial
                        : this.readChallengeFromDom();
                    if (initial && initial.token) {
                        this.start(initial);
                    }
                }
            });
        },

        readChallengeFromDom() {
            const el = this.$el?.querySelector('[data-qr-challenge]');
            if (!el || !el.dataset.qrChallenge) {
                return null;
            }
            try {
                return JSON.parse(el.dataset.qrChallenge);
            } catch (e) {
                return null;
            }
        },

        start(detail = {}) {
            if (
                detail.token
                && this.token === detail.token
                && (this._pusher || this._pollTimer || this._channel || this._customCleanup)
            ) {
                if (detail.status === 'approved' && detail.exchangeCode) {
                    this.handleStatusUpdate({ status: 'approved', exchange_code: detail.exchangeCode });
                } else if (detail.status === 'scanned' && this.status === 'pending') {
                    this.status = 'scanned';
                }
                return;
            }

            this.stopChannelOnly();
            this.stopCountdown();

            this._completing = false;
            this._refreshing = false;
            this._pendingAutoRefresh = false;
            this.errorMessage = null;
            this.token = detail.token || null;
            this.expiresAt = detail.expiresAt ? Number(detail.expiresAt) : null;
            if (detail.ttl !== undefined && detail.ttl !== null && Number(detail.ttl) > 0) {
                this._deadlineMs = Date.now() + (Number(detail.ttl) * 1000);
            } else if (this.expiresAt) {
                this._deadlineMs = this.expiresAt * 1000;
            } else {
                this._deadlineMs = null;
            }
            if (typeof detail.autoRefresh === 'boolean') {
                this.autoRefresh = detail.autoRefresh;
            }
            if (detail.maxAutoRefresh !== undefined && detail.maxAutoRefresh !== null) {
                this.maxAutoRefresh = Math.max(0, Number(detail.maxAutoRefresh));
            }
            this.clientConfig = detail.config || {};

            if (!this.token || this.clientConfig.configured === false) {
                this.disconnectPusher();
                return;
            }

            if (detail.status === 'approved' && detail.exchangeCode) {
                this.disconnectPusher();
                this.status = 'approved';
                this.handleStatusUpdate({ status: 'approved', exchange_code: detail.exchangeCode });
                return;
            }

            this.status = ['pending', 'scanned'].includes(detail.status) ? detail.status : 'pending';
            this.startCountdown();
            this.connectTransport();
        },

        stop() {
            this.stopTransport();
            this.stopCountdown();
            this.token = null;
            this.expiresAt = null;
            this._deadlineMs = null;
            this.remainingSeconds = 0;
            this.clientConfig = {};
            this.status = 'idle';
            this.errorMessage = null;
            this._autoRefreshCount = 0;
            this._pendingAutoRefresh = false;
            this._refreshing = false;
            this._completing = false;
        },

        resetAutoRefresh() {
            this._autoRefreshCount = 0;
            this._pendingAutoRefresh = false;
        },

        connectTransport() {
            const cfg = this.clientConfig || {};
            const driver = cfg.driver || 'pusher';
            const onUpdate = (payload) => this.handleStatusUpdate(payload);

            // 1. User-registered JS transport driver
            if (typeof customDrivers[driver] === 'function') {
                this.disconnectPusher();
                const teardown = customDrivers[driver](cfg, onUpdate, (err) => {
                    this.errorMessage = err?.message || String(err);
                    this.status = 'error';
                });
                this._customCleanup = typeof teardown === 'function' ? teardown : null;
                return;
            }

            // 2. Pusher or Laravel Reverb (Pusher protocol) via pusher-js
            if (driver === 'pusher' || driver === 'reverb') {
                this.connectPusher(cfg, onUpdate);
                return;
            }

            this.disconnectPusher();

            // 3. Laravel Echo bridge (e.g. Ably, Mercure, or custom Laravel broadcaster)
            if (driver !== 'polling' && typeof window !== 'undefined' && window.Echo && typeof window.Echo.channel === 'function') {
                this._channel = window.Echo.channel(cfg.channel);
                this._channel.listen(`.${cfg.event || 'qr-login.status'}`, onUpdate);
                return;
            }

            // 4. Built-in HTTP polling driver (or fallback if Echo is absent)
            this.connectPolling(cfg, onUpdate);
        },

        connectPusher(cfg, onUpdate) {
            if (!cfg.key || !cfg.channel) {
                this.disconnectPusher();
                this.status = 'unconfigured';
                this.errorMessage = this.labels.not_configured || 'Pusher credentials are missing.';
                return;
            }

            const pusherOptions = {
                cluster: cfg.cluster || 'mt1',
                forceTLS: cfg.forceTLS !== false,
            };

            if (cfg.wsHost) {
                pusherOptions.wsHost = cfg.wsHost;
                if (cfg.wsPort) pusherOptions.wsPort = Number(cfg.wsPort);
                if (cfg.wssPort) pusherOptions.wssPort = Number(cfg.wssPort);
                pusherOptions.enabledTransports = ['ws', 'wss'];
                pusherOptions.disableStats = true;
            }

            const signature = JSON.stringify([
                cfg.key,
                pusherOptions.cluster,
                pusherOptions.forceTLS,
                pusherOptions.wsHost || null,
                pusherOptions.wsPort || null,
                pusherOptions.wssPort || null,
            ]);

            try {
                const pusherState = this._pusher?.connection?.state;
                const canReuse = Boolean(
                    this._pusher
                    && this._pusherSignature === signature
                    && !['disconnected', 'failed', 'unavailable'].includes(pusherState)
                );

                if (!canReuse) {
                    this.disconnectPusher();
                    this._pusher = new Pusher(cfg.key, pusherOptions);
                    this._pusherSignature = signature;

                    this._pusher.connection.bind('error', (err) => {
                        if (this._isDestroyed) return;
                        const message = err?.error?.data?.message || err?.data?.message || null;
                        if (message) {
                            this.errorMessage = message;
                        }
                    });
                }

                this._channel = this._pusher.subscribe(cfg.channel);
                this._channel.bind(cfg.event || 'qr-login.status', onUpdate);
            } catch (err) {
                this.status = 'error';
                this.errorMessage = err?.message || 'Failed to connect QR WebSocket transport.';
            }
        },

        connectPolling(cfg, onUpdate) {
            if (!cfg.statusUrl) return;

            const interval = Math.max(800, Number(cfg.intervalMs || 1500));
            const pollOnce = async () => {
                if (
                    this._isDestroyed
                    || this._pollingInFlight
                    || !this.token
                    || this._completing
                    || ['expired', 'rejected', 'approved'].includes(this.status)
                ) {
                    return;
                }

                this._pollingInFlight = true;

                try {
                    const response = await fetch(cfg.statusUrl, {
                        method: 'GET',
                        credentials: 'same-origin',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    });

                    if (!response.ok) {
                        if ([403, 404, 419].includes(response.status)) {
                            this.stopTransport();
                            this.status = 'error';
                            this.errorMessage = this.labels.invalid_session || 'Session mismatch.';
                        }
                        return;
                    }

                    const payload = await response.json();
                    if (payload && payload.status && payload.status !== 'pending') {
                        onUpdate(payload);
                    }
                } catch (e) {
                    // Transient network failure; next interval will retry
                } finally {
                    this._pollingInFlight = false;
                }
            };

            this._pollTimer = setInterval(pollOnce, interval);
        },

        startCountdown() {
            this.stopCountdown();
            this.syncCountdownTick();

            if (
                !this._isDestroyed
                && ['pending', 'scanned'].includes(this.status)
                && this._deadlineMs
                && this.remainingSeconds > 0
            ) {
                this._countdownTimer = setInterval(() => this.syncCountdownTick(), 1000);
            }
        },

        syncCountdownTick() {
            if (this._isDestroyed) {
                this.stopCountdown();
                return true;
            }

            if (!this._deadlineMs) {
                this.remainingSeconds = 0;
                return false;
            }

            const diff = Math.max(0, Math.ceil((this._deadlineMs - Date.now()) / 1000));
            this.remainingSeconds = diff;

            if (diff === 0 && ['pending', 'scanned'].includes(this.status)) {
                this.stopChannelOnly();
                this.stopCountdown();

                if (this.attemptAutoRefresh()) {
                    return true;
                }

                this.disconnectPusher();
                this.status = this._pendingAutoRefresh ? 'refreshing' : 'expired';
                return true;
            }

            return false;
        },

        getWire() {
            if (this.$wire) {
                return this.$wire;
            }

            const wireEl = this.$el?.closest('[wire\\:id]');
            const wireId = wireEl?.getAttribute('wire:id');

            return wireId && window.Livewire ? window.Livewire.find(wireId) : null;
        },

        attemptAutoRefresh() {
            if (this._isDestroyed || this._refreshing || this._completing) {
                return false;
            }

            if (!this.autoRefresh) {
                return false;
            }

            if (this.maxAutoRefresh > 0 && this._autoRefreshCount >= this.maxAutoRefresh) {
                return false;
            }

            if (typeof document !== 'undefined' && document.hidden) {
                this._pendingAutoRefresh = true;
                this.status = 'refreshing';
                return false;
            }

            const wire = this.getWire();

            if (!wire || typeof wire.refreshQrLogin !== 'function') {
                return false;
            }

            this._refreshing = true;
            this._autoRefreshCount += 1;
            this.status = 'refreshing';

            Promise.resolve(wire.refreshQrLogin())
                .then((payload) => {
                    if (this._isDestroyed) {
                        return;
                    }

                    this._refreshing = false;

                    if (payload && payload.token) {
                        this.start(payload);
                        return;
                    }

                    if (payload && payload.status === 'error') {
                        this.disconnectPusher();
                        this.status = 'error';
                        this.errorMessage = payload.error || this.labels.complete_failed || null;
                        return;
                    }

                    if (payload && payload.status === 'unconfigured') {
                        this.disconnectPusher();
                        this.status = 'unconfigured';
                        this.errorMessage = payload.error || this.labels.not_configured || null;
                        return;
                    }

                    if (this.status === 'refreshing') {
                        this.disconnectPusher();
                        this.status = 'expired';
                    }
                })
                .catch(() => {
                    if (this._isDestroyed) {
                        return;
                    }

                    this._refreshing = false;
                    this.disconnectPusher();
                    this.status = 'expired';
                });

            return true;
        },

        stopCountdown() {
            if (this._countdownTimer) {
                clearInterval(this._countdownTimer);
                this._countdownTimer = null;
            }
        },

        stopChannelOnly() {
            this._pollingInFlight = false;
            if (typeof this._customCleanup === 'function') {
                try { this._customCleanup(); } catch (e) {}
                this._customCleanup = null;
            }
            if (this._pollTimer) {
                clearInterval(this._pollTimer);
                this._pollTimer = null;
            }
            if (this._channel) {
                const channelName = this._channel.name || this.clientConfig?.channel;
                try {
                    if (typeof this._channel.unbind_all === 'function') {
                        this._channel.unbind_all();
                    }
                    if (typeof this._channel.stopListening === 'function') {
                        this._channel.stopListening(`.${this.clientConfig?.event || 'qr-login.status'}`);
                    }
                    if (this._pusher && channelName && typeof this._pusher.unsubscribe === 'function') {
                        this._pusher.unsubscribe(channelName);
                    }
                } catch (e) {}
                this._channel = null;
            }
            if (!this._pusher && typeof window !== 'undefined' && window.Echo && this.clientConfig?.channel && typeof window.Echo.leaveChannel === 'function') {
                try {
                    window.Echo.leaveChannel(this.clientConfig.channel);
                } catch (e) {}
            }
        },

        disconnectPusher() {
            const pusher = this._pusher;
            this._pusher = null;
            this._pusherSignature = null;
            if (!pusher) {
                return;
            }

            try {
                const state = pusher.connection?.state;
                if (state === 'connecting' || state === 'initialized') {
                    const closeWhenSettled = (states) => {
                        if (states.current !== 'connecting' && states.current !== 'initialized') {
                            try { pusher.connection.unbind('state_change', closeWhenSettled); } catch (e) {}
                            try { pusher.disconnect(); } catch (e) {}
                        }
                    };
                    pusher.connection.bind('state_change', closeWhenSettled);
                } else {
                    pusher.disconnect();
                }
            } catch (e) {
                try { pusher.disconnect(); } catch (_) {}
            }
        },

        stopTransport() {
            this.stopChannelOnly();
            this.disconnectPusher();
        },

        async handleStatusUpdate(payload) {
            if (this._isDestroyed || !payload || !payload.status) return;

            if (payload.status === 'scanned' && this.status === 'pending') {
                this.status = 'scanned';
                return;
            }

            if (payload.status === 'rejected') {
                this.remainingSeconds = 0;
                this.stopTransport();
                this.stopCountdown();
                this.status = 'rejected';
                return;
            }

            if (payload.status === 'expired') {
                this.remainingSeconds = 0;
                this.stopChannelOnly();
                this.stopCountdown();

                if (this.attemptAutoRefresh()) {
                    return;
                }

                this.disconnectPusher();
                this.status = this._pendingAutoRefresh ? 'refreshing' : 'expired';
                return;
            }

            if (payload.status === 'approved' && payload.exchange_code && !this._completing) {
                this._completing = true;
                this.remainingSeconds = 0;
                this.status = 'approved';
                this.stopTransport();
                this.stopCountdown();

                const wire = this.getWire();

                if (wire && typeof wire.completeQrLogin === 'function') {
                    try {
                        await wire.completeQrLogin(this.token, payload.exchange_code);
                    } catch (e) {
                        this._completing = false;
                        this.status = 'error';
                        this.errorMessage = this.labels.complete_failed || 'Could not finalize QR login.';
                    }
                }
            }
        },

        formattedRemaining() {
            const total = Math.max(0, Number(this.remainingSeconds || 0));
            const mins = Math.floor(total / 60);
            const secs = total % 60;
            return `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
        },

        statusMessage() {
            switch (this.status) {
                case 'scanned':
                    return this.labels.status_scanned || 'QR scanned! Confirm on your other device...';
                case 'approved':
                    return this.labels.status_approved || 'Approved! Signing you in...';
                case 'rejected':
                    return this.labels.status_rejected || 'Login request declined.';
                case 'expired':
                    return this.labels.status_expired || 'QR Code expired.';
                case 'refreshing':
                    return this.labels.status_refreshing || 'Code expired. Generating a new one...';
                case 'error':
                    return this.errorMessage || this.labels.complete_failed || 'QR login error.';
                default:
                    return this.labels.status_pending || 'Waiting for scan...';
            }
        },

        destroy() {
            if (this._isDestroyed) return;
            this._isDestroyed = true;

            this.stopTransport();
            this.stopCountdown();

            if (this._startedHandler) {
                window.removeEventListener('vibe-qr-login-started', this._startedHandler);
                this._startedHandler = null;
            }
            if (this._stoppedHandler) {
                window.removeEventListener('vibe-qr-login-stopped', this._stoppedHandler);
                this._stoppedHandler = null;
            }
            if (this._navigatingHandler) {
                document.removeEventListener('livewire:navigating', this._navigatingHandler);
                this._navigatingHandler = null;
            }
            if (this._visibilityHandler) {
                document.removeEventListener('visibilitychange', this._visibilityHandler);
                this._visibilityHandler = null;
            }
        },
    };
}

function registerVibeQrLoginComponent() {
    if (typeof window !== 'undefined' && window.Alpine && typeof window.Alpine.data === 'function') {
        window.Alpine.data('vibeQrLogin', vibeQrLogin);
    }
}

if (typeof window !== 'undefined') {
    window.VibeQrLogin = VibeQrLogin;
    window.vibeQrLogin = vibeQrLogin;

    registerVibeQrLoginComponent();

    document.addEventListener('alpine:init', registerVibeQrLoginComponent);
    document.addEventListener('livewire:init', registerVibeQrLoginComponent);
    document.addEventListener('livewire:navigated', registerVibeQrLoginComponent);

    window.dispatchEvent(new CustomEvent('vibe-qr-login-ready'));
}
