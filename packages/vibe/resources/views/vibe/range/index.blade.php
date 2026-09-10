@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'min' => null,
    'max' => null,
    'step' => 1,
    'value' => null,
    'size' => 'md', // sm, md, lg, xl
    'variant' => 'primary', // primary, secondary, success, warning, danger, info, accent
    'showValue' => false,
    'valuePrefix' => '',
    'valueSuffix' => '',
    'minLabel' => null,
    'maxLabel' => null,
    'marks' => null, // bool or array of checkpoints
    'checkpoints' => null, // alias for array of checkpoints: ['10 GB', '20 GB', '30 GB', '50 GB', '100 GB']
    'strict' => null, // strict snap: if true, thumb snaps only to marks. If false, can select in-between values!
    'description' => null,
    'info' => null,
    'error' => null,
    'errorName' => null,
    'disabled' => false,
    'readonly' => false,
    'wrapperClass' => null,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ?? uniqid('range-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = $error && !is_bool($error) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $isDisabled = $disabled || ($attributes->has('disabled') && $attributes->get('disabled') !== false);
    $isReadonly = $readonly || ($attributes->has('readonly') && $attributes->get('readonly') !== false);

    // Track height
    $trackHeight = match ($size) {
        'sm' => '4px',
        'lg' => '8px',
        'xl' => '10px',
        default => '6px',
    };

    // Thumb size
    $thumbSize = match ($size) {
        'sm' => '14px',
        'lg' => '20px',
        'xl' => '24px',
        default => '16px',
    };

    // Semantic color variant
    $activeColor = match ($variant) {
        'secondary' => 'var(--secondary)',
        'success' => 'var(--success, #10b981)',
        'warning' => 'var(--warning, #f59e0b)',
        'danger', 'destructive' => 'var(--destructive)',
        'info' => 'var(--info, #0ea5e9)',
        'accent' => 'var(--accent, #8b5cf6)',
        default => 'var(--primary)',
    };

    if ($hasError) {
        $activeColor = 'var(--destructive)';
    }

    $trackColor = $hasError ? 'color-mix(in srgb, var(--destructive) 20%, transparent)' : 'var(--input)';

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
                $isStrict = $checkpoints !== null;
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

            // Pure non-numeric strings must default to strict discrete snap,
            // BUT only if the user has NOT explicitly set :strict="false"
            if (!$hasNumericVal && $strict === null) {
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
                // Non-strict mode: user CAN slide and pick in-between values
                if (!$hasNumericVal) {
                    // Non-numeric strings (e.g. ['Low','Medium','High']) with :strict="false":
                    // Use index-based equal spacing so labels are evenly distributed.
                    // Slider operates in 0..N-1 range; user can freely pick fractional positions.
                    $computedMin = 0;
                    $computedMax = max(0, $count - 1);
                    $i = 0;
                    foreach ($rawMarks as $k => $v) {
                        $percent = $count > 1 ? ($i / ($count - 1)) * 100 : 0;
                        $parsedMarks[] = [
                            'index' => $i,
                            'val' => $i,
                            'label' => (string) $v,
                            'percent' => round($percent, 2),
                        ];
                        $i++;
                    }
                } else {
                    // Numeric values: use actual numeric positioning (e.g. 3 GB between 2 and 4 GB)
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

    $wrapperBaseClasses = 'w-full ' . ($isDisabled ? 'opacity-50 pointer-events-none cursor-not-allowed ' : '') . ($isReadonly ? 'cursor-default ' : '');
    $sliderClasses = 'vibe-range w-full py-1.5 z-10 ' . ($isReadonly ? 'pointer-events-none cursor-default' : 'cursor-pointer');

    // Compute initial --progress for server-side render so the track gradient is correct on first paint
    // (CSS default is 50% which causes a wrong-color flash before Alpine.js hydrates)
    $initialProgress = 0;
    if ($computedMax - $computedMin > 0) {
        $initialProgress = (($initialSliderVal - $computedMin) / ($computedMax - $computedMin)) * 100;
        $initialProgress = round(min(100, max(0, $initialProgress)), 4);
    }
@endphp

<div {{ $attributes->only('class')->twMerge(['class' => trim("{$wrapperBaseClasses} {$wrapperClass}")]) }} x-data="{
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
    getLabelStyle(mark) {
        if (mark.percent === 0) return 'left: 0';
        if (mark.percent === 100) return 'right: 0; left: auto';
        return 'left: ' + mark.percent + '%';
    },
    getLabelClass(mark) {
        if (mark.percent === 0 || mark.percent === 100) return '';
        return '-translate-x-1/2';
    },
    handleWheel(e) {
        e.preventDefault();
        const step = {{ $computedStep }};
        const delta = e.deltaY < 0 ? step : -step;
        const newVal = Math.min(this.max, Math.max(this.min, this.sliderVal + delta));
        if (newVal === this.sliderVal) return;
        this.sliderVal = newVal;
        if (this.$refs.range) {
            this.$refs.range.value = newVal;
            this.updateProgress(this.$refs.range);
            this.$refs.range.dispatchEvent(new Event('input', { bubbles: true }));
            this.$refs.range.dispatchEvent(new Event('change', { bubbles: true }));
        }
    },
    init() {
        this.$watch('sliderVal', (val) => {
            let p = ((val - this.min) / (this.max - this.min)) * 100;
            let safeP = Math.min(100, Math.max(0, isNaN(p) ? 0 : p));
            if (this.$refs.range) {
                this.$refs.range.style.setProperty('--progress', safeP + '%');
            }
        });
        this.$nextTick(() => {
            this.updateProgress(this.$refs.range);
        });
    }
}">
    {{-- Header: Label & Live Value Display --}}
    @if ($label || $showValue)
        <div class="flex items-center {{ $label ? 'justify-between' : 'justify-end' }} mb-1.5 select-none gap-2">
            @if ($label)
                <label for="{{ $id }}" class="block text-xs font-semibold text-foreground">
                    {{ $label }}
                    @if ($attributes->has('required') && $attributes->get('required') !== false)
                        <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
                    @endif
                </label>
            @endif

            @if ($showValue)
                <span class="text-xs font-mono font-medium px-2 py-0.5 rounded-md {{ $hasError ? 'bg-destructive/10 text-destructive border-destructive/30' : 'bg-muted text-foreground border-border' }} border shadow-2xs shrink-0">
                    {{ $valuePrefix }}<span x-text="currentVal"></span>{{ $isStrict ? '' : $valueSuffix }}
                </span>
            @endif
        </div>
    @endif

    @if ($description)
        <p id="{{ $id }}-description" class="mb-2 text-xs text-muted-foreground">{{ $description }}</p>
    @endif

    {{-- Slider Input with Active Checkpoint Marks --}}
    <div class="relative flex items-center w-full select-none py-1">
        {{-- Hidden input for discrete checkpoints mode to submit actual value --}}
        @if ($isStrict)
            <input type="hidden" x-ref="hiddenInput" id="{{ $id }}-value" @if ($name) name="{{ $name }}" @endif value="{{ $initialRawVal }}" {{ $attributes->whereStartsWith('wire:model') }} />
        @endif

        {{-- Visual Checkpoint Dots on the Track --}}
        @if (!empty($parsedMarks))
            <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 pointer-events-none z-0 px-[calc({{ $thumbSize }}/2)]">
                <div class="relative w-full h-0">
                    <template x-for="(mark, idx) in marks" :key="idx">
                        {{-- Hide dots at 0% and 100% (track endpoints are visually clear without them) --}}
                        <span x-show="mark.percent > 0 && mark.percent < 100" class="absolute top-1/2 -translate-y-1/2 -translate-x-1/2 size-1.5 rounded-full transition-colors duration-150" :class="isMarkActive(mark) ? 'bg-background shadow-2xs' : 'bg-muted-foreground/40'" :style="'left: ' + mark.percent + '%'"></span>
                    </template>
                </div>
            </div>
        @endif

        {{-- Native Range Input --}}
        <input type="range" x-ref="range" id="{{ $id }}" @if (!$isStrict && $name) name="{{ $name }}" @endif min="{{ $computedMin }}" max="{{ $computedMax }}" step="{{ $computedStep }}" value="{{ $initialSliderVal }}" @input="updateProgress($el)" @change="updateProgress($el)" @wheel.prevent="handleWheel($event)" @if ($isDisabled) disabled @endif @if ($isReadonly) readonly @mousedown.prevent @keydown.prevent @endif @if ($hasError) aria-invalid="true" @endif @if ($describedByString) aria-describedby="{{ $describedByString }}" @endif :aria-valuetext="isStrict ? (marks[sliderVal] ? marks[sliderVal].label : String(sliderVal)) : String(currentVal)" style="--range-track-height: {{ $trackHeight }}; --range-thumb-size: {{ $thumbSize }}; --range-active-color: {{ $activeColor }}; --range-track-color: {{ $trackColor }}; --progress: {{ $initialProgress }}%;" {{ ($isStrict ? $attributes->whereDoesntStartWith('wire:model') : $attributes)->except(['class', 'disabled', 'readonly'])->twMerge(['class' => $sliderClasses]) }} />
    </div>

    {{-- Bottom Marks / Labels --}}
    @if (!empty($parsedMarks))
        {{-- Interactive Checkpoint Labels --}}
        <div class="relative w-full h-5 select-none mt-1 px-[calc({{ $thumbSize }}/2)]">
            <div class="relative w-full h-full text-[11px] font-medium text-muted-foreground">
                <template x-for="(mark, idx) in marks" :key="idx">
                    <button type="button" @click="jumpTo(isStrict ? mark.index : mark.val)" :disabled="{{ $isDisabled || $isReadonly ? 'true' : 'false' }}" class="absolute top-0 transition-colors hover:text-foreground cursor-pointer focus:outline-none focus-visible:text-primary focus-visible:font-semibold disabled:pointer-events-none disabled:opacity-40" :class="[getLabelClass(mark), { 'text-foreground font-semibold': isMarkSelected(mark) }]" :style="getLabelStyle(mark)" x-text="mark.label"></button>
                </template>
            </div>
        </div>
    @elseif ($minLabel !== null || $maxLabel !== null)
        <div class="flex items-center justify-between text-[11px] text-muted-foreground font-medium px-0.5 mt-0.5 select-none">
            <span>{{ $minLabel ?? $min }}</span>
            <span>{{ $maxLabel ?? $max }}</span>
        </div>
    @endif

    {{-- Error Message & Info --}}
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
