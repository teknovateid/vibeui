@blaze

@props([
    'label' => null,
    'id' => null,
    'type' => 'text',
    'name' => null,
    'description' => null,
    'size' => 'lg',
    'info' => null,
    'error' => null,
    'errorName' => null,
    'wrapperClass' => null,
])

@php
    $id = $id ?? ($name ?? uniqid('input-'));
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $errorKey = $errorName ?? $attributes->whereStartsWith('wire:model')->first() ?? $name;

    $hasError = !empty($error) || ($errorKey && $errors->has($errorKey));
    $errorMessage = $error ?: ($errorKey ? $errors->first($errorKey) : null);

    $sizeClasses = match ($size) {
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-base',
        default => 'px-4 py-2 text-sm',
    };

    $baseClasses = 'block w-full rounded-lg border focus:outline-none focus:ring-2 focus:ring-offset-0 disabled:opacity-50 disabled:cursor-not-allowed';

    $stateClasses = $hasError 
        ? 'border-red-500 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500/20 dark:border-red-600 dark:text-red-400 dark:placeholder-red-500/50 dark:focus:border-red-500 dark:focus:ring-red-500/30 bg-white dark:bg-vibe-950'
        : 'border-vibe-300 text-vibe-900 placeholder-vibe-400 focus:border-vibe-900 focus:ring-vibe-900/20 dark:border-vibe-700 dark:text-vibe-100 dark:placeholder-vibe-500 dark:focus:border-vibe-100 dark:focus:ring-vibe-100/30 bg-white dark:bg-vibe-950';

    $compiledClasses = "{$baseClasses} {$sizeClasses} {$stateClasses}";
@endphp

<div class="{{ $wrapperClass }}">
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-vibe-900 dark:text-vibe-100 mb-1">
            {{ $label }}
        </label>
    @endif

    @if ($description)
        <p class="mb-1.5 text-xs text-vibe-500 dark:text-vibe-400">{{ $description }}</p>
    @endif

    <div class="relative">
        <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" {{ $attributes->merge(['class' => $compiledClasses]) }}>
    </div>

    @if ($hasError)
        <p class="mt-1.5 text-xs font-medium text-red-600 dark:text-red-400">{{ $errorMessage }}</p>
    @elseif ($info)
        <p class="mt-1.5 text-xs font-medium text-vibe-500 dark:text-vibe-400">{{ $info }}</p>
    @endif
</div>
