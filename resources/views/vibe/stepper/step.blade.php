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
    x-init="registerStep(@js($stepVal), @js((bool) $disabled), @js((bool) $error))"
    x-bind:data-step="@js($stepVal)"
    class="vibe-stepper-item relative group"
    :class="{
        'flex-1 last:flex-none flex items-center': orientation === 'horizontal' && variant !== 'cards',
        'w-full flex items-start gap-4 pb-6 last:pb-0': orientation === 'vertical',
        'w-full flex items-stretch': orientation === 'horizontal' && variant === 'cards'
    }"
>
    {{-- Vertical Connector Line (Rail) --}}
    <div
        x-show="orientation === 'vertical' && !($el.closest('ol')?.lastElementChild === $el.closest('li'))"
        class="absolute left-4.5 top-9 bottom-0 w-0.5 bg-border -translate-x-1/2 overflow-hidden"
        :class="{
            'left-3.5 top-7': size === 'sm',
            'left-4.5 top-9': size === 'md',
            'left-5.5 top-11': size === 'lg'
        }"
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
            'class' => 'group/step relative inline-flex items-center text-left focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 rounded-lg transition-all duration-200 select-none disabled:cursor-not-allowed'
        ]) }}
        :class="{
            {{-- Variant: Cards --}}
            'w-full p-4 sm:p-5 border rounded-2xl transition-all flex items-start gap-3.5 text-left h-full': variant === 'cards',
            'border-primary bg-primary/5 ring-2 ring-primary/25 shadow-xs': variant === 'cards' && isStepActive(@js($stepVal)),
            'border-border/80 bg-card hover:bg-muted/40 hover:border-primary/40 shadow-2xs': variant === 'cards' && isStepCompleted(@js($stepVal)),
            'border-border/50 bg-muted/15 opacity-70 hover:opacity-100 hover:border-border': variant === 'cards' && !isStepActive(@js($stepVal)) && !isStepCompleted(@js($stepVal)),

            {{-- Variant: Pill --}}
            'px-3.5 py-1.5 sm:px-4 sm:py-2 rounded-full border text-xs sm:text-sm font-medium gap-2 inline-flex items-center justify-center transition-all': variant === 'pill',
            'border-primary bg-primary text-primary-foreground shadow-xs ring-2 ring-primary/20': variant === 'pill' && isStepActive(@js($stepVal)),
            'border-primary/40 bg-primary/10 text-primary hover:bg-primary/20': variant === 'pill' && isStepCompleted(@js($stepVal)),
            'border-border bg-muted/40 text-muted-foreground hover:bg-muted/70 hover:text-foreground': variant === 'pill' && !isStepActive(@js($stepVal)) && !isStepCompleted(@js($stepVal)),

            {{-- Variant: Progress --}}
            'flex-col items-start gap-1.5 w-full': variant === 'progress',

            {{-- Variant: Default & Dots --}}
            'gap-3': variant === 'default' || variant === 'dots',
            'opacity-50 pointer-events-none': !isStepAccessible(@js($stepVal)) && !isStepActive(@js($stepVal)) && !isStepCompleted(@js($stepVal)) && linear,
            'cursor-pointer': isStepAccessible(@js($stepVal)),
            'cursor-default': !isStepAccessible(@js($stepVal))
        }"
    >
        {{-- Variant: Segmented Progress Bar --}}
        <template x-if="variant === 'progress'">
            <div class="w-full flex flex-col gap-1.5">
                <div class="w-full h-1.5 sm:h-2 bg-muted rounded-full overflow-hidden relative">
                    <div
                        class="h-full bg-primary transition-all duration-300 rounded-full"
                        :class="{
                            'w-full': isStepCompleted(@js($stepVal)) || isStepActive(@js($stepVal)),
                            'w-0': !isStepCompleted(@js($stepVal)) && !isStepActive(@js($stepVal))
                        }"
                    ></div>
                </div>
            </div>
        </template>

        {{-- Variant: Default, Dots, Cards, Pill --}}
        <template x-if="variant !== 'progress'">
            <div class="flex items-center shrink-0">
                {{-- Completed Checkmark for Pill Variant --}}
                <span
                    x-show="variant === 'pill' && isStepCompleted(@js($stepVal))"
                    class="size-4 inline-flex items-center justify-center shrink-0 -ml-0.5"
                >
                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                </span>

                {{-- Dot indicator for Dots Variant --}}
                <div
                    x-show="variant === 'dots'"
                    class="rounded-full transition-all duration-200"
                    :class="{
                        'size-2.5 bg-muted-foreground/40': !isStepActive(@js($stepVal)) && !isStepCompleted(@js($stepVal)),
                        'size-3.5 bg-primary ring-4 ring-primary/20 shadow-xs': isStepActive(@js($stepVal)),
                        'size-3 bg-primary': isStepCompleted(@js($stepVal)),
                        'bg-destructive ring-4 ring-destructive/20': isStepError(@js($stepVal))
                    }"
                ></div>

                {{-- Circle / Number Indicator for Default and Cards Variants --}}
                <div
                    x-show="variant === 'default' || variant === 'cards'"
                    class="rounded-full border font-semibold flex items-center justify-center transition-all duration-200 shrink-0"
                    :class="{
                        'size-7 text-xs': size === 'sm',
                        'size-9 text-sm': size === 'md',
                        'size-11 text-base': size === 'lg',

                        {{-- Active state --}}
                        'bg-primary text-primary-foreground border-primary ring-4 ring-primary/20 shadow-xs': isStepActive(@js($stepVal)) && !isStepError(@js($stepVal)),
                        {{-- Completed state --}}
                        'bg-primary text-primary-foreground border-primary shadow-2xs': isStepCompleted(@js($stepVal)) && !isStepActive(@js($stepVal)) && !isStepError(@js($stepVal)),
                        {{-- Error state --}}
                        'bg-destructive text-destructive-foreground border-destructive ring-4 ring-destructive/20 shadow-xs': isStepError(@js($stepVal)),
                        {{-- Upcoming state --}}
                        'bg-muted/50 text-muted-foreground border-border hover:border-muted-foreground/40 hover:bg-muted': !isStepActive(@js($stepVal)) && !isStepCompleted(@js($stepVal)) && !isStepError(@js($stepVal))
                    }"
                >
                    {{-- Checkmark Icon when completed --}}
                    <span x-show="isStepCompleted(@js($stepVal)) && !isStepActive(@js($stepVal)) && !isStepError(@js($stepVal))">
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
        </template>

        {{-- Text Content (Title & Description) --}}
        @if ($title || $description || $slot->isNotEmpty())
            <div class="flex flex-col min-w-0" :class="{ 'mt-1': variant === 'progress' }">
                @if ($title)
                    <span
                        class="transition-colors leading-snug"
                        :class="{
                            'truncate': variant !== 'cards',
                            'text-xs': size === 'sm',
                            'text-sm': size === 'md',
                            'text-base': size === 'lg',
                            {{-- Active Pill: Must be text-primary-foreground to avoid white-on-white in dark mode --}}
                            'text-primary-foreground font-semibold': variant === 'pill' && isStepActive(@js($stepVal)),
                            {{-- Active Other Variants --}}
                            'font-semibold text-foreground': variant !== 'pill' && isStepActive(@js($stepVal)) && !isStepError(@js($stepVal)),
                            {{-- Completed Pill --}}
                            'text-primary font-medium': variant === 'pill' && isStepCompleted(@js($stepVal)),
                            {{-- Completed Other Variants --}}
                            'font-medium text-foreground': variant !== 'pill' && isStepCompleted(@js($stepVal)) && !isStepActive(@js($stepVal)),
                            {{-- Error --}}
                            'font-medium text-destructive': isStepError(@js($stepVal)),
                            {{-- Upcoming --}}
                            'font-normal text-muted-foreground': !isStepActive(@js($stepVal)) && !isStepCompleted(@js($stepVal)) && !isStepError(@js($stepVal))
                        }"
                    >
                        {!! $title !!}
                    </span>
                @endif

                @if ($description)
                    <span
                        class="transition-colors leading-relaxed"
                        :class="{
                            'truncate': variant !== 'cards',
                            'text-[10px]': size === 'sm',
                            'text-xs': size === 'md' || size === 'lg',
                            'text-primary-foreground/80': variant === 'pill' && isStepActive(@js($stepVal)),
                            'text-primary/80': variant === 'pill' && isStepCompleted(@js($stepVal)),
                            'text-muted-foreground': !(variant === 'pill' && (isStepActive(@js($stepVal)) || isStepCompleted(@js($stepVal))))
                        }"
                    >
                        {!! $description !!}
                    </span>
                @endif

                {{ $slot }}
            </div>
        @endif
    </button>

    {{-- Horizontal Connector Line --}}
    <div
        x-show="orientation === 'horizontal' && variant !== 'cards' && !($el.closest('ol')?.lastElementChild === $el.closest('li'))"
        class="hidden sm:block flex-1 mx-3 h-0.5 bg-border relative overflow-hidden rounded-full min-w-8"
    >
        <div
            class="absolute inset-y-0 left-0 bg-primary transition-all duration-300 rounded-full"
            :style="{ width: isStepCompleted(@js($stepVal)) ? '100%' : '0%' }"
        ></div>
    </div>
</li>
