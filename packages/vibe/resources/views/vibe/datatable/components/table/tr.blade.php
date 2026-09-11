@aware(['tableName', 'primaryKey', 'isTailwind', 'isBootstrap'])
@props(['row', 'rowIndex'])

@php
    $customAttributes = $this->getTrAttributes($row, $rowIndex);
@endphp

<tr
    rowpk="{{ $row->{$primaryKey} }}"
    x-on:dragstart.self="currentlyReorderingStatus && dragStart(event)"
    x-on:drop.prevent="currentlyReorderingStatus && dropEvent(event)"
    x-on:dragover.prevent.throttle.500ms="currentlyReorderingStatus && dragOverEvent(event)"
    x-on:dragleave.prevent.throttle.500ms="currentlyReorderingStatus && dragLeaveEvent(event)"
    @if($this->hasDisplayLoadingPlaceholder()) 
        wire:loading.class.add="hidden"
    @else
        wire:loading.class.delay="opacity-50"
    @endif
    id="{{ $tableName }}-row-{{ $row->{$primaryKey} }}"
    :draggable="currentlyReorderingStatus"
    wire:key="{{ $tableName }}-tablerow-tr-{{ $row->{$primaryKey} }}"
    @if(method_exists($this, 'hasContextMenu') && $this->hasContextMenu())
        @contextmenu.prevent="$dispatch('open-context', {
            menu: '{{ $tableName }}-context-menu',
            x: $event.clientX,
            y: $event.clientY,
            data: @js($this->contextData($row))
        })"
    @endif
    {{
        $attributes->merge($customAttributes)
            ->class([
                'transition-colors hover:bg-muted/50 dark:hover:bg-muted/30' => ($customAttributes['default'] ?? true),
                'cursor-pointer' => $this->hasTableRowUrl(),
                'cursor-context-menu' => method_exists($this, 'hasContextMenu') && $this->hasContextMenu(),
            ])
            ->except(['default', 'default-styling', 'default-colors'])
    }}
>
    {{ $slot }}
</tr>
