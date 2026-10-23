@blaze(fold: true)

@props([
    'name',
    'lazy' => false,
])

<div 
    role="tabpanel"
    x-bind:id="tabId + '-panel-' + @js($name)"
    x-bind:aria-labelledby="tabId + '-tab-' + @js($name)"
    x-show="activeTab === @js($name)"
    x-cloak
    x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0 translate-y-1"
    x-transition:enter-end="opacity-100 translate-y-0"
    tabindex="0"
    {{ $attributes->twMerge([
        'class' => 'vibe-tabs-panel w-full focus:outline-none'
    ]) }}
    :class="{
        'flex-1 min-w-0': layout === 'cols' || variant === 'sidebar'
    }"
>
    @if ($lazy)
        <template x-if="activeTab === @js($name)">
            <div>{{ $slot }}</div>
        </template>
    @else
        {{ $slot }}
    @endif
</div>
