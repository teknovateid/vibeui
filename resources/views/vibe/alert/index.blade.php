@blaze

@props([
    'position' => 'center',
    'align' => 'center',
    'timeout' => 3000,
])

@php
    // We move the class mappings to Alpine for dynamic overriding
@endphp

<div 
    x-data="{
        alerts: [],
        globalPosition: '{{ $position }}',
        globalAlign: '{{ $align }}',
        
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
            // Prevent multiple confirm dialogs
            if (alert.type === 'confirm' && this.alerts.some(a => a.type === 'confirm')) {
                return;
            }
            
            // Prevent exact duplicate alerts
            if (this.alerts.some(a => a.title === alert.title && a.message === alert.message && a.type === alert.type)) {
                return;
            }

            let id = Date.now() + Math.random().toString(36).substr(2, 9);
            
            if (alert.type === 'confirm') {
                alert.timeout = false;
                alert.primaryAction = alert.primaryAction || 'Ya, Lanjutkan';
                alert.secondaryAction = alert.secondaryAction || 'Batal';
                alert.position = alert.position || 'center';
            }
            
            let item = { ...alert, id, timer: null, hover: false };
            this.alerts.push(item);
            
            this.startTimer(item);
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
        }
    }"
    @alert.window="
        let d = $event.detail;
        let payload = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? d : {message: d, type: 'info'});
        add(payload);
    "
    class="fixed inset-0 z-[100] flex pointer-events-none"
    :class="getPositionClasses()"
>
    <!-- Handle Session Flash Messages -->
    <div class="hidden" x-init="
        @if (session()->has('success')) add({ type: 'success', message: '{{ session('success') }}', title: 'Berhasil' }); @endif
        @if (session()->has('error')) add({ type: 'error', message: '{{ session('error') }}', title: 'Error' }); @endif
        @if (session()->has('warning')) add({ type: 'warning', message: '{{ session('warning') }}', title: 'Peringatan' }); @endif
        @if (session()->has('info')) add({ type: 'info', message: '{{ session('info') }}', title: 'Informasi' }); @endif
    "></div>

    <!-- Backdrop -->
    <div x-show="alerts.length > 0 && isCenter()" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-900/40 dark:bg-gray-900/80 pointer-events-auto"></div>

    <div class="w-full max-w-[20rem] sm:max-w-sm flex flex-col gap-4 shadow-lg rounded-2xl pointer-events-auto">
        <template x-for="alert in alerts" :key="alert.id">
            <div 
                @mouseenter="pauseTimer(alert)"
                @mouseleave="resumeTimer(alert)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-8 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-8 scale-95"
                class="relative w-full bg-vibe-100 dark:bg-vibe-900 rounded-2xl shadow-xl flex flex-col overflow-hidden ring-1 ring-black/5 dark:ring-white/10"
            >
                <div class="p-4 sm:p-5 flex flex-col" :class="getAlignClasses(alert)">
                    <!-- Icon container -->
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl mb-4"
                        :class="{
                            'bg-green-50 dark:bg-green-900/30': alert.type === 'success',
                            'bg-red-50 dark:bg-red-900/30': alert.type === 'error',
                            'bg-yellow-50 dark:bg-yellow-900/30': alert.type === 'warning' || alert.type === 'confirm',
                            'bg-blue-50 dark:bg-blue-900/30': !alert.type || alert.type === 'info',
                        }"
                    >
                        <!-- Success Icon -->
                        <svg x-show="alert.type === 'success'" class="h-6 w-6 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" style="display: none;" />
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                        </svg>
                        <!-- Error Icon -->
                        <svg x-show="alert.type === 'error'" class="h-6 w-6 text-red-500 dark:text-red-400" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                        </svg>
                        <!-- Warning/Confirm Icon -->
                        <svg x-show="alert.type === 'warning' || alert.type === 'confirm'" class="h-6 w-6 text-yellow-500 dark:text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                        </svg>
                        <!-- Info Icon -->
                        <svg x-show="!alert.type || alert.type === 'info'" class="h-6 w-6 text-blue-500 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 011.08.732l-2.15 8.6a1.5 1.5 0 01-2.884-.712l.71-2.837-.042.02a.75.75 0 01-1.08-.732l2.15-8.6a1.5 1.5 0 011.757-1.003zM12 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    
                    <!-- Title -->
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white tracking-tight" 
                        x-text="alert.title || (alert.type === 'error' ? 'Error' : (alert.type === 'success' ? 'Berhasil' : 'Pemberitahuan'))"></h3>
                    
                    <!-- Message -->
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 leading-relaxed" x-text="alert.message"></p>
                </div>
                
                <!-- Footer -->
                <div class="px-5 py-3 sm:px-6 sm:py-4 flex items-center border-t border-gray-100 dark:border-white/10 bg-white dark:bg-vibe-950"
                     :class="{
                         'justify-between': (alert.align || globalAlign) === 'center' || (alert.align || globalAlign) === 'start',
                         'justify-end': (alert.align || globalAlign) === 'end',
                     }">
                    <!-- Left action -->
                    <button x-show="(alert.align || globalAlign) !== 'end'" @click="remove(alert.id)" class="text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white underline decoration-gray-300 dark:decoration-gray-600 underline-offset-4">Cancel</button>
                    
                    <!-- Right actions -->
                    <div class="flex items-center gap-2 sm:gap-3">
                        <button x-show="alert.secondaryAction" @click="if(alert.secondaryCallback) alert.secondaryCallback(); remove(alert.id)" class="inline-flex justify-center rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-vibe-900 px-3 py-1.5 sm:px-4 sm:py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-vibe-800 transition-colors" x-text="alert.secondaryAction"></button>
                        
                        <button @click="if(alert.primaryCallback) alert.primaryCallback(); remove(alert.id)" class="inline-flex justify-center rounded-lg bg-vibe-950 dark:bg-vibe-100 px-3 py-1.5 sm:px-4 sm:py-2 text-sm font-semibold text-white dark:text-vibe-950 shadow-sm hover:bg-vibe-800 dark:hover:bg-vibe-200 transition-colors" x-text="alert.primaryAction || 'Tutup'"></button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
