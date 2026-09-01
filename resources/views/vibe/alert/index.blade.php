@blaze

@props([
    'position' => 'center', // center, top-right, top-left, bottom-right, bottom-left, top-center, bottom-center
    'align' => 'center', // start, center, end
    'timeout' => 3000,
    'sound' => false,
    'blur' => false, // false, true, xs, sm, md, lg, xl, 2xl, 3xl, none
])

<div x-data="{
    alerts: [],
    globalPosition: '{{ $position }}',
    globalAlign: '{{ $align }}',
    globalSound: '{{ $sound }}',
    globalBlur: @js($blur),

    typeClasses: {
        success: 'bg-green-500/15 dark:bg-green-900/40 text-green-600 dark:text-green-400',
        error: 'bg-red-500/15 dark:bg-red-900/40 text-red-600 dark:text-red-400',
        confirm: 'bg-red-500/15 dark:bg-red-900/40 text-red-600 dark:text-red-400',
        warning: 'bg-yellow-500/15 dark:bg-yellow-900/40 text-yellow-600 dark:text-yellow-400',
        info: 'bg-blue-500/15 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400'
    },

    blurClasses: {
        'none': 'backdrop-blur-none',
        'xs': 'backdrop-blur-xs',
        'sm': 'backdrop-blur-sm',
        'md': 'backdrop-blur-md',
        'lg': 'backdrop-blur-lg',
        'xl': 'backdrop-blur-xl',
        '2xl': 'backdrop-blur-2xl',
        '3xl': 'backdrop-blur-3xl'
    },

    icons: {
        success: `<svg class='size-8' xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'><path d='M0 0h24v24H0z' fill='none' /><g fill='none' stroke='currentColor' stroke-width='1.5'><circle cx='12' cy='12' r='10' /><path stroke-linecap='round' stroke-linejoin='round' d='M8.5 12.5L10.5 14.5L15.5 9.5' /></g></svg>`,
        error: `<svg class='size-8' xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'><path d='M0 0h24v24H0z' fill='none' /><g fill='none' stroke='currentColor' stroke-width='1.5'><circle cx='12' cy='12' r='10' /><path stroke-linecap='round' d='M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5' /></g></svg>`,
        confirm: `<svg class='size-8' xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'><path d='M0 0h24v24H0z' fill='none' /><g fill='none' stroke='currentColor' stroke-width='1.5'><circle cx='12' cy='12' r='10' /><path stroke-linecap='round' d='M12 7V13' /><path stroke-linecap='round' stroke-linejoin='round' d='M12 16H12.0001' /></g></svg>`,
        warning: `<svg class='size-8' xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'><path d='M0 0h24v24H0z' fill='none' /><g fill='none' stroke='currentColor' stroke-width='1.5'><path d='M5.31171 10.7615C8.23007 5.58716 9.68925 3 12 3C14.3107 3 15.7699 5.58716 18.6883 10.7615L19.0519 11.4063C21.4771 15.7061 22.6897 17.856 21.5937 19.428C20.4978 21 17.7864 21 12.3637 21H11.6363C6.21356 21 3.50217 21 2.40626 19.428C1.31034 17.856 2.52291 15.7061 4.94805 11.4063L5.31171 10.7615Z' /><path stroke-linecap='round' d='M12 8V13' /><path stroke-linecap='round' stroke-linejoin='round' d='M12 16H12.0001' /></g></svg>`,
        info: `<svg class='size-8' xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'><path d='M0 0h24v24H0z' fill='none' /><g fill='none' stroke='currentColor' stroke-width='1.5'><circle cx='12' cy='12' r='10' /><path stroke-linecap='round' d='M12 7V13' /><path stroke-linecap='round' stroke-linejoin='round' d='M12 16H12.0001' /></g></svg>`
    },

    getPositionClasses() {
        let pos = this.alerts.length > 0 ? (this.alerts[this.alerts.length - 1].position || this.globalPosition) : this.globalPosition;
        const positions = {
            'top-right': 'items-start justify-end pt-4 sm:pt-6 pr-4 sm:pr-6',
            'top-left': 'items-start justify-start pt-4 sm:pt-6 pl-4 sm:pl-6',
            'bottom-right': 'items-end justify-end pb-4 sm:pb-6 pr-4 sm:pr-6',
            'bottom-left': 'items-end justify-start pb-4 sm:pb-6 pl-4 sm:pl-6',
            'top-center': 'items-start justify-center pt-4 sm:pt-6',
            'bottom-center': 'items-end justify-center pb-4 sm:pb-6',
            'center': 'items-center justify-center p-4 sm:p-6'
        };
        return positions[pos] || positions['center'];
    },

    getAlignClasses(alert) {
        let align = alert ? (alert.align || this.globalAlign) : this.globalAlign;
        const aligns = {
            'start': 'text-left items-start',
            'center': 'text-center items-center',
            'end': 'text-right items-end'
        };
        return aligns[align] || aligns['center'];
    },

    isCenter() {
        let pos = this.alerts.length > 0 ? (this.alerts[this.alerts.length - 1].position || this.globalPosition) : this.globalPosition;
        return pos === 'center';
    },

    getBackdropBlurClass() {
        let activeAlert = this.alerts.slice().reverse().find(a => a.blocking || a.blur);
        let blurVal = activeAlert && activeAlert.blur !== undefined ? activeAlert.blur : this.globalBlur;

        if (blurVal === false || blurVal === 'none' || blurVal === 'false') {
            return this.blurClasses['none'];
        }
        if (blurVal === true || blurVal === 'sm' || blurVal === 'true') {
            return this.blurClasses['sm'];
        }
        if (blurVal && this.blurClasses[blurVal]) {
            return this.blurClasses[blurVal];
        }
        if (typeof blurVal === 'string' && blurVal.startsWith('backdrop-blur')) {
            return blurVal;
        }
        return this.blurClasses['xs'];
    },

    add(alert) {
        if (alert.type === 'confirm' && this.alerts.some(a => a.type === 'confirm')) {
            return;
        }

        if (this.alerts.some(a => a.title === alert.title && a.message === alert.message && a.type === alert.type)) {
            return;
        }

        let id = Date.now() + Math.random().toString(36).substr(2, 9);

        if (alert.type === 'confirm') {
            alert.timeout = false;
            alert.position = alert.position || 'center';
            alert.blocking = alert.blocking !== undefined ? alert.blocking : true;
        }

        if (alert.blur !== undefined && alert.blocking === undefined) {
            alert.blocking = (alert.blur !== false && alert.blur !== 'none');
        }

        if (alert.confirmButton !== undefined) {
            if (typeof alert.confirmButton === 'string') alert.confirmButton = { text: alert.confirmButton };
        } else if (alert.primaryAction !== undefined || alert.primaryCallback !== undefined) {
            alert.confirmButton = { text: alert.primaryAction, action: alert.primaryCallback };
        } else if (alert.type === 'confirm') {
            alert.confirmButton = { text: '{{ __('vibe/alert.confirm') }}' };
        } else {
            alert.confirmButton = { text: '{{ __('vibe/alert.close') }}' };
        }

        if (alert.closeButton !== undefined) {
            if (typeof alert.closeButton === 'string') alert.closeButton = { text: alert.closeButton };
        } else if (alert.secondaryAction !== undefined || alert.secondaryCallback !== undefined) {
            alert.closeButton = { text: alert.secondaryAction, action: alert.secondaryCallback };
        } else if (alert.type === 'confirm') {
            alert.closeButton = { text: '{{ __('vibe/alert.cancel') }}' };
        }

        let s = alert.sound !== undefined ? alert.sound : this.globalSound;
        if (s === 'true' || s === '1') s = true;
        if (s === 'false' || s === '0' || s === '') s = false;

        let item = { ...alert, id, timer: null, hover: false, sound: s };

        setTimeout(() => {
            this.alerts.push(item);
            this.startTimer(item);
            this.playSound(item);
        }, 50);
    },

    playSound(alert) {
        if (!alert.sound) return;

        if (typeof alert.sound === 'string' && alert.sound.length > 5) {
            window.vibeAudioCache = window.vibeAudioCache || {};
            let audio = window.vibeAudioCache[alert.sound];
            if (!audio) {
                audio = new Audio(alert.sound);
                window.vibeAudioCache[alert.sound] = audio;
            }
            audio.currentTime = 0;
            audio.play().catch(e => console.warn('Audio play failed:', e));
        } else {
            try {
                const ctx = new(window.AudioContext || window.webkitAudioContext)();
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();

                osc.connect(gain);
                gain.connect(ctx.destination);

                osc.type = 'sine';
                osc.frequency.setValueAtTime(800, ctx.currentTime);
                osc.frequency.exponentialRampToValueAtTime(300, ctx.currentTime + 0.1);

                gain.gain.setValueAtTime(0.5, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.1);

                osc.start(ctx.currentTime);
                osc.stop(ctx.currentTime + 0.1);
            } catch (e) {
                console.warn('Web Audio API not supported', e);
            }
        }
    },
    startTimer(alert) {
        if (alert.timeout !== false && (alert.timeout || {{ $timeout }})) {
            let duration = alert.timeout || {{ $timeout }};
            alert.timer = setTimeout(() => {
                if (!alert.hover) {
                    this.remove(alert.id);
                }
            }, duration);
        }
    },
    pauseTimer(alert) {
        alert.hover = true;
        if (alert.timer) {
            clearTimeout(alert.timer);
        }
    },
    resumeTimer(alert) {
        alert.hover = false;
        this.startTimer(alert);
    },
    remove(id) {
        this.alerts = this.alerts.filter(a => {
            if (a.id === id && a.timer) clearTimeout(a.timer);
            return a.id !== id;
        });
    },
    executeCallback(cb) {
        if (typeof cb === 'function') {
            cb();
        } else if (typeof cb === 'string') {
            try {
                if (cb.trim().startsWith('function') || cb.includes('=>')) {
                    (new Function('return ' + cb))()();
                } else {
                    (new Function(cb))();
                }
            } catch (e) {
                console.error('Error executing alert callback:', e);
            }
        }
    }
}" x-on:alert.window="
        let d = $event.detail;
        let payload = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? d : {message: d, type: 'info'});
        add(payload);
    " class="fixed inset-0 z-100 flex pointer-events-none" id="vibe-alert-container" :class="getPositionClasses()">
    <div class="hidden" x-init="@if (session()->has('success')) add({ type: 'success', message: '{{ session('success') }}', title: '{{ __('vibe/toast.success') }}' }); @endif
    @if (session()->has('error')) add({ type: 'error', message: '{{ session('error') }}', title: '{{ __('vibe/toast.error') }}' }); @endif
    @if (session()->has('warning')) add({ type: 'warning', message: '{{ session('warning') }}', title: '{{ __('vibe/toast.warning') }}' }); @endif
    @if (session()->has('info')) add({ type: 'info', message: '{{ session('info') }}', title: '{{ __('vibe/toast.info') }}' }); @endif"></div>

    <!-- Backdrop -->
    <div x-show="alerts.some(a => a.blocking || (a.blur && a.blur !== false && a.blur !== 'none'))" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/40 pointer-events-auto transition-all duration-300" :class="getBackdropBlurClass()" style="display: none; z-index: -1;"></div>


    <div class="w-full max-w-88 sm:max-w-md flex flex-col gap-4 pointer-events-none">
        <template x-for="alert in alerts" :key="alert.id">
            <div :class="'pos-' + (alert.position || globalPosition)" @mouseenter="pauseTimer(alert)" @mouseleave="resumeTimer(alert)" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="vibe-alert-start" x-transition:enter-end="opacity-100 transform-none" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform-none" x-transition:leave-end="vibe-alert-start" class="relative w-full bg-card text-card-foreground select-none rounded-2xl shadow-2xl flex flex-col overflow-hidden border border-border pointer-events-auto">
                <div class="p-5 sm:p-6 flex flex-col" :class="getAlignClasses(alert)">
                    <div class="flex size-16 items-center justify-center rounded-full mb-4" :class="typeClasses[alert.type] || typeClasses.info" x-html="alert.icon || icons[alert.type] || icons.info"></div>
                    <h3 class="text-lg font-bold text-foreground tracking-tight" x-text="alert.title || (alert.type === 'error' ? 'Error' : (alert.type === 'success' ? 'Berhasil' : 'Pemberitahuan'))"></h3>
                    <p class="mt-1.5 text-sm text-muted-foreground leading-relaxed" x-text="alert.message"></p>
                </div>

                <!-- Footer -->
                <div class="px-5 pb-5 sm:px-6 sm:pb-6 flex w-full" :class="{
                    'flex-col-reverse gap-2.5': alert.buttonLayout === 'col',
                    'flex-row gap-2.5 sm:gap-3': alert.buttonLayout === 'row' || (!alert.buttonLayout && (alert.align || globalAlign) === 'center'),
                    'justify-end gap-2.5 sm:gap-3': !alert.buttonLayout && (alert.align || globalAlign) !== 'center',
                }">

                    <vibe:button variant="secondary" size="md" x-show="alert.closeButton" @click="if(alert.closeButton && alert.closeButton.action) executeCallback(alert.closeButton.action); remove(alert.id)" x-bind:class="[
                        (alert.closeButton && alert.closeButton.class) ? alert.closeButton.class : '',
                        (alert.closeButton && alert.closeButton.class && alert.closeButton.class.includes('bg-transparent')) ? 'bg-transparent! border-transparent! shadow-none!' : '',
                        (alert.buttonLayout === 'col' && alert.closeButton && alert.closeButton.class && alert.closeButton.class.includes('bg-transparent')) ?
                        'w-full h-10 text-sm font-medium text-muted-foreground' :
                        (alert.buttonLayout === 'col' ? 'w-full h-12! text-sm sm:text-base font-semibold' : 'h-9 px-4 text-sm font-medium'),
                        (alert.buttonLayout === 'col' || alert.buttonLayout === 'row' || (!alert.buttonLayout && (alert.align || globalAlign) === 'center')) ? 'flex-1' : ''
                    ]">
                        <span x-text="alert.closeButton ? alert.closeButton.text : ''"></span>
                    </vibe:button>

                    <vibe:button variant="primary" size="md" x-show="alert.confirmButton" @click="if(alert.confirmButton && alert.confirmButton.action) executeCallback(alert.confirmButton.action); remove(alert.id)" x-bind:class="[
                        (alert.confirmButton && alert.confirmButton.class) ? alert.confirmButton.class : '',
                        alert.buttonLayout === 'col' ? 'w-full h-12! text-sm sm:text-base font-semibold' : 'h-9 px-4 text-sm font-medium',
                        (alert.buttonLayout === 'col' || alert.buttonLayout === 'row' || (!alert.buttonLayout && (alert.align || globalAlign) === 'center')) ? 'flex-1' : ''
                    ]">
                        <span x-text="alert.confirmButton ? alert.confirmButton.text : ''"></span>
                    </vibe:button>
                </div>
            </div>
        </template>
    </div>
</div>

<script>
    if (typeof window.vibeAlert === 'undefined') {
        window.vibeAlert = function(payload) {
            if (typeof payload === 'string') {
                payload = {
                    message: payload,
                    type: 'info'
                };
            }

            let fired = false;
            let dispatchEvent = () => {
                if (fired) return;
                fired = true;
                window.dispatchEvent(new CustomEvent('alert', {
                    detail: payload
                }));
            };

            if (document.readyState === 'loading') {
                document.addEventListener('alpine:initialized', () => {
                    setTimeout(dispatchEvent, 50);
                });
                // Fallback for non-Alpine/late-Alpine loads
                document.addEventListener('DOMContentLoaded', () => {
                    setTimeout(dispatchEvent, 150);
                });
            } else {
                // If DOM is ready, wait a tiny bit to ensure Alpine has mounted
                setTimeout(dispatchEvent, 50);
            }
        };
    }
</script>
