<div>
    [DataTable]

    <vibe:sheet id="{{ isset($editId) ? 'edit-sheet' : 'create-sheet' }}" class="bg-vibe-50 dark:bg-vibe-950" position="right" layout="fixed" behavior="collapsible" defaultState="collapsed" defaultSize="500" closeOnOutsideClick="true">
        @if($editId)
            [SheetEdit]
        @else
            [SheetCreate]
        @endif
    </vibe:sheet>
</div>
