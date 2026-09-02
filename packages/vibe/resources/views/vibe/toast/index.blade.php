@blaze

@props([
    'position' => 'bottom-right',
    'timeout' => 3000,
    'sound' => false,
])

<div 
    x-data="{
        toasts: [],
        heights: {},
        globalPosition: '{{ $position }}',
        globalSound: '{{ $sound }}',
        expanded: false,
        hoverTimeout: null,
        
        typeClasses: {
            success: 'bg-card text-card-foreground border border-border',
            error: 'bg-card text-card-foreground border border-border',
            warning: 'bg-card text-card-foreground border border-border',
            info: 'bg-card text-card-foreground border border-border'
        },
        bubbleClasses: {
            success: 'bg-muted',
            error: 'bg-muted',
            warning: 'bg-muted',
            info: 'bg-muted'
        },
        iconClasses: {
            success: 'bg-green-100 dark:bg-green-900/40',
            error: 'bg-red-100 dark:bg-red-900/40',
            warning: 'bg-yellow-100 dark:bg-yellow-900/40',
            info: 'bg-blue-100 dark:bg-blue-900/40'
        },
        
        icons: {
            success: `<svg class='size-7 text-green-500' fill='none' viewBox='0 0 24 24' stroke-width='3' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' d='M4.5 12.75l6 6 9-13.5' /></svg>`,
            error: `<svg class='size-7 text-red-500' fill='none' viewBox='0 0 24 24' stroke-width='3' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' d='M12 8v4m0 4h.01' /></svg>`,
            warning: `<svg class='size-7 text-yellow-500' fill='none' viewBox='0 0 24 24' stroke-width='3' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' d='M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' /></svg>`,
            info: `<svg class='size-7 text-blue-500' fill='none' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' d='M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z' /></svg>`
        },
        
        getActivePosition() {
            return this.toasts.length > 0 ? (this.toasts[0].position || this.globalPosition) : this.globalPosition;
        },

        getPositionClasses() {
            let pos = this.getActivePosition();
            const positions = {
                'top-right': 'top-0 right-0',
                'top-left': 'top-0 left-0',
                'bottom-right': 'bottom-0 right-0',
                'bottom-left': 'bottom-0 left-0',
                'top-center': 'top-0 left-1/2 -translate-x-1/2',
                'bottom-center': 'bottom-0 left-1/2 -translate-x-1/2',
            };
            return positions[pos] || positions['bottom-right'];
        },
        
        getMarginClasses() {
            let pos = this.getActivePosition();
            const margins = {
                'top-right': 'mt-4 mr-4 sm:mt-6 sm:mr-6',
                'top-left': 'mt-4 ml-4 sm:mt-6 sm:ml-6',
                'bottom-right': 'mb-4 mr-4 sm:mb-6 sm:mr-6',
                'bottom-left': 'mb-4 ml-4 sm:mb-6 sm:ml-6',
                'top-center': 'mt-4 sm:mt-6',
                'bottom-center': 'mb-4 sm:mb-6',
            };
            return margins[pos] || margins['bottom-right'];
        },
        
        add(toast) {
            let id = Date.now() + Math.random().toString(36).substr(2, 9);
            
            let s = toast.sound !== undefined ? toast.sound : this.globalSound;
            if (s === 'true' || s === '1') s = true;
            if (s === 'false' || s === '0' || s === '') s = false;
            
            let item = { ...toast, id, timer: null, hover: false, sound: s };

            this.toasts.unshift(item);
            this.startTimer(item);
            this.playSound(item);
            
            if (this.toasts.length > 5) {
                let oldest = this.toasts[this.toasts.length - 1];
                this.remove(oldest.id);
            }
        },
        
        getAudioContext() {
            if (!window.vibeAudioContext || window.vibeAudioContext.state === 'closed') {
                const AudioCtx = window.AudioContext || window.webkitAudioContext;
                if (AudioCtx) {
                    window.vibeAudioContext = new AudioCtx();
                }
            }
            if (window.vibeAudioContext && window.vibeAudioContext.state === 'suspended') {
                window.vibeAudioContext.resume().catch(() => {});
            }
            return window.vibeAudioContext;
        },

        playSound(toast) {
            if (!toast || !toast.sound) return;

            if (typeof toast.sound === 'string' && toast.sound.length > 5) {
                try {
                    let audio = new Audio(toast.sound);
                    let p = audio.play();
                    if (p !== undefined) {
                        p.catch(e => console.warn('Audio play failed:', e));
                    }
                } catch (e) {
                    console.warn('Audio play failed:', e);
                }
            } else {
                try {
                    const ctx = this.getAudioContext();
                    if (!ctx) return;

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
        },
        
        remove(id) {
            let t = this.toasts.find(t => t.id === id);
            if (t && t.timer) clearTimeout(t.timer);
            this.toasts = this.toasts.filter(t => t.id !== id);
            delete this.heights[id];
        },
        
        startTimer(toast) {
            if (toast.timeout !== false && (toast.timeout || {{ $timeout }})) {
                let duration = toast.timeout || {{ $timeout }};
                toast.timer = setTimeout(() => {
                    this.remove(toast.id);
                }, duration);
            }
        },
        
        pauseTimer(toast) {
            if (toast.timer) {
                clearTimeout(toast.timer);
                toast.timer = null;
            }
        },
        
        resumeTimer(toast) {
            this.startTimer(toast);
        },
        
        onMouseEnter() {
            if (this.hoverTimeout) {
                clearTimeout(this.hoverTimeout);
                this.hoverTimeout = null;
            }
            this.expanded = true;
            this.toasts.forEach(t => this.pauseTimer(t));
        },
        
        onMouseLeave() {
            this.hoverTimeout = setTimeout(() => {
                this.expanded = false;
                this.toasts.forEach(t => this.resumeTimer(t));
            }, 300); // 300ms grace period for gaps
        },

        updateHeight(id, height) {
            if (height > 0) {
                this.heights[id] = height;
            }
        },

        getExpandedOffset(index) {
            let offset = 0;
            const gap = 12; // Gap/jarak antar toast saat expanded (12px)
            for (let i = 0; i < index; i++) {
                let t = this.toasts[i];
                let h = (t && this.heights[t.id]) ? this.heights[t.id] : (t && t.title ? 96 : 64);
                offset += h + gap;
            }
            return offset;
        },
        
        getTransform(index) {
            let isTop = this.getActivePosition().includes('top');
            
            if (this.expanded) {
                let y = this.getExpandedOffset(index);
                return `translateY(${isTop ? y : -y}px) scale(1)`;
            }
            
            let scale = 1 - (index * 0.05);
            let y = index * 14; 
            
            return `translateY(${isTop ? y : -y}px) scale(${scale})`;
        }
    }"
    x-on:toast.window="
        let d = $event.detail;
        let payload = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? d : {message: d, type: 'info'});
        add(payload);
    "
    class="fixed z-100 flex flex-col pointer-events-none"
    :class="[getPositionClasses(), getMarginClasses()]"
