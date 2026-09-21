@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-1.5">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button
                type="button"
                disabled
                aria-label="{{ __('pagination.previous') }}"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-border bg-background text-muted-foreground opacity-40 cursor-not-allowed shadow-2xs"
            >
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
            </button>
        @else
            @if(method_exists($paginator,'getCursorName'))
                <button
                    type="button"
                    wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->previousCursor()->encode() }}"
                    wire:click="setPage('{{$paginator->previousCursor()->encode()}}','{{ $paginator->getCursorName() }}')"
                    wire:loading.attr="disabled"
                    aria-label="{{ __('pagination.previous') }}"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-border bg-background text-foreground hover:bg-muted shadow-2xs transition-colors cursor-pointer"
                >
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                </button>
            @else
                <button
                    type="button"
                    wire:click="previousPage('{{ $paginator->getPageName() }}')"
                    wire:loading.attr="disabled"
                    aria-label="{{ __('pagination.previous') }}"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-border bg-background text-foreground hover:bg-muted shadow-2xs transition-colors cursor-pointer"
                >
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                </button>
            @endif
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            @if(method_exists($paginator,'getCursorName'))
                <button
                    type="button"
                    wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->nextCursor()->encode() }}"
                    wire:click="setPage('{{$paginator->nextCursor()->encode()}}','{{ $paginator->getCursorName() }}')"
                    wire:loading.attr="disabled"
                    aria-label="{{ __('pagination.next') }}"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-border bg-background text-foreground hover:bg-muted shadow-2xs transition-colors cursor-pointer"
                >
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </button>
            @else
                <button
                    type="button"
                    wire:click="nextPage('{{ $paginator->getPageName() }}')"
                    wire:loading.attr="disabled"
                    aria-label="{{ __('pagination.next') }}"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-border bg-background text-foreground hover:bg-muted shadow-2xs transition-colors cursor-pointer"
                >
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </button>
            @endif
        @else
            <button
                type="button"
                disabled
                aria-label="{{ __('pagination.next') }}"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-border bg-background text-muted-foreground opacity-40 cursor-not-allowed shadow-2xs"
            >
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m9 18 6-6-6-6"/>
                </svg>
            </button>
        @endif
    </nav>
@endif
