@blaze(fold: true)

@props([
    'title' => config('app.name'),
    'separator' => 'chevron',
    'wrap' => false,
    'titleClass' => null,
    'titleTag' => null,
])

@php
    $hasItems = $slot->isNotEmpty();
    $hasButton = isset($button) && $button->isNotEmpty();
@endphp

@if ($title && $hasItems)
    <div {{ $attributes->twMerge(['class' => 'flex flex-wrap gap-4 items-center justify-between w-full']) }}>
        <nav aria-label="{{ __('vibe/breadcrumb.breadcrumb') }}" class="flex flex-col gap-1.5 text-sm font-medium text-muted-foreground min-w-0">
            @php
                $titleUserClasses = trim($titleClass ?? '');
                $hasTitleCustomFontSize = (bool) preg_match('/(?:^|\s)(?:[a-z0-9-]+:)*text-(xs|sm|base|lg|[0-9]+xl|\[[^\]]+\])(?:\s|$)/', $titleUserClasses);
                $headingDefaultSize = $hasTitleCustomFontSize ? '' : 'text-xl md:text-2xl ';
                $headingClasses = trim($headingDefaultSize . 'font-bold text-foreground leading-tight');
                if ($titleClass) {
                    $headingClasses = twMerge($headingClasses, $titleClass);
                }
            @endphp
            <{{ $titleTag ?? 'h2' }} class="{{ $headingClasses }}">
                {{ $title === true ? config('app.name') : $title }}
            </{{ $titleTag ?? 'h2' }}>
            <ol class="vibe-breadcrumb flex items-center {{ $wrap ? 'flex-wrap' : 'flex-nowrap overflow-x-auto hide-scroll' }} gap-2 sm:gap-2.5 min-w-0">
                {{ $slot }}
            </ol>
        </nav>
        @if ($hasButton)
            <div class="shrink-0">
                {{ $button }}
            </div>
        @endif
    </div>
@elseif ($title && !$hasItems)
    @php
        $tag = $titleTag ?? 'span';
        $userClasses = trim(($attributes->get('class') ?? '') . ' ' . ($titleClass ?? ''));
        $hasCustomFontSize = (bool) preg_match('/(?:^|\s)(?:[a-z0-9-]+:)*text-(xs|sm|base|lg|[0-9]+xl|\[[^\]]+\])(?:\s|$)/', $userClasses);
        $defaultSize = $hasCustomFontSize ? '' : 'text-xl md:text-2xl ';
        $baseTitleClasses = trim($defaultSize . 'font-bold text-foreground leading-none inline-flex items-center min-w-0');
        if ($titleClass) {
            $baseTitleClasses = twMerge($baseTitleClasses, $titleClass);
        }
    @endphp
    @if ($hasButton)
        <div {{ $attributes->twMerge(['class' => 'flex items-center justify-between w-full gap-4']) }}>
            <{{ $tag }} class="{{ $baseTitleClasses }}">
                {{ $title === true ? config('app.name') : $title }}
            </{{ $tag }}>
            <div class="shrink-0">
                {{ $button }}
            </div>
        </div>
    @else
        <{{ $tag }} {{ $attributes->twMerge(['class' => $baseTitleClasses]) }}>
            {{ $title === true ? config('app.name') : $title }}
        </{{ $tag }}>
    @endif
@elseif (!$title && $hasItems)
    <nav aria-label="{{ __('vibe/breadcrumb.breadcrumb') }}" {{ $attributes->twMerge(['class' => 'inline-flex items-center text-sm font-medium text-muted-foreground min-w-0']) }}>
        <ol class="vibe-breadcrumb flex items-center {{ $wrap ? 'flex-wrap' : 'flex-nowrap overflow-x-auto hide-scroll' }} gap-2 sm:gap-2.5 min-w-0">
            {{ $slot }}
        </ol>
    </nav>
@endif
