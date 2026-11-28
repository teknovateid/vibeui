@blaze(fold: true)

@props([
    'variant' => 'primary', // primary, secondary, outline, ghost, surface, destructive/danger, success, warning, info, link, default
    'size' => 'md',        // xs, sm, md, lg, xl, icon-xs, icon-sm, icon-md, icon-lg, icon-xl, icon-2xl, icon-10, icon-12, auto, none
    'type' => 'button',
    'href' => null,
    'loading' => false,    // boolean, string loading text, or auto
    'disabled' => false,
    'pulse' => false,
    'animation' => false,
    'navigate' => null,    // boolean or null (auto-detect based on target: false if target is set and not _self, true otherwise)
])

@php
    $baseClasses = 'group/vbtn relative inline-flex items-center justify-center font-medium select-none whitespace-nowrap cursor-pointer transition-all duration-150 active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background disabled:pointer-events-none disabled:opacity-50 data-[loading=true]:pointer-events-none data-[loading=true]:opacity-70 [&_svg]:pointer-events-none [&_svg]:shrink-0';

    $userClasses = (string) $attributes->get('class', '');
    $isFlexCol = str_contains($userClasses, 'flex-col') || str_contains($userClasses, 'flex-column');
    $hasCustomHeight = (bool) preg_match('/(?:^|\s)(?:h-|size-)/', $userClasses);

    $variantClasses = match ($variant) {
        'tab', 'plain', 'unstyled' => '',
        'primary' => 'bg-primary text-primary-foreground shadow-xs hover:bg-primary/90',
        'secondary' => 'bg-secondary text-secondary-foreground shadow-2xs hover:bg-secondary/80',
        'outline' => 'border border-input bg-background text-foreground shadow-2xs hover:bg-muted hover:text-foreground',
        'ghost' => 'text-foreground hover:bg-muted hover:text-foreground active:bg-muted/80',
        'surface' => 'bg-card border border-border/80 text-card-foreground shadow-2xs hover:bg-muted/60',
        'destructive', 'danger' => 'bg-destructive text-destructive-foreground shadow-xs hover:bg-destructive/90 focus-visible:ring-destructive',
        'success' => 'bg-success text-success-foreground shadow-xs hover:bg-success/90 focus-visible:ring-success',
        'warning' => 'bg-warning text-warning-foreground shadow-xs hover:bg-warning/90 focus-visible:ring-warning',
        'info' => 'bg-info text-info-foreground shadow-xs hover:bg-info/90 focus-visible:ring-info',
        'link' => 'text-primary underline-offset-4 hover:underline p-0 h-auto font-medium shadow-none active:scale-100',
        default => 'border border-border bg-card text-card-foreground shadow-2xs hover:bg-muted hover:text-foreground',
    };

    [$heightClass, $paddingXClass, $textClass, $radiusClass, $gapClass, $flexPyClass] = match ($size) {
        'xs' => ['h-7', 'px-2.5', 'text-xs', 'rounded-md', 'gap-1', 'py-1'],
        'sm' => ['h-8', 'px-3', 'text-xs', 'rounded-md', 'gap-1.5', 'py-1.5'],
        'lg' => ['h-10', 'px-4', 'text-sm', 'rounded-lg', 'gap-2', 'py-2.5'],
        'xl' => ['h-11', 'px-5', 'text-base', 'rounded-xl', 'gap-2.5', 'py-3'],
        default => ['h-9', 'px-3.5', 'text-sm', 'rounded-lg', 'gap-2', 'py-2'],
    };

    if ($variant === 'link') {
        $sizeClasses = 'text-sm p-0';
    } elseif ($isFlexCol && ! $hasCustomHeight) {
        $sizeClasses = match ($size) {
            'none' => '',
            'auto' => 'h-auto py-2 px-3 text-sm gap-1.5 rounded-lg',
            default => "h-auto {$flexPyClass} {$paddingXClass} {$textClass} {$gapClass} {$radiusClass}",
        };
    } else {
        $sizeClasses = match ($size) {
            'icon-xs' => 'size-7 p-0 rounded-md',
            'icon-sm' => 'size-8 p-0 rounded-md',
            'icon-md' => 'size-9 p-0 rounded-lg',
            'icon-lg' => 'size-10 p-0 rounded-lg',
            'icon-xl' => 'size-11 p-0 rounded-xl',
            'icon-2xl' => 'size-12 p-0 rounded-xl',
            '10', 'icon-10' => 'size-10 p-0 rounded-lg',
            '12', 'icon-12' => 'size-12 p-0 rounded-xl',
            'auto' => 'h-auto py-2 px-3 text-sm gap-2 rounded-lg',
            'none' => '',
            default => "{$heightClass} {$paddingXClass} {$textClass} {$gapClass} {$radiusClass}",
        };
    }

    $animationClass = match ($animation) {
        'pulse' => 'animate-vibe-pulse',
        'shake' => 'animate-vibe-shake',
        'pop', 'bounce' => 'animate-vibe-pop',
        'wobble' => 'animate-vibe-wobble',
        default => ($pulse ? 'animate-vibe-pulse' : ''),
    };

    $compiledClasses = trim("{$baseClasses} {$sizeClasses} {$variantClasses} {$animationClass}");
    $hasCustomXData = $attributes->has('x-data');
    $isIcon = str_starts_with($size, 'icon-') || in_array($size, ['10', '12', '14']);
    $hasSlotContent = $slot->isNotEmpty() && trim($slot) !== '';

    $hasLoadingText = is_string($loading) && $loading !== '' && $loading !== 'auto' && $loading !== '1';
    $loadingText = $hasLoadingText ? $loading : null;

    $hasWireClick = $attributes->has('wire:click');
    $hasWireTarget = $attributes->has('wire:target');
    $hasWireSubmit = $attributes->has('wire:submit');
    $isLivewireTarget = $hasWireClick || $hasWireTarget || $hasWireSubmit;

    $isLivewireEvent = $isLivewireTarget && ($loading !== false || $attributes->has('loading'));
    $isStaticLoading = ! $isLivewireEvent && (bool) $loading;
    $isDisabled = $disabled || $isStaticLoading;

    $wireTarget = $attributes->get('wire:target')
        ?? ($hasWireClick ? preg_replace('/\(.*$/', '', (string) $attributes->get('wire:click')) : null);

    $alpineLoading = $attributes->get('x-bind:loading')
        ?? $attributes->get('::loading')
        ?? $attributes->get(':loading')
        ?? $attributes->get('x-loading');

    $alpineDataLoading = $attributes->get(':data-loading')
        ?? $attributes->get('x-bind:data-loading');

    $alpineExpr = $alpineLoading ?? $alpineDataLoading;

    if ($alpineLoading) {
        $attributes = $attributes->except([':loading', '::loading', 'x-bind:loading', 'x-loading']);
    }

    $target = $attributes->get('target');
    $hasExternalTarget = ! empty($target) && $target !== '_self';

    $isNavigateExplicitlyFalse = $navigate === false || $navigate === 'false' || $navigate === 0 || $navigate === '0';
    $isNavigateExplicitlyTrue = $navigate === true || $navigate === 'true' || $navigate === 1 || $navigate === '1';

    if ($isNavigateExplicitlyTrue) {
        $shouldNavigate = true;
    } elseif ($isNavigateExplicitlyFalse || $hasExternalTarget) {
        $shouldNavigate = false;
    } else {
        $shouldNavigate = true;
    }

    if (! $shouldNavigate) {
        $attributes = $attributes->except([
            'wire:navigate',
            'wire:navigate.hover',
            'wire:navigate.preserve-scroll',
            'wire:navigate.hover.preserve-scroll',
            'wire:navigate.preserve-scroll.hover',
        ]);
    }

    $hasCustomNavigateAttr = $attributes->has('wire:navigate')
        || $attributes->has('wire:navigate.hover')
        || $attributes->has('wire:navigate.preserve-scroll');

    $spinnerSize = match ($size) {
        'xs', 'icon-xs' => 'size-3.5',
        'sm', 'icon-sm' => 'size-3.5',
        'md', 'icon-md' => 'size-4',
        'lg', 'icon-lg' => 'size-4.5',
        'xl', 'icon-xl' => 'size-5',
        '10', 'icon-10' => 'size-5',
        '12', 'icon-12', 'icon-2xl' => 'size-6',
        default => 'size-4',
    };

    $spinnerMargin = (! $isIcon && $hasSlotContent && ! $hasLoadingText) ? '-ml-0.5 mr-1.5' : '';
    $spinnerClasses = trim("animate-spin shrink-0 text-current {$spinnerSize} {$spinnerMargin}");
    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }}
    @if($href)
        @if($shouldNavigate && ! $hasCustomNavigateAttr) wire:navigate @endif
        href="{{ $isDisabled ? '#' : $href }}"
        @if($isDisabled) aria-disabled="true" tabindex="-1" @endif
        @if($alpineExpr)
            :aria-disabled="Boolean({{ $alpineExpr }})"
        @endif
    @else
        type="{{ $type }}"
        @if($isDisabled) disabled @endif
        @if($alpineExpr && ! $attributes->has(':disabled') && ! $attributes->has('x-bind:disabled'))
            :disabled="Boolean({{ $alpineExpr }})"
        @endif
    @endif
    @if(!$hasCustomXData) x-data @endif
    data-loading="{{ $isStaticLoading ? 'true' : 'false' }}"
    @if($isStaticLoading) aria-busy="true" @endif
    @if($alpineExpr)
        :data-loading="Boolean({{ $alpineExpr }}) ? 'true' : 'false'"
        :aria-busy="Boolean({{ $alpineExpr }})"
    @endif
    @if($isLivewireEvent)
        wire:loading.attr="disabled"
        @if($wireTarget) wire:target="{{ $wireTarget }}" @endif
    @endif
    {{ $attributes->twMerge(['class' => $compiledClasses]) }}
