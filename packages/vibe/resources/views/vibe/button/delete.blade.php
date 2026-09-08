@blaze(fold: true)

@props([
    'variant' => 'ghost',
    'size' => 'md',
    'title' => 'Hapus Data?',
    'message' => 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.',
    'confirmText' => 'Ya, Hapus',
    'cancelText' => 'Batal',
    'action' => null,
])

@php
    $wireClick = $attributes->wire('click')->value();
    $buttonAttributes = $attributes->whereDoesntStartWith('wire:click');
    $isGhost = $variant === 'ghost';
    $isIcon = str_starts_with($size, 'icon-');

    $defaultClasses = match ($variant) {
        'ghost' => 'text-destructive/80 hover:text-destructive hover:bg-destructive/30',
        'outline' => 'border-destructive/30 text-destructive hover:bg-destructive/10',
        default => 'text-destructive/80 hover:text-destructive hover:bg-destructive/30',
    };

    $callbackJs = match (true) {
        !empty($wireClick) => "\$wire.{$wireClick}",
        !empty($action) => $action,
        default => "\$el.closest('form')?.submit()",
    };

    $mergedAttributes = $buttonAttributes->merge([
        'class' => $defaultClasses,
        'title' => $title,
        'data-confirm-title' => $title,
        'data-confirm-message' => $message,
        'data-confirm-text' => $confirmText,
        'data-cancel-text' => $cancelText,
        'x-on:click.stop' => "vibeConfirmDelete(\$el, () => { {$callbackJs} })",
    ]);
@endphp

<vibe:button :variant="$variant" :size="$size" :attributes="$mergedAttributes">
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @else
        <svg class="{{ $isIcon ? 'size-3.5' : 'size-4 mr-1.5' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 6h18" />
            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
            <line x1="10" x2="10" y1="11" y2="17" />
            <line x1="14" x2="14" y1="11" y2="17" />
        </svg>
    @endif
</vibe:button>

@pushOnce('head', 'vibe-confirm-delete-handler')
    <script>
        if (typeof window.vibeConfirmDelete === 'undefined') {
            window.vibeConfirmDelete = function(target, callback) {
                var options = {};
                var cb = callback;

                if (target instanceof Element) {
                    options = {
                        title: target.getAttribute('data-confirm-title'),
                        message: target.getAttribute('data-confirm-message'),
                        confirmText: target.getAttribute('data-confirm-text'),
                        cancelText: target.getAttribute('data-cancel-text')
                    };
                } else if (typeof target === 'object' && target !== null) {
                    options = target;
                    cb = callback || target.callback;
                }

                if (typeof vibeAlert !== 'undefined') {
                    vibeAlert({
                        type: 'confirm',
                        title: options.title,
                        message: options.message,
                        confirmButton: {
                            text: options.confirmText,
                            class: 'bg-destructive text-destructive-foreground hover:bg-destructive/90',
                            action: cb
                        },
                        closeButton: {
                            text: options.cancelText
                        }
                    });
                } else if (confirm(options.message)) {
                    if (typeof cb === 'function') {
                        cb();
                    }
                }
            };
        }
    </script>
@endPushOnce
