@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'prefix' => 'Rp',
    'suffix' => null,
    'thousandSeparator' => '.',
    'decimalSeparator' => ',',
    'precision' => 0,
    'allowNegative' => false,
    'description' => null,
    'size' => 'md', // sm, md, lg, xl
    'variant' => 'primary', // primary, outline, filled, flush, ghost
    'info' => null,
    'error' => null,
    'errorName' => null,
    'disabled' => false,
    'readonly' => false,
    'placeholder' => '0',
    'value' => null,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ?? uniqid('currency-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = $error && !is_bool($error) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $isDisabled = $disabled || ($attributes->has('disabled') && $attributes->get('disabled') !== false);
    $isReadonly = $readonly || ($attributes->has('readonly') && $attributes->get('readonly') !== false);

    $initialRaw = '';
    if (!empty($name) && !is_array(old($name))) {
        $initialRaw = (string) old($name, !is_array($value ?? null) ? ($value ?? '') : '');
    } elseif (!empty($value) && !is_array($value)) {
        $initialRaw = (string) $value;
    }
    $wireModel = $attributes->wire('model')->value();

    $sizeClasses = match ($size) {
        'sm' => 'h-8 text-xs rounded-md px-2.5',
        'md' => 'h-9 text-sm rounded-lg px-3',
        'lg' => 'h-10 text-sm rounded-lg px-3.5',
        'xl' => 'h-11 text-base rounded-xl px-4',
        default => 'h-9 text-sm rounded-lg px-3',
    };

    $variantClasses = match ($variant) {
        'outline' => 'bg-transparent border-input focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20',
        'filled' => 'bg-muted/60 border-transparent focus-within:bg-background focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20',
        'flush' => 'bg-transparent border-b border-border rounded-none px-0 focus-within:border-primary',
        'ghost' => 'bg-transparent border-transparent hover:bg-muted/40 focus-within:bg-background focus-within:border-primary',
        default => 'bg-background border-input focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20',
    };

    $errorBorderClasses = $hasError ? 'border-destructive text-destructive focus-within:border-destructive focus-within:ring-destructive/20' : '';
@endphp

<div class="space-y-1.5 w-full" id="{{ $id }}-container">
    @if ($label)
        <label for="{{ $id }}-display" class="block text-xs font-semibold text-foreground select-none">
            {{ $label }}
        </label>
    @endif

    @if ($description)
        <p class="text-xs text-muted-foreground select-none">{{ $description }}</p>
    @endif

    <div 
        x-data="{
            rawValue: '{{ $initialRaw !== null && $initialRaw !== '' ? (string) $initialRaw : '' }}',
            displayValue: '',
            thousandSep: '{{ $thousandSeparator }}',
            decimalSep: '{{ $decimalSeparator }}',
            precision: {{ (int) $precision }},
            allowNegative: {{ $allowNegative ? 'true' : 'false' }},

            init() {
                if (this.rawValue !== '') {
                    this.displayValue = this.formatNumber(this.rawValue);
                }

                // Listen to external input event for vibe:form restoreFromStorage()
                this.$nextTick(() => {
                    let hidden = this.$refs.hiddenInput;
                    if (hidden) {
                        hidden.addEventListener('input', (e) => {
                            if (e.target.value !== this.rawValue) {
                                this.rawValue = e.target.value;
                                this.displayValue = this.formatNumber(this.rawValue);
                            }
                        });
                    }
                });
            },

            formatNumber(val) {
                if (val === null || val === undefined || val === '') return '';
                let str = String(val);
                let isNeg = this.allowNegative && str.startsWith('-');
                str = str.replace(/[^\d.]/g, '');
                if (!str) return isNeg ? '-' : '';

                let parts = str.split('.');
                let integerPart = parts[0] || '0';
                let decimalPart = parts[1] !== undefined ? parts[1].slice(0, this.precision) : '';

                // Add thousand separators
                let formattedInt = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, this.thousandSep);

                let result = (isNeg ? '-' : '') + formattedInt;
                if (this.precision > 0 && decimalPart !== '') {
                    result += this.decimalSep + decimalPart;
                }
                return result;
            },

            parseRaw(displayStr) {
                if (!displayStr) return '';
                let str = String(displayStr);
                let isNeg = this.allowNegative && str.startsWith('-');
                
                // Remove prefix, spaces, and thousand separators
                let clean = str.replace(new RegExp('\\' + this.thousandSep, 'g'), '').trim();
                clean = clean.replace(new RegExp('\\' + this.decimalSep, 'g'), '.');
                clean = clean.replace(/[^\d.]/g, '');

                if (!clean) return isNeg ? '-' : '';
                return (isNeg ? '-' : '') + clean;
            },

            handleInput(e) {
                let inputVal = e.target.value;
                this.rawValue = this.parseRaw(inputVal);
                this.displayValue = this.formatNumber(this.rawValue);

                // Update hidden input and dispatch bubbling input/change events
                let hidden = this.$refs.hiddenInput;
                if (hidden) {
                    hidden.value = this.rawValue;
                    hidden.dispatchEvent(new Event('input', { bubbles: true }));
                    hidden.dispatchEvent(new Event('change', { bubbles: true }));
                }
            }
        }"
        class="relative flex items-center w-full border shadow-2xs transition-colors duration-150 {{ $sizeClasses }} {{ $variantClasses }} {{ $errorBorderClasses }}"
    >
        @if ($prefix)
            <span class="mr-2 text-muted-foreground font-semibold select-none text-xs pointer-events-none">
                {{ $prefix }}
            </span>
        @endif

        {{-- Visible Formatted Input --}}
        <input 
            type="text"
            inputmode="{{ $precision > 0 ? 'decimal' : 'numeric' }}"
            id="{{ $id }}-display"
            x-model="displayValue"
            @input="handleInput($event)"
            placeholder="{{ $placeholder }}"
            @if($isDisabled) disabled @endif
            @if($isReadonly) readonly @endif
            class="w-full bg-transparent text-foreground placeholder:text-muted-foreground focus:outline-none text-left font-medium"
        />

        {{-- Hidden Input carrying Clean Numeric Raw Value for Form POST & vibe:form --}}
        <input 
            type="hidden" 
            x-ref="hiddenInput"
            id="{{ $id }}"
            @if($name) name="{{ $name }}" @endif
            :value="rawValue"
            @if($wireModel) wire:model="{{ $wireModel }}" @endif
            @if($hasError) aria-invalid="true" @endif
        />

        @if ($suffix)
            <span class="ml-2 text-muted-foreground font-semibold select-none text-xs pointer-events-none">
                {{ $suffix }}
            </span>
        @endif
    </div>

    @if ($hasError && $errorMessage)
        <p id="{{ $id }}-error" role="alert" class="mt-1.5 text-xs font-medium text-destructive flex items-center gap-1">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="12" />
                <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            <span>{{ $errorMessage }}</span>
        </p>
    @elseif ($info)
        <p id="{{ $id }}-info" class="mt-1.5 text-xs text-muted-foreground">{{ $info }}</p>
    @endif
</div>
