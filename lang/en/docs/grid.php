<?php

return [
    'title' => 'Grid',
    'badge' => 'Component',
    'group' => 'Layout & Containers',
    'description' => 'An interactive, card-based dashboard grid component. Features smooth card resizing via bottom-right corner drag handles, seamless drag-and-drop card reordering, and browser localStorage persistence so widget layouts and sizes persist across page refreshes.',

    // Section 1: Interactive Showcase
    'showcase' => [
        'title' => 'Interactive Card Grid Showcase',
        'desc' => 'Experience the interactive capabilities directly on the dashboard grid below: **drag the bottom-right grabber handle** of any card to resize columns, or **drag the grip handle (⠿) in the card header** to rearrange card order. All layout changes are automatically saved to localStorage!',
        'preview_title' => 'Dashboard Widget Grid (Resize, Reorder, & LocalStorage)',
        'hint' => '💡 Pro-tip: Drag the ⠿ handle in the header to swap card positions, or drag the bottom-right corner ridges to enlarge or shrink card width!',
        'toolbar_title' => 'Dashboard Overview',
        'toolbar_desc' => 'Customize widget positions and sizes to match your preferred workspace layout.',
    ],

    // Section 2: Card Resize
    'resize' => [
        'title' => 'Card Width Resizing (Corner Grabber)',
        'desc' => 'Each card can be smoothly resized within the responsive 12-column grid system by dragging the handle on the bottom-right corner. Configure initial width with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:colSpan="4"</code>, lower boundaries with <code class="font-mono text-xs text-foreground">:minColSpan="2"</code>, and upper limits with <code class="font-mono text-xs text-foreground">:maxColSpan="12"</code>.',
        'preview_title' => 'Card Width Bounds and Resizing Options',
    ],

    // Section 3: Card Reorder (Drag & Drop)
    'reorder' => [
        'title' => 'Card Reordering (Drag & Drop)',
        'desc' => 'Cards can be repositioned and swapped freely using drag-and-drop. The integrated drag handle on card headers gives clear tactile feedback and visual drop guide borders. Pinned cards that should never move can be configured with <code class="font-mono text-xs text-foreground">:reorderable="false"</code>.',
        'preview_title' => 'Drag and Drop Reordering Between Cards',
    ],

    // Section 4: Persistence
    'persistence' => [
        'title' => 'Layout Persistence (localStorage)',
        'desc' => 'By defining <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">id="dashboard-grid"</code> and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:persist="true"</code>, all card orders and sizes configured by the user are automatically stored in the browser localStorage. When the page is reloaded, the layout remains intact. The "Reset Layout" toolbar button allows restoring default positions anytime.',
        'preview_title' => 'Persistent Layout Kept Across Page Refreshes',
    ],

    // Section 5: Props Reference
    'props' => [
        'title' => 'Props & Subcomponents Reference',
        'desc' => 'Configuration options and attributes supported across `<vibe:grid>`, `<vibe:grid.card>`, `<vibe:grid.item>`, and `<vibe:grid.toolbar>`.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    'subcomponents' => [
        'title' => 'Grid Subcomponents Catalog',
        'columns' => [
            'component' => 'Component',
            'desc' => 'Role & Responsibility',
        ],
    ],

    // Section 4: Lock Modes
    'lock' => [
        'title' => 'Three Card Locking Modes',
        'desc' => 'Each card supports three distinct locking methods through combinations of <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:resizable</code> and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:reorderable</code>. Padlock icons in headers and bottom-right corner resize handles <strong>only appear on hover</strong>, keeping cards clean when idle. Padlock tooltips accurately explain what is locked.',
        'preview_title' => 'Three Locking Modes: Position, Size, and Both',
        'hint' => '💡 Hover over each card to view contextual lock badges corresponding to their locking modes.',
    ],

    'cards' => [
        'user_stats' => 'User Statistics',
        'user_stats_desc' => '1,240 new users registered this week',
        'recent_orders' => 'Recent Orders',
        'recent_orders_desc' => 'New Order #8912 verified',
        'activity_log' => 'Activity Log',
        'resize_drag_instruction' => 'Drag the handle in the bottom-right corner of this card to resize its width.',
        'resize_flexible_instruction' => 'Each card can be widened or narrowed by dragging the resize handle in the bottom-right corner.',
        'reorder_drag_instruction' => 'Use the grip button on the left of the header to drag this card.',
        'reorder_swap_instruction' => 'Swap the position of this card with Card A. Card C next to it is static.',
        'reorder_locked_instruction' => 'This card has :reorderable="false" so its position cannot be moved.',
        'lock_pos_desc' => 'This card position is locked. It cannot be moved, but its width can still be resized.',
        'lock_size_desc' => 'This card size is locked. It cannot be resized, but its order can still be rearranged.',
        'lock_both_desc' => 'Both position and size of this card are fully locked.',
        'card_a' => 'Card A',
        'card_b' => 'Card B',
        'card_c' => 'Card C',
        'card_fixed' => 'Fixed Card (Locked)',
        'card_lock_pos' => 'Card: Lock Position',
        'card_lock_size' => 'Card: Lock Size',
        'card_lock_both' => 'Card: Full Lock',
        'metric_revenue' => 'Total Revenue',
        'metric_growth' => '+14.2% from last month',
    ],

    'props_items' => [
        'root' => [
            'id' => 'Unique identifier for persisting grid layout configurations in browser localStorage.',
            'cols' => 'Number of desktop grid system columns (default: 12 columns).',
            'gap' => 'Spacing gap between grid cards (options: 2, 3, 4, 5, 6).',
            'persist' => 'Automatically persist card order and dimensions to Alpine Store and browser localStorage.',
            'reorderable' => 'Globally enable or disable drag-and-drop card reordering.',
            'resizable' => 'Globally enable or disable column width resizing.',
        ],
        'card' => [
            'id' => 'Unique identification key for the card used for layout persistence.',
            'colSpan' => 'Initial column width of the card on a 12-column grid scale (default: 4).',
            'minColSpan' => 'Minimum column width constraint when dragging/reducing (default: 2).',
            'maxColSpan' => 'Maximum column width constraint when dragging/enlarging (default: 12).',
            'reorderable' => 'Controls whether this individual card can be reordered via drag-and-drop.',
            'resizable' => 'Controls whether this individual card can be resized via corner grabber handle.',
            'title' => 'Card header text title (can also use the title slot).',
            'description' => 'Short explanatory subtitle below the card title.',
        ],
        'toolbar' => [
            'title' => 'Dashboard title or grid section headline.',
            'description' => 'Optional subtitle hint placed below the toolbar title.',
            'resetLabel' => 'Custom text for the layout reset button.',
        ],
        'subcomponents' => [
            'grid' => 'Root container managing responsive CSS grid and Alpine.js state.',
            'card' => 'Individual widget card component with tactile drag handles and interactive resizing.',
            'toolbar' => 'Optional header toolbar housing section titles and the Reset Layout action.',
            'item' => 'Generic item container alias within the grid layout.',
        ],
    ],
];
