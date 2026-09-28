@blaze(fold: true)

@props([
    'variant' => 'ghost',
    'size' => 'md',
    'title' => null,
    'message' => null,
    'confirmText' => null,
    'cancelText' => null,
    'action' => null,
    'url' => null,
])

@php
    $title = $title ?? __('vibe/button.delete_title');
    $message = $message ?? __('vibe/button.delete_message');
    $confirmText = $confirmText ?? __('vibe/button.delete_confirm');
    $cancelText = $cancelText ?? __('vibe/button.delete_cancel');
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
        !empty($url) => "window.vibeSubmitDelete('{$url}')",
        !empty($wireClick) => str_contains($wireClick, '(') ? "\$wire.{$wireClick}" : "\$wire.{$wireClick}()",
        !empty($action) => $action,
        default => "\$el.closest('form')?.submit()",
    };

    $mergedAttributes = $buttonAttributes->merge([
        'class' => $defaultClasses,
        'title' => $title,
        'data-url' => $url,
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
        <svg class="{{ $isIcon ? 'size-3.5' : 'size-4 mr-1.5' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9.17 4a3.001 3.001 0 0 1 5.66 0M20.5 6H3.5m15.333 2.5l-.46 6.899c-.177 2.655-.265 3.983-1.13 4.792C16.378 21 15.047 21 12.387 21h-.774c-2.66 0-3.991 0-4.856-.809-.865-.809-.953-2.137-1.13-4.792L5.167 8.5M9.5 11l.5 5m4.5-5l-.5 5" />
        </svg>
    @endif
</vibe:button>

@pushOnce('head', 'vibe-confirm-delete-handler')
    <script>
        if (typeof window.vibeSubmitDelete === 'undefined') {
            window.vibeSubmitDelete = function(url) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                var token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
                form.innerHTML = '<input type="hidden" name="_token" value="' + token + '"><input type="hidden" name="_method" value="DELETE">';
                document.body.appendChild(form);
                form.submit();
            };
        }

        if (typeof window.vibeConfirmDelete === 'undefined') {
            window.vibeConfirmDelete = function(target, callback) {
                var options = {};
                var cb = callback;

                if (target instanceof Element) {
                    options = {
                        title: target.getAttribute('data-confirm-title'),
                        message: target.getAttribute('data-confirm-message'),
                        confirmText: target.getAttribute('data-confirm-text'),
                        cancelText: target.getAttribute('data-cancel-text'),
                        url: target.getAttribute('data-url')
                    };
                } else if (typeof target === 'object' && target !== null) {
                    options = target;
                    cb = callback || target.callback;
                }

                if (!cb && options.url) {
                    cb = function() {
                        window.vibeSubmitDelete(options.url);
                    };
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
