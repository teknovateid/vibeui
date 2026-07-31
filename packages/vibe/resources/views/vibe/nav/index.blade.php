@blaze(fold: true)

@props([
    'collapsed' => false,
])

<nav {{ $attributes->twMerge(['class' => 'flex flex-col gap-1 w-full']) }} @if($collapsed) data-collapsed="true" @endif>
    {{ $slot }}
</nav>
