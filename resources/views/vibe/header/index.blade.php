@blaze(fold: true)

@props([
    'variant' => 'default',
    'size' => 'default',
    'scrolledClass' => null,
    'unscrolledClass' => null,
    'threshold' => 10,
])

@php
    $isSticky = $variant === 'sticky';
    $hasCustomClasses = !empty($scrolledClass) || !empty($unscrolledClass);

    $baseClasses = $isSticky
        ? 'flex items-center justify-between shrink-0 text-header-foreground border-b border-transparent bg-transparent transition-[background-color,border-color,backdrop-filter,box-shadow] duration-200' . (!$hasCustomClasses ? ' data-[scrolled=true]:bg-header/80 data-[scrolled=true]:backdrop-blur-md data-[scrolled=true]:border-header-border/80 data-[scrolled=true]:shadow-2xs' : '')
        : 'flex items-center justify-between shrink-0 bg-header text-header-foreground border-b border-header-border';

    $variantClasses = match ($variant) {
        'sticky' => 'sticky top-0 z-50',
        default => '',
    };

    $sizeClasses = match ($size) {
        'sm' => 'py-2.5 px-4',
        'default' => 'py-4 px-6',
        'lg' => 'py-6 px-8',
        default => 'py-4 px-6',
    };

    $compiledClasses = "{$baseClasses} {$sizeClasses} {$variantClasses}";
@endphp

@if ($isSticky)
    <header
        x-data="{
            isScrolled: false,
            threshold: {{ (int) $threshold }},
            _target: null,
            _onScroll: null,
            init() {
                let findScrollTarget = () => {
                    let parent = this.$el.parentElement;
                    while (parent && parent !== document.body && parent !== document.documentElement) {
                        let style = window.getComputedStyle(parent);
                        if (style.overflowY === 'auto' || style.overflowY === 'scroll') {
                            return parent;
                        }
                        parent = parent.parentElement;
                    }
                    return window;
                };

                this._target = findScrollTarget();
                this._onScroll = () => {
                    let containerScroll = (this._target !== window) ? this._target.scrollTop : 0;
                    let windowScroll = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
                    let currentScroll = Math.max(containerScroll, windowScroll);
                    this.isScrolled = currentScroll > this.threshold;
                };

                this._onScroll();
                this._target.addEventListener('scroll', this._onScroll, { passive: true });
                if (this._target !== window) {
                    window.addEventListener('scroll', this._onScroll, { passive: true });
                }
            },
            destroy() {
                if (this._target && this._onScroll) {
                    this._target.removeEventListener('scroll', this._onScroll);
                    if (this._target !== window) {
                        window.removeEventListener('scroll', this._onScroll);
                    }
                }
            }
        }"
        data-variant="{{ $variant }}"
        data-scrolled="false"
        :data-scrolled="isScrolled ? 'true' : 'false'"
        @if ($hasCustomClasses)
            data-custom-scrolled="true"
            :class="isScrolled ? '{{ $scrolledClass }}' : '{{ $unscrolledClass }}'"
        @endif
        {{ $attributes->twMerge(['class' => $compiledClasses]) }}
    >
        {{ $slot }}
    </header>
@else
    <header data-variant="{{ $variant }}" {{ $attributes->twMerge(['class' => $compiledClasses]) }}>
        {{ $slot }}
    </header>
@endif