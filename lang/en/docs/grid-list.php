<?php

return [
    'title' => 'Grid List',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'An interactive layout toggle component that enables users to effortlessly switch their view between a responsive 3-column Grid and a full-width vertical List. Includes automatic localStorage persistence, zero-FOUC inline hydration preventing layout flickers, and a flexible header slot for search inputs and filters.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Enclose your collection of items or cards inside the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:grid-list&gt;</code> component. The layout toggle button group is automatically rendered in the top-right corner.',
        'preview_title' => 'Basic Item Catalog',
        'item_title' => 'Project Item',
        'item_desc' => 'Concise project summary demonstrating responsive grid and list layouts.',
    ],

    // Section 2: Default Layout
    'default_layout' => [
        'title' => 'Initial Layout Setting (defaultLayout)',
        'desc' => 'Configure the initial presentation via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">default-layout="grid"</code> or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">default-layout="list"</code> (defaults to <code class="font-mono text-xs text-foreground">\'list\'</code>).',
        'preview_title' => 'Initial List Presentation (default-layout="list")',
    ],

    // Section 3: Header Slot
    'header_slot' => [
        'title' => 'Custom Header Slot ($header)',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:header&gt;</code> slot to insert a section title, search bar, category filters, or item counters alongside the toggle buttons.',
        'preview_title' => 'Catalog with Header Search & Filters',
        'search_placeholder' => 'Search project repositories...',
        'count_badge' => '6 Active Projects',
        'header_title' => 'Team Project Repositories',
    ],

    // Section 4: Rich Catalog Cards
    'rich_cards' => [
        'title' => 'Adaptive Catalog Cards',
        'desc' => 'Responsive cards smoothly transition between compact vertical columns in Grid mode and spacious horizontal containers in List mode.',
        'preview_title' => 'Cloud Server & Node Catalog',
        'status_active' => 'Running',
        'status_maintenance' => 'Maintenance',
        'view_details' => 'View Details',
        'cpu' => 'vCPU',
        'ram' => 'RAM',
        'storage' => 'SSD',
    ],

    // Section 5: Persistence & Anti-Flicker
    'persistence' => [
        'title' => 'Persistence & Zero-FOUC Hydration',
        'desc' => 'The component automatically remembers the user\'s last preferred view mode in <code class="font-mono text-xs text-foreground">localStorage</code> under the unique <code class="font-mono text-xs text-foreground">id</code>. A lightweight inline IIFE script applies the layout classes before Alpine initializes, eliminating any Flash of Unstyled Content (FOUC).',
    ],

    // Section 6: Props Reference
    'props' => [
        'title' => 'Props & Configuration Reference',
        'desc' => 'Detailed specification of attributes supported by <code class="font-mono text-xs text-foreground">&lt;vibe:grid-list&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    'classes' => [
        'title' => 'Built-in Layout CSS Classes',
        'columns' => [
            'mode' => 'View Mode',
            'classes' => 'Applied Tailwind Classes',
            'desc' => 'Layout Behavior',
        ],
    ],
];
