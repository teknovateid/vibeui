@props([
    'language' => 'blade',
    'lang' => null,
    'title' => null,
    'filename' => null,
    'theme' => 'vibe',
    'lineNumbers' => true,
    'copyable' => true,
    'code' => null,
])

@php
    $resolvedLang = $lang ?? $language ?? 'blade';
    $resolvedTitle = $filename ?? $title;
@endphp

<div {{ $attributes->twMerge(['class' => 'relative w-full border-t border-border']) }}>
    <vibe:highlightjs
        :language="$resolvedLang"
        :title="$resolvedTitle"
        :theme="$theme"
        :lineNumbers="$lineNumbers"
        :copyable="$copyable"
        :code="$code"
        class="rounded-none! border-none! shadow-none!"
    >
        @if (!$code)
            {{ $slot }}
        @endif
    </vibe:highlightjs>
</div>
