@blaze(fold: true)

@props([
    'variant' => 'default',
    'padding' => 'sm',
    'hover' => true,
    'title' => null,
    'titleTag' => 'h4',
    'description' => null,
])

<vibe:grid-list.card
    :variant="$variant"
    :padding="$padding"
    :hover="$hover"
    :title="$title"
    :titleTag="$titleTag"
    :description="$description"
    {{ $attributes }}
>
    @if (isset($header))
        <x-slot:header>{{ $header }}</x-slot:header>
    @endif
    @if (isset($actions))
        <x-slot:actions>{{ $actions }}</x-slot:actions>
    @endif
    {{ $slot }}
    @if (isset($footer))
        <x-slot:footer>{{ $footer }}</x-slot:footer>
    @endif
</vibe:grid-list.card>
