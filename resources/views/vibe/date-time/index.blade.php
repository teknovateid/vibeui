@blaze

@props([
    'id' => null,
    'name' => null,
    'startName' => null,
    'endName' => null,
    'label' => null,
    'description' => null,
    'placeholder' => null,
    'startPlaceholder' => null,
    'endPlaceholder' => null,
    'startTimeLabel' => null,
    'endTimeLabel' => null,
    'timeLabel' => null,
    'startLabel' => null,
    'endLabel' => null,
    'type' => 'single', // single, datetime, range, datetime-range, multiple, time, month
    'mode' => null,
    'value' => null,
    'format' => null,
    'displayFormat' => null,
    'time24' => true,
    'minuteStep' => 1,
    'secondStep' => 1,
    'showSeconds' => false,
    'min' => null,
    'max' => null,
    'minDate' => null,
    'maxDate' => null,
    'minRange' => null,
    'maxRange' => null,
    'disabledDates' => [],
    'disabledDaysOfWeek' => [],
    'markers' => [],
    'locale' => null,
    'firstDayOfWeek' => 1,
    'inline' => false,
    'clearable' => true,
    'presets' => false,
    'dualMonth' => false,
    'size' => 'md',
    'variant' => 'primary', // primary, outline
    'error' => null,
    'errorName' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
])

