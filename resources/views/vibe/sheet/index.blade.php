@blaze

@props([
    'variant' => 'default',
    'layout' => 'fixed', // relative, fixed, sticky, absolute (default: fixed for slide-over drawer)
    'id' => null,
    'position' => 'right', // left, right, top, bottom (default: right)
    'behavior' => 'collapsible', // static, collapsible, minify (default: collapsible)
    'resizable' => false,
    'size' => null, // preset: sm, md, lg, xl, 2xl, or numeric px
    'defaultSize' => null, // explicit default size in px
    'mobileSize' => null, // explicit mobile size in px (default: min(defaultSize, 280))
    'minSize' => 0,
    'maxSize' => 600,
    'minifiedSize' => 80,
    'showToggle' => false,
    'persist' => false, // save to localstorage
    'defaultState' => null, // smart default: 'collapsed' for fixed/absolute, 'expanded' for relative/sticky
    'closeOnOutsideClick' => null, // smart default: true for fixed/absolute, false for relative/sticky
    'dismissible' => null, // alias for closeOnOutsideClick
    'backdrop' => null, // smart default: true for fixed, false for relative/absolute/sticky
    'backdropClass' => null,
    'teleport' => null, // smart default: true for fixed, false for relative/absolute/sticky
    'dismissibleButton' => null, // smart default: true for fixed/absolute, false for relative/sticky
])

