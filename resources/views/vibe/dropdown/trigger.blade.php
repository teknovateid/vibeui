@blaze(fold: true)

<div @click="toggle()" {{ $attributes->twMerge(['class' => 'cursor-pointer inline-block']) }}>
    {{ $slot }}
</div>
