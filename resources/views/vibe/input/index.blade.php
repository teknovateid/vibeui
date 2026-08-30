@blaze

@props([
    'label' => null,
    'id' => null,
    'type' => 'text',
    'name' => null,
    'description' => null,
    'size' => 'md',        // sm, md, lg, xl
    'variant' => 'outline', // outline, filled, flush, ghost, accent
    'info' => null,
    'error' => null,
    'errorName' => null,
    'wrapperClass' => null,
    'icon' => null,
    'trailingIcon' => null,
    'prefix' => null,
    'suffix' => null,
    'pill' => false,
    'disabled' => false,
    'readonly' => false,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $id = $id ?? ($name ?? uniqid('input-'));
    $errorKey = $errorName ?? $name;

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = $error ?: ($errorKey ? $errors->first($errorKey) : null);

    $hasLeading = isset($icon) || !empty($prefix);
    $hasTrailing = isset($trailingIcon) || !empty($suffix);

    $baseClasses = 'block w-full transition-colors duration-150 placeholder:text-muted-foreground focus-visible:outline-none disabled:pointer-events-none disabled:opacity-50 disabled:bg-muted/40';

    $sizeClasses = match ($size) {
        'sm' => 'h-8 text-xs ' . ($pill ? 'rounded-full' : 'rounded-md') . ' ' . ($hasLeading ? 'pl-8 ' : 'px-3 ') . ($hasTrailing ? 'pr-8' : ''),
        'md' => 'h-9 text-sm ' . ($pill ? 'rounded-full' : 'rounded-lg') . ' ' . ($hasLeading ? 'pl-9 ' : 'px-3.5 ') . ($hasTrailing ? 'pr-9' : ''),
        'lg' => 'h-10 text-sm ' . ($pill ? 'rounded-full' : 'rounded-lg') . ' ' . ($hasLeading ? 'pl-10 ' : 'px-4 ') . ($hasTrailing ? 'pr-10' : ''),
        'xl' => 'h-11 text-base ' . ($pill ? 'rounded-full' : 'rounded-xl') . ' ' . ($hasLeading ? 'pl-11 ' : 'px-5 ') . ($hasTrailing ? 'pr-11' : ''),
        default => 'h-9 text-sm ' . ($pill ? 'rounded-full' : 'rounded-lg') . ' ' . ($hasLeading ? 'pl-9 ' : 'px-3.5 ') . ($hasTrailing ? 'pr-9' : ''),
    };

    if ($variant === 'flush') {
        $sizeClasses = match ($size) {
            'sm' => 'h-8 text-xs px-0 rounded-none',
            'md' => 'h-9 text-sm px-0 rounded-none',
            'lg' => 'h-10 text-sm px-0 rounded-none',
            'xl' => 'h-11 text-base px-0 rounded-none',
            default => 'h-9 text-sm px-0 rounded-none',
        };
    }

    $variantClasses = match ($variant) {
        'filled' => $hasError 
            ? 'bg-destructive/10 border border-destructive text-destructive placeholder:text-destructive/50 focus-visible:bg-background focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20'
            : 'bg-muted/60 border border-transparent text-foreground hover:bg-muted/80 focus-visible:bg-background focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20',
        'flush' => $hasError
            ? 'border-b border-destructive text-destructive placeholder:text-destructive/50 bg-transparent focus-visible:border-destructive focus-visible:ring-0'
            : 'border-b border-input text-foreground bg-transparent focus-visible:border-ring focus-visible:ring-0',
        'ghost' => $hasError
            ? 'border-transparent text-destructive placeholder:text-destructive/50 bg-transparent focus-visible:ring-2 focus-visible:ring-destructive/20'
            : 'border-transparent text-foreground bg-transparent hover:bg-muted/40 focus-visible:bg-transparent focus-visible:ring-2 focus-visible:ring-ring/20',
        'accent' => $hasError
            ? 'bg-destructive/10 border border-destructive text-destructive placeholder:text-destructive/50 focus-visible:bg-background focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20'
            : 'bg-accent/15 border border-accent/40 text-foreground placeholder:text-muted-foreground hover:bg-accent/25 focus-visible:bg-background focus-visible:border-accent focus-visible:ring-2 focus-visible:ring-accent/25',
        default => $hasError
            ? 'border border-destructive bg-background text-destructive placeholder:text-destructive/50 focus-visible:border-destructive focus-visible:ring-2 focus-visible:ring-destructive/20'
            : 'border border-input bg-background text-foreground shadow-2xs focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20',
    };

    $compiledClasses = trim("{$baseClasses} {$sizeClasses} {$variantClasses}");
@endphp

<div class="{{ $wrapperClass }}">
    @if ($label)
        <label for="{{ $id }}" class="block text-xs font-semibold text-foreground mb-1.5 select-none">
            {{ $label }}
        </label>
    @endif

    @if ($description)
        <p class="mb-1.5 text-xs text-muted-foreground">{{ $description }}</p>
    @endif

    <div class="relative flex items-center">
        @if ($hasLeading)
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-muted-foreground text-xs">
                @if (isset($icon))
                    <span class="size-4 flex items-center justify-center">{{ $icon }}</span>
                @elseif (!empty($prefix))
                    <span class="font-medium text-muted-foreground">{{ $prefix }}</span>
                @endif
            </div>
        @endif

        <input 
            type="{{ $type }}" 
            id="{{ $id }}" 
            name="{{ $name }}" 
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif
            {{ $attributes->twMerge(['class' => $compiledClasses]) }}
        >

        @if ($hasTrailing)
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-muted-foreground text-xs">
                @if (isset($trailingIcon))
                    <span class="size-4 flex items-center justify-center">{{ $trailingIcon }}</span>
                @elseif (!empty($suffix))
                    <span class="font-medium text-muted-foreground">{{ $suffix }}</span>
                @endif
            </div>
        @endif
    </div>

    @if ($hasError)
        <p class="mt-1.5 text-xs font-medium text-destructive flex items-center gap-1">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" x2="12" y1="8" y2="12"/>
                <line x1="12" x2="12.01" y1="16" y2="16"/>
            </svg>
            <span>{{ $errorMessage }}</span>
        </p>
    @elseif ($info)
        <p class="mt-1.5 text-xs text-muted-foreground">{{ $info }}</p>
    @endif
</div>
