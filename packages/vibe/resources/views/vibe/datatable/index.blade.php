@blaze

@props([
    'component' => null,
])

@if ($component)
    @livewire($component, $attributes->getAttributes())
@else
    <div {{ $attributes->twMerge(['class' => 'w-full space-y-4']) }}>
        {{ $slot }}
    </div>
@endif
