@blaze(fold: true)

@props([])

<div
    x-show="isOpen(itemValue)"
    x-collapse
    x-cloak
    :id="'accordion-content-' + itemValue"
    :aria-labelledby="'accordion-trigger-' + itemValue"
    role="region"
    {{ $attributes->twMerge([
        'class' => 'overflow-hidden transition-all duration-200'
    ]) }}
>
    <div
        :class="{
            'px-3 pb-2.5 pt-0 text-xs': size === 'xs',
            'px-3.5 pb-3 pt-0 text-xs': size === 'sm',
            'px-5 pb-5 pt-0.5 text-base': size === 'lg',
            'px-5.5 pb-6 pt-1 text-base': size === 'xl',
            'px-4 pb-4 pt-0 text-sm': size !== 'xs' && size !== 'sm' && size !== 'lg' && size !== 'xl'
        }"
        class="text-muted-foreground leading-relaxed"
    >
        {{ $slot }}
    </div>
</div>
