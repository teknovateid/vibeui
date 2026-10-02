@blaze(fold: true)

@props([
    'name'           => null,
    'value'          => '1',
    'id'             => null,
    'type'           => 'button', // 'button' | 'submit'
    'size'           => 'md',     // 'xs', 'sm', 'md', 'lg', 'xl'
    'variant'        => 'primary', // 'primary', 'success', 'destructive', 'danger', 'warning', 'info', 'secondary'
    'label'          => null,     // null = auto-translate via vibe/swipe.label
    'confirmedLabel' => null,     // null = auto-translate via vibe/swipe.confirmed_label
    'loadingLabel'   => null,     // null = auto-translate via vibe/swipe.loading_label
    'threshold'      => 0.88,
    'autoReset'      => false,    // false, true (2000ms), or number in ms
    'disabled'       => false,
    'readonly'       => false,
    'loading'        => false,
    'haptic'         => true,
    'icon'           => null,
    'confirmedIcon'  => null,
    'loadingIcon'    => null,
    'wrapperClass'   => null,
])

@php
    $id = $id ?? ($name ?? uniqid('vibe-swipe-'));

    // i18n: resolve default labels from translation files
    $label          = $label          ?? __('vibe/swipe.label');
    $confirmedLabel = $confirmedLabel ?? __('vibe/swipe.confirmed_label');
    $loadingLabel   = $loadingLabel   ?? __('vibe/swipe.loading_label', [], null) ?: 'Loading...';

    $normalizedVariant = match (strtolower((string) $variant)) {
        'danger' => 'destructive',
        default => strtolower((string) $variant),
    };

    $isDisabled = $disabled || ($attributes->has('disabled') && $attributes->get('disabled') !== false);
    $isReadonly = $readonly || ($attributes->has('readonly') && $attributes->get('readonly') !== false);

    // Detect if user explicitly requested pill style (rounded-full) or standard button rounded
    $isPill = str_contains((string) $attributes->get('class'), 'rounded-full') || str_contains((string) $wrapperClass, 'rounded-full');

    // 5-Tier Scale: Height, Knob Size/Position, Offsets, Standard Button Radius & Typography
    // 5-Tier Scale
    // NOTE: 'knobSize' and 'knobLeft' are separate so we can use 'top-1/2' on the element
    // and put ONLY -50% in the inline transform (for correct Y centering without Tailwind v4 translate conflict)
    $sizeConfig = match ($size) {
        'xs' => [
            'height' => 'h-8',
            'knobSize' => 'size-6',
            'knobLeft' => 'left-1',  // 4px — included in offsetPx calculation
            'offsetPx' => 8,         // 4px left + 4px right
            'text' => 'text-[11px]',
            'icon' => 'size-3.5',
            'hintIcon' => 'size-3',
            'radius' => [
                'track' => $isPill ? 'rounded-full' : 'rounded-md',
                'handle' => $isPill ? 'rounded-full' : 'rounded-sm',
                'fill' => $isPill ? 'rounded-full' : 'rounded-l-md',
            ],
        ],
        'sm' => [
            'height' => 'h-9',
            'knobSize' => 'size-7',
            'knobLeft' => 'left-1',  // 4px
            'offsetPx' => 8,
            'text' => 'text-xs',
            'icon' => 'size-4',
            'hintIcon' => 'size-3.5',
            'radius' => [
                'track' => $isPill ? 'rounded-full' : 'rounded-md',
                'handle' => $isPill ? 'rounded-full' : 'rounded-sm',
                'fill' => $isPill ? 'rounded-full' : 'rounded-l-md',
            ],
        ],
        'lg' => [
            'height' => 'h-12',
            'knobSize' => 'size-10',
            'knobLeft' => 'left-1',  // 4px
            'offsetPx' => 8,
            'text' => 'text-sm font-semibold',
            'icon' => 'size-5',
            'hintIcon' => 'size-4',
            'radius' => [
                'track' => $isPill ? 'rounded-full' : 'rounded-lg',
                'handle' => $isPill ? 'rounded-full' : 'rounded-md',
                'fill' => $isPill ? 'rounded-full' : 'rounded-l-lg',
            ],
        ],
        'xl' => [
            'height' => 'h-14',
            'knobSize' => 'size-12',
            'knobLeft' => 'left-1',  // 4px
            'offsetPx' => 8,
            'text' => 'text-base font-semibold',
            'icon' => 'size-6',
            'hintIcon' => 'size-4.5',
            'radius' => [
                'track' => $isPill ? 'rounded-full' : 'rounded-xl',
                'handle' => $isPill ? 'rounded-full' : 'rounded-lg',
                'fill' => $isPill ? 'rounded-full' : 'rounded-l-xl',
            ],
        ],
        default => [ // md (44px standard ergonomic swipe)
            'height' => 'h-11',
            'knobSize' => 'size-9',
            'knobLeft' => 'left-1',  // 4px
            'offsetPx' => 8,
            'text' => 'text-xs sm:text-sm font-medium',
            'icon' => 'size-4.5',
            'hintIcon' => 'size-3.5',
            'radius' => [
                'track' => $isPill ? 'rounded-full' : 'rounded-lg',
                'handle' => $isPill ? 'rounded-full' : 'rounded-md',
                'fill' => $isPill ? 'rounded-full' : 'rounded-l-lg',
            ],
        ],
    };

    // Color Theme Styling aligned directly with Vibe UI Button design tokens
    $themeConfig = match ($normalizedVariant) {
        'success' => [
            'track' => 'border-border/80 bg-muted/40 dark:bg-muted/20 text-muted-foreground',
            'trackFill' => 'bg-success/20 dark:bg-success/25 border-r-2 border-success',
            'handle' => 'bg-success text-success-foreground shadow-sm hover:brightness-105 active:scale-95',
            'confirmedTrack' => 'border-success/50 bg-success/10 text-success',
            'confirmedHandle' => 'bg-success text-success-foreground shadow-sm',
            'textColor' => 'text-foreground/80 dark:text-foreground/70',
        ],
        'destructive' => [
            'track' => 'border-border/80 bg-muted/40 dark:bg-muted/20 text-muted-foreground',
            'trackFill' => 'bg-destructive/20 dark:bg-destructive/25 border-r-2 border-destructive',
            'handle' => 'bg-destructive text-destructive-foreground shadow-sm hover:brightness-105 active:scale-95',
            'confirmedTrack' => 'border-destructive/50 bg-destructive/10 text-destructive',
            'confirmedHandle' => 'bg-destructive text-destructive-foreground shadow-sm',
            'textColor' => 'text-foreground/80 dark:text-foreground/70',
        ],
        'warning' => [
            'track' => 'border-border/80 bg-muted/40 dark:bg-muted/20 text-muted-foreground',
            'trackFill' => 'bg-warning/20 dark:bg-warning/25 border-r-2 border-warning',
            'handle' => 'bg-warning text-warning-foreground shadow-sm hover:brightness-105 active:scale-95',
            'confirmedTrack' => 'border-warning/50 bg-warning/10 text-warning',
            'confirmedHandle' => 'bg-warning text-warning-foreground shadow-sm',
            'textColor' => 'text-foreground/80 dark:text-foreground/70',
        ],
        'info' => [
            'track' => 'border-border/80 bg-muted/40 dark:bg-muted/20 text-muted-foreground',
            'trackFill' => 'bg-info/20 dark:bg-info/25 border-r-2 border-info',
            'handle' => 'bg-info text-info-foreground shadow-sm hover:brightness-105 active:scale-95',
            'confirmedTrack' => 'border-info/50 bg-info/10 text-info',
            'confirmedHandle' => 'bg-info text-info-foreground shadow-sm',
            'textColor' => 'text-foreground/80 dark:text-foreground/70',
        ],
        'secondary' => [
            'track' => 'border-border/80 bg-muted/40 dark:bg-muted/20 text-muted-foreground',
            'trackFill' => 'bg-secondary/40 dark:bg-secondary/50 border-r-2 border-border',
            'handle' => 'bg-secondary text-secondary-foreground shadow-2xs border border-border/80 hover:bg-secondary/90 active:scale-95',
            'confirmedTrack' => 'border-border bg-muted/80 text-foreground',
            'confirmedHandle' => 'bg-secondary text-secondary-foreground shadow-2xs',
            'textColor' => 'text-foreground/80 dark:text-foreground/70',
        ],
        default => [ // primary
            'track' => 'border-border/80 bg-muted/40 dark:bg-muted/20 text-muted-foreground',
            'trackFill' => 'bg-primary/20 dark:bg-primary/25 border-r-2 border-primary',
            'handle' => 'bg-primary text-primary-foreground shadow-sm hover:bg-primary/90 active:scale-95',
            'confirmedTrack' => 'border-primary/50 bg-primary/10 text-primary',
            'confirmedHandle' => 'bg-primary text-primary-foreground shadow-sm',
            'textColor' => 'text-foreground/80 dark:text-foreground/70',
        ],
    };

    // Filter button-targeted attributes (wire:click, @click, onclick, wire:target, wire:confirm, etc.)
    $buttonAttributes = $attributes->filter(fn ($value, $key) =>
        str_starts_with($key, 'wire:') ||
        str_starts_with($key, 'x-on:click') ||
        str_starts_with($key, '@click') ||
        str_starts_with($key, 'onclick')
    );

    // Remaining attributes go to root wrapper
    $wrapperAttributes = $attributes->except(array_keys($buttonAttributes->getAttributes()));

    $hasWireClick = $attributes->has('wire:click');
    $hasWireTarget = $attributes->has('wire:target');
    $wireTarget = $attributes->get('wire:target') ?? ($hasWireClick ? preg_replace('/\(.*$/', '', (string) $attributes->get('wire:click')) : null);

    $alpineLoading = $attributes->get('x-bind:loading')
        ?? $attributes->get('::loading')
        ?? $attributes->get('x-loading');
    $alpineExpr = $alpineLoading;

    if ($alpineLoading) {
        $wrapperAttributes = $wrapperAttributes->except(['::loading', 'x-bind:loading', 'x-loading']);
    }
