@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'length' => 6,
    'mask' => false,
    'autoSubmit' => false,
    'alphanumeric' => false,
    'separator' => null,
    'separatorAt' => null,
    'autofocus' => false,
    'description' => null,
    'size' => 'md', // xs, sm, md, lg, xl
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
    $isAlphanumeric = (bool) $alphanumeric;
    $hasAutofocus = (bool) $autofocus || ($attributes->has('autofocus') && $attributes->get('autofocus') !== false);

    $resolvedSeparator = is_string($separator) && $separator !== '' ? $separator : null;
    $resolvedSeparatorAt = $resolvedSeparator !== null
        ? ($separatorAt !== null ? max(1, min($length - 1, (int) $separatorAt)) : ($length >= 4 && $length % 2 === 0 ? intdiv($length, 2) : null))
        : null;

    $initialVal = '';
    if (!empty($name) && !is_array(old($name))) {
        $initialVal = (string) old($name, !is_array($value ?? null) ? ($value ?? '') : '');
    } elseif (!empty($value) && !is_array($value)) {
        $initialVal = (string) $value;
    }
    $wireModel = $attributes->wire('model')->value();

    $gapClasses = $length >= 7 ? 'gap-1 sm:gap-1.5' : 'gap-2';
    $boxSizeClasses = match ($size) {
        'xs' => 'w-7 h-8 text-xs rounded-md',
        'sm' => $length >= 7 ? 'w-7 h-8 sm:w-8 sm:h-9 text-xs sm:text-sm rounded-md' : 'w-8 h-9 text-sm rounded-md',
        'md' => $length >= 7 ? 'w-7 h-9 sm:w-9 sm:h-11 text-sm sm:text-base rounded-lg' : 'w-10 h-11 text-base rounded-lg',
        'lg' => $length >= 7 ? 'w-8 h-10 sm:w-10 sm:h-12 text-base sm:text-lg rounded-xl' : 'w-12 h-13 text-lg rounded-xl',
        'xl' => 'w-14 h-15 text-xl rounded-xl',
        default => $length >= 7 ? 'w-7 h-9 sm:w-9 sm:h-11 text-sm sm:text-base rounded-lg' : 'w-10 h-11 text-base rounded-lg',
    };

    $variantClasses = match ($variant) {
        'outline' => 'bg-transparent border-input focus:border-primary focus:ring-primary/20',
        'filled' => 'bg-muted/60 border-transparent focus:bg-background focus:border-primary focus:ring-primary/20',
        default => 'bg-background border-input focus:border-primary focus:ring-primary/20',
    };

    $errorBoxClasses = $hasError ? 'border-destructive text-destructive focus:border-destructive focus:ring-destructive/20' : '';
@endphp

<div class="space-y-1.5 w-fit max-w-full" id="{{ $id }}-container">
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
            alphanumeric: {{ $isAlphanumeric ? 'true' : 'false' }},
            digits: Array({{ $length }}).fill(''),
            idPrefix: '{{ $id }}-',
            _lastAutoSubmitted: null,
            sanitize(val) {
                const raw = String(val ?? '');
                return this.alphanumeric
                    ? raw.toUpperCase().replace(/[^A-Z0-9]/g, '')
                    : raw.replace(/\D/g, '');
            },
            init() {
                let initVal = '{{ addslashes($initialVal) }}';
                if (initVal) {
                    this.populateFromValue(initVal);
                }

                // Listen to external input event for vibe:form restoreFromStorage() or Livewire updates
                this.$nextTick(() => {
                    let hidden = this.$refs.hiddenInput;
                    if (hidden) {
                        hidden.addEventListener('input', (e) => {
                            let sanitized = this.sanitize(e.target.value);
                            if (sanitized !== this.digits.join('')) {
                                this.populateFromValue(sanitized);
                            }
                        });
                    }
                });
            },
            populateFromValue(val) {
                if (!val) {
                    this.digits = Array(this.length).fill('');
                    this._lastAutoSubmitted = null;
                    for (let i = 0; i < this.length; i++) {
                        let el = document.getElementById(this.idPrefix + i);
                        if (el) el.value = '';
                    }
                    return;
                }
                let clean = this.sanitize(val).slice(0, this.length).split('');
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

                if (full.length < this.length) {
                    this._lastAutoSubmitted = null;
                } else if (this.autoSubmit && this.digits.every((d) => d !== '') && full !== this._lastAutoSubmitted) {
                    this._lastAutoSubmitted = full;
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
                let cleaned = this.sanitize(val);
                if (cleaned.length > 1) {
                    this.distributeText(cleaned, index);
                    return;
                }
                let clean = cleaned;
                this.digits[index] = clean;
                event.target.value = clean;
                this.updateValue();

                if (clean && index < this.length - 1) {
                    this.focusBox(index + 1);
                }
            },
            handleKeyDown(index, event) {
                const keyPattern = this.alphanumeric ? /^[a-zA-Z0-9]$/ : /^[0-9]$/;
                if (!event.ctrlKey && !event.metaKey && !event.altKey && keyPattern.test(event.key)) {
                    event.preventDefault();
                    let ch = this.alphanumeric ? event.key.toUpperCase() : event.key;
                    this.digits[index] = ch;
                    event.target.value = ch;
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
                let clean = this.sanitize(paste);
                if (clean) {
                    this.distributeText(clean, 0);
                }
            },
            distributeText(text, startIndex = 0) {
                let clean = this.sanitize(text);
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
        class="flex items-center justify-center {{ $gapClasses }}"
        @paste="handlePaste($event)"
        @vibe-otp-reset.window="if (!$event.detail?.id || $event.detail.id === '{{ $id }}') { populateFromValue(''); updateValue(); focusBox(0); }"
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

        {{-- Character / Digit Slot Boxes --}}
        @for ($i = 0; $i < $length; $i++)
            @if ($resolvedSeparator && $i === $resolvedSeparatorAt)
                <span aria-hidden="true" class="text-muted-foreground font-mono font-bold select-none shrink-0 px-0.5">{{ $resolvedSeparator }}</span>
            @endif

            <input
                type="{{ $mask ? 'password' : 'text' }}"
                inputmode="{{ $isAlphanumeric ? 'text' : 'numeric' }}"
                pattern="{{ $isAlphanumeric ? '[A-Za-z0-9]*' : '[0-9]*' }}"
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
                @if($hasAutofocus && $i === 0) autofocus @endif
                @if($isAlphanumeric)
                    autocomplete="off"
                    autocapitalize="characters"
                    spellcheck="false"
                @else
                    autocomplete="one-time-code"
                @endif
                class="text-center font-bold font-mono border shadow-2xs focus:ring-2 focus:outline-none transition-all duration-150 select-none {{ $isAlphanumeric ? 'uppercase ' : '' }}{{ $boxSizeClasses }} {{ $variantClasses }} {{ $errorBoxClasses }}"
                aria-label="{{ $isAlphanumeric ? ('Character ' . ($i + 1) . ' of ' . $length) : (__('vibe/input.digit_label', ['digit' => $i + 1, 'total' => $length]) ?? 'Digit ' . ($i + 1)) }}"
            />
        @endfor
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
