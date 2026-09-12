@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'description' => null,
    'size' => 'md', // sm, md, lg, xl
    'variant' => 'primary', // primary, outline, filled, flush, ghost
    'placeholder' => null,
    'searchPlaceholder' => null,
    'disabled' => false,
    'error' => null,
    'errorName' => null,
    'info' => null,
    'wrapperClass' => null,
    'value' => null,
    'placement' => 'auto', // auto, bottom, top
    'keyboard' => false,
    'multiple' => false,
    'min' => null,
    'max' => null,
    'clearable' => false,
    // Remote-specific props:
    'api' => null,
    'searchParam' => 'q',
    'minChars' => 0,
    'debounce' => 300,
    'headers' => [],
    'initialLabel' => null,
    'initialAvatar' => null,
    'initialIcon' => null,
])

@php
    $placeholder = $placeholder ?? __('vibe/select.placeholder');
    $searchPlaceholder = $searchPlaceholder ?? __('vibe/select.search_placeholder');
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ?? uniqid('select-remote-'));
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

    if ($value instanceof \Illuminate\Support\Collection) {
        $value = $value->toArray();
    }

    $initialItemsData = [];
    if (is_array($value)) {
        if (isset($value['value']) || isset($value['id']) || isset($value['label'])) {
            $val = (string) ($value['value'] ?? $value['id'] ?? '');
            $lbl = (string) ($value['label'] ?? $value['name'] ?? $value['title'] ?? $val);
            $initialItemsData[] = [
                'value' => $val,
                'label' => $lbl,
                'description' => $value['description'] ?? $value['desc'] ?? null,
                'avatar' => $value['avatar'] ?? (isset($value['icon']) && (str_starts_with((string) $value['icon'], 'http') || str_starts_with((string) $value['icon'], '/') || str_starts_with((string) $value['icon'], 'data:')) ? $value['icon'] : null),
                'icon' => $value['icon'] ?? $value['avatar'] ?? null,
            ];
            $value = $multiple ? [$val] : $val;
            if (!$initialLabel) {
                $initialLabel = $lbl;
            }
        } else {
            $first = reset($value);
            if (is_array($first) || is_object($first)) {
                $extractedValues = [];
                foreach ($value as $item) {
                    $itemArr = (array) $item;
                    $val = (string) ($itemArr['value'] ?? $itemArr['id'] ?? '');
                    $lbl = (string) ($itemArr['label'] ?? $itemArr['name'] ?? $itemArr['title'] ?? $val);
                    $extractedValues[] = $val;
                    $initialItemsData[] = [
                        'value' => $val,
                        'label' => $lbl,
                        'description' => $itemArr['description'] ?? $itemArr['desc'] ?? null,
                        'avatar' => $itemArr['avatar'] ?? (isset($itemArr['icon']) && (str_starts_with((string) $itemArr['icon'], 'http') || str_starts_with((string) $itemArr['icon'], '/') || str_starts_with((string) $itemArr['icon'], 'data:')) ? $itemArr['icon'] : null),
                        'icon' => $itemArr['icon'] ?? $itemArr['avatar'] ?? null,
                    ];
                }
                $value = $multiple ? $extractedValues : ($extractedValues[0] ?? '');
                if (!$initialLabel && !empty($initialItemsData)) {
                    $initialLabel = $multiple ? array_column($initialItemsData, 'label') : $initialItemsData[0]['label'];
                }
            }
        }
    }
@endphp