@php
    $id = $id ?? uniqid('sheet-');

    $resolvedSize = 350;
    if ($defaultSize !== null) {
        $resolvedSize = (int) $defaultSize;
    } elseif ($size !== null) {
        $resolvedSize = match ($size) {
            'sm' => 300,
            'md' => 380,
            'lg' => 500,
            'xl' => 640,
            '2xl' => 768,
            default => is_numeric($size) ? (int) $size : 350,
        };
    }
    $defaultSize = $resolvedSize;
    if ($maxSize < $defaultSize) {
        $maxSize = $defaultSize + 200;
    }

    $hasWFullClass = str_contains($attributes->get('class', ''), 'w-full');
    $resolvedMobileSize = 280;
    if ($mobileSize !== null) {
        $resolvedMobileSize = $mobileSize === 'full' ? 'full' : (is_numeric($mobileSize) ? (int) $mobileSize : $mobileSize);
    } elseif ($hasWFullClass) {
        $resolvedMobileSize = 'full';
    } elseif ($variant === 'sidebar') {
        $resolvedMobileSize = min($defaultSize, 280);
    } else {
        $resolvedMobileSize = min($defaultSize, 280);
    }
    $mobileSize = $resolvedMobileSize;

    $dimensionLimitClasses = ($variant === 'sidebar')
        ? (in_array($position, ['left', 'right'])
            ? 'max-w-[calc(100vw-3rem)] md:max-w-full max-h-full'
            : 'max-h-[calc(100dvh-3rem)] md:max-h-full max-w-full')
        : 'max-w-full max-h-full';

    $isOverlay = in_array($layout, ['fixed', 'absolute']);

    if ($defaultState === null) {
        $defaultState = $isOverlay ? 'collapsed' : 'expanded';
    }

    if ($closeOnOutsideClick === null) {
        if ($dismissible !== null) {
            $closeOnOutsideClick = (bool) $dismissible;
        } else {
            $closeOnOutsideClick = $isOverlay;
        }
    }

    if ($backdrop === null) {
        $backdrop = ($layout === 'fixed');
    }

    if ($teleport === null) {
        $teleport = ($layout === 'fixed');
    }

    if ($dismissibleButton === null) {
        $dismissibleButton = $isOverlay;
    } else {
        $parsed = filter_var($dismissibleButton, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $dismissibleButton = $parsed !== null ? $parsed : (bool) $dismissibleButton;
    }

    $positionClasses = match ($position) {
        'left' => 'border-r',
        'right' => 'border-l',
        'top' => 'border-b',
        'bottom' => 'border-t',
        default => 'border-l',
    };

    $variantClasses = match ($variant) {
        'sidebar' => 'bg-sidebar text-sidebar-foreground border-sidebar-border',
        'muted' => 'bg-muted text-muted-foreground border-border',
        'card', 'default' => 'bg-card text-card-foreground border-border',
        default => 'bg-card text-card-foreground border-border',
    };

    $layoutClasses = match ($layout) {
        'fixed' => match ($position) {
            'left' => 'fixed left-0 top-0 bottom-0 h-screen h-dvh shadow-2xl',
            'right' => 'fixed right-0 top-0 bottom-0 h-screen h-dvh shadow-2xl',
            'top' => 'fixed top-0 left-0 right-0 w-full shadow-2xl',
            'bottom' => 'fixed bottom-0 left-0 right-0 w-full shadow-2xl',
            default => 'fixed right-0 top-0 bottom-0 h-screen h-dvh shadow-2xl',
        },
        'absolute' => match ($position) {
            'left' => 'absolute left-0 top-0 bottom-0 h-full shadow-2xl',
            'right' => 'absolute right-0 top-0 bottom-0 h-full shadow-2xl',
            'top' => 'absolute top-0 left-0 right-0 w-full shadow-2xl',
            'bottom' => 'absolute bottom-0 left-0 right-0 w-full shadow-2xl',
            default => 'absolute right-0 top-0 bottom-0 h-full shadow-2xl',
        },
        'sticky' => match ($position) {
            'left', 'right' => 'sticky top-0 h-screen h-dvh',
            'top', 'bottom' => 'sticky left-0 w-full',
            default => 'sticky top-0 h-screen h-dvh',
        },
        default => match ($position) {
            'right' => 'relative order-last h-full self-stretch min-h-0',
            'bottom' => 'relative order-last w-full',
            'top' => 'relative w-full',
            default => 'relative h-full self-stretch min-h-0',
        },
    };

    $zIndexClasses = match ($layout) {
        'fixed' => 'z-60',
        'absolute' => 'z-60',
        'sticky' => 'z-20',
        default => 'z-10',
    };

    $initialSize = $defaultSize;
    if ($behavior !== 'static') {
        if ($defaultState === 'collapsed') {
            $initialSize = 0;
        } elseif ($defaultState === 'minified') {
            $initialSize = $minifiedSize;
        }
    }

    $innerStyle = $behavior !== 'minify'
        ? match ($position) {
            'right' => "top: 0; right: 0; bottom: 0; width: {$defaultSize}px",
            'bottom' => "left: 0; right: 0; top: 0; height: {$defaultSize}px",
            'top' => "left: 0; right: 0; bottom: 0; height: {$defaultSize}px",
            default => "top: 0; left: 0; bottom: 0; width: {$defaultSize}px",
        }
        : 'top: 0; left: 0; right: 0; bottom: 0';

    $sheetConfigJson = \Illuminate\Support\Js::from([
        'id' => $id,
        'layout' => $layout,
        'behavior' => $behavior,
        'position' => $position,
        'minifiedSize' => (int) $minifiedSize,
        'minSize' => (int) $minSize,
        'maxSize' => (int) $maxSize,
        'mobileSize' => (string) $mobileSize,
        'defaultSize' => (int) $defaultSize,
        'size' => (int) $defaultSize,
        'state' => $defaultState,
        'persist' => (bool) $persist,
        'persistKey' => config('vibe.prefix', 'vibe') . '-sheet',
        'resizable' => (bool) $resizable,
        'closeOnOutsideClick' => (bool) $closeOnOutsideClick,
        'teleport' => (bool) $teleport,
    ])->toHtml();

    $sheetXDataExpr = "typeof window.vibeSheet === 'function' ? window.vibeSheet({$sheetConfigJson}) : Object.assign({$sheetConfigJson}, { isResizing: false, isExpanding: false, isInitialized: false, lastTriggerTime: 0, startSize: 0, startPos: 0, isMobile: typeof window !== 'undefined' ? window.innerWidth < 768 : false, get isHorizontal() { return this.position === 'left' || this.position === 'right'; }, get currentSize() { if (this.isResizing || this.behavior === 'static') return this.size; if (this.state === 'collapsed') return 0; if (this.state === 'minified') return this.isMobile ? 0 : this.minifiedSize; if (this.isMobile) { if (this.mobileSize === 'full') return '100%'; var n = parseInt(this.mobileSize, 10) || 280; var m = this.isHorizontal ? Math.min(n, window.innerWidth - 48) : Math.min(n, window.innerHeight - 48); return Math.max(0, m); } return this.size; }, toggle() {}, close() {}, open() {}, saveToStorage() {}, startResize() {}, doResize() {}, stopResize() {}, handleOutsideClick() {}, init() { var self = this; var attach = function() { if (self._vibeSheetBound || typeof window.vibeSheet !== 'function') return; self._vibeSheetBound = true; var comp = window.vibeSheet({$sheetConfigJson}); Object.keys(comp).forEach(function(k) { if (k !== 'init' && k !== 'isHorizontal' && k !== 'currentSize' && typeof comp[k] === 'function') { self[k] = comp[k]; } }); comp.init.call(self); }; if (typeof window.vibeSheet === 'function') { attach(); } else { window.addEventListener('vibe-sheet-ready', attach, { once: true }); } } })";
@endphp

@pushOnce('head', 'vibe-sheet-scripts')
    @vite(['resources/js/vibe/sheet.js'])
@endPushOnce

@if ($teleport)
<div class="vibe-sheet-root contents" x-data="{!! $sheetXDataExpr !!}" @mouseup.window="stopResize()" @touchend.window="stopResize()" @touchcancel.window="stopResize()" @mousemove.window="doResize($event)" @touchmove.window="doResize($event)" @open-sheet.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === '{{ $id }}') { lastTriggerTime = Date.now(); state = 'expanded'; saveToStorage(); }" @close-sheet.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === '{{ $id }}' || t === '*' || !t) { state = 'collapsed'; saveToStorage(); }" @toggle-sheet.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === '{{ $id }}') { lastTriggerTime = Date.now(); toggle(); }" @keydown.escape.window="if (state !== 'collapsed' && {{ $closeOnOutsideClick ? 'true' : 'false' }}) { close(); }">
    <template x-teleport="body">
        <div class="vibe-sheet-overlay-container fixed inset-0 z-60 pointer-events-none" :class="{ 'pointer-events-none': state === 'collapsed' }">
            @if ($backdrop)
                <div
                    x-show="state !== 'collapsed'"
                    x-transition:enter="transition-opacity ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-black/50 backdrop-blur-xs z-10 pointer-events-auto {{ $backdropClass }}"
                    aria-hidden="true"
                    @click="if ({{ $closeOnOutsideClick ? 'true' : 'false' }}) { close(); }"
                ></div>
            @endif

            <div
                id="{{ $id }}"
                @if ($layout === 'fixed')
                    role="dialog"
                    aria-modal="{{ $backdrop ? 'true' : 'false' }}"
                @endif
                style="{{ ($position === 'left' || $position === 'right' ? "width: {$initialSize}px" : "height: {$initialSize}px") . ($initialSize === 0 ? '; border-width: 0px' : '') }}"
                :style="[
                    isHorizontal
                        ? (typeof currentSize === 'string' ? `width: ${currentSize}` : `width: ${currentSize}px`)
                        : (typeof currentSize === 'string' ? `height: ${currentSize}` : `height: ${currentSize}px`),
                    currentSize === 0 ? 'border-width: 0' : '',
                    isExpanding ? 'overflow: hidden' : ''
                ].filter(Boolean).join('; ')"
                data-state="{{ $defaultState }}"
                :data-state="state"
                data-variant="{{ $variant }}"
                data-layout="{{ $layout }}"
                data-dismissible="{{ $closeOnOutsideClick ? 'true' : 'false' }}"
                :class="{
                    'transition-[width,height,transform] duration-300 ease-in-out': !isResizing && isInitialized
                }"
                @click.outside="handleOutsideClick($event)"
                {{ $attributes->twMerge(['class' => "$variantClasses flex flex-col shrink-0 z-20 pointer-events-auto $positionClasses $layoutClasses group/sheet $dimensionLimitClasses overflow-visible group-data-[state=collapsed]/sheet:overflow-hidden group-data-[state=collapsed]/sheet:pointer-events-none group-data-[state=collapsed]/sheet:shadow-none"]) }}
            >
                <vibe:partials.sheet-body
                    :id="$id"
                    :layout="$layout"
                    :behavior="$behavior"
                    :position="$position"
                    :persist="$persist"
                    :defaultSize="$defaultSize"
                    :defaultState="$defaultState"
                    :minSize="$minSize"
                    :maxSize="$maxSize"
                    :minifiedSize="$minifiedSize"
                    :mobileSize="$mobileSize"
                    :innerStyle="$innerStyle"
                    :dismissibleButton="$dismissibleButton"
                    :showToggle="$showToggle"
                    :resizable="$resizable"
                >{{ $slot }}</vibe:partials.sheet-body>
            </div>
        </div>
    </template>
