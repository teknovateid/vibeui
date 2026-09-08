@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'value' => '1',
    'checked' => false,
    'description' => null,
    'size' => 'md', // sm, md, lg
    'variant' => 'primary', // primary, success, accent
    'labelPlacement' => 'right', // right, left, justify
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
        'success' => $hasError
            ? 'bg-destructive/30 peer-checked:bg-destructive'
            : 'bg-input peer-checked:bg-success group-hover/switch:brightness-95',
        'accent' => $hasError
            ? 'bg-destructive/30 peer-checked:bg-destructive'
            : 'bg-input peer-checked:bg-accent group-hover/switch:brightness-95',
        default => $hasError
            ? 'bg-destructive/30 peer-checked:bg-destructive'
            : 'bg-input peer-checked:bg-primary group-hover/switch:brightness-95',
    };

    $isJustify = $labelPlacement === 'justify';
    $isLeft = $labelPlacement === 'left';
@endphp

<div class="{{ $wrapperClass }}">
    <label for="{{ $id }}" class="flex {{ $isJustify ? 'items-center justify-between' : ($isLeft ? 'flex-row-reverse items-center justify-end gap-3' : 'items-start gap-2.5') }} cursor-pointer select-none group/switch has-disabled:cursor-not-allowed has-disabled:opacity-60">
        
        {{-- The Switch Toggle Element --}}
        <div class="relative inline-flex items-center shrink-0 {{ !$isJustify && !$isLeft ? 'mt-0.5' : '' }}">
            <input
                type="checkbox"
                id="{{ $id }}"
                @if($name) name="{{ $name }}" @endif
                value="{{ $value }}"
                @checked($checked)
                {{ $attributes->merge(['class' => 'peer sr-only']) }}
            />
            
            {{-- Track (Direct Sibling of .peer) --}}
            <span class="{{ $trackSizes }} {{ $trackColors }} rounded-full transition-colors duration-200 ease-in-out peer-focus-visible:ring-2 peer-focus-visible:ring-ring/30 peer-focus-visible:ring-offset-2 peer-focus-visible:ring-offset-background peer-disabled:opacity-50 peer-disabled:pointer-events-none shadow-2xs inline-block"></span>

            {{-- Sliding Thumb (Direct Sibling of .peer) --}}
            <span class="{{ $thumbSizes }} absolute left-0.5 top-0.5 pointer-events-none rounded-full bg-background shadow-md transition-transform duration-200 ease-in-out flex items-center justify-center">
                {{ $slot }}
            </span>
        </div>

        {{-- Label & Description --}}
        @if ($label || $description)
            <div class="flex flex-col {{ $isLeft ? 'text-right' : '' }}">
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
