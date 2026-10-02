@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'country' => 'ID',
    'mask' => '+62 8##-####-####',
    'placeholder' => '+62 812-3456-7890',
    'description' => null,
    'size' => 'md', // xs, sm, md, lg, xl
    'variant' => 'primary', // primary, outline, filled, flush, ghost
    'info' => null,
    'error' => null,
    'errorName' => null,
    'disabled' => false,
    'readonly' => false,
    'value' => null,
    'clean' => false,       // Jika true: POST/Livewire menerima digits bersih (tanpa +, -, spasi). Nilai: true, false, 'local', 'prefix'
    'cleanPrefix' => true,  // Jika true (default): sertakan kode negara (misal 628xx). false = lokal saja (08xx)
])

@php
    $wireModel = $attributes->wire('model')->value();
    $name = $name ?? ($wireModel ?: $attributes->whereStartsWith('wire:model')->first());
    $id = $id ?? ($name ?? uniqid('phone-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = $error && !is_bool($error) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $isDisabled = $disabled || ($attributes->has('disabled') && $attributes->get('disabled') !== false);
    $isReadonly = $readonly || ($attributes->has('readonly') && $attributes->get('readonly') !== false);

    // Clean mode logic
    $isClean = false;
    $withCleanPrefix = (bool) $cleanPrefix;

    if ($clean === true || $clean === 1 || $clean === '1' || $clean === 'true' || $clean === 'clean' || $clean === 'digits' || $clean === 'intl') {
        $isClean = true;
    } elseif ($clean === 'local') {
        $isClean = true;
        $withCleanPrefix = false;
    }

    if ($cleanPrefix === false || $cleanPrefix === 0 || $cleanPrefix === '0' || $cleanPrefix === 'false') {
        $withCleanPrefix = false;
    }

    // Resolve initial raw value (from old input, explicit value, or Livewire component property)
    $initialVal = '';
    if (!empty($name) && !is_array(old($name))) {
        $initialVal = (string) old($name, !is_array($value ?? null) ? ($value ?? '') : '');
    } elseif (!empty($value) && !is_array($value)) {
        $initialVal = (string) $value;
    }

    if ($initialVal === '' && !empty($wireModel) && isset($this) && is_object($this) && method_exists($this, 'getPropertyValue')) {
        try {
            $lwVal = data_get($this, $wireModel);
            if (!is_null($lwVal) && !is_array($lwVal)) {
                $initialVal = (string) $lwVal;
            }
        } catch (\Throwable $e) {
            // Ignore if property is inaccessible
        }
    }

    // Pre-calculate clean digits for initial HTML render of hidden input
    $initialCleanVal = '';
    if ($initialVal !== '') {
        $cleanDigits = preg_replace('/\D/', '', $initialVal);
        if ($cleanDigits !== '') {
            if (str_starts_with($mask, '+62') && str_starts_with($cleanDigits, '08')) {
                $cleanDigits = '62' . substr($cleanDigits, 1);
            }
            if (!$withCleanPrefix && str_starts_with($cleanDigits, '62')) {
                $cleanDigits = '0' . substr($cleanDigits, 2);
            }
            $initialCleanVal = $cleanDigits;
        }
    }

    $sizeClasses = match ($size) {
        'xs' => 'h-7 text-xs rounded-md px-2',
        'sm' => 'h-8 text-xs rounded-md px-2.5',
        'md' => 'h-9 text-sm rounded-lg px-3.5',
        'lg' => 'h-10 text-sm rounded-lg px-4',
        'xl' => 'h-11 text-base rounded-xl px-4.5',
        default => 'h-9 text-sm rounded-lg px-3.5',
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
        <label for="{{ $isClean ? $id . '-display' : $id }}" class="block text-xs font-semibold text-foreground select-none">
            {{ $label }}
        </label>
    @endif

    @if ($description)
        <p class="text-xs text-muted-foreground select-none">{{ $description }}</p>
    @endif

    <div 
        x-data="{
            phoneVal: '{{ addslashes((string) $initialVal) }}',
            maskPattern: '{{ $mask }}',
            cleanMode: {{ $isClean ? 'true' : 'false' }},
            withPrefix: {{ $withCleanPrefix ? 'true' : 'false' }},

            formatClean(val) {
                if (!val) return '';
                let digits = String(val).replace(/\D/g, '');
                if (!digits) return '';

                if (this.maskPattern.startsWith('+62') && digits.startsWith('08')) {
                    digits = '62' + digits.slice(1);
                }

                if (!this.withPrefix && digits.startsWith('62')) {
                    digits = '0' + digits.slice(2);
                }

                return digits;
            },

            get cleanVal() {
                return this.formatClean(this.phoneVal);
            },

            init() {
                if (this.cleanMode && this.$wire && '{{ $wireModel }}') {
                    let wireVal = this.$wire.get('{{ $wireModel }}');
                    if (wireVal && !this.phoneVal) {
                        this.phoneVal = this.applyMask(wireVal);
                    }
                }

                if (this.phoneVal) {
                    this.phoneVal = this.applyMask(this.phoneVal);
                }

                // If in clean mode, sync initial clean value to hidden input
                if (this.cleanMode && this.$refs.hiddenInput) {
                    this.$refs.hiddenInput.value = this.cleanVal;
                }

                // Watch Livewire property updates from backend
                if (this.cleanMode && window.Livewire && this.$wire && '{{ $wireModel }}') {
                    this.$watch('$wire.{{ $wireModel }}', (newVal) => {
                        let clean = this.formatClean(newVal);
                        if (clean !== this.cleanVal) {
                            this.phoneVal = this.applyMask(newVal || '');
                            if (this.$refs.hiddenInput) {
                                this.$refs.hiddenInput.value = this.cleanVal;
                            }
                        }
                    });
                }

                // Listen to external input/change on hidden input (e.g. vibe:form restoreFromStorage)
                this.$nextTick(() => {
                    let hidden = this.$refs.hiddenInput;
                    if (hidden) {
                        hidden.addEventListener('input', (e) => {
                            if (e.target.value !== this.cleanVal) {
                                this.phoneVal = this.applyMask(e.target.value || '');
                            }
                        });
                        hidden.addEventListener('change', (e) => {
                            if (e.target.value !== this.cleanVal) {
                                this.phoneVal = this.applyMask(e.target.value || '');
                            }
                        });
                    }
                });
            },

            applyMask(val) {
                if (!val) return '';
                let digits = String(val).replace(/\D/g, '');
                
                if (this.maskPattern.startsWith('+62') && digits.startsWith('08')) {
                    digits = '62' + digits.slice(1);
                }

                let digitIdx = 0;
                let masked = '';

                for (let i = 0; i < this.maskPattern.length && digitIdx < digits.length; i++) {
                    let patternChar = this.maskPattern[i];
                    if (patternChar === '#') {
                        masked += digits[digitIdx++];
                    } else {
                        masked += patternChar;
                        if (patternChar === digits[digitIdx]) {
                            digitIdx++;
                        }
                    }
                }

                return masked;
            },

            syncHidden() {
                if (this.cleanMode) {
                    let hidden = this.$refs.hiddenInput;
                    if (hidden) {
                        hidden.value = this.cleanVal;
                        hidden.dispatchEvent(new Event('input', { bubbles: true }));
                        hidden.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                    this.$dispatch('phone-change', this.cleanVal);
                } else {
                    this.$dispatch('phone-change', this.phoneVal);
                }
            },

            handleInput(e) {
                let formatted = this.applyMask(e.target.value);
                this.phoneVal = formatted;
                e.target.value = formatted;
                this.syncHidden();
            }
        }"
        class="relative flex items-center w-full border shadow-2xs transition-colors duration-150 {{ $sizeClasses }} {{ $variantClasses }} {{ $errorBorderClasses }}"
        onclick="if (!event.target.closest('button, a, input')) this.querySelector('input[type=tel]')?.focus()"
    >
        {{-- Country Icon/Prefix Indicator --}}
        <div class="flex items-center gap-1.5 mr-2 shrink-0 select-none text-muted-foreground">
            @if(strtoupper($country) === 'ID')
                {{-- Indonesian Flag SVG --}}
                <span class="inline-flex flex-col w-4 h-3 rounded-sm overflow-hidden border border-border/80 shadow-2xs">
                    <span class="w-full h-1.5 bg-red-600"></span>
                    <span class="w-full h-1.5 bg-white"></span>
                </span>
                <svg class="size-3.5 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14.05 6a5 5 0 0 1 3.95 3.95M14.05 2a9 9 0 0 1 9 9m-4.5 9c-1.39 1.39-3.23 1.98-5.04 1.57-3.9-.88-7.53-4.51-8.41-8.41-.41-1.81.18-3.65 1.57-5.04l1.45-1.45a2 2 0 0 1 2.83 0l2.12 2.12a2 2 0 0 1 0 2.83l-1.06 1.06a8.6 8.6 0 0 0 3.44 3.44l1.06-1.06a2 2 0 0 1 2.83 0l2.12 2.12a2 2 0 0 1 0 2.83l-1.45 1.45z" />
                </svg>
            @endif
        </div>

        {{-- Visible Masked Input --}}
        <input 
            type="tel"
            x-ref="phoneInput"
            id="{{ $isClean ? $id . '-display' : $id }}"
            @if(!$isClean && $name) name="{{ $name }}" @endif
            x-model="phoneVal"
            @input="handleInput($event)"
            placeholder="{{ $placeholder }}"
            @if(!$isClean) {{ $attributes->whereStartsWith('wire:model') }} @endif
            @if($isDisabled) disabled @endif
            @if($isReadonly) readonly @endif
            @if($hasError) aria-invalid="true" @endif
            {{ $attributes->whereDoesntStartWith(['wire:model'])->except(['class', 'disabled', 'readonly', 'id', 'name', 'value', 'type', 'placeholder']) }}
            class="w-full bg-transparent text-foreground placeholder:text-muted-foreground focus:outline-none font-medium text-left"
        />

        @if($isClean)
            {{-- Hidden input carrying clean numeric value for Form POST & Livewire --}}
            <input 
                type="hidden" 
                x-ref="hiddenInput"
                id="{{ $id }}"
                @if($name) name="{{ $name }}" @endif
                value="{{ $initialCleanVal }}"
                :value="cleanVal"
                {{ $attributes->whereStartsWith('wire:model') }}
                @if($hasError) aria-invalid="true" @endif
            />
        @endif
    </div>

    @if ($hasError && $errorMessage)
        <p id="{{ $id }}-error" role="alert" class="mt-1.5 text-xs font-medium text-destructive flex items-center gap-1">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 8v5M12 16h.01" />
            </svg>
            <span>{{ $errorMessage }}</span>
        </p>
    @elseif ($info)
        <p id="{{ $id }}-info" class="mt-1.5 text-xs text-muted-foreground">{{ $info }}</p>
    @endif
</div>
