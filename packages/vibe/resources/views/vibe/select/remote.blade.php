@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'description' => null,
    'size' => 'md', // xs, sm, md, lg, xl
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
    'badgeVariant' => 'secondary', // secondary, primary, outline, cycle
    'colorCycle' => ['info', 'primary', 'success', 'warning', 'secondary', 'purple'],
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
    'avatar' => null,
    'icon' => null,
    'selectedLabel' => null,
    'selectedAvatar' => null,
    'selectedIcon' => null,
])

@php
    $placeholder = $placeholder ?? __('vibe/select.placeholder');
    $searchPlaceholder = $searchPlaceholder ?? __('vibe/select.search_placeholder');
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ?? uniqid('select-remote-'));
    $initialLabel = $initialLabel ?? $selectedLabel ?? null;
    $initialAvatar = $initialAvatar ?? $avatar ?? $selectedAvatar ?? null;
    $initialIcon = $initialIcon ?? $icon ?? $selectedIcon ?? null;
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = $error && !is_bool($error) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $baseClasses = 'relative w-full flex items-center justify-between text-left transition-colors duration-150 focus:outline-none focus-visible:outline-none select-none cursor-pointer disabled:pointer-events-none disabled:opacity-50 disabled:bg-muted/40 disabled:cursor-not-allowed';

    [$heightClass, $textClass, $radiusClass, $plClass, $prClass, $flushPrClass, $gapClass, $chevronSize, $chevronRightPosition, $badgeSizeClass, $badgeRemoveSizeClass] = match ($size) {
        'xs' => [$multiple ? 'min-h-7 py-0.5' : 'h-7', 'text-xs', 'rounded-md', 'pl-2.5', $clearable ? 'pr-11' : 'pr-7', $clearable ? 'pr-9' : 'pr-5', 'gap-1', 'size-3.5', 'right-2', 'h-5 px-1.5 text-[10px] gap-1 rounded-sm', 'size-2.5'],
        'sm' => [$multiple ? 'min-h-8 py-1' : 'h-8', 'text-xs', 'rounded-md', 'pl-3', $clearable ? 'pr-12' : 'pr-8', $clearable ? 'pr-10' : 'pr-6', 'gap-1.5', 'size-3.5', 'right-2.5', 'h-5.5 px-2 text-[11px] gap-1 rounded-sm', 'size-2.5'],
        'lg' => [$multiple ? 'min-h-10 py-1.5' : 'h-10', 'text-sm', 'rounded-lg', 'pl-4', $clearable ? 'pr-14' : 'pr-10', $clearable ? 'pr-13' : 'pr-8', 'gap-2', 'size-4.5', 'right-3', 'h-6.5 px-2.5 text-xs gap-1.5 rounded-md', 'size-3'],
        'xl' => [$multiple ? 'min-h-11 py-1.5' : 'h-11', 'text-base', 'rounded-xl', 'pl-5', $clearable ? 'pr-16' : 'pr-11', $clearable ? 'pr-14' : 'pr-9', 'gap-2.5', 'size-5', 'right-3.5', 'h-7 px-3 text-sm gap-2 rounded-lg', 'size-3.5'],
        default => [$multiple ? 'min-h-9 py-1' : 'h-9', 'text-sm', 'rounded-lg', 'pl-3.5', $clearable ? 'pr-13' : 'pr-9', $clearable ? 'pr-12' : 'pr-7', 'gap-2', 'size-4', 'right-3', 'h-6 px-2 text-xs gap-1.5 rounded-md', 'size-3'],
    };

    $sizeClasses = $variant === 'flush'
        ? "{$heightClass} {$textClass} px-0 rounded-none {$flushPrClass}"
        : "{$heightClass} {$textClass} {$radiusClass} {$plClass} {$prClass} {$gapClass}";

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
            $rawLbl = (string) ($value['label'] ?? $value['name'] ?? $value['title'] ?? $val);
            $lbl = html_entity_decode($rawLbl, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $av = $value['avatar'] ?? (isset($value['icon']) && (str_starts_with((string) $value['icon'], 'http') || str_starts_with((string) $value['icon'], '/') || str_starts_with((string) $value['icon'], 'data:')) ? $value['icon'] : null);
            $ic = $value['icon'] ?? $value['avatar'] ?? null;
            $initialItemsData[] = [
                'value' => $val,
                'label' => $lbl,
                'description' => $value['description'] ?? $value['desc'] ?? null,
                'avatar' => $av,
                'icon' => $ic,
            ];
            $value = $multiple ? [$val] : $val;
            if (!$initialLabel) {
                $initialLabel = $lbl;
            }
            if (!$initialAvatar && $av) {
                $initialAvatar = $av;
            }
            if (!$initialIcon && $ic) {
                $initialIcon = $ic;
            }
        } else {
            $first = reset($value);
            if (is_array($first) || is_object($first)) {
                $extractedValues = [];
                foreach ($value as $item) {
                    $itemArr = (array) $item;
                    $val = (string) ($itemArr['value'] ?? $itemArr['id'] ?? '');
                    $rawLbl = (string) ($itemArr['label'] ?? $itemArr['name'] ?? $itemArr['title'] ?? $val);
                    $lbl = html_entity_decode($rawLbl, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    $av = $itemArr['avatar'] ?? (isset($itemArr['icon']) && (str_starts_with((string) $itemArr['icon'], 'http') || str_starts_with((string) $itemArr['icon'], '/') || str_starts_with((string) $itemArr['icon'], 'data:')) ? $itemArr['icon'] : null);
                    $ic = $itemArr['icon'] ?? $itemArr['avatar'] ?? null;
                    $extractedValues[] = $val;
                    $initialItemsData[] = [
                        'value' => $val,
                        'label' => $lbl,
                        'description' => $itemArr['description'] ?? $itemArr['desc'] ?? null,
                        'avatar' => $av,
                        'icon' => $ic,
                    ];
                }
                $value = $multiple ? $extractedValues : ($extractedValues[0] ?? '');
                if (!$initialLabel && !empty($initialItemsData)) {
                    $initialLabel = $multiple ? array_column($initialItemsData, 'label') : $initialItemsData[0]['label'];
                }
                if (!$initialAvatar && !empty($initialItemsData)) {
                    $initialAvatar = $multiple ? array_column($initialItemsData, 'avatar') : ($initialItemsData[0]['avatar'] ?? null);
                }
                if (!$initialIcon && !empty($initialItemsData)) {
                    $initialIcon = $multiple ? array_column($initialItemsData, 'icon') : ($initialItemsData[0]['icon'] ?? null);
                }
            }
        }
    }

    if ($initialLabel) {
        if (is_array($initialLabel)) {
            $initialLabel = array_map(fn($l) => html_entity_decode((string) $l, ENT_QUOTES | ENT_HTML5, 'UTF-8'), $initialLabel);
        } else {
            $initialLabel = html_entity_decode((string) $initialLabel, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
    }
@endphp

@pushOnce('head', 'vibe-select-scripts')
    @vite(['resources/js/vibe/select.js'])
@endPushOnce

@php
    $remoteSelectInitialVal = $multiple
        ? (is_array($value) ? array_map('strval', array_values($value)) : ($value !== null && $value !== '' ? [(string) $value] : []))
        : ($value !== null && $value !== '' ? (string) $value : '');

    $remoteSelectConfigJson = \Illuminate\Support\Js::from([
        'name' => $name,
        'selectedLabel' => $initialLabel ?? '',
        'selectedAvatar' => $initialAvatar ?? '',
        'selectedIcon' => $initialIcon ?? '',
        'selectedItems' => $initialItemsData,
        'disabled' => (bool) $disabled,
        'keyboard' => (bool) $keyboard,
        'multiple' => (bool) $multiple,
        'badgeVariant' => $badgeVariant,
        'colorCycle' => $colorCycle,
        'min' => $min !== null ? (int) $min : null,
        'max' => $max !== null ? (int) $max : null,
        'api' => $api,
        'searchParam' => $searchParam,
        'minChars' => (int) $minChars,
        'debounce' => (int) $debounce,
        'placement' => $placement,
        'openUp' => $placement === 'top',
        'headers' => (object) $headers,
    ])->toHtml();
@endphp

<div data-vibe-select="{{ $name }}" data-multiple="{{ $multiple ? 'true' : 'false' }}" {{ $attributes->only('class')->twMerge(['class' => trim("w-full {$wrapperClass}")]) }}
    x-data="typeof window.vibeRemoteSelect === 'function' ? window.vibeRemoteSelect(Object.assign({!! $remoteSelectConfigJson !!}, {
        value: @if ($wireModelName) $wire.entangle('{{ $wireModelName }}'){{ $isWireLive ? '.live' : '' }} @else @js($remoteSelectInitialVal) @endif
    })) : Object.assign({!! $remoteSelectConfigJson !!}, {
        open: false,
        search: '',
        value: @if ($wireModelName) $wire.entangle('{{ $wireModelName }}'){{ $isWireLive ? '.live' : '' }} @else @js($remoteSelectInitialVal) @endif,
        items: [],
        loading: false,
        hasLoadedOnce: false,
        hasNetworkError: false,
        abortController: null,
        getBadgeClasses: () => '',
        isSelected: () => false,
        isOptionDisabled: () => false,
        getVisibleItems: () => [],
        toggle() {},
        close() {},
        clearAll() {},
        removeTag() {},
        selectItem() {},
        fetchData() {},
        calculatePlacement() {},
        focusNext() {},
        focusPrevious() {},
        init() {
            var self = this;
            var attach = function() {
                if (self._vibeSelectBound || typeof window.vibeRemoteSelect !== 'function') return;
                self._vibeSelectBound = true;
                var comp = window.vibeRemoteSelect({!! $remoteSelectConfigJson !!});
                Object.keys(comp).forEach(function(k) {
                    if (k !== 'init' && k !== 'value' && typeof comp[k] === 'function') {
                        self[k] = comp[k];
                    }
                });
                comp.init.call(self);
            };
            if (typeof window.vibeRemoteSelect === 'function') {
                attach();
            } else {
                window.addEventListener('vibe-select-ready', attach, { once: true });
            }
        }
    })"
    @click.outside="close()"
    @keydown.escape.window="close()"
    @scroll.window.debounce.50ms="open ? calculatePlacement() : null"
    @resize.window.debounce.50ms="open ? calculatePlacement() : null"
    @if ($keyboard)
        @keydown.up.window="focusPrevious($event)"
        @keydown.down.window="focusNext($event)"
    @endif
