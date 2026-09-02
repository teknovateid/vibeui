@aware(['tableName'])

<tr
    wire:key="{{ $tableName . '-footer' }}"
    class="border-t border-border bg-muted/40 text-xs font-semibold uppercase tracking-wider text-muted-foreground"
>
    @if ($this->showBulkActionsSections)
        <td class="py-3 px-4" wire:key="{{ $tableName . '-footer-bulkactions' }}"></td>
    @endif

    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
        <td class="hidden py-3 px-4" wire:key="{{ $tableName . '-footer-collapse' }}"></td>
    @endif

    @foreach($this->selectedVisibleColumns as $colIndex => $column)
        <td
            wire:key="{{ $tableName . '-footer-shown-' . $colIndex }}"
            class="py-3 px-4 text-left text-xs font-semibold tracking-wider text-muted-foreground {{ $column->shouldCollapseAlways() ? 'hidden' : '' }} {{ $column->shouldCollapseOnMobile() ? 'hidden md:table-cell' : '' }} {{ $column->shouldCollapseOnTablet() ? 'hidden lg:table-cell' : '' }}"
        >
            @if($column->hasFooter() && $column->hasFooterCallback())
                @if($column->footerCallbackIsFilter())
                    {!! $column->getFooterFilter($column->getFooterCallback(), $this->getFilterGenericData) !!}
                @elseif($column->footerCallbackIsString())
                    {!! $column->getFooterFilter($this->getFilterByKey($column->getFooterCallback()), $this->getFilterGenericData) !!}
                @else
                    {!! $column->getNewFooterContents($this->getRows) !!}
                @endif
            @endif
        </td>
    @endforeach
</tr>
