@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'description' => null,
    'info' => null,
    'error' => null,
    'errorName' => null,
    'size' => 'md', // xs, sm, md, lg, xl
    'variant' => 'primary', // primary, outline, filled, flush, ghost
    'disabled' => false,
    'readonly' => false,
    'placeholder' => null,
    'value' => null,
    'icon' => null,
    'generator' => 'random', // random, pattern, uuid, slug, none
    'length' => 8,
    'charset' => 'alphanumeric', // alphanumeric, numeric, alphabetic, uppercase, lowercase, hex, or custom string
    'pattern' => null, // e.g. 'PRD-####-****'
    'prefix' => null,
    'suffix' => null,
    'separator' => null,
    'chunk' => null,
    'uppercase' => true,
    'url' => null, // Backend API endpoint to generate code
    'method' => 'POST', // POST or GET
    'responseKey' => 'code', // JSON key containing generated code
    'checkUrl' => null, // Backend API endpoint to check availability/uniqueness
    'checkMethod' => 'GET', // GET or POST
    'checkDebounce' => 400, // Debounce time in ms
    'autoCheck' => true, // Automatically check availability on generate/input
    'copyable' => true, // Show copy button
    'autoGenerate' => false, // Automatically generate on mount if empty
    'wrapperClass' => null,
    'animation' => false,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ?? uniqid('input-generate-'));
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

    $baseControlClasses = 'relative w-full flex items-center transition-colors duration-150 cursor-text overflow-hidden';

    $sizeControlClasses = match ($size) {
        'xs' => 'h-7 text-xs rounded-md',
        'sm' => 'h-8 text-xs rounded-md',
        'md' => 'h-9 text-sm rounded-lg',
        'lg' => 'h-10 text-sm rounded-lg',
        'xl' => 'h-11 text-base rounded-xl',
        default => 'h-9 text-sm rounded-lg',
    };

    if ($variant === 'flush') {
        $sizeControlClasses = match ($size) {
            'xs' => 'h-7 text-xs rounded-none px-0',
            'sm' => 'h-8 text-xs rounded-none px-0',
            'md' => 'h-9 text-sm rounded-none px-0',
            'lg' => 'h-10 text-sm rounded-none px-0',
            'xl' => 'h-11 text-base rounded-none px-0',
            default => 'h-9 text-sm rounded-none px-0',
        };
    }

    $variantControlClasses = match ($variant) {
        'filled' => $hasError ? 'bg-destructive/10 border border-destructive focus-within:bg-background focus-within:border-destructive focus-within:ring-2 focus-within:ring-destructive/20' : 'bg-muted/60 border border-transparent hover:bg-muted/80 focus-within:bg-background focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20',
        'flush' => $hasError ? 'border-b border-destructive bg-transparent focus-within:border-destructive focus-within:ring-0' : 'border-b border-input bg-transparent focus-within:border-primary focus-within:ring-0',
        'ghost' => $hasError ? 'border-transparent text-destructive bg-transparent focus-within:ring-2 focus-within:ring-destructive/20' : 'border-transparent bg-transparent hover:bg-muted/40 focus-within:bg-transparent focus-within:ring-2 focus-within:ring-primary/20',
        'outline' => $hasError ? 'border border-destructive bg-background shadow-2xs focus-within:border-destructive focus-within:ring-2 focus-within:ring-destructive/20' : 'border border-input bg-background shadow-2xs focus-within:border-ring focus-within:ring-2 focus-within:ring-ring/20',
        'primary' => $hasError ? 'border border-destructive bg-background shadow-2xs focus-within:border-destructive focus-within:ring-2 focus-within:ring-destructive/20' : 'border border-input bg-background shadow-2xs focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20',
        default => $hasError ? 'border border-destructive bg-background shadow-2xs focus-within:border-destructive focus-within:ring-2 focus-within:ring-destructive/20' : 'border border-input bg-background shadow-2xs focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20',
    };

    $stateControlClasses = '';
    if ($isDisabled) {
        $stateControlClasses = 'opacity-50 pointer-events-none bg-muted/40 cursor-not-allowed';
    } elseif ($isReadonly) {
        $stateControlClasses = 'bg-muted/20';
    }

    $animationClass = match ($animation) {
        true, 'auto' => ($hasError ? 'animate-vibe-shake' : ''),
        'shake' => 'animate-vibe-shake',
        'pop', 'bounce' => 'animate-vibe-pop',
        'pulse' => 'animate-vibe-pulse',
        'wobble' => 'animate-vibe-wobble',
        default => '',
    };

    $controlClasses = trim("{$baseControlClasses} {$sizeControlClasses} {$variantControlClasses} {$stateControlClasses} {$animationClass}");

    $leadingPadding = match ($size) {
        'xs' => 'pl-2 pr-1',
        'sm' => 'pl-2.5 pr-1.5',
        'lg' => 'pl-3.5 pr-2',
        'xl' => 'pl-4 pr-2.5',
        default => 'pl-3 pr-1.5',
    };

    $trailingPadding = match ($size) {
        'xs' => 'pr-1.5 pl-1',
        'sm' => 'pr-2 pl-1',
        'lg' => 'pr-2.5 pl-1.5',
        'xl' => 'pr-3 pl-1.5',
        default => 'pr-2 pl-1',
    };

    $inputPadding = ($icon ? 'pl-0 ' : match ($size) {
        'xs' => 'pl-2 ',
        'sm' => 'pl-2.5 ',
        'lg' => 'pl-4 ',
        'xl' => 'pl-4.5 ',
        default => 'pl-3.5 ',
    }) . 'pr-1';

    $inputFontSize = match ($size) {
        'xs', 'sm' => 'text-xs',
        'xl' => 'text-base',
        default => 'text-sm font-mono tracking-wide',
    };

    $inputTextColor = $hasError ? 'text-destructive placeholder:text-destructive/50' : 'text-foreground placeholder:text-muted-foreground';
    $inputClasses = trim("w-full flex-1 min-w-0 h-full bg-transparent border-0 py-0 focus:outline-none focus:ring-0 {$inputFontSize} {$inputPadding} {$inputTextColor} disabled:pointer-events-none");

    $iconSizeClass = match ($size) {
        'xs' => 'size-3.5',
        'sm' => 'size-3.5',
        'xl' => 'size-5',
        default => 'size-4',
    };

    $actionBtnPadding = match ($size) {
        'xs' => 'p-0.5',
        'sm' => 'p-1',
        'xl' => 'p-1.5',
        default => 'p-1',
    };

    $config = [
        'value' => $initialVal,
        'generator' => (string) $generator,
        'length' => max(1, (int) $length),
        'charset' => (string) $charset,
        'pattern' => $pattern ? (string) $pattern : '',
        'prefix' => $prefix ? (string) $prefix : '',
        'suffix' => $suffix ? (string) $suffix : '',
        'separator' => $separator ? (string) $separator : '',
        'chunk' => $chunk ? (int) $chunk : null,
        'uppercase' => (bool) $uppercase,
        'url' => $url ? (string) $url : '',
        'method' => strtoupper($method),
        'responseKey' => (string) $responseKey,
        'checkUrl' => $checkUrl ? (string) $checkUrl : '',
        'checkMethod' => strtoupper($checkMethod),
        'checkDebounce' => (int) $checkDebounce,
        'autoCheck' => (bool) $autoCheck,
        'autoGenerate' => (bool) $autoGenerate,
        'disabled' => (bool) $isDisabled,
    ];