@php
    $normalizeDate = function ($val) {
        if ($val instanceof \DateTimeInterface) {
            return $val->format('Y-m-d H:i:s');
        }
        if (is_array($val)) {
            return array_map(function ($item) {
                return $item instanceof \DateTimeInterface ? $item->format('Y-m-d H:i:s') : $item;
            }, $val);
        }
        return $val;
    };

    $effectiveMinDate = $normalizeDate($minDate ?? $min);
    $effectiveMaxDate = $normalizeDate($maxDate ?? $max);
    $resolvedValue = $normalizeDate($value);
    $resolvedMode = $mode ?? $type;
    $resolvedLocale = $locale ?? (app()->getLocale() === 'en' ? 'en' : 'id');
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $dtId = $id ?? ($name ? 'dt-' . str_replace(['[', ']', '.'], ['-', '', '-'], $name) : 'vibe-dt-' . Str::random(8));

    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);
    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = ($error && !is_bool($error)) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $rawTranslations = trans('vibe/date-time', [], $resolvedLocale);
    if (!is_array($rawTranslations)) {
        $rawTranslations = trans('vibe::vibe/date-time', [], $resolvedLocale);
    }
    $i18n = is_array($rawTranslations) ? $rawTranslations : [];

    $effectiveStartTimeLabel = $startTimeLabel ?? $startLabel;
    $effectiveEndTimeLabel = $endTimeLabel ?? $endLabel;

    if (!isset($i18n['timeLabels']) || !is_array($i18n['timeLabels'])) {
        $i18n['timeLabels'] = [];
    }
    if ($effectiveStartTimeLabel) {
        $i18n['timeLabels']['startTime'] = $effectiveStartTimeLabel;
    }
    if ($effectiveEndTimeLabel) {
        $i18n['timeLabels']['endTime'] = $effectiveEndTimeLabel;
    }
    if ($timeLabel) {
        $i18n['timeLabels']['time'] = $timeLabel;
    }

    $placeholders = $i18n['placeholders'] ?? [];
    $defaultPlaceholder = match($resolvedMode) {
        'time' => $placeholders['time'],
        'time-range' => $placeholders['time_range'],
        'datetime' => $placeholders['datetime'],
        'range' => $placeholders['range'],
        'datetime-range' => $placeholders['datetime_range'],
        'multiple' => $placeholders['multiple'],
        'month' => $placeholders['month'],
        default => $placeholders['date'],
    };
    $inputPlaceholder = $placeholder ?? $defaultPlaceholder;
    $startPlaceholder = $startPlaceholder ?? ($placeholders['start'] ?? 'Start Date');
    $endPlaceholder = $endPlaceholder ?? ($placeholders['end'] ?? 'End Date');

    $sizeClasses = match ($size) {
        'sm' => 'h-8 text-xs rounded-md pl-8 pr-8',
        'lg' => 'h-10 text-sm rounded-lg pl-10 pr-9',
        'xl' => 'h-11 text-base rounded-xl pl-11 pr-10',
        default => 'h-9 text-sm rounded-lg pl-9 pr-9',
    };

    $variantClasses = match ($variant) {
        'outline' => $hasError 
            ? 'border border-destructive text-destructive focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20' 
            : 'border border-input bg-background text-foreground shadow-2xs hover:border-ring/50 focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20',
        'primary' => $hasError 
            ? 'border border-destructive text-destructive focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20' 
            : 'border border-input bg-background text-foreground shadow-2xs hover:border-primary/50 focus-visible:border-primary focus-visible:ring-2 focus-visible:ring-primary/20',
        default => $hasError 
            ? 'border border-destructive text-destructive focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20' 
            : 'border border-input bg-background text-foreground shadow-2xs hover:border-primary/50 focus-visible:border-primary focus-visible:ring-2 focus-visible:ring-primary/20',
    };

    $iconSize = match ($size) {
        'sm' => 'size-3.5 left-2.5',
        'lg' => 'size-4.5 left-3',
        'xl' => 'size-5 left-3.5',
        default => 'size-4 left-3',
    };

    $configJson = json_encode([
        'id' => $dtId,
        'mode' => $resolvedMode,
        'locale' => $resolvedLocale,
        'i18n' => $i18n,
        'firstDayOfWeek' => (int) $firstDayOfWeek,
        'time24' => (bool) $time24,
        'minuteStep' => (int) $minuteStep,
        'secondStep' => (int) $secondStep,
        'showSeconds' => (bool) $showSeconds,
        'minDate' => $effectiveMinDate,
        'maxDate' => $effectiveMaxDate,
        'minRange' => $minRange !== null ? (int) $minRange : null,
        'maxRange' => $maxRange !== null ? (int) $maxRange : null,
        'disabledDates' => (array) $disabledDates,
        'disabledDaysOfWeek' => (array) $disabledDaysOfWeek,
        'markers' => (object) $markers,
        'inline' => (bool) $inline,
        'clearable' => (bool) $clearable,
        'presets' => $presets,
        'dualMonth' => (bool) $dualMonth,
        'startName' => $startName,
        'endName' => $endName,
        'format' => $format ?: '',
        'displayFormat' => $displayFormat ?: '',
        'value' => $resolvedValue,
    ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
@endphp

@pushOnce('head', 'vibe-date-time')
    @vite(['resources/js/vibe/date-time.js'])
@endPushOnce

<div
    data-vibe-date-time
    class="w-full space-y-1.5 text-left {{ $attributes->get('class') }}"
    x-data="typeof window.vibeDateTime === 'function' ? window.vibeDateTime({{ $configJson }}) : {
        id: '{{ $dtId }}',
        mode: '{{ $resolvedMode }}',
        locale: '{{ $resolvedLocale }}',
        isOpen: {{ $inline ? 'true' : 'false' }},
        viewMode: 'days',
        currentMonth: new Date().getMonth(),
        currentYear: new Date().getFullYear(),
        yearsStart: Math.floor(new Date().getFullYear() / 12) * 12,
        selectedDate: null,
        rangeStart: null,
        rangeEnd: null,
        hoverDate: null,
        multipleDates: [],
        presets: @js($presets),
        activePreset: null,
        get rangeDaysCount() { return 0; },
        get availablePresets() { return []; },
        time: { hours: 12, minutes: 0, seconds: 0, period: 'AM' },
        endTime: { hours: 12, minutes: 0, seconds: 0, period: 'PM' },
        inputText: '',
        inputStartText: '',
        inputEndText: '',
        formValue: '',
        weekDayNames: @js($i18n['daysShort'] ?? []),
        dict: @js($i18n),
        init() {
            var self = this;
            var isBound = false;
            var bindDt = function() {
                if (isBound) return;
                if (typeof window.vibeDateTime === 'function') {
                    isBound = true;
                    clearInterval(timer);
                    if (window.Alpine && typeof window.Alpine.initTree === 'function' && self.$el) {
                        var el = self.$el;
                        if (typeof window.Alpine.destroyTree === 'function') {
                            try { window.Alpine.destroyTree(el); } catch (e) {}
                        }
                        delete el._x_dataStack;
                        window.Alpine.initTree(el);
                    }
                }
            };
            window.addEventListener('vibe-date-time-ready', bindDt, { once: true });
            var timer = setInterval(function() {
                if (typeof window.vibeDateTime === 'function') {
                    bindDt();
                }
            }, 25);
            setTimeout(function() { clearInterval(timer); }, 3000);
        },
        prevMonth() {}, nextMonth() {}, prevDecade() {}, nextDecade() {},
        setYear() {}, setMonth() {}, toggleViewMode() {},
        getMonthDays() { return []; },
        selectDay() {}, onDayHover() {}, selectPreset() {},
        updateTime() {}, setTimeNow() {}, stepTime() {}, onTimeInput() {}, onTimeBlur() {}, onTimeKeydown() {}, onTimeWheel() {}, onTimeFocus() {}, getTimeValue() {}, clear() {}, onManualInput() {},
        adjustPosition() {}
    }"
    @if (!$inline)
        @click.outside="isOpen = false"
        @keydown.escape.window="isOpen = false"
    @endif
>
    {{-- Label --}}
    @if ($label)
        <label for="{{ $dtId }}" class="block text-xs font-semibold text-foreground select-none">
            {{ $label }}
            @if ($required)
                <span class="text-destructive font-bold ml-0.5">*</span>
            @endif
        </label>
    @endif

    {{-- Hidden Form Input(s) for Backend Submission --}}
    @if ($name)
        <input type="hidden" name="{{ $name }}" :value="formValue" />
    @endif
    @if ($startName)
        <input type="hidden" name="{{ $startName }}" :value="inputStartText" />
    @endif
    @if ($endName)
        <input type="hidden" name="{{ $endName }}" :value="inputEndText" />
    @endif

    {{-- Interactive Input Trigger (if not inline) --}}
    @if (!$inline)
        <div class="relative w-full">
            {{-- Leading Icon (Calendar or Clock) --}}
            <span class="absolute top-1/2 -translate-y-1/2 {{ $iconSize }} flex items-center justify-center text-muted-foreground pointer-events-none z-10">
                @if (in_array($resolvedMode, ['time', 'time-range']))
                    <svg class="size-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                    </svg>
                @else
                    <svg class="size-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/>
                    </svg>
                @endif
            </span>

            {{-- Text Input --}}
            <input
                id="{{ $dtId }}"
                type="text"
                :value="inputText"
                @click="isOpen = !isOpen"
                @input="onManualInput($event)"
                placeholder="{{ $inputPlaceholder }}"
                @if ($disabled) disabled @endif
                @if ($readonly) readonly @endif
                {{ $attributes->whereDoesntStartWith(['wire:model'])->except(['class', 'disabled', 'readonly'])->merge([
                    'autocomplete' => 'off',
                    'autocorrect' => 'off',
                    'autocapitalize' => 'off',
                    'spellcheck' => 'false',
                ]) }}
                class="block w-full transition-colors duration-150 placeholder:text-muted-foreground focus-visible:outline-none disabled:pointer-events-none disabled:opacity-50 disabled:bg-muted/40 cursor-pointer {{ $sizeClasses }} {{ $variantClasses }}"
            />

            {{-- Trailing Actions: Clear button & Chevron --}}
            <div class="absolute right-2.5 top-1/2 -translate-y-1/2 flex items-center gap-1">
                @if ($clearable)
                    <vibe:button
                        type="button"
                        variant="ghost"
                        size="icon-xs"
                        x-show="formValue"
                        x-cloak
                        @click.stop="clear()"
                        class="size-5 rounded-md text-muted-foreground hover:text-foreground"
                        x-bind:title="dict.clear"
                        x-bind:aria-label="dict.clear"
                    >
                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </vibe:button>
                @endif

                <vibe:button
                    type="button"
                    variant="ghost"
                    size="icon-xs"
                    @click="isOpen = !isOpen"
                    class="size-5 text-muted-foreground hover:text-foreground transition-transform duration-200"
                    x-bind:class="{ 'rotate-180 text-foreground': isOpen }"
                    x-bind:aria-label="isOpen ? dict.clear : dict.selectDate"
                >
                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </vibe:button>
            </div>

            {{-- Popover Panel Container --}}
            <div
                x-ref="popover"
                x-show="isOpen"
                x-cloak
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 translate-y-1 scale-98"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-1 scale-98"
                class="absolute left-0 top-full z-40 mt-1.5 w-max max-w-[calc(100vw-2rem)] rounded-2xl border border-border bg-card text-card-foreground shadow-xl overflow-hidden focus:outline-none"
            >
                <div class="flex flex-col sm:flex-row w-full sm:items-stretch">
                    {{-- Presets Sidebar (if enabled) --}}
                    @if ($presets)
                        @include('vibe.date-time.presets')
                    @endif

                    {{-- Main Picker Content --}}
                    <div class="shrink-0">
                        {{-- Header (unless mode is time or time-range) --}}
                        @if (!in_array($resolvedMode, ['time', 'time-range']))
                            @include('vibe.date-time.header')
                        @endif

                        {{-- Calendar Grid (unless mode is time or time-range) --}}
                        @if (!in_array($resolvedMode, ['time', 'time-range']))
                            @include('vibe.date-time.calendar')
                        @endif

                        {{-- Time Picker (if mode is time, time-range, datetime, or datetime-range) --}}
                        @if (in_array($resolvedMode, ['time', 'time-range', 'datetime', 'datetime-range']))
                            @include('vibe.date-time.time')
                        @endif

                        {{-- Bottom Action Bar --}}
                        <div class="flex items-center justify-between px-3.5 py-2 border-t border-border/70 bg-muted/20 text-xs">
                            <div class="flex items-center gap-2">
                                @if ($clearable)
                                    <vibe:button
                                        type="button"
                                        variant="ghost"
                                        size="sm"
                                        @click="clear()"
                                        class="text-xs font-medium text-muted-foreground hover:text-foreground px-2 h-7"
                                    >
                                        <span x-text="dict.clear"></span>
                                    </vibe:button>
                                @endif

                                <template x-if="rangeDaysCount > 0 && (mode === 'range' || mode === 'datetime-range')">
                                    <vibe:badge
                                        variant="secondary"
                                        size="sm"
                                        class="bg-primary/10 text-primary border border-primary/20 font-semibold"
                                    >
                                        <span x-text="rangeDaysCount + ' ' + (dict.daysCountLabel || '{{ __('vibe/date-time.daysCountLabel', [], $resolvedLocale) }}')"></span>
                                    </vibe:badge>
                                </template>
                            </div>

                            <vibe:button
                                type="button"
                                variant="primary"
                                size="sm"
                                @click="isOpen = false"
                                class="px-3 text-xs"
                            >
                                <span x-text="dict.apply"></span>
                            </vibe:button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Inline Calendar Panel Container --}}
        <div
            x-ref="popover"
            class="w-full sm:w-max rounded-2xl border border-border bg-card text-card-foreground shadow-2xs overflow-hidden"
        >
            <div class="flex flex-col sm:flex-row w-full sm:items-stretch">
                {{-- Presets Sidebar (if enabled) --}}
                @if ($presets)
                    @include('vibe.date-time.presets')
                @endif

                {{-- Main Picker Content --}}
                <div class="shrink-0">
                    {{-- Header (unless mode is time or time-range) --}}
                    @if (!in_array($resolvedMode, ['time', 'time-range']))
                        @include('vibe.date-time.header')
                    @endif

                    {{-- Calendar Grid (unless mode is time or time-range) --}}
                    @if (!in_array($resolvedMode, ['time', 'time-range']))
                        @include('vibe.date-time.calendar')
                    @endif

                    {{-- Time Picker (if mode is time, time-range, datetime, or datetime-range) --}}
                    @if (in_array($resolvedMode, ['time', 'time-range', 'datetime', 'datetime-range']))
                        @include('vibe.date-time.time')
                    @endif

                    {{-- Bottom Action Bar --}}
                    <div class="flex items-center justify-between px-3.5 py-2 border-t border-border/70 bg-muted/20 text-xs">
                        <div class="flex items-center gap-2">
                            @if ($clearable)
                                <vibe:button
                                    type="button"
                                    variant="ghost"
                                    size="xs"
                                    @click="clear()"
                                    class="text-xs font-medium text-muted-foreground hover:text-foreground px-2 h-7"
                                >
                                    <span x-text="dict.clear"></span>
                                </vibe:button>
                            @endif

                            <template x-if="rangeDaysCount > 0 && (mode === 'range' || mode === 'datetime-range')">
                                <vibe:badge
                                    variant="secondary"
                                    size="sm"
                                    class="bg-primary/10 text-primary border border-primary/20 font-semibold"
                                >
                                    <span x-text="rangeDaysCount + ' ' + (dict.daysCountLabel || '{{ __('vibe/date-time.daysCountLabel', [], $resolvedLocale) }}')"></span>
                                </vibe:badge>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Description --}}
    @if ($description && !$hasError)
        <p class="text-xs text-muted-foreground">{{ $description }}</p>
    @endif

    {{-- Error Message --}}
    @if ($hasError && $errorMessage)
        <p class="text-xs font-medium text-destructive flex items-center gap-1.5 animate-in fade-in duration-150">
            <svg class="size-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <span>{{ $errorMessage }}</span>
        </p>
    @endif
</div>
