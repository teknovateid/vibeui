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

    // Section 5: Custom Styling
    'custom_styling' => [
        'title' => 'Custom Styling (Custom Class)',
        'desc' => 'You can pass custom Tailwind utility classes directly to <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:breadcrumb.item&gt;</code> (e.g. text sizing like <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">text-lg</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">text-2xl</code>, or custom colors). Styles are intelligently merged via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">twMerge</code>.',
        'preview_title' => 'Breadcrumb with Custom Classes',
    ],

    // Section 6: Custom Separator
    'custom_separator' => [
        'title' => 'Custom Separator',
        'desc' => 'The separator between items can be customized using the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">separator</code> prop on <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:breadcrumb&gt;</code> or per item on <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:breadcrumb.item&gt;</code>. Built-in icon presets include <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">/</code> or <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">slash</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">chevron</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">arrow</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dot</code>, custom character strings, or a custom <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:separator&gt;</code>.',
        'preview_title' => 'Separator Icon Options',
    ],

    // Section 7: Props & Slots
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

    'props_items' => [
        'breadcrumb' => [
            'title' => 'Page title above breadcrumb navigation. Pass `false` to hide it.',
            'separator' => 'Default separator icon or character for all items. Options: `chevron` (default), `/` or `slash`, `arrow`, `dot`, or custom text.',
            'class' => 'Additional Tailwind CSS classes applied to the container.',
        ],
        'item' => [
            'href' => 'Destination URL. If provided, item renders as `<a wire:navigate>`. If null, renders as `<span>`.',
            'active' => 'Marks current active page (applies semibold font and contrast styling).',
            'separator' => 'Custom separator icon or character for this specific item (overrides parent setting).',
            'class' => 'Additional custom Tailwind classes merged via `twMerge` into the item link/text element.',
            'wrapperClass' => 'Additional Tailwind classes for the `<li>` wrapper element.',
        ],
    ],
];
