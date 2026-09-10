@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'value' => '1',
    'checked' => false,
    'description' => null,
    'size' => 'md', // sm, md, lg
    'variant' => 'primary', // primary, secondary, success, warning, danger/destructive, info, accent
    'labelPlacement' => 'right', // right, left, justify
    'disabled' => false,
    'error' => null,
    'errorName' => null,
    'wrapperClass' => null,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ? ($name . '-' . uniqid()) : uniqid('switch-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = ($error && !is_bool($error)) ? $error : ($errorKey ? $errors->first($errorKey) : null);
    $isDisabled = $disabled || ($attributes->has('disabled') && $attributes->get('disabled') !== false);

    // Track dimensions
    $trackSizes = match ($size) {
        'sm' => 'h-4 w-7',
        'lg' => 'h-6 w-11',
        default => 'h-5 w-9',
    };

    // Thumb dimensions
    $thumbSizes = match ($size) {
        'sm' => 'size-3 peer-checked:translate-x-3',
        'lg' => 'size-5 peer-checked:translate-x-5',
        default => 'size-4 peer-checked:translate-x-4',
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

    // Track active colors
    $trackColors = match ($variant) {
        'secondary' => $hasError
            ? 'bg-destructive/20 border-destructive/40 peer-checked:bg-destructive peer-checked:border-destructive'
            : 'bg-input border-border/70 peer-checked:bg-secondary-foreground/75 peer-checked:border-secondary-foreground/75 hover:brightness-98 dark:hover:brightness-110',
        'success' => $hasError
            ? 'bg-destructive/20 border-destructive/40 peer-checked:bg-destructive peer-checked:border-destructive'
            : 'bg-input border-border/70 peer-checked:bg-success peer-checked:border-success hover:brightness-98 dark:hover:brightness-110',
        'warning' => $hasError
            ? 'bg-destructive/20 border-destructive/40 peer-checked:bg-destructive peer-checked:border-destructive'
            : 'bg-input border-border/70 peer-checked:bg-warning peer-checked:border-warning hover:brightness-98 dark:hover:brightness-110',
        'danger', 'destructive' => $hasError
            ? 'bg-destructive/20 border-destructive/40 peer-checked:bg-destructive peer-checked:border-destructive'
            : 'bg-input border-border/70 peer-checked:bg-destructive peer-checked:border-destructive hover:brightness-98 dark:hover:brightness-110',
        'info' => $hasError
            ? 'bg-destructive/20 border-destructive/40 peer-checked:bg-destructive peer-checked:border-destructive'
            : 'bg-input border-border/70 peer-checked:bg-info peer-checked:border-info hover:brightness-98 dark:hover:brightness-110',
        'accent' => $hasError
            ? 'bg-destructive/20 border-destructive/40 peer-checked:bg-destructive peer-checked:border-destructive'
            : 'bg-input border-border/70 peer-checked:bg-primary peer-checked:border-primary hover:brightness-98 dark:hover:brightness-110',
        default => $hasError
            ? 'bg-destructive/20 border-destructive/40 peer-checked:bg-destructive peer-checked:border-destructive'
            : 'bg-input border-border/70 peer-checked:bg-primary peer-checked:border-primary hover:brightness-98 dark:hover:brightness-110',
    };

    // Thumb colors
    $thumbColors = match ($variant) {
        'success', 'danger', 'destructive', 'info' => 'bg-white dark:bg-vibe-200 dark:peer-checked:bg-primary-foreground shadow-xs',
        'warning' => 'bg-white dark:bg-vibe-100 dark:peer-checked:bg-vibe-950 shadow-xs',
        'secondary' => 'bg-white dark:bg-vibe-200 dark:peer-checked:bg-vibe-950 shadow-xs',
        default => 'bg-white dark:bg-vibe-200 dark:peer-checked:bg-primary-foreground shadow-xs',
    };

    $isJustify = $labelPlacement === 'justify';
    $isLeft = $labelPlacement === 'left';
@endphp

<div class="{{ $wrapperClass }}">
    <label for="{{ $id }}" class="flex {{ $isJustify ? 'flex-row-reverse items-center justify-between w-full' : ($isLeft ? 'flex-row-reverse items-center justify-end gap-3' : 'items-start gap-2.5') }} {{ $isDisabled ? 'cursor-not-allowed opacity-60 pointer-events-none' : 'cursor-pointer' }} select-none group/switch has-disabled:cursor-not-allowed has-disabled:opacity-60 has-disabled:pointer-events-none">
        
        {{-- The Switch Toggle Element --}}
        <div class="relative inline-flex items-center shrink-0 {{ !$isJustify && !$isLeft ? 'mt-0.5' : '' }}">
            <input
                type="checkbox"
                role="switch"
                id="{{ $id }}"
                @if($name) name="{{ $name }}" @endif
                value="{{ $value }}"
                @checked($checked)
                @disabled($isDisabled)
                x-init="$el.setAttribute('aria-checked', $el.checked ? 'true' : 'false')"
                @change="$el.setAttribute('aria-checked', $el.checked ? 'true' : 'false')"
                {{ $attributes->merge(['class' => 'peer sr-only']) }}
            />
            
            {{-- Track (Direct Sibling of .peer) --}}
            <span class="{{ $trackSizes }} {{ $trackColors }} border rounded-full transition-colors duration-200 ease-in-out peer-focus-visible:ring-2 peer-focus-visible:ring-ring/30 peer-focus-visible:ring-offset-2 peer-focus-visible:ring-offset-background peer-disabled:opacity-50 peer-disabled:pointer-events-none shadow-2xs inline-block"></span>

            {{-- Sliding Thumb (Direct Sibling of .peer) --}}
            <span class="{{ $thumbSizes }} {{ $thumbColors }} absolute left-0.5 top-0.5 pointer-events-none rounded-full transition-all duration-200 ease-in-out flex items-center justify-center [&>svg]:size-[70%] [&>svg]:shrink-0">
                {{ $slot }}
            </span>
        </div>

        {{-- Label & Description --}}
        @if ($label || $description)
            <div class="flex flex-col {{ $isLeft ? 'text-right' : 'text-left' }} {{ $isJustify ? 'flex-1 pr-4 min-w-0' : '' }}">
                @if ($label)
                    <span class="{{ $labelSizes }} font-medium text-foreground group-hover/switch:text-foreground/90 transition-colors leading-tight peer-disabled:opacity-50">
                        {{ $label }}
                    </span>
                @endif
                @if ($description)
                    <span class="{{ $descSizes }} text-muted-foreground mt-0.5 leading-normal">
                        {{ $description }}
                    </span>
                @endif
            </div>
        @endif
    </label>

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
