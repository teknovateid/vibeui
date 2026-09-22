@blaze(fold: true)

@props([
    'key' => null,
    'as' => 'span',
    'html' => false,
    'attr' => null,
])

@php
    $tag = $as ?: 'span';
    $showKey = $key ?? $attributes->get('vibe-show');
@endphp

@pushOnce('body')
    @vite('resources/js/vibe/show.js')
@endPushOnce

<{{ $tag }}
    @if ($showKey) vibe-show="{{ $showKey }}" @endif
    @if ($html) vibe-show-html @endif
    @if ($attr) vibe-show-attr="{{ $attr }}" @endif
    {{ $attributes->except(['vibe-show', 'vibe-show-html', 'vibe-show-attr']) }}
>{{ $slot }}</{{ $tag }}>
