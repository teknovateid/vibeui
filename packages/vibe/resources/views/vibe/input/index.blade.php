@props([
    'label' => null,
    'id' => null,
    'type' => 'text',
    'name' => null,
    'description' => null,
    'size' => 'md',
])

@php
    $id = $id ?? ($name ?? uniqid('input-'));
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $errorName = $attributes->whereStartsWith('wire:model')->first() ?? $name;

    $sizeClasses = match ($size) {
        'sm' => 'px-3 py-1.5 text-xs sm:text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-4 py-3 text-base',
        'xl' => 'px-5 py-4 text-lg',
        default => 'px-4 py-2 text-sm',
    };
@endphp

<div class="space-y-1.5">
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif

    @if ($description)
        <p class="text-xs text-gray-500">{{ $description }}</p>
    @endif

    <div class="relative">
        <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" {{ $attributes->class([
            'block w-full rounded-lg shadow-sm transition duration-150 ease-in-out', 
            $sizeClasses,
            'border-gray-300 focus:border-blue-500 focus:ring-blue-500' => !($errorName && $errors->has($errorName)), 
            'border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 pr-10' => $errorName && $errors->has($errorName), 
            'bg-gray-50 cursor-not-allowed text-gray-500' => $attributes->has('disabled') || $attributes->has('readonly')
        ]) }}>

        @if ($errorName && $errors->has($errorName))
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="w-5 h-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                </svg>
            </div>
        @endif
    </div>

    @if ($errorName)
        @error($errorName)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    @endif
</div>
