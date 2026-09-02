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
    $rawCode = $code !== null ? (string) $code : (isset($slot) ? (string) $slot : '');
    // Clean compilation-prevention escape backslash from <\vibe: and </\vibe: and <\x-
    $rawCode = preg_replace('/<(\/)?\\\\(vibe:|x-)/', '<$1$2', $rawCode);
@endphp

<div data-vibe-preview-code style="display: none;" {{ $attributes->twMerge(['class' => 'relative w-full border-t border-border']) }}>
    <vibe:highlightjs
        :language="$resolvedLang"
        :title="$resolvedTitle"
        :theme="$theme"
        :lineNumbers="$lineNumbers"
        :copyable="$copyable"
        :code="$rawCode"
        class="rounded-none! border-none! shadow-none!"
    />
</div>