>
    @if($hasLoadingText)
        <span 
            class="inline-flex items-center justify-center gap-1.5 group-data-[loading=true]/vbtn:hidden"
            @if($isLivewireEvent) wire:loading.remove @if($wireTarget) wire:target="{{ $wireTarget }}" @endif @endif
        >
            {{ $slot }}
        </span>
        <span 
            class="hidden items-center justify-center gap-1.5 leading-none group-data-[loading=true]/vbtn:inline-flex"
            @if($isLivewireEvent) wire:loading.inline-flex @if($wireTarget) wire:target="{{ $wireTarget }}" @endif @endif
        >
            <svg class="{{ $spinnerClasses }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            <span class="vibe-btn-loading-text">{{ $loadingText }}</span>
        </span>
    @else
        <svg 
            class="hidden {{ $spinnerClasses }} group-data-[loading=true]/vbtn:inline-flex" 
            @if($isLivewireEvent) wire:loading.inline-flex @if($wireTarget) wire:target="{{ $wireTarget }}" @endif @endif
            xmlns="http://www.w3.org/2000/svg" 
            fill="none" 
            viewBox="0 0 24 24"
        ><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
        @if($isIcon)
            <span class="group-data-[loading=true]/vbtn:hidden inline-flex items-center justify-center">
                {{ $slot }}
            </span>
        @else
            {{ $slot }}
        @endif
    @endif
</{{ $tag }}>

