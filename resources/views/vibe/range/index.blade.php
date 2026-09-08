@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'min' => null,
    'max' => null,
    'step' => 1,
    'value' => null,
    'size' => 'md', // sm, md, lg
    'showValue' => false,
    'valuePrefix' => '',
    'valueSuffix' => '',
    'minLabel' => null,
    'maxLabel' => null,
    'marks' => null, // bool or array of checkpoints
    'checkpoints' => null, // alias for array of checkpoints: ['10 GB', '20 GB', '30 GB', '50 GB', '100 GB']
    'strict' => null, // strict snap: if true, thumb snaps only to marks. If false, can select in-between values!
    'description' => null,
    'error' => null,
    'errorName' => null,
    'wrapperClass' => null,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ? ($name . '-' . uniqid()) : uniqid('range-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = ($error && !is_bool($error)) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    // Track height
    $trackHeight = match ($size) {
        'sm' => '4px',
        'lg' => '8px',
        default => '6px',
    };

    // Thumb size
    $thumbSize = match ($size) {
        'sm' => '14px',
        'lg' => '20px',
        default => '16px',
    };

    $rawMarks = $checkpoints ?? $marks;
    $hasMarks = !empty($rawMarks);
    $parsedMarks = [];

    $computedMin = $min !== null ? (float) $min : 0;
    $computedMax = $max !== null ? (float) $max : 100;
    $computedStep = (float) ($step ?? 1);
    $isStrict = false;

    if ($hasMarks) {
        if (is_bool($rawMarks) && $rawMarks === true) {
            // Auto-generate linear tick marks from min, max, step
            $isStrict = false;
            $stepVal = $computedStep > 0 ? $computedStep : 1;
            $rangeVals = range($computedMin, $computedMax, $stepVal);
            if (count($rangeVals) <= 25) {
                foreach ($rangeVals as $v) {
                    $p = $computedMax > $computedMin ? (($v - $computedMin) / ($computedMax - $computedMin)) * 100 : 0;
                    $parsedMarks[] = [
                        'index' => count($parsedMarks),
                        'val' => (float) $v,
                        'label' => $v . $valueSuffix,
                        'percent' => round($p, 2),
                    ];
                }
            }
        } elseif (is_array($rawMarks)) {
            $count = count($rawMarks);
            $isAssoc = array_keys($rawMarks) !== range(0, $count - 1);

            // Determine strict mode:
            // 1. If strict prop is explicitly passed (strict, :strict="true", :strict="false"), respect it.
            // 2. Otherwise: checkpoints defaults to true (strict discrete tiers), marks defaults to false (allows in-between values).
            if ($strict !== null) {
                $isStrict = (bool) $strict;
            } else {
                $isStrict = ($checkpoints !== null);
            }

            // Verify if values can be treated numerically for in-between selection
            $hasNumericVal = true;
            foreach ($rawMarks as $k => $v) {
                $checkVal = $isAssoc ? $k : $v;
                if (!is_numeric($checkVal) && !preg_match('/^-?\d+(\.\d+)?/', (string) $checkVal)) {
                    $hasNumericVal = false;
                    break;
                }
            }

            // Pure non-numeric strings must default to strict discrete snap
            if (!$hasNumericVal) {
                $isStrict = true;
            }

            if ($isStrict) {
                // Strict mode: slider is quantized to 0 .. count-1 (cannot pick in-between)
                $computedMin = 0;
                $computedMax = max(0, $count - 1);
                $computedStep = 1;
                $i = 0;

                foreach ($rawMarks as $k => $v) {
                    $percent = $count > 1 ? ($i / ($count - 1)) * 100 : 0;
                    $markVal = $isAssoc ? $k : $v;
                    $markLabel = (string) $v;
                    if ($valueSuffix && is_numeric($v) && !str_contains($markLabel, $valueSuffix)) {
                        $markLabel .= $valueSuffix;
                    }
                    $parsedMarks[] = [
                        'index' => $i,
                        'val' => $markVal,
                        'label' => $markLabel,
                        'percent' => round($percent, 2),
                    ];
                    $i++;
                }
            } else {
                // Non-strict mode: user CAN slide and pick in-between values (e.g. 3 GB between 2 and 4 GB)
                $extractedMarks = [];
                foreach ($rawMarks as $k => $v) {
                    if ($isAssoc) {
                        $num = is_numeric($k) ? (float) $k : (float) filter_var($k, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        $lbl = (string) $v;
                    } else {
                        $num = is_numeric($v) ? (float) $v : (float) filter_var($v, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        $lbl = (string) $v;
                        if ($valueSuffix && is_numeric($v) && !str_contains($lbl, $valueSuffix)) {
                            $lbl .= $valueSuffix;
                        }
                    }
                    $extractedMarks[] = ['val' => $num, 'label' => $lbl];
                }

                if ($min === null && !empty($extractedMarks)) {
                    $computedMin = min(array_column($extractedMarks, 'val'));
                }
                if ($max === null && !empty($extractedMarks)) {
                    $computedMax = max(array_column($extractedMarks, 'val'));
                }

                $i = 0;
                foreach ($extractedMarks as $m) {
                    $p = $computedMax > $computedMin ? (($m['val'] - $computedMin) / ($computedMax - $computedMin)) * 100 : 0;
                    $parsedMarks[] = [
                        'index' => $i,
                        'val' => $m['val'],
                        'label' => $m['label'],
                        'percent' => round(max(0, min(100, $p)), 2),
                    ];
                    $i++;
                }
            }
        }
    }

    // Determine initial values
    if ($isStrict) {
        $initialIndex = 0;
        if ($value !== null) {
            foreach ($parsedMarks as $m) {
                if ((string) $m['val'] === (string) $value || (string) $m['index'] === (string) $value || (string) $m['label'] === (string) $value) {
                    $initialIndex = $m['index'];
                    break;
                }
            }
        }
        $initialSliderVal = $initialIndex;
        $initialDisplayVal = $parsedMarks[$initialIndex]['label'] ?? '';
        $initialRawVal = $parsedMarks[$initialIndex]['val'] ?? '';
    } else {
        $initialSliderVal = $value !== null ? (float) $value : $computedMin;
        $initialDisplayVal = $initialSliderVal;
        $initialRawVal = $initialSliderVal;
    }
@endphp

<div class="{{ $wrapperClass }}" x-data="{
    isStrict: {{ $isStrict ? 'true' : 'false' }},
    marks: {{ json_encode($parsedMarks) }},
    sliderVal: {{ $initialSliderVal }},
    currentVal: '{{ $initialDisplayVal }}',
    min: {{ $computedMin }},
    max: {{ $computedMax }},
    updateProgress(el) {
        if (!el) return;
        this.sliderVal = Number(el.value);
        if (this.isStrict && this.marks[this.sliderVal]) {
            this.currentVal = this.marks[this.sliderVal].label;
            if (this.$refs.hiddenInput) {
                this.$refs.hiddenInput.value = this.marks[this.sliderVal].val;
                this.$refs.hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
                this.$refs.hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
            }
        } else {
            this.currentVal = this.sliderVal;
        }
        let p = ((this.sliderVal - this.min) / (this.max - this.min)) * 100;
        let safeP = Math.min(100, Math.max(0, isNaN(p) ? 0 : p));
        el.style.setProperty('--progress', safeP + '%');
    },
    jumpTo(target) {
        if (this.$refs.range) {
            this.$refs.range.value = target;
            this.updateProgress(this.$refs.range);
            this.$refs.range.dispatchEvent(new Event('input', { bubbles: true }));
            this.$refs.range.dispatchEvent(new Event('change', { bubbles: true }));
        }
    },
    isMarkActive(mark) {
        return this.isStrict ? (this.sliderVal >= mark.index) : (this.sliderVal >= mark.val);
    },
    isMarkSelected(mark) {
        return this.isStrict ? (this.sliderVal === mark.index) : (this.sliderVal === mark.val);
    },
    init() {
        this.$nextTick(() => {
            this.updateProgress(this.$refs.range);
        });
    }
}">
    {{-- Header: Label & Live Value Display --}}
    @if ($label || $showValue)
        <div class="flex items-center justify-between mb-1.5 select-none">
            @if ($label)
                <label for="{{ $id }}" class="block text-xs font-semibold text-foreground">
                    {{ $label }}
                    @if ($attributes->has('required') && $attributes->get('required') !== false)
                        <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
                    @endif
                </label>
            @endif

            @if ($showValue)
                <span class="text-xs font-mono font-medium px-2 py-0.5 rounded-md bg-muted text-foreground border border-border shadow-2xs">
                    {{ $valuePrefix }}<span x-text="currentVal"></span>{{ $isStrict ? '' : $valueSuffix }}
                </span>
            @endif
        </div>
    @endif

    @if ($description)
        <p class="mb-2 text-xs text-muted-foreground">{{ $description }}</p>
    @endif

    {{-- Slider Input with Active Checkpoint Marks --}}
    <div class="relative flex items-center w-full select-none py-1">
        {{-- Hidden input for discrete checkpoints mode to submit actual value --}}
        @if ($isStrict)
            <input
                type="hidden"
                x-ref="hiddenInput"
                id="{{ $id }}"
                @if($name) name="{{ $name }}" @endif
                value="{{ $initialRawVal }}"
                {{ $attributes->whereStartsWith('wire:model') }}
            />
        @endif

        {{-- Visual Checkpoint Dots on the Track --}}
        @if (!empty($parsedMarks))
            <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 pointer-events-none z-0 px-[calc({{ $thumbSize }}/2)]">
                <div class="relative w-full h-0">
                    <template x-for="(mark, idx) in marks" :key="idx">
                        <span
                            class="absolute top-1/2 -translate-y-1/2 -translate-x-1/2 size-1.5 rounded-full transition-colors duration-150"
                            :class="isMarkActive(mark) ? 'bg-background/90 shadow-2xs' : 'bg-muted-foreground/40'"
                            :style="'left: ' + mark.percent + '%'"
                        ></span>
                    </template>
                </div>
            </div>
        @endif

        {{-- Native Range Input --}}
        <input
            type="range"
            x-ref="range"
            @if(!$isStrict) id="{{ $id }}" @if($name) name="{{ $name }}" @endif @endif
            min="{{ $computedMin }}"
            max="{{ $computedMax }}"
            step="{{ $computedStep }}"
            value="{{ $initialSliderVal }}"
            @input="updateProgress($el)"
            @change="updateProgress($el)"
            class="vibe-range w-full py-1.5 z-10"
            style="--range-track-height: {{ $trackHeight }}; --range-thumb-size: {{ $thumbSize }}; {{ $hasError ? '--range-active-color: var(--destructive); --range-track-color: color-mix(in srgb, var(--destructive) 20%, transparent);' : '' }}"
            {{ $isStrict ? $attributes->whereDoesntStartWith('wire:model') : $attributes }}
        />
    </div>

    {{-- Bottom Marks / Labels --}}
    @if (!empty($parsedMarks))
        {{-- Interactive Checkpoint Labels --}}
        <div class="relative w-full h-5 select-none mt-1 px-[calc({{ $thumbSize }}/2)]">
            <div class="relative w-full h-full text-[11px] font-medium text-muted-foreground">
                <template x-for="(mark, idx) in marks" :key="idx">
                    <button
                        type="button"
                        @click="jumpTo(isStrict ? mark.index : mark.val)"
                        :disabled="{{ $attributes->has('disabled') && $attributes->get('disabled') !== false ? 'true' : 'false' }}"
                        class="absolute top-0 -translate-x-1/2 transition-colors hover:text-foreground cursor-pointer focus:outline-none focus-visible:text-primary focus-visible:font-semibold disabled:pointer-events-none disabled:opacity-40"
                        :class="{ 'text-foreground font-semibold': isMarkSelected(mark) }"
                        :style="'left: ' + mark.percent + '%'"
                        x-text="mark.label"
                    ></button>
                </template>
            </div>
        </div>
    @elseif ($minLabel !== null || $maxLabel !== null)
        <div class="flex items-center justify-between text-[11px] text-muted-foreground font-medium px-0.5 mt-0.5 select-none">
            <span>{{ $minLabel ?? $min }}</span>
            <span>{{ $maxLabel ?? $max }}</span>
        </div>
    @endif

    {{-- Error Message --}}
    @if ($hasError && $errorMessage)
        <p class="mt-1 text-xs text-destructive flex items-center gap-1">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
            </svg>
            {{ $errorMessage }}
        </p>
    @endif
</div>
