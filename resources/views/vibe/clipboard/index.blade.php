@blaze

@props([
    'value' => null,
    'target' => null,
    'variant' => 'outline', // outline, ghost, primary, secondary, surface, default, field/input, code/box
    'size' => 'md',         // xs, sm, md, lg, xl (also accepts icon-xs .. icon-xl)
    'label' => null,
    'description' => null,
    'copyLabel' => null,
    'copiedLabel' => null,
    'failedLabel' => null,
    'bubble' => 'top',      // top, bottom, left, right, false
    'duration' => 2000,
    'toast' => false,
    'masked' => false,
    'prefix' => null,
    'icon' => null,
    'tooltip' => null,
    'ariaLabel' => null,
    'disabled' => false,
    'id' => null,
    'wrapperClass' => null,
])

@php
    $instanceId = $id ?? uniqid('vibe-clipboard-');
    $normalizedVariant = match (strtolower((string) $variant)) {
        'input' => 'field',
        'box' => 'code',
        default => strtolower((string) $variant),
    };
    $isBoxMode = in_array($normalizedVariant, ['field', 'code'], true);
    $baseSize = str_starts_with((string) $size, 'icon-') ? substr((string) $size, 5) : (string) $size;

    [$boxHeight, $boxText, $boxRadius, $boxPadding, $triggerBtnSize, $iconDim, $affixClass] = match ($baseSize) {
        'xs' => ['h-7', 'text-xs', 'rounded-md', 'pl-2.5 pr-1', 'size-5', 'size-3.5', 'text-xs'],
        'sm' => ['h-8', 'text-xs', 'rounded-md', 'pl-3 pr-1', 'size-6', 'size-3.5', 'text-xs'],
        'lg' => ['h-10', 'text-sm', 'rounded-lg', 'pl-4 pr-1.5', 'size-7.5', 'size-4.5', 'text-sm'],
        'xl' => ['h-11', 'text-base', 'rounded-xl', 'pl-5 pr-2', 'size-8', 'size-5', 'text-sm'],
        default => ['h-9', 'text-sm', 'rounded-lg', 'pl-3.5 pr-1.5', 'size-7', 'size-4', 'text-xs'],
    };

    $rawValue = $value !== null ? (string) $value : '';
    $slotContent = $slot->isNotEmpty() ? trim((string) $slot) : '';
    $hasButtonText = ! $isBoxMode && ($slotContent !== '' || $copyLabel !== null || $label !== null);
    $idleButtonText = $slotContent !== '' ? $slotContent : ($copyLabel ?? $label ?? __('vibe/clipboard.copy'));

    $resolvedCopiedText = $copiedLabel ?? __('vibe/clipboard.copied');
    $resolvedFailedText = $failedLabel ?? __('vibe/clipboard.failed');
    $resolvedAriaLabel = $ariaLabel ?? $tooltip ?? __('vibe/clipboard.copy_value');
    $resolvedDuration = max(300, (int) $duration);
    $isDisabled = $disabled || ($attributes->has('disabled') && $attributes->get('disabled') !== false);

    $toastValue = is_string($toast) && trim($toast) !== '' ? $toast : (($toast === true || $toast === 'true' || $toast === 1 || $toast === '1') ? 'true' : null);
    $copiedToastText = __('vibe/clipboard.copied_toast');
    $failedToastText = __('vibe/clipboard.failed_toast');

    $showBubble = $bubble !== false && $bubble !== 'false' && $bubble !== 0 && $bubble !== '0';
    $bubblePositionClasses = match ((string) $bubble) {
        'bottom' => 'top-full left-1/2 -translate-x-1/2 mt-1.5',
        'left' => 'right-full top-1/2 -translate-y-1/2 mr-1.5',
        'right' => 'left-full top-1/2 -translate-y-1/2 ml-1.5',
        default => 'bottom-full left-1/2 -translate-x-1/2 mb-1.5',
    };

    $sourceId = $instanceId . '-source';
    $resolvedTarget = $target ?: ($isBoxMode ? $sourceId : null);

    $boxSurfaceClasses = $normalizedVariant === 'code'
        ? 'bg-muted/60 border-border font-mono'
        : 'bg-background border-input focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 shadow-2xs';

    $showLabel = __('vibe/clipboard.show_value');
    $hideLabel = __('vibe/clipboard.hide_value');
    $buttonForwardedAttributes = $isBoxMode
        ? new \Illuminate\View\ComponentAttributeBag()
        : $attributes->except(['class', 'disabled', 'type', 'id']);
@endphp

