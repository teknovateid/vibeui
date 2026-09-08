@aware(['tableName', 'isTailwind', 'isBootstrap', 'localisationPath'])

@if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
    @php
        $colspan = $this->getColspanCount();
        $selectAll = $this->selectAllIsEnabled();
        $simplePagination = $this->isPaginationMethod('simple');
    @endphp

    <tr
        x-cloak 
        x-show="selectedItems.length > 0 && !currentlyReorderingStatus"
        wire:key="{{ $tableName }}-bulk-select-message"
        class="border-b border-primary/20 bg-primary/5 text-primary text-xs"
    >
        <td :colspan="{{ $colspan }}" class="py-2.5 px-4 text-center">
            <template x-if="selectedItems.length == paginationTotalItemCount || selectAllStatus">
                <div wire:key="{{ $tableName }}-all-selected" class="inline-flex items-center gap-2">
                    <span>
                        {{ __($localisationPath.'You are currently selecting all') }}
                        @if(!$simplePagination) <strong class="font-bold"><span x-text="paginationTotalItemCount"></span></strong> @endif
                        {{ __($localisationPath.'rows') }}.
                    </span>

                    <vibe:button
                        variant="link"
                        x-on:click="clearSelected"
                        wire:loading.attr="disabled"
                        class="ml-1 font-semibold underline underline-offset-2 text-primary hover:text-primary/80 transition-colors"
                    >
                        {{ __($localisationPath.'Deselect All') }}
                    </vibe:button>
                </div>
            </template>

            <template x-if="selectedItems.length !== paginationTotalItemCount && !selectAllStatus">
                <div wire:key="{{ $tableName }}-some-selected" class="inline-flex items-center gap-2">
                    <span>
                        {{ __($localisationPath.'You have selected') }}
                        <strong class="font-bold"><span x-text="selectedItems.length"></span></strong>
                        {{ __($localisationPath.'rows, do you want to select all') }}
                        @if(!$simplePagination) <strong class="font-bold"><span x-text="paginationTotalItemCount"></span></strong> @endif
                        ?
                    </span>

                    <vibe:button
                        variant="link"
                        x-on:click="setAllSelected()"
                        wire:loading.attr="disabled"
                        class="ml-1 font-semibold underline underline-offset-2 text-primary hover:text-primary/80 transition-colors"
                    >
                        {{ __($localisationPath.'Select All') }}
                    </vibe:button>
                </div>
            </template>
        </td>
    </tr>
@endif
