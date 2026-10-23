@blaze(fold: true)

<div
    {{ $attributes->twMerge([
        'class' => 'vibe-stepper-panels w-full mt-6 transition-all duration-200'
    ]) }}
>
    {{ $slot }}
</div>
