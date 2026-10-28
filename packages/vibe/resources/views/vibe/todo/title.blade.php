@blaze(fold: true)

<div data-todo-title {{ $attributes->twMerge(['class' => 'font-semibold text-sm sm:text-base leading-snug tracking-tight text-foreground']) }}>
    {{ $slot }}
</div>

