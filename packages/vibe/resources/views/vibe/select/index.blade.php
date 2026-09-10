@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'description' => null,
    'size' => 'md', // sm, md, lg, xl
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
    'min' => null,
    'max' => null,
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

    $sizeClasses = match ($size) {
        'sm' => ($multiple ? 'min-h-8 py-1' : 'h-8') . ' text-xs rounded-md pl-3 pr-8 gap-1.5',
        'md' => ($multiple ? 'min-h-9 py-1.5' : 'h-9') . ' text-sm rounded-lg pl-3.5 pr-9 gap-2',
        'lg' => ($multiple ? 'min-h-10 py-1.5' : 'h-10') . ' text-sm rounded-lg pl-4 pr-10 gap-2',
        'xl' => ($multiple ? 'min-h-11 py-2' : 'h-11') . ' text-base rounded-xl pl-5 pr-11 gap-2.5',
        default => ($multiple ? 'min-h-9 py-1.5' : 'h-9') . ' text-sm rounded-lg pl-3.5 pr-9 gap-2',
    };

    if ($variant === 'flush') {
        $sizeClasses = match ($size) {
            'sm' => ($multiple ? 'min-h-8 py-1' : 'h-8') . ' text-xs px-0 rounded-none pr-6',
            'md' => ($multiple ? 'min-h-9 py-1.5' : 'h-9') . ' text-sm px-0 rounded-none pr-7',
            'lg' => ($multiple ? 'min-h-10 py-1.5' : 'h-10') . ' text-sm px-0 rounded-none pr-8',
            'xl' => ($multiple ? 'min-h-11 py-2' : 'h-11') . ' text-base px-0 rounded-none pr-9',
            default => ($multiple ? 'min-h-9 py-1.5' : 'h-9') . ' text-sm px-0 rounded-none pr-7',
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
        'sm' => 'size-3.5',
        'xl' => 'size-4.5',
        default => 'size-4',
    };

    $chevronRightPosition = match ($size) {
        'sm' => 'right-2.5',
        'xl' => 'right-3.5',
        default => 'right-3',
    };

    $compiledClasses = trim("{$baseClasses} {$sizeClasses} {$variantClasses}");

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

<div {{ $attributes->only('class')->twMerge(['class' => trim("w-full {$wrapperClass}")]) }} x-data="{
    open: false,
    search: '',
    value: @if ($wireModelName) $wire.entangle('{{ $wireModelName }}'){{ $isWireLive ? '.live' : '' }} @else @js($multiple ? (is_array($value) ? array_values($value) : ($value !== null && $value !== '' ? [(string) $value] : [])) : $value ?? ($attributes->get('value') ?? '')) @endif,
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

    init() {
        this.$nextTick(() => {
            let isEmptyValue = this.value === '' || this.value === null || this.value === undefined || (Array.isArray(this.value) && this.value.length === 0);
            if (isEmptyValue && this.$refs.hiddenInput && this.$refs.hiddenInput.value) {
                try {
                    if (this.multiple) {
                        let parsed = JSON.parse(this.$refs.hiddenInput.value);
                        if (Array.isArray(parsed) && parsed.length > 0) {
                            this.value = parsed;
                            isEmptyValue = false;
                        }
                    } else {
                        this.value = this.$refs.hiddenInput.value;
                        isEmptyValue = false;
                    }
                } catch(e) {
                    if (!this.multiple) {
                        this.value = this.$refs.hiddenInput.value;
                        isEmptyValue = false;
                    }
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
        if (this.min !== null && this.min > 0) {
            // Trim down to minimum required items (keep first min items)
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
    },

    dispatchChangeEvent() {
        if (this.$refs.hiddenInput) {
            this.$refs.hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
            this.$refs.hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
        }
    },

    updateSelectionFromValue() {
        if (this.multiple) {
            if (!Array.isArray(this.value)) {
                this.value = this.value !== null && this.value !== undefined && this.value !== '' ? [this.value] : [];
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
        <template x-for="val in value" :key="val">
            <input type="hidden" name="{{ $name }}[]" :value="val" />
        </template>
        <input type="hidden" id="{{ $id }}" x-ref="hiddenInput" :value="JSON.stringify(value)" @input="try { let p = JSON.parse($el.value); if (Array.isArray(p)) { value = p; updateSelectionFromValue(); } } catch(e) {}" @change="try { let p = JSON.parse($el.value); if (Array.isArray(p)) { value = p; updateSelectionFromValue(); } } catch(e) {}" />
    @else
        <input type="hidden" id="{{ $id }}" name="{{ $name }}" :value="value" x-ref="hiddenInput" @input="if (value !== $el.value) { value = $el.value; updateSelectionFromValue(); }" @change="if (value !== $el.value) { value = $el.value; updateSelectionFromValue(); }" />
    @endif

    {{-- Trigger & Popover Wrapper --}}
    <div class="relative">
        {{-- Trigger Button (Visual Parity with vibe:input) --}}
        <button type="button" x-ref="triggerBtn" id="{{ $id }}-trigger" @click="toggle()" :disabled="disabled" @if ($hasError) aria-invalid="true" @endif @if ($describedByString) aria-describedby="{{ $describedByString }}" @endif aria-haspopup="listbox" :aria-expanded="open" :class="open ? '{{ $activeOpenClasses }}' : ''" @if ($keyboard) @keydown.down.stop.prevent="if (!open) { toggle(); } else { focusNext($event); }"
                @keydown.up.stop.prevent="if (!open) { toggle(); } else { focusPrevious($event); }" @endif {{ $attributes->twMerge(['class' => $compiledClasses]) }}>
            {{-- Content Display --}}
            @if ($multiple)
                <div class="flex flex-wrap items-center gap-1.5 py-0.5 max-w-[calc(100%-2rem)]">
                    <template x-if="selectedItems.length === 0">
                        <span class="text-muted-foreground truncate">{{ $placeholder }}</span>
                    </template>

                    <template x-for="item in selectedItems" :key="item.value">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-xs font-medium bg-muted/80 text-foreground border border-border/70 shadow-2xs">
                            <template x-if="item.avatar">
                                <img :src="item.avatar" class="size-3.5 rounded-full object-cover shrink-0" alt="" />
                            </template>
                            <template x-if="!item.avatar && item.icon">
                                <span class="size-3 shrink-0 flex items-center justify-center [&>svg]:size-3" x-html="item.icon"></span>
                            </template>
                            <span x-text="item.label" class="truncate max-w-30"></span>
                            <button type="button" @click.stop="removeTag(item.value)" :disabled="disabled || (min !== null && value.length <= min)" :class="{ 'opacity-30 cursor-not-allowed': min !== null && value.length <= min }" class="hover:text-destructive hover:bg-destructive/10 rounded-xs p-0.5 text-muted-foreground transition-colors cursor-pointer" aria-label="{{ __('vibe/select.remove_tag') }}">
                                <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18" />
                                    <path d="m6 6 12 12" />
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

            {{-- Custom Animated Chevron Indicator --}}
            <div class="pointer-events-none absolute inset-y-0 {{ $chevronRightPosition }} flex items-center text-muted-foreground">
                <svg class="{{ $chevronSize }} shrink-0 transition-transform duration-200" :class="{ 'rotate-180 {{ $hasError ? 'text-destructive' : 'text-primary' }}': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </div>
        </button>

        {{-- Dropdown Popover --}}
        <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 right-0 z-50 rounded-xl border border-border bg-popover text-popover-foreground shadow-xl overflow-hidden focus:outline-none" :class="openUp ? 'bottom-full mb-1.5' : 'top-full mt-1.5'" style="display: none;">
            {{-- Search Field (if searchable) --}}
            @if ($searchable)
                <div class="p-2 border-b border-border bg-muted/20">
                    <div class="relative flex items-center">
                        <svg class="size-3.5 absolute left-2.5 text-muted-foreground pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.3-4.3" />
                        </svg>
                        <input x-ref="searchInput" x-model="search" type="text" placeholder="{{ $searchPlaceholder }}" class="w-full h-8 pl-8 pr-7 text-xs rounded-lg border border-input bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 focus-visible:outline-none focus-visible:border-primary focus-visible:ring-2 focus-visible:ring-primary/20 transition-colors" @keydown.escape.stop="close()" @if ($keyboard) @keydown.down.stop.prevent="focusNext($event)"
                                @keydown.up.stop.prevent=""
                                @keydown.enter.stop.prevent="let items = getVisibleItems(); if (items[0]) { items[0].click(); }" @endif />
                        <button x-show="search.length > 0" @click="search = ''; $refs.searchInput.focus()" type="button" class="absolute right-2 text-muted-foreground hover:text-foreground size-4 flex items-center justify-center cursor-pointer">
                            <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
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
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" x2="16.65" y1="21" y2="16.65" />
                        <line x1="8" x2="14" y1="11" y2="11" />
                    </svg>
                    <span>{{ __('vibe/select.no_options') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Error Message --}}
    @if ($hasError && $errorMessage)
        <p id="{{ $id }}-error" role="alert" class="mt-1.5 text-xs font-medium text-destructive flex items-center gap-1">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" x2="12" y1="8" y2="12" />
                <line x1="12" x2="12.01" y1="16" y2="16" />
            </svg>
            <span>{{ $errorMessage }}</span>
        </p>
    @elseif ($info)
        <p id="{{ $id }}-info" class="mt-1.5 text-xs text-muted-foreground">{{ $info }}</p>
    @endif
</div>
