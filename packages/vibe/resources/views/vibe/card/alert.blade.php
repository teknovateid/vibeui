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
        'border-left' => 'accent-left',
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
                        <svg class="size-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="m8.5 12.5 2 2 5-5" />
                        </svg>
                        @break
                    @case('warning')
                        <svg class="size-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5.312 10.762C8.23 5.587 9.69 3 12 3c2.31 0 3.77 2.587 6.688 7.762l.364.644c2.425 4.3 3.638 6.45 2.542 8.022C20.498 21 17.786 21 12.364 21h-.728c-5.422 0-8.134 0-9.23-1.572-1.096-1.572.117-3.722 2.542-8.022l.364-.644Z" />
                            <path d="M12 8v5M12 16h.01" />
                        </svg>
                        @break
                    @case('destructive')
                        <svg class="size-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="m14.5 9.5-5 5m0-5 5 5" />
                        </svg>
                        @break
                    @case('primary')
                        <svg class="size-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9.153 5.408C10.42 3.136 11.053 2 12 2c.947 0 1.58 3.136 2.847 5.408l.328.588c.36.646.54.969.82 1.182.282.213.631.292 1.33.45l.637.144c2.459.557 3.689.835 3.981 1.776.293.94-.545 1.921-2.222 3.882l-.434.507c-.476.557-.714.836-.821 1.18-.108.345-.072.717 0 1.46l.066.677c.253 2.617.38 3.925-.386 4.507-.766.581-1.918.051-4.22-1.009l-.596-.275C12.674 20.176 12.347 20.025 12 20.025s-.674.15-1.329.452l-.595.274c-2.303 1.06-3.455 1.59-4.221 1.01-.766-.582-.64-1.89-.386-4.508l.065-.677c.072-.743.036-1.115-.072-1.46-.107-.344-.345-.623-.82-1.18l-.435-.507C2.96 11.42 2.122 10.44 2.415 9.5c.292-.941 1.522-1.22 3.98-1.776l.637-.144c.7-.158 1.049-.237 1.33-.45.28-.213.46-.536.82-1.182l.328-.588Z" />
                        </svg>
                        @break
                    @default
                        {{-- Info & Default --}}
                        <svg class="size-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 7v6M12 16h.01" />
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
            <svg class="{{ $sizeClasses['close'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 5L5 19M19 19L5 5" />
            </svg>
        </button>
    @endif
</div>
