@blaze(fold: true)

@props([
    'variant' => 'default',       // default, neutral, info, success, warning, destructive, danger, primary
    'appearance' => 'subtle',     // subtle, outline, solid, accent-left
    'size' => 'md',               // sm, md, lg
    'title' => null,              // Judul teks atau bisa menggunakan slot #title
    'description' => null,        // Deskripsi teks atau bisa menggunakan $slot
    'icon' => null,               // null/true (auto icon sesuai variant), false (tanpa icon), string (custom SVG)
    'dismissible' => false,       // tombol close interaktif (Alpine.js)
    'rounded' => 'xl',            // none, sm, md, lg, xl, 2xl, full
    'animation' => false,         // false, auto/true, shake, pop, bounce, pulse, wobble
])

@php
    $normalizedVariant = match (strtolower((string) $variant)) {
        'danger', 'error' => 'destructive',
        'neutral' => 'default',
        default => strtolower((string) $variant),
    };

    $normalizedAppearance = match (strtolower((string) $appearance)) {
        'border-left', 'accent' => 'accent-left',
        'soft' => 'subtle',
        'filled' => 'solid',
        default => strtolower((string) $appearance),
    };

    $sizeClasses = match ($size) {
        'sm' => [
            'card' => 'p-3 text-xs gap-2.5',
            'icon' => 'size-4 mt-0.5',
            'title' => 'text-xs font-semibold',
            'description' => 'text-xs leading-relaxed',
            'close' => 'size-4 p-0.5',
        ],
        'lg' => [
            'card' => 'p-5 text-base gap-4',
            'icon' => 'size-6 mt-0.5',
            'title' => 'text-base font-semibold',
            'description' => 'text-sm leading-relaxed',
            'close' => 'size-5 p-0.5',
        ],
        default => [
            'card' => 'p-4 text-sm gap-3',
            'icon' => 'size-5 mt-0.5',
            'title' => 'text-sm font-semibold',
            'description' => 'text-xs sm:text-sm leading-relaxed',
            'close' => 'size-4.5 p-0.5',
        ],
    };

    $roundedClass = match ($rounded) {
        'none' => 'rounded-none',
        'sm' => 'rounded-sm',
        'md' => 'rounded-md',
        'lg' => 'rounded-lg',
        '2xl' => 'rounded-2xl',
        'full' => 'rounded-3xl',
        default => 'rounded-xl',
    };

    // Style combination based on Appearance & Variant
    $variantClasses = match ($normalizedAppearance) {
        'solid' => match ($normalizedVariant) {
            'info' => 'bg-info text-info-foreground border-transparent shadow-xs',
            'success' => 'bg-success text-success-foreground border-transparent shadow-xs',
            'warning' => 'bg-warning text-warning-foreground border-transparent shadow-xs',
            'destructive' => 'bg-destructive text-destructive-foreground border-transparent shadow-xs',
            'primary' => 'bg-primary text-primary-foreground border-transparent shadow-xs',
            default => 'bg-foreground text-background border-transparent shadow-xs',
        },
        'outline' => match ($normalizedVariant) {
            'info' => 'bg-transparent border border-info/50 text-info',
            'success' => 'bg-transparent border border-success/50 text-success',
            'warning' => 'bg-transparent border border-warning/50 text-warning',
            'destructive' => 'bg-transparent border border-destructive/50 text-destructive',
            'primary' => 'bg-transparent border border-primary/50 text-primary',
            default => 'bg-transparent border border-border text-foreground',
        },
        'accent-left' => match ($normalizedVariant) {
            'info' => 'bg-info/10 border border-info/20 border-l-4 border-l-info text-foreground dark:text-foreground',
            'success' => 'bg-success/10 border border-success/20 border-l-4 border-l-success text-foreground dark:text-foreground',
            'warning' => 'bg-warning/10 border border-warning/20 border-l-4 border-l-warning text-foreground dark:text-foreground',
            'destructive' => 'bg-destructive/10 border border-destructive/20 border-l-4 border-l-destructive text-foreground dark:text-foreground',
            'primary' => 'bg-primary/10 border border-primary/20 border-l-4 border-l-primary text-foreground dark:text-foreground',
            default => 'bg-muted/50 border border-border border-l-4 border-l-foreground text-foreground',
        },
        default => match ($normalizedVariant) { // subtle
            'info' => 'bg-info/10 border border-info/20 text-info dark:text-info',
            'success' => 'bg-success/10 border border-success/20 text-success dark:text-success',
            'warning' => 'bg-warning/10 border border-warning/20 text-warning dark:text-warning',
            'destructive' => 'bg-destructive/10 border border-destructive/20 text-destructive dark:text-destructive',
            'primary' => 'bg-primary/10 border border-primary/20 text-primary dark:text-primary',
            default => 'bg-muted/60 border border-border/80 text-foreground',
        },
    };

    // Text color adjustments for description based on appearance
    $descTextColor = match ($normalizedAppearance) {
        'solid' => 'opacity-90',
        'outline' => 'text-foreground/80 dark:text-foreground/90',
        'accent-left' => 'text-muted-foreground',
        default => match ($normalizedVariant) {
            'default' => 'text-muted-foreground',
            default => 'text-foreground/80 dark:text-foreground/90',
        },
    };

    // Close button hover color
    $closeButtonClass = match ($normalizedAppearance) {
        'solid' => 'text-current opacity-70 hover:opacity-100 hover:bg-black/10 dark:hover:bg-white/10',
        default => match ($normalizedVariant) {
            'default' => 'text-muted-foreground hover:text-foreground hover:bg-muted',
            default => 'text-current opacity-75 hover:opacity-100 hover:bg-current/10',
        },
    };

    // Resolve if icon should be displayed
    $showIcon = $icon !== false && $icon !== 'false' && $icon !== 'none';

    $animationClass = match ($animation) {
        true, 'auto' => match ($normalizedVariant) {
            'destructive' => 'animate-vibe-shake',
            'success' => 'animate-vibe-pop',
            'warning' => 'animate-vibe-pulse',
            default => 'animate-vibe-shake',
        },
        'shake' => 'animate-vibe-shake',
        'pop', 'bounce' => 'animate-vibe-pop',
        'pulse' => 'animate-vibe-pulse',
        'wobble' => 'animate-vibe-wobble',
        default => '',
    };
