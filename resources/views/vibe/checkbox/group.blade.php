@blaze

@props([
    'label' => null,
    'description' => null,
    'error' => null,
    'errorName' => null,
    'orientation' => 'vertical', // vertical, horizontal, grid
    'columns' => 2, // 2, 3, 4
    'required' => false,
])

@php
    $hasError = !empty($error) || ($errorName && $errors->has($errorName));
    $errorMessage = ($error && !is_bool($error)) ? $error : ($errorName ? $errors->first($errorName) : null);

    $gridCols = match ((int) $columns) {
        3 => 'grid-cols-1 sm:grid-cols-2 md:grid-cols-3',
        4 => 'grid-cols-1 sm:grid-cols-2 md:grid-cols-4',
        default => 'grid-cols-1 sm:grid-cols-2',
    };

    $layoutClasses = match ($orientation) {
        'horizontal' => 'flex flex-wrap items-center gap-4 sm:gap-6',
        'grid' => "grid {$gridCols} gap-3",
        default => 'flex flex-col gap-2.5',
    };
@endphp

<fieldset {{ $attributes->twMerge(['class' => 'space-y-2']) }}>
    @if ($label)
        <legend class="text-xs font-semibold text-foreground select-none">
            {{ $label }}
            @if ($required)
                <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
            @endif
        </legend>
    @endif

    @if ($description)
        <p class="text-xs text-muted-foreground">{{ $description }}</p>
    @endif

    <div class="{{ $layoutClasses }} pt-0.5">
        {{ $slot }}
    </div>

    @if ($hasError && $errorMessage)
        <p class="mt-1 text-xs text-destructive flex items-center gap-1">
            <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
            </svg>
            {{ $errorMessage }}
        </p>
    @endif
</fieldset>
