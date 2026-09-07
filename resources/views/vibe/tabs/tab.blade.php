@blaze(fold: true)

@props([
    'name',
    'badge' => null,
    'badgeVariant' => 'secondary',
    'disabled' => false,
    'href' => null,
])

<vibe:button
    :href="$href"
    :disabled="$disabled"
    :x-data="false"
    variant="tab"
    role="tab"
    id="tab-{{ $name }}"
    aria-controls="panel-{{ $name }}"
    data-tab-name="{{ $name }}"
    x-bind:aria-selected="activeTab === '{{ $name }}' ? 'true' : 'false'"
    x-bind:tabindex="activeTab === '{{ $name }}' ? '0' : '-1'"
    @click="select('{{ $name }}'); $dispatch('select-tab', '{{ $name }}')"
    {{ $attributes->twMerge([
        'class' => 'vibe-tabs-tab relative transition-all duration-150 gap-2 shrink-0 cursor-pointer'
    ]) }}
    x-bind:class="{
        {{-- Layout 2 Baris (Horizontal / Rows) --}}
        'bg-white text-foreground shadow-xs font-semibold rounded-lg ring-1 ring-border/50 dark:bg-white/15 dark:text-white dark:ring-white/20': layout === 'rows' && variant === 'pill' && activeTab === '{{ $name }}',
        'text-muted-foreground hover:text-foreground hover:bg-black/5 dark:hover:bg-white/5 rounded-lg font-medium': layout === 'rows' && variant === 'pill' && activeTab !== '{{ $name }}',

        'border-b-2 border-primary text-foreground font-semibold -mb-px rounded-none bg-transparent px-3 pb-2.5 pt-2 hover:bg-transparent': layout === 'rows' && variant === 'underline' && activeTab === '{{ $name }}',
        'border-b-2 border-transparent text-muted-foreground hover:text-foreground hover:border-muted-foreground/40 rounded-none bg-transparent px-3 pb-2.5 pt-2 font-medium hover:bg-transparent': layout === 'rows' && variant === 'underline' && activeTab !== '{{ $name }}',

        'border border-primary bg-primary/10 text-primary font-semibold shadow-xs hover:bg-primary/15 rounded-lg': layout === 'rows' && variant === 'button' && activeTab === '{{ $name }}',
        'border border-border/80 bg-card text-muted-foreground hover:text-foreground hover:bg-accent/60 shadow-2xs rounded-lg font-medium': layout === 'rows' && variant === 'button' && activeTab !== '{{ $name }}',

        {{-- Layout 2 Kolom (Vertical / Cols) --}}
        'w-full justify-start text-left bg-white text-foreground shadow-xs font-semibold rounded-lg ring-1 ring-border/50 dark:bg-white/15 dark:text-white dark:ring-white/20': layout === 'cols' && variant === 'pill' && activeTab === '{{ $name }}',
        'w-full justify-start text-left text-muted-foreground hover:text-foreground hover:bg-black/5 dark:hover:bg-white/5 rounded-lg font-medium': layout === 'cols' && variant === 'pill' && activeTab !== '{{ $name }}',

        'w-full justify-start text-left border-r-2 border-primary text-foreground font-semibold -mr-px rounded-none bg-transparent px-3 py-2 hover:bg-transparent': layout === 'cols' && variant === 'underline' && activeTab === '{{ $name }}',
        'w-full justify-start text-left border-r-2 border-transparent text-muted-foreground hover:text-foreground hover:border-muted-foreground/40 rounded-none bg-transparent px-3 py-2 font-medium hover:bg-transparent': layout === 'cols' && variant === 'underline' && activeTab !== '{{ $name }}',

        'w-full justify-start text-left border border-primary bg-primary/10 text-primary font-semibold shadow-xs hover:bg-primary/15 rounded-lg': layout === 'cols' && variant === 'button' && activeTab === '{{ $name }}',
        'w-full justify-start text-left border border-border/80 bg-card text-muted-foreground hover:text-foreground hover:bg-accent/60 shadow-2xs rounded-lg font-medium': layout === 'cols' && variant === 'button' && activeTab !== '{{ $name }}',
    }"
>
    @if (isset($icon))
        <span class="inline-flex shrink-0 items-center justify-center [&>svg]:size-4 text-current">
            {{ $icon }}
        </span>
    @endif

    <span class="truncate">{{ $slot }}</span>

    @if ($badge !== null && $badge !== '')
        <vibe:badge :variant="$badgeVariant" size="xs" class="ml-auto rounded-full px-1.5 py-0 text-[10px] font-mono leading-tight">
            {{ $badge }}
        </vibe:badge>
    @endif
</vibe:button>
