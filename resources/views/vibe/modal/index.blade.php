@blaze(fold: true)

@props([
    'id' => null,
    'persist' => false,
    'dismissible' => true,
    'show' => false,
    'position' => 'center',
    'maxWidth' => '2xl',
    'teleport' => true,
])

@php
    $modalId = $id ?? uniqid('modal-');
    
    $positionClasses = match ($position) {
        'top' => 'items-start pt-16 sm:pt-24',
        'center' => 'items-center',
        'bottom' => 'items-end pb-16 sm:pb-24',
        default => 'items-center',
    };

    $maxWidthClasses = match ($maxWidth) {
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
        '4xl' => 'sm:max-w-4xl',
        '5xl' => 'sm:max-w-5xl',
        '6xl' => 'sm:max-w-6xl',
        '7xl' => 'sm:max-w-7xl',
        'full' => 'sm:max-w-full',
        default => $maxWidth,
    };
@endphp

<div 
    x-data="{ 
        open: {{ ($persist ? "(() => { const s = window.VibeModal?.getStored('{$modalId}'); return s ? !!s.open : " . ($show ? 'true' : 'false') . "; })()" : ($show ? 'true' : 'false')) }},
        modalId: '{{ $modalId }}',
        persist: {{ $persist ? 'true' : 'false' }},
        
        init() {
            if (this.persist && this.modalId) {
                let stored = window.VibeModal?.getStored(this.modalId);
                if (stored) {
                    this.open = !!stored.open;
                }
            }

            if (this.open) {
                document.body.classList.add('overflow-hidden');
            }

            this.$watch('open', value => {
                if (value) {
                    document.body.classList.add('overflow-hidden');
                    if (this.persist && this.modalId) {
                        if (window.Alpine && Alpine.store && Alpine.store('vibeModals')) {
                            Alpine.store('vibeModals').setOpen(this.modalId, true);
                        } else if (window.VibeModal) {
                            window.VibeModal.setOpen(this.modalId, true);
                        }
                    }
                    setTimeout(() => {
                        let dialog = document.getElementById(this.modalId);
                        let input = dialog ? dialog.querySelector('input:not([type=hidden]):not([disabled]), textarea:not([disabled]), select:not([disabled])') : null;
                        if (input) input.focus();
                    }, 100);
                } else {
                    document.body.classList.remove('overflow-hidden');
                    if (this.persist && this.modalId) {
                        if (window.Alpine && Alpine.store && Alpine.store('vibeModals')) {
                            Alpine.store('vibeModals').setOpen(this.modalId, false);
                        } else if (window.VibeModal) {
                            window.VibeModal.setOpen(this.modalId, false);
                        }
                    }
                }
            });

            if (typeof this.$cleanup === 'function') {
                this.$cleanup(() => {
                    document.body.classList.remove('overflow-hidden');
                });
            }
        },
        
        close() {
            this.open = false;
            document.body.classList.remove('overflow-hidden');
            if (this.persist && this.modalId) {
                if (window.Alpine && Alpine.store && Alpine.store('vibeModals')) {
                    Alpine.store('vibeModals').dismiss(this.modalId);
                } else if (window.VibeModal) {
                    window.VibeModal.dismiss(this.modalId);
                }
            }
        }
    }"
    @open-modal.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === modalId) open = true"
    @close-modal.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === modalId) close()"
    @keydown.escape.window="if (open && '{{ $dismissible ? 'true' : 'false' }}' === 'true') close()"
    class="vibe-modal-root"
>
    @if ($teleport)
    <template x-teleport="body">
    @endif
        <div 
            id="{{ $modalId }}"
            x-show="open"
            x-cloak
            {{ $attributes->twMerge(['class' => 'vibe-modal-container fixed inset-0 z-60 overflow-y-auto']) }}
            aria-labelledby="modal-title" 
            role="dialog" 
            aria-modal="true"
            data-dismissible="{{ $dismissible ? 'true' : 'false' }}"
            style="display: none;"
        >
            <div class="flex justify-center min-h-screen p-4 text-center {{ $positionClasses }}">
                <div x-show="open" x-transition.opacity class="fixed inset-0 transition-opacity bg-black/60 backdrop-blur-xs" aria-hidden="true" @if($dismissible) @click="close" @endif></div>

                <vibe:card x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative overflow-hidden text-left transition-all transform shadow-2xl w-full {{ $maxWidthClasses }}">
                    <div class="absolute top-4 right-4 hidden sm:block z-10">
                        @if($dismissible)
                        <vibe:button @click="close" type="button" variant="ghost" size="icon-sm" class="text-muted-foreground hover:text-foreground">
                            <span class="sr-only">{{ __('vibe/modal.close') }}</span>
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </vibe:button>
                        @endif
                    </div>
                    
                    <div class="pt-2 sm:pt-0">
                        {{ $slot }}
                    </div>
                </vibe:card>
            </div>
        </div>
    @if ($teleport)
    </template>
    @endif
</div>
