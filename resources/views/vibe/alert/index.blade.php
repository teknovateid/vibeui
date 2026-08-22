@blaze

@props([
    'position' => 'center', // center, top-right, top-left, bottom-right, bottom-left, top-center, bottom-center
    'align' => 'center', // start, center, end
    'timeout' => 3000,
    'sound' => false,
])


<div 
    x-data="{
        alerts: [],
        globalPosition: '{{ $position }}',
        globalAlign: '{{ $align }}',
        globalSound: '{{ $sound }}',
        
        typeClasses: {
            success: 'bg-green-500/15 dark:bg-green-900/40 text-green-600 dark:text-green-400 ring-8 ring-green-100/80 dark:ring-green-900/20',
            error: 'bg-red-500/15 dark:bg-red-900/40 text-red-600 dark:text-red-400 ring-8 ring-red-100/80 dark:ring-red-900/20',
            confirm: 'bg-red-500/15 dark:bg-red-900/40 text-red-600 dark:text-red-400 ring-8 ring-red-100/80 dark:ring-red-900/20',
            warning: 'bg-yellow-500/15 dark:bg-yellow-900/40 text-yellow-600 dark:text-yellow-400 ring-8 ring-yellow-100/80 dark:ring-yellow-900/20',
            info: 'bg-blue-500/15 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 ring-8 ring-blue-100/80 dark:ring-blue-900/20'
        },
        
        icons: {
            success: `<svg class='h-6 w-6' fill='currentColor' viewBox='0 0 24 24'><path fill-rule='evenodd' d='M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z' clip-rule='evenodd' style='display: none;' /><path fill-rule='evenodd' d='M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z' clip-rule='evenodd' /></svg>`,
            error: `<svg class='h-6 w-6' fill='currentColor' viewBox='0 0 24 24'><path fill-rule='evenodd' d='M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z' clip-rule='evenodd' /></svg>`,
            confirm: `<svg class='h-6 w-6' fill='currentColor' viewBox='0 0 24 24'><path fill-rule='evenodd' d='M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z' clip-rule='evenodd' /></svg>`,
            warning: `<svg class='h-6 w-6' fill='currentColor' viewBox='0 0 24 24'><path fill-rule='evenodd' d='M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z' clip-rule='evenodd' /></svg>`,
            info: `<svg class='h-6 w-6' fill='currentColor' viewBox='0 0 24 24'><path fill-rule='evenodd' d='M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 011.08.732l-2.15 8.6a1.5 1.5 0 01-2.884-.712l.71-2.837-.042.02a.75.75 0 01-1.08-.732l2.15-8.6a1.5 1.5 0 011.757-1.003zM12 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z' clip-rule='evenodd' /></svg>`
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
            
            if (alert.confirmButton !== undefined) {
                if (typeof alert.confirmButton === 'string') alert.confirmButton = { text: alert.confirmButton };
            } else if (alert.primaryAction !== undefined || alert.primaryCallback !== undefined) {
                alert.confirmButton = { text: alert.primaryAction, action: alert.primaryCallback };
            } else if (alert.type === 'confirm') {
                alert.confirmButton = { text: 'Ya, Lanjutkan' };
            } else {
                alert.confirmButton = { text: 'Tutup' };
            }

            if (alert.closeButton !== undefined) {
                if (typeof alert.closeButton === 'string') alert.closeButton = { text: alert.closeButton };
            } else if (alert.secondaryAction !== undefined || alert.secondaryCallback !== undefined) {
                alert.closeButton = { text: alert.secondaryAction, action: alert.secondaryCallback };
            } else if (alert.type === 'confirm') {
                alert.closeButton = { text: 'Batal' };
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
                    const ctx = new (window.AudioContext || window.webkitAudioContext)();
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
    }"
    x-on:alert.window="
        let d = $event.detail;
        let payload = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? d : {message: d, type: 'info'});
        add(payload);
    "
    class="fixed inset-0 z-100 flex pointer-events-none"
    id="vibe-alert-container"
    :class="getPositionClasses()"
