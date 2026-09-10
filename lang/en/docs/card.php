<?php

return [
    'title' => 'Card',
    'badge' => 'Component',
    'group' => 'Layout & Container',
    'description' => 'A versatile card component for grouping related content, analytics metrics, forms, or actions with a consistent aesthetic, visual variants support (default, outline, flat, elevated, ghost), flexible padding options, and modular subcomponents (header, title, description, content, footer).',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Use the <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card&gt;</code> tag as the main container wrapper. By default, cards feature rounded corners (<code class="font-mono text-xs text-foreground">rounded-xl</code>), subtle borders, 2xs shadows, and standard interior padding.',
        'preview_title' => 'Basic Card',
        'sample_title' => 'Account Summary',
        'sample_desc' => 'General overview regarding your current membership status and account preferences.',
        'sample_body' => 'Your current subscription is the Pro Plan active until December 2026. All premium features are enabled.',
    ],

    // Section 2: Structured Card (Header, Content, Footer)
    'structured' => [
        'title' => 'Modular Structure (Header, Content & Footer)',
        'desc' => 'For clean, semantic layouts, utilize the modular subcomponents: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.header&gt;</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.title&gt;</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.description&gt;</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.content&gt;</code>, and <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.footer&gt;</code>.',
        'preview_title' => 'Card with Full Subcomponents',
        'title_text' => 'Security Notifications',
        'desc_text' => 'Manage two-factor authentication preferences and login activity alerts.',
        'content_text' => 'Two-factor authentication (2FA) is currently enabled via your authenticator app. Any new sign-in sessions from unrecognized devices will require a 6-digit OTP verification code.',
        'footer_action' => 'Configure 2FA',
        'footer_cancel' => 'Learn More',
    ],

    // Section 3: Variants
    'variants' => [
        'title' => 'Visual Variants',
        'desc' => 'The <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> prop controls the visual presentation: <code class="font-mono text-xs text-foreground">default</code>, <code class="font-mono text-xs text-foreground">outline</code>, <code class="font-mono text-xs text-foreground">flat</code>, <code class="font-mono text-xs text-foreground">elevated</code>, and <code class="font-mono text-xs text-foreground">ghost</code>.',
        'preview_title' => 'Card Variant Options',
        'default' => 'Default (Border & Subtle 2xs Shadow)',
        'outline' => 'Outline (Clean Border & Transparent)',
        'flat' => 'Flat (Muted Background Without Border)',
        'elevated' => 'Elevated (Prominent Medium Shadow)',
        'ghost' => 'Ghost (Fully Transparent)',
    ],

    // Section 4: Padding
    'padding' => [
        'title' => 'Padding Options (padding)',
        'desc' => 'By default, the card has <code class="font-mono text-xs text-foreground">p-6</code> padding. Use <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">padding="none"</code> (or <code class="font-mono text-xs text-foreground">"sm"</code>, <code class="font-mono text-xs text-foreground">"lg"</code>, <code class="font-mono text-xs text-foreground">"xl"</code>) when designing full edge-to-edge tables or banner imagery without outer gutters.',
        'preview_title' => 'Card Without Padding (Edge-to-Edge)',
        'banner_title' => 'System Update v2.4 Released',
        'banner_desc' => 'Real-time analytics dashboard and query performance improvements are now live.',
        'read_more' => 'Read Release Notes',
    ],

    // Section 5: Stat & Metric Cards
    'metrics' => [
        'title' => 'Metrics & KPI Cards',
        'desc' => 'Combine <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card&gt;</code> with <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:badge&gt;</code> to compose informative, modern analytical dashboards.',
        'preview_title' => 'Dashboard & KPI Cards',
        'total_revenue' => 'Total Revenue',
        'revenue_val' => '$148,520.00',
        'active_users' => 'Active Users',
        'users_val' => '24,890',
        'conversion_rate' => 'Conversion Rate',
        'conversion_val' => '4.85%',
        'growth_revenue' => '+18.2% this mo',
        'growth_users' => '+8.4% this mo',
        'growth_conversion' => '+1.2% this mo',
    ],

    // Section 6: Props & Slots
    'props' => [
        'title' => 'Props & Subcomponents Reference',
        'desc' => 'Comprehensive list of props and subcomponents available for the <code class="font-mono text-xs text-foreground">&lt;vibe:card&gt;</code> component.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Type',
            'default' => 'Default',
            'desc' => 'Description',
        ],
    ],

    'slots' => [
        'title' => 'Available Slots',
        'columns' => [
            'slot' => 'Slot / Component',
            'desc' => 'Description & Usage',
        ],
    ],

    'variants_items' => [
        'flat_desc' => 'Soft subtle background without borders.',
        'elevated_desc' => 'Medium elevation shadow for focused cards.',
        'ghost_desc' => 'Fully transparent without borders.',
    ],

    'props_items' => [
        'variant' => "Card visual style: `'default'`, `'outline'`, `'flat'`, `'elevated'`, or `'ghost'`.",
        'padding' => "Internal padding sizing: `'none'` (p-0), `'sm'` (p-4), `'lg'` (p-8), `'xl'` (p-10), or custom string. Default: `p-6`.",
    ],

    'slots_items' => [
        'header' => 'Card header container with vertical flex layout and default bottom spacing.',
        'title' => 'Semantic title element (<code class="font-mono text-xs text-foreground">&lt;h3&gt;</code>) with bold, snug typography.',
        'description' => 'Supporting description element beneath card title in muted text.',
        'content' => 'Main card body content wrapper.',
        'footer' => 'Card footer section with top divider and action button placement.',
    ],
];
