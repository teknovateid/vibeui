@blaze(fold: true)

@props([
    'paginator',
    'scrollTo' => 'body',
])

@php
$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="{{ __('vibe/pagination.navigation') }}" class="flex items-center justify-between">
            <div class="flex justify-between flex-1 sm:hidden">
                @if ($paginator->onFirstPage())
                    <vibe:button size="sm" disabled>
                        {!! __('vibe/pagination.previous') !!}
                    </vibe:button>
                @else
                    <vibe:button size="sm" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled">
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
                    <span class="relative z-0 inline-flex rtl:flex-row-reverse gap-1.5 items-center">
                        
                        @if ($paginator->onFirstPage())
                            <vibe:button size="icon-sm" disabled aria-label="{{ __('vibe/pagination.previous') }}">
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 19l-7-7 7-7" />
                                </svg>
                            </vibe:button>
                        @else
                            <vibe:button size="icon-sm" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" aria-label="{{ __('vibe/pagination.previous') }}">
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 19l-7-7 7-7" />
                                </svg>
                            </vibe:button>
                        @endif

                        @foreach ($elements as $element)
                            @if (is_string($element))
                                <vibe:button size="sm" class="min-w-8" disabled>{{ $element }}</vibe:button>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <vibe:button size="sm" class="min-w-8" variant="primary" wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">{{ $page }}</vibe:button>
                                    @else
                                        <vibe:button size="sm" class="min-w-8" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}" aria-label="{{ __('vibe/pagination.goto_page', ['page' => $page]) }}">{{ $page }}</vibe:button>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        @if ($paginator->hasMorePages())
                            <vibe:button size="icon-sm" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" aria-label="{{ __('vibe/pagination.next') }}">
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 5l7 7-7 7" />
                                </svg>
                            </vibe:button>
                        @else
                            <vibe:button size="icon-sm" disabled aria-label="{{ __('vibe/pagination.next') }}">
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 5l7 7-7 7" />
                                </svg>
                            </vibe:button>
                        @endif
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>
