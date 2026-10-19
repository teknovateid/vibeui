@blaze(fold: true)

<tbody {{ $attributes->twMerge(['class' => 'divide-y divide-table-border text-foreground']) }}>
    {{ $slot }}
</tbody>