>
    <div class="hidden" x-init="
        @if (session()->has('success')) add({ type: 'success', message: '{{ session('success') }}', title: 'Berhasil' }); @endif
        @if (session()->has('error')) add({ type: 'error', message: '{{ session('error') }}', title: 'Error' }); @endif
        @if (session()->has('warning')) add({ type: 'warning', message: '{{ session('warning') }}', title: 'Peringatan' }); @endif
        @if (session()->has('info')) add({ type: 'info', message: '{{ session('info') }}', title: 'Informasi' }); @endif
    "></div>

    <!-- Backdrop -->
    <div x-show="alerts.some(a => a.blocking)" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-vibe-900/40 dark:bg-black/40 backdrop-blur-[2px] pointer-events-auto"
         style="display: none; z-index: -1;"></div>


    <div class="w-full max-w-[20rem] sm:max-w-sm flex flex-col gap-4 pointer-events-none">
        <template x-for="alert in alerts" :key="alert.id">
            <div 
                :class="'pos-' + (alert.position || globalPosition)"
                @mouseenter="pauseTimer(alert)"
                @mouseleave="resumeTimer(alert)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="vibe-alert-start"
                x-transition:enter-end="opacity-100 transform-none"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform-none"
                x-transition:leave-end="vibe-alert-start"
                class="relative w-full bg-vibe-100 dark:bg-vibe-900 select-none rounded-2xl shadow-xl flex flex-col overflow-hidden ring-1 ring-black/5 dark:ring-white/10 pointer-events-auto"
            >
                <div class="p-4 sm:p-5 flex flex-col" :class="getAlignClasses(alert)">
                    <!-- Icon container -->
                    <div class="flex size-12 items-center justify-center rounded-full mb-6"
                        :class="typeClasses[alert.type] || typeClasses.info"
                        x-html="alert.icon || icons[alert.type] || icons.info"
                    ></div>
                    
                    <!-- Title -->
                    <h3 class="text-lg font-bold text-vibe-900 dark:text-white tracking-tight" 
                        x-text="alert.title || (alert.type === 'error' ? 'Error' : (alert.type === 'success' ? 'Berhasil' : 'Pemberitahuan'))"></h3>
                    
                    <!-- Message -->
                    <p class="mt-1 text-sm text-vibe-700 dark:text-vibe-300 leading-relaxed" x-text="alert.message"></p>
                </div>
                
                <!-- Footer -->
                <div class="px-4 pb-4 sm:px-5 sm:pb-5 pt-1 flex w-full"
                     :class="{
                         'flex-col space-y-2': alert.buttonLayout === 'col',
                         'flex-row space-x-2 sm:space-x-3': alert.buttonLayout === 'row' || (!alert.buttonLayout && (alert.align || globalAlign) === 'center'),
                         'justify-end space-x-2 sm:space-x-3': !alert.buttonLayout && (alert.align || globalAlign) !== 'center',
                     }">
                    
                    <button x-show="alert.closeButton" @click="if(alert.closeButton && alert.closeButton.action) executeCallback(alert.closeButton.action); remove(alert.id)" 
                        :class="[(alert.closeButton && alert.closeButton.class) ? alert.closeButton.class : 'inline-flex justify-center rounded-lg border border-vibe-200 dark:border-vibe-700 bg-vibe-50 hover:bg-vibe-100 dark:bg-vibe-800 dark:hover:bg-vibe-700 px-4 py-2 text-sm font-semibold text-vibe-700 dark:text-vibe-200 shadow-sm',
                                (alert.buttonLayout === 'col' || alert.buttonLayout === 'row' || (!alert.buttonLayout && (alert.align || globalAlign) === 'center')) ? 'flex-1 w-full' : '']" 
                        x-text="alert.closeButton ? alert.closeButton.text : ''"></button>
                    
                    <button x-show="alert.confirmButton" @click="if(alert.confirmButton && alert.confirmButton.action) executeCallback(alert.confirmButton.action); remove(alert.id)" 
                        :class="[(alert.confirmButton && alert.confirmButton.class) ? alert.confirmButton.class : 'inline-flex justify-center rounded-lg bg-vibe-950 dark:bg-vibe-100 px-4 py-2 text-sm font-semibold text-white dark:text-vibe-950 shadow-sm hover:bg-vibe-800 dark:hover:bg-vibe-200',
                                (alert.buttonLayout === 'col' || alert.buttonLayout === 'row' || (!alert.buttonLayout && (alert.align || globalAlign) === 'center')) ? 'flex-1 w-full' : '']" 
                        x-text="alert.confirmButton ? alert.confirmButton.text : ''"></button>
                </div>
            </div>
        </template>
    </div>
</div>

<script>
    if (typeof window.vibeAlert === 'undefined') {
        window.vibeAlert = function(payload) {
            if (typeof payload === 'string') {
                payload = { message: payload, type: 'info' };
            }
            
            let fired = false;
            let dispatchEvent = () => {
                if (fired) return;
                fired = true;
                window.dispatchEvent(new CustomEvent('alert', { detail: payload }));
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
