@blaze(fold: true)

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'value' => null,
    'min' => 0,
    'max' => null,
    'step' => 1,
    'size' => 'md', // xs (28px), sm (32px), md (36px), lg (40px), xl (44px)
    'layout' => 'split', // split, grouped, stacked
    'variant' => 'default', // default, outline, filled, ghost
    'unit' => null,
    'description' => null,
    'info' => null,
    'error' => null,
    'errorName' => null,
    'disabled' => false,
    'readonly' => false,
    'placeholder' => null,
    'allowZero' => true,
    'longPress' => true,
])

@php
    $wireModel = $attributes->wire('model')->value();
    $name = $name ?? ($wireModel ?: null);
    $id = $id ?? ($name ?? uniqid('qty-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = $error && !is_bool($error) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $isDisabled = $disabled || ($attributes->has('disabled') && $attributes->get('disabled') !== false);
    $isReadonly = $readonly || ($attributes->has('readonly') && $attributes->get('readonly') !== false);

    // Initial value resolution
    $effectiveMin = $min !== null ? (float) $min : ($allowZero ? 0 : 1);
    $initialRaw = null;
    if (!empty($name) && !is_array(old($name))) {
        $initialRaw = old($name, !is_array($value ?? null) ? ($value ?? null) : null);
    } elseif ($value !== null && !is_array($value)) {
        $initialRaw = $value;
    }
    $initialValue = $initialRaw !== null && is_numeric($initialRaw) ? (float) $initialRaw : $effectiveMin;

    // Sizing system (Harmonized with Vibe UI Density Scale)
    $isPill = str_contains($attributes->get('class', ''), 'rounded-full');

    $heightClass = match ($size) {
        'xs' => 'h-7 text-xs',
        'sm' => 'h-8 text-xs',
        'md' => 'h-9 text-sm',
        'lg' => 'h-10 text-sm',
        'xl' => 'h-11 text-base',
        default => 'h-9 text-sm',
    };

    $radiusClass = $isPill ? 'rounded-full' : match ($size) {
        'xs', 'sm' => 'rounded-md',
        'md' => 'rounded-lg',
        'lg' => 'rounded-lg',
        'xl' => 'rounded-xl',
        default => 'rounded-lg',
    };

    $btnWidthClass = match ($size) {
        'xs' => 'w-7',
        'sm' => 'w-8',
        'md' => 'w-9',
        'lg' => 'w-10',
        'xl' => 'w-11',
        default => 'w-9',
    };

    $iconSizeClass = match ($size) {
        'xs' => 'size-3',
        'sm' => 'size-3.5',
        'md' => 'size-4',
        'lg' => 'size-4.5',
        'xl' => 'size-5',
        default => 'size-4',
    };

    $errorClasses = $hasError
        ? 'border-destructive focus-within:border-destructive focus-within:ring-destructive/20'
        : 'border-input focus-within:border-primary focus-within:ring-primary/20';

    $stateClasses = $isDisabled
        ? 'opacity-60 pointer-events-none bg-muted/40 cursor-not-allowed select-none'
        : ($isReadonly ? 'bg-muted/20 cursor-default' : '');

    $btnSplitBg = $isDisabled
        ? 'bg-transparent'
        : ($isReadonly ? 'bg-muted/30' : 'bg-muted/50 hover:bg-muted');

    $variantClasses = $isDisabled || $isReadonly
        ? 'bg-transparent'
        : match ($variant) {
            'outline' => 'bg-transparent',
            'filled' => 'bg-muted/60',
            'ghost' => 'bg-transparent border-transparent',
            default => 'bg-background',
        };
@endphp

<div
    class="vibe-quantity-root w-full"
    x-data="{
        value: {{ $initialValue }},
        min: {{ $min !== null ? (float) $min : 'null' }},
        max: {{ $max !== null ? (float) $max : 'null' }},
        step: {{ (float) $step }},
        allowZero: {{ $allowZero ? 'true' : 'false' }},
        longPress: {{ $longPress ? 'true' : 'false' }},
        isDisabled: {{ $isDisabled ? 'true' : 'false' }},
        isReadonly: {{ $isReadonly ? 'true' : 'false' }},
        holdTimeout: null,
        holdInterval: null,

        get precision() {
            const stepStr = this.step.toString();
            return stepStr.includes('.') ? stepStr.split('.')[1].length : 0;
        },

        canDecrement() {
            if (this.isDisabled || this.isReadonly) return false;
            if (this.min !== null) return this.value > this.min;
            return this.allowZero ? this.value > 0 : this.value > 1;
        },

        canIncrement() {
            if (this.isDisabled || this.isReadonly) return false;
            if (this.max !== null) return this.value < this.max;
            return true;
        },

        decrement() {
            if (!this.canDecrement()) return;
            const factor = Math.pow(10, this.precision);
            let next = Math.round((Number(this.value) - Number(this.step)) * factor) / factor;
            if (this.min !== null && next < this.min) next = this.min;
            if (!this.allowZero && next < 1) next = 1;
            this.setValue(next);
        },

        increment() {
            if (!this.canIncrement()) return;
            const factor = Math.pow(10, this.precision);
            let next = Math.round((Number(this.value) + Number(this.step)) * factor) / factor;
            if (this.max !== null && next > this.max) next = this.max;
            this.setValue(next);
        },

        setValue(val) {
            this.value = val;
            if (this.$refs.input) {
                this.$refs.input.value = val;
                this.$refs.input.dispatchEvent(new Event('input', { bubbles: true }));
                this.$refs.input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        },

        onInput(e) {
            let val = e.target.value;
            if (val === '' || isNaN(val)) return;
            this.value = Number(val);
        },

        onBlur(e) {
            let val = Number(e.target.value);
            if (isNaN(val)) val = this.min !== null ? this.min : 1;
            if (this.min !== null && val < this.min) val = this.min;
            if (!this.allowZero && val < 1) val = 1;
            if (this.max !== null && val > this.max) val = this.max;
            this.setValue(val);
        },

        startHold(action) {
            if (this.isDisabled || this.isReadonly) return;
            if (action === 'decrement' && !this.canDecrement()) return;
            if (action === 'increment' && !this.canIncrement()) return;

            this[action]();
            if (!this.longPress) return;

            this.clearHold();
            this.holdTimeout = setTimeout(() => {
                this.holdInterval = setInterval(() => {
                    if (action === 'decrement' && !this.canDecrement()) {
                        this.clearHold();
                        return;
                    }
                    if (action === 'increment' && !this.canIncrement()) {
                        this.clearHold();
                        return;
                    }
                    this[action]();
                }, 85);
            }, 300);
        },

        clearHold() {
            if (this.holdTimeout) {
                clearTimeout(this.holdTimeout);
                this.holdTimeout = null;
            }
            if (this.holdInterval) {
                clearInterval(this.holdInterval);
                this.holdInterval = null;
            }
        },

        init() {
            @if ($wireModel)
                this.$watch('value', (val) => {
                    @this?.set('{{ $wireModel }}', val);
                });
            @endif
        }
    }"
    @mouseup.window="clearHold()"
    @touchend.window="clearHold()"
    @mouseleave.window="clearHold()"
>
    {{-- Label & Info Strip --}}
    @if ($label || $info)
        <div class="flex items-center justify-between mb-1.5">
            @if ($label)
                <label for="{{ $id }}" class="block text-xs font-semibold text-foreground select-none">
                    {{ $label }}
                    @if ($attributes->has('required') && $attributes->get('required') !== false)
                        <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
                    @endif
                </label>
            @endif

            @if ($info)
                <div class="relative inline-flex items-center group/info cursor-help" tabindex="0" role="tooltip" aria-label="{{ $info }}">
                    <svg class="size-3.5 text-muted-foreground hover:text-foreground transition-colors shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 16v-4" />
                        <path d="M12 8h.01" />
                    </svg>
                    <div class="absolute bottom-full right-0 mb-1.5 hidden group-hover/info:block group-focus/info:block z-30 w-48 p-2 text-[11px] leading-tight text-popover-foreground bg-popover rounded-md shadow-md border border-border pointer-events-none transition-all">
                        {{ $info }}
                    </div>
                </div>
            @endif
        </div>
    @endif

    {{-- Controls Wrapper --}}
    <div {{ $attributes->except(['wire:model', 'class'])->twMerge(['class' => 'relative inline-flex items-center w-full ' . ($attributes->get('class', ''))]) }}>

        @if ($layout === 'split')
            {{-- 1. LAYOUT SPLIT: [-] [ 10 pcs ] [+] --}}
            <div class="inline-flex items-stretch w-full {{ $heightClass }} shadow-2xs {{ $radiusClass }} border divide-x overflow-hidden focus-within:ring-2 focus-within:ring-offset-0 {{ $errorClasses }} {{ $hasError ? 'divide-destructive' : 'divide-border' }} {{ $stateClasses }}">
                {{-- Decrement Button --}}
                <button
                    type="button"
                    tabindex="-1"
                    aria-label="Decrease quantity"
                    @mousedown="startHold('decrement')"
                    @touchstart.passive="startHold('decrement')"
                    @click.prevent
                    :disabled="!canDecrement()"
                    class="inline-flex items-center justify-center {{ $btnWidthClass }} shrink-0 {{ $btnSplitBg }} text-foreground transition-colors cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed select-none active:scale-[0.98]"
                >
                    <svg class="{{ $iconSizeClass }} shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </button>

                {{-- Number Input --}}
                <div class="relative flex-1 min-w-0 flex items-center justify-center {{ $variantClasses }}">
                    <input
                        x-ref="input"
                        id="{{ $id }}"
                        @if ($name) name="{{ $name }}" @endif
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        :value="value"
                        @input="onInput($event)"
                        @blur="onBlur($event)"
                        @keydown.up.prevent="increment()"
                        @keydown.down.prevent="decrement()"
                        @if ($isDisabled) disabled @endif
                        @if ($isReadonly) readonly @endif
                        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
                        class="w-full h-full text-center font-semibold text-foreground bg-transparent border-0 focus:outline-none focus:ring-0 p-0 select-all disabled:cursor-not-allowed"
                    />

                    @if ($unit)
                        <span class="pr-2.5 text-xs text-muted-foreground select-none pointer-events-none shrink-0 font-medium">
                            {{ $unit }}
                        </span>
                    @endif
                </div>

                {{-- Increment Button --}}
                <button
                    type="button"
                    tabindex="-1"
                    aria-label="Increase quantity"
                    @mousedown="startHold('increment')"
                    @touchstart.passive="startHold('increment')"
                    @click.prevent
                    :disabled="!canIncrement()"
                    class="inline-flex items-center justify-center {{ $btnWidthClass }} shrink-0 {{ $btnSplitBg }} text-foreground transition-colors cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed select-none active:scale-[0.98]"
                >
                    <svg class="{{ $iconSizeClass }} shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </button>
            </div>

        @elseif ($layout === 'grouped')
            {{-- 2. LAYOUT GROUPED: Pill Segmented Wrapper [-| 10 |+] --}}
            <div class="inline-flex items-stretch w-full {{ $heightClass }} shadow-2xs {{ $radiusClass }} border {{ $errorClasses }} divide-x {{ $hasError ? 'divide-destructive' : 'divide-border' }} overflow-hidden {{ $variantClasses }} focus-within:ring-2 focus-within:ring-offset-0 {{ $stateClasses }}">
                {{-- Decrement Button --}}
                <button
                    type="button"
                    tabindex="-1"
                    aria-label="Decrease quantity"
                    @mousedown="startHold('decrement')"
                    @touchstart.passive="startHold('decrement')"
                    @click.prevent
                    :disabled="!canDecrement()"
                    class="inline-flex items-center justify-center {{ $btnWidthClass }} shrink-0 text-muted-foreground hover:text-foreground hover:bg-muted/70 transition-colors cursor-pointer disabled:opacity-30 disabled:cursor-not-allowed select-none active:scale-[0.98]"
                >
                    <svg class="{{ $iconSizeClass }} shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </button>

                {{-- Center Display/Input --}}
                <div class="relative flex-1 min-w-0 flex items-center justify-center px-1">
                    <input
                        x-ref="input"
                        id="{{ $id }}"
                        @if ($name) name="{{ $name }}" @endif
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        :value="value"
                        @input="onInput($event)"
                        @blur="onBlur($event)"
                        @keydown.up.prevent="increment()"
                        @keydown.down.prevent="decrement()"
                        @if ($isDisabled) disabled @endif
                        @if ($isReadonly) readonly @endif
                        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
                        class="w-full h-full text-center font-semibold text-foreground bg-transparent border-0 focus:outline-none focus:ring-0 p-0 select-all disabled:opacity-50 disabled:cursor-not-allowed"
                    />

                    @if ($unit)
                        <span class="pr-2 text-xs text-muted-foreground select-none pointer-events-none shrink-0 font-medium">
                            {{ $unit }}
                        </span>
                    @endif
                </div>

                {{-- Increment Button --}}
                <button
                    type="button"
                    tabindex="-1"
                    aria-label="Increase quantity"
                    @mousedown="startHold('increment')"
                    @touchstart.passive="startHold('increment')"
                    @click.prevent
                    :disabled="!canIncrement()"
                    class="inline-flex items-center justify-center {{ $btnWidthClass }} shrink-0 text-muted-foreground hover:text-foreground hover:bg-muted/70 transition-colors cursor-pointer disabled:opacity-30 disabled:cursor-not-allowed select-none active:scale-[0.98]"
                >
                    <svg class="{{ $iconSizeClass }} shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </button>
            </div>

        @elseif ($layout === 'stacked')
            {{-- 3. LAYOUT STACKED: Vertical Spinner Controls on the Right --}}
            <div class="inline-flex items-stretch w-full {{ $heightClass }} shadow-2xs {{ $radiusClass }} border {{ $errorClasses }} overflow-hidden {{ $variantClasses }} focus-within:ring-2 focus-within:ring-offset-0 {{ $stateClasses }}">
                {{-- Input Display --}}
                <div class="relative flex-1 min-w-0 flex items-center px-3">
                    <input
                        x-ref="input"
                        id="{{ $id }}"
                        @if ($name) name="{{ $name }}" @endif
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        :value="value"
                        @input="onInput($event)"
                        @blur="onBlur($event)"
                        @keydown.up.prevent="increment()"
                        @keydown.down.prevent="decrement()"
                        @if ($isDisabled) disabled @endif
                        @if ($isReadonly) readonly @endif
                        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
                        class="w-full h-full text-left font-semibold text-foreground bg-transparent border-0 focus:outline-none focus:ring-0 p-0 select-all disabled:cursor-not-allowed"
                    />

                    @if ($unit)
                        <span class="pr-2 text-xs text-muted-foreground select-none pointer-events-none shrink-0 font-medium">
                            {{ $unit }}
                        </span>
                    @endif
                </div>

                {{-- Stacked Vertical Buttons --}}
                <div class="w-7 sm:w-8 shrink-0 flex flex-col border-l {{ $hasError ? 'border-destructive divide-destructive' : 'border-border divide-border' }} divide-y">
                    <button
                        type="button"
                        tabindex="-1"
                        aria-label="Increase quantity"
                        @mousedown="startHold('increment')"
                        @touchstart.passive="startHold('increment')"
                        @click.prevent
                        :disabled="!canIncrement()"
                        class="flex-1 flex items-center justify-center text-muted-foreground hover:text-foreground hover:bg-muted/80 transition-colors disabled:opacity-30 disabled:cursor-not-allowed cursor-pointer select-none"
                    >
                        <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6" />
                        </svg>
                    </button>
                    <button
                        type="button"
                        tabindex="-1"
                        aria-label="Decrease quantity"
                        @mousedown="startHold('decrement')"
                        @touchstart.passive="startHold('decrement')"
                        @click.prevent
                        :disabled="!canDecrement()"
                        class="flex-1 flex items-center justify-center text-muted-foreground hover:text-foreground hover:bg-muted/80 transition-colors disabled:opacity-30 disabled:cursor-not-allowed cursor-pointer select-none"
                    >
                        <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                </div>
            </div>
        @elseif ($layout === 'gap' || $layout === 'separated')
            {{-- 4. LAYOUT GAP: Detached Buttons with Gap [-] [ 10 ] [+] --}}
            <div class="inline-flex items-center gap-2 w-full {{ $stateClasses }}">
                {{-- Decrement Button --}}
                <button
                    type="button"
                    tabindex="-1"
                    aria-label="Decrease quantity"
                    @mousedown="startHold('decrement')"
                    @touchstart.passive="startHold('decrement')"
                    @click.prevent
                    :disabled="!canDecrement()"
                    class="inline-flex items-center justify-center {{ $btnWidthClass }} {{ $heightClass }} shrink-0 border {{ $hasError ? 'border-destructive/70' : 'border-input' }} bg-card hover:bg-muted text-foreground transition-all duration-150 cursor-pointer disabled:opacity-30 disabled:cursor-not-allowed select-none active:scale-[0.96] {{ $radiusClass }} shadow-2xs hover:border-border"
                >
                    <svg class="{{ $iconSizeClass }} shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </button>

                {{-- Center Input Box --}}
                <div class="relative flex-1 min-w-0 flex items-center justify-center {{ $heightClass }} border {{ $radiusClass }} {{ $variantClasses }} shadow-2xs focus-within:ring-2 focus-within:ring-offset-0 transition-all {{ $errorClasses }}">
                    <input
                        x-ref="input"
                        id="{{ $id }}"
                        @if ($name) name="{{ $name }}" @endif
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        :value="value"
                        @input="onInput($event)"
                        @blur="onBlur($event)"
                        @keydown.up.prevent="increment()"
                        @keydown.down.prevent="decrement()"
                        @if ($isDisabled) disabled @endif
                        @if ($isReadonly) readonly @endif
                        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
                        class="w-full h-full text-center font-semibold text-foreground bg-transparent border-0 focus:outline-none focus:ring-0 px-2 py-0 select-all disabled:cursor-not-allowed"
                    />

                    @if ($unit)
                        <span class="pr-2.5 text-xs text-muted-foreground select-none pointer-events-none shrink-0 font-medium">
                            {{ $unit }}
                        </span>
                    @endif
                </div>

                {{-- Increment Button --}}
                <button
                    type="button"
                    tabindex="-1"
                    aria-label="Increase quantity"
                    @mousedown="startHold('increment')"
                    @touchstart.passive="startHold('increment')"
                    @click.prevent
                    :disabled="!canIncrement()"
                    class="inline-flex items-center justify-center {{ $btnWidthClass }} {{ $heightClass }} shrink-0 border {{ $hasError ? 'border-destructive/70' : 'border-input' }} bg-card hover:bg-muted text-foreground transition-all duration-150 cursor-pointer disabled:opacity-30 disabled:cursor-not-allowed select-none active:scale-[0.96] {{ $radiusClass }} shadow-2xs hover:border-border"
                >
                    <svg class="{{ $iconSizeClass }} shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </button>
            </div>

        @elseif ($layout === 'subtle' || $layout === 'minimal')
            {{-- 5. LAYOUT SUBTLE / MINIMAL: Floating Pill Buttons with Soft Background --}}
            <div class="inline-flex items-center gap-2 w-full p-1 bg-muted/50 {{ $isPill ? 'rounded-full' : 'rounded-xl' }} border {{ $hasError ? 'border-destructive focus-within:ring-2 focus-within:ring-destructive/20' : 'border-border/40 focus-within:ring-2 focus-within:ring-primary/20 focus-within:border-primary' }} focus-within:ring-offset-0 {{ $stateClasses }}">
                {{-- Decrement Button --}}
                <button
                    type="button"
                    tabindex="-1"
                    aria-label="Decrease quantity"
                    @mousedown="startHold('decrement')"
                    @touchstart.passive="startHold('decrement')"
                    @click.prevent
                    :disabled="!canDecrement()"
                    class="inline-flex items-center justify-center {{ $btnWidthClass }} {{ $heightClass }} shrink-0 {{ $radiusClass }} bg-background hover:bg-card text-foreground shadow-2xs transition-all duration-150 cursor-pointer disabled:opacity-30 disabled:cursor-not-allowed select-none active:scale-[0.96]"
                >
                    <svg class="{{ $iconSizeClass }} shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </button>

                {{-- Center Input --}}
                <div class="relative flex-1 min-w-0 flex items-center justify-center">
                    <input
                        x-ref="input"
                        id="{{ $id }}"
                        @if ($name) name="{{ $name }}" @endif
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        :value="value"
                        @input="onInput($event)"
                        @blur="onBlur($event)"
                        @keydown.up.prevent="increment()"
                        @keydown.down.prevent="decrement()"
                        @if ($isDisabled) disabled @endif
                        @if ($isReadonly) readonly @endif
                        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
                        class="w-full h-full text-center font-semibold text-foreground bg-transparent border-0 focus:outline-none focus:ring-0 p-0 select-all disabled:opacity-50 disabled:cursor-not-allowed"
                    />

                    @if ($unit)
                        <span class="pr-2 text-xs text-muted-foreground select-none pointer-events-none shrink-0 font-medium">
                            {{ $unit }}
                        </span>
                    @endif
                </div>

                {{-- Increment Button --}}
                <button
                    type="button"
                    tabindex="-1"
                    aria-label="Increase quantity"
                    @mousedown="startHold('increment')"
                    @touchstart.passive="startHold('increment')"
                    @click.prevent
                    :disabled="!canIncrement()"
                    class="inline-flex items-center justify-center {{ $btnWidthClass }} {{ $heightClass }} shrink-0 {{ $radiusClass }} bg-background hover:bg-card text-foreground shadow-2xs transition-all duration-150 cursor-pointer disabled:opacity-30 disabled:cursor-not-allowed select-none active:scale-[0.96]"
                >
                    <svg class="{{ $iconSizeClass }} shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </button>
            </div>
        @endif

    </div>

    {{-- Description --}}
    @if ($description && !$hasError)
        <p class="mt-1.5 text-xs text-muted-foreground">{{ $description }}</p>
    @endif

    {{-- Error Message --}}
    @if ($hasError)
        <p class="mt-1.5 text-xs text-destructive flex items-center gap-1">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="12" />
                <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            <span>{{ $errorMessage }}</span>
        </p>
    @endif
</div>
