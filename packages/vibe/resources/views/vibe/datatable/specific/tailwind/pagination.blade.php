@if ($paginator->hasPages())
    @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-1.5">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-border bg-background text-muted-foreground opacity-40 cursor-not-allowed shadow-2xs">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
            </span>
        @else
            <button
                type="button"
                wire:click="previousPage('{{ $paginator->getPageName() }}')"
                wire:loading.attr="disabled"
                rel="prev"
                aria-label="{{ __('pagination.previous') }}"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-border bg-background text-foreground hover:bg-muted shadow-2xs transition-colors cursor-pointer"
            >
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
            </button>
        @endif

        {{-- Pagination Elements --}}
        @if ($elements ?? null)
            <div class="hidden sm:flex items-center gap-1">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true" class="inline-flex h-8 w-8 items-center justify-center text-xs font-medium text-muted-foreground">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span
                                    aria-current="page"
                                    class="inline-flex h-8 min-w-8 px-2.5 items-center justify-center rounded-lg bg-primary text-primary-foreground text-xs font-semibold shadow-2xs select-none"
                                >
                                    {{ $page }}
                                </span>
                            @else
                                <button
                                    type="button"
                                    wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                    wire:loading.attr="disabled"
                                    class="inline-flex h-8 min-w-8 px-2.5 items-center justify-center rounded-lg border border-border bg-background text-foreground hover:bg-muted text-xs font-medium shadow-2xs transition-colors cursor-pointer"
                                >
                                    {{ $page }}
                                </button>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button
                type="button"
                wire:click="nextPage('{{ $paginator->getPageName() }}')"
                wire:loading.attr="disabled"
                rel="next"
                aria-label="{{ __('pagination.next') }}"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-border bg-background text-foreground hover:bg-muted shadow-2xs transition-colors cursor-pointer"
            >
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"/>
                </svg>
            </button>
        @else
            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-border bg-background text-muted-foreground opacity-40 cursor-not-allowed shadow-2xs">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"/>
                </svg>
            </span>
        @endif
    </nav>
@endif
