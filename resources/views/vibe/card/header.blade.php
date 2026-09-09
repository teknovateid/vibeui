@blaze(fold: true)

<div {{ $attributes->twMerge(['class' => 'flex flex-col gap-1.5 pb-2 border-b border-border']) }}>
    {{ $slot }}
</div>
