@blaze(fold: true)
@props([
    'step' => null,
    'value' => null,
    'title' => null,
    'description' => null,
    'icon' => null,
    'completedIcon' => null,
    'disabled' => false,
    'error' => false,
    'clickable' => null,
])

@php
    $stepVal = (string) ($step ?? $value ?? 1);
@endphp

<li
    x-init="registerStep(@js($stepVal), @js((bool) $disabled), @js((bool) $error), @js($clickable))"
    x-effect="registerStep(@js($stepVal), @js((bool) $disabled), @js((bool) $error), @js($clickable))"
    x-bind:data-step="@js($stepVal)"
    class="vibe-stepper-item relative group"
    :class="stepItemClasses(@js($stepVal))"
>
    {{-- Vertical Connector Line (Rail) --}}
    <div
        x-show="orientation === 'vertical' && !isLastStep(@js($stepVal))"
        x-cloak
        class="absolute w-0.5 bg-border -translate-x-1/2 overflow-hidden pointer-events-none"
        :class="verticalRailClasses()"
    >
        <div
            class="w-full bg-primary transition-all duration-300"
            :style="{ height: isStepCompleted(@js($stepVal)) ? '100%' : '0%' }"
        ></div>
    </div>

    {{-- Step Trigger Button / Container --}}
    <button
        type="button"
        role="tab"
        x-bind:id="stepperId + '-step-' + @js($stepVal)"
        x-bind:aria-selected="isStepActive(@js($stepVal)) ? 'true' : 'false'"
        x-bind:aria-current="isStepActive(@js($stepVal)) ? 'step' : null"
        x-bind:disabled="!isStepAccessible(@js($stepVal))"
        @click="goTo(@js($stepVal))"
        {{ $attributes->twMerge([
            'class' => 'group/step relative focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 rounded-lg transition-all duration-200 select-none disabled:cursor-not-allowed'
        ]) }}
        :class="stepButtonClasses(@js($stepVal))"
    >
        {{-- 1. Variant: Segmented Progress Bar --}}
        <div x-show="variant === 'progress'" x-cloak class="w-full">
            <div class="w-full h-2 bg-muted rounded-full overflow-hidden relative">
                <div
                    class="h-full transition-all duration-300 rounded-full"
                    :class="stepProgressClasses(@js($stepVal))"
                ></div>
            </div>
        </div>

        {{-- 2. Variant: Non-Progress Indicators (Default, Cards, Dots, Pill) --}}
        <div x-show="variant !== 'progress'" class="flex items-center shrink-0">
            {{-- Pill Indicator (Checkmark on Completed or Error Icon) --}}
            <span
                x-show="variant === 'pill' && (isStepCompleted(@js($stepVal)) || isStepError(@js($stepVal)))"
                x-cloak
                class="inline-flex items-center justify-center shrink-0 -ml-0.5"
            >
                <span x-show="isStepCompleted(@js($stepVal)) && !isStepError(@js($stepVal))">
                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                </span>
                <span x-show="isStepError(@js($stepVal))">
                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                </span>
            </span>

            {{-- Dot Indicator for Dots Variant --}}
            <div
                x-show="variant === 'dots'"
                x-cloak
                class="size-5 flex items-center justify-center shrink-0"
            >
                <div
                    class="rounded-full transition-all duration-200"
                    :class="stepDotClasses(@js($stepVal))"
                ></div>
            </div>

            {{-- Circle / Number Indicator for Default and Cards Variants --}}
            <div
                x-show="variant === 'default' || variant === 'cards'"
                class="rounded-full border font-semibold flex items-center justify-center transition-all duration-200 shrink-0"
                :class="stepCircleClasses(@js($stepVal))"
            >
                {{-- Checkmark Icon when completed --}}
                <span x-show="isStepCompleted(@js($stepVal)) && !isStepActive(@js($stepVal)) && !isStepError(@js($stepVal))" x-cloak>
                    @if ($completedIcon)
                        {!! $completedIcon !!}
                    @else
                        <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6 9 17l-5-5"/>
                        </svg>
                    @endif
                </span>

                {{-- Error Icon when error --}}
                <span x-show="isStepError(@js($stepVal))" x-cloak>
                    <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                </span>

                {{-- Default Number or Custom Icon --}}
                <span x-show="(!isStepCompleted(@js($stepVal)) || isStepActive(@js($stepVal))) && !isStepError(@js($stepVal))">
                    @if ($icon)
                        {!! $icon !!}
                    @else
                        {{ $stepVal }}
                    @endif
                </span>
            </div>
        </div>

        {{-- Text Content (Title & Description) --}}
        @if ($title || $description || $slot->isNotEmpty())
            <div class="flex flex-col min-w-0 flex-1 text-left">
                @if ($title)
                    <span
                        class="transition-colors leading-snug text-left"
                        :class="stepTitleClasses(@js($stepVal))"
                    >
                        {!! $title !!}
                    </span>
                @endif

                @if ($description)
                    <span
                        class="transition-colors leading-relaxed mt-0.5 text-left"
                        :class="stepDescriptionClasses(@js($stepVal))"
                    >
                        {!! $description !!}
                    </span>
                @endif

                {{ $slot }}
            </div>
        @endif
    </button>

    {{-- Horizontal Connector Line (Excluded for 'cards' and 'progress') --}}
    <div
        x-show="orientation === 'horizontal' && variant !== 'cards' && variant !== 'progress' && !isLastStep(@js($stepVal))"
        x-cloak
        class="hidden sm:block flex-1 mx-3 h-0.5 bg-border relative overflow-hidden rounded-full min-w-6"
    >
        <div
            class="absolute inset-y-0 left-0 bg-primary transition-all duration-300 rounded-full"
            :style="{ width: isStepCompleted(@js($stepVal)) ? '100%' : '0%' }"
        ></div>
    </div>
</li>