>

    {{-- Label & Description --}}
    <vibe:partials.field-label
        :for="$id . '-trigger'"
        :label="$label"
        :required="$attributes->has('required') && $attributes->get('required') !== false"
        :description="$description"
        :descriptionId="$id . '-description'"
    />

    {{-- Hidden Form Input for standard form submission --}}
    @if ($name)
        @if ($multiple)
            <template x-for="val in (Array.isArray(value) ? value : [])" :key="val">
                <input type="hidden" name="{{ Str::endsWith($name, '[]') ? $name : $name . '[]' }}" data-vibe-select-input="{{ $name }}" :value="val" />
            </template>
            <input type="hidden" id="{{ $id }}" data-vibe-select-input="{{ $name }}" x-ref="hiddenInput" :value="JSON.stringify(value)" />
        @else
            <input type="hidden" id="{{ $id }}" data-vibe-select-input="{{ $name }}" x-ref="hiddenInput" name="{{ $name }}" :value="value" />
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
                                class="size-3 shrink-0 flex items-center justify-center [&>svg]:size-3 text-[10px] font-bold text-muted-foreground"
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
                    {{-- Dynamic Avatar when an option is selected --}}
                    <img
                        x-show="Boolean(selectedAvatar)"
                        :src="selectedAvatar || ''"
                        class="size-5 rounded-full object-cover shrink-0 border border-border/60"
                        alt=""
                        style="display: none;"
                    />

                    {{-- Dynamic Icon when an option is selected and no avatar --}}
                    <span
                        x-show="!selectedAvatar && Boolean(selectedIcon)"
                        class="size-4 shrink-0 flex items-center justify-center [&>svg]:size-4 text-xs font-bold text-muted-foreground"
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
                        <svg x-show="!loading" class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11.5" cy="11.5" r="9.5" />
                            <path d="m20 20-2-2" />
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
                        class="w-full h-8 pl-8 pr-7 text-xs rounded-md border border-input bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 focus-visible:outline-none focus-visible:border-primary focus-visible:ring-2 focus-visible:ring-primary/20 transition-colors"
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
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="m14.5 9.5-5 5m0-5 5 5" />
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
                    <svg class="size-5 text-destructive/80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 8v5M12 16h.01" />
                    </svg>
                    <span>{{ __('vibe/select.network_error') }}</span>
                    <button type="button" @click="fetchData()" class="mt-1 text-[11px] underline text-foreground hover:text-primary cursor-pointer">{{ __('vibe/select.retry') }}</button>
                </div>

                {{-- Empty Search Results Message --}}
                <div x-cloak x-show="!loading && !hasNetworkError && items.length === 0 && search.length >= minChars && hasLoadedOnce" class="py-6 px-3 text-center text-xs text-muted-foreground">
                    <svg class="size-6 mx-auto mb-1.5 text-muted-foreground/50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11.5" cy="11.5" r="9.5" />
                        <path d="m20 20-2-2" />
                        <path d="M9 11.5h5" />
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
                        class="relative flex items-center gap-2.5 w-full px-2.5 py-1.5 text-xs rounded-lg select-none transition-colors group focus:outline-none cursor-pointer focus:bg-muted focus:text-foreground focus:ring-1 focus:ring-foreground/15 focus:ring-inset"
                        :class="{
                            'bg-muted text-foreground font-medium': !multiple && isSelected(item.value),
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
                                    <svg x-show="isSelected(item.value)" class="size-3 stroke-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 12.611 8.923 17.5 20 6.5" />
                                    </svg>
                                </div>
                            </template>

                            {{-- Single-Select Checkmark --}}
                            <template x-if="!multiple">
                                <div x-cloak x-show="isSelected(item.value)" class="text-primary">
                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 12.611 8.923 17.5 20 6.5" />
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
    <vibe:partials.field-message :id="$id" :hasError="$hasError" :errorMessage="$errorMessage" :info="$info" />
</div>