@if ($isBoxMode)
    <div
        id="{{ $instanceId }}"
        @if($masked) x-data="{ revealed: false }" @endif
        {{ $attributes->only('class')->twMerge(['class' => trim("w-full {$wrapperClass}")]) }}
    >
        <vibe:partials.field-label
            :for="$sourceId"
            :label="$label"
            :description="$description"
            :descriptionId="$instanceId . '-description'"
        />

        <div
            data-vibe-clipboard
            class="relative flex items-center gap-2 w-full border transition-colors duration-150 {{ $boxHeight }} {{ $boxText }} {{ $boxRadius }} {{ $boxPadding }} {{ $boxSurfaceClasses }} {{ $isDisabled ? 'opacity-50 pointer-events-none bg-muted/40' : '' }}"
        >
            @if (isset($icon) || ! empty($prefix))
                <span class="inline-flex items-center gap-1.5 shrink-0 text-muted-foreground select-none {{ $affixClass }}">
                    @if (isset($icon))
                        <span class="{{ $iconDim }} flex items-center justify-center shrink-0 [&>svg]:size-full">{{ $icon }}</span>
                    @endif
                    @if (! empty($prefix))
                        <span class="font-semibold">{{ $prefix }}</span>
                    @endif
                </span>
            @endif

            @if ($normalizedVariant === 'code' && ! $masked)
                <code
                    id="{{ $sourceId }}"
                    class="flex-1 min-w-0 truncate text-foreground select-all cursor-text"
                >{{ $rawValue !== '' ? $rawValue : $slot }}</code>
            @else
                <input
                    id="{{ $sourceId }}"
                    @if($masked) type="password" :type="revealed ? 'text' : 'password'" @else type="text" @endif
                    readonly
                    @if($rawValue !== '') value="{{ $rawValue }}" @endif
                    @if($isDisabled) disabled @endif
                    @if($description) aria-describedby="{{ $instanceId }}-description" @endif
                    @if($label) aria-label="{{ $label }}" @elseif(!$ariaLabel) aria-label="{{ $resolvedAriaLabel }}" @endif
                    {{ $attributes->except(['class', 'disabled', 'readonly', 'type', 'id']) }}
                    class="flex-1 min-w-0 h-full bg-transparent border-0 p-0 text-foreground focus:outline-none focus:ring-0 select-all cursor-text {{ $normalizedVariant === 'code' ? 'font-mono' : '' }}"
                />
            @endif

            <div class="relative inline-flex items-center gap-1 shrink-0">
                @if ($masked)
                    <button
                        type="button"
                        @click.stop="revealed = !revealed"
                        :aria-pressed="revealed"
                        :aria-label="revealed ? @js($hideLabel) : @js($showLabel)"
                        :title="revealed ? @js($hideLabel) : @js($showLabel)"
                        aria-label="{{ $showLabel }}"
                        class="{{ $triggerBtnSize }} inline-flex items-center justify-center rounded-md text-muted-foreground hover:text-foreground hover:bg-muted/80 transition-colors cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
                    >
                        <svg x-show="!revealed" aria-hidden="true" class="{{ $iconDim }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <svg x-show="revealed" x-cloak aria-hidden="true" class="{{ $iconDim }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                            <path d="M2 2l20 20M9.88 9.88A3 3 0 1 0 14.12 14.12M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68M6.61 6.61A13.53 13.53 0 0 0 2 12s3.5 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                        </svg>
                    </button>
                @endif
@else
    <span
        id="{{ $instanceId }}"
        data-vibe-clipboard
        {{ $attributes->only('class')->twMerge(['class' => trim("relative inline-flex items-center {$wrapperClass}")]) }}
    >
@endif

        <vibe:button
            type="button"
            :variant="$isBoxMode ? 'ghost' : $normalizedVariant"
            :size="$isBoxMode ? 'icon-xs' : ($hasButtonText ? $baseSize : ('icon-' . $baseSize))"
            command="--copy"
            :commandfor="$resolvedTarget"
            data-vibe-clipboard-trigger
            :data-clipboard-value="$rawValue !== '' ? $rawValue : null"
            :data-copied-text="$resolvedCopiedText"
            :data-failed-text="$resolvedFailedText"
            :data-copy-duration="$resolvedDuration"
            :data-copy-toast="$toastValue"
            :data-copied-toast="$toastValue ? $copiedToastText : null"
            :data-failed-toast="$toastValue ? $failedToastText : null"
            :disabled="$isDisabled"
            :aria-label="!$hasButtonText ? $resolvedAriaLabel : null"
            :title="$tooltip ?? (!$hasButtonText ? ($copyLabel ?? $resolvedAriaLabel) : null)"
            :class="$isBoxMode ? trim($triggerBtnSize . ' p-0 rounded-md text-muted-foreground hover:text-foreground') : null"
            :attributes="$buttonForwardedAttributes"
        >
            <span data-vibe-clipboard-state="idle" class="inline-flex items-center gap-1.5">
                <svg aria-hidden="true" class="{{ $iconDim }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="13" height="13" x="9" y="9" rx="2" />
                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                </svg>
                @if ($hasButtonText)
                    <span>{{ $idleButtonText }}</span>
                @endif
            </span>

            <span data-vibe-clipboard-state="copied" class="items-center gap-1.5">
                <svg aria-hidden="true" class="{{ $iconDim }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 12l5 5L20 7" />
                </svg>
                @if ($hasButtonText)
                    <span>{{ $resolvedCopiedText }}</span>
                @endif
            </span>

            <span data-vibe-clipboard-state="failed" class="items-center gap-1.5">
                <svg aria-hidden="true" class="{{ $iconDim }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 8v4m0 4h.01" />
                </svg>
                @if ($hasButtonText)
                    <span>{{ $resolvedFailedText }}</span>
                @endif
            </span>
        </vibe:button>

        {{-- Live region stays outside <button> so assistive technology reliably announces state updates --}}
        <span
            data-vibe-clipboard-status
            role="status"
            aria-live="polite"
            class="{{ $showBubble ? "vibe-clipboard-tip absolute {$bubblePositionClasses} px-2 py-0.5 rounded-md text-[11px] font-medium bg-foreground text-background shadow-sm whitespace-nowrap z-20 select-none" : 'sr-only' }}"
        ></span>

@if ($isBoxMode)
            </div>
        </div>
    </div>
@else
    </span>
@endif
