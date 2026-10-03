@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'separator' => ',', // Separator utama (input & POST), misal ',', '|', ';'
    'delimiters' => null, // Array/string karakter pemisah input tambahan, default: [$separator, 'Enter', ';']
    'postSeparator' => null, // Separator khusus saat form POST jika ingin berbeda dari $separator
    'postFormat' => 'string', // 'string' (contoh: 'laravel,nextjs,php'), 'array' (name[]), 'json'
    'value' => [],
    'badgeVariant' => 'secondary', // secondary, primary, outline, cycle
    'colorCycle' => ['info', 'primary', 'success', 'warning', 'secondary', 'purple'],
    'max' => null,
    'min' => null,
    'allowDuplicates' => false,
    'caseSensitive' => false,
    'placeholder' => 'Tambah item...',
    'clearable' => true,
    'copyable' => false,
    'size' => 'md', // xs, sm, md, lg, xl
    'variant' => 'primary', // primary, outline, filled, flush, ghost
    'disabled' => false,
    'readonly' => false,
    'description' => null,
    'info' => null,
    'error' => null,
    'errorName' => null,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ?? uniqid('input-multiple-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = $error && !is_bool($error) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $isDisabled = $disabled || ($attributes->has('disabled') && $attributes->get('disabled') !== false);
    $isReadonly = $readonly || ($attributes->has('readonly') && $attributes->get('readonly') !== false);

    $wireModel = $attributes->wire('model')->value();

    // Normalisasi nilai awal dari old(), $value, atau attribute
    $initialRaw = old($name, $value ?? ($attributes->get('value') ?? []));
    $initialItems = [];
    if (is_array($initialRaw)) {
        $initialItems = array_values(array_filter(array_map('trim', $initialRaw)));
    } elseif (!empty($initialRaw) && is_string($initialRaw)) {
        $parseSep = $separator ?: ',';
        $initialItems = array_values(array_filter(array_map('trim', explode($parseSep, $initialRaw))));
    }

    $actualPostSeparator = $postSeparator !== null ? $postSeparator : ($separator ?: ',');

    // Delimiters array normalized
    $delimitersList = [];
    if (!empty($delimiters)) {
        $delimitersList = is_array($delimiters) ? $delimiters : array_map('trim', explode(',', $delimiters));
    } else {
        $delimitersList = array_values(array_unique([$separator ?: ',', 'Enter', ';']));
    }

    // Styling container
    $sizeClasses = match ($size) {
        'xs' => 'min-h-7 text-xs rounded-md px-2 py-1 gap-1',
        'sm' => 'min-h-8 text-xs rounded-md px-2.5 py-1 gap-1.5',
        'md' => 'min-h-9 text-sm rounded-lg px-3 py-1.5 gap-1.5',
        'lg' => 'min-h-10 text-sm rounded-lg px-3.5 py-1.5 gap-2',
        'xl' => 'min-h-11 text-base rounded-xl px-4 py-2 gap-2.5',
        default => 'min-h-9 text-sm rounded-lg px-3 py-1.5 gap-1.5',
    };

    $variantClasses = match ($variant) {
        'outline' => 'bg-transparent border-input focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20',
        'filled' => 'bg-muted/60 border-transparent focus-within:bg-background focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20',
        'flush' => 'bg-transparent border-b border-border rounded-none px-0 focus-within:border-primary',
        'ghost' => 'bg-transparent border-transparent hover:bg-muted/40 focus-within:bg-background focus-within:border-primary',
        default => 'bg-background border-input focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20',
    };

    $errorBorderClasses = $hasError ? 'border-destructive text-destructive focus-within:border-destructive focus-within:ring-destructive/20' : '';

    // Badge sizing based on input size
    $badgeSizeClass = match ($size) {
        'xs' => 'h-5 px-1.5 text-[10px] gap-1 rounded-sm',
        'sm' => 'h-5.5 px-2 text-[11px] gap-1 rounded-sm',
        'md' => 'h-6 px-2 text-xs gap-1.5 rounded-md',
        'lg' => 'h-6.5 px-2.5 text-xs gap-1.5 rounded-lg',
        'xl' => 'h-7.5 px-3 text-sm gap-2 rounded-lg',
        default => 'h-6 px-2 text-xs gap-1.5 rounded-md',
    };

    $badgeRemoveSizeClass = match ($size) {
        'xs', 'sm' => 'size-2.5',
        'xl' => 'size-3.5',
        default => 'size-3',
    };
@endphp

<div class="space-y-1.5 w-full" id="{{ $id }}-container">
    @if ($label)
        <label for="{{ $id }}-input" class="block text-xs font-semibold text-foreground select-none">
            {{ $label }}
        </label>
    @endif

    @if ($description)
        <p class="text-xs text-muted-foreground select-none">{{ $description }}</p>
    @endif

    <div
        x-data="{
            items: @js($initialItems),
            inputValue: '',
            separator: @js($separator ?: ','),
            delimiters: @js($delimitersList),
            actualPostSeparator: @js($actualPostSeparator),
            postFormat: @js($postFormat),
            badgeVariant: @js($badgeVariant),
            colorCycle: @js($colorCycle),
            max: {{ $max !== null ? (int) $max : 'null' }},
            min: {{ $min !== null ? (int) $min : 'null' }},
            allowDuplicates: {{ $allowDuplicates ? 'true' : 'false' }},
            caseSensitive: {{ $caseSensitive ? 'true' : 'false' }},
            disabled: {{ $isDisabled ? 'true' : 'false' }},
            readonly: {{ $isReadonly ? 'true' : 'false' }},
            copied: false,

            init() {
                // Integrasi dengan event eksternal vibe:form restoreFromStorage()
                this.$nextTick(() => {
                    let hidden = this.$refs.hiddenInput;
                    if (hidden) {
                        hidden.addEventListener('input', (e) => {
                            let val = e.target.value;
                            if (typeof val === 'string' && val !== '') {
                                let parsed = this.parseItems(val);
                                if (JSON.stringify(parsed) !== JSON.stringify(this.items)) {
                                    this.items = parsed;
                                }
                            } else if (val === '' && this.items.length > 0) {
                                this.items = [];
                            }
                        });
                    }
                });
            },

            getCharSeps() {
                let seps = Array.isArray(this.delimiters) && this.delimiters.length > 0 
                    ? [...this.delimiters] 
                    : [this.separator, ';'];
                if (this.separator && !seps.includes(this.separator)) {
                    seps.push(this.separator);
                }
                return seps.filter(s => s !== 'Enter').map(s => s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'));
            },

            parseItems(inputStr) {
                if (!inputStr) return [];
                let escaped = this.getCharSeps();
                if (escaped.length === 0) escaped = [','];
                let regex = new RegExp('[' + escaped.join('') + '\\r\\n]+', 'g');
                return String(inputStr)
                    .split(regex)
                    .map(s => s.trim())
                    .filter(Boolean);
            },

            addItem(str) {
                let clean = (str || '').trim();
                if (!clean) return;
                if (this.max !== null && this.items.length >= this.max) return;

                if (!this.allowDuplicates) {
                    let exists = this.caseSensitive
                        ? this.items.includes(clean)
                        : this.items.some(item => item.toLowerCase() === clean.toLowerCase());
                    if (exists) return;
                }

                this.items.push(clean);
                this.syncHidden();
            },

            addFromInput() {
                if (!this.inputValue) return;
                let tokens = this.parseItems(this.inputValue);
                if (tokens.length > 0) {
                    tokens.forEach(tok => this.addItem(tok));
                } else if (this.inputValue.trim()) {
                    this.addItem(this.inputValue.trim());
                }
                this.inputValue = '';
                this.syncHidden();
            },

            handleInput(e) {
                if (this.disabled || this.readonly) return;
                let val = this.inputValue;
                let charSeps = this.getCharSeps();
                if (charSeps.length > 0) {
                    let regex = new RegExp('[' + charSeps.join('') + ']');
                    if (regex.test(val)) {
                        this.addFromInput();
                    }
                }
            },

            handleKeydown(e) {
                if (this.disabled || this.readonly) return;

                let isDelimiterKey = (e.key === 'Enter') || 
                    (e.key === this.separator) || 
                    (Array.isArray(this.delimiters) && this.delimiters.includes(e.key));

                if (isDelimiterKey) {
                    e.preventDefault();
                    this.addFromInput();
                    return;
                }

                if (e.key === 'Backspace' && this.inputValue === '') {
                    if (this.items.length > 0) {
                        e.preventDefault();
                        this.removeItem(this.items.length - 1);
                    }
                }
            },

            handlePaste(e) {
                if (this.disabled || this.readonly) return;
                e.preventDefault();
                let pasteText = (e.clipboardData || window.clipboardData)?.getData('text');
                if (!pasteText) return;

                let tokens = this.parseItems(pasteText);
                if (tokens.length > 0) {
                    tokens.forEach(tok => this.addItem(tok));
                }
                this.inputValue = '';
                this.syncHidden();
            },

            removeItem(index) {
                if (this.disabled || this.readonly) return;
                if (this.min !== null && this.items.length <= this.min) return;
                this.items.splice(index, 1);
                this.syncHidden();
                this.$nextTick(() => {
                    this.$refs.textInput?.focus();
                });
            },

            clearAll() {
                if (this.disabled || this.readonly) return;
                this.items = [];
                this.inputValue = '';
                this.syncHidden();
                this.$nextTick(() => {
                    this.$refs.textInput?.focus();
                });
            },

            copyAll() {
                let text = this.items.join(this.actualPostSeparator);
                if (!navigator.clipboard) return;
                navigator.clipboard.writeText(text).then(() => {
                    this.copied = true;
                    setTimeout(() => { this.copied = false; }, 2000);
                });
            },

            syncHidden() {
                this.$nextTick(() => {
                    let hidden = this.$refs.hiddenInput;
                    if (hidden) {
                        hidden.dispatchEvent(new Event('input', { bubbles: true }));
                        hidden.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
            },

            getBadgeClasses(index) {
                if (this.badgeVariant === 'cycle') {
                    const cycle = [
                        'bg-info/15 text-info border-info/30 hover:bg-info/20',
                        'bg-primary/15 text-primary border-primary/30 hover:bg-primary/20',
                        'bg-success/15 text-success border-success/30 hover:bg-success/20',
                        'bg-warning/15 text-warning border-warning/30 hover:bg-warning/20',
                        'bg-purple-500/15 text-purple-600 dark:text-purple-400 border-purple-500/30 hover:bg-purple-500/20',
                        'bg-pink-500/15 text-pink-600 dark:text-pink-400 border-pink-500/30 hover:bg-pink-500/20',
                        'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border-emerald-500/30 hover:bg-emerald-500/20',
                        'bg-cyan-500/15 text-cyan-600 dark:text-cyan-400 border-cyan-500/30 hover:bg-cyan-500/20',
                    ];
                    return cycle[index % cycle.length];
                }
                if (this.badgeVariant === 'primary') {
                    return 'bg-primary text-primary-foreground border-transparent shadow-2xs';
                }
                if (this.badgeVariant === 'outline') {
                    return 'bg-transparent text-foreground border-border hover:bg-muted';
                }
                return 'bg-muted/80 text-foreground border-border/70 hover:bg-muted';
            }
        }"
        @click="$refs.textInput?.focus()"
        class="relative flex flex-wrap items-center w-full border shadow-2xs transition-colors duration-150 cursor-text {{ $sizeClasses }} {{ $variantClasses }} {{ $errorBorderClasses }} @if($isDisabled) opacity-50 pointer-events-none @endif"
    >
        {{-- Badges / Chips Display --}}
        <template x-for="(item, index) in items" :key="index + '-' + item">
            <span 
                class="inline-flex items-center font-medium border select-none transition-colors shrink-0 max-w-full {{ $badgeSizeClass }}"
                :class="getBadgeClasses(index)"
            >
                <span x-text="item" class="truncate max-w-50"></span>
                <button
                    type="button"
                    @click.stop="removeItem(index)"
                    :disabled="disabled || readonly || (min !== null && items.length <= min)"
                    :class="{ 'opacity-30 cursor-not-allowed': min !== null && items.length <= min }"
                    class="hover:text-destructive hover:bg-destructive/10 rounded-xs p-0.5 transition-colors cursor-pointer shrink-0"
                    aria-label="Hapus tag"
                >
                    <svg class="{{ $badgeRemoveSizeClass }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m16 8-8 8m0-8 8 8" />
                    </svg>
                </button>
            </span>
        </template>

        {{-- Free-text Inline Input --}}
        <input
            type="text"
            id="{{ $id }}-input"
            x-ref="textInput"
            x-model="inputValue"
            @input="handleInput($event)"
            @keydown="handleKeydown($event)"
            @paste="handlePaste($event)"
            @blur="addFromInput()"
            :placeholder="items.length === 0 ? '{{ addslashes($placeholder) }}' : ''"
            :disabled="disabled || (max !== null && items.length >= max)"
            @if($isReadonly) readonly @endif
            class="flex-1 min-w-25 bg-transparent text-foreground placeholder:text-muted-foreground focus:outline-none border-none p-0 text-sm font-medium leading-none"
        />

        {{-- Trailing Actions: Copy All & Clear All --}}
        <div class="ml-auto flex items-center gap-1 shrink-0" @click.stop>
            @if ($copyable)
                <button
                    type="button"
                    @click="copyAll()"
                    x-show="items.length > 0"
                    x-cloak
                    :title="copied ? 'Tersalin!' : 'Salin Semua'"
                    class="p-1 rounded-md text-muted-foreground hover:text-foreground hover:bg-muted transition-colors cursor-pointer"
                >
                    <template x-if="!copied">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 12.9V17c0 3-1.7 4-4 4H7c-2.3 0-4-1-4-4v-5c0-3 1.7-4 4-4h1" />
                            <path d="M17 7.1V7c0-3-1.7-4-4-4H8" />
                        </svg>
                    </template>
                    <template x-if="copied">
                        <svg class="size-3.5 text-success" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 12.611 8.923 17.5 20 6.5" />
                        </svg>
                    </template>
                </button>
            @endif

            @if ($clearable)
                <button
                    type="button"
                    @click="clearAll()"
                    x-show="items.length > 0 && !disabled && !readonly"
                    x-cloak
                    title="Hapus Semua"
                    class="p-1 rounded-md text-muted-foreground hover:text-destructive hover:bg-destructive/10 transition-colors cursor-pointer"
                >
                    <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="m14.5 9.5-5 5m0-5 5 5" />
                    </svg>
                </button>
            @endif
        </div>

        {{-- Hidden Input(s) for Native Form POST & vibe:form --}}
        @if ($postFormat === 'array')
            <template x-for="item in items" :key="'post-' + item">
                <input type="hidden" name="{{ $name }}[]" :value="item" />
            </template>
            <input 
                type="hidden" 
                id="{{ $id }}" 
                x-ref="hiddenInput" 
                :value="items.join(actualPostSeparator)" 
                @if($wireModel) wire:model="{{ $wireModel }}" @endif 
                @if($hasError) aria-invalid="true" @endif 
            />
        @elseif ($postFormat === 'json')
            <input 
                type="hidden" 
                id="{{ $id }}" 
                @if($name) name="{{ $name }}" @endif 
                x-ref="hiddenInput" 
                :value="JSON.stringify(items)" 
                @if($wireModel) wire:model="{{ $wireModel }}" @endif 
                @if($hasError) aria-invalid="true" @endif 
            />
        @else
            {{-- Default: string terpisah post-separator (misal: laravel,nextjs,php) --}}
            <input 
                type="hidden" 
                id="{{ $id }}" 
                @if($name) name="{{ $name }}" @endif 
                x-ref="hiddenInput" 
                :value="items.join(actualPostSeparator)" 
                @if($wireModel) wire:model="{{ $wireModel }}" @endif 
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
