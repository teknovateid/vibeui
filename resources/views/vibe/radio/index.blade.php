@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'value' => null,
    'checked' => false,
    'description' => null,
    'size' => 'md', // sm, md, lg
    'variant' => 'default', // default, card, accent
    'error' => null,
    'errorName' => null,
    'wrapperClass' => null,
    'indicator' => true,
    'hideIndicator' => false,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ? ($name . '-' . ($value ?? uniqid())) : uniqid('radio-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = ($error && !is_bool($error)) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $isIndicatorHidden = $hideIndicator || $attributes->has('hide-indicator') || $attributes->has('hide_indicator');
    $indicatorVal = filter_var($indicator, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    $showIndicator = ($indicatorVal ?? (bool) $indicator) && !$isIndicatorHidden;

    // Outer circle sizes
    $outerSizes = match ($size) {
        'sm' => 'size-3.5',
        'lg' => 'size-5',
        default => 'size-4',
    };

    // Inner dot sizes
    $dotSizes = match ($size) {
        'sm' => 'size-1.5',
        'lg' => 'size-2.5',
        default => 'size-2',
    };

    // Text sizes
    $labelSizes = match ($size) {
        'sm' => 'text-xs',
        'lg' => 'text-base',
        default => 'text-sm',
    };

    $descSizes = match ($size) {
        'sm' => 'text-[11px]',
        'lg' => 'text-sm',
        default => 'text-xs',
    };

    // Variant colors
    $colorClasses = match ($variant) {
        'accent' => $hasError
            ? 'border-destructive bg-background peer-checked:border-destructive text-destructive'
            : 'border-input bg-background peer-checked:border-accent text-accent peer-checked:bg-accent/10',
        default => $hasError
            ? 'border-destructive bg-background peer-checked:border-destructive text-destructive'
            : 'border-input bg-background peer-checked:border-primary text-primary peer-checked:bg-primary/5',
    };

    $dotColor = match ($variant) {
        'accent' => 'bg-accent',
        default => 'bg-primary',
    };

    $isCard = $variant === 'card';
@endphp

<div class="{{ $wrapperClass }}">
    @if ($isCard)
        {{-- Card Variant --}}
        <label for="{{ $id }}" class="relative flex items-start gap-3 p-3.5 rounded-xl border transition-all duration-150 cursor-pointer select-none {{ $hasError ? 'border-destructive/60 bg-destructive/5' : 'border-border bg-card hover:bg-muted/40 hover:border-border/80' }} has-checked:border-primary has-checked:ring-1 has-checked:ring-primary/20 has-checked:bg-primary/5 has-checked:hover:border-primary has-focus-visible:ring-2 has-focus-visible:ring-ring/20 has-disabled:opacity-50 has-disabled:pointer-events-none shadow-2xs">
            @if ($showIndicator)
                <div class="relative flex items-center justify-center shrink-0 mt-0.5">
                    <input
                        type="radio"
                        id="{{ $id }}"
                        @if($name) name="{{ $name }}" @endif
                        value="{{ $value }}"
                        @checked($checked)
                        {{ $attributes->merge(['class' => 'peer absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10 m-0']) }}
                    />
                    <div class="{{ $outerSizes }} {{ $colorClasses }} rounded-full border transition-all duration-150 flex items-center justify-center shadow-2xs peer-checked:[&_.vibe-radio-dot]:scale-100">
                        <span class="{{ $dotSizes }} {{ $dotColor }} rounded-full scale-0 vibe-radio-dot transition-transform duration-150"></span>
                    </div>
                </div>
            @else
                <input
                    type="radio"
                    id="{{ $id }}"
                    @if($name) name="{{ $name }}" @endif
                    value="{{ $value }}"
                    @checked($checked)
                    {{ $attributes->merge(['class' => 'peer sr-only']) }}
                />
            @endif

            <div class="flex-1 min-w-0">
                @if ($label)
                    <div class="{{ $labelSizes }} font-medium text-foreground leading-snug">
                        {{ $label }}
                    </div>
                @endif
                @if ($description)
                    <p class="{{ $descSizes }} text-muted-foreground mt-0.5 leading-relaxed">{{ $description }}</p>
                @endif
                @if ($slot->isNotEmpty())
                    <div class="{{ $label || $description ? 'mt-1.5' : ($labelSizes . ' font-medium text-foreground leading-snug') }}">
                        {{ $slot }}
                    </div>
                @endif
            </div>
        </label>
    @else
        {{-- Standard / Inline Variant --}}
        <div class="inline-flex items-start gap-2.5">
            @if ($showIndicator)
                <div class="relative flex items-center justify-center shrink-0 mt-0.5">
                    <input
                        type="radio"
                        id="{{ $id }}"
                        @if($name) name="{{ $name }}" @endif
                        value="{{ $value }}"
                        @checked($checked)
                        {{ $attributes->merge(['class' => 'peer absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10 m-0']) }}
                    />
                    <div class="{{ $outerSizes }} {{ $colorClasses }} rounded-full border transition-all duration-150 flex items-center justify-center shadow-2xs peer-focus-visible:ring-2 peer-focus-visible:ring-ring/25 peer-focus-visible:ring-offset-1 peer-focus-visible:ring-offset-background peer-disabled:opacity-50 peer-disabled:pointer-events-none pointer-events-none peer-checked:[&_.vibe-radio-dot]:scale-100">
                        <span class="{{ $dotSizes }} {{ $dotColor }} rounded-full scale-0 vibe-radio-dot transition-transform duration-150"></span>
                    </div>
                </div>
            @else
                <input
                    type="radio"
                    id="{{ $id }}"
                    @if($name) name="{{ $name }}" @endif
                    value="{{ $value }}"
                    @checked($checked)
                    {{ $attributes->merge(['class' => 'peer sr-only']) }}
                />
            @endif

            @if ($label || $description || $slot->isNotEmpty())
                <div class="flex flex-col">
                    <label for="{{ $id }}" class="{{ $labelSizes }} font-medium text-foreground select-none cursor-pointer leading-tight peer-disabled:opacity-50 peer-disabled:cursor-not-allowed">
                        {{ $label ?? $slot }}
                    </label>
                    @if ($description)
                        <p class="{{ $descSizes }} text-muted-foreground mt-0.5 leading-normal select-none">{{ $description }}</p>
                    @endif
                </div>
            @endif
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