>
    <!-- Handle Session Flash Messages -->
    <div class="hidden" x-init="
        @if (session()->has('toast_success')) add({ type: 'success', message: '{{ session('toast_success') }}', title: '{{ __('vibe/toast.success') }}' }); @endif
        @if (session()->has('toast_error')) add({ type: 'error', message: '{{ session('toast_error') }}', title: '{{ __('vibe/toast.error') }}' }); @endif
        @if (session()->has('toast_warning')) add({ type: 'warning', message: '{{ session('toast_warning') }}', title: '{{ __('vibe/toast.warning') }}' }); @endif
        @if (session()->has('toast_info')) add({ type: 'info', message: '{{ session('toast_info') }}', title: '{{ __('vibe/toast.info') }}' }); @endif
    "></div>

    <div 
        class="relative w-full min-w-xs max-w-sm flex flex-col items-center pointer-events-none"
        @mouseenter="onMouseEnter()"
        @mouseleave="onMouseLeave()"
    >
        <template x-for="(toast, index) in toasts" :key="toast.id">
            <div 
                x-init="
                    $nextTick(() => {
                        updateHeight(toast.id, $el.offsetHeight);
                    });
                    if (window.ResizeObserver) {
                        const ro = new ResizeObserver(() => {
                            if ($el) updateHeight(toast.id, $el.offsetHeight);
                        });
                        ro.observe($el);
                    }
                "
                x-transition:enter="transition-all ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition-all ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                class="absolute left-0 right-0 p-4 rounded-xl lg:rounded-2xl shadow-lg pointer-events-auto flex items-center gap-3 overflow-hidden"
                :class="[
                    typeClasses[toast.type] || typeClasses.info,
                    getActivePosition().includes('top') ? 'top-0 origin-top' : 'bottom-0 origin-bottom'
                ]"
                :style="`transform: ${getTransform(index)}; z-index: ${50 - index}; opacity: ${index > 2 && !expanded ? 0 : 1}; transition-property: transform, opacity; transition-duration: 300ms;`"
            >
                <!-- Dekorasi Background Bulatan -->
                <div class="absolute -left-6 -top-6 size-24 rounded-full opacity-25 dark:opacity-40 mix-blend-multiply dark:mix-blend-overlay pointer-events-none" :class="bubbleClasses[toast.type] || bubbleClasses.info"></div>
                <div class="absolute left-6 -bottom-8 size-20 rounded-full opacity-15 dark:opacity-30 mix-blend-multiply dark:mix-blend-overlay pointer-events-none" :class="bubbleClasses[toast.type] || bubbleClasses.info"></div>

                <!-- Ikon dalam Lingkaran Putih -->
                <div class="shrink-0 relative z-10 w-11 h-11 rounded-full flex items-center justify-center" :class="iconClasses[toast.type] || iconClasses.info">
                    <span x-html="toast.icon || icons[toast.type] || icons.info"></span>
                </div>
                
                <!-- Teks Judul & Deskripsi -->
                <div class="flex-1 flex flex-col min-w-0 relative z-10 py-1 pl-1">
                    <h4 class="text-[15px] font-bold leading-tight" x-show="toast.title" x-text="toast.title"></h4>
                    <p class="text-[13px] opacity-85 leading-snug" :class="{'mt-1': toast.title}" x-text="toast.message"></p>
                </div>
                
                <!-- Tombol Close -->
                <button @click="remove(toast.id)" aria-label="{{ __('vibe/toast.close') }}" class="shrink-0 relative z-10 text-current opacity-40 hover:opacity-100 p-1.5 rounded-full hover:bg-black/5 dark:hover:bg-white/10 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </template>
    </div>
</div>

<script>
    if (typeof window.vibeToast === 'undefined') {
        window.vibeToast = function(payload) {
            if (typeof payload === 'string') {
                payload = { message: payload, type: 'info' };
            }
            
            let fired = false;
            let dispatchEvent = () => {
                if (fired) return;
                fired = true;
                window.dispatchEvent(new CustomEvent('toast', { detail: payload }));
            };
            
            if (document.readyState === 'loading') {
                document.addEventListener('alpine:initialized', () => setTimeout(dispatchEvent, 50));
                document.addEventListener('DOMContentLoaded', () => setTimeout(dispatchEvent, 150));
            } else {
                setTimeout(dispatchEvent, 50);
            }
        };
    }
</script>
