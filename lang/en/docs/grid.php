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
];
