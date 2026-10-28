@blaze(fold: true)

<div data-todo-description {{ $attributes->twMerge(['class' => 'text-xs text-muted-foreground leading-normal']) }}>
    {{ $slot }}
</div>

