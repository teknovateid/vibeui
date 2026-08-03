@blaze(fold: true)

@php
    $classes = 'text-sm text-vibe-500 dark:text-vibe-400 mt-1';
@endphp

<p {{ $attributes->twMerge(['class' => $classes]) }}>
    {{ $slot }}
</p>
