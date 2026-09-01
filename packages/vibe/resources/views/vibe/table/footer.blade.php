@blaze(fold: true)

<tfoot {{ $attributes->twMerge(['class' => 'border-t-2 border-border bg-muted/40 font-medium text-xs text-foreground']) }}>
    <tr>
        {{ $slot }}
    </tr>
</tfoot>