@endphp

<div 
    {{ $attributes->only('class')->twMerge(['class' => trim("w-full {$wrapperClass}")]) }}
    x-data="vibeInputGenerate(@js($config))"
>
    @if ($label)
        <label for="{{ $id }}" class="block text-xs font-semibold text-foreground mb-1.5 select-none">
            {{ $label }}
            @if ($attributes->has('required') && $attributes->get('required') !== false)
                <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    @if ($description)
        <p id="{{ $id }}-description" class="mb-1.5 text-xs text-muted-foreground">{{ $description }}</p>
    @endif

    <div class="{{ $controlClasses }}">
        {{-- Leading Icon --}}
        @if (isset($icon))
            <div class="flex items-center {{ $leadingPadding }} gap-1.5 shrink-0 text-muted-foreground select-none pointer-events-none">
                <span class="{{ $iconSizeClass }} flex items-center justify-center shrink-0 [&>svg]:w-full [&>svg]:h-full">{{ $icon }}</span>
            </div>
        @endif

        {{-- Main Input Field --}}
        <input 
            x-ref="input"
            type="text" 
            id="{{ $id }}" 
            name="{{ $name }}" 
            :value="value"
            @input="handleInput($event)"
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif
            @if ($hasError) aria-invalid="true" @endif 
            @if ($isDisabled) disabled @endif 
            @if ($isReadonly) readonly @endif 
            {{ $attributes->except(['class', 'disabled', 'readonly'])->twMerge(['class' => $inputClasses]) }}
        />

        {{-- Trailing Actions Area --}}
        <div class="flex items-center {{ $trailingPadding }} gap-1 shrink-0 text-muted-foreground select-none">
            {{-- Status Indicator (When checkUrl is active) --}}
            @if ($checkUrl)
                <div class="flex items-center justify-center shrink-0 mr-0.5" :title="statusMessage">
                    {{-- Checking Spinner --}}
                    <svg x-show="isChecking" x-cloak class="{{ $iconSizeClass }} animate-spin text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>

                    {{-- Available Checkmark --}}
                    <span x-show="!isChecking && status === 'available'" x-cloak class="text-success transition-transform transform scale-100">
                        <svg class="{{ $iconSizeClass }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                    </span>

                    {{-- Taken / Duplicate Cross --}}
                    <span x-show="!isChecking && status === 'taken'" x-cloak class="text-destructive transition-transform transform scale-100">
                        <svg class="{{ $iconSizeClass }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="15" y1="9" x2="9" y2="15" />
                            <line x1="9" y1="9" x2="15" y2="15" />
                        </svg>
                    </span>

                    {{-- Error Triangle --}}
                    <span x-show="!isChecking && status === 'error'" x-cloak class="text-warning transition-transform transform scale-100">
                        <svg class="{{ $iconSizeClass }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                            <line x1="12" y1="9" x2="12" y2="13" />
                            <line x1="12" y1="17" x2="12.01" y2="17" />
                        </svg>
                    </span>
                </div>
            @endif

            {{-- Copy to Clipboard Button --}}
            @if ($copyable)
                <button 
                    type="button" 
                    tabindex="-1"
                    @click.stop="copyToClipboard()" 
                    :disabled="!value || {{ $isDisabled ? 'true' : 'false' }}"
                    class="{{ $actionBtnPadding }} rounded-md text-muted-foreground hover:text-foreground hover:bg-muted/80 focus:outline-none focus:ring-1 focus:ring-ring transition-colors cursor-pointer disabled:opacity-40 disabled:pointer-events-none"
                    :title="copied ? 'Tersalin ke clipboard!' : 'Salin ke clipboard'"
                    aria-label="Salin kode"
                >
                    {{-- Copy Icon --}}
                    <svg x-show="!copied" class="{{ $iconSizeClass }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="14" height="14" x="8" y="8" rx="2" ry="2" />
                        <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                    </svg>

                    {{-- Copied Feedback Icon --}}
                    <svg x-show="copied" x-cloak class="{{ $iconSizeClass }} text-success" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </button>
            @endif

            {{-- Divider between copy & generate if both present --}}
            @if ($copyable)
                <span class="h-3.5 w-px bg-border/80 self-center"></span>
            @endif

            {{-- Generate Button --}}
            <button 
                type="button" 
                tabindex="-1"
                @click.stop="generate()" 
                :disabled="isGenerating || {{ $isDisabled ? 'true' : 'false' }}"
                class="{{ $actionBtnPadding }} rounded-md text-primary hover:text-primary-foreground hover:bg-primary/90 focus:outline-none focus:ring-1 focus:ring-ring transition-all cursor-pointer disabled:opacity-50 disabled:pointer-events-none"
                :title="isGenerating ? 'Sedang generate...' : 'Generate kode baru'"
                aria-label="Generate kode"
            >
                {{-- Sparkles / Refresh Icon with spin on generating --}}
                <svg :class="{ 'animate-spin': isGenerating }" class="{{ $iconSizeClass }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                    <path d="M3 3v5h5" />
                    <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                    <path d="M16 21h5v-5" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Feedback & Validation Messages --}}
    @if ($hasError && $errorMessage)
        <p id="{{ $id }}-error" role="alert" class="mt-1.5 text-xs font-medium text-destructive flex items-center gap-1">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 8v5M12 16h.01" />
            </svg>
            <span>{{ $errorMessage }}</span>
        </p>
    @elseif ($checkUrl)
        <div x-show="statusMessage" x-cloak class="mt-1.5 text-xs flex items-center gap-1.5 font-medium"
            :class="{
                'text-success': status === 'available',
                'text-destructive': status === 'taken',
                'text-warning': status === 'error',
                'text-muted-foreground': status === 'checking'
            }"
        >
            <span x-text="statusMessage"></span>
        </div>
    @elseif ($info)
        <p id="{{ $id }}-info" class="mt-1.5 text-xs text-muted-foreground">{{ $info }}</p>
    @endif
