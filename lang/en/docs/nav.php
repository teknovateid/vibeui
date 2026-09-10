<?php

return [
    'title' => 'Nav',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'A comprehensive, modular navigation architecture designed for application sidebars and menus. Features multi-level collapsible accordion groups, category section dividers, dynamic pinned items with localStorage persistence, recent route visit history, and seamless minified sheet integration with floating hover flyouts.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the root wrapper <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:nav&gt;</code> alongside link items <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:nav.item&gt;</code>. Each item accommodates an icon slot <code class="font-mono text-xs text-foreground">&lt;x-slot:icon&gt;</code>, active state indicators via <code class="font-mono text-xs text-foreground">:active="true"</code>, and notification count badges.',
        'preview_title' => 'Simple Navigation Menu',
        'dashboard' => 'Dashboard',
        'analytics' => 'Analytics',
        'messages' => 'Inbox Messages',
        'notifications' => 'Notifications',
    ],

    // Section 2: Groups
    'groups' => [
        'title' => 'Collapsible Sub-menus (vibe:nav.group)',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:nav.group&gt;</code> to compose collapsible accordion item trees. Groups feature smooth chevron toggle animations, auto-expand if any child is active (<code class="font-mono text-xs text-foreground">:active="true"</code>), and support localStorage state persistence with <code class="font-mono text-xs text-foreground">:persist="true"</code>.',
        'preview_title' => 'Accordion Menu with Nested Items',
        'ecommerce' => 'E-Commerce',
        'products' => 'All Products',
        'orders' => 'Customer Orders',
        'customers' => 'Buyer Directory',
        'content' => 'Content Hub',
        'articles' => 'Blog Posts',
        'categories' => 'Categories',
    ],

    // Section 3: Labels
    'labels' => [
        'title' => 'Section Category Dividers (vibe:nav.label)',
        'desc' => 'Organize your navigation items into distinct structural tiers using <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:nav.label&gt;</code>. Each label includes an independent collapse/expand control to conceal or reveal entire sections.',
        'preview_title' => 'Tiered Navigation with Section Labels',
        'main_section' => 'MAIN APPLICATION',
        'system_section' => 'SYSTEM PREFERENCES',
        'users' => 'Users & Permissions',
        'security' => 'Account Security',
        'audit' => 'Activity Audit Logs',
    ],

    // Section 4: Pinning
    'pinning' => [
        'title' => 'Favorite Item Pinning (vibe:nav.pinned)',
        'desc' => 'Enable the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">pinnable</code> prop on <code class="font-mono text-xs text-foreground">&lt;vibe:nav&gt;</code> to render interactive pin buttons on menu items. Place the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:nav.pinned&gt;</code> container anywhere in your layout to house user-pinned shortcuts, stored automatically in localStorage with zero-FOUC.',
        'pinned_desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:nav.pinned&gt;</code> component is a dedicated accordion container that remains gracefully hidden until at least one item is pinned. Clicking pin on any menu instantly clones the shortcut into this container with capacity counters (<code class="font-mono text-xs text-foreground">maxpin</code>) and unpin controls.',
        'preview_title' => 'Interactive Item Pinning Demonstration',
        'hint' => 'Hover over any menu item below and click the Pin icon on the right to pin it to the top section!',
        'pinned_title' => 'Pinned Shortcuts',
    ],

    // Section 5: History
    'history' => [
        'title' => 'Recent Route Visit History (vibe:nav.history)',
        'desc' => 'Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:nav.history&gt;</code> to automatically capture and display the user\'s most recently visited pages. Perfect for sidebar footers to enable rapid context-switching.',
        'preview_title' => 'Route History Container',
        'history_title' => 'Recent History',
    ],

    // Section 6: Minified Integration
    'minified' => [
        'title' => 'Minified Sheet Drawer Integration',
        'desc' => 'The Nav ecosystem seamlessly pairs with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:sheet behavior="minify"&gt;</code>. When minimized, text labels collapse smoothly, icons center automatically, and hovering reveals floating flyout popovers that escape container overflow constraints.',
        'preview_title' => 'Navigation Behavior on Compact Sidebar',
    ],

    // Section 7: Props Reference
    'props' => [
        'title' => 'Props & Subcomponents Reference',
        'desc' => 'Specification of available configuration options across the <code class="font-mono text-xs text-foreground">&lt;vibe:nav&gt;</code> suite.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    'subcomponents' => [
        'title' => 'Nav Subcomponents Catalog',
        'columns' => [
            'component' => 'Component',
            'desc' => 'Role & Responsibility',
        ],
    ],

    'pinning_items' => [
        'available_features' => 'AVAILABLE FEATURES',
        'perf_analytics' => 'Performance Analytics',
        'incoming_orders' => 'Incoming Orders',
    ],

    'subcomponents_items' => [
        'root' => 'Root navigation container managing pinning state, floating popovers, and minified sheet integration.',
        'group' => 'Collapsible accordion group hosting sub-navigation items.',
        'label' => 'Category section header with independent collapse/expand capability.',
        'pinned' => 'Dynamic container displaying pinned shortcut clones pinned by the user.',
        'history' => 'Dynamic container recording recent route navigation history accessed by the user.',
    ],

    'props_items' => [
        'root' => [
            'id' => 'Unique nav element ID for saving preferences in localStorage.',
            'pinnable' => 'Enable pin action buttons across all child navigation items.',
            'maxpin' => 'Maximum number of items that can be pinned simultaneously.',
            'collapsed' => 'Collapse navigation to compact icon-only mode.',
        ],
        'item' => [
            'href' => 'Target destination URL for the link.',
            'active' => 'Mark the item as active with bold background styling.',
            'badge' => 'Indicator badge text on the right (e.g. numeric counter or status).',
            'badgeColor' => 'Badge color variant: `"success"`, `"info"`, `"destructive"`, `"warning"`, `"accent"`, or default.',
            'pinnable' => 'Display pin button specifically on this item.',
            'id' => 'Unique item ID for pin shortcut persistence.',
        ],
        'pinned' => [
            'title' => 'Header accordion title for pinned shortcut container (default: "Pinned" or translation).',
            'open' => 'Initial open/collapsed state of the pinned shortcuts list.',
            'persist' => 'Persist pinned accordion open/close state to `localStorage`.',
            'id' => 'Unique identifier for mapping accordion persistence state in the browser.',
        ],
        'group' => [
            'title' => 'Accordion menu group title.',
            'open' => 'Initial open status of the menu group.',
            'active' => 'Mark group as active and expand automatically on initial page load.',
            'persist' => 'Save group expanded/collapsed preference to `localStorage`.',
            'pinnable' => 'Allow entire menu group to be pinned as a shortcut.',
            'id' => 'Unique group ID for persistence state mapping.',
        ],
        'label' => [
            'title' => 'Header title text for section category separator.',
            'open' => 'Initial visibility status of items under this section label.',
            'persist' => 'Save section open/close preference to `localStorage`.',
            'id' => 'Unique label ID for state persistence mapping.',
        ],
        'history' => [
            'title' => 'Header title text for navigation history container (default: "History").',
            'open' => 'Initial open/collapsed state of the history accordion.',
            'persist' => 'Save history container open/collapsed preference to `localStorage`.',
        ],
    ],
];
