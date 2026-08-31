@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
            <div class="flex justify-between flex-1 sm:hidden">
                @if ($paginator->onFirstPage())
                    <vibe:button class="px-2" disabled>
                        {!! __('vibe/pagination.previous') !!}
                    </vibe:button>
                @else
                    <vibe:button class="px-2" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled">
                        {!! __('vibe/pagination.previous') !!}
                    </vibe:button>
                @endif

                @if ($paginator->hasMorePages())
                    <vibe:button size="sm" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled">
                        {!! __('vibe/pagination.next') !!}
                    </vibe:button>
                @else
                    <vibe:button size="sm" disabled>
                        {!! __('vibe/pagination.next') !!}
                    </vibe:button>
                @endif
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">
                        <span>{!! __('vibe/pagination.showing') !!}</span>
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        <span>{!! __('vibe/pagination.to') !!}</span>
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                        <span>{!! __('vibe/pagination.of') !!}</span>
                        <span class="font-medium">{{ $paginator->total() }}</span>
                        <span>{!! __('vibe/pagination.results') !!}</span>
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex rtl:flex-row-reverse gap-1.5">
                        
                        @if ($paginator->onFirstPage())
                            <vibe:button class="px-2" disabled aria-label="{{ __('vibe/pagination.previous') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </vibe:button>
                        @else
                            <vibe:button class="px-2" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" aria-label="{{ __('vibe/pagination.previous') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </vibe:button>
                        @endif

                        @foreach ($elements as $element)
                            @if (is_string($element))
                                <vibe:button size="sm" disabled>{{ $element }}</vibe:button>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <vibe:button size="sm" variant="primary" wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">{{ $page }}</vibe:button>
                                    @else
                                        <vibe:button size="sm" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</vibe:button>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        @if ($paginator->hasMorePages())
                            <vibe:button class="px-2" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" aria-label="{{ __('vibe/pagination.next') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </vibe:button>
                        @else
                            <vibe:button class="px-2" disabled aria-label="{{ __('vibe/pagination.next') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </vibe:button>
                        @endif
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>
