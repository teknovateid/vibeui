@blaze(fold: true)

<div {{ $attributes->twMerge(['class' => 'relative px-6 py-4 flex flex-col gap-1 text-lg font-semibold text-foreground shrink-0 border-b border-border/80']) }}>
    {{ $slot }}
</div>
