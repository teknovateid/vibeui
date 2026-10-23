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

        registerStep(val, disabled = false, error = false, stepClickable = null) {
            val = String(val);
            const existing = this.steps.find(s => s.value === val);
            if (!existing) {
                this.steps.push({
                    value: val,
                    disabled: Boolean(disabled),
                    error: Boolean(error),
                    clickable: stepClickable === null ? null : Boolean(stepClickable)
                });
            } else {
                existing.disabled = Boolean(disabled);
                existing.error = Boolean(error);
                existing.clickable = stepClickable === null ? null : Boolean(stepClickable);
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

        isLastStep(val) {
            if (this.steps.length === 0) return false;
            return String(this.steps[this.steps.length - 1].value) === String(val);
        },

        isStepCompleted(val) {
            val = String(val);
            if (this.isStepError(val)) return false;
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
            val = String(val);
            const target = this.steps.find(s => String(s.value) === val);
            if (target && target.disabled) return false;

            const canClick = (target && target.clickable !== null) ? target.clickable : this.clickable;
            if (!canClick) return false;

            if (!this.linear) return true;

            const targetIdx = this.steps.findIndex(s => String(s.value) === val);
            if (targetIdx === -1) return false;
            if (targetIdx <= this.currentIndex) return true;
            if (this.completedSteps.includes(val)) return true;

            for (let i = 0; i < targetIdx; i++) {
                const prevStep = this.steps[i];
                if (prevStep.error || !this.isStepCompleted(prevStep.value)) {
                    return false;
                }
            }
            return true;
        },

        headerListClasses() {
            if (this.orientation === 'vertical') {
                return 'flex flex-col items-stretch w-full';
            }
            if (this.variant === 'cards') {
                if (this.totalSteps === 2) return 'grid grid-cols-1 sm:grid-cols-2 gap-3.5 w-full';
                if (this.totalSteps >= 4) return 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 w-full';
                return 'grid grid-cols-1 sm:grid-cols-3 gap-3.5 w-full';
            }
            if (this.variant === 'progress') {
                if (this.totalSteps === 2) return 'grid grid-cols-1 sm:grid-cols-2 gap-3 w-full';
                if (this.totalSteps >= 4) return 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 w-full';
                return 'grid grid-cols-1 sm:grid-cols-3 gap-3 w-full';
            }
            return 'flex flex-row items-center justify-between gap-2 sm:gap-3 overflow-x-auto hide-scroll py-1 w-full';
        },

        stepItemClasses(val) {
            if (this.orientation === 'vertical') {
                return 'w-full flex items-start gap-4 pb-8 last:pb-0';
            }
            if (this.variant === 'cards' || this.variant === 'progress') {
                return 'w-full flex items-stretch';
            }
            return this.isLastStep(val)
                ? 'flex-none flex items-center'
                : 'flex-1 flex items-center min-w-fit';
        },

        verticalRailClasses() {
            if (this.size === 'sm') return 'left-3.5 top-7 bottom-0';
            if (this.size === 'lg') return 'left-5.5 top-11 bottom-0';
            return 'left-4.5 top-9 bottom-0';
        },

        stepButtonClasses(val) {
            const accessible = this.isStepAccessible(val);
            const active = this.isStepActive(val);
            const completed = this.isStepCompleted(val);
            const error = this.isStepError(val);

            const cursorCls = accessible ? 'cursor-pointer' : 'cursor-default';
            const lockedCls = (!accessible && !active && !completed && this.linear) ? 'opacity-50 pointer-events-none' : '';

            if (this.variant === 'cards') {
                let stateCls = 'border-border/60 bg-muted/15 opacity-80 hover:opacity-100 hover:border-border';
                if (error) {
                    stateCls = 'border-destructive bg-destructive/5 ring-2 ring-destructive/20';
                } else if (active) {
                    stateCls = 'border-primary bg-primary/5 ring-2 ring-primary/20 shadow-xs';
                } else if (completed) {
                    stateCls = 'border-border bg-card hover:bg-muted/40 hover:border-primary/40 shadow-2xs';
                }
                return `w-full p-4 border rounded-xl flex flex-row items-start gap-3.5 text-left h-full ${stateCls} ${cursorCls} ${lockedCls}`;
            }

            if (this.variant === 'pill') {
                let stateCls = 'border-border bg-muted/40 text-muted-foreground hover:bg-muted/70 hover:text-foreground';
                if (error) {
                    stateCls = 'border-destructive bg-destructive text-destructive-foreground ring-2 ring-destructive/20';
                } else if (active) {
                    stateCls = 'border-primary bg-primary text-primary-foreground shadow-xs ring-2 ring-primary/20';
                } else if (completed) {
                    stateCls = 'border-primary/40 bg-primary/10 text-primary hover:bg-primary/15';
                }
                return `px-3.5 py-1.5 sm:px-4 sm:py-2 rounded-full border text-xs sm:text-sm font-medium gap-2 inline-flex flex-row items-center justify-center text-left shrink-0 ${stateCls} ${cursorCls} ${lockedCls}`;
            }

            if (this.variant === 'progress') {
                return `flex flex-col items-start text-left gap-2.5 w-full py-1 ${cursorCls} ${lockedCls}`;
            }

            const alignCls = this.orientation === 'vertical'
                ? 'inline-flex flex-row items-start text-left gap-3.5'
                : 'inline-flex flex-row items-center text-left gap-3 shrink-0';

            return `${alignCls} ${cursorCls} ${lockedCls}`;
        },

        stepCircleClasses(val) {
            const sizeCls = this.size === 'sm' ? 'size-7 text-xs' : (this.size === 'lg' ? 'size-11 text-base' : 'size-9 text-sm');
            if (this.isStepError(val)) {
                return `${sizeCls} bg-destructive text-destructive-foreground border-destructive ring-4 ring-destructive/20 shadow-xs`;
            }
            if (this.isStepActive(val)) {
                return `${sizeCls} bg-primary text-primary-foreground border-primary ring-4 ring-primary/20 shadow-xs`;
            }
            if (this.isStepCompleted(val)) {
                return `${sizeCls} bg-primary text-primary-foreground border-primary shadow-2xs`;
            }
            return `${sizeCls} bg-muted/50 text-muted-foreground border-border group-hover/step:border-muted-foreground/40 group-hover/step:bg-muted`;
        },

        stepDotClasses(val) {
            if (this.isStepError(val)) {
                return 'size-3.5 bg-destructive ring-4 ring-destructive/20';
            }
            if (this.isStepActive(val)) {
                return 'size-3.5 bg-primary ring-4 ring-primary/20 shadow-xs';
            }
            if (this.isStepCompleted(val)) {
                return 'size-3 bg-primary';
            }
            return 'size-2.5 bg-muted-foreground/40 group-hover/step:bg-muted-foreground/60';
        },

        stepProgressClasses(val) {
            if (this.isStepError(val)) {
                return 'w-full bg-destructive';
            }
            if (this.isStepCompleted(val) || this.isStepActive(val)) {
                return 'w-full bg-primary';
            }
            return 'w-0 bg-primary';
        },

        stepTitleClasses(val) {
            const sizeCls = this.size === 'sm' ? 'text-xs' : (this.size === 'lg' ? 'text-base' : 'text-sm');
            const truncCls = (this.variant !== 'cards' && this.orientation !== 'vertical') ? 'truncate' : '';

            if (this.variant === 'pill') {
                if (this.isStepError(val)) return `${sizeCls} ${truncCls} text-destructive-foreground font-semibold`;
                if (this.isStepActive(val)) return `${sizeCls} ${truncCls} text-primary-foreground font-semibold`;
                if (this.isStepCompleted(val)) return `${sizeCls} ${truncCls} text-primary font-medium`;
                return `${sizeCls} ${truncCls} text-muted-foreground font-medium`;
            }

            if (this.isStepError(val)) return `${sizeCls} ${truncCls} text-destructive font-semibold`;
            if (this.isStepActive(val)) return `${sizeCls} ${truncCls} text-foreground font-semibold`;
            if (this.isStepCompleted(val)) return `${sizeCls} ${truncCls} text-foreground font-medium`;
            return `${sizeCls} ${truncCls} text-muted-foreground font-medium`;
        },

        stepDescriptionClasses(val) {
            const sizeCls = this.size === 'sm' ? 'text-[11px]' : 'text-xs';
            const truncCls = (this.variant !== 'cards' && this.orientation !== 'vertical') ? 'truncate' : '';

            if (this.variant === 'pill') {
                if (this.isStepError(val)) return `${sizeCls} ${truncCls} text-destructive-foreground/85`;
                if (this.isStepActive(val)) return `${sizeCls} ${truncCls} text-primary-foreground/80`;
                if (this.isStepCompleted(val)) return `${sizeCls} ${truncCls} text-primary/80`;
                return `${sizeCls} ${truncCls} text-muted-foreground`;
            }

            if (this.isStepError(val)) return `${sizeCls} ${truncCls} text-destructive/80`;
            return `${sizeCls} ${truncCls} text-muted-foreground`;
        },

        goTo(val) {
            val = String(val);
            if (!this.isStepAccessible(val)) return;
            this.currentStep = val;
        },

        next() {
            const currentObj = this.steps[this.currentIndex];
            if (this.linear && currentObj && currentObj.error) {
                return;
            }

            if (this.isLast()) {
                this.$dispatch('vibe-stepper:finish', { current: this.currentStep, total: this.totalSteps });
                return;
            }

            const curVal = String(this.currentStep);
            if (!this.completedSteps.includes(curVal)) {
                this.completedSteps.push(curVal);
            }

            const nextIdx = this.currentIndex + 1;
            if (nextIdx < this.steps.length && !this.steps[nextIdx].disabled) {
                this.currentStep = this.steps[nextIdx].value;
            }
        },

        prev() {
            if (this.isFirst()) return;
            const prevIdx = this.currentIndex - 1;
            if (prevIdx >= 0 && !this.steps[prevIdx].disabled) {
                this.currentStep = this.steps[prevIdx].value;
            }
        },

        reset() {
            if (this.steps.length > 0) {
                this.completedSteps = [];
                this.currentStep = this.steps[0].value;
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

        setStepError(val, hasError = true) {
            val = String(val);
            const target = this.steps.find(s => String(s.value) === val);
            if (target) {
                target.error = Boolean(hasError);
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