@endphp

<div
    id="{{ $id }}"
    data-vibe-swipe
    x-data="{
        id: '{{ $id }}',
        type: '{{ $type }}',
        threshold: {{ (float) $threshold }},
        autoReset: @js($autoReset),
        disabled: {{ $isDisabled ? 'true' : 'false' }},
        readonly: {{ $isReadonly ? 'true' : 'false' }},
        haptic: {{ $haptic ? 'true' : 'false' }},
        isLoading: {{ $alpineExpr ? "Boolean($alpineExpr)" : ($loading ? 'true' : 'false') }},

        isDragging: false,
        isConfirmed: false,
        startX: 0,
        currentX: 0,
        maxX: 0,
        progress: 0,
        offsetPx: {{ $sizeConfig['offsetPx'] }},

        init() {
            this.$nextTick(() => {
                this.updateDimensions();
            });

            if (typeof ResizeObserver !== 'undefined' && this.$refs.track) {
                const resizeObserver = new ResizeObserver(() => {
                    this.updateDimensions();
                });
                resizeObserver.observe(this.$refs.track);
            }
        },

        updateDimensions() {
            if (!this.$refs.track || !this.$refs.handle) return;
            const trackWidth = this.$refs.track.clientWidth;
            const handleWidth = this.$refs.handle.offsetWidth;
            this.maxX = Math.max(0, trackWidth - handleWidth - this.offsetPx);
            if (this.isConfirmed) {
                this.currentX = this.maxX;
                this.progress = 1;
            }
        },

        onPointerDown(e) {
            if (this.disabled || this.readonly || this.isConfirmed || this.isLoading) return;
            this.isDragging = true;
            this.startX = e.clientX ?? (e.touches && e.touches[0] ? e.touches[0].clientX : 0);
            this.updateDimensions();
            if (e.target && typeof e.target.setPointerCapture === 'function' && e.pointerId) {
                try { e.target.setPointerCapture(e.pointerId); } catch(err) {}
            }
            this.$dispatch('swipe-start', { id: this.id });
        },

        onPointerMove(e) {
            if (!this.isDragging) return;
            const clientX = e.clientX ?? (e.touches && e.touches[0] ? e.touches[0].clientX : 0);
            const deltaX = clientX - this.startX;
            this.currentX = Math.max(0, Math.min(this.maxX, deltaX));
            this.progress = this.maxX > 0 ? this.currentX / this.maxX : 0;
            this.$dispatch('swiping', { id: this.id, progress: this.progress, currentX: this.currentX, maxX: this.maxX });
        },

        onPointerUp(e) {
            if (!this.isDragging) return;
            this.isDragging = false;

            if (this.progress >= this.threshold) {
                this.confirm();
            } else {
                // Spring back smoothly to origin
                this.currentX = 0;
                this.progress = 0;
            }
        },

        confirm() {
            this.isConfirmed = true;
            this.currentX = this.maxX;
            this.progress = 1;

            // Trigger haptic vibration if supported on device
            if (this.haptic && typeof navigator !== 'undefined' && typeof navigator.vibrate === 'function') {
                try { navigator.vibrate([40, 60, 40]); } catch (err) {}
            }

            // Dispatch Alpine/DOM custom events
            this.$dispatch('confirmed', { id: this.id, value: '{{ $value }}' });
            this.$dispatch('swiped', { id: this.id, value: '{{ $value }}' });

            // Trigger hidden native button click (executes @click, wire:click, onclick)
            if (this.$refs.triggerBtn) {
                this.$refs.triggerBtn.click();
            }

            // If submit button in form, trigger standard form submission
            if (this.type === 'submit') {
                const form = this.$el.closest('form');
                if (form) {
                    if (typeof form.requestSubmit === 'function') {
                        form.requestSubmit(this.$refs.triggerBtn);
                    } else {
                        form.submit();
                    }
                }
            }

            // Handle auto-reset if configured
            if (this.autoReset) {
                const delay = typeof this.autoReset === 'number' ? this.autoReset : 2000;
                setTimeout(() => {
                    this.reset();
                }, delay);
            }
        },

        reset() {
            this.isConfirmed = false;
            this.isLoading = false;
            this.currentX = 0;
            this.progress = 0;
            this.$dispatch('reset', { id: this.id });
        }
    }"
    @if ($alpineExpr)
        x-effect="isLoading = Boolean({{ $alpineExpr }})"
    @endif
    @reset-swipe.window="if (!$event.detail || !$event.detail.id || $event.detail.id === id) reset()"
    class="relative inline-block w-full select-none touch-pan-y {{ $wrapperClass }} {{ $isDisabled ? 'opacity-60 pointer-events-none cursor-not-allowed' : '' }}"
    {{ $wrapperAttributes }}
