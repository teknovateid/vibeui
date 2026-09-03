@blaze(fold: true)

<div {{ $attributes->twMerge(['class' => 'flex items-center justify-between gap-3 pt-4 border-t border-border/60']) }}>
    {{ $slot }}
</div>
