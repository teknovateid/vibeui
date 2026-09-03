<?php

return [
    'title' => 'Breadcrumb',
    'badge' => 'Component',
    'group' => 'Navigation',
    'description' => 'A hierarchical navigation component that helps users understand their current location within the app structure, featuring built-in page titles, quick action button slots, wire:navigate support, and automatic SVG separators.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:breadcrumb&gt;</code> container and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:breadcrumb.item&gt;</code> for each hierarchical link.',
        'preview_title' => 'Standard Breadcrumb',
        'home' => 'Home',
        'products' => 'Products',
        'category' => 'Electronics',
        'item' => 'Smartphone Pro',
    ],

    // Section 2: Page Title
    'title_prop' => [
        'title' => 'Page Title (title)',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">title</code> prop displays a prominent heading above the breadcrumb trail. Provide a string for a custom heading, or pass <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:title="false"</code> to render only the breadcrumb links.',
        'preview_title' => 'Page Title Configuration',
        'custom_title' => 'User Management',
        'settings' => 'Settings',
        'users' => 'Users List',
    ],

    // Section 3: Action Button
    'button_slot' => [
        'title' => 'Action Button Slot (button)',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:button&gt;</code> to embed quick actions on the right side of the breadcrumb header, such as "Add New" or "Export" buttons.',
        'preview_title' => 'Breadcrumb with Action Button',
        'add_user' => 'Add New User',
        'export' => 'Export Data',
    ],

    // Section 4: With Icons
    'icons' => [
        'title' => 'Items with Icons',
        'desc' => 'Each <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:breadcrumb.item&gt;</code> can contain SVG icons alongside link text for enhanced visual hierarchy.',
        'preview_title' => 'Breadcrumb with Icons',
        'home' => 'Home',
        'orders' => 'Orders',
        'invoice' => 'Invoice #INV-2026',
    ],

    // Section 5: Props & Slots
    'props' => [
        'title' => 'Props & Slots Reference',
        'desc' => 'Comprehensive reference of attributes and slots available on <code class="font-mono text-xs text-foreground">&lt;vibe:breadcrumb&gt;</code> and <code class="font-mono text-xs text-foreground">&lt;vibe:breadcrumb.item&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],
    'item_props' => [
        'title' => 'Props for <vibe:breadcrumb.item>',
    ],
    'slots' => [
        'title' => 'Available Slots',
        'columns' => [
            'slot' => 'Slot',
            'desc' => 'Description',
        ],
    ],
];
