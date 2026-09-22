@blaze(fold: true)

@props([
    'key' => null,
    'as' => 'div',
    'empty' => null,
    'emptyColspan' => null,
])

@php
    $tag = $as ?: 'div';
    $eachKey = $key ?? $attributes->get('vibe-show-each');
    $isTbody = strtolower($tag) === 'tbody';
@endphp

@pushOnce('body')
    @vite('resources/js/vibe/show.js')
@endPushOnce

<{{ $tag }}
    @if ($eachKey) vibe-show-each="{{ $eachKey }}" @endif
    {{ $attributes->except(['vibe-show-each']) }}
>
    <template>
        {{ $slot }}
    </template>

    @if ($empty)
        @if ($isTbody)
            <tr data-vibe-empty class="hidden">
                <td @if($emptyColspan) colspan="{{ $emptyColspan }}" @endif class="py-4 text-center text-xs text-muted-foreground">
                    {{ $empty }}
                </td>
            </tr>
        @else
            <div data-vibe-empty class="hidden py-4 text-center text-xs text-muted-foreground">
                {{ $empty }}
            </div>
        @endif
    @endif
</{{ $tag }}>
