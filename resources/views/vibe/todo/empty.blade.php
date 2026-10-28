@blaze(fold: true)

@props([
    'title' => 'Semua tugas selesai!',
    'description' => 'Belum ada tugas baru atau seluruh tugas telah diselesaikan.',
])

<div {{ $attributes->twMerge(['class' => 'flex flex-col items-center justify-center p-8 text-center rounded-2xl border border-dashed border-border/80 bg-muted/20']) }}>
    <div class="size-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-3">
        @if (isset($icon))
            {{ $icon }}
        @else
            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/>
                <path d="m9 12 2 2 4-4"/>
            </svg>
        @endif
    </div>

    <h4 class="text-sm font-semibold text-foreground">
        {{ $title }}
    </h4>

    @if ($description)
        <p class="text-xs text-muted-foreground mt-1 max-w-xs">
            {{ $description }}
        </p>
    @endif

    {{ $slot }}
</div>
