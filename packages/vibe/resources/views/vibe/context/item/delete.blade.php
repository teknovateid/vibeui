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
        !empty($wireClick) => "\$wire.{$wireClick}",
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
    <svg class="size-4 mr-2 shrink-0 text-destructive" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 6h18" />
        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
        <line x1="10" x2="10" y1="11" y2="17" />
        <line x1="14" x2="14" y1="11" y2="17" />
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
