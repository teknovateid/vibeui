@php
    $skeletonRowCount = min(max((int) ($this->perPage ?? 5), 3), 10);
    $widths = [30, 65, 45, 75, 40, 55, 80, 50];
@endphp
@for($skIdx = 0; $skIdx < $skeletonRowCount; $skIdx++)
    <tr wire:key="{{ $tableName }}-skeleton-loader-{{ $skIdx }}" wire:loading.class.remove="hidden" class="hidden animate-pulse border-b border-border/60 select-none">
        @if($this->getCurrentlyReorderingStatus)
            <td class="py-3.5 px-4"><div class="size-4 rounded bg-muted-foreground/15 dark:bg-muted-foreground/20"></div></td>
        @endif
        @if($this->showBulkActionsSections)
            <td class="py-3.5 px-4"><div class="size-4 rounded bg-muted-foreground/15 dark:bg-muted-foreground/20"></div></td>
        @endif
        @if($this->showCollapsingColumnSections)
            <td class="py-3.5 px-4"><div class="size-4 rounded bg-muted-foreground/15 dark:bg-muted-foreground/20"></div></td>
        @endif
        @foreach($this->selectedVisibleColumns as $colIdx => $col)
            <td class="py-3.5 px-4 align-middle">
                <div class="h-3.5 rounded bg-muted-foreground/15 dark:bg-muted-foreground/20" style="width: {{ $widths[($skIdx + $colIdx) % count($widths)] }}%;"></div>
            </td>
        @endforeach
    </tr>
@endfor
