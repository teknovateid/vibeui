@blaze(fold: true)

@props([
    'title' => null,
    'message' => null,
    'confirmText' => null,
    'cancelText' => null,
    'url' => null,
])

@php
    $title = $title ?? __('vibe/button.delete_title');
    $message = $message ?? __('vibe/button.delete_message');
    $confirmText = $confirmText ?? __('vibe/button.delete_confirm');
    $cancelText = $cancelText ?? __('vibe/button.delete_cancel');

    $wireClick = $attributes->wire('click')->value();
    $itemAttributes = $attributes->whereDoesntStartWith('wire:click');

    // Build the JS callback
    $callbackJs = match (true) {
        !empty($wireClick) => "\$wire.{$wireClick}",
        !empty($url)       => "document.getElementById('ctx-delete-form-{{ uniqid() }}')?.submit()",
        default            => "null",
    };

    $itemClasses = 'w-full justify-start font-normal px-3 py-1.5 text-sm rounded-md transition-colors text-destructive hover:bg-destructive/10 hover:text-destructive focus-visible:bg-destructive/10 focus-visible:text-destructive active:bg-destructive/20';
@endphp

<vibe:button
    variant="ghost"
    type="button"
    role="menuitem"
    tabindex="-1"
    data-confirm-title="{{ $title }}"
    data-confirm-message="{{ $message }}"
    data-confirm-text="{{ $confirmText }}"
    data-cancel-text="{{ $cancelText }}"
    x-on:click.stop="vibeConfirmDelete($el, () => { {{ $callbackJs }} })"
    {{ $itemAttributes->twMerge(['class' => $itemClasses]) }}
>
    <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 6h18" />
        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
        <line x1="10" x2="10" y1="11" y2="17" />
        <line x1="14" x2="14" y1="11" y2="17" />
    </svg>
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @else
        {{ $title }}
    @endif
</vibe:button>

@if ($url)
    @php $formId = 'ctx-delete-form-' . uniqid(); @endphp
    <form id="{{ $formId }}" action="{{ $url }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endif
