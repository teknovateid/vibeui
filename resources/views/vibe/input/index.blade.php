@blaze

@props([
    'label' => null,
    'id' => null,
    'type' => 'text',
    'name' => null,
    'description' => null,
    'size' => 'md', // sm, md, lg, xl
    'variant' => 'primary', // primary, outline, filled, flush, ghost
    'info' => null,
    'error' => null,
    'errorName' => null,
    'wrapperClass' => null,
    'icon' => null,
    'trailingIcon' => null,
    'prefix' => null,
    'suffix' => null,
    'disabled' => false,
    'readonly' => false,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ?? uniqid('input-'));
    $errorKey = $errorName ?? ($name ? str_replace(['[', ']'], ['.', ''], rtrim($name, ']')) : null);

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = ($error && !is_bool($error)) ? $error : ($errorKey ? $errors->first($errorKey) : null);

    $isDisabled = $disabled || ($attributes->has('disabled') && $attributes->get('disabled') !== false);
    $isReadonly = $readonly || ($attributes->has('readonly') && $attributes->get('readonly') !== false);

    $hasLeading = isset($icon) || !empty($prefix);
    $hasTrailing = isset($trailingIcon) || !empty($suffix);

    // Outer control box classes (holds border, background, focus ring, rounded, height)
    $baseControlClasses = 'relative w-full flex items-center transition-colors duration-150 cursor-text overflow-hidden';

    $sizeControlClasses = match ($size) {
        'sm' => 'h-8 text-xs rounded-md',
        'md' => 'h-9 text-sm rounded-lg',
        'lg' => 'h-10 text-sm rounded-lg',
        'xl' => 'h-11 text-base rounded-xl',
        default => 'h-9 text-sm rounded-lg',
    };

    if ($variant === 'flush') {
        $sizeControlClasses = match ($size) {
            'sm' => 'h-8 text-xs rounded-none px-0',
            'md' => 'h-9 text-sm rounded-none px-0',
            'lg' => 'h-10 text-sm rounded-none px-0',
            'xl' => 'h-11 text-base rounded-none px-0',
            default => 'h-9 text-sm rounded-none px-0',
        };
    }

    $variantControlClasses = match ($variant) {
        'filled' => $hasError 
            ? 'bg-destructive/10 border border-destructive focus-within:bg-background focus-within:border-destructive focus-within:ring-2 focus-within:ring-destructive/20' 
            : 'bg-muted/60 border border-transparent hover:bg-muted/80 focus-within:bg-background focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20',
        'flush' => $hasError 
            ? 'border-b border-destructive bg-transparent focus-within:border-destructive focus-within:ring-0' 
            : 'border-b border-input bg-transparent focus-within:border-primary focus-within:ring-0',
        'ghost' => $hasError 
            ? 'border-transparent text-destructive bg-transparent focus-within:ring-2 focus-within:ring-destructive/20' 
            : 'border-transparent bg-transparent hover:bg-muted/40 focus-within:bg-transparent focus-within:ring-2 focus-within:ring-primary/20',
        'outline' => $hasError 
            ? 'border border-destructive bg-background shadow-2xs focus-within:border-destructive focus-within:ring-2 focus-within:ring-destructive/20' 
            : 'border border-input bg-background shadow-2xs focus-within:border-ring focus-within:ring-2 focus-within:ring-ring/20',
        'primary' => $hasError 
            ? 'border border-destructive bg-background shadow-2xs focus-within:border-destructive focus-within:ring-2 focus-within:ring-destructive/20' 
            : 'border border-input bg-background shadow-2xs focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20',
        default => $hasError 
            ? 'border border-destructive bg-background shadow-2xs focus-within:border-destructive focus-within:ring-2 focus-within:ring-destructive/20' 
            : 'border border-input bg-background shadow-2xs focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20',
    };

    $stateControlClasses = '';
    if ($isDisabled) {
        $stateControlClasses = 'opacity-50 pointer-events-none bg-muted/40 cursor-not-allowed';
    } elseif ($isReadonly) {
        $stateControlClasses = 'bg-muted/20 cursor-default';
    }

    $controlClasses = trim("{$baseControlClasses} {$sizeControlClasses} {$variantControlClasses} {$stateControlClasses}");

    // Padding for addons and input
    if ($variant === 'flush') {
        $leadingPadding = 'pl-0 pr-1.5';
        $trailingPadding = 'pr-0 pl-1.5';
        $inputPadding = 'px-0';
    } else {
        $leadingPadding = match ($size) {
            'sm' => 'pl-2.5 pr-1.5',
            'lg' => 'pl-3.5 pr-2',
            'xl' => 'pl-4 pr-2.5',
            default => 'pl-3 pr-1.5',
        };
        $trailingPadding = match ($size) {
            'sm' => 'pr-2.5 pl-1.5',
            'lg' => 'pr-3.5 pr-2',
            'xl' => 'pr-4 pl-2.5',
            default => 'pr-3 pl-1.5',
        };
        $inputPadding = ($hasLeading ? 'pl-0 ' : match ($size) {
            'sm' => 'pl-2.5 ',
            'lg' => 'pl-4 ',
            'xl' => 'pl-5 ',
            default => 'pl-3.5 ',
        }) . ($hasTrailing ? 'pr-0' : match ($size) {
            'sm' => 'pr-2.5',
            'lg' => 'pr-4',
            'xl' => 'pr-5',
            default => 'pr-3.5',
        });
    }

    $inputFontSize = match ($size) {
        'sm' => 'text-xs',
        'xl' => 'text-base',
        default => 'text-sm',
    };

    $inputTextColor = $hasError ? 'text-destructive placeholder:text-destructive/50' : 'text-foreground placeholder:text-muted-foreground';
    $inputClasses = trim("w-full flex-1 min-w-0 h-full bg-transparent border-0 py-0 focus:outline-none focus:ring-0 {$inputFontSize} {$inputPadding} {$inputTextColor} disabled:pointer-events-none read-only:cursor-default");

    // Compute ARIA describedby IDs
    $describedBy = [];
    if ($hasError && $errorMessage) {
        $describedBy[] = "{$id}-error";
    } elseif ($description) {
        $describedBy[] = "{$id}-description";
    }
    if ($info && !$hasError) {
        $describedBy[] = "{$id}-info";
    }
    $describedByString = !empty($describedBy) ? implode(' ', $describedBy) : null;
@endphp

<div class="{{ $wrapperClass }}">
    @if ($label)
        <label for="{{ $id }}" class="block text-xs font-semibold text-foreground mb-1.5 select-none">
            {{ $label }}
            @if ($attributes->has('required') && $attributes->get('required') !== false)
                <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    @if ($description)
        <p id="{{ $id }}-description" class="mb-1.5 text-xs text-muted-foreground">{{ $description }}</p>
    @endif

    <div {{ $attributes->only('class')->twMerge(['class' => $controlClasses]) }} onclick="if (!event.target.closest('button, a, input')) this.querySelector('input')?.focus()">
        @if ($hasLeading)
            <div class="flex items-center {{ $leadingPadding }} gap-1.5 shrink-0 text-muted-foreground select-none pointer-events-none [&>button]:pointer-events-auto [&>a]:pointer-events-auto">
                @if (isset($icon))
                    <span class="size-4 flex items-center justify-center shrink-0 [&>svg]:size-4 [&>svg]:shrink-0">{{ $icon }}</span>
                @endif
                @if (!empty($prefix))
                    <span class="font-medium text-xs {{ $size === 'xl' ? 'text-sm' : '' }} select-none">{{ $prefix }}</span>
                @endif
            </div>
        @endif

        <input
            type="{{ $type }}"
            id="{{ $id }}"
            name="{{ $name }}"
            @if ($hasError) aria-invalid="true" @endif
            @if ($describedByString) aria-describedby="{{ $describedByString }}" @endif
            @if ($isDisabled) disabled @endif
            @if ($isReadonly) readonly @endif
            {{ $attributes->except(['class', 'disabled', 'readonly'])->twMerge(['class' => $inputClasses]) }}
        >

        @if ($hasTrailing)
            <div class="flex items-center {{ $trailingPadding }} gap-1.5 shrink-0 text-muted-foreground select-none pointer-events-none [&>button]:pointer-events-auto [&>a]:pointer-events-auto">
                @if (!empty($suffix))
                    <span class="font-medium text-xs {{ $size === 'xl' ? 'text-sm' : '' }} select-none">{{ $suffix }}</span>
                @endif
                @if (isset($trailingIcon))
                    <span class="size-4 flex items-center justify-center shrink-0 [&>svg]:size-4 [&>svg]:shrink-0">{{ $trailingIcon }}</span>
                @endif
            </div>
        @endif
    </div>

    @if ($hasError && $errorMessage)
        <p id="{{ $id }}-error" role="alert" class="mt-1.5 text-xs font-medium text-destructive flex items-center gap-1">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" x2="12" y1="8" y2="12" />
                <line x1="12" x2="12.01" y1="16" y2="16" />
            </svg>
            <span>{{ $errorMessage }}</span>
        </p>
    @elseif ($info)
        <p id="{{ $id }}-info" class="mt-1.5 text-xs text-muted-foreground">{{ $info }}</p>
    @endif
</div>
