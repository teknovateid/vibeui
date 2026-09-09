@blaze(fold: true)

@props([
    'variant' => 'default', // default, outline, ghost, flat, muted, elevated, container
    'padding' => 'sm',
    'hover' => true,
    'title' => null,
    'titleTag' => 'h4',
    'description' => null,
])

@php
    $validTitleTags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'p', 'span'];
    $tag = in_array($titleTag, $validTitleTags, true) ? $titleTag : 'h4';
@endphp

<vibe:card
    :variant="$variant"
    :padding="$padding"
    {{ $attributes->twMerge([
        'class' => trim('transition-all duration-200 ' . ($hover ? 'hover:shadow-xs hover:border-border/80' : ''))
    ]) }}
>
    @if ($title || $description || isset($header) || isset($actions))
        <div class="flex items-start justify-between gap-3 mb-2">
            @if (isset($header))
                {{ $header }}
            @else
                <div class="space-y-1 min-w-0">
                    @if ($title)
                        <{{ $tag }} class="font-semibold text-sm text-foreground tracking-tight">{{ $title }}</{{ $tag }}>
                    @endif
                    @if ($description)
                        <p class="text-xs text-muted-foreground leading-relaxed">{{ $description }}</p>
                    @endif
                </div>
            @endif

            @if (isset($actions))
                <div class="shrink-0 flex items-center gap-2">
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif

    {{ $slot }}

    @if (isset($footer))
        <div class="pt-3 mt-3 border-t border-border/50 flex items-center justify-between text-xs text-muted-foreground">
            {{ $footer }}
        </div>
    @endif
</vibe:card>
