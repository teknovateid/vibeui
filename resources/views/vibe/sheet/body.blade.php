@props([
    'id' => null,
])
@php
    $bodyId = $id ?? $attributes->get('id');
@endphp

<div
    @if($bodyId) id="{{ $bodyId }}" @endif
    {{ $attributes->twMerge(['class' => 'flex-1 overflow-y-auto min-h-0 p-4']) }}
>
    {{ $slot }}
</div>
