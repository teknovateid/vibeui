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
        'xs' => ($multiple ? 'min-h-7 py-0.5' : 'h-7') . " text-xs rounded-md pl-2.5 {$prClass} gap-1",
        'sm' => ($multiple ? 'min-h-8 py-1' : 'h-8') . " text-xs rounded-md pl-3 {$prClass} gap-1.5",
        'md' => ($multiple ? 'min-h-11 sm:min-h-9 py-1.5 sm:py-1' : 'h-11 sm:h-9') . " text-base sm:text-sm rounded-lg pl-4 sm:pl-3.5 {$prClass} gap-2",
        'lg' => ($multiple ? 'min-h-10 py-1.5' : 'h-10') . " text-sm rounded-lg pl-4 {$prClass} gap-2",
        'xl' => ($multiple ? 'min-h-11 py-1.5' : 'h-11') . " text-base rounded-xl pl-4.5 {$prClass} gap-2.5",
        default => ($multiple ? 'min-h-11 sm:min-h-9 py-1.5 sm:py-1' : 'h-11 sm:h-9') . " text-base sm:text-sm rounded-lg pl-4 sm:pl-3.5 {$prClass} gap-2",
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
            'xs' => ($multiple ? 'min-h-7 py-0.5' : 'h-7') . " text-xs px-0 rounded-none {$flushPr}",
            'sm' => ($multiple ? 'min-h-8 py-1' : 'h-8') . " text-xs px-0 rounded-none {$flushPr}",
            'md' => ($multiple ? 'min-h-11 sm:min-h-9 py-1.5 sm:py-1' : 'h-11 sm:h-9') . " text-base sm:text-sm px-0 rounded-none {$flushPr}",
            'lg' => ($multiple ? 'min-h-10 py-1.5' : 'h-10') . " text-sm px-0 rounded-none {$flushPr}",
            'xl' => ($multiple ? 'min-h-11 py-1.5' : 'h-11') . " text-base px-0 rounded-none {$flushPr}",
            default => ($multiple ? 'min-h-11 sm:min-h-9 py-1.5 sm:py-1' : 'h-11 sm:h-9') . " text-base sm:text-sm px-0 rounded-none {$flushPr}",
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

@pushOnce('head', 'vibe-select-scripts')
    @vite(['resources/js/vibe/select.js'])
@endPushOnce

@php
    $selectConfigJson = \Illuminate\Support\Js::from([
        'name' => $name,
        'separator' => $separator,
        'badgeVariant' => $badgeVariant,
        'colorCycle' => $colorCycle,
        'disabled' => (bool) $disabled,
        'keyboard' => (bool) $keyboard,
        'multiple' => (bool) $multiple,
        'min' => $min !== null ? (int) $min : null,
        'max' => $max !== null ? (int) $max : null,
        'placement' => $placement,
        'openUp' => $placement === 'top',
    ])->toHtml();
@endphp

