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
    'active' => null,
])

@php
    $isSsrActive = $active === true || $active === 'true' || $active === 1;

    $buttonVariantMap = [
        'primary' => 'bg-primary text-primary-foreground shadow-xs hover:bg-primary/90',
        'secondary' => 'bg-secondary text-secondary-foreground shadow-2xs hover:bg-secondary/80',
        'outline' => 'border border-input bg-background text-foreground shadow-2xs hover:bg-muted hover:text-foreground',
        'ghost' => 'text-foreground hover:bg-muted hover:text-foreground active:bg-muted/80',
        'surface' => 'bg-card border border-border/80 text-card-foreground shadow-2xs hover:bg-muted/60',
        'destructive' => 'bg-destructive text-destructive-foreground shadow-xs hover:bg-destructive/90 focus-visible:ring-destructive',
        'danger' => 'bg-destructive text-destructive-foreground shadow-xs hover:bg-destructive/90 focus-visible:ring-destructive',
        'success' => 'bg-success text-success-foreground shadow-xs hover:bg-success/90 focus-visible:ring-success',
        'warning' => 'bg-warning text-warning-foreground shadow-xs hover:bg-warning/90 focus-visible:ring-warning',
        'info' => 'bg-info text-info-foreground shadow-xs hover:bg-info/90 focus-visible:ring-info',
        'default' => 'border border-border bg-card text-card-foreground shadow-2xs hover:bg-muted hover:text-foreground',
    ];

    $activeBtn = $activeVariant ?? $variant ?? 'primary';
    $inactiveBtn = $inactiveVariant ?? 'default';

    $activeBtnClasses = $buttonVariantMap[$activeBtn] ?? $buttonVariantMap['primary'];
    $inactiveBtnClasses = $buttonVariantMap[$inactiveBtn] ?? $buttonVariantMap['default'];

    $ssrClasses = '';
    if ($active !== null) {
        $ssrClasses = match ($variant) {
            'sidebar' => $isSsrActive
                ? 'w-full justify-start text-left bg-muted text-foreground font-semibold rounded-lg shadow-2xs min-h-9 px-3 py-2 text-sm'
                : 'w-full justify-start text-left text-muted-foreground hover:text-foreground hover:bg-muted/60 rounded-lg font-medium min-h-9 px-3 py-2 text-sm',
            'underline' => $isSsrActive
                ? 'border-b-2 border-primary text-foreground font-semibold -mb-px rounded-none bg-transparent px-3 pb-2.5 pt-2 hover:bg-transparent h-9 text-sm active:scale-100 shadow-none'
                : 'border-b-2 border-transparent text-muted-foreground hover:text-foreground hover:border-muted-foreground/40 rounded-none bg-transparent px-3 pb-2.5 pt-2 font-medium hover:bg-transparent h-9 text-sm active:scale-100 shadow-none',
            'button' => $isSsrActive
                ? "{$activeBtnClasses} font-medium rounded-lg shadow-xs h-9 px-3.5 text-sm"
                : "{$inactiveBtnClasses} font-medium rounded-lg shadow-2xs h-9 px-3.5 text-sm",
            default => $isSsrActive
                ? 'bg-card text-foreground shadow-xs font-semibold rounded-lg ring-1 ring-border/50 h-8 px-3 text-sm'
                : 'text-muted-foreground hover:text-foreground hover:bg-muted/60 rounded-lg font-medium h-8 px-3 text-sm',
        };
    } elseif ($variant === 'sidebar') {
        $ssrClasses = 'w-full justify-start text-left text-muted-foreground hover:text-foreground hover:bg-muted/60 rounded-lg font-medium min-h-9 px-3 py-2 text-sm';
    }
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
    aria-selected="{{ $isSsrActive ? 'true' : 'false' }}"
    tabindex="{{ $isSsrActive ? '0' : '-1' }}"
    x-bind:aria-selected="activeTab === '{{ $name }}' ? 'true' : 'false'"
    x-bind:tabindex="activeTab === '{{ $name }}' ? '0' : '-1'"
    @click="select('{{ $name }}'); $dispatch('select-tab', '{{ $name }}')"
    {{ $attributes->twMerge([
        'class' => 'vibe-tabs-tab relative !transition-colors duration-150 gap-2 shrink-0 cursor-pointer ' . $ssrClasses
    ]) }}
    x-bind:class="{
        {{-- Layout 2 Baris (Horizontal / Rows) - Pill --}}
        'bg-card text-foreground shadow-xs font-semibold rounded-lg ring-1 ring-border/50': layout === 'rows' && variant === 'pill' && activeTab === '{{ $name }}',
        'text-muted-foreground hover:text-foreground hover:bg-muted/60 rounded-lg font-medium': layout === 'rows' && variant === 'pill' && activeTab !== '{{ $name }}',
        'h-7 px-2.5 text-xs rounded-md': variant === 'pill' && size === 'sm',
        'h-8 px-3 text-sm rounded-lg': variant === 'pill' && (size === 'md' || !size),
        'h-9 px-3.5 text-sm rounded-lg': variant === 'pill' && size === 'lg',

        {{-- Layout 2 Baris (Horizontal / Rows) - Underline --}}
        'border-b-2 border-primary text-foreground font-semibold -mb-px rounded-none bg-transparent hover:bg-transparent active:scale-100 shadow-none': layout === 'rows' && variant === 'underline' && activeTab === '{{ $name }}',
        'border-b-2 border-transparent text-muted-foreground hover:text-foreground hover:border-muted-foreground/40 rounded-none bg-transparent font-medium hover:bg-transparent active:scale-100 shadow-none': layout === 'rows' && variant === 'underline' && activeTab !== '{{ $name }}',
        'h-8 px-2.5 text-xs pb-2 pt-1.5': variant === 'underline' && size === 'sm',
        'h-9 px-3 text-sm pb-2.5 pt-2': variant === 'underline' && (size === 'md' || !size),
        'h-10 px-4 text-sm pb-3 pt-2.5': variant === 'underline' && size === 'lg',

        {{-- Layout 2 Baris (Horizontal / Rows) - Button --}}
        '{{ $activeBtnClasses }} font-medium rounded-lg shadow-xs': layout === 'rows' && variant === 'button' && activeTab === '{{ $name }}',
        '{{ $inactiveBtnClasses }} font-medium rounded-lg shadow-2xs': layout === 'rows' && variant === 'button' && activeTab !== '{{ $name }}',
        'h-8 px-2.5 text-xs rounded-md': variant === 'button' && size === 'sm',
        'h-9 px-3.5 text-sm rounded-lg': variant === 'button' && (size === 'md' || !size),
        'h-10 px-4 text-sm rounded-lg': variant === 'button' && size === 'lg',

        {{-- Layout 2 Kolom (Vertical / Cols) - Pill --}}
        'w-full justify-start text-left bg-card text-foreground shadow-xs font-semibold rounded-lg ring-1 ring-border/50': layout === 'cols' && variant === 'pill' && activeTab === '{{ $name }}',
        'w-full justify-start text-left text-muted-foreground hover:text-foreground hover:bg-muted/60 rounded-lg font-medium': layout === 'cols' && variant === 'pill' && activeTab !== '{{ $name }}',
        'min-h-7 px-2.5 text-xs rounded-md': layout === 'cols' && variant === 'pill' && size === 'sm',
        'min-h-8 px-3 text-sm rounded-lg': layout === 'cols' && variant === 'pill' && (size === 'md' || !size),
        'min-h-9 px-3.5 text-sm rounded-lg': layout === 'cols' && variant === 'pill' && size === 'lg',

        {{-- Layout 2 Kolom (Vertical / Cols) - Underline --}}
        'w-full justify-start text-left border-r-2 border-primary text-foreground font-semibold -mr-px rounded-none bg-transparent px-3 py-2 hover:bg-transparent active:scale-100 shadow-none': layout === 'cols' && variant === 'underline' && activeTab === '{{ $name }}',
        'w-full justify-start text-left border-r-2 border-transparent text-muted-foreground hover:text-foreground hover:border-muted-foreground/40 rounded-none bg-transparent px-3 py-2 font-medium hover:bg-transparent active:scale-100 shadow-none': layout === 'cols' && variant === 'underline' && activeTab !== '{{ $name }}',

        {{-- Layout 2 Kolom (Vertical / Cols) - Button --}}
        'w-full justify-start text-left {{ $activeBtnClasses }} font-medium rounded-lg shadow-xs': layout === 'cols' && variant === 'button' && activeTab === '{{ $name }}',
        'w-full justify-start text-left {{ $inactiveBtnClasses }} font-medium rounded-lg shadow-2xs': layout === 'cols' && variant === 'button' && activeTab !== '{{ $name }}',
        'min-h-8 px-2.5 text-xs rounded-md': layout === 'cols' && variant === 'button' && size === 'sm',
        'min-h-9 px-3.5 text-sm rounded-lg': layout === 'cols' && variant === 'button' && (size === 'md' || !size),
        'min-h-10 px-4 text-sm rounded-lg': layout === 'cols' && variant === 'button' && size === 'lg',

        {{-- Layout Sidebar --}}
        'w-full justify-start text-left bg-muted text-foreground font-semibold rounded-lg shadow-2xs': variant === 'sidebar' && activeTab === '{{ $name }}',
        'w-full justify-start text-left text-muted-foreground hover:text-foreground hover:bg-muted/60 rounded-lg font-medium': variant === 'sidebar' && activeTab !== '{{ $name }}',
        'min-h-8 px-2.5 py-1.5 text-xs rounded-md': variant === 'sidebar' && size === 'sm',
        'min-h-9 px-3 py-2 text-sm rounded-lg': variant === 'sidebar' && (size === 'md' || !size),
        'min-h-10 px-3.5 py-2.5 text-sm rounded-lg': variant === 'sidebar' && size === 'lg',
    }"
>
    @if (isset($icon))
        <span class="inline-flex shrink-0 items-center justify-center [&>svg]:size-4 text-current">
            {{ $icon }}
        </span>
    @endif

    <span class="truncate">{{ $slot }}</span>

    @if (isset($right))
        <span class="ml-auto inline-flex items-center shrink-0">
            {{ $right }}
        </span>
    @elseif ($badge !== null && $badge !== '')
        <vibe:badge :variant="$badgeVariant" size="xs" class="ml-auto rounded-full px-1.5 py-0 text-[10px] font-mono leading-tight">
            {{ $badge }}
        </vibe:badge>
    @endif
</vibe:button>
