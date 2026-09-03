@blaze(fold: true)

<p {{ $attributes->twMerge(['class' => 'text-sm text-muted-foreground leading-relaxed']) }}>
    {{ $slot }}
</p>