<div {{ $attributes->only('class')->twMerge(['class' => trim("w-full {$wrapperClass}")]) }}
    data-vibe-select="{{ $name }}"
    data-multiple="{{ $multiple ? 'true' : 'false' }}"
    x-data="typeof window.vibeSelect === 'function' ? window.vibeSelect(Object.assign({!! $selectConfigJson !!}, {
        value: @if ($wireModelName) $wire.entangle('{{ $wireModelName }}'){{ $isWireLive ? '.live' : '' }} @else @js($initialSelectVal) @endif
    })) : Object.assign({!! $selectConfigJson !!}, {
        open: false,
        search: '',
        value: @if ($wireModelName) $wire.entangle('{{ $wireModelName }}'){{ $isWireLive ? '.live' : '' }} @else @js($initialSelectVal) @endif,
        selectedLabel: '',
        selectedAvatar: '',
        selectedIcon: '',
        selectedDescription: '',
        selectedItems: [],
        hasVisibleOptions: true,
        getBadgeClasses: () => '',
        isOptionVisible: () => true,
        getOptionClasses: () => ({}),
        isSelected: () => false,
        isOptionDisabled: () => false,
        getVisibleItems: () => [],
        toggle() {},
        close() {},
        clearAll() {},
        removeTag() {},
        selectOption() {},
        handleHiddenInput() {},
        calculatePlacement() {},
        focusNext() {},
        focusPrevious() {},
        init() {
            var self = this;
            var attach = function() {
                if (self._vibeSelectBound || typeof window.vibeSelect !== 'function') return;
                self._vibeSelectBound = true;
                var comp = window.vibeSelect({!! $selectConfigJson !!});
                Object.keys(comp).forEach(function(k) {
                    if (k !== 'init' && k !== 'value' && typeof comp[k] === 'function') {
                        self[k] = comp[k];
                    }
                });
                comp.init.call(self);
            };
            if (typeof window.vibeSelect === 'function') {
                attach();
            } else {
                window.addEventListener('vibe-select-ready', attach, { once: true });
            }
        }
    })" @click.outside="close()" @keydown.escape.window="close()" @scroll.window.debounce.50ms="open ? calculatePlacement() : null" @resize.window.debounce.50ms="open ? calculatePlacement() : null" @if ($keyboard)
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
            <input type="hidden" id="{{ $id }}" name="{{ $name }}" data-vibe-select-input="{{ $name }}" :value="Array.isArray(value) ? value.join('{{ $separator }}') : (value || '')" x-ref="hiddenInput" @input="handleHiddenInput($el)" @change="handleHiddenInput($el)" />
        @else
            <template x-for="val in value" :key="val">
                <input type="hidden" name="{{ $name }}[]" data-vibe-select-input="{{ $name }}" :value="val" />
            </template>
            <input type="hidden" id="{{ $id }}" data-vibe-select-input="{{ $name }}" x-ref="hiddenInput" :value="JSON.stringify(value)" @input="handleHiddenInput($el)" @change="handleHiddenInput($el)" />
        @endif
    @else
        <input type="hidden" id="{{ $id }}" name="{{ $name }}" data-vibe-select-input="{{ $name }}" :value="value" x-ref="hiddenInput" @input="handleHiddenInput($el)" @change="handleHiddenInput($el)" />
    @endif

    {{-- Trigger & Popover Wrapper --}}
    <div class="relative">
        {{-- Trigger Element (Visual Parity with vibe:input) --}}
        <div role="combobox" tabindex="0" x-ref="triggerBtn" id="{{ $id }}-trigger" @click="toggle()" :aria-disabled="disabled" :class="{ 'pointer-events-none opacity-50': disabled, '{{ $activeOpenClasses }}': open }" @if ($hasError) aria-invalid="true" @endif @if ($describedByString) aria-describedby="{{ $describedByString }}" @endif aria-haspopup="listbox" :aria-expanded="open" @if ($keyboard) @keydown.down.stop.prevent="if (!open) { toggle(); } else { focusNext($event); }"
                @keydown.up.stop.prevent="if (!open) { toggle(); } else { focusPrevious($event); }" @endif {{ $attributes->twMerge(['class' => $compiledClasses]) }}>
            {{-- Content Display --}}
            @if ($multiple)
                <div class="flex flex-wrap items-center gap-1.5 py-0.5 sm:py-0 flex-1 min-w-0" wire:ignore.self>
                    <template x-if="selectedItems.length === 0">
                        <span class="text-muted-foreground truncate">{{ $placeholder }}</span>
                    </template>

                    <template x-for="(item, index) in selectedItems" :key="item.value">
                        <span 
                            class="inline-flex items-center font-medium border select-none transition-colors shrink-0 max-w-full {{ $badgeSizeClass }}"
                            :class="getBadgeClasses(index)"
                        >
                            <img
                                x-show="Boolean(item.avatar)"
                                :src="item.avatar || ''"
                                class="size-3.5 rounded-full object-cover shrink-0"
                                alt=""
                                style="display: none;"
                            />
                            <span
                                x-show="!item.avatar && Boolean(item.icon)"
                                class="size-3 shrink-0 flex items-center justify-center [&>svg]:size-3"
                                x-html="item.icon || ''"
                                style="display: none;"
                            ></span>
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
                <span class="flex items-center gap-2 min-w-0 truncate" wire:ignore.self>
                    {{-- Dynamic Avatar or Icon when an option is selected --}}
                    <img
                        x-show="Boolean(selectedAvatar)"
                        :src="selectedAvatar || ''"
                        class="size-5 rounded-full object-cover shrink-0"
                        alt=""
                        style="display: none;"
                    />
                    <span
                        x-show="!selectedAvatar && Boolean(selectedIcon)"
                        class="size-4 shrink-0 flex items-center justify-center [&>svg]:size-4"
                        x-html="selectedIcon || ''"
                        style="display: none;"
                    ></span>

                    {{-- Selected Label or Placeholder --}}
                    <span x-text="selectedLabel || @js($placeholder)" :class="!selectedLabel ? 'text-muted-foreground' : 'text-foreground font-medium'" class="truncate"></span>
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
                        aria-label="{{ __('vibe/select.clear') }}">
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
                        <input x-ref="searchInput" x-model="search" type="text" placeholder="{{ $searchPlaceholder }}" class="w-full h-10 sm:h-8 pl-8.5 sm:pl-8 pr-7 text-base sm:text-xs rounded-lg border border-input bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 focus-visible:outline-none focus-visible:border-primary focus-visible:ring-2 focus-visible:ring-primary/20 transition-colors" @keydown.escape.stop="close()" @if ($keyboard) @keydown.down.stop.prevent="focusNext($event)"
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