@endphp

<div
    @if($dismissible)
        x-data="{ show: true }"
        x-show="show"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
    @endif
    {{ $attributes->twMerge(['class' => trim("relative flex items-start w-full {$sizeClasses['card']} {$roundedClass} {$variantClasses} {$animationClass}")]) }}
    role="alert"
>
    {{-- Leading Icon --}}
    @if ($showIcon)
        <div class="shrink-0 flex items-center justify-center {{ $sizeClasses['icon'] }}">
            @if (isset($iconSlot))
                {{ $iconSlot }}
            @elseif (is_string($icon) && !empty($icon) && $icon !== 'true')
                {!! $icon !!}
            @else
                @switch($normalizedVariant)
                    @case('success')
                        <svg class="size-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                        @break
                    @case('warning')
                        <svg class="size-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                            <line x1="12" y1="9" x2="12" y2="13" />
                            <line x1="12" y1="17" x2="12.01" y2="17" />
                        </svg>
                        @break
                    @case('destructive')
                        <svg class="size-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="15" y1="9" x2="9" y2="15" />
                            <line x1="9" y1="9" x2="15" y2="15" />
                        </svg>
                        @break
                    @case('primary')
                        <svg class="size-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z" />
                        </svg>
                        @break
                    @default
                        {{-- Info & Default --}}
                        <svg class="size-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="16" x2="12" y2="12" />
                            <line x1="12" y1="8" x2="12.01" y2="8" />
                        </svg>
                @endswitch
            @endif
        </div>
    @endif

    {{-- Content Body --}}
    <div class="flex-1 min-w-0 space-y-1">
        {{-- Title --}}
        @if (isset($titleSlot))
            <div class="{{ $sizeClasses['title'] }}">
                {{ $titleSlot }}
            </div>
        @elseif ($title)
            <h5 class="{{ $sizeClasses['title'] }}">
                {{ $title }}
            </h5>
        @endif

        {{-- Description / Slot --}}
        @if ($description)
            <div class="{{ $sizeClasses['description'] }} {{ $descTextColor }}">
                {{ $description }}
            </div>
        @endif

        @if ($slot->isNotEmpty())
            <div class="{{ $sizeClasses['description'] }} {{ $descTextColor }}">
                {{ $slot }}
            </div>
        @endif

        {{-- Action buttons/links if provided --}}
        @if (isset($actions))
            <div class="pt-2 flex items-center flex-wrap gap-2">
                {{ $actions }}
            </div>
        @endif
    </div>

    {{-- Optional Close / Dismiss Button --}}
    @if ($dismissible)
        <button
            type="button"
            @click="show = false; $dispatch('dismiss')"
            class="shrink-0 inline-flex items-center justify-center rounded-lg transition-colors cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-ring {{ $closeButtonClass }}"
            title="{{ __('vibe::alert.close') ?? 'Close' }}"
            aria-label="Close"
        >
            <svg class="{{ $sizeClasses['close'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>
    @endif
</div>
