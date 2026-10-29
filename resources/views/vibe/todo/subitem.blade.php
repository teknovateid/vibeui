@blaze(fold: true)

@props([
    'total' => null,
    'completed' => 0,
    'progress' => true,
    'percentage' => true,
    'color' => 'primary',
    'title' => 'Subtasks',
])

@php
    $hasShortcut = $total !== null;
    $totalCount = (int) ($total ?? 0);
    $completedCount = (int) ($completed ?? 0);
    $pct = $totalCount > 0 ? (int) round(($completedCount / $totalCount) * 100) : 0;

    $colorClass = match ($color) {
        'indigo' => 'bg-indigo-600',
        'blue' => 'bg-blue-600',
        'emerald', 'green' => 'bg-emerald-600',
        'amber', 'yellow' => 'bg-amber-500',
        'destructive', 'red' => 'bg-destructive',
        default => str_starts_with($color, 'bg-') ? $color : 'bg-primary',
    };
@endphp

<div {{ $attributes->twMerge(['class' => 'w-full space-y-2']) }}>
    @if ($hasShortcut)
        {{-- Shortcut Row: Subtasks count --}}
        <div class="flex items-center justify-between text-xs font-medium">
            <span class="flex items-center gap-1.5 text-muted-foreground">
                <svg class="size-3.5 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/>
                    <path d="m9 12 2 2 4-4"/>
                </svg>
                <span>{{ $title }}</span>
            </span>
            <span class="text-muted-foreground font-semibold">{{ $completedCount }}/{{ $totalCount }}</span>
        </div>

        {{-- Shortcut Progress Bar --}}
        @if ($progress)
            <div class="space-y-1">
                @if ($percentage)
                    <div class="flex items-center justify-between text-xs text-muted-foreground">
                        <span>Progress</span>
                        <span class="font-semibold text-foreground">{{ $pct }}%</span>
                    </div>
                @endif
                <div class="w-full bg-muted rounded-full h-1.5 overflow-hidden">
                    <div class="{{ $colorClass }} h-full rounded-full transition-all duration-300" style="width: {{ $pct }}%"></div>
                </div>
            </div>
        @endif
    @endif

    {{ $slot }}
</div>

