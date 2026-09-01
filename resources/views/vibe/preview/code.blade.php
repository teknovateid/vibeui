@blaze

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
    $resolvedLang = $lang ?: $language;
    $resolvedTitle = $filename ?: $title;
@endphp

<div data-vibe-preview-code style="display: none;" {{ $attributes->twMerge(['class' => 'relative w-full border-t border-border']) }}>
    <vibe:highlightjs
        :language="$resolvedLang"
        :title="$resolvedTitle"
        :theme="$theme"
        :lineNumbers="$lineNumbers"
        :copyable="$copyable"
        :code="$code ?? (string) $slot"
        class="rounded-none! border-none! shadow-none!"
    />
</div>
