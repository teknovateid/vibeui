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
    'variant' => 'primary', // primary/default, secondary, success, warning, danger/destructive, info, accent, card
    'color' => null, // optional color override: primary, secondary, success, warning, danger/destructive, info, accent
    'card' => false,
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

    $isCardVariant = str_starts_with((string) $variant, 'card');
    $isCard = $card || $isCardVariant || $attributes->has('card');

    $cardColor = null;
    if ($isCardVariant && $variant !== 'card') {
        $cardColor = str_replace(['card-', 'card_'], '', (string) $variant);
    }

    $resolvedVariant = $color ?? $cardColor ?? ($variant === 'card' ? 'primary' : $variant);
    if ($resolvedVariant === 'default') {
        $resolvedVariant = 'primary';
    }

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
    $boxColorClasses = match ($resolvedVariant) {
        'secondary' => $hasError
            ? 'border-destructive bg-background text-destructive-foreground peer-checked:bg-destructive peer-checked:border-destructive peer-indeterminate:bg-destructive peer-indeterminate:border-destructive'
            : 'border-input bg-background text-background peer-checked:bg-secondary-foreground peer-checked:border-secondary-foreground peer-indeterminate:bg-secondary-foreground peer-indeterminate:border-secondary-foreground',
        'success' => $hasError
            ? 'border-destructive bg-background text-destructive-foreground peer-checked:bg-destructive peer-checked:border-destructive peer-indeterminate:bg-destructive peer-indeterminate:border-destructive'
            : 'border-input bg-background text-success-foreground peer-checked:bg-success peer-checked:border-success peer-indeterminate:bg-success peer-indeterminate:border-success',
        'warning' => $hasError
            ? 'border-destructive bg-background text-destructive-foreground peer-checked:bg-destructive peer-checked:border-destructive peer-indeterminate:bg-destructive peer-indeterminate:border-destructive'
            : 'border-input bg-background text-warning-foreground peer-checked:bg-warning peer-checked:border-warning peer-indeterminate:bg-warning peer-indeterminate:border-warning',
        'danger', 'destructive' => $hasError
            ? 'border-destructive bg-background text-destructive-foreground peer-checked:bg-destructive peer-checked:border-destructive peer-indeterminate:bg-destructive peer-indeterminate:border-destructive'
            : 'border-input bg-background text-destructive-foreground peer-checked:bg-destructive peer-checked:border-destructive peer-indeterminate:bg-destructive peer-indeterminate:border-destructive',
        'info' => $hasError
            ? 'border-destructive bg-background text-destructive-foreground peer-checked:bg-destructive peer-checked:border-destructive peer-indeterminate:bg-destructive peer-indeterminate:border-destructive'
            : 'border-input bg-background text-info-foreground peer-checked:bg-info peer-checked:border-info peer-indeterminate:bg-info peer-indeterminate:border-info',
        'accent' => $hasError
            ? 'border-destructive bg-background text-destructive-foreground peer-checked:bg-destructive peer-checked:border-destructive peer-indeterminate:bg-destructive peer-indeterminate:border-destructive'
            : 'border-input bg-background text-accent-foreground peer-checked:bg-accent peer-checked:border-accent peer-indeterminate:bg-accent peer-indeterminate:border-accent',
        default => $hasError
            ? 'border-destructive bg-background text-destructive-foreground peer-checked:bg-destructive peer-checked:border-destructive peer-indeterminate:bg-destructive peer-indeterminate:border-destructive'
            : 'border-input bg-background text-primary-foreground peer-checked:bg-primary peer-checked:border-primary peer-indeterminate:bg-primary peer-indeterminate:border-primary',
    };

    // Card checked accent colors
    $cardCheckedClasses = match ($resolvedVariant) {
        'secondary' => 'has-checked:border-secondary-foreground/70 has-checked:ring-1 has-checked:ring-secondary-foreground/20 has-checked:bg-secondary/40 has-checked:hover:border-secondary-foreground/80 has-checked:hover:bg-secondary/60',
        'success' => 'has-checked:border-success has-checked:ring-1 has-checked:ring-success/20 has-checked:bg-success/5 has-checked:hover:border-success has-checked:hover:bg-success/10',
        'warning' => 'has-checked:border-warning has-checked:ring-1 has-checked:ring-warning/20 has-checked:bg-warning/5 has-checked:hover:border-warning has-checked:hover:bg-warning/10',
        'danger', 'destructive' => 'has-checked:border-destructive has-checked:ring-1 has-checked:ring-destructive/20 has-checked:bg-destructive/5 has-checked:hover:border-destructive has-checked:hover:bg-destructive/10',
        'info' => 'has-checked:border-info has-checked:ring-1 has-checked:ring-info/20 has-checked:bg-info/5 has-checked:hover:border-info has-checked:hover:bg-info/10',
        'accent' => 'has-checked:border-accent has-checked:ring-1 has-checked:ring-accent/20 has-checked:bg-accent/10 has-checked:hover:border-accent has-checked:hover:bg-accent/15',
        default => 'has-checked:border-primary has-checked:ring-1 has-checked:ring-primary/20 has-checked:bg-primary/5 has-checked:hover:border-primary has-checked:hover:bg-primary/10',
    };

    $hasText = !empty($label) || !empty($description) || ($slot->isNotEmpty() && trim($slot) !== '');

    $hasXShow = $attributes->has('x-show');
    $xShow = $attributes->get('x-show');
    $hasXCloak = $attributes->has('x-cloak');
    $hasWireKey = $attributes->has('wire:key');
    $wireKey = $attributes->get('wire:key');

    $inputAttributes = $attributes->except(['x-show', 'x-cloak', 'wire:key']);
