@blaze(fold: true)
<nav
    aria-label="{{ __('vibe/stepper.progress') }}"
    {{ $attributes->twMerge([
        'class' => 'vibe-stepper-header w-full'
    ]) }}
>
    <ol
        role="tablist"
        class="vibe-stepper-list transition-all duration-200"
        :class="headerListClasses()"
    >
        {{ $slot }}
    </ol>
</nav>
