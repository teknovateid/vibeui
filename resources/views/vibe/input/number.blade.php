@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'prefix' => null,
    'suffix' => null,
    'thousandSeparator' => '.',
    'decimalSeparator' => ',',
    'precision' => 0,
    'allowNegative' => false,
    'integer' => false,
    'stripDecimals' => false,
    'round' => false,
    'raw' => true,
    'keepFormat' => false,
    'min' => null,
    'max' => null,
    'step' => 1,
    'clamp' => false,
    'stepper' => false,
    'keyboard' => true,
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
    $id = $id ?? ($name ?? uniqid('number-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = $error && !is_bool($error) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $isDisabled = $disabled || ($attributes->has('disabled') && $attributes->get('disabled') !== false);
    $isReadonly = $readonly || ($attributes->has('readonly') && $attributes->get('readonly') !== false);
    $isRequired = $attributes->has('required') && $attributes->get('required') !== false;

    $isInteger = $integer || $stripDecimals || ($attributes->has('integer') && $attributes->get('integer') !== false) || ($attributes->has('strip-decimals') && $attributes->get('strip-decimals') !== false) || (int) $precision === 0;

    $isRaw = $raw && !$keepFormat && !$attributes->has('keep-format');

    $initialRaw = '';
    if (!empty($name) && !is_array(old($name))) {
        $initialRaw = (string) old($name, !is_array($value ?? null) ? ($value ?? '') : '');
    } elseif ($value !== null && !is_array($value) && $value !== '') {
        $initialRaw = (string) $value;
    }

    if (!empty($initialRaw)) {
        $cleanInit = ($thousandSeparator !== '' && $thousandSeparator !== null) ? str_replace($thousandSeparator, '', trim($initialRaw)) : trim($initialRaw);
        $cleanInit = ($decimalSeparator !== '' && $decimalSeparator !== null) ? str_replace($decimalSeparator, '.', $cleanInit) : $cleanInit;
        if ($isInteger && str_contains($cleanInit, '.')) {
            if ($round) {
                $initialRaw = (string) round((float) $cleanInit);
            } else {
                $initialRaw = explode('.', $cleanInit)[0];
            }
        } else {
            $initialRaw = $cleanInit;
        }
    }

    $wireModel = $attributes->wire('model')->value();

    $plClass = match ($size) {
        'xs' => 'pl-2',
        'sm' => 'pl-2.5',
        'md' => 'pl-4 sm:pl-3.5',
        'lg' => 'pl-4',
        'xl' => 'pl-4.5',
        default => 'pl-4 sm:pl-3.5',
    };

    $prClass = match ($size) {
        'xs' => $stepper ? 'pr-0.5' : 'pr-2',
        'sm' => $stepper ? 'pr-0.5' : 'pr-2.5',
        'md' => $stepper ? 'pr-1 sm:pr-0.5' : 'pr-4 sm:pr-3.5',
        'lg' => $stepper ? 'pr-1' : 'pr-4',
        'xl' => $stepper ? 'pr-1' : 'pr-4.5',
        default => $stepper ? 'pr-1 sm:pr-0.5' : 'pr-4 sm:pr-3.5',
    };

    $hClass = match ($size) {
        'xs' => 'h-7 text-xs rounded-md',
        'sm' => 'h-8 text-xs rounded-md',
        'md' => 'h-11 sm:h-9 text-base sm:text-sm rounded-lg',
        'lg' => 'h-10 text-sm rounded-lg',
        'xl' => 'h-11 text-base rounded-xl',
        default => 'h-11 sm:h-9 text-base sm:text-sm rounded-lg',
    };

    $sizeClasses = "{$hClass} {$plClass} {$prClass}";

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
            isRaw: {{ $isRaw ? 'true' : 'false' }},
            min: {{ $min !== null ? (float) $min : 'null' }},
            max: {{ $max !== null ? (float) $max : 'null' }},
            step: {{ (float) $step }},
            clamp: {{ $clamp ? 'true' : 'false' }},
            isDisabled: {{ $isDisabled ? 'true' : 'false' }},
            isReadonly: {{ $isReadonly ? 'true' : 'false' }},

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
                                hidden.value = this.isRaw ? this.rawValue : this.displayValue;
                            }
                        }
                    });
                @else
                    if (this.rawValue !== '') {
                        this.rawValue = this.sanitizeRaw(this.rawValue);
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

            stepUp() {
                if (this.isDisabled || this.isReadonly) return;
                let current = this.rawValue !== '' && this.rawValue !== '-' ? parseFloat(this.rawValue) : 0;
                let next = current + this.step;
                if (this.max !== null && next > this.max) next = this.max;
                this.setValue(next);
            },

            stepDown() {
                if (this.isDisabled || this.isReadonly) return;
                let current = this.rawValue !== '' && this.rawValue !== '-' ? parseFloat(this.rawValue) : 0;
                let next = current - this.step;
                if (this.min !== null && next < this.min) next = this.min;
                this.setValue(next);
            },

            clampValue() {
                if (!this.clamp || this.rawValue === '' || this.rawValue === '-') return;
                let num = parseFloat(this.rawValue);
                if (isNaN(num)) return;
                let clamped = num;
                if (this.min !== null && clamped < this.min) clamped = this.min;
                if (this.max !== null && clamped > this.max) clamped = this.max;
                if (clamped !== num) {
                    this.setValue(clamped);
                }
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

            setValue(num) {
                let str = String(num);
                if (this.precision > 0 && !this.isInteger) {
                    str = Number(num).toFixed(this.precision);
                }
                this.rawValue = this.sanitizeRaw(str);
                this.displayValue = this.formatNumber(this.rawValue);
                this.syncHidden();
            },

            syncHidden() {
                let hidden = this.$refs.hiddenInput;
                if (hidden) {
                    hidden.value = this.isRaw ? this.rawValue : this.displayValue;
                    hidden.dispatchEvent(new Event('input', { bubbles: true }));
                    hidden.dispatchEvent(new Event('change', { bubbles: true }));
                }
                @if ($xModel)
                    this.syncModel();
                @endif
                this.$dispatch('input', this.rawValue);
                this.$dispatch('change', this.rawValue);
            },

            handleInput(e) {
                let inputVal = e.target.value;
                this.rawValue = this.sanitizeRaw(inputVal);
                this.displayValue = this.formatNumber(this.rawValue);
                this.syncHidden();
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
            @if ($keyboard)
                @keydown.up.prevent="stepUp()"
                @keydown.down.prevent="stepDown()"
            @endif
            @blur="clampValue()"
            placeholder="{{ $placeholder }}"
            @if($isDisabled) disabled @endif
            @if($isReadonly) readonly @endif
            @if($isRequired) required @endif
            class="w-full bg-transparent text-foreground placeholder:text-muted-foreground focus:outline-none text-left font-medium min-w-0"
        />

        @if ($suffix)
            <span class="ml-2 text-muted-foreground font-semibold select-none text-xs pointer-events-none shrink-0">
                {{ $suffix }}
            </span>
        @endif

        @if ($stepper)
            <div class="flex flex-col border-l border-border/60 pl-1 ml-2 self-stretch justify-center my-0.5 shrink-0 select-none">
                <button 
                    type="button" 
                    tabindex="-1" 
                    @click.stop="stepUp()" 
                    :disabled="isDisabled || isReadonly || (max !== null && parseFloat(rawValue || 0) >= max)" 
                    class="px-1.5 text-muted-foreground hover:text-foreground hover:bg-muted/60 rounded-xs transition-colors flex items-center justify-center flex-1 cursor-pointer disabled:opacity-30 disabled:pointer-events-none"
                    aria-label="{{ __('vibe/input.increase_value') }}"
                >
                    <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                </button>
                <button 
                    type="button" 
                    tabindex="-1" 
                    @click.stop="stepDown()" 
                    :disabled="isDisabled || isReadonly || (min !== null && parseFloat(rawValue || 0) <= min)" 
                    class="px-1.5 text-muted-foreground hover:text-foreground hover:bg-muted/60 rounded-xs transition-colors flex items-center justify-center flex-1 cursor-pointer disabled:opacity-30 disabled:pointer-events-none"
                    aria-label="{{ __('vibe/input.decrease_value') }}"
                >
                    <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>
            </div>
        @endif

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
            :value="isRaw ? rawValue : displayValue"
            @if($wireModel) wire:model="{{ $wireModel }}" @endif
            @if($hasError) aria-invalid="true" @endif
        />
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
