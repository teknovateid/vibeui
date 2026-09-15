/**
 * Vibe UI - Idle Timeout Watcher
 *
 * Automatically monitors user inactivity on pages protected by the 'idle' middleware.
 * If user is inactive for the specified timeout duration without activity,
 * the page redirects to the password confirmation page and locks the session.
 */

(function () {
    var timeout = 0;
    var remaining = 0;
    var redirecting = false;
    var lastX = null;
    var lastY = null;
    var lastActivityTime = Date.now();
    var lastKeepAliveTime = 0;
    var listenersAttached = false;

    /**
     * Read configured timeout (in seconds) from the current DOM or window.
     */
    function getIdleTimeout() {
        if (typeof window.VIBE_IDLE_TIMEOUT === 'number' && window.VIBE_IDLE_TIMEOUT > 0) {
            return window.VIBE_IDLE_TIMEOUT;
        }

        // 1. Check all tracker elements in the DOM (inside <main>, sidebar, or layout)
        var trackers = document.querySelectorAll('#vibe-idle-tracker, #vibe-idle-tracker-base, [data-vibe-idle-timeout]');
        for (var i = 0; i < trackers.length; i++) {
            var el = trackers[i];
            var val = parseInt(el.dataset.timeout || el.getAttribute('data-timeout') || el.getAttribute('data-vibe-idle-timeout'), 10);
            if (!isNaN(val) && val > 0) return val;
        }

        // 2. Check meta tag in <head>
        var meta = document.querySelector('meta[name="vibe-idle-timeout"]');
        if (meta && meta.content) {
            var val2 = parseInt(meta.content, 10);
            if (!isNaN(val2) && val2 > 0) return val2;
        }

        // 3. Check body data attribute
        if (document.body && document.body.dataset && document.body.dataset.idleTimeout) {
            var val3 = parseInt(document.body.dataset.idleTimeout, 10);
            if (!isNaN(val3) && val3 > 0) return val3;
        }

        return 0;
    }

    /**
     * Helper to extract pathname from a URL string (relative or absolute).
     */
    function getPathname(url) {
        if (!url || typeof url !== 'string') return '';
        try {
            if (url.indexOf('://') !== -1) {
                return new URL(url, window.location.origin).pathname;
            }
        } catch (e) {}
        return url.split('?')[0].split('#')[0];
    }

    /**
     * Get the configured confirmation URL.
     */
    function getConfirmUrl() {
        if (window.VIBE_CONFIRM_URL && typeof window.VIBE_CONFIRM_URL === 'string') {
            return window.VIBE_CONFIRM_URL;
        }

        var meta = document.querySelector('meta[name="vibe-confirm-url"]');
        if (meta && meta.content) return meta.content;

        var tracker = document.querySelector('#vibe-idle-tracker, #vibe-idle-tracker-base, [data-confirm-url]');
        if (tracker && tracker.getAttribute('data-confirm-url')) {
            return tracker.getAttribute('data-confirm-url');
        }

        return '/confirm-password';
    }

    /**
     * Get the configured idle lock URL.
     */
    function getIdleLockUrl() {
        if (window.VIBE_IDLE_LOCK_URL && typeof window.VIBE_IDLE_LOCK_URL === 'string') {
            return window.VIBE_IDLE_LOCK_URL;
        }

        var meta = document.querySelector('meta[name="vibe-idle-lock-url"]');
        if (meta && meta.content) return meta.content;

        var tracker = document.querySelector('#vibe-idle-tracker, #vibe-idle-tracker-base, [data-lock-url]');
        if (tracker && tracker.getAttribute('data-lock-url')) {
            return tracker.getAttribute('data-lock-url');
        }

        var confirmUrl = getConfirmUrl();
        return confirmUrl.replace(/\/+$/, '') + '/idle-lock';
    }

    /**
     * Get the configured keep-alive URL.
     */
    function getKeepAliveUrl() {
        if (window.VIBE_KEEP_ALIVE_URL && typeof window.VIBE_KEEP_ALIVE_URL === 'string') {
            return window.VIBE_KEEP_ALIVE_URL;
        }

        var meta = document.querySelector('meta[name="vibe-keep-alive-url"]');
        if (meta && meta.content) return meta.content;

        var tracker = document.querySelector('#vibe-idle-tracker, #vibe-idle-tracker-base, [data-keep-alive-url]');
        if (tracker && tracker.getAttribute('data-keep-alive-url')) {
            return tracker.getAttribute('data-keep-alive-url');
        }

        return '/keep-alive';
    }

    /**
     * Check if a path matches an auth, login, or confirmation route.
     */
    function isAuthOrConfirmPath(currentPath) {
        var cleanPath = (currentPath.replace(/\/+$/, '') || '/').toLowerCase();

        // Always ignore standard auth entry points
        if (cleanPath === '/login' || cleanPath.indexOf('/login/') === 0) {
            return true;
        }

        var confirmPath = (getPathname(getConfirmUrl()).replace(/\/+$/, '') || '/').toLowerCase();
        if (confirmPath && (cleanPath === confirmPath || cleanPath.indexOf(confirmPath + '/') === 0)) {
            return true;
        }

        var lockPath = (getPathname(getIdleLockUrl()).replace(/\/+$/, '') || '/').toLowerCase();
        if (lockPath && (cleanPath === lockPath || cleanPath.indexOf(lockPath + '/') === 0)) {
            return true;
        }

        // Safety fallback for default confirm-password paths
        if (cleanPath === '/confirm-password' || cleanPath.indexOf('/confirm-password/') === 0) {
            return true;
        }

        return false;
    }

    /**
     * Redirect to the password confirmation lock route.
     */
    function redirectToConfirmation() {
        if (redirecting) return;
        var path = window.location.pathname.replace(/\/+$/, '') || '/';
        if (isAuthOrConfirmPath(path)) {
            return;
        }

        redirecting = true;
        if (window._vibeIdleInterval) {
            clearInterval(window._vibeIdleInterval);
            window._vibeIdleInterval = null;
        }

        var intended = encodeURIComponent(window.location.href);
        var lockUrl = getIdleLockUrl();
        var separator = lockUrl.indexOf('?') === -1 ? '?' : '&';
        window.location.href = lockUrl + separator + 'intended=' + intended;
    }

    /**
     * Send keep-alive request for long-lived sessions (> 60s).
     */
    function sendKeepAlive() {
        if (redirecting) return;
        lastKeepAliveTime = Date.now();

        var keepAliveUrl = getKeepAliveUrl();
        fetch(keepAliveUrl, {
            method: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        }).then(function (res) {
            if (res.status === 423 || res.status === 401) {
                redirectToConfirmation();
            }
        }).catch(function () {});
    }

    /**
     * Handler for authentic user activity events.
     */
    function onActivity(e) {
        if (redirecting || timeout <= 0) return;

        if (e && e.type === 'mousemove') {
            if (lastX === null || lastY === null) {
                lastX = e.clientX;
                lastY = e.clientY;
                return;
            }
            if (Math.abs(e.clientX - lastX) < 25 && Math.abs(e.clientY - lastY) < 25) {
                return;
            }
            lastX = e.clientX;
            lastY = e.clientY;
        }

        remaining = timeout;
        lastActivityTime = Date.now();

        // Send keep-alive for long timeouts (> 60s)
        if (timeout > 60) {
            var keepAliveInterval = Math.max(30000, Math.floor((timeout * 1000) / 2));
            if (Date.now() - lastKeepAliveTime > keepAliveInterval) {
                sendKeepAlive();
            }
        }
    }

    /**
     * Attach activity listeners to window once.
     * Note: Uses 'wheel' instead of 'scroll' to prevent browser layout shifts / scroll restoration from resetting timer.
     */
    function attachListenersOnce() {
        if (listenersAttached) return;
        listenersAttached = true;

        ['mousedown', 'keydown', 'touchstart', 'wheel', 'click'].forEach(function (evt) {
            window.addEventListener(evt, onActivity, { passive: true });
        });
        window.addEventListener('mousemove', onActivity, { passive: true });

        document.addEventListener('visibilitychange', function () {
            if (document.visibilityState === 'visible' && timeout > 0 && !redirecting) {
                var elapsed = Math.floor((Date.now() - lastActivityTime) / 1000);
                if (elapsed >= timeout) {
                    redirectToConfirmation();
                } else {
                    remaining = Math.max(0, timeout - elapsed);
                }
            }
        });
    }

    /**
     * Start watcher on current page or stop if no timeout configured.
     */
    function initWatcher() {
        if (window._vibeIdleInterval) {
            clearInterval(window._vibeIdleInterval);
            window._vibeIdleInterval = null;
        }

        timeout = getIdleTimeout();

        if (timeout <= 0) {
            remaining = 0;
            return;
        }

        remaining = timeout;
        redirecting = false;
        lastX = null;
        lastY = null;
        lastActivityTime = Date.now();
        lastKeepAliveTime = Date.now();

        attachListenersOnce();

        window._vibeIdleInterval = setInterval(function () {
            remaining--;
            if (remaining <= 0) {
                redirectToConfirmation();
                return;
            }
        }, 1000);
    }

    // Expose global VibeIdle helper
    window.VibeIdle = {
        getRemainingTime: function () {
            return Math.max(0, remaining);
        },
        getTimeout: function () {
            return timeout;
        },
        getConfirmUrl: getConfirmUrl,
        getIdleLockUrl: getIdleLockUrl,
        getKeepAliveUrl: getKeepAliveUrl,
        reset: function () {
            remaining = timeout;
            lastX = null;
            lastY = null;
            lastActivityTime = Date.now();
        },
        lockNow: function () {
            redirectToConfirmation();
        },
        init: function (sec, lockUrl, confirmUrl) {
            if (typeof sec === 'number' && sec > 0) {
                window.VIBE_IDLE_TIMEOUT = sec;
            }
            if (typeof lockUrl === 'string' && lockUrl) {
                window.VIBE_IDLE_LOCK_URL = lockUrl;
            }
            if (typeof confirmUrl === 'string' && confirmUrl) {
                window.VIBE_CONFIRM_URL = confirmUrl;
            }
            initWatcher();
        }
    };

    // Initialize watcher when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initWatcher);
    } else {
        initWatcher();
    }

    // Livewire 3 wire:navigate support
    document.addEventListener('livewire:navigated', function () {
        delete window.VIBE_IDLE_TIMEOUT;
        // 20ms delay ensures morphed DOM elements inside <main> are mounted and ready
        setTimeout(initWatcher, 20);
    });

    document.addEventListener('livewire:navigating', function () {
        if (window._vibeIdleInterval) {
            clearInterval(window._vibeIdleInterval);
            window._vibeIdleInterval = null;
        }
    });

    // Hook into Livewire 3 requests to catch X-Vibe-Idle-* headers directly from server
    if (window.Livewire && window.Livewire.hook) {
        try {
            window.Livewire.hook('request', function (context) {
                if (context && context.succeed) {
                    context.succeed(function (data) {
                        var response = data && data.response;
                        if (response && response.headers && typeof response.headers.get === 'function') {
                            var headerVal = response.headers.get('X-Vibe-Idle-Timeout') || response.headers.get('x-vibe-idle-timeout');
                            if (headerVal) {
                                var parsed = parseInt(headerVal, 10);
                                if (!isNaN(parsed) && parsed > 0) {
                                    window.VIBE_IDLE_TIMEOUT = parsed;
                                }
                            }
                            var lockHeader = response.headers.get('X-Vibe-Idle-Lock-Url') || response.headers.get('x-vibe-idle-lock-url');
                            if (lockHeader) {
                                window.VIBE_IDLE_LOCK_URL = lockHeader;
                            }
                            var confirmHeader = response.headers.get('X-Vibe-Confirm-Url') || response.headers.get('x-vibe-confirm-url');
                            if (confirmHeader) {
                                window.VIBE_CONFIRM_URL = confirmHeader;
                            }
                            var keepAliveHeader = response.headers.get('X-Vibe-Keep-Alive-Url') || response.headers.get('x-vibe-keep-alive-url');
                            if (keepAliveHeader) {
                                window.VIBE_KEEP_ALIVE_URL = keepAliveHeader;
                            }
                        }
                    });
                }
            });
        } catch (e) {}
    }
})();
