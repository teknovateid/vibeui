@blaze

@props([
    'id' => null,
    'persist' => false,
    'dismissible' => true,
    'dismissibleButton' => true,
    'show' => false,
    'position' => 'center',
    'maxWidth' => '2xl',
    'size' => null,
    'teleport' => true,
    'variant' => 'default',
    'animation' => false,
    'containerClass' => null,
    'backdropClass' => null,
])

@php
    $modalId = $id ?? uniqid('modal-');
    $effectiveMaxWidth = $size ?? $maxWidth;

    $positionClasses = match ($position) {
        'top' => 'mt-16 sm:mt-24 mb-auto mx-auto',
        'center' => 'm-auto',
        'bottom' => 'mt-auto mb-16 sm:mb-24 mx-auto',
        default => 'm-auto',
    };

    $maxWidthClasses = match ($effectiveMaxWidth) {
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

    $dialogClasses = trim("vibe-modal-container relative overflow-hidden text-left shadow-2xl w-[calc(100%-2rem)] {$maxWidthClasses} max-h-[calc(100dvh-2rem)] overflow-y-auto text-card-foreground rounded-xl {$variantClasses} {$positionClasses} backdrop:bg-black/60 backdrop:backdrop-blur-xs {$containerClass} {$backdropClass}");
@endphp

<div x-data="{
    open: {{ $persist ? "(() => { const s = window.VibeModal?.getStored('{$modalId}'); return s ? !!s.open : " . ($show ? 'true' : 'false') . '; })()' : ($show ? 'true' : 'false') }},
    modalId: '{{ $modalId }}',
    persist: {{ $persist ? 'true' : 'false' }},
    animation: @js($animation),
    isShaking: false,

    triggerShake() {
        this.isShaking = true;
        setTimeout(() => { this.isShaking = false; }, 500);
    },

    onBackdropClick() {
        if ('{{ $dismissible ? 'true' : 'false' }}' === 'true') {
            this.close();
        } else {
            this.triggerShake();
        }
    },

    syncDialog(value) {
        const dialog = document.getElementById(this.modalId);
        if (!dialog) return;
        if (value) {
            if (!dialog.open) {
                if (typeof dialog.showModal === 'function') dialog.showModal();
                else dialog.setAttribute('open', '');
            }
            if ('{{ $dismissible ? 'true' : 'false' }}' === 'true') {
                window.VibeCore?.bindDialogLightDismissFallback(dialog, () => this.close());
            }
            setTimeout(() => {
                const input = dialog.querySelector('input:not([type=hidden]):not([disabled]), textarea:not([disabled]), select:not([disabled])');
                if (input) input.focus();
            }, 60);
        } else if (dialog.open || dialog.hasAttribute('open')) {
            if (typeof dialog.close === 'function') dialog.close();
            else dialog.removeAttribute('open');
        }
    },

    init() {
        if (this.persist && this.modalId) {
            let stored = window.VibeModal?.getStored(this.modalId);
            if (stored) {
                this.open = !!stored.open;
            }
        }

        if (this.open) {
            this.$nextTick(() => this.syncDialog(true));
        }

        this.$watch('open', value => {
            this.$nextTick(() => this.syncDialog(value));
            if (this.persist && this.modalId) {
                if (window.Alpine && Alpine.store && Alpine.store('vibeModals')) {
                    Alpine.store('vibeModals').setOpen(this.modalId, !!value);
                } else if (window.VibeModal) {
                    window.VibeModal.setOpen(this.modalId, !!value);
                }
            }
        });
    },

    close() {
        this.open = false;
        this.syncDialog(false);
        if (this.persist && this.modalId) {
            if (window.Alpine && Alpine.store && Alpine.store('vibeModals')) {
                Alpine.store('vibeModals').dismiss(this.modalId);
            } else if (window.VibeModal) {
                window.VibeModal.dismiss(this.modalId);
            }
        }
    }
}" @open-modal.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === modalId) open = true" @close-modal.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === modalId || t === '*' || !t) close()" @toggle-modal.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === modalId) { open ? close() : open = true; }" class="vibe-modal-root">
    @if ($teleport)
        <template x-teleport="body">
    @endif

    <dialog id="{{ $modalId }}" closedby="{{ $dismissible ? 'any' : 'none' }}" data-vibe-dialog data-dismissible="{{ $dismissible ? 'true' : 'false' }}" aria-labelledby="modal-title" @cancel.prevent="if ('{{ $dismissible ? 'true' : 'false' }}' === 'true') { close(); } else { triggerShake(); }" @close="if (open) close()" :class="{ 'animate-vibe-shake': isShaking, 'animate-vibe-pop': animation === 'pop' || animation === 'bounce', 'animate-vibe-pulse': animation === 'pulse', 'animate-vibe-wobble': animation === 'wobble' }" {{ $attributes->twMerge(['class' => $dialogClasses]) }}>
        @if ($dismissibleButton)
            <div class="absolute top-4 right-4 z-10">
                <vibe:modal.close />
            </div>
        @endif

        {{ $slot }}
    </dialog>
    @if ($teleport)
        </template>
    @endif
</div>
