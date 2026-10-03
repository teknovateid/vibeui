@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'description' => null,
    'size' => 'md', // xs, sm, md, lg, xl
    'variant' => 'primary', // primary, outline, filled, flush, ghost
    'placeholder' => null,
    'searchable' => false,
    'searchPlaceholder' => null,
    'disabled' => false,
    'error' => null,
    'errorName' => null,
    'info' => null,
    'wrapperClass' => null,
    'options' => null,
    'value' => null,
    'placement' => 'auto', // auto, bottom, top
    'keyboard' => false,
    'multiple' => false,
    'separator' => null,
    'badgeVariant' => 'secondary', // secondary, primary, outline, cycle
    'colorCycle' => ['info', 'primary', 'success', 'warning', 'secondary', 'purple'],
    'min' => null,
    'max' => null,
    'clearable' => false,
])

@php
    $placeholder = $placeholder ?? __('vibe/select.placeholder');
    $searchPlaceholder = $searchPlaceholder ?? __('vibe/select.search_placeholder');
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ?? uniqid('select-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = $error && !is_bool($error) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $baseClasses = 'relative w-full flex items-center justify-between text-left transition-colors duration-150 focus:outline-none focus-visible:outline-none select-none cursor-pointer disabled:pointer-events-none disabled:opacity-50 disabled:bg-muted/40 disabled:cursor-not-allowed';

    $prClass = match ($size) {
        'xs' => $clearable ? 'pr-11' : 'pr-7',
        'sm' => $clearable ? 'pr-12' : 'pr-8',
        'md' => $clearable ? 'pr-14' : 'pr-9',
        'lg' => $clearable ? 'pr-15' : 'pr-10',
        'xl' => $clearable ? 'pr-16' : 'pr-11',
        default => $clearable ? 'pr-14' : 'pr-9',
    };

    $sizeClasses = match ($size) {
        'xs' => ($multiple ? 'min-h-7.5 py-1' : 'h-7') . " text-xs rounded-md pl-2.5 {$prClass} gap-1",
        'sm' => ($multiple ? 'min-h-8.5 py-1' : 'h-8') . " text-xs rounded-md pl-3 {$prClass} gap-1.5",
        'md' => ($multiple ? 'min-h-10 py-1.5' : 'h-9') . " text-sm rounded-lg pl-3.5 {$prClass} gap-2",
        'lg' => ($multiple ? 'min-h-11 py-2' : 'h-10') . " text-sm rounded-lg pl-4 {$prClass} gap-2",
        'xl' => ($multiple ? 'min-h-12 py-2' : 'h-11') . " text-base rounded-xl pl-4.5 {$prClass} gap-2.5",
        default => ($multiple ? 'min-h-10 py-1.5' : 'h-9') . " text-sm rounded-lg pl-3.5 {$prClass} gap-2",
    };

    if ($variant === 'flush') {
        $flushPr = match ($size) {
            'xs' => $clearable ? 'pr-9' : 'pr-5',
            'sm' => $clearable ? 'pr-10' : 'pr-6',
            'md' => $clearable ? 'pr-12' : 'pr-7',
            'lg' => $clearable ? 'pr-13' : 'pr-8',
            'xl' => $clearable ? 'pr-14' : 'pr-9',
            default => $clearable ? 'pr-12' : 'pr-7',
        };
        $sizeClasses = match ($size) {
            'xs' => ($multiple ? 'min-h-7.5 py-1' : 'h-7') . " text-xs px-0 rounded-none {$flushPr}",
            'sm' => ($multiple ? 'min-h-8.5 py-1' : 'h-8') . " text-xs px-0 rounded-none {$flushPr}",
            'md' => ($multiple ? 'min-h-10 py-1.5' : 'h-9') . " text-sm px-0 rounded-none {$flushPr}",
            'lg' => ($multiple ? 'min-h-11 py-2' : 'h-10') . " text-sm px-0 rounded-none {$flushPr}",
            'xl' => ($multiple ? 'min-h-12 py-2' : 'h-11') . " text-base px-0 rounded-none {$flushPr}",
            default => ($multiple ? 'min-h-10 py-1.5' : 'h-9') . " text-sm px-0 rounded-none {$flushPr}",
        };
    }

    $variantClasses = match ($variant) {
        'filled' => $hasError ? 'bg-destructive/10 border border-destructive text-destructive placeholder:text-destructive/50 focus:bg-background focus:border-destructive focus:ring-2 focus:ring-destructive/20 focus-visible:bg-background focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20' : 'bg-muted/60 border border-transparent text-foreground hover:bg-muted/80 focus:bg-background focus:border-primary focus:ring-2 focus:ring-primary/20 focus-visible:bg-background focus-visible:border-primary focus-visible:ring-2 focus-visible:ring-primary/20',
        'flush' => $hasError ? 'border-b border-destructive text-destructive placeholder:text-destructive/50 bg-transparent focus:border-destructive focus:ring-0 focus-visible:border-destructive focus-visible:ring-0' : 'border-b border-input text-foreground bg-transparent focus:border-primary focus:ring-0 focus-visible:border-primary focus-visible:ring-0',
        'ghost' => $hasError ? 'border-transparent text-destructive placeholder:text-destructive/50 bg-transparent focus:ring-2 focus:ring-destructive/20 focus-visible:ring-2 focus-visible:ring-destructive/20' : 'border-transparent text-foreground bg-transparent hover:bg-muted/40 focus:bg-transparent focus:ring-2 focus:ring-primary/20 focus-visible:bg-transparent focus-visible:ring-2 focus-visible:ring-primary/20',
        'outline' => $hasError ? 'border border-destructive bg-background text-destructive placeholder:text-destructive/50 focus:border-destructive focus:ring-2 focus:ring-destructive/20 focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20' : 'border border-input bg-background text-foreground shadow-2xs focus:border-ring focus:ring-2 focus:ring-ring/20 focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20',
        'primary' => $hasError ? 'border border-destructive bg-background text-destructive placeholder:text-destructive/50 focus:border-destructive focus:ring-2 focus:ring-destructive/20 focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20' : 'border border-input bg-background text-foreground shadow-2xs focus:border-primary focus:ring-2 focus:ring-primary/20 focus-visible:border-primary focus-visible:ring-2 focus-visible:ring-primary/20',
        default => $hasError ? 'border border-destructive bg-background text-destructive placeholder:text-destructive/50 focus:border-destructive focus:ring-2 focus:ring-destructive/20 focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20' : 'border border-input bg-background text-foreground shadow-2xs focus:border-primary focus:ring-2 focus:ring-primary/20 focus-visible:border-primary focus-visible:ring-2 focus-visible:ring-primary/20',
    };

    $activeOpenClasses = match ($variant) {
        'filled' => $hasError ? 'bg-background !border-destructive ring-2 ring-destructive/20' : 'bg-background !border-primary ring-2 ring-primary/20',
        'flush' => $hasError ? '!border-destructive ring-0' : '!border-primary ring-0',
        'ghost' => $hasError ? 'ring-2 ring-destructive/20' : 'ring-2 ring-primary/20',
        'outline' => $hasError ? '!border-destructive ring-2 ring-destructive/20' : '!border-ring ring-2 ring-ring/20',
        'primary' => $hasError ? '!border-destructive ring-2 ring-destructive/20' : '!border-primary ring-2 ring-primary/20',
        default => $hasError ? '!border-destructive ring-2 ring-destructive/20' : '!border-primary ring-2 ring-primary/20',
    };

    $chevronSize = match ($size) {
        'xs', 'sm' => 'size-3.5',
        'xl' => 'size-4.5',
        default => 'size-4',
    };

    $chevronRightPosition = match ($size) {
        'xs' => 'right-2',
        'sm' => 'right-2.5',
        'xl' => 'right-3.5',
        default => 'right-3',
    };

    $compiledClasses = trim("{$baseClasses} {$sizeClasses} {$variantClasses}");

    // Badge sizing based on select size (matching vibe:input.multiple)
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

    // Compute ARIA describedby IDs
    $describedBy = [];
    if ($hasError && $errorMessage) {
        $describedBy[] = "{$id}-error";
    } elseif ($description) {
        $describedBy[] = "{$id}-description";
    }
    if ($info && !$hasError) {
        $describedBy[] = "{$id}-info";
    }
    $describedByString = !empty($describedBy) ? implode(' ', $describedBy) : null;

    $wireModel = $attributes->wire('model');
    $wireModelName = $wireModel->value();
    $isWireLive = $wireModel->hasModifier('live');
@endphp

@php
    $initialSelectVal = $value ?? ($attributes->get('value') ?? '');
    if ($multiple) {
        if (is_array($initialSelectVal)) {
            $initialSelectVal = array_values($initialSelectVal);
        } elseif ($initialSelectVal !== null && $initialSelectVal !== '') {
            $initialSelectVal = $separator ? array_values(array_filter(array_map('trim', explode($separator, (string) $initialSelectVal)))) : [(string) $initialSelectVal];
        } else {
            $initialSelectVal = [];
        }
    }
@endphp

<div {{ $attributes->only('class')->twMerge(['class' => trim("w-full {$wrapperClass}")]) }} x-data="{
    open: false,
    search: '',
    value: @if ($wireModelName) $wire.entangle('{{ $wireModelName }}'){{ $isWireLive ? '.live' : '' }} @else @js($initialSelectVal) @endif,
    separator: @js($separator),
    badgeVariant: @js($badgeVariant),
    colorCycle: @js($colorCycle),
    selectedLabel: '',
    selectedAvatar: '',
    selectedIcon: '',
    selectedDescription: '',
    selectedItems: [],
    hasVisibleOptions: true,
    disabled: {{ $disabled ? 'true' : 'false' }},
    keyboard: {{ $keyboard ? 'true' : 'false' }},
    multiple: {{ $multiple ? 'true' : 'false' }},
    min: {{ $min !== null ? (int) $min : 'null' }},
    max: {{ $max !== null ? (int) $max : 'null' }},
    placement: '{{ $placement }}',
    openUp: {{ $placement === 'top' ? 'true' : 'false' }},

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
    },

    init() {
        this.$nextTick(() => {
            let isEmptyValue = this.value === '' || this.value === null || this.value === undefined || (Array.isArray(this.value) && this.value.length === 0);
            if (isEmptyValue && this.$refs.hiddenInput && this.$refs.hiddenInput.value) {
                if (this.multiple) {
                    if (this.separator && typeof this.$refs.hiddenInput.value === 'string') {
                        let parsed = this.$refs.hiddenInput.value.split(this.separator).map(s => s.trim()).filter(Boolean);
                        if (parsed.length > 0) {
                            this.value = parsed;
                            isEmptyValue = false;
                        }
                    } else {
                        try {
                            let parsed = JSON.parse(this.$refs.hiddenInput.value);
                            if (Array.isArray(parsed) && parsed.length > 0) {
                                this.value = parsed;
                                isEmptyValue = false;
                            }
                        } catch(e) {}
                    }
                } else {
                    this.value = this.$refs.hiddenInput.value;
                    isEmptyValue = false;
                }
            }
            if (isEmptyValue && this.$refs.optionsContainer) {
                let preselected = Array.from(this.$refs.optionsContainer.querySelectorAll('[data-selected=\'true\']'));
                if (preselected.length > 0) {
                    if (this.multiple) {
                        this.value = preselected.map(el => el.getAttribute('data-value'));
                    } else {
                        this.value = preselected[0].getAttribute('data-value');
                    }
                }
            }
            this.updateSelectionFromValue();
        });
        this.$watch('value', () => {
            this.updateSelectionFromValue();
        });
        this.$watch('search', () => {
            this.$nextTick(() => this.checkVisibility());
        });
    },

    selectOption(el) {
        if (!el) return;
        let val = el.getAttribute('data-value');
        let lbl = el.getAttribute('data-label') || el.innerText.trim();
        let av = el.getAttribute('data-avatar') || '';
        let ic = el.getAttribute('data-icon') || '';
        let desc = el.getAttribute('data-description') || '';
        this.select(val, lbl, av, ic, desc);
    },

    isSelected(val) {
        if (this.multiple) {
            return Array.isArray(this.value) && this.value.some(v => String(v) === String(val));
        }
        return String(this.value) === String(val);
    },

    canSelectMore() {
        if (!this.multiple) return true;
        if (this.max === null) return true;
        return Array.isArray(this.value) && this.value.length < this.max;
    },

    canDeselect() {
        if (!this.multiple) return true;
        if (this.min === null) return true;
        return Array.isArray(this.value) && this.value.length > this.min;
    },

    isOptionDisabled(val, isDisabled) {
        if (isDisabled) return true;
        if (this.multiple && this.max !== null && !this.isSelected(val) && !this.canSelectMore()) {
            return true;
        }
        return false;
    },

    removeTag(val) {
        if (this.disabled) return;
        if (this.min !== null && Array.isArray(this.value) && this.value.length <= this.min) {
            return;
        }
        let strVal = String(val);
        this.value = this.value.filter(v => String(v) !== strVal);
        this.updateSelectionFromValue();
        this.$nextTick(() => {
            this.dispatchChangeEvent();
        });
    },

    clearAll() {
        if (this.disabled) return;
        if (this.multiple) {
            if (this.min !== null && this.min > 0) {
                if (Array.isArray(this.value) && this.value.length > this.min) {
                    this.value = this.value.slice(0, this.min);
                    this.updateSelectionFromValue();
                    this.$nextTick(() => {
                        this.dispatchChangeEvent();
                    });
                }
                return;
            }
            this.value = [];
            this.updateSelectionFromValue();
            this.$nextTick(() => {
                this.dispatchChangeEvent();
            });
            return;
        }
        this.value = '';
        this.selectedLabel = '';
        this.selectedAvatar = '';
        this.selectedIcon = '';
        this.selectedDescription = '';
        this.updateSelectionFromValue();
        this.$nextTick(() => {
            this.dispatchChangeEvent();
        });
    },

    dispatchChangeEvent() {
        if (this.$refs.hiddenInput) {
            this.$refs.hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
            this.$refs.hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
        }
    },

    handleHiddenInput(el) {
        if (!el) return;
        if (this.multiple) {
            if (this.separator && typeof el.value === 'string') {
                let p = el.value ? el.value.split(this.separator).map(s => s.trim()).filter(Boolean) : [];
                if (JSON.stringify(p) !== JSON.stringify(this.value)) {
                    this.value = p;
                    this.updateSelectionFromValue();
                }
            } else {
                try {
                    let p = JSON.parse(el.value);
                    if (Array.isArray(p) && JSON.stringify(p) !== JSON.stringify(this.value)) {
                        this.value = p;
                        this.updateSelectionFromValue();
                    }
                } catch(e) {}
            }
        } else {
            if (this.value !== el.value) {
                this.value = el.value;
                this.updateSelectionFromValue();
            }
        }
    },

    updateSelectionFromValue() {
        if (this.multiple) {
            if (!Array.isArray(this.value)) {
                if (this.separator && typeof this.value === 'string') {
                    this.value = this.value ? this.value.split(this.separator).map(s => s.trim()).filter(Boolean) : [];
                } else {
                    this.value = this.value !== null && this.value !== undefined && this.value !== '' ? [this.value] : [];
                }
            }
            let items = [];
            this.value.forEach(val => {
                let strVal = String(val);
                let el = this.$refs.optionsContainer ? this.$refs.optionsContainer.querySelector(`[data-value='${strVal}']`) : null;
                if (el) {
                    items.push({
                        value: val,
                        label: el.getAttribute('data-label') || el.innerText.trim(),
                        avatar: el.getAttribute('data-avatar') || '',
                        icon: el.getAttribute('data-icon') || '',
                        description: el.getAttribute('data-description') || ''
                    });
                } else {
                    items.push({
                        value: val,
                        label: String(val),
                        avatar: '',
                        icon: '',
                        description: ''
                    });
                }
            });
            this.selectedItems = items;
            return;
        }

        if (this.value === '' || this.value === null || this.value === undefined) {
            this.selectedLabel = '';
            this.selectedAvatar = '';
            this.selectedIcon = '';
            this.selectedDescription = '';
            return;
        }
        let el = this.$refs.optionsContainer ? this.$refs.optionsContainer.querySelector(`[data-value='${this.value}']`) : null;
        if (el) {
            this.selectedLabel = el.getAttribute('data-label') || el.innerText.trim();
            this.selectedAvatar = el.getAttribute('data-avatar') || '';
            this.selectedIcon = el.getAttribute('data-icon') || '';
            this.selectedDescription = el.getAttribute('data-description') || '';
        }
    },

    select(val, lbl, av, ic, desc) {
        if (this.disabled) return;
        if (this.isOptionDisabled(val, false)) return;

        if (this.multiple) {
            if (!Array.isArray(this.value)) {
                this.value = [];
            }
            let strVal = String(val);
            let exists = this.value.some(v => String(v) === strVal);

            if (exists) {
                if (this.min !== null && this.value.length <= this.min) {
                    return;
                }
                this.value = this.value.filter(v => String(v) !== strVal);
            } else {
                if (this.max !== null && this.value.length >= this.max) {
                    return;
                }
                this.value.push(val);
            }
            this.updateSelectionFromValue();
            this.$nextTick(() => {
                this.dispatchChangeEvent();
            });
            return;
        }

        this.value = val;
        this.selectedLabel = lbl;
        this.selectedAvatar = av || '';
        this.selectedIcon = ic || '';
        this.selectedDescription = desc || '';
        this.open = false;
        this.search = '';

        this.$nextTick(() => {
            this.dispatchChangeEvent();
        });
    },

    checkVisibility() {
        if (!this.$refs.optionsContainer) return;
        let options = Array.from(this.$refs.optionsContainer.querySelectorAll('[data-select-option]'));
        if (options.length === 0) {
            this.hasVisibleOptions = false;
            return;
        }
        let q = (this.search || '').toLowerCase().trim();
        if (!q) {
            this.hasVisibleOptions = true;
            return;
        }
        let anyVisible = options.some(el => {
            if (el.style.display === 'none') return false;
            let val = (el.getAttribute('data-value') || '').toLowerCase();
            let lbl = (el.getAttribute('data-label') || el.innerText || '').toLowerCase();
            return val.includes(q) || lbl.includes(q);
        });
        this.hasVisibleOptions = anyVisible;
    },

    calculatePlacement() {
        if (this.placement === 'top') {
            this.openUp = true;
            return;
        }
        if (this.placement === 'bottom') {
            this.openUp = false;
            return;
        }
        // Dynamic auto placement
        let trigger = this.$refs.triggerBtn || this.$el;
        let rect = trigger.getBoundingClientRect();
        let spaceBelow = window.innerHeight - rect.bottom;
        let spaceAbove = rect.top;
        let popoverHeight = 250;

        this.openUp = spaceBelow < popoverHeight && spaceAbove > spaceBelow;
    },

    toggle() {
        if (this.disabled) return;
        this.open = !this.open;
        if (this.open) {
            this.search = '';
            this.hasVisibleOptions = true;
            this.calculatePlacement();
            this.$nextTick(() => {
                this.calculatePlacement();
                if (this.$refs.searchInput) {
                    this.$refs.searchInput.focus();
                } else if (this.keyboard) {
                    this.focusNext();
                }
                this.checkVisibility();
            });
        }
    },

    getVisibleItems() {
        return Array.from(this.$refs.optionsContainer ? this.$refs.optionsContainer.querySelectorAll('[role=\'option\']:not([disabled]):not(.cursor-not-allowed)') : [])
            .filter(el => el.offsetWidth > 0 || el.offsetHeight > 0);
    },

    focusNext(e) {
        if (!this.open) return;
        e?.preventDefault();
        let items = this.getVisibleItems();
        if (!items.length) return;
        let currentIndex = items.indexOf(document.activeElement);
        let nextIndex = Math.min(currentIndex + 1, items.length - 1);
        if (items[nextIndex]) {
            items[nextIndex].focus();
            items[nextIndex].scrollIntoView({ block: 'nearest' });
        }
    },

    focusPrevious(e) {
        if (!this.open) return;
        e?.preventDefault();
        let items = this.getVisibleItems();
        if (!items.length) return;
        let currentIndex = items.indexOf(document.activeElement);
        if (currentIndex <= 0) {
            if (this.$refs.searchInput) {
                this.$refs.searchInput.focus();
                return;
            }
            currentIndex = items.length;
        }
        let nextIndex = Math.max(currentIndex - 1, 0);
        if (items[nextIndex]) {
            items[nextIndex].focus();
            items[nextIndex].scrollIntoView({ block: 'nearest' });
        }
    },

    close() {
        this.open = false;
        this.search = '';
    }
}" @click.outside="close()" @keydown.escape.window="close()" @scroll.window.debounce.50ms="open ? calculatePlacement() : null" @resize.window.debounce.50ms="open ? calculatePlacement() : null" @if ($keyboard)
    @keydown.up.window="focusPrevious($event)"
    @keydown.down.window="focusNext($event)"
    @endif
    >
    {{-- Label --}}
    @if ($label)
        <label for="{{ $id }}-trigger" class="block text-xs font-semibold text-foreground mb-1.5 select-none">
            {{ $label }}
            @if ($attributes->has('required') && $attributes->get('required') !== false)
                <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    {{-- Description --}}
    @if ($description)
        <p id="{{ $id }}-description" class="mb-1.5 text-xs text-muted-foreground">{{ $description }}</p>
    @endif

    {{-- Hidden input(s) for native form compatibility --}}
    @if ($multiple)
        @if ($separator)
            <input type="hidden" id="{{ $id }}" name="{{ $name }}" :value="Array.isArray(value) ? value.join('{{ $separator }}') : (value || '')" x-ref="hiddenInput" @input="handleHiddenInput($el)" @change="handleHiddenInput($el)" />
        @else
            <template x-for="val in value" :key="val">
                <input type="hidden" name="{{ $name }}[]" :value="val" />
            </template>
            <input type="hidden" id="{{ $id }}" x-ref="hiddenInput" :value="JSON.stringify(value)" @input="handleHiddenInput($el)" @change="handleHiddenInput($el)" />
        @endif
    @else
        <input type="hidden" id="{{ $id }}" name="{{ $name }}" :value="value" x-ref="hiddenInput" @input="handleHiddenInput($el)" @change="handleHiddenInput($el)" />
    @endif

    {{-- Trigger & Popover Wrapper --}}
    <div class="relative">
        {{-- Trigger Element (Visual Parity with vibe:input) --}}
        <div role="combobox" tabindex="0" x-ref="triggerBtn" id="{{ $id }}-trigger" @click="toggle()" :aria-disabled="disabled" :class="{ 'pointer-events-none opacity-50': disabled, '{{ $activeOpenClasses }}': open }" @if ($hasError) aria-invalid="true" @endif @if ($describedByString) aria-describedby="{{ $describedByString }}" @endif aria-haspopup="listbox" :aria-expanded="open" @if ($keyboard) @keydown.down.stop.prevent="if (!open) { toggle(); } else { focusNext($event); }"
                @keydown.up.stop.prevent="if (!open) { toggle(); } else { focusPrevious($event); }" @endif {{ $attributes->twMerge(['class' => $compiledClasses]) }}>
            {{-- Content Display --}}
            @if ($multiple)
                <div class="flex flex-wrap items-center gap-1.5 py-0.5 flex-1 min-w-0">
                    <template x-if="selectedItems.length === 0">
                        <span class="text-muted-foreground truncate">{{ $placeholder }}</span>
                    </template>

                    <template x-for="(item, index) in selectedItems" :key="item.value">
                        <span 
                            class="inline-flex items-center font-medium border select-none transition-colors shrink-0 max-w-full {{ $badgeSizeClass }}"
                            :class="getBadgeClasses(index)"
                        >
                            <template x-if="item.avatar">
                                <img :src="item.avatar" class="size-3.5 rounded-full object-cover shrink-0" alt="" />
                            </template>
                            <template x-if="!item.avatar && item.icon">
                                <span class="size-3 shrink-0 flex items-center justify-center [&>svg]:size-3" x-html="item.icon"></span>
                            </template>
                            <span x-text="item.label" class="truncate max-w-44 sm:max-w-56"></span>
                            <button 
                                type="button" 
                                @click.stop="removeTag(item.value)" 
                                :disabled="disabled || (min !== null && value.length <= min)" 
                                :class="{ 'opacity-30 cursor-not-allowed': min !== null && value.length <= min }" 
                                class="hover:text-destructive hover:bg-destructive/10 rounded-xs p-0.5 transition-colors cursor-pointer shrink-0" 
                                aria-label="{{ __('vibe/select.remove_tag') }}"
                            >
                                <svg class="{{ $badgeRemoveSizeClass }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m16 8-8 8m0-8 8 8" />
                                </svg>
                            </button>
                        </span>
                    </template>
                </div>
            @else
                <span class="flex items-center gap-2 min-w-0 truncate">
                    {{-- Dynamic Avatar or Icon when an option is selected --}}
                    <template x-if="selectedAvatar">
                        <img :src="selectedAvatar" class="size-5 rounded-full object-cover shrink-0" alt="" />
                    </template>
                    <template x-if="!selectedAvatar && selectedIcon">
                        <span class="size-4 shrink-0 flex items-center justify-center [&>svg]:size-4" x-html="selectedIcon"></span>
                    </template>

                    {{-- Selected Label or Placeholder --}}
                    <span x-text="selectedLabel || '{{ addslashes($placeholder) }}'" :class="!selectedLabel ? 'text-muted-foreground' : 'text-foreground font-medium'" class="truncate"></span>
                </span>
            @endif

            {{-- Clear Button & Chevron --}}
            <div class="pointer-events-auto absolute inset-y-0 {{ $chevronRightPosition }} flex items-center gap-1 text-muted-foreground">
                @if ($clearable)
                    <button
                        x-cloak
                        x-show="(multiple ? (value && value.length > 0) : (value !== '' && value !== null && value !== undefined)) && !disabled"
                        type="button"
                        @click.stop="clearAll()"
                        class="size-4 hover:text-foreground inline-flex items-center justify-center transition-colors cursor-pointer mr-0.5"
                        aria-label="{{ __('vibe/select.clear') ?? 'Clear' }}">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="m14.5 9.5-5 5m0-5 5 5" />
                        </svg>
                    </button>
                @endif
                <svg class="{{ $chevronSize }} shrink-0 transition-transform duration-200 pointer-events-none" :class="{ 'rotate-180 {{ $hasError ? 'text-destructive' : 'text-primary' }}': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m19 9-7 6-7-6" />
                </svg>
            </div>
        </div>

        {{-- Dropdown Popover --}}
        <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 right-0 z-50 rounded-xl border border-border bg-popover text-popover-foreground shadow-xl overflow-hidden focus:outline-none" :class="openUp ? 'bottom-full mb-1.5' : 'top-full mt-1.5'" style="display: none;">
            {{-- Search Field (if searchable) --}}
            @if ($searchable)
                <div class="p-2 border-b border-border bg-muted/20">
                    <div class="relative flex items-center">
                        <svg class="size-3.5 absolute left-2.5 text-muted-foreground pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11.5" cy="11.5" r="9.5" />
                            <path d="m20 20-2-2" />
                        </svg>
                        <input x-ref="searchInput" x-model="search" type="text" placeholder="{{ $searchPlaceholder }}" class="w-full h-9 sm:h-8 pl-8 pr-7 text-sm sm:text-xs rounded-lg border border-input bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 focus-visible:outline-none focus-visible:border-primary focus-visible:ring-2 focus-visible:ring-primary/20 transition-colors" @keydown.escape.stop="close()" @if ($keyboard) @keydown.down.stop.prevent="focusNext($event)"
                                @keydown.up.stop.prevent=""
                                @keydown.enter.stop.prevent="let items = getVisibleItems(); if (items[0]) { items[0].click(); }" @endif />
                        <button x-show="search.length > 0" @click="search = ''; $refs.searchInput.focus()" type="button" class="absolute right-2 text-muted-foreground hover:text-foreground size-4 flex items-center justify-center cursor-pointer">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <path d="m14.5 9.5-5 5m0-5 5 5" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            {{-- Multi-Select Counter / Limit Banner --}}
            @if ($multiple)
                <div class="px-3 py-1.5 text-xs font-medium border-b border-border bg-muted/30 flex items-center justify-between select-none">
                    <span class="text-muted-foreground">
                        {{ __('vibe/select.selected_count') }}
                        <span x-text="value.length" class="font-bold text-foreground"></span>
                        @if ($max)
                            / <span>{{ $max }}</span>
                        @endif
                    </span>

                    <div class="flex items-center gap-2">
                        @if ($min)
                            <span x-show="value.length < {{ $min }}" class="text-[11px] text-muted-foreground font-medium">
                                {{ __('vibe/select.min_limit', ['min' => $min]) }}
                            </span>
                        @endif
                        @if ($max)
                            <span x-show="value.length >= {{ $max }}" class="text-[11px] text-muted-foreground font-medium">
                                {{ __('vibe/select.max_reached') }}
                            </span>
                        @endif
                        <button x-show="value.length > 0 && (!min || value.length > min)" type="button" @click.stop="clearAll()" class="text-[11px] text-muted-foreground hover:text-destructive transition-colors cursor-pointer">
                            {{ __('vibe/select.reset') }}
                        </button>
                    </div>
                </div>
            @endif

            {{-- Options List Container --}}
            <div x-ref="optionsContainer" role="listbox" class="max-h-52 overflow-y-auto p-1 space-y-0.5 vibe-scrollbar focus:outline-none">
                {{-- Render options passed via prop array --}}
                @if (!empty($options))
                    @foreach ($options as $optKey => $optVal)
                        @php
                            $optValue = is_array($optVal) ? $optVal['value'] ?? $optKey : $optKey;
                            $optLabel = is_array($optVal) ? $optVal['label'] ?? ($optVal['name'] ?? $optKey) : $optVal;
                            $optDesc = is_array($optVal) ? $optVal['description'] ?? ($optVal['desc'] ?? null) : null;
                            $optAvatar = is_array($optVal) ? $optVal['avatar'] ?? null : null;
                            $optIcon = is_array($optVal) ? $optVal['icon'] ?? null : null;
                            $optDisabled = is_array($optVal) ? $optVal['disabled'] ?? false : false;
                            $optSelected = is_array($optVal) ? $optVal['selected'] ?? false : false;
                        @endphp
                        <vibe:select.option :value="$optValue" :label="$optLabel" :description="$optDesc" :avatar="$optAvatar" :icon="$optIcon" :disabled="$optDisabled" :selected="$optSelected" />
                    @endforeach
                @endif

                {{-- Slot for <vibe:select.option> or <vibe:select.group> --}}
                {{ $slot }}

                {{-- Empty Search Results Message --}}
                <div x-cloak x-show="!hasVisibleOptions" class="py-6 px-3 text-center text-xs text-muted-foreground">
                    <svg class="size-6 mx-auto mb-1.5 text-muted-foreground/50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11.5" cy="11.5" r="9.5" />
                        <path d="m20 20-2-2" />
                        <path d="M9 11.5h5" />
                    </svg>
                    <span>{{ __('vibe/select.no_options') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Error Message --}}
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
