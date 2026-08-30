@blaze(fold: true)

@props([
    'title' => config('app.name'),
])

<div {{ $attributes->merge(['class' => 'flex flex-wrap gap-4 items-center justify-between w-full']) }}>
    <nav aria-label="Breadcrumb" class="flex flex-col gap-1.5 text-sm font-medium text-muted-foreground">
        @if ($title)
            <h2 class="text-xl md:text-2xl font-bold text-foreground">
                {{ $title === true ? config('app.name') : $title }}
            </h2>
        @endif
        <ol class="vibe-breadcrumb flex items-center flex-wrap gap-2 sm:gap-2.5">
            {{ $slot }}
        </ol>
    </nav>
    @if (isset($button))
        <div>
            {{ $button }}
        </div>
    @endif
</div>
