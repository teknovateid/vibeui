@blaze(fold: true)

<div {{ $attributes->twMerge(['class' => 'bg-card text-card-foreground p-6 border border-border rounded-xl shadow-2xs']) }}>
    {{ $slot }}
</div>