>
    {{-- Hidden Input for Standard Form Data Submission --}}
    @if ($name)
        <input
            type="hidden"
            name="{{ $name }}"
            :value="isConfirmed ? '{{ $value }}' : ''"
            :disabled="!isConfirmed || disabled"
        />
    @endif

    {{-- Hidden Trigger Button for Native Event Dispatching (@click, wire:click, form submit) --}}
    <button
        type="{{ $type }}"
        x-ref="triggerBtn"
        class="sr-only"
        tabindex="-1"
        aria-hidden="true"
        @if ($isDisabled) disabled @endif
        @if ($hasWireTarget && $wireTarget) wire:target="{{ $wireTarget }}" @endif
        {{ $buttonAttributes }}
    ></button>

    {{-- Swipe Track Container (Standard Rounded like <vibe:button>) --}}
    <div
        x-ref="track"
        role="group"
        aria-label="{{ __('vibe/swipe.aria_label') }}"
        class="relative w-full overflow-hidden border shadow-xs transition-colors duration-200 {{ $sizeConfig['height'] }} {{ $sizeConfig['radius']['track'] }} {{ $themeConfig['track'] }}"
        :class="{
            '{{ $themeConfig['confirmedTrack'] }}': isConfirmed,
            'cursor-not-allowed': disabled || readonly
        }"
    >
        {{-- Dynamic Progress Fill Behind Handle
             Fill width = leftMargin + currentX + handleWidth + rightMargin = currentX + handleWidth + offsetPx
             At maxX: fill = (trackWidth - handleWidth - offsetPx) + handleWidth + offsetPx = trackWidth = 100% --}}
        <div
            x-show="currentX > 0 || isConfirmed"
            class="absolute inset-y-0 left-0 pointer-events-none transition-all duration-75 {{ $sizeConfig['radius']['fill'] }} {{ $themeConfig['trackFill'] }}"
            :style="{
                width: isConfirmed
                    ? '100%'
                    : (currentX > 0 ? `calc(${currentX}px + ${$refs.handle ? $refs.handle.offsetWidth : 36}px + ${offsetPx}px)` : '0px')
            }"
            :class="{ 'transition-all duration-300 ease-out': !isDragging }"
            style="display: none;"
        ></div>

        {{-- Centered Track Label with Animated Guidance Arrows --}}
        <div
            class="absolute inset-0 flex items-center justify-center text-center px-10 pointer-events-none transition-opacity duration-200 {{ $sizeConfig['text'] }}"
            :style="{ opacity: isConfirmed ? 0 : Math.max(0, 1 - (progress * 1.8)) }"
        >
            <span class="inline-flex items-center gap-2 font-medium tracking-tight truncate {{ $themeConfig['textColor'] }}">
                <span>{{ $slot->isNotEmpty() ? $slot : $label }}</span>
                <span class="inline-flex items-center -space-x-1 opacity-40 shrink-0">
                    <svg class="{{ $sizeConfig['hintIcon'] }} animate-pulse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                    <svg class="{{ $sizeConfig['hintIcon'] }} animate-pulse [animation-delay:200ms]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </span>
            </span>
        </div>

        {{-- Confirmed State Label (Revealed with scale & fade when swipe complete) --}}
        <div
            x-show="isConfirmed"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-90 translate-y-1"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            class="absolute inset-0 flex items-center justify-center text-center px-10 pointer-events-none font-semibold {{ $sizeConfig['text'] }}"
            style="display: none;"
        >
            <span class="inline-flex items-center gap-2 truncate">
                <svg class="{{ $sizeConfig['icon'] }} shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>{{ $confirmedLabel }}</span>
            </span>
        </div>

        {{-- Swipe Handle (Thumb)
             CENTERING STRATEGY:
             • 'top-1/2' sets top: 50% (vertical midpoint of track)
             • transform: translate3d(X, -50%, 0) moves knob left by X pixels AND up by 50% of own height
             • This is one atomic transform — no Tailwind v4 translate utility conflict
             • Do NOT add '-translate-y-1/2' class (Tailwind v4 uses CSS 'translate' property separately,
               which would stack on top of the inline transform and double the Y offset) --}}
        <div
            x-ref="handle"
            @pointerdown="onPointerDown($event)"
            @pointermove.window="onPointerMove($event)"
            @pointerup.window="onPointerUp($event)"
            @pointercancel.window="onPointerUp($event)"
            role="slider"
            :aria-valuenow="Math.round(progress * 100)"
            aria-valuemin="0"
            aria-valuemax="100"
            :aria-disabled="disabled || readonly"
            tabindex="0"
            @keydown.arrow-right.prevent="if (!disabled && !readonly && !isConfirmed) { currentX = Math.min(maxX, currentX + 30); progress = maxX > 0 ? currentX / maxX : 0; if (progress >= threshold) confirm(); }"
            @keydown.arrow-left.prevent="if (!disabled && !readonly && !isConfirmed) { currentX = Math.max(0, currentX - 30); progress = maxX > 0 ? currentX / maxX : 0; }"
            @keydown.enter.prevent="if (!disabled && !readonly && !isConfirmed) confirm()"
            @keydown.space.prevent="if (!disabled && !readonly && !isConfirmed) confirm()"
            class="absolute top-1/2 {{ $sizeConfig['knobLeft'] }} {{ $sizeConfig['knobSize'] }} {{ $sizeConfig['radius']['handle'] }} flex items-center justify-center cursor-grab active:cursor-grabbing select-none z-10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 {{ $themeConfig['handle'] }}"
            :style="{
                transform: `translate3d(${currentX}px, -50%, 0)`
            }"
            :class="{
                'transition-none': isDragging,
                'transition-transform duration-300 ease-out': !isDragging,
                'cursor-default': isConfirmed || disabled || readonly,
                '{{ $themeConfig['confirmedHandle'] }}': isConfirmed
            }"
        >
            {{-- Default Handle Icon --}}
            <div
                x-show="!isConfirmed && !isLoading"
                class="flex items-center justify-center pointer-events-none transition-transform duration-150"
                :class="{ 'scale-110 translate-x-0.5': isDragging }"
            >
                @if (isset($iconSlot))
                    {{ $iconSlot }}
                @elseif ($icon)
                    {!! $icon !!}
                @else
                    {{-- Double Chevron Right Icon --}}
                    <svg class="{{ $sizeConfig['icon'] }} shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="13 17 18 12 13 7"></polyline>
                        <polyline points="6 17 11 12 6 7"></polyline>
                    </svg>
                @endif
            </div>

            {{-- Confirmed Success Icon --}}
            <div
                x-show="isConfirmed && !isLoading"
                x-transition:enter="transition ease-out duration-250 transform"
                x-transition:enter-start="scale-50 opacity-0 rotate-[-45deg]"
                x-transition:enter-end="scale-100 opacity-100 rotate-0"
                class="flex items-center justify-center pointer-events-none"
                style="display: none;"
            >
                @if (isset($confirmedIconSlot))
                    {{ $confirmedIconSlot }}
                @elseif ($confirmedIcon)
                    {!! $confirmedIcon !!}
                @else
                    {{-- Checkmark Icon --}}
                    <svg class="{{ $sizeConfig['icon'] }} shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                @endif
            </div>

            {{-- Async Loading Spinner --}}
            <div
                x-show="isLoading"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="scale-50 opacity-0"
                x-transition:enter-end="scale-100 opacity-100"
                class="flex items-center justify-center pointer-events-none"
                style="display: none;"
            >
                @if (isset($loadingIconSlot))
                    {{ $loadingIconSlot }}
                @elseif ($loadingIcon)
                    {!! $loadingIcon !!}
                @else
                    <svg class="{{ $sizeConfig['icon'] }} animate-spin shrink-0 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                @endif
            </div>
        </div>
    </div>
</div>