</div>
@else
<div id="{{ $id }}" x-data="{!! $sheetXDataExpr !!}" @if ($layout === 'fixed' || $layout === 'absolute') role="dialog" aria-modal="{{ $backdrop ? 'true' : 'false' }}" @endif @mouseup.window="stopResize()" @touchend.window="stopResize()" @touchcancel.window="stopResize()" @mousemove.window="doResize($event)" @touchmove.window="doResize($event)" @open-sheet.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === '{{ $id }}') { lastTriggerTime = Date.now(); state = 'expanded'; saveToStorage(); }" @close-sheet.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === '{{ $id }}' || t === '*' || !t) { state = 'collapsed'; saveToStorage(); }" @toggle-sheet.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === '{{ $id }}') { lastTriggerTime = Date.now(); toggle(); }" @keydown.escape.window="if (state !== 'collapsed' && {{ $closeOnOutsideClick ? 'true' : 'false' }}) { close(); }" @click.outside="handleOutsideClick($event)" style="{{ ($position === 'left' || $position === 'right' ? "width: {$initialSize}px" : "height: {$initialSize}px") . ($initialSize === 0 ? '; border-width: 0px' : '') }}" :style="[
    isHorizontal
        ? (typeof currentSize === 'string' ? `width: ${currentSize}` : `width: ${currentSize}px`)
        : (typeof currentSize === 'string' ? `height: ${currentSize}` : `height: ${currentSize}px`),
    currentSize === 0 ? 'border-width: 0' : '',
    isExpanding ? 'overflow: hidden' : ''
].filter(Boolean).join('; ')" data-state="{{ $defaultState }}" :data-state="state" data-variant="{{ $variant }}" data-layout="{{ $layout }}" data-dismissible="{{ $closeOnOutsideClick ? 'true' : 'false' }}" :class="{
    'transition-[width,height,transform] duration-300 ease-in-out': !isResizing && isInitialized
}" {{ $attributes->twMerge(['class' => "$variantClasses flex flex-col shrink-0 $zIndexClasses $positionClasses $layoutClasses group/sheet $dimensionLimitClasses overflow-visible group-data-[state=collapsed]/sheet:overflow-hidden group-data-[state=collapsed]/sheet:pointer-events-none group-data-[state=collapsed]/sheet:shadow-none"]) }}>
    <vibe:partials.sheet-body
        :id="$id"
        :layout="$layout"
        :behavior="$behavior"
        :position="$position"
        :persist="$persist"
        :defaultSize="$defaultSize"
        :defaultState="$defaultState"
        :minSize="$minSize"
        :maxSize="$maxSize"
        :minifiedSize="$minifiedSize"
        :mobileSize="$mobileSize"
        :innerStyle="$innerStyle"
        :dismissibleButton="$dismissibleButton"
        :showToggle="$showToggle"
        :resizable="$resizable"
    >{{ $slot }}</vibe:partials.sheet-body>
</div>
@endif
