@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'length' => 6,
    'mask' => false,
    'autoSubmit' => false,
    'description' => null,
    'size' => 'md', // sm, md, lg, xl
    'variant' => 'primary', // primary, outline, filled
    'info' => null,
    'error' => null,
    'errorName' => null,
    'disabled' => false,
    'readonly' => false,
    'value' => '',
])

@php
    $length = max(2, min(12, (int) $length));
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ?? uniqid('otp-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = $error && !is_bool($error) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $isDisabled = $disabled || ($attributes->has('disabled') && $attributes->get('disabled') !== false);
    $isReadonly = $readonly || ($attributes->has('readonly') && $attributes->get('readonly') !== false);

    $initialVal = '';
    if (!empty($name) && !is_array(old($name))) {
        $initialVal = (string) old($name, !is_array($value ?? null) ? ($value ?? '') : '');
    } elseif (!empty($value) && !is_array($value)) {
        $initialVal = (string) $value;
    }
    $wireModel = $attributes->wire('model')->value();

    $boxSizeClasses = match ($size) {
        'sm' => 'w-8 h-9 text-sm rounded-md',
        'md' => 'w-10 h-11 text-base rounded-lg',
        'lg' => 'w-12 h-13 text-lg rounded-xl',
        'xl' => 'w-14 h-15 text-xl rounded-xl',
        default => 'w-10 h-11 text-base rounded-lg',
    };

    $variantClasses = match ($variant) {
        'outline' => 'bg-transparent border-input focus:border-primary focus:ring-primary/20',
        'filled' => 'bg-muted/60 border-transparent focus:bg-background focus:border-primary focus:ring-primary/20',
        default => 'bg-background border-input focus:border-primary focus:ring-primary/20',
    };

    $errorBoxClasses = $hasError ? 'border-destructive text-destructive focus:border-destructive focus:ring-destructive/20' : '';
@endphp

<div class="space-y-1.5 w-fit" id="{{ $id }}-container">
    @if ($label)
        <label for="{{ $id }}-0" class="block text-xs font-semibold text-foreground select-none">
            {{ $label }}
        </label>
    @endif

    @if ($description)
        <p class="text-xs text-muted-foreground select-none">{{ $description }}</p>
    @endif

    <div 
        x-data="{
            length: {{ $length }},
            mask: {{ $mask ? 'true' : 'false' }},
            autoSubmit: {{ $autoSubmit ? 'true' : 'false' }},
            digits: Array({{ $length }}).fill(''),
            idPrefix: '{{ $id }}-',
            init() {
                let initVal = '{{ addslashes($initialVal) }}';
                if (initVal) {
                    this.populateFromValue(initVal);
                }

                // Listen to external input event for vibe:form restoreFromStorage()
                this.$nextTick(() => {
                    let hidden = this.$refs.hiddenInput;
                    if (hidden) {
                        hidden.addEventListener('input', (e) => {
                            if (e.target.value !== this.digits.join('')) {
                                this.populateFromValue(e.target.value);
                            }
                        });
                    }
                });
            },
            populateFromValue(val) {
                if (!val) {
                    this.digits = Array(this.length).fill('');
                    for (let i = 0; i < this.length; i++) {
                        let el = document.getElementById(this.idPrefix + i);
                        if (el) el.value = '';
                    }
                    return;
                }
                let clean = String(val).replace(/\s+/g, '').slice(0, this.length).split('');
                for (let i = 0; i < this.length; i++) {
                    this.digits[i] = clean[i] || '';
                    let el = document.getElementById(this.idPrefix + i);
                    if (el) el.value = clean[i] || '';
                }
            },
            updateValue() {
                let full = this.digits.join('');
                let hidden = this.$refs.hiddenInput;
                if (hidden) {
                    hidden.value = full;
                    // Bubble input event for Livewire wire:model and vibe:form saveToStorage
                    hidden.dispatchEvent(new Event('input', { bubbles: true }));
                    hidden.dispatchEvent(new Event('change', { bubbles: true }));
                }
                this.$dispatch('otp-change', full);

                if (full.length === this.length && this.autoSubmit) {
                    this.$nextTick(() => {
                        let form = this.$el.closest('form');
                        if (form) {
                            form.requestSubmit ? form.requestSubmit() : form.submit();
                        }
                    });
                }
            },
            handleInput(index, event) {
                let val = event.target.value;
                if (!val) {
                    this.digits[index] = '';
                    this.updateValue();
                    return;
                }
                if (val.length > 1) {
                    let digitsOnly = val.replace(/\D/g, '');
                    if (digitsOnly.length > 1) {
                        this.distributeText(digitsOnly, index);
                        return;
                    }
                    val = digitsOnly || val.slice(-1);
                }
                let clean = val.replace(/\D/g, '');
                this.digits[index] = clean;
                event.target.value = clean;
                this.updateValue();

                if (clean && index < this.length - 1) {
                    this.focusBox(index + 1);
                }
            },
            handleKeyDown(index, event) {
                // Intercept numeric keys 0-9 directly for instant replacement and reliable focus progression
                if (/^[0-9]$/.test(event.key)) {
                    event.preventDefault();
                    this.digits[index] = event.key;
                    event.target.value = event.key;
                    this.updateValue();
                    if (index < this.length - 1) {
                        this.focusBox(index + 1);
                    }
                    return;
                }

                if (event.key === 'Backspace') {
                    event.preventDefault();
                    if (this.digits[index]) {
                        this.digits[index] = '';
                        event.target.value = '';
                        this.updateValue();
                    } else if (index > 0) {
                        this.digits[index - 1] = '';
                        let prev = document.getElementById(this.idPrefix + (index - 1));
                        if (prev) prev.value = '';
                        this.updateValue();
                        this.focusBox(index - 1);
                    }
                    return;
                }

                if (event.key === 'Delete') {
                    event.preventDefault();
                    this.digits[index] = '';
                    event.target.value = '';
                    this.updateValue();
                    return;
                }

                if (event.key === 'ArrowLeft' && index > 0) {
                    event.preventDefault();
                    this.focusBox(index - 1);
                    return;
                }

                if (event.key === 'ArrowRight' && index < this.length - 1) {
                    event.preventDefault();
                    this.focusBox(index + 1);
                    return;
                }
            },
            handlePaste(event) {
                event.preventDefault();
                let paste = (event.clipboardData || window.clipboardData)?.getData('text') || '';
                let clean = paste.replace(/\D/g, '');
                if (clean) {
                    this.distributeText(clean, 0);
                }
            },
            distributeText(text, startIndex = 0) {
                let clean = text.replace(/\D/g, '');
                let chars = clean.split('');
                for (let i = 0; i < chars.length && (startIndex + i) < this.length; i++) {
                    let idx = startIndex + i;
                    this.digits[idx] = chars[i];
                    let el = document.getElementById(this.idPrefix + idx);
                    if (el) el.value = chars[i];
                }
                this.updateValue();
                let nextFocus = Math.min(startIndex + chars.length, this.length - 1);
                this.focusBox(nextFocus);
            },
            focusBox(idx) {
                if (idx < 0 || idx >= this.length) return;
                const doFocus = () => {
                    let input = document.getElementById(this.idPrefix + idx);
                    if (input) {
                        input.focus();
                        input.select();
                    }
                };
                doFocus();
                this.$nextTick(doFocus);
                setTimeout(doFocus, 10);
            }
        }"
        class="flex items-center gap-2"
        @paste="handlePaste($event)"
    >
        {{-- Hidden input for traditional HTML form submit, vibe:form, and Livewire --}}
        <input 
            type="hidden" 
            x-ref="hiddenInput"
            id="{{ $id }}"
            @if($name) name="{{ $name }}" @endif
            @if($initialVal) value="{{ $initialVal }}" @endif
            @if($wireModel) wire:model="{{ $wireModel }}" @endif
            @if($hasError) aria-invalid="true" @endif
        />

        {{-- Digit Slot Boxes --}}
        @for ($i = 0; $i < $length; $i++)
            <input 
                type="{{ $mask ? 'password' : 'text' }}"
                inputmode="numeric"
                pattern="[0-9]*"
                maxlength="2"
                id="{{ $id }}-{{ $i }}"
                data-otp-index="{{ $i }}"
                x-model="digits[{{ $i }}]"
                @input="handleInput({{ $i }}, $event)"
                @keydown="handleKeyDown({{ $i }}, $event)"
                @paste="handlePaste($event)"
                @focus="$event.target.select()"
                @if($isDisabled) disabled @endif
                @if($isReadonly) readonly @endif
                autocomplete="one-time-code"
                class="text-center font-bold font-mono border shadow-2xs focus:ring-2 focus:outline-none transition-all duration-150 select-none {{ $boxSizeClasses }} {{ $variantClasses }} {{ $errorBoxClasses }}"
                aria-label="{{ __('vibe/input.digit_label', ['digit' => $i + 1, 'total' => $length]) ?? 'Digit ' . ($i + 1) }}"
            />
        @endfor
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
