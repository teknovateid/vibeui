<?php

return [
    'title' => 'Context Menu',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'A right-click context menu component that appears at the cursor position. Designed as a single global menu instance for safe use with large datasets — compatible with cards, table rows, datatables, and any HTML element.',

    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Wrap any element with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:context&gt;</code> and point it to a <code class="font-mono text-xs text-foreground">&lt;vibe:context.menu&gt;</code> via the <code class="font-mono text-xs text-foreground">menu</code> prop. Right-click on the target element to open the menu.',
        'preview_title' => 'Card with Context Menu',
        'card_text' => 'Right-click on this card',
        'card_hint' => 'Try right-clicking anywhere on this card',
        'edit' => 'Edit',
        'duplicate' => 'Duplicate',
        'delete' => 'Delete',
    ],

    'datatable' => [
        'title' => 'Datatable Integration (Single Global Menu)',
        'desc' => 'For datatables with many rows, use a <strong>single global</strong> <code class="font-mono text-xs text-foreground">&lt;vibe:context.menu&gt;</code> outside the loop. Each row dispatches an <code class="font-mono text-xs text-foreground">open-context</code> event with <code class="font-mono text-xs text-foreground">data</code> payload. The menu accesses it reactively via <code class="font-mono text-xs text-foreground">$context.data</code>.',
        'preview_title' => 'Right-click on any row',
        'col_name' => 'Name',
        'col_email' => 'Email',
        'col_role' => 'Role',
        'edit_row' => 'Edit',
        'view_row' => 'View Detail',
        'delete_row' => 'Delete',
        'selected_label' => 'Selected:',
    ],

    'with_submenu' => [
        'title' => 'With Submenu (context.sub)',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:context.sub&gt;</code> to nest submenus. They automatically flip left when near the viewport right edge.',
        'preview_title' => 'Context Menu with Submenu',
        'area_text' => 'Right-click here',
        'open' => 'Open',
        'share' => 'Share to...',
        'share_email' => 'Email',
        'share_slack' => 'Slack',
        'share_teams' => 'Microsoft Teams',
        'rename' => 'Rename',
        'delete' => 'Delete',
    ],

    'programmatic' => [
        'title' => 'Programmatic Control ($vibe.context)',
        'desc' => 'Open context menus programmatically using <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">$vibe.context(\'id\').show(x, y, data?)</code> or close all with <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">$vibe.contexts.close()</code>.',
        'preview_title' => 'Context Menu Programmatic Control',
        'open_btn' => 'Open Context Menu',
        'close_btn' => 'Close All',
        'edit' => 'Edit',
        'duplicate' => 'Duplicate',
        'delete' => 'Delete',
    ],

    'props' => [
        'title' => 'Props & Subcomponents Reference',
        'desc' => 'Complete specification of props and subcomponents available for the <code class="font-mono text-xs text-foreground">&lt;vibe:context&gt;</code> component suite.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
        'events_title' => 'Window Events & $vibe Helper Reference',
        'events_desc' => 'The context menu component responds to the following window events and $vibe Alpine.js helpers:',
        'th_event' => 'Helper / Window Event',
        'th_payload' => 'Payload',
        'th_event_desc' => 'Description',
        'events' => [
            [
                'name' => "\$vibe.context('id').show(x, y, data?) / @open-context",
                'payload' => "{ menu: 'id', x, y, data }",
                'desc' => 'Opens the context menu at the given x/y position with optional data payload accessible via $context.data.',
            ],
            [
                'name' => "\$vibe.context('id').close() / @close-context",
                'payload' => "'id'",
                'desc' => 'Closes the target context menu.',
            ],
            [
                'name' => "\$vibe.contexts.close() / @close-context",
                'payload' => "'*'",
                'desc' => 'Closes all active context menus currently open on the page.',
            ],
        ],
    ],

    'props_items' => [
        'context' => [
            'menu' => 'The ID of the <vibe:context.menu> to open on right-click.',
        ],
        'menu' => [
            'id' => 'Unique menu ID. Used by triggers to target this menu via the menu prop or $vibe.context(\'id\').',
        ],
        'item' => [
            'href' => 'If provided, renders as an <a> navigation link.',
            'variant' => "Item variant: 'default' or 'destructive'.",
            'disabled' => 'Disable the item (grayed out, non-clickable).',
        ],
        'item_delete' => [
            'title' => 'Title text for the confirm dialog.',
            'message' => 'Message body for the confirm dialog.',
            'confirmText' => 'Confirm button label.',
            'cancelText' => 'Cancel button label.',
            'url' => 'DELETE form URL for non-Livewire usage. Use route().',
            'wire:click' => 'Livewire action — read via $attributes->wire(\'click\').',
        ],
        'sub' => [
            'label' => 'Trigger label text for the submenu.',
            'align' => "Submenu alignment: 'right' (default) or 'left'.",
            'width' => "Submenu width: '48', '56', '64', '80', etc.",
        ],
    ],
];
