@blaze(fold: true)

<div {{ $attributes->twMerge(['class' => 'flex flex-col gap-1.5 pb-4']) }}>
    {{ $slot }}
</div>
