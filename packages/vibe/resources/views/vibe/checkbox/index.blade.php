@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'value' => '1',
    'checked' => false,
    'indeterminate' => false,
    'description' => null,
    'info' => null,
    'error' => null,
    'errorName' => null,
    'size' => 'md', // sm, md, lg
    'variant' => 'primary', // primary, accent, card
    'wrapperClass' => null,
    'indicator' => true,
    'hideIndicator' => false,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ? ($name . '-' . uniqid()) : uniqid('checkbox-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = ($error && !is_bool($error)) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $isIndicatorHidden = $hideIndicator || $attributes->has('hide-indicator') || $attributes->has('hide_indicator');
    $indicatorVal = filter_var($indicator, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    $showIndicator = ($indicatorVal ?? (bool) $indicator) && !$isIndicatorHidden;

    // Box size classes
    $boxSizes = match ($size) {
        'sm' => 'size-3.5 rounded-[4px]',
        'lg' => 'size-5 rounded-md',
        default => 'size-4 rounded-[5px]',
    };

    // Icon size classes
    $iconSizes = match ($size) {
        'sm' => 'size-2.5',
        'lg' => 'size-3.5',
        default => 'size-3',
    };

    // Text size classes
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

    // Box variant color classes
    $boxColorClasses = match ($variant) {
        'accent' => $hasError
            ? 'border-destructive bg-background text-destructive-foreground peer-checked:bg-destructive peer-checked:border-destructive peer-indeterminate:bg-destructive peer-indeterminate:border-destructive'
            : 'border-input bg-background text-accent-foreground peer-checked:bg-accent peer-checked:border-accent peer-indeterminate:bg-accent peer-indeterminate:border-accent',
        default => $hasError
            ? 'border-destructive bg-background text-destructive-foreground peer-checked:bg-destructive peer-checked:border-destructive peer-indeterminate:bg-destructive peer-indeterminate:border-destructive'
            : 'border-input bg-background text-primary-foreground peer-checked:bg-primary peer-checked:border-primary peer-indeterminate:bg-primary peer-indeterminate:border-primary',
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
                        type="checkbox"
                        id="{{ $id }}"
                        @if($name) name="{{ $name }}" @endif
                        value="{{ $value }}"
                        @checked($checked)
                        {{ $attributes->merge(['class' => 'peer sr-only']) }}
                        @if($indeterminate) x-init="$el.indeterminate = true" @endif
                    />
                    <div class="{{ $boxSizes }} {{ $boxColorClasses }} border transition-all duration-150 flex items-center justify-center shadow-2xs peer-checked:[&_.vibe-check-icon]:block peer-indeterminate:[&_.vibe-indeterminate-icon]:block">
                        {{-- Check Icon --}}
                        <svg class="{{ $iconSizes }} stroke-[3] hidden vibe-check-icon pointer-events-none fill-none stroke-current" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        {{-- Indeterminate Minus Icon --}}
                        <svg class="{{ $iconSizes }} stroke-[3] hidden vibe-indeterminate-icon pointer-events-none fill-none stroke-current" viewBox="0 0 24 24">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </div>
                </div>
            @else
                <input
                    type="checkbox"
                    id="{{ $id }}"
                    @if($name) name="{{ $name }}" @endif
                    value="{{ $value }}"
                    @checked($checked)
                    {{ $attributes->merge(['class' => 'peer sr-only']) }}
                    @if($indeterminate) x-init="$el.indeterminate = true" @endif
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
                        type="checkbox"
                        id="{{ $id }}"
                        @if($name) name="{{ $name }}" @endif
                        value="{{ $value }}"
                        @checked($checked)
                        {{ $attributes->merge(['class' => 'peer sr-only']) }}
                        @if($indeterminate) x-init="$el.indeterminate = true" @endif
                    />
                    <div class="{{ $boxSizes }} {{ $boxColorClasses }} border transition-all duration-150 flex items-center justify-center shadow-2xs peer-focus-visible:ring-2 peer-focus-visible:ring-ring/25 peer-focus-visible:ring-offset-1 peer-focus-visible:ring-offset-background peer-disabled:opacity-50 peer-disabled:pointer-events-none cursor-pointer peer-checked:[&_.vibe-check-icon]:block peer-indeterminate:[&_.vibe-indeterminate-icon]:block">
                        {{-- Check Icon --}}
                        <svg class="{{ $iconSizes }} stroke-[3] hidden vibe-check-icon pointer-events-none fill-none stroke-current" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        {{-- Indeterminate Minus Icon --}}
                        <svg class="{{ $iconSizes }} stroke-[3] hidden vibe-indeterminate-icon pointer-events-none fill-none stroke-current" viewBox="0 0 24 24">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </div>
                </div>
            @else
                <input
                    type="checkbox"
                    id="{{ $id }}"
                    @if($name) name="{{ $name }}" @endif
                    value="{{ $value }}"
                    @checked($checked)
                    {{ $attributes->merge(['class' => 'peer sr-only']) }}
                    @if($indeterminate) x-init="$el.indeterminate = true" @endif
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

    {{-- Error / Info Message --}}
    @if ($hasError && $errorMessage)
        <p class="mt-1 text-xs text-destructive flex items-center gap-1">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
            </svg>
            {{ $errorMessage }}
        </p>
    @elseif ($info)
        <p class="mt-1 text-xs text-muted-foreground">{{ $info }}</p>
    @endif
</div>
