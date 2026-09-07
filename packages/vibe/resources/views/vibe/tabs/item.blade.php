@blaze(fold: true)

<vibe:tabs.tab {{ $attributes }}>
    @if (isset($icon))
        <x-slot:icon>{{ $icon }}</x-slot:icon>
    @endif
    {{ $slot }}
</vibe:tabs.tab>
