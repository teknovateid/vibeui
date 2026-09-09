@blaze(fold: true)

@props([
    'id' => null,
])

<div
    @if($id) id="{{ $id }}" @endif
    {{ $attributes->twMerge(['class' => 'p-6 overflow-y-auto max-h-[calc(85vh-130px)] min-h-0 text-sm text-card-foreground space-y-4']) }}
>
    {{ $slot }}
</div>
