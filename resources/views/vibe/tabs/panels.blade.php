@blaze(fold: true)

<div 
    {{ $attributes->twMerge([
        'class' => 'vibe-tabs-panels w-full'
    ]) }}
    :class="{
        'flex-1 min-w-0': layout === 'cols'
    }"
>
    {{ $slot }}
</div>
