@blaze()

@props([
    'variant' => 'ghost',
    'title' => null,
    'message' => null,
    'confirmText' => null,
    'cancelText' => null,
    'action' => null,
    'url' => null,
    'label' => null,
    'closeOnClick' => true,
])

@php
    $closeOnClick = filter_var($closeOnClick, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? true;
    $title = $title ?? __('vibe/context.delete_title');
    $message = $message ?? __('vibe/context.delete_message');
    $confirmText = $confirmText ?? __('vibe/context.delete_confirm');
    $cancelText = $cancelText ?? __('vibe/context.delete_cancel');

    $wireClick = $attributes->wire('click')->value();
    $itemAttributes = $attributes->whereDoesntStartWith('wire:click');
    $formId = !empty($url) ? 'ctx-delete-form-' . uniqid() : null;

    // Build the JS callback matching vibe:button.delete
    $callbackJs = match (true) {
        !empty($wireClick) => str_contains($wireClick, '(') ? "\$wire.{$wireClick}" : "\$wire.{$wireClick}()",
        !empty($action)    => $action,
        !empty($url)       => "document.getElementById('{$formId}')?.submit()",
        default            => "\$el.closest('form')?.submit()",
    };

    $defaultClasses = match ($variant) {
        'ghost' => 'text-destructive hover:text-destructive hover:bg-destructive/15 dark:hover:bg-destructive/25 focus-visible:bg-destructive/15 focus-visible:text-destructive active:bg-destructive/25',
        'outline' => 'border border-destructive/30 text-destructive hover:bg-destructive/10 focus-visible:bg-destructive/10 focus-visible:text-destructive',
        default => 'text-destructive hover:text-destructive hover:bg-destructive/15 dark:hover:bg-destructive/25 focus-visible:bg-destructive/15 focus-visible:text-destructive active:bg-destructive/25',
    };

    $itemClasses = "w-full justify-start font-normal px-3 py-1.5 text-sm rounded-md transition-colors {$defaultClasses}";

    $mergedAttributes = $itemAttributes->merge([
        'type' => 'button',
        'role' => 'menuitem',
        'tabindex' => '-1',
        'data-confirm-title' => $title,
        'data-confirm-message' => $message,
        'data-confirm-text' => $confirmText,
        'data-cancel-text' => $cancelText,
        'data-close-on-click' => $closeOnClick ? 'true' : 'false',
        'x-on:click.stop' => "vibeConfirmDelete(\$el, () => { {$callbackJs} })",
        'class' => $itemClasses,
    ]);
@endphp

<vibe:button :variant="$variant" :attributes="$mergedAttributes">
    <svg class="size-4 mr-2 shrink-0 text-destructive" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9.17 4a3.001 3.001 0 0 1 5.66 0M20.5 6H3.5m15.333 2.5l-.46 6.899c-.177 2.655-.265 3.983-1.13 4.792C16.378 21 15.047 21 12.387 21h-.774c-2.66 0-3.991 0-4.856-.809-.865-.809-.953-2.137-1.13-4.792L5.167 8.5M9.5 11l.5 5m4.5-5l-.5 5" />
    </svg>
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @elseif ($label)
        {{ $label }}
    @elseif ($title && $title !== __('vibe/context.delete_title') && $title !== __('vibe/button.delete_title'))
        {{ $title }}
    @else
        {{ __('vibe/context.delete') }}
    @endif
</vibe:button>

@if ($url)
    <form id="{{ $formId }}" action="{{ $url }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endif

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

                var safeCb = function() {
                    if (typeof cb === 'function') {
                        try {
                            var res = cb();
                            if (res && typeof res.catch === 'function') {
                                res.catch(function(e) {
                                    console.error('Error executing delete action promise:', e);
                                });
                            }
                        } catch (e) {
                            console.error('Error executing delete action:', e);
                        }
                    }
                };

                if (typeof vibeAlert !== 'undefined') {
                    vibeAlert({
                        type: 'confirm',
                        title: options.title,
                        message: options.message,
                        confirmButton: {
                            text: options.confirmText,
                            class: 'bg-destructive text-destructive-foreground hover:bg-destructive/90',
                            action: safeCb
                        },
                        closeButton: {
                            text: options.cancelText
                        }
                    });
                } else if (confirm(options.message)) {
                    safeCb();
                }
            };
        }
    </script>
@endPushOnce
