@aware(['tableName', 'isTailwind', 'isBootstrap'])
@props(['colCount' => 1])

@php
    $loaderRow = $this->getLoadingPlaceHolderRowAttributes();
    $loaderCell = $this->getLoadingPlaceHolderCellAttributes();
@endphp

<tr
    wire:key="{{ $tableName }}-loader"
    wire:loading.class.remove="hidden"
    {{
        $attributes->merge($loaderRow)
            ->class([
                'hidden w-full text-center align-middle bg-muted/10' => ($loaderRow['default'] ?? true),
            ])
            ->except(['default', 'default-styling', 'default-colors'])
    }}
>
    <td
        colspan="{{ $colCount }}"
        wire:key="{{ $tableName }}-loader-column"
        {{
            $attributes->merge($loaderCell)
                ->class([
                    'py-8 px-4' => ($loaderCell['default'] ?? true),
                ])
                ->except(['default', 'default-styling', 'default-colors', 'colspan', 'wire:key'])
        }}
    >
        @if($this->hasLoadingPlaceholderBlade())
            @include($this->getLoadingPlaceHolderBlade(), ['colCount' => $colCount])
        @else
            <div class="flex items-center justify-center gap-3 text-muted-foreground">
                <svg class="h-5 w-5 animate-spin text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-sm font-medium">{{ __('vibe/datatable.loading') }}</span>
            </div>
        @endif
    </td>
</tr>
