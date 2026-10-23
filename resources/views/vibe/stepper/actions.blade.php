@blaze(fold: true)

<div
    {{ $attributes->twMerge([
        'class' => 'vibe-stepper-actions flex items-center justify-between gap-3 mt-8 pt-4 border-t border-border/60 w-full'
    ]) }}
>
    {{ $slot }}
</div>