</div>

@pushOnce('head', 'vibe-input-generate-script')
<script>
if (typeof window.vibeInputGenerate === 'undefined') {
    window.vibeInputGenerate = function(config) {
        return {
            value: config.value || '',
            generator: config.generator || 'random',
            length: config.length || 8,
            charset: config.charset || 'alphanumeric',
            pattern: config.pattern || '',
            prefix: config.prefix || '',
            suffix: config.suffix || '',
            separator: config.separator || '',
            chunk: config.chunk || null,
            uppercase: config.uppercase !== false,
            url: config.url || '',
            method: config.method || 'POST',
            responseKey: config.responseKey || 'code',
            checkUrl: config.checkUrl || '',
            checkMethod: config.checkMethod || 'GET',
            checkDebounce: config.checkDebounce || 400,
            autoCheck: config.autoCheck !== false,
            autoGenerate: config.autoGenerate || false,
            isGenerating: false,
            isChecking: false,
            status: 'idle',
            statusMessage: '',
            copied: false,
            debounceTimer: null,
            copyTimer: null,

            init() {
                if (this.autoGenerate && !this.value) {
                    this.$nextTick(() => this.generate());
                } else if (this.value && this.checkUrl && this.autoCheck) {
                    this.$nextTick(() => this.checkAvailability(this.value));
                }
            },

            getRandomInt(max) {
                if (window.crypto && window.crypto.getRandomValues) {
                    var arr = new Uint32Array(1);
                    window.crypto.getRandomValues(arr);
                    return arr[0] % max;
                }
                return Math.floor(Math.random() * max);
            },

            getCharacterSet() {
                var charsets = {
                    alphanumeric: 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789',
                    numeric: '0123456789',
                    alphabetic: 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                    uppercase: 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                    lowercase: 'abcdefghijklmnopqrstuvwxyz',
                    hex: '0123456789ABCDEF'
                };
                return charsets[this.charset] || this.charset || charsets.alphanumeric;
            },

            generateFrontend() {
                var result = '';

                if (this.generator === 'uuid') {
                    if (window.crypto && window.crypto.randomUUID) {
                        result = window.crypto.randomUUID();
                    } else {
                        var self = this;
                        result = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                            var r = self.getRandomInt(16);
                            var v = c === 'x' ? r : (r & 0x3 | 0x8);
                            return v.toString(16);
                        });
                    }
                } else if (this.generator === 'pattern' && this.pattern) {
                    var digits = '0123456789';
                    var alpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    var alphaNum = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
                    var lower = 'abcdefghijklmnopqrstuvwxyz';
                    var self = this;

                    result = this.pattern.replace(/[#*@?]/g, function(token) {
                        if (token === '#') return digits[self.getRandomInt(digits.length)];
                        if (token === '*') return alphaNum[self.getRandomInt(alphaNum.length)];
                        if (token === '@') return alpha[self.getRandomInt(alpha.length)];
                        if (token === '?') return lower[self.getRandomInt(lower.length)];
                        return token;
                    });
                } else {
                    var pool = this.getCharacterSet();
                    var randomBody = '';
                    for (var i = 0; i < this.length; i++) {
                        randomBody += pool[this.getRandomInt(pool.length)];
                    }

                    if (this.chunk && this.separator && this.chunk > 0) {
                        var regex = new RegExp('.{1,' + this.chunk + '}', 'g');
                        var matches = randomBody.match(regex);
                        if (matches) {
                            randomBody = matches.join(this.separator);
                        }
                    }

                    result = (this.prefix || '') + randomBody + (this.suffix || '');
                }

                if (this.uppercase && this.generator !== 'uuid') {
                    result = result.toUpperCase();
                }

                return result;
            },

            async generate() {
                if (this.isGenerating) return;

                this.status = 'idle';
                this.statusMessage = '';

                if (this.url) {
                    this.isGenerating = true;
                    try {
                        var csrfMeta = document.querySelector('meta[name="csrf-token"]');
                        var headers = {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        };
                        if (csrfMeta) {
                            headers['X-CSRF-TOKEN'] = csrfMeta.getAttribute('content');
                        }

                        var fetchOptions = {
                            method: this.method,
                            headers: headers
                        };

                        if (this.method === 'POST') {
                            headers['Content-Type'] = 'application/json';
                            fetchOptions.body = JSON.stringify({
                                prefix: this.prefix,
                                suffix: this.suffix,
                                length: this.length,
                                pattern: this.pattern
                            });
                        }

                        var response = await fetch(this.url, fetchOptions);
                        if (!response.ok) {
                            throw new Error('HTTP ' + response.status);
                        }

                        var data = await response.json();
                        var generated = null;

                        if (this.responseKey.indexOf('.') !== -1) {
                            generated = this.responseKey.split('.').reduce(function(acc, part) {
                                return acc && acc[part];
                            }, data);
                        } else {
                            generated = data[this.responseKey] !== undefined 
                                ? data[this.responseKey] 
                                : (data.data && data.data[this.responseKey] !== undefined 
                                    ? data.data[this.responseKey] 
                                    : (data.code !== undefined ? data.code : data.value));
                        }

                        if (generated !== null && generated !== undefined) {
                            this.setValue(String(generated));
                            if (this.checkUrl && this.autoCheck) {
                                this.checkAvailability(this.value);
                            }
                        } else {
                            throw new Error('Key not found in API response');
                        }
                    } catch (err) {
                        console.error('VibeInputGenerate Error:', err);
                        this.status = 'error';
                        this.statusMessage = 'Gagal menghubungi server untuk generate kode.';
                    } finally {
                        this.isGenerating = false;
                    }
                    return;
                }

                this.isGenerating = true;
                try {
                    var code = this.generateFrontend();
                    this.setValue(code);

                    if (this.checkUrl && this.autoCheck) {
                        await this.checkAvailability(code);
                    }
                } finally {
                    var self = this;
                    setTimeout(function() {
                        self.isGenerating = false;
                    }, 150);
                }
            },

            setValue(val) {
                var formatted = val;
                if (this.uppercase && this.generator !== 'uuid') {
                    formatted = formatted.toUpperCase();
                }
                this.value = formatted;

                var inputEl = this.$refs.input;
                if (inputEl) {
                    inputEl.value = formatted;
                    inputEl.dispatchEvent(new Event('input', { bubbles: true }));
                    inputEl.dispatchEvent(new Event('change', { bubbles: true }));
                }

                this.$dispatch('generated', { value: formatted });
            },

            handleInput(e) {
                var val = e.target.value;
                if (this.uppercase && this.generator !== 'uuid') {
                    val = val.toUpperCase();
                    e.target.value = val;
                }
                this.value = val;

                if (this.checkUrl && this.autoCheck) {
                    clearTimeout(this.debounceTimer);
                    var self = this;
                    this.debounceTimer = setTimeout(function() {
                        self.checkAvailability(val);
                    }, this.checkDebounce);
                } else {
                    this.status = 'idle';
                    this.statusMessage = '';
                }
            },

            async checkAvailability(code) {
                if (!this.checkUrl || !code || !code.trim()) {
                    this.status = 'idle';
                    this.statusMessage = '';
                    return;
                }

                this.isChecking = true;
                this.status = 'checking';

                try {
                    var csrfMeta = document.querySelector('meta[name="csrf-token"]');
                    var headers = {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    };
                    if (csrfMeta) {
                        headers['X-CSRF-TOKEN'] = csrfMeta.getAttribute('content');
                    }

                    var response;
                    if (this.checkMethod === 'POST') {
                        headers['Content-Type'] = 'application/json';
                        response = await fetch(this.checkUrl, {
                            method: 'POST',
                            headers: headers,
                            body: JSON.stringify({ code: code.trim() })
                        });
                    } else {
                        var sep = this.checkUrl.indexOf('?') !== -1 ? '&' : '?';
                        response = await fetch(this.checkUrl + sep + 'code=' + encodeURIComponent(code.trim()), {
                            method: 'GET',
                            headers: headers
                        });
                    }

                    if (!response.ok) {
                        throw new Error('HTTP ' + response.status);
                    }

                    var data = await response.json();
                    var isAvailable = (data.available === true || data.valid === true || data.status === 'available' || data.is_unique === true) && data.available !== false && data.valid !== false;

                    if (isAvailable) {
                        this.status = 'available';
                        this.statusMessage = data.message || 'Kode tersedia dan siap digunakan';
                    } else {
                        this.status = 'taken';
                        this.statusMessage = data.message || 'Kode sudah digunakan atau tidak valid';
                    }
                } catch (err) {
                    console.error('VibeInputGenerate Check Error:', err);
                    this.status = 'error';
                    this.statusMessage = 'Gagal memverifikasi keunikan kode';
                } finally {
                    this.isChecking = false;
                }
            },

            async copyToClipboard() {
                if (!this.value) return;

                try {
                    if (navigator.clipboard && window.isSecureContext) {
                        await navigator.clipboard.writeText(this.value);
                    } else {
                        var ta = document.createElement('textarea');
                        ta.value = this.value;
                        ta.style.position = 'fixed';
                        ta.style.left = '-9999px';
                        document.body.appendChild(ta);
                        ta.select();
                        document.execCommand('copy');
                        document.body.removeChild(ta);
                    }

                    this.copied = true;
                    clearTimeout(this.copyTimer);
                    var self = this;
                    this.copyTimer = setTimeout(function() {
                        self.copied = false;
                    }, 2000);

                    this.$dispatch('copied', { value: this.value });
                } catch (err) {
                    console.error('Clipboard error:', err);
                }
            }
        };
    };

    if (typeof window !== 'undefined') {
        if (window.Alpine) {
            window.Alpine.data('vibeInputGenerate', window.vibeInputGenerate);
        } else {
            document.addEventListener('alpine:init', function() {
                window.Alpine.data('vibeInputGenerate', window.vibeInputGenerate);
            });
        }
    }
}
</script>
@endPushOnce
