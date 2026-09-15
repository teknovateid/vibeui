@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'country' => 'ID',
    'mask' => '+62 8##-####-####',
    'placeholder' => '+62 812-3456-7890',
    'description' => null,
    'size' => 'md', // sm, md, lg, xl
    'variant' => 'primary', // primary, outline, filled, flush, ghost
    'info' => null,
    'error' => null,
    'errorName' => null,
    'disabled' => false,
    'readonly' => false,
    'value' => null,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ?? uniqid('phone-'));
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
        <label for="{{ $id }}" class="block text-xs font-semibold text-foreground select-none">
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

            init() {
                if (this.phoneVal) {
                    this.phoneVal = this.applyMask(this.phoneVal);
                }

                this.$nextTick(() => {
                    let input = this.$refs.phoneInput;
                    if (input) {
                        input.addEventListener('input', (e) => {
                            let formatted = this.applyMask(e.target.value);
                            if (formatted !== this.phoneVal) {
                                this.phoneVal = formatted;
                            }
                        });
                    }
                });
            },

            applyMask(val) {
                if (!val) return '';
                // Extract only digits
                let digits = String(val).replace(/\D/g, '');
                
                // If user typed without country code (e.g. 0812...), convert 08 to 628 for +62 mask
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
                        // If digit matches literal character in mask (e.g. 6 in +62), consume it
                        if (patternChar === digits[digitIdx]) {
                            digitIdx++;
                        }
                    }
                }

                return masked;
            },

            handleInput(e) {
                let formatted = this.applyMask(e.target.value);
                this.phoneVal = formatted;
                e.target.value = formatted;
            }
        }"
        class="relative flex items-center w-full border shadow-2xs transition-colors duration-150 {{ $sizeClasses }} {{ $variantClasses }} {{ $errorBorderClasses }}"
    >
        {{-- Country Icon/Prefix Indicator --}}
        <div class="flex items-center gap-1.5 mr-2 shrink-0 select-none text-muted-foreground">
            @if(strtoupper($country) === 'ID')
                {{-- Indonesian Flag SVG --}}
                <span class="inline-flex flex-col w-4 h-3 rounded-sm overflow-hidden border border-border/80 shadow-2xs">
                    <span class="w-full h-1.5 bg-red-600"></span>
                    <span class="w-full h-1.5 bg-white"></span>
                </span>
            @else
                <svg class="size-3.5 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            @endif
        </div>

        {{-- Phone Input --}}
        <input 
            type="tel"
            x-ref="phoneInput"
            id="{{ $id }}"
            @if($name) name="{{ $name }}" @endif
            x-model="phoneVal"
            @input="handleInput($event)"
            placeholder="{{ $placeholder }}"
            @if($wireModel) wire:model="{{ $wireModel }}" @endif
            @if($isDisabled) disabled @endif
            @if($isReadonly) readonly @endif
            @if($hasError) aria-invalid="true" @endif
            class="w-full bg-transparent text-foreground placeholder:text-muted-foreground focus:outline-none font-medium text-left"
        />
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
