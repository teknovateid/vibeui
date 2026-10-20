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
    'integer' => false,
    'stripDecimals' => false,
    'round' => false,
    'description' => null,
    'size' => 'md',
    'variant' => 'primary',
    'info' => null,
    'error' => null,
    'errorName' => null,
    'disabled' => false,
    'readonly' => false,
    'placeholder' => '0',
    'value' => null,
])

@php
    $bindName = $attributes->get('x-bind:name') ?? $attributes->get(':name');
    $bindId = $attributes->get('x-bind:id') ?? $attributes->get(':id');
    $xModel = $attributes->whereStartsWith('x-model')->first();

    $name = $name ?? ($bindName ? null : $attributes->whereStartsWith('wire:model')->first());
    $id = $id ?? ($name ?? uniqid('currency-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = $error && !is_bool($error) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $isDisabled = $disabled || ($attributes->has('disabled') && $attributes->get('disabled') !== false);
    $isReadonly = $readonly || ($attributes->has('readonly') && $attributes->get('readonly') !== false);
    $isRequired = $attributes->has('required') && $attributes->get('required') !== false;

    $isInteger = $integer || $stripDecimals || ($attributes->has('integer') && $attributes->get('integer') !== false) || ($attributes->has('strip-decimals') && $attributes->get('strip-decimals') !== false) || (int) $precision === 0;

    $initialRaw = '';
    if (!empty($name) && !is_array(old($name))) {
        $initialRaw = (string) old($name, !is_array($value ?? null) ? ($value ?? '') : '');
    } elseif ($value !== null && !is_array($value) && $value !== '') {
        $initialRaw = (string) $value;
    }

    if (!empty($initialRaw)) {
        if (is_numeric($initialRaw)) {
            if ($isInteger) {
                $initialRaw = $round ? (string) round((float) $initialRaw) : (string) (int) ((float) $initialRaw);
            }
        } else {
            $cleanInit = ($thousandSeparator !== '' && $thousandSeparator !== null) ? str_replace($thousandSeparator, '', trim($initialRaw)) : trim($initialRaw);
            $cleanInit = ($decimalSeparator !== '' && $decimalSeparator !== null) ? str_replace($decimalSeparator, '.', $cleanInit) : $cleanInit;
            if (str_contains($cleanInit, '.')) {
                if ($round) {
                    $initialRaw = (string) round((float) $cleanInit);
                } else {
                    $initialRaw = explode('.', $cleanInit)[0];
                }
            }
        }
    }

    $wireModel = $attributes->wire('model')->value();

    $sizeClasses = match ($size) {
        'xs' => 'h-7 text-xs rounded-md px-2',
        'sm' => 'h-8 text-xs rounded-md px-2.5',
        'md' => 'h-11 sm:h-9 text-base sm:text-sm rounded-lg px-4 sm:px-3.5',
        'lg' => 'h-10 text-sm rounded-lg px-4',
        'xl' => 'h-11 text-base rounded-xl px-4.5',
        default => 'h-11 sm:h-9 text-base sm:text-sm rounded-lg px-4 sm:px-3.5',
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

<div class="{{ $label || $description ? 'space-y-1.5' : '' }} w-full" @if($bindId) :id="'container-' + ({{ $bindId }})" @elseif($bindName) :id="'container-' + ({{ $bindName }})" @else id="{{ $id }}-container" @endif>
    @if ($label)
        <label @if($bindId) :for="'display-' + ({{ $bindId }})" @elseif($bindName) :for="'display-' + ({{ $bindName }})" @else for="{{ $id }}-display" @endif class="block text-xs font-semibold text-foreground select-none">
            {{ $label }}
            @if ($isRequired)
                <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
            @endif
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
            isInteger: {{ $isInteger ? 'true' : 'false' }},
            round: {{ $round ? 'true' : 'false' }},

            init() {
                @if ($xModel)
                    let getVal = () => {
                        try {
                            return {{ $xModel }};
                        } catch (e) {
                            return null;
                        }
                    };

                    let initialVal = getVal();
                    if (initialVal !== null && initialVal !== undefined && initialVal !== '') {
                        this.rawValue = this.sanitizeRaw(initialVal);
                        this.displayValue = this.formatNumber(this.rawValue);
                    } else if (this.rawValue !== '') {
                        this.displayValue = this.formatNumber(this.rawValue);
                    }

                    this.$watch(() => {
                        try {
                            return {{ $xModel }};
                        } catch (e) {
                            return null;
                        }
                    }, (newVal) => {
                        let clean = (newVal !== null && newVal !== undefined && newVal !== '') ? this.sanitizeRaw(newVal) : '';
                        if (clean !== this.rawValue) {
                            this.rawValue = clean;
                            this.displayValue = this.formatNumber(this.rawValue);
                            let hidden = this.$refs.hiddenInput;
                            if (hidden) {
                                hidden.value = this.rawValue;
                            }
                        }
                    });
                @else
                    if (this.rawValue !== '') {
                        if (/^-?\d*(\.\d+)?$/.test(String(this.rawValue).trim())) {
                            this.rawValue = (this.isInteger || this.precision === 0) 
                                ? (this.round && String(this.rawValue).includes('.') ? String(Math.round(parseFloat(this.rawValue))) : String(this.rawValue).split('.')[0])
                                : String(this.rawValue);
                        } else {
                            this.rawValue = this.sanitizeRaw(this.rawValue);
                        }
                        this.displayValue = this.formatNumber(this.rawValue);
                    }
                @endif

                this.$nextTick(() => {
                    let hidden = this.$refs.hiddenInput;
                    if (hidden) {
                        hidden.addEventListener('input', (e) => {
                            let clean = this.sanitizeRaw(e.target.value);
                            if (clean !== this.rawValue) {
                                this.rawValue = clean;
                                this.displayValue = this.formatNumber(this.rawValue);
                                @if ($xModel)
                                    this.syncModel();
                                @endif
                            }
                        });
                    }
                });
            },

            sanitizeRaw(val) {
                if (val === null || val === undefined || val === '') return '';
                let str = String(val);
                let isNeg = this.allowNegative && str.startsWith('-');
                
                let clean = str;
                if (this.thousandSep) {
                    clean = clean.split(this.thousandSep).join('');
                }
                if (this.decimalSep) {
                    clean = clean.split(this.decimalSep).join('.');
                }
                clean = clean.trim().replace(/[^\d.]/g, '');

                if (!clean) return isNeg ? '-' : '';

                if (this.isInteger || this.precision === 0) {
                    if (this.round && clean.includes('.')) {
                        return (isNeg ? '-' : '') + String(Math.round(parseFloat(clean)));
                    }
                    let intPart = clean.split('.')[0] || '0';
                    return (isNeg ? '-' : '') + intPart;
                }

                let parts = clean.split('.');
                let intPart = parts[0] || '0';
                let decPart = parts[1] !== undefined ? parts[1].slice(0, this.precision) : '';
                return (isNeg ? '-' : '') + (decPart ? intPart + '.' + decPart : intPart);
            },

            formatNumber(val) {
                if (val === null || val === undefined || val === '') return '';
                let str = String(val);
                let isNeg = this.allowNegative && str.startsWith('-');
                str = str.replace(/[^\d.]/g, '');
                if (!str) return isNeg ? '-' : '';

                let parts = str.split('.');
                let integerPart = parts[0] || '0';
                let decimalPart = (this.isInteger || this.precision === 0) 
                    ? '' 
                    : (parts[1] !== undefined ? parts[1].slice(0, this.precision) : '');

                let formattedInt = this.thousandSep 
                    ? integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, this.thousandSep)
                    : integerPart;

                let result = (isNeg ? '-' : '') + formattedInt;
                if (this.precision > 0 && !this.isInteger && decimalPart !== '') {
                    result += (this.decimalSep || '.') + decimalPart;
                }
                return result;
            },

            parseRaw(displayStr) {
                return this.sanitizeRaw(displayStr);
            },

            syncModel() {
                @if ($xModel)
                    try {
                        let parsed = null;
                        if (this.rawValue !== '' && this.rawValue !== '-') {
                            parsed = (this.isInteger || this.precision === 0)
                                ? parseInt(this.rawValue, 10)
                                : parseFloat(this.rawValue);
                        }
                        {{ $xModel }} = parsed;
                    } catch (e) {}
                @endif
            },

            handleInput(e) {
                let inputVal = e.target.value;
                this.rawValue = this.sanitizeRaw(inputVal);
                this.displayValue = this.formatNumber(this.rawValue);

                let hidden = this.$refs.hiddenInput;
                if (hidden) {
                    hidden.value = this.rawValue;
                    hidden.dispatchEvent(new Event('input', { bubbles: true }));
                    hidden.dispatchEvent(new Event('change', { bubbles: true }));
                }

                @if ($xModel)
                    this.syncModel();
                @endif

                this.$dispatch('input', this.rawValue);
                this.$dispatch('change', this.rawValue);
            }
        }"
        {{ $attributes->whereStartsWith('@') }}
        {{ $attributes->only('class')->twMerge(['class' => "relative flex items-center w-full border shadow-2xs transition-colors duration-150 {$sizeClasses} {$variantClasses} {$errorBorderClasses}"]) }}
    >
        @if ($prefix)
            <span class="mr-2 text-muted-foreground font-semibold select-none text-xs pointer-events-none shrink-0">
                {{ $prefix }}
            </span>
        @endif

        <input 
            type="text"
            inputmode="{{ ($precision > 0 && !$isInteger) ? 'decimal' : 'numeric' }}"
            @if($bindId)
                :id="'display-' + ({{ $bindId }})"
            @elseif($bindName)
                :id="'display-' + ({{ $bindName }})"
            @else
                id="{{ $id }}-display"
            @endif
            x-model="displayValue"
            @input="handleInput($event)"
            placeholder="{{ $placeholder }}"
            @if($isDisabled) disabled @endif
            @if($isReadonly) readonly @endif
            @if($isRequired) required @endif
            class="w-full bg-transparent text-foreground placeholder:text-muted-foreground focus:outline-none text-left font-medium min-w-0"
        />

        <input 
            type="hidden" 
            x-ref="hiddenInput"
            @if($bindId)
                :id="{{ $bindId }}"
            @elseif($bindName)
                :id="'hidden-' + ({{ $bindName }})"
            @else
                id="{{ $id }}"
            @endif
            @if($name)
                name="{{ $name }}"
            @elseif($bindName)
                :name="{{ $bindName }}"
            @endif
            :value="rawValue"
            @if($wireModel) wire:model="{{ $wireModel }}" @endif
            @if($hasError) aria-invalid="true" @endif
        />

        @if ($suffix)
            <span class="ml-2 text-muted-foreground font-semibold select-none text-xs pointer-events-none shrink-0">
                {{ $suffix }}
            </span>
        @endif
    </div>

    @if ($hasError && $errorMessage)
        <p @if($bindName) :id="'error-' + ({{ $bindName }})" @else id="{{ $id }}-error" @endif role="alert" class="mt-1.5 text-xs font-medium text-destructive flex items-center gap-1">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 8v5M12 16h.01" />
            </svg>
            <span>{{ $errorMessage }}</span>
        </p>
    @elseif ($info)
        <p @if($bindName) :id="'info-' + ({{ $bindName }})" @else id="{{ $id }}-info" @endif class="mt-1.5 text-xs text-muted-foreground">{{ $info }}</p>
    @endif
</div>
