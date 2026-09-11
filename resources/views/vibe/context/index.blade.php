@blaze(fold: true)

@props([
    'menu' => null,
])

<div
    {{ $attributes->twMerge(['class' => 'block']) }}
    @if ($menu)
        @contextmenu.prevent="$dispatch('open-context', {
            menu: '{{ $menu }}',
            x: $event.clientX,
            y: $event.clientY
        })"
    @endif
>
    {{ $slot }}
</div>