@endphp

<div 
    @if($wrapperClass) class="{{ $wrapperClass }}" @elseif(!$hasText) class="inline-flex items-center justify-center" @endif
    @if($hasWireKey) wire:key="{{ $wireKey }}" @endif
    @if($hasXShow) x-show="{{ $xShow }}" @endif
    @if($hasXCloak) x-cloak @endif
>
    @if ($isCard)
        {{-- Card Variant --}}
        <label for="{{ $id }}" class="relative flex items-start gap-3 p-3.5 rounded-xl border transition-all duration-150 cursor-pointer select-none {{ $hasError ? 'border-destructive/60 bg-destructive/5' : 'border-border bg-muted hover:bg-muted/80 hover:border-border/80' }} {{ $cardCheckedClasses }} has-focus-visible:ring-2 has-focus-visible:ring-ring/20 has-disabled:opacity-50 has-disabled:pointer-events-none shadow-2xs">
            @if ($showIndicator)
                <div class="relative flex items-center justify-center shrink-0 mt-0.5">
                    <input
                        type="checkbox"
                        id="{{ $id }}"
                        @if($name) name="{{ $name }}" @endif
                        value="{{ $value }}"
                        @checked($checked)
                        {{ $inputAttributes->merge(['class' => 'peer absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10 m-0']) }}
                        @if($indeterminate) x-init="$el.indeterminate = true" @endif
                    />
                    <div class="{{ $boxSizes }} {{ $boxColorClasses }} border transition-all duration-150 flex items-center justify-center shadow-2xs peer-checked:[&_.vibe-check-icon]:block peer-indeterminate:[&_.vibe-check-icon]:hidden! peer-indeterminate:[&_.vibe-indeterminate-icon]:block">
                        {{-- Check Icon --}}
                        <svg class="{{ $iconSizes }} stroke-3 hidden vibe-check-icon pointer-events-none fill-none stroke-current" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        {{-- Indeterminate Minus Icon --}}
                        <svg class="{{ $iconSizes }} stroke-3 hidden vibe-indeterminate-icon pointer-events-none fill-none stroke-current" viewBox="0 0 24 24">
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
                    {{ $inputAttributes->merge(['class' => 'peer sr-only']) }}
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
        <div class="inline-flex {{ $hasText ? 'items-start gap-2.5' : 'items-center justify-center' }}">
            @if ($showIndicator)
                <div class="relative flex items-center justify-center shrink-0 {{ $hasText ? 'mt-0.5' : '' }}">
                    <input
                        type="checkbox"
                        id="{{ $id }}"
                        @if($name) name="{{ $name }}" @endif
                        value="{{ $value }}"
                        @checked($checked)
                        {{ $inputAttributes->merge(['class' => 'peer absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10 m-0']) }}
                        @if($indeterminate) x-init="$el.indeterminate = true" @endif
                    />
                    <div class="{{ $boxSizes }} {{ $boxColorClasses }} border transition-all duration-150 flex items-center justify-center shadow-2xs peer-focus-visible:ring-2 peer-focus-visible:ring-ring/25 peer-focus-visible:ring-offset-1 peer-focus-visible:ring-offset-background peer-disabled:opacity-50 peer-disabled:pointer-events-none pointer-events-none peer-checked:[&_.vibe-check-icon]:block peer-indeterminate:[&_.vibe-check-icon]:hidden! peer-indeterminate:[&_.vibe-indeterminate-icon]:block">
                        {{-- Check Icon --}}
                        <svg class="{{ $iconSizes }} stroke-3 hidden vibe-check-icon pointer-events-none fill-none stroke-current" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        {{-- Indeterminate Minus Icon --}}
                        <svg class="{{ $iconSizes }} stroke-3 hidden vibe-indeterminate-icon pointer-events-none fill-none stroke-current" viewBox="0 0 24 24">
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
                    {{ $inputAttributes->merge(['class' => 'peer sr-only']) }}
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
