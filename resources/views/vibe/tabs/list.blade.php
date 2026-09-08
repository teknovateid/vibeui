@blaze(fold: true)

@props([
    'fitted' => false,
    'grow' => false,
])

@php
    $isFitted = $fitted || $grow;
@endphp

<div role="tablist" :aria-orientation="layout === 'cols' ? 'vertical' : 'horizontal'" @keydown.right.prevent="if (layout === 'rows') focusNextTab($event, 1)" @keydown.left.prevent="if (layout === 'rows') focusNextTab($event, -1)" @keydown.down.prevent="if (layout === 'cols') focusNextTab($event, 1)" @keydown.up.prevent="if (layout === 'cols') focusNextTab($event, -1)" @keydown.home.prevent="focusFirstTab()" @keydown.end.prevent="focusLastTab()" {{ $attributes->twMerge([
    'class' => 'vibe-tabs-list select-none scrollbar-none',
]) }} :class="{
    'inline-flex items-center gap-1 p-1 bg-muted rounded-xl border border-border/40 max-w-full overflow-x-auto': layout === 'rows' && variant === 'pill',
    'flex items-center gap-6 border-b border-border w-full overflow-x-auto': layout === 'rows' && variant === 'underline',
    'flex flex-wrap items-center gap-2 w-full': layout === 'rows' && variant === 'button',
    'flex flex-col gap-1 p-1.5 bg-muted rounded-xl border border-border/40 w-full md:w-60 shrink-0': layout === 'cols' && variant === 'pill',
    'flex flex-col border-r border-border w-full md:w-60 shrink-0': layout === 'cols' && variant === 'underline',
    'flex flex-col gap-2 w-full md:w-60 shrink-0': layout === 'cols' && variant === 'button',
    'flex flex-col border-b md:border-b-0 md:border-r border-border w-full md:w-60 shrink-0 self-stretch p-3.5 gap-1': variant === 'sidebar',
    '*:flex-1 w-full': {{ $isFitted ? 'true' : 'false' }}
}">
    {{ $slot }}
</div>
