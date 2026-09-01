@blaze(fold: true)

@props([
    'title' => 'Tidak ada data ditemukan',
    'description' => null,
    'colspan' => 100,
])

<tr data-empty="true" {{ $attributes->twMerge(['class' => 'hover:bg-transparent!']) }}>
    <td colspan="{{ $colspan }}" class="py-12 px-4 text-center">
        <div class="flex flex-col items-center justify-center gap-2 max-w-sm mx-auto">
            @if (isset($icon))
                <div class="text-muted-foreground/60 mb-1">
                    {{ $icon }}
                </div>
            @else
                <div class="size-10 rounded-full bg-muted flex items-center justify-center text-muted-foreground/70 mb-1">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.3-4.3"/>
                    </svg>
                </div>
            @endif

            <p class="text-sm font-semibold text-foreground">{{ $title }}</p>
            
            @if ($description)
                <p class="text-xs text-muted-foreground leading-relaxed">{{ $description }}</p>
            @endif

            @if ($slot->isNotEmpty())
                <div class="mt-2">
                    {{ $slot }}
                </div>
            @endif
        </div>
    </td>
</tr>
