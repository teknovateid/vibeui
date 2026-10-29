@blaze(fold: true)

<div {{ $attributes->twMerge(['class' => 'flex items-center justify-between gap-2 pt-2 border-t border-border/40 w-full text-xs text-muted-foreground']) }}>
    {{ $slot }}
</div>

