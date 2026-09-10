<?php

return [
    'title' => 'Header',
    'badge' => 'Component',
    'group' => 'UI Components',
    'description' => 'A versatile page header component designed to present view titles, contextual metadata descriptions, and action button groups. Features customizable padding sizes (sm, default, lg), sticky scroll pinning, and harmonious integration with breadcrumbs, badges, avatars, and dropdowns.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:header&gt;</code> component alongside semantic subcomponents <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:header.heading&gt;</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:header.subheading&gt;</code>, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:header.actions&gt;</code>.',
        'preview_title' => 'Standard Page Header',
        'heading' => 'User Management',
        'subheading' => 'Manage team member accounts, system permissions, and role authorizations.',
        'export_btn' => 'Export CSV',
        'create_btn' => 'Add New Member',
    ],

    // Section 2: Sizes
    'sizes' => [
        'title' => 'Padding Sizes (size)',
        'desc' => 'Three padding scales are available via the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">size</code> prop: <code class="font-mono text-xs text-foreground">\'sm\'</code> (compact for modals or secondary panels), <code class="font-mono text-xs text-foreground">\'default\'</code> (standard page views), and <code class="font-mono text-xs text-foreground">\'lg\'</code> (generous for primary landing or dashboard overviews).',
        'preview_title' => 'Header Size Variations (sm, default, lg)',
        'small_title' => 'Small Header (sm)',
        'small_sub' => 'Ideal for modal dialogs and compact drawer panels.',
        'default_title' => 'Default Header (default)',
        'default_sub' => 'Standard sizing suitable for general application layouts.',
        'large_title' => 'Large Header (lg)',
        'large_sub' => 'Spacious padding suitable for prominent dashboard hubs.',
    ],

    // Section 3: Sticky Header
    'sticky' => [
        'title' => 'Sticky Header (variant="sticky")',
        'desc' => 'Set <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant="sticky"</code> to pin the header to the top of the viewport (<code class="font-mono text-xs text-foreground">sticky top-0 z-50</code>). When scrolled, the header dynamically transitions from transparent to a semi-transparent frosted glass background (<code class="font-mono text-xs text-foreground">backdrop-blur-md</code>). You can customize scrolling styles via <code class="font-mono text-xs text-foreground">scrolled-class</code> and <code class="font-mono text-xs text-foreground">unscrolled-class</code>.',
        'preview_title' => 'Sticky Header Demonstration with Scrolled Background',
        'sticky_heading' => 'Payment Transaction Details',
        'sticky_sub' => 'Transaction Reference: TRX-2026-981023',
        'save_btn' => 'Save Changes',
        'hint' => 'Scroll down inside this container to see the header stay pinned at the top with a smooth semi-transparent frosted glass background!',
    ],

    // Section 4: Rich Composition
    'rich_composition' => [
        'title' => 'Rich Composition (Avatar, Badge, & Breadcrumb)',
        'desc' => 'Seamlessly compose <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:header&gt;</code> with complementary Vibe UI components such as Breadcrumbs above the heading, user Avatars, and status Badges.',
        'preview_title' => 'Advanced User Profile Header',
        'user_name' => 'Sarah Jenkins',
        'user_role' => 'Lead Product Designer &bull; Teknovate Design Systems',
        'status' => 'Active',
        'edit_profile' => 'Edit Profile',
        'settings' => 'Settings',
    ],

    // Section 5: Props Reference
    'props' => [
        'title' => 'Props & Subcomponents Reference',
        'desc' => 'Comprehensive reference of supported attributes and subcomponents across the <code class="font-mono text-xs text-foreground">&lt;vibe:header&gt;</code> suite.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    'subcomponents' => [
        'title' => 'Subcomponents',
        'columns' => [
            'component' => 'Component',
            'tag' => 'HTML Tag',
            'desc' => 'Role & Responsibility',
        ],
    ],

    'props_items' => [
        'variant' => "Header placement variant: `'default'` (normal static) or `'sticky'` (affixed to top of viewport with `sticky top-0 z-50`).",
        'size' => "Header padding size: `'sm'` (`py-2.5 px-4`), `'default'` (`py-4 px-6`), or `'lg'` (`py-6 px-8`).",
        'scrolledClass' => "Utility classes added when sticky header is scrolled past threshold.",
        'unscrolledClass' => "Utility classes when sticky header is at the top position (unscrolled).",
        'threshold' => "Scroll offset distance (in pixels) required to activate scrolled state.",
    ],
];
