@blaze(fold: true)

@props([
    'id' => null,
])

<div
    @if($id) id="{{ $id }}" @endif
    {{ $attributes->twMerge(['class' => 'flex-1 overflow-y-auto min-h-0 p-4']) }}
>
    {{ $slot }}
</div>
