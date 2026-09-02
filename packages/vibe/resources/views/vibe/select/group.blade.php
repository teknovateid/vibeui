@blaze(fold: true)

@props([
    'label',
])

<div 
    role="group" 
    aria-label="{{ $label }}"
    class="pt-1.5 first:pt-0.5"
    x-data="{
        hasVisibleChildren: true,
        checkGroupVisibility() {
            this.$nextTick(() => {
                let options = Array.from($el.querySelectorAll('[data-select-option]'));
                this.hasVisibleChildren = options.some(el => el.style.display !== 'none');
            });
        }
    }"
    x-init="$watch('search', () => checkGroupVisibility())"
    x-show="hasVisibleChildren"
>
    <div class="px-2.5 pt-1.5 pb-1 text-[11px] font-semibold uppercase tracking-wider text-muted-foreground/75 select-none">
        {{ $label }}
    </div>
    <div class="space-y-0.5">
        {{ $slot }}
    </div>
</div>
