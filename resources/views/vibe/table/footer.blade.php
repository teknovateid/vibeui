@blaze(fold: true)

<tfoot {{ $attributes->twMerge(['class' => 'border-t-2 border-table-border bg-table-footer font-medium text-xs text-table-header-foreground']) }}>
    <tr>
        {{ $slot }}
    </tr>
</tfoot>
