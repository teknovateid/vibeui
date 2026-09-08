@aware(['tableName', 'primaryKey', 'isTailwind', 'isBootstrap', 'localisationPath'])
@props(['row', 'rowIndex'])

@php
    $tdAttributes = $this->getBulkActionsTdAttributes;
    $tdCheckboxAttributes = $this->getBulkActionsTdCheckboxAttributes;
@endphp

@if ($this->showBulkActionsSections())
    <td
        wire:key="{{ $tableName }}-tbody-td-bulk-actions-td-{{ $row->{$primaryKey} }}"
        {{ 
            $attributes->merge($tdAttributes)
                ->class([
                    'w-14 px-2 py-3.5 text-center align-middle text-foreground select-none' => ($tdAttributes['default'] ?? true),
                ])
                ->except(['default', 'default-styling', 'default-colors']) 
        }}
    >
        @if ($this->rowIsSelectable($row))
            <div class="flex items-center justify-center">
                <x-livewire-tables::forms.checkbox
                    wire:key="{{ $tableName . '-selectedItems-' . $row->{$primaryKey} }}"
                    value="{{ $row->{$primaryKey} }}"
                    aria-label="{{ __($localisationPath.'row').' '.$row->{$primaryKey} }}"
                    :checkboxAttributes="$tdCheckboxAttributes"
                />
            </div>
        @endif
    </td>
@endif
