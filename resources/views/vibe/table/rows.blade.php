@blaze(fold: true)

<tbody {{ $attributes->twMerge(['class' => 'divide-y divide-border/60 text-foreground']) }}>
    {{ $slot }}
</tbody>
