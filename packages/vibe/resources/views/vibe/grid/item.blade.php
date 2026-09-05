@blaze(fold: true)

@props([
    'id' => null,
    'key' => null,
    'title' => null,
    'titleTag' => 'h3',
    'description' => null,
    'colSpan' => 4,
    'rowSpan' => 1,
    'minColSpan' => 2,
    'maxColSpan' => 12,
    'resizable' => true,
    'reorderable' => true,
    'variant' => 'default',
    'padding' => 'default',
])

<vibe:grid.card
    :id="$id"
    :key="$key"
    :title="$title"
    :titleTag="$titleTag"
    :description="$description"
    :colSpan="$colSpan"
    :rowSpan="$rowSpan"
    :minColSpan="$minColSpan"
    :maxColSpan="$maxColSpan"
    :resizable="$resizable"
    :reorderable="$reorderable"
    :variant="$variant"
    :padding="$padding"
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
</vibe:grid.card>
