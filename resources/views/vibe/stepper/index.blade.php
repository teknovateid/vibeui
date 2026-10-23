@blaze(fold: true)

@props([
    'step' => null,
    'value' => null,
    'default' => 1,
    'linear' => false,
    'orientation' => 'horizontal', // 'horizontal' | 'vertical'
    'variant' => 'default',       // 'default' | 'dots' | 'progress' | 'cards' | 'pill'
    'size' => 'md',               // 'sm' | 'md' | 'lg'
    'clickable' => true,
    'persist' => false,
    'syncUrl' => false,
    'id' => null,
])

@php
    $wireModel = $attributes->wire('model')->value();
    $isWireModel = !empty($wireModel);
    $stepperId = $id ?? 'stepper-' . substr(md5(uniqid('vibe_stepper_', true)), 0, 8);
    $initialStep = (string) ($step ?? $value ?? $default ?? 1);
    $storageKey = 'vibe-stepper-' . $stepperId;

    $baseClasses = 'vibe-stepper w-full';
    $orientationClasses = match ($orientation) {
        'vertical' => 'flex flex-col gap-6',
        default => 'flex flex-col gap-4',
    };
@endphp

<div
    id="{{ $stepperId }}"
    data-vibe-stepper
    x-data="{
        stepperId: @js($stepperId),
        currentStep: {{ $isWireModel ? '$wire.entangle(\''.$wireModel.'\')' : ($persist ? 'sessionStorage.getItem(\''.$storageKey.'\') || ' . \Illuminate\Support\Js::from($initialStep) : \Illuminate\Support\Js::from($initialStep)) }},
        linear: @js((bool) $linear),
        orientation: @js($orientation),
        variant: @js($variant),
        size: @js($size),
        clickable: @js((bool) $clickable),
        persist: @js((bool) $persist),
        syncUrl: @js(is_string($syncUrl) ? $syncUrl : ($syncUrl ? 'step' : false)),
        steps: [],
        completedSteps: [],

        registerStep(val, disabled = false, error = false) {
            val = String(val);
            const existing = this.steps.find(s => s.value === val);
            if (!existing) {
                this.steps.push({ value: val, disabled: Boolean(disabled), error: Boolean(error) });
            } else {
                existing.disabled = Boolean(disabled);
                existing.error = Boolean(error);
            }
        },

        get totalSteps() {
            return this.steps.length;
        },

        get currentIndex() {
            const idx = this.steps.findIndex(s => String(s.value) === String(this.currentStep));
            return idx !== -1 ? idx : 0;
        },

        isFirst() {
            return this.currentIndex <= 0;
        },

        isLast() {
            return this.steps.length > 0 && this.currentIndex >= this.steps.length - 1;
        },

        isStepCompleted(val) {
            val = String(val);
            if (this.completedSteps.includes(val)) return true;
            const targetIdx = this.steps.findIndex(s => String(s.value) === val);
            if (targetIdx !== -1 && targetIdx < this.currentIndex) return true;
            return false;
        },

        isStepActive(val) {
            return String(this.currentStep) === String(val);
        },

        isStepError(val) {
            val = String(val);
            const stepObj = this.steps.find(s => String(s.value) === val);
            return stepObj ? Boolean(stepObj.error) : false;
        },

        isStepAccessible(val) {
            if (!this.clickable) return false;
            val = String(val);
            const target = this.steps.find(s => String(s.value) === val);
            if (target && target.disabled) return false;
            if (!this.linear) return true;

            const targetIdx = this.steps.findIndex(s => String(s.value) === val);
            if (targetIdx === -1) return true;
            if (targetIdx <= this.currentIndex) return true;
            return targetIdx === this.currentIndex + 1;
        },

        goTo(val) {
            val = String(val);
            if (!this.isStepAccessible(val)) return;
            const prev = this.currentStep;
            this.currentStep = val;
            this.afterStepChange(prev, val);
        },

        next() {
            if (this.isLast()) {
                this.$dispatch('vibe-stepper:finish', { current: this.currentStep, total: this.totalSteps });
                return;
            }
            const curVal = String(this.currentStep);
            if (!this.completedSteps.includes(curVal)) {
                this.completedSteps.push(curVal);
            }
            const nextIdx = this.currentIndex + 1;
            if (nextIdx < this.steps.length) {
                const nextVal = this.steps[nextIdx].value;
                const prev = this.currentStep;
                this.currentStep = nextVal;
                this.afterStepChange(prev, nextVal);
            }
        },

        prev() {
            if (this.isFirst()) return;
            const prevIdx = this.currentIndex - 1;
            if (prevIdx >= 0) {
                const prevVal = this.steps[prevIdx].value;
                const prev = this.currentStep;
                this.currentStep = prevVal;
                this.afterStepChange(prev, prevVal);
            }
        },

        reset() {
            if (this.steps.length > 0) {
                this.completedSteps = [];
                this.currentStep = this.steps[0].value;
                this.afterStepChange(null, this.currentStep);
            }
        },

        setStepCompleted(val, isCompleted = true) {
            val = String(val);
            if (isCompleted && !this.completedSteps.includes(val)) {
                this.completedSteps.push(val);
            } else if (!isCompleted) {
                this.completedSteps = this.completedSteps.filter(v => v !== val);
            }
        },

        afterStepChange(prev, next) {
            if (this.persist) {
                try {
                    sessionStorage.setItem('vibe-stepper-' + this.stepperId, next);
                } catch (e) {}
            }
            if (this.syncUrl) {
                const url = new URL(window.location.href);
                url.searchParams.set(this.syncUrl, next);
                window.history.replaceState({}, '', url.toString());
            }
            this.$dispatch('vibe-stepper:change', { current: next, previous: prev, index: this.currentIndex, total: this.totalSteps });
            this.$dispatch('vibe-stepper:step-change', { current: next, previous: prev, index: this.currentIndex, total: this.totalSteps });
        },

        init() {
            if (this.syncUrl) {
                const p = new URLSearchParams(window.location.search);
                const val = p.get(this.syncUrl);
                if (val) this.currentStep = val;
            }
            this.$watch('currentStep', (val, oldVal) => {
                if (String(val) !== String(oldVal)) {
                    this.afterStepChange(oldVal, val);
                }
            });
        }
    }"
    {{ $attributes->twMerge(['class' => "$baseClasses $orientationClasses"]) }}
>
    {{ $slot }}
</div>
