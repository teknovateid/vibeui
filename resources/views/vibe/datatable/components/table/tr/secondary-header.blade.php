@aware(['tableName'])

<tr
    wire:key="{{ $tableName }}-secondary-header"
    class="border-b border-border bg-muted/20"
>
    <x-livewire-tables::table.td.plain x-cloak x-show="currentlyReorderingStatus" :displayMinimisedOnReorder="true" wire:key="{{ $tableName }}-header-test" />

    @if ($this->showBulkActionsSections)
        <td class="p-2 align-middle border-b border-border text-center" wire:key="{{ $tableName }}-header-hasBulkActions"></td>
    @endif

    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
        <x-livewire-tables::table.td.collapsed-columns :hidden="true" :displayMinimisedOnReorder="true" wire:key="{{ $tableName }}-header-collapsed-hide" rowIndex="-1" />
    @endif

    @foreach($this->selectedVisibleColumns as $colIndex => $column)
        <td wire:key="{{ $tableName }}-secondary-header-show-{{ $column->getSlug() }}" class="p-2 align-middle border-b border-border">
            @if($column->hasSecondaryHeader() && $column->hasSecondaryHeaderCallback())
                @if($column->secondaryHeaderCallbackIsFilter())
                    {!! $column->getSecondaryHeaderFilter($column->getSecondaryHeaderCallback(), $this->getFilterGenericData) !!}    
                @elseif($column->secondaryHeaderCallbackIsString())
                    {!! $column->getSecondaryHeaderFilter($this->getFilterByKey($column->getSecondaryHeaderCallback()), $this->getFilterGenericData) !!}
                @else
                    {!! $column->getNewSecondaryHeaderContents($this->getRows) !!}
                @endif
            @endif
        </td>
    @endforeach
</tr>
