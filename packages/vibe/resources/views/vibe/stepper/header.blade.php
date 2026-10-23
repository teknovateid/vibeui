@blaze(fold: true)

<nav
    aria-label="{{ __('vibe/stepper.progress') }}"
    {{ $attributes->twMerge([
        'class' => 'vibe-stepper-header w-full'
    ]) }}
>
    <ol
        role="tablist"
        class="vibe-stepper-list w-full transition-all duration-200"
        :class="{
            'flex flex-col items-stretch space-y-4': orientation === 'vertical',
            'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3.5': orientation === 'horizontal' && variant === 'cards',
            'flex flex-row items-center justify-between gap-2 sm:gap-3 overflow-x-auto hide-scroll py-1': orientation === 'horizontal' && variant !== 'cards'
        }"
    >
        {{ $slot }}
    </ol>
</nav>