<div {{ $attributes->only('class')->twMerge(['class' => trim("w-full {$wrapperClass}")]) }}
    x-data="{
        open: false,
        search: '',
        value: @if ($wireModelName) $wire.entangle('{{ $wireModelName }}'){{ $isWireLive ? '.live' : '' }} @else @js($multiple ? (is_array($value) ? array_map('strval', array_values($value)) : ($value !== null && $value !== '' ? [(string) $value] : [])) : ($value !== null && $value !== '' ? (string) $value : '')) @endif,
        selectedLabel: @js($initialLabel ?? ''),
        selectedAvatar: @js($initialAvatar ?? ''),
        selectedIcon: @js($initialIcon ?? ''),
        selectedItems: @js($initialItemsData),
        items: [],
        loading: false,
        hasLoadedOnce: false,
        hasNetworkError: false,
        disabled: {{ $disabled ? 'true' : 'false' }},
        keyboard: {{ $keyboard ? 'true' : 'false' }},
        multiple: {{ $multiple ? 'true' : 'false' }},
        min: {{ $min !== null ? (int) $min : 'null' }},
        max: {{ $max !== null ? (int) $max : 'null' }},
        api: '{{ $api }}',
        searchParam: '{{ $searchParam }}',
        minChars: {{ (int) $minChars }},
        debounce: {{ (int) $debounce }},
        placement: '{{ $placement }}',
        openUp: {{ $placement === 'top' ? 'true' : 'false' }},
        abortController: null,

        init() {
            if (this.multiple) {
                let initialVals = Array.isArray(this.value) ? this.value : (this.value ? [this.value] : []);
                this.value = initialVals.map(String);
                
                if (this.selectedItems.length === 0 && this.value.length > 0) {
                    let labels = Array.isArray(this.selectedLabel) ? this.selectedLabel : (this.selectedLabel ? [this.selectedLabel] : []);
                    let avatars = Array.isArray(this.selectedAvatar) ? this.selectedAvatar : (this.selectedAvatar ? [this.selectedAvatar] : []);
                    let icons = Array.isArray(this.selectedIcon) ? this.selectedIcon : (this.selectedIcon ? [this.selectedIcon] : []);
                    this.selectedItems = this.value.map((v, i) => ({
                        value: v,
                        label: labels[i] || v,
                        avatar: avatars[i] || '',
                        icon: icons[i] || '',
                        description: ''
                    }));
                }
            } else {
                this.value = this.value !== null && this.value !== undefined ? String(this.value) : '';
                if (!this.selectedLabel && this.selectedItems.length > 0) {
                    this.selectedLabel = this.selectedItems[0].label;
                    this.selectedAvatar = this.selectedItems[0].avatar || '';
                    this.selectedIcon = this.selectedIcon || this.selectedItems[0].icon || '';
                }
            }

            this.$watch('value', (val) => {
                if (!this.multiple && (!val || val === '')) {
                    this.selectedLabel = '';
                    this.selectedAvatar = '';
                    this.selectedIcon = '';
                }
                this.$nextTick(() => this.dispatchChangeEvent());
            });
        },

        toggle() {
            if (this.disabled) return;
            this.open = !this.open;
            if (this.open) {
                this.calculatePlacement();
                this.$nextTick(() => {
                    this.calculatePlacement();
                    if (this.$refs.searchInput) {
                        this.$refs.searchInput.focus();
                    } else if (this.keyboard) {
                        this.focusNext();
                    }
                    if (!this.hasLoadedOnce || (this.items.length === 0 && this.minChars === 0)) {
                        this.fetchData('');
                    }
                });
            } else {
                this.search = '';
            }
        },

        close() {
            this.open = false;
            this.search = '';
        },

        async fetchData(q = null) {
            let query = q !== null ? q : this.search;
            if (query.length < this.minChars) {
                this.items = [];
                this.loading = false;
                return;
            }

            if (this.abortController) {
                this.abortController.abort();
            }
            this.abortController = new AbortController();

            this.loading = true;
            this.hasNetworkError = false;

            try {
                let url = new URL(this.api, window.location.origin);
                url.searchParams.set(this.searchParam, query);

                let res = await fetch(url.toString(), {
                    signal: this.abortController.signal,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        @foreach ($headers as $hKey => $hVal)
                            '{{ $hKey }}': '{{ $hVal }}',
                        @endforeach
                    }
                });

                if (!res.ok) throw new Error('Network error');
                let json = await res.json();
                let rawItems = Array.isArray(json) ? json : (Array.isArray(json.data) ? json.data : []);

                this.items = rawItems.map(item => ({
                    value: String(item.value ?? item.id ?? ''),
                    label: String(item.label ?? item.name ?? item.title ?? item.value ?? ''),
                    description: item.description ?? item.desc ?? null,
                    avatar: item.avatar ?? (item.icon && (String(item.icon).startsWith('http') || String(item.icon).startsWith('/') || String(item.icon).startsWith('data:')) ? item.icon : null),
                    icon: item.icon ?? item.avatar ?? null,
                    disabled: Boolean(item.disabled)
                }));

                this.hasLoadedOnce = true;

                if (this.multiple) {
                    if (Array.isArray(this.selectedItems) && this.selectedItems.length > 0) {
                        this.selectedItems.forEach(sel => {
                            let found = this.items.find(i => String(i.value) === String(sel.value));
                            if (found) {
                                if (!sel.label || sel.label === sel.value) sel.label = found.label;
                                if (!sel.avatar && found.avatar) sel.avatar = found.avatar;
                                if (!sel.icon && found.icon) sel.icon = found.icon;
                                if (!sel.description && found.description) sel.description = found.description;
                            }
                        });
                    }
                } else {
                    if (this.value && (!this.selectedLabel || !this.selectedAvatar)) {
                        let found = this.items.find(i => String(i.value) === String(this.value));
                        if (found) {
                            this.selectedLabel = found.label;
                            this.selectedAvatar = found.avatar || '';
                            this.selectedIcon = !found.avatar && found.icon ? found.icon : '';
                        }
                    }
                }
            } catch (e) {
                if (e.name !== 'AbortError') {
                    this.hasNetworkError = true;
                    this.items = [];
                }
            } finally {
                this.loading = false;
            }
        },

        isSelected(val) {
            let strVal = String(val);
            if (this.multiple) {
                return Array.isArray(this.value) && this.value.includes(strVal);
            }
            return String(this.value) === strVal;
        },

        canSelectMore() {
            if (!this.multiple) return true;
            if (this.max === null) return true;
            return Array.isArray(this.value) && this.value.length < this.max;
        },

        isOptionDisabled(val, isDisabled) {
            if (isDisabled) return true;
            if (this.multiple && this.max !== null && !this.isSelected(val) && !this.canSelectMore()) {
                return true;
            }
            return false;
        },

        selectItem(item) {
            if (!item || item.disabled) return;
            if (this.isOptionDisabled(item.value, false)) return;

            if (this.multiple) {
                let strVal = String(item.value);
                if (this.isSelected(strVal)) {
                    if (this.min !== null && this.value.length <= this.min) return;
                    this.value = this.value.filter(v => v !== strVal);
                    this.selectedItems = this.selectedItems.filter(i => String(i.value) !== strVal);
                } else {
                    if (this.max !== null && this.value.length >= this.max) return;
                    this.value.push(strVal);
                    this.selectedItems.push({
                        value: strVal,
                        label: item.label,
                        avatar: item.avatar || '',
                        icon: item.icon || '',
                        description: item.description || ''
                    });
                }
                this.dispatchChangeEvent();
                return;
            }

            this.value = String(item.value);
            this.selectedLabel = item.label;
            this.selectedAvatar = item.avatar || '';
            this.selectedIcon = !item.avatar && item.icon ? item.icon : '';
            this.close();
            this.dispatchChangeEvent();
        },

        removeTag(val) {
            if (this.disabled) return;
            let strVal = String(val);
            if (this.min !== null && this.value.length <= this.min) return;
            this.value = this.value.filter(v => v !== strVal);
            this.selectedItems = this.selectedItems.filter(i => String(i.value) !== strVal);
            this.dispatchChangeEvent();
        },

        clearAll() {
            if (this.disabled) return;
            if (this.multiple) {
                if (this.min !== null && this.min > 0) {
                    if (Array.isArray(this.value) && this.value.length > this.min) {
                        this.value = this.value.slice(0, this.min);
                        this.selectedItems = this.selectedItems.slice(0, this.min);
                        this.dispatchChangeEvent();
                    }
                    return;
                }
                this.value = [];
                this.selectedItems = [];
                this.dispatchChangeEvent();
                return;
            }
            this.value = '';
            this.selectedLabel = '';
            this.selectedAvatar = '';
            this.selectedIcon = '';
            this.dispatchChangeEvent();
        },

        dispatchChangeEvent() {
            this.$nextTick(() => {
                if (this.$refs.hiddenInput) {
                    this.$refs.hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
                    this.$refs.hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });
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
            let trigger = this.$refs.triggerBtn || this.$el;
            let rect = trigger.getBoundingClientRect();
            let spaceBelow = window.innerHeight - rect.bottom;
            let spaceAbove = rect.top;
            let popoverHeight = 250;
            this.openUp = spaceBelow < popoverHeight && spaceAbove > spaceBelow;
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
        }
    }"
    @click.outside="close()"
    @keydown.escape.window="close()"
    @scroll.window.debounce.50ms="open ? calculatePlacement() : null"
    @resize.window.debounce.50ms="open ? calculatePlacement() : null"
    @if ($keyboard)
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

    {{-- Hidden Form Input for standard form submission --}}
    @if ($name)
        @if ($multiple)
            <template x-for="val in (Array.isArray(value) ? value : [])" :key="val">
                <input type="hidden" name="{{ Str::endsWith($name, '[]') ? $name : $name . '[]' }}" :value="val" />
            </template>
            <input type="hidden" id="{{ $id }}" x-ref="hiddenInput" :value="JSON.stringify(value)" />
        @else
            <input type="hidden" id="{{ $id }}" x-ref="hiddenInput" name="{{ $name }}" :value="value" />
        @endif
    @endif

    {{-- Trigger & Popover Wrapper --}}
    <div class="relative">
        {{-- Trigger Element (Visual Parity with vibe:select & vibe:input) --}}
        <div
            role="combobox"
            tabindex="0"
            x-ref="triggerBtn"
            id="{{ $id }}-trigger"
            @click="toggle()"
            :aria-disabled="disabled"
            :class="{ 'pointer-events-none opacity-50': disabled, '{{ $activeOpenClasses }}': open }"
            @if ($hasError) aria-invalid="true" @endif
            @if ($describedByString) aria-describedby="{{ $describedByString }}" @endif
            aria-haspopup="listbox"
            :aria-expanded="open"
            @if ($keyboard)
                @keydown.down.stop.prevent="if (!open) { toggle(); } else { focusNext($event); }"
                @keydown.up.stop.prevent="if (!open) { toggle(); } else { focusPrevious($event); }"
            @endif
            {{ $attributes->twMerge(['class' => $compiledClasses]) }}
        >
            {{-- Content Display --}}
            @if ($multiple)
                <div class="flex flex-wrap items-center gap-1.5 py-0.5 max-w-[calc(100%-2.5rem)]">
                    <template x-if="selectedItems.length === 0">
                        <span class="text-muted-foreground truncate">{{ $placeholder }}</span>
                    </template>

                    <template x-for="item in selectedItems" :key="item.value">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-xs font-medium bg-muted/80 text-foreground border border-border/70 shadow-2xs">
                            <template x-if="item.avatar">
                                <img :src="item.avatar" class="size-3.5 rounded-full object-cover shrink-0" alt="" />
                            </template>
                            <template x-if="!item.avatar && item.icon">
                                <template x-if="item.icon.includes('<svg')">
                                    <span class="size-3 shrink-0 flex items-center justify-center [&>svg]:size-3" x-html="item.icon"></span>
                                </template>
                                <template x-if="!item.icon.includes('<svg')">
                                    <span class="text-[10px] font-bold text-muted-foreground" x-text="item.icon"></span>
                                </template>
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
                        <img :src="selectedAvatar" class="size-5 rounded-full object-cover shrink-0 border border-border/60" alt="" />
                    </template>
                    <template x-if="!selectedAvatar && selectedIcon">
                        <template x-if="selectedIcon.includes('<svg')">
                            <span class="size-4 shrink-0 flex items-center justify-center [&>svg]:size-4" x-html="selectedIcon"></span>
                        </template>
                        <template x-if="!selectedIcon.includes('<svg')">
                            <span class="text-xs font-bold text-muted-foreground" x-text="selectedIcon"></span>
                        </template>
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
                        <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                @endif
                <svg class="{{ $chevronSize }} shrink-0 transition-transform duration-200 pointer-events-none" :class="{ 'rotate-180 {{ $hasError ? 'text-destructive' : 'text-primary' }}': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </div>
        </div>

        {{-- Dropdown Popover --}}
        <div
            x-cloak
            x-show="open"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute left-0 right-0 z-50 rounded-xl border border-border bg-popover text-popover-foreground shadow-xl overflow-hidden focus:outline-none"
            :class="openUp ? 'bottom-full mb-1.5' : 'top-full mt-1.5'"
            style="display: none;"
        >
            {{-- Remote Search Field --}}
            <div class="p-2 border-b border-border bg-muted/20">
                <div class="relative flex items-center">
                    {{-- Search Icon or Loading Spinner --}}
                    <div class="size-3.5 absolute left-2.5 text-muted-foreground pointer-events-none flex items-center justify-center">
                        <svg x-show="!loading" class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.3-4.3" />
                        </svg>
                        <svg x-show="loading" class="size-3.5 animate-spin text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                        </svg>
                    </div>

                    <input
                        x-ref="searchInput"
                        x-model="search"
                        @input.debounce.{{ $debounce }}ms="fetchData()"
                        type="text"
                        placeholder="{{ $searchPlaceholder }}"
                        class="w-full h-8 pl-8 pr-7 text-xs rounded-lg border border-input bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 focus-visible:outline-none focus-visible:border-primary focus-visible:ring-2 focus-visible:ring-primary/20 transition-colors"
                        @keydown.escape.stop="close()"
                        @if ($keyboard)
                            @keydown.down.stop.prevent="focusNext($event)"
                            @keydown.up.stop.prevent=""
                            @keydown.enter.stop.prevent="let items = getVisibleItems(); if (items[0]) { selectItem(items[0]); }"
                        @endif
                    />

                    {{-- Clear Search Text --}}
                    <button
                        x-show="search.length > 0"
                        @click="search = ''; fetchData(''); $refs.searchInput.focus()"
                        type="button"
                        class="absolute right-2 text-muted-foreground hover:text-foreground size-4 flex items-center justify-center cursor-pointer">
                        <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
            </div>

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

            {{-- Dynamic Options List --}}
            <div x-ref="optionsContainer" role="listbox" class="max-h-52 overflow-y-auto p-1 space-y-0.5 vibe-scrollbar focus:outline-none">
                {{-- Loading Skeleton State --}}
                <div x-cloak x-show="loading && items.length === 0" class="py-8 px-4 text-center text-xs text-muted-foreground flex flex-col items-center justify-center gap-2">
                    <svg class="size-5 animate-spin text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                    </svg>
                    <span>{{ __('vibe/select.loading') }}</span>
                </div>

                {{-- Min Characters Prompt --}}
                <div x-cloak x-show="!loading && search.length < minChars && items.length === 0" class="py-6 px-3 text-center text-xs text-muted-foreground">
                    <span>{{ __('vibe/select.min_chars', ['min' => $minChars]) }}</span>
                </div>

                {{-- Network Error State --}}
                <div x-cloak x-show="hasNetworkError" class="py-6 px-3 text-center text-xs text-destructive flex flex-col items-center gap-1.5">
                    <svg class="size-5 text-destructive/80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    <span>{{ __('vibe/select.network_error') }}</span>
                    <button type="button" @click="fetchData()" class="mt-1 text-[11px] underline text-foreground hover:text-primary cursor-pointer">Coba lagi</button>
                </div>

                {{-- Empty Search Results Message --}}
                <div x-cloak x-show="!loading && !hasNetworkError && items.length === 0 && search.length >= minChars && hasLoadedOnce" class="py-6 px-3 text-center text-xs text-muted-foreground">
                    <svg class="size-6 mx-auto mb-1.5 text-muted-foreground/50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        <line x1="8" y1="11" x2="14" y2="11" />
                    </svg>
                    <span>{{ __('vibe/select.no_options') }}</span>
                </div>

                {{-- Render Options from Remote Data --}}
                <template x-for="(item, index) in items" :key="item.value">
                    <div
                        role="option"
                        tabindex="-1"
                        :data-value="item.value"
                        :data-label="item.label"
                        @click="selectItem(item)"
                        @if ($keyboard)
                            @keydown.enter.prevent="selectItem(item)"
                            @keydown.space.prevent="selectItem(item)"
                        @endif
                        :aria-selected="isSelected(item.value)"
                        class="relative flex items-center gap-2.5 w-full px-2.5 py-1.5 text-xs rounded-lg select-none transition-colors group focus:outline-none cursor-pointer focus:bg-accent focus:text-accent-foreground focus:ring-1 focus:ring-foreground/15 focus:ring-inset"
                        :class="{
                            'bg-accent/50 text-accent-foreground font-medium': !multiple && isSelected(item.value),
                            'font-medium text-foreground': multiple && isSelected(item.value),
                            'text-popover-foreground hover:bg-muted/60': !isSelected(item.value) && !isOptionDisabled(item.value, item.disabled),
                            'hover:bg-muted/60': multiple && isSelected(item.value) && !isOptionDisabled(item.value, item.disabled),
                            'opacity-40 cursor-not-allowed pointer-events-none': isOptionDisabled(item.value, item.disabled)
                        }"
                    >
                        {{-- Left Avatar or Icon --}}
                        <template x-if="item.avatar || item.icon">
                            <div class="shrink-0 flex items-center justify-center">
                                <template x-if="item.avatar">
                                    <img :src="item.avatar" class="size-6 rounded-full object-cover shrink-0 border border-border/60" :alt="item.label" />
                                </template>
                                <template x-if="!item.avatar && item.icon">
                                    <template x-if="item.icon.startsWith('http') || item.icon.startsWith('/') || item.icon.startsWith('data:')">
                                        <img :src="item.icon" class="size-6 rounded-full object-cover shrink-0 border border-border/60" :alt="item.label" />
                                    </template>
                                    <template x-if="!item.icon.startsWith('http') && !item.icon.startsWith('/') && !item.icon.startsWith('data:') && item.icon.includes('<svg')">
                                        <span class="size-4 shrink-0 flex items-center justify-center [&>svg]:size-4 text-muted-foreground group-hover:text-foreground transition-colors" x-html="item.icon"></span>
                                    </template>
                                    <template x-if="!item.icon.startsWith('http') && !item.icon.startsWith('/') && !item.icon.startsWith('data:') && !item.icon.includes('<svg')">
                                        <div class="size-6 rounded-full bg-muted border border-border/60 flex items-center justify-center text-[10px] font-bold text-muted-foreground" x-text="item.icon"></div>
                                    </template>
                                </template>
                            </div>
                        </template>

                        {{-- Center Content: Label & Description --}}
                        <div class="flex-1 min-w-0 text-left">
                            <span class="block truncate font-medium" x-text="item.label"></span>
                            <template x-if="item.description">
                                <span class="block text-[11px] text-muted-foreground font-normal leading-snug truncate" x-text="item.description"></span>
                            </template>
                        </div>

                        {{-- Right Indicator: Checkbox for Multiple, Checkmark for Single --}}
                        <div class="shrink-0 flex items-center">
                            {{-- Multi-Select Checkbox Box --}}
                            <template x-if="multiple">
                                <div
                                    class="size-4 rounded border flex items-center justify-center transition-colors"
                                    :class="isSelected(item.value) ? 'bg-primary border-primary text-primary-foreground' : 'border-input bg-background'">
                                    <svg x-show="isSelected(item.value)" class="size-3 stroke-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12" />
                                    </svg>
                                </div>
                            </template>

                            {{-- Single-Select Checkmark --}}
                            <template x-if="!multiple">
                                <div x-cloak x-show="isSelected(item.value)" class="text-primary">
                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12" />
                                    </svg>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- Error Message --}}
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
