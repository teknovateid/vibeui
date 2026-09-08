@blaze(fold: true)

@props([
    'name',
    'badge' => null,
    'badgeVariant' => 'secondary',
    'disabled' => false,
    'href' => null,
    'variant' => null,
    'activeVariant' => null,
    'inactiveVariant' => null,
    'size' => null,
])

@php
    $buttonVariantMap = [
        'primary' => 'bg-primary text-primary-foreground shadow-xs hover:bg-primary/90',
        'secondary' => 'bg-secondary text-secondary-foreground shadow-2xs hover:bg-secondary/80',
        'outline' => 'border border-input bg-background text-foreground shadow-2xs hover:bg-accent hover:text-accent-foreground',
        'ghost' => 'text-foreground hover:bg-accent hover:text-accent-foreground active:bg-accent/80',
        'surface' => 'bg-card border border-border/80 text-card-foreground shadow-2xs hover:bg-accent/60',
        'accent' => 'bg-accent text-accent-foreground border border-accent hover:bg-accent/80 shadow-2xs focus-visible:ring-accent',
        'destructive' => 'bg-destructive text-destructive-foreground shadow-xs hover:bg-destructive/90 focus-visible:ring-destructive',
        'danger' => 'bg-destructive text-destructive-foreground shadow-xs hover:bg-destructive/90 focus-visible:ring-destructive',
        'success' => 'bg-emerald-600 text-white dark:bg-emerald-500 shadow-xs hover:bg-emerald-700 dark:hover:bg-emerald-600 focus-visible:ring-emerald-500',
        'warning' => 'bg-amber-500 text-white dark:bg-amber-600 shadow-xs hover:bg-amber-600 dark:hover:bg-amber-700 focus-visible:ring-amber-500',
        'info' => 'bg-sky-500 text-white dark:bg-sky-600 shadow-xs hover:bg-sky-600 dark:hover:bg-sky-700 focus-visible:ring-sky-500',
        'default' => 'border border-border bg-card text-card-foreground shadow-2xs hover:bg-accent hover:text-accent-foreground',
    ];

    $activeBtn = $activeVariant ?? $variant ?? 'primary';
    $inactiveBtn = $inactiveVariant ?? 'default';

    $activeBtnClasses = $buttonVariantMap[$activeBtn] ?? $buttonVariantMap['primary'];
    $inactiveBtnClasses = $buttonVariantMap[$inactiveBtn] ?? $buttonVariantMap['default'];
@endphp

<vibe:button
    :href="$href"
    :disabled="$disabled"
    :size="$size ?? 'md'"
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

        '{{ $activeBtnClasses }} font-medium rounded-lg': layout === 'rows' && variant === 'button' && activeTab === '{{ $name }}',
        '{{ $inactiveBtnClasses }} font-medium rounded-lg': layout === 'rows' && variant === 'button' && activeTab !== '{{ $name }}',

        {{-- Layout 2 Kolom (Vertical / Cols) --}}
        'w-full justify-start text-left bg-white text-foreground shadow-xs font-semibold rounded-lg ring-1 ring-border/50 dark:bg-white/15 dark:text-white dark:ring-white/20': layout === 'cols' && variant === 'pill' && activeTab === '{{ $name }}',
        'w-full justify-start text-left text-muted-foreground hover:text-foreground hover:bg-black/5 dark:hover:bg-white/5 rounded-lg font-medium': layout === 'cols' && variant === 'pill' && activeTab !== '{{ $name }}',

        'w-full justify-start text-left border-r-2 border-primary text-foreground font-semibold -mr-px rounded-none bg-transparent px-3 py-2 hover:bg-transparent': layout === 'cols' && variant === 'underline' && activeTab === '{{ $name }}',
        'w-full justify-start text-left border-r-2 border-transparent text-muted-foreground hover:text-foreground hover:border-muted-foreground/40 rounded-none bg-transparent px-3 py-2 font-medium hover:bg-transparent': layout === 'cols' && variant === 'underline' && activeTab !== '{{ $name }}',

        'w-full justify-start text-left {{ $activeBtnClasses }} font-medium rounded-lg': layout === 'cols' && variant === 'button' && activeTab === '{{ $name }}',
        'w-full justify-start text-left {{ $inactiveBtnClasses }} font-medium rounded-lg': layout === 'cols' && variant === 'button' && activeTab !== '{{ $name }}',
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
