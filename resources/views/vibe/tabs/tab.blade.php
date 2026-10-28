@blaze(fold: true)

@aware([
    'layout' => 'rows',
    'orientation' => null,
    'variant' => 'pill',
    'size' => 'md',
])

@props([
    'name',
    'label' => null,
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
    $nameJs = \Illuminate\Support\Js::from($name);
    $displayLabel = $label ?? trim(strip_tags((string) $slot));
    $isSsrActive = $active === true || $active === 'true' || $active === 1;

    $resolvedVariant = $variant ?? 'pill';
    $resolvedSize = $size ?? 'md';
    $isSidebar = $resolvedVariant === 'sidebar';
    $isCols = in_array($layout, ['cols', 'columns', '2-cols', 'vertical']) || $orientation === 'vertical' || $isSidebar;
    $normalizedLayout = $isCols ? 'cols' : 'rows';

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

    $activeBtn = $activeVariant ?? $resolvedVariant ?? 'primary';
    $inactiveBtn = $inactiveVariant ?? 'default';

    $activeBtnClasses = $buttonVariantMap[$activeBtn] ?? $buttonVariantMap['primary'];
    $inactiveBtnClasses = $buttonVariantMap[$inactiveBtn] ?? $buttonVariantMap['default'];

    // Hitung class ukuran & struktur secara statis di PHP agar twMerge bekerja sempurna
    $baseSizeClasses = match ($resolvedVariant) {
        'underline' => match ($resolvedSize) {
            'xs' => 'h-7 px-2 text-xs pb-1.5 pt-1',
            'sm' => 'h-8 px-2.5 text-xs pb-2 pt-1.5',
            'lg' => 'h-10 px-4 text-sm pb-3 pt-2.5',
            'xl' => 'h-11 px-4.5 text-base pb-3.5 pt-3',
            default => 'h-9 px-3 text-sm pb-2.5 pt-2',
        },
        'button' => match ($resolvedSize) {
            'xs' => 'h-7 px-2 text-xs rounded-sm',
            'sm' => 'h-8 px-2.5 text-xs rounded-md',
            'lg' => 'h-10 px-4 text-sm rounded-lg',
            'xl' => 'h-11 px-4.5 text-base rounded-xl',
            default => 'h-9 px-3.5 text-sm rounded-lg',
        },
        'sidebar' => match ($resolvedSize) {
            'sm' => 'min-h-8 px-2.5 py-1.5 text-xs rounded-md',
            'lg' => 'min-h-10 px-3.5 py-2.5 text-sm rounded-lg',
            default => 'min-h-9 px-3 py-2 text-sm rounded-lg',
        },
        default => match ($resolvedSize) { // pill
            'xs' => 'h-6 px-2 text-xs rounded-md',
            'sm' => 'h-7 px-2.5 text-xs rounded-md',
            'lg' => 'h-9 px-3.5 text-sm rounded-lg',
            'xl' => 'h-10 px-4 text-base rounded-xl',
            default => 'h-8 px-3 text-sm rounded-lg',
        },
    };

    $alignmentClasses = ($normalizedLayout === 'cols' || $isSidebar)
        ? 'w-auto md:w-full justify-start text-left whitespace-nowrap'
        : 'justify-center';

    $activeClasses = match ($resolvedVariant) {
        'sidebar' => 'bg-muted text-foreground font-semibold shadow-2xs',
        'underline' => $normalizedLayout === 'cols'
            ? 'border-b-2 md:border-b-0 md:border-r-2 border-primary text-foreground font-semibold -mb-px md:-mb-0 md:-mr-px rounded-none bg-transparent hover:bg-transparent shadow-none'
            : 'border-b-2 border-primary text-foreground font-semibold -mb-px rounded-none bg-transparent hover:bg-transparent shadow-none',
        'button' => "{$activeBtnClasses} font-medium rounded-lg shadow-xs",
        default => 'bg-card text-foreground shadow-xs font-semibold rounded-lg ring-1 ring-border/50',
    };

    $inactiveClasses = match ($resolvedVariant) {
        'underline' => $normalizedLayout === 'cols'
            ? 'border-b-2 md:border-b-0 md:border-r-2 border-transparent text-muted-foreground hover:text-foreground hover:border-muted-foreground/40 rounded-none bg-transparent font-medium hover:bg-transparent shadow-none'
            : 'border-b-2 border-transparent text-muted-foreground hover:text-foreground hover:border-muted-foreground/40 rounded-none bg-transparent font-medium hover:bg-transparent shadow-none',
        'button' => "{$inactiveBtnClasses} font-medium rounded-lg shadow-2xs",
        default => 'text-muted-foreground hover:text-foreground hover:bg-muted/60 rounded-lg font-medium',
    };

    $baseClasses = "vibe-tabs-tab relative inline-flex items-center select-none font-medium !transition-colors duration-150 gap-2 shrink-0 cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 {$baseSizeClasses} {$alignmentClasses}";

    $shouldNavigate = $href && (! $attributes->has('target') || $attributes->get('target') === '_self');
    $hasCustomNavigateAttr = $attributes->has('wire:navigate')
        || $attributes->has('wire:navigate.hover')
        || $attributes->has('wire:navigate.preserve-scroll');
@endphp

@if ($href)
    <a
        @if($shouldNavigate && ! $hasCustomNavigateAttr) wire:navigate @endif
        href="{{ $href }}"
        role="tab"
        x-bind:id="tabId + '-tab-' + {{ $nameJs }}"
        x-bind:aria-controls="tabId + '-panel-' + {{ $nameJs }}"
        data-tab-name="{{ $name }}"
        data-label="{{ $displayLabel }}"
        aria-selected="{{ $isSsrActive ? 'true' : 'false' }}"
        tabindex="{{ $isSsrActive ? '0' : '-1' }}"
        x-bind:aria-selected="activeTab === {{ $nameJs }} ? 'true' : 'false'"
        x-bind:tabindex="activeTab === {{ $nameJs }} ? '0' : '-1'"
        x-init="if ((activeTab === {{ $nameJs }} || {{ $isSsrActive ? 'true' : 'false' }}) && !activeLabel) activeLabel = $el.dataset.label || {{ $nameJs }}"
        {{ $attributes->twMerge(['class' => $baseClasses]) }}
        x-bind:class="[
            activeTab === {{ $nameJs }} ? @js($activeClasses) : @js($inactiveClasses),
            mobileMode === 'scroll' ? 'shrink-0 snap-start whitespace-nowrap' : ''
        ]"
    >
        @if (isset($icon))
            <span class="vibe-tab-icon inline-flex shrink-0 items-center justify-center [&>svg]:size-4 text-current">
                {{ $icon }}
            </span>
        @endif

        <span class="vibe-tab-label truncate">{{ $slot }}</span>

        @if (isset($right))
            <span class="vibe-tab-right ml-auto inline-flex items-center shrink-0">
                {{ $right }}
            </span>
        @elseif ($badge !== null && $badge !== '')
            <span class="vibe-tab-badge ml-auto inline-flex items-center shrink-0">
                <vibe:badge :variant="$badgeVariant" size="xs" class="rounded-full px-1.5 py-0 text-[10px] font-mono leading-tight">
                    {{ $badge }}
                </vibe:badge>
            </span>
        @endif
    </a>
@else
    <button
        type="button"
        @if($disabled) disabled @endif
        role="tab"
        x-bind:id="tabId + '-tab-' + {{ $nameJs }}"
        x-bind:aria-controls="tabId + '-panel-' + {{ $nameJs }}"
        data-tab-name="{{ $name }}"
        data-label="{{ $displayLabel }}"
        aria-selected="{{ $isSsrActive ? 'true' : 'false' }}"
        tabindex="{{ $isSsrActive ? '0' : '-1' }}"
        x-bind:aria-selected="activeTab === {{ $nameJs }} ? 'true' : 'false'"
        x-bind:tabindex="activeTab === {{ $nameJs }} ? '0' : '-1'"
        x-init="if ((activeTab === {{ $nameJs }} || {{ $isSsrActive ? 'true' : 'false' }}) && !activeLabel) activeLabel = $el.dataset.label || {{ $nameJs }}"
        @click="activeTab = {{ $nameJs }}; selectTab({{ $nameJs }}, $el.dataset.label, $el)"
        {{ $attributes->twMerge([
            'class' => "{$baseClasses} disabled:pointer-events-none disabled:opacity-50"
        ]) }}
        x-bind:class="[
            activeTab === {{ $nameJs }} ? @js($activeClasses) : @js($inactiveClasses),
            mobileMode === 'scroll' ? 'shrink-0 snap-start whitespace-nowrap' : ''
        ]"
    >
        @if (isset($icon))
            <span class="vibe-tab-icon inline-flex shrink-0 items-center justify-center [&>svg]:size-4 text-current">
                {{ $icon }}
            </span>
        @endif

        <span class="vibe-tab-label truncate">{{ $slot }}</span>

        @if (isset($right))
            <span class="vibe-tab-right ml-auto inline-flex items-center shrink-0">
                {{ $right }}
            </span>
        @elseif ($badge !== null && $badge !== '')
            <span class="vibe-tab-badge ml-auto inline-flex items-center shrink-0">
                <vibe:badge :variant="$badgeVariant" size="xs" class="rounded-full px-1.5 py-0 text-[10px] font-mono leading-tight">
                    {{ $badge }}
                </vibe:badge>
            </span>
        @endif
    </button>
@endif
