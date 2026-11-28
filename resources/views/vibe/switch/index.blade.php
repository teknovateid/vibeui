@blaze

@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'value' => null,
    'checked' => false,
    'description' => null,
    'size' => 'md', // xs, sm, md, lg, xl
    'variant' => 'primary', // primary, secondary, success, warning, danger/destructive, info
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

    [$trackSizes, $thumbSizes, $labelSizes, $descSizes] = match ($size) {
        'xs' => ['h-3.5 w-6', 'size-2.5 peer-checked:translate-x-2.5', 'text-xs', 'text-[10px]'],
        'sm' => ['h-4 w-7', 'size-3 peer-checked:translate-x-3', 'text-xs', 'text-[11px]'],
        'lg' => ['h-6 w-11', 'size-5 peer-checked:translate-x-5', 'text-sm', 'text-xs'],
        'xl' => ['h-7 w-13', 'size-6 peer-checked:translate-x-6', 'text-base', 'text-sm'],
        default => ['h-5 w-9', 'size-4 peer-checked:translate-x-4', 'text-sm', 'text-xs'],
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
        default => $hasError
            ? 'bg-destructive/20 border-destructive/40 peer-checked:bg-destructive peer-checked:border-destructive'
            : 'bg-input border-border/70 peer-checked:bg-primary peer-checked:border-primary hover:brightness-98 dark:hover:brightness-110',
    };

    // Thumb colors
    $thumbColors = match ($variant) {
        'warning' => 'bg-white dark:bg-zinc-200 dark:peer-checked:bg-warning-foreground shadow-xs',
        'secondary' => 'bg-white dark:bg-zinc-200 dark:peer-checked:bg-secondary-foreground shadow-xs',
        default => 'bg-white dark:bg-zinc-200 dark:peer-checked:bg-primary-foreground shadow-xs',
    };

    $isJustify = $labelPlacement === 'justify';
    $isLeft = $labelPlacement === 'left';

    $describedBy = [];
    if ($description) {
        $describedBy[] = "{$id}-description";
    }
    if ($hasError && $errorMessage) {
        $describedBy[] = "{$id}-error";
    }
    $describedByString = !empty($describedBy) ? implode(' ', $describedBy) : null;
@endphp

<div class="{{ $wrapperClass }}">
    <label for="{{ $id }}" class="flex {{ $isJustify ? 'flex-row-reverse items-center justify-between w-full' : ($isLeft ? 'flex-row-reverse items-center justify-end gap-3' : ($description ? 'items-start gap-2.5' : 'items-center gap-2.5')) }} {{ $isDisabled ? 'cursor-not-allowed opacity-60 pointer-events-none' : 'cursor-pointer' }} select-none group/switch has-disabled:cursor-not-allowed has-disabled:opacity-60 has-disabled:pointer-events-none">
        
        {{-- The Switch Toggle Element --}}
        <div class="relative inline-flex items-center shrink-0 {{ !$isJustify && !$isLeft && $description ? 'mt-0.5' : '' }}">
            <input
                type="checkbox"
                switch
                role="switch"
                id="{{ $id }}"
                data-error="{{ $id }}-error"
                @if($name) name="{{ $name }}" @endif
                @if($value !== null) value="{{ $value }}" @elseif($name) value="1" @endif
                @if($hasError) aria-invalid="true" data-vibe-server-invalid="true" @else aria-invalid="false" @endif
                @if($describedByString) aria-describedby="{{ $describedByString }}" @endif
                @checked($checked)
                @disabled($isDisabled)
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
                    <span id="{{ $id }}-description" class="{{ $descSizes }} text-muted-foreground mt-0.5 leading-normal">
                        {{ $description }}
                    </span>
                @endif
            </div>
        @endif
    </label>

    {{-- Error Message --}}
    <vibe:partials.field-message :id="$id" :hasError="$hasError" :errorMessage="$errorMessage" marginClass="mt-1" />
</div>
