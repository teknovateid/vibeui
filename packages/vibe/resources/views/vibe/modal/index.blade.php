@blaze(fold: true)

@props([
    'id' => null,
    'persist' => false,
    'dismissible' => true,
    'dismissibleButton' => true,
    'show' => false,
    'position' => 'center',
    'maxWidth' => '2xl',
    'teleport' => true,
    'variant' => 'default',
    'containerClass' => null,
    'backdropClass' => null,
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

    $variantClasses = match ($variant) {
        'outline' => 'bg-transparent border border-border shadow-none',
        'ghost' => 'bg-transparent border-transparent shadow-none',
        'flat', 'muted' => 'bg-muted/50 border-transparent shadow-none',
        'elevated' => 'bg-card border border-border/80 shadow-md',
        'container' => 'bg-container text-container-foreground border border-container-border shadow-xs',
        default => 'bg-card border border-border shadow-2xs',
    };

    $dialogClasses = "relative overflow-hidden text-left transition-all transform shadow-2xl w-full {$maxWidthClasses} text-card-foreground rounded-xl {$variantClasses}";
@endphp

<div x-data="{
    open: {{ $persist ? "(() => { const s = window.VibeModal?.getStored('{$modalId}'); return s ? !!s.open : " . ($show ? 'true' : 'false') . '; })()' : ($show ? 'true' : 'false') }},
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
}" @open-modal.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === modalId) open = true" @close-modal.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === modalId) close()" @keydown.escape.window="if (open && '{{ $dismissible ? 'true' : 'false' }}' === 'true') close()" class="vibe-modal-root">
    @if ($teleport)
        <template x-teleport="body">
    @endif

    <div id="{{ $modalId }}" x-show="open" x-cloak class="vibe-modal-container fixed inset-0 z-60 overflow-y-auto {{ $containerClass }}" aria-labelledby="modal-title" role="dialog" aria-modal="true" data-dismissible="{{ $dismissible ? 'true' : 'false' }}" style="display: none;">
        <div class="flex justify-center min-h-screen p-4 text-center {{ $positionClasses }}">
            <div x-show="open" x-transition.opacity class="fixed inset-0 transition-opacity bg-black/60 backdrop-blur-xs {{ $backdropClass }}" aria-hidden="true" @if ($dismissible) @click="close" @endif></div>

            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" {{ $attributes->twMerge(['class' => $dialogClasses]) }}>
                @if ($dismissibleButton)
                    <div class="absolute top-4 right-4 z-10">
                        <vibe:modal.close />
                    </div>
                @endif

                {{ $slot }}
            </div>
        </div>
    </div>
    @if ($teleport)
        </template>
    @endif
</div>
