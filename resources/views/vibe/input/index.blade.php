@props([
    'label' => null,
    'id' => null,
    'type' => 'text',
    'name' => null,
    'description' => null,
    'size' => 'md',
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
        'sm' => 'px-3 py-1.5 text-xs sm:text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-4 py-3 text-base',
        'xl' => 'px-5 py-4 text-lg',
        default => 'px-4 py-2 text-sm',
    };
@endphp

<div class="{{ $wrapperClass }}">
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif

    @if ($description)
        <p class="text-xs text-gray-500">{{ $description }}</p>
    @endif

    <div class="relative mt-1.5 mb-1">
        <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" {{ $attributes->twMerge([
            'block w-full rounded-lg shadow-xs transition duration-150 ease-in-out border border-gray-200', 
            $sizeClasses,
            'border-gray-300 focus:border-blue-500 focus:ring-blue-500' => !$hasError, 
            'border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500' => $hasError, 
            'bg-gray-50 cursor-not-allowed text-gray-500' => $attributes->has('disabled') || $attributes->has('readonly')
        ]) }}>
    </div>

    @if ($hasError)
        <p class="text-xs font-medium ml-1 text-red-600">{{ $errorMessage }}</p>
    @elseif ($info)
        <p class="text-xs font-medium ml-1 text-gray-500">{{ $info }}</p>
    @endif
</div>
